<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Dashboard controller
 *
 * @author		Jamie Holdroyd
 * @author		Chris Harvey
 * @package		FireSale\Core\Controllers
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
            if ( ! empty($order) and ( $nkey = array_search($item['id'], $order) ) >= 0 ) {
                $key           = $nkey;
                $display[$key] = $item;
            } else {
                $key           = ( 500 + count($display) );
                $display[$key] = $item;
            }

            // Hidden
            if ( ! empty($hidden) and in_array($item['id'], $hidden) ) {
                $display[$key]['hidden'] = true;
            }

            // Assets
            if ( isset($item['assets']) and ! empty($item['assets']) ) {
                foreach ( $item['assets'] as $asset ) {
                    if ( $asset['type'] == 'js' ) {
                        $this->template->append_js($asset['file']);
                    } else if ( $asset['type'] == 'css' ) {
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
