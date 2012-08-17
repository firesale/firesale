<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders_m extends MY_Model
{

	/**
	 * Loads the parent constructor and gets an
	 * instance of CI.
	 *
	 * @return void
	 * @access public
	 */
	function __construct()
    {
        parent::__construct();
    }
  
    /**
     * Gets the products for a given order
     *
     * @param integer $order_id The Order ID to query
     * @return array The products from the Order
     * @access public
     */
	public function order_products($order_id)
	{

		$total = 0; 
		$items = $this->db->query('SELECT SUM(qty) AS `count`, p.`id`, p.`code`, p.`title`, p.`price`, p.`slug`, i.`qty`
								   FROM `' . SITE_REF . '_firesale_orders_items` AS i
						  		   INNER JOIN `' . SITE_REF . '_firesale_products` AS p ON p.`id` = i.`product_id`
						 		   WHERE i.`order_id` = ' . $order_id . '
								   GROUP BY i.`product_id`
								   ORDER BY `count` DESC')->result_array();

		// Build overall count and add image
		foreach( $items AS &$item )
		{
			$total += $item['count'];
			$item   = $this->products_m->get_single_image($item['id']);
		}
		
		// Return
		return array('count' => $total, 'products' => $items);
	}

	/**
	 * Deletes a given order and the products contained in it
	 *
     * @param integer $order_id The Order ID to query
     * @return boolean TRUE or FALSE on successful delete
     * @access public
     */
	public function delete_order($order_id)
	{

		if( $this->db->where('id', $order_id)->delete('firesale_orders') )
		{
			if( $this->db->where('order_id', $order_id)->delete('firesale_orders_items') )
			{
				return TRUE;
			}
		}

		return FALSE;
	}

	/**
	 * Builds the user field used in the order administration section.
	 *
	 * @param integer $id (Optional) User ID to pre-select
	 * @return array The user input to be slotted into the streams array
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
		$users = $this->db->select('user_id, display_name')->group_by('user_id')->get('profiles')->result_array();
		$list  = array('0' => lang('firesale:label_user_order'));

		foreach( $users AS $user )
		{
			$list[$user['user_id']] = $user['display_name'] . ' ( #' . $user['user_id'] . ' )';
		}

		// Assign it to the array
		$array['input'] = form_dropdown('created_by', $list, $id);

		// Return
		return $array;
	}

	/**
	 * Inserts an order and its' products into the database
	 *
	 * @param array $input A POST array containing all of the order information
	 * @return integer Either an int containing the order ID or FALSE on failure
	 * @access public
	 */
	public function insert_order($input)
	{

		// Remove address input
		$remove = array('bill_', 'ship_', 'btnAc');
		$ignore = array('shipping', 'ship_to', 'bill_to');
		foreach( $input AS $key => $val )
		{
			if( in_array(substr($key, 0, 5), $remove) AND !in_array($key, $ignore) )
			{
				unset($input[$key]);
			}
		}

		// Check shipping is set
		if( !isset($input['shipping']) OR empty($input['shipping']) )
		{
			$input['shipping'] = 0;
		}

		// Append input
		$input['price_sub']    	 = str_replace(',', '', $input['price_sub']);
		$input['price_ship']   	 = str_replace(',', '', $input['price_ship']);
		$input['price_total']    = str_replace(',', '', $input['price_total']);
		$input['ip']			 = $_SERVER['REMOTE_ADDR'];
		$input['created'] 		 = date("Y-m-d H:i:s");
		$input['ordering_count'] = 0;
		unset($input['btnAction']);
		unset($input['bill_details_same']);

		// Insert it
		if( $this->db->insert('firesale_orders', $input) )
		{
			return $this->db->insert_id();
		}

		return FALSE;
	}

	/**
	 * Inserts or Updates a product in the given order.
	 *
	 * @param integer $order_id The Order ID to modify
	 * @param array $product The product data to use
	 * @param integer $qty The quantity to add
	 * @return boolean TRUE or FALSE on failure or success
	 * @access public
	 */
	public function insert_update_order_item($order_id, $product, $qty)
	{
	
		$this->db->from('firesale_orders_items')
				 ->where("order_id", $order_id)
				 ->where("product_id", $product['id']);

		// Stock?
		if( isset($product['stock']) AND $qty > $product['stock'] )
		{
			$qty = $product['stock'];
		}
					
		if( $this->db->count_all_results() == 0 )
		{

			$data = array(
				'created'		=> date("Y-m-d H:i:s"),
				'ordering_count'=> 0,
				'order_id'		=> $order_id,
				'product_id'	=> $product['id'],
				'code'			=> $product['code'],
				'name'			=> ( isset($product['title']) ? $product['title'] : $product['name'] ),
				'price'			=> $product['price'],
				'qty'			=> $qty
		 	);

		 	if( $this->db->insert('firesale_orders_items', $data) )
			{
				return TRUE;
			}

		}
		else
		{
			if( $this->db->update('firesale_orders_items', array('qty' => $qty), array('order_id' => $order_id, 'product_id' => $product['id'])) )
			{
				return TRUE;
			}
		}

		return FALSE;
	}

	/**
	 * Updates the cost of the order based on the current cart contents.
	 *
	 * @param integer $order_id The order ID to update
	 * @param boolean $update (Optional) Should the database be updated
	 * @param boolean $cart (Optional) Should the cart be updated
	 * @return void
	 * @access public
	 */
	public function update_order_cost($order_id, $update = TRUE, $cart = TRUE)
	{

		// Variables
		$total = 0;
		$tax   = $this->settings->get('firesale_tax');

		// Run through cart items
		if( $cart == TRUE )
		{
			foreach( $this->cart->contents() AS $item )
			{
				$total += ( $item['qty'] * $item['price'] );
			}
		}
		// Otherwise use DB entries
		else
		{
			$products = $this->db->where('order_id', $order_id)->get('firesale_orders_items')->result_array();
			foreach( $products AS $product )
			{
				$total += ( $product['qty'] * $product['price'] );
			}
		}

		// Format
		$total = round($total, 2);
		$sub   = round($total - ( ( $total / 100 ) * $tax ), 2);

		// Update cart
		if( $cart == TRUE )
		{
			$this->cart->total    = number_format($total, 2);
			$this->cart->subtotal = number_format($sub, 2);
			$this->cart->tax 	  = number_format(( $total - $sub), 2);
		}

		// Update?
		if( $update == TRUE )
		{
			$this->db->where('id', $order_id)->update('firesale_orders', array('price_total' => $total, 'price_sub' => $sub));
		}

	}

	/**
	 * Removes an item from the given order.
	 *
	 * @param integer $order_id The Order ID to update
	 * @param integer $product_id The Product ID to remove
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
	 * @param integer $user_id The User ID to query
	 * @return array
	 * @access public
	 */
	public function get_last_order($user_id)
	{
		$previous_order = $this->db->order_by('created', 'desc')
								   ->get_where('firesale_orders', array('created_by' => $user_id), 1);
					
		if( $previous_order->num_rows() )
		{
			return $previous_order->row_array();
		}

		return FALSE;
	}

	/**
	 * Gets the number of different products in a given order
	 *
	 * @param integer $order_id The Order ID to query
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
	 * @param integer $order_id The Order ID to query
	 * @return array
	 * @access public
	 */
	public function get_order_by_id($order_id)
	{

		// Set query paramaters
		$params	 = array(
					'stream' 	=> 'firesale_orders',
					'namespace'	=> 'firesale_orders',
					'where'		=> "id = '{$order_id}'",
					'limit'		=> 1
				   );
		
		// Get entries		
		$order = $this->streams->entries->get_entries($params);

		if( $order['total'] == 1 )
		{

			$order 			= $order['entries'][0];
			$order['items'] = $this->db->get_where('firesale_orders_items', array('order_id' => (int)$order_id))->result_array();
			
			foreach( $order['items'] AS $key => &$item )
			{
				$product       = $this->products_m->get_product($item['product_id']);
				$item['id']	   = $product['id'];
				$item          = array_merge($product, $item);
				$item['total'] = number_format(( $item['price'] * $item['qty'] ), 2);
				$item['no']	   = ( $key + 1 );
			}

			return $order;
		}
		
		return FALSE;
	}

	/**
	 * Updates a products stock level and status based on it.
	 *
	 * @param integer $id The Product ID to update
	 * @param integer $stock The stock level to remove
	 * @return boolean TRUE or FALSE on successful update
	 * @access public
	 */
	public function update_product_stock($id, $stock)
	{

		// Variables
		$low	 = 10; // Move to settings
		$product = $this->products_m->get_product($id);

		if( $product )
		{

			$data = array();
			$data['stock']  = ( $product['stock'] - $stock );

			// Get status
			if( $data['stock'] < 0 )
			{
				// We dun fucked up
				$data['stock_status'] = 3;
			}
			else if( $data['stock'] == 0 )
			{
				$data['stock_status'] = 3;
			}
			else if( $data['stock'] <= $low )
			{
				$data['stock_status'] = 2;
			}
			else
			{
				$data['stock_status'] = 1;
			}

			// Update table
			$this->db->where("id = '{$product['id']}'")->update('firesale_products', $data);
			return TRUE;

		}

		return FALSE;
	}

	/**
	 * Updates the status of a given order
	 *
	 * @param integer $order_id The Order ID to update
	 * @param integer $status (Optional) The status code to set it to
	 * @param boolean TRUE or FALSE on successful update
	 * @access public
	 */
	public function update_status($order_id, $status = 0)
	{

		if( $this->db->where("id = '{$order_id}'")->update('firesale_orders', array('order_status' => $status)) )
		{
			return TRUE;
		}

		return FALSE;
	}

}
