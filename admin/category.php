<?php include "header.php";
if($_SESSION['user_role']=='0'){
    header('location:http://localhost/news-site/admin/post.php');
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
            <?php
include "./config.php";
$limit=3;
if(isset($_GET['page'])){
$page = $_GET['page'];
}
else {
    $page= 1;
}
    $offset = ($page - 1)*$limit;
$sql = "SELECT * FROM category ORDER BY category_id ASC lIMIT {$offset},{$limit}";
$result = mysqli_query($conn,$sql) or die('Query failed');

if(mysqli_num_rows($result)>0){
    ?>
    <table class="content-table">
    <thead>
        <th>S.No.</th>
        <th>Category Name</th>
        <th>No. of Posts</th>
        <th>Edit</th>
        <th>Delete</th>
    </thead>
    <tbody>
<?php
  while($row = mysqli_fetch_assoc($result)){
    echo  "<tr>";
    echo "<td>".$row['category_id']."</td>";
    echo "<td>".$row['category_name']."</td>";
    echo "<td>".$row['number_of_posts']."</td>";
    echo "<td class='edit'><a href='update-category.php?id=".$row['category_id']."'><i class='fa fa-edit'></i></a></td>";
    echo "<td class='delete'><a href='delete-category.php?id=".$row['category_id']."'><i class='fa fa-edit'></i></a></td>";
  }
     ?>
             </tbody>
             <?php   
                          
                   ?>
                </table>
                <?php
                    }
echo "<ul class='pagination admin-pagination'>";
                $res = mysqli_query($conn,"SELECT * FROM category") or die('Query Failed');
                if(mysqli_num_rows($res)){
                             $totalRecord= mysqli_num_rows($res);  
                            
                             $totalPage = ceil($totalRecord/$limit);
                             echo "<ul class='pagination admin-pagination'>";
                             if($page>1){
                                 $page--;
                             echo "<li><a href='category.php?page=$page'>Prev</a></li>";
                             }
                             for($i=1;$i<=$totalPage;$i++){
         
                                 if($i == $page){
                                     $active="active";
                                 }
                                 else{
                                     $active='';
                                 }
                                     echo  "<li class='$active'><a href='category.php?page={$i}'>{$i}</a></li>";
                             } 
                             if($totalPage>$page){
                                 $page++;
                             echo "<li><a href='category.php?page=$page'>Next</a></li>";
                             }
                             echo "</ul>";
                         }
?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>
