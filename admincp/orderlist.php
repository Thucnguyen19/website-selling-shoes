<?php include('pages/header.php')?>
<?php include_once('../classes/order.php') ?>
<?php
$order= new order();
if (isset($_GET['deleteid'])) { 
  $id =$_GET['deleteid']; 
  $deletorder = $order->delete_order($id);
 }

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Danh sách đơn hàng</h1>
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
      if(isset($deletorder)){
        echo $deletorder;
      }
      ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên khách hàng</th>
                    <th scope="col">Số ĐT</th>
                    <th scope="col">Địa chỉ nhà</th>
                    <th scope="col">Sản phẩm</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Tổng tiền</th>
                    <th scope="col">Ngày</th>
                    <th scope="col">Phương thức TT</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php  
    $show_order =$order -> get_order_admin();
    if($show_order){
        while($result= $show_order->fetch_assoc()){

            ?>
                <tr>
                    <th scope="row"><?php echo $result['orderId'] ?></th>
                    <td><?php echo $result['customerName'] ?></td>
                    <td><?php echo $result['phone_number'] ?></td>
                    <td><?php echo $result['address_home'] ?></td>
                    <td><?php echo $result['productName'] ?></td>
                    <td><?php echo $result['quantity'] ?></td>
                    <td><?php echo $result['total'] ?></td>
                    <td><?php echo $result['method'] ?></td>
                    <td><?php echo $result['created_at'] ?></td>
                    <td><a class="btn btn-primary"
                            href="orderedit.php?orderId=<?php echo $result['orderId'] ;?>">Sửa</a> | <a
                            class=" btn btn-danger" href="?deleteid=<?php echo $result['orderId'] ;?>"
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