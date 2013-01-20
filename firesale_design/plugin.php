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
        $data->layouts = $this->design_m->get_layouts();

        // Get

        // Build form
        return $this->parser->parse('firesale_design/form', $data, true);
    }

}
