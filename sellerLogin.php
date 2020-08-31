<?php
require 'connect.php';

  //$request = json_decode($postdata);
  $username = mysqli_real_escape_string($con, $_GET['seller_username']);
  $password = mysqli_real_escape_string($con, $_GET['seller_password']);
$seller=[];
	$sql = "SELECT * FROM sellers where seller_username='$username' and seller_password='$password'";
  if($result=mysqli_query($con,$sql))
  {
    $cr=0;
    while($row=mysqli_fetch_assoc($result)){
      $seller[$cr]['seller_username']=$row['seller_username'];

      
    }
    // $customer = [
    //   'customer_username' => $username,
    //   'customer_password' => $password
     
    // ];
    echo json_encode(['data'=>$seller]);
   // if($result = mysqli_query($con,$sql))
// {
//   $cr = 0;
//   while($row = mysqli_fetch_assoc($result))
//   {
//     $seller_review[$cr]['review_id'] = $row['review_id'];
//     $seller_review[$cr]['seller_username'] = $row['seller_username']; 
//     $seller_review[$cr]['customer_username'] = $row['customer_username'];
//     $seller_review[$cr]['product_id'] = $row['product_id'];
//     $seller_review[$cr]['review'] = $row['review'];
//     $seller_review[$cr]['review_description'] = $row['review_description']; 
//     $cr++;
//   }
    
//   echo json_encode(['data'=>$seller_review]);
// }
  }
  else
  {
    http_response_code(422);
  }

?>