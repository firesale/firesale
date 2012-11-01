<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Taxes admin controller
 *
 * @author		Chris Harvey
 * @author		Jamie Holdroyd
 * @package		FireSale\Core\Controllers
 *
 */
class Admin_taxes extends Admin_Controller
{
	public $section = 'taxes';

	public function index()
	{
		$params = array(
			'stream'       => 'firesale_taxes',
			'namespace'    => 'firesale_taxes',
			'paginate'     => 'yes',
			'page_segment' => 4
		);

        $data['taxes'] = $this->streams->entries->get_entries($params);

        $this->template->build('admin/taxes/index', $data);
	}
}
