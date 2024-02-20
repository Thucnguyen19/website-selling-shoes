<?php include('pages/header.php')?>
<?php include('../classes/brand.php') ?>


<?php
$brand= new brand();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // The request is using the POST method
    $brandName =$_POST['brandName'];
	$insertbrand = $brand->insert_brand($brandName);
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Thêm thương hiệu</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="brandlist.php">Danh sách thương hiệu</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container">
    <form action="brandadd.php" method="POST">
        <?php if(isset($insertbrand)){
            echo $insertbrand;
        } ?>
      <div class="form-group">
        <label for="brand">Danh mục sản phẩm</label>
        <input type="text" name="brandName" class="form-control" id="brand" aria-describedby="emailHelp" placeholder="Điền vào danh mục">
        <!-- <small id="emailHelp" class="form-text text-muted">Danh mục không được bỏ trống.</small> -->
      </div>
    
      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
</div>
<?php include('pages/footer.php')?>
