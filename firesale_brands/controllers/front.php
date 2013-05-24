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
* @package firesale/brands
* @author FireSale <support@getfiresale.org>
* @copyright 2013 Moltin Ltd.
* @version master
* @link http://github.com/firesale/firesale
*
*/

class front extends Public_Controller
{

    public $user    = FALSE;
    public $perpage = 15;

    public function __construct()
    {

        parent::__construct();

        // Add data array
        $this->data = new stdClass();

        // Load models, lang, libraries, etc.
        $this->load->driver('Streams');
        $this->load->library('files/files');
        $this->load->model('firesale/routes_m');
        $this->load->model('brands_m');
        $this->load->model('firesale/categories_m');
        $this->load->model('firesale/products_m');
        $this->load->helper('firesale/general');

        // Get perpage option
        $this->perpage = $this->settings->get('firesale_perpage');

    }

    public function index()
    {

        // Format args
        $args     = func_get_args();
        $args     = array_filter($args);
        $start    = ( is_numeric(end($args)) ? array_pop($args) : 0 );
        $segments = count($args);
        $brand    = array_shift($args);
        $category = ( count($args) > 0 ? implode('/', $args) : null );

        // Variables
        $brand = $this->pyrocache->model('brands_m', 'get', array($brand), $this->firesale->cache_time);

        // Check it was found
        if( $brand ) {

            // Get cookie data
            $order              = $this->input->cookie('firesale_listing_order');
            $this->data->layout = $this->input->cookie('firesale_listing_style') or 'grid';
            $this->data->order  = get_order(( $order != null ? $order : '1' ));

            // Build route
            $route = $this->pyrocache->model('routes_m', 'build_url', array('brand', $brand['id']), $this->firesale->cache_time);

            // Get products
            $products = $this->pyrocache->model('brands_m', 'get_products', array($brand['id'], $this->perpage, $start, $this->data->order['by'], $this->data->order['dir'], $category), $this->firesale->cache_time);

            // Build pagination
            $count      = $this->pyrocache->model('brands_m', 'get_count', array($brand['id'], $category), $this->firesale->cache_time);
            $pagination = create_pagination($route.'/'.( $category ? $category.'/' : null ),  $count, $this->perpage, ( $segments + 2));

            // Build breadcrumbs
            foreach ( $this->brands_m->build_breadcrumbs($brand, $category) as $title => $url ) {
                if (rtrim($url,"/") == uri_string()) {
                    $this->template->set_breadcrumb($title);
                } else {
                    $this->template->set_breadcrumb($title, $url);
                }
            }

            // Assign data
            $this->data->layout     = $this->input->cookie('firesale_listing_style') ? $this->input->cookie('firesale_listing_style') : 'grid';
            $this->data->order      = get_order($this->input->cookie('firesale_listing_order') ? $this->input->cookie('firesale_listing_order') : 1);
            $this->data->ordering   = get_order();
            $this->data->brand      = $brand;
            $this->data->products   = reassign_helper_vars($products);
            $this->data->pagination = $pagination;

            asset_namespace('firesale');

            // Add page content
            $this->template->title($brand['title'])
                           ->append_css('firesale::firesale.css')
                           ->append_js('firesale::firesale.js')
                           ->set($this->data);

            // Assign accessible information
            $this->template->design = 'brand';
            $this->template->id     = $this->data->brand['id'];

            // Fire events
            $overload = Events::trigger('page_build', $this->template);

            // Build page
            $this->template->build(( $overload ? $overload : 'index' ));

        } else {
            show_404();
        }

    }

}
