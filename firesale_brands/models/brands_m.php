<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brands_m extends MY_Model
{

    protected $cache = array();

    public function get($id_slug)
    {

        // Check cache
        if ( array_key_exists($id_slug, $this->cache) ) {
            return $this->cache[$id_slug];
        }

        // Variables
        $type = ( 0 + $id_slug > 0 ? 'id' : 'slug' );

        // Set query paramaters
        $params	 = array(
                    'stream' 	=> 'firesale_brands',
                    'namespace'	=> 'firesale_brands',
                    'where'		=> "{$type} = '{$id_slug}' AND status = '1'",
                    'limit'		=> '1'
                   );

        // Get entries
        $brands = $this->streams->entries->get_entries($params);

        // Check entries
        if ( count($brands['entries']) == 1 ) {

            // Get brand
            $brand = current($brands['entries']);

            // Get images
            if ( $folder = $this->products_m->get_file_folder_by_slug($brand['slug']) ) {
                $query = $this->db->select('id, path')
                                   ->from('files')
                                   ->where('folder_id', $folder->id)
                                     ->get();
                $brand['images'] = $query->result_array();
            }

            // Return it
            return $brand;
        }

        // Nothing found
        return FALSE;
    }

    public function get_products($brand, $perpage, $start)
    {

        // Build query
        $query = $this->db->select('id')
                          ->from('firesale_products')
                          ->where('brand', $brand)
                          ->order_by('title', 'asc')
                          ->limit($perpage, $start)
                          ->get();

        // Check for results
        if ( $query->num_rows() ) {

            // Get results
            $results = $query->result_array();

            // Loop
            foreach ($results AS &$product) {
                // Get product
                $product = $this->products_m->get_product($product['id']);
            }

            // Return
            return $results;
        }

        // No results
        return FALSE;
    }

    public function get_count($brand)
    {

        // Build query
        $query = $this->db->select('id')
                          ->from('firesale_products')
                          ->where('brand', $brand)
                          ->get();

        return $query->num_rows();
    }

}
