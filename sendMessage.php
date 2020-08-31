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
  $seller = mysqli_real_escape_string($con, trim($request->data->sender_id));
  $customer = mysqli_real_escape_string($con, trim($request->data->receiver_id));
  $message = mysqli_real_escape_string($con, trim($request->data->message_text));
 
  // Store.
  $sql = "INSERT INTO `messages`(`sender_id`,`receiver_id`,`message_text`) VALUES ('{$customer}','{$seller}','{$message}')";

  if(mysqli_query($con,$sql))
  {
    http_response_code(201);
    $messages = [
    
      'sender_id' => $customer,
      'receiver' => $seller,
      'message_text'=>$message,
     

    ];
    echo json_encode(['data'=>$messages]);
  }
  else
  {
    http_response_code(422);
  }
}
