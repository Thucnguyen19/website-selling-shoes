<?php include('pages/header.php')?>
<?php include('../classes/product.php') ?>
<?php include('../classes/category.php') ?>
<?php include('../classes/brand.php') ?>

<?php
$product = new product();
if (!isset($_GET['productId']) || $_GET['productId'] == NULL) { 
    // The request is using the POST method
    echo "<script>window.location='productlist.php'</script>";
   }else{
    $id =$_GET['productId']; 
   }
   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']) ) {
 
    $updateproduct = $product->update_product($_POST, $_FILES, $id);
   }

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Sửa sản phẩm</h1>
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
        <?php 
     $get_all_product = $product ->get_product($id); // Sửa lại tên hàm
    //  var_dump($get_all_product->fetch_assoc());// In ra dữ liệu trả về từ câu truy vấn để xem liệu nó chứa tất cả các cột dữ liệu hay không.
     if ($get_all_product && $result = $get_all_product->fetch_assoc()) {
            // ... Code hiển thị form
            ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <?php if(isset($updateproduct)){
            echo $updateproduct; // Thêm dấu chấm phẩy
        } ?>

            <div class="form-group">
                <label for="product">Tên sản phẩm</label>
                <input type="text" value="<?php echo isset($result['productName']) ? $result['productName'] : ''; ?>"
                    name="productName" class="form-control" id="product" aria-describedby="emailHelp"
                    placeholder="Điền vào tên sản phẩm">
                <!-- <small id="emailHelp" class="form-text text-muted">Danh mục không được bỏ trống.</small> -->
            </div>

            <div class="form-group">
                <label for="product">Giá gốc sản phẩm</label>
                <input name="price" value="<?php echo isset($result['price']) ? $result['price'] : ''; ?>" type="text"
                    class="form-control" id="product" aria-describedby="emailHelp" placeholder="Điền vào giá sản phẩm">
                <!-- <small id="emailHelp" class="form-text text-muted">Danh mục không được bỏ trống.</small> -->
            </div>

            <div class="form-group">
                <label for="product">Giá khuyến mãi </label>
                <input type="text"
                    value="<?php echo isset($result['pricediscount']) ? $result['pricediscount'] : ''; ?>"
                    name="pricediscount" class="form-control" id="product" aria-describedby="emailHelp"
                    placeholder="Điền vào giá khuyến mãi">
                <!-- <small id="emailHelp" class="form-text text-muted">Danh mục không được bỏ trống.</small> -->
            </div>
            <div class="form-group">
                <label for="formFile" class="form-label"> Chọn ảnh</label>
                <input class="form-control" type="file" id="formFile" name="image">
            </div>
            <div class="">
                <img src="uploads/<?php echo isset($result['image']) ? $result['image'] : ''; ?>"
                    style="width:40px; height:40px; object-fit:cover" alt="<?php $result['productName'] ?>">
            </div>
            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="productDes" id="" cols="30" rows="10"
                    class="form-control"> <?php echo isset($result['productDes']) ? $result['productDes'] : ''; ?></textarea>
                <!-- <small id="emailHelp" class="form-text text-muted">Danh mục không được bỏ trống.</small> -->
            </div>
            <div class="form-goup">
                <label for="">Chọn loại</label>
                <select class="form-select" aria-label="Default select example" name="productType">
                    <option>Loại sản phẩm</option>
                    <?php if($result['productType'] == 1){ ?>
                    <option value="1" selected>Nổi bật</option>
                    <option value="2">không nổi bật</option>
                    <?php
         }else{?>
                    <option value="1">Nổi bật</option>
                    <option value="2" selected>không nổi bật</option>
                    <?php } 
         ?>
                    <!-- featured:nổi bật , non-featured: ko nổi bật  -->
                </select>
            </div>
            <div class="form-goup">
                <label for="">Chọn danh mục</label>
                <select class="form-select" aria-label="Default select example" name="category">
                    <option>Danh mục sản phẩm</option>
                    <?php 
         $cate = new category();
         $catelist =$cate->show_category();
         if($catelist){
            while($result_cate = $catelist->fetch_assoc()){
                ?>
                    <option <?php if($result_cate['categoryId'] == $result['categoryId']) {echo 'selected' ;} ?>
                        value="<?php echo $result_cate['categoryId'] ?>"> <?php echo $result_cate['categoryName'] ?>
                    </option>
                    <?php
            }
         }
         ?>

                </select>
            </div>
            <div class="form-goup">
                <label for="">Chọn thương hiệu</label>
                <select class="form-select" aria-label="Default select example" name="brand">
                    <option>Thương hiệu sản phẩm</option>
                    <?php 
         $brand = new brand();
         $brandlist =$brand->show_brand();
         if($brandlist){
            while($result_brand = $brandlist->fetch_assoc()){
                ?>
                    <option <?php if($result_brand['brandId'] == $result['brandId']) {echo 'selected' ;} ?>
                        value="<?php echo $result_brand['brandId'] ?>"> <?php echo $result_brand['brandName'] ?>
                    </option>
                    <?php
            }
         }
         ?>
                </select>
            </div>
            <div class="form-group">
                <label for="sizes">Kích thước</label>
                <input type="text" value="<?php echo isset($result['sizes']) ? $result['sizes'] : ''; ?>" name="sizes"
                    class="form-control" id="sizes" placeholder="Nhập các size, cách nhau bằng dấu phẩy">
            </div>
            <div class="form-group">
                <label for="colors">Màu</label>
                <input type="text" value="<?php echo isset($result['colors']) ? $result['colors'] : ''; ?>"
                    name="colors" class="form-control" id="colors" placeholder="Nhập các màu, cách nhau bằng dấu phẩy">
            </div>

            <button type="submit" name="submit" class="btn btn-primary" Value="Edit">Cập nhật</button>
        </form>
        <?php
        }
     else {
        // Xử lý khi không tìm thấy sản phẩm
        echo "Không tìm thấy sản phẩm.";
    }
    
    ?>


    </div>
</div>
<?php include('pages/footer.php')?>