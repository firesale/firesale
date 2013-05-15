<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

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

class Front_currency extends Public_Controller
{

    public function __construct()
    {

        parent::__construct();

        // Load libraries
        $this->lang->load('firesale');
        $this->load->library('fs_cart');
        $this->load->model('cart_m');
        $this->load->model('orders_m');
        $this->load->model('currency_m');

    }

    public function change($id)
    {

        // Get currency
        $currency = $this->currency_m->get($id);

        // Check it's valid
        if (! $currency) {
            $currency = $this->currency_m->get($id);
        }

        // Update currency of cart
        if ( $this->fs_cart->total_items() AND ( !isset($this->fs_cart->currency) OR $currency->id != $this->fs_cart->currency->id ) ) {
            $this->cart_m->update_currency($currency);
        }

        // Set it into session
        $this->session->set_userdata('currency', $id);

        // Order in progress?
        if ( $order_id = $this->session->userdata('order_id') ) {
            $this->orders_m->update_order_cost($order_id);
        }

        // Successful?
        if ($id == $currency->id) {
            $this->session->set_flashdata('success', 'Currency changed successfully');
        } else {
            $this->session->set_flashdata('error', 'Error changing currency');
        }

        // Redirect
        redirect(( isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'home' ));
    }

}
