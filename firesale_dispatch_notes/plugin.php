<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Plugin_Firesale_Discount_Codes extends Plugin
{

    public function __construct()
    {

		$this->load->model('categories_m');
		$this->load->model('products_m');
		$this->load->model('codes_m');

	}

	public function code_applied()
	{

		if( $this->session->userdata('discount_code') )
		{
			return TRUE;
		}

		return FALSE;
	}

}
