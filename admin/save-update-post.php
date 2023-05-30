<?php
include "./config.php";
if(empty($_FILES['new-image']['name'])){
 $file_name = $_POST['old_image'];
 }
 
 else{
    $errors = array();
    $file_name = $_FILES['new-image']['name'];
    $file_size = $_FILES['new-image']['size'];
    $file_tmp = $_FILES['new-image']['tmp_name'];
    $file_type = $_FILES['new-image']['type'];
    $file_ext = pathinfo($file_name,PATHINFO_EXTENSION);
    $extensions = array("jpeg","JPEG","jpg","JPG","png","PNG");
    
    if(in_array($file_ext,$extensions)=== false){
    $errors[] = "This file extension is not supported, Please choose a JPEG or PNG file";
    }
    if($file_size>209715200000){
         $errors[]="File size must be 2mb or lower.";
    }
    if(empty($errors)=== true){
    move_uploaded_file($file_tmp,"./upload/".$file_name);
    }else{
        print_r($errors);
        die();
     }
 }

 echo $sql= "UPDATE post 
 SET title = '{$_POST["post_title"]}' , description='{$_POST["postdesc"]}', category={$_POST["category"]},post_img ='{$file_name}' WHERE post_id = {$_POST["post_id"]}";

 $result= mysqli_query($conn,$sql);
 if($result){
   header('location:http://localhost/news-site/admin/post.php');
   die();
 }else{
    echo "<div class='alert alert-danger'> Cannot Update</div>";
 }
?> 