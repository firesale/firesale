<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Firesale
{
	private   $_CI;
	protected $sections = array();
	public 	  $elements = array();
	public    $assets   = array();
	public    $roles	= array('shipping' => NULL);

	public function __construct()
	{
		// Get an instance of CodeIgniter
		$this->_CI =& get_instance();
	}
	
	public function info($info, $lang_file = NULL)
	{
		// Load in the language file if one was specified
		if ($lang_file != NULL)
			$this->_CI->load->language($lang_file);
		
		// Is this module using the PyroCMS menu?
		if ($info['backend'] === TRUE && $info['firesale_core'] !== TRUE)
			return $info;
		
		// Lets check if the FireSALE core module has been loaded yet...
		if ( ! class_exists('Module_Firesale'))
			return $info;
		
		// Retrieve the FireSALE sub-modules
		$this->_CI->db->where("(`is_backend` = 0 OR `slug` = 'firesale')", NULL, FALSE)->order_by('CASE WHEN `slug`="firesale" THEN 0 ELSE 1 END', NULL, FALSE)->order_by('id', 'asc');
		$subs = $this->_CI->db->get_where('modules', array('menu' => 'FireSALE', 'installed' => '1', 'enabled' => '1'));

		if ($subs->num_rows())
		{
			foreach ($subs->result() as $module)
			{
				$class = 'Module_'.ucfirst($module->slug);

				if (class_exists($class))
				{
					// Instantiate the module
					$module_class = new $class;

					// Get this modules info (the FireSALE way)
					$module_info = $module_class->information();

					// Add the modules sections if it has any.
					if (isset($module_info['sections']) && is_array($module_info['sections']))
						$this->sections = array_merge($this->sections, $module_info['sections']);
					
					// Sorry settings, you're last!
					if (isset($this->sections['settings']))
					{
						$settings = $this->sections['settings'];
						unset($this->sections['settings']);
						$this->sections['settings'] = $settings;
					}
					
					// We don't want to run the following code if we're on the modules page.
					/*if( substr($this->_CI->uri->segment(2), 0, 8) == 'firesale' AND empty($_POST) )
					{
						// Keep the module title and desc the same
						if( !isset($name) && !isset($desc) )
						{
							
							$name = isset($module_info['name'][CURRENT_LANGUAGE]) ? $module_info['name'][CURRENT_LANGUAGE] : $module_info['name']['en'];
							$desc = isset($module_info['description'][CURRENT_LANGUAGE]) ? $module_info['description'][CURRENT_LANGUAGE] : $module_info['description']['en'];
						}
						
						if( substr($this->_CI->uri->segment(2), 0, 8) == 'firesale' && empty($_POST) )
						{
							$info['name'][CURRENT_LANGUAGE]        = $name;
							$info['description'][CURRENT_LANGUAGE] = $desc;
						}
					}*/
					
					// Register roles
					if( isset($module_info['role']) AND $this->roles[$module_info['role']] == NULL )
					{
						$this->roles[$module_info['role']] = array('module' => $module->slug, 'model' => strtolower($module_info['role']) . '_m');
					}

					// Register page elements
					if( isset($module_info['elements']) && is_array($module_info['elements']) )
					{
						$this->register_elements($module->slug, $module_info['elements']);
					}
					
				}
			}
		}
		
		// A little bonus... Select the correct tab so we don't need to use public $section as often
		foreach ($this->sections as $key => $section)
		{
			if (site_url($section['uri']) == current_url())
			{
				$this->_CI->template->set('active_section', $key);
				break;
			}
			elseif (isset($section['shortcuts']))
			{
				foreach ($section['shortcuts'] as $shortcut)
				{
					if (strripos(current_url(), $shortcut['uri']))
					{
						$this->_CI->template->set('active_section', $key);
						break 2;
					}
				}
			}
		}
		
		$info['sections'] = $this->sections;

		return $info;
	}
	
	function register_elements($module, $module_info)
	{
	
		foreach( $module_info AS $section => $elements )
		{

			if( !array_key_exists($section, $this->elements) )
			{
				$this->elements[$section] = array();
			}

			foreach( $elements AS $element )
			{
	
				if( !array_key_exists($element['slug'], $this->elements[$section]) )
				{
					$this->elements[$section][$element['slug']] = array('content' => "{{ {$module}:{$element['function']} }}", 'title' => $element['title']);
				}
				
				if( isset($element['assets']) AND !empty($element['assets']) )
				{
					$this->register_assets($section, $module, $element['assets']);
				}
			}

		}
	
	}
	
	// Register page assets
	function register_assets($page, $module, $assets)
	{
	
		if( !isset($this->assets[$page]) )
		{
			$this->assets[$page] = array();
		}

		foreach( $assets AS $asset )
		{
			$this->assets[$page][$asset['file']] = array($asset['type'], $module);
		}
	
	}
	
	// Retrieve page assets
	function retrieve_assets($page, &$parent)
	{
	
		if( isset($this->assets[$page]) )
		{
		
			$dir = BASE_URL . 'addons/shared_addons/modules/';
			
			while( list($key, $options) = each($this->assets[$page]) )
			{
	
				Asset::add_path($options[1], $dir . $options[1] . '/');
				$func = 'append_' . $options[0];
				$parent->template->$func($options[1] . '::' . $key);
			
			}
	
		}
		
	}

}
