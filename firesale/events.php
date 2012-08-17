<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Events_Firesale
{
	protected $ci;
	
	public function __construct()
	{

		$this->ci =& get_instance();
		
		// register the events
		Events::register('product_created',    array($this, 'product_created'));
		Events::register('product_updated',    array($this, 'product_updated'));
		Events::register('product_delete',     array($this, 'product_deleted'));
		Events::register('product_duplicated', array($this, 'product_duplicated'));
		Events::register('product_viewed',     array($this, 'product_viewed'));
		Events::register('order_complete',     array($this, 'order_complete'));
		Events::register('cart_item_added',    array($this, 'cart_item_added'));
		Events::register('cart_updated',       array($this, 'cart_updated'));
		Events::register('page_build',         array($this, 'page_build'));
	
	}
	
	public function product_created($data)
	{
		
		$this->_run_firesale_events('product_created', $data);
	}

	public function product_updated($data)
	{
		
		$this->_run_firesale_events('product_updated', $data);
	}
		
	public function product_deleted($data)
	{
		
		$this->_run_firesale_events('product_deleted', $data);
	}

	public function product_duplicated($data)
	{
		
		$this->_run_firesale_events('product_duplicated', $data);
	}
	
	public function product_viewed($data)
	{

		$this->_run_firesale_events('product_viewed', $data);
	}
	
	public function order_complete($data)
	{
		
		$this->_run_firesale_events('order_complete', $data);
	}

	public function cart_item_added($data)
	{
		$this->_run_firesale_events('cart_item_added', $data);
	}

	public function cart_updated($data)
	{
		$this->_run_firesale_events('cart_updated', $data);
	}

	public function page_build($data)
	{
		$this->_run_firesale_events('page_build', $data);
	}

	
	public function _run_firesale_events($name, $data)
	{
		
		if( isset($this->ci->firesale->events[$name]) )
		{
			foreach( $this->ci->firesale->events[$name] AS $event )
			{
				$this->ci->load->model($event['model']);
				$ref = end(explode('/', $event['model']));
				$this->ci->$ref->$event['function']($data);
			}
		}
	
	}
	
}
