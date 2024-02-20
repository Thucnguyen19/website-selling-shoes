<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/database.php');
include_once($filepath.'/../helpers/format.php');
include_once($filepath.'/../config/config.php');

class Order  
{
    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
    //insert tbl_shipping
    public function insert_customer_detail($data,$customerId){    
        $first_name = mysqli_real_escape_string($this->db->link, $data['first_name']);
        $last_name = mysqli_real_escape_string($this->db->link, $data['last_name']);
        $company = mysqli_real_escape_string($this->db->link, $data['company']);
        $phone_number = mysqli_real_escape_string($this->db->link, $data['phone_number']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $address_home = mysqli_real_escape_string($this->db->link, $data['address_home']);
        $address_office = mysqli_real_escape_string($this->db->link, $data['address_office']);
        $zip = mysqli_real_escape_string($this->db->link, $data['zip']);
        $note = mysqli_real_escape_string($this->db->link, $data['note']);
        $customerId = mysqli_real_escape_string($this->db->link, $customerId);

        if( $first_name == "" || $last_name == "" || $company == "" || $phone_number == "" || $email == "" || $address_home == "" || $address_office == "" || $zip == "" || $note == "" || $customerId ==""){
            $alert ="<span class='text-danger'>Không được bỏ trống các thông tin <i class='fa-solid fa-triangle-exclamation' style='color: #ff1100;'></i></span>";
            return $alert;
        }else{
            $query ="INSERT INTO tbl_shipping (first_name,last_name, company, phone_number, email, address_home, address_office , zip, note, customerId) VALUES ('$first_name','$last_name','$company','$phone_number','$email','$address_home','$address_office','$zip','$note','$customerId')";
            $result =$this->db->insert($query);//lấy hàm select trong database 
            if($result){
                $alert ="<span class='text-success'> Lưu thông tin thành công <i class='fa-solid fa-circle-check' style='color: #27c41c;'></i></span>";
                return $alert ;
            }else{
                $alert ="<span class='text-danger'> Lưu thông tin thất bại</span>";
                return $alert;
            } 
        }
    }
     //insert tbl_order 
     public function insert_order($customerId,$shippingId,$total, $method,$orderDetails,$sessionId){
        $customerId = mysqli_real_escape_string($this->db->link, $customerId);
        $shippingId = mysqli_real_escape_string($this->db->link, $shippingId);
        $total = mysqli_real_escape_string($this->db->link, $total);
        $sessionId = mysqli_real_escape_string($this->db->link, $sessionId);
        // var_dump($sessionId);
        $method = mysqli_real_escape_string($this->db->link, $method);
        // var_dump($shippingId);
        if($customerId =="" || $shippingId =="" || $total == ""|| $method =="" ){
            $alert ="<span class='text-danger'>Không đủ các thông tin <i class='fa-solid fa-triangle-exclamation' style='color: #ff1100;'></i></span>";
            return $alert;
        }else{
            $query ="INSERT INTO tbl_order(customerId, shippingId,total,method) VALUES('$customerId','$shippingId','$total','$method')";
            $result =$this->db->insert($query);//lấy hàm select trong database 
              // Lấy id của order vừa thêm
    $orderId = $this->db->link->insert_id;

    // Thêm thông tin chi tiết của từng sản phẩm vào bảng order_detail
    foreach ($orderDetails as $detail) {
        $productId = $detail['productId'];
        $size = $detail['size'];
        $price = $detail['price'];
        $quantity = $detail['quantity'];
        $subTotal = $detail['subTotal'];
        $this->insert_order_detail($orderId, $productId, $size,$quantity, $price, $subTotal);
    }
    if (isset($result)) {
        // $delete_cart=$this->clearCartAfterOrder($sessionId);
        $query = "DELETE FROM tbl_cart WHERE sessionId = '$sessionId'";
        $delete_cart = $this->db->delete($query);
        // Chuyển hướng đến trang confirmation.php
        if($delete_cart){
            echo '<script type="text/javascript">';
            echo 'window.location.href="confirmation.php?orderId='.$orderId.'"';
            echo '</script>';            
        }else{
            echo 'xoa that bai';
        }
         
    }
     
   
    // Xử lý các công việc khác

    return true; // Hoặc giá trị phù hợp
        }
        
     }
     public function get_order_detail($orderId) {
        // Sử dụng prepared statement để tránh SQL injection
        $stmt = $this->db->link->prepare("SELECT a.*, b.quantity, b.size, b.pricediscount, b.subTotal, c.*, d.productName, d.image 
            FROM tbl_order AS a 
            INNER JOIN tbl_order_detail AS b ON a.orderId = b.orderId 
            INNER JOIN tbl_shipping AS c ON a.shippingId = c.shippingId 
            INNER JOIN tbl_product AS d ON b.productId = d.productId 
            WHERE a.orderId = ?");
    
        // Kiểm tra xem prepared statement có thành công không
        if ($stmt) {
            // Gán giá trị tham số
            $stmt->bind_param("i", $orderId);
    
            // Thực hiện truy vấn
            $stmt->execute();
    
            // Lấy kết quả
            $result = $stmt->get_result();
    
            // Đóng prepared statement
            $stmt->close();
    
            return $result;
        } else {
            // Xử lý lỗi khi không thể tạo prepared statement
            return false;
        }
    }
    
    
     public function insert_order_detail($orderId, $productId,$size, $quantity, $price,$subTotal) {
        $orderId = mysqli_real_escape_string($this->db->link, $orderId);
        $productId = mysqli_real_escape_string($this->db->link, $productId);
        $size = mysqli_real_escape_string($this->db->link, $size);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $subTotal = mysqli_real_escape_string($this->db->link, $subTotal);

    
        if ($orderId == "" || $productId == "" || $size == "" || $quantity == "" || $price == "" || $subTotal =="") {
            $alert = "<span class='text-danger'>Không đủ các thông tin <i class='fa-solid fa-triangle-exclamation' style='color: #ff1100;'></i></span>";
            return $alert;
        } else {
            $subtotal = $quantity * $price;
            $query = "INSERT INTO tbl_order_detail(orderId, productId, size, quantity, pricediscount, subTotal) VALUES('$orderId','$productId','$size','$quantity','$price', '$subTotal')";
            $result = $this->db->insert($query);
            
    
            if (!$result) {
                echo 'Lỗi khi thêm order detail';
                return false;
            }
    
            return true;
        }
    }
    
    
    //Xóa đơn hàng trong giỏ sau khi lên đon 
    public function clearCartAfterOrder($sessionId) {
        // Thực hiện các truy vấn hoặc hành động cần thiết để xóa đơn hàng và sản phẩm từ giỏ hàng
        // Ví dụ: xóa dữ liệu từ bảng giỏ hàng sau khi đơn hàng được đặt thành công
        $query = "DELETE FROM tbl_cart WHERE sessionId = '$sessionId'";
        $result = $this->db->delete($query);
        
        // Kiểm tra và trả về kết quả xóa
        return $result;
    }

     public function get_customer_detail($customer_id){
        $query = "SELECT * FROM tbl_shipping where customerId = '$customer_id' ";
        $result =$this->db->select($query);//lấy hàm select trong database 
        return $result;
     }
     public function get_all_order(){
        $query = "SELECT * FROM tbl_order";
        $result =$this->db->select($query);//lấy hàm select trong database 
        return $result;
     }
     public function get_order_admin(){
        $query ="SELECT * FROM tbl_order AS a 
        INNER JOIN tbl_order_detail AS b ON a.orderId = b.orderId 
        INNER JOIN tbl_shipping AS c ON a.shippingId = c.shippingId 
        INNER JOIN tbl_product AS d ON b.productId = d.productId 
        INNER JOIN tbl_customer AS e ON a.customerId = e.customerId ";
        $result =$this->db->select($query);
        return $result;
     }
     public function delete_order($id){
        $query ="DELETE From tbl_order WHERE orderId = '$id'";
        $result =$this->db->delete($query);
        if($result !== FALSE){
           $alert ="<span class='success'> Xóa đơn hàng thành công</span>";
           return $alert;
       }else{
           $alert ="<span class='error'> Xóa đơn hàng không thành công</span>";
           return $alert;
       } 
   }
}
?>