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
* @package firesale/brands
* @author FireSale <support@getfiresale.org>
* @copyright 2013 Moltin Ltd.
* @version master
* @link http://github.com/firesale/firesale
*
*/

class admin extends Admin_Controller
{

    public $section = 'brands';
    public $tabs	= array('_images' => array());

    public function __construct()
    {

        parent::__construct();

        // Load libraries, drivers & models
        $this->load->driver('Streams');
        $this->load->library('files/files');
        $this->load->model('firesale/products_m');
        $this->load->helper('firesale/general');

        // Initialise data
        $this->data = new stdClass();

        // Get the stream
        $this->stream = $this->streams->streams->get_stream('firesale_brands', 'firesale_brands');

        // Add metadata
        $this->template->append_css('module::brands.css')
                       ->append_js('module::jquery.filedrop.js')
                       ->append_js('module::upload.js')
                       ->append_js('module::brands.js');

    }

    public function index()
    {

        // Check for btnAction
        if( $action = $this->input->post('btnAction') ) {
            $this->$action();
        }

        // Variables
        $params = array(
            'stream'       => 'firesale_brands',
            'namespace'    => 'firesale_brands',
            'paginate'     => 'yes',
            'page_segment' => 4
        );

        // Assign brands
        $this->data->brands = $this->streams->entries->get_entries($params);

        // Add images
        foreach( $this->data->brands['entries'] AS &$brand ) {

            // Assign images
            $folder = get_file_folder_by_slug($brand['slug'], 'brand-images');
            $images = Files::folder_contents($folder->id);
            $brand['image'] = $images['data']['file'][0];

            // Assign categories
            $brand['categories'] = $this->pyrocache->model('brands_m', 'get_categories', array($brand['id']), $this->firesale->cache_time);
        }

        // Add page data
        $this->template->title(lang('firesale:title') . ' ' . lang('firesale:sections:brands'))
                       ->set($this->data);

        // Fire events
        Events::trigger('page_build', $this->template);

        // Build page
        $this->template->build('admin/index');

    }

    public function create()
    {

        // Variables
        $input  = $this->input->post();
        $skip   = array('btnAction');
        $return = ( $this->input->post('btnAction') == 'save_exit' ? 'admin/firesale_brands' : 'admin/firesale_brands/edit/-id-' );
        $extra  = array(
            'return'          => $return,
            'success_message' => lang('firesale:brands:add_success'),
            'failure_message' => lang('firesale:brands:add_error'),
            'title'           => lang('firesale:brands:new')
        );

        // Build the form
        $fields = $this->fields->build_form($this->stream, 'new', $input, false, false, $skip, $extra);

        // Fire build event
        Events::trigger('form_build', $this);

        // Assign data
        $this->data->fields = fields_to_tabs($fields, $this->tabs);
        $this->data->tabs	= array_keys($this->data->fields);

        // Build the template
        $this->template->title(lang('firesale:title').' '.lang('firesale:brands:new'))
                       ->set($this->data);

        // Fire events
        Events::trigger('page_build', $this->template);

        // Build the page
        $this->template->build('admin/create');
    }

    public function edit($id)
    {

        // Variables
        $row    = $this->row_m->get_row($id, $this->stream, false);
        $input  = $this->input->post();
        $skip   = array('btnAction');
        $return = ( $this->input->post('btnAction') == 'save_exit' ? 'admin/firesale_brands' : 'admin/firesale_brands/edit/-id-' );
        $extra  = array(
            'return'          => $return,
            'success_message' => lang('firesale:brands:edit_success'),
            'failure_message' => lang('firesale:brands:edit_error'),
            'title'           => lang('firesale:brands:edit')
        );

        // Not found
        if( empty($row) ) {
            $this->session->set_flashdata('error', lang('firesale:brands:not_found'));
            redirect('admin/firesale_brands/create');
        }

        // Build the form
        $fields = $this->fields->build_form($this->stream, 'edit', $row, false, false, $skip, $extra);

        // Fire build event
        Events::trigger('form_build', $this);

        // Assign data
        $this->data->id     = $row->id;
        $this->data->row    = $row;
        $this->data->fields = fields_to_tabs($fields, $this->tabs);
        $this->data->tabs	= array_keys($this->data->fields);

        // Assign images
        $folder = get_file_folder_by_slug($row->slug, 'brand-images');
        $images = Files::folder_contents($folder->id);
        $this->data->images = $images['data']['file'];

        // Build the template
        $this->template->title(lang('firesale:title').' '.sprintf(lang('firesale:brands:edit'), $row->title))
                       ->enable_parser(true)
                       ->set($this->data);

        // Fire events
        Events::trigger('page_build', $this->template);

        // Build the page
        $this->template->build('admin/edit');
    }

    public function upload($id)
    {

        // Get product
        $row    = $this->row_m->get_row($id, $this->stream, FALSE);
        $folder = get_file_folder_by_slug($row->slug, 'brand-images');
        $allow  = array('jpeg', 'jpg', 'png', 'gif', 'bmp');

        // Create folder?
        if( !$folder ) {
            $parent = get_file_folder_by_slug('brand-images');
            $folder = $this->products_m->create_file_folder($parent->id, $row->title, $row->slug);
            $folder = (object)$folder['data'];
        }

        // Check for folder
        if( is_object($folder) AND ! empty($folder) ) {

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

            // Ajax status
            echo json_encode(array('status' => $status['status'], 'message' => $status['message']));
            exit;
        }

        // Seems it was unsuccessful
        echo json_encode(array('status' => FALSE, 'message' => 'Error uploading image'));
        exit();
    }

    public function delete($id = NULL)
    {

        // Variables
        $success = TRUE;

        // Check for array
        if( $id != NULL ) {
            $brands = array($id);
        } else {
            $brands = $this->input->post('action_to');
        }

        // Loop brands
        foreach( $brands AS $id ) {

            // Get brand
            $query = $this->db->where('id', $id)->get('firesale_brands');

            // Check it exists
            if( $query->num_rows() ) {

                // Get the brand
                $brand = current($query->result_array());

                // Update products using this brand
                $this->db->where('brand', $id)->update('firesale_products', array('brand' => NULL));

                // Remove images
                $folder = get_file_folder_by_slug($brand['slug'], 'brand-images');
                if( $folder != FALSE ) {

                    // Get files in folder
                    $files = Files::folder_contents($folder->id);
                    foreach( $files['data']['file'] AS $file ) {
                        Files::delete_file($file->id);
                    }

                    // Delete folder
                    Files::delete_folder($folder->id);
                }

                // Delete the brand
                if( ! $this->db->where('id', $id)->delete('firesale_brands') ) {
                    $success = FALSE;
                }

            }

        }

        // Result
        if( $success ) {
            $this->session->set_flashdata('success', lang('firesale:brands:delete_success'));
        } else {
            $this->session->set_flashdata('error', lang('firesale:brands:delete_error'));
        }

        // Send back to page
        redirect('admin/firesale_brands');
    }

}
