<?php include('pages/header.php')?>
<?php include('../classes/slider.php') ?>

<?php include_once('../helpers/format.php') ?>


<?php
$fm = new Format();
$slider = new slider();
$deleteslider = ""; // Khai báo trước để tránh lỗi khi sử dụng biến

if (isset($_GET['deleteid'])) { 
  $id = $_GET['deleteid']; 
  $deleteslider = $slider->delete_slider($id);
}

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Danh sách slider</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active"><a href="slideradd.php"> Thêm slider</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container">
        <?php 
      if(isset($deleteslider)){
        echo $deleteslider;
      }
      ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên slider</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Mô tả</th>
                    <th scope="col">Ẩn/ Hiện</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php  
    $show_slider = $slider->show_slider();
    if($show_slider){
        $i = 0; 
        while($result = $show_slider->fetch_assoc()){
            $i++;
            ?>
                <tr>
                    <th scope="row"><?php echo $result['sliderId'] ?></th>
                    <td><?php echo $result['sliderName'] ?></td>
                    <td><img src="uploads/<?php echo $result['image'] ?>"
                            style="width:40px; height:40px; object-fit:cover" alt="<?php echo $result['sliderName'] ?>">
                    </td>
                    <td><?php echo $result['sliderDes'] ?></td>
                    <td><?php if( $result['status']==1){echo 'Ẩn';}else{echo'Hiện';} ?></td>
                    <td><a class="btn btn-primary"
                            href="slideredit.php?sliderId=<?php echo $result['sliderId'] ;?>">Sửa</a> | <a
                            class="btn btn-danger" href="?deleteid=<?php echo $result['sliderId'] ;?>"
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