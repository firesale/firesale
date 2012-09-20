<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shipping_m extends MY_Model
{

	public $fired  = array(
						'form_build' => FALSE
					);

	public function get_option_by_id($id)
	{

		$query = $this->db->where("id = {$id}")->get('firesale_shipping');
		if( $query->num_rows() )
		{
			$result = $query->result_array();
			return $result[0];
		}

		return '0.00';
	}

	public function calculate_methods($cart)
	{
	
		// Variables
		$total_weight  = 0; 
		$total_value   = 0;
		$total_options = array();

		// Get total weight and value
		foreach( $cart AS $item )
		{
			$total_weight += ( $item['weight'] * $item['qty'] );
			$total_value  += ( $item['price']  * $item['qty'] );
		}
		
		// Select shipping options
		$params	 = array(
					'stream' 	=> 'firesale_shipping',
					'namespace'	=> 'firesale_shipping',
					'order_by'	=> 'price',
					'sort'		=> 'asc'
				   );

		$options = $this->streams->entries->get_entries($params);
		
		// Loop options and perform checks
		foreach( $options['entries'] AS $option )
		{
			$viable = $this->check_methods($option, $total_weight, $total_value);
			if( $viable )
			{
				$total_options[] = $option;
			}
		}
		
		// Return options
		return $total_options;		
	}
	
	public function check_methods($method, $weight, $price)
	{

		// Variables
		$_return  = FALSE;
		$_options = array('price_min', 'price_max', 'weight_min', 'weight_max');

		// Loop it!
		foreach( $_options AS $key => $option )
		{
		
			// Variables
			$name   = substr($option, 0, -4);
			$max    = ( ( $key + 1 ) % 2 == 1 ? TRUE : FALSE );
			
			// Values
			$first  = $method[$option];
			$second = $method[( $max ? str_replace('_min', '_max', $option) : str_replace('_max', '_min', $option) )];
			$value  = $$name;
			
			if( $first != NULL AND $this->compare_values((float)$first, $value, $max) )
			{
				if( ( $second != NULL AND $this->compare_values((float)$second, $value, $max, TRUE) ) OR $second == NULL )
				{
					$_return = TRUE;
				}
				else
				{
					$_return = FALSE;
				}
			}
			
		}

		// Return
		return $_return;
	}

	public function compare_values($var1, $var2, $max, $reverse = FALSE)
	{
	
		if( $max OR ( !$max AND $reverse ) )
		{
			return ( $var1 <= $var2 );
		}
		else
		{
			return ( $var1 >= $var2 );
		}
	
	}

}