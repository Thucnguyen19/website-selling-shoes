<?php 
include_once('../lib/session.php');
Session::checkLogin();
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/database.php');
include_once($filepath.'/../helpers/format.php');
include_once($filepath.'/../config/config.php');
// include('../lib/database.php');
// include('../helpers/format.php');
// include('../config/config.php');

?>
<?php 
class adminlogin 
{
    private $db;
    private $fm;
 function __construct(){
$this->db = new Database();
$this->fm = new Format();
 }
//  public function login_admin($adminUser,$adminPass){
//     $adminUser =$this->fm->validation($adminUser);
//     $adminPass =$this->fm->validation($adminPass);
//     $adminUser =mysqli_real_escape_string($this->db->link,$adminUser);
//     $adminPass =mysqli_real_escape_string($this->db->link,$adminPass);
//     if(empty($adminUser)|| empty($adminPass)){
//         $alert ="User and Pass must be not empty";
//         return $alert;
//     }else{
//         $query ="SELECT * from tbl_admin WHERE adminUser ='$adminUser' AND adminPass ='$adminPass' LIMIT 1 ";
//         $result =$this->db->select($query);//lấy hàm select trong database 
//         if($result != false){
//             $value = $result ->fetch_assoc();
//             Session::set('adminLogin',true);
//             Session::set('adminId',$value['adminId']);
//             Session::set('adminUser',$value['adminUser']);
//             Session::set('adminName',$value['adminName']);
//             header('Location:index.php');
//             exit;
//         }else{
//             $alert ="User and Pass not match ";
//         return $alert;
//         }
//     }
//  }
 public function login_admin($adminUser, $adminPass) {
    $adminUser = $this->fm->validation($adminUser);
    $adminPass = $this->fm->validation($adminPass);
    $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);

    if (empty($adminUser) || empty($adminPass)) {
        $alert = "<span class='text-danger'>Tài khoản hoặc mật khẩu không được bỏ trống <i class='fa-solid fa-triangle-exclamation' style='color: #ff1100;'></i></span>";
        return $alert;
    } else {
        $hashedPassword = password_hash($adminPass, PASSWORD_DEFAULT);

        $stmt = $this->db->link->prepare("SELECT * FROM tbl_admin WHERE adminUser = ? LIMIT 1");
        $stmt->bind_param("s", $adminUser);
        $stmt->execute();
        $result = $stmt->get_result();
        // $admin_id = $this->db->link->insert_id;

        if ($result->num_rows > 0) {
            $value = $result->fetch_assoc();
            if (password_verify($adminPass, $value['adminPass'])) {
                Session::set('admin', true);
                Session::set('admin_id', $value['admin_id']);
                Session::set('adminUser', $value['adminUser']);
                Session::set('adminName', $value['adminName']);
                Session::set('level', $value['level']);
                 header('Location: index.php');
                        // echo '<script type="text/javascript">';
                        // echo 'window.location.href="index.php";';
                        // echo '</script>'; 
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
 public function insert_admin($data){
    $adminName =mysqli_real_escape_string($this->db->link,$data['adminName']);
    $sex =mysqli_real_escape_string($this->db->link,$data['sex']);
    $adminUser =mysqli_real_escape_string($this->db->link,$data['adminUser']);
    $adminEmail =mysqli_real_escape_string($this->db->link,$data['adminEmail']);
    $adminPass =password_hash(mysqli_real_escape_string($this->db->link,$data['adminPass']),PASSWORD_DEFAULT);
    $level =mysqli_real_escape_string($this->db->link,$data['level']);
if( $adminName=="" || $adminUser =="" || $adminEmail =="" || $adminPass =="" || $level =="")
{
    $alert = "Thêm tài khỏan không thành công";
}else{
    $query ="INSERT INTO tbl_admin(adminName,sex,adminUser,adminEmail,adminPass,level) VALUES('$adminName','$sex','$adminUser','$adminEmail','$adminPass','$level')";
    $result =$this->db->insert($query);
    if($result){
        $alert = "Thêm tài khỏan thành công";
    }else{
        $alert ="Them that bai";
    }
    return $alert;
     
}
}
public function show_admin(){
    $query = "SELECT * FROM tbl_admin ";
    $result = $this->db->select($query);
    return $result;
}

public function logout_admin() {
    // Xóa tất cả các session liên quan đến người dùng
    session_unset();
    session_destroy();
    // Chuyển hướng người dùng về trang đăng nhập
    echo '<script type="text/javascript">';
    echo 'window.location.href="login.php";';
    echo '</script>';
}
}
?>