<?php  include('pages/header.php') ; ?>
<!-- start banner Area -->
<section class="banner-area">
    <div class="container">
        <div class="row fullscreen align-items-center justify-content-start">
            <div class="col-lg-12">
                <div class="active-banner-slider owl-carousel">
                    <!-- single-slide -->
                    <?php 
                                $get_slider =$slider-> show_slider_home();
                                if($get_slider){
                                    while($result_slider =$get_slider->fetch_assoc()){
                                        ?>
                    <div class="row single-slide align-items-center d-flex">
                        <div class="col-lg-5 col-md-6">
                            <div class="banner-content">
                                <h1 style="font-family: 'Montserrat', sans-serif;">
                                    <?php echo $result_slider['sliderName'] ?></h1>
                                <p><?php echo $result_slider['sliderDes']?></p>
                                <div class="add-bag d-flex align-items-center">
                                    <a class="add-btn" href=""><span><i class="fa-solid fa-plus fa-rotate-by"
                                                style="color: #ffffff; --fa-rotate-angle: 45deg;"></i></span></a>
                                    <span class=" add-text text-uppercase">xem ngay</span>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="banner-img">
                                <img class="img-fluid" style="width:500px; height:auto;"
                                    src="admincp/uploads/<?php echo $result_slider['image'] ?>" alt="">
                            </div>
                        </div>
                    </div>
                    <?php
                                    }
                                }
                                ?>
                    <!-- <div class="row single-slide align-items-center d-flex">
                        <div class="col-lg-5 col-md-6">
                            <div class="banner-content">
                                <h1> Bộ sưu tập <br>màu sắc mới!</h1>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et
                                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                                <div class="add-bag d-flex align-items-center">
                                    <a class="add-btn" href=""><span><i class="fa-solid fa-plus fa-rotate-by"
                                                style="color: #ffffff; --fa-rotate-angle: 45deg;""></i></span></a>
										<span class=" add-text text-uppercase">Thêm vào giỏ</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="banner-img">
                                <img class="img-fluid" style="width:500px; height:auto;" src="img/banner/banner-img.png"
                                    alt="">
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->

<!-- start features Area -->
<section class="features-area section_gap">
    <div class="container">
        <div class="row features-inner">
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-features">
                    <div class="f-icon">
                        <img src="img/features/f-icon1.png" alt="">
                    </div>
                    <h6>Giao hàng miễn phí</h6>
                    <p>Miễn phí vận chuyển cho mọi đơn hàng</p>
                </div>
            </div>
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-features">
                    <div class="f-icon">
                        <img src="img/features/f-icon2.png" alt="">
                    </div>
                    <h6>Chính sách hoàn trả</h6>
                    <p>Hoàn trả lại hàng lỗi trong 7 ngày đầu.</p>
                </div>
            </div>
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-features">
                    <div class="f-icon">
                        <img src="img/features/f-icon3.png" alt="">
                    </div>
                    <h6>Hỗ trợ 24/7</h6>
                    <p>Nhân viên trực 24/24</p>
                </div>
            </div>
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-features">
                    <div class="f-icon">
                        <img src="img/features/f-icon4.png" alt="">
                    </div>
                    <h6>Thanh toán an toàn</h6>
                    <p>Bảo mậtt thông tin thanh toán</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end features Area -->

<!-- Start category Area -->
<section class="category-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <div class="single-deal">
                            <div class="overlay"></div>
                            <img class="img-fluid w-100" src="img/category/c1.jpg" alt="">
                            <a href="img/category/c1.jpg" class="img-pop-up" target="_blank">
                                <div class="deal-details">
                                    <h6 class="deal-title">Sneaker for Sports</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="single-deal">
                            <div class="overlay"></div>
                            <img class="img-fluid w-100" src="img/category/c2.jpg" alt="">
                            <a href="img/category/c2.jpg" class="img-pop-up" target="_blank">
                                <div class="deal-details">
                                    <h6 class="deal-title">Sneaker for Sports</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="single-deal">
                            <div class="overlay"></div>
                            <img class="img-fluid w-100" src="img/category/c3.jpg" alt="">
                            <a href="img/category/c3.jpg" class="img-pop-up" target="_blank">
                                <div class="deal-details">
                                    <h6 class="deal-title">Giày dành cho cặp đôi</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8">
                        <div class="single-deal">
                            <div class="overlay"></div>
                            <img class="img-fluid w-100" src="img/category/c4.jpg" alt="">
                            <a href="img/category/c4.jpg" class="img-pop-up" target="_blank">
                                <div class="deal-details">
                                    <h6 class="deal-title">Sneaker cho thể thao</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-deal">
                    <div class="overlay"></div>
                    <img class="img-fluid w-100" src="img/category/c5.jpg" alt="">
                    <a href="img/category/c5.jpg" class="img-pop-up" target="_blank">
                        <div class="deal-details">
                            <h6 class="deal-title">Sneaker for Sports</h6>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End category Area -->

<!-- start product Area -->
<section class="owl-carousel active-product-area section_gap">
    <!-- single product slide -->
    <div class="single-product-slider">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="section-title">
                        <h1>Sản phẩm mới</h1>
                        <p>Những sản phẩm mới nhất của New Color</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php 
					$getproduct = $product-> getlatest_product();
					if($getproduct){
						while($result_latest= $getproduct->fetch_assoc()){
							?>
                <!-- single product -->
                <div class="col-lg-3 col-md-6">
                    <div class="single-product">
                        <img class="img-fluid" style="height:270px;object-fit:contain"
                            src="admincp/uploads/<?php echo $result_latest['image'];?>" alt="">
                        <div class="product-details">
                            <h6><?php echo $result_latest['productName'];?></h6>
                            <div class="price">
                                <h6>₫<?php echo number_format($result_latest['pricediscount'], 0, ',', '.'); ?></h6>
                                <h6 class="l-through">
                                    ₫<?php echo number_format($result_latest['price'], 0, ',', '.'); ?></h6>
                            </div>
                            <div class="prd-bottom">

                                <a href="detail-product.php?productId=<?php echo $result_latest['productId']?>"
                                    class="social-info">
                                    <span class="">
                                        <i class="fa-solid fa-bag-shopping" style="color: #ffffff;"></i>
                                    </span>
                                    <p class="hover-text">Thêm vào giỏ</p>
                                </a>
                                <a href="" class="social-info">
                                    <span class="">
                                        <i class="fa-regular fa-heart" style="color: #ffffff;"></i>
                                    </span>
                                    <p class="hover-text">Yêu thích</p>
                                </a>
                                <a href="" class="social-info">
                                    <span class=""><i class="fa-solid fa-repeat fa-rotate-by"
                                            style="color: #ffffff; --fa-rotate-angle: 45deg;"></i></span>
                                    <p class=" hover-text">So sánh</p>
                                </a>
                                <a href="detail-product.php?productId=<?php echo $result_latest['productId']?>"
                                    class="social-info">
                                    <span class=""><i class="fa-solid fa-up-down-left-right"
                                            style="color: #ffffff;"></i></span>
                                    <p class="hover-text">xem thêm</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
						}
					}
					?>


            </div>
        </div>
    </div>
    <!-- single product slide -->
    <div class="single-product-slider">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="section-title">
                        <h1>Sản phẩm nổi bật</h1>
                        <p>Những sản phẩm nổi bật của nhà New Color</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php 
					$get_feature_product = $product-> getfeature_product();
					// var_dump($get_feature_product);// kiem tra bien 
					if($get_feature_product){
						while($result_feature= $get_feature_product->fetch_assoc()){
							?>
                <!-- single product -->
                <div class="col-lg-3 col-md-6">
                    <div class="single-product">
                        <img class="img-fluid" style="height:270px;object-fit:contain"
                            src="admincp/uploads/<?php echo $result_feature['image'];?>" alt="">
                        <div class="product-details">
                            <h6><?php echo $result_feature['productName'];?></h6>
                            <div class="price">
                                <h6>₫<?php echo number_format($result_feature['pricediscount'], 0, '.', ','); ?></h6>
                                <h6 class="l-through">
                                    ₫<?php echo number_format($result_feature['price'], 0, '.', ','); ?></h6>
                            </div>
                            <div class="prd-bottom">

                                <a href="detail-product.php?productId=<?php echo $result_feature['productId']?>"
                                    class="social-info">
                                    <span class="">
                                        <i class="fa-solid fa-bag-shopping" style="color: #ffffff;"></i>
                                    </span>
                                    <p class="hover-text">Thêm vào giỏ</p>
                                </a>
                                <a href="" class="social-info">
                                    <span class="">
                                        <i class="fa-regular fa-heart" style="color: #ffffff;"></i>
                                    </span>
                                    <p class="hover-text">Yêu thích</p>
                                </a>
                                <a href="" class="social-info">
                                    <span class=""><i class="fa-solid fa-repeat fa-rotate-by"
                                            style="color: #ffffff; --fa-rotate-angle: 45deg;"></i></span>
                                    <p class=" hover-text">So sánh</p>
                                </a>
                                <a href="detail-product.php?productId=<?php echo $result_feature['productId']?>"
                                    class="social-info">
                                    <span class=""><i class="fa-solid fa-up-down-left-right"
                                            style="color: #ffffff;"></i></span>
                                    <p class="hover-text">xem thêm</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
						}
					}
					?>


            </div>
        </div>
    </div>
</section>
<!-- end product Area -->

<!-- Start exclusive deal Area -->
<!-- <section class="exclusive-deal-area">
		<div class="container-fluid">
			<div class="row justify-content-center align-items-center">
				<div class="col-lg-6 no-padding exclusive-left">
					<div class="row clock_sec clockdiv" id="clockdiv">
						<div class="col-lg-12">
							<h1>Ưu đãi hấp dẫn sắp kết thúc!</h1>
							<p>Dành cho những người yêu thích phong cách đường phố</p>
						</div>
						<div class="col-lg-12">
							<div class="row clock-wrap">
								<div class="col clockinner1 clockinner">
									<h1 class="days">150</h1>
									<span class="smalltext">Days</span>
								</div>
								<div class="col clockinner clockinner1">
									<h1 class="hours">23</h1>
									<span class="smalltext">Hours</span>
								</div>
								<div class="col clockinner clockinner1">
									<h1 class="minutes">47</h1>
									<span class="smalltext">Mins</span>
								</div>
								<div class="col clockinner clockinner1">
									<h1 class="seconds">59</h1>
									<span class="smalltext">Secs</span>
								</div>
							</div>
						</div>
					</div>
					<a href="" class="primary-btn">Mua ngay</a>
				</div>
				<div class="col-lg-6 no-padding exclusive-right">
					<div class="active-exclusive-product-slider">
					
						<div class="single-exclusive-slider">
							<img class="img-fluid" src="img/product/e-p1.png" alt="">
							<div class="product-details">
								<div class="price">
									<h6>$150.00</h6>
									<h6 class="l-through">$210.00</h6>
								</div>
								<h4>addidas New Hammer sole
									for Sports person</h4>
								<div class="add-bag d-flex align-items-center justify-content-center">
									<a class="add-btn" href=""><span class="ti-bag"></span></a>
									<span class="add-text text-uppercase">Add to Bag</span>
								</div>
							</div>
						</div>
					
						<div class="single-exclusive-slider">
							<img class="img-fluid" src="img/product/e-p1.png" alt="">
							<div class="product-details">
								<div class="price">
									<h6>$150.00</h6>
									<h6 class="l-through">$210.00</h6>
								</div>
								<h4>addidas New Hammer sole
									for Sports person</h4>
								<div class="add-bag d-flex align-items-center justify-content-center">
									<a class="add-btn" href=""><span class="ti-bag"></span></a>
									<span class="add-text text-uppercase">Add to Bag</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> -->
<!-- End exclusive deal Area -->

<!-- Start brand Area -->
<section class="brand-area section_gap">
    <div class="container">
        <div class="row">
            <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="img/brand/1.png" alt="">
            </a>
            <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="img/brand/2.png" alt="">
            </a>
            <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="img/brand/3.png" alt="">
            </a>
            <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="img/brand/4.png" alt="">
            </a>
            <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="img/brand/5.png" alt="">
            </a>
        </div>
    </div>
</section>
<!-- End brand Area -->

<!-- Start related-product Area -->
<section class="related-product-area section_gap_bottom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h1>Ưu đãi trong tuần</h1>
                    <p>Hãy xem qua những sản phẩm đang được ưu đãi trong tuần qua nào.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9">
                <div class="row">
                    <?php 
					$get_deal_7days = $product-> get_deal_7days();
					// var_dump($get_deal_7days);// kiem tra bien 
					if($get_deal_7days){
						while($result_deal= $get_deal_7days->fetch_assoc()){
							?>
                    <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                        <div class="single-related-product d-flex">
                            <a href="#"><img style="height:70px; width:70px; object-fit:contain"
                                    src="admincp/uploads/<?php echo $result_deal['image'];?>" alt=""></a>
                            <div class="desc">
                                <a href="detail-product.php?productId=<?php echo $result_deal['productId']?>"
                                    class="title"><?php echo $result_deal['productName'] ?></a>
                                <div class="price">
                                    <h6>₫<?php echo number_format($result_deal['pricediscount'], 0, '.', ','); ?></h6>
                                    <h6 class="l-through">
                                        ₫<?php echo number_format($result_deal['price'], 0, '.', ','); ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
						}}
						?>

                </div>
            </div>
            <div class="col-lg-3">
                <div class="ctg-right">
                    <a href="#" target="_blank">
                        <img class="img-fluid d-block mx-auto" src="img/category/c5.jpg" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End related-product Area -->

<?php include('pages/footer.php') ?>