<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Modifier model
 *
 * @author		Jamie Holdroyd
 * @author		Chris Harvey
 * @package		FireSale\Core\Models
 *
 */
class Modifier_m extends MY_Model {


	public function get_modifiers($product)
	{

		// Variables
		$return = array();
		$params	= array(
					'stream' 	=> 'firesale_product_modifiers',
					'namespace'	=> 'firesale_product_modifiers',
					'where'		=> "parent = '{$product}'",
					'order_by'	=> 'id',
					'sort'		=> 'asc'
				  );

		// Get the modifiers
		$modifiers = $this->streams->entries->get_entries($params);

		// Check total
		if( $modifiers['total'] > 0 )
		{

			// Get the variations
			foreach( $modifiers['entries'] as &$modifier )
			{
				$modifier['variations'] = $this->get_variations($modifier['id']);
			}

			return $modifiers['entries'];
		}

		// Nothing found
		return array();
	}

	public function get_variations($parent)
	{

		// Variables
		$return = array();
		$params	= array(
					'stream' 	=> 'firesale_product_variations',
					'namespace'	=> 'firesale_product_variations',
					'where'		=> "parent = '{$parent}'",
					'order_by'	=> 'id',
					'sort'		=> 'asc'
				  );

		// Get the variations
		$variations = $this->streams->entries->get_entries($params);

		// Check total
		if( $variations['total'] > 0 )
		{
			return $variations['entries'];
		}

		// Nothing found
		return array();
	}

	public function get_products($product)
	{

		// Variables
		$stream     = $this->streams->streams->get_stream('firesale_product_variations', 'firesale_product_variations');
		$modifiers  = $this->get_modifiers($product);
		$variations = $this->possible_variations($modifiers);
		$products   = array();

		// Loop variations
		foreach( $variations AS $variation )
		{

			// Get products
			if( $id = $this->variation_exists($variation, $stream->id) )
			{
				$products[] = $this->products_m->get_product($id);
			}

		}

		return $products;
	}

	public function build_variations($product, $stream)
	{

		// Variables
		$modifiers = $this->get_modifiers($product);

		// Build an array of the possible variations for this product
		$variations = $this->possible_variations($modifiers);

		// Loop through possible and determine what does and doesn't exist
		foreach( $variations AS $variation )
		{

			if( ! $this->variation_exists($variation, $stream->id) )
			{
				// Doesn't exist, create it
				$this->variation_create($product, $variation, $stream->id);
			}

		}

	}

	public function variation_create($product, $variations, $stream_id)
	{

		// Duplicate parent product
		$id = $this->products_m->duplicate_product($product);

		// Variables
		$update  = array();
		$product = $this->products_m->get_product($id);
		$tax     = ( 100 + $this->taxes_m->get_percentage() ) / 100;

		// Update title
		$product['title'] .= ' -';

		// Loop the variations
		foreach( $variations as $variation )
		{

			// Get the variation details
			$row = $this->db->where('id', $variation)->get('firesale_product_variations')->row();

			// Append the title and code
			$product['title'] .= ' '.$row->title;
			$product['code']  .= strtoupper(substr($row->title, 0, 2));

			// Rebuild the prices
			$product['price'] += $row->price;

			// Add to lookup table
			$lookup = array('row_id' => $variation, 'firesale_product_variations_id' => $stream_id, 'firesale_products_id' => $id);
			$this->db->insert('firesale_product_variations_firesale_products', $lookup);

		}

		// Add to update
		$update['title']        = $product['title'];
		$update['code']         = $product['code'];
		$update['price']        = number_format($product['price'], 2);
		$update['price_tax']    = number_format(( $product['price'] / $tax ), 2);
		$update['is_variation'] = '1';

		// Perform update
		return $this->db->where('id', $id)->update('firesale_products', $update);
	}

	public function variation_exists($variations, $stream_id)
	{

		// Get initial ID
		$id = $variations[0];
		array_shift($variations);

		// Variables
		$sql = "SELECT fp_0.`firesale_products_id`
				FROM `".SITE_REF."_firesale_product_variations_firesale_products` AS `fp_0`";

		if( ! empty($variations) )
		{
			// Loop variations
			foreach( $variations as $key => $variation )
			{
				$key += 1;
				$sql .= "\nINNER JOIN `default_firesale_product_variations_firesale_products` AS `fp_{$key}` ON ( `fp_{$key}`.`row_id` = {$variation} AND `fp_{$key}`.`firesale_products_id` = fp_0.`firesale_products_id` )";
			}
		}

		// Append where
		$sql .= "\nWHERE fp_0.`row_id` = {$id}\nAND fp_0.`firesale_product_variations_id` = {$stream_id}";

		// Run query
		$query = $this->db->query($sql);

		// Check for results
		if( $query->num_rows() )
		{
			$row = $query->row();
			return $row->firesale_products_id;
		}

		// Not found
		return FALSE;
	}

	public function possible_variations($modifiers)
	{

		// Variables
		$options = array();

		// Pull out all variation information
		foreach( $modifiers as $modifier )
		{
			if( $modifier['type']['key'] == '1' )
			{
				foreach( $modifier['variations'] as $variation )
				{
					if( ! array_key_exists($modifier['id'], $options) )
					{
						$options[$modifier['id']] = array();
					}
					$options[$modifier['id']][] = $variation['id'];
				}
			}
		}

		return $this->array_cartesian_product($options);
	}

	// Stack overflow
	// http://stackoverflow.com/questions/8567082/how-to-generate-in-php-all-combinations-of-items-in-multiple-arrays
	function array_cartesian_product($arrays)
	{
	    $result = array();
	    $arrays = array_values($arrays);
	    $sizeIn = sizeof($arrays);
	    $size = $sizeIn > 0 ? 1 : 0;
	    foreach ($arrays as $array)
	        $size = $size * sizeof($array);
	    for ($i = 0; $i < $size; $i ++)
	    {
	        $result[$i] = array();
	        for ($j = 0; $j < $sizeIn; $j ++)
	            array_push($result[$i], current($arrays[$j]));
	        for ($j = ($sizeIn -1); $j >= 0; $j --)
	        {
	            if (next($arrays[$j]))
	                break;
	            elseif (isset ($arrays[$j]))
	                reset($arrays[$j]);
	        }
	    }
	    return $result;
	}

}
