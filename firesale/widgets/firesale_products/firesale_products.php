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

class Widget_FireSale_Products extends Widgets
{

    // Details
    public $title       = 'FireSale Products';
    public $description = 'Display Products based on a range of options';
    public $author      = 'Jamie Holdroyd';
    public $website     = 'http://www.getfiresale.org';
    public $version     = '1.1.0';

    // Form Fields
    public $fields  =  array(
        'title'     => array('field' => 'title', 'label' => 'Title', 'rules' => 'required'),
        'category'  => array('field' => 'category', 'label' => 'Category', 'rules' => 'numeric'),
        'sale_only' => array('field' => 'sale_only', 'label' => 'Sale Items', 'rules' => 'numeric'),
        'limit'     => array('field' => 'limit', 'label' => 'Number to Show', 'rules' => 'numeric|required'),
    );

    // Element Build
    public function run($options)
    {

        // Load the models
        $this->load->model('firesale/categories_m');
        $this->load->model('firesale/products_m');

        // Variables
        $start  = 0;
        $limit  = $options['limit'];
        $params = array();

        // Add paramaters
        if ($options['category'] != '0') {
            $params['category'] = $options['category'];
        }

        if ($options['sale_only'] == '1') {
            $params['sale'] = '1';
        }

        // Get product IDs
        $products = $this->products_m->get_products($params, $start, $limit);

        // Assign products
        if ( !empty($products) ) {
            foreach ($products AS &$product) {
                $product = $this->products_m->get_product($product['id']);
            }
        }

        // Store the feed items
        return array('products' => $products);
    }

    // Options
    public function form()
    {

        // Variables
        $return = array();

        // Load the models
        $this->load->model('firesale/categories_m');
        $this->load->model('firesale/products_m');

        // Assign variables for form
        $return['categories'] = array('0' => '-----') + $this->categories_m->dropdown_values();
        $return['sale']       = array('0' => 'No', '1' => 'Yes');

        // Return
        return $return;
    }

}
