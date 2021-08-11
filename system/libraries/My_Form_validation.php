<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class MY_Form_validation extends CI_Form_validation {
	 protected $CI;
	 function __construct() {
		 parent::__construct();
		 // reference to the CodeIgniter super object 
		 $this->CI =& get_instance();
	 }

	function edit_unique($value, $params)
    {
        $this->set_message('edit_unique', "This %s is already in use!");
        list($table, $field, $current_id) = explode(".", $params);
        $result = $this->CI->db->where($field, $value)->get($table)->row();
        return ($result && $result->id != $current_id) ? FALSE : TRUE;
    }
}
