<?php 
include('pages/header.php');
include('../classes/category.php'); 
include('../classes/brand.php'); 
include('../classes/product.php'); 
?>


<?php
$product= new Product();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // The request is using the POST method
    $sizes = $_POST['size'];
$colors = $_POST['color'];
  
	$insertproduct = $product->insertProduct($_POST,$_FILES,$sizes,$colors);
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Thêm sản phẩm</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="productlist.php">Danh sách sản phẩm</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container">
    <form action="productadd.php" method="POST" enctype="multipart/form-data">
        <?php 
        if(isset($insertproduct)){
            echo $insertproduct;
        } 
        ?>
      <div class="form-group">
        <label for="product">Tên sản phẩm</label>
        <input type="text" name="productName" class="form-control" id="product" aria-describedby="emailHelp" placeholder="Điền vào tên sản phẩm">
        <!-- <small id="emailHelp" class="form-text text-muted">Danh mục không được bỏ trống.</small> -->
      </div>
      <div class="form-goup">
        <label for="">Chọn danh mục</label>
        <select class="form-select" aria-label="Default select example" name="category">
         <option selected>Danh mục sản phẩm</option>
         <?php  
         $cate = new category();
         $show_cate =$cate -> show_category();
         if($show_cate){
        while($result= $show_cate->fetch_assoc()){
            ?>
         <option value="<?php echo $result['categoryId']?>"><?php echo $result['categoryName']; ?></option>
         <?php
        }
         }
         ?>
        </select>
      </div>
      <div class="form-goup">
        <label for="">Chọn thương hiệu</label>
        <select class="form-select" aria-label="Default select example" name="brand">
         <option selected>thương hiệu sản phẩm</option>
         <?php  
         $brand = new brand();
         $show_brand =$brand -> show_brand();
         if($show_brand){
   
        while($result= $show_brand->fetch_assoc()){

            ?>
         <option value="<?php echo $result['brandId']?>"><?php echo $result['brandName']; ?></option>
         <?php
        }
         }
         ?>
        </select>
      </div>
      <div class="form-group">
        <label for="product">Giá gốc sản phẩm</label>
        <input name="price" type="text"  class="form-control" id="product" aria-describedby="emailHelp" placeholder="Điền vào giá sản phẩm">
        <!-- <small id="emailHelp" class="form-text text-muted">Danh mục không được bỏ trống.</small> -->
      </div>

      <div class="form-group">
        <label for="product">Giá khuyến mãi </label>
        <input type="text" name="pricediscount" class="form-control" id="product" aria-describedby="emailHelp" placeholder="Điền vào giá khuyến mãi">
        <!-- <small id="emailHelp" class="form-text text-muted">Danh mục không được bỏ trống.</small> -->
      </div>
      <div class="form-group">
        <label for="formFile" class="form-label"> Chọn ảnh</label>
        <input class="form-control" type="file" id="formFile" name="image">
      </div>
      <div class="form-group">
        <label >Mô tả</label>
        <textarea name="productDes" id="" cols="30" rows="10" class="form-control"></textarea>
        <!-- <small id="emailHelp" class="form-text text-muted">Danh mục không được bỏ trống.</small> -->
      </div>
      <div class="form-goup">
        <label for="">Chọn loại</label>
        <select class="form-select" aria-label="Default select example" name="productType">
         <option selected>loại sản phẩm</option>
         <option value="1">Nổi bật</option>
         <option value="2">không nổi bật</option>
       <!-- featured:nổi bật , non-featured: ko nổi bật  -->
        </select>
      </div>
      <!-- Bên trong phần tử <form> trong productadd.php -->

<div class="form-group">
    <label for="product">Kích thước</label>
    <input type="text" name="size" class="form-control" id="product" placeholder="Nhập kích thước sản phẩm">
</div>

<div class="form-group">
    <label for="product">Màu sắc</label>
    <input type="text" name="color" class="form-control" id="product" placeholder="Nhập màu sắc sản phẩm">
</div>

         <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
</div>
<?php include('pages/footer.php')?>
