<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Events_Firesale_design
{

    protected $ci;

    public $pages = array();

    public function __construct()
    {

        $this->ci =& get_instance();
        $this->ci->load->model('firesale_design/design_m');

        // Get enabled pages
        $this->pages = explode(',', $this->ci->settings->get('firesale_design_enable'));

        // register the events
        Events::register('form_build', array($this, 'form_build'));
        Events::register('page_build', array($this, 'page_build'));

    }

    public function form_build($controller)
    {

        // Variables
        $page = str_replace('admin_', '', $this->ci->controller);

        // Check if we should add to this one
        if ( in_array($page, $this->pages) ) {

            // Remove images (needs to be last)
            unset($controller->tabs['_images']);

            // Add metadata to tabs
            $controller->tabs['design'] = '{{ firesale_design:form product="'.$controller->id.'" }}';

            // Add images back in
            $controller->tabs['_images'] = array();

        }

    }

    public function page_build($template)
    {



    }

}
