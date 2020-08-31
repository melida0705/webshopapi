<?php

require 'connect.php';

// Extract, validate and sanitize the id.
$id = ($_GET['category_id'] !== null)? mysqli_real_escape_string($con, $_GET['category_id']) : false;

if(!$id)
{
  return http_response_code(400);
}

// Delete.
$sql = "DELETE FROM `category` WHERE `category_id` ='{$id}' LIMIT 1";

if(mysqli_query($con, $sql))
{
  http_response_code(204);
}
else
{
  return http_response_code(422);
}
?>