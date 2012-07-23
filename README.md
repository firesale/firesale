# FireSALE Core (Beta)

* Documentation: Coming Soon
* License: MIT License, a copy of which is included with this package
* Version: 0.9.1

## Team

* [Jamie Holdroyd](http://www.jholdroyd.co.uk)
* [Chris Harvey](http://www.chrisnharvey.com)

## Description

FireSALE is a lightweight, extensible eCommerce platform designed and build around [PyroCMS](http://www.pyrocms.com). We've aimed to keep it small yet highly functional while making it easy to use for you and your clients, enabling you to get your new online store running in no time. In the core we've included everything you need to build an amazing online store and the two additional modules (search and shipping) are intended to be used not only as a template for your future development but also key to the default usability. These two features were left out of the core as we know they're the areas most likely to be customised by many clients and felt it was necessary to allow them to be easily replaced.

Through a slightly modified version of the standard details file found in any PyroCMS module we have put together a framework that allows the core and add-ons to look and feel the same on the admin side while interacting seamlessly across the whole package. The idea of extensibility was something we had from day-one and everything we've done has been based around this principle. We've aimed to allow you to use the core as a starting point and to require as little modification as possible and moving all customisation to the add-ons. While add-ons do a lot of the customisation we've also aimed to make as much of the core streams enabled as possible, with more of it being converted as time goes on, meaning you can easily customise and change the options for each area of the module.

## About the beta

This beta is an opportunity for you and us to evaluate the current state of the module, root out any issues or concerns you may have but with the main intention to gauge feedback and to listen to what you would like to see included in the future, either as an add-on module or as core functionality. We have a lot of feature ideas for subsequent releases and as previously stated they are not included in the core as we have intentionally kept it minimal to be extended later on by either our or your own add-on modules.

### Theme
The default views have not been completed and during the beta we've decided to provide the demo theme that has been shown in a number of screenshots during development so add-on and theme authors can see how certain elements are done and what variables are provided to the front-end. There are a large number of redundant if-module-installed queries that can be ignored, these were in place to simply stop having to rewrite parts of it as we played with extra add-ons. The theme was based on [Shoppica](http://www.shoppica.com/html) and is not intended to be used in a production environment. The theme is not yet finished and was never intended for release or use, as such cross-browser compatibility is patchy.

You can find a copy to download via [this link](https://dl.dropbox.com/u/32596384/fs-theme.zip).

## Installation

1. Clone yourself a copy of the FireSALE core
2. Move everything to either your PyroCMS shared_addons or addons/default folder
3. Install the core via the admin modules panel
4. Install the other two modules by the same method
5. Go into settings and choose your preferred options, we strongly advise you to select yes for routes
6. Below you'll find a number of routes we suggest you install; a number of features will not work without them

## Routes

Either via the Routes Add-on or directly into the config we suggest you put the following items into your routes:

	$route['category(:any)'] 		  = 'firesale/front_category/index$1';
	$route['product(:any)']  		  = 'firesale/front_product/index$1';
	$route['search(:any)?']  		  = 'firesale_search/search/index$1';
	$route['cart(:any)?']    		  = 'firesale/cart$1';
	$route['users/orders/([0-9]+)']   = 'firesale/front_orders/view_order/$1';
	$route['users/orders']   		  = 'firesale/front_orders/index';
	$route['users/addresses(/:any)?'] = 'firesale/front_address$1';

## Feedback and issues

If you find any issues or want to provide feedback we'd appreciate it if you used the GitHub issue tracker and we'll try to address them as soon as we can.

# Contributors

Thank you to everyone that has helped along the way, contributing not only code but time, ideas and coffee, without you this wouldn't have been possible.