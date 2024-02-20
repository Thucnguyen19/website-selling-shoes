<?php include('pages/header.php')?>
<?php include('../classes/brand.php') ?>
<?php
$brand= new brand();
if (isset($_GET['deleteid'])) { 
  $id =$_GET['deleteid']; 
  $deletebrand = $brand->delete_brand($id);
 }

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Danh sách thương hiệu</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="brandadd.php"> Thêm thương hiệu</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container">
      <?php 
      if(isset($deletebrand)){
        echo $deletebrand;
      }
      ?>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Tên danh mục</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php  
    $show_cate =$brand -> show_brand();
    if($show_cate){
        $i=0; 
        while($result= $show_cate->fetch_assoc()){
            $i++; // Thêm dấu chấm phẩy ở đây
            ?>
            <tr>
              <th scope="row"><?php echo $result['brandId'] ?></th>
              <td><?php echo $result['brandName'] ?></td>
              <td><a class="btn btn-primary" href="brandedit.php?brandId=<?php echo $result['brandId'] ;?>">Sửa</a> | <a class=" btn btn-danger" href="?deleteid=<?php echo $result['brandId'] ;?>" onclick="return confirm('Are you sure you want to delete this data?')">Xóa</a> </td>
            </tr>
            <?php } // Đóng thẻ PHP ở đây
    }
    ?>
  
  </tbody>
</table>

    </div>
</div>
<?php include('pages/footer.php')?>