<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Product controller
 *
 * @author		Jamie Holdroyd
 * @author		Chris Harvey
 * @package		FireSale\Core\Controllers
 *
 */
class Front_product extends Public_Controller {
	
	public function __construct()
    {

        parent::__construct();
		
		// Load libraries
		$this->load->driver('Streams');
		$this->lang->load('firesale');
		$this->load->model('categories_m');
		$this->load->model('products_m');
		$this->load->model('routes_m');
		$this->load->model('streams_core/row_m');
		$this->load->library('files/files');

		// Assign data object
		$this->data = new stdClass;

	}
	
	public function index($product)
	{

		// Get the product
		$product = $this->pyrocache->model('products_m', 'get_product', array($product), $this->firesale->cache_time);
		
		// Check it exists
		if( $product !== FALSE )
		{
		
			// General information
			$this->data->product  = $product;
			$this->data->category = $this->pyrocache->model('products_m', 'get_category', array($product), $this->firesale->cache_time);

			// Fire event
			Events::trigger('product_viewed', array('id' => $product['id']));

			// Images
			$folder = $this->products_m->get_file_folder_by_slug($product['slug']);
			$images = Files::folder_contents($folder->id);
			$this->data->images = $images['data']['file'];

			// Add key for easy limits, main, etc.
			foreach( $this->data->images AS $key => $image )
			{
				$this->data->images[$key]->position = $key;
			}

			// Breadcrumbs
			$cats = $this->pyrocache->model('products_m', 'get_cat_path', array($this->data->category, true), $this->firesale->cache_time);
			foreach( $cats as $key => $cat )
			{
				if( $key == 0 ) { $this->data->parent = $cat['id']; }
				$url = $this->pyrocache->model('routes_m', 'build_url', array('category', $cat['id']), $this->firesale->cache_time);
				$this->template->set_breadcrumb($cat['title'], $url);
			}

			// Build page URL
			$url = $this->pyrocache->model('routes_m', 'build_url', array('product', $this->data->product['id']), $this->firesale->cache_time);
		
			// Build Page
			$this->template->set_breadcrumb($this->data->product['title'], $url)
						   ->append_css('module::firesale.css')
					   	   ->append_js('module::firesale.js')
						   ->title($this->data->product['title'])
						   ->set($this->data);

			// Fire events
			Events::trigger('page_build', $this->template);

			// Build page
			$this->template->build('product');
	
		}
		else
		{
			show_404();
		}

	}
    
}
