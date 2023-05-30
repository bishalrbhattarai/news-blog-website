<?php include "header.php"; 

// if($_SESSION['user_role']=='0'){
//     header('location:http://localhost/news-site/admin/post.php');
// }
?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <?php
        include "./config.php";
        $post_id = $_GET['id'];
        $sql = "SELECT * FROM post
        LEFT JOIN category ON post.category = category.category_id
        LEFT JOIN user ON post.author = user.user_id
        WHERE post.post_id = {$post_id} ";

$result = mysqli_query($conn,$sql) or die('query failed');
if(mysqli_num_rows($result)>0){
    while($row= mysqli_fetch_assoc($result)){
        ?>
    
    <!-- Form for show edit-->
        <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $row['post_id'];  ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $row['title'];  ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5">
                   <?php echo $row['description']; ?>
                </textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
                    <option disabled> Select Category </option>
                <?php
                        include "./config.php";
                        $sql1 = "SELECT * FROM category";
                        $result1 = mysqli_query($conn,$sql1);
                        if(mysqli_num_rows($result1)>0){
                            while($row1= mysqli_fetch_assoc($result1)){

                                if($row['category']==$row1['category_id']){
                                    $selected = "selected";
                                }else{
                                    $selected ="";
                                }
                                echo "<option {$selected} value=".$row1['category_id'].">".$row1['category_name'] ."</option>";
                            
                            }
                        }
                      ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Post image</label>
                <br>
                
                <input type="file" value="bishal.jpg" name="new-image" id="img" style="display:none;">
                
                     <label for="img" id="change" class="btn btn-info">update image</label> 
                  <br> <br> 
                <img id="old_img" src="upload/<?php echo $row['post_img'];?>" height="150px">
                        
                <input type="hidden" name="old_image" value="<?php echo $row['post_img'];?>">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <?php 
          }
         }else{
            echo "<div class='alert alert-danger' style='text-align:center;'>
            Result not found 
            </div>";
         }
     ?>
        <!-- Form End -->
      </div>
    </div>
  </div>
</div>
<!-- <script>

        //  if(x.files.length>0){
        //     console.log
        //  }
        let x = document.querySelector('input[type="file"]')
        x.addEventListener('change',()=>{
                   let arr = x.value.split("fakepath")
                     let path = arr[1].substr(1)
                    //  C:\Users\bisha\Pictures\Screenshots
                    console.log(path)
                let old = document.querySelector('#old_img')
                    old.style.display ='none';
                // let new = document.querySelector('#new_img')
                //     new.style.display = 'block'
                //     new.src="uploads/path"
                let b = document.getElementsByClassName('new_img')
                    console.log(b[0])
                    b[0].src="./Screenshots/path"                
        })
</script> -->
<?php include "footer.php"; ?>
