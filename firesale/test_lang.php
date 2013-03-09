<?php

	// Because it's required by many files
	define('BASEPATH', 'NONE');

	// Variables
	$directory = 'language';
	$base      = 'english';
	$files     = ListFiles($directory);
	$original  = array();

	// Loop files
	foreach( $files AS $file )
	{

		// Variables
		list($folder, $language, $filename) = explode('/', $file);

		// Check is php
		if( substr($file, -3) == 'php' AND $language != $base )
		{

			// Include base
			if( !array_key_exists($file, $original) )
			{
				include(str_replace($language, $base, $file));
				$original[$filename] = $lang;
				unset($lang);
			}

			// Compare
			include($file);
			$compare = array_diff_key($original[$filename], $lang);

			// Output
			echo '<pre>';
				echo '<h2>'.ucwords($language).' - '.$filename.'</h2>';
				echo '<strong>'.ucwords($language).'</strong>: '.count($lang).'<br />';
				echo '<strong>'.ucwords($base).'</strong>: '.count($original[$filename]).'<br />';
				print_r($compare);
			echo '</pre>';

			// Unset before next loop
			unset($lang);
		}

	}

	// Random pre-built function since I was too lazy to do one again myself
	function ListFiles($dir) {

	    if($dh = opendir($dir)) {

	        $files = Array();
	        $inner_files = Array();

	        while($file = readdir($dh)) {
	            if($file != "." && $file != ".." && $file[0] != '.') {
	                if(is_dir($dir . "/" . $file)) {
	                    $inner_files = ListFiles($dir . "/" . $file);
	                    if(is_array($inner_files)) $files = array_merge($files, $inner_files); 
	                } else {
	                    array_push($files, $dir . "/" . $file);
	                }
	            }
	        }

	        closedir($dh);
	        return $files;
	    }
	}
