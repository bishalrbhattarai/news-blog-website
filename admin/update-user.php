<?php 
include "header.php";
if($_SESSION['user_role']=='0'){
    header('location:http://localhost/news-site/admin/post.php');
}

if(isset($_GET['submit'])){
    $u_id = $_GET['user_id'];
    $fname = $_GET['f_name'];
    $lname = $_GET['l_name'];
    $username = $_GET['username'];
    $role = $_GET['role'];
    include "./config.php";
$sql = "UPDATE user SET first_name = '$fname' ,last_name = '$lname', username = '$username' , role='$role'  
WHERE user_id ='$u_id'";
$result =  mysqli_query($conn,$sql);
if(mysqli_affected_rows($conn)){
        header('location:http://localhost/news-site/admin/users.php');
    }
    else{
        echo "<p style='color:red; text-align:center; ' > Cannot Update the User </p>";
    }

}


?>
<div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading">Modify User Details</h1>
              </div>
              <div class="col-md-offset-4 col-md-4">
                  <!-- Form Start -->
                  <?php
                    include "./config.php";
                    $id  = $_GET['id'];
                        $sql = "SELECT * FROM user
                        WHERE user_id = '$id'";
                        $result = mysqli_query($conn,$sql) or die('Query failed');
                          if(mysqli_num_rows($result)>0){
                            while($row = mysqli_fetch_assoc($result)){
                      ?>
                     <form  action="" method ="GET">
                        <div class="form-group">
<input type="hidden" name="user_id"  class="form-control" value=" <?php echo $row['user_id'] ?> " placeholder="" required>
                        </div>
                          <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="f_name" class="form-control" value="<?php
                          echo $row['first_name'];
                          ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="l_name" class="form-control" value="<?php
                          echo $row['last_name']
                          ?>
                          " placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="username" class="form-control" value="<?php
                          echo $row['username'];
                          ?>" placeholder="" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" value="<?php echo $row['role'];  ?>">
                          <?php
                            if($row['role']==1){
                               echo "<option value='1' selected>Admin</option>";
                               echo "<option value='0'>normal User</option>";
                            }
                            else{
                                echo "<option value='1'>Admin</option>";
                                echo "<option value='0' selected>normal User</option>";
                            }
                          ?>

                          </select>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>

                  <?php }} ?>
                  <!-- /Form -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
