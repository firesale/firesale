<?php defined('BASEPATH') or exit('No direct script access allowed');

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
* @package firesale/shipping
* @author FireSale <support@getfiresale.org>
* @copyright 2013 Moltin Ltd.
* @version master
* @link http://github.com/firesale/firesale
*
*/

class admin extends Admin_Controller
{
    public $perpage = 30;
    public $stream  = NULL;
    public $section = 'shipping';

    public function __construct()
    {

        parent::__construct();

        // CH: Instantiate the StdClass object to fix E_STRICT errors
        $this->data = new StdClass;

        // Load libraries
        $this->load->driver('Streams');
        $this->lang->load('firesale_shipping/firesale');

        // Add metadata
        $this->template->append_css('module::shipping.css')
                       ->append_js('module::shipping.js')
                       ->append_metadata('<script type="text/javascript">' .
                                         "\n  var currency = '" . $this->settings->get('currency') . "';" .
                                         "\n</script>");

        // Get the stream
        $this->stream = $this->streams->streams->get_stream('firesale_shipping', 'firesale_shipping');

    }

    public function index()
    {

        // Set query paramaters
        $params	 = array(
                    'stream' 	=> 'firesale_shipping',
                    'namespace'	=> 'firesale_shipping',
                    'order_by'	=> 'id',
                    'sort'		=> 'desc'
                   );

        // Get stream data
        $options = $this->streams->entries->get_entries($params);

        // Assign variables
        $this->data->options    = $options['entries'];
        $this->data->pagination = $options['pagination'];

        // Build page
        $this->template->title(lang('firesale:title') . ' ' . lang('firesale:shipping:title'))
                       ->build('admin/index', $this->data);

    }

    public function create($id = NULL, $row = NULL)
    {

        // Check for post data
        if ( $this->input->post('btnAction') == 'save' ) {

            // Variables
            $input 	= $this->input->post();
            $skip	= array('btnAction');
            $extra 	= array(
                        'return' 			=> '/admin/firesale_shipping/edit/-id-',
                        'success_message'	=> lang('firesale:shipping:' . ( $id == NULL ? 'add' : 'edit' ) . '_success'),
                        'error_message'		=> lang('firesale:shipping:' . ( $id == NULL ? 'add' : 'edit' ) . '_error')
                      );

        } else {
            $input = FALSE;
            $skip  = array();
            $extra = array();
        }

        // Assign variables
        if ($row !== NULL) { $this->data = $row; }
        $this->data->fields = $this->fields->build_form($this->stream, ( $id == NULL ? 'new' : 'edit' ), ( $id == NULL ? $input : $row ), FALSE, FALSE, $skip, $extra);
        $this->data->id	    =  $id;

        // Build page
        $this->template->title(lang('firesale:title') . ' ' . lang('firesale:shipping:title'))
                       ->build('admin/create', $this->data);
    }

    public function edit($id)
    {

        // Get row
        if ( $row = $this->row_m->get_row($id, $this->stream, FALSE) ) {
            // Load form
            $this->create($id, $row);
        } else {
            $this->session->set_flashdata('error', lang('firesale:prod_not_found'));
            redirect('admin/firesale/products/create');
        }

    }

    public function delete($id = null)
    {

        $delete  = true;
        $options = $this->input->post('action_to');

        if ( $this->input->post('btnAction') == 'delete' ) {

            for ( $i = 0; $i < count($options); $i++ ) {

                if ( !$this->streams->entries->delete_entry($options[$i], 'firesale_shipping', 'firesale_shipping') ) {
                    $delete = false;
                }

            }

        } elseif ($id !== null) {

            if ( !$this->streams->entries->delete_entry($id, 'firesale_shipping', 'firesale_shipping') ) {
                $delete = false;
            }

        }

        if ($delete) {
            $this->session->set_flashdata('success', lang('firesale:prod_delete_success'));
        } else {
            $this->session->set_flashdata('error', lang('firesale:prod_delete_error'));
        }

        redirect('admin/firesale_shipping');

    }

}
/* End of file */
