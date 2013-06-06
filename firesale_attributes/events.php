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
* @package firesale/attributes
* @author FireSale <support@getfiresale.org>
* @copyright 2013 Moltin Ltd.
* @version master
* @link http://github.com/firesale/firesale
*
*/

class Events_Firesale_attributes
{

    protected $ci;

    public function __construct()
    {

        $this->ci =& get_instance();

        // Load required items
        $this->ci->load->helper('firesale/general');
        $this->ci->load->model('firesale_attributes/attributes_m');
        $this->ci->load->driver('Streams');

        // register the events
        Events::register('form_build',        array($this, 'form_build'));
        Events::register('clear_cache',       array($this, 'clear_cache'));
        Events::register('variation_created', array($this, 'variation_created'));
        Events::register('product_updated',   array($this, 'product_updated'));
        Events::register('product_get',       array($this, 'product_get'));
    }

    public function form_build($controller)
    {

        // Variables
        $id = $this->ci->uri->rsegment(3);

        // Check controller
        if( $controller->section == 'products' ) {

            // Remove images (needs to be last)
            unset($controller->tabs['_images']);

            // Add metadata to tabs
            $controller->tabs['_attributes'] = '{{ firesale_attributes:form product="'.$id.'" }}';

            // Append metadata
            asset_namespace('firesale_attributes');
            $controller->template->append_js('firesale_attributes::jquery.autogrow.js');
            $controller->template->append_js('firesale_attributes::attributes.js');
            $controller->template->append_css('firesale_attributes::attributes.css');

            // Add images back in
            $controller->tabs['_images'] = array();
        }
    }

    public function clear_cache()
    {
        $this->ci->pyrocache->delete_all('attributes_m');
    }

    public function variation_created($data)
    {
        $this->ci->attributes_m->variation($data['product'], $data['variations']);
    }

    public function product_updated($input)
    {

        // Check if it's set
        if( isset($input['attribute']) ) {

            // Loop attributes
            foreach( $input['attribute'] AS $attribute ) {

                // Deleting
                if( isset($attribute['remove']) ) {

                    // Remove
                    $where = array('row_id' => $input['id'], 'attribute_id' => $attribute['key'], 'stream_id' => $stream->id);
                    $this->ci->db->where($where)->delete('firesale_attributes_assignments');

                // Updating/Creation
                } else if( strlen(trim($attribute['value'])) > 0 ) {

                    // Variables
                    $stream = $this->ci->streams->streams->get_stream($input['stream'], $input['stream']);
                    $where  = array('row_id' => $input['id'], 'attribute_id' => $attribute['key'], 'stream_id' => $stream->id);
                    $result = $this->ci->db->where($where)->get('firesale_attributes_assignments');

                    // Update
                    if( $result->num_rows() ) {
                        $this->ci->db->where($where)->update('firesale_attributes_assignments', array('value' => $attribute['value']));
                    // Create
                    } else {
                        $data = array_merge($where, array('value' => $attribute['value']));
                        $this->ci->db->insert('firesale_attributes_assignments', $data);
                    }

                }

            }

            // Clear cache
            $this->ci->pyrocache->delete_all('attributes_m');
            $this->ci->pyrocache->delete_all('products_m');
        }

        return true;
    }

    public function product_get($product)
    {
        $this->ci->load->model('firesale_attributes/attributes_m');
        $attributes = $this->ci->pyrocache->model('attributes_m', 'current_attributes', array($product['id']), $this->firesale->cache_time);
        return array('attributes' => $attributes);
    }

}
