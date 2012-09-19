<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Plugin_Firesale extends Plugin
{

    public function __construct()
    {
		$this->load->model('categories_m');
		$this->load->model('products_m');
	}

	public function module_installed()
	{
	
		// Variables
		$module = $this->attribute('name', 'firesale');

		// Check
		$query = $this->db->select('id')->where("slug = '{$module}' AND installed = 1")->get('modules');

		if( $query->num_rows() )
		{
			return TRUE;
		}

		return FALSE;	
	}

	public function categories()
	{
	
		// Variables
		$limit	   	   = $this->attribute('limit', 6);
		$category  	   = $this->attribute('category', 0);
		$order_by  	   = $this->attribute('order-by', 'ordering_count');
		$order_dir 	   = $this->attribute('order-dir', 'asc');
		$exclude_empty = (bool)$this->attribute('exclude-empty', FALSE);

		// Exclude empty categories?
		if ($exclude_empty)
		{
			$this->db->where('(SELECT COUNT(id)
				FROM ' . $this->db->dbprefix('firesale_products_firesale_categories') . '
				WHERE firesale_categories_id=' . $this->db->dbprefix('firesale_categories.id') . ') >', 0);
		}
		
		// Build query
		$query = $this->db->select('id, title, parent, slug')
					  	  ->from('firesale_categories')
						  ->where('status', '1')
						  ->where('parent', $category)
						  ->order_by($order_by, $order_dir);

		// Add limit?
		if( $limit > 0 )
		{
			$query->limit($limit);
		}

		// Category may be NULL
		if( $category <= 0 )
		{
			$query->or_where('status', '1')
				  ->where('parent', NULL);
		}

		// Get categories
		$categories = $query->get()->result_array();
		
		return $categories;
	}
	
	public function sub_categories()
	{
	
		// Return
		return $this->categories();
	}

	public function products()
	{

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

	public function cart()
	{
	
		// Load libraries
		$this->load->model('products_m');
		$this->load->library('fs_cart');

		$tax  		 	= 0.2; // add to settings later
		$data 		 	= new stdClass;
		$data->sub 	 	= 0;
		$data->tax 	 	= 0;
		$data->total 	= 0;
		$data->count 	= 0;
		$data->products = array();
		
		// Loop products in cart
		foreach( $this->fs_cart->contents() as $id => $item )
		{
		
			$product = $this->products_m->get_product($item['id']);
			
			if( $product !== FALSE )
			{
			
				$data->products[] = array(
					'id'		=> $id,
					'code' 		=> $product['code'],
					'slug'		=> $product['slug'],
					'quantity'	=> $item['qty'],
					'name'		=> $item['name']
				);
				
				$data->total += $item['subtotal'];
				$data->count += $item['qty'];
			}
		
		}
		
		// Calculate prices
		$data->tax   = number_format(( $data->total * $tax ), 2);
		$data->sub   = number_format(( $data->total - $data->tax ), 2);
		$data->total = number_format($data->total, 2);

		return array($data);
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
