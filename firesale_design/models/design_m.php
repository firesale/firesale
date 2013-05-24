<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

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

class Design_m extends MY_Model
{

    public function get_theme_views($theme)
    {

        $views = array();

        foreach ($this->template->theme_locations() as $location) {
            if(is_dir($location.$theme.'/views/modules')) {
                foreach(glob($location.$theme.'/views/modules/firesale*') as $module) {
                    $module = pathinfo($module, PATHINFO_BASENAME);
                    foreach(glob($location.$theme.'/views/modules/'.$module.'/*.*') as $view) {
                        $views[] = $module.'/'.pathinfo($view, PATHINFO_BASENAME);
                    }
                }
                break;
            }
        }

        return $views;
    }

    public function get_design($type, $id)
    {

        $query = $this->db->where('type', $type)
                          ->where('element', $id)
                          ->get('firesale_design');

        if( $query->num_rows() ) {
            return current($query->result_array());
        }

        return false;
    }

    public function format_name($string)
    {

        // Variables
        $replace = array('_', '.php', '.html');
        $with    = array(' ', '', '');

        // Format
        $string = explode('/', $string);
        $string = end($string);
        $string = str_replace($replace, $with, $string);

        // Return
        return ucwords($string);
    }

}
