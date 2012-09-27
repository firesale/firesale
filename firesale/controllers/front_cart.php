<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Front_cart extends Public_Controller
{

	public $validation_rules = array();
	public $stream;

	public function __construct()
	{

		parent::__construct();

		// Load CodeIgniter's cart class, the ci-merchant class and the gateways class
		$this->load->library(array('fs_cart', 'merchant', 'gateways'));
		
		// Load the required models
		$this->load->driver('Streams');
		$this->load->model('firesale/cart_m');
		$this->load->model('firesale/orders_m');
		$this->load->model('firesale/address_m');
		$this->load->model('firesale/categories_m');
		$this->load->model('firesale/products_m');

		// Require login?
		if( $this->settings->get('firesale_login') == 1 AND !$this->current_user )
		{

			// Posted to cart
			if( $this->uri->segment('2') == 'insert' AND $code = $this->input->post('prd_code') )
			{
				$qty  = $this->input->post('prd_qty');
				$url  = BASE_URL.'cart/insert/'.$code[0].'/'.( $qty ? $qty[0] : '1' );
			}
			else
			{
				$url = current_url();
			}

			// Set data and redirect
			$this->session->set_flashdata('error', lang('firesale:cart:login_required'));
			$this->session->set_userdata('redirect_to', $url);
			redirect('users/login');		
		}
		
		// Get the stream
		$this->stream = $this->streams->streams->get_stream('firesale_orders', 'firesale_orders');
		
		// Set the tax percentage
		$this->fs_cart->tax_percent = $this->settings->get('firesale_tax');
		
		// Set the pricing vars
		if ($this->fs_cart->total() > 0)
		{
			$this->fs_cart->total		= $this->fs_cart->total();
			$this->fs_cart->tax			= ( $this->fs_cart->total / 100 ) * $this->fs_cart->tax_percent;
			$this->fs_cart->subtotal	= ( $this->fs_cart->total - $this->fs_cart->tax );
		}
		else
		{
			$this->fs_cart->total		= '0.00';
			$this->fs_cart->tax			= '0.00';
			$this->fs_cart->subtotal	= '0.00';
		}

		// Load shipping model
		if( isset($this->firesale->roles['shipping']) )
		{
			$role = $this->firesale->roles['shipping'];
			$this->load->model($role['module'] . '/' . $role['model']);
		}

		// Load css/js
		$this->template->append_css('module::firesale.css')
					   ->append_js('module::firesale.js');

	}

	public function index()
	{
	
		// Assign Variables
		$data['subtotal']    = $this->fs_cart->format_number($this->fs_cart->subtotal);
		$data['tax']   		 = $this->fs_cart->format_number($this->fs_cart->tax);
		$data['total']   	 = $this->fs_cart->format_number($this->fs_cart->total);
		$data['tax_percent'] = $this->fs_cart->tax_percent;
		$data['contents']    = $this->fs_cart->contents();

		// Add item id
		$i = 1;
		foreach ($data['contents'] AS $key => $product)
		{
			$data['contents'][$key]['no'] = $i;
			$i++;
		}

		// Add page data
		$this->template->set_breadcrumb('Home', '/home')
					   ->set_breadcrumb(lang('firesale:cart:title'), '/cart')
					   ->title(lang('firesale:cart:title'));

		// Fire events
		Events::trigger('page_build', $this->template);

		// Build page
		$this->template->build('cart', $data);
	}
	
	public function insert($prd_code = NULL, $qty = 1)
	{

		// Variables
		$data = array();
		$tmp  = array();

		// Add an item to the cart, either by post or from the URL
		if ($prd_code === NULL)
		{

			if (is_array($this->input->post('prd_code')))
			{

				$qtys = $this->input->post('qty', TRUE);
				
				foreach ($this->input->post('prd_code', TRUE) as $key => $prd_code)
				{
					
					$product = $this->products_m->get_product($prd_code);

					if ($product != FALSE AND ( $product['stock_status']['key'] == 6 OR $qtys[$key] > 0 ))
					{
						$data[] = $this->cart_m->build_data($product, (int)$qtys[$key]);
						if( $product['stock_status']['key'] != 6 ) { $tmp[$product['id']] = $product['stock']; }
					}

				}
			}

		}
		else
		{

			$product = $this->products_m->get_product($prd_code);

			if ($product != FALSE AND ( $product['stock_status']['key'] == 6 OR $qty > 0 ))
			{
				$data[] = $this->cart_m->build_data($product, $qty);
				$this->session->set_userdata('added', $product['id']);
				if( $product['stock_status']['key'] != 6 ) { $tmp[$product['id']] = $product['stock']; }
			}

		}

		// Insert items into the cart
		$this->fs_cart->insert($data);

		// Force available quanity
		if( $this->cart_m->check_quantity($this->fs_cart->contents(), $tmp) )
		{
			// Set flash to warn the user
			$this->session->set_flashdata('message', lang('firesale:cart:qty_too_low'));
		}

		if ($product != FALSE)
		{
			Events::trigger('cart_item_added', (array)$product);
		}

		Events::trigger('cart_updated');

		// Return for ajax or redirect
		if( $this->input->is_ajax_request() )
		{
			exit($this->cart_m->ajax_response('ok'));
		}
		else
		{
			redirect('cart');
		}

	}
	
	public function update()
	{

		// Make sure there are items in cart
		if ( ! $this->fs_cart->total_items())
		{
			$this->session->set_flashdata('message', lang('firesale:cart:empty'));
			redirect('cart');
		}
		else
		{

			// Variables
			$cart = $this->fs_cart->contents(); // Get the current contents of the cart
			$data = array(); // Set the empty data array
			
			// Loop through the updates, checking the quantity against the stock level and updating accordingly
			foreach ($this->input->post('item', TRUE) as $row_id => $item)
			{

				if (array_key_exists($row_id, $cart))
				{

					$data['rowid'] = $row_id;
					
					// Has this item been marked for removal?
					if (isset($item['remove']) OR $item['qty'] <= 0)
					{
		
						$data['qty'] = 0;
			
						// If this is a current order, update the table
						if ($this->cart_m->cart_has_order())
						{
							$this->orders_m->remove_order_item($this->session->userdata('order_id'), $cart[$row_id]['id']);
						}
	
					}
					else
					{

						$product = $this->products_m->get_product($cart[$row_id]['id']);

						if ($product)
						{

							// Set the new quantity, or the stock level if the quantity exceeds it.
							$data['qty'] = ( $product['stock_status']['key'] != 6 && $item['qty'] > $product['stock'] ? $product['stock'] : $item['qty'] );

							// If this is a current order, update the table
							if ($this->cart_m->cart_has_order())
							{
								$this->orders_m->insert_update_order_item($this->session->userdata('order_id'), $cart[$row_id], $data['qty']);
							}

							if( $data['qty'] < $item['qty'] )
							{
								// Set flash to warn the user
								$this->session->set_flashdata('message', lang('firesale:cart:qty_too_low'));
							}
			
						}
						else
						{

							// Looks like this product no longer exists, remove it!
							$data['qty'] = 0;
				
							// If this is a current order, update the table
							if ($this->cart_m->cart_has_order())
							{
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
			if ($this->input->post('btnAction') == 'checkout')
			{

				// Added so shipping can be a cart option
				if ($shipping = $this->input->post('shipping'))
				{
					$this->session->set_userdata('shipping', $shipping);
				}

				// Send to checkout
				redirect('cart/checkout');

			}
			elseif ($this->input->is_ajax_request())
			{
				exit($this->cart_m->ajax_response('ok'));
			}
			else
			{
				redirect('cart');
			}

		}

	}
	
	public function remove($row_id)
	{

		// If this is a current order, update the table
		if ($this->cart_m->cart_has_order())
		{
			$cart = $this->fs_cart->contents();
			$this->orders_m->remove_order_item($this->session->userdata('order_id'), $cart[$row_id]['id']);
		}
		
		// Update the cart
		$this->fs_cart->update(array('rowid' => $row_id, 'qty' => 0));
		
		if ($this->input->is_ajax_request())
		{
			exit('success');
		}
		else
		{
			redirect( ( isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'cart' ));
		}

	}
	
	public function checkout()
	{

		// No checkout without items
		if ( ! $this->fs_cart->total())
		{
			$this->session->set_flashdata('message', lang('firesale:cart:empty'));
			redirect('cart');
		}
		else
		{
			
			// Libraries
			$this->load->library('gateways');
			$this->load->model('streams_core/streams_m');
			$this->load->helper('form');

			// Variables
			$data = array();
			
			// Check for post data
			if ($this->input->post('btnAction') == 'pay')
			{
				
				// Variables
				$posted = TRUE;
				$input 	= $this->input->post();
				$skip	= array('btnAction', 'bill_details_same');
				$extra 	= array('return' => 'cart/payment', 'error_start' => '<div class="error-box">', 'error_end' => '</div>', 'success_message' => FALSE, 'error_message' => FALSE);

				// Shipping option
				if (isset($this->firesale->roles['shipping']) AND isset($input['shipping']))
				{
					$role = $this->firesale->roles['shipping'];
					$shipping = $this->$role['model']->get_option_by_id($input['shipping']);
				}
				else
				{
					$shipping['price'] = '0.00';
				}
				
				// Modify posted data
				$input['shipping']	   = ( isset($input['shipping']) ? $input['shipping'] : 0 );
				$input['created_by']   = ( isset($this->current_user->id) ? $this->current_user->id : NULL );
				$input['order_status'] = '1'; // Unpaid
				$input['price_sub']    = $this->fs_cart->subtotal;
				$input['price_ship']   = $shipping['price'];
				$input['price_total']  = number_format(( $this->fs_cart->total + $shipping['price'] ), 2);
				$_POST 				   = $input;

				// Generate validation
				$rules = $this->cart_m->build_validation();
				$this->form_validation->set_rules($rules);

				// Run validation
				if ($this->form_validation->run() === TRUE)
				{
					// Check for addresses
					if ( ! isset($input['ship_to']) OR $input['ship_to'] == 'new')
					{
						$input['ship_to'] = $this->address_m->add_address($input, 'ship');
					}

					if ( ! isset($input['bill_to']) OR $input['bill_to'] == 'new' )
					{
						$input['bill_to'] = $this->address_m->add_address($input, 'bill');
					}

					// Insert order
					if ($id = $this->orders_m->insert_order($input))
					{

						// Now for each item in the order
						foreach ($this->fs_cart->contents() as $item)
						{
							$this->orders_m->insert_update_order_item($id, $item, $item['qty']);
						}

						// CH: Trigger an event
						Events::trigger('order_created', array('id' => $id));
						
						// Set order id
						$this->session->set_userdata('order_id', $id);

						// Redirect to payment
						redirect('/cart/payment');

					}

				}

				// Set error flashdata
				// Let script continue to rebuild page

			}
			else
			{

				$posted = FALSE;
				$input  = FALSE;
				$skip   = array();
				$extra  = array();
				
				// Check if the user has placed an order before and use these details.
				if (isset($this->current_user->id) AND $user_id = $this->current_user->id)
				{
					$input = (object)$this->orders_m->get_last_order($user_id);
				}

			}

			// Get fields
			$data['fields'] = $this->address_m->get_address_form();
			
			// Get available shipping methods
			if( isset($this->firesale->roles['shipping']) )
			{
				$role = $this->firesale->roles['shipping'];
				$data['shipping'] = $this->$role['model']->calculate_methods($this->fs_cart->contents());
			}

			// Get available bliing and shipping options
			if( isset($this->current_user->id) )
		 	{
				$data['addresses'] = $this->address_m->get_addresses($this->current_user->id);
			}

			// Check for shipping option set in cart
			if( $this->session->userdata('shipping') )
			{
				$data['shipping'] = $this->session->userdata('shipping');
			}

			// Build page
			$this->template->set_breadcrumb('Home', '/home')
						   ->set_breadcrumb(lang('firesale:cart:title'), '/cart')
						   ->set_breadcrumb(lang('firesale:checkout:title'), '/cart/checkout')
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
		return TRUE;
	}

	public function _validate_gateway($value)
	{
		$this->form_validation->set_message('_valid_gateway', 'The payment gateway you selected is not valid');
		return $this->gateways->is_enabled($value);
	}
	
	public function payment()
	{

		$order = $this->orders_m->get_order_by_id($this->session->userdata('order_id'));
	
		if ( ! empty($order) AND $this->gateways->is_enabled($order['gateway']['id']))
		{

			// Get the gateway slug
			$gateway = $this->gateways->slug_from_id($order['gateway']['id']);
			
			// Initialize CI-Merchant
			$this->merchant->load($gateway);
			$this->merchant->initialize($this->gateways->settings($gateway));
			
			// Begin payment processing
			if ($this->input->post())
			{
				// Run payment
				$params = array_merge($this->input->post(NULL, TRUE), array(
					'currency_code' => $this->settings->get('firesale_currency'),
					'amount'        => $this->fs_cart->total,
					'reference'     => 'Order #' . $this->session->userdata('order_id')
				));
				$process = $this->merchant->process($params);
				$status = '_order_' . $process->status;

				// Check status
				if ($process->status == 'authorized')
				{
					if ((float)$process->amount == (float)$order['price_total'])
					{
						// Remove ID & Shipping option
						$this->session->unset_userdata('order_id');
						$this->session->unset_userdata('shipping');
					}
					else
					{
						$status = '_order_mismatch';
					}
				}

				// Run status function
				$this->$status($order);
			}
			else
			{
			
				// Variables
				$var['months'] = array();
				$currentMonth  = (int)date('m');
				for( $x = $currentMonth; $x < $currentMonth+12; $x++ ) { $var['months'][$x] = date('F', mktime(0, 0, 0, $x, 1)); }

				// Format order
				foreach( $order['items'] AS $key => $item )
				{
					$order['items'][$key]['price'] = number_format($item['price'], 2);
					$order['items'][$key]['total'] = number_format(( $item['price'] * $item['qty']), 2);
				}

				// Build page
				$this->template->title(lang('firesale:payment:title'))
							   ->set_breadcrumb('Home', '/home')
							   ->set_breadcrumb(lang('firesale:cart:title'), '/cart')
							   ->set_breadcrumb(lang('firesale:checkout:title'), '/cart/checkout')
							   ->set_breadcrumb(lang('firesale:payment:title'), '/cart/payment')
							   ->set('payment', $this->template->set_layout(FALSE)->build('gateways/' . $gateway, $var, TRUE))
							   ->build('payment', $order);

			}

		}
		else
		{
			redirect('/cart/checkout');
		}
		
	}

	public function callback($gateway = NULL, $order_id = NULL)
	{
		$order = $this->orders_m->get_order_by_id($order_id);

		if ($this->gateways->is_enabled($gateway) AND $gateway != NULL AND ! empty($order))
		{
			$this->merchant->load($gateway, $this->gateways->settings($gateway));
			$response = $this->merchant->process_return();
			$status = '_order_' . $process->status;

			$processed = $this->db->get_where('firesale_transactions', array('txn_id' => $response->txn_id, 'status' => $response->status))->num_rows();
			$processed OR $this->db->insert('firesale_transactions', array('order_id' => $order_id, 'txn_id' => $response->txn_id, 'amount' => $response->amount, 'message' => $response->message, 'status' => $response->status));

			if ( ! $processed)
			{
				// Check status
				if ($process->status == 'authorized')
				{
					if ($process->amount != $order['price_total'])
					{
						$status = '_order_mismatch';
					}
				}

				// Run status function
				$this->$status($order, TRUE);
			}
		}
		else
		{
			redirect($this->routes_installed ? 'cart' : 'firesale/cart');
		}
	}

	private function _order_failed($order, $callback = FALSE)
	{
		$this->orders_m->update_status($order['id'], 7);
		$this->session->set_flashdata('error', lang('firesale:orders:failed_message'));

		if ( ! $callback)
			redirect('cart/payment');
	}

	private function _order_declined($order, $callback = FALSE)
	{
		$this->orders_m->update_status($order['id'], 8);
		$this->session->set_flashdata('error', lang('firesale:orders:declined_message'));

		if ( ! $callback)
			redirect('cart/payment');

	}

	private function _order_mismatch($order, $callback = FALSE)
	{
		$this->orders_m->update_status($order['id'], 9);
		$this->session->set_flashdata('error', lang('firesale:orders:mismatch_message'));

		if ( ! $callback)
			redirect('cart/payment');
	}

	private function _order_authorized($order, $callback = FALSE)
	{

		// Sale made, run updates
		$this->cart_m->sale_complete($order);

		// Fire events
		Events::trigger('order_complete', $order);

		// Email (user)
		Events::trigger('email', array_merge($order, array('slug' => 'order-complete-user', 'to' => $order['bill_to']['email'])), 'array');

		// Email (admin)
		Events::trigger('email', array_merge($order, array('slug' => 'order-complete-admin', 'to' => $this->settings->get('contact_email'))), 'array');

		if ( ! $callback)
		{
			// Clear cart
			$this->fs_cart->destroy();

			// Format order for display
			$order['price_sub']   = number_format($order['price_sub'], 2);
			$order['price_ship']  = number_format($order['price_ship'], 2);
			$order['price_total'] = number_format($order['price_total'], 2);

			// Build page
			$this->template->title(lang('firesale:payment:title_success'))
						   ->set_breadcrumb('Home', '/home')
						   ->set_breadcrumb(lang('firesale:cart:title'), '/cart')
						   ->set_breadcrumb(lang('firesale:checkout:title'), '/cart/checkout')
						   ->set_breadcrumb(lang('firesale:payment:title'), '/cart/payment')
						   ->set_breadcrumb(lang('firesale:payment:title_success'), '/cart/payment')
						   ->build('payment_complete', $order);
		}

	}

	public function success()
	{

		if( $order_id = $this->session->userdata('order_id') )
		{

			$order = $this->orders_m->get_order_by_id($order_id);

			$this->fs_cart->destroy();

			$this->template->title(lang('firesale:payment:title_success'))
						   ->set_breadcrumb(lang('firesale:cart:title'), '/cart')
						   ->set_breadcrumb(lang('firesale:checkout:title'), '/cart/checkout')
						   ->set_breadcrumb(lang('firesale:payment:title'), '/cart/payment')
						   ->set_breadcrumb(lang('firesale:payment:title_success'), '/cart/payment')
						   ->build('payment_complete', $order);
		}
		else
		{
			show_404();
		}
		
	}

	public function cancel()
	{
		if ($order_id = $this->session->userdata('order_id'))
		{
			$this->orders_m->delete_order($order_id);
			$this->session->unset_userdata('order_id');

			$this->fs_cart->destroy();

			$this->template->title('Order Cancelled')
						   ->build('payment_cancelled');
		}
		else
		{
			show_404();
		}
		
	}

}
