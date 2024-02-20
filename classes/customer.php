<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/database.php');
include_once($filepath.'/../helpers/format.php');
include_once($filepath.'/../config/config.php');

class Customer  
{
    private $db;
    private $fm;
 function __construct(){
$this->db = new Database();
$this->fm = new Format();
 }
 public function insert_customer($data){
    $customerName = mysqli_real_escape_string($this->db->link, $data['customerName']);
    $email = mysqli_real_escape_string($this->db->link, $data['email']);
    $phone_number = mysqli_real_escape_string($this->db->link, $data['phone_number']);
    $password = password_hash(mysqli_real_escape_string($this->db->link, $data['password']), PASSWORD_DEFAULT);
    if($customerName == "" || $email == "" || $phone_number == "" || $password == "" ){
        $alert ="<span class='text-danger'>Không được bỏ trống các thông tin <i class='fa-solid fa-triangle-exclamation' style='color: #ff1100;'></i></span>";
        return $alert;
    }else{
        $query ="INSERT INTO tbl_customer (customerName,email, phone_number,password) VALUES ('$customerName','$email','$phone_number','$password')";
        $result =$this->db->insert($query);//lấy hàm select trong database 
        if($result){
            $alert ="<span class='text-success'> Đăng ký tài khoản thành công <i class='fa-solid fa-circle-check' style='color: #27c41c;'></i></span>";
            echo '<script type="text/javascript">';
            echo 'window.location.href="login.php";';
            echo '</script>';
        }else{
            $alert ="<span class='text-danger'> Đăng ký thất bại</span>";
            return $alert;
        } 
    }
}
public function login_customer($username, $password) {
    $username = $this->fm->validation($username);
    $password = $this->fm->validation($password);
    $username = mysqli_real_escape_string($this->db->link, $username);

    if (empty($username) || empty($password)) {
        $alert = "<span class='text-danger'>Tài khoản hoặc mật khẩu không được bỏ trống <i class='fa-solid fa-triangle-exclamation' style='color: #ff1100;'></i></span>";
        return $alert;
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->link->prepare("SELECT * FROM tbl_customer WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $value = $result->fetch_assoc();
            if (password_verify($password, $value['password'])) {
                Session::set('customer', true);
                Session::set('customerId', $value['customerId']);
                Session::set('username', $value['email']);
                Session::set('customerName', $value['customerName']);
                    // Kiểm tra nếu có tham số redirect
                    if (isset($_GET['redirect'])) {
                        // Chuyển hướng người dùng đến trang mục tiêu
                        echo '<script type="text/javascript">';
                        echo 'window.location.href="checkout.php";';
                        echo '</scrip>';
                       
                    } else {
                        // Nếu không có tham số redirect, chuyển hướng về trang index.php
                        echo '<script type="text/javascript">';
                        echo 'window.location.href="index.php";';
                        echo '</script>';
                    }   
            } else {
                $alert = "<span class='text-danger'>Tài khoản hoặc mật khẩu sai <i class='fa-solid fa-triangle-exclamation' style='color: #ff1100;'></i> </span>";
                return $alert;
            }
        } else {
            $alert = "<span class='text-danger'>Tài khoản hoặc mật khẩu sai <i class='fa-solid fa-triangle-exclamation' style='color: #ff1100;'></i> </span>";
            return $alert;
        }
    }
}
public function logout_customer() {
    // Xóa tất cả các session liên quan đến người dùng
    session_unset();
    session_destroy();
    // Chuyển hướng người dùng về trang đăng nhập
    echo '<script type="text/javascript">';
    echo 'window.location.href="login.php";';
    echo '</script>';
}
public function get_all_customer(){
    $query = "SELECT * FROM tbl_customer";
    $result =$this->db->select($query);//lấy hàm select trong database 
    return $result;
 }
}
?>