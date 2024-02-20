<?php include('pages/header.php') ?>


<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>THANH TOÁN</h1>
                <nav class="d-flex align-items-center">
                    <a href="index.php">TRANG CHỦ<span><i class="fa-solid fa-arrow-right"
                                style="color: #ffffff;"></i></span></a>
                    <a href="#">THANH TOÁN</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Checkout Area =================-->
<?php 
    $order =new Order();
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        // The request is using the POST method
      $first_name =$_POST['first_name'];
      $last_name =$_POST['last_name'];
      $company =$_POST['company'];
      $phone_number =$_POST['phone_number'];
      $email =$_POST['email'];
      $address_home =$_POST['address_home'];
      $address_office =$_POST['address_office'];
      $zip =$_POST['zip'];
      $note =$_POST['note'];
      if (isset($_SESSION['customerId'])) {
        $customer_id = $_SESSION['customerId'];
        // Tiếp tục xử lý với $customer_id ở đây
    } else {
    // Xử lý khi 'customerId' không tồn tại trong $_SESSION
        echo "<span>Lỗi: Không tìm thấy 'customerId' trong SESSION.</span>";
    }
    
      $customer_detail = $order->insert_customer_detail($_POST,$customer_id);
    } 
?>

<!-- Các trường và nút submit cho form order -->

<section class="checkout_area section_gap">
    <div class="container">
        <div class="cupon_area">
            <div class="check_title">
                <h2>Bạn chưa có mã giảm giá ? <a href="#">Click vào đây để nhận mã giảm giá</a></h2>
            </div>
            <input type="text" placeholder="Nhập mã phiếu giảm giá">
            <a class="tp_btn" href="#">ÁP DỤNG PHIẾU GIẢM GIÁ</a>
        </div>
        <div class="billing_details">
            <?php 
  
        
        ?>
            <div class="row">
                <div class="col-lg-6">
                    <h3>CHI TIẾT THANH TOÁN</h3>
                    <?php
                        if(isset($customer_detail)){
                            echo $customer_detail;
                        }
                        ?>
                    <?php
                         if (isset($_SESSION['customerId'])) {
                            $customer_id = $_SESSION['customerId'];
                            // Tiếp tục xử lý với $customer_id ở đây
                        } else {
                            // Xử lý khi 'customerId' không tồn tại trong $_SESSION
                            echo "<span>Lỗi: Không tìm thấy 'customerId' trong SESSION.</span>";
                        }
                        $get_order = $order->get_customer_detail($customer_id);
                        if($get_order){
                            $result = $get_order->fetch_assoc();

                        if (isset($result['customerId']) && $result['customerId'] = $customer_id){
                            ?>
                    <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                        <div class="col-md-6 form-group p_star">
                            <input type="hidden" name="shippingId" value="<?php echo $result['shippingId'] ?>">
                            <input type="hidden" name="customerId" value="<?php echo $result['customerId'] ?>">
                            <span style="color:#222 ; font-weight:500">Họ & tên khách hàng:
                            </span><span><?php echo $result['first_name'].' '.$result['last_name']; ?></span>
                            <!-- <input type="text" class="form-control" placeholder="Họ *" id="first" value="" name="first_name" required>                             -->
                        </div>
                        <div class="col-md-12 form-group">
                            <span style="color:#222 ; font-weight:500">Công ty:
                            </span><span><?php echo $result['company'] ?></span>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <span style="color:#222 ; font-weight:500">Số điện thoại:
                            </span><span><?php echo $result['phone_number'] ?></span>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <span style="color:#222 ; font-weight:500">Email:
                            </span><span><?php echo $result['email'] ?></span>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <span style="color:#222 ; font-weight:500">Địa chỉ nhà (Nơi nhận hàng):
                            </span><span><?php echo $result['address_home'] ?></span>
                        </div>
                        <div class="col-md-12 form-group ">
                            <span style="color:#222 ; font-weight:500">Địa chỉ công ty (Nếu có):
                            </span><span><?php echo $result['address_office'] ?></span>
                        </div>

                        <div class="col-md-12 form-group">
                            <span style="color:#222 ; font-weight:500">Mã bưu điện(Nếu có):
                            </span><span><?php echo $result['zip'] ?></span>
                        </div>

                        <div class="col-md-12 form-group">
                            <span style="color:#222 ; font-weight:500">Ghi chú:
                            </span><span><?php echo $result['note'] ?></span>
                        </div>
                        <div class="col-md-2 form-group">

                            <input type="submit" name="submit" class="btn btn-primary text-white" value="Sửa thông tin">
                        </div>
                        <div class="col-md-12 form-group">
                            <span style="font-size:10px; font-style:italic">Note: Lưu thông tin vận chuyển cho
                                lần dặt
                                hàng kế tiếp !. Các thông tin có dấu <span class="text-danger">*</span> cần điền
                                đầy đủ
                                và chính xác!</span>
                        </div>
                    </form>
                    <?php
                        }    
                        }else{
                            ?>

                    <form class="row contact_form" action="" method="POST" novalidate="novalidate">
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" placeholder="Họ *" id="first" name="first_name"
                                required>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" placeholder="Tên *" id="last" name="last_name">
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="company" name="company"
                                placeholder="Tên công ty">
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" placeholder="Số điện thoại *" id="number"
                                name="phone_number">

                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="email" placeholder="Email *" name="email">
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" name="country" value="Việt Nam">
                        </div>

                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" placeholder="Địa chỉ chi tiết *" id="add1"
                                name="address_home">

                        </div>
                        <div class="col-md-12 form-group ">
                            <input type="text" class="form-control" id="add2" placeholder="Địa chỉ công ty"
                                name="address_office">
                        </div>

                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" id="zip" name="zip" placeholder="Mã bưu điện">
                        </div>

                        <div class="col-md-12 form-group">
                            <textarea class="form-control" name="note" id="note" rows="1"
                                placeholder="Ghi chú đặt hàng"></textarea>
                        </div>
                        <div class="col-md-2 form-group">

                            <input type="submit" name="submit" class="btn btn-primary text-white" value="Lưu">
                        </div>
                        <div class="col-md-12 form-group">
                            <span style="font-size:10px; font-style:italic">Note: Lưu thông tin vận chuyển cho
                                lần dặt
                                hàng kế tiếp !. Các thông tin có dấu <span class="text-danger">*</span> cần điền
                                đầy đủ
                                và chính xác!</span>
                        </div>
                    </form>
                    <?php
                        }
                     
                        ?>
                </div>
                <div class="col-lg-6">
                    <form id="momoForm" action="process_payment.php" method="POST">
                        <div class="order_box">
                            <h2>ĐƠN HÀNG CỦA BẠN</h2>
                            <ul class="list">
                                <li><a href="#">Sản phẩm <span>Tổng cộng</span></a></li>
                                <input type="hidden" name="sessionId"
                                    value="<?php echo ($sessionId = session_id() ) ?>">
                                <input type="hidden" name="shippingId" value="<?php echo $result['shippingId'] ?>">
                                <input type="hidden" name="customerId" value="<?php echo $result['customerId'] ?>">
                                <?php 
                                 $get_oder = $ct -> get_product_cart();
                                 $total_price = 0;
                                 $flat_rate = 30000;
                                 if($get_oder){
                                    while($result= $get_oder->fetch_assoc()){
                                        $subtotal = $result['quantity']*$result['pricediscount'];
                                        $total_price +=$subtotal;
                                        ?>
                                <li>

                                    <a href="detail-product.php?productId=<?php echo $result['productId']; ?>">
                                        <input type="hidden" name="productId[]"
                                            value="<?php echo $result['productId']?>">
                                        <input type="hidden" name="size[]" value="<?php echo $result['size']?>">
                                        <div class="row">
                                            <div class="col-7" style="padding:0">
                                                <img src="admincp/uploads/<?php echo $result['image'] ?>"
                                                    style="width:40px;object-fit:contain" alt="">
                                                <?php echo $result['productName'].' - Size '.$result['size']?>
                                            </div>
                                            <div class="col-1" style="padding:0">
                                                <span class="" name=""><?php echo 'x'.$result['quantity']?></span>
                                                <input type="hidden" name="quantity[]"
                                                    value="<?php echo $result['quantity']?>">
                                            </div>
                                            <div class="col-4" style="padding:0">
                                                <span
                                                    class="last">₫<?php echo number_format($result['pricediscount']*$result['quantity'], 0, '.', ','); ?></span>
                                                <input type="hidden" name="pricediscount[]"
                                                    value="<?php echo $result['pricediscount']?>">
                                                <input type="hidden" name="subTotal[]"
                                                    value="<?php echo ($result['pricediscount']* $result['quantity']) ?>">
                                            </div>

                                        </div>
                                    </a>
                                </li>
                                <?php
                                    }
                                 }
                                ?>
                            </ul>
                            <ul class="list list_2">
                                <li><a href="#">Tổng tiền
                                        <span>₫<?php echo number_format($total_price, 0, '.', ','); ?></span></a>
                                </li>
                                <li><a href="#">Phí vận chuyển <span>Flat
                                            rate:₫<?php echo number_format($flat_rate, 0, '.', ','); ?></span></a></li>
                                <li><a href="#">Tổng tất cả
                                        <span
                                            name="">₫<?php echo number_format($total_price + $flat_rate, 0, '.', ','); ?></span></a>
                                    <input type="hidden" name="total" value="<?php echo ($total_price + $flat_rate) ?>">
                                </li>
                            </ul>
                            <div class="payment_item">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option5" name="selectPlaceOrder">
                                    <label for="f-option5">Thanh toán khi nhận hàng</label>
                                    <div class="check"></div>
                                </div>
                                <p>Quý khách được kiểm tra hàng trước khi nhận, vui lòng thanh toán khi nhận được
                                    hàng.</p>
                            </div>
                            <div class="payment_item active">
                                <div class="radion_btn">
                                    <input type="radio" id="f-option6" name="selectMomo">
                                    <label for="f-option6">MOMO </label>
                                    <img src="img/product/momo.png" style="height:30px; object-fit:contain" alt="">
                                    <div class="check"></div>
                                </div>
                                <p>Thanh toán qua MOMO, quý khách có thể thanh toán qua thẻ tín dụng nếu không có
                                    tài khoản
                                    MOMO.</p>
                            </div>
                            <div class="creat_account">
                                <input type="checkbox" id="agreeCheckbox" name="selector">
                                <label for="agreeCheckbox">Tôi đã đọc và chấp nhận </label>
                                <a href="#">Mọi điều khoản và quy định *</a>
                            </div>
                            <div class="col-md-12">

                                <input type="submit" class="btn primary-btn w-100" name="placeOrder"
                                    id="placeOrderButton" value="ĐẶT HÀNG" disabled>

                                <input type="submit" class="btn primary-btn w-100" onclick="initiateMoMoPayment()"
                                    name="payUrl" id="paypalButton" value="TIẾP TỤC VỚI MOMO" style="display:none"
                                    disabled>

                                <script>
                                function initiateMoMoPayment() {
                                    document.getElementById('momoForm').submit();
                                }
                                </script>
                            </div>
                            <!-- <a class="primary-btn" href="#">ĐẶT HÀNG</a> -->
                            <script>
                            //Click vào nút đồng ý mới chuyển hướng trang
                            document.addEventListener('DOMContentLoaded', function() {
                                var agreeCheckbox = document.getElementById('agreeCheckbox');
                                var paypalButton = document.getElementById('paypalButton');
                                var placeOrderButton = document.getElementById('placeOrderButton');

                                agreeCheckbox.addEventListener('change', function() {
                                    paypalButton.disabled = !agreeCheckbox.checked;
                                    placeOrderButton.disabled = !agreeCheckbox.checked;
                                });
                            });
                            </script>
                            <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var cashOnDeliveryOption = document.getElementById('f-option5');
                                var paypalOption = document.getElementById('f-option6');
                                var agreeCheckbox = document.getElementById('agreeCheckbox');
                                var paypalButton = document.getElementById('paypalButton');
                                var placeOrderButton = document.getElementById('placeOrderButton');

                                cashOnDeliveryOption.addEventListener('change', function() {
                                    paypalButton.style.display = 'none';
                                    placeOrderButton.style.display = 'block';
                                });

                                paypalOption.addEventListener('change', function() {
                                    paypalButton.style.display = 'block';
                                    placeOrderButton.style.display = 'none';
                                });

                                agreeCheckbox.addEventListener('change', function() {
                                    placeOrderButton.disabled = !agreeCheckbox.checked;
                                    paypalButton.disabled = !agreeCheckbox.checked;
                                });
                            });
                            </script>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Checkout Area =================-->
<?php include('pages/footer.php') ?>