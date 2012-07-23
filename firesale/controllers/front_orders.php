<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Front_orders extends Public_Controller
{

	public function __construct()
	{
		parent::__construct();
		
		// Load models, lang, libraries, etc.
		$this->load->model('orders_m');
		$this->load->model('products_m');

	}
	
	public function index()
	{
		
		// Variables
		$user = ( isset($this->current_user->id) ? $this->current_user->id : NULL );
		
		// Check user
		if( $user != NULL )
		{

			// Set query paramaters
			$params	 = array(
						'stream' 	=> 'firesale_orders',
						'namespace'	=> 'firesale_orders',
						'where'		=> "created_by = '{$user}'"
					   );
		
			// Get entries		
			$orders = $this->streams->entries->get_entries($params);

			// Add items to order
			if( $orders['total'] > 0 )
			{
				foreach( $orders['entries'] AS $key => $order )
				{
					$products = $this->orders_m->order_products($order['id']);
					$orders['entries'][$key] = array_merge($orders['entries'][$key], $products);
				}
			}
			
			// Variables
			$this->data->total  	= $orders['total'];
			$this->data->orders 	= $orders['entries'];
			$this->data->pagination = $orders['pagination'];
		
			// Build page
			$this->template->title(lang('firesale:orders:my_orders'))
						   ->set_breadcrumb('Home', '/home')
						   ->set_breadcrumb(lang('firesale:orders:my_orders'), '/users/orders')
						   ->build('orders', $this->data);
		
		}
		else
		{
			// Must be logged in, etc etc.
			// Redirect to login/register
		}
	
	}
	
	public function view_order($id)
	{
	
		// Variables
		$user  = ( isset($this->current_user->id) ? $this->current_user->id : NULL );
		$order = $this->orders_m->get_order_by_id($id);

		// Check user can view
		if( $user != NULL AND $order != FALSE AND $user == $order['created_by']['user_id'] )
		{
		
			// Format order for display
			$order['price_sub']   = number_format($order['price_sub'], 2);
			$order['price_ship']  = number_format($order['price_ship'], 2);
			$order['price_total'] = number_format($order['price_total'], 2);

			// Format products
			foreach( $order['items'] AS $key => $item )
			{
				$order['items'][$key]['price'] = number_format($item['price'], 2);
			}

			// Build page
			$this->template->title(sprintf(lang('firesale:orders:view_order'), $id))
						   ->set_breadcrumb('Home', '/home')
						   ->set_breadcrumb(lang('firesale:orders:my_orders'), '/users/orders')
						   ->set_breadcrumb(sprintf(lang('firesale:orders:view_order'), $id), '/users/orders/' . $id)
						   ->build('payment_complete', $order);

		}
		else
		{
			// Error
			// Set flash
			redirect('/users/orders');
		}
	
	}

}
