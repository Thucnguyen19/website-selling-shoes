<?php include('pages/header.php')?>
<?php include_once('../classes/adminlogin.php') ?>
<?php
$admin= new adminlogin();
if (isset($_GET['deleteid'])) { 
  $id =$_GET['deleteid']; 
  $deleteadmin = $cate->delete_admin($id);
 }

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Danh sách tài khoản</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active"><a href="adminadd.php"> Thêm tài khoản</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container">
        <?php 
      if(isset($deleteadmin)){
        echo $deleteadmin;
      }
      ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên tài khoản</th>
                    <th scope="col">Giới tính</th>
                    <th scope="col">Cấp độ</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php  
    $show_admin =$admin  -> show_admin();
    if($show_admin){
        while($result= $show_admin->fetch_assoc()){
            ?>
                <tr>
                    <th scope="row"><?php echo $result['admin_id'] ?></th>
                    <td><?php echo $result['adminName'] ?></td>
                    <td><?php  if($result['sex']==0){ echo 'Nữ' ;} elseif($result['sex']==1){echo 'Nam';}else{echo 'other';}; ?>
                    <td><?php  if($result['level']==0){ echo 'Admin' ;} elseif($result['level']==1){echo 'Người dùng';}else{echo 'other';}; ?>
                    </td>
                    <td><a class="btn btn-primary"
                            href="adminedit.php?adminId=<?php echo $result['admin_id'] ;?>">Sửa</a> | <a
                            class=" btn btn-danger" href="?deleteid=<?php echo $result['admin_id'] ;?>"
                            onclick="return confirm('Are you sure you want to delete this data?')">Xóa</a> </td>
                </tr>
                <?php } // Đóng thẻ PHP ở đây
    }
    ?>

            </tbody>
        </table>

    </div>
</div>
<?php include('pages/footer.php')?>