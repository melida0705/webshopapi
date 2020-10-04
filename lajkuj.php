<?php
require 'connect.php';

// Get the posted data.
$postdata = file_get_contents("php://input");


  // Extract the data.
  $request = json_decode($postdata);
  // // // Validate.
  // if(trim($request->data->user_username) === '' || trim($request->data->user_password)==='' || trim($request->data->user_type) === '' )
  // {
  //   return http_response_code(400);
  // }
	
  // Sanitize.
  $id=mysqli_real_escape_string($con,(int)($request->data->id));
  
 $lajkovi=5;
 
  // Store.
  $sql="UPDATE images SET
     lajkovi='{$lajkovi}',
    

     where id='{$id}'
  
   ";
  // $sql = "INSERT INTO `products`(`product_id`,`product_name`,`product_seller_id`,`product_description`,`product_tags`,`product_brand_name`,`product_main_image`,`product_first_image`,`product_second_image`,`product_price`,`product_quantity`,`product_colors`,`product_width`, `product_height`, `product_category_id`) 
  // VALUES (null,'{$name}','{$seller_id}','{$description}','{$tags}','{$brand_name}',
  // '{$main_image}','{$first_image}','{$second_image}', '{$price}','{$quantity}','{$colors}','{$width}',
  // '{$height}' ,'{$category_id}')";

  if(mysqli_query($con,$sql))
  {
    http_response_code(201);
    $images = [
    
      'lajkovi' => $lajkovi,
    
      'id' => mysqli_insert_id($con),

    ];
    echo json_encode(['data'=>$images]);
  }
  else
  {
    http_response_code(422);
  }

?>