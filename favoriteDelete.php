<?php

require 'connect.php';

// Extract, validate and sanitize the id.
echo "TU SMA U PHP";
$id = ($_GET['product_id'] !== null && (int)$_GET['product_id'] > 0)? mysqli_real_escape_string($con, (int)$_GET['product_id']) : false;
$customer_id= mysqli_real_escape_string($con, $_GET['customer_id']);
if(!$id)
{
  return http_response_code(400);
}

// Delete.
$sql = "DELETE FROM `favorite` WHERE `favorite_product_id` ='{$id}' and `customer_id`='{$customer_id}' LIMIT 1";

if(mysqli_query($con, $sql))
{
  echo "Radim";
  http_response_code(204);
}
else
{
  return http_response_code(422);
}