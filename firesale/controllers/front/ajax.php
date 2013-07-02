<?php defined('BASEPATH') or exit('No direct script access allowed');

class Ajax extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Load required items
        $this->lang->load('firesale');
        $this->load->helper('general');

        // Add initial items
        $this->data = new stdClass();

        // Ensure request was made
        if ( ! $this->input->is_ajax_request() ) { show_404(); }
	}

}
