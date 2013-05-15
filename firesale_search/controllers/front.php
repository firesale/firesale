<?php defined('BASEPATH') or exit('No direct script access allowed');

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
* @package firesale/search
* @author FireSale <support@getfiresale.org>
* @copyright 2013 Moltin Ltd.
* @version master
* @link http://github.com/firesale/firesale
*
*/

class front extends Public_Controller
{
    private $validation_rules = array();

    public $section = "search";
    public $perpage = 15;

    public function __construct()
    {

        parent::__construct();

        // Load libraries
        $this->lang->load('firesale_search/firesale');
        $this->load->model('firesale/products_m');
        $this->load->model('firesale/routes_m');
        $this->load->model('search_m');
        $this->load->helper('firesale/general');

        // Set data object
        $this->data = new stdClass;

        // Get perpage option
        $this->perpage = (int) $this->settings->get('firesale_perpage', 15);

    }

    public function index($category = NULL, $term = NULL, $start = 0)
    {

        // Redirect
        if ( $this->input->post('btnAction') == 'search' ) {
            $category = $this->input->post('category');
            $term	  = $this->input->post('search');
            unset($_POST);
            redirect($this->routes_m->build_url('search').($category?$category:'all').'/'.$term);
        }

        // Assign base variables
        $this->data->layout     = $this->input->cookie('firesale_listing_style') ? $this->input->cookie('firesale_listing_style') : 'grid';
        $this->data->order      = get_order($this->input->cookie('firesale_listing_order') ? $this->input->cookie('firesale_listing_order') : 1 );
        $this->data->categories = $this->search_m->get_cat_dropdown($category);
        $this->data->ordering   = get_order();
        $this->data->products   = FALSE;
        $this->data->parent     = 0;
        $this->data->current    = $term;
        $this->data->cat        = $category;
        $this->data->term       = urldecode($term);

        // Check for search term
        if ($term !== NULL) {

            // Update search terms
            $this->search_m->update_terms(urldecode($term));

            // Check for category match first
            if ( $category != 'all' AND $is_cat = $this->search_m->check_category($term) ) {
                // Send there if we got exact match
                redirect($this->routes_m->build_url('category', $is_cat));
            }

            // Get search results
            $total_rows 		  = $this->search_m->perform_search($category, $term, 0, 0, NULL, TRUE);
            $this->data->products = $this->search_m->perform_search($category, $term, $start, $this->perpage, $this->data->order);

            if ($total_rows > 1) {

                if ($total_rows > $this->perpage) {
                    // Assign pagination
                    $this->data->pagination  = create_pagination($this->routes_m->build_url('search').$category.'/'.$term.'/', $total_rows, $this->perpage, 4);
                }

                // Get images
                foreach ($this->data->products AS $key => $product) {
                    $product['image']           = $this->products_m->get_single_image($product['id']);
                    $product['description']     = strip_tags($product['description']);
                    $this->data->products[$key] = $product;
                }

                // Fix helper variables
                $this->data->products = reassign_helper_vars($this->data->products);

                // Assign current search
                $this->data->from  = $start;
                $this->data->to	   = $start + $this->perpage;
                $this->data->total = $total_rows;

            } elseif ( $total_rows == 1 AND !$this->input->is_ajax_request() ) {
                // Redirect to page with one result
                redirect($this->routes_m->build_url('product', $this->data->products[0]['id']));
            }

        }

        // Check for ajax
        if ( $term !== NULL AND $this->input->is_ajax_request() ) {
            $results = array();
            foreach ($this->data->products AS $result) {
                $results[] = array('label' => $result['title'], 'value' => $this->routes_m->build_url('product', $result['id']));
            }
            echo json_encode($results);
            exit();
        } else {
            // Build page
            $this->template->set_breadcrumb('Home', '/')
                           ->set_breadcrumb(lang('firesale:sections:search'), $this->routes_m->build_url('search'))
                           ->append_css('module::search.css')
                           ->title(sprintf(lang('firesale:sections:search' . ( $this->data->term != NUll ? '_results' : '' )), $this->data->term))
                           ->build('search', $this->data);
        }

    }

}
