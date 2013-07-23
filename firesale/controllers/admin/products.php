<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* This file is part of FireSale, a PHP based eCommerce system built for
* PyroCMS.
*
* Copyright (c) 2013 Moltin Ltd.
* http://github.com/firesale/firesale
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*
* @package firesale/core
* @author FireSale <support@getfiresale.org>
* @copyright 2013 Moltin Ltd.
* @version dev
* @link http://github.com/firesale/firesale
*
*/

class products extends Admin_Controller
{

    public $stream  = NULL;
    public $perpage = 30;
    public $section = 'products';
    public $tabs    = array('description' => array('description'),
                            '_modifiers'  => array(),
                            '_images'     => array());

    public function __construct()
    {

        parent::__construct();

        // Add data object
        $this->data = new stdClass;

        // Button events
        Events::trigger('button_build', $this->template);

        // Load libraries, drivers & models
        $this->load->driver('Streams');
        $this->load->model(array(
            'routes_m',
            'products_m',
            'modifier_m',
            'categories_m',
            'taxes_m',
            'streams_core/row_m'
        ));

        $this->load->library('streams_core/fields');
        $this->load->library('files/files');
        $this->load->helper('general');

        // Add metadata
        $this->template->append_css('module::admin/products.css')
                       ->append_js('module::admin/jquery.tablesort.js')
                       ->append_js('module::admin/jquery.metadata.js')
                       ->append_js('module::admin/jquery.tablesort.plugins.js')
                       ->append_js('module::admin/upload.js')
                       ->append_js('module::admin/products.js')
                       ->append_js('module::admin/modifiers.js')
                       ->append_metadata('<script type="text/javascript">' .
                                         "\n  var currency = '".cache('currency_m/get_symbol')."';" .
                                         "\n  var tax_rate = '".cache('taxes_m/get_percentage', 1, 1)."';" .
                                         "\n</script>");

        // Get the stream
        $this->stream = $this->streams->streams->get_stream('firesale_products', 'firesale_products');
    }

    public function index($start = 0)
    {

        // Check for btnAction
        if ( $action = $this->input->post('btnAction') ) {
            $this->$action();
        }

        // Get product IDs
        $products = cache('products_m/get_products', array(), $start, $this->perpage);

        // Build product data
        foreach ($products AS &$product) {
            $product = cache('products_m/get_product', $product['id']);
        }

        // Assign variables
        $this->data->products     = $products;
        $this->data->count        = cache('products_m/get_products', ( isset($filter) ? $filter : array() ), 0, 0);
        $this->data->count        = ( $this->data->count ? count($this->data->count) : 0 );
        $this->data->pagination   = create_pagination('/admin/firesale/products/', $this->data->count, $this->perpage, 4);
        $this->data->categories   = array('-1' => lang('firesale:label_filtersel')) + cache('categories_m/dropdown_values');
        $this->data->status       = cache('products_m/status_dropdown', ( $type == 'status' ? $value : -1 ));
        $this->data->stock_status = cache('products_m/stock_status_dropdown', ( $type == 'stock_status' ? $value : -1 ));
        $this->data->min_max      = cache('products_m/price_min_max');
        $this->data->buttons      = ( $this->template->buttons ? $this->template->buttons : '' );

        // Add page data
        $this->template->title(lang('firesale:title') . ' ' . lang('firesale:sections:products'))
                       ->set($this->data);

        // Fire events
        Events::trigger('page_build', $this->template);

        // Build page
        $this->template->build('admin/products/index');
    }

    public function create($id = NULL, $row = NULL)
    {

        // Variables
        $input = FALSE;
        $skip  = array();
        $extra = array();

        // Check for post data
        if ( substr($this->input->post('btnAction'), 0, 4) == 'save' ) {

            // Variables
            $input  = $this->input->post();
            $skip   = array('btnAction');
            $extra  = array(
                'return'          => FALSE,
                'success_message' => lang('firesale:prod_' . ( $id == NULL ? 'add' : 'edit' ) . '_success'),
                'error_message'   => lang('firesale:prod_' . ( $id == NULL ? 'add' : 'edit' ) . '_error')
            );

            // Editing
            if ($id !== NULL) {

                // Just incase
                Events::trigger('pre_product_updated', $id);
                $input = $this->input->post();

                // Clear out current categories to prevent duplicate db entries
                $input['category'] = $_POST['category'] = $this->products_m->category_fix($id, $input['category']);
            }

        }

        // Get the stream fields
        $fields = $this->fields->build_form($this->stream, ( $id == NULL ? 'new' : 'edit' ), ( $id == NULL ? $input : $row ), FALSE, FALSE, $skip, $extra);

        // Posted
        if ( substr($this->input->post('btnAction'), 0, 4) == 'save' ) {

            // Got an ID back
            if ( is_string($fields) OR is_integer($fields) ) {

                // Assign ID
                $id = $fields;

                // Update image folder?
                if ( ! empty($row) ) {

                    // Update Folder Slug
                    if ($row->slug != $input['slug']) {
                        $this->products_m->update_folder_slug($row->slug, $input['slug']);
                    }

                    // Update variation
                    if ($row->price != $input['price'] ) {
                        $this->modifier_m->edit_price($row, $input['price'], $input['rrp']);
                    }

                    // Fire event
                    $data = array_merge(array('id' => $id, 'stream' => 'firesale_products'), $input);
                    Events::trigger('product_updated', $data);
                }

                // Everything went well, clear cache for front-end update
                Events::trigger('clear_cache');

                // Add to search
                $product = cache('products_m/get_product', $id);
                $this->products_m->search($product, true);

                // Redirect
                redirect('admin/firesale/products'.( $input['btnAction'] != 'save_exit' ? '/edit/'.$id : '' ));
            }

        }

        // Fire build event
        Events::trigger('form_build', $this);

        // Get edit variables
        if ($row) {

            // Add row
            $this->data = $row;

            // Get modifiers and variants
            $this->data->modifiers  = cache('modifier_m/get_modifiers', $row->id);
            $this->data->variations = cache('modifier_m/get_products', $row->id);

            // Get images
            $folder = get_file_folder_by_slug($row->slug, 'product-images');
            $images = Files::folder_contents($folder->id);
            $this->data->images = $images['data']['file'];
        }

        // Assign variables
        $this->data->id     = $id;
        $this->data->fields = fields_to_tabs($fields, $this->tabs);
        $this->data->tabs   = array_keys($this->data->fields);
        $this->data->symbol = cache('currency_m/get_symbol');

        // Add metadata
        $this->template->append_js('module::admin/jquery.filedrop.js')
                       ->append_js('module::admin/upload.js')
                       ->append_metadata($this->load->view('fragments/wysiwyg', NULL, TRUE));

        // Grab all the taxes
        $taxes = cache('taxes_m/taxes_for_currency', 1);

        $tax_string = '<script type="text/javascript">' .
                      "\n var taxes = new Array();\n";

        foreach ($taxes as $tax)
            $tax_string .= "taxes[" . $tax->id . "] = " . $tax->value . ";\n";

        $tax_string .= '</script>';

        $this->template->append_metadata($tax_string);

        // Add page data
        $this->template->title(lang('firesale:title') . ' ' . lang('firesale:prod_title_' . ( $id == NULL ? 'create' : 'edit' )))
                       ->set($this->data)
                       ->enable_parser(true);

        // Fire events
        Events::trigger('page_build', $this->template);

        // Build page
        $this->template->build('admin/products/create');

    }

    public function edit($id)
    {

        // Get row
        if ( $row = cache('row_m/get_row', $id, $this->stream, false) ) {
            // Load form
            $this->create($id, $row);
        } else {
            $this->session->set_flashdata('error', lang('firesale:prod_not_found'));
            redirect('admin/firesale/products/create');
        }

    }

    public function delete($prod_id = null)
    {

        $delete   = true;
        $products = $this->input->post('action_to');

        if ( $this->input->post('btnAction') == 'delete' and ! empty($products) ) {

            for ( $i = 0; $i < count($products); $i++ ) {

                if ( !$this->products_m->delete_product($products[$i]) ) {
                    $delete = false;
                }

                // Remove from search
                if ($delete === true) {
                    $this->products_m->search(array('id' => $products[$i]));
                }

            }

        } elseif ($prod_id !== null) {

            if ( !$this->products_m->delete_product($prod_id) ) {
                $delete = false;
            }

            // Remove from search
            if ($delete === true) {
                $this->products_m->search(array('id' => $prod_id));
            }

        }

        if ($delete) {

            // Deleted, clear cache!
            Events::trigger('clear_cache');

            $this->session->set_flashdata('success', lang('firesale:prod_delete_success'));
        } else {
            $this->session->set_flashdata('error', lang('firesale:prod_delete_error'));
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function modifier($parent, $id = NULL)
    {

        // Variables
        $input  = FALSE;
        $skip   = array();
        $extra  = array();
        $stream = $this->streams->streams->get_stream('firesale_product_modifiers', 'firesale_product_modifiers');

        // Check for post data
        if ( $this->input->post('btnAction') == 'save' ) {

            // Update variables
            $input  = $this->input->post();
            $skip   = array('btnAction');
            $extra  = array(
                'return'          => FALSE,
                'success_message' => lang('firesale:mods:'.( $id == null ? 'create' : 'edit' ).'_success'),
                'error_message'   => lang('firesale:mods:'.( $id == null ? 'create' : 'edit' ).'_error')
            );

            // Add parent to post
            $input['parent'] = $_POST['parent'] = $parent;

        } elseif ( $id != null and $this->input->post('btnAction') == 'delete' ) {

            // Delete
            if ( $this->modifier_m->delete_modifier($id) ) {

                // Deleted, clear cache!
                Events::trigger('clear_cache');

                $this->session->set_userdata('flash:old:success', lang('firesale:mods:delete_success'));
            } else {
                $this->session->set_userdata('flash:old:error', lang('firesale:mods:delete_success'));
            }

            // Send back edit
            unset($_POST);
            $this->edit($parent);
            return;
        }

        // Check for ID
        if ($id != NULL) {
            // Get current row
            $row = cache('row_m/get_row', $id, $stream, false);

            // Update parent in post
            $input['parent'] = $_POST['parent'] = $row->parent;
        }

        // Get the stream fields
        $fields = $this->fields->build_form($stream, ( $id == NULL ? 'new' : 'edit' ), ( $id == NULL ? $input : $row ), FALSE, FALSE, $skip, $extra);

        // Check for success
        if ( is_string($fields) OR is_integer($fields) ) {

            // Good news everyone, clear cache!
            Events::trigger('clear_cache');

            // Set flashdata
            $this->session->set_userdata('flash:old:success', $extra['success_message']);

            // Send back edit
            unset($_POST);
            $this->edit($parent);
            return;
        } else {
            $this->session->set_userdata('flash:old:error', $extra['error_message']);
        }

        // Format streams fields
        foreach ( $fields as $key => $value ) {
            if ( $value['input_slug'] == 'parent' ) {
                unset($fields[$key]);
                break;
            }
        }

        // Assign variables
        $this->data->id     = $id;
        $this->data->fields = $fields;
        $this->data->parent = $parent;

        // Add page data
        $this->template->set_layout(false)
                       ->set($this->data)
                       ->build('admin/products/modifier');

    }

    public function variation($parent, $id = NULL)
    {

        // Variables
        $input  = FALSE;
        $skip   = array();
        $extra  = array();
        $stream = $this->streams->streams->get_stream('firesale_product_variations', 'firesale_product_variations');
        $parent = $this->db->where('id', $parent)->get('firesale_product_modifiers')->row();

        // Check for post data
        if ( $this->input->post('btnAction') == 'save' ) {

            // Update variables
            $input = $this->input->post();
            $skip  = array('btnAction');
            $extra = array(
                'return'          => FALSE,
                'success_message' => lang('firesale:vars:'.( $id == null ? 'create' : 'edit' ).'_success'),
                'error_message'   => lang('firesale:vars:'.( $id == null ? 'create' : 'edit' ).'_error')
            );

            // Add parent to post
            $input['parent'] = $_POST['parent'] = $parent->id;

        } elseif ( $id != null and $this->input->post('btnAction') == 'delete' ) {

            // Delete
            if ( $this->modifier_m->delete_variation($id) ) {

                // Deleted, clear cache!
                Events::trigger('clear_cache');

                $this->session->set_userdata('flash:old:success', lang('firesale:vars:delete_success'));
            } else {
                $this->session->set_userdata('flash:old:error', lang('firesale:vars:delete_success'));
            }

            // Send back edit
            unset($_POST);
            $this->edit($parent->parent);
            return;
        }

        // Check for ID
        if ($id != NULL) {
            // Get current row
            $row = cache('row_m/get_row', $id, $stream, false);

            // Update parent in post
            $input['parent'] = $_POST['parent'] = $row->parent;
        }

        // Get the stream fields
        $fields = $this->fields->build_form($stream, ( $id == NULL ? 'new' : 'edit' ), ( $id == NULL ? $input : $row ), FALSE, FALSE, $skip, $extra);

        // Check for success
        if ( is_string($fields) OR is_integer($fields) ) {

            // If we're in creation mode
            if ($id == NULL and $parent->type == '1') {
                // Check for variant type
                $this->modifier_m->build_variations($parent->parent, $stream);
            } elseif ($id != NULL) {
                // Update the products for this option
                $this->modifier_m->edit_variations($row, $input);
            }

            // Updated, clear cache!
            Events::trigger('clear_cache');

            // Set flashdata
            $this->session->set_userdata('flash:old:success', $extra['success_message']);

            // Send back edit
            unset($_POST);
            $this->edit($parent->parent);
            return;
        } else {
            $this->session->set_userdata('flash:old:error', $extra['error_message']);
        }

        // Format streams fields
        unset($fields[2]);
        if ($parent->type != '3') {
            unset($fields[3]);
        }

        // Assign variables
        $this->data->id     = $id;
        $this->data->fields = $fields;
        $this->data->parent = $parent;

        // Add page data
        $this->template->set_layout(false)
                       ->set($this->data)
                       ->build('admin/products/variation');
    }

    public function duplicate($prod_id = 0 )
    {

        $duplicate = true;
        $products  = $this->input->post('action_to');
        $latest    = 0;

        if ( $this->input->post('btnAction') == 'duplicate' and ! empty($products) ) {

            for ( $i = 0; $i < count($products); $i++ ) {

                if ( !$latest = $this->products_m->duplicate_product($products[$i]) ) {
                    $duplicate = false;
                }

            }

        } elseif ($prod_id !== null) {

            if ( !$latest = $this->products_m->duplicate_product($prod_id) ) {
                $duplicate = false;
            }

        }

        if ($duplicate) {

            // Updated, clear cache!
            Events::trigger('clear_cache');

            $this->session->set_flashdata('success', lang('firesale:prod_duplicate_success'));
        } else {
            $this->session->set_flashdata('error', lang('firesale:prod_duplicate_error'));
        }

        if ( ( $prod_id !== NULL OR count($products) == 1 ) AND $latest != 0 ) {
            redirect('admin/firesale/products/edit/' . $latest);
        } else {
            redirect('admin/firesale/products');
        }

    }

    public function upload($id)
    {

        // Get product
        $row    = cache('row_m/get_row', $id, $this->stream, false);
        $folder = get_file_folder_by_slug($row->slug, 'product-images');
        $allow  = array('jpeg', 'jpg', 'png', 'gif', 'bmp');

        // Create folder?
        if (!$folder) {
            $parent = get_file_folder_by_slug('product-images');
            $folder = $this->products_m->create_file_folder($parent->id, $row->title, $row->slug);
            $folder = (object)$folder['data'];
        }

        // Check for folder
        if ( is_object($folder) and ! empty($folder) ) {

            // Upload it
            $status = Files::upload($folder->id);

            // Success
            if ( $status['status'] == true ) {

                // Order images
                $count = $this->db->where('folder_id', $folder->id)->get('files')->num_rows();
                $this->db->where('id', $status['data']['id'])->update('files', array('sort' => ( $count - 1 )));

                // Make image square
                if ( $this->settings->get('image_square') == 1 ) {
                    $this->products_m->make_square($status, $allow);
                }
            }

            // Updated, clear cache!
            Events::trigger('clear_cache');

            // Ajax status
            echo json_encode(array('status' => (bool)$status['status'], 'message' => $status['message']));
            exit;
        }

        // Seems it was unsuccessful
        echo json_encode(array('status' => FALSE, 'message' => 'Error uploading image'));
        exit();
    }

    public function delete_image($id)
    {

        // Delete file
        if ( Files::delete_file($id) ) {

            // Deleted, clear cache!
            Events::trigger('clear_cache');

            // Success
            $this->session->set_flashdata('success', lang('firesale:prod_delimg_success'));
        } else {
            // Error
            $this->session->set_flashdata('error', lang('firesale:prod_delimg_error'));
        }

        // Redirect
        redirect($_SERVER['HTTP_REFERER']."#images");
    }

}
