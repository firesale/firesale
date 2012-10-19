<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Currency model
 *
 * @author		Jamie Holdroyd
 * @author		Chris Harvey
 * @package		FireSale\Core\Models
 *
 */
class Currency_m extends MY_Model
{

	protected $cache = array();

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

	public function get($id = 1)
	{

		// Check cache
		if( array_key_exists($id, $this->cache) )
		{
			return $this->cache[$id];
		}

		// Variables
		$stream = $this->streams->streams->get_stream('firesale_currency', 'firesale_currency');
		$row    = $this->row_m->get_row($id, $stream, false);

		// Check it's valid
		if( $row )
		{

			// Format price, just incase
			$row->cur_format = str_replace(array('&#123;', '&#125;'), array('{', '}'), $row->cur_format);

			// Add to cache
			$this->cache[$id] = $row;

			return $row;
		}

		// Nothing?
		return FALSE;
	}

	public function format_price($price, $rrp, $currency = 1)
	{

		// Get currency ID
		if( $this->session->userdata('currency') )
		{
			$currency = $this->session->userdata('currency');
		}

		// Get currency data
		$currency = $this->get($currency);

		// Check valid option
		if( ! is_object($currency) )
		{
			// Get default
			$currency = $this->get();
		}

		// Add symbol
		$currency->symbol = str_replace('&Acirc;', '', htmlentities(str_replace('{{ price }}', '', $currency->cur_format)));

		// Perform conversion
		$tax_mod   = 1 + ( $currency->cur_tax / 100 );
		$rrp       = ( $rrp   * $currency->exch_rate ) * $tax_mod;
		$rrp_tax   = ( $rrp   * $currency->exch_rate );
		$price     = ( $price * $currency->exch_rate ) * $tax_mod;
		$price_tax = ( $price * $currency->exch_rate );

		// Format prices
		$rrp_f       = $this->format_string($rrp, $currency);       // RRP With tax
		$rrp_tax_f   = $this->format_string($rrp_tax, $currency);   // RRP Without tax
		$price_f     = $this->format_string($price, $currency);     // With tax
		$price_tax_f = $this->format_string($price_tax, $currency); // Without tax

		// Prepare return
		$return = array(
					'currency'            => $currency,
					'rrp_tax'             => $rrp_tax,
					'rrp_tax_formatted'   => $rrp_tax_f,
					'rrp'                 => $rrp,
					'rrp_formatted'       => $rrp_f,
					'price_tax'           => $price_tax,
					'price_tax_formatted' => $price_tax_f,
					'price'               => $price,
					'price_formatted'     => $price_f
				  );

		return $return;
	}

	public function format_string($price, $currency, $fix = TRUE)
	{

		// Stop random values
		if( $fix AND $currency->id != 1 )
		{
			$price = ( ceil($price) - 0.01 );
		}

		// Format
		$formatted = number_format($price, 2, $currency->cur_format_dec, $currency->cur_format_sep);
		$formatted = str_replace('{{ price }}', $formatted, $currency->cur_format);
		$formatted = str_replace('&Acirc;', '', htmlentities(trim($formatted)));

		// Return
		return $formatted;
	}

}
