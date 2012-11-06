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
		/** 
		 * @todo Move this to a model
		 */

		// Load streams
		$this->load->driver('Streams');

		// Get taxes
		$params = array(
			'stream' => 'firesale_taxes',
			'namespace' => 'firesale_taxes',
			'paginate' => 'no'
		);

		$taxes = $this->streams->entries->get_entries($params);
		$data['taxes'] = $taxes['entries'];

		// Get currencies
		$params = array(
			'stream' => 'firesale_currency',
			'namespace' => 'firesale_currency',
			'paginate' => 'no'
		);

		$currencies = $this->streams->entries->get_entries($params);
		$data['currencies'] = $currencies['entries'];

		// Get assignments
		$query = $this->db->get('firesale_taxes_assignments')->result();

		$assignments = array();

		foreach ($query as $assignment)
		{
			$assignments[$assignment->currency_id][$assignment->tax_id] = $assignment->value;
		}

		foreach ($data['currencies'] as &$currency)
		{
			foreach ($data['taxes'] as $tax)
			{
				if (isset($assignments[$currency['id']][$tax['id']]))
				{
					$currency['taxes'][] = array_merge(array(
						'value' => $assignments[$currency['id']][$tax['id']]
					), $tax);
				}
				else
				{
					$currency['taxes'][] = array_merge(array(
						'value' => NULL
					), $tax);
				}
			}
		}

		$this->template->build('admin/taxes/assign', $data);
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
		}

		if ($redirect)
		{
			redirect('admin/firesale/taxes');
		}
	}
}
