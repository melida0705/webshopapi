<?php

require 'connect.php';

// Extract, validate and sanitize the id.

$seller_username = ($_GET['seller_username'] !== null)? mysqli_real_escape_string($con, $_GET['seller_username']) : false;
$product_id = ($_GET['product_id'] !== null && (int)$_GET['product_id'] > 0)? mysqli_real_escape_string($con, (int)$_GET['product_id']) : false;

if(!$seller_username && !$product_id)
{
  return http_response_code(400);
}

// Delete.
$sql = "SELECT * FROM `seller_review` WHERE `seller_username` ='{$seller_username}' and `product_id`='{$product_id}' " ;

if($result = mysqli_query($con,$sql))
{
  $cr = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $seller_review[$cr]['review_id'] = $row['review_id'];
    $seller_review[$cr]['seller_username'] = $row['seller_username']; 
    $seller_review[$cr]['customer_username'] = $row['customer_username'];
    $seller_review[$cr]['product_id'] = $row['product_id'];
    $seller_review[$cr]['review'] = $row['review'];
    $seller_review[$cr]['review_description'] = $row['review_description']; 
    $cr++;
  }
    
  echo json_encode(['data'=>$seller_review]);
}
else
{
  http_response_code(404);
}
?>