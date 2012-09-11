<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Categories_m extends MY_Model {

	/**
	 * Contains the current database table name
	 *
	 * @var string
	 * @access public
	 */
    public $_table = 'firesale_categories';

	/**
	 * Gets the category via id or slug via streams
	 *
	 * @param string $id_slug The Category ID or slug to query
	 * @return array The requested Category if found, FALSE if not
	 * @access public
	 */
	public function get_category($id_slug)
	{

		// Set params
		$params	 = array(
					'stream' 	=> 'firesale_categories',
					'namespace'	=> 'firesale_categories',
					'where'		=> ( ( 0 + $id_slug ) > 0 ? 'id = ' : 'slug = ' ) . "'{$id_slug}'",
					'limit'		=> '1',
					'order_by'	=> 'id',
					'sort'		=> 'desc'
				   );

		// Add to params if required
		if( $this->uri->segment('1') != 'admin' )
		{
			$params['where'] .= ' AND status = 1';
		}
		
		// Get entries		
		$category = $this->streams->entries->get_entries($params);

		// Check exists
		if( $category['total'] > 0 )
		{
			return current($category['entries']);
		}
		
		// Nothing?
		return FALSE;
	}

    /**
     * Gets the child categories of a given parent category
     *
     * @param string $parent The category ID to query
     * @return array
     * @access public
     */
    public function get_children($parent)
    {

    	// Run query
    	$query = $this->db->select('id')->where('parent', $parent)->get($this->_table);

    	// Check results
    	if( $query->num_rows() )
    	{
    		$ids = array();
    		$results = $query->result_array();
    		foreach( $results AS $result )
    		{
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
     * @param integer $category The Category ID to query
     * @return DB_Driver_Object
     * @access public
     */
    public function _build_query($category)
    {

    	// Variables
		$children = $this->get_children($category);
    	$query    = $this->db->select('firesale_products.`id`', FALSE)
    						 ->from('firesale_products_firesale_categories')
    						 ->join('firesale_products', 'firesale_products.id = firesale_products_firesale_categories.row_id', 'inner')
    						 ->join('firesale_categories', 'firesale_categories.id = firesale_products_firesale_categories.firesale_categories_id', 'inner')
    						 ->where('firesale_products.status', 1)
    						 ->group_by('firesale_products.slug');

    	// Has children?
    	if( !empty($children) )
		{
			// Then get the count including child products
			$children[] = $category;
			$query->where_in('firesale_categories_id', $children);
		}
		else
		{
			// Otherwise just this categories
			$query->where('firesale_categories_id', (int)$category);
		}

		// Return object
		return $query;
    }

    /**
     * Counts the total number of products within a given category or sub-categories
     *
     * @param integer $category The Category ID to query
     * @return integer
     * @access public
     */
    public function total_products($category)
    {

    	// Get a query
    	$query = $this->_build_query($category);

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
		if( $id != 1 )
		{

			// Was it deleted?
			if( $this->db->delete('firesale_categories', array('id' => ( 0 + $id ))) )
			{

				// Add children to root category
				$this->db->update('firesale_categories', array('parent' => 1), 'parent = ' . ( 0 + $id ));

				// Add products to root category
				$this->db->update('firesale_products_firesale_categories', array('firesale_categories_id' => 1));

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
		
		foreach( $_cats AS $cat )
		{
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
		foreach( $categories['entries'] AS $category )
		{
			$tmp[$category['id']] = $category;
		}
		
		unset($categories);

		foreach( $tmp as $row )
		{
	
			if( array_key_exists($row['parent']['id'], $tmp) )
			{
				$tmp[$row['parent']['id']]['children'][] =& $tmp[$row['id']];
			}
	
			if ($row['parent'] == 0)
			{
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
	 * @param array $cat An array containing the current Category details.
	 * @param string $tree (Optional) The current html structure that is being built recursivly.
	 * @param boolean $first (Optional) A boolean to track the first element to echo the output.
	 * @return string The html tree that is being built
	 * @access public
	 */
	public function tree_builder($cat, $tree = '', $first = true)
	{

		// Variables
		if( isset($cat['children']) )
		{

			foreach($cat['children'] as $cat)
			{

				$tree .= '<li id="cat_' . $cat['id'] . '">' . "\n";
				$tree .= '  <div>' . "\n";
				$tree .= '    <a href="{{ url:base }}category/' . $cat['slug'] . '" rel="' . $cat['id'] . '">' . $cat['title'] . '</a>' . "\n";
				$tree .= '  </div>' . "\n";

				if( isset($cat['children']) )
				{

					$tree .= '  <ul>' . "\n";
					$tree  = $this->tree_builder($cat, $tree, false);
					$tree .= '  </ul>' . "\n";
					$tree .= '</li>' . "\n";
				}

				$tree .= '</li>' . "\n";
			}

		}

		// Return or echo
		if( !$first )
		{
			return $tree;
		}	
		else
		{
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
		if( isset($cat['children']) )
		{
			foreach( $cat['children'] as $i => $child )
			{
				$this->db->where('id', str_replace('cat_', '', $child['id']));
				$this->db->update('firesale_categories', array('parent' => str_replace('cat_', '', $cat['id']), 'ordering_count' => $i));
				
				//repeat as long as there are children
				if (isset($child['children']))
				{
					$this->set_children($child);
				}
			}
		}
	}

}
