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
* @package firesale/design
* @author FireSale <support@getfiresale.org>
* @copyright 2013 Moltin Ltd.
* @version master
* @link http://github.com/firesale/firesale
*
*/

class Plugin_Firesale_design extends Plugin
{

    public function form()
    {

        // Load required items
        $this->load->model('firesale_design/design_m');

        // Attributes
        $type = $this->attribute('type');
        $id   = (int)$this->attribute('id');

        // Check attributes
        if( $type ) {

            $theme   = $this->settings->get('default_theme');
            $layouts = $this->template->get_theme_layouts($theme);
            $views   = $this->design_m->get_theme_views($theme);

            // Build data
            $data          = new stdClass;
            $data->type    = $type;
            $data->id      = $id;
            $data->layouts = array();
            $data->views   = array();
            $data->design  = $this->design_m->get_design($type, $id);

            // Format layout names
            foreach( $layouts as $layout ) {
                $data->layouts[$layout] = $this->design_m->format_name($layout);
            }

            // Format view names
            foreach( $views as $view ) {
                $data->views[$view] = $this->design_m->format_name($view);
            }

            // Build form
            return $this->parser->parse('firesale_design/form', $data, true);
        }

        return false;
    }

}
