<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/database.php');
include_once($filepath.'/../helpers/format.php');
include_once($filepath.'/../config/config.php');

class Momo  
{
    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
   public function execPostRequest($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data))
    );
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    //execute post
    $result = curl_exec($ch);
    //close connection
    curl_close($ch);
    return $result;
}

public function createPaymentRequest($total){
 $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
$partnerCode = 'MOMOBKUN20180529';
$accessKey = 'klm05TvNBzhg7h7j';
$secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
$orderInfo = "Thanh toán tiền mua hàng tại New Color qua MoMo";
$amount = mysqli_real_escape_string($this->db->link,$total);
$orderId = rand(00,9999);
$redirectUrl = "http://localhost/web-sneaker/checkout.php";//chuyển hướng khi hủy giao dịch
$ipnUrl = "http://localhost/web-sneaker/confirmation.php";// chuyển hướng khi giao dịch thành công 
$extraData = "";


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['payUrl'])){
    $partnerCode = $partnerCode;
    $accessKey = $accessKey;
    $serectkey = $secretKey;
    $orderId = $orderId ; // Mã đơn hàng
    $orderInfo = $orderInfo;
    $amount =$amount;
    $ipnUrl = $ipnUrl;
    $redirectUrl = $redirectUrl;
    $extraData = $extraData;

    $requestId = time() . "";
    $requestType = "payWithATM";
    // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
    //before sign HMAC SHA256 signature
    $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
    $signature = hash_hmac("sha256", $rawHash, $serectkey);
    $data = array('partnerCode' => $partnerCode,
        'partnerName' => "Test",
        "storeId" => "MomoTestStore",
        'requestId' => $requestId,
        'amount' => $amount,
        'orderId' => $orderId,
        'orderInfo' => $orderInfo,
        'redirectUrl' => $redirectUrl,
        'ipnUrl' => $ipnUrl,
        'lang' => 'vi',
        'extraData' => $extraData,
        'requestType' => $requestType,
        'signature' => $signature);
    $result = $this->execPostRequest($endpoint, json_encode($data));
    $jsonResult = json_decode($result, true);  // decode json
    var_dump($jsonResult);
    //Just a example, please check more in there
// Kiểm tra xem có lỗi không
if (isset($jsonResult['errorCode']) && $jsonResult['errorCode'] != '0') {
    // Xử lý lỗi
    echo 'Error: ' . $jsonResult['message'];
} else {
    // Kiểm tra xem khóa "payUrl" có tồn tại trong mảng không
    if (isset($jsonResult['payUrl'])) {
        // Chuyển hướng đến trang thanh toán MoMo
        header('Location: ' . $jsonResult['payUrl']);
    } else {
        // Xử lý khi không có khóa "payUrl"
        echo 'Error: Missing "payUrl" in the response.';
    }
}
}

}
}
 ?>