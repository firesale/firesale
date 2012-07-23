<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders_m extends MY_Model
{

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
		foreach( $items AS $key => $item )
		{
			$total += $item['count'];
			$items[$key]['image'] = $this->products_m->get_single_image($item['id']);
		}
		
		// Return
		return array('count' => $total, 'products' => $items);
	}

	public function delete_order($id)
	{

		if( $this->db->where('id', $id)->delete('firesale_orders') )
		{
			if( $this->db->where('order_id', $id)->delete('firesale_orders_items') )
			{
				return TRUE;
			}
		}

		return FALSE;
	}

	public function check_quantity($products, $qty)
	{

		foreach( $products AS $rowid => $product )
		{
			if( array_key_exists($product['id'], $qty) )
			{
				if( (int)$qty[$product['id']] < (int)$product['qty'] )
				{
					$data 		   	  = array();
					$data['rowid']    = $rowid;
					$data['qty']   	  = $qty[$product['id']];
					$data['subtotal'] = number_format(( $data['qty'] * $product['price'] ), 2);
					$this->cart->update($data);
				}
			}
		}

	}

	public function build_validation()
	{

		// Variables
		$rules  = array();
		$input  = $this->input->post();

		// Get rules
		$stream = $this->streams->streams->get_stream('firesale_addresses', 'firesale_addresses');
		$fields = $this->streams_m->get_stream_fields($stream->id);
		$_rules = $this->fields->set_rules($fields, 'new', array(), TRUE,  NULL);

		// Build validation
		foreach( $_rules AS $rule )
		{

			// Shipping
			if( !isset($input['ship_to']) )
			{
				$_rule   		= $rule;
				$_rule['field'] = 'ship_' . $_rule['field'];
				$rules[] 		= $_rule;
			}

			// Billing
			if( !isset($input['bill_to']) )
			{
				$_rule   		= $rule;
				$_rule['field'] = 'bill_' . $_rule['field'];
				$rules[] 		= $_rule;
			}

		}

		// Set callbacks
		$rules[] = array('field' => 'gateway', 'label' => 'lang:firesale:label_gateway', 'rules' => 'callback__validate_gateway');
		$rules[] = array('field' => 'shipping', 'label' => 'lang:firesale:label_shipping', 'rules' => 'callback__validate_shipping');
		if( isset($input['ship_to']) )
		{
			$rules[] = array('field' => 'ship_to', 'label' => 'lang:firesale:label_ship_to', 'rules' => 'callback__validate_address');
		}
		if( isset($input['bill_to']) )
		{
			$rules[] = array('field' => 'bill_to', 'label' => 'lang:firesale:label_bill_to', 'rules' => 'callback__validate_address');
		}

		// Return
		return $rules;
	}

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

	public function ajax_response($status = 'ok')
	{

		// Variables
		$response = array();
		$response['status'] = $status;

		// Update cart if ok
		if( $status == 'ok' )
		{

			// Cart contents
			$response['products'] = $this->cart->contents();

			// Update cart pricing
			$this->update_order_cost(0, FALSE);

			// Add pricing
			$response['total'] 		= $this->cart->total;
			$response['tax']   		= $this->cart->tax;
			$response['subtotal']	= $this->cart->subtotal;

		}

		// Return
		return json_encode($response);
	}

	public function build_data($product, $qty)
	{

		$data = array(
					'id'	=> $product->id,
					'code'	=> $product->code,
					'qty'	=> ( $qty > $product->stock ? $product->stock : $qty ),
					'price'	=> $product->price,
					'name'	=> $product->title,
					'slug'	=> $product->slug,
					'weight'=> ( isset($product->shipping_weight) ? $product->shipping_weight : '0.00' ),
					'image'	=> $this->products_m->get_single_image($product->id)
				);

		return $data;
	}

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

	public function remove_order_item($order_id, $product_id)
	{
		$this->db->where("order_id", $order_id)
				 ->where("product_id", $product_id)
				 ->delete('firesale_orders_items');
	}

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

	public function get_product_count($id)
	{

		$query = $this->db->select('id')->where("order_id = {$id}")->get('firesale_orders_items');
		return $query->num_rows();
	}

	public function get_order_by_id($id)
	{

		// Set query paramaters
		$params	 = array(
					'stream' 	=> 'firesale_orders',
					'namespace'	=> 'firesale_orders',
					'where'		=> "id = '{$id}'"
				   );
		
		// Get entries		
		$order = $this->streams->entries->get_entries($params);

		if( $order['total'] == 1 )
		{
			$order 			= $order['entries'][0];
			$order['items'] = $this->db->get_where('firesale_orders_items', array('order_id' => (int)$id))->result_array();
			foreach( $order['items'] AS $key => $item )
			{
				$order['items'][$key]['total'] = number_format(( $item['price'] * $item['qty'] ), 2);
			}
			return $order;
		}
		
		return FALSE;
	}

	public function sale_complete($order)
	{

		// Update this order status
		$this->update_status($order['id'], 2);

		// Remove order id from session
		$this->session->unset_userdata('order_id');

		// Update product stock
		foreach( $order['items'] AS $item )
		{
			$this->update_product_stock($item['product_id'], $item['qty']);
		}

	}

	public function update_product_stock($id, $stock)
	{

		// Variables
		$low	 = 10; // Move to settings
		$product = $this->products_m->get_product_by_id($id);

		if( $product )
		{

			$data = array();
			$data['stock']  = ( $product->stock - $stock );

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
			$this->db->where("id = '{$product->id}'")->update('firesale_products', $data);
			return TRUE;

		}

		return FALSE;
	}

	public function update_status($id, $status = 0)
	{

		if( $this->db->where("id = '{$id}'")->update('firesale_orders', array('status' => $status)) )
		{
			return TRUE;
		}

		return FALSE;
	}

}
