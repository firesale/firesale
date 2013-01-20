<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Firesale_design extends Module
{
    public $version = '1.0.0';
    public $language_file = 'firesale_design/firesale';

    public function __construct()
    {
        parent::__construct();

        // Load in the FireSale library
        $this->load->library('firesale/firesale');
    }

    public function information()
    {

        $info = array(
            'name' => array(
                'en' => 'FireSale Design'
            ),
            'description' => array(
                'en' => 'Complete control over your page layouts, style and javascript'
            ),
            'frontend' => FALSE,
            'backend'  => FALSE,
            'menu'	   => 'FireSale',
            'author'   => 'Jamie Holdroyd'
        );

        return $info;
    }

    public function info()
    {
        return $this->firesale->info($this->information(), $this->language_file);
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
            // if( !$this->streams->streams->add_stream(lang('firesale:sections:design'), 'firesale_design', 'firesale_design', NULL, NULL) ) return FALSE;

            #####################
            ## CREATE SETTINGS ##
            #####################

            // Add pages
            $pages   = array();
            $pages[] = 'products='.lang('firesale:design:pages:products');
            $pages[] = 'categories='.lang('firesale:design:pages:categories');
            $pages[] = 'brands='.lang('firesale:design:pages:brands');

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

            return TRUE;
        }

    }

    public function uninstall()
    {

        // Load required items
        $this->load->driver('Streams');

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
