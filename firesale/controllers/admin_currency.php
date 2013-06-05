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

class Admin_currency extends Admin_Controller
{

    public $section = 'currency';
    public $tabs    = array('formatting' => array('cur_format', 'cur_format_num', 'cur_format_dec', 'cur_format_sep'));
    public $default = 1;

    public function __construct()
    {

        parent::__construct();

        // Does the user have access?
        role_or_die('firesale', 'access_currency');

        // Load libraries, drivers & models
        $this->load->driver('Streams');
        $this->load->model('currency_m');
        $this->load->helper('general');

        // Initialise data
        $this->data = new stdClass();

        // Get the stream
        $this->stream = $this->streams->streams->get_stream('firesale_currency', 'firesale_currency');

        // Get the default
        $this->default = $this->settings->get('firesale_currency');
    }

    public function index()
    {

        // Check for updates
        if ( $this->input->post('btnAction') ) {
            // Set action
            $action = $this->input->post('btnAction');

            // Loop IDs
            if ($this->input->post('action_to')) {
                foreach ( $this->input->post('action_to') AS $id ) {
                    // Perform action
                    $this->$action($id, FALSE);
                }
            }
        }

        // Variables
        $params = array(
            'stream'       => 'firesale_currency',
            'namespace'    => 'firesale_currency',
            'paginate'     => 'yes',
            'page_segment' => 4
        );

        // Assign routes
        $this->data->default    = $this->default;
        $this->data->currencies = $this->streams->entries->get_entries($params);

        // Check for usage
        foreach ($this->data->currencies['entries'] AS &$currency) {
            $currency['delete'] = $this->currency_m->can_delete($currency['id']);
        }

        // Add page data
        $this->template->title(lang('firesale:title') . ' ' . lang('firesale:sections:currency'))
                       ->append_css('module::currency.css')
                       ->set($this->data);

        // Fire events
        Events::trigger('page_build', $this->template);

        // Build page
        $this->template->build('admin/currency/index');

    }

    public function create($row = NULL)
    {

        // Variables
        $input = $this->input->post();
        $skip  = array('btnAction', 'cur_mod_type', 'cur_mod_type_btn');
        $extra = array(
            'return'          => false,
            'success_message' => lang('firesale:currency:'.( $row == NULL ? 'add' : 'edit' ).'_success'),
            'failure_message' => lang('firesale:currency:'.( $row == NULL ? 'add' : 'edit' ).'_error'),
            'title'           => lang('firesale:currency:create')
        );

         // Posted
        if ( substr($this->input->post('btnAction'), 0, 4) == 'save' ) {

            // Check access
            if ( $this->input->post('enabled') == '1' ) {
                role_or_die('firesale', 'install_uninstall_currency');
            }

            // Format modifier
            $modifier         = $this->input->post('cur_mod_type');
            $modifier         = ( in_array($modifier, array('+', '-', '*')) ? $modifier : '+' );
            $value            = preg_replace('/[^0-9,.]/', '', $this->input->post('cur_mod'));
            $_POST['cur_mod'] = $modifier.'|'.$value;

            // Format seperator
            $_POST['cur_format_sep'] = $input['cur_format_sep'] = str_replace(' ', '&nbsp;', $_POST['cur_format_sep']);

        }

        // Build the form
        $fields = $this->fields->build_form($this->stream, ( $row == NULL ? 'new' : 'edit' ), ( $row == NULL ? $input : $row ), FALSE, FALSE, $skip, $extra);

         // Posted and created successfully
        if ( substr($this->input->post('btnAction'), 0, 4) == 'save' AND ( is_numeric($fields) OR is_string($fields) ) ) {

            // Run currency update function
            $this->load->library('firesale/exchange');

            // Success, clear cache!
            Events::trigger('clear_cache');

            // Redirect
            if ( $this->input->post('btnAction') == 'save_exit' ) {
                redirect('admin/firesale/currency');
            } else {
                redirect('admin/firesale/currency/edit/'.$fields);
            }

        }

        // Assign data
        $this->data->fields = fields_to_tabs($fields, $this->tabs);
        $this->data->tabs	= array_keys($this->data->fields);
        $this->data->type   = ( $row == NULL ? 'create' : 'edit' );

        // Build the page
        $this->template->title(lang('firesale:title').' '.lang('firesale:currency:'.$this->data->type))
                       ->set($this->data)
                       ->append_css('module::currency.css')
                       ->append_js('module::currency.js')
                       ->build('admin/currency/create');

    }

    public function edit($id)
    {

        // Get row
        if ( $row = $this->currency_m->get($id) ) {
            // Load form
            $this->create($row);
        } else {
            $this->session->set_flashdata('error', lang('firesale:currency:not_found'));
            redirect('admin/firesale/currency/create');
        }

    }

    public function enable($id, $redirect = TRUE)
    {

        // Check access
        role_or_die('firesale', 'install_uninstall_currency');

        // Variables
        $status = TRUE;

        // Update it
        if ( ! $this->db->where('id', $id)->update('firesale_currency', array('enabled' => 1)) ) {
            $status = FALSE;
        }

        // Redirect?
        if ($redirect) {
            redirect('admin/firesale/currency');
        } else {
            return $status;
        }

    }

    public function disable($id, $redirect = TRUE)
    {

        // Check access
        role_or_die('firesale', 'install_uninstall_currency');

        // Variables
        $status = TRUE;

        // Check for default, cannot disable this
        if ($id != $this->default) {
            // Update it
            if ( ! $this->db->where('id', $id)->update('firesale_currency', array('enabled' => 0)) ) {
                $status = FALSE;
            }
        } else {
            $status = FALSE;
        }

        // Redirect?
        if ($redirect) {
            redirect('admin/firesale/currency');
        } else {
            return $status;
        }

    }

    public function delete($id, $redirect = TRUE)
    {

        // Check access
        role_or_die('firesale', 'install_uninstall_currency');

        // Check deletion
        if ( $this->currency_m->can_delete($id) ) {

            // Delete entry
            $this->streams->entries->delete_entry($id, 'firesale_currency', 'firesale_currency');

            // Success, clear cache!
            Events::trigger('clear_cache');

            $this->session->set_flashdata('success', lang('firesale:currency:delete_success'));
        } else {
            // Unable to delete
            $this->session->set_flashdata('error', lang('firesale:currency:delete_error'));
        }

        // Send them back
        redirect('admin/firesale/currency');
    }

}
