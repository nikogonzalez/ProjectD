<?php

$errors = array();

function form_errors($errors=array()) {
		$output = "";
		if (!empty($errors)) {
		  $output .= "<div class=\"error\">";
		  $output .= "<ul>";
		  foreach ($errors as $key => $error) {
		    $output .= "<li>";
				$output .= htmlentities($error);
				$output .= "</li>";
		  }
		  $output .= "</ul>";
		  $output .= "</div>";
		}
		return $output;
	}

function has_presence($value){
  return isset($value) && $value !== "";
}

function validate_presence($required_fields){
  global $errors;
  foreach($required_fields as $field){
    $value = trim($_POST[$field]);
    if(!has_presence($value)){
      $errors[$field] = fieldname_as_text($field) . " can't be blank";
    }
  }
}

function fieldname_as_text($fieldname){
  $fieldname = str_replace("_"," ", $fieldname);
  $fieldname = ucfirst($fieldname);
  return $fieldname;
}

function validate_max_lengths($fields_with_max_length){
  global $errors;
  foreach($fields_with_max_length as $field=>$max){
    $value = trim($_POST[$field]);
    if(!is_less_than_max_length($value, $max)){
      $errors[$field] = fieldname_as_text($field) . " is too long";
    }
  }
}

function is_less_than_max_length($value, $max){
  return strlen($value) <= $max;

}

function has_inclusion_in($value, $set){
  return in_array($value, $set);
}


?>
