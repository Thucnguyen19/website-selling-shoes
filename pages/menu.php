<!-- Start Header Area -->
<?php
 
   $get_all_product = $ct->get_all_product_cart();
   if($get_all_product){
	    $row =$get_all_product->fetch_assoc();	 
		$totalItems = $row['totalItems'];
	};

$cus = new Customer();
if (isset($_POST['logout'])) {
    $cus->logout_customer();
}

// $home = 
?>
<header class="header_area sticky-header">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light main_box">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="index.html"><img style="height:60px;" src="img/banner/logo-2.jpg"
                        alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <?php
$current_page = $_SERVER['REQUEST_URI'];
// var_dump($current_page);

// Function to check if the current page matches a given link
function isPageActive($link) {
    global $current_page;
    return ($current_page == $link) ? 'active' : '';
}

?>

                    <ul class="nav navbar-nav menu_nav ml-auto">
                        <li class="nav-item  <?php echo isPageActive('/web-sneaker/index.php') ?>">
                            <a class="nav-link" href="index.php">TRANG CHỦ</a>
                        </li>
                        <li class="nav-item submenu dropdown  <?php echo isPageActive('/web-sneaker/category.php') ?>">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false">BỘ SƯU TẬP</a>
                            <ul class="dropdown-menu" style="min-width:220px">
                                <?php
                                     $get_category = $cate->get_all_category();
                                     if($get_category) {
                                         while($result = $get_category->fetch_assoc()) {
                                             $categoryLink = 'category.php?categoryId=' . $result['categoryId'];
                            ?>
                                <li class="nav-item <?php echo isPageActive($categoryLink); ?>">
                                    <a class="nav-link"
                                        href="<?php echo $categoryLink; ?>"><?php echo $result['categoryName']; ?></a>
                                </li>
                                <?php
                }
            }
            ?>
                            </ul>
                        </li>
                        <li class="nav-item  <?php echo isPageActive('/web-sneaker/blog.php') ?>">
                            <a href="blog.php" class="nav-link dropdown-toggle">Tin Tức</a>
                        </li>
                        <li class="nav-item  <?php echo isPageActive('/web-sneaker/contact.php') ?>">
                            <a class="nav-link" href="contact.php" style="font-size:16px">LIÊN HỆ</a>
                        </li>
                        <li class="nav-item submenu dropdown">
                            <?php
                              if(isset($_SESSION['customer']) && $_SESSION['customer'] == true) {
                                  echo '<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' . $_SESSION['customerName'] . ' <i class="fa-regular fa-user" ></i></a>';
                              } else {
                                  echo '<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">TÀI KHOẢN</a>';
                              }
                              ?>
                            <ul class="dropdown-menu">
                                <?php
            if(isset($_SESSION['customer']) && $_SESSION['customer'] == true) {
                ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"
                                        onclick="document.getElementById('logoutForm').submit();">ĐĂNG XUẤT <i
                                            class="fa-solid fa-arrow-right-from-bracket"
                                            style="color: #ffc107;"></i></a>
                                    <form id="logoutForm" method="post" style="display: none;">
                                        <input type="hidden" name="logout" value="1">
                                    </form>
                                </li>
                                <?php
            } else {
                echo '<li class="nav-item ' . isPageActive('/web-sneaker/login.php') . '"><a class="nav-link" href="login.php">ĐĂNG NHẬP</a></li>';
                echo '<li class="nav-item ' . isPageActive('/web-sneaker/register.php') . '"><a class="nav-link" href="register.php">ĐĂNG KÝ</a></li>';
            }
            ?>
                            </ul>
                        </li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item">
                            <a href="cart.php" class="cart">
                                <span>
                                    <i class="fa-solid fa-lg fa-bag-shopping" style="color:#fd7e14;"></i>
                                    <?php
                                     if($totalItems > 0){
                                    ?>
                                    <span
                                        style="border: 0.1px solid #fd7e14;padding: 0 4px; border-radius: 50%;font-size: 12px;color:#fd7e14">
                                        <?php   echo $totalItems;  ?>
                                    </span>
                                    <?php
                                    }
                                    ?>
                                </span>
                            </a>

                        </li>

                        <li class="nav-item">
                            <button class="search"><span id="search"> <i class="fa-solid fa-lg fa-magnifying-glass"
                                        style="color: #fd7e14;"></i></span></button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="search_input" id="search_input_box">
        <div class="container">
            <?php
if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_POST['searchbtn'])){
    $keyword = $_POST['search_product'];
    $get_result_search = $cate->get_result_search($keyword);
}
?>

            <form class="d-flex justify-content-between" action="result_search.php" method="GET">
                <input type="text" class="form-control" name='search_product' id="search_input"
                    placeholder="Search Here">
                <button type="submit" name="searchbtn" class="btn"></button>
                <span id="close_search" title="Close Search"><i class="fa-solid fa-x"
                        style="color: #ffffff;"></i></span>
            </form>

        </div>
    </div>
</header>
<!-- End Header Area -->