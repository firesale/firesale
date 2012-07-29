<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Plugin_Firesale extends Plugin
{

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

	public function categories($limit = 6, $category = 0, $order_by = 'children', $order_dir = 'desc')
	{
	
		// Variables
		$limit	   	   = $this->attribute('limit', $limit);
		$category  	   = $this->attribute('category', $category);
		$order_by  	   = $this->attribute('order-by', $order_by);
		$order_dir 	   = $this->attribute('order-dir', $order_dir);
		
		// SQL Query
		$sql = "SELECT c.`id`, c.`title`, c.`slug`, ( SELECT COUNT(`id`) FROM `" . SITE_REF . "_firesale_categories` WHERE `parent` = c.`id` ) AS `children`
				FROM `" . SITE_REF . "_firesale_categories` AS c
				WHERE c.`status` = 1
				AND c.`parent` = '{$category}'
				ORDER BY `{$order_by}` {$order_dir}, c.`ordering_count` DESC";
				
		if( ( 0 + $limit ) > 0 ) { $sql .= "\nLIMIT {$limit}"; }

		// Get main cats
		$cats = $this->db->query($sql)->result();
		
		// Loop cats
		for( $i = 0; $i < count($cats); $i++ ) {
		
			// Get last and subs
			$cats[$i]->last = ( ( $i + 1 ) == $limit ? ' last' : '' );

		}

		return $cats;
	}
	
	public function sub_categories()
	{
	
		// Variables
		$limit	   	   = $this->attribute('limit', 6);
		$category  	   = $this->attribute('category', 0);
		$order_by  	   = $this->attribute('order-by', 'children');
		$order_dir 	   = $this->attribute('order-dir', 'desc');
	
		// Return
		return $this->categories($limit, $category, $order_by, $order_dir);
	}

	public function cart()
	{
	
		// Load libraries
		$this->load->model('products_m');
		$this->load->library('cart');

		$tax  		 	= 0.2; // add to settings later
		$data 		 	= new stdClass;
		$data->sub 	 	= 0;
		$data->tax 	 	= 0;
		$data->total 	= 0;
		$data->products = array();
		
		// Loop products in cart
		foreach( $this->cart->contents() as $id => $item )
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
			$data = array();
			$data['products'] = $this->db->query('SELECT SUM(qty) AS `count`, p.`id`, p.`title`, p.`slug`
												  FROM `' . SITE_REF . '_firesale_orders_items` AS i
												  INNER JOIN `' . SITE_REF . '_firesale_products` AS p ON p.`id` = i.`product_id`
												  GROUP BY i.`product_id`
												  ORDER BY `count` DESC
												  LIMIT 10')->result_array();

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
			$data['low_prods'] = $this->db->select("title, stock, id, slug")->where('stock_status', '2')->order_by('stock', 'desc')->limit('10')->get('firesale_products')->result_array();
			$data['out_prods'] = $this->db->select("title, stock, id, slug")->where('stock_status', '3')->order_by('stock', 'desc')->limit('10')->get('firesale_products')->result_array();

			// Return view
			return $this->module_view('firesale', 'admin/dashboard/lowstock', $data, true);
		}

	}

}
