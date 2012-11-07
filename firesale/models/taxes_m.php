<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Taxes_m extends MY_Model
{
	public function get_assignments()
	{
		// Load streams
		$this->load->driver('Streams');

		// Get taxes
		$params = array(
			'stream'    => 'firesale_taxes',
			'namespace' => 'firesale_taxes',
			'paginate'  => 'no',
			'sort'      => 'asc'
		);

		$taxes = $this->streams->entries->get_entries($params);
		$data['taxes'] = $taxes['entries'];

		// Get currencies
		$params = array(
			'stream'    => 'firesale_currency',
			'namespace' => 'firesale_currency',
			'paginate'  => 'no',
			'sort'      => 'asc'
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

		return $data;
	}

	public function get_percentage($tax_band = 1, $currency = FALSE)
	{
		if ( ! $currency)
			$currency = $this->session->userdata('currency') ? $this->session->userdata('currency') : 1;

		$query = $this->db->get_where('firesale_taxes_assignments', array(
			'tax_id'      => $tax_band,
			'currency_id' => $currency
		));

		if ($query->num_rows())
		{
			return $query->row()->value;
		}
		else
		{
			$this->load->model('currency_m');
			
			return $this->currency_m->get($currency)->cur_tax;
		}
	}
}