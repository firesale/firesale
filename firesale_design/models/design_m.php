<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Design_m extends MY_Model
{
    public function get_layouts()
    {

        // Load requierd items
        $this->load->model('pages/page_type_m');

        // Variables
        $pages = $this->page_type_m->get_all();
        $drop  = array('0' => 'None');

        // Format into dropdown array
        if ( ! empty($pages) ) {
            foreach ($pages as $page) {
                $drop[$page->id] = $page->title;
            }
        }

        return $drop;
    }

}
