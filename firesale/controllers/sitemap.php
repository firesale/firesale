<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Sitemap controller
 *
 * @author		Jamie Holdroyd
 * @author		Chris Harvey
 * @package		FireSale\Core\Controllers
 *
 */
class sitemap extends Public_Controller
{

    public function __construct()
    {
        parent::__construct();

        // Load required items
        $this->load->library('firesale');
        $this->load->model('firesale/routes_m');
        $this->load->model('firesale/sitemap_m');
    }

    public function xml()
    {

        // Variables
        $doc = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" />');

        // Add categories
        $categories = $this->pyrocache->model('sitemap_m', 'retrieve', array('category', 'firesale_categories'), $this->firesale->cache_time);
        $this->sitemap_m->assign($categories, $doc);

        // Add products
        $products = $this->pyrocache->model('sitemap_m', 'retrieve', array('product', 'firesale_products'), $this->firesale->cache_time);
        $this->sitemap_m->assign($products, $doc);

        // Fire event
        Events::trigger('sitemap_build', $doc);

        // Output sitemap
        $this->output->set_content_type('application/xml')->set_output($doc->asXML());
    }

}
