<?php include('pages/header.php') ?>

<?php
$class= new Customer();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['submit']) {
    // The request is using the POST method
    $username =$_POST['username'];
    $password =$_POST['password'];
	$login_check = $class->login_customer($username,$password);
}
?>
	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>TRANG ĐĂNG NHẬP</h1>
					<nav class="d-flex align-items-center">
						<a href="index.php">TRANG CHỦ<span><i class="fa-solid fa-arrow-right" style="color: #ffffff;"></i></span></a>
						<a href="register.php">ĐĂNG KÝ TÀI KHOẢN</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Login Box Area =================-->
	<section class="login_box_area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<img class="img-fluid" src="img/login.jpg" alt="">
						<div class="hover">
							<h4>Bạn chưa có tài khoản ?</h4>
							<p>Nếu chưa có mời bạn bấm vào nút đăng ký tài khoản bên dưới</p>
							<a class="primary-btn" href="register.php">TẠO TÀI KHOẢN</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h3>ĐĂNG NHẬP ĐỂ TIẾP TỤC</h3>
						<form class="row login_form" action="" method="post" style="padding:0">
						<div class="col-md-12 form-">
							<?php
							if(isset($login_check)){
								echo $login_check;
							}
							?>
						</div>
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="name" name="username" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Tên đăng nhập'">
							</div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="name" name="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Mật khẩu'">
							</div>
							<div class="col-md-12 form-group">
								<div class="creat_account">
									<input type="checkbox" id="f-option2" name="selector">
									<label for="f-option2">Lưu thông tin cho lần đăng nhập sau</label>
								</div>
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" name="submit" value="submit" class="primary-btn">ĐăNG NHẬP</button>
								<a href="#">Quên mật khẩu ?</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->

	<?php include('pages/footer.php') ?>
