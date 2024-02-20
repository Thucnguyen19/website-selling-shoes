<?php 
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../lib/database.php');
include_once($filepath.'/../helpers/format.php');
include_once($filepath.'/../config/config.php');


class Product 
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

    public function insertProduct($data, $files,$sizes, $colors)
    {
      $this->sizes = explode(',', $sizes);
      $this->colors = explode(',', $colors);
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $category = mysqli_real_escape_string($this->db->link, $data['category']);
        $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
        $productDes = mysqli_real_escape_string($this->db->link, $data['productDes']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $priceDiscount = mysqli_real_escape_string($this->db->link, $data['pricediscount']);
        $productType = mysqli_real_escape_string($this->db->link, $data['productType']);
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


        if ($productName == "" || $category == "" || $brand == "" || $productDes == "" || $price == "" || $priceDiscount == "" || $productType == "") {
            $alert = "Không được bỏ trống";
            return $alert;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            // Bên trong phương thức insertProduct trong product.php

            // Chèn vào bảng products
            $queryProduct = "INSERT INTO tbl_product(productName, categoryId, brandId, productDes, price, pricediscount, productType, image) VALUES('$productName','$category','$brand','$productDes','$price','$priceDiscount','$productType','$unique_image')";

              $resultProduct = $this->db->insert($queryProduct);

              // Lấy id của sản phẩm vừa chèn
              $product_id = $this->db->link->insert_id;

              // Lặp qua các sizes và chèn vào bảng product_sizes
              foreach ($this->sizes as $size) {
                  $querySize = "INSERT INTO size (productId, sizeName) VALUES ('$product_id', '$size')";
                  $resultSize = $this->db->insert($querySize);
              
                  // Kiểm tra kết quả chèn vào bảng product_sizes
                  if (!$resultSize) {
                      // Xử lý lỗi khi chèn vào bảng product_sizes
                      return "Lỗi khi chèn kích thước.";
                  }
              }

              // Lặp qua các colors và chèn vào bảng product_colors
              foreach ($this->colors as $color) {
                  $queryColor = "INSERT INTO color (productId, colorName) VALUES ('$product_id', '$color')";
                  $resultColor = $this->db->insert($queryColor);
              
                  // Kiểm tra kết quả chèn vào bảng product_colors
                  if (!$resultColor) {
                      // Xử lý lỗi khi chèn vào bảng product_colors
                      return "Lỗi khi chèn màu sắc.";
                  }
              }


            // $query = "INSERT INTO tbl_product(productName, categoryId, brandId, productDes, price, pricediscount, productType, image) VALUES('$productName','$category','$brand','$productDes','$price','$priceDiscount','$productType','$unique_image')";
            // $result = $this->db->insert($query);

            if ($resultProduct) {
                $alert = "<span class='success'>Thêm sản phẩm thành công</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Thêm sản phẩm không thành công</span>";
                return $alert;
            }
        }
    }


  public function show_product(){
    $query = "SELECT
    tbl_product.productId,
    tbl_product.productName,
    tbl_product.image,
    tbl_product.categoryId,
    tbl_product.brandId,
    tbl_product.price,
    tbl_product.pricediscount,
    tbl_product.productDes,
    tbl_product.productType,
    tbl_category.categoryName,
    tbl_brand.brandName,
    GROUP_CONCAT(DISTINCT size.sizeName) AS sizes,
        GROUP_CONCAT(DISTINCT color.colorName) AS colors
  FROM
    tbl_product
  INNER JOIN
    tbl_category ON tbl_product.categoryId = tbl_category.categoryId
  INNER JOIN
    tbl_brand ON tbl_product.brandId = tbl_brand.brandId
    LEFT JOIN
        size ON tbl_product.productId = size.productId
    LEFT JOIN
        color ON tbl_product.productId = color.productId
    GROUP BY
        tbl_product.productId
  ORDER BY
    tbl_product.productId DESC";
    $result =$this->db->select($query);//lấy hàm select trong database 
    return $result;
  }
  // public function get_product($id){
  //   $query ="SELECT * ,size.sizeName,
  //   color.colorName
  //   FROM tbl_product
  //    INNER JOIN
  //   size ON tbl_product.productId = size.productId
  //   INNER JOIN
  //   color ON tbl_product.productId = color.productId
  //    WHERE productId = '$id'";
  //   $result =$this->db->select($query);//lấy hàm select trong database 
  //   return $result;
  // }
  public function get_product($id){
    $query = "SELECT 
        tbl_product.*,
        GROUP_CONCAT(DISTINCT size.sizeName) AS sizes,
        GROUP_CONCAT(DISTINCT color.colorName) AS colors
    FROM
        tbl_product
    LEFT JOIN
        size ON tbl_product.productId = size.productId
    LEFT JOIN
        color ON tbl_product.productId = color.productId
    WHERE
        tbl_product.productId = '$id'
    GROUP BY
        tbl_product.productId";

    $result = $this->db->select($query);
    return $result;
}

  public function update_product($data, $files, $id){
    // var_dump($_POST); 
    $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
    $category = mysqli_real_escape_string($this->db->link, $data['category']);
    $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
    $productDes = mysqli_real_escape_string($this->db->link, $data['productDes']);
    $price = mysqli_real_escape_string($this->db->link, $data['price']);
    $priceDiscount = mysqli_real_escape_string($this->db->link, $data['pricediscount']);
    $productType = mysqli_real_escape_string($this->db->link, $data['productType']);

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
     // Lấy các sizes và colors từ form
     $sizes = explode(',', $data['sizes']);
     $colors = explode(',', $data['colors']);
 
     // Xóa tất cả các size và color của sản phẩm trong bảng product_sizes và product_colors
     $this->db->delete("DELETE FROM size WHERE productId = '$id'");
     $this->db->delete("DELETE FROM color WHERE productId = '$id'");
 
     // Lặp qua các sizes và chèn vào bảng product_sizes
     foreach ($sizes as $size) {
         $size = mysqli_real_escape_string($this->db->link, $size);
         $querySize = "INSERT INTO size (productId, sizeName) VALUES ('$id', '$size')";
         $this->db->insert($querySize);
     }
 
     // Lặp qua các colors và chèn vào bảng product_colors
     foreach ($colors as $color) {
         $color = mysqli_real_escape_string($this->db->link, $color);
         $queryColor = "INSERT INTO color (productId, colorName) VALUES ('$id', '$color')";
         $this->db->insert($queryColor);
     }

    if ($productName == "" || $category == "" || $brand == "" || $productDes == "" || $price == "" || $priceDiscount == "" || $productType == "") {
        $alert = "Không được bỏ trống";
        return $alert;
    } else {
        if(!empty($file_name)){
        //Neu nguoi dung chon anh
        $query = "UPDATE tbl_product SET productName='$productName', categoryId='$category', brandId='$brand', productDes='$productDes', price='$price', pricediscount='$priceDiscount', productType='$productType', image='$unique_image' WHERE productId = '$id'";
        // $result = $this->db->update($query);
        // die('debug: ' . $query);

    }else{
        $query = "UPDATE tbl_product SET productName='$productName', categoryId='$category', brandId='$brand', productDes='$productDes', price='$price', pricediscount='$priceDiscount', productType='$productType' WHERE productId = '$id'";
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


    public function delete_product($id){
        // Trước hết, lấy thông tin size và màu của sản phẩm
         $query_size = "DELETE FROM size WHERE productId = '$id'";
         $query_color = "DELETE FROM color WHERE productId = '$id'";

         $result_size = $this->db->delete($query_size);
         $result_color = $this->db->delete($query_color);
        //sau đó  mới xóa sp
         $query ="DELETE From tbl_product WHERE productId = '$id'";
         $result =$this->db->delete($query);
         if($result !== FALSE){
            $alert ="<span class='success'> Xóa sản phẩm thành công</span>";
            return $alert;
        }else{
            $alert ="<span class='error'> Xóa sản phẩm không thành công</span>";
            return $alert;
        } 
    }


// end backend 
//start front end 
//lay san pham moi
  public function getlatest_product(){
    $query ="SELECT * FROM tbl_product ORDER BY productId = 'DESC' LIMIT 8";
    $result =$this->db->select($query);//lấy hàm select trong database 
    return $result;
  }
// lay san pham noi bat
public function getfeature_product(){
    $query ="SELECT * FROM tbl_product WHERE productType = 1 LIMIT 8" ;
    $result =$this->db->select($query);//lấy hàm select trong database 
    return $result;
  }
  // lay san pham có deal giam gia trong 7 days
  public function get_deal_7days(){
    $query ="SELECT *
    FROM tbl_product
    WHERE pricediscount < price LIMIT 9
    " ;
    $result =$this->db->select($query);//lấy hàm select trong database 
    return $result;
  }
  public function get_detail ($id){
    $query = "SELECT
    tbl_product.productId,
    tbl_product.productName,
    tbl_product.image,
    tbl_product.categoryId,
    tbl_product.brandId,
    tbl_product.price,
    tbl_product.pricediscount,
    tbl_product.productDes,
    tbl_product.productType,
    tbl_category.categoryName,
    tbl_brand.brandName,
    GROUP_CONCAT(DISTINCT size.sizeName) AS sizes,
    GROUP_CONCAT(DISTINCT color.colorName) AS colors
  FROM
    tbl_product
  INNER JOIN
    tbl_category ON tbl_product.categoryId = tbl_category.categoryId
  INNER JOIN
    tbl_brand ON tbl_product.brandId = tbl_brand.brandId
    LEFT JOIN
        size ON tbl_product.productId = size.productId
    LEFT JOIN
        color ON tbl_product.productId = color.productId
    WHERE
        tbl_product.productId = '$id'
    GROUP BY
        tbl_product.productId LIMIT 1";
    $result =$this->db->select($query);//lấy hàm select trong database 
    return $result;
  }
};




?>
<!-- number_format(number, decimals, decimal_separator, thousands_separator);
number: Số bạn muốn định dạng.
decimals: Số lượng chữ số sau dấu phẩy thập phân. (Tùy chọn, mặc định là 0)
decimal_separator: Dấu phẩy thập phân. (Tùy chọn, mặc định là ".")
thousands_separator: Dấu phân cách hàng nghìn. (Tùy chọn, mặc định là ",")
ex: $number = 1234567.89;
$formatted_number = number_format($number, 2, '.', ',');
echo $formatted_number; -->