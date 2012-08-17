<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_orders extends Admin_Controller
{

	public $perpage = 30;
	public $section = 'orders';

	public function __construct()
	{

		parent::__construct();
		
		// Load the models
		$this->load->model('orders_m');
		$this->load->model('categories_m');
		$this->load->model('products_m');
		$this->load->model('address_m');

		// Get the stream
		$this->stream = $this->streams->streams->get_stream('firesale_orders', 'firesale_orders');

		// Add metadata
		$this->template->append_css('module::orders.css')
					   ->append_js('module::orders.js')
					   ->append_metadata('<script type="text/javascript">' .
										 "\n  var currency = '" . $this->settings->get('currency') . "';" . 
										 "\n  var tax_rate = " . $this->settings->get('firesale_tax') . ";" .
										 "\n</script>");
	}

	public function index($type = NULL, $query = NULL, $start = 0)
	{

		// Set query paramaters
		$params	 = array(
					'stream' 	=> 'firesale_orders',
					'namespace'	=> 'firesale_orders',
					'limit'		=> $this->perpage,
					'offset'	=> $start,
					'order_by'	=> 'id',
					'sort'		=> 'desc'
				   );
		
		// Get by category if set
		if( $type != NULL AND $query != NULL )
		{
			$params['where'] = $type . '=' . $query;
		}
		
		// Get entries
		$orders = $this->streams->entries->get_entries($params);

		// Get product count
		foreach( $orders['entries'] AS $key => $order )
		{
			$orders['entries'][$key]['products'] = $this->orders_m->get_product_count($order['id']);
		}

		// Assign variables
		$this->data->orders     = $orders['entries'];
		$this->data->pagination = $orders['pagination'];

		// Assign filtering
		$users = $this->orders_m->user_field(( $type == 'created_by' ? $query : NULL));
		$prods = $this->products_m->build_dropdown();
		$this->data->filter_users = $users['input'];
		$this->data->filter_prods = form_dropdown('product', $prods, ( $type == 'product' ? $query : NULL ));
		
		// Build template
		$this->template->title(lang('firesale:title') . ' ' . lang('firesale:sections:orders'))
					   ->build('admin/orders/index', $this->data);
	}

	public function create($id = NULL, $row = NULL)
	{

		// Check for post data
		if( $this->input->post('btnAction') == 'save' )
		{
			
			// Variables
			$input 	= $this->input->post();
			$skip	= array('btnAction');
			$extra 	= array(
						'return' 			=> '/admin/firesale/orders/edit/-id-',
						'success_message'	=> lang('firesale:order_' . ( $id == NULL ? 'add' : 'edit' ) . '_success'),
						'error_message'		=> lang('firesale:order_' . ( $id == NULL ? 'add' : 'edit' ) . '_error')
					  );

			// Check for products
			if( isset($input['item']) AND !empty($input['item']) )
			{

				// Loop order items
				foreach( $input['item'] AS $product => $item )
				{
					// Remove product?
					if( $id != NULL AND isset($item['remove']) AND $item['remove'] == 1 )
					{
						$this->orders_m->remove_order_item($id, $product);
					}
					// Update quantity
					elseif( $id != NULL )
					{
						// Get product
						$product = (array)$this->products_m->get_product($product);

						// Update/add product
						$this->orders_m->insert_update_order_item($id, $product, $item['qty']);
					}
				}

			}

			// Check for addresses
			$ship = $this->address_m->update_address($input['ship_to'], $input, 'ship');
			if( $ship != TRUE OR $input['ship_to'] != $input['bill_to'] )
			{
				$this->address_m->update_address($input['bill_to'], $input, 'bill');
			}

		}
		else
		{
			$input = FALSE;
			$skip  = array();
			$extra = array();
		}
	
		// Get the stream fields
		$fields = $this->fields->build_form($this->stream, ( $id == NULL ? 'new' : 'edit' ), ( $id == NULL ? (object)$input : $row ), FALSE, FALSE, $skip, $extra);

		// Assign variables
		if( $row !== NULL ) { $this->data = $row; }
		$this->data->id		= $id;
		$this->data->fields = array(
								'general' => array('details' => $fields),
								'ship'	  => $this->address_m->get_address_form('ship', ( $row != NULL && $row->ship_to > 0 ? 'edit' : 'new' ), ( $row != NULL ? $this->address_m->get_address($row->ship_to) : NULL )),
								'bill'	  => $this->address_m->get_address_form('bill', ( $row != NULL && $row->bill_to > 0 ? 'edit' : 'new' ), ( $row != NULL ? $this->address_m->get_address($row->bill_to) : NULL ))
							  );

		// Add users as first general field
		$users = $this->orders_m->user_field(( $row != NULL ? $row->created_by : NULL ));
		array_unshift($this->data->fields['general']['details'], $users);

		// Move/format ship_to and bill_to
		$bill = end(array_splice($this->data->fields['general']['details'], 8, 1));
		$ship = end(array_splice($this->data->fields['general']['details'], 7, 1));
		array_unshift($this->data->fields['ship']['details'], $ship);
		array_unshift($this->data->fields['bill']['details'], $bill);

		// Get products
		if( $id != NULL )
		{
			$products = $this->orders_m->order_products($id);
			$this->data->products = $products['products'];
			$this->data->prod_drop = $this->products_m->build_dropdown();
		}
			
		// Build the page
		$this->template->title(lang('firesale:title') . ' ' . sprintf(lang('firesale:orders:title_' . ( $id == NULL ? 'create' : 'edit' )), $id))
					   ->build('admin/orders/create', $this->data);
	}

	public function edit($id)
	{
		// Does the user have access?
		role_or_die('firesale', 'edit_orders');
		
		// Get row
		if( $row = $this->row_m->get_row($id, $this->stream, FALSE) )
		{
			// Load form
			$this->create($id, $row);
		}
		else
		{
			$this->session->set_flashdata('error', lang('firesale:order_not_found'));
			redirect('admin/firesale/orders/create');
		}

	}

	public function delete($id = NULL)
	{

		// Delete
		if( $this->orders_m->delete_order($id) )
		{
			$this->session->set_flashdata('success', lang('firesale:orders:delete_success'));
		}
		else
		{
			$this->session->set_flashdata('error', lang('firesale:orders:delete_error'));
		}

		// Redirect?
		if( !$this->input->post('btnAction') )
		{
			redirect('/admin/firesale/orders');
		}

	}

	public function status()
	{

		// Variables
		$input = $this->input->post();

		// Check for inputs
		if( isset($input['btnAction']) AND count($input['action_to']) > 0 )
		{

			switch($input['btnAction'])
			{
				case 'paid':	   $status = '2'; break;
				case 'dispatched': $status = '3'; break;
				case 'processing': $status = '4'; break;
				case 'refunded':   $status = '5'; break;
				case 'cancelled':  $status = '6'; break;
				default:		   $status = '1'; break;
			}

			foreach( $input['action_to'] AS $order )
			{
				if( $input['btnAction'] == 'delete' )
				{
					$this->delete($order);
				}
				else
				{
					$this->db->where('id', $order)->update('firesale_orders', array('order_status' => $status));
				}
			}

		}

		// Redirect
		redirect('/admin/firesale/orders');
	}

	public function ajax_add_product($order, $id, $qty)
	{
		if( $this->input->is_ajax_request() )
		{
			// Get product
			$product = (array)$this->products_m->get_product($id);

			// Insert/Update item
			if( $this->orders_m->insert_update_order_item($order, $product, $qty) )
			{
				// Update price
				$this->orders_m->update_order_cost($order, TRUE, FALSE);

				// Return to the browser
				$qty = ( $qty > $product['stock'] ? $product['stock'] : $qty );
				$data = array('qty' => $qty, 'price' => $product['price'], 'total' => number_format(( $qty * $product['price']), 2));
				echo json_encode($data);
				exit();
			}
			else
			{
				echo 'false';
				exit();
			}
		}
	}

	public function ajax_get_address($user, $id)
	{
		/*if( $this->input->is_ajax_request() )
		{*/
			// Get Address
			$address = $this->address_m->get_address($id, $user);
			echo json_encode($address);
			exit();
		/*}

		echo 'false';
		exit();*/
	}
	
}
