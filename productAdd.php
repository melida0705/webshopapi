<?php
require 'connect.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);
  // // // Validate.
  // if(trim($request->data->user_username) === '' || trim($request->data->user_password)==='' || trim($request->data->user_type) === '' )
  // {
  //   return http_response_code(400);
  // }
	
  // Sanitize.
  $name = mysqli_real_escape_string($con, trim($request->data->product_name));
  $seller_id = mysqli_real_escape_string($con, trim($request->data->product_seller_id));
  $description = mysqli_real_escape_string($con, trim($request->data->product_description));
  $tags = mysqli_real_escape_string($con, trim($request->data->product_tags));
  $brand_name = mysqli_real_escape_string($con, trim($request->data->product_brand_name));
  $main_image = mysqli_real_escape_string($con, trim($request->data->product_main_image));
  $first_image = mysqli_real_escape_string($con, trim($request->data->product_first_image));
  $second_image = mysqli_real_escape_string($con, trim($request->data->product_second_image));
  $quantity = mysqli_real_escape_string($con, (int)($request->data->product_quantity));
  $colors = mysqli_real_escape_string($con, trim($request->data->product_colors));
  $width = mysqli_real_escape_string($con, (int)($request->data->product_width));
  $height = mysqli_real_escape_string($con, (int)($request->data->product_height));
  $price = mysqli_real_escape_string($con, (int)($request->data->product_price));
  $category_id = mysqli_real_escape_string($con, (int)($request->data->product_category_id));
 
 
  // Store.
  $sql = "INSERT INTO `products`(`product_id`,`product_name`,`product_seller_id`,`product_description`,`product_tags`,`product_brand_name`,`product_main_image`,`product_first_image`,`product_second_image`,`product_price`,`product_quantity`,`product_colors`,`product_width`, `product_height`, `product_category_id`) 
  VALUES (null,'{$name}','{$seller_id}','{$description}','{$tags}','{$brand_name}',
  '{$main_image}','{$first_image}','{$second_image}', '{$price}','{$quantity}','{$colors}','{$width}',
  '{$height}' ,'{$category_id}')";

  if(mysqli_query($con,$sql))
  {
    http_response_code(201);
    $product = [
    
      'product_name' => $name,
      'product_seller_id' => $seller_id,
      'product_description'=>$description,
      'product_tags' => $tags,
      'product_brand_name' => $brand_name,
      'product_main_image' => $main_image,
      'product_first_image' => $first_image,
      'product_second_image' => $second_image,
      'product_price' => $price,
      'product_quantity' => $quantity,
      'product_colors' => $colors,
      'product_width' => $width,
      'product_height' => $height,
      
      'product_category_id' => $category_id,
      'product_id' => mysqli_insert_id($con),

    ];
    echo json_encode(['data'=>$product]);
  }
  else
  {
    http_response_code(422);
  }
}
