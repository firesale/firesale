<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

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

class index extends Public_Controller
{

    /**
     * Loads the parent constructor and gets an
     * instance of CI. Also loads in the language
     * files and required models to perform any
     * required actions.
     *
     *
     * @return void
     * @access public
     */
    public function __construct()
    {

        parent::__construct();

        // Load libraries
        $this->load->driver('Streams');
        $this->load->library('files/files');
        $this->lang->load('firesale');
        $this->load->model('categories_m');
        $this->load->model('routes_m');
        $this->load->helper('firesale/general');

        // Assign data object
        $this->data = new stdClass;
    }

    public function index()
    {
        // Get top level categories
        $categories = $this->db->select('id')->where('parent', '0')->get('firesale_categories')->result_array();

        // Loop and get data
        foreach ( $categories as &$category ) {
            $category = cache('categories_m/get_category', $category['id']);
        }

        // Assign data
        $this->data->categories = $categories;

        // Build page
        $this->template->title('Store')
                       ->append_css('module::firesale.css')
                       ->append_js('module::firesale.js')
                       ->set_breadcrumb('Store')
                       ->build('index', $this->data);
    }

}
