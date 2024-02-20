<?php include('pages/header.php') ?>


<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>TRANG TIN TỨC</h1>
                <nav class="d-flex align-items-center">
                    <a href="index.php">TRANG CHỦ<span><i class="fa-solid fa-arrow-right"
                                style="color: #ffffff;"></i></span></a>
                    <a href="blog.php">TIN TỨC</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Blog Categorie Area =================-->
<section class="blog_categorie_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="categories_post">
                    <img src="img/blog/cat-post/cat-post-3.jpg" alt="post">
                    <div class="categories_details">
                        <div class="categories_text">
                            <a href="blog-details.html">
                                <h5>ĐỜI SỐNG</h5>
                            </a>
                            <div class="border_line"></div>
                            <p>Tận hưởng cuộc sống cùng nhau</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="categories_post">
                    <img src="img/blog/cat-post/cat-post-2.jpg" alt="post">
                    <div class="categories_details">
                        <div class="categories_text">
                            <a href="blog-details.html">
                                <h5>Thời trang</h5>
                            </a>
                            <div class="border_line"></div>
                            <p>Khám phá phong cách mới</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="categories_post">
                    <img src="img/blog/cat-post/cat-post-1.jpg" alt="post">
                    <div class="categories_details">
                        <div class="categories_text">
                            <a href="blog-details.html">
                                <h5>Xu hướng</h5>
                            </a>
                            <div class="border_line"></div>
                            <p>Cập nhật những xu hướng mới</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================Blog Categorie Area =================-->

<!--================Blog Area =================-->
<section class="blog_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog_left_sidebar">
                    <?php
                    $blog = new Blog();
                    $get_blog = $blog->get_all_blog();
                    if($get_blog){
                        while($result=$get_blog->fetch_assoc()){
                            ?>
                    <article class="row blog_item">
                        <div class="col-md-3">
                            <div class="blog_info text-right">
                                <div class="post_tag">
                                    <!-- <a href="#">Food,</a> -->

                                    <!-- <a href="#">Politics,</a>
                                    <a href="#">Lifestyle</a> -->
                                </div>
                                <ul class="blog_meta list">
                                    <li> <a class="" href="#"><?php echo $result['category_blogName'] ?> <i
                                                class="fa-solid fa-list" style="color: #777777;"></i></a></li>
                                    <li><a href="#">Mark wiens<i class="fa-regular fa-user"
                                                style="color: #777777;"></i></a></li>
                                    <li><a href="#">12 Dec, 2018<i class="fa-regular fa-calendar-days"
                                                style="color: #777777;"></i></a></li>
                                    <li><a href="#">1.2M Lượt xem<i class="fa-regular fa-eye"
                                                style="color: #777777;"></i></a></li>
                                    <li><a href="#">06 Bình luận<i class="fa-regular fa-comment"
                                                style="color: #777777;"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="blog_post">
                                <img src="admincp/uploads/<?php echo $result['image'] ?>"
                                    style="height:272px;width:100%; object-fit:cover"
                                    alt="<?php echo $result['blogName'];?>">
                                <div class="blog_details">
                                    <a href="detail-blog.php?blogId=<?php echo $result['blogId'] ?>">
                                        <h2><?php echo $result['blogName'];?></h2>
                                    </a>
                                    <p><?php echo $result['subtitle'];?></p>
                                    <a href="detail-blog.php?blogId=<?php echo $result['blogId'] ?>"
                                        class="white_bg_btn">Xem thêm</a>
                                </div>
                            </div>
                        </div>
                    </article>
                    <?php
                        }
                    }
                    ?>


                    <nav class="blog-pagination justify-content-center d-flex">
                        <ul class="pagination">
                            <li class="page-item">
                                <a href="#" class="page-link" aria-label="Previous">
                                    <span aria-hidden="true">
                                        <span><i class="fa-solid fa-chevron-left"></i></span>
                                    </span>
                                </a>
                            </li>
                            <li class="page-item"><a href="#" class="page-link">01</a></li>
                            <li class="page-item active"><a href="#" class="page-link">02</a></li>
                            <li class="page-item"><a href="#" class="page-link">03</a></li>
                            <li class="page-item"><a href="#" class="page-link">04</a></li>
                            <li class="page-item"><a href="#" class="page-link">09</a></li>
                            <li class="page-item">
                                <a href="#" class="page-link" aria-label="Next">
                                    <span aria-hidden="true">
                                        <span><i class="fa-solid fa-chevron-right"></i></span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <aside class="single_sidebar_widget search_widget">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Tìm kiếm bài viết"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Tìm kiếm bài viết'">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa-solid fa-magnifying-glass"
                                        style="color: #ffffff;"></i></button>
                            </span>
                        </div><!-- /input-group -->
                        <div class="br"></div>
                    </aside>
                    <!-- <aside class="single_sidebar_widget author_widget">
                        <img class="author_img rounded-circle" src="img/blog/author.png" alt="">
                        <h4>NT developer</h4>
                        <p>Senior blog writer</p>
                        <div class="social_icon">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-github"></i></a>
                            <a href="#"><i class="fa fa-behance"></i></a>
                        </div>
                        <p>Boot camps have its supporters andit sdetractors. Some people do not understand why you
                            should have to spend money on boot camp when you can get. Boot camps have itssuppor
                            ters andits detractors.</p>
                        <div class="br"></div>
                    </aside> -->
                    <aside class="single_sidebar_widget popular_post_widget">
                        <h3 class="widget_title">Bài viết mới nhất</h3>
                        <?php 
                        $get_latest=$blog->get_latest_blog();
                        if($get_latest){
                            while($result_latest=$get_latest->fetch_assoc()){
                                ?>
                        <div class="media post_item">
                            <img style="width: 100px;height:60px;object-fit:cover"
                                src="admincp/uploads/<?php echo $result_latest['image']?>" alt="post">
                            <div class="media-body">
                                <a href="detail-blog.php?blogId=<?php echo $result_latest['blogId']?>">
                                    <h3><?php echo $result_latest['blogName'] ?></h3>
                                </a>
                                <p><?php echo $result_latest['created_at'] ?></p>
                            </div>
                        </div>
                        <?php
                            }
                        }
                        ?>

                        <div class="br"></div>
                    </aside>
                    <aside class="single_sidebar_widget ads_widget">
                        <a href="#"><img class="img-fluid" src="img/blog/add.jpg" alt=""></a>
                        <div class="br"></div>
                    </aside>
                    <aside class="single_sidebar_widget post_category_widget">
                        <h4 class="widget_title">DANH MỤC BÀI VIẾT</h4>
                        <ul class="list cat-list">
                            <li>
                                <?php 
                                 $cate_blog = new CategoryBlog();
                                 $get_cate = $cate_blog->show_category_blog();
                                 if($get_cate){
                                    while($result=$get_cate->fetch_assoc()){
                                        ?>
                                <a href="#" class="d-flex justify-content-between">
                                    <p><?php echo $result['category_blogName'] ?></p>
                                </a>
                                <?php
                                    }
                                 }
                                  ?>

                            </li>

                        </ul>
                        <div class="br"></div>
                    </aside>

                    <aside class="single-sidebar-widget tag_cloud_widget">
                        <h4 class="widget_title">Thẻ tag</h4>
                        <ul class="list">
                            <li><a href="#">Technology</a></li>
                            <li><a href="#">Fashion</a></li>
                            <li><a href="#">Architecture</a></li>
                            <li><a href="#">Fashion</a></li>
                            <li><a href="#">Food</a></li>
                            <li><a href="#">Technology</a></li>
                            <li><a href="#">Lifestyle</a></li>
                            <li><a href="#">Art</a></li>
                            <li><a href="#">Adventure</a></li>
                            <li><a href="#">Food</a></li>
                            <li><a href="#">Lifestyle</a></li>
                            <li><a href="#">Adventure</a></li>
                        </ul>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================Blog Area =================-->

<?php include('pages/footer.php') ?>