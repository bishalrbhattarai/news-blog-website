<?php include "header.php";
if($_SESSION['user_role']=='0'){
  header('location:http://localhost/news-site/admin/post.php');
}
?>
<?php
$id  = $_GET['id'];
include "./config.php";
 if(isset($_POST['submit'])){
         $categoryName = $_POST['cat_name'];
         $cat_id = $_POST['cat_id'];
         echo $categoryName."<br>".$cat_id;
       $result =  mysqli_query($conn," UPDATE category SET category_name = '$categoryName' WHERE category_id = '$cat_id'");
       if(mysqli_affected_rows($conn)){
            header("location:http://localhost/news-site/admin/category.php");
       }
            else{
            echo "<h2 style='text-align:center; color:red;'> Sorry the category cannot be updated </h2>";
         }

 }
?>
<div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
              <?php 
                    
                        $sql = "SELECT * FROM category
                        WHERE category_id = '$id'";
                        $result = mysqli_query($conn,$sql) or die('Query failed');
                          if(mysqli_num_rows($result)>0){
                            while($row = mysqli_fetch_assoc($result)){
                      ?>
                  <form action="" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="
                          <?php echo $row['category_id'];  ?>
                          " placeholder="">
                      </div>

                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php
                        echo $row['category_name'];  ?>"   required>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php }} ?>
                </div>
              </div>
            </div>
          </div>

<?php
//  include "footer.php";
 ?>
