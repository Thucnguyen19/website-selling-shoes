<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/database.php');
include_once($filepath.'/../helpers/format.php');
include_once($filepath.'/../config/config.php');

class Contact  
{
    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_contact($data){
        $name = mysqli_real_escape_string($this->db->link,$data['name']);
        $email = mysqli_real_escape_string($this->db->link,$data['email']);
        $subject = mysqli_real_escape_string($this->db->link,$data['subject']);
        $message = mysqli_real_escape_string($this->db->link,$data['message']);
        $query ="INSERT INTO tbl_contact(name,email,subject,message) VALUES('$name','$email','$subject','$message')";
        $result =$this->db->insert($query);
        if($result){
            $alert ="<div class='text-center'><span class='text-success'> Gửi phản hồi thành công <i class='fa-solid fa-circle-check' style='color: #27c41c;'></i></span></div>";
        }else{
            $alert ="<span class='text-danger'> Gửi thất bại</span>";
        }
        return $alert;
        
    }
     public function get_contact(){
        $query = "SELECT *   FROM tbl_contact ";
        $result = $this->db->select($query);
        return $result;
     }
     public function delete_contact($id){
        $query ="DELETE From tbl_contact WHERE contactId = '$id'";
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