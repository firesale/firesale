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
* @version dev
* @link http://github.com/firesale/firesale
*
*/

class Ajax extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Load required items
        $this->lang->load('firesale');
        $this->load->helper('general');

        // Add initial items
        $this->data = new stdClass();

        // Ensure request was made
        if ( ! $this->input->is_ajax_request() ) { show_404(); }
	}

}
