<?php include('pages/header.php') ?>
<?php 
				$contact = new Contact();
				if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
					$name =$_POST['name'];
					$email =$_POST['email'];
					$subject =$_POST['subject'];
					$message =$_POST['message'];
					$insert_contact =$contact->insert_contact($_POST);
				}
				

				?>

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>LIÊN HỆ VỚI CHÚNG TÔI</h1>
                <nav class="d-flex align-items-center">
                    <a href="index.php">TRANG CHỦ<span><i class="fa-solid fa-arrow-right"
                                style="color: #ffffff;"></i></span></a>
                    <a href="category.php">LIÊN HỆ</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Contact Area =================-->
<section class="contact_area section_gap_bottom">
    <div class="container">
        <!-- <div id="mapBox" class="mapBox" data-lat="40.701083" data-lon="-74.1522848" data-zoom="13" data-info="PO Box CT16122 Collins Street West, Victoria 8007, Australia." data-mlat="40.701083" data-mlon="-74.1522848"> -->
        <div id="map" style="margin:50px">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.2303106951567!2d105.87620467471534!3d21.063461686586813!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135a98893e5c0ab%3A0xf0ac96db5d859a69!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEPDtG5nIG5naGnhu4dwIFF14buRYyBwaMOybmcgKGPGoSBz4bufIDIp!5e0!3m2!1svi!2s!4v1705364992552!5m2!1svi!2s"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <?php
					if(isset($insert_contact)){
						echo $insert_contact;
					}
					?>
        <div class="row">
            <div class="col-lg-3">
                <div class="contact_info">
                    <div class="info_item">
                        <i class="fa-solid fa-map-location-dot" style="color: #ffba00;"></i>
                        <h6>Hà Nội, Việt Nam</h6>
                        <p>Đường Lý Sơn, Ngọc Thụy, Long Biên</p>
                    </div>
                    <div class="info_item">
                        <i class="fa-solid fa-mobile-screen " style="color: #ffba00;"></i>
                        <h6><a href=" #">+84.336.863.623</a></h6>
                        <p>Mở cửa từ 8.00 AM - 21.00 PM</p>
                    </div>
                    <div class="info_item">
                        <i class="fa-solid fa-envelope" style="color: #ffba00;"></i>
                        <h6><a href=" #">thuc9a85@colorlib.com</a></h6>
                        <p>Gửi mọi thắc mắc của ban cho chúng tôi bất cứ lúc nào</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">

                <form class="row contact_form" action="" method="post" id="contactForm" novalidate="novalidate">

                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Họ tên của bạn"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Nhập email address" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Enter email address'">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="subject" name="subject"
                                placeholder="Nhập vấn đề của bạn" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Enter Subject'">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea class="form-control" name="message" id="message" rows="1"
                                placeholder="Nhập nội dung" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Enter Message'"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12 text-right">
                        <button type="submit" name="submit" value="submit" class="primary-btn">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!--================Contact Area =================-->

<?php include('pages/footer.php') ?>