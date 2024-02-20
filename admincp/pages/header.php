<?php
// Sử dụng đường dẫn tệp hệ thống
include_once("../lib/session.php");
// Khởi tạo phiên
Session::init ();
// Kiểm tra phiên
// Session::checkSession ();

include_once("../classes/contact.php");
include_once("../classes/order.php");
include_once("../classes/brand.php");
include_once("../classes/customer.php");
include_once('../classes/adminlogin.php'); 
include_once('../classes/user_onlines.php'); 
include_once('../classes/direct_chat.php'); 



?>
<?php
 $brand =new brand();
 $dataPoints= array();
    
    $get_all_brand =$brand ->get_all_brand();
    if($get_all_brand){
        while($result_brand=$get_all_brand->fetch_assoc()){         
            $dataPoints[]= array("label"=>  $result_brand['brandName'] , "y"=>  $result_brand['productCount']);
        }
    } 
    
    //  array("label"=> "Activities and Entertainments", "y"=> 261),
    //  array("label"=> "Health and Fitness", "y"=> 158),
    //  array("label"=> "Shopping & Misc", "y"=> 72),
    //  array("label"=> "Transportation", "y"=> 191),
    //  array("label"=> "Rent", "y"=> 573),
    //  array("label"=> "Travel Insurance", "y"=> 126)

     
 ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Trang quản lý admin</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
    <!-- Nhúng CKEditor từ CDN -->
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>


    <!-- Hoặc tải từ trang chính thức và nhúng -->
    <!-- <script src="/đường/dẫn/đến/ckeditor.js"></script> -->
    <script>
    window.onload = function() {

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            title: {
                text: "Số lượng sản phẩm của các thương hiệu",
                fontFamily: "Helvetica"
            },
            subtitles: [{
                text: ""
            }],
            data: [{
                type: "pie",
                showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 16,
                indexLabel: "{label} - #percent%",
                yValueFormatString: "#,##0 sản phẩm",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();

    }
    </script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">

                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <?php 
                           $contact = new Contact();
                           $get_contact =$contact->get_contact();
                        if($get_contact){
                          $result_count = $get_contact->num_rows;
                          ?>
                        <span class="badge badge-danger navbar-badge"><?php echo $result_count; ?></span>
                        <?php
                        }
                        ?>
                    </a>
                    <?php 
                  
                     if($get_contact){
                      while($result_detail=$get_contact->fetch_assoc()){
                        ?>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="dist/img/user1-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        <?php echo $result_detail['name'] ?>
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">
                                        <?php
                                        $message = $result_detail['message'];
                                        $limitedMessage = strlen($message) > 30 ? substr($message, 0, 30) . '...' : $message;
                                        echo $limitedMessage;
                                        ?></p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>
                                        <?php
                                        // Nếu bạn muốn sử dụng hàm time()
                                        $now = time();
                                        // Hoặc sử dụng strtotime("now")
                                        // $now = strtotime("now");
                                                              
                                        $created_at_timestamp = strtotime($result_detail['created_at']);
                                        $time_difference = $now - $created_at_timestamp;
                                                              
                                        // Lấy giá trị theo giờ
                                        $time_difference_in_hours = floor($time_difference / 3600);
                                                              
                                        echo $time_difference_in_hours ;
                                        ?>
                                        Giờ trước</p>
                                </div>
                            </div>
                            <!-- Message End -->

                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="contactlist.php" class="dropdown-item dropdown-footer">Xem tất cả</a>
                    </div>
                    <?php
                      }
                     }
                    ?>



                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <?php  
                            $order =new Order();                          
                            $get_all_order =$order->get_all_order();
                        if($get_all_order){
                          $result_count_order = $get_all_order->num_rows;
                          ?>
                        <span class="badge badge-warning navbar-badge"><?php  echo $result_count_order ;?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header"><?php  echo $result_count_order ;?> Đơn hàng</span>
                        <div class="dropdown-divider"></div>
                        <a href="orderlist.php" class="dropdown-item">

                            <i class="fas fa-envelope mr-2"></i> <?php  echo $result_count_order ;?> Đơn hàng mới
                            <span class="float-right text-muted text-sm">Chưa xem</span>
                            <?php }
                            ?>

                        </a>
                        <div class="dropdown-divider"></div>

                        <a href="#" class="dropdown-item dropdown-footer">Xem tất cả thông báo</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>


            <!-- Messages Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-comments"></i>
                    <span class="badge badge-danger navbar-badge">3</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Brad Diesel
                                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">Call me whenever you can...</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    John Pierce
                                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">I got your message bro</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <!-- Message Start -->
                        <div class="media">
                            <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Nora Silvester
                                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                                </h3>
                                <p class="text-sm">The subject goes here</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                        <!-- Message End -->
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
            </li>
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item dropdown">
                <a class="nav-link" data-toggle="dropdown" href="#">
                    <i class="far fa-bell"></i>
                    <span class="badge badge-warning navbar-badge">15</span>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> 4 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-users mr-2"></i> 8 friend requests
                        <span class="float-right text-muted text-sm">12 hours</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-file mr-2"></i> 3 new reports
                        <span class="float-right text-muted text-sm">2 days</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                    role="button">
                    <i class="fas fa-th-large"></i>
                </a>
            </li>
            </ul>
            </nav>
            <!-- /.navbar -->
            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="index3.html" class="brand-link">
                    <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                        style="opacity: .8">
                    <span class="brand-text font-weight-light">TRANG QUẢN LÝ</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">

                            <?php
                            if(isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
                                // Nếu đã đăng nhập, hiển thị tên đăng nhập
                                echo '<span class="text-primary text-lg text-bold">'.$_SESSION['adminName'].'</span>';
                            } 
                        ?>
                            <?php 
                            $admin = new adminlogin();
                            if (isset($_POST['logout'])) {
                            $admin->logout_admin();
                            }
									// Kiểm tra xem người dùng đã đăng nhập chưa
									if(isset($_SESSION['admin']) && $_SESSION['admin'] == true) {?>

                            <!-- Nếu đã đăng nhập, hiển thị tên đăng nhập -->
                            <a class="nav-link" href="#" onclick="document.getElementById('logoutForm').submit();"><i
                                    class="fa-solid fa-arrow-right-from-bracket" style="color: #1b22ee;"></i></a>
                            <form id="logoutForm" method="post" style="display: none;">
                                <input type="hidden" name="logout" value="1">
                            </form>


                            <?php } else {
									    // Nếu chưa đăng nhập, hiển thị như trước
									    echo '<li class="nav-item"><a class="nav-link" href="login.php">ĐĂNG NHẬP</a></li>';

									}
								?>
                        </div>

                    </div>
                    <?php include('pages/sidebar.php')?>
                </div>
                <!-- /.sidebar -->
            </aside>