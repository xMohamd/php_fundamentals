<?php
require_once "vendor/autoload.php";

function log_visit($name, $email, $logFilePath)
{
  $logData = [
    date("F j Y g:i a"),
    $_SERVER['REMOTE_ADDR'],
    $email,
    $name
  ];
  $logString = implode(', ', $logData) . PHP_EOL;
  file_put_contents($logFilePath, $logString, FILE_APPEND | LOCK_EX);
}
