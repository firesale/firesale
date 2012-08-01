<?php defined('BASEPATH') or exit('No direct script access allowed');

class Plugin_Firesale_Shipping extends Plugin {

    public function __construct()
    {
		$this->load->library('cart');
		$this->load->model('shipping_m');
		$this->load->model('categories_m');
		$this->load->model('products_m');
	}

	public function get_methods()
	{

		// Variables
		$free = $this->attribute('free', TRUE);

		// Get cart and shipping methods
		$cart    = $this->cart->contents();
		$methods = $this->shipping_m->calculate_methods($cart);

		// Rename free method?
		if( $free )
		{
			foreach( $methods AS $key => $method )
			{
				if( $method['price'] == '0.00' )
				{
					$methods[$key]['price'] = lang('firesale:label_free');
				}
				else
				{
					$methods[$key]['price'] = $this->settings->get('currency') . $method['price'];
				}
			}
		}

		// Return
		return $methods;
	}

}