
<?php
/**
 * Returns the list of cars.
 */
require 'connect.php';
$id = mysqli_real_escape_string($con, $_GET['customer_username']);
$customer = [];
$sql = "SELECT * FROM customers where customer_username='{$id}'";

if($result = mysqli_query($con,$sql))
{
  $cr = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    $customer[$cr]['customer_username'] = $row['customer_username'];
   
    $customer[$cr]['customer_firstName'] = $row['customer_firstName'];
    $customer[$cr]['customer_lastName'] = $row['customer_lastName'];
    $customer[$cr]['customer_email'] = $row['customer_email'];
    $customer[$cr]['customer_city'] = $row['customer_city'];
    $customer[$cr]['customer_state'] = $row['customer_state'];
    $customer[$cr]['customer_zip'] = $row['customer_zip'];
    $customer[$cr]['customer_phoneNumber'] = $row['customer_phoneNumber'];
    $customer[$cr]['customer_address'] = $row['customer_address'];
    $customer[$cr]['customer_address2'] = $row['customer_address2'];
   
    $cr++;
  }
    
  echo json_encode(['data'=>$customer]);
}
else
{
  http_response_code(404);
}
?>