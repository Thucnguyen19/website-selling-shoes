<?php include('pages/header.php')?>
<?php include_once('../classes/contact.php') ?>
<?php
$contact= new Contact();
if (isset($_GET['deleteid'])) { 
  $id =$_GET['deleteid']; 
  $deletcontact = $contact->delete_contact($id);
 }

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Danh sách phản hồi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>

                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="container">
        <?php 
      if(isset($deletcontact)){
        echo $deletcontact;
      }
      ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên khách hàng</th>
                    <th scope="col">Email</th>
                    <th scope="col">Vấn đề</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col">Ngày</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php  
    $show_contact =$contact -> get_contact();
    if($show_contact){
        while($result= $show_contact->fetch_assoc()){

            ?>
                <tr>
                    <th scope="row"><?php echo $result['contactId'] ?></th>
                    <td><?php echo $result['name'] ?></td>
                    <td><?php echo $result['email'] ?></td>
                    <td><?php echo $result['subject'] ?></td>
                    <td><?php echo $result['message'] ?></td>
                    <td><?php echo $result['created_at'] ?></td>
                    <td><a class="btn btn-primary"
                            href="feetbackcontact.php?contactId=<?php echo $result['contactId'] ;?>">Phản hồi</a> | <a
                            class=" btn btn-danger" href="?deleteid=<?php echo $result['contactId'] ;?>"
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