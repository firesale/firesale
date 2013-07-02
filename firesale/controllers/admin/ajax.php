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

}
