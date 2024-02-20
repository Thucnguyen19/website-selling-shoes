<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/database.php');
include_once($filepath.'/../helpers/format.php');
include_once($filepath.'/../config/config.php');

class Cart  
{
    private $db;
    private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function add_to_cart($id, $quantity, $size){
        $quantity = $this->fm->validation($quantity);
        $id = $this->db->link->real_escape_string($id);
        $quantity = $this->db->link->real_escape_string($quantity);
        $size = $this->db->link->real_escape_string($size);
        // var_dump($size);
        if($size == ''){
            // $message = '<span class="text-danger">Bạn hãy chọn size và số lượng nhiều hơn 1 nhé.<span>';
            $message ='<script>alert("Bạn chưa chọn size và số lượng cho sản phẩm phải lớn hơn 0 !")</script>';
                return $message;
        }else{
            $sessionId = session_id();
            $query = "SELECT * FROM tbl_product WHERE productId ='$id'";
            $result = $this->db->select($query)->fetch_assoc();
            $productName = $result['productName'];
            $pricediscount = $result['pricediscount'];
            $price = $result['price'];
            $image = $result['image'];
            $checkcard = "SELECT * FROM tbl_cart WHERE sessionId = '$sessionId' and productId = '$id' and size = '$size' ";
            $checkResult = $this->db->select($checkcard);
            if ($checkResult ) {
                $message = '<span class="text-danger">Sản phẩm đã có trong giỏ hàng.<span>';
                return $message;
            } else {
                // $queryCart = "INSERT INTO tbl_cart(productId, productName, quantity, sessionId, size, pricediscount, price, image) VALUES('$id', '$productName', '$quantity', '$sessionId', '$size', '$pricediscount', '$price', '$image')";
                // $resultCart = $this->db->insert($queryCart);   
                // return $resultCart;
              
                $queryCart = "INSERT INTO tbl_cart(productId, productName, quantity, sessionId, size, pricediscount, price, image) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = $this->db->link->prepare($queryCart);
                $stmt->bind_param("ssssssss", $id, $productName, $quantity, $sessionId, $size, $pricediscount, $price, $image);
                $resultCart = $stmt->execute();
                $stmt->close();
    
                // if ($resultCart) {
                //     $alert = "<span class='success'>Thêm sản phẩm thành công</span>";
                // } else {
                //     $alert = "<span class='error'>Thêm sản phẩm không thành công</span>";
                // }
            
                // return $alert;
            }
        }
        echo '<script type="text/javascript">';
        echo 'window.location.reload();';
        echo '</script>';
        

    }
    public function update_to_cart($quantity,$cartId){
       
        $quantity = $this->fm->validation($quantity);
        $quantity = $this->db->link->real_escape_string($quantity);
        $cartId  = $this->db->link->real_escape_string($cartId );
        if($quantity >= 1){
            $query = "UPDATE tbl_cart SET quantity = '$quantity' where cartId = '$cartId'";
            $result = $this ->db->update($query);
        }else{
         $query ="DELETE From tbl_cart WHERE cartId = '$cartId'";
         $result =$this->db->delete($query);
        }
        echo '<script type="text/javascript">';
        echo 'window.location.href="cart.php";';
        echo '</script>';
        
        if($result){
            $alert= 'Cập nhật số lượng thành công .';
        }else{
            $alert= 'Cập nhật số lượng thất bại .';
           
        }
        // Do not use echo after return  if you use echo the code will not execute
    
        return $alert;
        
    }
    public function delete_to_cart($cartId){
        $cartId  = $this->db->link->real_escape_string($cartId );
         $query ="DELETE From tbl_cart WHERE cartId = '$cartId'";
         $result =$this->db->delete($query);
         echo '<script type="text/javascript">';
         echo 'window.location.href="cart.php";';
         echo '</script>';
         if($result){
             $alert ="<span class='text-success'> Xóa sản phẩm trong giỏ hàng thành công <i class='fa-solid fa-circle-check' style='color: #3eba1c;'></i></span>";
            
        }else{
            $alert ="<span class='text-danger'> Xóa sản phẩm trong giỏ hàng không thành công</span>";
            
        } 
  
     
        return $alert;
    }
    
    public function get_product_cart(){
        $sessionId = session_id();
        $query ="SELECT * FROM tbl_cart WHERE sessionId ='$sessionId'";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_all_product_cart(){
        $sessionId = session_id();
        $query = "SELECT SUM(quantity) AS totalItems FROM tbl_cart WHERE sessionId = '$sessionId'";
        $result = $this ->db->select($query);
        return $result;
    }
}
?>