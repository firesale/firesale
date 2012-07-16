<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Front_product extends Public_Controller {
	
    public $stream;
	
	public function __construct()
    {

        parent::__construct();
		
		// Load libraries
		$this->load->driver('Streams');
		$this->lang->load('firesale');
		$this->load->model('products_m');
		$this->load->model('streams_core/row_m');
		$this->load->library('files/files');

	}
	
	public function index($product)
	{

		// Set query paramaters
		$params	 = array(
					'stream' 	=> 'firesale_products',
					'namespace'	=> 'firesale_products',
					'where'		=> "slug = '{$product}' AND status = 1",
					'limit'		=> '1',
					'order-by'	=> 'id'
				   );
		
		// Get prodct
		$entry = $this->streams->entries->get_entries($params);
		
		if( count($entry['entries']) == 1 )
		{
		
			// General information
			$this->data->product = $entry['entries'][0];
			$this->data->folder  = '/' . UPLOAD_PATH . 'products/' . $this->data->product['id'] . '/';

			// Images
			$folder = $this->products_m->get_file_folder_by_slug($this->data->product['slug']);
			$images = Files::folder_contents($folder->id);
			$this->data->images = $images['data']['file'];

			// Add key for easy limits, main, etc.
			foreach( $this->data->images AS $key => $image )
			{
				$this->data->images[$key]->i = $key;
			}

			// Breadcrumbs
			$cat_tree = $this->products_m->get_cat_path($this->data->product['category']['id'], true);
			$this->template->set_breadcrumb('Home', '/home');
			foreach( $cat_tree as $key => $cat )
			{

				if( $key == 0 )
				{
					$this->data->parent = $cat['id'];
				}

				$this->template->set_breadcrumb($cat['title'], '/category/' . $cat['slug']);
			}

			// Temp
			$this->data->product['description'] = str_replace('[BR]', '<br /><br />', $this->data->product['description']);

			// Fire events
			Events::trigger('product_viewed', $product->id);
		
			// Build Page
			$this->template->set_breadcrumb($this->data->product['title'], '/product/' . $this->data->product['slug'])
						   ->title($this->data->product['title'])
						   ->build('product', $this->data);
	
		}
		else
		{
			set_status_header(404);
			echo Modules::run('pages/_remap', '404');
		}

	}
    
}

