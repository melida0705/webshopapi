<?php

// db credentials
define('DB_HOST', 'www.000webhost.com');
define('DB_USER', 'id16507163_melida');
define('DB_PASS', 'Miamilakesdj5881');
define('DB_NAME', 'id16507163_webshop');

// Connect with the database.
function connect()
{
  $connect = mysqli(DB_HOST ,DB_USER ,DB_PASS ,DB_NAME);

  if (mysqli_connect_errno($connect)) {
    die("Failed to connect:" . mysqli_connect_error());
  }

  mysqli_set_charset($connect, "utf8");

  return $connect;
}

$con = connect();
?>
