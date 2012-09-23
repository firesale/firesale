<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart_m extends MY_Model
{

	/**
	 * Ensures that the product quanities that have been added to a cart are within
	 * the allowed limits of what is currently in stock.
	 *
	 * @param array $products An array of the products currently in the cart
	 * @param integer $qty An array of max quantities that are in the order
	 * @return void
	 * @access public
	 */
	public function check_quantity($products, $qty)
	{

		$changed = FALSE;

		foreach( $products AS $rowid => $product )
		{
			if( array_key_exists($product['id'], $qty) )
			{
				if( (int)$qty[$product['id']] < (int)$product['qty'] )
				{
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

	/**
	 * Dynamically builds the validation for the checkout process depending on what
	 * has been submitted. This is to ensure that the address chosen exists and is
	 * for the correct user or if a new address has been submitted that it contains
	 * all of the necissary data.
	 *
	 * @return array An array containing the rules to be added to validation
	 * @access public
	 */
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
			if( !isset($input['ship_to']) OR ( isset($input['ship_to']) AND $input['ship_to'] == 'new' ) )
			{
				$_rule   		= $rule;
				$_rule['field'] = 'ship_' . $_rule['field'];
				$rules[] 		= $_rule;
			}

			// Billing
			if( !isset($input['bill_to']) OR ( isset($input['bill_to']) AND $input['bill_to'] == 'new' ) )
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

	/**
	 * Returns the current contents of the cart as well as the prices in JSON format
	 * to be used by any front-end applications that want to insert/update the cart
	 * via ajax.
	 *
	 * @param string $status The status message to be sent back to the browser
	 * @return string An ajax object containing the cart and prices
	 * @access public
	 */
	public function ajax_response($status = 'ok')
	{

		// Variables
		$response = array();
		$response['status'] = $status;

		// Update cart if ok
		if( $status == 'ok' )
		{

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
	 * @param array $product The product data to be used
	 * @param integer $qty The quantity of the product to be added
	 * @return array An array of information for db/cart insertion
	 * @access public
	 */
	public function build_data($product, $qty)
	{

		$data = array(
					'id'	=> $product['id'],
					'code'	=> $product['code'],
					'qty'	=> ( $qty > $product['stock'] && $product['stock_status']['key'] != 6 ? $product['stock'] : $qty ),
					'price'	=> $product['price'],
					'name'	=> $product['title'],
					'slug'	=> $product['slug'],
					'weight'=> ( isset($product['shipping_weight']) ? $product['shipping_weight'] : '0.00' ),
					'image'	=> $this->products_m->get_single_image($product['id'])
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
		if ($order_id = $this->session->userdata('order_id'))
		{
			// Load the orders model if its not already loaded
			$this->load->model('orders_m');

			$order = $this->orders_m->get_order_by_id($order_id);

			// Are there any items in the order?
			if (empty($order['items']))
			{
				// Nope, delete the order.
				$this->orders_m->delete_order($order_id);

				// Remove the order id from session.
				$this->session->unset_userdata('order_id');

				// Return FALSE, we have no order now.
				return FALSE;
			}

			// Is the order unpaid?
			if ($order['order_status']['key'] == 1)
			{
				return TRUE;
			}
			else
			{
				// Remove the order id from session.
				$this->session->unset_userdata('order_id');

				// Return FALSE, we have no order.
				return FALSE;
			}
		}
		else
		{
			return FALSE;
		}
	}

	/**
	 * Called when an Order has been completed.
	 * Updates the order status and sets it to paid, removes the order tracking from
	 * the users' session and finally updates the stock status of the items found
	 * in the order.
	 *
	 * @param array $order The Order object that has been completed
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
		foreach( $order['items'] AS $item )
		{
			$this->orders_m->update_product_stock($item['product_id'], $item['qty']);
		}

	}

}
