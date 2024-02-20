<?php include('pages/header.php') ?>
<?php
$cart = new Cart();
 if(!isset($_GET['productId']) || $_GET['productId']== NULL){
	header("Location: 404.php");
    exit();
 }else{
    $id =$_GET['productId'];
 }
if($_SERVER['REQUEST_METHOD']== 'POST' && !empty($_POST['submit'])){
	$quantity = $_POST['quantity'];
    $size = isset($_POST['option-size']) ? $_POST['option-size'] : '';
	$Addtocart = $ct->add_to_cart($id, $quantity,$size);
}
if (isset($_SESSION['customerId'])) {
    $customer_id = $_SESSION['customerId'];
    // Tiếp tục xử lý với $customer_id ở đây
}
?>
<style>
.sub-swap {
    width: 65%;
    display: flex;
    flex-wrap: wrap;
}

.swap-lv2 {
    width: 20%;
    margin: 0;
    display: inline-block;
    position: relative;
    vertical-align: bottom;
}

.variant-1 {
    display: none;
}

.swap-lv2>label {
    position: relative;
    display: block;
    margin: 0;
    padding: 3px;
    width: 100%;
    height: 100%;
    background: #fff;
    border: 1px solid #999999;
    color: #000;
    font-size: 14px;
    text-align: center;
    cursor: pointer;
    /* border-radius: 4px; */
    justify-content: center;
}

.swap-lv2>label.checked-size {
    display: block;
    background-color: #000;
    color: #ffffff;
    position: relative;
    font-weight: bold;
}

.title-detail {
    background: linear-gradient(90deg, #ffba00 0%, #ff6c00 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    color: #555;
    -webkit-text-fill-color: #555;
}

.s_product_text .card_area .primary-btn {
    border: none;
}

.s_product_text .card_area .primary-btn:hover {
    cursor: pointer;
    background: #ccc !important;
    border: 0.1px solid #ff6c00;
    color: #ff6c00;

}

#successMessage {
    display: none;
    background-color: #ffffff;
    border: 2px solid #4CAF50;
    border-radius: 4px;
    /* Màu nền */
    color: #4CAF50;
    font-weight: 600;
    /* Màu chữ *
    /* Kích thước padding */
    padding: 5px 15px;
    text-align: center;
    /* Căn giữa nội dung */
    position: fixed;
    /* Hiển thị cố định trên trang */
    top: 0;
    /* Ở phía trên của trang */
    left: 50%;
    /* Căn giữa theo chiều ngang */
    transform: translateX(-50%);
    /* Dịch chuyển về bên trái 50% */
    z-index: 1000;
    /* Z-index để đảm bảo hiển thị trên tất cả các phần tử khác */
}
</style>
<!-- <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v18.0"
    nonce="Rcqzd1Se"></script> -->
<!-- Thêm một div để chứa thông báo -->
<div id="successMessage" style="display:none;"><i class="fa-solid fa-circle-check" style="color: #4bbd00;"></i></div>
<script>
function showSuccessMessage(message) {
    // Hiển thị thông báo trong div
    document.getElementById('successMessage').innerHTML = message;
    document.getElementById('successMessage').style.display = 'block';

    // Tự động ẩn thông báo sau vài giây (nếu cần)
    setTimeout(function() {
        document.getElementById('successMessage').style.display = 'none';
    }, 5000); // 3000 milliseconds = 3 seconds
}
</script>

<?php
 $get_product_detail = $product->get_detail($id);
 if($get_product_detail){

	while($result =$get_product_detail->fetch_assoc()){
		$sizeNames = $result['sizes']; // Chuỗi chứa tên các size
    $sizes = explode(',', $sizeNames); // Tách chuỗi thành mảng các size
    // Bây giờ $sizes chứa mảng các size của sản phẩm
		?>
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>CHI TIẾT SẢN PHẨM</h1>
                <nav class="d-flex align-items-center">
                    <a href="index.php">TRANG CHỦ<span><i class="fa-solid fa-arrow-right"
                                style="color: #ffffff;"></i></span></a>
                    <a href="#"><?php echo $result['categoryName'] ?><span><i class="fa-solid fa-arrow-right"
                                style="color: #ffffff;"></i></span></a>
                    <a href="#"><?php echo strtoupper($result['productName']) ?></a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Single Product Area =================-->
<div class="product_image_area">
    <div class="container">
        <div class="row s_product_inner">
            <div class="col-lg-6">
                <div class="s_Product_carousel">
                    <div class="single-prd-item">
                        <img class="img-fluid" src="admincp/uploads/<?php echo $result['image'];?>"
                            alt="<?php echo $result['productName'] ?>">
                    </div>
                    <div class="single-prd-item">
                        <img class="img-fluid" src="admincp/uploads/<?php echo $result['image'];?>"
                            alt="<?php echo $result['productName'] ?>">
                    </div>
                    <div class="single-prd-item">
                        <img class="img-fluid" src="admincp/uploads/<?php echo $result['image'];?>"
                            alt="<?php echo $result['productName'] ?>">
                    </div>
                    <!-- <div class="single-prd-item">
                        <img class="img-fluid" src="img/category/s-p1.jpg" alt="">
                    </div>
                    <div class="single-prd-item">
                        <img class="img-fluid" src="img/category/s-p1.jpg" alt="">
                    </div> -->
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="s_product_text" style="margin-top:0;">
                    <h3><?php echo $result['productName'];?>
                    </h3>
                    <div class="price-detail" style=" display:flex">
                        <?php if($result['pricediscount'] < $result['price'] ){
								?>
                        <span
                            class="price-discount-detail">₫<?php echo number_format($result['pricediscount'], 0, ',', '.'); ?></span>
                        <span class="price-detail">₫<?php echo number_format($result['price'], 0, ',', '.'); ?></span>
                        <div class="sale-percentage">
                            <span
                                class="percen-discount">-<?php echo round((1-$result['pricediscount']/$result['price'])*100)?>%</span>
                        </div>
                        <?php	
									}else{
										?>
                        <span
                            class="price-discount-detail">₫<?php echo number_format($result['pricediscount'], 0, '.', ','); ?></span>

                        <?php
									}
									?>
                    </div>
                    <style>

                    </style>

                    <ul class="list" style="margin-top:10px">
                        <li><a class="active" href="#"><span>Danh mục</span> : <?php echo $result['categoryName'];?></a>
                        </li>
                        <li><a class="active" href="#"><span>Thương hiệu</span> : <?php echo $result['brandName'];?></a>
                        </li>
                        <li><span class="title-detail">Tình trạng</span> : Còn hàng</li>
                        <li><span class="title-detail">Màu :</span> <?php echo $result['colors'] ?></li>
                        <form action="" method="POST">
                            <?php if(isset($Addtocart)){
									echo $Addtocart;
								} ?>
                            <li><span class="title-detail">Kích thước (Size) :</span>
                                <div class="select-swap w-100 mt-2 d-flex flex-wrap">
                                    <div class="sub-swap">
                                        <?php 
									foreach($sizes as $size){
											?>
                                        <div class="swap-lv2">
                                            <input class="variant-1" type="radio" id="swatch-<?php echo $size ?>"
                                                name="option-size" data-vhandle="<?php echo $size ?>"
                                                value="<?php echo $size ?>">
                                            <!-- Thêm trường input ẩn -->
                                            <input type="hidden" name="selectedSize" id="selectedSize"
                                                value="<?php echo $size ;?>">

                                            <label for="swatch-<?php echo $size ?>"
                                                class="size-label "><?php echo $size; ?></label>
                                        </div>
                                        <?php
										}
									
									?>

                                    </div>
                                </div>
                            </li>
                    </ul>
                    <p>Hãy chọn size trước khi thêm vào giỏ hàng.</p>
                    <div class="product_count">
                        <label for="qty">Số lượng :</label>
                        <input type="number" id="sst" name="quantity" maxlength="12" value="1" title="Quantity:"
                            class="input-text qty">
                        <button
                            onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                            class="increase items-count" type="button"><i class="fa-solid fa-angle-up fa-xs"
                                style="color: #999999;"></i></button>
                        <button
                            onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                            class="reduced items-count" type="button"><i class="fa-solid fa-angle-down fa-xs"
                                style="color: #999999;"></i></button>
                    </div>

                    <div class="card_area d-flex align-items-center">
                        <input type="submit" class="primary-btn add-cart" name="submit" value="Thêm vào giỏ">
                        <!-- <input type="submit" class="primary-btn add-cart"  name="buy-submit" value="Mua ngay">		 -->
                        <a class="icon_btn" href="#"><i class="fa-regular fa-gem" style="color: #ffffff;"></i></a>
                        <a class="icon_btn" href="#"><i class="fa-regular fa-heart" style="color: #ffffff;"></i></a>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--================End Single Product Area =================-->

<!--================Product Description Area =================-->
<section class="product_description_area">
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                    aria-selected="true">MÔ TẢ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                    aria-controls="profile" aria-selected="false">THÔNG SỐ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                    aria-controls="contact" aria-selected="false">BÌNH LUẬN</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab"
                    aria-controls="review" aria-selected="false">ĐÁNH GIÁ</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                <prev>
                    <?php echo $result['productDes'] ?>
                </prev>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <h5>Width</h5>
                                </td>
                                <td>
                                    <h5>128mm</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Height</h5>
                                </td>
                                <td>
                                    <h5>508mm</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Depth</h5>
                                </td>
                                <td>
                                    <h5>85mm</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Weight</h5>
                                </td>
                                <td>
                                    <h5>52gm</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Quality checking</h5>
                                </td>
                                <td>
                                    <h5>yes</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Freshness Duration</h5>
                                </td>
                                <td>
                                    <h5>03days</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>When packeting</h5>
                                </td>
                                <td>
                                    <h5>Without touch of hand</h5>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Each Box contains</h5>
                                </td>
                                <td>
                                    <h5>60pcs</h5>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="row">
                    <!-- <div class="col-lg-6">
							<div class="comment_list">
								<div class="review_item">
									<div class="media">
										<div class="d-flex">
											<img src="img/product/review-1.png" alt="">
										</div>
										<div class="media-body">
											<h4>Blake Ruiz</h4>
											<h5>12th Feb, 2018 at 05:56 pm</h5>
											<a class="reply_btn" href="#">Reply</a>
										</div>
									</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
										dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
										commodo</p>
								</div>
								<div class="review_item reply">
									<div class="media">
										<div class="d-flex">
											<img src="img/product/review-2.png" alt="">
										</div>
										<div class="media-body">
											<h4>Blake Ruiz</h4>
											<h5>12th Feb, 2018 at 05:56 pm</h5>
											<a class="reply_btn" href="#">Reply</a>
										</div>
									</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
										dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
										commodo</p>
								</div>
								<div class="review_item">
									<div class="media">
										<div class="d-flex">
											<img src="img/product/review-3.png" alt="">
										</div>
										<div class="media-body">
											<h4>Blake Ruiz</h4>
											<h5>12th Feb, 2018 at 05:56 pm</h5>
											<a class="reply_btn" href="#">Reply</a>
										</div>
									</div>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
										dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
										commodo</p>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="review_box">
								<h4>Post a comment</h4>
								<form class="row contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
									<div class="col-md-12">
										<div class="form-group">
											<input type="text" class="form-control" id="name" name="name" placeholder="Your Full name">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<input type="text" class="form-control" id="number" name="number" placeholder="Phone Number">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<textarea class="form-control" name="message" id="message" rows="1" placeholder="Message"></textarea>
										</div>
									</div>
									<div class="col-md-12 text-right">
										<button type="submit" value="submit" class="btn primary-btn">Submit Now</button>
									</div>
								</form>
							</div>
						</div> -->
                    <!-- <div class="fb-comments"
                        data-href="<?php echo 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>"
                        data-width="100%" data-numposts="10"></div> -->
                </div>
            </div>
            <div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
                <div class="row">
                    <div class="col-lg-6">

                        <div class="row total_rate">
                            <div class="col-6">
                                <?php
                                 $rate = new Rating();
                                 $get_rate = $rate->get_rating();
                                 $rating_array = $get_rate->fetch_all(MYSQLI_ASSOC);
                                 $total_ratings = count($rating_array);

                                ?>
                                <div class="box_total">
                                    <h5>Số sao</h5>
                                    <?php $get_average_rating = $rate->get_average_rating();

                                        // Kiểm tra xem có dữ liệu trả về hay không
                                        // if ($get_average_rating) {
                                            $average_rating = $get_average_rating->fetch_assoc();
                                            
                                            // Lấy giá trị trung bình từ kết quả truy vấn
                                            $average = $average_rating['average_rating']; ?>
                                    <h4><?php echo $average ?></h4>
                                    <!-- <h6>(03 đánh giá)</h6> -->
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="rating_list">
                                    <h3>Tổng số đánh giá:</h3> <span><?php echo $total_ratings ?> đánh giá</span>
                                </div>
                            </div>
                        </div>
                        <div class="review_list">
                            <?php
                                 $get_rate = $rate->get_rating();

                            if($get_rate){
                               while( $result_rating= $get_rate->fetch_assoc()){

                                ?>
                            <div class="review_item">
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="img/product/review-1.png" alt="">
                                    </div>
                                    <div class="media-body">
                                        <h4><?php echo $result_rating['full_name'] ?></h4>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <p><?php echo $result_rating['review'] ?></p>
                            </div>
                            <?php
                               }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <style>
                        .list-star a.selected i {
                            color: #ffd700;
                            /* Màu sáng cho sao đã chọn */
                        }

                        .list-star a::hover {
                            color: #ffd700;
                        }
                        </style>
                        <?php
                        if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['reviewSubmit'])){
                            $insert_rate = $rate->insert_rating($_POST);
                        }
                        ?>
                        <div class="review_box">
                            <h4>Thêm 1 đánh giá</h4>
                            <form class="row contact_form" action="" method="post" id="contactForm"
                                novalidate="novalidate">
                                <input type="hidden" name="customerId" value="<?php echo $customer_id ?>">
                                <input type="hidden" name="productId" value="<?php echo $id ?>">
                                <ul class="list-star d-flex" id="starList">
                                    <span class="col-md-8">Đánh giá:</span>
                                    <li><a href="#" name="rating" data-value="1"><i class="fa-solid fa-star"></i></a>
                                    </li>
                                    <li><a href="#" name="rating" data-value="2"><i class="fa-solid fa-star"></i></a>
                                    </li>
                                    <li><a href="#" name="rating" data-value="3"><i class="fa-solid fa-star"></i></a>
                                    </li>
                                    <li><a href="#" name="rating" data-value="4"><i class="fa-solid fa-star"></i></a>
                                    </li>
                                    <li><a href="#" name="rating" data-value="5"><i class="fa-solid fa-star"></i></a>
                                    </li>
                                    <input type="hidden" name="rating" id="ratingInput" value="0">
                                    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                                    <script>
                                    $(document).ready(function() {
                                        // Xử lý khi click vào một sao
                                        $('a[name="rating"]').on('click', function() {
                                            // Lấy giá trị từ thuộc tính data-value
                                            var ratingValue = $(this).data('value');
                                            // Cập nhật giá trị rating vào input ẩn
                                            $('#ratingInput').val(ratingValue);
                                            // Có thể thêm hiệu ứng sáng tạo cho số sao đã chọn ở đây (nếu cần)
                                        });
                                    });
                                    </script>

                                </ul>
                                <?php
                                if(isset($insert_rate)){
                                    echo $insert_rate;
                                }
                                ?>
                                <script>
                                document.addEventListener("DOMContentLoaded", function() {
                                    var starList = document.getElementById("starList");
                                    var stars = starList.getElementsByTagName("a");

                                    for (var i = 0; i < stars.length; i++) {
                                        stars[i].addEventListener("click", function(event) {
                                            event.preventDefault();

                                            // Lấy giá trị của sao đã chọn từ thuộc tính data-value
                                            var selectedValue = this.getAttribute("data-value");
                                            console.log("Sao đã chọn: " + selectedValue);

                                            // Loại bỏ hiệu ứng sáng của tất cả các sao
                                            for (var j = 0; j < stars.length; j++) {
                                                stars[j].classList.remove("selected");
                                            }

                                            // Thêm hiệu ứng sáng cho các sao đến sao đã chọn
                                            for (var k = 0; k < selectedValue; k++) {
                                                stars[k].classList.add("selected");
                                            }
                                        });
                                    }
                                });
                                </script>



                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" name="full_name"
                                            placeholder="Họ tên của bạn" onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Họ tên của bạn'">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Email" onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Email'">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="number" name="phone_number"
                                            placeholder="Số điện thoại" onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Số điện thoại'">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" name="review" id="message" rows="1"
                                            placeholder="Nhận xét" onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Nhận xét'"></textarea></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button type="submit" name="reviewSubmit" value="submit" class="primary-btn">Đăng
                                        ngay</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Product Description Area =================-->

<?php
	}
 }

?>

<!-- Start related-product Area -->
<section class="related-product-area section_gap_bottom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h1>Ưu đãi trong tuần</h1>
                    <p>Ngập tràn ưu đãi đến từ các thương hiệu lớn như Nike, New Balance, Puma, Adidas. Nhanh tay kẻo
                        lỡ.</p>
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
<script>
document.addEventListener('DOMContentLoaded', function() {
    var selectedSize = '';
    var selectedSizeInput = document.getElementById('selectedSize');

    var labels = document.querySelectorAll('.swap-lv2 label');

    labels.forEach(function(label) {
        label.addEventListener('click', function() {
            // Lấy giá trị của size khi người dùng chọn
            selectedSize = label.textContent;

            // Xóa lớp checked-size khỏi tất cả các label
            labels.forEach(function(l) {
                l.classList.remove('checked-size');
            });

            // Thêm lớp checked-size vào label đang được chọn
            label.classList.add('checked-size');

            // Bỏ chọn tất cả các input và chọn input của label đang được chọn
            var inputs = label.parentNode.querySelectorAll('input');
            inputs.forEach(function(input) {
                input.checked = false;
            });

            label.previousElementSibling.checked = true;

            // Đặt giá trị size vào trường input ẩn
            selectedSizeInput.value = selectedSize;
        });
    });
});
</script>
<?php include('pages/footer.php') ?>