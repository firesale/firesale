<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Attributes_m extends MY_Model
{

    public function create($title, $get_id = false)
    {

        // Check title
        if( strlen($title) > 0 ) {

            // Check doesn't exist
            $results = $this->db->where('title', $title)->get('firesale_attributes');
            $id      = 0;

            // Insert it
            if( !$results->num_rows() ) {

                $this->db->insert('firesale_attributes', array('title' => $title));
                $id = $this->db->insert_id();

            } else if( $get_id == true ) {
                
                $result = current($results->result_array());
                $id     = $result['id'];
            }

            // Clear and return
            $this->pyrocache->delete_all('attributes_m');
            $this->pyrocache->delete_all('products_m');
            return $id;
        }

        // Failed or invalid
        return 0;
    }

    public function build_dropdown()
    {

        // Variables
        $attributes = $this->db->select('id, title')->order_by('title')->get('firesale_attributes')->result_array();
        $drop  = array('0' => '--- '.lang('firesale:attributes:labels:select').' ---');

        // Loop and assign
        foreach( $attributes AS $attribute ) {
            $drop[$attribute['id']] = $attribute['title'];
        }

        return $drop;
    }

    public function current_attributes($row_id, $stream = 'firesale_products')
    {

        // Load required items
        $this->load->driver('Streams');

        // Variables
        $stream = $this->streams->streams->get_stream($stream, $stream);
        $where  = array('stream_id' => $stream->id, 'row_id' => $row_id);

        // Get it
        $results = $this->db->select('title, value, attribute_id AS `key`')
                            ->from('firesale_attributes AS a')
                            ->where($where)
                            ->join('firesale_attributes_assignments AS aa', 'aa.attribute_id = a.id')
                            ->order_by('ordering_count', 'asc')
                            ->get();

        if( $results->num_rows() ) {
            $data = $results->result_array();
            return $data;
        }

        return array();
    }

}
