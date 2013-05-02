<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Events_Firesale
{

    protected $ci;

    public function __construct()
    {

        $this->ci =& get_instance();

        // register the events
        Events::register('public_controller', array($this, 'public_controller'));
        Events::register('settings_updated', array($this, 'settings_updated'));
        Events::register('clear_cache', array($this, 'clear_cache'));
        Events::register('firesale_dashboard', array($this, 'firesale_dashboard_sales'));
        Events::register('firesale_dashboard', array($this, 'firesale_dashboard_stock'));
    }

    public function public_controller()
    {
        // Update currency after an hour has passed since last update to api
        if ( ( time() - $this->ci->settings->get('firesale_currency_updated') ) > 3600 ) {
            // Load required items
            $this->ci->load->library('firesale/exchange');
        }
    }

    public function settings_updated($settings)
    {

        // Add/remove override routes
        if ( isset($settings['firesale_dashboard']) ) {

            // Load required items
            $this->ci->lang->load('firesale/firesale');
            $this->ci->load->model('firesale/routes_m');

            // Add
            if ( $settings['firesale_dashboard'] == '1' ) {
                $this->ci->routes_m->write(lang('firesale:sections:dashboard'), 'admin', 'firesale/admin/index');
            // Remove
            } else {
                $this->ci->routes_m->remove(lang('firesale:sections:dashboard'));
            }
        }

        // Clear cache on currency change
        if ( isset($settings['firesale_currency']) or isset($settings['firesale_show_variations'])) {
            Events::trigger('clear_cache');
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
        $this->ci->pyrocache->delete_all('routes_m');
        $this->ci->pyrocache->delete_all('sitemap_m');
        $this->ci->pyrocache->delete_all('taxes_m');
        $this->ci->pyrocache->delete_all('row_m');
        $this->ci->pyrocache->delete_all('products_m');
        $this->ci->cache->clean();
    }

    public function firesale_dashboard_sales()
    {

        // Load required items
        $this->ci->load->model('firesale/dashboard_m');
        $this->ci->load->model('firesale/currency_m');

        // Variables
        $data          = array();
        $currency      = $this->ci->currency_m->get();
        $data['year']  = $this->ci->dashboard_m->sales_duration('month', 12, $currency);
        $data['month'] = $this->ci->dashboard_m->sales_duration('month', 1, $currency);
        $data['week']  = $this->ci->dashboard_m->sales_duration('day', 7, $currency);
        $data['day']   = $this->ci->dashboard_m->sales_duration('day', 1, $currency);

        // Assign data
        if ( $data['year'] !== false ) {
            $data['year']['sales']       = json_encode($data['year']['sales']);
            $data['year']['count']       = json_encode($data['year']['count']);
            $data['year']['currency']    = $currency->symbol;
        }

        // Build and return data
        return array(
            'id'      => 'sales',
            'title'   => lang('firesale:elements:product_sales'),
            'content' => $this->ci->parser->parse('firesale/admin/dashboard/productsales', $data, true),
            'assets'  => array(
                array('type' => 'js',  'file' => 'module::dashboard_productsales.js'),
                array('type' => 'css', 'file' => 'module::dashboard_productsales.css')
            )
        );
    }

    public function firesale_dashboard_stock()
    {

        // Variables
        $data              = array();
        $data['low_count'] = $this->ci->db->select("id")->where('stock_status', '2')->get('firesale_products')->num_rows();
        $data['out_count'] = $this->ci->db->select("id")->where('stock_status', '3')->get('firesale_products')->num_rows();
        $data['low_prods'] = $this->ci->db->select("code, title, stock, id, slug")->where('stock_status', '2')->order_by('stock', 'desc')->limit('5')->get('firesale_products')->result_array();
        $data['out_prods'] = $this->ci->db->select("code, title, stock, id, slug")->where('stock_status', '3')->order_by('stock', 'desc')->limit('5')->get('firesale_products')->result_array();

        // Build and return data
        return array(
            'id'      => 'stock',
            'title'   => lang('firesale:elements:low_stock'),
            'content' => $this->ci->parser->parse('firesale/admin/dashboard/lowstock', $data, true),
            'assets'  => array(
                array('type' => 'css', 'file' => 'module::dashboard_lowstock.css')
            )
        );
    }

}
