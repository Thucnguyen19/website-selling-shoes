<?php include('pages/header.php')?>
<?php include('../classes/CategoryBlog.php') ?>
<?php
$cate= new CategoryBlog();
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    // The request is using the POST method
    $category_blogName =$_POST['category_blogName'];
	$insertCategory_blog = $cate->insert_category_blog($category_blogName);
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Thêm danh mục tin tức</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active"><a href="category_bloglist.php">Danh sách danh mục</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container">
        <form action="category_blogadd.php" method="POST">
            <?php if(isset($insertCategory_blog)){
            echo $insertCategory_blog;
        } ?>
            <div class="form-group">
                <label for="category_blog">Danh mục tin tức</label>
                <input type="text" name="category_blogName" class="form-control" id="category_blog"
                    aria-describedby="emailHelp" placeholder="Điền vào danh mục">
                <!-- <small id="emailHelp" class="form-text text-muted">Danh mục không được bỏ trống.</small> -->
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<?php include('pages/footer.php')?>