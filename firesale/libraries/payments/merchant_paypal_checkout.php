<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * CI-Merchant Library
 *
 * Copyright (c) 2011-2012 Crescendo Multimedia Ltd
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:

 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.

 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * Merchant Paypal Class
 *
 * Payment processing using Paypal Payments Standard
 */

class Merchant_paypal_checkout extends Merchant_driver
{
	public $required_fields = array('amount', 'reference', 'currency_code', 'return_url', 'cancel_url', 'notify_url');

	public $settings = array(
		'paypal_email' => '',
		'require_address' => TRUE,
		'test_mode' => TRUE
	);

	const PROCESS_URL = 'https://www.paypal.com/cgi-bin/webscr';
	const PROCESS_URL_TEST = 'https://www.sandbox.paypal.com/cgi-bin/webscr';

	public $CI;

	public function __construct($settings = array())
	{
		foreach ($settings as $key => $value)
		{
			if(array_key_exists($key, $this->settings))	$this->settings[$key] = $value;
		}
		$this->CI =& get_instance();
	}

	public function _process($params)
	{
		// ask paypal to generate request url
		$data = array(
			'rm' => '2',
			'cmd' => '_cart',
			'upload' => '1',
			'business' => $this->settings['paypal_email'],
			'return'=> $params['return_url'],
      		'cancel_return' => $params['cancel_url'],
      		'notify_url' => $params['notify_url'],
			'currency_code' => $params['currency_code'],
			'no_shipping' => $this->settings['require_address'] ? 2 : 1
		);

		// Add the items to the cart
		$i = 1;
		foreach ($params['items'] as $item)
		{
			$data['item_name_'.$i] = $item['name'];
			$data['amount_'.$i] = $item['subtotal'] / $item['qty'];
			$data['quantity_'.$i] = $item['qty'];

			$i++;
		}

		$data['item_name_'.$i] = 'Shipping ('.$params['shipping']['title'].')';
		$data['amount_'.$i] = $params['shipping']['price'];
		$data['quantity_'.$i] = '1';

		$post_url = $this->settings['test_mode'] ? self::PROCESS_URL_TEST : self::PROCESS_URL;
		Merchant::redirect_post($post_url, $data);
	}

	public function _process_return()
	{
		$action = $this->CI->input->get('action', TRUE);

		if ($action === FALSE) return new Merchant_response('failed', 'invalid_response');

		if ($action === 'success') return new Merchant_response('return', '', $_POST['txn_id']);

		if ($action === 'cancel') return new Merchant_response('failed', 'payment_cancelled');

		if ($action === 'ipn')
		{
			$query = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i','${1}%0D%0A${3}', http_build_query($_POST));

			// generate the post string from _POST
			$post_string = 'cmd=_notify-validate&'.$query;

			$response = Merchant::curl_helper($this->settings['test_mode'] ? self::PROCESS_URL_TEST : self::PROCESS_URL, $post_string);
			if ( ! empty($response['error'])) return new Merchant_response('failed', $response['error']);

			$memo = $this->CI->input->post('memo');
			if (strpos("VERIFIED", $response['data']) !== FALSE)
			{
				// Valid IPN transaction.

				if ($_POST['payment_status'] != 'Completed')
				{
					return new Merchant_response(strtolower($_POST['payment_status']), $memo, $_POST['txn_id'], (string)$_POST['mc_gross']);
				}

				// CH: Build the address into a standardised array
				$address['to'] = $_POST['address_name'];
				$address['lines'] = explode("\n", $_POST['address_street']);
				$address['city'] = $_POST['address_city'];
				$address['county'] = isset($_POST['address_state']) ? $_POST['address_state'] : NULL;
				$address['postcode'] = $_POST['address_zip'];
				$address['country'] = $_POST['address_country_code'];

				return new Merchant_response('authorized', $memo, $_POST['txn_id'], (string)$_POST['mc_gross'], $address);
      		}
			else
			{
				// Invalid IPN transaction
				return new Merchant_response('declined', $memo);
			}
		}
	}
}
