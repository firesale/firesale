<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * CI-Merchant Library
 *
 * Copyright (c) 2012 Jamie Holdroyd
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * Merchant BitPay Class
 *
 * Payment processing using BitPay
 * Documentation: https://bitpay.com/bitcoin-for-ecommerce
 */

class Merchant_bitpay extends Merchant_driver
{
    const PROCESS_URL = 'https://bitpay.com/api';

    public function default_settings()
    {
        return array(
            'api_key'     => '',
            'trans_speed' => 'high',
            'test_mode'   => FALSE
        );
    }

    public function purchase()
    {

        $data = array(
            'price'            => $this->amount_dollars(),
            'currency'         => $this->param('currency'),
            'posData'          => array('ref' => $this->param('order_id'), 'hash' => md5($this->amount_dollars().$this->setting('api_key'))),
            'notificationURL'  => '',
            'transactionSpeed' => $this->setting('trans_speed'),
            'redirectURL'      => $this->param('return_url'),
            'orderID'          => $this->param('order_id'),
            'buyerName'        => $this->param('first_name').' '.$this->param('last_name'),
            'buyerAddress1'    => $this->param('address1'),
            'buyerAddress2'    => $this->param('address2'),
            'buyerCity'        => $this->param('city'),
            'buyerZip'         => $this->param('postcode'),
            'buyerCountry'     => $this->param('country'),
            'buyerEmail'       => $this->param('email')
        );

        // Build URL
        $url = $this->_process_url().'/invoice/'.$this->setting('api_key');

        // Make request
        $response = $this->post_request($url, json_encode($data));

        var_dump($response);
        exit();

    }

}
