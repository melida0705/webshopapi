<?php
require 'connect.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);
	

  // // // Validate.
  // if(trim($request->data->seller_username) === '' || trim($request->data->seller_password)==='' )
  // {
  //   return http_response_code(400);
  // }
	
  // Sanitize.
  $username = mysqli_real_escape_string($con, trim($request->data->seller_username));
  $password = mysqli_real_escape_string($con, trim($request->data->seller_password));
  $firstName = mysqli_real_escape_string($con, trim($request->data->seller_firstName));
  $lastName = mysqli_real_escape_string($con, trim($request->data->seller_lastName));
  // $email = mysqli_real_escape_string($con, trim($request->data->customer_email));
  // $city = mysqli_real_escape_string($con, trim($request->data->customer_city));
  // $state = mysqli_real_escape_string($con, trim($request->data->customer_state));
  // $zip = mysqli_real_escape_string($con, trim($request->data->customer_zip));
  // $phone = mysqli_real_escape_string($con, trim($request->data->customer_phoneNumber));
  // $address = mysqli_real_escape_string($con, trim($request->data->customer_address));
  // $address2 = mysqli_real_escape_string($con, trim($request->data->customer_address2));
  
 
  // Store.
  $sql = "INSERT INTO `sellers`(`seller_username`,`seller_password`,`seller_firstName`,`seller_lastName`) 
  VALUES ('{$username}','{$password}','{$firstName}','{$lastName}')";

  if(mysqli_query($con,$sql))
  {
    http_response_code(201);
    $seller = [
      'seller_username' => $username,
      'seller_firstName'=>$firstName,
      'seller_lastName' => $lastName,
      

    ];
    echo json_encode(['data'=>$seller]);
  }
  else
  {
    http_response_code(422);
  }
}
?>