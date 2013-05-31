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

class Admin_routes extends Admin_Controller
{

    public $section = 'routes';

    public function __construct()
    {

        parent::__construct();

        // Does the user have access?
        role_or_die('firesale', 'access_routes');

        // Load libraries, drivers & models
        $this->load->driver('Streams');
        $this->load->model('routes_m');
        $this->load->helper('general');

        // Initialise data
        $this->data = new stdClass();

        // Get the stream
        $this->stream = $this->streams->streams->get_stream('firesale_routes', 'firesale_routes');

    }

    public function index()
    {

        // Variables
        $params = array(
            'stream'      => 'firesale_routes',
            'namespace'   => 'firesale_routes',
            'order_by'    => 'ordering_count',
            'sort'        => 'asc',
            'paginate'    => 'yes',
            'pag_segment' => 4
        );

        // Assign routes
        $this->data->routes = $this->streams->entries->get_entries($params);

        // Add page data
        $this->template->title(lang('firesale:title') . ' ' . lang('firesale:sections:routes'))
                       ->append_js('module::routes.js')
                       ->append_css('module::routes.css')
                       ->set($this->data);

        // Fire events
        Events::trigger('page_build', $this->template);

        // Build page
        $this->template->build('admin/routes/index');

    }

    public function create()
    {

        // Variables
        $input = $this->input->post();
        $skip  = array('btnAction');
        $extra = array(
            'return'          => false,
            'success_message' => lang('firesale:routes:add_success'),
            'failure_message' => lang('firesale:routes:add_error'),
            'title'           => lang('firesale:routes:new')
        );

        // Build the form
        $fields = $this->fields->build_form($this->stream, 'new', $input, false, false, $skip, $extra);

        // Posted
        if ( substr($this->input->post('btnAction'), 0, 4) == 'save' ) {

            // Check access
            role_or_die('firesale', 'create_edit_routes');

            // Got an ID back
            if ( is_numeric($fields) ) {
                
                // Add the route
                $this->routes_m->write($input['title'], $input['route'], $input['translation']);

                // Success, clear cache!
                Events::trigger('clear_cache');

                // Redirect
                if ( $input['btnAction'] == 'save_exit') {
                    redirect('admin/firesale/routes');
                } else {
                    redirect('admin/firesale/routes/edit/'.$fields);
                }
            }
        }

        // Assign data
        $this->data->fields = $fields;

        // Build the page
        $this->template->title(lang('firesale:title').' '.lang('firesale:routes:new'))
                       ->set($this->data)
                       ->append_css('module::routes.css')
                       ->append_js('module::jquery.caret.js')
                       ->append_js('module::routes.js')
                       ->build('admin/routes/create');
    }

    public function edit($id)
    {

        // Variables
        $row   = $this->row_m->get_row($id, $this->stream, false);
        $input = $this->input->post();
        $skip  = array('btnAction');
        $extra = array(
            'return'          => false,
            'success_message' => lang('firesale:routes:edit_success'),
            'failure_message' => lang('firesale:routes:edit_error'),
            'title'           => lang('firesale:routes:edit')
        );

        // Not found
        if ( empty($row) ) {
            $this->session->set_flashdata('error', lang('firesale:routes:not_found'));
            redirect('admin/firesale/routes/create');
        }

        // Don't allow title and slug to be changed
        $_POST['title'] = $row->title;
        $_POST['slug']  = $row->slug;
        $_POST['table'] = $row->table;

        // Build the form
        $fields = $this->fields->build_form($this->stream, 'edit', $row, false, false, $skip, $extra);

        // Remove title and slug
        if ( is_array($fields) ) {
            // Remove title, slug and table
            unset($fields[0]);
            unset($fields[1]);
            unset($fields[2]);
        }

        // Posted
        if ( substr($this->input->post('btnAction'), 0, 4) == 'save' ) {

            // Check access
            role_or_die('firesale', 'create_edit_routes');

            // Got an ID back
            if ( is_numeric($fields) ) {

                // Add the route
                $this->routes_m->write($row->title, $input['route'], $input['translation']);

                // Update search index
                $this->routes_m->search_update($this->input->post('slug'));

                // Success, clear cache!
                Events::trigger('clear_cache');

                // Redirect
                if ( $input['btnAction'] == 'save_exit' ) {
                    redirect('admin/firesale/routes');
                } else {
                    redirect('admin/firesale/routes/edit/'.$id);
                }
            }
        }

        // Assign data
        $this->data->row    = $row;
        $this->data->fields = $fields;

        // Build title
        $title = sprintf(lang('firesale:routes:edit'), ( substr($row->title, 0, 5) == 'lang:' ? lang(substr($row->title, 5)) : $row->title ));

        // Build the page
        $this->template->title(lang('firesale:title').' '.$title)
                       ->set($this->data)
                       ->append_css('module::routes.css')
                       ->append_js('module::jquery.caret.js')
                       ->append_js('module::routes.js')
                       ->build('admin/routes/edit');
    }

    public function rebuild($redirect = true)
    {

        // Variables
        $params = array(
            'stream'       => 'firesale_routes',
            'namespace'    => 'firesale_routes',
            'order_by'     => 'ordering_count',
            'sort'         => 'asc',
            'paginate'     => 'yes',
            'page_segment' => 4
        );

        // Get routes
        $routes = $this->streams->entries->get_entries($params);

        // Loop routes
        foreach ($routes['entries'] AS $route) {

            // Format data
            $route['route']       = html_entity_decode($route['route']);
            $route['translation'] = html_entity_decode($route['translation']);

            // Rebuild
            $this->routes_m->write($route['title'], $route['route'], $route['translation']);
        }

        // Flash and redirect
        if ( $redirect ) {
            $this->session->set_flashdata('success', lang('firesale:routes:build_success'));
            redirect('admin/firesale/routes');
        }
    }

    public function delete($id)
    {

        // Get route
        $query = $this->db->where('id', $id)->get('firesale_routes');

        // Check if exists
        if ( $query->num_rows() ) {

            // Get the route
            $route = current($query->result_array());

            // Check if it's core
            if ($route['is_core'] != '1') {

                // Remove it
                if ( $this->routes_m->delete($id) ) {

                    // Success, clear cache!
                    Events::trigger('clear_cache');

                    $this->session->set_flashdata('success', lang('firesale:routes:delete_success'));
                    redirect('admin/firesale/routes');
                }

            }

        }

        // Something went wrong
        $this->session->set_flashdata('error', lang('firesale:routes:delete_error'));
        redirect('admin/firesale/routes');
    }

    public function ajax_order()
    {

        if ( $this->input->is_ajax_request() ) {
            echo order_table($this->input->post('order'), 'firesale_routes', 'route_');
            $this->routes_m->clear();
            $this->rebuild(false);
            exit();
        }

        echo 'error';
        exit();
    }

}
