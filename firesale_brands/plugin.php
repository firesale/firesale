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

		// Build query
		$query = $this->db->select('b.id')
						  ->from('firesale_brands AS b')
						  ->where('b.status', '1');

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
					$query->order_by('b.' . $by, $dir);
				break;

				default:
					$query->where('b.'.$key, $val);
				break;

			}

		}

		// Run query
		$results = $query->get()->result_array();

		// Get brands
		foreach( $results AS &$result )
		{
			$result = $this->brands_m->get($result['id']);
		}

		// Return results
		return $results;
	}

}