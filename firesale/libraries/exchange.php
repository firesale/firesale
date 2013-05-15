<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* This file is part of FireSale, a PHP based eCommerce system built for
* PyroCMS.
*
* Copyright (c) 2013 Moltin Ltd.
* http://github.com/firesale/firesale
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*
* @package firesale/core
* @author FireSale <support@getfiresale.org>
* @copyright 2013 Moltin Ltd.
* @version master
* @link http://github.com/firesale/firesale
*
*/

class exchange
{

    // Variables
    protected $ci     = NULL;
    protected $base   = 'GBP';
    protected $app_id = '';
    protected $url    = 'http://openexchangerates.org/api/latest.json?app_id=';

    public function __construct()
    {

        // Get CI Instance
        $this->ci =& get_instance();

        // Add to settings soon
        $this->app_id = $this->ci->settings->get('firesale_currency_key');
        $this->url    = $this->url.$this->app_id;

        // Check key
        if ( !empty($this->app_id) ) {

            // Get data
            $json = $this->get($this->url);

            // Check data
            if ($json !== FALSE) {
                $this->process($json);
            }

        }

    }

    public function get($url)
    {

        // Get data
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        curl_close($ch);

        // Convert
        $json = json_decode($data);

        // Check data
        if ( ! isset($json->error) ) {
            return $json;
        }

        // Problem
        return FALSE;
    }

    public function process($json)
    {

        // Variables
        $base = $this->ci->settings->get('firesale_currency') or $this->base;

        // Get all currency options
        $currencies = $this->ci->db->get('firesale_currency')->result_array();

        // Loop them
        foreach ($currencies AS $currency) {
            //Added patch
            $rate = 1;

            // Do we need to cross-convert?
            if ($json->base != $this->base) {
                $new  = ( $json->rates->$currency['cur_code'] * ( 1 / $json->rates->$base ) );
                $rate = round($new, 6);
            }

            // Perform modifications
            list($op, $value) = explode('|', $currency['cur_mod']);
            $rate             = eval('return ('.$rate.$op.$value.');');

            // Update it
            $this->ci->db->where('id', $currency['id'])->update('firesale_currency', array('exch_rate' => $rate));

        }

        // Update last checked time
        $time = ( (int) ( time() - $json->timestamp ) > 3600 ? time() : $json->timestamp );
        $this->ci->settings->set('firesale_currency_updated', $time);

    }

}
