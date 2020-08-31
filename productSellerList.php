<?php
/**
 * Returns the list of cars.
 */
require 'connect.php';
$username = ($_GET['product_seller_id'] !== null)? mysqli_real_escape_string($con, $_GET['product_seller_id']) : false;
$products = [];
if(!$username)
{
  return http_response_code(400);
}    
$products = [];
$sql = "SELECT * FROM products WHERE product_seller_id='{$username}'";

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