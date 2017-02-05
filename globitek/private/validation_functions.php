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


?>
