<?php defined('BASEPATH') or exit('No direct script access allowed');

class Notes_m extends MY_Model
{
	public function get_order($order_id)
	{
		$order = $this->orders_m->get_order_by_id($order_id);

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