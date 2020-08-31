<?php
require 'connect.php';

  // Extract the data.
   
  $id = ($_GET['order_id'] !== null && (int)$_GET['order_id'] > 0)? mysqli_real_escape_string($con, (int)$_GET['oder_id']) : false;
  $productid = ($_GET['product_id'] !== null && (int)$_GET['product_id'] > 0)? mysqli_real_escape_string($con, (int)$_GET['product_id']) : false;

  if(!$id)
  {
    return http_response_code(400);
  }
  if(!$productid)
  {
    return http_response_code(400);
  }
  
$sql="INSERT INTO `order_details`( `detail_order_id`, `detail_product_id`) VALUES ($id,$productid)";

if(mysqli_query($con,$sql))
  {
   
    http_response_code(201);
   
   
   
  }
  else
  {
    http_response_code(422);
  }

?>

 
  

