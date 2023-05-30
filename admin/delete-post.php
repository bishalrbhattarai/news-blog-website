<?php
include "./config.php";
$post_id = $_GET['id'];
$cat_id = $_GET['catid'];

$sql1 = "SELECT * FROM post WHERE post_id = {$post_id} ";
$result = mysqli_query($conn,$sql1) or die("Query failed : select");

$row = mysqli_fetch_assoc($result);
unlink("./upload/".$row['post_img']);

$sql = "DELETE FROM post WHERE 
post_id = {$post_id};";
$sql .="UPDATE category SET number_of_posts = number_of_posts - 1 
WHERE category_id = {$cat_id} ";

if(mysqli_multi_query($conn,$sql)){
    header("location:http://localhost/news-site/admin/post.php");
}else{
    echo "<div class='alert alert-danger' style='text-align:center;' > Cannot delete  </div>";
}

?>