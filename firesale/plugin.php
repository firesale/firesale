<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Plugin_Firesale extends Plugin
{

    public function __construct()
    {
		$this->load->library('files/files');
		$this->load->model('categories_m');
		$this->load->model('products_m');
		$this->load->model('routes_m');
		$this->load->model('taxes_m');
		$this->load->model('currency_m');
	}

	public function url()
	{

		// Variables
		$route = $this->attribute('route');
		$id    = $this->attribute('id');
		$after = $this->attribute('after');

		// Get the URL
		return BASE_URL.$this->routes_m->build_url($route, $id).$after;
	}

	public function module_installed()
	{
	
		// Variables
		$module = $this->attribute('slug', 'firesale');

		// Check
		$query = $this->db->select('id')->where('slug', $module)->where('installed', '1')->get('modules');

		if( $query->num_rows() )
		{
			return TRUE;
		}

		return FALSE;	
	}

	public function categories()
	{

		// Variables
		$attributes = $this->attributes();
		
		// Build query
		$query = $this->db->select('id')
					  	  ->from('firesale_categories')
						  ->where('status', '1');

		// Add to query
		foreach( $attributes AS $key => $val )
		{

			switch($key)
			{

				case 'limit':
					$query->limit($val);
				break;

				case 'order':
					list($by, $dir) = explode(' ', $val);
					$query->order_by($by, $dir);
				break;

				case 'empty':
					if( $val == 'false' )
					{
						$this->db->where('(SELECT COUNT(id)
										  FROM ' . $this->db->dbprefix('firesale_products_firesale_categories') . '
										  WHERE firesale_categories_id=' . $this->db->dbprefix('firesale_categories.id') . ') >', 0);
					}
				break;

				default:
					$query->where($key, $val);
				break;

			}

		}

		// Get categories
		$categories = $query->get()->result_array();

		// Loop and get objects
		foreach( $categories AS &$category )
		{
			$category = $this->categories_m->get_category($category['id']);
		}
		
		return $categories;
	}
	
	public function sub_categories()
	{
	
		// Return
		return $this->categories();
	}
	
	public function sub_sub_categories()
	{
	
		// Return
		return $this->categories();
	}

	public function products()
	{
		$show_variations = (bool)$this->settings->get('firesale_show_variations');

		// Variables
		$attributes = $this->attributes();

		// Children?
		if( isset($attributes['category']) )
		{
			$children   = $this->categories_m->get_children($attributes['category']);
			$children[] = $attributes['category'];
		}

		// Build query
		$query = $this->db->select('p.id')
						  ->from('firesale_products AS p')
						  ->join('firesale_products_firesale_categories AS pc', 'pc.row_id = p.id', 'inner')
						  ->join('firesale_categories AS c', 'c.id = pc.firesale_categories_id')
						  ->where('p.status', '1')
						  ->group_by('p.slug');

		if ( ! $show_variations)
			$query->where('is_variation', 0);

		// Add to query
		foreach( $attributes AS $key => $val )
		{

			switch($key)
			{

				case 'limit':
					$query->limit($val);
				break;

				case 'order':
					list($by, $dir) = explode(' ', $val);
					$query->order_by('p.' . $by, $dir);
				break;

				case 'category':
					$query->where_in('c.id', $children);
				break;

				default:
					$query->where($key, $val);
				break;

			}

		}

		// Run query
		$results = $query->get()->result_array();

		// Get products
		foreach( $results AS &$result )
		{
			$result = $this->products_m->get_product($result['id']);
		}

		// Return results
		return $results;
	}

	public function modifier_form()
	{

		// Variables
		$type    = $this->attribute('type', 'select'); // radio
		$product = $this->attribute('product');
		$product = $this->products_m->get_product($product);

		// Format data
		foreach( $product['modifiers'] as &$modifier )
		{
			$first = true;
			foreach( $modifier['variations'] as &$variation )
			{
				$variation['mod_id']   = $modifier['id'];
				$variation['selected'] = ( $first ? 'checked="checked" ' : '' );
				$first = false;
			}
		}

		// Assign data
		$data = new stdClass;
		$data->type      = $type;
		$data->product   = $product;
		$data->modifiers = $product['modifiers'];

		// Build form
		return $this->parser->parse('partials/modifier_form', $data, true);
	}

	public function cart()
	{
	
		// Load libraries
		$this->load->library('fs_cart');

		// Get currency
		$currency = $this->currency_m->get(( $this->session->userdata('currency') ? $this->session->userdata('currency') : 1 ));

		// Variables
		$data 		 	= new stdClass;
		$data->products = array();
		
		// Loop products in cart
		foreach( $this->fs_cart->contents() as $id => $item )
		{
		
			$product = $this->products_m->get($item['id']);

			if( $product !== FALSE )
			{
			
				$data->products[] = array(
					'id'		=> $id,
					'code' 		=> $product->code,
					'slug'		=> $product->slug,
					'quantity'	=> $item['qty'],
					'name'		=> $item['name']
				);
			}
		
		}
		
		// Calculate prices
		$data->tax   = $this->currency_m->format_string($this->fs_cart->tax(), $currency, false);
		$data->sub   = $this->currency_m->format_string($this->fs_cart->subtotal(), $currency, false);
		$data->total = $this->currency_m->format_string($this->fs_cart->total(), $currency, false);
		$data->count = $this->fs_cart->total_items();

		// Retrun data
		return array($data);
	}

	public function currencies()
	{

		// Select all currencies
		$results = $this->db->select('id')->get('firesale_currency')->result_array();

		// Loop them
		foreach( $results AS &$currency )
		{
			// Retrieve data
			$currency = $this->currency_m->get($currency['id']);
		}

		return $results;
	}

	#######################
	## DASHBOARD MODULES ##
	#######################

	public function product_sales()
	{
	
		if( $_SERVER['REQUEST_URI'] == '/admin/firesale' )
		{

			// Variables
			$data     = array('total_sales' => 0, 'total_count' => 0);
			$sales    = array();
			$count    = array();
			$currency = $this->settings->get('currency');
			$products = $this->db->query('SELECT SUM(`qty`) AS `count`, SUM(`qty` * `price`) AS `sales`, date_format(`created`, "%Y-%m") AS `month`
										  FROM `' . SITE_REF . '_firesale_orders_items`
										  GROUP BY `month`
										  ORDER BY `month` ASC
										  LIMIT 12')->result_array();

			// Build JSON
			foreach( $products AS $product )
			{
				$sales[] = array(strtotime($product['month']) . '000', round($product['sales'], 2));
				$count[] = array(strtotime($product['month']) . '000', (int)$product['count']);
				$data['total_sales'] += $product['sales'];
				$data['total_count'] += $product['count'];
			}
			
			// Assign data
			$data['sales'] 		 = json_encode($sales);
			$data['count'] 		 = json_encode($count);
			$data['currency']	 = $currency;
			$data['total_sales'] = $currency . number_format($data['total_sales'], 2);

			// Return view
			return $this->module_view('firesale', 'admin/dashboard/productsales', $data, true);
		}

	}

	public function low_stock()
	{

		if( $_SERVER['REQUEST_URI'] == '/admin/firesale' )
		{

			// Variables
			$data			   = array();
			$data['low_count'] = $this->db->select("id")->where('stock_status', '2')->get('firesale_products')->num_rows();
			$data['out_count'] = $this->db->select("id")->where('stock_status', '3')->get('firesale_products')->num_rows();
			$data['low_prods'] = $this->db->select("code, title, stock, id, slug")->where('stock_status', '2')->order_by('stock', 'desc')->limit('5')->get('firesale_products')->result_array();
			$data['out_prods'] = $this->db->select("code, title, stock, id, slug")->where('stock_status', '3')->order_by('stock', 'desc')->limit('5')->get('firesale_products')->result_array();

			// Return view
			return $this->module_view('firesale', 'admin/dashboard/lowstock', $data, true);
		}

	}

}
