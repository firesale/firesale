<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

// Admin routes
$route['firesale/admin/categories(/:any)?'] 		 		  = 'admin_categories$1';
$route['firesale/admin/products(?:/([0-9]+))?(?:/([0-9]+))?'] = 'admin_products/index/$1/$2';
$route['firesale/admin/products(/:any)?'] 					  = 'admin_products$1';
$route['firesale/admin/orders/edit(/:any)?']	  			  = 'admin_orders/edit$1';
$route['firesale/admin/orders/create']	  			  		  = 'admin_orders/create';
$route['firesale/admin/orders/status']	  			  		  = 'admin_orders/status';
$route['firesale/admin/orders(/:any)?'] 					  = 'admin_orders/index$1';
$route['firesale/admin/gateways(/:any)?'] 					  = 'admin_gateways$1';
$route['firesale/admin'] 			 	  					  = 'firesale/admin/index';

// Public routes
$route['firesale/cart(/:any)?']		= 'front_cart$1';
$route['firesale/product(/:any)?']	= 'front_product/index$1';
