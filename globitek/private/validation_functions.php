<?php

  // is_blank('abcd')
  function is_blank($value='') {
    return !isset($value) || trim($value) == '';
  }

  // has_length('abcd', ['min' => 3, 'max' => 5])
  function has_length($value, $options=array()) {
    $length = strlen($value);
    if(isset($options['max']) && ($length > $options['max'])) {
      return false;
    } elseif(isset($options['min']) && ($length < $options['min'])) {
      return false;
    } elseif(isset($options['exact']) && ($length != $options['exact'])) {
      return false;
    } else {
      return true;
    }
  }

  // has_valid_email_format('test@test.com')
  function has_valid_email_format($value) {
    return filter_var($value, FILTER_VALIDATE_EMAIL);
  }

  // not longer than 255 characters
  // have at least 2 characters
  function validate_name_length($value) {
    return has_length($value, ['min' => 2, 'max' => 255]);
  }

  // not longer than 255 characters
  // contains "@"
  function validate_email_length($value) {
    return has_valid_email_format($value);
  }

  // not longer than 255 characters
  // at least 8 characters
  function validate_username_length($value) {
    return has_length($value, ['min' => 8, 'max' => 255]);
  }

  // checks that string doesn't contain invalid characters for names
  function validate_name_chars($value) {
    return preg_match('/\A[A-Za-z\s\-,\.\']+\Z/', $value);
  }

  // checks that string doesn't contain invalid characters for email
  function validate_email_chars($value) {
    return preg_match('/\A[A-Za-z\d\_\.\@]+\Z/', $value);
  }

  // checks that string doesn't contain invalid characters for username
  function validate_username_chars($value) {
    return preg_match('/\A[A-Za-z\d\_]+\Z/', $value);
  }

  function validate_unique_username($value) {
    global $db;
    $sql = "SELECT * FROM users WHERE username='{$value}';";
    $query_result = db_query($db, $sql);
    if($query_result->num_rows == 0) {
      return true;
    } else {
      return false;
    }
  }

?>
