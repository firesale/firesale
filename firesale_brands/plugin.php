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
* @package firesale/brands
* @author FireSale <support@getfiresale.org>
* @copyright 2013 Moltin Ltd.
* @version master
* @link http://github.com/firesale/firesale
*
*/

class Plugin_Firesale_brands extends Plugin
{

    public function __construct()
    {

        // Load requirements
        $this->load->library('files/files');
        $this->load->model('brands_m');

    }

    public function get()
    {

        // Variables
        $attributes = $this->attributes();
        $cache_key  = md5(BASE_URL.implode('|', $attributes));

        if ( ! $brands = $this->cache->get($cache_key) ) {
            // Build query
            $query = $this->db->select('firesale_brands.id')
                              ->where('status', '1');

            // Add to query
            foreach ($attributes AS $key => $val) {

                switch ($key) {

                    case 'limit':
                        $query->limit($val);
                    break;

                    case 'order':
                        list($by, $dir) = explode(' ', $val);
                        $query->order_by($by, $dir);
                    break;

                    case 'parse_params':
                    break;

                    default:
                        $query->where($key, $val);
                    break;

                }

            }

            // Run query
            $brands = $query->get('firesale_brands')->result_array();

            // Get brands
            foreach ($brands AS &$result) {
                $result = $this->pyrocache->model('brands_m', 'get', ($result['id']), $this->firesale->cache_time);
            }

            // Fix helper variables
            $brands = reassign_helper_vars($brands);

            // Add to cache
            $this->cache->save($cache_key, $brands, $this->firesale->cache_time);

        }

        if ($brands) {
            return array(array('brands' => $brands));
        }

        // Nothing?
        return array('brands' => FALSE);
    }

}
