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
	public function products()
	{

		// Variables
		$limit	   = $this->attribute('limit', 10);
		$where     = $this->attribute('where', NULL);
		$order_by  = $this->attribute('order-by', 'id');
		$order_dir = $this->attribute('order-dir', 'desc');

		// Build query
		$query = $this->db->select('id')
						  ->from('firesale_products')
						  ->order_by($order_by, $order_dir)
						  ->limit($limit);

		if( $where != NULL )
		{
			foreach( explode('|', $where) AS $where )
			{
				list($field, $val) = explode('=', $where);
				$query->where(trim($field), trim($val));
			}
		}

		// Run query
		$results = $query->get();

		// Check for results
		if( $results->num_rows() )
		{

			// Get results
			$results  = $results->result_array();
			$products = array();

			// Get products
			foreach( $results AS $result )
			{
				$products[] = $this->products_m->get_product($result['id']);
			}

			// Return
			return $products;
		}

		// Nothing?
		return array();
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
		$data->count 	= 0;
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
			$data['low_prods'] = $this->db->select("title, stock, id, slug")->where('stock_status', '2')->order_by('stock', 'desc')->limit('10')->get('firesale_products')->result_array();
			$data['out_prods'] = $this->db->select("title, stock, id, slug")->where('stock_status', '3')->order_by('stock', 'desc')->limit('10')->get('firesale_products')->result_array();

			// Return view
			return $this->module_view('firesale', 'admin/dashboard/lowstock', $data, true);
		}

	}

}
