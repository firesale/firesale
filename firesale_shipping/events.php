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
* @package firesale/shipping
* @author FireSale <support@getfiresale.org>
* @copyright 2013 Moltin Ltd.
* @version master
* @link http://github.com/firesale/firesale
*
*/

class Events_Firesale_shipping
{

    protected $ci;

    public function __construct()
    {

        $this->ci =& get_instance();
        $this->ci->load->model('firesale_shipping/shipping_m');

        // register the events
        Events::register('form_build', array($this, 'form_build'));
        Events::register('shipping_methods', array($this, 'shipping_methods'));
        Events::register('clear_cache', array($this, 'clear_cache'));
    }

    public function form_build($controller)
    {

        // Check we're in products
        if( isset($controller->section) AND $controller->section == 'products' ) {

            // Remove images (needs to be last)
            unset($controller->tabs['_images']);

            // Add metadata to tabs
            $controller->tabs['shipping'] = array('ship_req', 'shipping_weight', 'shipping_height', 'shipping_width', 'shipping_depth');

            // Add images back in
            $controller->tabs['_images'] = array();

        }

    }

    public function shipping_methods($cart)
    {
        return $this->ci->shipping_m->calculate_methods($cart);
    }

    public function clear_cache()
    {
        $this->ci->pyrocache->delete_all('shipping_m');
    }

}
