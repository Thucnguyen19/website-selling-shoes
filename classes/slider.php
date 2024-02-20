<?php 
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/database.php');
include_once($filepath.'/../helpers/format.php');
include_once($filepath.'/../config/config.php');


class Slider 
{
    private $db;
    private $fm;
    private $sizes;
    private $colors;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insertslider($data, $files)
    {
    
        $sliderName = mysqli_real_escape_string($this->db->link, $data['sliderName']);
        $sliderDes = mysqli_real_escape_string($this->db->link, $data['sliderDes']);
        $status = mysqli_real_escape_string($this->db->link, $data['status']);
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
    // ...
} else {
    // Nếu không có file được tải lên, bạn có thể xử lý theo ý của mình, ví dụ:
    $alert = "Không có file hình ảnh được chọn.";
    return $alert;
}


        if ($sliderName == "" || $status =="") {
            $alert = "Không được bỏ trống";
            return $alert;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            // Bên trong phương thức insertslider trong slider.php

            // Chèn vào bảng sliders
            $queryslider = "INSERT INTO tbl_slider(sliderName,sliderDes, status, image) VALUES('$sliderName','$sliderDes','$status','$unique_image')";

              $resultslider = $this->db->insert($queryslider);

              // Lấy id của sản phẩm vừa chèn
            //   $slider_id = $this->db->link->insert_id;

            // $query = "INSERT INTO tbl_slider(sliderName, categoryId, brandId, sliderDes, price, pricediscount, sliderType, image) VALUES('$sliderName','$category','$brand','$sliderDes','$price','$priceDiscount','$sliderType','$unique_image')";
            // $result = $this->db->insert($query);

            if ($resultslider) {
                $alert = "<span class='success'>Thêm sản phẩm thành công</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Thêm sản phẩm không thành công</span>";
                return $alert;
            }
        }
    }


  public function show_slider(){
    $query = "SELECT * 
  FROM
    tbl_slider
  
  ORDER BY
    tbl_slider.sliderId DESC";
    $result =$this->db->select($query);//lấy hàm select trong database 
    return $result;
  }

  public function get_slider($id){
    $query = "SELECT 
        tbl_slider.*
    FROM
        tbl_slider
    WHERE
        tbl_slider.sliderId = '$id'";

    $result = $this->db->select($query);
    return $result;
}

  public function update_slider($data, $files, $id){
    // var_dump($_POST); 
    $sliderName = mysqli_real_escape_string($this->db->link, $data['sliderName']);
    $sliderDes = mysqli_real_escape_string($this->db->link, $data['sliderDes']);
   
    $status = mysqli_real_escape_string($this->db->link, $data['status']);

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
    
    if ($sliderName == "" || $status == "" || $sliderDes =="" ) {
        $alert = "Không được bỏ trống";
        return $alert;
    } else {
        if(!empty($file_name)){
        //Neu nguoi dung chon anh
        $query = "UPDATE tbl_slider SET sliderName='$sliderName', sliderDes='$sliderDes', status='$status', image='$unique_image' WHERE sliderId = '$id'";
        // $result = $this->db->update($query);
        // die('debug: ' . $query);

    }else{
        $query = "UPDATE tbl_slider SET sliderName='$sliderName',sliderDes ='$sliderDes', status='$status' WHERE sliderId = '$id'";
        // die('debug: ' . $query);   
    }
    $result =$this->db->update($query);//lấy hàm select trong database 
    // return $result;
    if ($result) {
        $alert = "<span class='success'>Cập nhật sản phẩm thành công</span>";
        return $alert;
    } else {
        $alert = "<span class='error'>Cập nhật sản phẩm không thành công</span>";
        return $alert;
    }
  
}
}


    public function delete_slider($id){
       
        //sau đó  mới xóa sp
         $query ="DELETE From tbl_slider WHERE sliderId = '$id'";
         $result =$this->db->delete($query);
         if($result !== FALSE){
            $alert ="<span class='success'> Xóa sản phẩm thành công</span>";
            return $alert;
        }else{
            $alert ="<span class='error'> Xóa sản phẩm không thành công</span>";
            return $alert;
        } 
    }
    // show slider to front-end 
    public function show_slider_home(){
        $query ="SELECT * FROM tbl_slider WHERE status = 2";
        $result = $this->db->select($query);
        return $result;


    }
}