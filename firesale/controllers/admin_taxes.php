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

class Admin_taxes extends Admin_Controller
{
    public $section = 'taxes';

    public $tabs = array('general' => array());

    public function __construct()
    {

        parent::__construct();

        // Does the user have access?
        role_or_die('firesale', 'access_taxes');

        // Load libraries, drivers & models
        $this->load->model('taxes_m');

        // Initialise data
        $this->data = new stdClass();

    }

    public function index()
    {
        $action = $this->input->post('btnAction');

        if ($action == 'save') {
            foreach ($this->input->post('assignment') as $currency_id => $taxes) {
                foreach ($taxes as $tax_id => $value) {
                    $query = $this->db->get_where('firesale_taxes_assignments', array(
                        'tax_id'      => $tax_id,
                        'currency_id' => $currency_id
                    ));

                    if ($query->num_rows()) {
                        $this->db->update('firesale_taxes_assignments', array(
                            'value'       => $value
                        ), array(
                            'tax_id'      => $tax_id,
                            'currency_id' => $currency_id
                        ));
                    } else {
                        $this->db->insert('firesale_taxes_assignments', array(
                            'tax_id'      => $tax_id,
                            'currency_id' => $currency_id,
                            'value'       => $value
                        ));
                    }
                }
            }

            // Success, clear all the cache!
            Events::trigger('clear_cache');

            $this->session->set_flashdata('success', lang('firesale:taxes:assignments_updated'));

            redirect('admin/firesale/taxes');
        }

        // Load the taxes model
        $this->load->model('firesale/taxes_m');

        $data = $this->taxes_m->get_assignments();

        $this->template->append_js('module::taxes.js')
                       ->append_css('module::taxes.css')
                       ->build('admin/taxes/index', $data);
    }

    public function form($row = FALSE)
    {
        $stream = $this->streams->streams->get_stream('firesale_taxes', 'firesale_taxes');
        $skip  = array('btnAction');
        $extra = array(
            'return'          => false,
            'success_message' => lang('firesale:taxes:'.($row ? 'edit' : 'add').'_success'),
            'failure_message' => lang('firesale:taxes:'.($row ? 'edit' : 'add').'_error'),
            'title'           => lang('firesale:taxes:create')
        );

        $fields = $this->fields->build_form($stream, $row ? 'edit' : 'new', $row ? $row : $this->input->post(), FALSE, FALSE, $skip, $extra);

        if ( ! is_array($fields)) {

            // Success, clear all the cache!
            Events::trigger('clear_cache');

            // Redirect
            if ( $this->input->post('btnAction') == 'save_exit' ) {
                redirect('admin/firesale/taxes');
            } else {
                redirect('admin/firesale/taxes/edit/' . $fields);
            }

        }

        // Load helper
        $this->load->helper('firesale/general');

        // Pass some data to the view
        $data['type'] = $row ? 'edit' : 'new';
        $data['fields'] = fields_to_tabs($fields, $this->tabs);
        $data['tabs'] = array_keys($data['fields']);

        $this->template->build('admin/taxes/form', $data);
    }

    public function create()
    {
        $this->form();
    }

    public function edit($id)
    {
        // Get the row
        $row = $this->streams->entries->get_entry($id, 'firesale_taxes', 'firesale_taxes');
        $this->form($row);
    }

    public function delete($id = NULL, $redirect = TRUE)
    {
        if (is_null($id) AND $this->input->post('action_to')) {
            foreach ($this->input->post('action_to') as $id) {
                if ($this->taxes_m->can_delete($id)) {
                    $this->delete($id, FALSE);
                }
            }
        } elseif ($this->taxes_m->can_delete($id)) {
            $this->streams->entries->delete_entry($id, 'firesale_taxes', 'firesale_taxes');

            $this->db->delete('firesale_taxes_assignments', array(
                'tax_id' => $id
            ));
        }

        // Success, clear all the cache!
        Events::trigger('clear_cache');

        if ($redirect) {
            redirect('admin/firesale/taxes');
        }
    }
}
