<?php

require 'connect.php';

// Extract, validate and sanitize the id.

$seller_username = mysqli_real_escape_string($con, $_GET['seller']);
$customer_username= mysqli_real_escape_string($con, $_GET['customer']);

if(!$seller_username && !$customer_username)
{
  return http_response_code(400);
}
$products=[];

// Delete.
$proba2="SELECT orders.order_id,order_details.detail_product_name,order_details.detail_product_id,order_details.detail_product_quantity,
order_details.detail_product_price,order_details.detail_id FROM
orders 
INNER JOIN order_details
ON orders.order_id=order_details.detail_order_id
WHERE orders.order_seller_id='{$seller_username}' and orders.order_customer_id='{$customer_username}'";

   
  if($result1=mysqli_query($con,$proba2))
     {
     
            $cr = 0;
            while($row = mysqli_fetch_assoc($result1))
            { 
                $order_detail[$cr]['detail_order_id'] = $row['order_id'];
                $order_detail[$cr]['detail_product_id'] = $row['detail_product_id'];
                 $order_detail[$cr]['detail_product_quantity'] = $row['detail_product_quantity'];
                $order_detail[$cr]['detail_product_name'] = $row['detail_product_name'];
                $order_detail[$cr]['detail_product_price'] = $row['detail_product_price'];
                 $order_detail[$cr]['detail_id'] = $row['detail_id'];
             
                $cr++;
            }
            
                       echo json_encode(['data'=>$order_detail]);
           }
    
                  
  


              
        

    
    
   
     
    // 
        
  
        
 
     
  
  


