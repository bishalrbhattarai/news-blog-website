<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                  <?php
include "./config.php";

if(isset($_GET['search'])){
    $search_term = mysqli_real_escape_string($conn,$_GET['search']);
    }


    // print_r($row1);
     ?>
                  <h2 class="page-heading">Search : <?php echo $search_term;  ?></h2>
                  <?php




$limit = 3;

if(isset($_GET['page'])){
   $page = $_GET['page'];
}

else{
   $page = 1; 
}

   $offset = ($page - 1)*$limit;

 $sql = "SELECT * FROM post
LEFT JOIN category ON post.category = category.category_id
LEFT JOIN user ON post.author = user.user_id
WHERE post.title LIKE   '%{$search_term}%' OR
post.description LIKE   '%{$search_term}%'
ORDER BY post_id ASC LIMIT {$offset},{$limit}" ; 

$result = mysqli_query($conn,$sql) or die('query failed');
if(mysqli_num_rows($result)>0){
while($row= mysqli_fetch_assoc($result)) { ?>

<div class="post-content">
<div class="row">
<div class="col-md-4">
    <a class="post-img" href="single.php?id=<?php echo$row['post_id']; ?> "><img src="admin/upload/<?php echo $row['post_img']; ?>" alt=""/></a>
</div>
<div class="col-md-8">
    <div class="inner-content clearfix">
        <h3><a href='single.php?id=<?php echo $row['post_id']; ?>'> <?php echo $row['title']; ?> </a></h3>
        <div class="post-information">
            <span>
                <i class="fa fa-tags" aria-hidden="true"></i>
                <a href='category.php?cid=<?php echo $row['category'] ?>'>  <?php echo $row['category_name'];  ?>        </a>
            </span>
            <span>
                <i class="fa fa-user" aria-hidden="true"></i>
                <a href='author.php?aid=<?php echo $row['author']; ?>'> <?php echo $row['username'];  ?>     </a>
            </span>
            <span>
            <i class="fa fa-calendar" aria-hidden="true"></i>
            <?php  echo $row['post_date']; ?>
            </span>
        </div>
        <p class="description">
            <?php echo substr($row['description'],0,10)."..."; ?>
        </p>
        <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id']; ?>'>read more</a>
    </div>
</div>
</div>
</div>


<?php
}
}else{
echo "<h2>No Record Found.</h2>";
}
?>
<?php
    $sql1 = "SELECT * FROM post  
   WHERE post.title LIKE '%{$search_term}%'  OR
   post.description LIKE   '%{$search_term}%'
   ";
   $result1 = mysqli_query($conn,$sql1) or die('query failed');

if(mysqli_num_rows($result1)>0){
$totalRecord = mysqli_num_rows($result1);

$totalPage = ceil($totalRecord/$limit);
echo "<ul class='pagination admin-pagination'>";
if($page>1){
$page--;
echo "<li><a href='author.php?search={$search_term}&page={$page}'>Prev</a></li>";
}
for($i=1;$i<=$totalPage;$i++){

if($i == $page){
$active="active";
}
else{
$active='';
}
echo  "<li class='{$active}'><a href='category.php?search={$search_term}&page={$i}'>{$i}</a></li>";
} 
if($totalPage>$page){
++$page;
echo "<li><a href='category.php?search={$search_term}&page={$page}'>Next</a></li>";
}
echo "</ul>";
}

?>
                
                



                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
