<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* This file is part of FireSale, a PHP based eCommerce system built for
* PyroCMS.
*
* Copyright (c) 2013 Moltin Ltd.
* http://github.com/firesale/firesale
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*
* @package firesale/core
* @author FireSale <support@getfiresale.org>
* @copyright 2013 Moltin Ltd.
* @version dev
* @link http://github.com/firesale/firesale
*
*/

/* Admin */
$route['firesale/admin/products(/:num)?']   = 'admin/products/index$1';
$route['firesale/admin/products(/:any)?']   = 'admin/products$1';
$route['firesale/admin/categories(/:num)?'] = 'admin/categories/index$1';
$route['firesale/admin/categories(/:any)?'] = 'admin/categories$1';
$route['firesale/admin/taxes(/:num)?']      = 'admin/taxes/index$1';
$route['firesale/admin/taxes(/:any)?']      = 'admin/taxes$1';
$route['firesale/admin/currency(/:num)?']   = 'admin/currency/index$1';
$route['firesale/admin/currency(/:any)?']   = 'admin/currency$1';
$route['firesale/admin/routes(/:num)?']     = 'admin/routes/index$1';
$route['firesale/admin/routes(/:any)?']     = 'admin/routes$1';
$route['firesale/admin/orders(/:num)?']     = 'admin/orders/index$1';
$route['firesale/admin/orders(/:any)?']     = 'admin/orders$1';
$route['firesale/admin/gateways(/:num)?']   = 'admin/gateways/index$1';
$route['firesale/admin/gateways(/:any)?']   = 'admin/gateways$1';
$route['firesale/admin/liveedit(/:num)?']   = 'admin/liveedit/index$1';
$route['firesale/admin/liveedit(/:any)?']   = 'admin/liveedit$1';
$route['firesale/admin(/:num)?']            = 'admin/dashboard/index$1';
$route['firesale/admin(/:any)?']            = 'admin/dashboard$1';
