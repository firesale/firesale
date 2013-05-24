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

class Widget_FireSale_Cart extends Widgets
{

    // Details
    public $title       = 'FireSale Cart';
    public $description = 'Display the current cart for a user';
    public $author      = 'Jamie Holdroyd';
    public $website     = 'http://www.getfiresale.org';
    public $version     = '1.2.0';

    // Form Fields
    public $fields =  array(
        'title'    => array('field' => 'title', 'label' => 'Title', 'rules' => 'required'),
        'hide'     => array('field' => 'hide', 'label' => 'Hide when empty', 'rules' => 'numeric')
    );

    // Element Build
    public function run($options)
    {

        // Load required items
        $this->load->library('firesale/fs_cart');
        $this->load->model('firesale/cart_m');
        $this->load->model('firesale/taxes_m');
        $this->load->model('firesale/currency_m');
        $this->load->model('firesale/products_m');

        // Variables
        $currency       = ( $this->session->userdata('currency') ? $this->session->userdata('currency') : NULL );
        $contents       = $this->fs_cart->contents();
        $data           = new stdClass;
        $data->products = array();

        // Hide?
        if( $options['hide'] == '1' and empty($contents) ) {
            return false;
        }

        // Get currency
        $currency = $this->pyrocache->model('currency_m', 'get', array($currency), $this->firesale->cache_time);

        // Loop products in cart
        foreach( $contents as $id => $item ) {

            $product = $this->pyrocache->model('products_m', 'get', array($item['id']), $this->firesale->cache_time);

            if( $product !== FALSE ) {

                $data->products[] = array(
                    'id'        => $item['id'],
                    'code'      => $product->code,
                    'slug'      => $product->slug,
                    'quantity'  => $item['qty'],
                    'name'      => $item['name'],
                    'price'     => $this->pyrocache->model('currency_m', 'format_string', array($product->price, $currency, false), $this->firesale->cache_time)
                );
            }

        }

        // Calculate prices
        $data->tax   = $this->pyrocache->model('currency_m', 'format_string', array($this->fs_cart->tax(), $currency, false), $this->firesale->cache_time);
        $data->sub   = $this->pyrocache->model('currency_m', 'format_string', array($this->fs_cart->subtotal(), $currency, false), $this->firesale->cache_time);
        $data->total = $this->pyrocache->model('currency_m', 'format_string', array($this->fs_cart->total(), $currency, false), $this->firesale->cache_time);
        $data->count = $this->fs_cart->total_items();

        // Send back cart data
        return $data;
    }

    // Options
    public function form()
    {

        // Variables
        $return = array();

        // Add data
        $return['hide'] = array('0' => 'No', '1' => 'Yes');

        // Return
        return $return;
    }

}
