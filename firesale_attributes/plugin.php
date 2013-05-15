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
