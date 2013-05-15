<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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

class Dashboard_m extends MY_Model
{

    public function sales_duration($type = 'month', $duration = 12, $currency)
    {

        // Variables
        $data = array(
            'sales'       => array(),
            'count'       => array(),
            'products'    => array(),
            'total_sales' => 0,
            'total_count' => 0
        );

        // Get format
        switch($type) {
            case 'year':  $format = '%Y';       $order = 'asc';  $mod = 365; break;
            case 'month': $format = '%Y-%m';    $order = 'asc';  $mod = 30;  break;
            case 'day':   $format = '%Y-%m-%d'; $order = 'desc'; $mod = 1;   break;
            default:      $format = '%Y-%m';    $order = 'asc';  $mod = 30;  break;
        }

        // Build initial query
        $query = $this->db->select("SUM(i.`qty`) AS `count`, SUM(i.`qty` * i.`price`) AS `sales`, date_format(i.`created`, \"$format\") AS `{$type}`", false)
                          ->from('firesale_orders_items AS i')
                          ->join('firesale_orders AS o', 'o.id = i.order_id', 'inner')
                          ->where_in('o.order_status', array(2, 3, 4))
                          ->group_by($type)
                          ->order_by($type, $order)
                          ->limit($duration);

        // Add to query
        if ( $type == 'day' and $duration == 1 ) {
            $query->where("date_format(i.`created`, \"$format\") = ", "'".date('Y-m-d')."'", false);
        } else {
            $query->where("date_format(i.`created`, \"$format\") > ", "'".date('Y-m-d', ( time() - ( $duration * $mod ) * 24 * 60 * 60 ))."'", false);
        }

        // Run Query
        $query = $query->get();

        // Check data
        if ( $query->num_rows() ) {

            // Get data
            $results = $query->result_array();

            // Loop and format
            foreach ( $results AS $product ) {
                $data['sales'][]      = array(strtotime($product[$type]) . '000', round($product['sales'], 2));
                $data['count'][]      = array(strtotime($product[$type]) . '000', (int) $product['count']);
                $data['total_sales'] += $product['sales'];
                $data['total_count'] += $product['count'];
            }
        }

        // Format pricing
        $data['total_sales'] = $this->currency_m->format_string($data['total_sales'], $currency, false);

        return $data;
    }

}
