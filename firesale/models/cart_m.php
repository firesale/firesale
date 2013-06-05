<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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

class Cart_m extends MY_Model
{

    /**
    */
    public function update_currency($currency)
    {

        // Variables
        $contents = $this->fs_cart->contents();

        // Destroy the cart
        $this->fs_cart->destroy();

        // Loop products
        foreach ($contents AS $row_id => $product) {

            // Get original price
            $query = $this->db->select('price_tax, rrp_tax, tax_band')->where('id', $product['id'])->get('firesale_products');
            $price = $query->row_array();

            // Build new price
            $price = $this->currency_m->format_price($price['price_tax'], $price['rrp_tax'], $price['tax_band'], $currency->id);

            // Assign to data
            $product['price']    = $price['price_rounded'];
            $product['subtotal'] = $price['price_rounded'] * $product['qty'];

            // insert
            $this->fs_cart->insert($product);
        }

    }

    /**
     * Ensures that the product quanities that have been added to a cart are within
     * the allowed limits of what is currently in stock.
     *
     * @param  array   $products An array of the products currently in the cart
     * @param  integer $qty      An array of max quantities that are in the order
     * @return void
     * @access public
     */
    public function check_quantity($products, $qty)
    {

        $changed = FALSE;

        foreach ($products AS $rowid => $product) {
            if ( array_key_exists($product['id'], $qty) ) {
                if ( (int) $qty[$product['id']] < (int) $product['qty'] ) {
                    $changed 		  = TRUE;
                    $data 		   	  = array();
                    $data['rowid']    = $rowid;
                    $data['qty']   	  = $qty[$product['id']];
                    $data['subtotal'] = number_format(( $data['qty'] * $product['price'] ), 2);
                    $this->fs_cart->update($data);
                }
            }
        }

        return $changed;
    }

    public function check_price()
    {

        // Variables
        $changed  = FALSE;
        $products = $this->fs_cart->contents();

        // Check price
        foreach ($products AS $row_id => $item) {

            // Get product
            $product = $this->pyrocache->model('products_m', 'get_product', array($item['id'], NULL, 1), $this->firesale->cache_time);

            // Format prices
            $prod_price = round(preg_replace('/[^0-9\.]+/', '', $product['price']), 1);
            $item_price = round(preg_replace('/[^0-9\.]+/', '', $item['price']), 1);
            $mod_price  = $prod_price;

            // Build modifier price
            if ( ! empty($item['options']) ) {
                foreach ( $item['options'] as $option ) {
                    $mod_price += $option['price'];
                }
            }

            // if cart has not been modified (e.g. discount codes) and price has changed
            if ( ( ! isset($item['modified']) or ! $item['modified']) and $item_price != $prod_price and $mod_price != $item_price ) {

                $changed           = true;
                $data              = array();
                $data['price']     = $product['price'];
                $data['old_price'] = $item['price'];
                $data['old_sub']   = number_format(( $item['qty'] * $item['price'] ), 2);
                $data['subtotal']  = number_format(( $item['qty'] * $data['price'] ), 2);

                $this->fs_cart->set($row_id, $data);

            } else if( isset($item['old_price']) ) {

                $this->fs_cart->clear($row_id, 'old_price');
                $this->fs_cart->clear($row_id, 'old_sub');

            }

        }

        // Check changed
        if( $changed === true ) {
            $this->session->set_userdata('flash:old:error', lang('firesale:cart:price_changed'));
        }

    }

    /**
     * Dynamically builds the validation for the checkout process depending on what
     * has been submitted. This is to ensure that the address chosen exists and is
     * for the correct user or if a new address has been submitted that it contains
     * all of the necissary data.
     *
     * @param  boolean $ship Do we require shipping?
     * @return array   An array containing the rules to be added to validation
     * @access public
     */
    public function build_validation($ship = TRUE)
    {
        // Variables
        $rules  = array();
        $input  = $this->input->post();

        // Get rules
        $stream = $this->streams->streams->get_stream('firesale_addresses', 'firesale_addresses');
        $fields = $this->streams_m->get_stream_fields($stream->id);
        $_rules = $this->fields->set_rules($fields, 'new', array(), TRUE,  NULL);

        // Build validation
        foreach ($_rules AS $rule) {

            // Shipping
            if ( $ship AND ( !isset($input['ship_to']) OR ( isset($input['ship_to']) AND $input['ship_to'] == 'new' ) ) ) {
                $_rule   		= $rule;
                $_rule['field'] = 'ship_' . $_rule['field'];
                $rules[] 		= $_rule;
            }

            // Billing
            if ( !isset($input['bill_to']) OR ( isset($input['bill_to']) AND $input['bill_to'] == 'new' ) ) {
                $_rule   		= $rule;
                $_rule['field'] = 'bill_' . $_rule['field'];
                $rules[] 		= $_rule;
            }

        }

        // Set callbacks
        $rules[] = array('field' => 'gateway', 'label' => 'lang:firesale:label_gateway', 'rules' => 'callback__validate_gateway');
        if ( $ship AND isset($input['ship_to']) ) {
            $rules[] = array('field' => 'ship_to', 'label' => 'lang:firesale:label_ship_to', 'rules' => 'callback__validate_address');
        }
        if ( isset($input['bill_to']) ) {
            $rules[] = array('field' => 'bill_to', 'label' => 'lang:firesale:label_bill_to', 'rules' => 'callback__validate_address');
        }

        // Shipping
        if ( $ship ) { 
            $rules[] = array('field' => 'shipping', 'label' => 'lang:firesale:label_shipping', 'rules' => 'callback__validate_shipping');
        }

        // Return
        return $rules;
    }

    /**
     * Returns the current contents of the cart as well as the prices in JSON format
     * to be used by any front-end applications that want to insert/update the cart
     * via ajax.
     *
     * @param  string $status The status message to be sent back to the browser
     * @return string An ajax object containing the cart and prices
     * @access public
     */
    public function ajax_response($status = 'ok')
    {

        // Variables
        $response = array();
        $response['status'] = $status;

        // Update cart if ok
        if ($status == 'ok') {

            // Cart contents
            $response['products'] = $this->fs_cart->contents();

            // Update cart pricing
            $this->orders_m->update_order_cost(0, FALSE);

            // Add pricing
            $response['total'] 		= $this->fs_cart->total;
            $response['tax']   		= $this->fs_cart->tax;
            $response['subtotal']	= $this->fs_cart->subtotal;

        }

        // Return
        return json_encode($response);
    }

    /**
     * Builds an array of data to be inserted into the database for an order and to
     * be added into the cart object.
     *
     * @param  array         $product The product data to be used
     * @param  integer       $qty     The quantity of the product to be added
     * @param  boolean/array $options The options associated with this product
     * @return array         An array of information for db/cart insertion
     * @access public
     */
    public function build_data($product, $qty, $options = false)
    {
        $data = array(
            'id'	   => $product['id'],
            'code'	   => $product['code'],
            'qty'	   => ( $qty > $product['stock'] && $product['stock_status']['key'] != 6 ? $product['stock'] : $qty ),
            'price'	   => preg_replace('/[^0-9\.]+/', '', $product['price_rounded']),
            'tax_band' => $product['tax_band']['id'],
            'name'	   => $product['title'],
            'slug'	   => $product['slug'],
            'ship'     => $product['ship_req']['key'],
            'weight'   => ( isset($product['shipping_weight']) ? $product['shipping_weight'] : '0.00' ),
            'image'	   => $this->products_m->get_single_image($product['id']),
            'options'  => $options,
            'parent'   => $product['modifiers'][0]['parent']
        );

        return $data;
    }

    /**
     * A secure check to see if a user has an active order that is not
     * complete.
     *
     * @return bool
     * @access public
     */
    public function cart_has_order()
    {
        if ($order_id = $this->session->userdata('order_id')) {
            // Load the orders model if its not already loaded
            $this->load->model('orders_m');

            $order = $this->orders_m->get_order_by_id($order_id);

            // Are there any items in the order?
            if (empty($order['items'])) {
                // Nope, delete the order.
                $this->orders_m->delete_order($order_id);

                // Remove the order id from session.
                $this->session->unset_userdata('order_id');

                // Return FALSE, we have no order now.
                return FALSE;
            }

            // Is the order unpaid?
            if ($order['order_status']['key'] == 1) {
                return TRUE;
            } else {
                // Remove the order id from session.
                $this->session->unset_userdata('order_id');

                // Return FALSE, we have no order.
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    /**
     * Called when an Order has been completed.
     * Updates the order status and sets it to paid, removes the order tracking from
     * the users' session and finally updates the stock status of the items found
     * in the order.
     *
     * @param  array $order The Order object that has been completed
     * @return void
     * @access public
     */
    public function sale_complete($order)
    {
        // Update this order status
        $this->orders_m->update_status($order['id'], 2);

        // Remove order id from session
        $this->session->unset_userdata('order_id');

        // Update product stock
        foreach ($order['items'] AS $item) {
            $this->orders_m->update_product_stock($item['product_id'], $item['qty']);
        }

        // Update variation stock
        foreach ( $order['items'] as $item ) {
            if ( ! empty($item['options']) ) {
                foreach ( $item['options'] as $option ) {
                    $product = $this->db->select('product')->where('id', $option['var_id'])->get('firesale_product_variations')->row();
                    if( $product ) {
                        $this->orders_m->update_product_stock($product->product, $item['qty']);
                    }
                }
            }
        }
    }

}
