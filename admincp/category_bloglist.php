<?php include('pages/header.php')?>
<?php include('../classes/CategoryBlog.php') ?>
<?php
$cate= new CategoryBlog();
if (isset($_GET['deleteid'])) { 
  $id =$_GET['deleteid']; 
  $deletecategory_blog = $cate->delete_category_blog($id);
 }

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Danh sách danh mục tin tức</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active"><a href="category_blogadd.php"> Thêm danh mục</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container">
        <?php 
      if(isset($deletecategory_blog)){
        echo $deletecategory_blog;
      }
      ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên danh mục tin tức</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php  
    $show_cate =$cate -> show_category_blog();
    if($show_cate){
        $i=0; 
        while($result= $show_cate->fetch_assoc()){
            $i++; // Thêm dấu chấm phẩy ở đây
            ?>
                <tr>
                    <th scope="row"><?php echo $result['category_blogId'] ?></th>
                    <td><?php echo $result['category_blogName'] ?></td>
                    <td><a class="btn btn-primary"
                            href="category_blogedit.php?category_blogId=<?php echo $result['category_blogId'] ;?>">Sửa</a>
                        | <a class=" btn btn-danger" href="?deleteid=<?php echo $result['category_blogId'] ;?>"
                            onclick="return confirm('Are you sure you want to delete this data?')">Xóa</a> </td>
                </tr>
                <?php } // Đóng thẻ PHP ở đây
    }
    ?>

            </tbody>
        </table>

    </div>
</div>
<?php include('pages/footer.php')?>