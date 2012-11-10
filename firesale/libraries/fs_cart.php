<?php defined('BASEPATH') OR exit('No direct script access allowed');

/* 
 * This class adds extra functionality to the stock
 * CodeIgniter Cart class without adding to the PyroCMS
 * core files.
 *
 * You can access the cart using:
 * $this->load->library('fs_cart');
 * $this->fs_cart->function();
 * 
 * Written by: Chris Harvey (FireSALE Team)
 */

// Include the stock CodeIgniter Cart class
require_once(BASEPATH.'libraries/Cart.php');

class Fs_cart extends CI_Cart
{
	public $product_name_safe   = FALSE;
	public $product_name_rules	= '\.\:\-_ a-z0-9_-а-яА-Я ';

	public function __construct()
	{
		parent::__construct();

		$this->ci =& get_instance();

		// Load the required models
		$this->ci->load->model('firesale/currency_m');
	}

	public function destroy()
	{
		// Run the standard CI_Cart function
		parent::destroy();

		// Fire an event to tell external modules that the cart has been destroyed
		Events::trigger('cart_destroyed');
	}

	public function currency()
	{
		if ( ! isset($this->currency))
		{
			$currency = $this->ci->session->userdata('currency');
			$this->currency = $this->ci->currency_m->get($currency ? $currency : 1);
		}

		return $this->currency;
	}

	public function tax_mod()
	{
		if ( ! isset($this->tax_mod))
		{
			$this->tax_mod = 1 - ($this->currency()->cur_tax / 100);
		}

		return $this->tax_mod;
	}

	public function tax()
	{
		$this->tax = 0;

		foreach ($this->contents() as $item)
		{
			$this->ci->load->model('firesale/taxes_m');

			$percentage = $this->ci->taxes_m->get_percentage($item['tax_band']);

			$tax_mod = 1 - ($percentage / 100);

			$tax = ($item['price'] * (($percentage / 100) + 1) - $item['price']);
			$tax = $tax * $item['qty'];

			$this->tax += $tax;
		}

		return $this->tax;
	}

	public function total()
	{
		$total = parent::total();

		$total += $this->tax();

		return $total;
	}

	public function shipping()
	{
		return $this->_cart_contents['cart_ship'];
	}

	public function set_shipping($value)
	{
		$this->_cart_contents['cart_ship'] = (float)$value;
	}

	public function subtotal()
	{
		return $this->subtotal = ($this->total(TRUE) - $this->tax());
	}
}