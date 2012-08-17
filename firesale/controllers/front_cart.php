<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Front_cart extends Public_Controller
{

	public $validation_rules = array();
	public $has_routes = FALSE;
	public $stream;

	public function __construct()
	{

		parent::__construct();
		
		// Load CodeIgniter's cart class, the ci-merchant class and the gateways class
		$this->load->library(array('cart', 'merchant', 'gateways'));
		
		// Load the required models
		$this->load->driver('Streams');
		$this->load->model('firesale/cart_m');
		$this->load->model('firesale/orders_m');
		$this->load->model('firesale/address_m');
		$this->load->model('firesale/categories_m');
		$this->load->model('firesale/products_m');
		
		// Get the stream
		$this->stream = $this->streams->streams->get_stream('firesale_orders', 'firesale_orders');
		
		// Set routes
		if( $this->settings->get('routes_installed') == 1 )
			$this->has_routes = TRUE;
		
		// Set the tax percentage
		$this->cart->tax_percent = $this->settings->get('firesale_tax');
		
		// Set the pricing vars
		if ($this->cart->total() > 0)
		{
			$this->cart->total		= $this->cart->total();
			$this->cart->tax		= ( $this->cart->total / 100 ) * $this->cart->tax_percent;
			$this->cart->subtotal	= ( $this->cart->total - $this->cart->tax );
		}
		else
		{
			$this->cart->total		= '0.00';
			$this->cart->tax		= '0.00';
			$this->cart->subtotal	= '0.00';
		}

		// Load shipping model
		if( isset($this->firesale->roles['shipping']) )
		{
			$role = $this->firesale->roles['shipping'];
			$this->load->model($role['module'] . '/' . $role['model']);
		}

	}
	
	public function index()
	{
	
		// Assign Variables
		$data['subtotal']    = $this->cart->format_number($this->cart->subtotal);
		$data['tax']   		 = $this->cart->format_number($this->cart->tax);
		$data['total']   	 = $this->cart->format_number($this->cart->total);
		$data['tax_percent'] = $this->cart->tax_percent;
		$data['contents']    = $this->cart->contents();

		// Add item id
		$i = 1;
		foreach( $data['contents'] AS $key => $product )
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
		if( $prd_code === NULL )
		{

			if( is_array($this->input->post('prd_code')) AND is_array($this->input->post('prd_code')) )
			{

				$qtys = $this->input->post('qty', TRUE);
				
				foreach( $this->input->post('prd_code', TRUE) as $key => $prd_code )
				{
					
					$product = $this->products_m->get_product($prd_code);
					$tmp[$product['id']] = $product['stock'];

					if( $product != FALSE AND $qtys[$key] > 0 )
					{
						$data[] = $this->cart_m->build_data($product, (int)$qtys[$key]);
					}

				}
			}

		}
		else
		{

			$product = $this->products_m->get_product($prd_code);
			$tmp[$product['id']] = $product['stock'];

			if( $product != FALSE AND $qty > 0 )
			{
				$data[] = $this->cart_m->build_data($product, $qty);
				$this->session->set_userdata('added', $product['id']);
			}

		}

		// Insert items into the cart
		$this->cart->insert($data);

		// Force available quanity
		$this->cart_m->check_quantity($this->cart->contents(), $tmp);

		// Return for ajax or redirect
		if( $this->input->is_ajax_request() )
		{
			echo $this->cart_m->ajax_response('ok');
			exit();
		}
		else
		{

			if( $product != FALSE )
			{
				Events::trigger('cart_item_added', (array)$product);
			}

			redirect('/cart');

		}

	}
	
	public function update()
	{

		// Make sure there are items in cart
		if( !$this->cart->total() )
		{
			$this->session->set_flashdata('message', lang('firesale:cart:empty'));
			redirect(isset($this->has_routes) ? 'cart' : 'firesale/cart');
		}
		else
		{

			// Variables
			$cart = $this->cart->contents(); // Get the current contents of the cart
			$data = array(); // Set the empty data array
			
			// Loop through the updates, checking the quantity against the stock level and updating accordingly
			foreach( $this->input->post('item', TRUE) as $row_id => $item )
			{

				if( array_key_exists($row_id, $cart) )
				{

					$data['rowid'] = $row_id;
					
					// Has this item been marked for removal?
					if( isset($item['remove']) OR $item['qty'] <= 0 )
					{
		
						$data['qty'] = 0;
			
						// If this is a current order, update the table
						if( $this->session->userdata('order_id') > 0 )
						{
							$this->orders_m->remove_order_item($this->session->userdata('order_id'), $cart[$row_id]['id']);
						}
	
					}
					else
					{

						$product = $this->products_m->get_product($cart[$row_id]['id']);

						if( $product )
						{
	
							// Set the new quantity, or the stock level if the quantity exceeds it.
							$data['qty'] = $item['qty'] > $product['stock'] ? $product['stock'] : $item['qty'];

							// If this is a current order, update the table
							if( $this->session->userdata('order_id') > 0 )
							{
								$this->orders_m->insert_update_order_item($this->session->userdata('order_id'), $cart[$row_id], $data['qty']);
							}
			
						}
						else
						{

							// Looks like this product no longer exists, remove it!
							$data['qty'] = 0;
				
							// If this is a current order, update the table
							if( $this->session->userdata('order_id') > 0 )
							{
								$this->orders_m->remove_order_item($this->session->userdata('order_id'), $cart[$row_id]['id']);
							}

						}

					}

				}

				// Update cart
				$this->cart->update($data);

			}	

			// Update order cost
			$this->orders_m->update_order_cost($this->session->userdata('order_id'));

			// Fire events
			Events::trigger('cart_updated', array());

			// Are we checking out or just updating?
			if( $this->input->post('btnAction') == 'checkout' )
			{

				// Added so shipping can be a cart option
				if( $shipping = $this->input->post('shipping') )
				{
					$this->session->set_userdata('shipping', $shipping);
				}

				// Send to checkout
				redirect(( ! $this->has_routes ? '/firesale' : '' ) . '/cart/paypal');

			}
			else if( $this->input->is_ajax_request() )
			{
				echo $this->cart_m->ajax_response('ok');
				exit();
			}
			else
			{
				redirect(( ! $this->has_routes ? '/firesale' : '' ) . '/cart');
			}

		}

	}
	
	public function remove($row_id)
	{

		// If this is a current order, update the table
		if( $this->session->userdata('order_id') > 0 )
		{
			$cart = $this->cart->contents();
			$this->orders_m->remove_order_item($this->session->userdata('order_id'), $cart[$row_id]['id']);
		}
		
		// Update the cart
		$this->cart->update(array('rowid' => $row_id, 'qty' => 0));
		
		if( $this->input->is_ajax_request() )
		{
			exit('success');
		}
		else
		{
			redirect( ( isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : ( !$this->has_routes ? '/firesale' : '' ) . '/cart' ));
		}

	}
	
	private function checkout() // CH: Made private to prevent access for SLiM
	{

		// No checkout without items
		if( !$this->cart->total() )
		{
			$this->session->set_flashdata('message', lang('firesale:cart:empty'));
			redirect(isset($this->has_routes) ? 'cart' : 'firesale/cart');
		}
		else
		{
			
			// Libraries
			$this->load->library('gateways');
			$this->load->model('streams_core/streams_m');
			$this->load->helper('form');
			$this->merchant->load('paypal', $this->gateways->settings('paypal'));

			// Variables
			$data = array();
			
			// Check for post data
			if( $this->input->post('btnAction') == 'pay' )
			{
				
				// Variables
				$posted = TRUE;
				$input 	= $this->input->post();
				$skip	= array('btnAction', 'bill_details_same');
				$extra 	= array('return' => '/cart/payment', 'error_start' => '<div class="error-box">', 'error_end' => '</div>', 'success_message' => FALSE, 'error_message' => FALSE);

				// Shipping option
				if( isset($this->firesale->roles['shipping']) AND isset($input['shipping']) )
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
				$input['price_sub']    = $this->cart->subtotal;
				$input['price_ship']   = $shipping['price'];
				$input['price_total']  = number_format(( $this->cart->total + $shipping['price'] ), 2);
				$_POST 				   = $input;

				// Generate validation
				$rules = $this->cart_m->build_validation();
				$this->form_validation->set_rules($rules);

				// Run validation
				if( $this->form_validation->run() === TRUE )
				{
					// Check for addresses
					if( !isset($input['ship_to']) OR $input['ship_to'] == 'new' )
					{
						$input['ship_to'] = $this->address_m->add_address($input, 'ship');
					}

					if( !isset($input['bill_to']) OR $input['bill_to'] == 'new' )
					{
						$input['bill_to'] = $this->address_m->add_address($input, 'bill');
					}

					// Insert order
					if( $id = $this->orders_m->insert_order($input) )
					{

						// Now for each item in the order
						foreach( $this->cart->contents() as $item )
						{
							$this->orders_m->insert_update_order_item($id, $item, $item['qty']);
						}
						
						// Set order id
						$this->session->set_userdata('order_id', $id);

						// Redirect to payment
						redirect('/cart/payment');

					}

				}

				// Set error flashdata
				// Let script continue to rebuild page

			}
			elseif ($gateway = $this->session->flashdata('pay_via'))
			{
				if (isset($this->firesale->roles['shipping']) AND $this->session->flashdata('shipping'))
				{
					$role = $this->firesale->roles['shipping'];
					$shipping = $this->$role['model']->get_option_by_id($input['shipping']);
				}
				else
				{
					$shipping['price'] = '0.00';
					$shipping['id'] = 0;
				}

				print_r($shipping);

				$input = array(
					'gateway'		=> $this->gateways->id_from_slug($gateway),
					'order_status'	=> 1,
					'price_sub'		=> $this->cart->subtotal,
					'price_ship'	=> $shipping['price'],
					'price_total'	=> number_format(($this->cart->total + $shipping['price']), 2),
					'ship_to'		=> 0,
					'bill_to'		=> 0,
					'shipping'		=> $shipping['id']
				);

				// Insert order
				if( $id = $this->orders_m->insert_order($input) )
				{

					// Now for each item in the order
					foreach( $this->cart->contents() as $item )
					{
						$this->orders_m->insert_update_order_item($id, $item, $item['qty']);
					}
					
					// Set order id
					$this->session->set_userdata('order_id', $id);

					// Redirect to payment
					$gateway_info = $this->input->post('gateway_info');

					foreach ($gateway_info as &$value)
						$value = str_replace('-order_id-', $id, $value);


					$process = $this->merchant->process($gateway_info);
				}
			}
			else
			{

				$posted = FALSE;
				$input  = FALSE;
				$skip   = array();
				$extra  = array();
				
				// Check if the user has placed an order before and use these details.
				if( isset($this->current_user->id) AND $user_id = $this->current_user->id )
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
				$data['shipping'] = $this->$role['model']->calculate_methods($this->cart->contents());
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

	public function paypal()
	{
		// Variables
		$posted = TRUE;
		$shipping = $this->session->userdata('shipping');

		$skip	= array('btnAction', 'bill_details_same');
		$extra 	= array('return' => '/cart/payment', 'error_start' => '<div class="error-box">', 'error_end' => '</div>', 'success_message' => FALSE, 'error_message' => FALSE);

		// Shipping option
		if( isset($this->firesale->roles['shipping']) AND isset($shipping) )
		{
			$role = $this->firesale->roles['shipping'];
			$shipping = $this->$role['model']->get_option_by_id($shipping);
		}
		else
		{
			$shipping['price'] = '0.00';
		}
		
		// Modify posted data

		$input['shipping']     = ( isset($shipping['id']) ? $shipping['id'] : 0 );
		$input['created_by']   = ( isset($this->current_user->id) ? $this->current_user->id : NULL );
		$input['order_status'] = '1'; // Unpaid
		$input['price_sub']    = $this->cart->subtotal;
		$input['price_ship']   = $shipping['price'];
		$input['price_total']  = number_format(( $this->cart->total + $shipping['price'] ), 2);
		$input['ship_to']      = 0;
		$input['bill_to']      = 0;
		$input['gateway']      = $this->gateways->id_from_slug('paypal_checkout');
		$_POST                 = $input;


		// Generate validation
		//$rules = $this->cart_m->build_validation();
		//$this->form_validation->set_rules($rules);

		// Run validation
		//if( $this->form_validation->run() === TRUE )
		//{
			// Check for addresses
		/*	if( !isset($input['ship_to']) OR $input['ship_to'] == 'new' )
			{
				$input['ship_to'] = $this->address_m->add_address($input, 'ship');
			}

			if( !isset($input['bill_to']) OR $input['bill_to'] == 'new' )
			{
				$input['bill_to'] = $this->address_m->add_address($input, 'bill');
			}*/

			// Insert order
			if( $id = $this->orders_m->insert_order($input) )
			{
				// Now for each item in the order
				foreach( $this->cart->contents() as $item )
				{
					$this->orders_m->insert_update_order_item($id, $item, $item['qty']);
				}
				
				// Set order id
				$this->session->set_userdata('order_id', $id);

				// Redirect to payment
				if ($this->gateways->is_enabled('paypal_checkout'))
				{
					$this->merchant->load('paypal_checkout');

					$this->merchant->initialize($this->gateways->settings('paypal_checkout'));

					$paypal = array(
						'return_url'	=> site_url('firesale/cart/success').'?action=success',
						'cancel_url'	=> site_url('firesale/cart/cancel').'?action=cancel',
						'notify_url'	=> site_url('firesale/cart/callback/paypal_checkout/'.$id).'?action=ipn',
						'reference'		=> 'Order #'.$id,
						'currency_code'	=> 'GBP',
						'amount'		=> $this->cart->total,
						'items'			=> $this->cart->contents(),
						'shipping'		=> $shipping
					);

					$process = $this->merchant->process($paypal);
						
				}

			}

		//}
	}
	
	private function payment()
	{

		$order = $this->orders_m->get_order_by_id($this->session->userdata('order_id'));
	
		if( !empty($order) AND $this->gateways->is_enabled($order['gateway']['id']) )

		{

			// Get the gateway slug
			$gateway = $this->gateways->slug_from_id($order['gateway']['id']);
			
			// Initialize CI-Merchant
			$this->merchant->load($gateway);
			$this->merchant->initialize($this->gateways->settings($gateway));
			
			// Begin payment processing
			if( $_SERVER['REQUEST_METHOD'] === 'POST' )
			{

				// Run payment
				$process = $this->merchant->process($this->input->post(NULL, TRUE));
				$status  = '_order_' . $process->status;

				// Check status
				if( $process->status == 'authorized' )
				{
					// Remove ID & Shipping option
					$this->session->unset_userdata('order_id');
					$this->session->unset_userdata('shipping');
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
							   ->set('payment', $this->load->view('gateways/' . $gateway, $var, TRUE))
							   ->build('payment', $order);

			}

		}
		else
		{
			redirect('/cart/checkout');
		}
		
	}

	private function _order_failed($order)
	{

		$this->session->set_flashdata('error', 'There was an error processing the payment, perhaps a field is missing... Oh... This error message needs to be better ;)');
		redirect('/cart/payment');

	}

	private function _order_declined($order)
	{

		$this->session->set_flashdata('error', 'DECLINED! << Great error page, huh?');
		redirect('/cart/payment');

	}

	private function _order_authorized($order)
	{

		// Sale made, run updates
		$this->cart_m->sale_complete($order);

		// Clear cart
		$this->cart->destroy();

		// Fire events
		Events::trigger('order_complete', $order);

		// Email (user)
		Events::trigger('email', array_merge($order, array('slug' => 'order-complete-user')), 'array');

		// Email (admin)
		Events::trigger('email', array_merge($order, array('slug' => 'order-complete-admin', 'email' => $this->settings->get('contact_email'))), 'array');

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

	public function success()
	{

		if( $order_id = $this->session->userdata('order_id') )
		{

			$order = $this->orders_m->get_order_by_id($order_id);

			$this->cart->destroy();

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

			$this->cart->destroy();

			$this->template->title('Order Cancelled')
						   ->build('payment_cancelled');
		}
		else
		{
			show_404();
		}
		
	}

	public function callback($gateway = NULL, $order_id = NULL)
	{
		if ($this->gateways->is_enabled($gateway) AND $gateway != NULL AND $order_id != NULL)
		{
			$this->merchant->load($gateway, $this->gateways->settings($gateway));
			$response = $this->merchant->process_return();

			if ( ! empty($response->txn_id))
			{
				$processed = $this->db->get_where('firesale_transactions', array('txn_id' => $response->txn_id, 'status' => $response->status))->num_rows();
				
				$processed OR $this->db->insert('firesale_transactions', array('order_id' => $order_id, 'txn_id' => $response->txn_id, 'amount' => $response->amount, 'message' => $response->message, 'status' => $response->status, 'gateway' => $gateway));

				if ($response->status == 'authorized' AND ! $processed)
				{
					$order = $this->orders_m->get_order_by_id($order_id);


					if ($response->amount == $order['price_total'] AND $response->vars->mc_currency == 'GBP' AND $response->vars->receiver_email == $this->gateways->setting('paypal_checkout', 'paypal_email'))
					{
						// We need the ion_auth model to query/create the user.
						$this->load->model('users/ion_auth_model');

						if ( ! $order['created_by'])
						{
							// Has the user got an account, but ordered whilst logged out?
							$user = $this->db->select('id')
											 ->get_where('users', array('email' => $response->vars->payer_email));

							if ($user->num_rows())
							{
								$user_id = $user->row()->id;
								$email = $response->vars->payer_email; // This is the same as their db email
							}
							else
							{
								$this->load->helper('string');

								// Create a unique username
								$username = strtolower($response->vars->first_name.'-'.substr($response->vars->last_name, 0, 1).uniqid());
								$password = random_string('alnum', 10);
								$email = $response->vars->payer_email;

								$additional = array(
									'display_name'		=> $response->vars->first_name.' '.substr($response->vars->last_name, 0, 1),
									'first_name'		=> $response->vars->first_name,
									'last_name'			=> $response->vars->last_name
								);


								$group_name = $this->config->item('default_group', 'ion_auth');
								$group_id = ($group = $this->db->select('id')
									->where('name', $group_name)
									->get('groups')
									->row()) ? $group->id: 0;

								$salt = $this->ion_auth_model->salt();
								$ip = $this->input->ip_address();
								
								$hashed_password = $this->ion_auth_model->hash_password($password, $salt);

								$user = array(
									'username'        => $username,
									'password'        => $hashed_password,
									'salt'            => $salt,
									'email'           => $email,
									'group_id'        => $group_id,
									'ip_address'      => $ip,
									'created_on'      => now(),
									'last_login'      => now(),
									'active'          => 0,
									'activation_code' => md5(microtime(TRUE).uniqid())
								);

								// Add that user!
								$this->db->insert('users', $user);
								$user_id = $this->db->insert_id();

								// This is the profile data that we are not running through streams
								$extra = array(
									'user_id'			=> $user_id,
									'display_name' 		=> $additional['display_name']
								);

								// Add the profile fields
								$this->streams->entries->insert_entry($additional, 'profiles', 'users', array(), $extra);

								$user['id']       = $user_id;
								$user['password'] = $password;
								$user['to']       = $user['email'];

								// Send out an email!!!!
								Events::trigger('email', array_merge($user, array('slug' => 'user-created-temp')), 'array');

								// We don't need user anymore
								unset($user);
							}
						}
						else
						{
							$user_id = $order['created_by']['user_id'];
							$email = $order['created_by']['email'];
						}

						// Did the user get added successfully?
						if ($user_id)
						{
							// Explode PayPal's brilliant way of seperating address line 1 from address line 2 :S
							$address_lines = explode("\n", $response->vars->address_street);
							$ship_name = explode(' ', $response->vars->address_name, 2);

							$addr_data = array(
								'created_by'		=> $user_id,
								'addr_firstname'	=> $ship_name[0],
								'addr_lastname'		=> isset($ship_name[1]) ? $ship_name[1] : NULL,
								'addr_email'		=> $email,
								'addr_address1'		=> $address_lines[0],
								'addr_address2'		=> isset($address_lines[1]) ? $address_lines[1] : NULL,
								'addr_city'			=> $response->vars->address_city,
								'addr_county'		=> $response->vars->address_state,
								'addr_postcode'		=> $response->vars->address_zip,
								'addr_country'		=> $response->vars->address_country_code
							);

							// Add the address
							$this->load->model('firesale/address_m');

							// Add/retreive the address
							$address = $this->address_m->add_address($addr_data, 'addr');

							$order_data = array(
								'ship_to'    => $address,
								'bill_to'    => $address,
								'created_by' => $user_id
							);

							$this->db->update('firesale_orders', $order_data, array('id' => $order_id));

							// Refresh the order with the new data
							$order = $this->orders_m->get_order_by_id($order_id);

							// Complete the sale
							$this->cart_m->sale_complete($order);
						}

					}
					else
					{
						// Email (admin)
						mail('jamie.holdroyd@ne-web.com', 'PayPal Mismatch', print_r($order, true) . print_r($response, true));
						Events::trigger('email', array_merge($order, (array)$response, array('slug' => 'order-mismatch', 'email' => $this->settings->get('contact_email'))), 'array');
					}
				}

			}
				
		}

	}

}
