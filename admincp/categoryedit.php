<?php include('pages/header.php')?>
<?php include('../classes/category.php') ?>
<?php
$cate = new category();
if (!isset($_GET['categoryId']) || $_GET['categoryId'] == NULL) { // Thay đổi NUll thành NULL
    // The request is using the POST method
    echo "<script>window.location='categorylist.php'</script>";
   }else{
    $id =$_GET['categoryId']; // Sửa lại tên biến
   }
   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // The request is using the GET method
    $categoryName =$_POST['categoryName'];
	$updateCategory = $cate->update_category($categoryName,$id);
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Sửa danh mục</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="categorylist.php">Danh sách thương hiệu</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container">
    <form action="" method="POST"> 
        <?php if(isset($updateCategory)){
            echo $updateCategory; // Thêm dấu chấm phẩy
        } ?>
       
     <?php 
     $get_cate_name = $cate ->get_category($id); // Sửa lại tên hàm
     if($get_cate_name){
        while($result=$get_cate_name->fetch_assoc()){
    ?>
        <div class="form-group">
        <label for="category">Danh mục sản phẩm</label>
        <input value="<?php echo $result['categoryName']?>" type="text" name="categoryName" class="form-control" id="category" aria-describedby="emailHelp" placeholder="Điền vào danh mục">
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
