<?php

    /**
     * Detects if a given module is currently installed
     *
     * @param  string  $module A module slug to query
     * @return boolean TRUE or FALSE on installed or not
     * @access public
     */
    function is_module_installed($module)
    {

        // Get instance
        $_CI =& get_instance();

        // Ensure core is installed first
        $query = $_CI->db->select('id')->where("slug = '{$module}' AND installed = 1")->get('modules');

        // Check query
        if ( $query->num_rows() ) {
            return TRUE;
        }

        return FALSE;
    }

    /**
     * Reorders a given steams table by updating the ordering_count field based on
     * the comma seperated array passed to it.
     *
     * @param string $order Comma seperated list of ids to update
     * @param string $table The tablename you wish you update
     * @param string $replace (Optional) A string to replace in each of the array items
     * @return string ok/error on success and failure
     */
    function order_table($order, $table, $replace = null)
    {

        // Get instance
        $_CI =& get_instance();

        // Check data
        if ( strlen($order) > 0 ) {

            $order = explode(',', $order);

            // Loop and update rows
            for ( $i = 0; $i < count($order); $i++ ) {
                if ( strlen($order[$i]) > 0 ) {
                    $id = str_replace($replace, '', $order[$i]);
                    $_CI->db->where('id', $id)->update($table, array('ordering_count' => $i));
                }
            }

            // Updated, clear cache!
            Events::trigger('clear_cache');
            return 'ok';
        }

        return 'error';
    }

    /**
     * Adds the given modules asset namespace to be referenced by other modules
     *
     * @param string $module The module name to be added to the namespace
     * @return void
     */
    function asset_namespace($module)
    {
        // Variables
        $dir = ADDONPATH.'/modules/';
        
        // Check shared addons
        if( file_exists(SHARED_ADDONPATH.'modules/'.$module.'/details.php') ) {
            $dir = SHARED_ADDONPATH.'modules/';
        }
        
        // Register namespace
        Asset::add_path($module, $dir.$module.'/');
    }

    /**
     * Gets the version for the currently installed field type
     * @param string $type field type name
     * @return string The field type version
     */
    function field_type_version($type)
    {
        // Get instance
        $_CI =& get_instance();
        $_CI->load->library('streams_core/type');

        // Get and return information
        $type = $_CI->type->load_single_type($type);
        if ( $type !== null ) { return $type->version; }
        
        // Not installed
        return false;
    }

    /**
     * Truncates a string by a number of characters but ensures to complete the
     * last word, following by "..."
     *
     * @param  string  $string The string to truncate
     * @param  integer $length (Optional) The character count to limit to
     * @return string  The truncated string
     * @access public
     */
    function truncate_words($string, $length = 140)
    {

        if ( strlen($string) > $length ) {
            $string = substr( $string, 0, strrpos( substr( $string, 0, $length), ' ' ) ) . '...';
        }

        return $string;
    }

    /**
     * Splits Streams fileds into an array of tabs, specified fields in a tabs array
     * will be put into their designated positions with all others failling into a
     * default "general options" array.
     *
     * @param  array $fields A Streams generated array of fields
     * @param  array $tabs   A guide containing the tab name and an array of field names
     * @return array
     * @access public
     */
    function fields_to_tabs($fields, $tabs, $default = 'general')
    {

        // Variables
        $data = array($default => array());

        // Loop fields
        foreach ($fields AS $key => $field) {

            // Reset found
            $found = FALSE;

            // Loop each of the tab options
            foreach ($tabs AS $tab => $slugs) {
                // Add tab to array?
                if ( !array_key_exists($tab, $data) ) {
                    if ($tab != '!hidden')
                        $data[$tab] = is_array($slugs) ? array() : $slugs;
                }

                // Assign to special tab
                if ( in_array($field['input_slug'], $slugs) ) {
                    if ($tab != '!hidden')
                        $data[$tab][] = $field;

                    $found = TRUE;
                }

            }

            // Default to general
            if ($found == FALSE) {
                $data[$default][] = $field;
            }

        }

        //unset($data['_hidden']);

        // Retrun
        return $data;
    }

    /**
     * Returns the available ordering options for products or the requested order
     * according to a specified ID (array key)
     *
     * @param  integer $id (Optional) The key for a given item in the order array
     * @return array   Either one or all of the ordering options
     * @access public
     */
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
        if ($id != NULL) {
            return $_ORDER[$id];
        }

        // Add key to values
        foreach ($_ORDER AS $key => $order) {
            $_ORDER[$key]['key'] = $key;
        }

        return $_ORDER;
    }

    /**
     * Generates a "twitter-like" time string displaying how long ago since a given
     * unix time occured.
     *
     * @param  integer $time A unix timestamp
     * @return string
     * @access public
     */
    function nice_time($time)
    {
        $delta = ( time() - $time );

        if ($delta < 60) {
            return lang('firesale:label_time_now');
        } elseif ($delta < 120) {
            return lang('firesale:label_time_min');
        } elseif ( $delta < ( 60 * 60 ) ) {
            return sprintf(lang('firesale:label_time_mins'), floor($delta / 60));
        } elseif ( $delta < ( 90 * 60 ) ) {
            return lang('firesale:label_time_hour');
        } elseif ( $delta < ( 24 * 60 * 60 ) ) {
            return sprintf(lang('firesale:label_time_hours'), floor( $delta / 3600 ));
        } elseif ( $delta < ( 48 * 60 * 60 ) ) {
            return lang('firesale:label_time_day');
        } else {
            return sprintf(lang('firesale:label_time_days'), floor( $delta / 86400 ));
        }

    }
