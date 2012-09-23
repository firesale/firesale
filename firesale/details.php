<?php defined('BASEPATH') or exit('No direct script access allowed');

class Module_Firesale extends Module {
	
	public $version = '1.0.4';
	public $language_file = 'firesale/firesale';
	
	public function __construct()
	{
		parent::__construct();
		
		// Load in the FireSALE library
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
			'menu'	   => 'FireSALE',
			'author'   => 'Jamie Holdroyd & Chris Harvey',
			'roles' => array(
				'edit_orders', 'access_gateways', 'install_uninstall_gateways', 'enable_disable_gateways', 'edit_gateways'
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
		
		return $info;
	}
	
	public function install()
	{
		
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
		foreach( $fields AS $key => $field ) { $fields[$key] = array_merge($template, $field); }
	
		// Add fields to stream
		$this->streams->fields->add_fields($fields);
		
		// Change default parent value
		$this->db->query("ALTER TABLE `" . SITE_REF . "_firesale_categories` CHANGE `parent` `parent` INT( 11 ) NULL DEFAULT '0';");
		
		// Add an initial category
		$cat = array('id' => 1, 'created' => date("Y-m-d H:i:s"), 'created_by' => 1, 'ordering_count' => 0, 'parent' => 0, 'status' => 1, 'title' => 'Uncategorised', 'slug' => 'uncategorised', 'description' => 'This is your initial product category, which can\'t be deleted; however you can rename it if you wish.');
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
		$fields[] = array('name' => 'lang:firesale:label_category', 'slug' => 'category', 'type' => 'multiple', 'extra' => array('choose_stream' => $categories->id), 'required' => FALSE);
		$fields[] = array('name' => 'lang:firesale:label_rrp', 'slug' => 'rrp', 'type' => 'text', 'instructions' => 'lang:firesale:inst_rrp', 'extra' => array('max_length' => 10, 'pattern' => '^\d+(?:,\d{3})*\.\d{2}$'));
		$fields[] = array('name' => 'lang:firesale:label_rrp_tax', 'slug' => 'rrp_tax', 'type' => 'text', 'extra' => array('max_length' => 10, 'pattern' => '^\d+(?:,\d{3})*\.\d{2}$'));
		$fields[] = array('name' => 'lang:firesale:label_price', 'slug' => 'price', 'type' => 'text', 'instructions' => 'lang:firesale:inst_price', 'extra' => array('max_length' => 10, 'pattern' => '^\d+(?:,\d{3})*\.\d{2}$'));
		$fields[] = array('name' => 'lang:firesale:label_price_tax', 'slug' => 'price_tax', 'type' => 'text', 'extra' => array('max_length' => 10, 'pattern' => '^\d+(?:,\d{3})*\.\d{2}$'));
		$fields[] = array('name' => 'lang:firesale:label_status', 'slug' => 'status', 'type' => 'choice', 'extra' => array('choice_data' => "0 : lang:firesale:label_draft\n1 : lang:firesale:label_live", 'choice_type' => 'dropdown', 'default_value' => 1));
		$fields[] = array('name' => 'lang:firesale:label_stock', 'slug' => 'stock', 'type' => 'integer');
		$fields[] = array('name' => 'lang:firesale:label_stock_status', 'slug' => 'stock_status', 'type' => 'choice', 'extra' => array('choice_data' => $stockstatus, 'choice_type' => 'dropdown', 'default_value' => 1));
		$fields[] = array('name' => 'lang:firesale:label_description', 'slug' => 'description', 'type' => 'wysiwyg', 'extra' => array('editor_type' => 'advanced'));

		// Combine
		foreach( $fields AS $key => $field ) { $fields[$key] = array_merge($template, $field); }
	
		// Add fields to stream
		$this->streams->fields->add_fields($fields);
		
		// Change engine and add fulltext
		$this->db->query("ALTER TABLE `" . SITE_REF . "_firesale_products` ENGINE = MyISAM,
						  ADD FULLTEXT (`title`, `description`),
						  CHANGE `rrp` `rrp` DECIMAL( 10, 2 ) DEFAULT '0.00',
						  CHANGE `rrp_tax` `rrp_tax` DECIMAL( 10, 2 ) DEFAULT '0.00',
						  CHANGE `price` `price` DECIMAL( 10, 2 ) DEFAULT '0.00',
						  CHANGE `price_tax` `price_tax` DECIMAL( 10, 2 ) DEFAULT '0.00';");

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
		foreach( $fields AS $key => $field ) { $fields[$key] = array_merge($template, $field); }
	
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
		foreach( $fields AS $key => $field ) { $fields[$key] = array_merge($template, $field); }
		
		// Add fields to stream
		$this->streams->fields->add_fields($fields);

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
		$orders = $this->streams->streams->get_stream('firesale_orders', 'firesale_orders');
		
		// Add fields
		$fields   = array();
		$template = array('namespace' => 'firesale_orders', 'assign' => 'firesale_orders', 'type' => 'text', 'title_column' => FALSE, 'required' => TRUE, 'unique' => FALSE);
		$fields[] = array('name' => 'lang:firesale:label_ip', 'slug' => 'ip', 'type' => 'text', 'extra' => array('max_length' => 32), 'required' => FALSE);
		$fields[] = array('name' => 'lang:firesale:label_gateway', 'slug' => 'gateway', 'type' => 'relationship', 'extra' => array('max_length' => 5, 'choose_stream' => $gateways->id), 'required' => FALSE);
		$fields[] = array('name' => 'lang:firesale:label_status', 'slug' => 'order_status', 'type' => 'choice', 'extra' => array('choice_data' => $orderstatus, 'choice_type' => 'dropdown', 'default_value' => '1'));
		$fields[] = array('name' => 'lang:firesale:label_price_sub', 'slug' => 'price_sub', 'extra' => array('max_length' => 10), 'required' => FALSE);
		$fields[] = array('name' => 'lang:firesale:label_price_ship', 'slug' => 'price_ship', 'extra' => array('max_length' => 10), 'required' => FALSE);
		$fields[] = array('name' => 'lang:firesale:label_price_total', 'slug' => 'price_total', 'extra' => array('max_length' => 10), 'required' => FALSE);
		$fields[] = array('name' => 'lang:firesale:label_ship_to', 'slug' => 'ship_to', 'type' => 'relationship', 'extra' => array('choose_stream' => $addresses->id), 'required' => FALSE);
		$fields[] = array('name' => 'lang:firesale:label_bill_to', 'slug' => 'bill_to', 'type' => 'relationship', 'extra' => array('choose_stream' => $addresses->id), 'required' => FALSE);
		$fields[] = array('name' => 'lang:firesale:label_shipping', 'slug' => 'shipping', 'type' => 'integer', 'required' => FALSE);
	
		// Combine
		foreach( $fields AS $key => $field ) { $fields[$key] = array_merge($template, $field); }
		
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
		foreach( $fields AS $key => $field ) { $fields[$key] = array_merge($template, $field); }

		// Add fields to stream
		$this->streams->fields->add_fields($fields);

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
		
		// Create files folder
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
	
		// Remove settings
		$this->settings('remove');

		// Remove email templates
		$this->templates('remove');
		
		// Remove products
		$this->products_m->delete_all_products();
		
		// Remove files folder
		$folder = $this->products_m->get_file_folder_by_slug('product-images');
		if( $folder != FALSE ) { Files::delete_folder($folder->id); }
		
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
		if ($old_version == '0.9.7')
		{
			// Currency Code
			$settings = array(
				'slug' 		  	=> 'firesale_currency',
				'title' 	  	=> 'Currency Code',
				'description' 	=> 'The currency you accept (ISO-4217 format)',
				'default'		=> 'GBP',
				'value'			=> 'GBP',
				'type' 			=> 'text',
				'options'		=> '',
				'is_required' 	=> 1,
				'is_gui'		=> 1,
				'module' 		=> 'firesale'
			);

			return $this->db->insert('settings', $settings);
		}

		return TRUE;
	}

	public function help()
	{

		return "Some Help Stuff";
	}
	
	public function settings($action)
	{
	
		// Variables
		$return     = TRUE;
		$settings   = array();
		
		// Tax
		$settings[] = array(
			'slug' 		  	=> 'firesale_tax',
			'title' 	  	=> 'Tax Percentage',
			'description' 	=> 'The percentage of tax to be applied to the products',
			'default'		=> '20',
			'value'			=> '20',
			'type' 			=> 'text',
			'options'		=> '',
			'is_required' 	=> 1,
			'is_gui'		=> 1,
			'module' 		=> 'firesale'
		);

		// Currency Code
		$settings[] = array(
			'slug' 		  	=> 'firesale_currency',
			'title' 	  	=> 'Currency Code',
			'description' 	=> 'The currency you accept (ISO-4217 format)',
			'default'		=> 'GBP',
			'value'			=> 'GBP',
			'type' 			=> 'text',
			'options'		=> '',
			'is_required' 	=> 1,
			'is_gui'		=> 1,
			'module' 		=> 'firesale'
		);

		// Products Per Page
		$settings[] = array(
			'slug' 		  	=> 'firesale_perpage',
			'title' 	  	=> 'Products per Page',
			'description' 	=> 'The number of products to be displayed on category and search result pages',
			'default'		=> '15',
			'value'			=> '15',
			'type' 			=> 'text',
			'options'		=> '',
			'is_required' 	=> 1,
			'is_gui'		=> 1,
			'module' 		=> 'firesale'
		);
		
		// Make images square
		$settings[] = array(
			'slug' 		  	=> 'image_square',
			'title' 	  	=> 'Make Images Square?',
			'description' 	=> 'Some themes may require square images to keep layouts consistent',
			'default'		=> '0',
			'value'			=> '0',
			'type' 			=> 'select',
			'options'		=> '1=Yes|0=No',
			'is_required' 	=> 1,
			'is_gui'		=> 1,
			'module' 		=> 'firesale'
		);

		// Require login to purchase
		$settings[] = array(
			'slug' 		  	=> 'firesale_login',
			'title' 	  	=> 'Require login to purchase?',
			'description' 	=> 'Ensure a user is logged in before allowing them to buy products',
			'default' 		=> '0',
			'value' 		=> '0',
			'type' 			=> 'select',
			'options' 		=> '1=Yes|0=No',
			'is_required' 	=> 1,
			'is_gui' 		=> 1,
			'module' 		=> 'firesale'
		);

		// Perform	
		if( $action == 'add' )
		{
			if( !$this->db->insert_batch('settings', $settings) )
			{
				$return = FALSE;
			}
		}
		elseif( $action == 'remove' )
		{
			foreach ($settings as $setting)
			{
				if( !$this->db->delete('settings', array('slug' => $setting['slug'])) )
				{
					$return = FALSE;
				}
			}
		}
		
		return $return;	
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

	public function info()
	{
		return $this->firesale->info($this->information(), $this->language_file);
	}

}
