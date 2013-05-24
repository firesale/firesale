<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

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

class Categories_m extends MY_Model
{

    /**
     * Contains the current database table name
     *
     * @var string
     * @access public
     */
    public $_table = 'firesale_categories';

    /**
     * Caches all category queries by slug or id
     *
     * @var array
     * @access protected
     */
    protected $cache = array('id' => array(), 'slug' => array());

    /**
     * Gets the category via id or slug via streams
     *
     * @param  string $id_slug The Category ID or slug to query
     * @return array  The requested Category if found, FALSE if not
     * @access public
     */
    public function get_category($id_slug)
    {

        // Variables
        $type = is_numeric($id_slug) && is_int(($id_slug + 0)) ? 'id' : 'slug';

        // Check cache
        if ( array_key_exists($id_slug, $this->cache[$type]) ) {
            // Return cached version
            return $this->cache[$type][$id_slug];
        } else {

            $this->load->library('files/files');

            // Set params
            $params = array(
                'stream'    => 'firesale_categories',
                'namespace' => 'firesale_categories',
                'where'     => SITE_REF."_firesale_categories.{$type} = '{$id_slug}'",
                'limit'     => '1',
                'order_by'  => 'id',
                'sort'      => 'desc'
            );

            // Add to params if required
            if ( $this->uri->segment('1') != 'admin' ) {
                $params['where'] .= ' AND '.SITE_REF.'_firesale_categories.status = 1';
            }

            // Get entries
            $category = $this->streams->entries->get_entries($params);

            // Check exists
            if ($category['total'] > 0) {

                // Get category
                $category = current($category['entries']);

                // Get images
                $folder = get_file_folder_by_slug($category['slug'], 'category-images');
                $images = Files::folder_contents($folder->id);
                $category['images'] = $images['data']['file'];

                // Get a child count
                $category['children'] = $this->db->where('parent', $category['id'])->get('firesale_categories')->num_rows();

                // Append data from other modules
                $results = Events::trigger('category_get', $category, 'array');
                foreach ($results as $result) {
                    $category = array_merge($category, $result);
                }

                // Prefix
                $segments                = explode('/', $category['slug']);
                $category['slug']        = $category['slug'];
                $category['slug_prefix'] = implode('/', array_pop($segments));

                // Add to cache
                $this->cache['id'][$category['id']]     = $category;
                $this->cache['slug'][$category['slug']] = $category;

                // Return it
                return $category;
            }

        }

        // Nothing?
        return FALSE;
    }

    public function get_complete_slug($parent)
    {

        // Variables
        $slug             = '';
        $parent['parent'] = $parent['id'];

        // If we have a parent to deal with
        if ( $parent['parent'] != 0 ) {

            // Loop until we hit the root
            do {
                $query    = $this->db->select('id, parent, slug')->where('id', $parent['parent'])->get('firesale_categories');
                $parent   = current($query->result_array());
                $segments = explode('/', $parent['slug']);
                $slug     = array_pop($segments).'/'.$slug;
            } while ( $parent['parent'] != 0 and $parent['parent'] != null );

        }

        return $slug;
    }

    /**
     * Gets the child categories of a given parent category
     *
     * @param  string $parent The category ID to query
     * @return array
     * @access public
     */
    public function get_children($parent)
    {

        // Run query
        $query = $this->db->select('id')->where('parent', $parent)->get($this->_table);

        // Check results
        if ( $query->num_rows() ) {
            $ids = array();
            $results = $query->result_array();
            foreach ($results AS $result) {
                $ids[] = $result['id'];
            }

            return $ids;
        }

        // Empty array for no children
        return array();
    }

    /**
    * Gets all children of a parent category
    *
    * @param integer $parent The current category ID
    * @return array
    * @access public
    */
    public function get_all_children($parent)
    {

        $children = $this->pyrocache->model('categories_m', 'get_children', array($parent), $this->firesale->cache_time);

        foreach ($children as $child) {
            $children = array_unique(array_merge($children, $this->get_all_children($child)));
        }

        return $children;
    }

    /**
     * Builds the product query for use in other functions
     *
     * @param  array            $category The Category object to query
     * @return DB_Driver_Object
     * @access public
     */
    public function _build_query($category)
    {
        $show_variations = (bool) $this->settings->get('firesale_show_variations');

        // Get ALL THE CHILDREN!
        if ( isset($category['id']) AND $category['id'] != NULL ) {
            $children = $this->pyrocache->model('categories_m', 'get_all_children', array($category['id']), $this->firesale->cache_time);
        }

        // Build the initial query
        $query = $this->db->select('`row_id` AS id', FALSE)
                          ->from('firesale_products_firesale_categories')
                          ->join('firesale_products', 'firesale_products.id = firesale_products_firesale_categories.row_id', 'inner')
                          ->where('firesale_products.status', 1)
                          ->group_by('firesale_products.slug');

        if ( ! $show_variations)
            $query->where('is_variation', 0);

        // Check for children
        if ( isset($children) AND ! empty($children) ) {
            $children[] = $category['id'];
            $query->where_in('firesale_categories_id', $children);
        } elseif ( isset($category['id']) AND $category['id'] != NULL ) {
            $query->where('firesale_categories_id', (int) $category['id']);
        }

        // Return object
        return $query;
    }

    /**
     * Counts the total number of products within a given category or sub-categories
     *
     * @param  integer $category The Category ID to query
     * @return integer
     * @access public
     */
    public function total_products($category)
    {

        // Get a query
        $query = $this->_build_query(array('id' => $category));

        // Run the query
        $result = $query->get();

        // Return the resulting count
        return $result->num_rows();
    }

    /**
     * Deletes a Category (other than ID: 1) and adds it's
     * children categories to the default category before
     * removing the category from products that are in it.
     *
     * @param $id The Category ID to delete
     * @return boolean TRUE or FALSE on successful deletion
     * @access public
     */
    public function delete($id)
    {

        // Check if we're deleting Category 1
        if ($id != 1) {

            // Was it deleted?
            if ( $this->db->delete('firesale_categories', array('id' => ( 0 + $id ))) ) {

                // Add children to root category
                $this->db->update('firesale_categories', array('parent' => 1), 'parent = ' . ( 0 + $id ));

                // Add products to root category
                $this->db->where('firesale_categories_id', ( 0 + $id ))->update('firesale_products_firesale_categories', array('firesale_categories_id' => 1));

                // Return
                return TRUE;
            }

        }

        return FALSE;
    }

    /**
     * Creates the required array of values for a dropdown
     * in the following format:
     *
     *   Category ID => Category Title
     *
     * @return array
     * @access public
     */
    public function dropdown_values()
    {

        $_cats = $this->db->select('id, slug, title')->order_by('title')->get($this->_table)->result_array();
        $cats  = array();

        foreach ($_cats AS $cat) {
            $cats[$cat['id']] = $cat['title'];
        }

        return $cats;
    }

    /**
     * Creates the required array of values to generate
     * the tree shown on the categories management page.
     * The array key is the ID of the category and may
     * feature an array called 'children' which has IDs
     * as values rather than keys.
     *
     * @param $params A valid params array for streams
     * that is passed into get_entries recursivly
     * @return array
     * @access public
     */
    public function generate_streams_tree($params)
    {

        // Variables
        $tmp  = array();
        $tree = array();

        // Get categories
        $categories = $this->streams->entries->get_entries($params);

        // Start building
        foreach ($categories['entries'] AS $category) {
            $tmp[$category['id']] = $category;
        }

        unset($categories);

        foreach ($tmp as $row) {

            if ( array_key_exists($row['parent']['id'], $tmp) ) {
                $tmp[$row['parent']['id']]['children'][] =& $tmp[$row['id']];
            }

            if ($row['parent'] == 0 or ( array_key_exists('id', $row['parent']) and $row['parent']['id'] === null )) {
                $tree[] =& $tmp[$row['id']];
            }

        }

        // Return
        return $tree;
    }

    /**
     * Builds the tree for display on the Category
     * management page. The string is an HTML list
     * structure with sub-lists for the children
     * categories.
     *
     * @param  array   $cat   An array containing the current Category details.
     * @param  string  $tree  (Optional) The current html structure that is being built recursivly.
     * @param  boolean $first (Optional) A boolean to track the first element to echo the output.
     * @return string  The html tree that is being built
     * @access public
     */
    public function tree_builder($cat, $tree = '', $first = true)
    {

        // Variables
        if ( isset($cat['children']) ) {

            foreach ($cat['children'] as $cat) {

                $url   = $this->pyrocache->model('routes_m', 'build_url', array('category', $cat['id']), $this->firesale->cache_time);
                $tree .= '<li id="cat_' . $cat['id'] . '">' . "\n";
                $tree .= '  <div'.( $cat['status']['key'] == '0' ? ' class="draft"' : '' ).'>' . "\n";
                $tree .= '    <a href="#' . $cat['id'] . '" rel="' . $cat['id'] . '">' . $cat['title'] . '</a>' . "\n";
                $tree .= '  </div>' . "\n";

                if ( isset($cat['children']) ) {

                    $tree .= '  <ul>' . "\n";
                    $tree  = $this->tree_builder($cat, $tree, false);
                    $tree .= '  </ul>' . "\n";
                    $tree .= '</li>' . "\n";
                }

                $tree .= '</li>' . "\n";
            }

        }

        // Return or echo
        if (!$first) {
            return $tree;
        } else {
            echo $tree;
        }

    }

    /**
     * Sets the children of a given category or array
     * of categories. Used by the order function in
     * the admin controller to define the parent/child
     * tree when categories are moved.
     *
     * @param array $cat An array of categories and children
     * to be set as children of the parent.
     * @return void
     * @access public
     */
    public function set_children($cat)
    {
        if ( isset($cat['children']) ) {
            foreach ($cat['children'] as $i => $child) {

                // Variables
                $id     = str_replace('cat_', '', $child['id']);
                $parent = str_replace('cat_', '', $cat['id']);
                $update = array('parent' => (string)( $parent != $id ? $parent : "0" ), 'ordering_count' => $i);

                // Update
                $this->db->where('id', $id)->update('firesale_categories', $update);

                //repeat as long as there are children
                if ( isset($child['children']) ) {
                    $this->set_children($child);
                }

            }
        }
    }

    /**
     * Removes and creates core search indexing for a category.
     *
     * @param array $category Product data array
     * @param boolean [$add] Should this be added to the index
     * @access public
     */
    public function search($category, $add = false)
    {

        // Check version
        if (CMS_VERSION >= '2.2' and $category !== false) {

            // Load required items
            $this->load->model('search/search_index_m');

            // Try and remove existing item
            $this->search_index_m->drop_index('firesale', 'firesale:category', $category['id']);

            if ($add) {
                // Add to search
                $this->search_index_m->index(
                    'firesale',
                    'firesale:category',
                    'firesale:categories',
                    $category['id'],
                    $this->pyrocache->model('routes_m', 'build_url', array('category', $category['id']), $this->firesale->cache_time),
                    $category['title'],
                    strip_tags($category['description']),
                    array(
                        'cp_edit_uri'   => 'admin/firesale/categories#'.$category['id'],
                        'cp_delete_uri' => 'admin/firesale/categories/delete/'.$category['id'],
                        'keywords'      => ( isset($category['meta_keywords']) ? $category['meta_keywords'] : null ),
                    )
                );
            }

        }

    }

    /**
     * Builds the breadcrumbs for the given category page
     * 
     * @param  array  $category The current category
     * @param  object $template Template object reference
     * @return void
     */
    public function build_breadcrumbs($category, &$template)
    {
        if ( $category == null ) {
            $url  = $this->pyrocache->model('routes_m', 'build_url', array('category', NULL), $this->firesale->cache_time);
            $template->set_breadcrumb(lang('firesale:cats_all_products'));
        } else {
            $cats = $this->pyrocache->model('products_m', 'get_cat_path', array($category['id'], true), $this->firesale->cache_time);
            foreach ($cats as $key => $cat) {
                $url = $this->pyrocache->model('routes_m', 'build_url', array('category', $cat['id']), $this->firesale->cache_time);
                if ($category['id'] == $cat['id']) {
                    $template->set_breadcrumb($cat['title']);
                } else {
                    $template->set_breadcrumb($cat['title'], $url);
                }
            }
        }
    }

}
