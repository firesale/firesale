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
	public function destroy()
	{
		// Run the standard CI_Cart function
		parent::destroy();

		// Fire an event to tell external modules that the cart has been destroyed
		Events::trigger('cart_destroyed');
	}
}