<?php 
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/database.php');
include_once($filepath.'/../helpers/format.php');
include_once($filepath.'/../config/config.php');


class Blog 
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insertblog($data, $files)
    {
        $blogName = mysqli_real_escape_string($this->db->link, $data['blogName']);
        $subtitle = isset($data['subtitle']) ? mysqli_real_escape_string($this->db->link, $data['subtitle']) : '';
        $category = mysqli_real_escape_string($this->db->link, $data['category_blog']);
        $blogDes = mysqli_real_escape_string($this->db->link, $data['blogDes']);
        $blogType = mysqli_real_escape_string($this->db->link, $data['blogType']);
        $source = mysqli_real_escape_string($this->db->link, $data['source']);
// Trước khi thực hiện bất kỳ thao tác nào với $_FILES, hãy kiểm tra xem file có tồn tại không
if (isset($_FILES['image'])) {
    $permited = array('jpg','jpeg','png','gif');
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_temp = $_FILES['image']['tmp_name'];

    // Tiếp tục với xử lý file như thông thường
    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
    $uploaded_image = "uploads/" . $unique_image;
    move_uploaded_file($file_temp, $uploaded_image);
    
    // Tiếp tục xử lý các thông tin khác và thực hiện truy vấn vào database
} else {
    // Nếu không có file được tải lên, bạn có thể xử lý theo ý của mình, ví dụ:
    $alert = "Không có file hình ảnh được chọn.";
    return $alert;
}
        if ($blogName == "" || $category == "" || $blogType == "" || $source =="" || $subtitle =="" || $blogDes == "") {
            $alert = "Không được bỏ trống";
            return $alert;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            // Bên trong phương thức insertblog trong blog.php

            // Chèn vào bảng blogs
            $queryblog = "INSERT INTO tbl_blog(blogName,blogDes,subtitle, category_blogId, blogType,source, image) VALUES('$blogName','$blogDes' ,'$subtitle','$category','$blogType','$source','$unique_image')";

              $resultblog = $this->db->insert($queryblog);

              // Lấy id của sản phẩm vừa chèn
              $blog_id = $this->db->link->insert_id;

            if ($resultblog) {
                $alert = "<span class='success'>Thêm sản phẩm thành công</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Thêm sản phẩm không thành công</span>";
                return $alert;
            }
        }
    }


    public function show_blog(){
        $query = "SELECT  a.*,b.category_blogName  from tbl_blog as a INNER JOIN tbl_category_blog as b  ON a.category_blogId = b.category_blogId ";
        $result = $this->db->select($query);
        return $result;
    }
    
    public function get_blog($id){
        // Lấy bài viết hiện tại
        $current_post_query = "SELECT * FROM tbl_blog WHERE blogId = '$id'";
        $current_post = $this->db->select($current_post_query);
    
        // Lấy bài viết trước 
        if($id === 1){
            $previous_post_query = "SELECT * FROM tbl_blog WHERE blogId > '$id' ORDER BY blogId DESC LIMIT 1";
            $previous_post = $this->db->select($previous_post_query); 
            
        }else{
            $previous_post_query = "SELECT * FROM tbl_blog WHERE blogId < '$id' ORDER BY blogId DESC LIMIT 1";
            $previous_post = $this->db->select($previous_post_query);    

        }
        // Lấy bài viết sau
        $next_post_query = "SELECT * FROM tbl_blog WHERE blogId > '$id' ORDER BY blogId ASC LIMIT 1";
        $next_post = $this->db->select($next_post_query);
    
        // Trả về một mảng chứa thông tin về bài viết hiện tại, bài viết trước và bài viết sau
        return array(
            'current_post' => $current_post,
            'previous_post' => $previous_post,
            'next_post' => $next_post
        );
    }
    


  public function update_blog($data, $files, $id){
    // var_dump($_POST); 
    $blogName = mysqli_real_escape_string($this->db->link, $data['blogName']);
    $subtitle = isset($data['subtitle']) ? mysqli_real_escape_string($this->db->link, $data['subtitle']) : '';
    $category = mysqli_real_escape_string($this->db->link, $data['category_blog']);
    $blogDes = mysqli_real_escape_string($this->db->link, $data['blogDes']);
    $blogType = mysqli_real_escape_string($this->db->link, $data['blogType']);
    $source = mysqli_real_escape_string($this->db->link, $data['source']);
    // Xử lý tệp tin
        $permited = array('jpg','jpeg','png','gif');
        $file_size = $_FILES['image']['size'];
        $file_name = $files['image']['name'];
        $file_temp = $files['image']['tmp_name'];
        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        move_uploaded_file($file_temp, $uploaded_image);
        $image = $uploaded_image;
 
 

    if ($blogName == "" || $category == "" || $blogType == "") {
        $alert = "Không được bỏ trống";
        return $alert;
    } else {
        if(!empty($file_name)){
        //Neu nguoi dung chon anh
        $query = "UPDATE tbl_blog SET blogName='$blogName',subtitle ='$subtitle',blogDes='$blogDes', category_blogId='$category',  blogType='$blogType', source ='$source', image='$unique_image' WHERE blogId = '$id'";
        // $result = $this->db->update($query);
        // die('debug: ' . $query);

    }else{
        $query = "UPDATE tbl_blog SET blogName='$blogName',subtitle ='$subtitle',blogDes='$blogDes', category_blogId='$category', blogType='$blogType',source ='$source' WHERE blogId = '$id'";
        // die('debug: ' . $query);
        
    }
    $result =$this->db->update($query);//lấy hàm select trong database 
    // return $result;
    if ($result) {
        $alert = "<span class='success'>Cập nhật tin tức thành công</span>";
        return $alert;
    } else {
        $alert = "<span class='error'>Cập nhật tin tức không thành công</span>";
        return $alert;
    }
  
}
}


    public function delete_blog($id){
        
        //sau đó  mới xóa sp
         $query ="DELETE From tbl_blog WHERE blogId = '$id'";
         $result =$this->db->delete($query);
         if($result !== FALSE){
            $alert ="<span class='text-success'> Xóa tin tức thành công</span>";
            return $alert;
        }else{
            $alert ="<span class='text-danger'> Xóa sản phẩm không thành công</span>";
            return $alert;
        } 
    }


// end backend 
//start front end 
//lay san pham moi
  public function get_all_blog(){
    $query ="SELECT a.*,b.category_blogName FROM tbl_blog as a INNER JOIN tbl_category_blog as b ON a.category_blogId = b.category_blogId  ORDER BY blogId = 'DESC' LIMIT 8";
    $result =$this->db->select($query);//lấy hàm select trong database 
    return $result;
  }
  public function get_latest_blog(){
    $query ="SELECT * FROM tbl_blog ORDER BY blogId = 'DESC' LIMIT 8";
    $result =$this->db->select($query);//lấy hàm select trong database 
    return $result;
  }
// lay san pham noi bat
}




?>
<!-- number_format(number, decimals, decimal_separator, thousands_separator);
number: Số bạn muốn định dạng.
decimals: Số lượng chữ số sau dấu phẩy thập phân. (Tùy chọn, mặc định là 0)
decimal_separator: Dấu phẩy thập phân. (Tùy chọn, mặc định là ".")
thousands_separator: Dấu phân cách hàng nghìn. (Tùy chọn, mặc định là ",")
ex: $number = 1234567.89;
$formatted_number = number_format($number, 2, '.', ',');
echo $formatted_number; -->