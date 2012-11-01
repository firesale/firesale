<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Firesale extends Module {
	
	public $version = '0.5.1';
	public $language_file = 'firesale_brands/firesale';

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
				'en' => 'FireSale Brands'
			),
			'description' => array(
				'en' => 'Brand Management',
			),
			'frontend'		=> TRUE,
			'backend'		=> TRUE,
			'firesale_core'	=> TRUE,
			'menu'	   => 'FireSale',
			'author'   => 'Jamie Holdroyd',
			'shortcuts' => array(
				array(
				    'name' 	=> 'firesale:shortcuts:brand_create',
				    'uri'	=> 'admin/firesale/brands/create',
				    'class' => 'add'
				)
			)
		);

		return $info;
	}