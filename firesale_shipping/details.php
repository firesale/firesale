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
* @package firesale/shipping
* @author FireSale <support@getfiresale.org>
* @copyright 2013 Moltin Ltd.
* @version master
* @link http://github.com/firesale/firesale
*
*/

class Module_Firesale_shipping extends Module
{
    public $version = '1.2.2';
    public $language_file = 'firesale_shipping/firesale';

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
                'en' => 'FireSale Shipping',
                'fr' => 'FireSale Expédition',
                'it' => 'FireSale Spedizioni'
            ),
            'description' => array(
                'en' => 'Basic band-based shipping options',
                'fr' => 'Gestionnaire de modes d\'expédition',
                'it' => 'Gestione base delle spedizioni'
            ),
            'frontend'		=> FALSE,
            'backend'		=> TRUE,
            'role'			=> 'shipping',
            'author'   		=> 'Jamie Holdroyd',
            'shortcuts' => array(
                array(
                    'name' 	=> 'firesale:shortcuts:band_create',
                    'uri'	=> 'admin/firesale_shipping/create',
                    'class' => 'add'
                )
            )
        );

        return $info;
    }

    public function admin_menu(&$menu)
    {
        $menu['lang:firesale:title']['lang:firesale:sections:shipping'] = 'admin/firesale_shipping';
    }

    public function install()
    {
        if ($this->firesale->is_installed()) {
            // Load required items
            $this->load->driver('Streams');
            $this->lang->load($this->language_file);
            $this->lang->load('firesale/firesale');

            #####################
            ## APPEND PRODUCTS ##
            #####################

            // Add fields
            $fields   = array();
            $template = array('namespace' => 'firesale_products', 'assign' => 'firesale_products', 'type' => 'text', 'title_column' => FALSE, 'required' => FALSE, 'unique' => FALSE);
            $fields[] = array_merge($template, array('name' => 'lang:firesale:label_weight_kg', 'slug' => 'shipping_weight', 'type' => 'text', 'extra' => array('max_length' => 10, 'data-tab' => 'shipping')));
            $fields[] = array_merge($template, array('name' => 'lang:firesale:label_height_cm', 'slug' => 'shipping_height', 'type' => 'text', 'extra' => array('max_length' => 10, 'data-tab' => 'shipping')));
            $fields[] = array_merge($template, array('name' => 'lang:firesale:label_width_cm', 'slug' => 'shipping_width', 'type' => 'text', 'extra' => array('max_length' => 10, 'data-tab' => 'shipping')));
            $fields[] = array_merge($template, array('name' => 'lang:firesale:label_depth_cm', 'slug' => 'shipping_depth', 'type' => 'text', 'extra' => array('max_length' => 10, 'data-tab' => 'shipping')));

            // Add fields to stream
            $this->streams->fields->add_fields($fields);

            ####################
            ## SHIPPING BANDS ##
            ####################

            // Create stream
            if( !$this->streams->streams->add_stream(lang('firesale:sections:shipping'), 'firesale_shipping', 'firesale_shipping', NULL, NULL) ) return FALSE;

            // Add fields
            $fields   = array();
            $template = array('namespace' => 'firesale_shipping', 'assign' => 'firesale_shipping', 'type' => 'text', 'title_column' => FALSE, 'required' => TRUE, 'unique' => FALSE);
            $fields[] = array_merge($template, array('name' => 'lang:firesale:label_title', 'slug' => 'title', 'type' => 'text', 'title_column' => TRUE, 'extra' => array('max_length' => 255), 'unique' => TRUE));
            $fields[] = array_merge($template, array('name' => 'lang:firesale:label_slug', 'slug' => 'slug', 'type' => 'slug', 'extra' => array('max_length' => 255, 'slug_field' => 'title', 'space_type' => '-'), 'unique' => TRUE));
            $fields[] = array_merge($template, array('name' => 'lang:firesale:label_courier', 'slug' => 'company', 'type' => 'text', 'extra' => array('max_length' => 255)));
            $fields[] = array_merge($template, array('name' => 'lang:firesale:label_status', 'slug' => 'status', 'type' => 'choice', 'extra' => array('choice_data' => "0 : lang:firesale:label_draft\n1 : lang:firesale:label_live", 'choice_type' => 'dropdown', 'default_value' => 0)));
            $fields[] = array_merge($template, array('name' => 'lang:firesale:label_price', 'slug' => 'price', 'type' => 'text', 'extra' => array('max_length' => 10)));
            $fields[] = array_merge($template, array('name' => 'lang:firesale:label_price_min', 'slug' => 'price_min', 'type' => 'text', 'extra' => array('max_length' => 10), 'required' => FALSE));
            $fields[] = array_merge($template, array('name' => 'lang:firesale:label_price_max', 'slug' => 'price_max', 'type' => 'text', 'extra' => array('max_length' => 10), 'required' => FALSE));
            $fields[] = array_merge($template, array('name' => 'lang:firesale:label_weight_min', 'slug' => 'weight_min', 'type' => 'text', 'extra' => array('max_length' => 10), 'required' => FALSE));
            $fields[] = array_merge($template, array('name' => 'lang:firesale:label_weight_max', 'slug' => 'weight_max', 'type' => 'text', 'extra' => array('max_length' => 10), 'required' => FALSE));
            $fields[] = array_merge($template, array('name' => 'lang:firesale:label_description', 'slug' => 'description', 'type' => 'wysiwyg', 'extra' => array('editor_type' => 'simple', 'data-tab' => 'general')));

            // Add fields to stream
            $this->streams->fields->add_fields($fields);

            ###################
            ## MODIFY ORDERS ##
            ###################

            // Remove field - without deleting column
            $this->db->where('field_slug', 'shipping')->where('field_namespace', 'firesale_orders')->delete('data_fields');
            $this->dbforge->modify_column('firesale_orders', array('shipping' => array('name' => 'tmp_shipping', 'type' => 'int(11)')));

            // Get stream data
            $shipping = $this->streams->streams->get_streams('firesale_shipping', TRUE, 'firesale_shipping');
            $shipping = end($shipping);

            // Build field
            $field = array('namespace' 	  => 'firesale_orders',
                           'assign'   	  => 'firesale_orders',
                           'name' 	   	  => 'lang:firesale:label_shipping',
                           'slug' 	  	  => 'shipping',
                           'type' 	  	  => 'relationship',
                           'extra' 	   	  => array('choose_stream' => $shipping->id),
                           'title_column' => FALSE,
                           'required' 	  => FALSE,
                           'unique' 	  => FALSE);

            // Add field to stream
            $this->streams->fields->add_field($field);

            // Drop and rename shipping
            $this->dbforge->drop_column('firesale_orders', 'shipping');
            $this->dbforge->modify_column('firesale_orders', array('tmp_shipping' => array('name' => 'shipping', 'type' => 'int(11)')));

            // Return
            return TRUE;
        }
    }

    public function uninstall()
    {

        // Load required items
        $this->load->driver('Streams');
        $this->lang->load($this->language_file);
        $this->lang->load('firesale/firesale');

        // Remove Product additions
        $this->streams->fields->delete_field('shipping_weight', 'firesale_products');
        $this->streams->fields->delete_field('shipping_height', 'firesale_products');
        $this->streams->fields->delete_field('shipping_width', 'firesale_products');
        $this->streams->fields->delete_field('shipping_depth', 'firesale_products');

        // Remove streams
        $this->streams->utilities->remove_namespace('firesale_shipping');

        ####################
        ## REBUILD ORDERS ##
        ####################

        // Ensure core is installed first
        $query = $this->db->select('id')->where("slug = 'firesale' AND installed = 1")->get('modules');

        // Check query
        if ( $query->num_rows() ) {

            // Remove field - without deleting column
            $this->db->where('field_slug', 'shipping')->where('field_namespace', 'firesale_orders')->delete('data_fields');
            $this->dbforge->modify_column('firesale_orders', array('shipping' => array('name' => 'tmp_shipping', 'type' => 'int(11)')));

            // Build field
            $field = array('namespace' => 'firesale_orders', 'assign' => 'firesale_orders', 'name' => 'lang:firesale:label_shipping', 'slug' => 'shipping', 'type' => 'integer', 'title_column' => FALSE,  'required' => FALSE, 'unique' => FALSE);

            // Add field to stream
            $this->streams->fields->add_field($field);

            // Drop and rename shipping
            $this->dbforge->drop_column('firesale_orders', 'shipping');
            $this->dbforge->modify_column('firesale_orders', array('tmp_shipping' => array('name' => 'shipping', 'type' => 'int(11)')));

        }

        // Return
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
