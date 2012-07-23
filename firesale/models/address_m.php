<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Address_m extends MY_Model
{

	public function get_addresses($user)
	{

		// Set query paramaters
		$params	 = array(
					'stream' 	=> 'firesale_addresses',
					'namespace'	=> 'firesale_addresses',
					'where'		=> 'created_by = ' . $user,
					'order_by'	=> 'id',
					'sort'		=> 'desc'
				   );
		
		// Get addresses	
		$addresses = $this->streams->entries->get_entries($params);

		// Return
		return $addresses['entries'];
	}

	public function get_address($id, $user = NULL)
	{

		// Build query
		$query = $this->db->where('id', $id)->from('firesale_addresses');
		
		// User check?
		if( $user != NULL )
		{
			$query->where('created_by', $user);
		}

		// Run query
		$result = $query->get();

		// Check for result
		if( $result->num_rows() )
		{
			$result = $result->row();
			return $result;
		}

		// Nothing found?
		return FALSE;
	}

	public function add_address($input, $type)
	{

		unset($input['bill_details_same']);

		// Variables
		$items  = array('created_by' => ( isset($this->current_user->id) ? $this->current_user->id : 0));
		$ignore = array('shipping', 'ship_to', 'bill_to');

		// Get items
		foreach( $input AS $key => $value )
		{
			if( substr($key, 0, 4) == $type AND !in_array($key, $ignore) )
			{
				$items[substr($key, 5)] = $value;
			}
		}

		// Check for existing address
		$query = $this->db->select('id')->where($items)->get('firesale_addresses');

		// Add
		if( !$query->num_rows() )
		{

			// Add to items
			$items['created']        = date("Y-m-d H:i:s");
			$items['ordering_count'] = 0;

			// Insert
			$this->db->insert('firesale_addresses', $items);
			return $this->db->insert_id();

		}
		else
		{
			$result = $query->row();
			return $result->id;
		}

	}

	public function update_address($id, $input, $type)
	{

		// Get rules
		$rules  = array();
		$update = array();
		$stream = $this->streams->streams->get_stream('firesale_addresses', 'firesale_addresses');
		$fields = $this->streams_m->get_stream_fields($stream->id);
		$_rules = $this->fields->set_rules($fields, 'edit', $input, TRUE,  NULL);

		// Build validation
		foreach( $_rules AS $rule )
		{

			// Format values
			$update[$rule['field']] = $input[$type . '_' . $rule['field']];

			// Format rules
			$_rule   		= $rule;
			$_rule['field'] = $type . '_' . $_rule['field'];
			$rules[] 		= $_rule;

		}

		// Set validation rules
		$this->form_validation->set_rules($rules);

		// Run validation
		if( $this->form_validation->run() === TRUE )
		{
			if( $this->db->where('id', $id)->update('firesale_addresses', $update) )
			{
				return TRUE;
			}
		}

		// Failed?
		return FALSE;
	}

	public function get_address_form($type = NULL, $mode = 'new', $input = NULL)
	{
	
		// Variables
		$address = array('address1', 'address2', 'city', 'county', 'postcode', 'country');
		$tabs    = array('details' => array(), 'address' => array());
		$stream  = $this->streams->streams->get_stream('firesale_addresses', 'firesale_addresses');
		$fields  = $this->fields->build_form($stream, $mode, ( $input != NULL ? $input : $this->input->post() ), FALSE, FALSE, array(), array());

		// Format fields
		foreach( $fields AS $field )
		{
			$key = ( in_array($field['input_slug'], $address) ? 'address' : 'details' );
			if( $type != NULL )
			{
				$field['input'] = str_replace(array('id="', 'name="'), array('id="' . $type . '_', 'name="' . $type . '_'), $field['input']);
			}
			$tabs[$key][] = $field;
		}
		
		return $tabs;	
	}


}
