<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Events_Firesale
{

	protected $ci;

	public function __construct()
	{

		$this->ci =& get_instance();
		
		// register the events
		Events::register('public_controller', array($this, 'public_controller'));
	
	}

	public function public_controller()
	{

		// Just testing at the moment
		/*if( isset($this->ci->current_user->id) AND $this->ci->current_user->id == 1 )
		{

			// Load required items
			$this->ci->load->library('firesale/exchange');

		}*/

	}

}