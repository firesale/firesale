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

class Events_Firesale
{

    protected $ci;

    public function __construct()
    {
        $this->ci =& get_instance();

        // register the events
        Events::register('public_controller',  array($this, 'public_controller'));
        Events::register('settings_updated',   array($this, 'settings_updated'));
        Events::register('clear_cache',        array($this, 'clear_cache'));
        Events::register('cart_item_added',    array($this, 'cart_item_added'));
        Events::register('firesale_dashboard', array($this, 'firesale_dashboard_sales'));
        Events::register('firesale_dashboard', array($this, 'firesale_dashboard_stock'));
    }

    public function public_controller()
    {
        // Update currency after an hour has passed since last update to api
        if ( ( time() - $this->ci->settings->get('firesale_currency_updated') ) > 3600 ) {
            // Load required items
            $this->ci->load->library('firesale/exchange');
        }

        // Check routes redirecting
        if ( ( ! isset($_SERVER['HTTPS']) or $_SERVER['HTTPS'] != 'on' ) and substr($this->ci->module, 0, 8) == 'firesale' ) {

            // Load required items
            $this->ci->load->model('firesale/routes_m');

            // Get the route
            $route = $this->ci->pyrocache->model('routes_m', 'get_by_module_controller', array($this->ci->module, $this->ci->uri->rsegment(1)), $this->ci->firesale->cache_time);

            // Check and redirect
            if ( $route !== false and $route->https == '1' ) {
                redirect(str_replace('http://', 'https://', current_url()));
            }
        }
    }

    public function settings_updated($settings)
    {

        // Add/remove override routes
        if ( isset($settings['firesale_dashboard']) ) {

            // Load required items
            $this->ci->lang->load('firesale/firesale');
            $this->ci->load->model('firesale/routes_m');

            // Add
            if ( $settings['firesale_dashboard'] == '1' ) {
                $this->ci->routes_m->write(lang('firesale:sections:dashboard'), 'admin', 'firesale/admin/index');
            // Remove
            } else {
                $this->ci->routes_m->remove(lang('firesale:sections:dashboard'));
            }
        }

        // Clear cache on currency change
        if ( isset($settings['firesale_currency']) or isset($settings['firesale_show_variations'])) {
            Events::trigger('clear_cache');
        }
    }

    public function clear_cache()
    {
        $this->ci->pyrocache->delete_all('address_m');
        $this->ci->pyrocache->delete_all('cart_m');
        $this->ci->pyrocache->delete_all('categories_m');
        $this->ci->pyrocache->delete_all('currency_m');
        $this->ci->pyrocache->delete_all('modifier_m');
        $this->ci->pyrocache->delete_all('orders_m');
        $this->ci->pyrocache->delete_all('routes_m');
        $this->ci->pyrocache->delete_all('sitemap_m');
        $this->ci->pyrocache->delete_all('taxes_m');
        $this->ci->pyrocache->delete_all('row_m');
        $this->ci->pyrocache->delete_all('products_m');
        $this->ci->cache->clean();
    }

    public function cart_item_added()
    {
        if ( $this->ci->settings->get('firesale_disabled') == '1' ) {
            $this->ci->fs_cart->destroy();
            $this->ci->session->set_flashdata('error', $this->ci->settings->get('firesale_disabled_msg'));
            redirect($this->ci->input->server('HTTP_REFERER'));
        }
    }

    public function firesale_dashboard_sales()
    {

        // Load required items
        $this->ci->load->model('firesale/dashboard_m');
        $this->ci->load->model('firesale/currency_m');

        // Variables
        $data          = array();
        $currency      = $this->ci->currency_m->get();
        $data['year']  = $this->ci->dashboard_m->sales_duration('month', 12, $currency);
        $data['month'] = $this->ci->dashboard_m->sales_duration('month', 1, $currency);
        $data['week']  = $this->ci->dashboard_m->sales_duration('day', 7, $currency);
        $data['day']   = $this->ci->dashboard_m->sales_duration('day', 1, $currency);

        // Assign data
        if ( $data['year'] !== false ) {
            $data['year']['sales']       = json_encode($data['year']['sales']);
            $data['year']['count']       = json_encode($data['year']['count']);
            if(!empty($currency)){
                $data['year']['currency']    = $currency->symbol;
            }else{
                $data['year']['currency']    = '';
            }
        }

        // Build and return data
        return array(
            'id'      => 'sales',
            'title'   => lang('firesale:elements:product_sales'),
            'content' => $this->ci->parser->parse('firesale/admin/dashboard/productsales', $data, true),
            'assets'  => array(
                array('type' => 'js',  'file' => 'module::dashboard_productsales.js'),
                array('type' => 'css', 'file' => 'module::dashboard_productsales.css')
            )
        );
    }

    public function firesale_dashboard_stock()
    {

        // Variables
        $data              = array();
        $data['low_count'] = $this->ci->db->select("id")->where('stock_status', '2')->get('firesale_products')->num_rows();
        $data['out_count'] = $this->ci->db->select("id")->where('stock_status', '3')->get('firesale_products')->num_rows();
        $data['low_prods'] = $this->ci->db->select("code, title, stock, id, slug")->where('stock_status', '2')->order_by('stock', 'desc')->limit('5')->get('firesale_products')->result_array();
        $data['out_prods'] = $this->ci->db->select("code, title, stock, id, slug")->where('stock_status', '3')->order_by('stock', 'desc')->limit('5')->get('firesale_products')->result_array();

        // Build and return data
        return array(
            'id'      => 'stock',
            'title'   => lang('firesale:elements:low_stock'),
            'content' => $this->ci->parser->parse('firesale/admin/dashboard/lowstock', $data, true),
            'assets'  => array(
                array('type' => 'css', 'file' => 'module::dashboard_lowstock.css')
            )
        );
    }

}
