<?php

require 'connect.php';

// Extract, validate and sanitize the id.

$username =  mysqli_real_escape_string($con, $_GET['seller_username']);

if(!$username)
{
  return http_response_code(400);
}

// Delete.
$sql = "DELETE FROM `sellers` WHERE `seller_username` ='{$username}' LIMIT 1";

if(mysqli_query($con, $sql))
{
  http_response_code(204);
}
else
{
  return http_response_code(422);
}