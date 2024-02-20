<?php include('pages/header.php') ?>

<?php
	 if(!isset($_GET['categoryId']) || $_GET['categoryId']== NULL){
		header("Location: 404.php");
		exit();
	 }else{
		$id =$_GET['categoryId'];
	 }
?>

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <?php 
					$cate_title = $cate ->get_category($id);
					if($cate_title){
						$result_title =$cate_title->fetch_assoc();
					}
					?>
                <h1><?php echo $result_title['categoryName'] ?></h1>
                <nav class="d-flex align-items-center">
                    <a href="index.php">TRANG CHỦ<span class=""><i class="fa-solid fa-arrow-right"
                                style="color: #ffffff;"></i></span></a>
                    <a href="category.html"><?php echo $result_title['categoryName'] ?></a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->
<div class="container">
    <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-5">
            <div class="sidebar-categories">

                <div class="head">DANH MỤC SẢN PHẨM
                    <div>
                        <ul class="main-categories">
                            <?php 
						 $show_category =$cate->show_category();
						 if($show_category){
							while($result_show_category=$show_category->fetch_assoc()){
								?>
                            <li class="main-nav-list">
                                <a href="category.php?categoryId=<?php echo $result_show_category['categoryId'];?>">
                                    <span
                                        class="lnr lnr-arrow-right"></span><?php echo $result_show_category['categoryName'] ?><span
                                        class="number">(<?php echo $result_show_category['productCount'];?>)</span>
                                </a>
                            </li>
                            <?php
							}
						 }
						?>
                        </ul>
                    </div>
                    <div class="sidebar-filter mt-50">
                        <div class="top-filter-head">LỌC SẢN PHẨM</div>
                        <div class="common-filter">
                            <div class="head">THƯƠNG HIỆU</div>

                            <ul class="main-categories">
                                <?php 
							$get_all_brand =$brand ->get_all_brand();
							if($get_all_brand){
								while($result_brand=$get_all_brand->fetch_assoc()){
									?>
                                <li class="main-nav-list">
                                    <a href="brand.php?brandId=<?php echo $result_brand['brandId'];?>">
                                        <span
                                            class="lnr lnr-arrow-right"></span><?php echo $result_brand['brandName'] ?><span
                                            class="number">(<?php echo $result_brand['productCount'];?>)</span>
                                    </a>
                                    <?php
								}
							} 
							?>
                            </ul>
                        </div>
                        <!-- <div class="common-filter">
                            <div class="head">MÀU SẮC</div>
                            <form action="#">
                                <ul>
                                    <li class="filter-list"><input class="pixel-radio" type="radio" id="black"
                                            name="color"><label for="black">Black<span>(29)</span></label></li>
                                    <li class="filter-list"><input class="pixel-radio" type="radio" id="balckleather"
                                            name="color"><label for="balckleather">Black
                                            Leather<span>(29)</span></label></li>
                                    <li class="filter-list"><input class="pixel-radio" type="radio" id="blackred"
                                            name="color"><label for="blackred">Black
                                            with red<span>(19)</span></label></li>
                                    <li class="filter-list"><input class="pixel-radio" type="radio" id="gold"
                                            name="color"><label for="gold">Gold<span>(19)</span></label></li>
                                    <li class="filter-list"><input class="pixel-radio" type="radio" id="spacegrey"
                                            name="color"><label for="spacegrey">Spacegrey<span>(19)</span></label></li>
                                </ul>
                            </form>
                        </div> -->
                        <!-- <div class="common-filter">
                            <div class="head">GIÁ</div>
                            <div class="price-range-area">
                                <div id="price-range"></div>
                                <div class="value-wrapper d-flex">
                                    <div class="price">Giá:</div>
                                    <span>đ</span>
                                    <div id="lower-value"></div>
                                    <div class="to">to</div>
                                    <span>đ</span>
                                    <div id="upper-value"></div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8 col-md-7">
            <!-- Start Filter Bar -->
            <div class="filter-bar d-flex flex-wrap align-items-center">
                <div class="sorting">
                    <select id="sorting">
                        <option value="1">MẶC ĐỊNH</option>
                        <option value="2">GIÁ TỪ CAO ĐẾN THẤP</option>
                        <option value="3">GIÁ TỪ THẤP ĐẾN CAO </option>
                    </select>
                </div>
                <div class="sorting mr-auto">
                    <select id="products-per-page">
                        <option value="1">12</option>
                        <option value="2">24</option>
                        <option value="3">ALL</option>
                    </select>
                </div>

                <!-- <div class="pagination">
                    <a href="#" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
                    <a href="#" class="active">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                    <a href="#">6</a>
                    <a href="#" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                </div> -->
            </div>
            <!-- End Filter Bar -->
            <!-- Start Best Seller -->
            <section class="lattest-product-area pb-40 category-list">
                <div class="row">
                    <?php 
                        
                             $get_category_detail =$cate->get_category_detail($id);
                             if($get_category_detail){
                                while($result=$get_category_detail->fetch_assoc()){
                        ?>
                    <!-- single product -->
                    <div class="col-lg-4 col-md-6">
                        <div class="single-product">
                            <img class="img-fluid" style="height:270px;object-fit:contain"
                                src="admincp/uploads/<?php echo $result['image'] ?>"
                                alt="<?php echo $result['productName'] ?>">
                            <div class="product-details">
                                <h6><?php $result['productName'] ?></h6>
                                <div class="price">
                                    <h6>₫<?php echo number_format($result['pricediscount'], 0, ',', '.'); ?></h6>
                                    <h6 class="l-through">₫<?php echo number_format($result['price'], 0, ',', '.'); ?>
                                    </h6>
                                </div>
                                <div class="prd-bottom">

                                    <a href="detail-product.php?productId=<?php echo $result['productId']?>"
                                        class="social-info">
                                        <span class="">
                                            <i class="fa-solid fa-bag-shopping" style="color: #ffffff;"></i>
                                        </span>
                                        <p class="hover-text">Thêm vào giỏ</p>
                                    </a>
                                    <a href="" class="social-info">
                                        <span class="">
                                            <i class="fa-regular fa-heart" style="color: #ffffff;"></i>
                                        </span>
                                        <p class="hover-text">Yêu thích</p>
                                    </a>
                                    <a href="" class="social-info">
                                        <span class=""><i class="fa-solid fa-repeat fa-rotate-by"
                                                style="color: #ffffff; --fa-rotate-angle: 45deg;""></i></span>
                                            <p class=" hover-text">So sánh</p>
                                    </a>
                                    <a href="detail-product.php?productId=<?php echo $result['productId']?>"
                                        class="social-info">
                                        <span class=""><i class="fa-solid fa-up-down-left-right"
                                                style="color: #ffffff;"></i></span>
                                        <p class="hover-text">xem thêm</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                            }
                         }
                        ?>

                </div>
            </section>
            <!-- End Best Seller -->
            <!-- Start Filter Bar -->
            <div class="filter-bar d-flex flex-wrap align-items-center">
                <div class="sorting mr-auto">
                    <select>
                        <option value="1">Show 12</option>
                        <option value="1">Show 24</option>
                        <option value="1">Show 48</option>
                    </select>
                </div>
                <div class="pagination">
                    <?php $productsPerPage = 12; // Số lượng sản phẩm mỗi trang
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1; // Trang hiện tại
$categoryDetail = $cate->get_category_detail($id);
$totalProducts = $categoryDetail->num_rows; // Đếm số hàng trả về từ kết quả
$totalPages = ceil($totalProducts / $productsPerPage);

$offset = ($currentPage - 1) * $productsPerPage; // Số sản phẩm bắt đầu từ
$get_category_detail = $cate->get_category_detail_with_limit($id, $productsPerPage, $offset);


 ?>
                    <?php
    for ($i = 1; $i <= $totalPages; $i++) {
        $activeClass = ($currentPage == $i) ? 'active' : '';
        echo "<a href='category.php?categoryId=$id&page=$i' class='$activeClass'>$i</a>";
    }
    ?>

                </div>
            </div>
            <!-- End Filter Bar -->
        </div>

    </div>

</div>




<!-- Start related-product Area -->
<section class="related-product-area section_gap_bottom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h1>Ưu đãi trong tuần</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore
                        magna aliqua.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9">
                <div class="row">
                    <?php 
					$get_deal_7days = $product-> get_deal_7days();
					// var_dump($get_deal_7days);// kiem tra bien 
					if($get_deal_7days){
						while($result_deal= $get_deal_7days->fetch_assoc()){
							?>
                    <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                        <div class="single-related-product d-flex">
                            <a href="#"><img style="height:70px; width:70px; object-fit:contain"
                                    src="admincp/uploads/<?php echo $result_deal['image'];?>" alt=""></a>
                            <div class="desc">
                                <a href="detail-product.php?productId=<?php echo $result_deal['productId']?>"
                                    class="title"><?php echo $result_deal['productName'] ?></a>
                                <div class="price">
                                    <h6>₫<?php echo number_format($result_deal['pricediscount'], 0, '.', ','); ?></h6>
                                    <h6 class="l-through">
                                        ₫<?php echo number_format($result_deal['price'], 0, '.', ','); ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
						}}
						?>

                </div>
            </div>
            <div class="col-lg-3">
                <div class="ctg-right">
                    <a href="#" target="_blank">
                        <img class="img-fluid d-block mx-auto" src="img/category/c5.jpg" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End related-product Area -->



<?php include('pages/footer.php') ?>