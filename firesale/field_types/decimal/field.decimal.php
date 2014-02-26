<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Decimal Field Type
 *
 * @author		Ryan Thompson - AI Web Systems, Inc.
 * @copyright	Copyright (c) 208 - 2012, AI Web Systems, Inc.
 * @link		http://aiwebsystems.com
 */
class Field_decimal
{
    public $field_type_name			= 'Decimal';

    public $field_type_slug			= 'decimal';

    public $db_col_type				= 'float';

    public $version					= '1.2';

    public $custom_parameters		= array('decimal_places', 'default_value', 'min_value', 'max_value');

    public $author					= array('name'=>'Ryan Thompson - AI Web Systems, Inc.', 'url'=>'http://aiwebsystems.com');

    // --------------------------------------------------------------------------

    /**
     * Process before saving to database
     *
     * @access	public
     * @param	float
     * @param	object
     * @return	string
     */
    public function pre_save($input, $field)
    {

        // To High?
        if ( isset($field->field_data['max_value']) and strlen($field->field_data['max_value']) > 0 and $input > $field->field_data['max_value']) {
            return $field->field_data['max_value'];
        }

        // To Low?
        if ( isset($field->field_data['min_value']) and strlen($field->field_data['min_value']) > 0 and $input < $field->field_data['min_value']) {
            return $field->field_data['min_value'];
        }

        return $this->prep($input, $field->field_data['decimal_places']);
    }

    // --------------------------------------------------------------------------

    /**
     * Process before outputting
     *
     * @access	public
     * @param	float
     * @param	array
     * @return	float
     */
    public function pre_output($input, $data)
    {
        return $this->prep($input, $data['decimal_places']);
    }

    // --------------------------------------------------------------------------

    /**
     * Output the form input
     *
     * @access	public
     * @param	array
     * @param	int
     * @param	object
     * @return	string
     */
    public function form_output($data, $id = false, $field)
    {

        $options['name'] 	 = $data['form_slug'];
        $options['id']		 = $data['form_slug'];
        $options['value']	 = (!empty($data['value'])) ? $this->prep($data['value'], $field->field_data['decimal_places']) : $this->prep($field->field_data['default_value'], $field->field_data['decimal_places']);
        $options['class']    = 'decimal';
        $options['onchange'] = 'javascript:this.value=parseFloat(this.value.replace(/[^0-9\.]+/g,\'\')).toFixed('.$field->field_data['decimal_places'].');';

        return form_input($options);
    }

    /**
     * How many decimals do you want to maintain?
     *
     * @return	string
     */
    public function param_decimal_places( $value = 0 )
    {
        return form_input('decimal_places', $value);
    }

    /**
     * Min value?
     *
     * @return	string
     */
    public function param_min_value( $value = null )
    {
        return form_input('min_value', $value);
    }

    /**
     * Max value?
     *
     * @return	string
     */
    public function param_max_value( $value = null )
    {
        return form_input('max_value', $value);
    }

    // --------------------------------------------------------------------------

    /**
     * Strip it down to it's knickers
     *
     * @access	public
     * @param	float
     * @param	int
     * @return	float
     */
    private function prep($value, $decimals = 0)
    {
        return number_format((float) str_replace(',', '', $value), (int) $decimals, '.', false);
    }

}// eof field.cc_number.php
