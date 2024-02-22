<?php
require_once "vendor/autoload.php";

if (file_exists(LOG_FILE_PATH)) {
  $logData = file_get_contents(LOG_FILE_PATH);

  $logLines = explode("\n", $logData);

  if (!empty($logLines)) {
    foreach ($logLines as $logLine) {
      $logElements = explode(",", $logLine);

      if (count($logElements) == 4) {
        $visitDate = trim($logElements[0]);
        $ipAddress = trim($logElements[1]);
        $name = trim($logElements[2]);
        $email = trim($logElements[3]);

        echo "<p>Visit Date: $visitDate</p>";
        echo "<p>IP Address: $ipAddress</p>";
        echo "<p>Name: $name</p>";
        echo "<p>Email: $email</p>";
        echo "<br>";
      }
    }
  } else {
    echo "<p>No logs found.</p>";
  }
} else {
  echo "<p>Error: Log file not found.</p>";
}
