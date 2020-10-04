<?php

// db credentials
define('DB_HOST', 'sql2.freemysqlhosting.net');
define('DB_USER', 'sql2368143');
define('DB_PASS', 'xF2%yL3*');
define('DB_NAME', 'sql2368143');

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
