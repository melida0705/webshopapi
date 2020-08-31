<?php
/**
 * Returns the list of cars.
 */
require 'connect.php';
    
$users = [];
$sql = "SELECT customer_username,customer_password,customer_firstName FROM customers";

if($result = mysqli_query($con,$sql))
{
  $cr = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $users[$cr]['customer_username']    = $row['customer_username'];
    $users[$cr]['customer_password']    = $row['customer_password'];
    $users[$cr]['customer_firstName']    = $row['customer_firstName'];
    $cr++;
  }
    
  echo json_encode(['data'=>$users]);
}
else
{
  http_response_code(404);
}
?>