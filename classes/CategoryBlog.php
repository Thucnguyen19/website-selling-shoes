<?php 
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/database.php');
include_once($filepath.'/../helpers/format.php');
include_once($filepath.'/../config/config.php');

?>
<?php 
class CategoryBlog
{
    private $db;
    private $fm;
 function __construct(){
$this->db = new Database();
$this->fm = new Format();
 }
 public function insert_category_blog($category_blogName){
    $category_blogName =$this->fm->validation($category_blogName);
    $category_blogName =mysqli_real_escape_string($this->db->link,$category_blogName);
    if(empty($category_blogName)){
        $alert ="Tên danh mục không được bỏ trống";
        return $alert;
    }else{
        $query ="INSERT INTO tbl_category_blog (category_blogName) VALUES ('$category_blogName')";
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
 public function show_category_blog(){
    $query = "SELECT tbl_category_blog.category_blogId, tbl_category_blog.category_blogName From tbl_category_blog";
    $result = $this->db->select($query);
    return $result;
}

  public function get_category_blog($id){
    $query ="SELECT * FROM tbl_category_blog WHERE category_blogId = '$id'";
    $result =$this->db->select($query);//lấy hàm select trong database 
    return $result;
  }
  public function update_category_blog($category_blogName,$id){
    $category_blogName =$this->fm->validation($category_blogName);
    $category_blogName =mysqli_real_escape_string($this->db->link,$category_blogName);
    $id =mysqli_real_escape_string($this->db->link,$id);
    if(empty($category_blogName)){
        $alert ="Tên danh mục không được bỏ trống";
        return $alert;
    }else{
        $query ="UPDATE tbl_category_blog SET category_blogName = '$category_blogName' WHERE category_blogId ='$id'";
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
    public function delete_category_blog($id){
         $query ="DELETE From tbl_category_blog WHERE category_blogId = '$id'";
         $result =$this->db->delete($query);
         if($result !== FALSE){
            $alert ="<span class='success'> Xóa danh mục thành công</span>";
            return $alert;
        }else{
            $alert ="<span class='error'> Xóa danh mục không thành công</span>";
            return $alert;
        } 
    }
}
 ?>