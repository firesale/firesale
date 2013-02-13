<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Events_Firesale_brands
{

    protected $ci;

    public function __construct()
    {

        $this->ci =& get_instance();

        // register the events
        Events::register('product_updated', array($this, 'product_updated'));

    }

    public function product_updated()
    {
        $this->ci->pyrocache->delete_all('brands_m');
    }

}
