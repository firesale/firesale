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
* @package firesale/search
* @author FireSale <support@getfiresale.org>
* @copyright 2013 Moltin Ltd.
* @version master
* @link http://github.com/firesale/firesale
*
*/

class Events_Firesale_search
{

    protected $ci;

    public function __construct()
    {

        $this->ci =& get_instance();

        $this->ci->load->model('firesale_search/search_m');

        Events::register('clear_cache', array($this, 'clear_cache'));
        Events::register('firesale_dashboard', array($this, 'firesale_dashboard_search'));
    }

    public function clear_cache()
    {
        $this->ci->pyrocache->delete_all('search_m');
    }

    public function firesale_dashboard_search()
    {

        // Get search results
        $results = $this->ci->db->order_by('sales, count')->limit(10)->get('firesale_search')->result_array();

        // Build and return data
        return array(
            'id'      => 'search',
            'title'   => lang('firesale:sections:search'),
            'content' => $this->ci->parser->parse('firesale_search/admin_searchterms', array('results' => $results), true),
            'assets'  => array()
        );
    }

}
