<?php defined('BASEPATH') or exit('No direct script access allowed');

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
* @package firesale/dispatch_notes
* @author FireSale <support@getfiresale.org>
* @copyright 2013 Moltin Ltd.
* @version master
* @link http://github.com/firesale/firesale
*
*/

class Notes_m extends MY_Model
{
	public function get_order($order_id)
	{
		$order = $this->pyrocache->model('orders_m', 'get_order_by_id', array($order_id), $this->firesale->cache_time);

		if ( ! empty($order))
		{
			// Format order for display
			$order['price_sub']   = number_format($order['price_sub'], 2);
			$order['price_ship']  = number_format($order['price_ship'], 2);
			$order['price_total'] = number_format($order['price_total'], 2);

			// Format products
			foreach ($order['items'] AS &$item)
				$item['price'] = number_format($item['price'], 2);

			return $order;
		}
		else
		{
			return FALSE;
		}
	}
}