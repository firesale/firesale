<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Plugin_Firesale_design extends Plugin
{

    public function form()
    {

        // Load required items
        $this->load->model('firesale_design/design_m');

        // Variables
        $type = $this->attribute('type', 'product');
        $id   = (int) $this->attribute('id');

        // Build data
        $data          = new stdClass;
        $data->layouts = $this->template->get_layouts();

        // Format names
        foreach( $data->layouts as &$layout ) {
            $layout = ucwords(str_replace(array('_', '.php', '.html'), array(' ', '', ''), $layout));
        }

        // Build form
        return $this->parser->parse('firesale_design/form', $data, true);
    }

}
