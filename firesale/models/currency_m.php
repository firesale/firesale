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

    public function get($id = NULL)
    {

        // Check cache
        if ( $id !== NULL && array_key_exists($id, $this->cache) ) {
            return $this->cache[$id];
        }

        // if no id given, get the default currency
        if($id === NULL) {
            $default_currency = $this->db->select('value')->get_where('settings', array('slug' => 'firesale_currency'))->row();
            $row = $this->db->get_where('firesale_currency', array('cur_code' => $default_currency->value))->row();
        } else {
            $stream = $this->streams->streams->get_stream('firesale_currency', 'firesale_currency');
            $row    = $this->row_m->get_row($id, $stream, false);
        }

        // Check it's valid
        if ($row) {

            // Format price, just incase
            $row->cur_format = html_entity_decode($row->cur_format);
            $row->symbol     = str_replace('&Acirc;', '', htmlspecialchars(str_replace('{{ price }}', '', $row->cur_format)));
            $row->symbol     = html_entity_decode($row->symbol, NULL, 'UTF-8');

            // Add to cache
            $this->cache[$id] = $row;

            return $row;
        }

        // Nothing?
        return FALSE;
    }

    public function get_symbol($id = NULL)
    {

        // Variables
        $currency = $this->get($id);

        return str_replace('{{ price }}', '', $currency->symbol);
    }

    public function can_delete($currency)
    {

        // Get usage count
        $query = $this->db->where('currency', $currency)
                          ->get('firesale_orders');

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
        $currency = $this->get($currency);

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
        // Format initial value
        if ($fix) {
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
    
    
    /**
     * Updates the options for the select/dropdown "Default Currency Code" in settings
     */
    public function update_default_currency_options()
    {
        // get current setting
        $setting = $this->db->get_where('settings', array('slug' => 'firesale_currency'))->row_array();
/*         var_dump($setting); */
        
        $options = array();
        $codes = array();
        if($currencies = $this->db->get('firesale_currency')->result_array()) {
            foreach($currencies as $k => $currency) {
                $codes[$currency['cur_code']] = $currency['cur_code'];
                $options[] = $currency['cur_code'].'='.$currency['cur_code'];
            }
        }
        $setting['options'] = implode('|', $options);
        
        // make sure saved currency is still in the list (it might have been deleted)
        if(!isset($codes[$setting['value']])) {
            // it's not, so try the default
            if(isset($codes[$setting['default']]))
                $setting['value'] = $setting['default'];
            
            // default gone too, so use the first enabled currency
            else {
                foreach($currencies as $currency) {
                    if(!$currency['enabled'])
                        continue;
                    $setting['value'] = $setting['default'] = $currency['cur_code'];
                    break;
                }
            }
        }
        
        $this->db->where('slug', 'firesale_currency')->update('settings', $setting);
    }

}
