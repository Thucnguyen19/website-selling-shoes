<?php include('pages/header.php')?>
<?php include_once('../classes/blog.php') ?>
<?php include('../classes/CategoryBlog.php') ?>
<?php include_once('../helpers/format.php') ?>


<?php
$fm = new Format();
$blog = new Blog();
$deleteblog = ""; // Khai báo trước để tránh lỗi khi sử dụng biến

if (isset($_GET['deleteid'])) { 
  $id = $_GET['deleteid']; 
  $deleteblog = $blog->delete_blog($id);
}

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Danh sách tin tức</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active"><a href="blogadd.php"> Thêm tin tức</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container">
        <?php 
      if(isset($deleteblog)){
        echo $deleteblog;
      }
      ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên tin tức</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">danh mục</th>
                    <th scope="col">phụ đề</th>
                    <th scope="col">mô tả</th>
                    <th scope="col">nguồn</th>
                    <th scope="col">Loại</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
                <?php  
          $show_blog = $blog->show_blog();
            if($show_blog){
            // $i = 0; 
           while($result = $show_blog->fetch_assoc()){
            // $i++;
            ?>
                <tr>
                    <th scope="row"><?php echo $result['blogId'] ?></th>
                    <td><?php echo $result['blogName'] ?></td>
                    <td><img src="uploads/<?php echo $result['image'] ?>"
                            style="width:40px; height:40px; object-fit:cover" alt="<?php echo $result['blogName'] ?>">
                    </td>
                    <td><?php echo $result['category_blogName'] ?></td>
                    <td><?php echo $fm->textShorten( $result['subtitle'],30)?></td>
                    <td><?php echo $fm->textShorten( $result['blogDes'],30)?></td>
                    <td><?php echo $result['source'] ?></td>
                    <td><?php echo $result['blogType'] ?></td>
                    <td><a class="btn btn-primary" href="blogedit.php?blogId=<?php echo $result['blogId'] ;?>">Sửa</a> |
                        <a class="btn btn-danger" href="?deleteid=<?php echo $result['blogId'] ;?>"
                            onclick="return confirm('Are you sure you want to delete this data?')">Xóa</a>
                    </td>
                </tr>
                <?php
        }
    }
    ?>
            </tbody>
        </table>
    </div>
</div>
<?php include('pages/footer.php')?>