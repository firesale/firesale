<<<<<<< HEAD
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Front_product extends Public_Controller {
	
	public function __construct()
    {

        parent::__construct();
		
		// Load libraries
		$this->load->driver('Streams');
		$this->lang->load('firesale');
		$this->load->model('categories_m');
		$this->load->model('products_m');
		$this->load->model('streams_core/row_m');
		$this->load->library('files/files');

	}
	
	public function index($product)
	{

		// Get the product
		$product = $this->products_m->get_product($product);
		
		// Check it exists
		if( $product !== FALSE )
		{
		
			// General information
			$this->data->product  = $product;
			$this->data->category = $this->products_m->get_category($product);
			$this->data->folder   = '/' . UPLOAD_PATH . 'products/' . $this->data->product['id'] . '/';

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
			$cat_tree = $this->products_m->get_cat_path($this->data->category, true);
			$this->template->set_breadcrumb('Home', 'home');
			foreach( $cat_tree as $key => $cat )
			{
				if( $key == 0 ) { $this->data->parent = $cat['id']; }
				$this->template->set_breadcrumb($cat['title'], 'category/' . $cat['slug']);
			}
		
			// Build Page
			$this->template->set_breadcrumb($this->data->product['title'], 'product/' . $this->data->product['slug'])
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
			set_status_header(404);
			echo Modules::run('pages/_remap', '404');
		}

	}
    
=======
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

	}
	
	public function index($product)
	{

		// Get the product
		$product = $this->products_m->get_product($product);
		
		// Check it exists
		if( $product !== FALSE )
		{
		
			// General information
			$this->data->product  = $product;
			$this->data->category = $this->products_m->get_category($product);
			$this->data->folder   = '/' . UPLOAD_PATH . 'products/' . $this->data->product['id'] . '/';

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
			$cat_tree = $this->products_m->get_cat_path($this->data->category, true);
			foreach( $cat_tree as $key => $cat )
			{
				if( $key == 0 ) { $this->data->parent = $cat['id']; }
				$this->template->set_breadcrumb($cat['title'], $this->routes_m->build_url('category', $cat['id']));
			}
		
			// Build Page
			$this->template->set_breadcrumb($this->data->product['title'], $this->routes_m->build_url('product', $this->data->product['id']))
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
			set_status_header(404);
			echo Modules::run('pages/_remap', '404');
		}

	}
    
>>>>>>> b3ad7d60c53e6b8bfe87b745fbff9d858f5c222f
}
