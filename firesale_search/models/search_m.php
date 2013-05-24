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
* @package firesale/search
* @author FireSale <support@getfiresale.org>
* @copyright 2013 Moltin Ltd.
* @version master
* @link http://github.com/firesale/firesale
*
*/

class Search_m extends MY_Model
{
    public $selected = FALSE;
    public $fired    = FALSE;

    public function __construct()
    {

        parent::__construct();

        $this->_table = 'firesale_products';

    }

    public function get_cat_dropdown($current = NULL)
    {

        $all_cats 	  = $this->db->select('id, slug, title')->order_by('ordering_count')->get('firesale_categories')->result_array();
        $cats     	  = array();
        $cats['all']  = 'Any Category';

        while ( list($key, $row) = each($all_cats) ) {
            $cats[$row['slug']] = $row['title'];
            if ($current !== NULL AND $row['slug'] == $current) {
                $this->selected = $row['slug'];
            }
        }

        return $cats;
    }

    public function check_category($term)
    {

        $term		= strtolower(trim($term));
        $categories = $this->db->select('id')->where("LOWER(`title`) = '{$term}'")->get('firesale_categories')->result_array();

        if ( count($categories) == 1 ) {
            return $categories[0]['id'];
        } else {
            return FALSE;
        }

    }

    public function perform_search($category, $term, $start = 0, $count, $order, $getcount = FALSE)
    {

        $category = urldecode(trim($category));
        $term     = urldecode(trim($term));

        $term = $this->db->escape('*'.$term.'*');
        $sql  = "SELECT p.*, c.`id` AS `cat_id`, c.`title` AS `cat_title`, MATCH(p.`title`, p.`description`) AGAINST({$term} IN BOOLEAN MODE) AS `weight`
                FROM `" . SITE_REF . "_firesale_products` AS p
                INNER JOIN `" . SITE_REF . "_firesale_products_firesale_categories` AS pc ON pc.`row_id` = p.`id`
                INNER JOIN `" . SITE_REF . "_firesale_categories` AS c ON c.`id` = pc.`firesale_categories_id`
                WHERE p.`status` = 1";

        if ($category !== 'all') {
            $sql .= "
                AND c.`slug` = {$this->db->escape($category)}";
        }

        $sql .= "
                GROUP BY p.`slug`
                HAVING `weight` > 0\n";

        if ($getcount == TRUE) {
            $result = $this->db->query($sql);

            return $result->num_rows();
        } else {

            if ( is_array($order) ) {
                $sql .= "
                        ORDER BY p.`{$order['by']}` {$order['dir']}
                        LIMIT " . (int) $start . ", " . (int) $count;
            } else {
                $sql .= "
                        ORDER BY `weight` DESC
                        LIMIT " . (int) $start . ", " . (int) $count;
            }

            $result = $this->db->query($sql);

            if ( $result->num_rows() ) {
                $products = $result->result_array();

                return $products;
            }
        }

        return FALSE;
    }

    public function update_terms($term)
    {

        // Sales tracking via search
        $this->session->set_userdata(array('term' => $term));

        // Update database terms
        $query = $this->db->select('id, count')->where("LOWER(`term`)", $term)->get('firesale_search');
        if ( $query->num_rows() ) {
            $result = $query->row();
            $this->db->where("id", $result->id)->update('firesale_search', array('count' => ( $result->count + 1 )));
        } else {
            $this->db->insert('firesale_search', array('term' => strtolower($term), 'count' => 1, 'sales' => 0));
        }

    }

    public function order_complete($data)
    {

        // Check for session data
        if ( $term = $this->session->userdata('term') AND !$this->fired ) {

            // Get search term
            $term   = strtolower(trim($term));
            $query  = $this->db->select('id, sales')->where("LOWER(`term`)", $term)->get('firesale_search');
            $result = $query->row();

            // Update sales
            $this->db->where("id", $result->id)->update('firesale_search', array('sales' => ( $result->sales + 1 )));

            // Remove session data
            $this->session->unset_userdata('term');

            // Fired
            $this->fired = TRUE;
        }

    }

}
/* End of file */
