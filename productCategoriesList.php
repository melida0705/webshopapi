<?php
/**
 * Returns the list of cars.
 */
require 'connect.php';
$id = ($_GET['category_id'] !== null && (int)$_GET['category_id'] > 0)? mysqli_real_escape_string($con, (int)$_GET['category_id']) : false;
$products = [];
if(!$id)
{
  return http_response_code(400);
}

// Delete.
$sql="SELECT DISTINCT product_id,product_seller_id,product_name,product_description,product_tags,product_brand_name,product_main_image,product_first_image,product_second_image,product_quantity,product_colors,product_width,product_height,product_price FROM `products` INNER JOIN `category` ON products.product_category_id='{$id}'";


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

