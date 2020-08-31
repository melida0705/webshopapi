<?php

require 'connect.php';

// Extract, validate and sanitize the id.

//$seller_username = mysqli_real_escape_string($con, $_GET['seller']);
$customer_id= mysqli_real_escape_string($con, $_GET['customer_id']);

if(!$customer_id)
{
  return http_response_code(400);
}
$messages=[];

// Delete.
$proba2="SELECT DISTINCT receiver_id FROM `messages` WHERE sender_id='{$customer_id}'";

   
  if($result1=mysqli_query($con,$proba2))
     {
     
            $cr = 0;
            while($row = mysqli_fetch_assoc($result1))
            { 
               
                $messages[$cr]['receiver_id'] = $row['receiver_id'];
                
              
             
                
                $cr++;
            }
            
                       echo json_encode(['data'=>$messages]);
    }
    
                  
  ?>
