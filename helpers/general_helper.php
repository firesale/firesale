<?php

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
