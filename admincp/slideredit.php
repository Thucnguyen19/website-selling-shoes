<?php include('pages/header.php')?>
<?php include('../classes/slider.php') ?>
<?php
$slider = new slider();
if (!isset($_GET['sliderId']) || $_GET['sliderId'] == NULL) { 
    // The request is using the POST method
    echo "<script>window.location='sliderlist.php'</script>";
   }else{
    $id =$_GET['sliderId']; 
   }
   if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit']) ) {
 
    $updateslider = $slider->update_slider($_POST, $_FILES, $id);
   }

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Sửa slider</h1>
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
        <?php 
     $get_all_slider = $slider ->get_slider($id); // Sửa lại tên hàm
    //  var_dump($get_all_slider->fetch_assoc());// In ra dữ liệu trả về từ câu truy vấn để xem liệu nó chứa tất cả các cột dữ liệu hay không.
     if ($get_all_slider && $result = $get_all_slider->fetch_assoc()) {
            // ... Code hiển thị form
            ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <?php if(isset($updateslider)){
            echo $updateslider; // Thêm dấu chấm phẩy
        } ?>

            <div class="form-group">
                <label for="slider">Tên slider</label>
                <input type="text" value="<?php echo isset($result['sliderName']) ? $result['sliderName'] : ''; ?>"
                    name="sliderName" class="form-control" id="slider" aria-describedby="emailHelp"
                    placeholder="Điền vào tên sản phẩm">
                <!-- <small id="emailHelp" class="form-text text-muted">Danh mục không được bỏ trống.</small> -->
            </div>

            <div class="form-group">
                <label for="formFile" class="form-label"> Chọn ảnh</label>
                <input class="form-control" type="file" id="formFile" name="image">
            </div>
            <div class="">
                <img src="uploads/<?php echo isset($result['image']) ? $result['image'] : ''; ?>"
                    style="width:40px; height:40px; object-fit:cover" alt="<?php $result['sliderName'] ?>">
            </div>
            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="sliderDes" id="" cols="30" rows="10"
                    class="form-control"> <?php echo isset($result['sliderDes']) ? $result['sliderDes'] : ''; ?></textarea>
                <!-- <small id="emailHelp" class="form-text text-muted">Danh mục không được bỏ trống.</small> -->
            </div>
            <div class="form-goup">
                <label for="">Status</label>
                <select class="form-select" aria-label="Default select example" name="status">
                    <?php if($result['sliderType'] == 1){ ?>
                    <option value="1" selected>Ẩn</option>
                    <option value="2">Hiện</option>
                    <?php
         }else{?>
                    <option value="1">Ẩn</option>
                    <option value="2" selected>Hiện</option>
                    <?php } 
         ?>
                    <!-- featured:nổi bật , non-featured: ko nổi bật  -->
                </select>
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