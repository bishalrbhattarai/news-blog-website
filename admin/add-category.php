<?php include "header.php";
if($_SESSION['user_role']=='0'){
    header('location:http://localhost/news-site/admin/post.php');
}
if(isset($_POST['save'])){
    include "./config.php";
    $category = $_POST['cat'];
     $result = mysqli_query($conn,"SELECT * FROM category WHERE category_name = '$category'") or die('Query Failed');
     if(mysqli_num_rows($result)>0){  
     echo "<p style='text-align:center; background-color:red;'>this category already exists </p>"; 
     }
    else{
        $posts = 0;
        if(mysqli_query($conn,"INSERT INTO category(category_name,number_of_posts)VALUES('$category',$posts)")){
            header('location:category.php');
        }
        else{
       echo "<p style='text-align:center; background-color:red; '> error adding the category </p>"; 
        }
    }
}
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
