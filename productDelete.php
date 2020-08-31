<?php

require 'connect.php';

// Extract, validate and sanitize the id.

$id = ($_GET['product_id'] !== null && (int)$_GET['product_id'] > 0)? mysqli_real_escape_string($con, (int)$_GET['product_id']) : false;

if(!$id)
{
  return http_response_code(400);
}

// Delete.
$sql = "DELETE FROM `products` WHERE `product_id` ='{$id}' LIMIT 1";

if(mysqli_query($con, $sql))
{
  http_response_code(204);
}
else
{
  return http_response_code(422);
}