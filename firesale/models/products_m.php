<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Products_m extends MY_Model {
	
	protected $_table = 'firesale_products';
	public $_stockstatus = array(
							1 => 'firesale:label_stock_in',
							2 => 'firesale:label_stock_low',
							3 => 'firesale:label_stock_out',
							4 => 'firesale:label_stock_order',
							5 => 'firesale:label_stock_ended'
						   );
	
    public function __construct()
    {
        parent::__construct();
    }
	
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
	
	public function get_product_by_id($id)
	{
		// Is a product ID or product code being passed?
		if (is_numeric($id))
		{
			// An ID
			$this->db->where('firesale_products.id', $id);
		}
		else
		{
			// Slug
			$this->db->where('firesale_products.slug', $id);
		}
		
		$result = $this->db->select('firesale_products.*, firesale_categories.title AS `category_name`')
						   ->join('firesale_categories', 'firesale_products.category = firesale_categories.id')
						   ->order_by('id', 'asc')
						   ->limit('1')
						   ->get('firesale_products');
		
		if($result->num_rows())
		{
			$product = $result->row();
		}
		else
		{
			return FALSE;
		}
		
		$data 			= $product;
		$data->cat_id 	= $product->category;
		$data->category = $product->category_name;
		$data->status	= ( $product->status == '1' ? lang('firesale:label_live') : lang('firesale:label_draft') );
		
		return $data;
	}
	
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
	
	public function delete_product($id)
	{
	
		$product = $this->get_product_by_id($id);

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
	
	public function get_file_folder_by_slug($slug)
	{

		$result = $this->db->where("slug = '{$slug}'")->get('file_folders');

		if( $result->num_rows() )
		{
			$parent = $result->row();
			return $parent;
		}
		
		return FALSE;
	}
	
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
