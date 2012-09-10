<?php defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends Admin_Controller
{
	public $section = 'dashboard';
	
    public function __construct()
    {
        parent::__construct();

		// Load libraries
		$this->lang->load('firesale');
		$this->load->library('firesale/firesale');
		
		// Add metadata
		$this->template->append_css('module::dashboard.css')
					   ->append_js('module::flot.js')
					   ->append_js('module::dashboard.js');

	}

	public function index()
	{

		// CH: If we're not on the FireSALE dashboard, redirect to it.
		if ( ! $this->uri->segment(2))
		{
			redirect('admin/firesale');
		}

		// Variables
		$items  = array();
		$hidden = array();

		// Get element data from core
		if( isset($this->firesale->elements['dashboard']) AND !empty($this->firesale->elements['dashboard']) )
		{
	
			$_tmp = $this->firesale->elements['dashboard'];

			// Order dashboard items
			if ($this->input->cookie('firesale_dashboard_order'))
			{
				$order = explode('|', $this->input->cookie('firesale_dashboard_order'));
				foreach( $order AS $slug )
				{
					if( strlen($slug) > 0 )
					{
						if( isset($_tmp[$slug]) )
						{
							$items[$slug] = $_tmp[$slug];
						}
					}
				}
			}
			else
			{
				$items = $_tmp;
			}
			
			if( isset($this->firesale->elements['dashboard']) )
			{
				$this->firesale->retrieve_assets('dashboard', $this);
			}
	
		}
		
		// Assign variables
		$this->data->controller =& $this;
		$this->data->items      =  $items;
		$this->data->shown		=  count($items);
		$this->data->count		=  ( isset($_tmp) ? count($_tmp) : $this->data->shown );
	
		// Build the page
		$this->template->enable_parser(true)
					   ->title(lang('firesale:title') . ' ' . lang('firesale:sections:dashboard'))
					   ->build('admin/dashboard', $this->data);
	}
	
}
