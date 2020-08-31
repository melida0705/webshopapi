<?php
require 'connect.php';


// Get the posted data.
// $id = ($_GET['product_id'] !== null && $_GET['product_id'] > 0)? mysqli_real_escape_string($con, $_GET['product_id']) : false;

//   if(!$id)
//   {
//     return http_response_code(400);
//   }
//$id = array(($_GET['cart'] !== null)? mysqli_real_escape_string($con, $_GET['cart']) : false);
$id=mysqli_real_escape_string($con, $_GET['niz']);
$quantity=mysqli_real_escape_string($con,$_GET['product_quantity']);
$niz = explode(",", $id);
$quantityArray=explode(",",$quantity);

  if(!$id && !$quantity)
  {
    return http_response_code(400);
  }
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
  //$orderId=mysqli_real_escape_string($con, (int)($request->data->order_id));
  //$cart=mysqli_real_escape_string($con,trim($req))
  $amount = mysqli_real_escape_string($con, (int)($request->data->order_amount));
  $seller = mysqli_real_escape_string($con, trim($request->data->order_seller_id));
  $customer_id = mysqli_real_escape_string($con, trim($request->data->order_customer_id));
  $shipName = mysqli_real_escape_string($con, trim($request->data->order_shipName));
  $shipAddress = mysqli_real_escape_string($con, trim($request->data->order_shipAddress));
  $shipAddress2 = mysqli_real_escape_string($con, trim($request->data->order_shipAddress2));
  $city = mysqli_real_escape_string($con, trim($request->data->order_city));
  $state = mysqli_real_escape_string($con, trim($request->data->order_state));
  $zip = mysqli_real_escape_string($con, trim($request->data->order_zip));
  $phoneNumber = mysqli_real_escape_string($con, trim($request->data->order_phoneNumber));
  $shipped ="0";
  //$product = mysqli_real_escape_string($con, (int)($request->data->cart));
  
  // Store.

  $sql = "INSERT INTO `orders`(`order_id`,`order_seller_id`,`order_amount`,`order_customer_id`,`order_shipName`,
  `order_shipAddress`,`order_shipAddress2`,`order_city`,`order_state`,`order_zip`,`order_phoneNumber`,`order_shipped`)
   VALUES (null,'{$seller}','{$amount}','{$customer_id}','{$shipName}','{$shipAddress}','{$shipAddress2}','{$city}',
   '{$state}','{$zip}','{$phoneNumber}','{$shipped}')";
  //SET @last_id=LAST_INSERT_ID()";
  
 
  //  foreach($niz as $i){
  //  $sql .="INSERT INTO `order_details`(`detail_order_id`,`detail_product_id`)
  //  VALUES ($last_id,'{$i}')"; 
  //  }
   mysqli_query($con,$sql);
   $last_id=mysqli_insert_id($con);
  
  
  // if(mysqli_query($con,$sql))
  // {
   
  //   http_response_code(201);
    $order = [
      'order_id' => $last_id,
      'order_seller_id'=>$seller,
      'order_amount' => $amount,
      'order_customer_id'=>$customer_id,
       'order_shipName'=>$shipName,
       'order_shipAddress'=>$shipAddress,
       'order_shipAddress2'=>$shipAddress2,
       'order_city'=>$city,
       'order_state'=>$state,
       'order_zip'=>$zip,
       'order_phoneNumber'=>$phoneNumber,
       'order_shipped'=>$shipped 
    ];
    echo json_encode(['data'=>$order]);
    $i1=0;
    foreach($niz as $i){
    $sql2="SELECT product_name, product_price FROM products WHERE product_id='{$i}'";
   

    $result1=mysqli_query($con,$sql2);
    $row = mysqli_fetch_assoc($result1);
      $sql1="INSERT INTO `order_details`(`detail_order_id`,`detail_product_id`,`detail_product_quantity`,`detail_product_name`,`detail_product_price`)
      VALUES ($last_id,'{$i}','{$quantityArray[$i1]}','{$row['product_name']}','{$row['product_price']}')"; 
      
      mysqli_query($con,$sql1);
      $i1++;
    
  }
}
  
  

?>
