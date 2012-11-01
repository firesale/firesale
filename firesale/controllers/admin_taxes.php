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

	public function create()
	{
		$this->streams->cp->entry_form('firesale_taxes', 'firesale_taxes', 'new', NULL, TRUE);
	}

	public function edit($id = NULL)
	{
		if (is_null($id))
		{
			redirect('admin/firesale/taxes/create');
		}
		else
		{
			//$entry = (array) $this->streams->entries->get_entry($id, 'firesale_taxes', 'firesale_taxes');
			//print_r($entry);
			$this->streams->cp->entry_form('firesale_taxes', 'firesale_taxes', 'edit', $id, TRUE);
		}
	}
}
