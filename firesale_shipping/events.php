<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Events_Firesale_shipping
{

	protected $ci;
	
	public function __construct()
	{

		$this->ci =& get_instance();
		
		// register the events
		Events::register('form_build', array($this, 'form_build'));
	
	}

    public function form_build(&$controller)
    {

		// Remove images (needs to be last)
	    unset($controller->tabs['_images']);

	    // Add metadata to tabs
	    $controller->tabs['shipping'] = array('shipping_weight', 'shipping_height', 'shipping_width', 'shipping_depth');

	    // Add images back in
	    $controller->tabs['_images'] = array();

    }
	
}
