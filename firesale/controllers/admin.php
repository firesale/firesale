<?php defined('BASEPATH') or exit('No direct script access allowed');

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

class admin extends Admin_Controller
{
    public $section = 'dashboard';

    public function __construct()
    {
        parent::__construct();

        // Load libraries
        $this->lang->load('firesale');
        $this->load->library('firesale/firesale');

        // Add data object
        $this->data = new stdClass;

        // Add metadata
        $this->template->append_css('module::dashboard.css')
                       ->append_js('module::flot.js')
                       ->append_js('module::dashboard.js');
    }

    public function index()
    {

        // CH: If we're not on the FireSale dashboard, redirect to it.
        if ( ! $this->uri->segment(2) ) {
            redirect('admin/firesale');
        }

        // Variables
        $items   = Events::trigger('firesale_dashboard', array(), 'array');
        $order   = explode('|', $this->input->cookie('firesale_dashboard_order'));
        $hidden  = explode('|', $this->input->cookie('firesale_dashboard_hidden'));
        $display = array();

        // Check and loop items
        foreach ( $items as $key => $item ) {

            // Ordering
            if ( ! empty($order) and ( $nkey = array_search($item['id'], $order) ) !== false ) {
                $key = $nkey;
            }
            do { $key++; } while ( isset($display[$key]) );
            $display[$key] = $item;

            // Hidden
            if ( ! empty($hidden) and in_array($item['id'], $hidden) ) {
                $display[$key]['hidden'] = true;
            }

            // Assets
            if ( isset($item['assets']) and ! empty($item['assets']) ) {
                foreach ( $item['assets'] as $asset ) {

                    // Check and add namespacing
                    list($namespace, $file) = explode('::', $asset['file']);
                    if ( $namespace !== 'module' ) {
                        asset_namespace($namespace);
                    }

                    // Append assets
                    if ( $asset['type'] == 'js' ) {
                        $this->template->append_js($asset['file']);
                    } elseif ( $asset['type'] == 'css' ) {
                        $this->template->append_css($asset['file']);
                    }
                }
            }

        }

        // Sort the array
        ksort($display);

        // Assign variables
        $this->data->controller = $this;
        $this->data->items      = $display;
        $this->data->shown		= count($display);
        $this->data->count		= count($items);

        // Build the page
        $this->template->enable_parser(true)
                       ->title(lang('firesale:title') . ' ' . lang('firesale:sections:dashboard'))
                       ->build('admin/dashboard', $this->data);
    }

}
