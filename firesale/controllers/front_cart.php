<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* This file is part of FireSale, a PHP based eCommerce system built for
* PyroCMS.
*
* Copyright (c) 2013 Moltin Ltd.
* http://github.com/firesale/firesale
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*
* @package firesale/core
* @author FireSale <support@getfiresale.org>
* @copyright 2013 Moltin Ltd.
* @version master
* @link http://github.com/firesale/firesale
*
*/

class Front_cart extends Public_Controller
{

    public $validation_rules = array();
    public static $valid_gateway = true;
    public static $valid_shipping = true;
    public $stream;

    public function __construct()
    {
        parent::__construct();

        // Load ci-merchant language file
        $this->lang->load('merchant');

        // Load cart class, the ci-merchant class and the gateways class
        $this->load->library(array('fs_cart', 'merchant', 'gateways'));

        // Load the required models
        $this->load->driver('Streams');
        $this->load->library('files/files');
        $this->load->model('firesale/cart_m');
        $this->load->model('firesale/orders_m');
        $this->load->model('firesale/address_m');
        $this->load->model('firesale/categories_m');
        $this->load->model('firesale/products_m');
        $this->load->model('firesale/routes_m');
        $this->load->model('firesale/modifier_m');

        // Require login?
        if ( $this->settings->get('firesale_login') == 1 and ! $this->current_user ) {

            // Posted to cart
            if ( $this->uri->segment('2') == 'insert' and $code = $this->input->post('prd_code') ) {
                $qty = $this->input->post('prd_qty');
                $url = $this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time).'/insert/'.$code[0].'/'.( $qty ? $qty[0] : '1' );
            } else {
                $url = current_url();
            }

            // Set data and redirect
            $this->session->set_flashdata('error', lang('firesale:cart:login_required'));
            $this->session->set_userdata('redirect_to', $url);

            // Ajax response
            if ( $this->input->is_ajax_request() ) {
                // If ajax send back error reponse
                echo $this->cart_m->ajax_response(lang('firesale:cart:login_required'));
                exit();
            }

            // Redirect
            redirect('users/login');
        }

        // Get the stream
        $this->stream = $this->streams->streams->get_stream('firesale_orders', 'firesale_orders');

        // Load css/js
        $this->template->append_css('module::firesale.css')
                       ->append_js('module::firesale.js');
    }

    public function index()
    {

        // Check for price change
        $this->cart_m->check_price();
        
        // get the cart data
        $data = $this->_cart_data();

        // Add page data
        $this->template->set_breadcrumb(lang('firesale:cart:title'))
                       ->title(lang('firesale:cart:title'));

        // Fire events
        Events::trigger('page_build', $this->template);

        // Build page
        $this->template->build('cart', $data);
    }
    
    /**
     * Return the cart as a json object
     */
    public function json()
    {
        // Check for price change
        $this->cart_m->check_price();
        
        // get the cart data
        $data = $this->_cart_data();
        
        // output json response
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($data));
    }
    
    public function _cart_data()
    {
        $data = array();
        
        // Assign Variables
        $data['subtotal']    = $this->currency_m->format_string($this->fs_cart->subtotal(), $this->fs_cart->currency(), false);
        $data['tax']   		 = $this->currency_m->format_string($this->fs_cart->tax(), $this->fs_cart->currency(), false);
        $data['total']   	 = $this->currency_m->format_string($this->fs_cart->total(), $this->fs_cart->currency(), false);
        $data['currency']    = $this->fs_cart->currency();
        $data['contents']    = $this->fs_cart->contents();

        // Add item id
        $i = 1;
        foreach ($data['contents'] AS &$product) {

            $product['price']    = $this->currency_m->format_string($product['price'], $this->fs_cart->currency(), false);
            $product['subtotal'] = $this->currency_m->format_string($product['subtotal'], $this->fs_cart->currency(), false);
            $product['no']       = $i;

            $i++;
        }
        
        return $data;
    }

    public function insert($prd_code = NULL, $qty = 1)
    {
        // Variables
        $data = array();
        $tmp  = array();

        // Setup post data
        if ($prd_code !== NULL) {

            // Set basics
            $_POST['prd_code'][0] = $prd_code;
            $_POST['qty'][0]      = $qty;

            // Get product
            $product = $this->pyrocache->model('products_m', 'get_product', array($prd_code, null, true), $this->firesale->cache_time);

            // Check and add variations
            if ( $product['modifiers'] ) {

                // Loop modifiers
                foreach ( $product['modifiers'] as $variation ) {

                    // Update ID
                    if ( $product['is_variation'] == '1' ) {
                        $_POST['prd_code'][0] = $modifier['parent'];
                    }

                    // Add option
                    if ( isset($variation['variations']) ) {
                        $variation = current($variation['variations']);
                        $_POST['options'][0][$variation['parent']] = $variation['id'];
                    } else {
                        $_POST['options'][0][$variation['id']] = $variation['var_id'];
                    }

                }
            }
        }

        // Add an item to the cart
        if (is_array($this->input->post('prd_code'))) {

            $qtys = $this->input->post('qty', TRUE);

            // Check for options
            if ( $this->input->post('options') ) {
                // Modify post
                $_POST = $this->modifier_m->cart_variation($this->input->post());
            }

            foreach ($this->input->post('prd_code', TRUE) as $key => $prd_code) {

                // Get product
                $product   = $this->pyrocache->model('products_m', 'get_product', array($prd_code, null, true), $this->firesale->cache_time);
                $modifiers = current($product['modifiers']);

                // Check status
                $status = $this->modifier_m->single_product_stock($product['id'], $_POST['options'][$key], (int)$qtys[$key]);
                if ( $status !== true ) {
                    $this->session->set_flashdata('error', sprintf(lang('firesale:vars:stock_low'), $status));
                    redirect($_SERVER['HTTP_REFERER']);
                }

                // Increase price based on options
                $product['price_rounded'] += $this->input->post('price') or 0;
                $product['price']         += $this->input->post('price') or 0;

                // Check product, stock and modifiers
                if ( $product != FALSE and ( $product['stock_status']['key'] == 6 OR $qty > 0 ) and
                    ( (!is_array($modifiers['type']) or (is_array($modifiers) and ! isset($modifiers['type']['key']))) or 
                        ( is_array($modifiers['type']) and isset($modifiers['type']['key']) and $modifiers['type']['key'] != '1' ) ) ) {
                    
                    // Build cart data
                    $data[] = $this->cart_m->build_data($product, (int) $qtys[$key], $_POST['options'][$key]);

                    // Update stock levels
                    if ($product['stock_status']['key'] != 6) { $tmp[$product['id']] = $product['stock']; }
                }

            }

        }

        // Insert items into the cart
        $this->fs_cart->insert($data);

        // Force available quanity
        if ( $this->cart_m->check_quantity($this->fs_cart->contents(), $tmp) ) {
            // Set flash to warn the user
            $this->session->set_flashdata('message', lang('firesale:cart:qty_too_low'));
        }

        if ($product != FALSE) {
            Events::trigger('cart_item_added', (array) $product);
        }

        Events::trigger('cart_updated');
        
        // Return for ajax or redirect
        if ( $this->input->is_ajax_request() ) {
            exit($this->cart_m->ajax_response('ok'));
        } else if ( $this->input->post('btnAction') == 'buy' ) {
            redirect($this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time).'/checkout');
        } else {
            redirect($this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time));
        }

    }

    public function update()
    {

        // Make sure there are items in cart
        if ( ! $this->fs_cart->total_items()) {
            $this->session->set_flashdata('message', lang('firesale:cart:empty'));
            redirect($this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time));
        } else {

            // Variables
            $cart = $this->fs_cart->contents(); // Get the current contents of the cart
            $data = array(); // Set the empty data array

            // Loop through the updates, checking the quantity against the stock level and updating accordingly
            foreach ($this->input->post('item', TRUE) as $row_id => $item) {

                if (array_key_exists($row_id, $cart)) {

                    $data['rowid'] = $row_id;

                    // Has this item been marked for removal?
                    if (isset($item['remove']) OR $item['qty'] <= 0) {

                        $data['qty'] = 0;

                        // If this is a current order, update the table
                        if ($this->cart_m->cart_has_order()) {
                            $this->orders_m->remove_order_item($this->session->userdata('order_id'), $cart[$row_id]['id']);
                        }

                    } else {

                        $product = $this->pyrocache->model('products_m', 'get_product', array($cart[$row_id]['id'], null, true), $this->firesale->cache_time);

                        if ($product) {

                            // Set the new quantity, or the stock level if the quantity exceeds it.
                            $data['qty'] = ( $product['stock_status']['key'] != 6 && $item['qty'] > $product['stock'] ? $product['stock'] : $item['qty'] );

                            // If this is a current order, update the table
                            if ($this->cart_m->cart_has_order()) {
                                $this->orders_m->insert_update_order_item($this->session->userdata('order_id'), $cart[$row_id], $data['qty']);
                            }

                            if ($data['qty'] < $item['qty']) {
                                // Set flash to warn the user
                                $this->session->set_flashdata('message', lang('firesale:cart:qty_too_low'));
                            }

                        } elseif ( ! array_key_exists('custom', $cart[$row_id])) {

                            // Looks like this product no longer exists, remove it!
                            $data['qty'] = 0;

                            // If this is a current order, update the table
                            if ($this->cart_m->cart_has_order()) {
                                $this->orders_m->remove_order_item($this->session->userdata('order_id'), $cart[$row_id]['id']);
                            }

                        }

                    }

                }

                // Update cart
                $this->fs_cart->update($data);

            }

            // Update order cost
            $this->orders_m->update_order_cost($this->session->userdata('order_id'));

            // Fire events
            Events::trigger('cart_updated', array());

            // Are we checking out or just updating?
            if ($this->input->post('btnAction') == 'checkout') {

                // Added so shipping can be a cart option
                if ($shipping = $this->input->post('shipping')) {
                    $this->session->set_userdata('shipping', $shipping);
                }

                // Send to checkout
                redirect($this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time).'/checkout');

            } elseif ($this->input->is_ajax_request()) {
                exit($this->cart_m->ajax_response('ok'));
            } else {
                redirect($this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time));
            }

        }

    }

    public function remove($row_id)
    {

        // If this is a current order, update the table
        if ($this->cart_m->cart_has_order()) {
            $cart = $this->fs_cart->contents();
            $this->orders_m->remove_order_item($this->session->userdata('order_id'), $cart[$row_id]['id']);
        }

        // Get product details
        $product = $this->pyrocache->model('products_m', 'get_product', array($cart[$row_id]['id'], null, true), $this->firesale->cache_time);

        // Update the cart
        $this->fs_cart->remove($row_id);

        // Fire events
        Events::trigger('cart_item_removed', $product);

        if ($this->input->is_ajax_request()) {
            exit('success');
        } else {
            redirect(isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time));
        }

    }

    public function checkout()
    {

        // No checkout without items
        if ( ! $this->fs_cart->total_items()) {
            $this->session->set_flashdata('message', lang('firesale:cart:empty'));
            redirect($this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time));
        } else {

            // Libraries
            $this->load->library('gateways');
            $this->load->model('streams_core/streams_m');
            $this->load->helper('form');

            // Variables
            $data = array('ship_req' => false, 'shipping' => array());

            // Check for shipping requirements
            foreach ($this->fs_cart->contents() as $item) {
                if ( ! isset($item['ship']) OR $item['ship'] == 1 ) {
                    $data['ship_req'] = true;
                    break;
                }
            }

            // Get available shipping methods
            if ( $data['ship_req'] === true ) {
                $results = Events::trigger('shipping_methods', $this->fs_cart->contents(), 'array');
                foreach ($results as $result) {
                    $data['shipping'] = array_merge($data['shipping'], $result);
                }
            }

            // Check for post data
            if ($this->input->post('btnAction') == 'pay') {

                // Variables
                $posted = true;
                $input 	= $this->input->post();
                $skip	= array('btnAction', 'bill_details_same');
                $extra 	= array('return' => 'cart/payment', 'error_start' => '<div class="error-box">', 'error_end' => '</div>', 'success_message' => false, 'error_message' => false);

                // Shipping option
                if ( $data['ship_req'] AND ! empty($data['shipping']) AND isset($input['shipping'])) {
                    foreach ( $data['shipping'] as $ship ) {
                        if ( $ship['id'] == $input['shipping'] ) {
                            $shipping = $ship;
                            break;
                        }
                    }
                } else {
                    $shipping['price'] = '0.00';
                }

                // Same as billing address
                if ($data['ship_req'] and $input['ship_to'] == "same_as_billing") {
                    foreach ($input as $key => $field) {
                        if (substr($key, 0, 5) != 'bill_') continue;

                        $input[str_replace("bill_", "ship_", $key)] = $field;
                    }

                    $input['ship_to'] = $input['bill_to'];
                    // Don't save this address
                    $input['ship_title'] = "";
                }

                // Modify posted data
                $input['shipping']	   = ( isset($input['shipping']) ? $input['shipping'] : 0 );
                $input['created_by']   = ( isset($this->current_user->id) ? $this->current_user->id : NULL );
                $input['order_status'] = '1'; // Unpaid
                $input['price_sub']    = $this->fs_cart->subtotal();
                $input['price_ship']   = $shipping['price'];
                $input['price_total']  = number_format($this->fs_cart->total() + $shipping['price'], 2);
                $_POST 				   = $input;

                // Generate validation
                $rules = $this->cart_m->build_validation($data['ship_req']);
                $this->form_validation->set_rules($rules);

                // Run validation
                if ($this->form_validation->run() === TRUE) {
                    // Check for addresses
                    if ( $data['ship_req'] AND ( ! isset($input['ship_to']) OR $input['ship_to'] == 'new' ) ) {
                        $input['ship_to'] = $this->address_m->add_address($input, 'ship');
                    }

                    if ( ! isset($input['bill_to']) OR $input['bill_to'] == 'new' ) {
                        $input['bill_to'] = $this->address_m->add_address($input, 'bill');
                    }

                    // Insert order
                    if ($id = $this->orders_m->insert_order($input)) {

                        // Now for each item in the order
                        foreach ($this->fs_cart->contents() as $item) {
                            $this->orders_m->insert_update_order_item($id, $item, $item['qty']);
                        }

                        // CH: Trigger an event
                        Events::trigger('order_created', array('id' => $id));

                        // Set order id
                        $this->session->set_userdata('order_id', $id);

                        // Redirect to payment
                        redirect($this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time).'/payment');
                    }

                }

                // Set error flashdata & continue to page build
                $this->session->set_userdata('flash:old:error', implode('<br />', $this->form_validation->error_array()));

            } else {

                $posted = FALSE;
                $input  = FALSE;
                $skip   = array();
                $extra  = array();

                // Check if the user has placed an order before and use these details.
                if (isset($this->current_user->id)) {
                    $input = (object) $this->orders_m->get_last_order($this->current_user->id);
                }

            }

            if( isset($this->current_user->id) ) {

                // Get available bliing and shipping options
                $data['addresses'] = $this->address_m->get_addresses($this->current_user->id);

                // Possibly first time, pre-populate some things
                if( empty($_POST) ) {

                    $_POST = array(
                        'ship_email'     => $this->current_user->email,
                        'ship_firstname' => $this->current_user->first_name,
                        'ship_lastname'  => $this->current_user->last_name,
                        'ship_company'   => $this->current_user->company,
                        'ship_phone'     => $this->current_user->phone,
                        'bill_email'     => $this->current_user->email,
                        'bill_firstname' => $this->current_user->first_name,
                        'bill_lastname'  => $this->current_user->last_name,
                        'bill_company'   => $this->current_user->company,
                        'bill_phone'     => $this->current_user->phone
                    );

                    $input = $_POST;
                }
            }

            // Get fields
            $data['ship_fields'] = $this->address_m->get_address_form('ship', 'new', ( $input ? $input : null ));
            $data['bill_fields'] = $this->address_m->get_address_form('bill', 'new', ( $input ? $input : null ));
            $data['valid_shipping'] = self::$valid_shipping;
            $data['valid_gateway']  = self::$valid_gateway;

            // Check for shipping option set in cart
            if ( $this->session->userdata('shipping') ) {
                $data['shipping'] = $this->session->userdata('shipping');
            }

            // Minimal layout
            if ( $this->settings->get('firesale_basic_checkout') == '1' ) {
                $this->template->set_layout('minimal.html');
            }

            // Build page
            $this->template->set_breadcrumb(lang('firesale:cart:title'), $this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time))
                           ->set_breadcrumb(lang('firesale:checkout:title'))
                           ->title(lang('firesale:checkout:title'))
                           ->build('checkout', $data);

        }

    }

    public function _validate_address($value)
    {
        return TRUE;
    }

    public function _validate_shipping($value)
    {

        if ($value) {

            $cart = $this->fs_cart->contents();
            $total = $this->fs_cart->total();
    
            $weight = 0;
    
            foreach ($cart as $item) {
                if ($item['weight']) {
                    $weight += intval($item['weight']);
                }
            }
        
            $query = $this->db->get_where('firesale_shipping', array('id' => $value));
    
            if ($query->num_rows()) {

                $result = $query->row();

                if ($result->price_min > $total) {
                    $this->form_validation->set_message('_validate_shipping', lang('firesale:checkout:shipping_min_price'));
                } elseif ($result->price_max < $total) {
                    $this->form_validation->set_message('_validate_shipping', lang('firesale:checkout:shipping_max_price'));
                } elseif ($result->weight_min > $weight) {
                    $this->form_validation->set_message('_validate_shipping', lang('firesale:checkout:shipping_min_weight'));
                } elseif ($result->weight_max < $weight) {
                    $this->form_validation->set_message('_validate_shipping', lang('firesale:checkout:shipping_max_weight'));
                } else {
                   return TRUE;  
                }
                
            }
        } else {
            $this->form_validation->set_message('_validate_shipping', lang('firesale:checkout:shipping_invalid'));
            self::$valid_shipping = false; 
        }

        return FALSE;
    }

    public function _validate_gateway($value)
    {
        $this->form_validation->set_message('_validate_gateway', lang('firesale:checkout:gateway_invalid'));

        $valid = $this->gateways->is_enabled($value);

        self::$valid_gateway = $valid;

        return $valid;
    }

    public function payment()
    {

        $order = $this->pyrocache->model('orders_m', 'get_order_by_id', array($this->session->userdata('order_id')), $this->firesale->cache_time);

        if ( ! empty($order) AND $this->gateways->is_enabled($order['gateway']['id'])) {

            // Get the gateway slug
            $gateway = $this->gateways->slug_from_id($order['gateway']['id']);
            $settings = $this->gateways->settings($gateway);
                
            // Initialize CI-Merchant
            $this->merchant->load($gateway);
            $this->merchant->initialize($settings);

            // Skip confirmation
            $skip = isset($settings['skip_confirmation_page']) and $settings['skip_confirmation_page'];

            // Begin payment processing
            if ($_SERVER['REQUEST_METHOD'] == 'POST' or $skip) {
                // Load the routes model
                $this->load->model('routes_m');

                $posted_data = $this->input->post(NULL, TRUE);

                // Run payment
                $params = array_merge(array(
                    'notify_url' => site_url($this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time) . '/callback/' . $gateway . '/' . $order['id']),
                    'return_url' => site_url($this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time) . '/success'),
                    'cancel_url' => site_url($this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time) . '/cancel')
                ), $posted_data ? $posted_data : array(), array(
                    'currency_code'  => $this->fs_cart->currency()->cur_code,
                    'amount'         => $this->fs_cart->total() + $order['shipping']['price'],
                    'order_id'       => $this->session->userdata('order_id'),
                    'transaction_id' => $this->session->userdata('order_id'),
                    'reference'      => 'Order #' . $this->session->userdata('order_id'),
                    'description'    => 'Order #' . $this->session->userdata('order_id'),
                    'first_name'     => $order['bill_to']['firstname'],
                    'last_name'      => $order['bill_to']['lastname'],
                    'address1'       => $order['bill_to']['address1'],
                    'address2'       => $order['bill_to']['address2'],
                    'city'           => $order['bill_to']['city'],
                    'region'         => $order['bill_to']['county'],
                    'country'        => $order['bill_to']['country']['code'],
                    'postcode'       => $order['bill_to']['postcode'],
                    'phone'          => $order['bill_to']['phone'],
                    'email'          => $order['bill_to']['email'],
                ));

                $process = $this->merchant->purchase($params);

                $this->db->insert('firesale_transactions', array(
                    'reference' => $process->reference(),
                    'order_id'  => $order['id'],
                    'gateway'   => $gateway,
                    'amount'    => $this->fs_cart->total() + $order['shipping']['price'],
                    'currency'  => $this->fs_cart->currency()->cur_code,
                    'status'    => $process->status(),
                    'data'      => serialize($process->data())
                ));

                $status = '_order_' . $process->status();

                // Check status
                if ($process->status() == 'authorized') {
                    if ((float) $process->amount() == (float) $order['price_total']) {
                        // Remove ID & Shipping option
                        $this->session->unset_userdata('order_id');
                        $this->session->unset_userdata('shipping');
                    } else {
                        $status = '_order_mismatch';
                    }
                } else {
                    // Looks like theres an error! Set this to flash data so we know.
                    $this->session->set_flashdata('error', $process->message());
                }

                // Minimal layout
                if ( $this->settings->get('firesale_basic_checkout') == '1' ) {
                    $this->template->set_layout('minimal.html');
                } else {
                    $this->template->set_layout('default.html');
                }

                $theme_path = $this->template->get_theme_path();
                if ($process->is_redirect()) {
                    if (file_exists($theme_path . 'views/modules/firesale/gateways/redirect/all.php')) {
                        $this->template->title(lang('firesale:payment:title'))
                                       ->set('redirect_url', $process->redirect_url())
                                       ->set('redirect_method', $process->redirect_method())
                                       ->set('redirect_data', $process->redirect_data())
                                       ->build('gateways/redirect/all');
                    } elseif (file_exists($theme_path . 'views/modules/firesale/gateways/redirect/' . $gateway . '.php')) {
                        $this->template->title(lang('firesale:payment:title'))
                                       ->set('redirect_url', $process->redirect_url())
                                       ->set('redirect_method', $process->redirect_method())
                                       ->set('redirect_data', $process->redirect_data())
                                       ->build('gateways/redirect/' . $gateway);
                    } else {
                        $process->redirect();
                    }
                } else {
                    if ( ! method_exists($this, $status)) {
                        $status = '_order_processing';
                    }

                    // Run status function
                    $this->$status($order);
                }

            } else {

                // Variables
                $var['months'] = array();
                $currentMonth  = (int) date('m');
                for ($x = $currentMonth; $x < $currentMonth+12; $x++) {
                    $time = mktime(0, 0, 0, $x, 1);
                    $var['months'][date('m', $time)] = date('F', $time);
                }

                $current_year = date('Y');
                for ($i = $current_year; $i < $current_year + 15; $i++)
                    $var['years'][$i] = $i;

                $current_year = date('Y');
                for ($i = $current_year; $i > $current_year - 15; $i--)
                    $var['start_years'][$i] = $i;

                $var['default_cards'] = array(
                    'visa'       => 'Visa',
                    'maestro'    => 'Maestro',
                    'mastercard' => 'MasterCard',
                    'discover'   => 'Discover'
                );

                // Format currency
                $order['price_tax']     = $order['price_total'] - $order['price_sub'] - $order['price_ship'];
                $order['price_sub_tax'] = $order['price_sub'] + $order['price_tax'];
                $order['price_tax']     = $this->currency_m->format_string($order['price_tax'], (object)$order['currency'], FALSE);
                $order['price_sub_tax'] = $this->currency_m->format_string($order['price_sub_tax'], (object)$order['currency'], FALSE);
                $order['price_sub']     = $this->currency_m->format_string($order['price_sub'], (object)$order['currency'], FALSE);
                $order['price_ship']    = $this->currency_m->format_string($order['price_ship'], (object)$order['currency'], FALSE);
                $order['price_total']   = $this->currency_m->format_string($order['price_total'], (object)$order['currency'], FALSE);

                $gateway_view = $this->template->set_layout(FALSE)->build('gateways/' . $gateway, $var, TRUE);

                // Minimal layout
                if ( $this->settings->get('firesale_basic_checkout') == '1' ) {
                    $this->template->set_layout('minimal.html');
                } else {
                    $this->template->set_layout('default.html');
                }

                // Build page
                $this->template->title(lang('firesale:payment:title'))
                               ->set_breadcrumb(lang('firesale:cart:title'), $this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time).'/payment')
                               ->set_breadcrumb(lang('firesale:checkout:title'), $this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time).'/checkout')
                               ->set_breadcrumb(lang('firesale:payment:title'))
                               ->set('currency', $this->fs_cart->currency())
                               ->set('payment', $gateway_view)
                               ->build('payment', $order);

            }

        } else {
            redirect($this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time).'/checkout');
        }

    }

    public function callback($gateway = NULL, $order_id = NULL)
    {

        $order = $this->pyrocache->model('orders_m', 'get_order_by_id', array($order_id), $this->firesale->cache_time);

        if ($this->gateways->is_enabled($gateway) AND $gateway != NULL AND ! empty($order)) {
            $this->merchant->load($gateway);
            $this->merchant->initialize($this->gateways->settings($gateway));

            $transaction = $this->db->get_where('firesale_transactions', array(
                'order_id' => $order_id,
                'gateway'  => $gateway
            ))->row_array();

            $response = $this->merchant->purchase_return(array_merge($transaction, array(
                'failure_url' => site_url($this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time) . '/cancel')
            )));

            $status = '_order_' . $response->status();
            $processed = $this->db->get_where('firesale_transactions', array('reference' => $response->reference(), 'order_id' => $order_id, 'gateway' => $gateway, 'status' => $response->status()))->num_rows();
            $processed OR $this->db->insert('firesale_transactions', array('reference' => $response->reference(), 'order_id' => $order_id, 'gateway' => $gateway, 'status' => $response->status(), 'data' => serialize($response->data())));

            if (! $processed) {
                // Check status
                if ($response->status() == 'authorized') {
                    if ($response->amount() != $order['price_total']) {
                        $status = '_order_mismatch';
                    }
                }

                // Run status function
                $this->$status($order, TRUE);
            }
        } else {
            redirect($this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time));
        }
    }

    private function _order_processing($order, $callback = FALSE)
    {
        $this->orders_m->update_status($order['id'], 4);
        $skip = $this->_skip($order['gateway']['id']);

        if (! $callback) {
            redirect($this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time).( $skip ? '/checkout' : '/payment' ));
        } else {
            $this->merchant->confirm_return(site_url($this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time) . '/cancel'));
        }
    }

    private function _order_failed($order, $callback = FALSE)
    {
        $this->orders_m->update_status($order['id'], 7);
        $skip = $this->_skip($order['gateway']['id']);

        if (! $callback) {
            redirect($this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time).( $skip ? '/checkout' : '/payment' ));
        } else {
            $this->merchant->confirm_return(site_url($this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time) . '/cancel'));
        }
    }

    private function _order_declined($order, $callback = FALSE)
    {
        $this->orders_m->update_status($order['id'], 8);
        $skip = $this->_skip($order['gateway']['id']);

        if ( ! $callback)
            redirect($this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time).( $skip ? '/checkout' : '/payment' ));

    }

    private function _order_mismatch($order, $callback = FALSE)
    {
        $this->orders_m->update_status($order['id'], 9);
        $skip = $this->_skip($order['gateway']['id']);

        if ( ! $callback)
            redirect($this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time).( $skip ? '/checkout' : '/payment' ));
    }

    private function _order_authorized($order, $callback = FALSE)
    {

        // Sale made, run updates
        $this->cart_m->sale_complete($order);

        // Fire events
        Events::trigger('order_complete', $order);
        Events::trigger('clear_cache');

        // Format order
        foreach ($order['items'] as &$item) {
            $item['total'] = $this->currency_m->format_string(($item['price_rounded'] * $item['qty']), $this->fs_cart->currency());
        }

        // Format currency
        $order['price_sub']     = $this->currency_m->format_string($order['price_sub'], $this->fs_cart->currency(), FALSE);
        $order['price_ship']    = $this->currency_m->format_string($order['price_ship'], $this->fs_cart->currency(), FALSE);
        $order['price_total']   = $this->currency_m->format_string($order['price_total'], $this->fs_cart->currency(), FALSE);
        $order['price_tax']     = $this->currency_m->format_string($order['price_tax'], $this->fs_cart->currency(), FALSE);

        // Email (user)
        Events::trigger('email', array_merge($order, array('slug' => 'order-complete-user', 'to' => $order['bill_to']['email'])), 'array');

        // Email (admin)
        Events::trigger('email', array_merge($order, array('slug' => 'order-complete-admin', 'to' => $this->settings->get('contact_email'))), 'array');

        if (! $callback) {
            // Clear cart
            $this->fs_cart->destroy();

            // Build page
            $this->template->title(lang('firesale:payment:title_success'))
                           ->set_breadcrumb(lang('firesale:cart:title'), $this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time))
                           ->set_breadcrumb(lang('firesale:checkout:title'), $this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time).'/checkout')
                           ->set_breadcrumb(lang('firesale:payment:title'), $this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time).'/payment')
                           ->set_breadcrumb(lang('firesale:payment:title_success'))
                           ->order = $order;

            // Fire events
            Events::trigger('page_build', $this->template);

            // Minimal layout
            if ( $this->settings->get('firesale_basic_checkout') == '1' ) {
                $this->template->set_layout('minimal.html');
            }

            // Build the page
            $this->template->build('payment_complete', $order);
        } else {
            $this->merchant->confirm_return(site_url($this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time) . '/success'));
        }

    }

    private function _order_complete()
    {
        $args = func_get_args();
        call_user_func_array(array($this, '_order_authorized'), $args);
    }

    public function success($gateway = null)
    {

        if ( $order_id = $this->session->userdata('order_id') ) {

            $order = $this->pyrocache->model('orders_m', 'get_order_by_id', array($order_id), $this->firesale->cache_time);

            if ( ! is_null($gateway)) {
                $this->merchant->load($gateway);
                $this->merchant->initialize($this->gateways->settings($gateway));

                $params = array_merge(array(
                    'notify_url' => site_url($this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time) . '/callback'),
                    'return_url' => site_url($this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time) . '/success'),
                    'cancel_url' => site_url($this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time) . '/cancel')
                ), array(
                    'currency_code'  => $this->fs_cart->currency()->cur_code,
                    'amount'         => $this->fs_cart->total() + $order['shipping']['price'],
                    'order_id'       => $order_id,
                    'transaction_id' => $order_id,
                    'reference'      => 'Order #' . $order_id,
                    'description'    => 'Order #' . $order_id,
                    'first_name'     => $order['bill_to']['firstname'],
                    'last_name'      => $order['bill_to']['lastname'],
                    'address1'       => $order['ship_to']['address1'],
                    'address2'       => $order['ship_to']['address2'],
                    'city'           => $order['ship_to']['city'],
                    'region'         => $order['ship_to']['county'],
                    'country'        => $order['ship_to']['country']['code'],
                    'postcode'       => $order['ship_to']['postcode'],
                    'phone'          => $order['ship_to']['phone'],
                    'email'          => $order['ship_to']['email'],
                ));

                $response = $this->merchant->purchase_return($params);

                $status = '_order_' . $response->status();

                $processed = $this->db->get_where('firesale_transactions', array('reference' => $response->reference(), 'status' => $response->status()))->num_rows();
                $processed or $this->db->insert('firesale_transactions', array('order_id' => $order_id, 'reference' => $response->reference(), 'status' => $response->status(), 'gateway' => $gateway, 'data' => serialize($response->data())));

                if ( ! $processed) {
                    // Check status
                    if ($response->status() == 'authorized' or $response->status() == 'complete') {
                        if (method_exists($response, 'amount')) {
                            if ($response->amount() != $order['price_total']) {
                                $status = '_order_mismatch';
                            }
                        }
                    }

                    // Run status function
                    $this->$status($order, FALSE);
                }
            }

            $this->fs_cart->destroy();

            // Minimal layout
            if ( $this->settings->get('firesale_basic_checkout') == '1' ) {
                $this->template->set_layout('minimal.html');
            }

            $this->template->title(lang('firesale:payment:title_success'))
                           ->set_breadcrumb(lang('firesale:cart:title'), $this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time))
                           ->set_breadcrumb(lang('firesale:checkout:title'), $this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time).'/checkout')
                           ->set_breadcrumb(lang('firesale:payment:title'), $this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time).'/payment')
                           ->set_breadcrumb(lang('firesale:payment:title_success'))
                           ->build('payment_complete', $order);
        } else {
            show_404();
        }

    }

    public function cancel()
    {
        if ($order_id = $this->session->userdata('order_id')) {
            $this->orders_m->delete_order($order_id);
            $this->session->unset_userdata('order_id');

            $this->fs_cart->destroy();

            $this->template->title('Order Cancelled')
                           ->set_breadcrumb(lang('firesale:cart:title'), $this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time))
                           ->set_breadcrumb(lang('firesale:checkout:title'), $this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time).'/checkout')
                           ->set_breadcrumb(lang('firesale:payment:title'), $this->pyrocache->model('routes_m', 'build_url', array('cart'), $this->firesale->cache_time).'/payment')
                           ->set_breadcrumb(lang('Order Cancelled'))
                           ->build('payment_cancelled');
        } else {
            show_404();
        }

    }

    public function _skip($gateway)
    {
        // Get the gateway slug
        $gateway = $this->gateways->slug_from_id($gateway);
        $settings = $this->gateways->settings($gateway);

        return ( isset($settings['skip_confirmation_page']) ? $settings['skip_confirmation_page'] : false );
    }

}
