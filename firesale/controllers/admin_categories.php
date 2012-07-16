<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_categories extends Admin_Controller
{

	public $tabs	= array();
	public $stream  = NULL;

    public function __construct()
    {
        parent::__construct();
	
		// Load libraries
		$this->load->language('firesale');
		$this->load->model('categories_m');
		$this->load->model('products_m');
		
		// Add metadata
		$this->template->append_css('module::categories.css')
					   ->append_js('module::jquery.ui.nestedSortable.js')
					   ->append_js('module::categories.js');
	
		// Get the stream
		$this->stream = $this->streams->streams->get_stream('firesale_categories', 'firesale_categories');

    }

	public function index($id = 0)
	{
	
		// Check for post data
		if( $this->input->post('btnAction') == 'save' )
		{
	
			// Variables
			$input 	= $this->input->post();
			$id     = ( $input['id'] > 0 ? $input['id'] : $id );
			$skip	= array('btnAction');
			$extra 	= array(
						'return' 			=> '/admin/firesale/categories',
						'success_message'	=> lang('firesale:cats_' . ( $id == NULL ? 'add' : 'edit' ) . '_success'),
						'error_message'		=> lang('firesale:cats_' . ( $id == NULL ? 'add' : 'edit' ) . '_error')
					  );
					  
			if( $id != null ) { $input = (object)$input; }
		
		}
		else
		{
			$input = FALSE;
			$skip  = array();
			$extra = array();
		}
	
		// Get the stream fields
		$fields = $this->fields->build_form($this->stream, ( $id == NULL ? 'new' : 'edit' ), $input, FALSE, FALSE, $skip, $extra);
	
		// Set query paramaters
		$params	= array(
					'stream' 	=> 'firesale_categories',
					'namespace'	=> 'firesale_categories',
					'order_by'	=> 'ordering_count',
					'sort'		=> 'asc'
				  );

		// Assign variables
		$this->data->controller =& $this;
		$this->data->cats       =  $this->categories_m->generate_streams_tree($params, 0);
		$this->data->fields     =  $this->products_m->fields_to_tabs($fields, $this->tabs);
		$this->data->tabs		=  array_reverse(array_keys($this->data->fields));
	
		// Build the page
		$this->template->title(lang('firesale:title') . ' ' . lang('firesale:sections:categories'))
					   ->build('admin/categories/index', $this->data);
	}
	
	public function order()
	{

		$order		= $this->input->post('order');
		$data		= $this->input->post('data');
		$root_cats	= isset($data['root_cats']) ? $data['root_cats'] : array();

		if( is_array($order) )
		{
			//reset all parent > child relations
			$this->categories_m->update_all(array('parent' => 0));

			foreach( $order as $i => $cat )
			{
				//set the order of the root cats
				$this->categories_m->update_by('id', str_replace('cat_', '', $cat['id']), array('ordering_count' => $i));

				//iterate through children and set their order and parent
				$this->categories_m->set_children($cat);
			}
	
		}
	
	}
	
	public function delete($id)
	{
	
		$delete = $this->categories_m->delete($id);
		
		if( $delete )
		{
			$this->session->set_flashdata('success', lang('firesale:cats_delete_success'));
		}
		else
		{
			$this->session->set_flashdata('error', lang('firesale:cats_delete_error'));
		}
		
		redirect('admin/firesale/categories');
	
	}
	
	public function ajax_cat_details($id)
	{

		if( $this->input->is_ajax_request() )
		{
			$cat = $this->categories_m->get_category_by_id($id);
			echo json_encode($cat);
			exit();
		}
	
	}

	public function tree_builder($cat, $tree = '', $first = true)
	{

		// Variables
		if( isset($cat['children']) )
		{

			foreach($cat['children'] as $cat)
			{

				$tree .= '<li id="cat_' . $cat['id'] . '">' . "\n";
				$tree .= '  <div>' . "\n";
				$tree .= '    <a href="#" rel="' . $cat['id'] . '">' . $cat['title'] . '</a>' . "\n";
				$tree .= '  </div>' . "\n";

				if( isset($cat['children']) )
				{

					$tree .= '  <ul>' . "\n";
					$tree  = $this->tree_builder($cat, $tree, false);
					$tree .= '  </ul>' . "\n";
					$tree .= '</li>' . "\n";
				}

				$tree .= '</li>' . "\n";
			}

		}

		// Return or echo
		if( !$first )
		{
			return $tree;
		}	
		else
		{
			echo $tree;
		}

	}

}
