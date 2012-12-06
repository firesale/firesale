<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Products admin controller
 *
 * @author		Jamie Holdroyd
 * @author		Chris Harvey
 * @package		FireSale\Core\Controllers
 *
 */
class Admin_products extends Admin_Controller
{

	public $stream  = NULL;
	public $perpage = 30;
	public $section = 'products';
	public $tabs	= array('description' => array('description'),
							'_modifiers'  => array(),
							'_images'	  => array());

	public function __construct()
	{

		parent::__construct();

		// Load libraries, drivers & models
		$this->load->driver('Streams');
		$this->load->model(array(
			'routes_m',
			'products_m',
			'modifier_m',
			'categories_m',
			'taxes_m',
			'streams_core/row_m'
		));

		$this->load->library('streams_core/fields');
		$this->load->library('files/files');
		$this->load->helper('general');

		// Add data object
		$this->data = new stdClass;

		// Add metadata
		$this->template->append_css('module::products.css')
					   ->append_js('module::jquery.tablesort.js')
					   ->append_js('module::jquery.metadata.js')
					   ->append_js('module::jquery.tablesort.plugins.js')
					   ->append_js('module::upload.js')
					   ->append_js('module::products.js')
					   ->append_metadata('<script type="text/javascript">' .
										 "\n  var currency = '" . $this->currency_m->get_symbol() . "';" . 
										 "\n  var tax_rate = '" . $this->taxes_m->get_percentage(1, 1) . "';" .
										 "\n</script>");
	
		// Get the stream
		$this->stream = $this->streams->streams->get_stream('firesale_products', 'firesale_products');

	}

	public function index($type = 'na', $value = 'na', $start = 0)
	{

		// Check for btnAction
		if( $action = $this->input->post('btnAction') )
		{
			$this->$action();
		}

		// Get filter if set
		if( $type != 'na' AND $value != 'na' )
		{
			$filter   = array($type => $value);
			$products = $this->products_m->get_products($filter, $start, $this->perpage);
			$this->data->$type = $value;
		}
		else
		{
			$products = $this->products_m->get_products(array(), $start, $this->perpage);
		}

		// Build product data
		foreach( $products AS &$product )
		{
			$product = $this->products_m->get_product($product['id'], 1);
		}
			
		// Assign variables
		$this->data->products 	  = $products;
		$this->data->count        = $this->products_m->get_products(( isset($filter) ? $filter : array() ), 0, 0);
		$this->data->count		  = ( $this->data->count ? count($this->data->count) : 0 );
		$this->data->pagination   = create_pagination('/admin/firesale/products/' . ( $type != 'na' ? $type : 'na' ) . '/' . ( $value != 'na' ? $value : 'na' ) . '/', $this->data->count, $this->perpage, 6);
		$this->data->categories   = array('-1' => lang('firesale:label_filtersel')) + $this->categories_m->dropdown_values();
		$this->data->status       = $this->products_m->status_dropdown(( $type == 'status' ? $value : -1 ));
		$this->data->stock_status = $this->products_m->stock_status_dropdown(( $type == 'stock_status' ? $value : -1 ));
		$this->data->min_max      = $this->products_m->price_min_max();

		// Ajax request?
		if( $this->input->is_ajax_request() )
		{
			echo json_encode($this->data->products);
			exit();
		}
		else
		{
			// Add page data
			$this->template->title(lang('firesale:title') . ' ' . lang('firesale:sections:products'))
						   ->set($this->data);

			// Fire events
			Events::trigger('page_build', $this->template);

			// Build page
			$this->template->build('admin/products/index');
		}

	}
	
	public function create($id = NULL, $row = NULL)
	{

		// Variables
		$input = FALSE;
		$skip  = array();
		$extra = array();

		// Check for post data
		if( substr($this->input->post('btnAction'), 0, 4) == 'save' )
		{
			
			// Variables
			$input 	= $this->input->post();
			$skip	= array('btnAction');
			$extra 	= array(
						'return'          => FALSE,
						'success_message' => lang('firesale:prod_' . ( $id == NULL ? 'add' : 'edit' ) . '_success'),
						'error_message'   => lang('firesale:prod_' . ( $id == NULL ? 'add' : 'edit' ) . '_error')
					  );

			// Clear out current categories to prevent duplicate db entries
			// Will fix this in multiple itself
			if( $id !== NULL )
			{
				$input['category'] = $_POST['category'] = $this->products_m->category_fix($id, $input['category']);
			}
		
		}
	
		// Get the stream fields
		$fields = $this->fields->build_form($this->stream, ( $id == NULL ? 'new' : 'edit' ), ( $id == NULL ? $input : $row ), FALSE, FALSE, $skip, $extra);

		// Posted
		if( substr($this->input->post('btnAction'), 0, 4) == 'save' )
		{

			// Got an ID back
			if( is_numeric($fields) AND ! empty($row) )
			{
				// Assign ID
				$id = $fields;

				// Update image folder?
				if( $row->slug != $input['slug'] )
				{
					$this->products_m->update_folder_slug($row->slug, $input['slug']);
				}

				// Fire event
				$data = array_merge(array('id' => $id, 'stream' => 'firesale_products'), $input);
				Events::trigger('product_updated', $data);
			}

			// Redirect
			if( $input['btnAction'] == 'save_exit' AND ! is_object($fields) )
			{
				redirect('admin/firesale/products');
			}
			else if( is_string($fields) OR is_integer($fields) )
			{
				redirect('admin/firesale/products/edit/'.$fields);
			}

		}

		// Fire build event
		Events::trigger('form_build', $this);
		
		// Get edit variables
		if( $row )
		{

			// Add row
			$this->data = $row;

			// Get modifiers and variants
			$this->data->modifiers  = $this->modifier_m->get_modifiers($row->id);
			$this->data->variations = $this->modifier_m->get_products($row->id);

			// Get images
			$folder = $this->products_m->get_file_folder_by_slug($row->slug);
			$images = Files::folder_contents($folder->id);
			$this->data->images = $images['data']['file'];
		}

		// Assign variables
		$this->data->id		= $id;
		$this->data->fields = fields_to_tabs($fields, $this->tabs);
		$this->data->tabs	= array_keys($this->data->fields);
		$this->data->symbol = $this->currency_m->get_symbol();
		
		// Add metadata
		$this->template->append_js('module::jquery.filedrop.js')
					   ->append_js('module::upload.js')
					   ->append_metadata($this->load->view('fragments/wysiwyg', NULL, TRUE));

		// Grab all the taxes
		$taxes = $this->taxes_m->taxes_for_currency(1);

		$tax_string = '<script type="text/javascript">' .
					  "\n var taxes = new Array();\n";

		foreach ($taxes as $tax)
			$tax_string .= "taxes[" . $tax->id . "] = " . $tax->value . ";\n";

		$tax_string .= '</script>';

		$this->template->append_metadata($tax_string);
	
		// Add page data
		$this->template->title(lang('firesale:title') . ' ' . lang('firesale:prod_title_' . ( $id == NULL ? 'create' : 'edit' )))
					   ->set($this->data)
					   ->enable_parser(true);

		// Fire events
		Events::trigger('page_build', $this->template);

		// Build page
		$this->template->build('admin/products/create');

	}
	
	public function edit($id)
	{
		
		// Get row
		if( $row = $this->row_m->get_row($id, $this->stream, FALSE) )
		{
			// Load form
			$this->create($id, $row);
		}
		else
		{
			$this->session->set_flashdata('error', lang('firesale:prod_not_found'));
			redirect('admin/firesale/products/create');
		}

	}
	
	public function delete($prod_id = null)
	{
	
		$delete   = true;
		$products = $this->input->post('action_to');

		if( $this->input->post('btnAction') == 'delete' )
		{
		
			for( $i = 0; $i < count($products); $i++ )
			{
			
				if( !$this->products_m->delete_product($products[$i]) )
				{
					$delete = false;
				}
			
			}
		
		}
		else if( $prod_id !== null )
		{
		
			if( !$this->products_m->delete_product($prod_id) )
			{
				$delete = false;
			}
		
		}
		
		if( $delete )
		{
			$this->session->set_flashdata('success', lang('firesale:prod_delete_success'));
		}
		else
		{
			$this->session->set_flashdata('error', lang('firesale:prod_delete_error'));
		}
		
		redirect('admin/firesale/products');
		
	}

	public function modifier($parent, $id = NULL)
	{

		// Variables
		$input  = FALSE;
		$skip   = array();
		$extra  = array();
		$stream = $this->streams->streams->get_stream('firesale_product_modifiers', 'firesale_product_modifiers');

		// Check for post data
		if( $this->input->post('btnAction') == 'save' )
		{

			// Update variables
			$input 	= $this->input->post();
			$skip	= array('btnAction');
			$extra 	= array(
						'return'          => FALSE,
						'success_message' => lang('firesale:mods:'.( $id == null ? 'create' : 'edit' ).'_success'),
						'error_message'   => lang('firesale:mods:'.( $id == null ? 'create' : 'edit' ).'_error')
					  );

			// Add parent to post
			$input['parent'] = $_POST['parent'] = $parent;

		}

		// Check for ID
		if( $id != NULL )
		{
			// Get current row
			$row = $this->row_m->get_row($id, $stream, FALSE);

			// Update parent in post
			$input['parent'] = $_POST['parent'] = $row->parent;
		}
	
		// Get the stream fields
		$fields = $this->fields->build_form($stream, ( $id == NULL ? 'new' : 'edit' ), ( $id == NULL ? $input : $row ), FALSE, FALSE, $skip, $extra);		

		// Check for success
		if( is_string($fields) OR is_integer($fields) )
		{
			redirect('admin/firesale/products/edit/'.$parent.'#modifiers');
		}

		// Assign variables
		unset($fields[3]);
		$this->data->fields = $fields;
		$this->data->parent = $parent;

		// Add page data
		$this->template->set_layout(false)
					   ->set($this->data)
					   ->build('admin/products/modifier');

	}

	public function variation($parent, $id = NULL)
	{

		// Variables
		$input  = FALSE;
		$skip   = array();
		$extra  = array();
		$stream = $this->streams->streams->get_stream('firesale_product_variations', 'firesale_product_variations');
		$parent = $this->db->where('id', $parent)->get('firesale_product_modifiers')->row();

		// Check for post data
		if( $this->input->post('btnAction') == 'save' )
		{

			// Update variables
			$input 	= $this->input->post();
			$skip	= array('btnAction');
			$extra 	= array(
						'return'          => FALSE,
						'success_message' => lang('firesale:vars:'.( $id == null ? 'create' : 'edit' ).'_success'),
						'error_message'   => lang('firesale:vars:'.( $id == null ? 'create' : 'edit' ).'_error')
					  );

			// Add parent to post
			$input['parent'] = $_POST['parent'] = $parent->id;

		}
		else if( $id != null and $this->input->post('btnAction') == 'delete' )
		{

			// Delete
			if( $this->modifier_m->delete_variation($id) )
			{
				$this->session->set_flashdata('success', lang('firesale:vars:delete_success'));
			}
			else
			{
				$this->session->set_flashdata('error', lang('firesale:vars:delete_success'));
			}

			// Send back to edit
			redirect('admin/firesale/products/edit/'.$parent->parent.'#modifiers');
		}
		
		// Check for ID
		if( $id != NULL )
		{
			// Get current row
			$row = $this->row_m->get_row($id, $stream, FALSE);

			// Update parent in post
			$input['parent'] = $_POST['parent'] = $row->parent;
		}

		// Get the stream fields
		$fields = $this->fields->build_form($stream, ( $id == NULL ? 'new' : 'edit' ), ( $id == NULL ? $input : $row ), FALSE, FALSE, $skip, $extra);		

		// Check for success
		if( is_string($fields) OR is_integer($fields) )
		{

			// If we're in creation mode
			if( $id == NULL and $parent->type == '1' )
			{
				// Check for variant type
				$this->modifier_m->build_variations($parent->parent, $stream);
			}
			else if( $id != NULL )
			{
				// Update the products for this option
				$this->modifier_m->edit_variations($row, $input);
			}
			
			// Send back to edit
			redirect('admin/firesale/products/edit/'.$parent->parent.'#modifiers');
		}

		// Assign variables
		unset($fields[2]);
		$this->data->id     = $id;
		$this->data->fields = $fields;
		$this->data->parent = $parent;

		// Add page data
		$this->template->set_layout(false)
					   ->set($this->data)
					   ->build('admin/products/variation');

	}

	public function duplicate($prod_id = 0 )
	{

		$duplicate = true;
		$products  = $this->input->post('action_to');
		$latest    = 0;

		if( $this->input->post('btnAction') == 'duplicate' )
		{
		
			for( $i = 0; $i < count($products); $i++ )
			{
			
				if( !$latest = $this->products_m->duplicate_product($products[$i]) )
				{
					$duplicate = false;
				}
			
			}
		
		}
		else if( $prod_id !== null )
		{
		
			if( !$latest = $this->products_m->duplicate_product($prod_id) )
			{
				$duplicate = false;
			}
		
		}
		
		if( $duplicate )
		{
			$this->session->set_flashdata('success', lang('firesale:prod_duplicate_success'));
		}
		else
		{
			$this->session->set_flashdata('error', lang('firesale:prod_duplicate_error'));
		}

		if( ( $prod_id !== NULL OR count($products) == 1 ) AND $latest != 0 )
		{
			redirect('admin/firesale/products/edit/' . $latest);
		}
		else
		{
			redirect('admin/firesale/products');
		}

	}
	
	public function upload($id)
	{
	
		// Get product
		$row    = $this->row_m->get_row($id, $this->stream, FALSE);
		$folder = $this->products_m->get_file_folder_by_slug($row->slug);
		$allow  = array('jpeg', 'jpg', 'png', 'gif', 'bmp');

		// Create folder?
		if( !$folder )
		{
			$parent = $this->products_m->get_file_folder_by_slug('product-images');
			$folder = $this->products_m->create_file_folder($parent->id, $row->title, $row->slug);
			$folder = (object)$folder['data'];
		}

		// Check for folder
		if( is_object($folder) AND ! empty($folder) )
		{

			// Upload it
			$status = Files::upload($folder->id);

			// Make square?
			if( $status['status'] == TRUE AND $this->settings->get('image_square') == 1 )
			{
				$this->products_m->make_square($status, $allow);
			}

			// Ajax status
			echo json_encode(array('status' => $status['status'], 'message' => $status['message']));
			exit;
		}

		// Seems it was unsuccessful
		echo json_encode(array('status' => FALSE, 'message' => 'Error uploading image'));
		exit();
	}

	public function delete_image($id)
	{

		// Delete file
		if( Files::delete_file($id) )
		{
			// Success
			$this->session->set_flashdata('success', lang('firesale:prod_delimg_success'));
		}
		else
		{
			// Error
			$this->session->set_flashdata('error', lang('firesale:prod_delimg_error'));
		}

		// Redirect
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	public function ajax_quick_edit()
	{
		
		if( $this->input->is_ajax_request() )
		{

			$update = $this->products_m->update_product($this->input->post(), $this->stream->id, true);
	
			if( isset($update) && $update == TRUE )
			{
				$this->session->set_flashdata('success', lang('firesale:prod_edit_success'));
				echo 'ok';
				exit();
			}
			else
			{
				echo lang('firesale:prod_edit_error');
				exit();
			}

		}

	}

	public function ajax_product($id)
	{
		if( $this->input->is_ajax_request() )
		{
			echo json_encode($this->products_m->get_product($id));
			exit();
		}
	}

	public function ajax_order_images()
	{

		if( $this->input->is_ajax_request() )
		{

			$order = $this->input->post('order');

			if( strlen($order) > 0 )
			{
				$order = explode(',', $order);
				for( $i = 0; $i < count($order); $i++ )
				{
					$this->db->where('id', $order[$i])->update('files', array('sort' => $i));
				}
				echo 'ok';
				exit();
			}

		}

		echo 'error';
		exit();
	}

	public function ajax_order_modifiers($table = 'firesale_product_modifiers', $replace = 'mod_')
	{

		if( $this->input->is_ajax_request() )
		{

			$order = $this->input->post('order');

			if( strlen($order) > 0 )
			{
				$order = explode(',', $order);
				for( $i = 0; $i < count($order); $i++ )
				{
					if( strlen($order[$i]) > 0 )
					{
						$id = str_replace($replace, '', $order[$i]);
						$this->db->where('id', $id)->update($table, array('ordering_count' => $i));
					}
				}
				echo 'ok';
				exit();
			}

		}

		echo 'error';
		exit();
	}

	public function ajax_order_variations()
	{
		$this->ajax_order_modifiers('firesale_product_variations', 'var_');
	}

	public function ajax_filter()
	{
		if( $this->input->is_ajax_request() )
		{
			echo json_encode($this->products_m->get_product($id));
			exit();
		}
	}

	public function _remap($method, $args)
	{

		// Capture
		$remap = array('search', 'price');

		// Check for search
		if( in_array($method, $remap) )
		{
			call_user_func_array(array($this, 'index'), array_merge(array($method), $args));
		}
		else
		{
			call_user_func_array(array($this, $method), $args);
		}

	}
	
}
