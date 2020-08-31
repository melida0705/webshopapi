<?php
require 'connect.php';

  // Extract the data.
   
  $id =mysqli_real_escape_string($con, (int)$_GET['order']);
  
//   $productid = ($_GET['product_id'] !== null && (int)$_GET['product_id'] > 0)? mysqli_real_escape_string($con, (int)$_GET['product_id']) : false;

  if(!$id)
  {
    return http_response_code(400);
  }
 
  
$sql="SELECT * FROM order_details WHERE detail_order_id='{$id}'";

if($result=mysqli_query($con,$sql))
{
  $cr = 0;
  while($row = mysqli_fetch_assoc($result))
  { 
   
    $order_detail[$cr]['detail_order_id'] = $row['detail_order_id'];
    $order_detail[$cr]['detail_product_id'] = $row['detail_product_id'];
    $order_detail[$cr]['detail_product_quantity'] = $row['detail_product_quantity'];
    $order_detail[$cr]['detail_id'] = $row['detail_id'];
    $order_detail[$cr]['detail_product_name'] = $row['detail_product_name'];
    $order_detail[$cr]['detail_product_price'] = $row['detail_product_price'];
    
    $cr++;
  }
    
  echo json_encode(['data'=>$order_detail]);
}
else
{
  http_response_code(404);
}
?>

 
  

