<?php
include_once ("framework/MySQLDB.php");


function is_blank($value) {
    return !isset($value) || trim($value) === '';
  }

  function has_presence($value) {
    return !is_blank($value);
  }

  function has_length_greater_than($value, $min) {
    $length = strlen($value);
    return $length > $min;
  }

  function has_length_less_than($value, $max) {
    $length = strlen($value);
    return $length < $max;
  }

  function has_valid_email_format($value) {
    $email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
    return preg_match($email_regex, $value) === 1;
  }

  function checkPassword($password,$username){
      $errors = null;
      if ($password == null){
          $errors[] = "Password cannot be blank.";
      } 
      else if (strlen(trim($password)) <= 10){
          $errors[] = "Password must contain 10 or more characters";
      } 
      elseif (!preg_match('/[A-Z]/', $password)) {
        $errors[] = "Password must contain at least 1 uppercase letter";
      }
      elseif (!preg_match('/[a-z]/', $password)) {
        $errors[] = "Password must contain at least 1 lowercase letter";
      }
      elseif (!preg_match('/[0-9]/', $password)) {
        $errors[] = "Password must contain at least 1 number";
      }
      elseif (!preg_match('/[^A-Za-z0-9\s]/', $password)) {
        $errors[] = "Password must contain at least 1 symbol";
      }
      elseif($password == $username) {
        $errors[] = "Username and password must be different";
      }
    return $errors;
}

function display_errors($errors=array()) {
    $output = '';
    if(!empty($errors)) {
      $output .= "<div class=\"errors\">";
      $output .= "Please fix the following errors:";
      $output .= "<ul>";
      foreach($errors as $error) {
        $output .= "<li>" . h($error) . "</li>";
      }
      $output .= "</ul>";
      $output .= "</div>";
    }
    return $output;
  }
  
  function h($string="") {
    return htmlspecialchars($string);
  }

