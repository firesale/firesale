<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Plugin_Firesale_Search extends Plugin
{
	
	#####################
	## ADMIN DASHBOARD ##
	#####################

	public function search_terms()
	{
	
		$results = $this->db->order_by('sales, count')->limit(10)->get('firesale_search')->result_array();

		// Return view
		return $this->module_view('firesale_search', 'admin_searchterms', array('results' => $results), true);
	}

}