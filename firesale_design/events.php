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
        Events::register('admin_controller', array($this, 'admin_controller'));
        Events::register('form_build', array($this, 'form_build'));
        Events::register('page_build', array($this, 'page_build'));

    }

    public function admin_controller()
    {

        // Check if this has been posted
        if ( $this->ci->input->post('design_type') ) {

            // Variables
            $type   = $this->ci->input->post('design_type');
            $id     = $this->ci->input->post('id');
            $design = $this->ci->design_m->get_design($type, $id);

            // Old, update
            if( $design ) {

                $this->ci->db->where('id', $design['id'])
                             ->update('firesale_design', array(
                                'updated' => date("Y-m-d H:i:s"),
                                'enabled' => $this->ci->input->post('design_enabled'),
                                'layout'  => $this->ci->input->post('design_layout'),
                                'view'    => $this->ci->input->post('design_view')
                               ));
            }
            // New, insert
            else {

                // Build insert array
                $data = array(
                    'created'        => date("Y-m-d H:i:s"),
                    'created_by'     => $this->ci->current_user->id,
                    'ordering_count' => 0,
                    'type'           => $type,
                    'element'        => ( $id > 0 ? $id : $this->ci->db->insert_id() ),
                    'enabled'        => $this->ci->input->post('design_enabled'),
                    'layout'         => $this->ci->input->post('design_layout'),
                    'view'           => $this->ci->input->post('design_view')
                );

                // Add it
                $this->ci->db->insert('firesale_design', $data);
            }

            // Clear cache
            $this->ci->pyrocache->delete_all('design_m');
        }

    }

    public function form_build($controller)
    {

        // Variables
        $page = str_replace(array('admin_', 'ies', 's'), array('', 'y', ''), $this->ci->controller);
        $id   = $this->ci->uri->rsegment(3);

        // Check for annoying controller names (damn us!)
        if( $page == 'admin' ) {
            $page = str_replace(array('firesale_', 'ies', 's'), array('', 'y', ''), $this->ci->uri->segment(2));
        }

        // Check if we should add to this one
        if ( in_array($page, $this->pages) ) {

            // Remove images (needs to be last)
            unset($controller->tabs['_images']);

            // Add metadata to tabs
            $controller->tabs['design'] = '{{ firesale_design:form type="'.$page.'" id="'.$id.'" }}';

            // Add images back in
            $controller->tabs['_images'] = array();

        }

    }

    public function page_build($template)
    {

        // Check template data
        if( $template->design and $template->id ) {

            // Get design information
            $design = $this->ci->pyrocache->model('design_m', 'get_design', array($template->design, $template->id), $this->ci->firesale->cache_time);

            // Check design is set and enabled
            if( $design and $design['enabled'] == '1' ) {

                // Set layout
                $template->set_layout($design['layout']);

                // Set CSS

                // Set JS

                // Send back view
                return $design['view'];
            }

        }

    }

}
