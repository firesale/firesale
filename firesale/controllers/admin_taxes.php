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

	public $tabs = array('general' => array());

	public function index($page = 1)
	{
		$params = array(
			'stream'       => 'firesale_taxes',
			'namespace'    => 'firesale_taxes',
			'paginate'     => 'yes',
			'page_segment' => 4,
			'sort'         => 'asc'
		);

        $data['taxes'] = $this->streams->entries->get_entries($params);

        $this->template->build('admin/taxes/index', $data);
	}

	public function form($row = FALSE)
	{
		$stream = $this->streams->streams->get_stream('firesale_taxes', 'firesale_taxes');
		$skip  = array('btnAction');
		$extra = array(
			'return'          => false,
			'success_message' => lang('firesale:taxes:'.($row ? 'edit' : 'add').'_success'),
			'failure_message' => lang('firesale:taxes:'.($row ? 'edit' : 'add').'_error'),
			'title'           => lang('firesale:taxes:create')
        );

		$fields = $this->fields->build_form($stream, $row ? 'edit' : 'new', $row ? $row : $this->input->post(), FALSE, FALSE, $skip, $extra);

        if ( ! is_array($fields))
		{
			// Redirect
			if( $this->input->post('btnAction') == 'save_exit' )
			{
				redirect('admin/firesale/taxes');
			}
			else
			{
				redirect('admin/firesale/taxes/edit/' . $fields);
			}

		}

		// Load helper
		$this->load->helper('firesale/general');

		// Pass some data to the view
		$data['type'] = $row ? 'edit' : 'new';
		$data['fields'] = fields_to_tabs($fields, $this->tabs);
		$data['tabs'] = array_keys($data['fields']);

		$this->template->build('admin/taxes/form', $data);
	}

	public function assign()
	{
		$action = $this->input->post('btnAction');

		if ($action == 'save' OR $action == 'save_exit')
		{
			foreach ($this->input->post('assignment') as $currency_id => $taxes)
			{
				foreach ($taxes as $tax_id => $value)
				{
					$query = $this->db->get_where('firesale_taxes_assignments', array(
						'tax_id'      => $tax_id,
						'currency_id' => $currency_id
					));

					if ($query->num_rows())
					{
						$this->db->update('firesale_taxes_assignments', array(
							'value'       => $value
						), array(
							'tax_id'      => $tax_id,
							'currency_id' => $currency_id
						));
					}
					else
					{
						$this->db->insert('firesale_taxes_assignments', array(
							'tax_id'      => $tax_id,
							'currency_id' => $currency_id,
							'value'       => $value
						));
					}
				}
			}

			if ($action == 'save_exit')
			{
				redirect('admin/firesale/taxes');
			}
		}

		// Load the taxes model
		$this->load->model('firesale/taxes_m');

		$data = $this->taxes_m->get_assignments();

		$this->template->append_js('module::taxes.js')
					   ->build('admin/taxes/assign', $data);
	}

	public function create()
	{
		$this->form();
	}

	public function edit($id)
	{
		// Get the row
		$row = $this->streams->entries->get_entry($id, 'firesale_taxes', 'firesale_taxes');
		$this->form($row);
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
			
			$this->db->delete('firesale_taxes_assignments', array(
				'tax_id' => $id
			));
		}

		if ($redirect)
		{
			redirect('admin/firesale/taxes');
		}
	}
}
