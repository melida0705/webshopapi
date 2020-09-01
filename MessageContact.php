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
$proba2="SELECT DISTINCT receiver_id,sender_id FROM `messages` WHERE (sender_id='{$customer_id}' or receiver_id='{$customer_id}')";

   
  if($result1=mysqli_query($con,$proba2))
     {
         
            $cr = 0;
            while($row = mysqli_fetch_assoc($result1))
            { 
                if($customer_id==$row['receiver_id'] ){
                    $messages[$cr]['receiver_id'] = $row['sender_id'];
                    $cr++;
                  }
               if($customer_id==$row['sender_id'])
                  {
                    $messages[$cr]['receiver_id']=$row['receiver_id'];
                    $cr++;
                  }
                  
               // $messages[$cr]['sender_id']=$row['receiver_id'];
             //  }
              
             
                
                
            }
            
                       echo json_encode(['data'=>$messages]);
    }
    ?>
                  
  
