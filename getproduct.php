<?php

require 'connect.php';

// Extract, validate and sanitize the id.

$id = ($_GET['product_id'] !== null && (int)$_GET['product_id'] > 0)? mysqli_real_escape_string($con, (int)$_GET['product_id']) : false;

if(!$id)
{
  return http_response_code(400);
}

// Delete.
$sql = "SELECT * FROM `products` WHERE `product_id` ='{$id}' LIMIT 1";

if($result = mysqli_query($con,$sql))
{
  $cr = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $products[$cr]['product_id'] = $row['product_id'];
    $products[$cr]['product_seller_id'] = $row['product_seller_id'];
    
    $products[$cr]['product_name'] = $row['product_name'];
    $products[$cr]['product_description'] = $row['product_description'];
    $products[$cr]['product_tags'] = $row['product_tags'];
    $products[$cr]['product_brand_name'] = $row['product_brand_name'];
    $products[$cr]['product_main_image'] = $row['product_main_image'];
    $products[$cr]['product_first_image'] = $row['product_first_image'];
    $products[$cr]['product_second_image'] = $row['product_second_image'];
    $products[$cr]['product_quantity'] = $row['product_quantity'];
    $products[$cr]['product_colors'] = $row['product_colors'];
    $products[$cr]['product_width'] = $row['product_width'];
    $products[$cr]['product_height'] = $row['product_height'];
    $products[$cr]['product_price'] = $row['product_price'];
    $cr++;
  }
    
  echo json_encode(['data'=>$products]);
}
else
{
  http_response_code(404);
}
?>