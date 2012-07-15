<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Categories_m extends MY_Model {

    public $_table = 'firesale_categories';
	
	function __construct()
    {
        parent::__construct();
    }

    public function get_children($parent)
    {

    	$query = $this->db->select('id')->where('parent', $parent)->get($this->_table);

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

    	return array();
    }

    public function total_products($category)
    {

    	$query = $this->db->select('id');

    	if( $category['parent'] == 0 )
		{
			$cat_ids = $this->get_children($category['id']);
			$query->where_in('category', $cat_ids);
		}
		else
		{
			$query->where('category', $category['id']);
		}

		$result = $query->where('status', '1')->get('firesale_products');

    	return $result->num_rows();
    }
	
	public function get_category_by_id($id)
	{
	
		$cat = $this->db->where("id = '{$id}'")->get($this->_table)->result_array();
		return $cat;
	}
	
	public function get_category_by_slug($slug)
	{

		$query = $this->db->where("slug = '{$slug}'")->get($this->_table);
		
		if( $query->num_rows() )
		{
			$category = $query->result_array();
			return $category[0];
		}
		
		return FALSE;
	}

	public function build_dropdown()
	{
	
		$_cats = $this->db->select('id, slug, title')->order_by('title')->get($this->_table)->result_array();
		$cats  = array();
		
		foreach( $_cats AS $cat )
		{
			$cats[$cat['id']] = $cat['title'];
		}
	
		return $cats;
	}
	
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
	
	public function delete($cat_id)
	{
	
		if( $cat_id != 1 ) {
			$this->db->update('firesale_categories', array('parent' => 1), 'parent = ' . ( 0 + $cat_id ));
			return $this->db->delete('firesale_categories', array('id' => ( 0 + $cat_id )));
		}
		else
		{
			return FALSE;
		}

	}
	
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
