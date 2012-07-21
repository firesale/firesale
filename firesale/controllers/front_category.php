<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Front_category extends Public_Controller {
	
    public $perpage = 15;
	
	public function __construct()
    {

        parent::__construct();
		
		// Load libraries
		$this->load->driver('Streams');
		$this->load->library('files/files');
		$this->lang->load('firesale');
		$this->load->model('categories_m');
		$this->load->model('products_m');
		$this->load->helper('firesale/general');

	}
	
	public function index($category, $start = 0, $extra = NULL)
	{
	
		// Get cookie data
		$this->data->layout = ( isset($_COOKIE['listing_style']) ? $_COOKIE['listing_style'] : 'grid' );
		$this->data->order  = get_order(( isset($_COOKIE['listing_order']) ? $_COOKIE['listing_order'] : 1 ));

		// Get category details
		$category = $this->categories_m->get_category_by_slug($category);

		// Check category exists
		if( $category != FALSE )
		{
			
			// Variables
			$products = array();
			$children = $this->categories_m->get_children($category['id']);

			// Check for children
			if( !empty($children) )
			{
				$children[] = $category['id'];
				$where      = "`category` IN (" . implode(',', $children) . ") AND `status` = '1'";
			}
			else
			{
				$where = "category = '{$category['id']}' AND status = 1";
			}

			// Check start
			if( !is_int($start) AND substr($start, 0, 4) == 'sale' )
			{
				$sale   = $start;
				$start  = $extra;
				$where .= ' AND `price` < `rrp`';
			}

			// Set query paramaters
			$params	 = array(
						'stream' 	=> 'firesale_products',
						'namespace'	=> 'firesale_products',
						'where'		=> $where,
						'limit'		=> $this->perpage,
						'offset'	=> $start,
						'order_by'	=> $this->data->order['by'],
						'sort'		=> $this->data->order['dir']
					   );

			// Get product
			$entry = $this->streams->entries->get_entries($params);
			
			// Check for products
			if( count($entry['entries']) > 0 )
			{
				
				// Loop entries
				foreach( $entry['entries'] AS $product )
				{
					$product['image'] 		= $this->products_m->get_single_image($product['id']);
					$product['description'] = strip_tags($product['description']);
					$products[] 	  		= $product;
				}
				
			}

			// Assign data
			$this->data->category = $category;
			$this->data->products = $products;
			$this->data->ordering = get_order();

			// Assign pagination
			if( !empty($products) )
			{
				$this->data->pagination = create_pagination('/category/' . $category['slug'] . ( isset($sale) ? '/' . $sale : '' ),  $this->categories_m->total_products($category), $this->perpage, ( isset($sale) ? 4 : 3 ));
				$this->data->pagination['shown'] = count($products);
			}

			// Breadcrumbs
			$cat_tree = $this->products_m->get_cat_path($this->data->products[0]['category']['id'], true);
			$this->template->set_breadcrumb('Home', '/home');
			foreach( $cat_tree as $key => $cat )
			{
				$this->template->set_breadcrumb($cat['title'], '/category/' . $cat['slug']);
			}

			// Assign parent data
			$this->data->parent = ( $category['parent'] > 0 ? $category['parent'] : $category['id'] );

			// Build Page
			$this->template->title($this->data->category['title'])
						   ->build('category', $this->data);

		}
		else
		{
			set_status_header(404);
			echo Modules::run('pages/_remap', '404');
		}

	}

	public function style($type)
	{
		setcookie('listing_style', $type, ( time() + ( 30 * 24 * 60 * 60 )));
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function order($type)
	{

		$orders = get_order();

		if( array_key_exists($type, $orders) )
		{
			setcookie('listing_order', $type, ( time() + ( 30 * 24 * 60 * 60 )));
		}

		redirect($_SERVER['HTTP_REFERER']);
	}
    
}
