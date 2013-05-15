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
* @package firesale/brands
* @author FireSale <support@getfiresale.org>
* @copyright 2013 Moltin Ltd.
* @version master
* @link http://github.com/firesale/firesale
*
*/

class Events_Firesale_brands
{

    protected $ci;

    public function __construct()
    {

        $this->ci =& get_instance();

        $this->ci->load->model('firesale_brands/brands_m');

        // register the events
        Events::register('clear_cache', array($this, 'clear_cache'));

    }

    public function clear_cache()
    {
        $this->ci->pyrocache->delete_all('brands_m');
    }

}
