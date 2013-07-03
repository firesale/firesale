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
* @package firesale/core
* @author FireSale <support@getfiresale.org>
* @copyright 2013 Moltin Ltd.
* @version dev
* @link http://github.com/firesale/firesale
*
*/

class Ajax extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Load required items
        $this->load->driver('Streams');
        $this->load->library('files/files');
        $this->lang->load('firesale');
        $this->load->helper('general');

        // Add initial items
        $this->data = new stdClass();

        // Ensure request was made
        if ( ! $this->input->is_ajax_request() ) { show_404(); }
	}

    /**
     * Gets the category details and returns a JSON
     * array for use in the front-end view editing.
     *
     * @param  integer $id The Category ID to retrieve
     * @return string  A JSON Object containing the
     *                Category information.
     * @access public
     */
    public function category_details($id)
    {
        // Load required items
        $this->load->model('categories_m');

        // Get category
        $category = $this->pyrocache->model('categories_m', 'get_category', array($id), $this->firesale->cache_time);

        // Build output
        $this->output->set_content_type('application/json')
                     ->set_output(json_encode($category));
    
        return;
    }

    /**
     * Gets the category images and returns an HTML string to be appended into the
     * tab created for each category.
     *
     * @param  integer $id The Category ID to retrieve
     * @return string  HTML for dropbox and image display
     * @access public
     */
    public function category_images($id)
    {
        // Variables
        $data   = array();
        $stream = $this->streams->streams->get_stream('firesale_categories', 'firesale_categories');
        $row    = $this->pyrocache->model('row_m', 'get_row', array($id, $stream, false), $this->firesale->cache_time);

        // Check for data
        if ( $row != false ) {
            $folder         = get_file_folder_by_slug($row->slug, 'category-images');
            $images         = Files::folder_contents($folder->id);
            $data['images'] = $images['data']['file'];
        }

        // Return to script
        echo $this->parser->parse('admin/categories/images', $data, true);
        exit();
    }

    public function product_get($id)
    {
        // Load required items
        $this->load->model('products_m');

        // Get product
        $product = $this->pyrocache->model('products_m', 'get_product', array($id), $this->firesale->cache_time);

        // Build output
        $this->output->set_content_type('application/json')
                     ->set_output(json_encode($product));
    
        return;
    }

    public function product_filter($page)
    {
        // Load required items
        $this->load->model('products_m');

        // Variables
        $perpage = 30;
        $data    = array('products' => array(), 'pagination' => '');
        $start   = ( isset($_POST['start']) ? $_POST['start'] : $page );
        $start   = ( $start > 0 ? ( $start - 1 ) * $perpage : 0 );

        unset($_POST['start']);

        // Get filtered product IDs
        $data['count'] = $this->pyrocache->model('products_m', 'get_products', array($this->input->post()), $this->firesale->cache_time);
        $products      = $this->pyrocache->model('products_m', 'get_products', array($this->input->post(), $start, $perpage), $this->firesale->cache_time);

        // Get product data
        foreach ( $products as $product ) {
            $data['products'][] = $this->pyrocache->model('products_m', 'get_product', array($product['id']), $this->firesale->cache_time);
        }

        // Assign data
        $data['count']      = ( $data['count'] ? count($data['count']) : 0 );
        $data['pagination'] = create_pagination('admin/firesale/products/', $data['count'], $perpage, 4);

        // Build page
        $this->template->set_layout(false)
                       ->build('admin/products/index', $data);
    }

    public function product_edit()
    {
        // Load required items
        $this->load->model('products_m');

        // Variables
        $update = true;
        $stream = $this->streams->streams->get_stream('firesale_products', 'firesale_products');
        $start  = $this->input->post('start');
        $post   = $this->input->post('product');

        // Check action
        if ( $this->input->post('btnAction') == 'save' ) {

            // Check products are set
            if ( $post and ! empty($post) ) {
                // Loop products
                foreach ( $this->input->post('product') as $id => $product ) {
                    // Update products
                    if ( ! $this->products_m->update_product($id, $product, $stream->id, true) ) {
                        $update = false;
                    }
                }
            }

            // Set flashdata
            if ( $update ) {
                $this->session->set_flashdata('success', lang('firesale:prod_edit_success'));
            } else {
                $this->session->set_flashdata('error', lang('firesale:prod_edit_error'));
            }
        }

        // Clear cache
        Events::trigger('clear_cache');

        // Clear post
        unset($_POST);

        // Call index for layout update
        echo ( $update ? 'ok' : 'error' );
    }

    public function modifiers_order()
    {
        echo order_table($this->input->post('order'), 'firesale_product_modifiers', 'mod_');
        exit();
    }

    public function variations_order()
    {
        echo order_table($this->input->post('order'), 'firesale_product_variations', 'var_');
        exit();
    }

    public function routes_order()
    {
        // Load required items
        $this->load->model('routes_m');

        // Order and rebuild
        echo order_table($this->input->post('order'), 'firesale_routes', 'route_');
        $this->routes_m->clear();
        $this->rebuild(false);
        exit();
    }

    public function images_order()
    {
        // Variables
        $order = $this->input->post('order');

        // Check data
        if ( strlen($order) > 0 ) {

            $order = explode(',', $order);

            for ( $i = 0; $i < count($order); $i++ ) {
                $this->db->where('id', $order[$i])->update('files', array('sort' => $i));
            }

            // Updated, clear cache!
            Events::trigger('clear_cache');

            echo 'ok';
            exit();
        }

        echo 'error';
        exit();
    }

}
