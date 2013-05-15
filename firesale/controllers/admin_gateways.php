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

class Admin_gateways extends Admin_Controller
{
    public $section = 'gateways';

    public function __construct()
    {
        parent::__construct();

        // Does the user have access?
        role_or_die('firesale', 'access_gateways');

        // Load the gateways library
        $this->load->library('gateways');

        // Add metadata
        $this->template->append_css('module::gateways.css');
    }

    // Show installed
    public function index()
    {
        if ($this->input->post('btnAction') == 'enable') {
            $this->enable();
        } elseif ($this->input->post('btnAction') == 'disable') {
            $this->disable();
        } elseif ($this->input->post('btnAction') == 'uninstall') {
            $this->uninstall();
        }

        $data['gateways'] = $this->gateways->get_installed();

        // Build the page
        $this->template->title(lang('firesale:title') . ' ' . lang('firesale:sections:gateways'))
                       ->build('admin/gateways/index', $data);
    }

    // Show uninstalled
    public function add()
    {
        // Does the user have access?
        role_or_die('firesale', 'install_uninstall_gateways');

        $data['gateways'] = $this->gateways->get_uninstalled();

        $this->template->build('admin/gateways/install', $data);
    }

    public function install($slug)
    {
        // Does the user have access?
        role_or_die('firesale', 'install_uninstall_gateways');

        $fields = $this->gateways->get_setting_fields($slug);
        $rules = array(
            array(
                'field'	=> 'name',
                'label'	=> lang('firesale:gateways:labels:name'),
                'rules'	=> 'trim|htmlspecialchars|required|max_length[100]',
                'type'	=> 'string'
            ),
            array(
                'field'	=> 'desc',
                'label'	=> lang('firesale:gateways:labels:desc'),
                'rules'	=> 'trim|xss_clean|required',
                'type'	=> 'text'
            )
        );

        $this->lang->load('gateways');
        $values['name'] = lang('firesale:gateways:'.$slug.':name') ? lang('firesale:gateways:'.$slug.':name') : ucwords(str_replace('_', ' ', $slug));
        $values['desc'] = lang('firesale:gateways:'.$slug.':desc');

        if (is_array($fields)) {
            foreach ($fields as $field) {
                $field_data['field'] = $field['slug'];
                $field_data['label'] = $field['name'];

                if ($field['type'] == 'boolean') {
                    $field_data['rules'] = 'required|callback__valid_bool';
                    $field_data['type'] = 'boolean';
                } elseif ($field['type'] == 'array') {
                    $field_data['rules'] = 'required|callback__valid_array[' . $field['slug'] . ']';
                    $field_data['type'] = 'array';
                } else {
                    $field_data['rules'] = 'required|xss_clean|trim';
                    $field_data['type'] = 'string';
                }

                $rules[] = $field_data;
                $additional_fields[] = $field_data;
            }

            $this->form_validation->set_rules($rules);

            if ($this->form_validation->run()) {
                $data = array(
                    'created' 		 => date("Y-m-d H:i:s"),
                    'ordering_count' => 0,
                    'slug'			 => $slug,
                    'name'			 => set_value('name'),
                    'desc'			 => set_value('desc')
                );

                $this->db->trans_begin();
                $this->db->insert('firesale_gateways', $data);

                $gateway_id = $this->db->insert_id();

                foreach ($additional_fields as $field) {
                    $this->db->insert('firesale_gateway_settings', array(
                        'id'	=> $gateway_id,
                        'key'	=> $field['field'],
                        'value'	=> set_value($field['field'])
                    ));
                }

                if ($this->db->trans_status() !== FALSE) {
                    $this->db->trans_commit();
                    $this->session->set_flashdata('success', lang('firesale:gateways:installed_success'));
                    redirect('admin/firesale/gateways');
                } else {
                    $this->db->trans_rollback();
                    $this->session->set_flashdata('error', lang('firesale:gateways:installed_fail'));
                    redirect('admin/firesale/gateways/add');
                }
            } else {
                $this->template->build('admin/gateways/install_form', array('fields' => $rules, 'values' => $values));
            }
        } else {
            show_404();
        }
    }

    public function _valid_bool($value)
    {
        if ($value == 1 OR $value == 0)
            return TRUE;

        $this->form_validation->set_message('_valid_bool', lang('firesale:gateways:errors:invalid_bool'));

        return FALSE;
    }

    public function _valid_array($value, $field)
    {
        $this->load->library('merchant');
        $this->merchant->load($this->uri->rsegment(3));

        // CH: Can't use PHP 5.4's function array dereferencing, so we'll have to assign it to a variable
        $settings = $this->merchant->default_settings();

        if (isset($settings[$field]['options']) AND is_array($settings[$field]['options'])) {
            if (array_key_exists($value, $settings[$field]['options'])) {
                return TRUE;
            } else {
                $this->form_validation->set_message('_valid_array', sprintf(lang('firesale:gateways:invalid_option'), ucwords(str_replace('_', ' ', $field))));

                return FALSE;
            }
        }
    }

    public function enable($id = NULL)
    {
        // Does the user have access?
        role_or_die('firesale', 'enable_disable_gateways');

        if ($id === NULL) {
            $this->db->trans_start();

            foreach ($this->input->post('action_to') as $id)
                $this->db->update('firesale_gateways', array('enabled' => 1), array('id' => (int) $id));

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('error', lang('firesale:gateways:multiple_enabled_fail'));
            } else {
                $this->session->set_flashdata('success', lang('firesale:gateways:multiple_enabled_success'));
            }
        } else {
            if ($this->db->update('firesale_gateways', array('enabled' => 1), array('id' => (int) $id))) {
                $this->session->set_flashdata('success', lang('firesale:gateways:enabled_success'));
            } else {
                $this->session->set_flashdata('error', lang('firesale:gateways:enabled_fail'));
            }
        }

        redirect('admin/firesale/gateways');
    }

    public function disable($id = NULL)
    {
        // Does the user have access?
        role_or_die('firesale', 'enable_disable_gateways');

        if ($id === NULL) {
            $this->db->trans_start();

            foreach ($this->input->post('action_to') as $id)
                $this->db->update('firesale_gateways', array('enabled' => 0), array('id' => (int) $id));

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('error', lang('firesale:gateways:multiple_disabled_fail'));
            } else {
                $this->session->set_flashdata('success', lang('firesale:gateways:multiple_disabled_success'));
            }
        } else {
            if ($this->db->update('firesale_gateways', array('enabled' => 0), array('id' => (int) $id))) {
                $this->session->set_flashdata('success', lang('firesale:gateways:disabled_success'));
            } else {
                $this->session->set_flashdata('error', lang('firesale:gateways:multiple_disabled_fail'));
            }
        }

        redirect('admin/firesale/gateways');
    }

    public function uninstall($id = NULL)
    {
        // Does the user have access?
        role_or_die('firesale', 'install_uninstall_gateways');

        if ($id === NULL) {
            $this->db->trans_start();

            foreach ($this->input->post('action_to') as $id) {
                $this->db->delete('firesale_gateways', array('id' => (int) $id));
                $this->db->delete('firesale_gateway_settings', array('id' => (int) $id));
            }

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('error', lang('firesale:gateways:multiple_uninstalled_fail'));
            } else {
                $this->session->set_flashdata('success', lang('firesale:gateways:multiple_uninstalled_success'));
            }
        } else {
            $this->db->trans_start();

            $this->db->delete('firesale_gateways', array('id' => (int) $id));
            $this->db->delete('firesale_gateway_settings', array('id' => (int) $id));

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('error', lang('firesale:gateways:uninstalled_fail'));
            } else {
                $this->session->set_flashdata('success', lang('firesale:gateways:uninstalled_success'));
            }
        }

        redirect('admin/firesale/gateways');
    }

    public function edit($slug)
    {
        // Does the user have access?
        role_or_die('firesale', 'edit_gateways');

        $query = $this->db->get_where('firesale_gateways', array('slug' => $slug));

        if ($query->num_rows()) {

            $values['name'] = $query->row()->name;
            $values['desc'] = $query->row()->desc;

            $fields = $this->gateways->get_setting_fields($slug);
            $rules = array(
                array(
                    'field'	=> 'name',
                    'label'	=> lang('firesale:gateways:labels:name'),
                    'rules'	=> 'trim|htmlspecialchars|required|max_length[100]',
                    'type'	=> 'string'
                ),
                array(
                    'field'	=> 'desc',
                    'label'	=> lang('firesale:gateways:labels:desc'),
                    'rules'	=> 'trim|xss_clean|required',
                    'type'	=> 'text'
                )
            );

            if (is_array($fields)) {

                $additional_fields = array();

                foreach ($fields as $field) {
                    $values[$field['slug']] = $this->gateways->setting($slug, $field['slug']);

                    $field_data['field'] = $field['slug'];
                    $field_data['label'] = $field['name'];

                    if ($field['type'] == 'boolean') {
                        $field_data['rules'] = 'required|callback__valid_bool';
                        $field_data['type'] = 'boolean';
                    } else {
                        $field_data['rules'] = 'required|xss_clean|trim';
                        $field_data['type'] = 'string';
                    }

                    $rules[] = $field_data;
                    $additional_fields[] = $field_data;
                }

                $this->form_validation->set_rules($rules);

                if ($this->form_validation->run()) {
                    $data = array(
                        'name'	=> set_value('name'),
                        'desc'	=> set_value('desc')
                    );

                    $gateway_id = $this->db->get_where('firesale_gateways', array('slug' => $slug))->row()->id;

                    $this->db->trans_begin();
                    $this->db->update('firesale_gateways', $data, array('id' => $gateway_id));

                    foreach ($additional_fields as $field) {
                        if ($this->db->get_where('firesale_gateway_settings', array('id' => $gateway_id, 'key' => $field['field']))->num_rows()) {
                            $this->db->update('firesale_gateway_settings', array(
                                'value'	=> set_value($field['field'])
                            ), array(
                                'id'	=> $gateway_id,
                                'key'	=> $field['field']
                            ));
                        } else {
                            $this->db->insert('firesale_gateway_settings', array(
                                'id'	=> $gateway_id,
                                'key'	=> $field['field'],
                                'value'	=> set_value($field['field'])
                            ));
                        }
                    }



                    if ($this->db->trans_status() !== FALSE) {
                        $this->db->trans_commit();
                        $this->session->set_flashdata('success', lang('firesale:gateways:updated_success'));
                        redirect('admin/firesale/gateways');
                    } else {
                        $this->db->trans_rollback();
                        $this->session->set_flashdata('error', lang('firesale:gateways:updated_fail'));
                        redirect('admin/firesale/gateways');
                    }
                } else {
                    $this->template->build('admin/gateways/edit', array('fields' => $rules, 'values' => $values));
                }
            } else {
                show_404();
            }
        }
    }
}
