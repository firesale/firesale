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

class Sitemap_m extends MY_Model
{

    public function assign($data, &$doc)
    {

        if( $data and ! empty($data) ) {

            foreach( $data as $item ) {

                $node = $doc->addChild('url');
                $node->addChild('loc', $item['url']);

                if ($item['updated']) {
                    $node->addChild('lastmod', date(DATE_W3C, $item['updated']));
                }

            }

        }

    }

    public function retrieve($type, $table)
    {

        // Get data
        $query = $this->db->select('id, updated')
                          ->from($table)
                          ->where('status', '1')
                          ->order_by('ordering_count')
                          ->get();

        // Check for data
        if( $query->num_rows() ) {

            // Get results
            $results = $query->result_array();

            // Loop and format
            foreach( $results as &$result ) {
                $result['updated'] = strtotime($result['updated']);
                $result['url']     = site_url();
                $result['url']    .= $this->pyrocache->model('routes_m', 'build_url', array($type, $result['id']), $this->firesale->cache_time);
            }

            return $results;
        }

        // Nothing found
        return false;
    }

}
