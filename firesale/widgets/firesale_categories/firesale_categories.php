<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Widget_FireSale_Categories extends Widgets
{

    // Details
    public $title       = 'FireSale Categories';
    public $description = 'Display Categories in a structured tree list';
    public $author      = 'Jamie Holdroyd';
    public $website     = 'http://www.getfiresale.org';
    public $version     = '1.1.0';
 
    // Form Fields
    public $fields = array(
        'title'  => array('field' => 'title', 'label' => 'Title', 'rules' => 'required'),
        'parent' => array('field' => 'parent', 'label' => 'Parent', 'rules' => 'numeric')
    );
 
    // Element Build
    public function run($options)
    {

        // Load in the model
        $this->load->model('firesale/categories_m');

        // Set query paramaters
        $params = array(
                    'stream'    => 'firesale_categories',
                    'namespace' => 'firesale_categories',
                    'order_by'  => 'ordering_count',
                    'sort'      => 'asc',
                    'where'     => "status = '1'"
                  );

        // Parent set?
        if( $options['parent'] != 0 )
        {
            $params['where'] .= " AND parent = '{$options['parent']}'";
        }

        // Get all categories
        $categories = $this->categories_m->generate_streams_tree($params);

        // Store the feed items
        return array('cats' => $categories, 'controller' => $this);
    }
 
    // Options
    public function form()
    {

        // Get all categories
        $this->load->model('firesale/categories_m');
        $categories = array('0' => '-----') + $this->categories_m->dropdown_values();

        // Return
        return array('categories' => $categories);
    }

}