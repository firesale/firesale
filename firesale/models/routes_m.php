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

class Routes_m extends MY_Model
{

    protected $cache = array();

    /**
     * Loads the parent constructor and gets an
     * instance of CI.
     *
     * @return void
     * @access public
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->driver('Streams');
    }

    public function build_url($slug, $id = NULL)
    {

        // Variables
        $cache_key = $slug.'-'.$id;

        // Check cache
        if ( array_key_exists($cache_key, $this->cache) ) {
            // return cache
            return $this->cache[$cache_key];
        } else {

            // Get route info
            $query = $this->db->where('slug', $slug)->get('firesale_routes');
            $route = $query->row();

            // Found it
            if ( !empty($route) AND $route != 'null' ) {

                // Basic route formatting
                $formatted = $route->map;
                $formatted = html_entity_decode($formatted);
                $formatted = str_replace(array('{{ any }}', '{{ pagination }}'), '', $formatted);

                // Check table
                if ( ! empty($route->table) AND $id != NULL ) {

                    // Start query
                    $this->db->from($route->table.' AS t');

                    // Build query columns
                    if ( $route->table == 'firesale_orders' ) {
                        $this->db->select('t.id');
                    } else if ( $route->table == 'firesale_products' ) {
                        $this->db->select('t.id, t.slug, t.title, t.is_variation, v.parent')
                                 ->join('firesale_product_variations_firesale_products AS vp', 'vp.firesale_products_id = t.id', 'left')
                                 ->join('firesale_product_variations AS v', 'v.id = vp.row_id', 'left');
                    } else {
                        $this->db->select('t.id, t.slug, t.title');
                    }

                    // Get type
                    $type = $this->db->where('t.id', $id)->get()->row();

                    // Check type
                    if (  $route->table == 'firesale_products' and $type->is_variation == '1' ) {
                        $type = $this->db->where('id', $type->parent)->get($route->table)->row();
                    }

                    // Perform replacements
                    $formatted = @str_replace(array('{{ id }}', '{{ slug }}', '{{ title }}'), array($type->id, $type->slug, $type->title), $formatted);

                    // Check for product and category slug
                    if ( $route->table == 'firesale_products' AND ( strpos($formatted, '{{ category_slug }}') !== FALSE OR strpos($formatted, '{{ category_id }}') !== FALSE ) ) {
                        // Get category
                        $this->load->model('products_m');
                        $category  = current($this->pyrocache->model('products_m', 'get_categories', array($type->id), $this->firesale->cache_time));
                        $formatted = str_replace('{{ category_slug }}', $category['slug'], $formatted);
                        $formatted = str_replace('{{ category_id }}', $category['id'], $formatted);
                    }

                }

                // Add to cache
                $this->cache[$cache_key] = $formatted;

                // Return
                return $formatted;
            }
        }

        return FALSE;
    }

    public function get_by_module_controller($module, $controller)
    {
        // Run query
        $query = $this->db->like('translation', $module.'/'.$controller)->get('firesale_routes');

        // Check results
        if ( $query->num_rows() ) {
            return $query->row();
        }

        // Nothing found
        return false;
    }

    /**
     * Updates the search results URLs based on which route was just edited.
     * This enables everything to be kept in sync.
     *
     * @param string $route The route being edited
     * @access public
     */
    public function search_update($route)
    {
        // Check version
        if (CMS_VERSION < "2.2.0") {
            return FALSE;
        }

        // Get indexes
        $query = $this->db->select('id, entry_id')->where('entry_key', 'firesale:'.$route)->get('search_index');

        // Check results
        if ( $query->num_rows() ) {

            $results = $query->result_array();

            // Loop and update
            foreach ( $results as $result ) {
                $uri = $this->build_url($route, $result['entry_id']);
                $this->db->where('id', $result['id'])->update('search_index', array('uri' => $uri));
            }

        }

    }

    /**
     * Creates a new route by adding it to the databaes and then adding it to the
     * routes file to be cached and used by the system.
     *
     * @param  array           $input POST input array
     * @return Integer/Boolean ID or FALSE on success or failure
     * @access public
     */
    public function create($input)
    {

        // Remove btnAction
        unset($input['btnAction']);

        // Add extra information
        $input['created'] 		 = date("Y-m-d H:i:s");
        $input['created_by']     = $this->current_user->id;
        $input['ordering_count'] = 0;

        // Insert it
        if ( $this->db->insert('firesale_routes', $input) ) {

            // Get the new ID
            $id = $this->db->insert_id();

            // Update routes file
            $this->write($input['title'], $input['route'], $input['translation']);

            return $id;
        }

        return FALSE;
    }

    public function edit($id, $input, $row)
    {

        // Remove btnAction
        unset($input['btnAction']);

        // Add extra information
        $input['updated'] = date("Y-m-d H:i:s");

        // Insert it
        if ( $this->db->where('id', $id)->update('firesale_routes', $input) ) {

            // Update routes file
            $old_title = ( $row['title'] != $input['title'] ? $row['title'] : false );
            $this->write($input['title'], $input['route'], $input['translation'], $old_title);

            // Clear cache data on save
            Events::trigger('clear_cache');

            return TRUE;
        }

        return FALSE;
    }

    public function delete($id_slug)
    {

        // Get row
        $type = is_numeric($id_slug) && is_int(($id_slug + 0)) ? 'id' : 'slug';
        $row  = $this->db->where($type, $id_slug)->get('firesale_routes')->row();

        // Remove it
        if ( $row AND $this->db->where('id', $row->id)->delete('firesale_routes') ) {
            // Remove from file
            $this->remove($row->title);

            // Clear cache data on removal
            Events::trigger('clear_cache');

            // Success
            return TRUE;
        }

        // Something went wrong
        return FALSE;
    }

    public function write($title, $route, $map, $old_title = false)
    {
        // CH: Are we in the PyroCMS installer?
        $path = defined('PYROPATH') ? PYROPATH : APPPATH;

        // Variables
        $file    = $path.'config/routes.php';
        $content = file_get_contents($file);
        $before  = "\n/* End of file routes.php */";
        $title   = ( substr($title, 0, 5) == 'lang:' ? lang(substr($title, 5)) : $title );
        $_title  = str_replace(array('(', ')'), array('\(', '\)'), ($old_title?$old_title:$title));
        $regex   = "%(\n/\* FireSale - {$_title} \*/\n.+?\n)%si";
        $map     = preg_replace('/\$([0-9]+)/si', '\$__$1', $map);
        $string  = "\n/* FireSale - {$title} */\n\$route['{$route}'] = '{$map}';\n";

        if (! is_writeable($file)) {
            $this->session->set_flashdata('error', lang('firesale:routes:write_error'));
            redirect($_SERVER['HTTP_REFERER']);
        }

        // Existing route
        if ( preg_match($regex, $content) ) {
            // Replace in string
            $content = preg_replace($regex, $string, $content);
        } else {
            // Add to string
            $content = str_replace($before, $string.$before, $content);
        }

        // Fix mapping
        $content = str_replace('$__', '$', $content);

        // Write it
        file_put_contents($file, $content);
    }

    public function remove($title)
    {

        // Variables
        $file    = APPPATH.'config/routes.php';
        $content = file_get_contents($file);
        $title   = ( substr($title, 0, 5) == 'lang:' ? lang(substr($title, 5)) : $title );
        $regex   = "%(\n/\* FireSale - {$title} \*/\n.+?\n)%si";

        if (! is_writeable($file)) {
            $this->session->set_flashdata('error', lang('firesale:routes:write_error'));
            redirect($_SERVER['HTTP_REFERER']);
        }

        // Replace in string
        $content = preg_replace($regex, '', $content);

        // Write it
        file_put_contents($file, $content);
    }

    public function clear()
    {
        $routes = $this->db->select('title')->get('firesale_routes')->result_array();
        foreach ( $routes as $route ) {
            $this->remove($route['title']);
        }
    }

}
