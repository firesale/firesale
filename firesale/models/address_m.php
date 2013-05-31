<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* This file is part of FireSale, a PHP based eCommerce system built for
* PyroCMS.
*
* Copyright (c) 2013 Moltin Ltd.
* http://github.com/firesale/firesale
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*
* @package firesale/core
* @author FireSale <support@getfiresale.org>
* @copyright 2013 Moltin Ltd.
* @version master
* @link http://github.com/firesale/firesale
*
*/

class Address_m extends MY_Model
{

    /**
     * Gets all addresses for a given user
     *
     * @param  integer $user The User ID to query
     * @return array   An array containing the addresses
     * @access public
     */
    public function get_addresses($user)
    {

        // Set query paramaters
        $params	 = array(
            'stream'    => 'firesale_addresses',
            'namespace' => 'firesale_addresses',
            'where'     => SITE_REF."_firesale_addresses.created_by = '{$user}' AND ".SITE_REF."_firesale_addresses.title != ''",
            'order_by'  => 'id',
            'sort'      => 'desc'
        );

        // Get addresses
        $addresses = $this->streams->entries->get_entries($params);

        // Return
        return $addresses['entries'];
    }

    /**
     * Gets a single address by ID and optionally limited to a user
     *
     * @param  integer $id   The Address ID to query
     * @param  integer $user (Optional) The User ID to query for
     * @return array   Containing the address if found, otherwise FALSE
     * @access public
     */
    public function get_address($id, $user = NULL)
    {

        // Build query
        $query = $this->db->where('id', $id)->from('firesale_addresses');

        // User check?
        if ($user != NULL) {
            $query->where('created_by', $user);
        }

        // Run query
        $result = $query->get();

        // Check for result
        if ( $result->num_rows() ) {
            $result = $result->row();

            return $result;
        }

        // Nothing found?
        return FALSE;
    }

    /**
     * Stores an address of a given type (Shipping or Billing)
     * - the type does not limit to what it can be used for it
     * simply is used to determine which post inputs to use.
     *
     * @param  array   $input An array of post values
     * @param  string  $type  Either bill or ship
     * @return integer The new or existing ID of the address
     * @access public
     */
    public function add_address($input, $type)
    {
        unset($input['bill_details_same']);

        // Variables
        $created_by = $this->current_user->id OR $input['created_by'] OR 0;
        $items  = array('created_by' => $created_by);
        $ignore = array('shipping', 'ship_to', 'bill_to');

        // Get items
        foreach ($input AS $key => $value) {
            if ( substr($key, 0, 4) == $type AND !in_array($key, $ignore) ) {
                $items[substr($key, 5)] = $value;
            }
        }

        // Check for existing address
        $query = $this->db->select('id')->where($items)->get('firesale_addresses');

        // Add
        if ( ! $query->num_rows() ) {

            // Add to items
            $items['created']        = date("Y-m-d H:i:s");
            $items['ordering_count'] = 0;

            // Insert
            $this->db->insert('firesale_addresses', $items);
            return $this->db->insert_id();
        }

        $result = $query->row();
        return $result->id;
    }

    /**
     * Updates an existing address
     *
     * @param  integer $id   The ID of the Address to update
     * @param  array   $post Array of post values to use
     * @param  string  $type Either bill or ship to define the keys to use from $input
     * @return boolean TRUE or FALSE on successful update
     * @access public
     */
    public function update_address($id, $input, $type)
    {

        // Get rules
        $rules  = array();
        $update = array();
        $stream = $this->streams->streams->get_stream('firesale_addresses', 'firesale_addresses');
        $fields = $this->streams_m->get_stream_fields($stream->id);
        $_rules = $this->fields->set_rules($fields, 'edit', $input, TRUE,  NULL);

        // Build validation
        foreach ($_rules AS $rule) {

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
        if ( $this->form_validation->run() === TRUE ) {
            if ( $id > 0 AND $this->db->where('id', $id)->update('firesale_addresses', $update) ) {
                return $id;
            } else if ( $id <= 0 AND $address_id = $this->add_address($input, $type) ) {
                return $address_id;
            }
        }

        // Failed?
        return FALSE;
    }

    /**
     * Hashes the billing and shipping address input in order to check if they're
     * the same and if we should insert or update both or just one.
     *
     * @param  array $input The POST array
     * @return array Shipping and Billing Hashes
     * @access public
     */
    public function input_hash($input)
    {

        // Variables
        $ignore    = array('bill_details_same', 'ship_to', 'bill_to');
        $ship_hash = '';
        $bill_hash = '';

        // Loop input
        foreach ($input AS $key => $val) {
            if ( !in_array($key, $ignore) ) {
                if ( substr($key, 0, 5) == 'ship_' ) {
                    $ship_hash .= $val;
                } elseif ( substr($key, 0, 5) == 'bill_' ) {
                    $bill_hash .= $val;
                }
            }
        }

        // Generate the hash
        $ship_hash = md5($ship_hash);
        $bill_hash = md5($bill_hash);

        // Return them
        return array($ship_hash, $bill_hash);
    }

    /**
     * Build the form used on both the front and back-end to input addresses.
     * This also seperates them into tabs and sections of information and address
     * fields for use in layout.
     *
     * @param  string $type  Either bill or ship
     * @param  string $mode  Sets the mode (new or edit) for inserting or updating info
     * @param  array  $input The POST variables that are to be processed
     * @return array
     * @access public
     */
    public function get_address_form($type = NULL, $mode = 'new', $input = NULL)
    {

        // Variables
        $tmp     = $input;
        $data    = array();
        $address = array('address1', 'address2', 'city', 'county', 'postcode', 'country');
        $tabs    = array('details' => array(), 'address' => array());
        $stream  = $this->streams->streams->get_stream('firesale_addresses', 'firesale_addresses');

        // Pull out post data
        if ( $input !== null ) {

            // Fix key names based on type
            foreach( $input as $key => $val ) {
                if( substr($key, 0, 5) == $type.'_' ) { $data[substr($key, 5)] = $val; } else { $data[$key] = $val; }
            }

            // Set into post
            $_POST = $data;
        }

        // Fix language settings
        if ( ! empty($_POST) ) {
            $this->address_langauge_fix($stream->id, $type);
        }

        // Get fields
        $fields = $this->fields->build_form($stream, $mode, $data, FALSE, FALSE, array(), array());

        // Format fields
        foreach( $fields AS $field ) {
            
            // Prefix input slugs
            $key = ( in_array($field['input_slug'], $address) ? 'address' : 'details' );
            if( $type != NULL ) {
                $field['input'] = str_replace(array('id="', 'name="'), array('id="' . $type . '_', 'name="' . $type . '_'), $field['input']);
            }

            // Correct titles
            if ( substr($field['input_title'], 0, 5) == 'lang:' ) {
                $key = substr($field['input_title'], 5);
                $this->lang->language[$key] = str_replace(lang('firesale:title:'.$type).' ', '', lang($key));
            }

            // Reassign
            $tabs[$key][] = $field;
        }

        // Reset post
        $_POST = $input;

        return $tabs;
    }

    /**
     * Fixes the language strings for an address form to better display if an error
     * has occured with billing or shipping fields.
     * 
     * @param  int $stream_id The stream ID for the address form
     * @param  string $type   The type to deal with bill or ship
     * @return void
     */
    public function address_langauge_fix($stream_id, $type)
    {
        // Check type
        if ( $type === null ) { return; }

        // Variables
        $other = ( $type == 'bill' ? 'ship' : 'bill' );

        // Get fields
        $fields = $this->db->select('f.field_name')
                           ->from('data_fields AS f')
                           ->join('data_field_assignments AS fa', 'fa.field_id = f.id', 'inner')
                           ->where('fa.stream_id', $stream_id)
                           ->get()
                           ->result_array();

        // Loop and reassign fields
        foreach ( $fields as $field ) {
            $key   = substr($field['field_name'], 5);
            $field = lang($key);
            $clean = str_replace(lang('firesale:title:'.$other).' ', '', $field);
            $this->lang->language[$key] = lang('firesale:title:'.$type).' '.$clean;
        }
    }

}
