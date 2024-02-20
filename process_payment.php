<?php
spl_autoload_register(function($className) {
	include_once("classes/".$className.".php");

});

// Khởi tạo đối tượng Momo
$momo = new Momo();
$order = new Order();
// Kiểm tra xem có dữ liệu POST từ form không
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['payUrl'])) {
    // Lấy thông tin đơn hàng và số tiền từ form

    $customerId = $_POST['customerId'];
    // var_dump($customerId);
    $shippingId = $_POST['shippingId'];
    $total = $_POST['total'];
    $method = 'Thanh toán khi nhận hàng';
    $products = $_POST['productId'];
    $prices = $_POST['pricediscount'];
    $sizes = $_POST['size'];
    $quantitys = $_POST['quantity'];
    $subTotals = $_POST['subTotal'];
    $sessionId = $_POST['sessionId'];
    // Tạo yêu cầu thanh toán MoMo
    $momo->createPaymentRequest($total);
} else {
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['placeOrder'])){
      
        $customerId = $_POST['customerId'];
        // var_dump($customerId);
        $shippingId = $_POST['shippingId'];
        $total = $_POST['total'];
        $method = 'Thanh toán khi nhận hàng';
        $products = $_POST['productId'];
        $prices = $_POST['pricediscount'];
        $sizes = $_POST['size'];
        $quantitys = $_POST['quantity'];
        $subTotals = $_POST['subTotal'];
        $sessionId = $_POST['sessionId'];
        $orderDetails = array();

        for ($i = 0; $i < count($products); $i++) {
            $orderDetails[] = array(
                'productId' => $products[$i],
                'size' => $sizes[$i],
                'price' => $prices[$i],
                'quantity' => $quantitys[$i],
                'subTotal' => $subTotals[$i],
            );
        }
        
        $insert_order = $order->insert_order($customerId, $shippingId,$total, $method, $orderDetails,$sessionId);
     }
    // Xử lý trường hợp không có dữ liệu POST
}

?>