<?php 
include('pages/header.php');
include('../classes/CategoryBlog.php'); 
// include('../classes/brand.php'); 
include('../classes/blog.php'); 
?>


<?php
$blog= new Blog();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // The request is using the POST method
	$insertblog = $blog->insertblog($_POST,$_FILES);
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
        <form action="blogadd.php" method="POST" enctype="multipart/form-data">
            <?php 
        if(isset($insertblog)){
            echo $insertblog;
        } 
        ?>
            <div class="form-group">
                <label for="blog">Tên tin tức</label>
                <input type="text" name="blogName" class="form-control" id="blog" aria-describedby="emailHelp"
                    placeholder="Điền vào tên sản phẩm">
                <!-- <small id="emailHelp" class="form-text text-muted">Danh mục không được bỏ trống.</small> -->
            </div>
            <div class="form-group">
                <label>Phụ đề</label>
                <input type="text" name="subtitle" class="form-control" aria-describedby="emailHelp"
                    placeholder="Điền phụ đề">
                <!-- <small id="emailHelp" class="form-text text-muted">Danh mục không được bỏ trống.</small> -->
            </div>
            <div class="form-goup">
                <label for="">Chọn danh mục tin tức</label>
                <select class="form-select" aria-label="Default select example" name="category_blog">
                    <option selected>Danh mục tin tức</option>
                    <?php  
                     $cate = new CategoryBlog();
                     $show_cate =$cate -> show_category_blog();
                     if($show_cate){
                    while($result= $show_cate->fetch_assoc()){
                    ?>
                    <option value="<?php echo $result['category_blogId']?>"><?php echo $result['category_blogName']; ?>
                    </option>
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
            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="blogDes" id="editor" cols="30" rows="10" class="form-control"></textarea>
                <!-- <small id="emailHelp" class="form-text text-muted">Danh mục không được bỏ trống.</small> -->
            </div>
            <div class="form-goup">
                <label for="">Chọn loại</label>
                <select class="form-select" aria-label="Default select example" name="blogType">
                    <option selected>loại tin tức</option>
                    <option value="1">Nổi bật</option>
                    <option value="2">không nổi bật</option>
                    <!-- featured:nổi bật , non-featured: ko nổi bật  -->
                </select>
            </div>
            <div class="form-group">
                <label for="blog">Nguồn</label>
                <input type="text" name="source" class="form-control" aria-describedby="emailHelp"
                    placeholder="Điền tên nguồn">
                <!-- <small id="emailHelp" class="form-text text-muted">Danh mục không được bỏ trống.</small> -->
            </div>
            <!-- Bên trong phần tử <form> trong blogadd.php -->

            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<script>
CKEDITOR.replace('editor');
</script>



<?php include('pages/footer.php')?>