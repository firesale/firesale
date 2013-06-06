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

class Modifier_m extends MY_Model
{
    private $cache_mods = array();
    private $cache_vars = array();

    public function cart_variation($options)
    {
        // Variables
        $stream = $this->streams->streams->get_stream('firesale_product_variations', 'firesale_product_variations');
        $post   = $_POST;

        // Loop through all options
        foreach ($options['options'] as $i => $opts ) {

            // Get/Set defaults
            $modifiers     = $this->pyrocache->model('modifier_m', 'get_modifiers', array($options['prd_code'][$i]), $this->firesale->cache_time);
            $post['price'] = 0;
            $ids           = array();

            // Loop through these options
            foreach ( $opts as $mod => $var) {

                // Get variations
                $modifier = $modifiers[$mod];

                // Check type
                if ($modifier['type']['key'] == '1') {
                    $variation = $modifier['variations'][$var];
                    $ids[] = $var;
                } elseif ($modifier['type']['key'] == '3') {
                    $variation      = $modifier['variations'][$var];
                    $post['price'] += $variation['price'];
                }

                // Change options
                $post['options'][$i][$mod] = array(
                    'mod_id' => $modifier['id'],
                    'var_id' => ( isset($variation) ? $variation['id'] : '' ),
                    'type'   => $modifier['type']['key'],
                    'title'  => $modifier['title'],
                    'value'  => ( isset($variation) ? $variation['title'] : $var ),
                    'price'  => $variation['price']
                );

                // Unset before next loop
                unset($modifier);
                unset($variation);
            }

            // Get correct ID for options
            if ( ! empty($ids) ) {
                $post['prd_code'][$i] = $this->variation_exists($ids, $stream->id);
            }
        }

        // Retrun
        return $post;
    }

    public function get_modifiers($product)
    {

        // Check cache
        if ( array_key_exists($product, $this->cache_mods) ) {
            return $this->cache_mods[$product];
        }

        // Variables
        $params = array(
            'stream'    => 'firesale_product_modifiers',
            'namespace' => 'firesale_product_modifiers',
            'where'     => "parent = '{$product}'",
            'order_by'  => 'ordering_count',
            'sort'      => 'asc'
        );

        // Get the modifiers
        $modifiers = $this->streams->entries->get_entries($params);
        $tmp = array();

        // Check total
        if ($modifiers['total'] > 0) {

            // Get the variations
            foreach ($modifiers['entries'] as &$modifier) {
                $modifier['variations'] = $this->get_variations($modifier['id']);
                $tmp[$modifier['id']]   = $modifier;
            }

            $modifiers['entries'] = $tmp;

            // Add into cache
            $this->cache_mods[$product] = $modifiers['entries'];

            return $modifiers['entries'];
        }

        // Nothing found
        return array();
    }

    public function get_variations($parent)
    {

        // Check cache
        if ( array_key_exists($parent, $this->cache_vars) ) {
            return $this->cache_vars[$parent];
        }

        // Variables
        $return     = array();
        $tmp        = array();
        $currency   = ( $this->session->userdata('currency') ? $this->session->userdata('currency') : $this->settings->get('firesale_currency') );
        $currency   = $this->pyrocache->model('currency_m', 'get', array($currency), $this->firesale->cache_time);
        $variations = $this->db->select('v.*, vp.firesale_products_id AS product')
                               ->from('firesale_product_variations AS v')
                               ->join('firesale_product_variations_firesale_products AS vp', 'vp.row_id = v.id', 'left')
                               ->where('v.parent', $parent)
                               ->order_by('v.ordering_count', 'asc')
                               ->get()
                               ->result_array();

        foreach ($variations as &$variation) {

            // Format difference
            $before = ( substr($variation['price'], 0, 1) == '-' ? '-' : ( 0 + $variation['price'] > 0 ? '+' : '' ) );
            $price  = str_replace('-', '', $variation['price']);

            // Assign variables
            $variation['difference'] = $before.$this->currency_m->format_string($price, $currency);
            $variation['product']    = $this->pyrocache->model('products_m', 'get_product', array($variation['product'], null, true), $this->firesale->cache_time);

            // Reassign with id as key
            $tmp[$variation['id']] = $variation;
        }

        // Reassign
        $variations = $tmp;

        // Check total
        if (count($variations) > 0) {
            // Add into cache
            $this->cache_vars[$parent] = $variations;

            return $variations;
        }

        // Nothing found
        return array();
    }

    public function edit_variations($row, $input)
    {

        // Variables
        $stream = $this->streams->streams->get_stream('firesale_product_variations', 'firesale_product_variations');
        $tax    = ( 100 + $this->taxes_m->get_percentage() ) / 100;

        // Get all products that are part of this variation
        $query = $this->db->select('firesale_products_id')
                          ->where('row_id', $row->id)
                          ->where('firesale_product_variations_id', $stream->id)
                          ->get('firesale_product_variations_firesale_products');

        // Check for results
        if ( $query->num_rows() ) {

            // Get results
            $variations = $query->result_array();

            // Loop through them
            foreach ($variations as $variation) {

                // Get the product details
                $product = $this->products_m->get_product($variation['firesale_products_id'], null, true);
                $update  = array();

                // Edit price
                $diff = ( $input['price'] - $row->price );
                $update['price']     = round(( $product['price'] + $diff ), 2);
                $update['price_tax'] = round(( $update['price'] / $tax ), 2);

                // Edit title
                $update['title'] = str_replace(' '.$row->title, ' '.$input['title'], $product['title']);

                // Edit code
                $old = strtoupper(substr(str_replace(' ', '', $row->title), 0, 2));
                $new = strtoupper(substr(str_replace(' ', '', $input['title']), 0, 2));
                $update['code'] = str_replace($old, $new, $product['code']);

                // Update the product
                $this->db->where('id', $product['id'])->update('firesale_products', $update);
            }

        }

    }

    public function edit_price($product, $price, $rrp)
    {
        $stream = $this->streams->streams->get_stream('firesale_product_variations', 'firesale_product_variations');

        // Get all products that are part of this variation
        $query = $this->db->select('p.id, v.price, p.tax_band')
                          ->from('firesale_product_modifiers AS m')
                          ->join('firesale_product_variations as v', 'm.id = v.parent', 'inner')
                          ->join('firesale_product_variations_firesale_products as pv', 'v.id = pv.row_id')
                          ->join('firesale_products as p', 'p.id = pv.firesale_products_id', 'inner')
                          ->where('m.parent', $product->id)
                          ->where('pv.firesale_product_variations_id', $stream->id)
                          ->get();

        // Check for results
        if ( $query->num_rows() ) {
            foreach ($query->result_array() as $variation) {

                // Calculate pre tax prices
                $tax       = $this->taxes_m->get_percentage($variation['tax_band']);
                $tax       = (100+$tax)/100;
                $rrp_tax   = ($rrp + $variation['price'])/$tax;
                $price_tax = ($price + $variation['price'])/$tax;
                $mod       = $this->currency_m->format_price($price_tax, $rrp_tax);

                // Build update array
                $update = array();
                $update['price']     = round($mod['price']+0.004, 3);
                $update['price_tax'] = round($mod['price_tax']+0.004, 3);
                $update['rrp']       = round($mod['rrp']+0.004, 3);
                $update['rrp_tax']   = round($mod['rrp_tax']+0.004, 3);

                // Update the product variation
                $this->db->where('id', $variation['id'])->update('firesale_products', $update);

            }
        }

    }

    public function delete_modifier($id)
    {

        // Get modifier type
        $row = $this->db->select('type')->where('id', $id)->get('firesale_product_modifiers')->row();

        // Check type
        if ($row->type == '1') {

            // Select variations
            $results = $this->db->where('parent', $id)->get('firesale_product_variations')->result_array();

            if ( ! empty($results) ) {
                foreach ($results as $result) {
                    $this->delete_variation($result['id']);
                }
            }

        }

        // Delete this
        return $this->db->where('id', $id)->delete('firesale_product_modifiers');
    }

    public function delete_variation($id)
    {

        // Variables
        $stream = $this->streams->streams->get_stream('firesale_product_variations', 'firesale_product_variations');

        // Delete associated products
        $this->delete_variation_products($id);

        // Delete remaining references
        $this->db->where('row_id', $id)->where('firesale_product_variations_id', $stream->id)->delete('firesale_product_variations_firesale_products');

        // Delete from variations
        return $this->db->where('id', $id)->delete('firesale_product_variations');
    }

    public function delete_variation_products($id)
    {

        // Variables
        $stream = $this->streams->streams->get_stream('firesale_product_variations', 'firesale_product_variations');

        // Get all products that are part of this variation
        $query = $this->db->select('firesale_products_id')
                          ->where('row_id', $id)
                          ->where('firesale_product_variations_id', $stream->id)
                          ->get('firesale_product_variations_firesale_products');

        // Check for results
        if ( $query->num_rows() ) {

            // Get results
            $variations = $query->result_array();

            // Loop through them
            foreach ($variations as $variation) {
                $action = $this->products_m->delete_product($variation['firesale_products_id'], FALSE);
            }

        }

    }

    public function get_products($product)
    {

        // Variables
        $stream     = $this->streams->streams->get_stream('firesale_product_variations', 'firesale_product_variations');
        $modifiers  = $this->get_modifiers($product);
        $variations = $this->possible_variations($modifiers);
        $products   = array();

        // Loop variations
        foreach ($variations AS $variation) {
            // Get products
            if ( $id = $this->variation_exists($variation, $stream->id) ) {
                $products[] = $this->products_m->get_product($id, null, true);
            }
        }

        return $products;
    }

    public function product_variations($product, $is_variation = false)
    {

        // Variables
        $stream = $this->streams->streams->get_stream('firesale_product_variations', 'firesale_product_variations');

        // Check if this is a variation
        // If so we must go bottom up rather than top down
        if ($is_variation) {

            // Get variations
            $query = $this->db->select('m.*, v.title AS var_title, v.price AS var_price, v.id AS var_id')
                              ->from('firesale_product_variations_firesale_products AS fp')
                              ->join('firesale_product_variations AS v', 'v.id = fp.row_id', 'inner')
                              ->join('firesale_product_modifiers AS m', 'm.id = v.parent', 'inner')
                              ->where('fp.firesale_products_id', $product)
                              ->where('fp.firesale_product_variations_id', $stream->id)
                              ->order_by('m.ordering_count', 'asc')
                              ->get();

            // Check results
            if ( $query->num_rows() ) {
                // Get results
                $results = $query->result_array();

                return $query->result_array();
            }

            return array();
        }

        // Otherwise just send back the modifiers
        return $this->get_modifiers($product);
    }

    public function build_variations($product, $stream)
    {

        // Variables
        $modifiers = $this->get_modifiers($product);

        // Build an array of the possible variations for this product
        $variations = $this->possible_variations($modifiers);

        // Loop through possible and determine what does and doesn't exist
        foreach ($variations AS $variation) {
            if ( ! $this->variation_exists($variation, $stream->id) ) {
                // Doesn't exist, create it
                $this->variation_create($product, $variation, $stream->id);
            }
        }

    }

    public function variation_create($product, $variations, $stream_id)
    {
        // Duplicate parent product
        $id = $this->products_m->duplicate_product($product);

        // Variables
        $update   = array();
        $original = $this->pyrocache->model('products_m', 'get_product', array($product), $this->firesale->cache_time);
        $product  = $this->pyrocache->model('products_m', 'get_product', array($id), $this->firesale->cache_time);
        $tax      = ( 100 + $this->taxes_m->get_percentage() ) / 100;

        // Update title
        $product['code']  = $original['code'].'-';
        $product['title'] = $original['title'].' -';
        $product['slug']  = $original['slug'];

        // Loop the variations
        foreach ($variations as $variation) {

            // Get the variation details
            $row = $this->db->where('id', $variation)->get('firesale_product_variations')->row();

            // Append the title and code
            $product['title'] .= ' '.$row->title;
            $product['code']  .= strtoupper(substr($row->title, 0, 2));
            $product['slug']  .= '-'.strtolower(url_title($row->title));

            // Rebuild the prices
            $product['price'] += $row->price;

            // Add to lookup table
            $lookup = array('row_id' => $variation, 'firesale_product_variations_id' => $stream_id, 'firesale_products_id' => $id);
            $this->db->insert('firesale_product_variations_firesale_products', $lookup);
        }

        // Add to update
        $update['title']        = $product['title'];
        $update['slug']         = $product['slug'];
        $update['code']         = $product['code'];
        $update['price']        = round($product['price'], 2);
        $update['price_tax']    = round(( $product['price'] / $tax ), 2);
        $update['is_variation'] = '1';

        // Perform update
        $status = $this->db->where('id', $id)->update('firesale_products', $update);

        // Just because
        Events::trigger('variation_created', array('product' => $update, 'variations' => $variations, 'stream_id' => $stream_id));

        return $status;
    }

    public function variation_exists($variations, $stream_id)
    {

        // Get initial ID
        $id = $variations[0];
        array_shift($variations);

        // Variables
        $sql = "SELECT fp_0.`firesale_products_id`
                FROM `".SITE_REF."_firesale_product_variations_firesale_products` AS `fp_0`";

        if ( ! empty($variations) ) {
            // Loop variations
            foreach ($variations as $key => $variation) {
                $key += 1;
                $sql .= "\nINNER JOIN `" . SITE_REF . "_firesale_product_variations_firesale_products` AS `fp_{$key}` ON ( `fp_{$key}`.`row_id` = {$variation} AND `fp_{$key}`.`firesale_products_id` = fp_0.`firesale_products_id` )";
            }
        }

        // Append where
        $sql .= "\nWHERE fp_0.`row_id` = {$id}\nAND fp_0.`firesale_product_variations_id` = {$stream_id}";

        // Run query
        $query = $this->db->query($sql);

        // Check for results
        if ( $query->num_rows() ) {
            $row = $query->row();

            return $row->firesale_products_id;
        }

        // Not found
        return FALSE;
    }

    public function possible_variations($modifiers)
    {

        // Variables
        $options = array();

        // Pull out all variation information
        foreach ($modifiers as $modifier) {
            if ($modifier['type']['key'] == '1') {
                foreach ($modifier['variations'] as $variation) {
                    if ( ! array_key_exists($modifier['id'], $options) ) {
                        $options[$modifier['id']] = array();
                    }
                    $options[$modifier['id']][] = $variation['id'];
                }
            }
        }

        return $this->array_cartesian_product($options);
    }

    public function single_product_stock($product_id, $options, $qty)
    {
        // Variables
        $opts = array();

        // Ensure we have options
        if ( empty($options) ) {
            return true;
        }

        // Loop the options we have
        foreach ( $options as $option ) {

            // Check for the right type
            if ( $option['type'] != '3' ) {
                continue;
            }

            // Get stock level
            $product = $this->db->select('p.id, p.title, p.stock, p.stock_status')
                                ->from('firesale_product_variations AS v')
                                ->join('firesale_products AS p', 'p.id = v.product', 'inner')
                                ->where('v.id', $option['var_id'])
                                ->get()
                                ->row();

            // Check product is set, status and quantity
            if ( $product and $product->stock_status != 6 ) {

                // Add to options
                if ( ! array_key_exists($product->id, $opts) ) {
                    $opts[$product->id] = array(
                        'title' => $product->title,
                        'stock' => $product->stock,
                        'qty'   => 0
                    );
                }

                // Increase qty
                $opts[$product->id]['qty'] += $qty;
            }
        }

        // Check options
        if ( ! empty($opts) ) {
            foreach ( $opts as $option ) {
                if ( $option['stock'] < $option['qty'] ) {
                    return $option['title'];
                }
            }
        }

        // Seems okay!
        return true;
    }

    // Stack overflow
    // http://stackoverflow.com/questions/8567082/how-to-generate-in-php-all-combinations-of-items-in-multiple-arrays
    public function array_cartesian_product($arrays)
    {
        $result = array();
        $arrays = array_values($arrays);
        $sizeIn = sizeof($arrays);
        $size   = $sizeIn > 0 ? 1 : 0;

        foreach ($arrays as $array) {
            $size = $size * sizeof($array);
        }

        for ($i = 0; $i < $size; $i ++) {

            $result[$i] = array();

            for ($j = 0; $j < $sizeIn; $j ++) {
                array_push($result[$i], current($arrays[$j]));
            }

            for ($j = ($sizeIn -1); $j >= 0; $j --) {
                if (next($arrays[$j])) {
                    break;
                } elseif (isset ($arrays[$j])) {
                    reset($arrays[$j]);
                }
            }

        }

        return $result;
    }

}
