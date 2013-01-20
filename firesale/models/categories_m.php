<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Categories model
 *
 * @author		Jamie Holdroyd
 * @author		Chris Harvey
 * @package		FireSale\Core\Models
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
            $params	 = array(
                        'stream' 	=> 'firesale_categories',
                        'namespace'	=> 'firesale_categories',
                        'where'		=> SITE_REF."_firesale_categories.{$type} = '{$id_slug}'",
                        'limit'		=> '1',
                        'order_by'	=> 'id',
                        'sort'		=> 'desc'
                       );

            // Add to params if required
            if ( $this->uri->segment('1') != 'admin' ) {
                $params['where'] .= ' AND status = 1';
            }

            // Get entries
            $category = $this->streams->entries->get_entries($params);

            // Check exists
            if ($category['total'] > 0) {

                // Get category
                $category = current($category['entries']);

                // Get images
                $folder = $this->products_m->get_file_folder_by_slug($category['slug']);
                $images = Files::folder_contents($folder->id);
                $category['images'] = $images['data']['file'];

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
     * Builds the product query for use in other functions
     *
     * @param  array            $category The Category object to query
     * @return DB_Driver_Object
     * @access public
     */
    public function _build_query($category)
    {
        $show_variations = (bool) $this->settings->get('firesale_show_variations');

        // Get children
        if ( isset($category['id']) AND $category['id'] != NULL ) {
            $children = $this->get_children($category['id']);
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
                $tree .= '  <div>' . "\n";
                $tree .= '    <a href="'.BASE_URL.$url.'" rel="' . $cat['id'] . '">' . $cat['title'] . '</a>' . "\n";
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
     *					 to be set as children of the parent.
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
                $update = array('parent' => ( $parent != $id ? $parent : 0 ), 'ordering_count' => $i);

                // Update
                $this->db->where('id', $id)->update('firesale_categories', $update);

                //repeat as long as there are children
                if ( isset($child['children']) ) {
                    $this->set_children($child);
                }

            }
        }
    }

}
