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

class Admin extends Admin_Controller
{
	public function print_notes($order = NULL)
	{
		// Laod stuff
		$this->load->model(array(
			'firesale/orders_m',
			'firesale/products_m',
			'firesale/categories_m',
			'notes_m'
		));

		$func_args = func_get_args();

		$orders = empty($func_args) ? $this->input->post('action_to') : $func_args;

		if ( ! empty($orders))
		{
			$theme = $this->settings->get('default_theme');
			$this->template->set_theme($theme); // So we can overload in our theme

			// So we can include theme files in our overloaded templates
			Asset::add_path($theme, $this->template->get_theme_path());

			$content = NULL;

			foreach ($orders as $order_id)
			{
				// Set some default template stuff
				$this->template
					 ->enable_parser(TRUE)
					 ->set_layout(FALSE);

				$order = $this->notes_m->get_order($order_id);

				if ($order)
					$content .= $this->template->build('note', $order, TRUE);
			}

			$this->template->set_theme($this->settings->get('default_theme')) // So we can overload in our theme
						   ->set_layout(FALSE)
						   ->set('content', $content)
						   ->append_css('module::print.css')
						   ->build('global');
		}
		else
		{
			redirect('admin/firesale/orders');
		}
	}
}