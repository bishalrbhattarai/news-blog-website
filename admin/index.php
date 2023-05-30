<?php

session_start();
if(isset($_SESSION['username'])){
    header('location:http://localhost/news-site/admin/users.php');  
}

?>

<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ADMIN | Login</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <img class="logo" src="images/news.jpg">
                        <h3 class="heading">Admin</h3>
                        <!-- Form Start -->
                        <form  action="<?php echo $_SERVER['PHP_SELF']; ?>" method ="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="">
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="login" />
                        </form>
                        <!-- /Form  End -->

                        <?php
                        if(isset($_POST['login'])){
                            $username=$password='';

                            include "./config.php";
                            $username=  $_POST['username'];
                            $password= md5($_POST['password']);
                            
                            if(empty($username) and empty($password)){   
                                echo "<div style='alert alert-danger'>Username and password  is empty </div>";
                                die();
                            }
                           else if(empty($username)){   
                                echo "<div style='alert alert-danger'>Username  is empty </div>";
                                die();
                            }
                           else if(empty($password)){
                                echo "<div style='alert alert-danger'>Password  is empty </div>";
                                die();
                            }

                            $sql = "SELECT * FROM user 
                            WHERE username = '$username' AND password='$password' ";    
            $result = mysqli_query($conn,$sql) or die('Query Failed');    
                            $noOfRows = mysqli_num_rows($result);                    
                               if($noOfRows==1)  {
                            $row = mysqli_fetch_assoc($result);
                                session_start();    
                                $_SESSION['username'] = $row['username'];
                                $_SESSION['user_id'] = $row['user_id'];
                                $_SESSION['user_role'] = $row['role'];
                            
                            header("location:http://localhost/news-site/admin/post.php");   

                            } 
                            
                            else{
                            echo "<div style='alert alert-danger'>Username and Password doesnot match </div>";
                            }
                        }   

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
