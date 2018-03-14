<?php

//in php we dont start a class with public


class Validator
{
	//for storing form field names
	private $fields = array();
	
	//for storing errors for form fields
	private $field_errors = array();
	
	private $form_is_valid = TRUE;
	
	//creating the function addField
	
	public function addField($field_name)
	{
	$this->fields[] =$field_name;
	
	//initialize our error array by passing sub array into it
	$this->field_errors[$field_name] = array();
	}
	
	

	public function add_rule_to_field($field_name, $field_rule)
	{
		// e.g from array('min_length', 2)
		$rule_name = $field_rule[0];
	  date_default_timezone_set('Africa/Johannesburg'); 

		
		switch($rule_name)
		{
			case 'min_date':
			
			if(date('o-m-d',strtotime($_POST[$field_name])) < $field_rule[1])
			{
				$this->add_errors_to_field($field_name, ucwords($field_name). " cannot be less than {$field_rule[1]} in date.");
			}
			break;
			
			case 'min_time':
			$todaysDate= date('o-m-d', strtotime(date('o-m-d')));
			if(date('o-m-d',strtotime($_POST['appointmentDate'])) ==$todaysDate)
			{
			if(date('H:i:s',strtotime($_POST[$field_name])) < $field_rule[1])
			{
				$this->add_errors_to_field($field_name, ucwords($field_name). " cannot be less than ".date('H:iA',strtotime($field_rule[1]))." in time.");
			}
			}
			break;

			case 'min_visit_hour':
			
			if(date('H:i:s',strtotime($_POST[$field_name])) < $field_rule[1])
			{
				$this->add_errors_to_field($field_name, ucwords($field_name). " cannot be less than ".date('H:iA',strtotime($field_rule[1]))." in time.");
			}
			
			break;

			case 'max_visit_hour':
			
			if(date('H:i:s',strtotime($_POST[$field_name])) > $field_rule[1])
			{
				$this->add_errors_to_field($field_name, ucwords($field_name). " cannot more than ".date('H:iA',strtotime($field_rule[1]))." in time.");
			}
			
			break;
			
			case 'emptyDate':
			if(strlen($_POST[$field_name]) == 0)
			{
				$this->add_errors_to_field($field_name, ucwords($field_name). " cannot be empty");
			}
			break;
			
			case 'emptyTime':
			if(strlen($_POST[$field_name]) == 0)
			{
				$this->add_errors_to_field($field_name, ucwords($field_name). " cannot be empty");
			}
			break;
			
			case 'min_length':
			if(strlen($_POST[$field_name]) < $field_rule[1])
			{
				$this->add_errors_to_field($field_name, ucwords($field_name). " cannot be less than {$field_rule[1]} in length.");
			}
			break;
			
			case 'empty':
			if(strlen($_POST[$field_name]) == 0)
			{
				$this->add_errors_to_field($field_name, ucwords($field_name). " cannot be empty");
			}
			break;
			
			case 'max_length':
			if(strlen($_POST[$field_name]) > $field_rule[1])
			{
				$this->add_errors_to_field($field_name, ucwords($field_name). " cannot be more than {$field_rule[1]} in length.");
			}
			break;
			
			
	      case 'max_from_date':
			
			if(date('o-m-d',strtotime($_POST[$field_name])) > $field_rule[1])
			{
			
				$this->add_errors_to_field($field_name, ucwords($field_name). " cannot more than ".$field_rule[1]." to time.");
			
			}
			break;

			case 'min_to_date':
			
			if(date('o-m-d',strtotime($_POST[$field_name])) < $field_rule[1])
			{
			
				$this->add_errors_to_field($field_name, ucwords($field_name). " cannot less than ".$field_rule[1]." from time.");
			
			}
			break;
			
			
			default: 
			break;
		}
	}
	
	private function add_errors_to_field($field_name, $error_message)
	{
		$this->form_is_valid = false;
		$this->field_errors[$field_name][] =$error_message;
	}
	
	//method to check if form is valid
	public function form_valid()
	{
		return $this->form_is_valid;
	}
	
	
	// we are allowing our script to pass or display an error message
	public function out_field_error($field_name)
	{
	//we want to check on field_errors array is there is an error with the associated field_name
	if(isset($this->field_errors[$field_name]))
	{
		foreach($this->field_errors[$field_name] as $field_error)
		{
			echo "<p style='color: red; font-size: 12px;'>{$field_error}</p>";
		}
	}
	}
	
	// display all fields method
	public function output_all_field_errors()
	{
		foreach($this->fields as $field)
		{
			$this->out_field_error($field);
		}
	}
}
?>