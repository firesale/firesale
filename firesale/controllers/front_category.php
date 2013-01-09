<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Category controller
 *
 * @author		Jamie Holdroyd
 * @author		Chris Harvey
 * @package		FireSale\Core\Controllers
 *
 */
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
		$this->load->model('routes_m');
		$this->load->helper('firesale/general');

		// Assign data object
		$this->data = new stdClass;

		// Get perpage option
		$this->perpage = $this->settings->get('firesale_perpage');

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
	public function index($category = NULL, $start = 0, $extra = NULL)
	{

		// Check category
		if( ( is_int($category) OR is_numeric($category) ) AND $start == 0 )
		{
			$start    = $category;
			$category = NULL;
		}
	
		// Get cookie data
		$order              = $this->input->cookie('firesale_listing_order');
		$this->data->layout = $this->input->cookie('firesale_listing_style') or 'grid';
		$this->data->order  = get_order(( $order != null ? $order : '1' ));

		// Get category details
		if( $category != NULL )
		{
			$category = $this->pyrocache->model('categories_m', 'get_category', array($category), $this->firesale->cache_time);
		}

		// Check category exists
		if( $category != FALSE or $category == NULL )
		{
			
			// Build Query
			$query = $this->categories_m->_build_query($category)
						  ->order_by('firesale_products.' . $this->data->order['by'], $this->data->order['dir'])
						  ->limit($this->perpage, $start);

			// Variables
			$query     = $query->get_compiled_select();
			$cache_key = md5(BASE_URL.$query);
			$products  = array();

			// Get from cache
			if( ! $ids = $this->cache->get($cache_key) )
			{
				// Otherwise run query
				$ids = $this->db->query($query)->result_array();
			}

			// Loop and get products
			foreach( $ids AS $id )
			{
				$product    			= $this->pyrocache->model('products_m', 'get_product', array($id['id']), $this->firesale->cache_time);
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
				$cat = ( isset($category['id']) ? $category['id'] : NULL );
				$url = str_replace('/{{ slug }}', '', $this->pyrocache->model('routes_m', 'build_url', array('category', $cat), $this->firesale->cache_time));
				$this->data->pagination = create_pagination($url, $this->categories_m->total_products($cat), $this->perpage, ( 2 + substr_count($url, '/') ));
				$this->data->pagination['shown'] = count($products);
			}

			// Breadcrumbs
			$cats = $this->pyrocache->model('products_m', 'get_cat_path', array($category['id'], true), $this->firesale->cache_time);
			$url  = $this->pyrocache->model('routes_m', 'build_url', array('category', NULL), $this->firesale->cache_time);
			$this->template->set_breadcrumb(lang('firesale:cats_all_products'), $url);
			foreach( $cats as $key => $cat )
			{
				$url = $this->pyrocache->model('routes_m', 'build_url', array('category', $cat['id']), $this->firesale->cache_time);
				$this->template->set_breadcrumb($cat['title'], $url);
			}

			// Assign parent data
			$this->data->parent = ( isset($category['parent']['id']) && $category['parent']['id'] > 0 ? $category['parent']['id'] : $category['id'] );

			// Set category in session
			$this->session->set_userdata('category', $this->data->category['id']);

			// Build Page
			$this->template->title(( $category != NULL ? $this->data->category['title'] : lang('firesale:cats_all_products') ))
						   ->append_css('module::firesale.css')
					       ->append_js('module::firesale.js')
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
		$cookie = array(
			'name'   => 'listing_style',
			'value'  => $type,
			'expire' => '2592000',
			'path'   => '/',
			'prefix' => 'firesale_',
			'secure' => FALSE
		);

		$this->input->set_cookie($cookie);
		
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
			$cookie = array(
				'name'   => 'listing_order',
				'value'  => $type,
				'expire' => '86500',
				'path'   => '/',
				'prefix' => 'firesale_',
				'secure' => FALSE
			);

			$this->input->set_cookie($cookie);
		}

		redirect($_SERVER['HTTP_REFERER']);
	}
    
}
