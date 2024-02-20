<?php include('pages/header.php')?>
<?php include('../classes/category.php') ?>
<?php
$cate= new category();
if (isset($_GET['deleteid'])) { 
  $id =$_GET['deleteid']; 
  $deletecategory = $cate->delete_category($id);
 }

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Danh sách danh mục</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active"><a href="categoryadd.php"> Thêm danh mục</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container">
      <?php 
      if(isset($deletecategory)){
        echo $deletecategory;
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
    $show_cate =$cate -> show_category();
    if($show_cate){
        $i=0; 
        while($result= $show_cate->fetch_assoc()){
            $i++; // Thêm dấu chấm phẩy ở đây
            ?>
            <tr>
              <th scope="row"><?php echo $result['categoryId'] ?></th>
              <td><?php echo $result['categoryName'] ?></td>
              <td><a class="btn btn-primary" href="categoryedit.php?categoryId=<?php echo $result['categoryId'] ;?>">Sửa</a> | <a class=" btn btn-danger" href="?deleteid=<?php echo $result['categoryId'] ;?>" onclick="return confirm('Are you sure you want to delete this data?')">Xóa</a> </td>
            </tr>
            <?php } // Đóng thẻ PHP ở đây
    }
    ?>
  
  </tbody>
</table>

    </div>
</div>
<?php include('pages/footer.php')?>