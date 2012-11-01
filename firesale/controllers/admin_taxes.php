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
			$this->streams->cp->entry_form('firesale_taxes', 'firesale_taxes', 'edit', $id, TRUE);
		}
	}

	public function delete($id = NULL, $redirect = TRUE)
	{
		if (is_null($id) AND $this->input->post('action_to'))
		{
			foreach ($this->input->post('action_to') as $id)
			{
				$this->delete($id, FALSE);
			}
		}
		elseif ($id != 1)
		{
			$this->streams->entries->delete_entry($id, 'firesale_taxes', 'firesale_taxes');
		}

		if ($redirect)
		{
			redirect('admin/firesale/taxes');
		}
	}
}
