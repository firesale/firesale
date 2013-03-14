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

        // Variables
        $data          = array();
        $currency      = $this->ci->settings->get('currency');
        $data['year']  = $this->ci->dashboard_m->sales_duration('month', 12);
        $data['month'] = $this->ci->dashboard_m->sales_duration('month', 1);
        $data['week']  = $this->ci->dashboard_m->sales_duration('day', 7);
        $data['day']   = $this->ci->dashboard_m->sales_duration('day', 1);

        // Assign data
        if ( $data['year'] !== false ) {
            $data['year']['sales']       = json_encode($data['year']['sales']);
            $data['year']['count']       = json_encode($data['year']['count']);
            $data['year']['currency']    = $currency;
            $data['year']['total_sales'] = $currency . number_format($data['year']['total_sales'], 2);
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
