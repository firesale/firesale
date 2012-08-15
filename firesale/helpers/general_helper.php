<?php

	function is_module_installed($module)
	{

		// Ensure core is installed first
		$query = $this->db->select('id')->where("slug = '{$module}' AND installed = 1")->get('modules');

		// Check query
		if( $query->num_rows() )
		{
			return TRUE;
		}

		return FALSE;
	}

	/**
	 * Splits Streams fileds into an array of tabs, specified fields in a tabs array
	 * will be put into their designated positions with all others failling into a
	 * default "general options" array.
	 *
	 * @param array $fields A Streams generated array of fields
	 * @param array $tabs A guide containing the tab name and an array of field names
	 * @return array
	 * @access public
	 */
	function fields_to_tabs($fields, $tabs, $default = 'general options')
	{
	
		// Variables
		$data = array($default => array());

		// Loop fields
		foreach( $fields AS $field )
		{
	
			// Reset found
			$found = FALSE;
	
			// Loop each of the tab options
			foreach( $tabs AS $tab => $slugs )
			{
			
				// Add tab to array?
				if( !array_key_exists($tab, $data) )
				{
					$data[$tab] = ( substr($tab, 0, 1) == '_' ? $slugs : array() );
				}

				// Assign to special tab
				if( in_array($field['input_slug'], $slugs) )
				{
					$data[$tab][] = $field;
					$found = TRUE;
				}

			}
			
			// Default to general
			if( $found == FALSE )
			{
				$data[$default][] = $field;
			}

		}
		
		// Retrun
		return $data;	
	}

	function get_order($id = NULL)
	{
		
		// Define order
		$_ORDER    = array();
		$_ORDER[1] = array('title' => lang('firesale:label_nameaz'), 'by' => 'title', 'dir' => 'asc');
		$_ORDER[2] = array('title' => lang('firesale:label_nameza'), 'by' => 'title', 'dir' => 'desc');
		$_ORDER[3] = array('title' => lang('firesale:label_pricelow'), 'by' => 'price', 'dir' => 'asc');
		$_ORDER[4] = array('title' => lang('firesale:label_pricehigh'), 'by' => 'price', 'dir' => 'desc');
		$_ORDER[5] = array('title' => lang('firesale:label_modelaz'), 'by' => 'code', 'dir' => 'asc');
		$_ORDER[6] = array('title' => lang('firesale:label_modelza'), 'by' => 'code', 'dir' => 'desc');
		
		// Return
		if( $id != NULL )
			return $_ORDER[$id];

		// Add key to values
		foreach($_ORDER AS $key => $order )
		{
			$_ORDER[$key]['key'] = $key;
		}

		return $_ORDER;
	}
	
	function nice_time($time) {
	
		$delta = ( time() - $time );
	
		if( $delta < 60 )
		{
			return lang('firesale:label_time_now');
		}
		else if( $delta < 120 )
		{
			return lang('firesale:label_time_min');
		}
		else if( $delta < ( 60 * 60 ) )
		{
			return sprintf(lang('firesale:label_time_mins'), floor($delta / 60));
		}
		else if( $delta < ( 90 * 60 ) )
		{
			return lang('firesale:label_time_hour');
		}
		else if( $delta < ( 24 * 60 * 60 ) )
		{
			return sprintf(lang('firesale:label_time_hours'), floor( $delta / 3600 ));
		}
		else if( $delta < ( 48 * 60 * 60 ) )
		{
			return lang('firesale:label_time_day');
		}
		else
		{
			return sprintf(lang('firesale:label_time_days'), floor( $delta / 86400 ));
		}

	}
