<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Events_Firesale_search
{

    protected $ci;

    public function __construct()
    {

        $this->ci =& get_instance();

        $this->ci->load->model('firesale_search/search_m');

        Events::register('clear_cache', array($this, 'clear_cache'));

    }

    public function clear_cache()
    {
        $this->ci->pyrocache->delete_all('search_m');
    }

}
