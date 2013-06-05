<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

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

class Products_m extends MY_Model
{
    /**
     * Contains the current database table name
     *
     * @var string
     * @access public
     */
    public $_table = 'firesale_products';

    /**
     * Contains an array of the possible stock status options
     *
     * @var array
     * @access public
     */
    public $_stockstatus = array(
        1 => 'firesale:label_stock_in',
        2 => 'firesale:label_stock_low',
        3 => 'firesale:label_stock_out',
        4 => 'firesale:label_stock_order',
        5 => 'firesale:label_stock_ended',
        6 => 'firesale:label_stock_unlimited'
    );

    /**
     * Loads the parent constructor and gets an
     * instance of CI.
     *
     * @return void
     * @access public
     */
    public function __construct()
    {
        parent::__construct();

        // Load required items
        $this->load->model('firesale/categories_m');
        $this->load->helper('firesale/general');
        $this->load->model('firesale/currency_m');
        $this->load->model('firesale/modifier_m');
    }

    /**
     * Builds an array of the require keys and values for a dropdown of products,
     * the array is built with the following structure:
     *
     *    Product ID => Product Title
     *
     * Note: this function doesn't actually build the dropdown, just the array...
     * misleading title huh?
     *
     * @return array An array in the above format, sorry still no dropdown
     * @access public
     */
    public function build_dropdown()
    {

        $_products = $this->db->select('id, slug, title')->order_by('title')->get($this->_table)->result_array();
        $products  = array('-1' => lang('firesale:label_filterprod'));

        foreach ($_products AS $product) {
            $products[$product['id']] = $product['title'];
        }

        return $products;
    }

    /**
     * Builds a dropdown of the available product status' for products and returns
     * the dropdown string with the optionally passed ID preselected.
     *
     * @param  integer $id (Optional) Pre-selected key in the dropdown
     * @return string  The HTML dropdown string
     * @access public
     */
    public function status_dropdown($id = NULL)
    {

        // Variables
        $list       = array();
        $list['-1'] = lang('firesale:label_filterstatus');
        $list['0']  = lang('firesale:label_draft');
        $list['1']  = lang('firesale:label_live');

        // Build the dropbown
        $drop = form_dropdown('status', $list, $id);

        // Return it
        return $drop;
    }

    /**
     * Builds a dropdown of the available stock status' for products and returns
     * the dropdown string with the optionally passed ID preselected.
     *
     * @param  integer $id (Optional) Pre-selected key in the dropdown
     * @return string  The HTML dropdown string
     * @access public
     */
    public function stock_status_dropdown($id = NULL)
    {

        // Variables
        $list = array('-1' => lang('firesale:label_filtersstatus'));
        $drop = '';

        // Loop products
        foreach ($this->_stockstatus AS $key => $status) {
            $list[$key] = lang($status);
        }

        // Build the dropbown
        $drop = form_dropdown('stock_status', $list, $id);

        // Return it
        return $drop;
    }

    /**
     * Using Streams and a number of other functions to gather categories and images
     * this function builds a complete Product array for use in a number of places
     * and pages for display.
     *
     * @param  integer or string $id_slug The ID or Slug of a Product to query
     * @return array             A complete product array or FALSE on nothing found
     * @access public
     */
    public function get_product($id_slug, $currency = NULL, $show_variations = false)
    {

        if (! $show_variations) {
            $show_variations = (bool) $this->settings->get('firesale_show_variations');
        }

        // Variables
        $user_currency = $this->session->userdata('currency');
        $currency      = $currency ? $currency : ($user_currency ? $user_currency : NULL);

        // Set params
        $params = array(
            'stream'    => 'firesale_products',
            'namespace' => 'firesale_products',
            'where'     => SITE_REF."_firesale_products.slug = '{$id_slug}'",
            'limit'     => '1',
            'order_by'  => 'id',
            'sort'      => 'desc'
        );

        // Display variations?
        if (! $show_variations) {
            $params['where'] .= ' AND is_variation = 0';
        }

        // Get entries
        $product = $this->streams->entries->get_entries($params);

        // Try ID instead
        if ($product['total'] <= 0) {
            $params['where'] = SITE_REF."_firesale_products.id = '{$id_slug}'";
            $product         = $this->streams->entries->get_entries($params);
        }

        // Check exists
        if ($product['total'] > 0) {

            // Get and format product data
            $product                 = current($product['entries']);
            $product['snippet']      = truncate_words($product['description']);
            $product['category']     = $this->get_categories($product['id']);
            $product['image']        = $this->get_single_image($product['id']);
            $product['images']       = $this->get_images($product['slug']);

            // New product?
            $duration = ( time() - (int)$this->settings->get('firesale_new') );
            $product['new'] = ( $product['created'] > $duration ? '1' : '0' );

            // Get variation and modifer data
            $product['is_variation'] = $this->db->select('is_variation')->where('id', $product['id'])->get('firesale_products')->row()->is_variation;
            $product['modifiers']    = $this->pyrocache->model('modifier_m', 'product_variations', array($product['id'], $product['is_variation']), $this->firesale->cache_time);

            // Format product pricing
            $pricing = $this->pyrocache->model('currency_m', 'format_price', array($product['price_tax'], $product['rrp_tax'], $product['tax_band']['id'], $currency), $this->firesale->cache_time);
            $product = array_merge($product, $pricing);

            // Check images
            if ( $product['is_variation'] == '1' and empty($product['images']) ) {
                $product['images'] = $this->get_parent_images($product['id']);
                $product['image']  = ( isset($product['images'][0]) ? $product['images'][0]->id : false );
            }

            // Append data from other modules
            $results = Events::trigger('product_get', $product, 'array');
            foreach ($results as $result) {
                $product = array_merge($product, $result);
            }

            // Return
            return $product;
        }

        // Nothing?
        return false;
    }

    /**
     * Gets a list of product IDs to match the current query paramaters.
     *
     * @param  array   $filter A series of fields and values to filter results on
     * @param  integer $start  (Optional)
     * @param  integer $limit  (Optional)
     * @return array   An array of product IDs, FALSE on nothing found
     * @access public
     */
    public function get_products($filter, $start = 0, $limit = 0)
    {

        // Show variations?
        $show_variations = (bool) $this->settings->get('firesale_show_variations');

        // Build initial query
        $query = $this->db->select('p.id')
                          ->from($this->_table . ' AS p')
                          ->group_by('p.id');

        // Add limits if set
        if ($start > 0 OR $limit > 0) {
            $query->limit($limit, $start);
        }

        // Add filtering
        foreach ($filter AS $key => $value) {
            if ( $key == 'category' AND (int) $value > 0 ) {
                $query->join('firesale_products_firesale_categories AS pc', 'p.id = pc.row_id', 'inner')
                      ->where('pc.firesale_categories_id', $value);
            } elseif ($key == 'search' AND strlen($value) > 0 ) {
                $query->where("( p.`title` LIKE '%{$value}%' OR p.`code` LIKE '%{$value}%' OR p.`description` LIKE '%{$value}%' )");
            } elseif ($key == 'sale' AND $value == '1') {
                $query->where('p.price < p.rrp');
            } elseif ($value == 'asc' or $value == 'desc' ) {
                $query->order_by('p.'.$key, $value);
            } elseif ($key == 'price') {
                list($from, $to) = explode('-', $value);
                $query->where('p.price >=', $from)
                      ->where('p.price <=', $to);
            } elseif ($key == 'new' ) {
                $new = (int)$this->settings->get('firesale_new');
                $query->where('p.created >=', date('Y-m-d H:i:s', ( time() - $new )));
            } elseif( strlen($value) > 0 AND $value != '-1' ) {
                $query->where($key, $value);
            }
        }

        // Display variations?
        if (! $show_variations) {
            $query->where('p.is_variation', '0');
        }

        // Add to params if required
        if ( $this->uri->segment('1') != 'admin' ) {
            $query->where('p.status', '1');
        }

        // Run query
        $results = $query->get();

        // Check results
        if ( $results->num_rows() ) {
            return $results->result_array();
        }

        // Nothing?
        return FALSE;
    }

    /**
     * Generates the minimum and maximum available pricing for products.
     *
     * @return array The min and max price
     * @access public
     */
    public function price_min_max()
    {

        // Variables
        $return = array('min' => '0.00', 'max' => '0.00');

        // Run min query
        $query = $this->db->select('price')->order_by('price', 'asc')->limit('1')->get('firesale_products');

        // Check for min
        if ( $query->num_rows() ) {
            $results = current($query->result_array());
            $return['min'] = $results['price'];
        }

        // Run max query
        $query = $this->db->select('price')->order_by('price', 'desc')->limit('1')->get('firesale_products');

        // Check for max
        if ( $query->num_rows() ) {
            $results = current($query->result_array());
            $return['max'] = $results['price'];
        }

        return $return;
    }

    /**
     * Update the most basic elements of a product, used via the inline product
     * edit feature of the administration section of products.
     *
     * @param  array   $input An array of the POST vars
     * @return boolean TRUE or FALSE on success of failure
     * @access public
     */
    public function update_product($id, $input, $stream_id)
    {

        // Variables
        $product = $this->pyrocache->model('products_m', 'get_product', array($id), $this->firesale->cache_time);
        $tax     = $this->pyrocache->model('taxes_m', 'get_percentage', array($product['tax_band']['id']), $this->firesale->cache_time);
        $tax     = ( 100 + $tax ) / 100;
        $data    = array(
            'code'      => $input['id'],
            'title'     => $input['title'],
            'stock'     => $input['stock'],
            'price'     => $input['price'],
            'price_tax' => round(( $input['price'] / $tax ), 3)
        );

        // Update rrp and rrp_tax
        $data['rrp']     = $data['price'];
        $data['rrp_tax'] = $data['price_tax'];

        // Update stock status
        if ($data['stock'] == 0 and $product['stock_status']['key'] != 6 ) {
            $data['stock_status'] = 3;
        } elseif ($data['stock'] <= 10) {
            $data['stock_status'] = 2;
        }

        // Update
        if ( $id > 0 AND $this->db->where('id', $id)->update($this->_table, $data) ) {

            // Update categories
            if ( isset($input['parent']) AND !empty($input['parent']) ) {
                $categories = 'category_' . implode(',category_', $input['parent']);
                $this->update_categories($id, $stream_id, $categories);
            }

            // Clear cache
            Events::trigger('clear_cache');

            return TRUE;
        }

        return FALSE;
    }

    /**
     * Deletes a product, the images and Files folder related to it.
     *
     * @param  integer $id     The Product ID to delete
     * @param  boolean $images Delete images as well as product?
     * @return boolean TRUE or FALSE on success of failure
     * @access public
     */
    public function delete_product($id, $images = true)
    {

        // Get product basics
        $product = $this->db->select('id, slug')->where('id', $id)->get('firesale_products')->row();

        if ( $this->db->where('id', $product->id)->delete('firesale_products') ) {

            // Remove from categories
            $this->db->where('row_id', $product->id)->delete('firesale_products_firesale_categories');

            // Remove from variations
            $this->db->where('firesale_products_id', $product->id)->delete('firesale_product_variations_firesale_products');

            // Check remaining products with same slug
            $siblings = $this->db->select('id')->where('slug', $product->slug)->get('firesale_products');

            // Remove files folder
            if ( ! $siblings->num_rows() AND $product !== FALSE AND $images == TRUE ) {
                $folder = get_file_folder_by_slug($product->slug, 'product-images');
                if ($folder != FALSE) {
                    $images = Files::folder_contents($folder->id);
                    $images = $images['data']['file'];
                    foreach ($images AS $image) {
                        Files::delete_file($image->id);
                    }
                    Files::delete_folder($folder->id);
                }
            }

            return TRUE;
        }

        return FALSE;
    }

    /**
     * Deletes all products using the delete_product method, used during the
     * uninstall process to ensure all products and their images are deleted.
     *
     * @return boolean TRUE or FALSE depending on status
     * @access public
     */
    public function delete_all_products()
    {

        $products = $this->db->select('id, slug')->get($this->_table)->result_array();

        if ( count($products) > 0 ) {

            foreach ($products AS $product) {
                $this->delete_product($product['id'], $product['slug']);
            }

            return TRUE;
        }

        return FALSE;
    }

    /**
     * Duplicates a product and all of its' associated values, which also firing an
     * event for addon modules to tap into and copy their values too.
     *
     * @param  integer $id Product ID being duplicated
     * @return integer The created Product ID
     * @access public
     */
    public function duplicate_product($id)
    {

        // Get original details
        $original = current($this->db->where('id', $id)->get('firesale_products')->result_array());
        $cats     = $this->db->where('row_id', $id)->get('firesale_products_firesale_categories')->result_array();

        // Remove original id
        unset($original['id']);

        // Update fields
        $product           = $original;
        $count             = $this->db->like('title', $product['title'])->get('firesale_products')->num_rows();
        $product['title'] .= ' ('.( $count + 1 ).')';
        $product['slug']  .= '-'.( $count + 1 );
        $product['code']  .= '-'.( $count + 1 );

        // Insert it
        $this->db->insert('firesale_products', $product);
        $id = $this->db->insert_id();

        // Add category data
        foreach ($cats AS $cat) {
            unset($cat['id']);
            $cat['row_id'] = $id;
            $this->db->insert('firesale_products_firesale_categories', $cat);
        }

        // Get parent images
        $parent = get_file_folder_by_slug($original['slug'], 'product-images');
        $images = $this->db->where('folder_id', $parent->id)->get('files');

        // Clone them
        if ( $images->num_rows() ) {

            // Create folder
            $folder = $this->create_file_folder($parent->id, $product['title'], $product['slug']);
            $folder = (object)$folder['data'];

            // Loop and add images
            foreach ( $images->result_array() as $image ) {
                $image['id']        = substr(md5(microtime().rand(0,100000)), 0, 15);
                $image['folder_id'] = $folder->id;
                $this->db->insert('files', $image);
            }
        }

        // Fire events
        Events::trigger('clear_cache');
        Events::trigger('product_duplicated', array('original' => $product['id'], 'new' => $id));

        // Return ID
        return $id;
    }

    /**
     * Removes and creates core search indexing for a product.
     *
     * @param array $product Product data array
     * @param boolean [$add] Should this be added to the index
     * @access public
     */
    public function search($product, $add = false)
    {

        // Check version
        if (CMS_VERSION >= '2.2' and $product !== false) {

            // Load required items
            $this->load->model('search/search_index_m');

            // Try and remove existing item
            $this->search_index_m->drop_index('firesale', 'firesale:product', $product['id']);

            if ($add) {
                // Add to search
                $this->search_index_m->index(
                    'firesale',
                    'firesale:product',
                    'firesale:products',
                    $product['id'],
                    $this->pyrocache->model('routes_m', 'build_url', array('product', $product['id']), $this->firesale->cache_time),
                    $product['title'],
                    strip_tags($product['description']),
                    array(
                        'cp_edit_uri'   => 'admin/firesale/products/edit/'.$product['id'],
                        'cp_delete_uri' => 'admin/firesale/products/delete/'.$product['id'],
                        'keywords'      => ( isset($product['meta_keywords']) ? $product['meta_keywords'] : null ),
                    )
                );
            }

        }

    }

    /**
     * Updates the mulitple categories for a Product.
     * Required at the moment since the Streams Multiple field type doesn't seem
     * to do this automatically at the moment.
     *
     * @param  integer $product_id The Product ID to update
     * @param  integer $stream_id  The Stream ID of the products tables
     * @param  string  $categories The Categories to add to the product
     * @return void
     * @access public
     */
    public function update_categories($product_id, $stream_id, $categories)
    {

        // Drop current categories
        $this->db->where('row_id', $product_id)->delete('firesale_products_firesale_categories');

        // Get array of new categories
        $categories = explode(',', str_replace(' ', '', $categories));

        // Loop and insert
        for ( $i = 0; $i < count($categories); $i++ ) {

            // Get ID
            list($ignore, $id) = explode('_', $categories[$i]);

            // Check for valid category
            if ( ( 0 + $id ) > 0 AND $this->pyrocache->model('categories_m', 'get_category', array($id), $this->firesale->cache_time) !== FALSE ) {

                // Build data
                $data = array('row_id' => $product_id, 'firesale_products_id' => $stream_id, 'firesale_categories_id' => trim($id));

                // Check exists
                if ( $this->db->where($data)->get('firesale_products_firesale_categories')->num_rows() == 0 ) {
                    // Insert it
                    $this->db->insert('firesale_products_firesale_categories', $data);
                }

            }

        }

    }

    /**
     * Gets all of the Category information for a given Product ID.
     *
     * @param  integer $id The Product ID to query
     * @return array
     * @access public
     */
    public function get_categories($id)
    {

        // Build query
        $query = $this->db->select('firesale_categories_id AS id')
                          ->from('firesale_products_firesale_categories')
                          ->where('row_id', $id)
                          ->group_by('firesale_categories_id');

        // Run query
        $results = $query->get();

        // Check for categories
        if ( $results->num_rows() ) {

            // Get results
            $results    = $results->result_array();
            $categories = array();

            // Get categories
            foreach ($results AS $category) {
                $categories[] = $this->pyrocache->model('categories_m', 'get_category', array($category['id']), $this->firesale->cache_time);
            }

            // Return
            return $categories;
        }

        // Nothing?
        return array();
    }

    /**
     * Gets the refering Category for a product where available, otherwise defaults
     * to the primary (first) category of the product. Primarily used on the product
     * details pages for breadcrumbs and display purposes.
     *
     * @param  integer $product The Product ID to query
     * @return integer The ID of a Category
     * @access public
     */
    public function get_category($product)
    {

        // Variables
        $id = 0;

        // Get refering category
        $ref = $_SERVER['HTTP_REFERER'];
        $ref = explode('/', $ref);

        // Did we get referred?
        if ( count($product['category']) > 1 AND isset($ref[3]) AND $ref[3] == 'category' ) {
            // Check the product categories
            foreach ($product['category'] AS $category) {
                if ( $category['id'] == $this->session->userdata('category') ) {
                    $id = $category['id'];
                    break;
                }
            }
        }

        // Nothing set?
        if ($id == 0) {
            $id = $product['category'][0]['id'];
        }

        // Return
        return $id;
    }

    /**
     * Builds a category path for a given category, used primarily for the building
     * of breadcrumbs on both the product and category pages.
     *
     * @param  integer $cat     The Primary category to query
     * @param  boolean $reverse (Optional) Should the final result be reversed?
     * @param  array   $cats    (Protected) Used by the function when being recursive
     * @return array
     * @access public
     */
    public function get_cat_path($cat, $reverse = false, $cats = array())
    {

        $result = $this->db->select('id, parent, slug, title')->where("id = '{$cat}'")->get('firesale_categories')->result_array();
        $first  = ( count($cats) == 0 ? true : false );

        if ( count($result) > 0 ) {

            $cats[] = $result[0];

            if ($result[0]['parent'] != 0) {
                $cats = $this->get_cat_path($result[0]['parent'], $reverse, $cats);
            }

        }

        if ($first == true AND $reverse == true) {
            $cats = array_reverse($cats);
        }

        return $cats;
    }

    /**
     * Category fix to delete existing categories, format input, etc.
     *
     * @param  integer $product_id The product ID
     * @param  string  $category   Category input from POST
     * @return string  Formatted categories
     * @access public
     */
    public function category_fix($product_id, $category)
    {

        // Drop current categories
        $this->db->where('row_id', $product_id)->delete('firesale_products_firesale_categories');

        // Fix input
        $cats = explode(',', $category);
        $cats = array_unique($cats);

        return implode(',', $cats);
    }

    /**
     * Builds the breadcrumbs for a products categories.
     *
     * @param  array   $category  An array of categories to loop and assign
     * @param  string  &$template The template class to assign them to
     * @return integer The id of the parent category for the product
     * @access public
     */
    public function build_breadcrumbs($category, &$template)
    {

        // Variables
        $parent     = null;
        $categories = $this->get_cat_path($category, true);

        // Loop categories
        foreach ($categories as $category) {

            if ($parent === null) {
                $parent = $category['id'];
            }

            $url = $this->pyrocache->model('routes_m', 'build_url', array('category', $category['id']), $this->firesale->cache_time);
            $template->set_breadcrumb($category['title'], $url);
        }

        return $parent;
    }

    /**
     * Creates a new file folder within a given parent ID, Title and Slug.
     *
     * @param  integer $parent The parent folder ID
     * @param  string  $title  The title of the new folder
     * @param  string  $slug   The folder slug
     * @return array   or boolean
     * @access public
     */
    public function create_file_folder($parent, $title, $slug)
    {

        // Variables
        $return         = array();
        $original_slug  = $slug;
        $original_title = $title;

        // Create folder
        $data = Files::create_folder($parent, $title);

        // Check status
        if ($data['status']) {
            // Change slug
            $this->db->where('id', $data['data']['id'])->update('file_folders', array('slug' => $slug));
            $data['data']['slug'] = $slug;

            return $data;
        }

        // Failed
        return FALSE;
    }

    /**
     * Gets the first image ID available for a product to be used with Files.
     *
     * @param  integer $product The Product ID to query
     * @return integer The image ID or FALSE on no image
     * @access public
     */
    public function get_single_image($product)
    {
        $query = $this->db->select('f.id')
                          ->from('firesale_products AS p')
                          ->join('file_folders AS ff', 'p.slug = ff.slug', 'inner')
                          ->join('files AS f', 'ff.id = f.folder_id', 'inner')
                          ->where('p.id', $product)
                          ->or_where('p.code', $product)
                          ->order_by('f.sort', 'asc')
                          ->limit(1)
                          ->get();

        if ($query->num_rows())
            return $query->row()->id;

        return FALSE;
    }

    /**
     * Gets the all images for a product.
     *
     * @param  string $slug The Product slug to query
     * @return array the files for the give product
     * @access public
     */
    public function get_images($slug)
    {
        // Load required items
        $this->load->library('files/files');

        // Variables
        $folder = get_file_folder_by_slug($slug, 'product-images');
        $images = Files::folder_contents($folder->id);

        if (!empty($images['data']['file'])) {
            foreach ($images['data']['file'] AS $key => &$image) {
                $image->position = $key;
            }
        }

        return $images['data']['file'];
    }

    /**
     * Gets an array of the parent products images
     * 
     * @param  int $id The id of the product to query
     * @return array   The array of images, boolean false on not found
     */
    public function get_parent_images($id)
    {
        // Get parent slug
        $slug = $this->db->select('p.slug')
                         ->from('firesale_product_variations_firesale_products AS pvp', 'inner')
                         ->join('firesale_product_variations AS pv', 'pv.id = pvp.row_id', 'inner')
                         ->join('firesale_product_modifiers AS pm', 'pm.id = pv.parent', 'inner')
                         ->join('firesale_products AS p', 'p.id = pm.parent', 'inner')
                         ->where('pvp.firesale_products_id', $id)
                         ->group_by('p.slug')
                         ->get();

        // Check result
        if ( $slug->num_rows() ) {
            $slug = $slug->row()->slug;
            return $this->get_images($slug);
        }

        // Nothing found
        return false;
    }

    /**
     * Keeps the file folder for images in sync with changes made to a products
     * slug - otherwise upon updating a products slug the images would go missing.
     *
     * @param  string  $old The old slug for the folder
     * @param  string  $new The new slug for the folder
     * @return boolean TRUE or FALSE on success
     * @access public
     */
    public function update_folder_slug($old, $new)
    {

        // Variables
        $folder = get_file_folder_by_slug($old, 'product-images');

        // Found?
        if ($file !== FALSE AND $folder->id > 0) {

            if ( $this->db->where('id', $folder->id)->update('file_folders', array('slug' => $new)) ) {
                return TRUE;
            }

        }

        return FALSE;
    }

    /**
     * When uploading a new image for a product, based on the settings defined
     * in the admin section we can make the image square. This is a requirement
     * for many designs to keep things consistent and the same height/width
     * throughtout.
     *
     * @param  array   $status A status array from the files upload process
     * @return boolean TRUE or FALSE based on the status of the resize
     * @access public
     */
    public function make_square($status, $allow = array('jpeg', 'png') )
    {

        // Variables
        $id    = $status['data']['id'];
        $w     = $status['data']['width'];
        $h     = $status['data']['height'];
        $mime  = str_replace('image/', '', $status['data']['mimetype']);
        $path  = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . SITE_REF . '/files/' . $status['data']['filename'];

        // Build background colour
        $colour = str_replace('#', '', $this->settings->get('image_background', 'ffffff'));
        $colour = ( strlen($colour) == 3 ? $colour : '' ) . $colour;
        $bg     = array(
                    'r' => hexdec(substr($colour, 0, 2)),
                    'g' => hexdec(substr($colour, 2, 2)),
                    'b' => hexdec(substr($colour, 4, 2))
                );

        // Is it required?
        if ( $w != $h AND in_array($mime, $allow) ) {

            // Settings
            $size = ( $w > $h ? $w : $h );
            $img  = imagecreatetruecolor($size, $size);
            $bg   = imagecolorallocate($img, $bg['r'], $bg['g'], $bg['b']);
            $copy = 'imagecreatefrom' . $mime;
            $save = 'image' . $mime;
            $orig = $copy($path);
            $x    = ( $w != $size ? round( ( $size - $w ) / 2 ) : 0 );
            $y    = ( $h != $size ? round( ( $size - $h ) / 2 ) : 0 );

            // Build image
            imagefilledrectangle($img, 0, 0, $size, $size, $bg);
            imagecopy($img, $orig, $x, $y, 0, 0, $w, $h);
            $save($img, $path);
            imagedestroy($orig);
            imagedestroy($img);

            // Update files table
            $this->db->where('id', $id)->update('files', array('width' => $size, 'height' => $size));
        }

        return TRUE;
    }

}
