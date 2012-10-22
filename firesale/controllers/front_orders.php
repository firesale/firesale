<?php defined('BASEPATH') OR exit('No direct script access allowed');

<<<<<<< HEAD
=======
/**
 * Orders controller
 *
 * @author		Jamie Holdroyd
 * @author		Chris Harvey
 * @package		FireSale\Core\Controllers
 *
 */
>>>>>>> b3ad7d60c53e6b8bfe87b745fbff9d858f5c222f
class Front_orders extends Public_Controller
{

	public function __construct()
	{
<<<<<<< HEAD
		parent::__construct();
		
		// Load models, lang, libraries, etc.
=======

		parent::__construct();
		
		// Add data array
		$this->data = new stdClass();

		// Load models, lang, libraries, etc.
		$this->load->model('routes_m');
>>>>>>> b3ad7d60c53e6b8bfe87b745fbff9d858f5c222f
		$this->load->model('orders_m');
		$this->load->model('categories_m');
		$this->load->model('products_m');

		// Load css/js
		$this->template->append_css('module::firesale.css')
					   ->append_js('module::firesale.js');

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
				'where'		=> "created_by = '{$user}'",
				'order_by'  => 'id',
				'sort'      => 'desc'
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
<<<<<<< HEAD
						   ->set_breadcrumb('Home', 'home')
						   ->set_breadcrumb(lang('firesale:orders:my_orders'), 'users/orders')
=======
						   ->set_breadcrumb(lang('firesale:orders:my_orders'), $this->routes_m->build_url('orders'))
>>>>>>> b3ad7d60c53e6b8bfe87b745fbff9d858f5c222f
						   ->set($this->data);

			// Fire events
			Events::trigger('page_build', $this->template);

			// Build page
			$this->template->build('orders');
		
		}
		else
		{
			// Must be logged in
			$this->session->set_flashdata('error', lang('firesale:orders:logged_in'));
<<<<<<< HEAD
			redirect('users/login');
=======
			redirect('/users/login');
>>>>>>> b3ad7d60c53e6b8bfe87b745fbff9d858f5c222f
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
			foreach( $order['items'] AS &$item )
			{
				$item['price'] = number_format($item['price'], 2);
			}

			// Build page
			$this->template->title(sprintf(lang('firesale:orders:view_order'), $id))
<<<<<<< HEAD
						   ->set_breadcrumb('Home', 'home')
						   ->set_breadcrumb(lang('firesale:orders:my_orders'), 'users/orders')
						   ->set_breadcrumb(sprintf(lang('firesale:orders:view_order'), $id), 'users/orders/' . $id)
=======
						   ->set_breadcrumb('Home', '/home')
						   ->set_breadcrumb(lang('firesale:orders:my_orders'), '/users/orders')
						   ->set_breadcrumb(sprintf(lang('firesale:orders:view_order'), $id), '/users/orders/' . $id)
>>>>>>> b3ad7d60c53e6b8bfe87b745fbff9d858f5c222f
						   ->set($order);

			// Fire events
			Events::trigger('page_build', $this->template);

			// Build page
			$this->template->build('orders_single');

		}
		else
		{
			// Must be logged in
			$this->set_flashdata('error', lang('firesale:orders:logged_in'));
<<<<<<< HEAD
			redirect('users/login');
=======
			redirect('/users/login');
>>>>>>> b3ad7d60c53e6b8bfe87b745fbff9d858f5c222f
		}
	
	}

<<<<<<< HEAD
}
=======
}
>>>>>>> b3ad7d60c53e6b8bfe87b745fbff9d858f5c222f
