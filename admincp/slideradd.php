<?php 
include('pages/header.php');
include('../classes/slider.php'); 
?>


<?php
$slider= new slider();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
  
	$insertslider = $slider->insertslider($_POST,$_FILES);
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Thêm slider</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active"><a href="sliderlist.php">Danh sách slider</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container">
        <form action="slideradd.php" method="POST" enctype="multipart/form-data">
            <?php 
        if(isset($insertslider)){
            echo $insertslider;
        } 
        ?>
            <div class="form-group">
                <label for="slider">Tên slider</label>
                <input type="text" name="sliderName" class="form-control" id="slider" aria-describedby="emailHelp"
                    placeholder="Điền vào tên sản phẩm">
                <!-- <small id="emailHelp" class="form-text text-muted">Danh mục không được bỏ trống.</small> -->
            </div>

            <div class="form-group">
                <label for="formFile" class="form-label"> Chọn ảnh</label>
                <input class="form-control" type="file" id="formFile" name="image">
            </div>
            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="sliderDes" id="" cols="30" rows="10" class="form-control"></textarea>
                <!-- <small id="emailHelp" class="form-text text-muted">Danh mục không được bỏ trống.</small> -->
            </div>
            <div class="form-goup">
                <label for="">Status</label>
                <select class="form-select" aria-label="Default select example" name="status">
                    <option value="1">Ẩn</option>
                    <option value="2">Hiện</option>
                    <!-- featured:nổi bật , non-featured: ko nổi bật  -->
                </select>
            </div>
            <!-- Bên trong phần tử <form> trong slideradd.php -->


            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>
<?php include('pages/footer.php')?>