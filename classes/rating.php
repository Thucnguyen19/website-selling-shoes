<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/database.php');
include_once($filepath.'/../helpers/format.php');
include_once($filepath.'/../config/config.php');

class Rating  
{
    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }
    public function insert_rating($data){
        $rating =mysqli_real_escape_string($this->db->link,$data['rating']);
        $full_name =mysqli_real_escape_string($this->db->link,$data['full_name']);
        $email =mysqli_real_escape_string($this->db->link,$data['email']);
        $phone_number =mysqli_real_escape_string($this->db->link,$data['phone_number']);
        $review =mysqli_real_escape_string($this->db->link,$data['review']);
        $customerId =mysqli_real_escape_string($this->db->link,$data['customerId']);
        $productId =mysqli_real_escape_string($this->db->link,$data['productId']);
        if($rating =="" || $full_name=="" || $email =="" || $phone_number =="" || $review== "" || $customerId == "" || $productId==""){
            echo "Thêm đánh giá thất bại.";
        }else{
            $query = "INSERT INTO tbl_rating(full_name,email, phone_number,review,customerId,productId) VALUES('$full_name','$email','$phone_number','$review','$customerId','$productId')";
            $result = $this->db->insert($query);
            if($result){
                // echo "<span class='text-success'>Cảm ơn bạn đã đánh giá sản phẩm.</span>";
                echo '<script>';
                echo 'showSuccessMessage("Đánh giá thành công!");';
                echo '</script>';
            }else{
                echo "<span class='text-success'>Đánh giá sản phẩm thất bại.</span>";
            }
        }
    }
    public function get_rating(){
        $query = "SELECT * FROM tbl_rating   ORDER BY ratingId ='DESC' LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_average_rating() {
        $query = "SELECT ROUND(AVG(star), 1) as average_rating FROM tbl_rating";
        return $this->db->select($query);
    }
    

}
?>