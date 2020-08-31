<?php
/**
 * Returns the list of cars.
 */
require 'connect.php';
    
$categories = [];
$sql = "SELECT category_id,category_name,category_image FROM category";

if($result = mysqli_query($con,$sql))
{
  $cr = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $categories[$cr]['category_id']    = $row['category_id'];
    $categories[$cr]['category_name']    = $row['category_name'];
    $categories[$cr]['category_image']    = $row['category_image'];
  
    $cr++;
  }
    
  echo json_encode(['data'=>$categories]);
}
else
{
  http_response_code(404);
}