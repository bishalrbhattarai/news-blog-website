<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>News</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>


<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->

            <!--uncut  <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="images/news.jpg"></a>
            </div>  uncut -->



            <div class="col-md-2">
                        <a href="/news-site/index.php"><img class="logo" src="images/news.jpg"></a>
                    </div>
                    <!-- /LOGO -->
                      <!-- LOGO-Out -->
<!-- this is the added one -->

 <!-- this is the add one -->
 <?php
                    session_start();
                if(!isset($_SESSION['username'])){
                    echo '<div class="col-md-offset-9  col-md-1">';
                        // $a= $_SESSION['username'];
                        // echo "<span style='color:red;'><b>". $a ."</b></span>"; 
                    echo '<a href="./admin/" style="font-size:17px; color:white;"  class="btn btn-primary" >Login</a>';
                    echo  "</div>";
                }
                    ?>


            

            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

            <?php
    include "./config.php";
    if(isset($_GET['cid'])){
    $cat_id=$_GET['cid'];
    }
    $sql = "SELECT * FROM category
    WHERE number_of_posts > 0
    ";

$result = mysqli_query($conn,$sql) or die('query failed : Category');
if(mysqli_num_rows($result)>0){
            ?>
                <ul class='menu'>
                    <li> <a href="./index.php">Home</a> </li>
                     <?php
                 while($row= mysqli_fetch_assoc($result)) { 
                    $active="";
                    if(isset($_GET['cid'])){

                        if($row['category_id']==$cat_id){
                            $active = "active";
                        }else{
                            $active="";
                        }

                    }
                  echo  "<li><a class='{$active}' href='category.php?cid={$row['category_id']}'> {$row['category_name']}  </a></li>";
                 } ?>
                </ul>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
