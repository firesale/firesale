<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Firesale extends Module {
	
	public $version = '1.1.0';
	public $language_file = 'firesale/firesale';
	
	public function __construct()
	{
		parent::__construct();
		
		// Load in the FireSale library
		$this->load->library('firesale/firesale');
	}

	public function information()
	{

		$info = array(
			'name' => array(
				'en' => 'FireSale',
				'it' => 'FireSale', 
				'fr' => 'FireSale'
			),
			'description' => array(
				'en' => 'The lightweight & extensible eCommerce platform for PyroCMS',
				'it' => 'Una leggera piattaforma eCommerce per PyroCMS',
				'fr' => 'Plateforme eCommerce pour PyroCMS'
			),
			'frontend'		=> TRUE,
			'backend'		=> TRUE,
			'firesale_core'	=> TRUE,
			'menu'	   => 'FireSale',
			'author'   => 'Jamie Holdroyd & Chris Harvey',
			'roles' => array(
				'edit_orders', 'access_routes', 'create_edit_routes', 'access_gateways', 'install_uninstall_gateways',
				'enable_disable_gateways', 'edit_gateways', 'access_currency', 'install_uninstall_currency',
				'access_taxes', 'add_edit_taxes'
			),
			'sections' => array(
				'dashboard' => array(
					'name'	=> 'firesale:sections:dashboard',
					'uri'	=> 'admin/firesale',
				),
				'categories' => array(
					'name'   => 'firesale:sections:categories',
					'uri' 	 => 'admin/firesale/categories',
					'shortcuts' => array(
						array(
						    'name' 	=> 'firesale:shortcuts:cat_create',
						    'uri'	=> 'admin/firesale/categories',
						    'class' => 'add'
						)
				    )
				),
				'products' => array(
					'name' => 'firesale:sections:products',
					'uri'  => 'admin/firesale/products',
					'shortcuts' => array(
						array(
						    'name' 	=> 'firesale:shortcuts:prod_create',
						    'uri'	=> 'admin/firesale/products/create',
						    'class' => 'add'
						)
				    )
				),
				'orders' => array(
					'name' => 'firesale:sections:orders',
					'uri'  => 'admin/firesale/orders',
					'shortcuts' => array(
						array(
						    'name' 	=> 'firesale:shortcuts:create_order',
						    'uri'	=> 'admin/firesale/orders/create',
						    'class' => 'add'
						)
				    )
				)
			),
			'elements' => array(
				'dashboard' => array(
					array(
						'slug'		=> 'product_sales',
						'title' 	=> 'firesale:elements:product_sales',
						'function' 	=> 'product_sales',
						'assets'	=> array(
							array('type' => 'css', 'file' => 'dashboard_productsales.css'),
							array('type' => 'js', 'file' => 'dashboard_productsales.js')
						)
					),
					array(
						'slug'		=> 'low_stock',
						'title'		=> 'firesale:elements:low_stock',
						'function'	=> 'low_stock',
						'assets'	=> array(
							array('type' => 'css', 'file' => 'dashboard_lowstock.css')
						)
					)
				)
			)
		);

		if (group_has_role('firesale', 'access_routes'))
		{
			$info['sections']['routes'] = array(
				'name' => 'firesale:sections:routes',
				'uri'  => 'admin/firesale/routes',
				'shortcuts' => array()
			);
		}

		if (group_has_role('firesale', 'create_edit_routes') AND isset($info['sections']['routes']))
		{
			$info['sections']['routes']['shortcuts'] = array(
				array(
					'name' 	=> 'firesale:shortcuts:create_routes',
					'uri'	=> 'admin/firesale/routes/create',
					'class' => 'add'
				),
				array(
					'name' 	=> 'firesale:shortcuts:build_routes',
					'uri'	=> 'admin/firesale/routes/rebuild',
					'class' => ''
				)
			);
		}
		
		if (group_has_role('firesale', 'access_gateways'))
		{
			$info['sections']['gateways'] = array(
				'name' => 'firesale:sections:gateways',
				'uri'  => 'admin/firesale/gateways',
				'shortcuts' => array()
			);
		}
		
		if (group_has_role('firesale', 'install_uninstall_gateways') AND isset($info['sections']['gateways']))
		{
			$info['sections']['gateways']['shortcuts'] = array(
				array(
					'name' 	=> 'firesale:shortcuts:install_gateway',
					'uri'	=> 'admin/firesale/gateways/add',
					'class' => 'add'
				)
			);
		}

		if (group_has_role('firesale', 'access_currency'))
		{
			$info['sections']['currency'] = array(
				'name' => 'firesale:sections:currency',
				'uri'  => 'admin/firesale/currency',
				'shortcuts' => array()
			);
		}

		if (group_has_role('firesale', 'access_taxes'))
		{
			$info['sections']['taxes'] = array(
				'name' => 'firesale:sections:taxes',
				'uri'  => 'admin/firesale/taxes',
				'shortcuts' => array()
			);
		}

		if (group_has_role('firesale', 'add_edit_taxes'))
		{
			$info['sections']['taxes']['shortcuts'] = array(
				array(
					'name' 	=> 'firesale:shortcuts:add_tax_band',
					'uri'	=> 'admin/firesale/taxes/create',
					'class' => 'add'
				),
				array(
					'name' 	=> 'firesale:shortcuts:assign_taxes',
					'uri'	=> 'admin/firesale/taxes/assign',
					'class' => ''
				)
			);
		}

		if (group_has_role('firesale', 'install_uninstall_currency') AND isset($info['sections']['currency']))
		{
			$info['sections']['currency']['shortcuts'] = array(
				array(
					'name' 	=> 'firesale:currency:create',
					'uri'	=> 'admin/firesale/currency/create',
					'class' => 'add'
				)
			);
		}
		
		return $info;
	}
	
	public function install()
	{

		// For 2.2 compatibility
		$redirect = (CMS_VERSION >= '2.2' ? 'addons/' : '') . 'modules';

		if (CMS_VERSION < "2.1.4")
		{
			$this->session->set_flashdata('error', lang('firesale:install:wrong_version'));
			redirect('admin/'.$redirect);
			return FALSE;
		}
		elseif ( ! is_dir(SHARED_ADDONPATH . 'field_types/multiple')
			AND ! is_dir(ADDONPATH . 'field_types/multiple')
			AND ! is_dir(APPPATH . 'modules/streams_core/field_types/multiple'))
		{
			if( ! $this->install_multiple() )
			{
				$this->session->set_flashdata('error', lang('firesale:install:missing_multiple'));
				redirect('admin/'.$redirect);
				return FALSE;
			}
			else
			{
				// Redirect so Pyro recognises the field type is installed
				redirect('admin/'.$redirect.'/install/firesale');
			}
		}
		elseif ( ! is_writable(APPPATH . 'config/routes.php') )
		{
			$this->session->set_flashdata('error', lang('firesale:install:no_route_access'));
			redirect('admin/'.$redirect);
			return FALSE;
		}

		// Load required items
		$this->load->driver('Streams');
		$this->load->language($this->language_file);
		$this->load->model('firesale/categories_m');
		$this->load->model('firesale/products_m');
		$this->load->library('files/files');
		
		################
		## CATEGORIES ##
		################
		
		// Create categories stream
		if( !$this->streams->streams->add_stream(lang('firesale:sections:categories'), 'firesale_categories', 'firesale_categories', NULL, NULL) ) return FALSE;
		
		// Get stream data
		$categories = $this->streams->streams->get_stream('firesale_categories', 'firesale_categories');
	
		// Add fields
		$fields   = array();
		$template = array('namespace' => 'firesale_categories', 'assign' => 'firesale_categories', 'type' => 'text', 'title_column' => FALSE, 'required' => TRUE, 'unique' => FALSE);
		$fields[] = array('name' => 'lang:firesale:label_parent', 'slug' => 'parent', 'type' => 'relationship', 'extra' => array('max_length' => 5, 'choose_stream' => $categories->id), 'required' => FALSE);
		$fields[] = array('name' => 'lang:firesale:label_status', 'slug' => 'status', 'type' => 'choice', 'extra' => array('choice_data' => "0 : lang:firesale:label_draft\n1 : lang:firesale:label_live", 'choice_type' => 'dropdown', 'default_value' => 0));
		$fields[] = array('name' => 'lang:firesale:label_title', 'slug' => 'title', 'type' => 'text', 'title_column' => TRUE, 'extra' => array('max_length' => 255), 'unique' => TRUE);
		$fields[] = array('name' => 'lang:firesale:label_slug', 'slug' => 'slug', 'type' => 'slug', 'extra' => array('max_length' => 255, 'slug_field' => 'title', 'space_type' => '-'), 'unique' => TRUE);
		$fields[] = array('name' => 'lang:firesale:label_description', 'slug' => 'description', 'type' => 'wysiwyg', 'extra' => array('editor_type' => 'simple'));

		// Combine
		foreach( $fields AS &$field ) { $field = array_merge($template, $field); }
	
		// Add fields to stream
		$this->streams->fields->add_fields($fields);
		
		// Change default parent value
		$this->db->query("ALTER TABLE `" . SITE_REF . "_firesale_categories` CHANGE `parent` `parent` INT( 11 ) NULL DEFAULT '0';");
		
		// Add an initial category
		$cat = array('id' => 1, 'created' => date("Y-m-d H:i:s"), 'created_by' => $this->current_user->id, 'ordering_count' => 0, 'parent' => 0, 'status' => 1, 'title' => 'Uncategorised', 'slug' => 'uncategorised', 'description' => 'This is your initial product category, which can\'t be deleted; however you can rename it if you wish.');
		$this->db->insert('firesale_categories', $cat);
	
		##############
		## PRODUCTS ##
		##############
		
		// Format stock status
		$stockstatus = '';
		foreach( $this->products_m->_stockstatus AS $key => $val ) { $stockstatus .= "{$key} : lang:{$val}\n"; }
		
		// Create products stream
		if( !$this->streams->streams->add_stream(lang('firesale:sections:products'), 'firesale_products', 'firesale_products', NULL, NULL) ) return FALSE;

		// Get stream data
		$products = $this->streams->streams->get_stream('firesale_products', 'firesale_products');
		
		// Add fields
		$fields   = array();
		$template = array('namespace' => 'firesale_products', 'assign' => 'firesale_products', 'type' => 'text', 'title_column' => FALSE, 'required' => TRUE, 'unique' => FALSE);
		$fields[] = array('name' => 'lang:firesale:label_id', 'slug' => 'code', 'extra' => array('max_length' => 64), 'unique' => TRUE);
		$fields[] = array('name' => 'lang:firesale:label_title', 'slug' => 'title', 'type' => 'text', 'title_column' => TRUE, 'extra' => array('max_length' => 255), 'unique' => TRUE);
		$fields[] = array('name' => 'lang:firesale:label_slug', 'slug' => 'slug', 'type' => 'slug', 'extra' => array('max_length' => 255, 'slug_field' => 'title', 'space_type' => '-'));
		$fields[] = array('name' => 'lang:firesale:label_category', 'slug' => 'category', 'type' => 'multiple', 'extra' => array('choose_stream' => $categories->id));
		$fields[] = array('name' => 'lang:firesale:label_rrp', 'slug' => 'rrp', 'type' => 'text', 'instructions' => 'lang:firesale:inst_rrp', 'extra' => array('max_length' => 10, 'pattern' => '^\d+(?:,\d{3})*\.\d{2}$'));
		$fields[] = array('name' => 'lang:firesale:label_rrp_tax', 'slug' => 'rrp_tax', 'type' => 'text', 'extra' => array('max_length' => 10, 'pattern' => '^\d+(?:,\d{3})*\.\d{2}$'));
		$fields[] = array('name' => 'lang:firesale:label_price', 'slug' => 'price', 'type' => 'text', 'instructions' => 'lang:firesale:inst_price', 'extra' => array('max_length' => 10, 'pattern' => '^\d+(?:,\d{3})*\.\d{2}$'));
		$fields[] = array('name' => 'lang:firesale:label_price_tax', 'slug' => 'price_tax', 'type' => 'text', 'extra' => array('max_length' => 10, 'pattern' => '^\d+(?:,\d{3})*\.\d{2}$'));
		$fields[] = array('name' => 'lang:firesale:label_status', 'slug' => 'status', 'type' => 'choice', 'extra' => array('choice_data' => "0 : lang:firesale:label_draft\n1 : lang:firesale:label_live", 'choice_type' => 'dropdown', 'default_value' => 1));
		$fields[] = array('name' => 'lang:firesale:label_stock', 'slug' => 'stock', 'type' => 'integer');
		$fields[] = array('name' => 'lang:firesale:label_stock_status', 'slug' => 'stock_status', 'type' => 'choice', 'extra' => array('choice_data' => $stockstatus, 'choice_type' => 'dropdown', 'default_value' => 1));
		$fields[] = array('name' => 'lang:firesale:label_ship_req', 'slug' => 'ship_req', 'type' => 'choice', 'extra' => array('choice_data' => "0 : lang:global:no\n1 : lang:global:yes", 'choice_type' => 'dropdown', 'default_value' => 1));
		$fields[] = array('name' => 'lang:firesale:label_description', 'slug' => 'description', 'type' => 'wysiwyg', 'extra' => array('editor_type' => 'advanced'));

		// Combine
		foreach( $fields AS &$field ) { $field = array_merge($template, $field); }
	
		// Add fields to stream
		$this->streams->fields->add_fields($fields);
		
		// Change engine and add fulltext
		$this->db->query("ALTER TABLE `" . SITE_REF . "_firesale_products` ENGINE = MyISAM,
						  ADD FULLTEXT (`title`, `description`),
						  CHANGE `rrp` `rrp` DECIMAL( 10, 2 ) DEFAULT '0.00',
						  CHANGE `rrp_tax` `rrp_tax` DECIMAL( 10, 2 ) DEFAULT '0.00',
						  CHANGE `price` `price` DECIMAL( 10, 2 ) DEFAULT '0.00',
						  CHANGE `price_tax` `price_tax` DECIMAL( 10, 2 ) DEFAULT '0.00';");


		###########
		## TAXES ##
		###########
		$this->taxes();


		######################
		## PAYMENT GATEWAYS ##
		######################

		// Create gateways stream
		if( !$this->streams->streams->add_stream(lang('firesale:sections:gateways'), 'firesale_gateways', 'firesale_gateways', NULL, NULL) ) return FALSE;

		// Get stream data
		$gateways = $this->streams->streams->get_stream('firesale_gateways', 'firesale_gateways');

		// Add fields
		$fields   = array();
		$template = array('namespace' => 'firesale_gateways', 'assign' => 'firesale_gateways', 'type' => 'text', 'title_column' => FALSE, 'required' => TRUE, 'unique' => FALSE);
		$fields[] = array('name' => 'lang:firesale:label_title', 'slug' => 'name', 'type' => 'text', 'title_column' => TRUE, 'extra' => array('max_length' => 255), 'unique' => TRUE);
		$fields[] = array('name' => 'lang:firesale:label_slug', 'slug' => 'slug', 'type' => 'slug', 'extra' => array('max_length' => 255, 'slug_field' => 'name', 'space_type' => '-'));
		$fields[] = array('name' => 'lang:firesale:label_description', 'slug' => 'desc', 'type' => 'wysiwyg', 'extra' => array('editor_type' => 'advanced'));
		$fields[] = array('name' => 'lang:firesale:label_status', 'slug' => 'enabled', 'type' => 'choice', 'extra' => array('choice_data' => "0 : lang:firesale:label_draft\n1 : lang:firesale:label_live", 'choice_type' => 'dropdown', 'default_value' => 0));

		// Combine
		foreach( $fields AS &$field ) { $field = array_merge($template, $field); }
	
		// Add fields to stream
		$this->streams->fields->add_fields($fields);
		
		// Add the gateway settings table
		$this->db->query("
			CREATE TABLE IF NOT EXISTS `".SITE_REF."_firesale_gateway_settings` (
			  `id` int(11) NOT NULL,
			  `key` varchar(64) NOT NULL,
			  `value` text NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;
		");
		
		// Load the gateways class
		$this->load->library('firesale/gateways');
		
		// Install the core gateways
		$this->gateways->install_core();

		#####################
		## ADDRESS HISTORY ##
		#####################

		// Create orders stream
		if( !$this->streams->streams->add_stream(lang('firesale:sections:addresses'), 'firesale_addresses', 'firesale_addresses', NULL, NULL) ) return FALSE;

		// Get stream data
		$addresses = $this->streams->streams->get_stream('firesale_addresses', 'firesale_addresses');

		// Add fields
		$fields   = array();
		$template = array('namespace' => 'firesale_addresses', 'assign' => 'firesale_addresses', 'type' => 'text', 'title_column' => FALSE, 'required' => TRUE, 'unique' => FALSE);
		$fields[] = array('name' => 'lang:firesale:label_title', 'slug' => 'title', 'type' => 'text', 'title_column' => TRUE, 'extra' => array('max_length' => 255), 'required' => FALSE);
		$fields[] = array('name' => 'lang:firesale:label_company', 'slug' => 'company', 'extra' => array('max_length' => 255), 'required' => FALSE);
		$fields[] = array('name' => 'lang:firesale:label_firstname', 'slug' => 'firstname', 'extra' => array('max_length' => 100));
		$fields[] = array('name' => 'lang:firesale:label_lastname', 'slug' => 'lastname', 'extra' => array('max_length' => 100));
		$fields[] = array('name' => 'lang:firesale:label_email', 'slug' => 'email', 'extra' => array('max_length' => 255));
		$fields[] = array('name' => 'lang:firesale:label_phone', 'slug' => 'phone', 'extra' => array('max_length' => 255), 'required' => FALSE);
		$fields[] = array('name' => 'lang:firesale:label_address1', 'slug' => 'address1', 'extra' => array('max_length' => 255));
		$fields[] = array('name' => 'lang:firesale:label_address2', 'slug' => 'address2', 'extra' => array('max_length' => 255), 'required' => FALSE);
		$fields[] = array('name' => 'lang:firesale:label_city', 'slug' => 'city', 'extra' => array('max_length' => 255));
		$fields[] = array('name' => 'lang:firesale:label_county', 'slug' => 'county', 'extra' => array('max_length' => 255));
		$fields[] = array('name' => 'lang:firesale:label_postcode', 'slug' => 'postcode', 'extra' => array('max_length' => 40));
		$fields[] = array('name' => 'lang:firesale:label_country', 'slug' => 'country', 'type' => 'country');

		// Combine
		foreach( $fields AS &$field ) { $field = array_merge($template, $field); }
		
		// Add fields to stream
		$this->streams->fields->add_fields($fields);
		
		##############
		## CURRENCY ##
		##############

		$this->currency('add');

		############################
		## ORDERS & ORDER HISTORY ##
		############################
		
		// Format order status options
		$orderstatus = "1 : lang:firesale:orders:status_unpaid\n" .
					   "2 : lang:firesale:orders:status_paid\n" .
					   "3 : lang:firesale:orders:status_dispatched\n" .
					   "4 : lang:firesale:orders:status_processing\n" .
					   "5 : lang:firesale:orders:status_refunded\n" .
					   "6 : lang:firesale:orders:status_cancelled";
		
		// Create orders stream
		if( !$this->streams->streams->add_stream(lang('firesale:sections:orders'), 'firesale_orders', 'firesale_orders', NULL, NULL) ) return FALSE;

		// Get stream data
		$orders   = $this->streams->streams->get_stream('firesale_orders', 'firesale_orders');
		$currency = $this->streams->streams->get_stream('firesale_currency', 'firesale_currency');
		
		// Add fields
		$fields   = array();
		$template = array('namespace' => 'firesale_orders', 'assign' => 'firesale_orders', 'type' => 'text', 'title_column' => FALSE, 'required' => TRUE, 'unique' => FALSE);
		$fields[] = array('name' => 'lang:firesale:label_ip', 'slug' => 'ip', 'type' => 'text', 'extra' => array('max_length' => 32), 'required' => FALSE);
		$fields[] = array('name' => 'lang:firesale:label_gateway', 'slug' => 'gateway', 'type' => 'relationship', 'extra' => array('max_length' => 5, 'choose_stream' => $gateways->id), 'required' => FALSE);
		$fields[] = array('name' => 'lang:firesale:label_status', 'slug' => 'order_status', 'type' => 'choice', 'extra' => array('choice_data' => $orderstatus, 'choice_type' => 'dropdown', 'default_value' => '1'));
		$fields[] = array('name' => 'lang:firesale:label_price_sub', 'slug' => 'price_sub', 'extra' => array('max_length' => 10), 'required' => FALSE);
		$fields[] = array('name' => 'lang:firesale:label_price_ship', 'slug' => 'price_ship', 'extra' => array('max_length' => 10), 'required' => FALSE);
		$fields[] = array('name' => 'lang:firesale:label_price_total', 'slug' => 'price_total', 'extra' => array('max_length' => 10), 'required' => FALSE);
		$fields[] = array('name' => 'lang:firesale:sections:currency', 'slug' => 'currency', 'type' => 'relationship', 'extra' => array('max_length' => 5, 'choose_stream' => $currency->id));
		$fields[] = array('name' => 'lang:firesale:label_exch_rate', 'slug' => 'exchange_rate', 'extra' => array('default' => 1, 'max_length' => 10));
		$fields[] = array('name' => 'lang:firesale:label_ship_to', 'slug' => 'ship_to', 'type' => 'relationship', 'extra' => array('choose_stream' => $addresses->id), 'required' => FALSE);
		$fields[] = array('name' => 'lang:firesale:label_bill_to', 'slug' => 'bill_to', 'type' => 'relationship', 'extra' => array('choose_stream' => $addresses->id), 'required' => FALSE);
		$fields[] = array('name' => 'lang:firesale:label_shipping', 'slug' => 'shipping', 'type' => 'integer', 'required' => FALSE);
	
		// Combine
		foreach( $fields AS &$field ) { $field = array_merge($template, $field); }
		
		// Add fields to stream
		$this->streams->fields->add_fields($fields);
		
		// Modify table
		$this->db->query("ALTER TABLE `" . SITE_REF . "_firesale_orders`
						  CHANGE `price_sub` `price_sub` DECIMAL( 10, 2 ) DEFAULT '0.00',
						  CHANGE `price_ship` `price_ship` DECIMAL( 10, 2 ) DEFAULT '0.00',
						  CHANGE `price_total` `price_total` DECIMAL( 10, 2 ) DEFAULT '0.00';");
		
		// Create orders items stream
		if( !$this->streams->streams->add_stream(lang('firesale:sections:orders_items'), 'firesale_orders_items', 'firesale_orders_items', NULL, NULL) ) return FALSE;
		
		// Add fields
		$fields   = array();
		$template = array('namespace' => 'firesale_orders_items', 'assign' => 'firesale_orders_items', 'type' => 'text', 'title_column' => FALSE, 'required' => TRUE, 'unique' => FALSE);
		$fields[] = array('name' => 'lang:firesale:label_order', 'slug' => 'order_id', 'type' => 'relationship', 'extra' => array('max_length' => 5, 'choose_stream' => $orders->id));
		$fields[] = array('name' => 'lang:firesale:label_product', 'slug' => 'product_id', 'type' => 'relationship', 'extra' => array('max_length' => 5, 'choose_stream' => $products->id));
		$fields[] = array('name' => 'lang:firesale:label_id', 'slug' => 'code', 'extra' => array('max_length' => 64), 'unique' => TRUE);
		$fields[] = array('name' => 'lang:firesale:label_title', 'slug' => 'name', 'type' => 'text', 'title_column' => TRUE, 'extra' => array('max_length' => 255), 'unique' => TRUE);
		$fields[] = array('name' => 'lang:firesale:label_price', 'slug' => 'price', 'type' => 'text', 'extra' => array('max_length' => 10, 'pattern' => '^\d+(?:,\d{3})*\.\d{2}$'));
		$fields[] = array('name' => 'lang:firesale:label_quantity', 'slug' => 'qty', 'type' => 'integer', 'required' => FALSE);

		// Combine
		foreach( $fields AS &$field ) { $field = array_merge($template, $field); }

		// Add fields to stream
		$this->streams->fields->add_fields($fields);

		############
		## ROUTES ##
		############

		$this->routes('add');

		##################
		## TRANSACTIONS ##
		##################

		$this->db->query("
			CREATE TABLE IF NOT EXISTS `".SITE_REF."_firesale_transactions` (
			  `txn_id` varchar(50) NOT NULL,
			  `order_id` int(11) NOT NULL,
			  `gateway` varchar(100) NOT NULL,
			  `amount` decimal(10,2) NOT NULL,
			  `message` text NOT NULL,
			  `status` varchar(100) NOT NULL,
			  PRIMARY KEY  (`txn_id`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;
		");
		
		###########
		## OTHER ##
		###########
		
		// Add settings
		$this->settings('add');

		// Add email templates
		$this->templates('add');
		
		// Create files folders
		Files::create_folder(0, 'Category Images');
		Files::create_folder(0, 'Brand Images');
		Files::create_folder(0, 'Product Images');

		// Return
		return TRUE;
	}

	public function uninstall()
	{
	
		// Load required items
		$this->load->driver('Streams');
		$this->load->model('firesale/categories_m');
		$this->load->model('firesale/products_m');
		$this->load->library('files/files');
	
		// Remove category images
		$category_folder = $this->products_m->get_file_folder_by_slug('category-images');
		if( $category_folder != FALSE )
		{

			// Get files in folder
			$files = Files::folder_contents($category_folder->id);
			foreach( $files['data']['file'] AS $file )
			{
				Files::delete_file($file->id);
			}

			// Delete folder
			Files::delete_folder($category_folder->id);
		}

		// Remove products
		if( $this->db->where('stream_namespace', 'firesale_products')->where('stream_slug', 'firesale_products')->get('data_streams')->num_rows() )
		{
			$this->products_m->delete_all_products();
		}
		
		// Remove products folder
		$product_folder = $this->products_m->get_file_folder_by_slug('product-images');
		if( $product_folder != FALSE )
		{
			Files::delete_folder($product_folder->id);
		}

		// Remove routes
		if( $this->db->where('stream_namespace', 'firesale_routes')->where('stream_slug', 'firesale_routes')->get('data_streams')->num_rows() )
		{
			$this->routes('remove');
		}

		// Remove email templates
		$this->templates('remove');
		
		// Remove settings
		$this->settings('remove');

		// Remove taxes
		$this->taxes('remove');

		// Remove currency
		$this->currency('remove');
		
		// Remove streams
		$this->streams->utilities->remove_namespace('firesale_categories');
		$this->streams->utilities->remove_namespace('firesale_products');
		$this->streams->utilities->remove_namespace('firesale_gateways');
		$this->streams->utilities->remove_namespace('firesale_addresses');
		$this->streams->utilities->remove_namespace('firesale_orders');
		$this->streams->utilities->remove_namespace('firesale_orders_items');
		
		// Drop the payment gateway tables
		$this->dbforge->drop_table('firesale_products_firesale_categories'); // Streams doesn't auto-remove it =/
		$this->dbforge->drop_table('firesale_gateway_settings');
		$this->dbforge->drop_table('firesale_order_items');
		$this->dbforge->drop_table('firesale_transactions');

		// Return
		return TRUE;
	}

	public function upgrade($old_version)
	{

		// Load requirements
		$this->load->driver('Streams');
		$this->load->model('firesale/categories_m');
		$this->load->model('firesale/products_m');
		$this->load->library('files/files');

		// Pre 1.1.0
		if( $old_version < '1.1.0' )
		{

			// Add routes
			$this->routes('add');

			// Add currency
			$this->currency('add');

			// Add settings
			$this->settings('add', array('firesale_currency_key', 'firesale_current_currency', 'firesale_currency_updated', 'image_background'));

			// Add category images folder
			Files::create_folder(0, 'Category Images');

			// Products
			$brands   = $this->streams->streams->get_stream('firesale_brands', 'firesale_brands');
			$fields   = array();
			$template = array('namespace' => 'firesale_products', 'assign' => 'firesale_products', 'type' => 'text', 'title_column' => FALSE, 'required' => TRUE, 'unique' => FALSE);
			$fields[] = array('name' => 'lang:firesale:label_brand', 'slug' => 'brands', 'type' => 'relationship', 'extra' => array('choose_stream' => $brands->id), 'required' => FALSE);
			$fields[] = array('name' => 'lang:firesale:label_ship_req', 'slug' => 'ship_req', 'type' => 'choice', 'extra' => array('choice_data' => "0 : lang:global:no\n1 : lang:global:yes", 'choice_type' => 'dropdown', 'default_value' => 1));
			foreach( $fields AS &$field ) { $field = array_merge($template, $field); }
			$this->streams->fields->add_fields($fields);

			// Orders
			$currency = $this->streams->streams->get_stream('firesale_currency', 'firesale_currency');
			$fields   = array();
			$template = array('namespace' => 'firesale_orders', 'assign' => 'firesale_orders', 'type' => 'text', 'title_column' => FALSE, 'required' => TRUE, 'unique' => FALSE);
			$fields[] = array('name' => 'lang:firesale:sections:currency', 'slug' => 'currency', 'type' => 'relationship', 'extra' => array('max_length' => 5, 'choose_stream' => $currency->id));
			$fields[] = array('name' => 'lang:firesale:label_exch_rate', 'slug' => 'exchange_rate', 'extra' => array('default' => 1, 'max_length' => 10));
			foreach( $fields AS &$field ) { $field = array_merge($template, $field); }
			$this->streams->fields->add_fields($fields);

		}

		return TRUE;
	}

	public function help()
	{

		return '<iframe src="https://www.getfiresale.org/documentation" style="width: 1100px; height: 650px; border-radius: 4px 4px 0 0"></iframe>';
	}
	
	public function settings($action, $add = array())
	{
	
		// Variables
		$return     = TRUE;
		$settings   = array();
		
		// Settings
		$settings[] = array('slug' => 'firesale_currency', 'title' => lang('firesale:settings_currency'), 'description' => lang('firesale:settings_currency_inst'), 'default' => 'GBP', 'value' => 'GBP', 'type' => 'text', 'options' => '', 'is_required' => 1, 'is_gui' => 1, 'module' => 'firesale');
		$settings[] = array('slug' => 'firesale_currency_key', 'title' => lang('firesale:settings_currency_key'), 'description' => lang('firesale:settings_currency_key_inst'), 'default' => '', 'value' => '', 'type' => 'text', 'options' => '', 'is_required' => 0, 'is_gui' => 1, 'module' => 'firesale' );
		$settings[] = array('slug' => 'firesale_current_currency', 'title' => lang('firesale:settings_current_currency'), 'description' => lang('firesale:settings_current_currency_inst'), 'default' => 'GBP', 'value' => 'GBP', 'type' => 'text', 'options' => '', 'is_required' => 0, 'is_gui' => 0, 'module' => 'firesale' );
		$settings[] = array('slug' => 'firesale_currency_updated', 'title' => lang('firesale:settings_currency_updated'), 'description' => lang('firesale:settings_currency_updated_inst'), 'default' => '', 'value' => '', 'type' => 'text', 'options' => '', 'is_required' => 0, 'is_gui' => 0, 'module' => 'firesale');
		$settings[] = array('slug' => 'firesale_perpage', 'title' => lang('firesale:settings_perpage'), 'description' => lang('firesale:settings_perpage_inst'), 'default' => '15', 'value' => '15', 'type' => 'text', 'options' => '', 'is_required' => 1, 'is_gui' => 1, 'module' => 'firesale');
		$settings[] = array('slug' => 'image_square', 'title' => lang('firesale:settings_image_square'), 'description' => lang('firesale:settings_image_square_inst'), 'default' => '0', 'value' => '0', 'type' => 'select', 'options' => '1=Yes|0=No', 'is_required' => 1, 'is_gui' => 1, 'module' => 'firesale');
		$settings[] = array('slug' => 'image_background', 'title' => lang('firesale:settings_image_background'), 'description' => lang('firesale:settings_image_background_inst'), 'default' => 'ffffff', 'value' => 'ffffff', 'type' => 'text', 'options' => '', 'is_required' => 1, 'is_gui' => 1, 'module' => 'firesale');
		$settings[] = array('slug' => 'firesale_login', 'title' => lang('firesale:settings_login'), 'description' => lang('firesale:settings_login_inst'), 'default' => '0', 'value' => '0', 'type' => 'select', 'options' => '1=Yes|0=No', 'is_required' => 1, 'is_gui' => 1, 'module' => 'firesale');

		// Perform
		foreach( $settings as $setting )
		{

			if( $action == 'add' )
			{
				if( ( !empty($add) AND in_array($setting['slug'], $add) ) OR empty($add) )
				{
					if( !$this->db->insert('settings', $setting) )
					{
						$return = FALSE;
					}
				}
			}
			else
			{
				if( !$this->db->delete('settings', array('slug' => $setting['slug'])) )
				{
					$return = FALSE;
				}
			}

		}
		
		return $return;	
	}

	public function routes($action)
	{

		// Load model
		$this->load->driver('Streams');
		$this->load->model('firesale/routes_m');
		$this->load->model('firesale/categories_m');
		$this->load->model('firesale/products_m');
		$this->load->library('files/files');

		// Install
		if( $action == 'add' )
		{

			// Create routes stream
			if( !$this->streams->streams->add_stream(lang('firesale:sections:routes'), 'firesale_routes', 'firesale_routes', NULL, NULL) ) return FALSE;

			// Add fields
			$fields   = array();
			$template = array('namespace' => 'firesale_routes', 'assign' => 'firesale_routes', 'type' => 'text', 'title_column' => FALSE, 'required' => TRUE, 'unique' => FALSE);
			$fields[] = array('name' => 'lang:firesale:label_title', 'slug' => 'title', 'type' => 'text', 'title_column' => TRUE, 'extra' => array('max_length' => 255), 'unique' => TRUE);
			$fields[] = array('name' => 'lang:firesale:label_slug', 'slug' => 'slug', 'type' => 'slug', 'extra' => array('max_length' => 255, 'slug_field' => 'title', 'space_type' => '-'), 'unique' => TRUE);
			$fields[] = array('name' => 'lang:firesale:label_table', 'slug' => 'table', 'type' => 'text', 'extra' => array('max_length' => 255), 'required' => FALSE);
			$fields[] = array('name' => 'lang:firesale:label_map', 'slug' => 'map', 'extra' => array('max_length' => 255), 'unique' => TRUE);
			$fields[] = array('name' => 'lang:firesale:label_route', 'slug' => 'route', 'extra' => array('max_length' => 255), 'unique' => TRUE);
			$fields[] = array('name' => 'lang:firesale:label_translation', 'slug' => 'translation', 'extra' => array('max_length' => 128), 'unique' => TRUE);

			// Combine
			foreach( $fields AS &$field ) { $field = array_merge($template, $field); }

			// Add fields to stream
			$this->streams->fields->add_fields($fields);

			// Add is_core
			$this->db->query("ALTER TABLE `".SITE_REF."_firesale_routes` ADD `is_core` BOOLEAN NOT NULL DEFAULT '0'");

		}

		// Routes
		$routes   = array();
		$routes[] = array('id' => '7', 'is_core' => 1, 'title' => 'Category (Customisation)', 'slug' => 'category-custom', 'table' => '', 'map' => 'category/{{ type }}/{{ slug }}', 'route' => 'category/(order|style)/([a-z0-9]+)', 'translation' => 'firesale/front_category/$1/$2');
		$routes[] = array('id' => '1', 'is_core' => 1, 'title' => 'Category', 'slug' => 'category', 'table' => 'firesale_categories', 'map' => 'category/{{ slug }}', 'route' => 'category(/[a-z0-9-]+)?', 'translation' => 'firesale/front_category/index$1');
		$routes[] = array('id' => '2', 'is_core' => 1, 'title' => 'Product', 'slug' => 'product', 'table' => 'firesale_products', 'map' => 'product/{{ slug }}', 'route' => 'product/([a-z0-9-]+)', 'translation' => 'firesale/front_product/index/$1');
		$routes[] = array('id' => '3', 'is_core' => 1, 'title' => 'Cart', 'slug' => 'cart', 'table' => '', 'map' => 'cart{{ any }}', 'route' => 'cart(/:any)?', 'translation' => 'firesale/front_cart$1');
		$routes[] = array('id' => '5', 'is_core' => 1, 'title' => 'Orders (Single)', 'slug' => 'orders-single', 'table' => 'firesale_orders', 'map' => 'users/orders/{{ id }}', 'route' => 'users/orders/([0-9]+)', 'translation' => 'firesale/front_orders/view_order/$1');
		$routes[] = array('id' => '4', 'is_core' => 1, 'title' => 'Orders', 'slug' => 'orders', 'table' => '', 'map' => 'users/orders', 'route' => 'users/orders', 'translation' => 'firesale/front_orders/index');
		$routes[] = array('id' => '6', 'is_core' => 1, 'title' => 'Addresses', 'slug' => 'addresses', 'table' => 'firesale_addresses', 'map' => 'users/addresses{{ any }}', 'route' => 'users/addresses(/:any)?', 'translation' => 'firesale/front_address$1');
		$routes[] = array('id' => '8', 'is_core' => 1, 'title' => 'Currency', 'slug' => 'currency', 'table' => 'firesale_currency', 'map' => 'currency/{{ id }}', 'route' => 'currency/([0-9]+)?', 'translation' => 'firesale/front_currency/change/$1');

		// Perform
		foreach( $routes AS $route )
		{

			// Check action
			if( $action == 'add' )
			{
				// Add
				$this->routes_m->create($route);
			}
			else if( $action == 'remove' )
			{
				// Remove
				$this->routes_m->delete($route['id']);
			}

		}

		// Remove stream
		if( $action != 'add' )
		{
			$this->streams->utilities->remove_namespace('firesale_routes');
		}

		// Return
		return TRUE;
	}

	public function currency($action)
	{

		// Load required items
		$this->load->driver('Streams');
		$this->load->model('firesale/currency_m');
		$this->load->model('firesale/categories_m');
		$this->load->model('firesale/products_m');
		$this->load->library('files/files');

		// Install
		if( $action == 'add' )
		{
			// Create currency stream
			if( !$this->streams->streams->add_stream(lang('firesale:sections:currency'), 'firesale_currency', 'firesale_currency', NULL, NULL) ) return FALSE;

			// Create currency folder
			$currency = Files::create_folder(0, 'Currency Images');

			// Format order status options
			$cur_format = "0 : lang:firesale:currency:format_none\n" .
						  "1 : lang:firesale:currency:format_00\n" .
						  "2 : lang:firesale:currency:format_50\n" .
						  "3 : lang:firesale:currency:format_99\n";

			// Add fields
			$fields   = array();
			$template = array('namespace' => 'firesale_currency', 'assign' => 'firesale_currency', 'type' => 'text', 'title_column' => FALSE, 'required' => TRUE, 'unique' => FALSE);
			$fields[] = array('name' => 'lang:firesale:label_cur_code', 'slug' => 'cur_code', 'type' => 'text', 'instructions' => 'lang:firesale:label_cur_code_inst', 'extra' => array('max_length' => 3));
			$fields[] = array('name' => 'lang:firesale:label_title', 'slug' => 'title', 'type' => 'text', 'title_column' => TRUE, 'extra' => array('max_length' => 255), 'unique' => TRUE);
			$fields[] = array('name' => 'lang:firesale:label_slug', 'slug' => 'slug', 'type' => 'slug', 'extra' => array('max_length' => 255, 'slug_field' => 'title', 'space_type' => '-'));
			$fields[] = array('name' => 'lang:firesale:label_enabled', 'slug' => 'enabled', 'type' => 'choice', 'extra' => array('choice_data' => "0 : lang:firesale:label_disabled\n1 : lang:firesale:label_enabled", 'choice_type' => 'dropdown', 'default_value' => 1));
			$fields[] = array('name' => 'lang:firesale:label_cur_tax', 'slug' => 'cur_tax', 'type' => 'text', 'extra' => array('max_length' => 10));
			$fields[] = array('name' => 'lang:firesale:label_cur_format', 'slug' => 'cur_format', 'type' => 'text', 'instructions' => 'lang:firesale:label_cur_format_inst', 'extra' => array('max_length' => 64));
			$fields[] = array('name' => 'lang:firesale:label_cur_format_dec', 'slug' => 'cur_format_dec', 'type' => 'text', 'extra' => array('max_length' => 1), 'required' => FALSE);
			$fields[] = array('name' => 'lang:firesale:label_cur_format_sep', 'slug' => 'cur_format_sep', 'type' => 'text', 'extra' => array('max_length' => 1));
			$fields[] = array('name' => 'lang:firesale:label_cur_format_num', 'slug' => 'cur_format_num', 'type' => 'choice', 'extra' => array('choice_data' => $cur_format, 'choice_type' => 'dropdown', 'default_value' => '1'));
			$fields[] = array('name' => 'lang:firesale:label_cur_mod', 'slug' => 'cur_mod', 'type' => 'text', 'instructions' => 'lang:firesale:label_cur_mod_inst', 'extra' => array('max_length' => 10));
			$fields[] = array('name' => 'lang:firesale:label_cur_flag', 'slug' => 'image', 'type' => 'image', 'extra' => array('folder' => $currency['data']['id']), 'required' => FALSE);
			$fields[] = array('name' => 'lang:firesale:label_exch_rate', 'slug' => 'exch_rate', 'type' => 'text', 'instructions' => 'lang:firesale:label_exch_rate_inst', 'extra' => array('max_length' => 10), 'required' => FALSE);
			
			// Combine
			foreach( $fields AS &$field ) { $field = array_merge($template, $field); }

			// Add fields to stream
			$this->streams->fields->add_fields($fields);

			// Add an initial currency
			$this->db->insert('firesale_currency', array(
							  	'id' => 1,
							  	'created' => date("Y-m-d H:i:s"),
							  	'created_by' => $this->current_user->id,
							  	'ordering_count' => 0,
							  	'cur_code' => 'GBP',
							  	'title' => 'Default',
							  	'slug' => 'default',
							  	'enabled' => 1,
							  	'cur_tax' => '20',
							  	'cur_format' => '£{{ price }}',
							  	'cur_format_num' => '0',
							  	'cur_format_dec' => '.',
							  	'cur_format_sep' => ',',
							  	'cur_mod' => '+|0',
							  	'exch_rate' => '1'
							));
		}
		else
		{
			// Remove currency folder
			$currency_folder = $this->products_m->get_file_folder_by_slug('currency-images');
			if( $currency_folder != FALSE )
			{

				// Get files in folder
				$files = Files::folder_contents($currency_folder->id);
				foreach( $files['data']['file'] AS $file )
				{
					Files::delete_file($file->id);
				}

				// Delete folder
				Files::delete_folder($currency_folder->id);
			}

			// Remove stream
			$this->streams->utilities->remove_namespace('firesale_currency');
		}

	}

	public function taxes($method = 'add')
	{
		if ($method == 'add')
		{
			$this->streams->streams->add_stream('lang:firesale:sections:taxes', 'firesale_taxes', 'firesale_taxes', NULL, NULL);

			// Default settings for the fields
			$default = array(
				'namespace' => 'firesale_taxes',
				'assign'    => 'firesale_taxes',
				'required'  => TRUE
			);

			$fields = array(
				array(
					'name'         => 'lang:firesale:label_title',
					'slug'         => 'title',
					'type'         => 'text',
					'extra'        => array('max_length' => 200),
					'title_column' => TRUE
				),
				array(
					'name'  => 'lang:firesale:label_description',
					'slug'  => 'description',
					'type'  => 'wysiwyg'
				),
			);

			foreach ($fields as &$field)
				$field = array_merge($default, $field);

			$this->streams->fields->add_fields($fields);

			// We also need a field in products so we can select the tax band it applies to
			$taxes = $this->streams->streams->get_stream('firesale_taxes', 'firesale_taxes');

			$field = array(
				'name' => 'lang:firesale:label_tax_band',
				'slug' => 'tax_band',
				'type' => 'relationship',
				'extra' => array(
					'choose_stream' => $taxes->id
				),
				'namespace' => 'firesale_products',
				'assign' => 'firesale_products',
				'required' => TRUE
			);

			$this->streams->fields->add_field($field);

			// Lets create the assignments table
			$this->db->query('
				CREATE TABLE `'.$this->db->dbprefix('firesale_taxes_assignments').'` (
				  `tax_id` int(11) NOT NULL,
				  `currency_id` int(11) NOT NULL,
				  `value` decimal(5,2) default NULL
				) ENGINE=MyISAM DEFAULT CHARSET=latin1;
			');

			// Add our default tax rate
			$this->db->insert('firesale_taxes', array(
				'id' => 1,
				'created' => date("Y-m-d H:i:s"),
				'created_by' => $this->current_user->id,
				'ordering_count' => 0,
				'title' => 'Default',
				'description' => 'Default'
			));

			// And the default tax assignment
			$this->db->insert('firesale_taxes_assignments', array(
				'tax_id' => 1,
				'currency_id' => 1,
				'value' => '20.00'
			));
		}
		elseif ($method == 'remove')
		{
			// Remove the field from products if its still there
			$this->streams->fields->delete_field('tax_band', 'firesale_products');

			// Remove the taxes namespace
			$this->streams->utilities->remove_namespace('firesale_taxes');

			// Drop the assignments table
			$this->dbforge->drop_table('firesale_taxes_assignments');
		}
	}

	public function templates($action)
	{

		// Define our templates
		$templates = array('order-complete-admin', 'order-complete-user', 'order-dispatched');
		$sql = "INSERT INTO `" . SITE_REF . "_email_templates` (`slug`, `name`, `description`, `subject`, `body`, `lang`, `is_default`, `module`) VALUES
				('order-complete-admin', 'Order Complete (Admin)', 'Sent to the site admin once an order has been completed', '{{ settings:site_name }} :: An order has been complete', '<table border=\"0\" cellpadding=\"2\" cellspacing=\"0\" style=\"width: 500px;\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n				<p>\r\n					<strong>Add Your Logo Here</strong></p>\r\n				<p>\r\n					&nbsp;</p>\r\n			</td>\r\n			<td style=\"text-align: right;\">\r\n				<p>\r\n					<strong>Order ID: #{{ id }}</strong></p>\r\n				<p>\r\n					&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n				<p>\r\n					Dear Admin,</p>\r\n				<p>\r\n					You have just recieved a new order on {{ settings:site_name }}.<br />\r\n					<br />\r\n					&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				<p>\r\n					<strong>Postage Information:</strong></p>\r\n				<p>\r\n					{{ if ship_to.firstname }}{{ ship_to.firstname }}<br />\r\n					{{ endif }} {{ if ship_to.address1 }}{{ ship_to.address1 }}<br />\r\n					{{ endif }} {{ if ship_to.address2 }}{{ ship_to.address2 }}<br />\r\n					{{ endif }} {{ if ship_to.city }}{{ ship_to.city }}<br />\r\n					{{ endif }} {{ if ship_to.county }}{{ ship_to.county }}<br />\r\n					{{ endif }} {{ if ship_to.postcode }}{{ ship_to.postcode }}<br />\r\n					{{ endif }} {{ ship_to.country.name }}</p>\r\n			</td>\r\n			<td>\r\n				<p>\r\n					<strong>Billing Information:</strong></p>\r\n				<p>\r\n					{{ if bill_to.firstname }}{{ bill_to.firstname }}<br />\r\n					{{ endif }} {{ if bill_to.address1 }}{{ bill_to.address1 }}<br />\r\n					{{ endif }} {{ if bill_to.address2 }}{{ bill_to.address2 }}<br />\r\n					{{ endif }} {{ if bill_to.city }}{{ bill_to.city }}<br />\r\n					{{ endif }} {{ if bill_to.county }}{{ bill_to.county }}<br />\r\n					{{ endif }} {{ if bill_to.postcode }}{{ bill_to.postcode }}<br />\r\n					{{ endif }} {{ bill_to.country.name }}</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n				<br />\r\n				<br />\r\n				<table border=\"0\" cellpadding=\"2\" cellspacing=\"0\" style=\"width: 100%\">\r\n					<thead>\r\n						<tr style=\"border-top: 1px solid #ccc\">\r\n							<th style=\"font-weight:bold;text-align:left\">\r\n								Product</th>\r\n							<th style=\"font-weight:bold;text-align:left\">\r\n								Unit Price</th>\r\n							<th style=\"font-weight:bold;text-align:left\">\r\n								Quantity</th>\r\n							<th style=\"font-weight:bold;text-align:left\">\r\n								Total</th>\r\n						</tr>\r\n					</thead>\r\n					<tfoot>\r\n						<tr style=\"border-top: 1px solid #ccc\">\r\n							<td colspan=\"2\">\r\n								&nbsp;</td>\r\n							<td>\r\n								<strong>Sub-total:</strong></td>\r\n							<td>\r\n								{{ settings:currency }} {{ price_sub }}</td>\r\n						</tr>\r\n						<tr>\r\n							<td colspan=\"2\">\r\n								&nbsp;</td>\r\n							<td>\r\n								<strong>Postage:</strong></td>\r\n							<td>\r\n								{{ settings:currency }} {{ price_ship }}</td>\r\n						</tr>\r\n						<tr>\r\n							<td colspan=\"2\">\r\n								&nbsp;</td>\r\n							<td>\r\n								<strong>Tax ({{ settings:firesale_tax }}%):</strong></td>\r\n							<td>\r\n								{{ settings:currency }} {{ price_tax }}</td>\r\n						</tr>\r\n						<tr>\r\n							<td colspan=\"2\">\r\n								&nbsp;</td>\r\n							<td>\r\n								<strong>Total:</strong></td>\r\n							<td>\r\n								{{ settings:currency }} {{ price_total }}</td>\r\n						</tr>\r\n					</tfoot>\r\n					<tbody>\r\n{{ contents }}\r\n						<tr style=\"border-top: 1px solid #ccc\">\r\n							<td>\r\n								<a href=\"{{ url:base }}product/{{ slug }}\">{{ name }}<br />\r\n								Item No: {{ code }}</a></td>\r\n							<td>\r\n								{{ settings:currency }} {{ helper:number_format string=price decimals=\"2\" }}</td>\r\n							<td>\r\n								{{ qty }}</td>\r\n							<td>\r\n								{{ settings:currency }} {{ helper:number_format string=subtotal decimals=\"2\" }}</td>\r\n						</tr>\r\n{{ /contents }}\r\n					</tbody>\r\n				</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	&nbsp;</p>', 'en', 0, ''),
				('order-complete-user', 'Order Complete (User)', 'Sent to the user once an order has been completed', '{{ settings:site_name }} :: Your Order Confirmation', '<table border=\"0\" cellpadding=\"2\" cellspacing=\"0\" style=\"width: 500px;\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n				<p>\r\n					<strong>Add Your Logo Here</strong></p>\r\n				<p>\r\n					&nbsp;</p>\r\n			</td>\r\n			<td style=\"text-align: right;\">\r\n				<p>\r\n					<strong>Order ID: #{{ id }}</strong></p>\r\n				<p>\r\n					&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n				<p>\r\n					Dear {{ bill_to.firstname }},</p>\r\n				<p>\r\n					Thank you for your recent order on {{ settings:site_name }}, below you will find the details of your order and these should be kept for your own records.<br />\r\n					<br />\r\n					&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				<p>\r\n					<strong>Postage Information:</strong></p>\r\n				<p>\r\n					{{ if ship_to.firstname }}{{ ship_to.firstname }}<br />\r\n					{{ endif }} {{ if ship_to.address1 }}{{ ship_to.address1 }}<br />\r\n					{{ endif }} {{ if ship_to.address2 }}{{ ship_to.address2 }}<br />\r\n					{{ endif }} {{ if ship_to.city }}{{ ship_to.city }}<br />\r\n					{{ endif }} {{ if ship_to.county }}{{ ship_to.county }}<br />\r\n					{{ endif }} {{ if ship_to.postcode }}{{ ship_to.postcode }}<br />\r\n					{{ endif }} {{ ship_to.country.name }}</p>\r\n			</td>\r\n			<td>\r\n				<p>\r\n					<strong>Billing Information:</strong></p>\r\n				<p>\r\n					{{ if bill_to.firstname }}{{ bill_to.firstname }}<br />\r\n					{{ endif }} {{ if bill_to.address1 }}{{ bill_to.address1 }}<br />\r\n					{{ endif }} {{ if bill_to.address2 }}{{ bill_to.address2 }}<br />\r\n					{{ endif }} {{ if bill_to.city }}{{ bill_to.city }}<br />\r\n					{{ endif }} {{ if bill_to.county }}{{ bill_to.county }}<br />\r\n					{{ endif }} {{ if bill_to.postcode }}{{ bill_to.postcode }}<br />\r\n					{{ endif }} {{ bill_to.country.name }}</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n				<br />\r\n				<br />\r\n				<table border=\"0\" cellpadding=\"2\" cellspacing=\"0\" style=\"width: 100%\">\r\n					<thead>\r\n						<tr style=\"border-top: 1px solid #ccc\">\r\n							<th style=\"font-weight:bold;text-align:left\">\r\n								Product</th>\r\n							<th style=\"font-weight:bold;text-align:left\">\r\n								Unit Price</th>\r\n							<th style=\"font-weight:bold;text-align:left\">\r\n								Quantity</th>\r\n							<th style=\"font-weight:bold;text-align:left\">\r\n								Total</th>\r\n						</tr>\r\n					</thead>\r\n					<tfoot>\r\n						<tr style=\"border-top: 1px solid #ccc\">\r\n							<td colspan=\"2\">\r\n								&nbsp;</td>\r\n							<td>\r\n								<strong>Sub-total:</strong></td>\r\n							<td>\r\n								{{ settings:currency }} {{ price_sub }}</td>\r\n						</tr>\r\n						<tr>\r\n							<td colspan=\"2\">\r\n								&nbsp;</td>\r\n							<td>\r\n								<strong>Postage:</strong></td>\r\n							<td>\r\n								{{ settings:currency }} {{ price_ship }}</td>\r\n						</tr>\r\n						<tr>\r\n							<td colspan=\"2\">\r\n								&nbsp;</td>\r\n							<td>\r\n								<strong>Tax ({{ settings:firesale_tax }}%):</strong></td>\r\n							<td>\r\n								{{ settings:currency }} {{ price_tax }}</td>\r\n						</tr>\r\n						<tr>\r\n							<td colspan=\"2\">\r\n								&nbsp;</td>\r\n							<td>\r\n								<strong>Total:</strong></td>\r\n							<td>\r\n								{{ settings:currency }} {{ price_total }}</td>\r\n						</tr>\r\n					</tfoot>\r\n					<tbody>\r\n{{ contents }}\r\n						<tr style=\"border-top: 1px solid #ccc\">\r\n							<td>\r\n								<a href=\"{{ url:base }}product/{{ slug }}\">{{ name }}<br />\r\n								Item No: {{ code }}</a></td>\r\n							<td>\r\n								{{ settings:currency }} {{ helper:number_format string=price decimals=\"2\" }}</td>\r\n							<td>\r\n								{{ qty }}</td>\r\n							<td>\r\n								{{ settings:currency }} {{ helper:number_format string=subtotal decimals=\"2\" }}</td>\r\n						</tr>\r\n{{ /contents }}\r\n					</tbody>\r\n				</table>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n				<br />\r\n				<br />\r\n				<p>\r\n					Please note this is just a confirmation of your order, once payment has been processed and your items have been dispatched we will contact you again to let you know.</p>\r\n				<p>\r\n					Thank you very much for your custom, and we hope to see you back on {{ settings:site_name }} again soon!</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	&nbsp;</p>', 'en', 0, ''),
				('order-dispatched', 'Order Dispatched (user)', 'Sent to the user when their order has been dispatched', '{{ settings:site_name }} :: Your Order Has Been Dispatched', '<table border=\"0\" cellpadding=\"2\" cellspacing=\"0\" style=\"width: 500px;\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n				<p>\r\n					<strong>Add Your Logo Here</strong></p>\r\n				<p>\r\n					&nbsp;</p>\r\n			</td>\r\n			<td style=\"text-align: right;\">\r\n				<p>\r\n					<strong>Order ID: #{{ id }}</strong></p>\r\n				<p>\r\n					Expected delivery date: <strong>???</strong></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n				<p>\r\n					Dear {{ bill_to.firstname }},</p>\r\n				<p>\r\n					Thank you for your recent order on {{ settings:site_name }}, we''re just letting you know that your order has been dispatched as well as confirm the details once again.<br />\r\n					<br />\r\n					&nbsp;</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n				<p>\r\n					<strong>Postage Information:</strong></p>\r\n				<p>\r\n					{{ if ship_to.firstname }}{{ ship_to.firstname }}<br />\r\n					{{ endif }} {{ if ship_to.address1 }}{{ ship_to.address1 }}<br />\r\n					{{ endif }} {{ if ship_to.address2 }}{{ ship_to.address2 }}<br />\r\n					{{ endif }} {{ if ship_to.city }}{{ ship_to.city }}<br />\r\n					{{ endif }} {{ if ship_to.county }}{{ ship_to.county }}<br />\r\n					{{ endif }} {{ if ship_to.postcode }}{{ ship_to.postcode }}<br />\r\n					{{ endif }} {{ ship_to.country.name }}</p>\r\n			</td>\r\n			<td>\r\n				<p>\r\n					<strong>Billing Information:</strong></p>\r\n				<p>\r\n					{{ if bill_to.firstname }}{{ bill_to.firstname }}<br />\r\n					{{ endif }} {{ if bill_to.address1 }}{{ bill_to.address1 }}<br />\r\n					{{ endif }} {{ if bill_to.address2 }}{{ bill_to.address2 }}<br />\r\n					{{ endif }} {{ if bill_to.city }}{{ bill_to.city }}<br />\r\n					{{ endif }} {{ if bill_to.county }}{{ bill_to.county }}<br />\r\n					{{ endif }} {{ if bill_to.postcode }}{{ bill_to.postcode }}<br />\r\n					{{ endif }} {{ bill_to.country.name }}</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n				<br />\r\n				<br />\r\n				<table border=\"0\" cellpadding=\"2\" cellspacing=\"0\" style=\"width: 100%\">\r\n					<thead>\r\n						<tr style=\"border-top: 1px solid #ccc\">\r\n							<th style=\"font-weight:bold;text-align:left\">\r\n								Product</th>\r\n							<th style=\"font-weight:bold;text-align:left\">\r\n								Unit Price</th>\r\n							<th style=\"font-weight:bold;text-align:left\">\r\n								Quantity</th>\r\n							<th style=\"font-weight:bold;text-align:left\">\r\n								Total</th>\r\n						</tr>\r\n					</thead>\r\n					<tfoot>\r\n						<tr style=\"border-top: 1px solid #ccc\">\r\n							<td colspan=\"2\">\r\n								&nbsp;</td>\r\n							<td>\r\n								<strong>Sub-total:</strong></td>\r\n							<td>\r\n								{{ settings:currency }} {{ price_sub }}</td>\r\n						</tr>\r\n						<tr>\r\n							<td colspan=\"2\">\r\n								&nbsp;</td>\r\n							<td>\r\n								<strong>Postage:</strong></td>\r\n							<td>\r\n								{{ settings:currency }} {{ price_ship }}</td>\r\n						</tr>\r\n						<tr>\r\n							<td colspan=\"2\">\r\n								&nbsp;</td>\r\n							<td>\r\n								<strong>Tax ({{ settings:firesale_tax }}%):</strong></td>\r\n							<td>\r\n								{{ settings:currency }} {{ price_tax }}</td>\r\n						</tr>\r\n						<tr>\r\n							<td colspan=\"2\">\r\n								&nbsp;</td>\r\n							<td>\r\n								<strong>Total:</strong></td>\r\n							<td>\r\n								{{ settings:currency }} {{ price_total }}</td>\r\n						</tr>\r\n					</tfoot>\r\n					<tbody>\r\n{{ contents }}\r\n						<tr style=\"border-top: 1px solid #ccc\">\r\n							<td>\r\n								<a href=\"{{ url:base }}product/{{ slug }}\">{{ name }}<br />\r\n								Item No: {{ code }}</a></td>\r\n							<td>\r\n								{{ settings:currency }} {{ helper:number_format string=price decimals=\"2\" }}</td>\r\n							<td>\r\n								{{ qty }}</td>\r\n							<td>\r\n								{{ settings:currency }} {{ helper:number_format string=subtotal decimals=\"2\" }}</td>\r\n						</tr>\r\n{{ /contents }}\r\n					</tbody>\r\n				</table>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">\r\n				<br /><br />\r\n				<p>\r\n					Once again, thank you very much for your custom, and we hope to see you back on {{ settings:site_name }} again soon!</p>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n<p>\r\n	&nbsp;</p>', 'en', 0, '');";

		if( $action == 'add' )
		{
			$this->db->query($sql);
		}
		else
		{
			$this->db->where_in('slug', $templates)->delete('email_templates');
		}

	}

	public function install_multiple()
	{

		// Load required items
		$this->load->library('unzip');

		// Variables
		$url    = 'https://github.com/parse19/PyroStreams-Multiple-Relationships/zipball/master';
		$path   = SHARED_ADDONPATH . 'field_types/';
		$before = scandir($path);

		// Perform checks before continuing
		if( extension_loaded('zlib') AND
			function_exists('copy') AND
			function_exists('rename') AND
			function_exists('unlink') AND
			is_writable($path) )
		{

			// Download to temp folder
			$temp = tempnam(sys_get_temp_dir(), 'multiple');
			copy($url, $temp);

			// Unzip
			$this->unzip->extract($temp, $path);

			// Rename folder
			$after  = scandir($path);
			$new    = array_diff($after, $before);
			$folder = current($new);
			rename($path.$folder, $path.'multiple');

			// Remove temp file
			@unlink($temp);

			// Check it all went well
			if( is_dir($path.'multiple') )
			{
				return TRUE;
			}

		}

		// Something went wrong
		return FALSE;
	}

	public function info()
	{
		return $this->firesale->info($this->information(), $this->language_file);
	}

}
