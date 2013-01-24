<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

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
