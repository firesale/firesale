<?php defined('BASEPATH') or exit('No direct script access allowed');

class ajax extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Load required items
        $this->lang->load('firesale');
        $this->load->helper('general');

        // Add initial items
        $this->data = new stdClass();

        // Ensure request was made
        if ( ! $this->input->is_ajax_request() ) { show_404(); }
    }

    // check the variation exists based on options
    public function variation_check()
    {
        if ($this->input->post()) {
            $input   = $this->input->post();
            $options = $input['options'][0];
            sort($options);

            $stream = $this->streams->streams->get_stream('firesale_product_variations', 'firesale_product_variations');
            $product = $this->modifier_m->variation_exists($options, $stream->id);

            if ($product !== false) {
                $product = cache('products_m/get_product', $product, null, 1);

                $data = array(
                    'code'            => $product['code'],
                    'stock'           => $product['stock'],
                    'stock_status'    => $product['stock_status'],
                    'rrp_rounded'     => $product['rrp_rounded'],
                    'rrp_formatted'   => $product['rrp_formatted'],
                    'price_rounded'   => $product['price_rounded'],
                    'price_formatted' => $product['price_formatted'],
                    'diff_rounded'    => $product['diff_rounded'],
                    'diff_formatted'  => $product['diff_formatted']
                );

                echo json_encode($data);
                exit;

            }
        }
    }

}
