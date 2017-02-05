<?php
  require_once('../private/initialize.php');

  // Set default values for all variables the page needs.

  // if this is a POST request, process the form
  // Hint: private/functions.php can help

    // Confirm that POST values are present before accessing them.

    // Perform Validations
    // Hint: Write these in private/validation_functions.php

    // if there were no errors, submit data to database

      // Write SQL INSERT statement
      // $sql = "";

      // For INSERT statments, $result is just true/false
      // $result = db_query($db, $sql);
      // if($result) {
      //   db_close($db);

      //   TODO redirect user to success page

      // } else {
      //   // The SQL INSERT statement failed.
      //   // Just show the error, not the form
      //   echo db_error($db);
      //   db_close($db);
      //   exit;
      // }
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // is a post request
    $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';

    $errors = [];
    if(is_blank($first_name)) {
      $errors[] = "First name cannot be blank.";
    } elseif(!validate_name_length($first_name)) {
      $errors[] = "First name must be between 2 and 255 characters.";
    }
    if(is_blank($last_name)) {
      $errors[] = "Last name cannot be blank.";
    } elseif(!validate_name_length($last_name)) {
      $errors[] = "Last name must be between 2 and 255 characters.";
    }
    if(is_blank($email)) {
      $errors[] = "E-Mail cannot be blank.";
    } elseif(!has_valid_email_format($email)) {
      $errors[] = "E-Mail is not in the correct format.";
    }
    if(is_blank($username)) {
      $errors[] = "Username cannot be blank.";
    } elseif(!validate_username_length($username)) {
      $errors[] = "Username must be between 8 and 255 characters.";
    }

    if(empty($errors)) {
      date_default_timezone_set("America/Los_Angeles");
      $date = date("Y-m-d H:i:s");
      $sql = "INSERT INTO users (first_name, last_name, email, username, created_at)
              VALUES ('$first_name', '$last_name', '$email', '$username', '$date');";
      $result = db_query($db, $sql);
      if($result) { // 
        db_close($db);
        header("Location: registration_success.php");
        exit;
      }
      echo db_error($db);
      db_close($db);
      exit;

    }
  }
  else {
    // not a post request

  }

?>

<?php $page_title = 'Register'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <h1>Register</h1>
  <p>Register to become a Globitek Partner.</p>

  <?php
    // TODO: display any form errors here
    // Hint: private/functions.php can help
    if(!empty($errors)) {
      echo "<div class=\"errors\">";
      echo "Please fix the following errors:";
      echo "<ul>";
      foreach($errors as $error) {
        echo "<li>{$error}</li>";
      }
      echo "</ul>";
      echo "</div>";
    }
  ?>

  <!-- TODO: HTML form goes here -->
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
    First Name: <br>
    <input type="text" name="first_name" value="<?php echo $first_name;?>"><br>
    Last Name: <br>
    <input type="text" name="last_name" value="<? echo $last_name;?>"><br>
    E-mail: <br>
    <input type="text" name="email" value="<? echo $email;?>"><br>
    Username: <br>
    <input type="text" name="username" value="<? echo $username;?>"><br>
    <br>
    <input type="submit" value="Submit"> <br>
  </form>


</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
