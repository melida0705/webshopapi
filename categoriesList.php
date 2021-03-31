<?php
/**
 * Returns the list of cars.
 */
require 'connect.php';
    
$images = [];
$sql = "SELECT * FROM category";

if($result = mysqli_query($con,$sql))
{
  $cr = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $images[$cr]['category_id']    = $row['category_id'];
    $images[$cr]['category_name']    = $row['category_name'];
    $images[$cr]['category_image']    = $row['category_image'];
 
  
    $cr++;
  }
    
  echo json_encode(['data'=>$images]);
}
else
{
  http_response_code(404);
}
?>
