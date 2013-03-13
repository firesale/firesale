<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Plugin_Firesale extends Plugin
{

    public $version = '1.2.0';
    
    public $name = array(
        'en'    => 'FireSale'
    );

    public $description = array(
        'en'    => 'Core FireSale plugin methods'
    );

    public function __construct()
    {
        $this->load->library('files/files');
        $this->load->model('categories_m');
        $this->load->model('products_m');
        $this->load->model('routes_m');
        $this->load->model('taxes_m');
        $this->load->model('currency_m');
    }

    public function url()
    {

        // Variables
        $route = $this->attribute('route');
        $id    = $this->attribute('id');
        $after = $this->attribute('after');

        // Get the URL
        $url = $this->pyrocache->model('routes_m', 'build_url', array($route, $id), $this->firesale->cache_time);

        // Build the URL
        return BASE_URL.$url.$after;
    }

    public function module_installed()
    {

        // Variables
        $module = $this->attribute('slug', 'firesale');

        // Check
        $query = $this->db->select('id')->where('slug', $module)->where('installed', '1')->get('modules');

        if ( $query->num_rows() ) {
            return TRUE;
        }

        return FALSE;
    }

    public function categories()
    {

        // Variables
        $attributes = $this->attributes();
        $cache_key  = md5(BASE_URL.implode('|', $attributes));

        // Get from cache
        if ( ! $categories = $this->cache->get($cache_key) ) {

            // Build query
            $query = $this->db->select('id')
                              ->from('firesale_categories')
                              ->where('status', '1');

            // Add to query
            foreach ($attributes AS $key => $val) {

                switch ($key) {

                    case 'limit':
                        $query->limit($val);
                    break;

                    case 'order':
                        list($by, $dir) = explode(' ', $val);
                        $query->order_by($by, $dir);
                    break;

                    case 'empty':
                        if ($val == 'false') {
                            $this->db->where('(SELECT COUNT(id)
                                              FROM ' . $this->db->dbprefix('firesale_products_firesale_categories') . '
                                              WHERE firesale_categories_id=' . $this->db->dbprefix('firesale_categories.id') . ') >', 0);
                        }
                    break;

                    case 'parse_params':
                    break;

                    default:
                        $query->where($key, $val);
                    break;

                }

            }

            // Get categories
            $categories = $query->get()->result_array();

            // Loop and get objects
            foreach ($categories AS &$category) {
                $category = $this->pyrocache->model('categories_m', 'get_category', array($category['id']), $this->firesale->cache_time);
            }

            // Add to cache
            $this->cache->save($cache_key, $categories, $this->firesale->cache_time);
        }

        return $categories;
    }

    public function sub_categories()
    {

        // Return
        return $this->categories();
    }

    public function sub_sub_categories()
    {

        // Return
        return $this->categories();
    }

    public function products()
    {

        // Variables
        $attributes      = $this->attributes();
        $show_variations = (bool) $this->settings->get('firesale_show_variations');
        $cache_key       = md5(BASE_URL.implode('|', $attributes));

        // Get from cache
        if ( ! $results = $this->cache->get($cache_key) ) {

            // Children?
            if ( isset($attributes['category']) ) {
                $children   = $this->categories_m->get_children($attributes['category']);
                $children[] = $attributes['category'];
            }

            // Build query
            $query = $this->db->select('p.id')
                              ->from('firesale_products AS p')
                              ->join('firesale_products_firesale_categories AS pc', 'pc.row_id = p.id', 'inner')
                              ->join('firesale_categories AS c', 'c.id = pc.firesale_categories_id')
                              ->where('p.status', '1')
                              ->group_by('p.slug');

            if ( ! $show_variations)
                $query->where('is_variation', 0);

            // Add to query
            foreach ($attributes AS $key => $val) {

                switch ($key) {

                    case 'limit':
                        $query->limit($val);
                    break;

                    case 'order':
                        list($by, $dir) = explode(' ', $val);
                        $query->order_by('p.' . $by, $dir);
                    break;

                    case 'category':
                        $query->where_in('c.id', $children);
                    break;

                    case 'where':
                        $query->where($val, null, false);
                    break;

                    case 'parse_params':
                    break;

                    default:
                        $query->where($key, $val);
                    break;

                }

            }

            // Run query
            $results = $query->get()->result_array();

            // Get products
            foreach ($results AS &$result) {
                $result = $this->products_m->get_product($result['id']);
            }

            // Add to cache
            $this->cache->save($cache_key, $results, $this->firesale->cache_time);
        }

        // Return results
        return $results;
    }

    public function bestsellers()
    {
        $limit = $this->attribute('limit', 10);
        $order = $this->attribute('order', 'p.created asc');

        list($order, $order_dir) = explode(' ', $order);

        $result = $this->db
            ->select("COUNT(oo.product_id) as count, p.id")
            ->from('firesale_products AS p')
            ->join('firesale_orders_items AS oo', 'p.id = oo.product_id', 'left')
            ->order_by('count', 'desc')
            ->order_by($order, $order_dir)
            ->limit($limit)
            ->get()
            ->result();

        foreach ($result as &$product)
        {
            $product = $this->pyrocache->model('products_m', 'get_product', array($product->id), $this->firesale->cache_time);
        }

        return $result;
    }

    public function modifier_form()
    {

        // Variables
        $type    = $this->attribute('type', 'select'); // radio
        $product = $this->attribute('product');
        $product = $this->products_m->get_product($product);

        // Format data
        foreach ($product['modifiers'] as &$modifier) {
            $first = true;
            foreach ($modifier['variations'] as &$variation) {
                $variation['mod_id']   = $modifier['id'];
                $variation['selected'] = ( $first ? 'checked="checked" ' : '' );
                $first = false;
            }
        }

        // Assign data
        $data = new stdClass;
        $data->type      = $type;
        $data->product   = $product;
        $data->modifiers = $product['modifiers'];

        // Build form
        return $this->parser->parse('partials/modifier_form', $data, true);
    }

    public function cart()
    {

        // Load libraries
        $this->load->library('fs_cart');

        // Get currency
        $currency = $this->currency_m->get(( $this->session->userdata('currency') ? $this->session->userdata('currency') : 1 ));

        // Variables
        $data 		 	= new stdClass;
        $data->products = array();

        // Loop products in cart
        foreach ( $this->fs_cart->contents() as $id => $item ) {

            $product = $this->products_m->get($item['id']);

            if ($product !== FALSE) {

                $data->products[] = array(
                    'id'		=> $id,
                    'code' 		=> $product->code,
                    'slug'		=> $product->slug,
                    'quantity'	=> $item['qty'],
                    'name'		=> $item['name']
                );
            }

        }

        // Calculate prices
        $data->tax   = $this->currency_m->format_string($this->fs_cart->tax(), $currency, false);
        $data->sub   = $this->currency_m->format_string($this->fs_cart->subtotal(), $currency, false);
        $data->total = $this->currency_m->format_string($this->fs_cart->total(), $currency, false);
        $data->count = $this->fs_cart->total_items();

        // Retrun data
        return array($data);
    }

    public function currencies()
    {

        // Select all currencies
        $results = $this->db->select('id')->get('firesale_currency')->result_array();

        // Loop them
        foreach ($results AS &$currency) {
            // Retrieve data
            $currency = $this->currency_m->get($currency['id']);
        }

        return $results;
    }

    /**
     * Returns a PluginDoc array that PyroCMS uses 
     * to build the reference in the admin panel
     *
     * All options are listed here but refer 
     * to the Blog plugin for a larger example
     *
     * @return array
     */
    public function _self_doc()
    {
        $info = array(
            'url' => array(
                'description' => array(
                    'en' => 'Returns a formatted dynamic URL for a given route'
                ),
                'single'           => true,
                'double'           => false,
                'variables'        => '',
                'attributes'       => array(
                    'route'        => array(
                        'type'     => 'slug',
                        'flags'    => '',
                        'default'  => null,
                        'required' => true,
                    ),
                    'id'           => array(
                        'type'     => 'number',
                        'flags'    => '',
                        'default'  => null,
                        'required' => false,
                    ),
                    'after'        => array(
                        'type'     => 'text',
                        'flags'    => '',
                        'default'  => null,
                        'required' => false
                    )
                ),
            ),
            'module_installed' => array(
                'description' => array(
                    'en' => 'Returns true/false if a module is currently installed or not'
                ),
                'single'           => true,
                'double'           => false,
                'variables'        => '',
                'attributes'       => array(
                    'module'       => array(
                        'type'     => 'slug',
                        'flags'    => '',
                        'default'  => 'firesale',
                        'required' => false,
                    )
                ),
            ),
            'categories' => array(
                'description' => array(
                    'en' => 'The categories plugin is a great way to get a list of your categories for navigation, sidebars, or anywhere else you\'d like them. It has a number of options to get exactly what you want to display and provides a complete category object for you to display.'
                ),
                'single'           => false,
                'double'           => true,
                'variables'        => 'id|title|slug|description|images|links',
                'attributes'       => array(
                    'limit'        => array(
                        'type'     => 'number',
                        'flags'    => '',
                        'default'  => null,
                        'required' => false
                    ),
                    'order'        => array(
                        'type'     => 'text',
                        'flags'    => 'column asc|desc',
                        'default'  => 'id asc',
                        'required' => false
                    ),
                    'empty'        => array(
                        'type'     => 'text',
                        'flags'    => 'true|false',
                        'default'  => 'false',
                        'required' => false
                    ),
                    'column'       => array(
                        'type'     => 'text',
                        'flags'    => 'column="value"|column=">value"|column="<value"|etc.',
                        'default'  => null,
                        'required' => false
                    )
                )
            ),
            'sub_categories'  => array(
                'description'      => array(
                    'en'           => 'The same as categories, accepting the same attributes but usable within the categories plugin (overcomes a lex bug)'
                ),
                'single'           => false,
                'double'           => true,
                'variables'        => 'id|title|slug|description|images|links',
                'attributes'       => array(
                    'parent'       => array(
                        'type'     => 'number',
                        'flags'    => '',
                        'default'  => null,
                        'required' => false
                    )
                )
            ),
            'products'  => array(
                'description'      => array(
                    'en'           => 'Returns an array of products based on your dynamic attributes (much like categories)'
                ),
                'single'           => false,
                'double'           => true,
                'variables'        => 'id|code|title|slug|rrp|rrp_tax|price|price_tax|description|snippet|images|status|stock|stock_status|price_formatted|price_tax_formatted|rrp_formatted|rrp_tax_formatted',
                'attributes'       => array(
                    'limit'        => array(
                        'type'     => 'number',
                        'flags'    => '',
                        'default'  => null,
                        'required' => false
                    ),
                    'order'        => array(
                        'type'     => 'text',
                        'flags'    => 'column asc|desc',
                        'default'  => 'id asc',
                        'required' => false
                    ),
                    'column'       => array(
                        'type'     => 'text',
                        'flags'    => 'column="value"|column=">value"|column="<value"|etc.',
                        'default'  => null,
                        'required' => false
                    )
                )
            )
        );
    
        return $info;
    }

}
