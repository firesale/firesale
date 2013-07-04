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
* @package firesale/attributes
* @author FireSale <support@getfiresale.org>
* @copyright 2013 Moltin Ltd.
* @version master
* @link http://github.com/firesale/firesale
*
*/

class Attributes_m extends MY_Model
{

    public function create($title, $get_id = false)
    {

        // Check title
        if( strlen($title) > 0 ) {

            // Check doesn't exist
            $results = $this->db->where('title', $title)->get('firesale_attributes');
            $id      = 0;

            // Insert it
            if( ! $results->num_rows() ) {

                $this->db->insert('firesale_attributes', array('title' => $title));
                $id = $this->db->insert_id();

            } else if( $get_id == true ) {

                $result = current($results->result_array());
                $id     = $result['id'];
            }

            // Clear and return
            $this->pyrocache->delete_all('attributes_m');
            $this->pyrocache->delete_all('products_m');
            return $id;
        }

        // Failed or invalid
        return 0;
    }

    public function variation($product, $variations)
    {
        // Variables
        $stream = $this->streams->streams->get_stream('firesale_products', 'firesale_products');

        // Loop variations
        foreach ( $variations as $variation ) {

            // Get product
            $query = $this->db->select('pvp.firesale_products_id AS id, pm.title AS key, pv.title AS value')
                              ->from('firesale_product_variations AS pv')
                              ->join('firesale_product_variations_firesale_products AS pvp', 'pv.id = pvp.row_id', 'inner')
                              ->join('firesale_product_modifiers AS pm', 'pm.id = pv.parent', 'inner')
                              ->where('pv.id', $variation)
                              ->get();

            // Check results
            if ( $query->num_rows() ) {

                // Loop results
                foreach ( $query->result_array() as $result ) {

                    // Create attribute
                    $result['attribute'] = $this->create($result['key'], true);

                    // Build data
                    $data = array(
                         'stream_id'    => $stream->id,
                         'row_id'       => $result['id'],
                         'attribute_id' => $result['attribute']
                    );

                    // Update value
                    if ( $this->db->where($data)->get('firesale_attributes_assignments')->num_rows() ) {
        
                        $this->db->where($data)->update('firesale_attributes_assignments', array(
                            'value' => $result['value']
                        ));
        
                    // Create value
                    } else {
        
                        $data['value'] = $result['value'];
                        $this->db->insert('firesale_attributes_assignments', $data);    
                    }

                }

            }

        }

    }

    public function build_dropdown()
    {

        // Variables
        $attributes = $this->db->select('id, title')->order_by('title')->get('firesale_attributes')->result_array();
        $drop  = array('0' => '--- '.lang('firesale:attributes:labels:select').' ---');

        // Loop and assign
        foreach( $attributes AS $attribute ) {
            $drop[$attribute['id']] = $attribute['title'];
        }

        return $drop;
    }

    public function current_attributes($row_id, $stream = 'firesale_products')
    {

        // Load required items
        $this->load->driver('Streams');

        // Variables
        $stream = $this->streams->streams->get_stream($stream, $stream);
        $where  = array('stream_id' => $stream->id, 'row_id' => $row_id);

        // Get it
        $results = $this->db->select('title, value, attribute_id AS `key`')
                            ->from('firesale_attributes AS a')
                            ->where($where)
                            ->join('firesale_attributes_assignments AS aa', 'aa.attribute_id = a.id')
                            ->order_by('ordering_count', 'asc')
                            ->get();

        if( $results->num_rows() ) {
            $data = $results->result_array();
            return $data;
        }

        return array();
    }

}
