<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * CI-Merchant Library
 *
 * Copyright (c) 2011-2012 Adrian Macneil
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
 * Merchant PayU Class
 *
 * Payment processing using PayU.in
 *
 * @author Daksh H. Mehta ( @dakshhmehta )
 * 
 */

class Merchant_payu extends Merchant_Driver
{
    private $hash_data = array();
    private $hash_sequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
    protected $settings = array();

    public function __construct()
    {
        parent::__construct();
        $this->settings = $this->settings();
    }
    public function default_settings()
    {
        return array(
            'merchant_key' => '',
            'salt' => '',
            'test_mode' => false,
            'skip_confirmation_page' => true
        );
    }

    public function purchase()
    {
        // Gather and organize required parameters.
        $this->hash_data = array(
            'key'           => $this->settings['merchant_key'],
            'txnid'         => time(),
            'amount'        => $this->param('amount'),
            'firstname'     => $this->param('first_name'),
            'productinfo'   => $this->param('description'),
            'lastname'      => $this->param('last_name'),
            'address1'      => $this->param('address1'),
            'address2'      => $this->param('address2'),
            'city'          => $this->param('city'),
            'state'         => $this->param('region'),
            'country'       => $this->param('country'),
            'zipcode'       => $this->param('postcode'),
            'email'         => $this->param('email'),
            'phone'         => $this->param('phone'),
            'surl'          => $this->param('return_url').'/payu',
            'furl'          => $this->param('cancel_url')
        );
        $this->hash_data['hash'] = $this->_hash(); // Calculate and merge checksum

        $this->post_redirect($this->_process_url(), $this->hash_data);
    }

    protected function _hash()
    {
        $hash_string = '';
        $hashSeq = explode('|', $this->hash_sequence);
        foreach($hashSeq as $hash_var) {
          $hash_string .= isset($this->hash_data[$hash_var]) ? $this->hash_data[$hash_var] : '';
          $hash_string .= '|';
        }
        $hash_string .= $this->settings['salt'];
        //exit($hash_string);
        $hash = strtolower(hash('sha512', $hash_string));
        return $hash;
    }

    public function purchase_return()
    {
        $payu_response = $this->CI->input->post(null, true); 
        if($payu_response['status'] == 'success')
        {
            // You can perform reverse hash check for more security.
            $response = new Merchant_payu_response(Merchant_response::COMPLETE);
        }
        else
        {
            $response = new Merchant_payu_response(Merchant_response::FAILED);

        }
        return $response;
    }

    protected function _process_url()
    {
        return 'https://'.(($this->setting('test_mode') == true) ? 'test' : 'secure').'.payu.in/_payment';
    }
}
class Merchant_payu_response extends Merchant_response
{
    protected $_response;

    public function __construct($response)
    {
        $ci = &get_instance();
        $this->_response = $response;
        $this->_status = $response;
        $this->_reference = (string) $ci->input->post('txnid');
    }
}
/* End of file ./libraries/merchant/drivers/merchant_payu.php */
