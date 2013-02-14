<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Events_Firesale
{

    protected $ci;

    public function __construct()
    {

        $this->ci =& get_instance();

        // register the events
        Events::register('public_controller', array($this, 'public_controller'));
        Events::register('clear_cache', array($this, 'clear_cache'));

    }

    public function public_controller()
    {
        // Update currency after an hour has passed since last update to api
        if ( ( time() - $this->ci->settings->get('firesale_currency_updated') ) > 3600 ) {
            // Load required items
            $this->ci->load->library('firesale/exchange');
        }

    }

    public function clear_cache()
    {
        $this->ci->pyrocache->delete_all('address_m');
        $this->ci->pyrocache->delete_all('cart_m');
        $this->ci->pyrocache->delete_all('categories_m');
        $this->ci->pyrocache->delete_all('currency_m');
        $this->ci->pyrocache->delete_all('modifier_m');
        $this->ci->pyrocache->delete_all('orders_m');
        $this->ci->pyrocache->delete_all('products_m');
        $this->ci->pyrocache->delete_all('routes_m');
        $this->ci->pyrocache->delete_all('sitemap_m');
        $this->ci->pyrocache->delete_all('taxes_m');
        $this->ci->cache->clean();
    }

}
