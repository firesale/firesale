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
* @version dev
* @link http://github.com/firesale/firesale
*
*/

class orders extends Admin_Controller
{

    public $perpage = 30;
    public $section = 'orders';

    public function __construct()
    {

        parent::__construct();

        // Assign data object
        $this->data = new StdClass;

        // Button events
        Events::trigger('button_build', $this->template);

        // Load the models
        $this->load->library('files/files');
        $this->load->model('orders_m');
        $this->load->model('currency_m');
        $this->load->model('categories_m');
        $this->load->model('products_m');
        $this->load->model('address_m');
        $this->load->model('routes_m');

        // Get the stream
        $this->stream = $this->streams->streams->get_stream('firesale_orders', 'firesale_orders');

        // Add metadata
        $this->template->append_css('module::admin/orders.css')
                       ->append_js('module::admin/jquery.tablesort.js')
                       ->append_js('module::admin/jquery.metadata.js')
                       ->append_js('module::admin/jquery.tablesort.plugins.js')
                       ->append_js('module::admin/orders.js')
                       ->append_metadata('<script type="text/javascript">' .
                                         "\n  var currency = '" . $this->settings->get('currency') . "';" .
                                         "\n</script>");

    }

    public function index($start = 0)
    {

        // Variables
        $pagination = array('uri_segment' => 4, 'per_page' => $this->perpage, 'base_url' => 'admin/firesale/orders/');
        $params     = array(
            'stream'      => 'firesale_orders',
            'namespace'   => 'firesale_orders',
            'limit'       => $this->perpage,
            'offset'      => $start,
            'order_by'    => 'id',
            'sort'        => 'desc'
        );

        // Get entries
        $orders            = $this->streams->entries->get_entries($params);
        $orders['entries'] = $this->orders_m->format_order($orders['entries']);

        // Get filter data
        $users    = cache('orders_m/user_field', ( $type == 'created_by' ? $query : NULL));
        $products = cache('orders_m/product_dropdown', null, false, false);
        $status   = cache('orders_m/status_field', null);

        // Assign variables
        $this->data->orders        = $orders['entries'];
        $this->data->total         = cache('orders_m/order_count', null);
        $this->data->pagination    = create_pagination('/admin/firesale/orders/', $this->data->total, $this->perpage, 4);
        $this->data->filter_users  = $users['input'];
        $this->data->filter_status = form_dropdown('order_status', $status, null);
        $this->data->filter_prods  = form_dropdown('product', $products, null);
        $this->data->min_max       = $this->orders_m->min_max_price();
        $this->data->buttons       = ( $this->template->buttons ? $this->template->buttons : '' );

        // Build template
        $this->template->title(lang('firesale:title') . ' ' . lang('firesale:sections:orders'))
                       ->build('admin/orders/index', $this->data);
    }

    public function create($id = NULL, $row = NULL)
    {

        // Check for post data
        if ( $this->input->post('btnAction') == 'save' ) {

            // Variables
            $input  = $this->input->post();
            $skip   = array('btnAction');
            $extra  = array(
                'return'          => 'admin/firesale/orders/edit/-id-',
                'success_message' => lang('firesale:order_' . ( $id == NULL ? 'add' : 'edit' ) . '_success'),
                'error_message'   => lang('firesale:order_' . ( $id == NULL ? 'add' : 'edit' ) . '_error')
            );

            // Check for products
            if ( isset($input['item']) AND !empty($input['item']) ) {

                // Loop order items
                foreach ($input['item'] AS $product => $item) {

                    // Remove product?
                    if ( $id != NULL AND isset($item['remove']) AND $item['remove'] == 1 ) {
                        $this->orders_m->remove_order_item($id, $product);
                    }

                    // Update quantity
                    elseif ($id != NULL) {
                        // Get product
                        $product = cache('products_m/get_product', $product);

                        // Update/add product
                        $this->orders_m->insert_update_order_item($id, $product, $item['qty']);
                    }
                }

            }

            // Check for user change
            if ( $this->input->post('created_by') != $row->created_by ) {
                $this->db->where('id', $row->id)->update('firesale_orders', array('created_by' => $this->input->post('created_by')));
                $this->db->where('order_id', $row->id)->update('firesale_orders_items', array('created_by' => $this->input->post('created_by')));
            }

            // Check for address
            if ( !isset($input['shipping']) OR $input['shipping'] == NULL ) {
                $input['shipping'] = '0';
                $_POST = $input;
            }

            // Create hash
            list($ship_hash, $bill_hash) = cache('address_m/input_hash', $input);

            // Check for addresses
            $ship = $this->address_m->update_address($input['ship_to'], $input, 'ship');
            if ($ship != TRUE OR $ship <= 0 OR $input['ship_to'] != $input['bill_to'] OR $ship_hash != $bill_hash) {
                $bill = $this->address_m->update_address($input['bill_to'], $input, 'bill');
            }

            // Did we insert them?
            if ($ship > 0 OR $bill > 0) {
                $input['ship_to'] = $ship;
                $input['bill_to'] = ( isset($bill) ? $bill : $ship );
                $_POST = $input;
            }

        } else {
            $input = FALSE;
            $skip  = array();
            $extra = array();
        }

        // Get the stream fields
        $fields = $this->fields->build_form($this->stream, ( $id == NULL ? 'new' : 'edit' ), ( $id == NULL ? (object) $input : $row ), FALSE, FALSE, $skip, $extra);

        // Assign variables
        if ($row !== NULL) { $this->data = $row; }
        $this->data->id     = $id;
        $this->data->fields = array(
                                'general' => array('details' => $fields),
                                'ship'    => $this->address_m->get_address_form('ship', ( isset($row->ship_to) ? 'edit' : 'new' ), ( isset($row->ship_to) ? cache('address_m/get_address', $row->ship_to) : $this->input->post() )),
                                'bill'    => $this->address_m->get_address_form('bill', ( isset($row->bill_to) ? 'edit' : 'new' ), ( isset($row->bill_to) ? cache('address_m/get_address', $row->bill_to) : $this->input->post() ))
                              );

        // Add users as first general field
        $users = cache('orders_m/user_field', ( $row != NULL ? $row->created_by : NULL ));
        array_unshift($this->data->fields['general']['details'], $users);

        // Move/format ship_to and bill_to
        $bill = end(array_splice($this->data->fields['general']['details'], 10, 1));
        $ship = end(array_splice($this->data->fields['general']['details'], 9, 1));
        array_unshift($this->data->fields['ship']['details'], $ship);
        array_unshift($this->data->fields['bill']['details'], $bill);

        // Get currency
        $this->data->currency = cache('currency_m/get', ( $id != NULL && $row->currency != NULL ? $row->currency : NULL ));

        // Get products
        if ($id != NULL) {

            // Get and format products
            $products = cache('orders_m/order_products', $id);
            foreach ($products['products'] AS &$product) {
                $price            = $product['price'];
                $product['price'] = cache('currency_m/format_string', $price, $this->data->currency, false);
                $product['total'] = cache('currency_m/format_string', $price * $product['qty'], $this->data->currency, false);
            }

            // Assign products
            $this->data->products  = $products['products'];
            $this->data->prod_drop = cache('products_m/build_dropdown', null);
        }

        // Build the page
        $this->template->title(lang('firesale:title') . ' ' . sprintf(lang('firesale:orders:title_' . ( $id == NULL ? 'create' : 'edit' )), $id))
                       ->append_metadata("<script type=\"text/javascript\">\n  var currency = '{$this->data->currency->symbol}', tax_rate = '{$this->data->currency->cur_tax}';\n</script>")
                       ->build('admin/orders/create', $this->data);
    }

    public function edit($id)
    {
        // Does the user have access?
        role_or_die('firesale', 'edit_orders');

        // Get row
        if ( $row = $this->row_m->get_row($id, $this->stream, false) ) {
            // Load form
            $this->create($id, $row);
        } else {
            $this->session->set_flashdata('error', lang('firesale:order_not_found'));
            redirect('admin/firesale/orders/create');
        }

    }

    public function delete($id = NULL)
    {

        // Delete
        if ( $this->orders_m->delete_order($id) ) {
            $this->session->set_flashdata('success', lang('firesale:orders:delete_success'));
        } else {
            $this->session->set_flashdata('error', lang('firesale:orders:delete_error'));
        }

        // Redirect?
        if ( !$this->input->post('btnAction') ) {
            redirect('admin/firesale/orders');
        }

    }

    public function status()
    {

        // Variables
        $input = $this->input->post();

        // Check for inputs
        if ( isset($input['btnAction']) AND count($input['action_to']) > 0 ) {

            switch ($input['btnAction']) {
                case 'paid':       $status = '2'; break;
                case 'dispatched': $status = '3'; break;
                case 'processing': $status = '4'; break;
                case 'refunded':   $status = '5'; break;
                case 'cancelled':  $status = '6'; break;
                default:           $status = '1'; break;
            }

            foreach ($input['action_to'] AS $order) {
                if ($input['btnAction'] == 'delete') {
                    $this->delete($order);
                } else {
                    $this->orders_m->update_status($order, $status);
                }
            }

        }

        // Redirect
        redirect('admin/firesale/orders');
    }

}
