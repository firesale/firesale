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
        Events::register('product_get', array($this, 'product_get'));
        Events::register('category_get', array($this, 'category_get'));
        Events::register('clear_cache', array($this, 'clear_cache'));

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
            $controller->tabs['_design'] = '{{ firesale_design:form type="'.$page.'" id="'.$id.'" }}';

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

            }

        }

    }

    public function product_get($product)
    {

        // Get design
        $design = $this->ci->pyrocache->model('design_m', 'get_design', array('product', $product['id']), $this->ci->firesale->cache_time);

        // Check we have data
        if( $design ) {

            // Return for merge
            return array('design' => $design);
        }

        // Add nothing
        return array();
    }

    public function category_get($category)
    {

        // Get design
        $design = $this->ci->pyrocache->model('design_m', 'get_design', array('category', $category['id']), $this->ci->firesale->cache_time);

        // Check we have data
        if( $design ) {

            // Build data to be assigned
            $data = array(
                'design_enabled' => $design['enabled'],
                'design_layout'  => array('id' => $design['layout'], 'key' => $design['layout']),
                'design_view'    => array('id' => $design['view'], 'key' => $design['view'])
            );

            // Return for merge
            return $data;
        }

        // Unset enabled
        return array('design_enabled' => false);
    }

    public function clear_cache()
    {
        $this->ci->pyrocache->delete_all('design_m');
    }

}
