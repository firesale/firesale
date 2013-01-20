<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Events_Firesale
{

    protected $ci;

    public function __construct()
    {

        $this->ci =& get_instance();

        // register the events
        Events::register('public_controller', array($this, 'public_controller'));

    }

    public function public_controller()
    {

        // Update currency after an hour has passed since last update to api
        if ( ( time() - $this->ci->settings->get('firesale_currency_updated') ) > 3600 ) {
            // Load required items
            $this->ci->load->library('firesale/exchange');
        }

    }

}
