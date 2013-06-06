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

class Module_Firesale_Search extends Module
{
    public $version = '1.2.2';
    public $language_file = 'firesale_search/firesale';

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
                'en' => 'FireSale Search',
                'fr' => 'FireSale Recherche',
                'it' => 'FireSale Ricerca'
            ),
            'description' => array(
                'en' => 'Product and category search with ajax capabilities',
                'fr' => 'Recherche dans les produits et la catégories, dynamisée par AJAX',
                'it' => 'Ricerca di prodotti e categorie, compatibile con AJAX'
            ),
            'frontend' 		=> TRUE,
            'backend' 		=> FALSE,
            'author' 		=> 'Jamie Holdroyd'
        );

        return $info;
    }

    public function install()
    {
        if ($this->firesale->is_installed()) {
            // Variables
            $_return = TRUE;

            ##################
            ## SEARCH TERMS ##
            ##################

            $search = array(
                'id' 	=> array('type' => 'INT', 'constraint' => '6', 'auto_increment' => TRUE),
                'term'	=> array('type' => 'VARCHAR', 'constraint' => '64'),
                'count'	=> array('type' => 'INT', 'constraint' => '6'),
                'sales'	=> array('type' => 'INT', 'constraint' => '6')
            );

            // Insert into the database
            $this->dbforge->add_field($search);
            $this->dbforge->add_key('id', TRUE);
            if ( !$this->dbforge->create_table('firesale_search') ) { $_return = FALSE; }

            // Add routes
            $this->routes('add');

            // Return
            return $_return;
        }
    }

    public function uninstall()
    {

        // Variables
        $_return = TRUE;

        // Drop tables
        if ( !$this->dbforge->drop_table('firesale_search') ) { $_return = FALSE; }

        // Remove routes
        $this->routes('remove');

        // Return
        return $_return;
    }

    public function upgrade($old_version)
    {

        // Pre 1.1.1
        if ($old_version < '1.1.1') {

            // Load requirements
            $this->load->model('firesale/routes_m');

            // Add search route
            $route = array('is_core' => 1, 'title' => 'lang:firesale:routes:search', 'slug' => 'search', 'table' => '', 'map' => 'search/{{ any }}', 'route' => 'search(/:any)?', 'translation' => 'firesale_search/front/index$1');
            $this->routes_m->create($route);
        }

        return TRUE;
    }

    public function routes($action)
    {

        // Load requirements
        $this->load->model('firesale/routes_m');

        // Route definitions
        $routes   = array();
        $routes[] = array('is_core' => 1, 'title' => 'lang:firesale:routes:search', 'slug' => 'search', 'table' => '', 'map' => 'search/{{ any }}', 'route' => 'search(/:any)?', 'translation' => 'firesale_search/front/index$1');

        // Perform
        foreach ($routes AS $route) {

            // Check action
            if ($action == 'add') {
                // Add
                $this->routes_m->create($route);
            } elseif ($action == 'remove') {
                // Remove
                $this->routes_m->delete($route['slug']);
            }

        }

    }

    public function help()
    {
        // Return a string containing help info
        // You could include a file and return it here.
        return "Some Help Stuff";
    }

}
