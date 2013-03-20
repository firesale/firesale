<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Plugin_Firesale_attributes extends Plugin
{

    public function form()
    {

        // Load required items
        $this->load->model('attributes_m');

        // Variables
        $product = $this->attribute('product', NULL);
        $data    = new stdClass;

        $data->options = $this->pyrocache->model('attributes_m', 'build_dropdown', array(), $this->firesale->cache_time);

        // Get this products current attributes
        if ( $this->input->post() !== null ) {
            $data->attributes = $this->input->post('attribute');
        } else {
            $data->attributes = $this->pyrocache->model('attributes_m', 'current_attributes', array($product), $this->firesale->cache_time);
        }

        // Return view
        return $this->parser->parse('firesale_attributes/admin/product', $data, true);
    }

}
