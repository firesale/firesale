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

class Orders_m extends MY_Model
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('firesale/products_m');
    }

    /**
     * Gets the products for a given order
     *
     * @param  integer $order_id The Order ID to query
     * @return array   The products from the Order
     * @access public
     */
    public function order_products($order_id)
    {

        $total = 0;
        $items = $this->db->query('SELECT SUM(qty) AS `count`, p.`id`, p.`code`, p.`title`, i.`price`, p.`slug`, i.`qty`, i.`tax_band`, i.`options`
                                   FROM `' . SITE_REF . '_firesale_orders_items` AS i
                                     INNER JOIN `' . SITE_REF . '_firesale_products` AS p ON p.`id` = i.`product_id`
                                    WHERE i.`order_id` = ' . $order_id . '
                                   GROUP BY i.`product_id`
                                   ORDER BY `count` DESC')->result_array();

        // Build overall count and add image
        foreach ($items AS &$item) {
            $total          += $item['count'];
            $item['image']   = $this->products_m->get_single_image($item['id']);
            $item['options'] = ! empty($item['options']) ? unserialize($item['options']) : NULL;
        }

        // Return
        return array('count' => $total, 'products' => $items);
    }

    public function product_count($order_id)
    {
        return $this->db->query("SELECT SUM( `qty` ) AS `count`
                                 FROM `".SITE_REF."_firesale_orders_items`
                                 WHERE `order_id` = '{$order_id}'")->row()->count;
    }

    /**
     * Deletes a given order and the products contained in it
     *
     * @param  integer $order_id The Order ID to query
     * @return boolean TRUE or FALSE on successful delete
     * @access public
     */
    public function delete_order($order_id)
    {

        if ( $this->db->where('id', $order_id)->delete('firesale_orders') ) {
            if ( $this->db->where('order_id', $order_id)->delete('firesale_orders_items') ) {
                return TRUE;
            }
        }

        return FALSE;
    }

    /**
     * Returns the minimum and maximum order prices
     *
     * @return array containing min and max prices
     * @access public
     */
    public function min_max_price()
    {

        // Run query
        $query = $this->db->select('MIN(price_total) AS min, MAX(price_total) AS max')->get('firesale_orders');

        // Check and return results
        if ( $query->num_rows() ) {
            return current($query->result_array());
        }

        // Nothing found
        return array('min' => '0.00', 'max' => '0.00');
    }

    /**
     * Compiles an array into a where clause to filter orders
     *
     * @param array $data $_POST data for parsing
     * @return string where clause to be used in streams
     * @access public
     */
    public function add_filters($data)
    {

        // Variables
        $where = array();

        // Loop options
        foreach ( $data as $column => $value ) {
            if ( $value != '0' and $value != '-1' and ( is_array($value) or strlen($value) > 0 ) ) {
                switch($column) {

                    case 'product':

                        // Get possible IDs
                        $query = $this->db->select('order_id')->where('product_id', $value)->group_by('order_id')->get('firesale_orders_items')->result_array();
                        $ids   = array();

                        // Loop IDs
                        foreach ($query AS $order) { $ids[] = $order['order_id']; }

                        // Add to query
                        if ( ! empty($ids) ) {
                            $where[] = '`id` IN ('.implode(',', $ids).')';
                        } else {
                            $where[] = '`id` = -1';
                        }

                    break;

                    case 'date':
                        if ( strlen($value['from']) > 0 or strlen($value['to']) > 0 ) {
                            $from = strtotime('00:00:01 '.( strlen($value['from']) > 0 ? $value['from'] : $value['to'] ));
                            $to   = strtotime('23:59:59 '.( strlen($value['to']) > 0 ? $value['to'] : $value['from'] ));
                            $where[] = "UNIX_TIMESTAMP(`created`) >= {$from} AND UNIX_TIMESTAMP(`created`) <= {$to}";
                        }
                    break;

                    case 'price_total':
                        list($min, $max) = explode('-', $value);
                        $where[] = "`price_total` >= {$min} AND `price_total` <= {$max}";
                    break;

                    default:
                        $where[] = "`{$column}` = '{$value}'";
                    break;
                }
            }
        }

        // Return data
        return implode(' AND ', $where);
    }

    /**
     * Builds the user field used in the order administration section.
     *
     * @param  integer $id (Optional) User ID to pre-select
     * @return array   The user input to be slotted into the streams array
     * @access public
     */
    public function user_field($id = NULL)
    {

        // Variables
        $array = array(
                    'input_title'  => 'lang:firesale:label_user_order',
                    'input_slug'   => 'created_by',
                    'instructions' => '',
                    'value'		   => $id,
                    'input'		   => '',
                    'input_parts'  => '',
                    'error_raw'	   => '',
                    'error'		   => '',
                    'required'	   => '<span>*</span>',
                    'odd_even'	   => 'odd'
                );

        // Build user list
        $users = $this->db->select('u.id, u.email, p.display_name')
                          ->from('users AS u')
                          ->join('profiles AS p', 'p.user_id = u.id', 'inner')
                          ->get()
                          ->result_array();

        // Start building list
        $list  = array('-1' => lang('firesale:label_user_order'));

        // Loop users
        foreach ($users AS $user) {
            $list[$user['id']] = $user['display_name'] . ' ( ' . $user['email'] . ' )';
        }

        // Assign it to the array
        $array['input'] = form_dropdown('created_by', $list, $id);

        // Return
        return $array;
    }

    /**
     * Builds the status field used in the order administration section.
     *
     * @return array The status input to be turned into a dropdown
     * @access public
     */
    public function status_field()
    {

        // Start building list
        $list  = array('-1' => lang('firesale:label_order_status'));

        // Get data from streams
        $query = $this->db->select('field_data')
                          ->where('field_namespace', 'firesale_orders')
                          ->where('field_slug', 'order_status')
                          ->get('data_fields')
                          ->result_array();

        // Check for results
        if ( !empty($query) ) {

            // Get field data
            $result = current($query);
            $data   = unserialize($result['field_data']);

            // Get options
            $options = explode("\n", $data['choice_data']);

            // Loop and assign
            foreach ($options AS $option) {
                list($key, $val) = explode(' : ', $option);
                $list[$key]      = lang(substr($val, 5));
            }

        }

        ksort($list);

        return $list;
    }

    /**
     * Builds the product field used in the order administration section.
     *
     * @param  integer $id (Optional) Product ID to pre-select
     * @param  boolean $all (Optional) Return all products or just those ordered
     * @param  boolean $build (Optional) Build the dropdown or return list
     * @return array   The product dropdowm
     * @access public
     */
    public function product_dropdown($id = NULL, $all = true, $build = true)
    {

        // Variables
        $list = array('-1' => lang('firesale:label_filterprod'));

        // Get products
        if ( $all === true ) {

            $products = $this->db->select('id, title')->order_by('id')->get('firesale_products')->result_array();
        } else {

            $products = $this->db->query('SELECT `product_id` as `id`, `name` as `title`
                                          FROM `' . SITE_REF . '_firesale_orders_items`
                                          GROUP BY `product_id`
                                          ORDER BY `name` ASC')->result_array();
        }

        // Loop and assign
        foreach ( $products AS $product ) {
            $list[$product['id']] = $product['title'];
        }

        ksort($list);

        // Build the dropbown
        if ( $build === true ) {
            $list = form_dropdown('products', $list, $id);
        }

        // Return it
        return $list;
    }

    /**
     * Formats an order entries array to fix prices, urls and additional data
     *
     * @param array $orders containing a range of orders
     * @return array updated orders
     * @access public
     */
    public function format_order($orders)
    {

        // Get product count
        foreach ($orders AS &$order) {

            // Get product count
            $order['products'] = $this->pyrocache->model('orders_m', 'get_product_count', array($order['id']), $this->firesale->cache_time);

            // No currency set?
            if ($order['currency'] == NULL) {
                $order['currency'] = $this->pyrocache->model('currency_m', 'get', array(), $this->firesale->cache_time);
            }

            // Format prices
            $order['price_sub']   = $this->pyrocache->model('currency_m', 'format_string', array($order['price_sub'],   (object) $order['currency'], FALSE), $this->firesale->cache_time);
            $order['price_ship']  = $this->pyrocache->model('currency_m', 'format_string', array($order['price_ship'],  (object) $order['currency'], FALSE), $this->firesale->cache_time);
            $order['price_total'] = $this->pyrocache->model('currency_m', 'format_string', array($order['price_total'], (object) $order['currency'], FALSE), $this->firesale->cache_time);
        }

        return $orders;
    }

    /**
     * Inserts an order and its' products into the database
     *
     * @param  array   $input A POST array containing all of the order information
     * @return integer Either an int containing the order ID or FALSE on failure
     * @access public
     */
    public function insert_order($input)
    {

        // Remove address input
        $remove = array('bill_', 'ship_', 'btnAc');
        $ignore = array('shipping', 'ship_to', 'bill_to');
        foreach ($input AS $key => $val) {
            if ( in_array(substr($key, 0, 5), $remove) AND !in_array($key, $ignore) ) {
                unset($input[$key]);
            }
        }

        // Check shipping is set
        if ( !isset($input['shipping']) OR empty($input['shipping']) ) {
            $input['shipping'] = 0;
        }

        // Get currency
        $user_currency = ( $this->session->userdata('currency') ? $this->session->userdata('currency') : NULL );
        $currency      = $this->currency_m->get($user_currency);

        // Append input
        $input['price_sub']    	 = str_replace(',', '', $input['price_sub']);
        $input['price_ship']   	 = str_replace(',', '', $input['price_ship']);
        $input['price_total']    = str_replace(',', '', $input['price_total']);
        $input['ip']			 = $_SERVER['REMOTE_ADDR'];
        $input['created'] 		 = date("Y-m-d H:i:s");
        $input['ordering_count'] = 0;
        $input['currency']       = $currency->id;
        $input['exchange_rate']  = $currency->exch_rate;
        unset($input['btnAction']);
        unset($input['bill_details_same']);

        // Insert it
        if ( $this->db->insert('firesale_orders', $input) ) {
            return $this->db->insert_id();
        }

        return FALSE;
    }

    /**
     * Inserts or Updates a product in the given order.
     *
     * @param  integer $order_id The Order ID to modify
     * @param  array   $product  The product data to use
     * @param  integer $qty      The quantity to add
     * @return boolean TRUE or FALSE on failure or success
     * @access public
     */
    public function insert_update_order_item($order_id, $product, $qty)
    {
        // Get user ID
        $user_id = $this->db->select('created_by')
                            ->where('id', $order_id)
                            ->get('firesale_orders')
                            ->row()
                            ->created_by;

        // Setup query
        $this->db->from('firesale_orders_items')
                 ->where("order_id", $order_id)
                 ->where("product_id", $product['id']);

        // Stock?
        if ( isset($product['stock']) AND $product['stock_status']['key'] != 6 AND $qty > $product['stock'] ) {
            $qty = $product['stock'];
        }

        if ( $this->db->count_all_results() == 0 ) {
            $data = array(
                'created'        => date("Y-m-d H:i:s"),
                'created_by'     => $user_id,
                'ordering_count' => 0,
                'order_id'       => $order_id,
                'product_id'     => $product['id'],
                'code'           => $product['code'],
                'name'           => ( isset($product['title']) ? $product['title'] : $product['name'] ),
                'price'          => $product['price'],
                'qty'            => $qty,
                'tax_band'       => $product['tax_band']['id'],
                'options'        => isset($product['options']) ? serialize($product['options']) : ''
            );

            if ( $this->db->insert('firesale_orders_items', $data) ) {
                Events::trigger('clear_cache');
                return TRUE;
            }

        } else {
            if ( $this->db->where('order_id', $order_id)->where('product_id', $product['id'])->update('firesale_orders_items', array('qty' => $qty)) ) {
                Events::trigger('clear_cache');
                return TRUE;
            }
        }

        return FALSE;
    }


    /**
     * Updates the cost of the order based on the current cart contents.
     *
     * @param  integer $order_id The order ID to update
     * @param  boolean $update   (Optional) Should the database be updated
     * @param  boolean $cart     (Optional) Should the cart be updated
     * @return void
     * @access public
     */
    public function update_order_cost($order_id, $update = TRUE, $cart = TRUE)
    {

        // Get tax rate
        $user_currency = $this->session->userdata('currency') ? $this->session->userdata('currency') : NULL;
        $currency      = $this->currency_m->get($user_currency);

        // Variables
        $total = 0;
        $tax   = $currency->cur_tax;

        // Run through cart items
        if ($cart == TRUE) {
            foreach ( $this->fs_cart->contents() AS $item ) {
                $total += ( $item['qty'] * $item['price'] );
            }
        }
        // Otherwise use DB entries
        else {
            $products = $this->db->where('order_id', $order_id)->get('firesale_orders_items')->result_array();
            foreach ($products AS $product) {
                $total += ( $product['qty'] * $product['price'] );
            }
        }

        // Format
        $total = round($total, 2);
        $sub   = round($total - ( ( $total / 100 ) * $tax ), 2);

        // Update cart
        if ($cart == TRUE) {
            $this->fs_cart->total    = number_format($total, 2);
            $this->fs_cart->subtotal = number_format($sub, 2);
            $this->fs_cart->tax 	 = number_format(( $total - $sub), 2);
        }

        // Update?
        if ($update == TRUE) {
            $this->db->where('id', $order_id)->update('firesale_orders', array('price_total' => $total, 'price_sub' => $sub));
        }

    }

    /**
     * Removes an item from the given order.
     *
     * @param  integer $order_id   The Order ID to update
     * @param  integer $product_id The Product ID to remove
     * @return void
     * @access public
     */
    public function remove_order_item($order_id, $product_id)
    {
        $this->db->where("order_id", $order_id)
                 ->where("product_id", $product_id)
                 ->delete('firesale_orders_items');
    }

    /**
     * Gets the last order placed by a given user
     *
     * @param  integer $user_id The User ID to query
     * @return array
     * @access public
     */
    public function get_last_order($user_id)
    {
        $previous_order = $this->db->order_by('created', 'desc')
                                   ->get_where('firesale_orders', array('created_by' => $user_id), 1);

        if ( $previous_order->num_rows() ) {
            return $previous_order->row_array();
        }

        return FALSE;
    }

    /**
     * Gets the number of different products in a given order
     *
     * @param  integer $order_id The Order ID to query
     * @return integer
     * @access public
     */
    public function get_product_count($order_id)
    {

        $query = $this->db->select('id')->where("order_id = {$order_id}")->get('firesale_orders_items');

        return $query->num_rows();
    }

    /**
     * Gets an order and its' products by ID
     *
     * @param  integer $order_id The Order ID to query
     * @return array
     * @access public
     */
    public function get_order_by_id($order_id)
    {

        // Set query paramaters
        $params	 = array(
            'stream' 	=> 'firesale_orders',
            'namespace'	=> 'firesale_orders',
            'where'		=> SITE_REF."_firesale_orders.id = '{$order_id}'",
            'limit'		=> 1
        );

        // Get entries
        $order = $this->streams->entries->get_entries($params);

        if ($order['total'] == 1) {

            $order 			    = $order['entries'][0];
            $order['items']     = $this->db->get_where('firesale_orders_items', array('order_id' => (int) $order_id))->result_array();
            $order['price_tax'] = number_format(( $order['price_total'] - $order['price_sub'] - $order['price_ship'] ), 2);

            // Loop items
            foreach ($order['items'] AS $key => &$item) {

                // Get the product
                $product = $this->pyrocache->model('products_m', 'get_product', array($item['product_id'], null, true), $this->firesale->cache_time);

                // Check it exists
                if ($product !== FALSE) {

                    // Build initial item
                    $item['id']    = $product['id'];
                    $item['price'] = (float)number_format($item['price'], 2);
                    $item          = array_merge($product, $item);

                    // Format and assign data
                    $item['total']   = $this->currency_m->format_string(($item['price']*$item['qty']), (object)$order['currency'], FALSE, FALSE);
                    $item['price']   = $this->currency_m->format_string($item['price'], (object)$order['currency'], FALSE, FALSE);
                    $item['options'] = unserialize($item['options']);
                    $item['image']   = $this->products_m->get_single_image($item['product_id']);
                    $item['no']      = ( $key + 1 );
                }
            }

            return $order;
        }

        return FALSE;
    }

    /**
     * Returns a list of orders for a given user
     * @param  int $user_id The user id to query for
     * @return array an array of orders
     */
    public function get_orders_by_user($user_id)
    {
        // Get IDS
        $orders = $this->db->where('created_by', $user_id)
                           ->order_by('created', 'desc')
                           ->get('firesale_orders')
                           ->result_array();

        // Check for orders
        if ( ! empty($orders) ) {

            // Loop and get data
            foreach ( $orders as &$order ) {
                $order = $this->pyrocache->model('orders_m', 'get_order_by_id', array($order['id']), $this->firesale->cache_time);
            }

            // Format orders
            $orders = $this->format_order($orders);

            // Reassign help
            $orders = reassign_helper_vars($orders);
        }

        return $orders;
    }

    /**
     * Updates a products stock level and status based on it.
     *
     * @param  integer $id    The Product ID to update
     * @param  integer $stock The stock level to remove
     * @return boolean TRUE or FALSE on successful update
     * @access public
     */
    public function update_product_stock($id, $stock)
    {

        // Variables
        $low	 = $this->settings->get('firesale_low') or 10;
        $product = $this->pyrocache->model('products_m', 'get_product', array($id, null, true), $this->firesale->cache_time);

        if ($product) {

            $data = array();
            $data['stock']  = ( $product['stock'] - $stock );

            // Get status
            if ($product['stock_status']['key'] == 6) {
                // Unlimited, do nothing
                return TRUE;
            } elseif ($data['stock'] <= 0) {
                $data['stock_status'] = 3;
            } elseif ($data['stock'] <= $low) {
                $data['stock_status'] = 2;
            } else {
                $data['stock_status'] = 1;
            }

            // Update table
            $this->db->where('id', $product['id'])->update('firesale_products', $data);

            return true;
        }

        return false;
    }

    /**
     * Updates the status of a given order
     *
     * @param integer $order_id The Order ID to update
     * @param integer $status   (Optional) The status code to set it to
     * @param boolean TRUE or FALSE on successful update
     * @access public
     */
    public function update_status($order_id, $status = 0)
    {

        // Update order status
        if ( $this->db->where('id', $order_id)->update('firesale_orders', array('order_status' => $status)) ) {

            // Email update for dispatched
            if ($status == 3) {

                // Get the order
                $order = $this->pyrocache->model('orders_m', 'get_order_by_id', array($order_id), $this->firesale->cache_time);

                // Email the user
                Events::trigger('email', array_merge($order, array('slug' => 'order-dispatched', 'to' => $order['bill_to']['email'])), 'array');

                // Order dispatched event
                Events::trigger('order_dispatched', $order);
            }

            return TRUE;
        }

        return FALSE;
    }

    /**
     * Gets a complete count of the number of orders in a given filter
     *
     * @param  string [$where] The where clause of the filter option
     * @return int    The count of the total result set
     * @access public
     */
    public function order_count($where = null)
    {
        $query = $this->db->select('id')->from('firesale_orders');
        if ( $where != null ) { $query->where($where, null, false); }
        return $query->get()->num_rows();
    }

}
