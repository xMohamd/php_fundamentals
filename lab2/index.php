<html>

<head>
  <title>Contact form</title>
</head>

<body>
  <h3>Contact Form</h3>
  <div id="after_submit"></div>
  <?php
  require_once "vendor/autoload.php";
  // Initialize variables
  $name = isset($_POST['name']) ? htmlentities($_POST['name']) : '';
  $email = isset($_POST['email']) ? htmlentities($_POST['email']) : '';
  $message = isset($_POST['message']) ? htmlentities($_POST['message']) : '';

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errs = [];

    if (empty($name) || strlen($name) > MAX_NAME_LENGTH) {
      $errs[] = "Name is required and should be less than " . MAX_NAME_LENGTH . " characters.";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errs[] = "Email is required and should be a valid email address.";
    }

    if (empty($message) || strlen($message) > MAX_MESSAGE_LENGTH) {
      $errs[] = "Message is required and should be less than " . MAX_MESSAGE_LENGTH . " characters.";
    }

    if (empty($errs)) {
      // $log_data = date("F j Y g:i a") . "," . $_SERVER['REMOTE_ADDR'] . "," . $name . "," . $email . "\n";
      // file_put_contents($log_file_path, $log_data, FILE_APPEND | LOCK_EX);

      log_visit($name, $email, LOG_FILE_PATH);
      echo "<p>" . MSG . "</p>";
      echo "<p><strong>Name:</strong> $name</p>";
      echo "<p><strong>Email:</strong> $email</p>";
      echo "<p><strong>Message:</strong> $message</p>";
    } else {
      echo "<ul>";
      foreach ($errs as $e) {
        echo "<li>$e</li>";
      }
      echo "</ul>";
    }
  }
  ?>
  <form id="contact_form" action="index.php" method="POST" enctype="multipart/form-data">

    <div class="row">
      <label class="required" for="name">Your name:</label><br />
      <input id="name" class="input" name="name" type="text" value="<?php echo $name; ?>" size="30" /><br />
    </div>
    <div class="row">
      <label class="required" for="email">Your email:</label><br />
      <input id="email" class="input" name="email" type="text" value="<?php echo $email; ?>" size="30" /><br />
    </div>
    <div class="row">
      <label class="required" for="message">Your message:</label><br />
      <textarea id="message" class="input" name="message" rows="7" cols="30"><?php echo $message; ?></textarea><br />
    </div>

    <input id="submit" name="submit" type="submit" value="Send email" />
    <input id="clear" name="clear" type="reset" value="clear form" />

  </form>
</body>

</html>