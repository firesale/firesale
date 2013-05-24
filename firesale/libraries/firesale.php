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

class firesale
{

    protected $sections    = array();
    private $_CI         = null;
    public $elements    = array();
    public $assets      = array();
    public $roles       = array('shipping' => NULL);
    public $cache_time  = 86400;

    public function __construct()
    {
        // Get an instance of CodeIgniter
        $this->_CI =& get_instance();
        $this->_CI->load->driver('cache', array('adapter' => ( function_exists('apc_fetch') ? 'apc' : 'file' ), 'backup' => 'file'));
        $this->_CI->lang->load('firesale/firesale');
        $this->_CI->load->helper('firesale/gateway');
    }

    public function is_installed()
    {

        if ( ! function_exists('module_exists') or module_exists('firesale')) {

            $installed = $this->_CI->db->where('installed', 1)
                                       ->where('slug', 'firesale')
                                       ->count_all_results('modules');

            if ( $installed ) {
                return TRUE;
            }
        }

        // Not installed
        $this->_CI->session->set_flashdata('error', lang('firesale:install:not_installed'));
        redirect('admin/modules');
    }

}
