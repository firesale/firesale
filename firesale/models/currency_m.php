<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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

class Currency_m extends MY_Model
{

    /**
     * Loads the parent constructor and gets an
     * instance of CI.
     *
     * @return void
     * @access public
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->driver('Streams');
    }

    public function get($id = NULL)
    {
        // If no id given, get the default currency
        if ($id === NULL) {
            $id = (int)$this->settings->get('firesale_currency');
        }

        // Get the currency
        $stream = $this->streams->streams->get_stream('firesale_currency', 'firesale_currency');
        $row    = $this->row_m->get_row($id, $stream, false);

        // Check it's valid
        if ($row) {

            // Format price, just incase
            $row->cur_format = html_entity_decode($row->cur_format);
            $row->symbol     = str_replace('&Acirc;', '', htmlspecialchars(str_replace('{{ price }}', '', $row->cur_format)));
            $row->symbol     = html_entity_decode($row->symbol, NULL, 'UTF-8');

            return $row;
        }

        // Nothing?
        return FALSE;
    }

    public function get_symbol($id = NULL)
    {

        // Variables
        $currency = $this->pyrocache->model('currency_m', 'get', array($id), $this->firesale->cache_time);

        return str_replace('{{ price }}', '', $currency->symbol);
    }

    public function can_delete($currency)
    {
        // Get usage count
        $query = $this->db->where('currency', $currency)->get('firesale_orders');

        // return
        return ( $query->num_rows() || $currency == 1 ? false : true );
    }

    public function format_price($price, $rrp, $tax_id = NULL, $currency = NULL)
    {
        // Get currency ID
        if ( $this->session->userdata('currency') AND $currency == NULL ) {
            $currency = $this->session->userdata('currency');
        }

        // Get currency data
        $currency = $this->pyrocache->model('currency_m', 'get', array($currency), $this->firesale->cache_time);

        // Check valid option
        if ( ! is_object($currency) ) {
            // Get default
            $currency = $this->get();
        }

        $query = $this->db->get_where('firesale_taxes_assignments', array(
            'tax_id'      => $tax_id,
            'currency_id' => $currency->id
        ));

        if ($query->num_rows()) {
            $currency->cur_tax = $query->row()->value;
        }

        // Add symbol
        $currency->symbol = str_replace('&Acirc;', '', htmlentities(str_replace('{{ price }}', '', $currency->cur_format)));

        // Perform conversion
        $tax_mod   = 1 + ( $currency->cur_tax / 100 );
        $rrp_tax   = ( $rrp   * $currency->exch_rate );
        $rrp       = ( $rrp   * $currency->exch_rate ) * $tax_mod;
        $price_tax = ( $price * $currency->exch_rate );
        $price     = ( $price * $currency->exch_rate ) * $tax_mod;
        $rrp_r     = $this->format_string($rrp, $currency, TRUE, FALSE, FALSE);
        $rrp_tax_r = $this->format_string($rrp_tax, $currency, TRUE, FALSE, FALSE);
        $price_r   =  $this->format_string($price, $currency, TRUE, FALSE, FALSE);
        $price_tax_r = $this->format_string($price_tax, $currency, TRUE, FALSE, FALSE);
        $diff      = ( $rrp_r > $price_r ? ( $rrp_r - $price_r ) : 0.00 );
        $diff_tax  = ( $rrp_tax_r > $price_tax_r ? ( $rrp_tax_r - $price_tax_r ) : 0.00 );

        // Prepare return
        $return = array(
            'currency'            => $currency,
            'rrp_tax'             => $rrp_tax,
            'rrp_tax_formatted'   => $this->format_string($rrp_tax, $currency),                       // RRP Without tax
            'rrp_tax_rounded'     => $this->format_string($rrp_tax, $currency, TRUE, FALSE, FALSE),   // RRP Without tax
            'rrp'                 => $rrp,
            'rrp_formatted'       => $this->format_string($rrp, $currency),                           // RRP With tax
            'rrp_rounded'         => $this->format_string($rrp, $currency, TRUE, FALSE, FALSE),       // RRP With tax
            'price_tax'           => $price_tax,
            'price_tax_formatted' => $this->format_string($price_tax, $currency),                     // Without tax
            'price_tax_rounded'   => $this->format_string($price_tax, $currency, TRUE, FALSE, FALSE), // Without tax
            'price'               => $price,
            'price_formatted'     => $this->format_string($price, $currency),                         // With tax
            'price_rounded'       => $this->format_string($price, $currency, TRUE, FALSE, FALSE),     // With tax
            'diff'                => $diff,
            'diff_formatted'      => $this->format_string($diff, $currency),                          // Difference With Tax
            'diff_rounded'        => $this->format_string($diff, $currency, TRUE, FALSE, FALSE),      // Difference With Tax
            'diff_tax'            => $diff_tax,
            'diff_tax_formatted'  => $this->format_string($diff_tax, $currency),                      // Difference Without Tax
            'diff_tax_rounded'    => $this->format_string($diff_tax, $currency, TRUE, FALSE, FALSE)   // Difference Without Tax
        );

        return $return;
    }

    public function format_string($price, $currency, $fix = TRUE, $apply_tax = FALSE, $format = TRUE)
    {
        if(empty($currency)){
            $currency = new stdClass();
            $currency->cur_format = "";
            $currency->cur_format_dec = "";
            $currency->cur_format_sep = "";
        }
        // Format initial value
        if ($fix and $price > 0) {
            switch ($currency->cur_format_num) {
                case '1':
                    $price = ceil($price).'.00';
                break;

                case '2':
                    $price = ( round(( $price * 2 ), 0) / 2 );
                break;

                case '3':
                    $price = round($price).'.99';
                break;

                default:
                    $price = ( floor(( $price + 0.004 ) * 100) / 100 );
                break;
            }
        }

        // Apply tax if required
        if ($apply_tax) {
            $this->load->model('taxes_m');

            $percentage = $this->taxes_m->get_percentage($tax_band);
            $tax_mod    = 1 - ($percentage / 100);
            $price      = $price * (($percentage / 100) + 1);
        }

        if ( ! $format)
            return number_format($price, 2, $currency->cur_format_dec, $currency->cur_format_sep);

        // Just in case streams has added any extra formatting
        $currency->cur_format = html_entity_decode($currency->cur_format);

        // Format
        $formatted = number_format($price, 2, $currency->cur_format_dec, $currency->cur_format_sep);
        $formatted = str_replace('{{ price }}', $formatted, $currency->cur_format);
        $formatted = trim($formatted);

        // Return
        return $formatted;
    }

}
