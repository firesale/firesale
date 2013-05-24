<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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

class Brands_m extends MY_Model
{

    protected $cache = array();

    public function __construct()
    {
        parent::__construct();

        // Load required items
        $this->load->helper('firesale/general');
    }

    public function get($id_slug)
    {

        // Check cache
        if( array_key_exists($id_slug, $this->cache) ) {
            return $this->cache[$id_slug];
        }

        // Variables
        $type = ( 0 + $id_slug > 0 ? 'id' : 'slug' );

        // Set query paramaters
        $params	 = array(
                    'stream' 	  => 'firesale_brands',
                    'namespace'	=> 'firesale_brands',
                    'where'     => SITE_REF."_firesale_brands.{$type} = '{$id_slug}' AND ".SITE_REF."_firesale_brands.status = '1'",
                    'limit'		  => '1'
                   );

        // Get entries
        $brands = $this->streams->entries->get_entries($params);

        // Check entries
        if( count($brands['entries']) == 1 ) {

            // Get brand
            $brand = current($brands['entries']);

            // Get images
            if ( $folder = get_file_folder_by_slug($brand['slug']) ) {
                $query = $this->db->select('id, path')
                                  ->from('files')
                                  ->where('folder_id', $folder->id)
                                  ->get();
                $brand['images'] = $query->result_array();
            }

            // Get categories
            $brand['categories'] = $this->pyrocache->model('brands_m', 'get_categories', array($brand['id']), $this->firesale->cache_time);

            // Return it
            return $brand;
        }

        // Nothing found
        return FALSE;
    }

    public function get_categories($brand)
    {

        $query = $this->db->select('c.id, c.title, c.slug, b.id as brand_id')
                          ->from('firesale_brands AS b')
                          ->join('firesale_products AS p', 'p.brand = b.id', 'inner')
                          ->join('firesale_products_firesale_categories AS pc', 'pc.row_id = p.id')
                          ->join('firesale_categories AS c', 'c.id = pc.firesale_categories_id')
                          ->where('b.id', $brand)
                          ->where('p.status', '1')
                          ->where('c.status', '1')
                          ->group_by('c.id')
                          ->order_by('c.title', 'asc')
                          ->get();

        if ( $query->num_rows() ) {
            $results = $query->result_array();
            return $results;
        }

        return false;
    }

    public function get_products($brand, $perpage, $start, $by, $dir, $category = null)
    {
        // Variations
        $show_variations = (bool) $this->settings->get('firesale_show_variations');

        // Build query
        $query = $this->db->select('p.id')
                          ->from('firesale_products AS p')
                          ->where('p.brand', $brand)
                          ->where('p.status', '1')
                          ->order_by('p.' . $by, $dir)
                          ->limit($perpage, $start);

        // Hide variations
        if ( ! $show_variations ) {
            $query->where('is_variation', '0');
        }

        // Add category
        if ( $category !== null ) {
            $query->join('firesale_products_firesale_categories AS fc', 'fc.row_id = p.id', 'inner')
                  ->join('firesale_categories AS c', 'c.id = fc.firesale_categories_id', 'inner')
                  ->where('c.slug', $category)
                  ->group_by('p.id');
        }

        // Run the query
        $query = $query->get();

        // Check for results
        if( $query->num_rows() ) {

            // Get results
            $results = $query->result_array();

            // Loop
            foreach( $results AS &$product ) {
                // Get product
                $product = $this->pyrocache->model('products_m', 'get_product', array($product['id']), $this->firesale->cache_time);
            }

            // Return
            return $results;
        }

        // No results
        return FALSE;
    }

    public function get_count($brand, $category = null)
    {

        // Build query
        $query = $this->db->select('p.id')
                          ->from('firesale_products AS p')
                          ->where('p.brand', $brand)
                          ->where('p.status', '1');

        // Add category
        if ( $category !== null ) {
            $query->join('firesale_products_firesale_categories AS fc', 'p.id = fc.row_id', 'inner')
                  ->join('firesale_categories AS c', 'c.id = fc.firesale_categories_id', 'inner')
                  ->where('c.slug', $category)
                  ->group_by('p.id');
        }

        // Run query
        $query = $query->get();

        return $query->num_rows();
    }

    public function build_breadcrumbs($brand, $category = null)
    {

        // Variables
        $url    = $this->pyrocache->model('routes_m', 'build_url', array('brand', $brand['id']), $this->firesale->cache_time);
        $crumbs = array();

        // Set default breadcrumbs
        $crumbs[lang('firesale:sections:brands')] = 'brands';
        $crumbs[$brand['title']]  = $url;

        // Set category breadcrumbs
        if ( $category !== null ) {
            $result = $this->db->select('title, id')->where('slug', $category)->get('firesale_categories')->row();
            $crumbs[$result->title] = $url.$category;
        }

        return $crumbs;
    }

}
