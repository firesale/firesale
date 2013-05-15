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

class Front_orders extends Public_Controller
{

    public function __construct()
    {
        parent::__construct();

        // Add data array
        $this->data = new stdClass();

        // Load models, lang, libraries, etc.
        $this->load->model('routes_m');
        $this->load->model('orders_m');
        $this->load->model('categories_m');
        $this->load->model('products_m');
        $this->load->model('currency_m');

        // Load css/js
        $this->template->append_css('module::firesale.css')
                       ->append_js('module::firesale.js');
    }

    public function index()
    {
        // Variables
        $user = ( isset($this->current_user->id) ? $this->current_user->id : NULL );

        // Check user
        if ($user != NULL) {

            // Set query paramaters
            $params	 = array(
                'stream' 	=> 'firesale_orders',
                'namespace'	=> 'firesale_orders',
                'where'		=> SITE_REF."_firesale_orders.created_by = '{$user}'",
                'order_by'  => 'id',
                'sort'      => 'desc'
            );

            // Get entries
            $orders = $this->streams->entries->get_entries($params);

            // Add items to order
            if ($orders['total'] > 0) {
                foreach ($orders['entries'] AS &$order) {
                    $order['count'] = $this->pyrocache->model('orders_m', 'product_count', array($order['id']), $this->firesale->cache_time);
                    $currency       = $this->pyrocache->model('currency_m', 'get', array($order['currency']['id']), $this->firesale->cache_time);
                    $order['price_sub_formatted']   = $this->currency_m->format_string($order['price_sub'], $currency, false);
                    $order['price_ship_formatted']  = $this->currency_m->format_string($order['price_ship'], $currency, false);
                    $order['price_total_formatted'] = $this->currency_m->format_string($order['price_total'], $currency, false);
                }
            }

            // Variables
            $this->data->total  	= $orders['total'];
            $this->data->orders 	= $orders['entries'];
            $this->data->pagination = $orders['pagination'];

            // Build page
            $this->template->title(lang('firesale:orders:my_orders'))
                           ->set_breadcrumb(lang('firesale:orders:my_orders'))
                           ->set($this->data);

            // Fire events
            Events::trigger('page_build', $this->template);

            // Build page
            $this->template->build('orders');

        } else {
            // Must be logged in
            $this->session->set_flashdata('error', lang('firesale:orders:logged_in'));
            redirect('users/login');
        }
    }

    public function view_order($id)
    {

        // Variables
        $user  = ( isset($this->current_user->id) ? $this->current_user->id : NULL );
        $order = $this->pyrocache->model('orders_m', 'get_order_by_id', array($id), $this->firesale->cache_time);

        // Check user can view
        if ($user != NULL AND $order != FALSE AND $user == $order['created_by']['user_id']) {

            // Format order for display
            $order['price_sub']   = $this->currency_m->format_string($order['price_sub'], (object) $order['currency'], FALSE, FALSE);
            $order['price_ship']  = $this->currency_m->format_string($order['price_ship'], (object) $order['currency'], FALSE, FALSE);
            $order['price_total'] = $this->currency_m->format_string($order['price_total'], (object) $order['currency'], FALSE, FALSE);

            // Build page
            $this->template->title(sprintf(lang('firesale:orders:view_order'), $id))
                           ->set_breadcrumb(lang('firesale:orders:my_orders'), $this->pyrocache->model('routes_m', 'build_url', array('orders'), $this->firesale->cache_time))
                           ->set_breadcrumb(sprintf(lang('firesale:orders:view_order'), $id))
                           ->set($order);

            // Fire events
            Events::trigger('page_build', $this->template);

            // Build page
            $this->template->build('orders_single');

        } else {
            // Must be logged in
            $this->session->set_flashdata('error', lang('firesale:orders:logged_in'));
            redirect('users/login');
        }

    }

}
