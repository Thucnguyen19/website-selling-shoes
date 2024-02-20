<?php include('pages/header.php') ?>
<?php
 $cart =new Cart();
 if($_SERVER['REQUEST_METHOD']== 'POST' && !empty($_POST['update'])){
	$quantity = $_POST['quantity'];
    $cartId =$_POST['cartId'];
	$updateCart  = $ct->update_to_cart( $quantity,$cartId);
 }
 $deletecart = ""; // Khai báo trước để tránh lỗi khi sử dụng biến
 if($_SERVER['REQUEST_METHOD']== 'POST' && !empty($_POST['delete'])){
    $cartId =$_POST['cartId'];
	$deleteCart  = $ct->delete_to_cart($cartId);
 }
 $get_product = $ct->get_product_cart();

?>

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>GIỎ HÀNG </h1>
                <nav class="d-flex align-items-center">
                    <a href="index.html">TRANG CHỦ<span class=""><i class="fa-solid fa-arrow-right"
                                style="color: #ffffff;"></i></span></a>
                    <a href="category.html">GIỎ HÀNG CỦA BẠN</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Cart Area =================-->
<section class="cart_area">
    <div class="container">
        <div class="cart_inner">
            <div class="table-responsive">
                <table class="table">
                    <?php
                        if(isset($deleteCart)){
                            echo $deleteCart;
                        }
                        ?>
                    <?php
                            if($get_product){

                        ?>
                    <thead>

                        <tr>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Size</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Tổng</th>
                            <th scope="col">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                                while($result =$get_product->fetch_assoc()){

                                   ?>
                        <tr>
                            <td>
                                <div class="media">
                                    <div class="d-flex">
                                        <img style="height:40px ;object-fit:contain"
                                            src="admincp/uploads/<?php echo $result['image'];?>"
                                            alt="<?php echo $result['productName'] ?>">
                                    </div>
                                    <div class="media-body">
                                        <p><?php echo $result['productName']?></p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h5><?php echo $result['size'] ?></h5>
                            </td>
                            <td>
                                <h5>₫<?php echo number_format($result['price'], 0, ',', '.'); ?></h5>
                            </td>
                            <form action="" method="POST">
                                <td>
                                    <div class="product_count">
                                        <input type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>">
                                        <input type="text" name="quantity" id="sst-<?php echo $result['cartId'] ?>"
                                            maxlength="12" value="<?php echo $result['quantity'];?>" title="Quantity:"
                                            class="input-text qty">
                                        <button
                                            onclick="var result = document.getElementById('sst-<?php echo $result['cartId'] ?>'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                            class="increase items-count" type="button"><i
                                                class="fa-solid fa-angle-up fa-xs" style="color: #999999;"></i></button>
                                        <button
                                            onclick="var result = document.getElementById('sst-<?php echo $result['cartId'] ?>'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                                            class="reduced items-count" type="button"><i
                                                class="fa-solid fa-angle-down fa-xs"
                                                style="color: #999999;"></i></button>
                                    </div>
                                </td>
                                <td>
                                    <h5>₫<?php echo number_format($result['price']*$result['quantity'], 0, ',', '.'); ?>
                                    </h5>
                                </td>
                                <td>
                                    <input type="submit" name="update" value="Cập nhật" class="btn btn-primary">
                                    <input type="submit"
                                        onclick="return confirm('Bạn chắc chắn muốn xóa sản phẩm này chứ?')"
                                        name="delete" value="Xóa" class="btn btn-danger">
                                </td>
                            </form>
                        </tr>
                        <?php
                                }?>


                    </tbody>
                </table>
            </div>
            <?php 
                if(isset($_SESSION['customer']) && $_SESSION['customer'] == true) {
                    $checkoutURL = "checkout.php";
                    ?>
            <a href="checkout.php" class="btn btn-secondary float-right">THÔNG TIN ĐƠN HÀNG</a>
            <?php }else{
                 $checkoutURL = "login.php?redirect=checkout.php";
                ?>
            <a href="<?php echo $checkoutURL; ?>" class="btn btn-secondary float-right">THÔNG TIN ĐƠN HÀNG</a>
            <?php
               }
                ?>
            <?php
                            }else{
                                ?>
            <div class="text-danger text-lg-center" style="font-size:18px; font-weight:500;">Giỏ hàng của bạn đang
                trống! Hãy tiếp tục mua sắm nhé.</div>
            <?php
                            }
                            ?>

        </div>
    </div>
</section>
<!--================End Cart Area =================-->

<?php include('pages/footer.php') ?>