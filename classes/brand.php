<?php 
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/database.php');
include_once($filepath.'/../helpers/format.php');
include_once($filepath.'/../config/config.php');
// include_once('../lib/database.php');
// include_once('../helpers/format.php');
// include_once('../config/config.php');

?>
<?php 
class brand 
{

    private $db;
    private $fm;
 function __construct(){
$this->db = new Database();
$this->fm = new Format();
 }
 public function insert_brand($brandName){
    $brandName =$this->fm->validation($brandName);
    $brandName =mysqli_real_escape_string($this->db->link,$brandName);
    if(empty($brandName)){
        $alert ="Tên thương hiệu không được bỏ trống";
        return $alert;
    }else{
        $query ="INSERT INTO tbl_brand (brandName) VALUES ('$brandName')";
        $result =$this->db->insert($query);//lấy hàm select trong database 
        if($result){
            $alert ="<span class='success'> Thêm thương hiệu thành công</span>";
            return $alert;
        }else{
            $alert ="<span class='error'> Thêm thương hiệu không thành công</span>";
            return $alert;
        } 
    }


 }
  public function show_brand(){
    $query ="SELECT * FROM tbl_brand order by brandId desc";
    $result =$this->db->select($query);//lấy hàm select trong database 
    return $result;
  }
  public function get_brand($id){
    $query ="SELECT * FROM tbl_brand WHERE brandId = '$id'";
    $result =$this->db->select($query);//lấy hàm select trong database 
    return $result;
  }
  public function update_brand($brandName,$id){
    $brandName =$this->fm->validation($brandName);
    $brandName =mysqli_real_escape_string($this->db->link,$brandName);
    $id =mysqli_real_escape_string($this->db->link,$id);
    if(empty($brandName)){
        $alert ="Tên thương hiệu không được bỏ trống";
        return $alert;
    }else{
        $query ="UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId ='$id'";
        $result =$this->db->update($query);//lấy hàm select trong database 
        if($result !== FALSE){
            $alert ="<span class='success'> Sửa thương hiệu thành công</span>";
            return $alert;
        }else{
            $alert ="<span class='error'> Sửa thương hiệu không thành công</span>";
            return $alert;
        } 
    }
    }
    public function delete_brand($id){
         $query ="DELETE * From tbl_brand WHERE brandId = '$id'";
         $result =$this->db->delete($query);
         if($result !== FALSE){
            $alert ="<span class='success'> Xóa thương hiệu thành công</span>";
            return $alert;
        }else{
            $alert ="<span class='error'> Xóa thương hiệu không thành công</span>";
            return $alert;
        } 
    }

    public function get_all_brand(){
        $query = "SELECT tbl_brand.brandId, tbl_brand.brandName, COUNT(tbl_product.productId) AS productCount 
              FROM tbl_brand 
              LEFT JOIN tbl_product ON tbl_brand.brandId = tbl_product.brandId 
              GROUP BY tbl_brand.brandId, tbl_brand.brandName";
    $result = $this->db->select($query);
    return $result;
    }

}