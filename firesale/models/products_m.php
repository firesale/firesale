<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Products_m extends MY_Model {
	
	/**
	 * Contains the current database table name
	 *
	 * @var string
	 * @access public
	 */
	public $_table = 'firesale_products';

	/**
	 * Contains an array of the possible stock status options
	 *
	 * @var array
	 * @access public
	 */
	public $_stockstatus = array(
							1 => 'firesale:label_stock_in',
							2 => 'firesale:label_stock_low',
							3 => 'firesale:label_stock_out',
							4 => 'firesale:label_stock_order',
							5 => 'firesale:label_stock_ended'
						   );
	
	/**
	 * Loads the parent constructor and gets an
	 * instance of CI.
	 *
	 * @return void
	 * @access public
	 */
	function __construct()
    {
        parent::__construct();
    }
	
	/**
	 * Builds an array of the require keys and values for a dropdown of products,
	 * the array is built with the following structure:
	 *
	 *    Product ID => Product Title
	 *
	 * Note: this function doesn't actually build the dropdown, just the array...
	 * misleading title huh?
	 *
	 * @return array An array in the above format, sorry still no dropdown
	 * @access public
	 */
	public function build_dropdown()
	{
	
		$_products = $this->db->select('id, slug, title')->order_by('title')->get($this->_table)->result_array();
		$products  = array();
		
		foreach( $_products AS $product )
		{
			$products[$product['id']] = $product['title'];
		}
	
		return $products;	
	}
	
	/**
	 * Splits Streams fileds into an array of tabs, specified fields in a tabs array
	 * will be put into their designated positions with all others failling into a
	 * default "general options" array.
	 *
	 * @param array $fields A Streams generated array of fields
	 * @param array $tabs A guide containing the tab name and an array of field names
	 * @return array
	 * @access public
	 */
	public function fields_to_tabs($fields, $tabs)
	{
	
		// Variables
		$data = array('general options' => array());

		// Loop fields
		foreach( $fields AS $field )
		{
	
			// Reset found
			$found = FALSE;
	
			// Loop each of the tab options
			foreach( $tabs AS $tab => $slugs )
			{
			
				// Assign to special tab
				if( in_array($field['input_slug'], $slugs) )
				{
					if( !array_key_exists($tab, $data) ) { $data[$tab] = array(); }
					$data[$tab][] = $field;
					$found = TRUE;
				}

			}
			
			// Default to general
			if( $found == FALSE )
			{
				$data['general options'][] = $field;
			}

		}
		
		// Retrun
		return $data;	
	}
	
	/**
	 * Using Streams and a number of other functions to gather categories and images
	 * this function builds a complete Product array for use in a number of places
	 * and pages for display.
	 *
	 * @param integer or string $id_slug The ID or Slug of a Product to query
	 * @return array A complete product array or FALSE on nothing found
	 * @access public
	 */
	public function get_product($id_slug)
	{

		// Set params
		$params	 = array(
					'stream' 	=> 'firesale_products',
					'namespace'	=> 'firesale_products',
					'where'		=> ( is_numeric($id_slug) ? 'id = ' : 'slug = ' ) . "'{$id_slug}' AND status = 1",
					'limit'		=> '1',
					'order_by'	=> 'id',
					'sort'		=> 'asc'
				   );
		
		// Get entries		
		$product = $this->streams->entries->get_entries($params);

		// Check exists
		if( $product['total'] > 0 )
		{

			// Get and format product data
			$product 			 = current($product['entries']);
			$product['category'] = $this->get_categories($product['id']);
			$product['image']    = $this->get_single_image($product['id']);

			// Return
			return $product;
		}
		
		// Nothing?
		return FALSE;
	}

	/**
	 * Gets a list of product IDs to match the current query paramaters.
	 *
	 * @param array $filter A series of fields and values to filter results on
	 * @param integer $start (Optional)
	 * @param integer $limit (Optional)
	 * @return array An array of product IDs, FALSE on nothing found
	 * @access public
	 */
	public function get_products($filter, $start = 0, $limit = 0)
	{

		// Build initial query
		$query = $this->db->select($this->_table . '.id')
						  ->from($this->_table)
						  ->order_by('id', 'desc');
		
		// Add limits if set
		if( $start > 0 OR $limit > 0 )
		{
			$query->limit($limit, $start);
		}

		// Add filtering
		foreach( $filter AS $key => $value )
		{
			if( $key == 'category' )
			{
				$query->join('firesale_products_firesale_categories', 'firesale_products.id = firesale_products_firesale_categories.row_id', 'inner')
					  ->where('firesale_categories_id', $value);
			}
			else
			{
				$query->where($key, $value);
			}
		}

		// Run query
		$results = $query->get();

		// Check results
		if( $results->num_rows() )
		{
			return $results->result_array();
		}

		// Nothing?
		return FALSE;
	}
	
	/**
	 * Update the most basic elements of a product, used via the inline product
	 * edit feature of the administration section of products.
	 *
	 * @param array $input An array of the POST vars
	 * @return boolean TRUE or FALSE on success of failure
	 * @access public
	 */
	public function update_product($input)
	{
	
		// Variables
		$id   = $input['action_to'][0];
		$data = array(
					'code'	   => $input['id'],
					'title'	   => $input['title'],
					'stock'	   => $input['stock'],
					'category' => $input['parent'],
					'price'	   => $input['price']
				);
		
		// Update stock status
		if( $data['stock'] == 0 ) { $data['stock_status'] = 0; }
		
		// Update
		if( $this->db->where('id', $id)->update($this->_table, $data) )
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	
	}
	
	/**
	 * Deletes a product, the images and Files folder related to it.
	 *
	 * @param integer $id The Product ID to delete
	 * @return boolean TRUE or FALSE on success of failure
	 * @access public
	 */
	public function delete_product($id)
	{
	
		$product = $this->get_product($id);

		if( $this->db->delete('firesale_products', array('id' => $id)) )
		{
			
			// Remove files folder
			if( $product !== FALSE )
			{
				$folder = $this->get_file_folder_by_slug($product->slug);
				if( $folder != FALSE ) {
					$images = Files::folder_contents($folder->id);
					$images = $images['data']['file'];
					foreach( $images AS $image )
					{
						Files::delete_file($image->id);
					}
					Files::delete_folder($folder->id);
				}
			}

			return TRUE;
	
		}
		else
		{
			return FALSE;
		}
	
	}

	/**
	 * Deletes all products using the delete_product method, used during the
	 * uninstall process to ensure all products and their images are deleted.
	 *
	 * @return boolean TRUE or FALSE depending on status
	 * @access public
	 */	
	public function delete_all_products()
	{
	
		$products = $this->db->select('id, slug')->get($this->_table)->result_array();

		if( count($products) > 0 )
		{
		
			foreach( $products AS $product )
			{
				$this->delete_product($product['id'], $product['slug']);
			}

			return TRUE;
		}
		
		return FALSE;	
	}

	/**
	 * Updates the mulitple categories for a Product.
	 * Required at the moment since the Streams Multiple field type doesn't seem
	 * to do this automatically at the moment.
	 *
	 * @param integer $product_id The Product ID to update
	 * @param integer $stream_id The Stream ID of the products tables
	 * @param string $categories The Categories to add to the product
	 * @return void
	 * @access public
	 */
	public function update_categories($product_id, $stream_id, $categories)
	{

		// Drop current categories
		$this->db->where('row_id', $product_id)->delete('firesale_products_firesale_categories');

		// Get array of new categories
		$categories = str_replace('category_', '', $categories);
		$categories = explode(',', $categories);

		// Loop and insert
		for( $i = 0; $i < count($categories); $i++ )
		{
			$cat = trim($categories[$i]);
			if( strlen($cat) > 0 )
			{
				$data = array('row_id' => $product_id, 'firesale_products_id' => $stream_id, 'firesale_categories_id' => $cat);
				$this->db->insert('default_firesale_products_firesale_categories', $data);
			}
		}

	}

	/**
	 * Gets all of the Category information for a given Product ID.
	 *
	 * @param integer $id The Product ID to query
	 * @return array
	 * @access public
	 */
	public function get_categories($id)
	{

		// Build query
		$query = $this->db->select('firesale_categories_id AS id')
						  ->from('firesale_products_firesale_categories')
						  ->where('row_id', $id);

		// Run query
		$results = $query->get();

		// Check for categories
		if( $results->num_rows() )
		{

			// Get results
			$results    = $results->result_array();
			$categories = array();

			// Get categories
			foreach( $results AS $category )
			{
				$categories[] = $this->categories_m->get_category($category['id']);
			}

			// Return
			return $categories;
		}

		// Nothing?
		return array();
	}

	/**
	 * Gets the refering Category for a product where available, otherwise defaults
	 * to the primary (first) category of the product. Primarily used on the product
	 * details pages for breadcrumbs and display purposes.
	 *
	 * @param integer $product The Product ID to query
	 * @return integer The ID of a Category
	 * @access public
	 */
	public function get_category($product)
	{

		// Variables
		$id = 0;

		// Get refering category
		$ref = $_SERVER['HTTP_REFERER'];
		$ref = explode('/', $ref);

		// Did we get referred?
		if( count($product['category']) > 1 AND isset($ref[3]) AND $ref[3] == 'category' )
		{
			// Check the product categories
			foreach( $product['category'] AS $category )
			{
				if( $category['id'] == $this->session->userdata('category') )
				{
					$id = $category['id'];
					break;
				}
			}
		}

		// Nothing set?
		if( $id == 0 )
		{
			$id = $product['category'][0]['id'];
		}

		// Return
		return $id;
	}
	
	/**
	 * Builds a category path for a given category, used primarily for the building
	 * of breadcrumbs on both the product and category pages.
	 *
	 * @param integer $cat The Primary category to query
	 * @param boolean $reverse (Optional) Should the final result be reversed?
	 * @param array $cats (Protected) Used by the function when being recursive
	 * @return array
	 * @access public
	 */
	public function get_cat_path($cat, $reverse = false, $cats = array())
	{
	
		$result = $this->db->select('id, parent, slug, title')->where("id = '{$cat}'")->get('firesale_categories')->result_array();
		$first  = ( count($cats) == 0 ? true : false );
		
		if( count($result) > 0 )
		{
		
			$cats[] = $result[0];

			if( $result[0]['parent'] != 0 )
			{
				$cats = $this->get_cat_path($result[0]['parent'], $reverse, $cats);
			}
			
		}

		if( $first == true AND $reverse == true )
		{
			$cats = array_reverse($cats);	
		}
		
		return $cats;	
	}

	/**
	 * Gets a Files folder object based on the Product/Name slug.
	 *
	 * @param string $slug The Slug to query
	 * @return object or boolean FALSE on failure
	 * @access public
	 */
	public function get_file_folder_by_slug($slug)
	{

		$result = $this->db->where('slug', $slug)->get('file_folders');

		if( $result->num_rows() )
		{
			$parent = $result->row();
			return $parent;
		}
		
		return FALSE;
	}
	
	/**
	 * Gets the first image ID available for a product to be used with Files.
	 *
	 * @param integer $product The Product ID to query
	 * @return integer The image ID or FALSE on no image
	 * @access public
	 */
	public function get_single_image($product)
	{
		$query = $this->db->select('files.id')
						  ->join('file_folders', 'firesale_products.slug = file_folders.slug', 'left')
						  ->join('files', 'file_folders.id = files.folder_id', 'left')
						  ->where('firesale_products.id', $product)
						  ->or_where('code', $product)
						  ->get('firesale_products', 1);
		
		if ($query->num_rows())
			return $query->row()->id;
		
		return FALSE;
	}

	/**
	 * When uploading a new image for a product, based on the settings defined
	 * in the admin section we can make the image square. This is a requirement
	 * for many designs to keep things consistent and the same height/width
	 * throughtout.
	 *
	 * @param array $status A status array from the files upload process
	 * @return boolean TRUE or FALSE based on the status of the resize
	 * @access public
	 */
	public function make_square($status)
	{

		// Variables
		$bg   = array(255, 255, 255);
		$id   = $status['data']['id'];
		$w    = $status['data']['width'];
		$h	  = $status['data']['height'];
		$mime = str_replace('image/', '', $status['data']['mimetype']);
		$path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . SITE_REF . '/files/' . $status['data']['filename'];

		if( $this->settings->get('image_square') == '1' )
		{
	
			if( $w != $h )
			{
		
				// Settings
				$size = ( $w > $h ? $w : $h );
				$img  = imagecreatetruecolor($size, $size);
				$bg   = imagecolorallocate($img, $bg[0], $bg[1], $bg[2]);
				$copy = 'imagecreatefrom' . $mime;
				$save = 'image' . $mime;
				$orig = $copy($path);
				$x 	  = ( $w != $size ? round( ( $size - $w ) / 2 ) : 0 );
				$y 	  = ( $h != $size ? round( ( $size - $h ) / 2 ) : 0 );
			
				// Build image
				imagefilledrectangle($img, 0, 0, $size, $size, $bg);
				imagecopy($img, $orig, $x, $y, 0, 0, $w, $h);
				$save($img, $path);
				imagedestroy($orig);
				imagedestroy($img);

				// Update files table
				$this->db->where('id', $id)->update('files', array('width' => $size, 'height' => $size));
	
			}

		}
			
		return TRUE;		
	}

}
