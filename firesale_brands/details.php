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
* @package firesale/brands
* @author FireSale <support@getfiresale.org>
* @copyright 2013 Moltin Ltd.
* @version master
* @link http://github.com/firesale/firesale
*
*/

class Module_Firesale_brands extends Module
{
    public $version = '1.0.2';
    public $language_file = 'firesale_brands/firesale';

    public function __construct()
    {
        parent::__construct();

        // Load in the FireSale library
        $this->load->library('firesale/firesale');
        $this->lang->load($this->language_file);
    }

    public function info()
    {

        $info = array(
            'name' => array(
                'en' => 'FireSale Brands',
                'fr' => 'FireSale Marques',
                'it' => 'FireSale Marche'
            ),
            'description' => array(
                'en' => 'Brand Management',
                'fr' => 'Gestion des marques',
                'it' => 'Gestione Marche'
            ),
            'frontend'  => FALSE,
            'backend'   => TRUE,
            'author'    => 'Jamie Holdroyd',
            'shortcuts' => array(
                array(
                    'name' 	=> 'firesale:shortcuts:brand_create',
                    'uri'	=> 'admin/firesale_brands/create',
                    'class' => 'add'
                )
            )
        );

        return $info;
    }

    public function admin_menu(&$menu)
    {
        $menu['lang:firesale:title']['lang:firesale:sections:brands'] = 'admin/firesale_brands';
    }

    public function install()
    {

        if ($this->firesale->is_installed()) {

            // Load requirements
            $this->load->driver('Streams');
            $this->load->model('firesale/categories_m');
            $this->load->model('firesale/products_m');
            $this->load->model('firesale/routes_m');
            $this->load->library('files/files');
            $this->lang->load('firesale/firesale');
            $this->lang->load('firesale_brands/firesale');

            ###################
            ## CREATE STREAM ##
            ###################

            // Create brands stream
            if( !$this->streams->streams->add_stream(lang('firesale:sections:brands'), 'firesale_brands', 'firesale_brands', NULL, NULL) ) return FALSE;

            // Get stream data
            $brands = $this->streams->streams->get_stream('firesale_brands', 'firesale_brands');

            // Add fields
            $fields   = array();
            $template = array('namespace' => 'firesale_brands', 'assign' => 'firesale_brands', 'type' => 'text', 'title_column' => FALSE, 'required' => TRUE, 'unique' => FALSE);
            $fields[] = array('name' => 'lang:firesale:label_title', 'slug' => 'title', 'type' => 'text', 'title_column' => TRUE, 'extra' => array('max_length' => 255), 'unique' => TRUE);
            $fields[] = array('name' => 'lang:firesale:label_slug', 'slug' => 'slug', 'type' => 'slug', 'extra' => array('max_length' => 255, 'slug_field' => 'title', 'space_type' => '-'));
            $fields[] = array('name' => 'lang:firesale:label_status', 'slug' => 'status', 'type' => 'choice', 'extra' => array('choice_data' => "0 : lang:firesale:label_draft\n1 : lang:firesale:label_live", 'choice_type' => 'dropdown', 'default_value' => 1));
            $fields[] = array('name' => 'lang:firesale:label_description', 'slug' => 'description', 'type' => 'wysiwyg', 'extra' => array('editor_type' => 'simple'));

            // Combine
            foreach( $fields AS &$field ) { $field = array_merge($template, $field); }

            // Add fields to stream
            $this->streams->fields->add_fields($fields);

            #####################
            ## APPEND PRODUCTS ##
            #####################

            $fields   = array();
            $template = array('namespace' => 'firesale_products', 'assign' => 'firesale_products', 'type' => 'text', 'title_column' => FALSE, 'required' => TRUE, 'unique' => FALSE);
            $fields[] = array('name' => 'lang:firesale:label_brand', 'slug' => 'brand', 'type' => 'relationship', 'extra' => array('choose_stream' => $brands->id), 'required' => FALSE);
            foreach( $fields AS &$field ) { $field = array_merge($template, $field); }
            $this->streams->fields->add_fields($fields);

            ################
            ## ADD ROUTES ##
            ################

            $route = array('title' => 'Brand', 'slug' => 'brand', 'table' => 'firesale_brands', 'map' => 'brand/{{ slug }}/{{ any }}', 'route' => 'brand/([a-z0-9-]+)?(/:any)?', 'translation' => 'firesale_brands/front/index/$1$2');
            $this->routes_m->create($route);

            return TRUE;
        }

    }

    public function uninstall()
    {

        // Load required items
        $this->load->driver('Streams');
        $this->load->model('firesale/categories_m');
        $this->load->model('firesale/products_m');
        $this->load->model('firesale/routes_m');
        $this->load->library('files/files');

        // Remove brand images
        $brand_folder = get_file_folder_by_slug('brand-images');
        if( $brand_folder != FALSE ) {

            // Get files in folder
            $files = Files::folder_contents($brand_folder->id);
            foreach( $files['data']['file'] AS $file ) {
                Files::delete_file($file->id);
            }

            // Delete folder
            Files::delete_folder($brand_folder->id);
        }

        // Remove brands field from products
        $this->streams->fields->delete_field('brand', 'firesale_products');

        // Remove streams
        $this->streams->utilities->remove_namespace('firesale_brands');

        // Remove route
        $route = current($this->db->where('slug', 'brand')->get('firesale_routes')->result_array());
        $this->routes_m->delete($route['id']);

        return TRUE;
    }

    public function upgrade($old_version)
    {
        return TRUE;
    }

    public function help()
    {
        return "Some Help Stuff";
    }

}
