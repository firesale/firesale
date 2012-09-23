# FireSale

* Website: http://www.getfiresale.org
* Documentation: http://docs.getfiresale.org
* License: MIT License, a copy of which is included with this package
* Version: 1.0.4

## Team

* [Jamie Holdroyd](http://www.jholdroyd.co.uk)
* [Chris Harvey](http://www.chrisnharvey.com)

## Description

FireSale is a lightweight, extensible eCommerce platform designed and built around [PyroCMS](http://www.pyrocms.com). We've aimed to keep it small yet highly functional while making it easy to use for you and your clients, enabling you to get your new store running in no time. In the core we've included everything you need to build an amazing store and the two additional modules (search and shipping) are intended to be used not only as a template for your future development but also key to the default usability. These two features were left out of the core as we know they're the areas most likely to be customised by many clients and felt it was necessary to allow them to be easily replaced.

Through a slightly modified version of the standard details file found in any PyroCMS module we have put together a framework that allows the core and add-ons to look and feel the same on the admin side while interacting seamlessly across the whole package. The idea of extensibility was something we had from day-one and everything we've done has been based around this principle. We've aimed to allow you to use the core as a starting point and to require as little modification as possible and moving all customisation to the add-ons. While add-ons do a lot of the customisation we've also aimed to make as much of the core streams enabled as possible, with more of it being converted as time goes on, meaning you can easily customise and change the options for each area of the module.

## Features
* Highly powerful product and category creation
* Complete order tracking
* Informative dashboard with more information added via modules
* Available in 6 (and counting) Languages
* Simple and intuative interface
* 15 Payment Gateways, powered by CI-Merchant and easily extended
* Almost fully extensible through modules
* Totally streams powered for easy customisation
* Drag and drop, files integrated, image uploading
* Complete with shipping and search

## Requirements
* PHP 5.2+
* PyroCMS 2.1.4+
* The suggested routes added to your system/cms/config/routes.php file ([see below](#routes))
* Theme with jQuery

## Installation

1. Clone yourself a copy of the FireSale core
2. Move everything to either your PyroCMS shared_addons or addons/default folder
3. If you are using PyroCMS Community you need to install also the [Multiple Relationship](https://github.com/parse19/PyroStreams-Multiple-Relationships) field type
4. Install the core via the admin modules panel
5. Install the other two modules by the same method
6. Go into settings and choose your preferred options, we strongly advise you to select yes for routes
7. Below you'll find a number of routes we suggest you install; a number of features will not work without them

## Routes

Either via the Routes Add-on or directly into the config we suggest you put the following items into your routes:
	
	$route['category/(order|style)/([a-z0-9]+)'] = 'firesale/front_category/$1/$2';
	$route['category(:any)'] 		  			 = 'firesale/front_category/index$1';
	$route['product(:any)']  		  			 = 'firesale/front_product/index$1';
	$route['search(:any)?']  		  			 = 'firesale_search/search/index$1';
	$route['cart(:any)?']    		  			 = 'firesale/cart$1';
	$route['users/orders/([0-9]+)']   			 = 'firesale/front_orders/view_order/$1';
	$route['users/orders']   		  			 = 'firesale/front_orders/index';
	$route['users/addresses(/:any)?'] 			 = 'firesale/front_address$1';

If you would like to replace the default PyroCMS dashboard with the FireSale dashboard then you can do so by adding the following route:

	$route['admin'] = 'firesale/admin/index';

## Feedback and issues

If you find any issues or want to provide feedback we'd appreciate it if you used the GitHub issue tracker and we'll try to address them as soon as we can.

## Pull Requests

If you would like to submit your bug fixes, enhancements and translations to the project then you are welcome to submit pull requests here on GitHub. We do however ask that you use the UNIX LF (\n) line endings.

# Contributors

Thank you to everyone that has helped along the way, contributing not only code but time, ideas and coffee, without you this wouldn't have been possible.