<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Currency controller
 *
 * @author		Jamie Holdroyd
 * @author		Chris Harvey
 * @package		FireSale\Core\Controllers
 *
 */
class Front_currency extends Public_Controller
{
	
	public function __construct()
    {

        parent::__construct();
		
		// Load libraries
		$this->lang->load('firesale');
		$this->load->model('currency_m');

	}

	public function change($id)
	{

		// Get currency
		$currency = $this->currency_m->get($id);

		// Check it's valid
		if( $currency )
		{

			// Set it into session
			$this->session->set_userdata('currency', $id);

			// Add flashdata
			$this->session->set_flashdata('success', 'Currency changed successfully');
		}
		else
		{

			// Set default into session
			$this->session->set_userdata('currency', 1);

			// Add flashdata
			$this->session->set_flashdata('error', 'Error changing currency');
		}

		// Redirect
		redirect(( isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'home' ));
	}
    
}

