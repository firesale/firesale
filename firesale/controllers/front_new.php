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
* @version master
* @link http://github.com/firesale/firesale
*
*/

class Front_new extends Public_Controller
{
    /**
     * Contains the maximum number of products to show in the
     * front-end view, also used for pagination.
     *
     * @var integer Number of products to show per-page
     * @access public
     */
    public $perpage = 15;

    public function __construct()
    {
        parent::__construct();

        // Load libraries
        $this->load->driver('Streams');
        $this->load->library('files/files');
        $this->lang->load('firesale');
        $this->load->model('categories_m');
        $this->load->model('products_m');
        $this->load->model('routes_m');
        $this->load->helper('firesale/general');

        // Assign data object
        $this->data = new stdClass;

        // Get perpage option
        $this->perpage = $this->settings->get('firesale_perpage');
    }

    public function index($start = 0)
    {
        // Get cookie data
        $order              = $this->input->cookie('firesale_listing_order');
        $this->data->layout = $this->input->cookie('firesale_listing_style') or 'grid';
        $this->data->order  = get_order(( $order != null ? $order : '1' ));

        // Get product IDs
		$filter   = array('new' => '', $this->data->order['by'] => $this->data->order['dir']);
		$ids      = $this->pyrocache->model('products_m', 'get_products', array($filter, $start, $this->perpage), $this->firesale->cache_time);;
		$total    = count($this->products_m->get_products(array('new' => '')));
		$products = array();
        
        // Loop and get product data
        foreach ( $ids as $id ) {
        	$products[] = $this->pyrocache->model('products_m', 'get_product', array($id['id']), $this->firesale->cache_time);
        }

        // Assign pagination
        if ( ! empty($products) ) {
            $url = $this->pyrocache->model('routes_m', 'build_url', array('new'), $this->firesale->cache_time);
            $this->data->pagination = create_pagination($url.'/', $total, $this->perpage, (substr_count($url, '/') + 1 ));
            $this->data->pagination['shown'] = count($products);
        }

        // Assign data
        $this->data->products = reassign_helper_vars($products);
        $this->data->ordering = get_order();

        // Build Page
        $this->template->title(lang('firesale:new:title'))
                       ->append_css('module::firesale.css')
                       ->append_js('module::firesale.js')
                       ->set($this->data)
                       ->design = 'new';

        // Fire events
        $overload = Events::trigger('page_build', $this->template);

        // Build page
        $this->template->build(( $overload ? $overload : 'new' ));
    }

}