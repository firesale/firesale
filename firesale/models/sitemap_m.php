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
* @version dev
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
        // Get data, don't get product variations if they are not required
        $show_variations = (bool) $this->settings->get('firesale_show_variations');
    
        if($table == 'firesale_products' and ! $show_variations)
        {
            $query = $this->db->select('id, updated')
                            ->from($table)
                            ->where(array('status' => '1', 'is_variation' => '0'))
                            ->order_by('ordering_count')
                            ->get();
        }
        else
        {
            $query = $this->db->select('id, updated')
                            ->from($table)
                            ->where('status', '1')
                            ->order_by('ordering_count')
                            ->get();
        }
    
        // Check for data
        if( $query->num_rows() ) {
    
            // Get results
            $results = $query->result_array();
    
            // Loop and format
            foreach( $results as &$result ) {
                $result['updated'] = strtotime($result['updated']);
                $result['url']     = url($type, $result['id']);
            }
    
            return $results;
        }
    
        // Nothing found
        return false;
    }

}
