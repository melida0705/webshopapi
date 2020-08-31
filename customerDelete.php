<?php

require 'connect.php';

// Extract, validate and sanitize the id.
$username = ($_GET['customer_username'] !== null)? mysqli_real_escape_string($con, $_GET['customer_username']) : false;

if(!$username)
{
  return http_response_code(400);
}

// Delete.
$sql = "DELETE FROM `customers` WHERE `customer_username` ='{$username}' LIMIT 1";

if(mysqli_query($con, $sql))
{
  http_response_code(204);
}
else
{
  return http_response_code(422);
}
?>