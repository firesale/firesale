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

class Plugin_Firesale_Shipping extends Plugin
{
    public function __construct()
    {
        $this->load->library('firesale/fs_cart');
        $this->load->model('shipping_m');
        $this->load->model('categories_m');
        $this->load->model('products_m');
    }

    public function get_methods()
    {

        // Variables
        $free = $this->attribute('free', TRUE);

        // Get cart and shipping methods
        $cart    = $this->fs_cart->contents();
        $methods = $this->shipping_m->calculate_methods($cart);

        // Rename free method?
        if ($free) {
            foreach ($methods AS $key => $method) {
                if ($method['price'] == '0.00') {
                    $methods[$key]['price'] = lang('firesale:label_free');
                } else {
                    $methods[$key]['price'] = $this->settings->get('currency') . $method['price'];
                }
            }
        }

        // Return
        return $methods;
    }

}
