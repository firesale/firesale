<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

$route['firesale/admin/products(?:(/[category|status|stock_status|na]+/[0-9na]+(?:(/[0-9]+)?)))?'] = 'admin_products/index$1'; // Fuck you pagination and filtering
$route['firesale/admin/categories(/:any)?'] 		 	 = 'admin_categories$1';
$route['firesale/admin/brands(/:any)?'] 		 	 	 = 'admin_brands$1';
$route['firesale/admin/products(/:any)?'] 				 = 'admin_products$1';
$route['firesale/admin/currency(/:any)?'] 				 = 'admin_currency$1';
$route['firesale/admin/routes(/:any)?'] 				 = 'admin_routes$1';
$route['firesale/admin/orders/ajax_add_product(/:any)?'] = 'admin_orders/ajax_add_product$1';
$route['firesale/admin/orders/ajax_get_address(/:any)?'] = 'admin_orders/ajax_get_address$1';
$route['firesale/admin/orders/edit(/:any)?']	  		 = 'admin_orders/edit$1';
$route['firesale/admin/orders/create']	  			  	 = 'admin_orders/create';
$route['firesale/admin/orders/status']	  			  	 = 'admin_orders/status';
$route['firesale/admin/orders/delete(/:any)?'] 			 = 'admin_orders/delete$1';
$route['firesale/admin/orders(/:any)?'] 				 = 'admin_orders/index$1';
$route['firesale/admin/gateways(/:any)?'] 				 = 'admin_gateways$1';
$route['firesale/admin'] 			 	  				 = 'firesale/admin/index';
