<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/database.php');
include_once($filepath.'/../helpers/format.php');
include_once($filepath.'/../config/config.php');

class DirectChat  
{
    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_message($data){
        $message = mysqli_real_escape_string($this->db->link,$data['message']);
        $admin_id = mysqli_real_escape_string($this->db->link,$data['admin_id']);
        if(isset($message)){
            $query ="INSERT INTO tbl_direct_chat(message,admin_id) VALUES('$message','$admin_id')";
            $result =$this->db->insert($query);
            if($result){
                $alert ="<div class='float-right'><span class='text-success' style='font-size:14px'> Gửi thành công <i class='fa-solid fa-circle-check' style='color: #27c41c;'></i></span></div>";
            }else{
                $alert ="<span class='text-danger'> Gửi thất bại</span>";
            }
            return $alert;
        }
       
        
    }
     public function get_message(){
        $query = "SELECT a.admin_id, b.adminName,b.sex, a.message,a.created_at  FROM tbl_direct_chat as a inner join tbl_admin as b on a.admin_id = b.admin_id ";
        $result = $this->db->select($query);
        return $result;
     }
     public function delete_message($id){
        $query ="DELETE From tbl_message WHERE messageId = '$id'";
        $result =$this->db->delete($query);
        if($result !== FALSE){
           $alert ="<span class='success'> Xóa phản hồi thành công</span>";
           return $alert;
       }else{
           $alert ="<span class='error'> Xóa phản hồi không thành công</span>";
           return $alert;
       } 
   }
}
?>