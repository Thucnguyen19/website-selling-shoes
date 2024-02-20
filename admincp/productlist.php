<?php include('pages/header.php')?>
<?php include('../classes/product.php') ?>
<?php include('../classes/category.php') ?>
<?php include('../classes/brand.php') ?>
<?php include_once('../helpers/format.php') ?>


<?php
$fm = new Format();
$product = new Product();
$deleteproduct = ""; // Khai báo trước để tránh lỗi khi sử dụng biến

if (isset($_GET['deleteid'])) { 
  $id = $_GET['deleteid']; 
  $deleteproduct = $product->delete_product($id);
}

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Danh sách sản phẩm</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active"><a href="productadd.php"> Thêm sản phẩm</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container">
        <?php 
      if(isset($deleteproduct)){
        echo $deleteproduct;
      }
      ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Danh mục sản phẩm</th>
                    <th scope="col">Thương hiệu</th>
                    <th scope="col">Giá gốc</th>
                    <th scope="col">Giá khuyến mãi</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Loại</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php  
    $show_product = $product->show_product();
    if($show_product){
        $i = 0; 
        while($result = $show_product->fetch_assoc()){
            $i++;
            ?>
                <tr>
                    <th scope="row"><?php echo $result['productId'] ?></th>
                    <td><?php echo $result['productName'] ?></td>
                    <td><img src="uploads/<?php echo $result['image'] ?>"
                            style="width:40px; height:40px; object-fit:cover"
                            alt="<?php echo $result['productName'] ?>"></td>
                    <td><?php echo $result['categoryName'] ?></td>
                    <td><?php echo $result['brandName'] ?></td>
                    <td><?php echo $result['price'] ?></td>
                    <td><?php echo $result['pricediscount'] ?></td>
                    <td><?php echo $fm->textShorten( $result['productDes'],30) ?></td>
                    <td><?php echo $result['productType'] ?></td>
                    <td><a class="btn btn-primary"
                            href="productedit.php?productId=<?php echo $result['productId'] ;?>">Sửa</a> | <a
                            class="btn btn-danger" href="?deleteid=<?php echo $result['productId'] ;?>"
                            onclick="return confirm('Are you sure you want to delete this data?')">Xóa</a> </td>
                </tr>
                <?php
        }
    }
    ?>
            </tbody>
        </table>
    </div>
</div>
<?php include('pages/footer.php')?>