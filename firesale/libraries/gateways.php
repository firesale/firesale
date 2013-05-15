<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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

class gateways
{
    private $gateway_path = 'gateways';
    protected $_CI;

    public function __construct()
    {
        // Get an instance of CodeIgniter
        $this->_CI =& get_instance();

        // Load the ci-merchant library
        $this->_CI->load->library('firesale/merchant');

        // Set the default path for the payment gateways
        $this->gateway_path(dirname(__FILE__).'/'.$this->gateway_path);
    }

    // Function to set the gateway path
    public function gateway_path($path)
    {
        $this->gateway_path = realpath($path);

        return TRUE;
    }

    public function get_uninstalled()
    {
        if ($handle = opendir($this->gateway_path)) {
            while (($file = readdir($handle)) !== FALSE) {
                if (substr($file, 0, 9) == 'merchant_' AND substr($file, -8, 4) != 'base') {
                    $gateway_name = substr($file, 9, -4);

                    if ( ! $this->is_installed($gateway_name)) {
                        $uninstalled[] = array(
                            'slug'	=> $gateway_name,
                            'name'	=> ucwords(str_replace('_', ' ', $gateway_name))
                        );
                    }
                }
            }

            closedir($handle);

            return isset($uninstalled) ? $uninstalled : FALSE;
        }
    }

    public function get_installed()
    {
        $gateways = $this->_CI->db->get('firesale_gateways')->result_array();

        foreach ($gateways as $key => $gateway) {
            if ( ! $this->is_installed($gateway['slug']))
                unset($gateways[$key]);
        }

        return $gateways;
    }

    public function get_enabled()
    {
        $data = array();

        $gateways = $this->_CI->db->get_where('firesale_gateways', array('enabled' => 1));

        foreach ($gateways->result() as $gateway) {
            $data[$gateway->id] = array(
                'slug'	=> $gateway->slug,
                'name'	=> $gateway->name,
                'desc'	=> $gateway->desc
            );
        }

        return $data;
    }

    public function is_installed($gateway)
    {

        $installed = $this->_CI->db->get_where('firesale_gateways', array('slug' => $gateway));
        if ($installed->num_rows()) {
            if ($this->exists($gateway))
                return TRUE;

            $this->_CI->db->delete('firesale_gateways', array('slug' => $gateway));
        }

        return FALSE;
    }

    public function exists($gateway)
    {
        if (file_exists($this->gateway_path.'/merchant_'.$gateway.'.php'))
            return TRUE;

        return FALSE;
    }

    public function is_enabled($gateway)
    {

        if (is_numeric($gateway)) {
            $this->_CI->db->where('id', $gateway);
        } elseif ( is_array($gateway)) {
            $this->_CI->db->where('id', $gateway['id']);
        } else {
            $this->_CI->db->where('slug', $gateway);
        }

        $enabled = $this->_CI->db->get_where('firesale_gateways', array('enabled' => 1));
        if ($enabled->num_rows())
            return TRUE;

        return FALSE;
    }

    public function get_setting_fields($gateway)
    {
        if ($this->exists($gateway)) {
            if ($this->_CI->merchant->load($gateway)) {
                foreach ($this->_CI->merchant->default_settings() as $setting => $value) {
                    $settings[] = array(
                        'slug'	=> $setting,
                        'name'	=> ucwords(str_replace('_', ' ', $setting)),
                        'type'	=> gettype($value),
                        'value'	=> $this->setting($gateway, $setting)
                    );
                }

                return isset($settings) ? $settings : array();
            }
        }

        return FALSE;
    }

    public function setting($gateway, $setting)
    {
        if ( ! is_numeric($gateway)) {
            $this->_CI->db->select('firesale_gateway_settings.*, firesale_gateways.slug')
                          ->join('firesale_gateways', 'firesale_gateway_settings.id = firesale_gateways.id')
                          ->where('slug', $gateway);
        } else {
            $this->_CI->db->where('id', $gateway);
        }

        $query = $this->_CI->db->get_where('firesale_gateway_settings', array('key' => $setting));

        if ($query->num_rows())
            return $query->row()->value;

        return NULL;
    }

    public function settings($gateway)
    {
        $data = array();

        $gateway_settings = $this->get_setting_fields($gateway);

        $query = $this->_CI->db->select('firesale_gateway_settings.*, firesale_gateways.slug')
                               ->join('firesale_gateways', 'firesale_gateway_settings.id = firesale_gateways.id')
                               ->get('firesale_gateway_settings', array('slug' => $gateway));

        if ($query->num_rows()) {
            // Assign the setting types
            foreach ($gateway_settings as $setting) {
                $types[$setting['slug']] = $setting['type'];

                if ($setting['type'] == 'boolean') {
                    if ($setting['value'] == '1') {
                        // 1 is true :)
                        $data[$setting['slug']] = TRUE;
                    } else {
                        // Anything else is false :)
                        $data[$setting['slug']] = FALSE;
                    }
                } else {
                    // This is not a boolean value, just assign it to the array
                    $data[$setting['slug']] = $setting['value'];
                }
            }

            return $data;
        }

        return NULL;
    }

    public function install_core()
    {
        $this->_CI->lang->load('firesale/gateways');

        $uninstalled = $this->get_uninstalled();

        foreach ($uninstalled as $key => $gateway) {
            if (lang('firesale:gateways:'.$gateway['slug'].':name')
                AND lang('firesale:gateways:'.$gateway['slug'].':desc'))
            {
                $uninstalled[$key]['created'] = date("Y-m-d H:i:s");
                $uninstalled[$key]['ordering_count'] = 0;
                $uninstalled[$key]['name'] = lang('firesale:gateways:'.$gateway['slug'].':name');
                $uninstalled[$key]['desc'] = lang('firesale:gateways:'.$gateway['slug'].':desc');
                $uninstalled[$key]['enabled'] = $gateway['slug'] == 'dummy';
            } else {
                unset($uninstalled[$key]);
            }
        }

        if ($this->_CI->db->insert_batch('firesale_gateways', $uninstalled))
            return TRUE;

        return FALSE;
    }

    public function slug_from_id($id)
    {
        $query = $this->_CI->db->get_where('firesale_gateways', array('id' => (int) $id));

        if ($query->num_rows())
            return $query->row()->slug;

        return FALSE;
    }

    public function id_from_slug($slug)
    {
        $query = $this->_CI->db->get_where('firesale_gateways', array('slug' => $slug));

        if ($query->num_rows())
            return $query->row()->id;

        return FALSE;
    }

}
