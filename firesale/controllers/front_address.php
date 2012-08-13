<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Front_address extends Public_Controller
{

	public function __construct()
	{
		parent::__construct();
		
		// Load models, lang, libraries, etc.
		$this->load->model('orders_m');
		$this->load->model('address_m');

		// Check for user
		$this->user = ( isset($this->current_user->id) ? $this->current_user->id : NULL );

		// Check user
		if( !$this->user )
		{
			// Redirect to login if no user
		}

	}
	
	public function index()
	{
		
		// Set query paramaters
		$params	 = array(
					'stream' 	=> 'firesale_addresses',
					'namespace'	=> 'firesale_addresses',
					'where'		=> "created_by = '{$this->user}' AND title != ''"
				   );
		
		// Get entries		
		$addresses = $this->streams->entries->get_entries($params);
	
		// Variables
		$this->data->total  	= $addresses['total'];
		$this->data->addresses  = $addresses['entries'];
		$this->data->pagination = $addresses['pagination'];
		
		// Add page content
		$this->template->title(lang('firesale:addresses:title'))
					   ->set_breadcrumb('Home', '/home')
					   ->set_breadcrumb(lang('firesale:addresses:title'), '/users/addresses')
					   ->set($this->data);

		// Fire events
		Events::trigger('page_build', $this->template);

		// Build page
		$this->template->build('addresses');

	}

	public function create()
	{

		// Variables
        $skip  = array('btnAction');
        $extra = array(
            'return' => 'users/addresses/edit/-id-',
            'success_message' => lang('faq:submit_success'),
            'failure_message' => lang('faq:submit_failure')
        );

		// Get the stream
		$this->data->mode   = 'new';
		$this->data->stream = $this->streams->streams->get_stream('firesale_addresses', 'firesale_addresses');
		$this->data->fields = $this->fields->build_form($this->data->stream, 'new', $this->input->post(), FALSE, FALSE, $skip, $extra);
		$this->data->fields[0]['required'] = '<span>*</span>';
		
		// Add page content
		$this->template->title(lang('firesale:addresses:title'))
					   ->set_breadcrumb('Home', '/home')
					   ->set_breadcrumb(lang('firesale:addresses:title'), '/users/addresses')
					   ->set($this->data);

		// Fire events
		Events::trigger('page_build', $this->template);

		// Build page
		$this->template->build('address_create');

	}

	public function edit($id)
	{

		// Variables
        $skip  = array('btnAction');
        $extra = array(
            'return' => 'users/addresses/edit/-id-',
            'success_message' => lang('faq:submit_success'),
            'failure_message' => lang('faq:submit_failure')
        );

		// Get the stream
		$this->data->mode   = 'new';
		$this->data->stream = $this->streams->streams->get_stream('firesale_addresses', 'firesale_addresses');
		$this->data->row    = $this->row_m->get_row($id, $this->data->stream, FALSE);

		// Check user
		if( $this->data->row AND $this->user == $this->data->row->created_by )
		{

			// Get fields
			$this->data->fields = $this->fields->build_form($this->data->stream, 'edit', $this->data->row, FALSE, FALSE, $skip, $extra);
			$this->data->fields[0]['required'] = '<span>*</span>';

			// Build page
			$this->template->title(lang('firesale:addresses:title'))
						   ->set_breadcrumb('Home', '/home')
						   ->set_breadcrumb(lang('firesale:addresses:title'), '/users/addresses')
						   ->build('address_create', $this->data);

		}
		else
		{
			set_status_header(404);
			echo Modules::run('pages/_remap', '404');
		}

	}

}
