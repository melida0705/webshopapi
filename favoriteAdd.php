<?php
require 'connect.php';

  $id = mysqli_real_escape_string($con,(int)$_GET['product_id']);
  $customer_id = mysqli_real_escape_string($con, $_GET['customer_id']);

  $sql = "INSERT INTO `favorite`(`customer_id`,`favorite_product_id`) 
  VALUES ('{$customer_id}','{$id}')";

  if(mysqli_query($con,$sql))
  {
   
    http_response_code(201);
    $favorite = [
    
      'favorite_product_id' => $id,
      'customer_id'=>$customer_id

    ];
    echo json_encode(['data'=>$favorite]);
  }
  else
  {
    http_response_code(422);
  }
?>
