<?php include('pages/header.php')?>
<?php include('../classes/category.php') ?>
<?php
$cate= new category();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // The request is using the POST method
    $categoryName =$_POST['categoryName'];
	$insertCategory = $cate->insert_category($categoryName);
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Thêm danh mục</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="categorylist.php">Danh sách danh mục</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container">
    <form action="categoryadd.php" method="POST">
        <?php if(isset($insertCategory)){
            echo $insertCategory;
        } ?>
      <div class="form-group">
        <label for="category">Danh mục sản phẩm</label>
        <input type="text" name="categoryName" class="form-control" id="category" aria-describedby="emailHelp" placeholder="Điền vào danh mục">
        <!-- <small id="emailHelp" class="form-text text-muted">Danh mục không được bỏ trống.</small> -->
      </div>
    
      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
</div>
<?php include('pages/footer.php')?>
