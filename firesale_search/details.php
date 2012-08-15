<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Firesale_Search extends Module {

	public $version = '0.3.1';
	public $language_file = 'firesale_search/firesale';
	
	public function __construct()
	{
		parent::__construct();
		
		// Load in the FireSALE library
		$this->load->library('firesale/firesale');
	}

	public function information()
	{
		
		$info = array(
			'name' => array(
				'en' => 'FireSALE Search (Basic)'
			),
			'description' => array(
				'en' => 'A lightweight eCommerce platform for PyroCMS.'
			),
			'frontend' 		=> TRUE,
			'backend' 		=> FALSE,
			'firesale_core'	=> FALSE,
			'menu'	   		=> 'FireSALE',
			'author' 		=> 'Jamie Holdroyd',
			'elements' => array(
				'dashboard' => array(
					array(
						'slug'		=> 'search_terms',
						'title' 	=> 'firesale:elements:search_terms',
						'function' 	=> 'search_terms',
						'assets'	=> array(
							array('type' => 'css', 'file' => 'dashboard_searchterms.css')
						)
					)
				)
			),
			'events'			 => array(
				'order_complete'     => array(
					'model'		 => 'firesale_searcg/search_m',
					'function'	 => 'order_complete'
				)
			)
		);
		
		return $info;
	}
	
	public function install()
	{

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
		if( !$this->dbforge->create_table('firesale_search') ) { $_return = FALSE; }

		// Return
		return $_return;
	}

	public function uninstall()
	{

		// Variables
		$_return = TRUE;
		
		// Drop tables
		if( !$this->dbforge->drop_table('firesale_search') ) { $_return = FALSE; }

		// Return
		return $_return;
	}

	public function upgrade($old_version)
	{
		// Your Upgrade Logic
		return TRUE;
	}
	
	public function help()
	{
		// Return a string containing help info
		// You could include a file and return it here.
		return "Some Help Stuff";
	}
	
	public function info()
	{
		return $this->firesale->info($this->information(), $this->language_file);
	}
	
}