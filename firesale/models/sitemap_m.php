<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sitemap_m extends MY_Model
{

    public function assign($data, &$doc)
    {

        if( $data and ! empty($data) ) {

            foreach( $data as $item ) {

                $node = $doc->addChild('url');
                $node->addChild('loc', $item['url']);

                if ($item['updated']) {
                    $node->addChild('lastmod', date(DATE_W3C, $item['updated']));
                }

            }

        }

    }

    public function retrieve($type, $table)
    {

        // Get data
        $query = $this->db->select('id, updated')
                          ->from($table)
                          ->where('status', '1')
                          ->order_by('ordering_count')
                          ->get();

        // Check for data
        if( $query->num_rows() ) {

            // Get results
            $results = $query->result_array();

            // Loop and format
            foreach( $results as &$result ) {
                $result['updated'] = strtotime($result['updated']);
                $result['url']     = site_url();
                $result['url']    .= $this->pyrocache->model('routes_m', 'build_url', array($type, $result['id']), $this->firesale->cache_time);
            }

            return $results;
        }

        // Nothing found
        return false;
    }

}
