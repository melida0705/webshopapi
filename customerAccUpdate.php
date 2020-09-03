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
  $username = mysqli_real_escape_string($con, trim($request->data->customer_username));
  $password = mysqli_real_escape_string($con, trim($request->data->customer_password));
  $firstName = mysqli_real_escape_string($con, trim($request->data->customer_firstName));
  $lastName = mysqli_real_escape_string($con, trim($request->data->customer_lastName));
  $email = mysqli_real_escape_string($con, trim($request->data->customer_email));
  $city = mysqli_real_escape_string($con, trim($request->data->customer_city));
  $state = mysqli_real_escape_string($con, trim($request->data->customer_state));
  $zip = mysqli_real_escape_string($con, trim($request->data->customer_zip));
  $phone = mysqli_real_escape_string($con, trim($request->data->customer_phoneNumber));
  $address = mysqli_real_escape_string($con, trim($request->data->customer_address));
  $address2 = mysqli_real_escape_string($con, trim($request->data->customer_address2));

  // Store.
  $sql="UPDATE `customers` SET
    
     customer_firstName='{$firstName}',
  customer_password='{$password}',
      customer_lastName ='{$lastName}',
      customer_email = '{$email}',
      customer_city = '{$city}',
      customer_state = '{$state}',
      customer_zip = '{$zip}',
      customer_phoneNumber = '{$phone}',
      customer_address = '{$address}',
      customer_address2 = '{$address2}'
    
     where customer_username='{$username}'";
   
  if(mysqli_query($con,$sql))
  {
      
    http_response_code(201);
    $customer = [
    
        'customer_username' => $username,
       
        'customer_firstName'=>$firstName,
        'customer_lastName' => $lastName,
        'customer_email' => $email,
        'customer_city' => $city,
        'customer_state' => $state,
        'customer_zip' => $zip,
        'customer_phoneNumber' => $phone,
        'customer_address' => $address,
        'customer_address2' => $address2
      
    
    ];
    echo json_encode(['data'=>$customer]);
  }
  else
  {
      //echo $customer
      echo "Error updating record: " . mysqli_error($con);
    http_response_code(422);
  }
}
?>