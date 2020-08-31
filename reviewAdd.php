<?php
require 'connect.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);
  // // // Validate.
  // if(trim($request->data->user_username) === '' || trim($request->data->user_password)==='' || trim($request->data->user_type) === '' )
  // {
  //   return http_response_code(400);
  // }
	
  // Sanitize.
  $seller = mysqli_real_escape_string($con, trim($request->data->seller_username));
  $customer = mysqli_real_escape_string($con, trim($request->data->customer_username));
  $review = mysqli_real_escape_string($con, (int)($request->data->review));
  $description = mysqli_real_escape_string($con, trim($request->data->review_description));
 
  $product = mysqli_real_escape_string($con, trim($request->data->product_id));
  
 
 
  // Store.
  $sql = "INSERT INTO `seller_review`(`review_id`,`seller_username`,`customer_username`,`product_id`,`review`,`review_description`)
  VALUES (null,'{$seller}','{$customer}','{$product}','{$review}','{$description}')";
  

  if(mysqli_query($con,$sql))
  {
    http_response_code(201);
    $seller_review = [
    
      'seller_username' => $seller,
      'customer_username' => $customer,
      'product_id'=>$product,
      'review' => $review,
     
      
      'review_id' => mysqli_insert_id($con),

    ];
    echo json_encode(['data'=>$seller_review]);
  }
  else
  {
    http_response_code(422);
  }
}
?>