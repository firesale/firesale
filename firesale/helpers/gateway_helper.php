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

function require_gateway($gateway)
{
    $ci =& get_instance();

    if ( ! property_exists($ci, 'merchant')) $ci->load->driver('firesale/merchant');

    if (stripos($gateway, 'merchant_') === 0) {
        $driver_class = ucfirst(strtolower($gateway));
    } else {
        $driver_class = 'Merchant_'.strtolower($gateway);
    }

    if ( ! class_exists($driver_class)) {

        foreach ($ci->merchant->get_driver_paths() as $path) {
            $driver_path = $path.'/'.strtolower($driver_class).'.php';

            if ( ! file_exists($driver_path)) continue;

            require_once($driver_path);

            if ( ! class_exists($driver_class)) return FALSE;
        }

    }
}
