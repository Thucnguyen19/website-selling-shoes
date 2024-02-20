<?php 
include_once('pages/header.php');
include_once('../classes/adminlogin.php'); 
?>


<?php
$admin= new adminlogin();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // The request is using the POST method
	$insertadmin = $admin->insert_admin($_POST);
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Thêm tài khoản admin</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active"><a href="adminlist.php">Danh sách tài khoản</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container">
        <form action="" method="POST">
            <?php 
             if(isset($insertadmin)){
                echo $insertadmin;
             }
            ?>
            <div class="mb-3">
                <label for="adminName" class="form-label">Họ Tên</label>
                <input type="text" name="adminName" class="form-control" id="adminName">

            </div>
            <div class="form-goup">
                <label for="">Giới tính</label>
                <select class="form-select" aria-label="Default select example" name="sex">
                    <option value="0">Nam</option>
                    <option value="1">Nữ</option>
                    <option value="2">Khác</option>
                    <!-- featured:nổi bật , non-featured: ko nổi bật  -->
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" name="adminEmail" class="form-control" id="exampleInputEmail1">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="adminName" class="form-label">Tên tài khoản</label>
                <input type="text" name="adminUser" class="form-control" id="adminName">

            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                <input type="password" name="adminPass" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="form-goup">
                <label for="">Level</label>
                <select class="form-select" aria-label="Default select example" name="level">
                    <option value="0">admin</option>
                    <option value="1">Người dùng</option>
                    <option value="2">Khác</option>
                    <!-- featured:nổi bật , non-featured: ko nổi bật  -->
                </select>
            </div>


            <button type="submit" name="submit" class="btn btn-primary">Đăng ký</button>
        </form>
    </div>
</div>




<?php include('pages/footer.php')?>