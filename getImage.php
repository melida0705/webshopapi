<?php

require 'connect.php';


$sql = "SELECT * FROM image" ;
$image=[];
if($result = mysqli_query($con,$sql))
{
  $cr = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $image=[$cr]['id'] = $row['d'];
    $image=[$cr]['url'] = $row['url']; 
    $image=[$cr]['opis'] = $row['opis']; 
    $image=[$cr]['lajkovi'] = $row['lajkovi']; 
   
    $cr++;
  }
    
  echo json_encode(['data'=>$image])
}
else
{
  http_response_code(404);
}
?>