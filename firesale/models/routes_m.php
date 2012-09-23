<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Routes_m extends MY_Model
{

	/**
	 * Loads the parent constructor and gets an
	 * instance of CI.
	 *
	 * @return void
	 * @access public
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Creates a new route by adding it to the databaes and then adding it to the 
	 * routes file to be cached and used by the system.
	 *
	 * @param array $input POST input array
	 * @return Integer/Boolean ID or FALSE on success or failure
	 * @access public
	 */
	public function create($input)
	{

		// Remove btnAction
		unset($input['btnAction']);

		// Add extra information
		$input['created'] 		 = date("Y-m-d H:i:s");
		$input['created_by']     = $this->current_user->id;
		$input['ordering_count'] = 0;

		// Insert it
		if( $this->db->insert('firesale_routes', $input) )
		{

			// Get the new ID
			$id = $this->db->insert_id();

			// Update routes file
			$this->write($input['name'], $input['route'], $input['translation']);

			return $id;
		}

		return FALSE;
	}

	public function write($title, $route, $map)
	{

		// Variables
		$file    = APPPATH_URI.'config/routes.php';
		$content = file_get_contents($file);
		$before  = "\n/* End of file routes.php */";
		$regex   = "%(\n/\* FireSale - {$title} \*/\n.+?\n)%si";
		$map     = preg_replace('/\$([0-9]+)/si', '\$__$1', $map);
		$string  = "\n/* FireSale - {$title} */\n\$route['{$route}'] = '{$map}';\n";

		// Existing route
		if( preg_match($regex, $content) )
		{
			// Replace in string
			$content = preg_replace($regex, $string, $content);
		}
		else
		{
			// Add to string
			$content = str_replace($before, $string.$before, $content);
		}

		// Fix mapping
		$content = str_replace('$__', '$', $content);

		// Write it
		file_put_contents($file, $content);
	}

}
