<?php include('pages/header.php') ?>
<style>
prev img {
    width: 100% !important;
}
</style>

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1>TIN TỨC</h1>
                <nav class="d-flex align-items-center">
                    <a href="index.html">TRANG CHỦ<span><i class="fa-solid fa-arrow-right"
                                style="color: #ffffff;"></i></span></a>
                    <a href="category.html">TIN TỨC</a>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->
<!--================Blog Area =================-->
<section class="blog_area single-post-area section_gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 posts-list">
                <div class="single-post row">
                    <?php 

                    $blog = new Blog();
                    if(!isset($_GET['blogId']) || $_GET['blogId']== NULL){
                        header("Location: 404.php");
                        exit();
                     }else{
                        $id =$_GET['blogId'];
                     }
                    $get_blog_data = $blog -> get_blog($id);
                    $current_post = $get_blog_data['current_post'];
                    $previous_post = $get_blog_data['previous_post'];
                    $next_post = $get_blog_data['next_post'];
                    if($current_post){
                        while($result=$current_post->fetch_assoc()){
                     ?>
                    <div class="col-lg-12">
                        <div class="feature-img">
                            <img class="img-fluid" style="width:100%;height:340px;object-fit:cover"
                                src="admincp/uploads/<?php echo $result['image'] ?>" alt="">
                        </div>
                    </div>


                    <div class="col-lg-12">
                        <h2 style="font-family: 'Helvetica', sans-serif;"><?php echo $result['blogName'] ?></h2>
                        <prev>
                            <?php echo $result['blogDes']?>
                        </prev>
                        <span style="font-style:italic;"><?php echo $result['source'] ?></span>
                    </div>
                    <?php
                            }
                        }
                        ?>
                </div>
                <div class="navigation-area">
                    <div class="row">
                        <?php if($previous_post ){
                            $result_prev = $previous_post->fetch_assoc();
                                ?>
                        <div
                            class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                            <div class="thumb">
                                <a href="detail-blog.php?blogId=<?php echo $result_prev['blogId'] ?>"><img
                                        style="width:60px;height:60px ; object-fit:cover"
                                        src="admincp/uploads/<?php echo $result_prev['image'] ?>"
                                        alt="<?php echo $result_prev['blogName'] ?>"></a>
                            </div>
                            <div class="arrow">
                                <a href="detail-blog.php?blogId=<?php echo $result_prev['blogId'] ?>"><span><i
                                            class="fa-solid fa-arrow-left" style="color: #ffffff;"></i></span></a>
                            </div>
                            <div class="detials">
                                <p>Prev Post</p>
                                <a href="detail-blog.php?blogId=<?php echo $result_prev['blogId'] ?>">
                                    <h4><?php echo $result_prev['blogName'] ?></h4>
                                </a>
                            </div>
                        </div>

                        <?php
                            
                        } ?>
                        <?php if($next_post){
                            $result_next = $next_post->fetch_assoc();
                                ?>
                        <div
                            class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                            <div class="detials">
                                <p>Next Post</p>
                                <a href="detail-blog.php?blogId=<?php echo $result_next['blogId'] ?>">
                                    <h4><?php echo $result_next['blogName'] ?></h4>
                                </a>
                            </div>
                            <div class="arrow">
                                <a href="detail-blog.php?blogId=<?php echo $result_next['blogId'] ?>"><span><i
                                            class="fa-solid fa-arrow-right" style="color: #ffffff;"></i></span></a>
                            </div>
                            <div class="thumb">
                                <a href="detail-blog.php?blogId=<?php echo $result_next['blogId'] ?>"><img
                                        style="width:60px;height:60px ; object-fit:cover"
                                        src="admincp/uploads/<?php echo $result_next['image'] ?>"
                                        alt="<?php echo $result_next['blogName']?>"></a>
                            </div>
                        </div>
                        <?php }?>
                    </div>
                </div>
                <div class="comments-area">
                    <h4>Bình luận</h4>
                    <div class="comment-list">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="img/blog/c1.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <h5><a href="#">Emilly Blunt</a></h5>
                                    <p class="date">December 4, 2018 at 3:12 pm </p>
                                    <p class="comment">
                                        Never say goodbye till the end comes!
                                    </p>
                                </div>
                            </div>
                            <div class="reply-btn">
                                <a href="" class="btn-reply text-uppercase">reply</a>
                            </div>
                        </div>
                    </div>
                    <div class="comment-list left-padding">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="img/blog/c2.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <h5><a href="#">Elsie Cunningham</a></h5>
                                    <p class="date">December 4, 2018 at 3:12 pm </p>
                                    <p class="comment">
                                        Never say goodbye till the end comes!
                                    </p>
                                </div>
                            </div>
                            <div class="reply-btn">
                                <a href="" class="btn-reply text-uppercase">reply</a>
                            </div>
                        </div>
                    </div>
                    <div class="comment-list left-padding">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="img/blog/c3.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <h5><a href="#">Annie Stephens</a></h5>
                                    <p class="date">December 4, 2018 at 3:12 pm </p>
                                    <p class="comment">
                                        Never say goodbye till the end comes!
                                    </p>
                                </div>
                            </div>
                            <div class="reply-btn">
                                <a href="" class="btn-reply text-uppercase">reply</a>
                            </div>
                        </div>
                    </div>
                    <div class="comment-list">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="img/blog/c4.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <h5><a href="#">Maria Luna</a></h5>
                                    <p class="date">December 4, 2018 at 3:12 pm </p>
                                    <p class="comment">
                                        Never say goodbye till the end comes!
                                    </p>
                                </div>
                            </div>
                            <div class="reply-btn">
                                <a href="" class="btn-reply text-uppercase">reply</a>
                            </div>
                        </div>
                    </div>
                    <div class="comment-list">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="img/blog/c5.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <h5><a href="#">Ina Hayes</a></h5>
                                    <p class="date">December 4, 2018 at 3:12 pm </p>
                                    <p class="comment">
                                        Never say goodbye till the end comes!
                                    </p>
                                </div>
                            </div>
                            <div class="reply-btn">
                                <a href="" class="btn-reply text-uppercase">reply</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="comment-form">
                    <h4>Để lại 1 bình luận</h4>
                    <form>
                        <div class="form-group form-inline">
                            <div class="form-group col-lg-6 col-md-6 name">
                                <input type="text" class="form-control" id="name" placeholder="Nhập họ tên"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nhập họ tên'">
                            </div>
                            <div class="form-group col-lg-6 col-md-6 email">
                                <input type="email" class="form-control" id="email" placeholder="Nhập địa chỉ email"
                                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nhập địa chỉ email'">
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control mb-10" rows="5" name="message" placeholder="Nội dung"
                                onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nội dung'"
                                required=""></textarea>
                        </div>
                        <a href="#" class="primary-btn submit_btn">Đăng bình luận</a>
                    </form>
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