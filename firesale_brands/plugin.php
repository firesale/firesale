<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Plugin_Firesale_brands extends Plugin
{

    public function __construct()
    {

    	// Load requirements
		$this->load->library('files/files');
		$this->load->model('brands_m');

	}

	public function get()
	{

		// Variables
		$attributes = $this->attributes();
		$cache_key  = md5(implode('|', $attributes));

		if( ! $brands = $this->cache->get($cache_key) )
		{
			// Build query
			$query = $this->db->select('id')
							  ->where('status', '1');
	
			// Add to query
			foreach( $attributes AS $key => $val )
			{
	
				switch($key)
				{
	
					case 'limit':
						$query->limit($val);
					break;
	
					case 'order':
						list($by, $dir) = explode(' ', $val);
						$query->order_by($by, $dir);
					break;
	
					default:
						$query->where($key, $val);
					break;
	
				}
	
			}
	
			// Run query
			$brands = $query->get('firesale_brands')->result_array();
	
			// Get brands
			foreach( $brands AS &$result )
			{
				$result = $this->pyrocache->model('brands_m', 'get', ($result['id']), $this->firesale->cache_time);
			}

			// Add to cache
			$this->cache->save($cache_key, $brands, $this->firesale->cache_time);

		}

		// Return results
		return $brands;
	}

}