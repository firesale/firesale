<?php defined('BASEPATH') or exit('No direct script access allowed');

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