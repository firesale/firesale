<?php defined('BASEPATH') or exit('No direct script access allowed');

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

/**
 * Detects if a given module is currently installed
 *
 * @param  string  $module A module slug to query
 * @return boolean true or false on installed or not
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
        return true;
    }

    return false;
}

/**
 * Gets a Files folder object based on the Product/Name slug.
 *
 * @param  string $slug The slug to query
 * @param  string [$parent] The parent slug to query
 * @return object or boolean false on failure
 * @access public
 */
function get_file_folder_by_slug($slug, $parent = null)
{

    // Get instance
    $_CI =& get_instance();

    // Get parent and child
    if ( $parent !== null ) {
        $parent = get_file_folder_by_slug($parent);
        $result = $_CI->db->where('slug', $slug)->where('parent_id', $parent->id)->get('file_folders');

    // Just child
    } else {
        $result = $_CI->db->where('slug', $slug)->get('file_folders');
    }

    // Check results
    if ( $result->num_rows() ) {
        $parent = $result->row();

        return $parent;
    }

    return false;
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
 * Reassigns the streams helper variables to fix the first, last and odd_even
 * items, ensuring they are correct after being pulled out singally.
 *
 * @param  array $array The array to fix
 * @return array        The fixed array
 */
function reassign_helper_vars($array)
{
    // Variables
    $count    = 0;
    $odd_even = 'even';

    // Loop array
    foreach ( $array as &$item ) {
        $count           += 1;
        $item['first']    = ( $count == 1 ? '1' : '0' );
        $item['last']     = ( count($array) == $count ? '1' : '0' );
        $item['odd_even'] = $odd_even = ( $odd_even == 'even' ? 'odd' : 'even' );
        $item['count']    = $count;
    }

    return $array;
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
    if (is_dir(SHARED_ADDONPATH.'modules/'.$module)) {
        $dir = SHARED_ADDONPATH.'modules/';
    } elseif ( ! is_dir($dir.$module)) {
        $core_path = defined('PYROPATH') ? PYROPATH : APPPATH;
        $dir = $core_path.'modules/';
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
        $found = false;

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

                $found = true;
            }

        }

        // Default to general
        if ($found == false) {
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
function get_order($id = null)
{

    // Define order
    $_ORDER    = array();
    $_ORDER[1] = array('title' => lang('firesale:label_nameaz'), 'by' => 'title', 'dir' => 'asc');
    $_ORDER[2] = array('title' => lang('firesale:label_nameza'), 'by' => 'title', 'dir' => 'desc');
    $_ORDER[3] = array('title' => lang('firesale:label_pricelow'), 'by' => 'price', 'dir' => 'asc');
    $_ORDER[4] = array('title' => lang('firesale:label_pricehigh'), 'by' => 'price', 'dir' => 'desc');
    $_ORDER[5] = array('title' => lang('firesale:label_modelaz'), 'by' => 'code', 'dir' => 'asc');
    $_ORDER[6] = array('title' => lang('firesale:label_modelza'), 'by' => 'code', 'dir' => 'desc');
    $_ORDER[7] = array('title' => lang('firesale:label_creatednew'), 'by' => 'created', 'dir' => 'desc');
    $_ORDER[8] = array('title' => lang('firesale:label_createdold'), 'by' => 'created', 'dir' => 'asc');

    // Return
    if ($id !== null) {
        $_ORDER[$id]['key'] = $id;
        return $_ORDER[$id];
    }

    // Add key to values
    foreach ($_ORDER AS $key => $order) {
        $_ORDER[$key]['key'] = $key;
    }

    return $_ORDER;
}

/**
* Builds a pipe seperated list of available currencies
*
* @return string
*/
function get_currencies()
{
    // Variables
    $_CI =& get_instance();
    $currencies =  '';

    // Get them
    $results = $_CI->db->select('id, cur_code')->get('firesale_currency')->result_array();

    // Format
    foreach ( $results as $result ) {
        $currencies .= ( strlen($currencies) > 0 ? '|' : '' ).$result['id'].'='.$result['cur_code'];
    }

    return $currencies;
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

/**
 * Track the install, uninstall and upgrade status of a module.
 * 
 * @param  string $action      The action being performed - install, uninstall or upgrade
 * @param  string $version     The current version being installed
 * @param  string $old_version The old version being upgraded from
 * @return void
 */
function statistics($action, $version, $old_version = null)
{
    // Variables
    $_CI =& get_instance();
    $url =  'https://www.getfiresale.org/stats/add';
    $uri =  $_CI->uri->rsegment_array();

    // Build initial data
    $data = array(
        'module'          => end($uri),
        'action'          => $action,
        'version'         => $version,
        'pyro_version'    => CMS_VERSION,
        'php_version'     => phpversion(),
        'server_hash'     => md5($_CI->input->server('SERVER_NAME').$_CI->input->server('SERVER_ADDR').$_CI->input->server('SERVER_SIGNATURE')),
        'server_software' => $_CI->input->server('SERVER_SOFTWARE')
    );

    // Upgrade
    if ( $action == 'upgrade' and $old_version !== null ) {
        $data['old_version'] = $old_version;
    }

    // Perform request
    if ( class_exists('Curl') ) {
        include $_SERVER['DOCUMENT_ROOT'].'/system/sparks/curl/1.2.1/libraries/Curl.php';
        $curl = new Curl;
        $curl->simple_post($url, $data);
    } else {
        $request = http_build_query($data);
        file_get_contents($url.'?'.$request);
    }

}
