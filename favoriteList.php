<?php

require 'connect.php';

// Extract, validate and sanitize the id.

//$seller_username = mysqli_real_escape_string($con, $_GET['seller']);
$customer_id= mysqli_real_escape_string($con, $_GET['customer_id']);

if(!$customer_id)
{
  return http_response_code(400);
}
$products=[];

// Delete.
$proba2="SELECT favorite.favorite_product_id,
products.product_id,products.product_name,
products.product_seller_id,products.product_description,products.product_tags,
products.product_brand_name,products.product_main_image,products.product_first_image,
products.product_second_image,products.product_quantity,
products.product_colors,
products.product_width,
products.product_height,
products.product_price
 FROM
favorite 
INNER JOIN products
ON favorite.favorite_product_id=products.product_id
WHERE favorite.customer_id='{$customer_id}'";

   
  if($result1=mysqli_query($con,$proba2))
     {
     
            $cr = 0;
            while($row = mysqli_fetch_assoc($result1))
            { 
                $products[$cr]['product_id'] = $row['product_id'];
                $products[$cr]['product_seller_id'] = $row['product_seller_id'];
                
                $products[$cr]['product_name'] = $row['product_name'];
                $products[$cr]['product_description'] = $row['product_description'];
                $products[$cr]['product_tags'] = $row['product_tags'];
                $products[$cr]['product_brand_name'] = $row['product_brand_name'];
                $products[$cr]['product_main_image'] = $row['product_main_image'];
                $products[$cr]['product_first_image'] = $row['product_first_image'];
                $products[$cr]['product_second_image'] = $row['product_second_image'];
                $products[$cr]['product_quantity'] = $row['product_quantity'];
                $products[$cr]['product_colors'] = $row['product_colors'];
                $products[$cr]['product_width'] = $row['product_width'];
                $products[$cr]['product_height'] = $row['product_height'];
                $products[$cr]['product_price'] = $row['product_price'];
                
                $cr++;
            }
            
                       echo json_encode(['data'=>$products]);
    }
    
                  
  


              
        

    
    
   
     
    // 
        
  
        
 
     
  
  


