<?php
/**
 * Returns the list of cars.
 */
require 'connect.php';
    
$images = [];
$sql = "SELECT * FROM image";

if($result = mysqli_query($con,$sql))
{
  $cr = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $images[$cr]['id']    = $row['id'];
    $images[$cr]['url']    = $row['url'];
    $images[$cr]['opis']    = $row['opis'];
    $images[$cr]['lajkovi']    = $row['lajkovi'];
  
    $cr++;
  }
    
  echo json_encode(['data'=>$images]);
}
else
{
  http_response_code(404);
}
?>
