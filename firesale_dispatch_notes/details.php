<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Firesale_dispatch_notes extends Module {
	
	public $version = '0.0.1';
	
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
				'en' => 'FireSALE Dispatch Notes'
			),
			'description' => array(
				'en' => 'Print dispatch notes for your orders'
			),
			'frontend'		=> FALSE,
			'backend'		=> FALSE,
			'firesale_core'	=> FALSE,
			'menu'	   => 'FireSALE',
			'author'   => 'Chris Harvey'
		);

		return $info;
	}
	
	public function info()
	{
		return $this->firesale->info($this->information());
	}
	
	public function install()
	{
		return TRUE;
	}

	public function uninstall()
	{
        return TRUE;
	}

	public function upgrade($old_version)
	{
		return TRUE;
	}

	public function help()
	{
		return "HELP ME!!";
	}

}
