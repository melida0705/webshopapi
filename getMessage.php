<?php

require 'connect.php';

// Extract, validate and sanitize the id.

//$seller_username = mysqli_real_escape_string($con, $_GET['seller']);
$customer_id= mysqli_real_escape_string($con, $_GET['customer_id']); //dzekica
$seller_id=mysqli_real_escape_string($con,$_GET['seller_id']); //melida
if(!$customer_id)
{
  return http_response_code(400);
}
$messages=[];

// Delete.
$proba2="SELECT * FROM `messages` WHERE (sender_id='{$customer_id}' or sender_id='{$seller_id}') and (receiver_id='{$seller_id}' or receiver_id='{$customer_id}')";

   
  if($result1=mysqli_query($con,$proba2))
     {
     
            $cr = 0;
            while($row = mysqli_fetch_assoc($result1))
            { 
                $messages[$cr]['sender_id'] = $row['sender_id'];
                $messages[$cr]['receiver_id'] = $row['receiver_id'];
                
                $messages[$cr]['message_text'] = $row['message_text'];
               
             
                
                $cr++;
            }
            
                       echo json_encode(['data'=>$messages]);
    }
    
                  
  


              
        

    
    
   
     
    // 
        
  
        
 
     
  
  


