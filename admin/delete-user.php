<?php
if($_SESSION['user_role']=='0'){
    header('location:http://localhost/news-site/admin/post.php');
}

$id = $_GET['id'];
include "config.php";
if(mysqli_query($conn,"DELETE FROM user WHERE user_id= '$id'") or die('query failed') ){
    header('location:users.php?');
}
?>