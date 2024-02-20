<?php include('pages/header.php')?>
<?php include('../classes/CategoryBlog.php') ?>
<?php
$cate = new CategoryBlog();
if (!isset($_GET['category_blogId']) || $_GET['category_blogId'] == NULL) { // Thay đổi NUll thành NULL
    // The request is using the POST method
    echo "<script>window.location='category_bloglist.php'</script>";
   }else{
    $id =$_GET['category_blogId']; // Sửa lại tên biến
   }
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // The request is using the GET method
    $category_blogName =$_POST['category_blogName'];
	$updateCategory_blog = $cate->update_category_blog($category_blogName,$id);
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Sửa danh mục tin tức</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active"><a href="category_bloglist.php">Danh sách danh mục tin
                                tức</a>
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container">
        <form action="" method="POST">
            <?php if(isset($updateCategory_blog)){
            echo $updateCategory_blog; // Thêm dấu chấm phẩy
        } ?>

            <?php 
     $get_cate_name = $cate ->get_category_blog($id); // Sửa lại tên hàm
     if($get_cate_name){
        while($result=$get_cate_name->fetch_assoc()){
    ?>
            <div class="form-group">
                <label for="category_blog">Danh mục tin tức</label>
                <input value="<?php echo $result['category_blogName']?>" type="text" name="category_blogName"
                    class="form-control" id="category_blog" aria-describedby="emailHelp"
                    placeholder="Điền vào danh mục">
                <!-- <small id="emailHelp" class="form-text text-muted">Danh mục không được bỏ trống.</small> -->
            </div>
            <?php
           }
        }
      ?>
            <button type="submit" name="submit" class="btn btn-primary" Value="Edit">Submit</button>
        </form>
    </div>
</div>
<?php include('pages/footer.php')?>