<?php
/**
 * Returns the list of cars.
 */
require 'connect.php';
    
$sellers = [];
$sql = "SELECT seller_username,seller_firstName,seller_lastName FROM sellers";

if($result = mysqli_query($con,$sql))
{
  $cr = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $sellers[$cr]['seller_username'] = $row['seller_username'];
    $sellers[$cr]['seller_firstName'] = $row['seller_firstName'];
    $sellers[$cr]['seller_lastName'] = $row['seller_lastName'];
    $cr++;
  }
    
  echo json_encode(['data'=>$sellers]);
}
else
{
  http_response_code(404);
}