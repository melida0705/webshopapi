<?php
require 'connect.php';
if($_FILES){
    $target_dir="images/";
    echo $target_file=$target_dir.basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'],$target_file);
    echo $file_name=$_FILES['image']['name'];
}
?>