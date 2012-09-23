<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_routes extends Admin_Controller
{

	public $section = 'routes';

	public function __construct()
	{

		parent::__construct();

		// Load libraries, drivers & models
		$this->load->driver('Streams');
		$this->load->model('routes_m');

		// Get the stream
		$this->stream = $this->streams->streams->get_stream('firesale_routes', 'firesale_routes');

	}

	public function index()
	{

		// Add page data
		$this->template->title(lang('firesale:title') . ' ' . lang('firesale:sections:routes'))
					   ->set($this->data);

		// Fire events
		Events::trigger('page_build', $this->template);

		// Build page
		$this->template->build('admin/routes/index');

	}

	public function create()
	{

		// Variables
		$fields = $this->streams_m->get_stream_fields($this->stream->id);
		$input  = $this->input->post();
		$skip   = array('btnAction');
		$extra  = array(
            'return'          => 'admin/firesale/routes/edit/-id-',
            'success_message' => lang('firesale:routes:add_success'),
            'failure_message' => lang('firesale:routes:add_error'),
            'title'           => lang('firesale:routes:new')
        );

		// Build the fields
		$this->data->fields = $this->fields->build_fields($fields, $input, 'new', NULL, $skip, $extra);
		
		// Posted
		if( $this->input->post('btnAction') == 'save' OR $this->input->post('btnAction') == 'save_exit' )
		{

			// Set rules
			$this->fields->set_rules($fields, 'new', $skip, false, null);

			// Run validation
			if( $this->form_validation->run() === TRUE )
			{

				// Save it
				$id = $this->routes_m->create($input);

				// Success message
				$this->session->set_flashdata('success', $extra['success_message']);

				// Redirect
				if( $input['btnAction'] == 'save_exit' )
				{
					redirect('admin/firesale/routes');
				}
				else
				{
					redirect('admin/firesale/routes/edit/'.$id);
				}

			}

			// Failed validation
			$this->session->set_flashdata('error', $extra['failure_message']);
			redirect('admin/firesale/routes/create');

		}

		// Build the page
        $this->template->title(lang('firesale:routes:new'))
        			   ->set($this->data)
        			   ->build('admin/routes/create');
	
	}

	public function edit($id)
	{


		// Build the page
        $this->template->title(lang('firesale:routes:edit'))
        			   ->set($this->data)
        			   ->build('admin/routes/edit');
	}

}
