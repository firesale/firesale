<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Events_Firesale_dispatch_notes
{
	protected $ci;

	public function __construct()
	{
		$this->ci =& get_instance();

		// Load the dispatch notes model
		$this->ci->load->model('firesale_dispatch_notes/notes_m');

		Events::register('clear_cache', array($this, 'clear_cache'));
	}

    public function clear_cache()
    {
        $this->ci->pyrocache->delete_all('codes_m');
    }
    
}
/* End of file */