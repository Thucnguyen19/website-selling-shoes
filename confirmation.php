<?php $orderId = isset($_GET['orderId']) ? $_GET['orderId'] : null;?>
<?php include('pages/header.php') ?>
<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>XÁC NHẬN</h1>
                <nav class="d-flex align-items-center">
                    <a href="index.html">TRANG CHỦ<span class=""><i class="fa-solid fa-arrow-right"
                                style="color: #ffffff;"></i></span></a>
                    <a href="category.html">XÁC NHẬN</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Order Details Area =================-->
<section class="order_details section_gap">
    <div class="container">
        <h3 class="title_confirmation">Cảm ơn bạn đã đặt hàng, chúng tôi sẽ chuẩn bị đơn hàng để gửi đến bạn nhanh nhất.
        </h3>
        <div class="row order_d_inner">
            <div class="col-lg-4">
                <div class="details_item">
                    <h4>Thông tin đơn hàng</h4>
                    <ul class="list">
                        <?php
							 $order =new Order();
							 $get_order = $order->get_order_detail($orderId);
							 $flat_rate =30000;
							 if(isset($get_order)){
								$result = $get_order->fetch_assoc();?>
                        <li><a href="#"><span>Số đơn hàng</span> : <?php echo $result['orderId'];?></a></li>
                        <li><a href="#"><span>Ngày</span> : <?php echo $result['created_at']; ?></a></li>
                        <li><a href="#"><span>Tổng tiền</span> : <?php echo $result['total'] ?></a></li>
                        <li><a href="#"><span>Thanh toán</span> : <?php echo $result['method'] ?></a></li>

                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="details_item">
                    <h4>Địa chỉ thanh toán</h4>
                    <ul class="list">
                        <li><a href="#"><span>Địa chỉ nhà</span> : <?php echo $result['address_home'] ?></a></li>
                        <li><a href="#"><span>Thành phố</span> : <?php echo $result['address_home'] ?></a></li>
                        <li><a href="#"><span>Quốc gia</span> : Việt Nam</a></li>
                        <li><a href="#"><span>Mã zip </span> : <?php echo $result['zip'] ?></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="details_item">
                    <h4>Địa chỉ giao hàng</h4>
                    <ul class="list">
                        <li><a href="#"><span>Địa chỉ nhà</span> : <?php echo $result['address_home'] ?></a></li>
                        <li><a href="#"><span>Thành phố</span> : <?php echo $result['address_home'] ?></a></li>
                        <li><a href="#"><span>Quốc gia</span> : Việt Nam</a></li>
                        <li><a href="#"><span>Mã zip </span> : <?php echo $result['zip'] ?></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="order_details_table">

            <h2>Chi tiết đơn hàng</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Tổng cộng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
						$get_order = $order->get_order_detail($orderId);
						if(isset($get_order)){
						while($result_detail = $get_order->fetch_assoc()){
					?>
                        <tr>
                            <td>
                                <p><?php echo $result_detail['productName'] ?></p>
                            </td>
                            <td>
                                <h5>x <?php echo $result_detail['quantity'] ?></h5>
                            </td>
                            <td>
                                <p>đ<?php echo number_format($result_detail['subTotal'],0,',','.') ?></p>
                            </td>
                        </tr>
                        <?php
						}
						}?>
                        <tr>
                            <td>
                                <h4>Tổng tiền</h4>
                            </td>
                            <td>
                                <h5></h5>
                            </td>
                            <td>
                                <p>đ<?php echo number_format($result['total'] - $flat_rate,0,',','.')?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Phí vận chuyển</h4>
                            </td>
                            <td>
                                <h5></h5>
                            </td>
                            <td>
                                <p>đ<?php echo number_format( $flat_rate,0,',','.')?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Tổng cộng</h4>
                            </td>
                            <td>
                                <h5></h5>
                            </td>
                            <td>
                                <p>đ<?php echo number_format($result['total'],0,',','.')?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php
		}
		?>
        </div>
    </div>
</section>
<!--================End Order Details Area =================-->

<?php include('pages/footer.php') ?>