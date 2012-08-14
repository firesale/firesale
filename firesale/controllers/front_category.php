<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Front_category extends Public_Controller {
	
	/**
	 * Contains the maximum number of products to show in the
	 * front-end category view, also used for pagination.
	 *
	 * @var integer Number of products to show per-page
	 * @access public
	 */
    public $perpage = 15;
	
	/**
	 * Loads the parent constructor and gets an
	 * instance of CI. Also loads in the language
	 * files and required models to perform any 
	 * required actions.
	 *
	 *
	 * @return void
	 * @access public
	 */
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

		// Get perpage option
		$this->perpage = $this->settings->get('firesale_perpage');

		// Load css/js
		/*$this->template->append_css('module::firesale.css')
					   ->append_js('module::firesale.js');*/

	}

	/**
	 * Builds the initial Category view for the front-end
	 * pages, including the specific category or sub-cats,
	 * pagination and possibly only sale items with the format
	 * of:
	 *
	 *   category/CATEGORY NAME/sale/[pagination]?
	 *
	 * @param string $category Category slug to query
	 * @param string $start (Optional) Either the pagination page or sale
	 * @param integer $extra (Optional) When sale is set as the second param, this is the pagination page
	 * @return void
	 * @access public
	 */	
	public function index($category, $start = 0, $extra = NULL)
	{
	
		// Get cookie data
		$this->data->layout = ( isset($_COOKIE['listing_style']) ? $_COOKIE['listing_style'] : 'grid' );
		$this->data->order  = get_order(( isset($_COOKIE['listing_order']) ? $_COOKIE['listing_order'] : 1 ));

		// Get category details
		$category = $this->categories_m->get_category($category);

		// Check category exists
		if( $category != FALSE )
		{
			
			// Query
			$query = $this->categories_m->_build_query($category['id']);

			// Check start for sale section
			if( !is_int($start) AND substr($start, 0, 4) == 'sale' )
			{

				// Redefine vars
				$sale  = $start;
				$start = $extra;

				// Add where
				$query->where('firesale_products.rrp > firesale_products.price');
			}

			// Add ordering
			$query->order_by('firesale_products.' . $this->data->order['by'], $this->data->order['dir']);

			// Add Limits
			$query->limit($this->perpage, $start);

			// Get products
			$ids      = $query->get()->result_array();
			$products = array();

			foreach( $ids AS $id )
			{
				$product    			= $this->products_m->get_product($id['id']);
				$product['description'] = strip_tags($product['description']);
				$products[] 			= $product;
			}

			// Assign data
			$this->data->category = $category;
			$this->data->products = $products;
			$this->data->ordering = get_order();

			// Assign pagination
			if( !empty($products) )
			{
				$this->data->pagination = create_pagination('/category/' . $category['slug'] . ( isset($sale) ? '/' . $sale : '' ),  $this->categories_m->total_products($category['id']), $this->perpage, ( isset($sale) ? 4 : 3 ));
				$this->data->pagination['shown'] = count($products);
			}

			// Breadcrumbs
			$cat_tree = $this->products_m->get_cat_path($category['id'], true);
			$this->template->set_breadcrumb('Home', '/home');
			foreach( $cat_tree as $key => $cat )
			{
				$this->template->set_breadcrumb($cat['title'], '/category/' . $cat['slug']);
			}

			// Assign parent data
			$this->data->parent = ( isset($category['parent']['id']) && $category['parent']['id'] > 0 ? $category['parent']['id'] : $category['id'] );

			// Set category in session
			$this->session->set_userdata('category', $this->data->category['id']);

			// Build Page
			$this->template->title($this->data->category['title'])
						   ->set($this->data);

			// Fire events
			Events::trigger('page_build', $this->template);

			// Build page
			$this->template->build('category');

		}
		else
		{
			set_status_header(404);
			echo Modules::run('pages/_remap', '404');
		}

	}

	/**
	 * Sets the listing style cookie with a possible value of grid or layout
	 *
	 * @param string $type The layout style to set in the cookie
	 * @return void
	 * @access public
	 */
	public function style($type)
	{
		setcookie('listing_style', $type, ( time() + ( 30 * 24 * 60 * 60 )));
		redirect($_SERVER['HTTP_REFERER']);
	}

	/**
	 * Sets the listing order cookie with a number of possible values as
	 * defined in the get_order helper.
	 *
	 * @param integer $type The ID of the ordering method to use
	 * @return void
	 * @access public
	 */
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
