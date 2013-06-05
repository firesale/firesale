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
* @version master
* @link http://github.com/firesale/firesale
*
*/

class Plugin_Firesale extends Plugin
{

    public $version = '1.2.0';

    public $name = array(
        'en'    => 'FireSale'
    );

    public $description = array(
        'en'    => 'Core FireSale plugin methods'
    );

    public function __construct()
    {
        $this->load->library('files/files');
        $this->load->model('categories_m');
        $this->load->model('products_m');
        $this->load->model('routes_m');
        $this->load->model('taxes_m');
        $this->load->model('currency_m');
        $this->load->helper('general');
    }

    public function url()
    {

        // Variables
        $route = $this->attribute('route');
        $id    = $this->attribute('id');
        $after = $this->attribute('after');
        $base = $this->attribute('base', 'yes');

        // Get the URL
        $url = $this->pyrocache->model('routes_m', 'build_url', array($route, $id), $this->firesale->cache_time);

        // Build the URL
        return (($base == 'yes') ? BASE_URL : '').$url.$after;
    }

    public function module_installed()
    {

        // Variables
        $module = $this->attribute('slug', 'firesale');

        // Check
        $query = $this->db->select('id')->where('slug', $module)->where('installed', '1')->get('modules');

        if ( $query->num_rows() ) {
            return TRUE;
        }

        return FALSE;
    }

    public function enabled_gateways()
    {
        return $this->gateways->get_enabled();
    }

    public function categories()
    {

        // Variables
        $attributes = $this->attributes();
        
        // if no ordering specified default to tree order
        if ( ! isset($attributes['order']) and ! isset($attributes['order-by']) ) {
            $attributes['order'] = 'ordering_count asc';
        } else if ( isset($attributes['order-by']) ) {
            $attributes['order'] = $attributes['order-by'].' '.( isset($attributes['order-dir']) ? $attributes['order-dir'] : 'asc' );
        }
        
        // Are we cached?
        $cache_key  = md5(BASE_URL.implode('|', $attributes));

        // Get from cache
        if ( ! $results = $this->cache->get($cache_key) ) {

            // Build query
            $query = $this->db->select('id')
                              ->from('firesale_categories')
                              ->where('status', '1');

            // Add to query
            foreach ($attributes AS $key => $val) {

                switch ($key) {

                    case 'limit':
                        $query->limit($val);
                    break;

                    case 'order':
                        list($by, $dir) = explode(' ', $val);
                        $query->order_by($by, $dir);
                    break;

                    case 'empty':
                        if ($val == 'false') {
                            $this->db->where('(SELECT COUNT(id)
                                              FROM ' . $this->db->dbprefix('firesale_products_firesale_categories') . '
                                              WHERE firesale_categories_id=' . $this->db->dbprefix('firesale_categories.id') . ') >', 0);
                        }
                    break;

                    case 'parse_params':
                    case 'order-by':
                    case 'order-dir':
                    break;

                    default:
                        $query->where($key, $val);
                    break;

                }

            }

            // Get categories
            $results = $query->get()->result_array();

            // Loop and get objects
            foreach ($results AS &$category) {
                $category = $this->pyrocache->model('categories_m', 'get_category', array($category['id']), $this->firesale->cache_time);
            }

            // Fix helper variables
            $results = reassign_helper_vars($results);

            // Add to cache
            $this->cache->save($cache_key, $results, $this->firesale->cache_time);
        }

        return array(array('total' => count($results), 'entries' => $results));
    }

    public function sub_categories()
    {

        // Return
        return $this->categories();
    }

    public function sub_sub_categories()
    {

        // Return
        return $this->categories();
    }

    public function products()
    {

        // Variables
        $attributes      = $this->attributes();
        $show_variations = (bool) $this->settings->get('firesale_show_variations');
        $cache_key       = md5(BASE_URL.implode('|', $attributes));

        // Get from cache
        if ( ! $results = $this->cache->get($cache_key) ) {

            // Children?
            if ( isset($attributes['category']) ) {
                $children   = $this->categories_m->get_children($attributes['category']);
                $children[] = $attributes['category'];
            }

            // Build query
            $query = $this->db->select('p.id')
                              ->from('firesale_products AS p')
                              ->join('firesale_products_firesale_categories AS pc', 'pc.row_id = p.id', 'inner')
                              ->join('firesale_categories AS c', 'c.id = pc.firesale_categories_id')
                              ->where('p.status', '1')
                              ->group_by('p.slug');

            if ( ! $show_variations)
                $query->where('is_variation', 0);

            // Add to query
            foreach ($attributes AS $key => $val) {

                switch (trim(substr($key, 0, 9))) {

                    case 'parse_par':
                    break;

                    case 'attribute':
                        $r = array_map('strrev', explode('=', strrev($val), 2));
                        $query->join('firesale_attributes_assignments AS aa', 'aa.row_id = p.id', 'inner')
                              ->join('firesale_attributes AS a', 'a.id = aa.attribute_id', 'inner')
                              ->where('aa.value', trim($r[0]))
                              ->where('a.title', trim($r[1]));
                    break;

                    case 'limit':
                        $query->limit($val);
                    break;

                    case 'order':
                        list($by, $dir) = explode(' ', $val);
                        $query->order_by('p.' . $by, $dir);
                    break;

                    case 'category':
                        $query->where_in('c.id', $children);
                    break;

                    case 'where':
                        $query->where($val, null, false);
                    break;

                    default:
                        $query->where($key, $val);
                    break;

                }

            }

            // Run query
            $results = $query->get()->result_array();

            // Get products
            foreach ($results AS &$result) {
                $result = $this->products_m->get_product($result['id']);
            }

            // Fix helper variables
            $products = reassign_helper_vars($products);

            // Add to cache
            $this->cache->save($cache_key, $results, $this->firesale->cache_time);
        }

        // Send it back
        return array(array('total' => count($results), 'entries' => $results));
    }

    public function bestsellers()
    {
        $limit = $this->attribute('limit', 10);
        $order = $this->attribute('order', 'p.created asc');

        list($order, $order_dir) = explode(' ', $order);

        $results = $this->db
            ->select("COUNT(oo.product_id) as count, p.id")
            ->from('firesale_products AS p')
            ->join('firesale_orders_items AS oo', 'p.id = oo.product_id', 'left')
            ->order_by('count', 'desc')
            ->order_by($order, $order_dir)
            ->limit($limit)
            ->get()
            ->result();

        foreach ($results as &$product) {
            $product = $this->pyrocache->model('products_m', 'get_product', array($product->id), $this->firesale->cache_time);
        }

        return array(array('total' => count($results), 'entries' => $results));
    }

    public function modifier_form()
    {

        // Variables
        $type    = $this->attribute('type', 'select'); // radio
        $product = $this->attribute('product');
        $product = $this->products_m->get_product($product);

        // Format data
        foreach ($product['modifiers'] as &$modifier) {
            $first = true;
            foreach ($modifier['variations'] as &$variation) {
                $variation['mod_id']   = $modifier['id'];
                $variation['selected'] = ( $first ? 'checked="checked" ' : '' );
                $first = false;
            }
        }

        // Assign data
        $data            = new stdClass;
        $data->type      = $type;
        $data->product   = $product;
        $data->modifiers = $product['modifiers'];

        // Build form
        return $this->parser->parse('partials/modifier_form', $data, true);
    }

    public function cart()
    {

        // Load libraries
        $this->load->library('fs_cart');

        // Get currency
        $currency = ( $this->session->userdata('currency') ? $this->session->userdata('currency') : NULL );
        $currency = $this->pyrocache->model('currency_m', 'get', array($currency), $this->firesale->cache_time);

        // Variables
        $data 		 	= new stdClass;
        $data->products = array();

        // Loop products in cart
        foreach ( $this->fs_cart->contents() as $id => $item ) {

            $product = $this->pyrocache->model('products_m', 'get_product', array($item['id']), $this->firesale->cache_time);

            if ($product !== FALSE) {

                $product['quantity'] = $item['qty'];
                $product['name']     = $item['name'];
                $product['price']    = $item['price'];
                $product['ship']     = $item['ship'];
                $product['subtotal'] = $this->currency_m->format_string($item['subtotal'], $currency, false);
                $product['rowid']    = $item['rowid'];

                $data->products[] = $product;

            }

        }

        // Calculate prices
        $data->tax   = $this->currency_m->format_string($this->fs_cart->tax(), $currency, false);
        $data->sub   = $this->currency_m->format_string($this->fs_cart->subtotal(), $currency, false);
        $data->total = $this->currency_m->format_string($this->fs_cart->total(), $currency, false);
        $data->count = $this->fs_cart->total_items() ? $this->fs_cart->total_items() : '&#48;';

        // Fix helper variables
        $data->products = reassign_helper_vars($data->products);

        // Retrun data
        return array($data);
    }

    public function currencies()
    {

        // Select all currencies
        $results = $this->db->select('id')->get('firesale_currency')->result_array();

        // Loop them
        foreach ($results AS &$currency) {
            // Retrieve data
            $currency = $this->currency_m->get($currency['id']);
        }

        // Fix helper variables
        $results = reassign_helper_vars($results);

        return array(array('total' => count($results), 'entries' => $results));
    }

    public function addresses()
    {
        // Variables
        $default = ( isset($this->current_user->id) ? $this->current_user->id : null );
        $user    = $this->attribute('user_id', $default);
        $total   = 0;
        $results = false;

        // Check for user
        if ( $user !== null ) {
           
            $this->load->model('address_m');

            // Get addresses
            $results = $this->pyrocache->model('address_m', 'get_addresses', array($user), $this->firesale->cache_time);
        }

        return array(array('total' => count($results), 'entries' => $results));
    }

    public function orders()
    {
        // Variables
        $default = ( isset($this->current_user->id) ? $this->current_user->id : null );
        $user    = $this->attribute('user_id', $default);
        $total   = 0;
        $results = false;

        // Check for user
        if ( $user !== null ) {
           
            $this->load->model('orders_m');

            // Get addresses
            $results = $this->pyrocache->model('orders_m', 'get_orders_by_user', array($user), $this->firesale->cache_time);
        }

        return array(array('total' => count($results), 'entries' => $results));
    }

    /**
     * Returns a PluginDoc array that PyroCMS uses
     * to build the reference in the admin panel
     *
     * All options are listed here but refer
     * to the Blog plugin for a larger example
     *
     * @return array
     */
    public function _self_doc()
    {
        $info = array(
            'url' => array(
                'description' => array(
                    'en' => 'Returns a formatted dynamic URL for a given route'
                ),
                'single'           => true,
                'double'           => false,
                'variables'        => '',
                'attributes'       => array(
                    'route'        => array(
                        'type'     => 'slug',
                        'flags'    => '',
                        'default'  => null,
                        'required' => true,
                    ),
                    'id'           => array(
                        'type'     => 'number',
                        'flags'    => '',
                        'default'  => null,
                        'required' => false,
                    ),
                    'after'        => array(
                        'type'     => 'text',
                        'flags'    => '',
                        'default'  => null,
                        'required' => false
                    )
                ),
            ),
            'module_installed' => array(
                'description' => array(
                    'en' => 'Returns true/false if a module is currently installed or not'
                ),
                'single'           => true,
                'double'           => false,
                'variables'        => '',
                'attributes'       => array(
                    'module'       => array(
                        'type'     => 'slug',
                        'flags'    => '',
                        'default'  => 'firesale',
                        'required' => false,
                    )
                ),
            ),
            'categories' => array(
                'description' => array(
                    'en' => 'The categories plugin is a great way to get a list of your categories for navigation, sidebars, or anywhere else you\'d like them. It has a number of options to get exactly what you want to display and provides a complete category object for you to display.'
                ),
                'single'           => false,
                'double'           => true,
                'variables'        => 'id|title|slug|description|images|links',
                'attributes'       => array(
                    'limit'        => array(
                        'type'     => 'number',
                        'flags'    => '',
                        'default'  => null,
                        'required' => false
                    ),
                    'order'        => array(
                        'type'     => 'text',
                        'flags'    => 'column asc|desc',
                        'default'  => 'id asc',
                        'required' => false
                    ),
                    'empty'        => array(
                        'type'     => 'text',
                        'flags'    => 'true|false',
                        'default'  => 'false',
                        'required' => false
                    ),
                    'column'       => array(
                        'type'     => 'text',
                        'flags'    => 'column="value"|column=">value"|column="<value"|etc.',
                        'default'  => null,
                        'required' => false
                    )
                )
            ),
            'sub_categories'  => array(
                'description'      => array(
                    'en'           => 'The same as categories, accepting the same attributes but usable within the categories plugin (overcomes a lex bug)'
                ),
                'single'           => false,
                'double'           => true,
                'variables'        => 'id|title|slug|description|images|links',
                'attributes'       => array(
                    'parent'       => array(
                        'type'     => 'number',
                        'flags'    => '',
                        'default'  => null,
                        'required' => false
                    )
                )
            ),
            'products'  => array(
                'description'      => array(
                    'en'           => 'Returns an array of products based on your dynamic attributes (much like categories)'
                ),
                'single'           => false,
                'double'           => true,
                'variables'        => 'id|code|title|slug|rrp|rrp_tax|price|price_tax|description|snippet|images|status|stock|stock_status|price_formatted|price_tax_formatted|rrp_formatted|rrp_tax_formatted',
                'attributes'       => array(
                    'limit'        => array(
                        'type'     => 'number',
                        'flags'    => '',
                        'default'  => null,
                        'required' => false
                    ),
                    'order'        => array(
                        'type'     => 'text',
                        'flags'    => 'column asc|desc',
                        'default'  => 'id asc',
                        'required' => false
                    ),
                    'column'       => array(
                        'type'     => 'text',
                        'flags'    => 'column="value"|column=">value"|column="<value"|etc.',
                        'default'  => null,
                        'required' => false
                    )
                )
            )
        );

        return $info;
    }

}
