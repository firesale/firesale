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
* @package firesale/design
* @author FireSale <support@getfiresale.org>
* @copyright 2013 Moltin Ltd.
* @version master
* @link http://github.com/firesale/firesale
*
*/

class Module_Firesale_design extends Module
{
    public $version = '1.0.2';
    public $language_file = 'firesale_design/firesale';

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
                'en' => 'FireSale Design',
                'it' => 'FireSale Design',
            ),
            'description' => array(
                'en' => 'Complete control over your page layouts, style and javascript',
                'it' => 'Controllo completo sul layout della pagina, sugli stili e sul javascript'
            ),
            'frontend' => FALSE,
            'backend'  => FALSE,
            'menu'	   => 'FireSale',
            'author'   => 'Jamie Holdroyd'
        );

        return $info;
    }

    public function install()
    {

        if ($this->firesale->is_installed()) {

            // Load requirements
            $this->load->driver('Streams');
            $this->lang->load('firesale_design/firesale');
            $this->lang->load('firesale/firesale');

            ###################
            ## CREATE STREAM ##
            ###################

            // Create design stream
            if( !$this->streams->streams->add_stream(lang('firesale:design:title'), 'firesale_design', 'firesale_design', NULL, NULL) ) return FALSE;

            // Add fields
            $fields   = array();
            $template = array('namespace' => 'firesale_design', 'assign' => 'firesale_design', 'type' => 'text', 'title_column' => FALSE, 'required' => TRUE, 'unique' => FALSE);
            $fields[] = array('name' => 'lang:firesale:design:label_element', 'slug' => 'element', 'type' => 'integer');
            $fields[] = array('name' => 'lang:firesale:design:label_type', 'slug' => 'type');
            $fields[] = array('name' => 'lang:firesale:design:enable', 'slug' => 'enabled', 'type' => 'choice', 'extra' => array('choice_data' => "0 : lang:global:no\n1 : lang:global:yes", 'choice_type' => 'dropdown', 'default_value' => 1));
            $fields[] = array('name' => 'lang:firesale:design:label_layout', 'slug' => 'layout');
            $fields[] = array('name' => 'lang:firesale:design:label_view', 'slug' => 'view');

            // Combine
            foreach( $fields AS &$field ) { $field = array_merge($template, $field); }

            // Add fields to stream
            $this->streams->fields->add_fields($fields);

            #####################
            ## CREATE SETTINGS ##
            #####################

            // Add pages
            $pages   = array();
            $pages[] = 'product='.lang('firesale:design:pages:products');
            $pages[] = 'category='.lang('firesale:design:pages:categories');
            $pages[] = 'brand='.lang('firesale:design:pages:brands');

            // Create setting
            $setting = array(
                'slug'        => 'firesale_design_enable',
                'title'       => lang('firesale:design:settings:enable'),
                'description' => '',
                'default'     => 'products,categories',
                'value'       => 'products,categories',
                'type'        => 'checkbox',
                'options'     => implode('|', $pages),
                'is_required' => 0,
                'is_gui'      => 1,
                'module'      => 'firesale'
            );

            // Add setting
            $this->db->insert('settings', $setting);

            return true;
        }

    }

    public function uninstall()
    {

        // Load required items
        $this->load->driver('Streams');

        // Remove table
        $this->streams->utilities->remove_namespace('firesale_design');

        // Remove setting
        $this->db->where_in('slug', array('firesale_design_enable'))->delete('settings');

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
