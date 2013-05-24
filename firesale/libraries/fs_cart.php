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

// Include the stock CodeIgniter Cart class
require_once(BASEPATH.'libraries/Cart.php');

class Fs_cart extends CI_Cart
{
    public $product_name_safe   = FALSE;
    public $product_name_rules	= '\.\:\-_ a-z0-9_-а-яА-Я ';

    public function __construct()
    {
        parent::__construct();

        $this->ci =& get_instance();

        // Load the required models
        $this->ci->load->model('firesale/currency_m');
    }

    public function destroy()
    {
        // Run the standard CI_Cart function
        parent::destroy();

        // Fire an event to tell external modules that the cart has been destroyed
        Events::trigger('cart_destroyed');
    }

    public function currency()
    {
        if ( ! isset($this->currency)) {
            $currency = $this->ci->session->userdata('currency') ? $this->ci->session->userdata('currency') : $this->ci->settings->get('firesale_currency');
            $this->currency = $this->ci->pyrocache->model('currency_m', 'get', array($currency ? $currency : NULL), $this->ci->firesale->cache_time);
        }

        return $this->currency;
    }

    public function tax()
    {
        $this->tax = 0;

        foreach ($this->contents() as $item) {
            $this->ci->load->model('firesale/taxes_m');

            $percentage = $this->ci->pyrocache->model('taxes_m', 'get_percentage', array($item['tax_band']), $this->ci->firesale->cache_time);

            $tax_mod = 1 - ($percentage / 100);

            $tax = $item['price'] / (($percentage / 100) + 1) * ($percentage / 100);
            $tax = $tax * $item['qty'];

            $this->tax += $tax;
        }

        return $this->tax;
    }

    public function total()
    {
        $total = parent::total();

        return number_format($total, 2, '.', '');
    }

    public function shipping()
    {
        return $this->_cart_contents['cart_ship'];
    }

    public function set_shipping($value)
    {
        $this->_cart_contents['cart_ship'] = (float) $value;
    }

    public function subtotal()
    {
        return $this->subtotal = ($this->total(TRUE) - $this->tax());
    }

    public function set($row_id, $params = array())
    {
        $contents = $this->contents();
        $data     = array_merge($contents[$row_id], $params);
        $this->remove($row_id);
        $this->insert($data);
    }

    public function clear($row_id, $key)
    {
        if( isset($this->_cart_contents[$row_id][$key]) ) {

            $data = $this->_cart_contents[$row_id];
            unset($data[$key]);
            $this->remove($row_id);
            $this->insert($data);

        }
    }

}
