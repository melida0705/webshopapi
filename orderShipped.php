<?php
require 'connect.php';

// Get the posted data.

  // Extract the data.
  //$request = json_decode($postdata);
	
  // Validate.
//   if ((int)$request->data->id < 1 || trim($request->data->model) == '' || (int)$request->data->price < 1) {
//     return http_response_code(400);
//   }
    
  // Sanitize.
  $id = mysqli_real_escape_string($con, $_GET['seller_order_id']);
 $orders=[];

  // Update.
  $sql = "UPDATE `orders` SET `order_shipped`='1' WHERE `order_id` = '{$id}'";
 
  if(mysqli_query($con, $sql))
  { 
    $inserted=  mysqli_insert_id($con);
     $sql1="SELECT * FROM orders where order_id='{$inserted}";
  
   // http_response_code(204);
    if($result = mysqli_query($con,$sql1))
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
        $orders[$cr]['order_date']=$row['order_date'];
        $orders[$cr]['order_shipped'] = $row['order_shipped'];
        
        $orders[$cr]['order_id'] = $row['order_id'];
      
        $cr++;
      }
        
      echo json_encode(['data'=>$orders]);
  }
}
  else
  {
    return http_response_code(422);
  }  


