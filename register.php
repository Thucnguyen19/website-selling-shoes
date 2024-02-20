<?php include('pages/header.php') ?>

<?php
$cus= new Customer();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // The request is using the POST method
  $customerName =$_POST['customerName'];
  $email =$_POST['email'];
  $phone_number =$_POST['phone_number'];
  $password =$_POST['password'];
	$insertCustomer = $cus->insert_customer($_POST);
}
?>
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">

        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>ĐĂNG KÝ TÀI KHOẢN</h1>
                <nav class="d-flex align-items-center">
                    <a href="index.php">TRANG CHỦ<span><i class="fa-solid fa-arrow-right"
                                style="color: #ffffff;"></i></span></a>
                    <a href="login.php">ĐĂNG NHẬP</a>
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
                        <h4>ĐĂNG KÝ TÀI KHOẢN ĐỂ TIẾN HÀNH ĐẶT HÀNG</h4>
                        <p>Mọi thông tin khách hàng sẽ được bảo mật tuyệt đối.</p>

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="login_form_inner" style="padding:0">
                    <h3>ĐĂNG KÝ TÀI KHOẢN</h3>
                    <form class="row login_form" action="" method="post">
                        <div class="col-md-12 form-">
                            <?php
                      if(isset($insertCustomer)){
                          echo $insertCustomer ;
                      }
                      ?>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="name" name="customerName" placeholder="Họ Tên"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Họ Tên'">
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="email" class="form-control" id="name" name="email" placeholder="Email"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="name" name="phone_number"
                                placeholder="Số điện thoại" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Số điện thoại'">
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Mật khẩu" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Mật khẩu'">
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                                placeholder="Xác nhận mật khẩu" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Xác nhận mật khẩu'">
                            <span id="password_match"></span>
                        </div>

                        <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            var passwordInput = document.getElementById("password");
                            var confirmInput = document.getElementById("confirm_password");
                            var matchSpan = document.getElementById("password_match");

                            passwordInput.addEventListener("input", function() {
                                validatePassword();
                            });

                            confirmInput.addEventListener("input", function() {
                                validatePassword();
                            });

                            function validatePassword() {
                                var passwordValue = passwordInput.value;
                                var confirmValue = confirmInput.value;

                                if (passwordValue === confirmValue) {
                                    matchSpan.innerHTML = "Mật khẩu khớp";
                                    matchSpan.style.color = "green";
                                } else {
                                    matchSpan.innerHTML = "Mật khẩu không khớp";
                                    matchSpan.style.color = "red";
                                }
                            }
                        });
                        </script>


                        <div class="col-md-12 form-group">
                            <div class="creat_account">
                                <input type="checkbox" id="f-option2" name="selector">
                                <label for="f-option2">Lưu thông tin cho lần đăng nhập sau</label>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" value="submit" name="submit" class="primary-btn">ĐĂNG KÝ</button>
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