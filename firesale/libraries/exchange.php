<?php

	class exchange
	{

		// Variables
		protected $ci     = NULL;
		protected $base   = 'GBP';
		protected $app_id = '';
		protected $url    = 'http://openexchangerates.org/api/latest.json?app_id=';

		public function __construct()
		{

			// Get CI Instance
			$this->ci =& get_instance();

			// Add to settings soon
			$this->app_id = '8fc03975a2324ca4b20cae70e987b706';// $this->ci->settings->get('firesale_exchange_key');
			$this->url    = $this->url.$this->app_id;
			
			// Get data
			$json = $this->get($this->url);
			
			// Check data
			if( $json !== FALSE )
			{
				$this->process($json);
			}

		}

		public function get($url)
		{

			// Get data
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$data = curl_exec($ch);
			curl_close($ch);

			// Convert
			$json = json_decode($data);

			// Check data
			if( ! isset($json->error) )
			{
				return $json;
			}

			// Problem
			return FALSE;
		}

		public function process($json)
		{

			// Variables
			$base = $this->ci->settings->get('firesale_currency') or $this->base;

			// Loop all currencies
			foreach( $json->rates AS $cur => $rate )
			{

				// Do we need to cross-convert?
				if( $json->base != $this->base )
				{
					$new  = ( $json->rates->$cur * ( 1 / $json->rates->$base ) );
					$rate = round($new, 6);
				}

				// Insert or update settings


				// Debug
				// echo $cur.' - '.$rate.'<br />';

			}

		}

	}