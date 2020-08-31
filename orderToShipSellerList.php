<?php
/**
 * Returns the list of cars.
 */
require 'connect.php';
    
$orders = [];
$username= mysqli_real_escape_string($con,$_GET['seller_id']);
$sql = "SELECT * FROM orders  
 where orders.order_seller_id='{$username}' and orders.order_shipped='0'" ;

if($result = mysqli_query($con,$sql))
{
  $cr = 0;
  while($row = mysqli_fetch_assoc($result))
  { //$orders[$cr]['product_id'] = $row['detail_product_id'];
    $orders[$cr]['order_customer_id'] = $row['order_customer_id'];
    $orders[$cr]['order_seller_id'] = $row['order_seller_id'];
    $orders[$cr]['order_amount'] = $row['order_amount'];
    $orders[$cr]['order_shipName'] = $row['order_shipName'];
    $orders[$cr]['order_shipAddress'] = $row['order_shipAddress'];
    $orders[$cr]['order_shipAddress2'] = $row['order_shipAddress2'];
    $orders[$cr]['order_city'] = $row['order_city'];
    $orders[$cr]['order_state'] = $row['order_state'];
    $orders[$cr]['order_zip'] = $row['order_zip'];
    $orders[$cr]['order_phoneNumber'] = $row['order_phoneNumber'];
    $orders[$cr]['order_shipped'] = $row['order_shipped'];
    $orders[$cr]['order_id'] = $row['order_id'];
  
    $cr++;
  }
    
  echo json_encode(['data'=>$orders]);
}
else
{
  http_response_code(404);
}