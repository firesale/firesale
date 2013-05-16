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
* @package firesale/dispatch_notes
* @author FireSale <support@getfiresale.org>
* @copyright 2013 Moltin Ltd.
* @version master
* @link http://github.com/firesale/firesale
*
*/

class Events_Firesale_dispatch_notes
{
	protected $ci;

	public function __construct()
	{
		$this->ci =& get_instance();

		// Load the dispatch notes model
		$this->ci->load->model('firesale_dispatch_notes/notes_m');

		Events::register('clear_cache', array($this, 'clear_cache'));
		Events::register('button_build', array($this, 'button_build'));
	}

    public function clear_cache()
    {
        $this->ci->pyrocache->delete_all('codes_m');
    }

    public function button_build($template)
    {
    	// Only interested in order admin
    	if ( $this->ci->module == 'firesale' and $this->ci->controller == 'admin_orders' ) {

    		// Show on dashboard
    		if ( $this->ci->uri->rsegment(2) == 'index' ) {
    			$template->buttons  = ( isset($template->buttons) ? $template->buttons : '' );
    			$template->buttons .= '<button type="submit" name="btnAction" value="print" class="btn green">'.lang('firesale:notes:print').'</button>';
    		}

    		// Check for post
    		if ( $this->ci->input->post('btnAction') == 'print' ) {
    			$ids = $this->ci->input->post('action_to');
    			$uri = implode('/', $ids);
    			redirect('admin/firesale_dispatch_notes/print_notes/'.$uri);
    		}

    	}
    	
    }
    
}
