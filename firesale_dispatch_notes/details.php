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
* @package firesale/dispatch_notes
* @author FireSale <support@getfiresale.org>
* @copyright 2013 Moltin Ltd.
* @version master
* @link http://github.com/firesale/firesale
*
*/

class Module_Firesale_dispatch_notes extends Module {
	
	public $version = '1.0.2';
    public $language_file = 'firesale_dispatch_notes/firesale';

    public function __construct()
    {
        parent::__construct();
        $this->load->library('firesale/firesale');
        $this->lang->load($this->language_file);
    }

	public function info()
	{

		$info = array(
			'name' => array(
				'en' => 'FireSale Dispatch Notes',
				'it' => 'FireSale note di spedizione'
			),
			'description' => array(
				'en' => 'Print dispatch notes for your orders',
				'it' => 'Stampa le note di spedizione per gli ordini'
			),
			'frontend'		=> false,
			'backend'		=> false,
			'firesale_core'	=> false,
			'menu'	   => 'FireSale',
			'author'   => 'Chris Harvey'
		);

		return $info;
	}
	
	public function install()
	{
		return true;
	}

	public function uninstall()
	{
        return true;
	}

	public function upgrade($old_version)
	{
		return true;
	}

	public function help()
	{
		return "HELP ME!!";
	}

}
