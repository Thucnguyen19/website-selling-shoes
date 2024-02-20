<?php 
include('pages/header.php');
include('../classes/CategoryBlog.php'); 
// include('../classes/brand.php'); 
include('../classes/blog.php'); 
?>


<?php
$blog= new Blog();
if (!isset($_GET['blogId']) || $_GET['blogId'] == NULL) {
    // The request is using the POST method
    echo "<script>window.location='bloglist.php'</script>";
}else{
 $id =$_GET['blogId']; 
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit']) ) {

 $updateblog = $blog->update_blog($_POST, $_FILES, $id);

}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Thêm Tin tức</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active"><a href="bloglist.php">Danh sách tin tức</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container">
        <?php 
     $get_all_blog = $blog ->get_blog($id); // Sửa lại tên hàm
    //  var_dump($get_all_blog->fetch_assoc());// In ra dữ liệu trả về từ câu truy vấn để xem liệu nó chứa tất cả các cột dữ liệu hay không.
     if ($get_all_blog && $result = $get_all_blog->fetch_assoc()) {
            // ... Code hiển thị form
            ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <?php if(isset($updateblog)){
                echo $updateblog;
            } ?>
            <div class="form-group">
                <label for="blog">Tên tin tức</label>
                <input type="text" name="blogName"
                    value="<?php echo isset($result['blogName']) ? $result['blogName'] : ''; ?>" class="form-control"
                    id="blog" aria-describedby="emailHelp" placeholder="Điền vào tên sản phẩm">
                <!-- <small id="emailHelp" class="form-text text-muted">Danh mục không được bỏ trống.</small> -->
            </div>
            <div class="form-group">
                <label>Phụ đề</label>
                <input type="text" name="subtitle"
                    value="<?php echo isset($result['subtitle']) ? $result['subtitle'] : ''; ?>" class="form-control"
                    aria-describedby="emailHelp" placeholder="Điền phụ đề">
                <!-- <small id="emailHelp" class="form-text text-muted">Danh mục không được bỏ trống.</small> -->
            </div>
            <div class="form-goup">
                <label for="">Chọn danh mục tin tức</label>
                <select class="form-select" aria-label="Default select example" name="category_blog">
                    <option selected>Danh mục tin tức</option>
                    <?php 
         $cate = new CategoryBlog();
         $catelist =$cate->show_category_blog();
         if($catelist){
            while($result_cate = $catelist->fetch_assoc()){
                ?>
                    <option
                        <?php if($result_cate['category_blogId'] == $result['category_blogId']) {echo 'selected' ;} ?>
                        value="<?php echo $result_cate['category_blogId'] ?>">
                        <?php echo $result_cate['category_blogName'] ?> </option>
                    <?php
            }
         }
         ?>
                </select>
            </div>
            <div class="form-group">
                <label for="formFile" class="form-label"> Chọn ảnh</label>
                <input class="form-control" type="file" id="formFile" name="image">
            </div>
            <div class="">
                <img src="uploads/<?php echo isset($result['image']) ? $result['image'] : ''; ?>"
                    style="width:40px; height:40px; object-fit:cover" alt="<?php $result['blogName'] ?>">
            </div>
            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="blogDes" id="editor" cols="30" rows="10"
                    class="form-control"><?php echo isset($result['blogDes']) ? $result['blogDes'] : ''; ?></textarea>
                <!-- <small id="emailHelp" class="form-text text-muted">Danh mục không được bỏ trống.</small> -->
            </div>
            <div class="form-goup">
                <label for="">Chọn loại</label>
                <select class="form-select" aria-label="Default select example" name="blogType">
                    <option selected>loại tin tức</option>
                    <?php if($result['blogType'] == 1){ ?>
                    <option value="1" selected>Nổi bật</option>
                    <option value="2">không nổi bật</option>
                    <?php
         }else{?>
                    <option value="1" selected>Nổi bật</option>
                    <option value="2">không nổi bật</option>
                    <?php } 
         ?>
                    <!-- featured:nổi bật , non-featured: ko nổi bật  -->
                </select>
            </div>
            <div class="form-group">
                <label for="blog">Nguồn</label>
                <input type="text" name="source"
                    value="<?php echo isset($result['source']) ? $result['source'] : ''; ?>" class="form-control"
                    aria-describedby="emailHelp" placeholder="Điền tên nguồn">
                <!-- <small id="emailHelp" class="form-text text-muted">Danh mục không được bỏ trống.</small> -->
            </div>
            <!-- Bên trong phần tử <form> trong blogadd.php -->

            <button type="submit" name="submit" class="btn btn-primary">Cập nhật</button>
        </form>
        <?php
        }
     else {
        // Xử lý khi không tìm thấy sản phẩm
        echo "Không tìm thấy sản phẩm.";
    }
    
    ?>
    </div>
</div>
<script>
CKEDITOR.replace('editor');
</script>


<?php include('pages/footer.php')?>