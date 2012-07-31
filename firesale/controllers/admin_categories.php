<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_categories extends Admin_Controller
{

	/**
	 * Contains the tab configuration for the
	 * layout.
	 *
	 * @var array An array of key => array containing
	 * 			  the none-default values that are moved to
	 * 			  other tabs.
	 * @access public
	 */
	public $tabs = array();

	/**
	 * Contains the stream data for the categories
	 * stream for use during get_row and build_form.
	 *
	 * @var object
	 * @access public
	 */
	public $stream  = NULL;

	/**
	 * Loads the parent constructor and gets an
	 * instance of CI. Also loads in the language
	 * files and required models to perform any 
	 * required actions.
	 *
	 * Sets the $stream variable and assigns it
	 * the values of the categories stream from
	 * get_stream.
	 *
	 * @return void
	 * @access public
	 */
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

    /**
     * Builds the default view for the categories
     * management page. Built using streams it also
     * manages all insert/editing of the given
     * category.
     *
     * @param integry $id (Optional) The ID of the category
     *					  to be edited/updated.
     * @access public
     */
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
					  
			if( $id != null ) {
				$input = (object)$input;
				$this->data->input = $input;
			}
		
		}
		else if( $this->input->post('btnAction') == 'delete' )
		{
			$this->delete($this->input->post('id'));
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
		$this->data->cats       =  $this->categories_m->generate_streams_tree($params);
		$this->data->fields     =  $this->products_m->fields_to_tabs($fields, $this->tabs);
		$this->data->tabs	    =  array_reverse(array_keys($this->data->fields));
	
		// Build the page
		$this->template->title(lang('firesale:title') . ' ' . lang('firesale:sections:categories'))
					   ->build('admin/categories/index', $this->data);
	}
	
	/**
	 * Reorders the given categories into parent
	 * and child relationships as well as into a
	 * given order as defined in the ajax drag and
	 * drop in the view. Accepts post data generated
	 * by the javascript libraries on the front-end.
	 *
	 * @access public
	 */
	public function order()
	{

		// Variables
		$order		= $this->input->post('order');
		$data		= $this->input->post('data');
		$root_cats	= isset($data['root_cats']) ? $data['root_cats'] : array();

		if( is_array($order) )
		{
			// Reset all parent > child relations
			$this->categories_m->update_all(array('parent' => 0));

			foreach( $order as $i => $cat )
			{
				// Set the order of the root cats
				$this->categories_m->update_by('id', str_replace('cat_', '', $cat['id']), array('ordering_count' => $i));

				// Iterate through children and set their order and parent
				$this->categories_m->set_children($cat);
			}
	
		}
	
	}
	
	/**
	 * Deletes the given Category
	 * 
	 * @param integer $id The Category ID to delete
	 * @access public
	 */
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
	
	/**
	 * Gets the category details and returns a JSON
	 * array for use in the front-end view editing.
	 *
	 * @param integer $id The Category ID to retrieve
	 * @return string A JSON Object containing the 
	 *				  Category information.
	 * @access public
	 */
	public function ajax_cat_details($id)
	{

		if( $this->input->is_ajax_request() )
		{
			$cat = $this->categories_m->get_category($id);
			echo json_encode($cat);
			exit();
		}
	
	}

	/**
	 * Builds the tree for display on the Category
	 * management page. The string is an HTML list
	 * structure with sub-lists for the children
	 * categories.
	 *
	 * @param array $cat An array containing the current Category details.
	 * @param string $tree (Optional) The current html structure that is being built recursivly.
	 * @param boolean $first (Optional) A boolean to track the first element to echo the output.
	 * @return string The html tree that is being built
	 * @access public
	 */
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
