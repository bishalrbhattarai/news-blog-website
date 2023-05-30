<?php
include "./config.php";
session_start();
print_r ($_SESSION);
if(isset($_FILES['fileToUpload'])){
    $errors = array();
$file_name = $_FILES['fileToUpload']['name'];
$file_size = $_FILES['fileToUpload']['size'];
$file_tmp = $_FILES['fileToUpload']['tmp_name'];
$file_type = $_FILES['fileToUpload']['type'];
$file_ext = pathinfo($file_name,PATHINFO_EXTENSION);
$extensions = array("jpeg","jpg","png");

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
$title = mysqli_real_escape_string($conn,$_POST['post_title']);
$description = mysqli_real_escape_string($conn,$_POST['postdesc']);
$category = mysqli_real_escape_string($conn,$_POST['category']);
$date= date('d M, Y');
$author = $_SESSION['user_id'];

echo "the title is : ".$title."<br>";
echo "this description: ".$description."<br>";
echo "the category id is: ".$category."<br>";
echo "the date is: ".$date."<br>";
echo "the author id: ".$author."<br>";

$sql = "INSERT INTO post (title,description,category,post_date,author,post_img)
VALUES ('{$title}','{$description}',{$category},'{$date}',{$author},'{$file_name}');";

$sql .="UPDATE category SET number_of_posts = number_of_posts + 1 WHERE category_id = {$category} ";


if(mysqli_multi_query($conn,$sql)){
    header("location:http://localhost/news-site/admin/post.php");
    die();
}else{
    echo "<div class='alert alert-danger'> Query failed </div>";
  }



?>