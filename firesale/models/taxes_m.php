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
* @version master
* @link http://github.com/firesale/firesale
*
*/

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

        // Get delete status
        foreach ($data['taxes'] AS $key => $tax) {
            $data['taxes'][$key]['can_delete'] = $this->can_delete($tax['id']);
        }

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

        foreach ($query as $assignment) {
            $assignments[$assignment->currency_id][$assignment->tax_id] = $assignment->value;
        }

        foreach ($data['currencies'] as &$currency) {
            foreach ($data['taxes'] as $tax) {
                if (isset($assignments[$currency['id']][$tax['id']])) {
                    $currency['taxes'][] = array_merge(array(
                        'value' => $assignments[$currency['id']][$tax['id']]
                    ), $tax);
                } else {
                    $currency['taxes'][] = array_merge(array(
                        'value' => number_format($currency['cur_tax'], 2)
                    ), $tax);
                }
            }
        }

        return $data;
    }

    public function can_delete($band)
    {

        // Get usage count
        $query = $this->db->where('tax_band', $band)
                          ->get('firesale_orders_items');

        // return
        return ( $query->num_rows() || $band == 1 ? false : true );
    }

    public function taxes_for_currency($currency = FALSE)
    {
        $user_currency = $this->session->userdata('currency') ? $this->session->userdata('currency') : 1;
        $currency = is_numeric($currency) ? $currency : $user_currency;

        $currency = $this->db->get_where('firesale_currency', array(
            'id' => $currency
        ));

        if ($currency->num_rows()) {
            $default_tax = $currency->row()->cur_tax;

            $taxes = $this->db->get('firesale_taxes')->result();
            $tax_assignments = $this->db->get_where('firesale_taxes_assignments', array(
                'currency_id' => $currency->row()->id
            ))->result();

            foreach ($tax_assignments as $assignment)
                $assignments[$assignment->tax_id] = $assignment->value;

            foreach ($taxes as &$tax) {
                if (isset($assignments[$tax->id])) {
                    $tax->value = $assignments[$tax->id];
                } else {
                    $tax->value = $default_tax;
                }
            }

            return $taxes;
        } else {
            return FALSE;
        }
    }

    public function get_percentage($tax_band = 1, $currency = FALSE)
    {
        if ( ! $currency)
            $currency = $this->session->userdata('currency') ? $this->session->userdata('currency') : 1;

        $query = $this->db->get_where('firesale_taxes_assignments', array(
            'tax_id'      => $tax_band,
            'currency_id' => $currency
        ));

        if ($query->num_rows()) {
            return $query->row()->value;
        } else {
            $this->load->model('currency_m');

            return $this->currency_m->get($currency)->cur_tax;
        }
    }
}
