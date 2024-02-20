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
class category 
{
    private $db;
    private $fm;
 function __construct(){
$this->db = new Database();
$this->fm = new Format();
 }
 public function insert_category($categoryName){
    $categoryName =$this->fm->validation($categoryName);
    $categoryName =mysqli_real_escape_string($this->db->link,$categoryName);
    if(empty($categoryName)){
        $alert ="Tên danh mục không được bỏ trống";
        return $alert;
    }else{
        $query ="INSERT INTO tbl_category (categoryName) VALUES ('$categoryName')";
        $result =$this->db->insert($query);//lấy hàm select trong database 
        if($result){
            $alert ="<span class='success'> Thêm danh mục thành công</span>";
            return $alert;
        }else{
            $alert ="<span class='error'> Thêm danh mục không thành công</span>";
            return $alert;
        } 
    }


 }
 public function show_category(){
    $query = "SELECT tbl_category.categoryId, tbl_category.categoryName, COUNT(tbl_product.productId) AS productCount 
              FROM tbl_category 
              LEFT JOIN tbl_product ON tbl_category.categoryId = tbl_product.categoryId 
              GROUP BY tbl_category.categoryId, tbl_category.categoryName";
    $result = $this->db->select($query);
    return $result;
}

  public function get_category($id){
    $query ="SELECT * FROM tbl_category WHERE categoryId = '$id'";
    $result =$this->db->select($query);//lấy hàm select trong database 
    return $result;
  }
  public function update_category($categoryName,$id){
    $categoryName =$this->fm->validation($categoryName);
    $categoryName =mysqli_real_escape_string($this->db->link,$categoryName);
    $id =mysqli_real_escape_string($this->db->link,$id);
    if(empty($categoryName)){
        $alert ="Tên danh mục không được bỏ trống";
        return $alert;
    }else{
        $query ="UPDATE tbl_category SET categoryName = '$categoryName' WHERE categoryId ='$id'";
        $result =$this->db->update($query);//lấy hàm select trong database 
        if($result !== FALSE){
            $alert ="<span class='success'> Sửa danh mục thành công</span>";
            return $alert;
        }else{
            $alert ="<span class='error'> Sửa danh mục không thành công</span>";
            return $alert;
        } 
    }
    }
    public function delete_category($id){
         $query ="DELETE From tbl_category WHERE categoryId = '$id'";
         $result =$this->db->delete($query);
         if($result !== FALSE){
            $alert ="<span class='success'> Xóa danh mục thành công</span>";
            return $alert;
        }else{
            $alert ="<span class='error'> Xóa danh mục không thành công</span>";
            return $alert;
        } 
    }

    public function get_all_category(){
        $query ="SELECT * FROM tbl_category  ORDER BY categoryId = 'DESC' ";
        $result = $this->db->select($query);
        return $result;
    }
    public function get_category_detail($id) {
        $query = "SELECT
            tbl_category.categoryId,
            tbl_category.categoryName,
            tbl_product.productId,
            tbl_product.productName,
            tbl_product.image,
            tbl_product.categoryId AS productCategoryId, -- Đặt alias nếu cần thiết
            tbl_product.brandId,
            tbl_product.price,
            tbl_product.pricediscount,
            tbl_product.productDes,
            tbl_product.productType,
            tbl_brand.brandName
          FROM
            tbl_product
          INNER JOIN
            tbl_category ON tbl_product.categoryId = tbl_category.categoryId
          INNER JOIN
            tbl_brand ON tbl_product.brandId = tbl_brand.brandId
          WHERE
            tbl_category.categoryId = '$id'";
    
        $result = $this->db->select($query);
        return $result;
    }
    
public function get_category_detail_with_limit($id, $limit, $offset) {
    $query = "SELECT * FROM tbl_category WHERE categoryId = $id LIMIT $limit OFFSET $offset";
    return $this->db->select($query);
}

    
    public function get_result_search($keyword)
    {
        $keyword = mysqli_real_escape_string($this->db->link, $keyword);
        // var_dump($keyword);
        $query = "SELECT * FROM tbl_product WHERE productName LIKE '%$keyword%'";
        $result = $this->db->select($query);
        // var_dump($result);
        return $result;
    }
    
}
?>