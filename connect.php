<?php

// db credentials
define('DB_HOST', 'www.mysql-26075-0.cloudclusters.net');
define('DB_USER', 'melida');
define('DB_PASS', 'Miamilakesdj5881');
define('DB_NAME', 'webshop');

// Connect with the database.
function connect()
{
  $connect = mysqli_connect(DB_HOST ,DB_USER ,DB_PASS ,DB_NAME);

  if (mysqli_connect_errno($connect)) {
    die("Failed to connect:" . mysqli_connect_error());
  }

  mysqli_set_charset($connect, "utf8");

  return $connect;
}

$con = connect();
