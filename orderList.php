<?php
/**
 * Returns the list of cars.
 */
require 'connect.php';
    
$orders = [];
$sql = "SELECT order_customer_id FROM orders";

if($result = mysqli_query($con,$sql))
{
  $cr = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $orders[$cr]['order_customer_id'] = $row['order_customer_id'];
  
    $cr++;
  }
    
  echo json_encode(['data'=>$orders]);
}
else
{
  http_response_code(404);
}