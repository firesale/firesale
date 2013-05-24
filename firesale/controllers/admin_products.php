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
* @version master
* @link http://github.com/firesale/firesale
*
*/

class Admin_products extends Admin_Controller
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
        $this->template->append_css('module::products.css')
                       ->append_js('module::jquery.tablesort.js')
                       ->append_js('module::jquery.metadata.js')
                       ->append_js('module::jquery.tablesort.plugins.js')
                       ->append_js('module::upload.js')
                       ->append_js('module::products.js')
                       ->append_js('module::modifiers.js')
                       ->append_metadata('<script type="text/javascript">' .
                                         "\n  var currency = '" . $this->pyrocache->model('currency_m', 'get_symbol', array(), $this->firesale->cache_time) . "';" .
                                         "\n  var tax_rate = '" . $this->pyrocache->model('taxes_m', 'get_percentage', array(1, 1), $this->firesale->cache_time) . "';" .
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
        $products = $this->pyrocache->model('products_m', 'get_products', array(array(), $start, $this->perpage), $this->firesale->cache_time);

        // Build product data
        foreach ($products AS &$product) {
            $product = $this->pyrocache->model('products_m', 'get_product', array($product['id']), $this->firesale->cache_time);
        }

        // Assign variables
        $this->data->products     = $products;
        $this->data->count        = $this->pyrocache->model('products_m', 'get_products', array(( isset($filter) ? $filter : array() ), 0, 0), $this->firesale->cache_time);
        $this->data->count        = ( $this->data->count ? count($this->data->count) : 0 );
        $this->data->pagination   = create_pagination('/admin/firesale/products/', $this->data->count, $this->perpage, 4);
        $this->data->categories   = array('-1' => lang('firesale:label_filtersel')) + $this->pyrocache->model('categories_m', 'dropdown_values', array(), $this->firesale->cache_time);
        $this->data->status       = $this->pyrocache->model('products_m', 'status_dropdown', array(( $type == 'status' ? $value : -1 )), $this->firesale->cache_time);
        $this->data->stock_status = $this->pyrocache->model('products_m', 'stock_status_dropdown', array(( $type == 'stock_status' ? $value : -1 )), $this->firesale->cache_time);
        $this->data->min_max      = $this->pyrocache->model('products_m', 'price_min_max', array(), $this->firesale->cache_time);
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
                $product = $this->pyrocache->model('products_m', 'get_product', array($id), $this->firesale->cache_time);
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
            $this->data->modifiers  = $this->pyrocache->model('modifier_m', 'get_modifiers', array($row->id), $this->firesale->cache_time);
            $this->data->variations = $this->pyrocache->model('modifier_m', 'get_products', array($row->id), $this->firesale->cache_time);

            // Get images
            $folder = get_file_folder_by_slug($row->slug, 'product-images');
            $images = Files::folder_contents($folder->id);
            $this->data->images = $images['data']['file'];
        }

        // Assign variables
        $this->data->id     = $id;
        $this->data->fields = fields_to_tabs($fields, $this->tabs);
        $this->data->tabs   = array_keys($this->data->fields);
        $this->data->symbol = $this->pyrocache->model('currency_m', 'get_symbol', array(), $this->firesale->cache_time);

        // Add metadata
        $this->template->append_js('module::jquery.filedrop.js')
                       ->append_js('module::upload.js')
                       ->append_metadata($this->load->view('fragments/wysiwyg', NULL, TRUE));

        // Grab all the taxes
        $taxes = $this->pyrocache->model('taxes_m', 'taxes_for_currency', array(1), $this->firesale->cache_time);

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
        if ( $row = $this->pyrocache->model('row_m', 'get_row', array($id, $this->stream, FALSE), $this->firesale->cache_time) ) {
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

                if ( !$this->pyrocache->model('products_m', 'delete_product', array($products[$i]), $this->firesale->cache_time) ) {
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
            $row = $this->pyrocache->model('row_m', 'get_row', array($id, $stream, FALSE), $this->firesale->cache_time);

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
            if ( $this->pyrocache->model('modifier_m', 'delete_variation', array($id), $this->firesale->cache_time) ) {

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
            $row = $this->pyrocache->model('row_m', 'get_row', array($id, $stream, FALSE), $this->firesale->cache_time);

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

                if ( !$latest = $this->pyrocache->model('products_m', 'duplicate_product', array($products[$i]), $this->firesale->cache_time) ) {
                    $duplicate = false;
                }

            }

        } elseif ($prod_id !== null) {

            if ( !$latest = $this->pyrocache->model('products_m', 'duplicate_product', array($prod_id), $this->firesale->cache_time) ) {
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
        $row    = $this->pyrocache->model('row_m', 'get_row', array($id, $this->stream, FALSE), $this->firesale->cache_time);
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
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function ajax_quick_edit()
    {

        // Ajax only, sorry
        if ( $this->input->is_ajax_request() ) {

            // Variables
            $update = true;
            $start  = $this->input->post('start');
            $post   = $this->input->post('product');

            // Check action
            if ( $this->input->post('btnAction') == 'save' ) {

                // Check products are set
                if ( $post and ! empty($post) ) {
                    // Loop products
                    foreach ( $this->input->post('product') as $id => $product ) {
                        // Update products
                        if ( ! $this->products_m->update_product($id, $product, $this->stream->id, true) ) {
                            $update = false;
                        }
                    }
                }

                // Set flashdata
                if ( $update ) {
                    $this->session->set_flashdata('success', lang('firesale:prod_edit_success'));
                } else {
                    $this->session->set_flashdata('error', lang('firesale:prod_edit_error'));
                }
            }

            // Clear cache
            Events::trigger('clear_cache');

            // Clear post
            unset($_POST);

            // Call index for layout update
            echo ( $update ? 'ok' : 'error' );
        }

    }

    public function ajax_product($id)
    {
        if ( $this->input->is_ajax_request() ) {
            echo json_encode($this->pyrocache->model('products_m', 'get_product', array($id), $this->firesale->cache_time));
            exit();
        }
    }

    public function ajax_order_images()
    {

        if ( $this->input->is_ajax_request() ) {

            $order = $this->input->post('order');

            if ( strlen($order) > 0 ) {

                $order = explode(',', $order);

                for ( $i = 0; $i < count($order); $i++ ) {
                    $this->db->where('id', $order[$i])->update('files', array('sort' => $i));
                }

                // Updated, clear cache!
                Events::trigger('clear_cache');

                echo 'ok';
                exit();
            }

        }

        echo 'error';
        exit();
    }

    public function ajax_order_modifiers()
    {

        if ( $this->input->is_ajax_request() ) {
            echo order_table($this->input->post('order'), 'firesale_product_modifiers', 'mod_');
            exit();
        }

        echo 'error';
        exit();
    }

    public function ajax_order_variations()
    {

        if ( $this->input->is_ajax_request() ) {
            echo order_table($this->input->post('order'), 'firesale_product_variations', 'var_');
            exit();
        }

        echo 'error';
        exit();
    }

    public function ajax_filter($page)
    {
        if ( $this->input->is_ajax_request() ) {

            // Variables
            $data  = array('products' => array(), 'pagination' => '');
            $start = ( isset($_POST['start']) ? $_POST['start'] : $page );
            $start = ( $start > 0 ? ( $start - 1 ) * $this->perpage : 0 );

            unset($_POST['start']);

            // Get filtered product IDs
            $data['count'] = $this->pyrocache->model('products_m', 'get_products', array($this->input->post()), $this->firesale->cache_time);
            $products      = $this->pyrocache->model('products_m', 'get_products', array($this->input->post(), $start, $this->perpage), $this->firesale->cache_time);

            // Get product data
            foreach ( $products as $product ) {
                $data['products'][] = $this->pyrocache->model('products_m', 'get_product', array($product['id']), $this->firesale->cache_time);
            }

            // Assign data
            $data['count']      = ( $data['count'] ? count($data['count']) : 0 );
            $data['pagination'] = create_pagination('admin/firesale/products/', $data['count'], $this->perpage, 4);

            // Build page
            $this->template->set_layout(false)->set($data)->build('admin/products/index');
        }
    }

}
