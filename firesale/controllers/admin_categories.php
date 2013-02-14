<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Categories admin controller
 *
 * @author		Jamie Holdroyd
 * @author		Chris Harvey
 * @package		FireSale\Core\Controllers
 *
 */
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

    public $section = 'categories';

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
        $this->load->library('files/files');
        $this->load->model('categories_m');
        $this->load->model('products_m');
        $this->load->helper('general');

        // Add data object
        $this->data = new stdClass;

        // Add metadata
        $this->template->append_css('module::categories.css')
                       ->append_js('module::jquery.ui.nestedSortable.js')
                       ->append_js('module::jquery.filedrop.js')
                       ->append_js('module::upload.js')
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
        if ( $this->input->post('btnAction') == 'save' ) {

            // Variables
            $input 	= $this->input->post();
            $id     = ( $input['id'] > 0 ? $input['id'] : $id );
            $skip	= array('btnAction');
            $extra 	= array(
                        'return' 			=> '/admin/firesale/categories',
                        'success_message'	=> lang('firesale:cats_' . ( $id == NULL ? 'add' : 'edit' ) . '_success'),
                        'error_message'		=> lang('firesale:cats_' . ( $id == NULL ? 'add' : 'edit' ) . '_error')
                      );

            // Assign input
            if ($id != null) {
                $input             = (object) $input;
                $this->data->input = $input;
            }

            $input->parent = ( $_POST['parent'] == null ? '0' : $_POST['parent'] );
            $_POST['parent'] = $input->parent;

            Events::trigger('clear_cache');

        } elseif ( $this->input->post('btnAction') == 'delete' ) {
            $this->delete($this->input->post('id'));
        } else {
            $input = FALSE;
            $skip  = array();
            $extra = array();
        }

        // Get the stream fields
        $fields = $this->fields->build_form($this->stream, ( $id == NULL ? 'new' : 'edit' ), $input, FALSE, FALSE, $skip, $extra);

        if ( is_string($fields) OR is_integer($fields) ) {
            // Success, clear cache!
            Events::trigger('clear_cache');
        }

        // Set query paramaters
        $params	= array(
                    'stream' 	=> 'firesale_categories',
                    'namespace'	=> 'firesale_categories',
                    'order_by'	=> 'ordering_count',
                    'sort'		=> 'asc'
                  );

        // Fire build event
        Events::trigger('form_build', $this);

        // Assign variables
        $this->data->controller = $this;
        $this->data->cats       = $this->categories_m->generate_streams_tree($params);
        $this->data->fields     = fields_to_tabs($fields, $this->tabs);
        $this->data->tabs	    = array_keys($this->data->fields);

        // Add page data
        $this->template->title(lang('firesale:title') . ' ' . lang('firesale:sections:categories'))
                       ->set($this->data)
                       ->enable_parser(true);

        // Fire events
        Events::trigger('page_build', $this->template);

        // Build the page
        $this->template->build('admin/categories/index');
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

        if ( is_array($order) ) {
            // Reset all parent > child relations
            $this->categories_m->update_all(array('parent' => 0));

            foreach ($order as $i => $cat) {
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

        if ($delete) {

            // Success, clear cache!
            Events::trigger('clear_cache');

            $this->session->set_flashdata('success', lang('firesale:cats_delete_success'));
        } else {
            $this->session->set_flashdata('error', lang('firesale:cats_delete_error'));
        }

        redirect('admin/firesale/categories');
    }

    public function upload($id)
    {

        // Get product
        $row    = $this->row_m->get_row($id, $this->stream, FALSE);
        $folder = $this->products_m->get_file_folder_by_slug($row->slug);
        $allow  = array('jpeg', 'jpg', 'png', 'gif', 'bmp');

        // Create folder?
        if (!$folder) {
            $parent = $this->products_m->get_file_folder_by_slug('category-images');
            $folder = $this->products_m->create_file_folder($parent->id, $row->title, $row->slug);
            $folder = (object) $folder['data'];
        }

        // Check for folder
        if ( is_object($folder) AND ! empty($folder) ) {

            // Upload it
            $status = Files::upload($folder->id);

            // Make square?
            if ( $status['status'] == TRUE AND $this->settings->get('image_square') == 1 ) {
                $this->products_m->make_square($status, $allow);
            }

            // Success, clear cache!
            Events::trigger('clear_cache');

            // Ajax status
            echo json_encode(array('status' => $status['status'], 'message' => $status['message']));
            exit;
        }

        // Seems it was unsuccessful
        echo json_encode(array('status' => FALSE, 'message' => 'Error uploading image'));
        exit();
    }

    /**
     * Gets the category details and returns a JSON
     * array for use in the front-end view editing.
     *
     * @param  integer $id The Category ID to retrieve
     * @return string  A JSON Object containing the
     *				  Category information.
     * @access public
     */
    public function ajax_cat_details($id)
    {

        if ( $this->input->is_ajax_request() ) {
            $cat = $this->categories_m->get_category($id);
            echo json_encode($cat);
            exit();
        }

    }

    /**
     * Gets the category images and returns an HTML string to be appended into the
     * tab created for each category.
     *
     * @param  integer $id The Category ID to retrieve
     * @return string  HTML for dropbox and image display
     * @access public
     */
    public function ajax_cat_images($id)
    {

        if ( $this->input->is_ajax_request() ) {

            // Variables
            $data = array();
            $row  = $this->row_m->get_row($id, $this->stream, FALSE);

            if ($row != FALSE) {
                $folder = $this->products_m->get_file_folder_by_slug($row->slug);
                $images = Files::folder_contents($folder->id);
                $data['images'] = $images['data']['file'];
            }

            // Return to script
            echo $this->parser->parse('admin/categories/images', $data, true);
            exit();
        }

    }

}
