<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Orders admin controller
 *
 * @author		Jamie Holdroyd
 * @author		Chris Harvey
 * @package		FireSale\Core\Controllers
 *
 */
class Admin_orders extends Admin_Controller
{

	public $perpage = 30;
	public $section = 'orders';

	public function __construct()
	{

		parent::__construct();

		// CH: Instantiate the StdClass object to fix E_STRICT errors
		$this->data = new StdClass;
		
		// Load the models
		$this->load->library('files/files');
		$this->load->model('orders_m');
		$this->load->model('currency_m');
		$this->load->model('categories_m');
		$this->load->model('products_m');
		$this->load->model('address_m');

		// Get the stream
		$this->stream = $this->streams->streams->get_stream('firesale_orders', 'firesale_orders');

		// Add metadata
		$this->template->append_css('module::orders.css')
					   ->append_js('module::jquery.tablesort.js')
					   ->append_js('module::jquery.metadata.js')
					   ->append_js('module::jquery.tablesort.plugins.js')
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

			if( $type == 'product' )
			{

				// Get possible IDs
				$query = $this->db->select('order_id')->where('product_id', $query)->group_by('order_id')->get('firesale_orders_items')->result_array();
				$ids   = array();

				// Loop IDs
				foreach( $query AS $order )
				{
					$ids[] = $order['order_id'];
				}

				// Add to query
				$params['where'] = 'id IN ('.implode(',',$ids).') ';

			}
			else
			{
				$params['where'] = $type . '=' . $query;
			}

		}
		
		// Get entries
		$orders = $this->streams->entries->get_entries($params);
		
		// Get product count
		foreach( $orders['entries'] AS &$order )
		{
			
			// Get product count
			$order['products'] = $this->orders_m->get_product_count($order['id']);
			
			// No currency set?
			if( $order['currency'] == NULL )
			{
				$order['currency'] = $this->currency_m->get(1);
			}

			// Format prices
			$order['price_sub']   = $this->currency_m->format_string($order['price_sub'],   (object)$order['currency'], FALSE);
			$order['price_ship']  = $this->currency_m->format_string($order['price_ship'],  (object)$order['currency'], FALSE);
			$order['price_total'] = $this->currency_m->format_string($order['price_total'], (object)$order['currency'], FALSE);
		}

		// Assign variables
		$this->data->orders     = $orders['entries'];
		$this->data->pagination = $orders['pagination'];

		// Assign filtering
		$users = $this->orders_m->user_field(( $type == 'created_by' ? $query : NULL));
		$prods = $this->products_m->build_dropdown(( $type == 'product' ? $query : NULL));
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
						'return' 			=> 'admin/firesale/orders/edit/-id-',
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

			// Check for address
			if( !isset($input['shipping']) OR $input['shipping'] == NULL )
			{
				$input['shipping'] = '0';
				$_POST = $input;
			}

			// Create hash
			list($ship_hash, $bill_hash) = $this->address_m->input_hash($input);

			// Check for addresses
			$ship = $this->address_m->update_address($input['ship_to'], $input, 'ship');
			if( $ship != TRUE OR $ship <= 0 OR $input['ship_to'] != $input['bill_to'] OR $ship_hash != $bill_hash )
			{
				$bill = $this->address_m->update_address($input['bill_to'], $input, 'bill');
			}

			// Did we insert them?
			if( $ship > 0 OR $bill > 0 )
			{
				$input['ship_to'] = $ship;
				$input['bill_to'] = ( isset($bill) ? $bill : $ship );
				$_POST = $input;
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

		// Get currency
		$this->data->currency = $this->currency_m->get(( $id != NULL && $row->currency != NULL ? $row->currency : 1 ));

		// Get products
		if( $id != NULL )
		{

			// Get and format products
			$products = $this->orders_m->order_products($id);
			foreach( $products['products'] AS &$product )
			{
				$price            = $product['price'];
				$product['price'] = $this->currency_m->format_string($price, $this->data->currency, false);
				$product['total'] = $this->currency_m->format_string(( $price * $product['qty'] ), $this->data->currency, false);
			}

			// Assign products
			$this->data->products  = $products['products'];
			$this->data->prod_drop = $this->products_m->build_dropdown();
		}

		// Build the page
		$this->template->title(lang('firesale:title') . ' ' . sprintf(lang('firesale:orders:title_' . ( $id == NULL ? 'create' : 'edit' )), $id))
					   ->append_metadata("<script type=\"text/javascript\">\n  var currency = '{$this->data->currency->symbol}', tax_rate = '{$this->data->currency->cur_tax}';\n</script>")
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
			redirect('admin/firesale/orders');
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
					$this->orders_m->update_status($order, $status);
				}
			}

		}

		// Redirect
		redirect('admin/firesale/orders');
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
				$qty = ( $product['stock_status']['key'] != 6 && $qty > $product['stock'] ? $product['stock'] : $qty );
				$data = array('qty' => $qty, 'price' => $product['price'], 'total' => number_format(( $qty * $product['price']), 2));
				echo json_encode($data);
				exit();
			}
		}

		echo 'false';
		exit();
	}

	public function ajax_get_address($user, $id)
	{

		if( $this->input->is_ajax_request() )
		{
			// Get Address
			$address = $this->address_m->get_address($id, $user);
			echo json_encode($address);
			exit();
		}

		echo 'false';
		exit();
	}
	
}
