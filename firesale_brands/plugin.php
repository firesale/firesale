<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Plugin_Firesale_brands extends Plugin
{

    public function __construct()
    {

    	// Load requirements
		$this->load->library('files/files');
		$this->load->model('firesale/categories_m');
		$this->load->model('firesale/products_m');
		$this->load->model('firesale/routes_m');
		$this->load->model('firesale/taxes_m');
		$this->load->model('firesale/currency_m');

	}