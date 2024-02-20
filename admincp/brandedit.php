<?php include('pages/header.php')?>
<?php include('../classes/brand.php') ?>
<?php
$brand = new brand();
if (!isset($_GET['brandId']) || $_GET['brandId'] == NULL) { // Thay đổi NUll thành NULL
    // The request is using the POST method
    echo "<script>window.location='brandlist.php'</script>";
   }else{
    $id =$_GET['brandId']; // Sửa lại tên biến
   }
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // The request is using the GET method
    $brandName =$_POST['brandName'];
	$updatebrand = $brand->update_brand($brandName,$id);
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Sửa thương hiệu</h1>
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
    <form action="" method="POST"> 
        <?php if(isset($updatebrand)){
            echo $updatebrand; // Thêm dấu chấm phẩy
        } ?>
       
     <?php 
     $get_brand_name = $brand ->get_brand($id); // Sửa lại tên hàm
     if($get_brand_name){
        while($result=$get_brand_name->fetch_assoc()){
    ?>
        <div class="form-group">
        <label for="brand">Thương hiệu</label>
        <input value="<?php echo $result['brandName']?>" type="text" name="brandName" class="form-control" id="brand" aria-describedby="emailHelp" placeholder="Điền vào danh mục">
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
