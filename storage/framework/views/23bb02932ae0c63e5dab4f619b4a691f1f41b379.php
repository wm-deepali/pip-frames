

<?php $__env->startSection('title'); ?>
    <?php echo e($blog->meta_title ?? $blog->title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('meta_tags'); ?>
    <meta name="title" content="<?php echo e($blog->meta_title); ?>">
    <meta name="description" content="<?php echo e($blog->meta_description); ?>">
    <meta name="keywords" content="<?php echo e($blog->meta_keyword); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <!--Start breadcrumb area-->
    <section class="breadcrumb-area"
        style="background-image: url(<?php echo e(asset('site_assets')); ?>//images/breadcrumb/breadcrumb-1.png);">
        <div class="banner-curve-gray"></div>
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="inner-content clearfix text-center">
                        <div class="title wow slideInUp animated" data-wow-delay="0.3s" data-wow-duration="1500ms">
                            <h2>News Details<span class="dotted"></span></h2>
                        </div>
                        <div class="breadcrumb-menu wow slideInDown animated" data-wow-delay="0.3s"
                            data-wow-duration="1500ms">
                            <ul class="clearfix">
                                <li><a href="index-2.html">Home</a></li>
                                <li class="active">News Details</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End breadcrumb area-->


    <!--Start Blog Style2 Area-->
    <section id="blog-area" class="blog-single-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="blog-posts">
                        <div class="single-blog-style2">
                            <div class="img-holder">
                                <div class="inner">
                                    <img src="<?php echo e($blog->banner_url ?? asset('site_assets/images/default-blog.jpg')); ?>"
                                        alt="<?php echo e($blog->title); ?>">
                                </div>
                            </div>
                            <div class="text-holder">
                                <!--Start Blog Details Single-->
                                <div class="blog-details-single">
                                    <h2 class="blog-title"><?php echo e($blog->title); ?></h2>
                                    <ul class="meta-info">
                                        <li><span class="icon-user"></span><a href="#">by
                                                <?php echo e($blog->author->name ?? 'Admin'); ?></a></li>
                                        <li><span class="icon-calendar"></span><a
                                                href="#"><?php echo e($blog->created_at->format('d M Y')); ?></a></li>
                                    </ul>
                                    <div class="text">
                                        <?php echo $blog->detail; ?>

                                    </div>

                                    <div class="tag-social-share-box">
                                        <div class="single-box">
                                            <div class="title">
                                                <h3>Releted Tags</h3>
                                            </div>
                                            <ul class="tag-list">
                                                <li><a href="#">Popular</a></li>
                                                <li><a href="#">Desgin</a></li>
                                                <li><a href="#">UI/UX</a></li>
                                            </ul>
                                        </div>
                                        <div class="single-box">
                                            <div class="title right">
                                                <h3>Social Share</h3>
                                            </div>
                                            <ul class="social-share">
                                                <?php
                                                    $shareUrl = urlencode(url()->current());
                                                    $shareText = urlencode($blog->title);
                                                ?>
                                                <li>
                                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e($shareUrl); ?>"
                                                        target="_blank">
                                                        <i class="fa fa-facebook" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://twitter.com/intent/tweet?url=<?php echo e($shareUrl); ?>&text=<?php echo e($shareText); ?>"
                                                        target="_blank" class="list-inline-item"><i class="fa fa-twitter"
                                                            aria-hidden="true"></i></a>
                                                </li>
                                                <li>
                                                    <a href="https://www.linkedin.com/shareArticle?url=<?php echo e($shareUrl); ?>&title=<?php echo e($shareText); ?>"
                                                        target="_blank" class="list-inline-item"><i class="fa fa-linkedin"
                                                            aria-hidden="true"></i></a>
                                                </li>
                                                <li>
                                                    
                                                    <a href="https://www.behance.net/?share=<?php echo e($shareUrl); ?>" target="_blank"
                                                        rel="noopener noreferrer" title="Share on Behance">
                                                        <i class="fa fa-behance"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://pinterest.com/pin/create/button/?url=<?php echo e($shareUrl); ?>&description=<?php echo e($shareText); ?>"
                                                        target="_blank" rel="noopener noreferrer"
                                                        title="Share on Pinterest">
                                                        <i class="fa fa-pinterest"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!--End Blog Details Single-->
                                <!-- 
                                                        <div class="blog-prev-next-option">
                                                            <div class="single-box left">
                                                                <p><a href="#">Prev Post</a></p>
                                                                <h2><a href="#">Tips On Minimalist</a></h2>
                                                            </div>
                                                            <div class="middle-box">
                                                                <div class="icon">
                                                                    <a href="#"><span class="icon-menu"></span></a>
                                                                </div>
                                                            </div>
                                                            <div class="single-box right">
                                                                <p><a href="#">Next Post</a></p>
                                                                <h2><a href="#">Less Is More</a></h2>
                                                            </div>
                                                        </div> -->

                            </div>
                        </div>


                        <!-- <div class="blog-details-bottom-content"> -->
                        <!-- <div class="related-blog-post">
                                                <div class="inner-title">
                                                    <h3>Releted Post</h3>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <div class="single-blog-style1">
                                                            <div class="img-holder">
                                                                <div class="inner">
                                                                    <img src="<?php echo e(asset('site_assets')); ?>//images/blog/related-blog-1.jpg"
                                                                        alt="Awesome Image">
                                                                </div>
                                                            </div>
                                                            <div class="text-holder">
                                                                <ul class="meta-info">
                                                                    <li><span class="icon-calendar"></span><a href="#">24th March 2019</a>
                                                                    </li>
                                                                </ul>
                                                                <h3 class="blog-title">
                                                                    <a href="blog-single.html">A series of iOS 7 inspire vector icons
                                                                        sense<span class="round-box zoominout"></span></a>
                                                                </h3>
                                                                <div class="text">
                                                                    <p>Lorem ipsum dolor sit amet, conse ctet ur adipisicing elit, sed
                                                                        doing.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <div class="single-blog-style1">
                                                            <div class="img-holder">
                                                                <div class="inner">
                                                                    <img src="<?php echo e(asset('site_assets')); ?>//images/blog/related-blog-2.jpg"
                                                                        alt="Awesome Image">
                                                                </div>
                                                            </div>
                                                            <div class="text-holder">
                                                                <ul class="meta-info">
                                                                    <li><span class="icon-calendar"></span><a href="#">24th March 2019</a>
                                                                    </li>
                                                                </ul>
                                                                <h3 class="blog-title">
                                                                    <a href="blog-single.html">A series of iOS 7 inspire vector icons
                                                                        sense<span class="round-box zoominout"></span></a>
                                                                </h3>
                                                                <div class="text">
                                                                    <p>Lorem ipsum dolor sit amet, conse ctet ur adipisicing elit, sed
                                                                        doing.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->

                        <!-- <div class="author-box-holder">
                                                <div class="inner">
                                                    <div class="img-box">
                                                        <img src="<?php echo e(asset('site_assets')); ?>//images/blog/author.jpg" alt="">
                                                    </div>
                                                    <div class="text-box">
                                                        <span>Written by</span>
                                                        <h2>Rosalina D. William</h2>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                                            nostrud exercitation ullamco laboris nisi ut aliquip ex ea.</p>
                                                    </div>
                                                </div>
                                            </div> -->


                        <!-- </div> -->

                    </div>
                </div>

                <!--Start sidebar Wrapper-->
                <div class="col-xl-4 col-lg-5 col-md-9 col-sm-12">
                    <div class="sidebar-wrapper">

                        <!-- <div class="single-sidebar wow fadeInUp animated" data-wow-delay="0.0s" data-wow-duration="1200ms">
                                                    <div class="sidebar-about-me-box text-center">
                                                        <div class="title">
                                                            <h3>About Me</h3>
                                                        </div>
                                                        <div class="image-box">
                                                            <img src="<?php echo e(asset('site_assets')); ?>//images/blog/sidebar-me-box-1.png"
                                                                alt="Awesome Image" />
                                                        </div>
                                                        <div class="text-holder">
                                                            <h3>Rosalina D. Willaimson</h3>
                                                            <p>Lorem ipsum dolor sit amet, consectet ur adipisicing elit, sed do eiusmod tempor
                                                                incididunt ut labore.</p>
                                                            <div class="sidebar-social-link">
                                                                <ul>
                                                                    <li>
                                                                        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> -->

                        <!--Start single sidebar-->
                        <div class="single-sidebar wow fadeInUp animated" data-wow-delay="0.1s" data-wow-duration="1200ms">
                            <div class="title">
                                <h3>Search Objects</h3>
                            </div>
                            <div class="sidebar-search-box">
                                <form class="search-form" action="#">
                                    <input placeholder="Search your keyword..." type="text">
                                    <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                                </form>
                            </div>
                        </div>
                        <!--End single sidebar-->

                        <!--Start single sidebar-->

                        <div class="single-sidebar wow fadeInUp animated" data-wow-delay="0.2s" data-wow-duration="1200ms">
                            <div class="title">
                                <h3>Recent Blogs</h3>
                            </div>
                            <ul class="popular-feeds">
                                <?php $__currentLoopData = $recentBlogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $recent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <div class="inner">
                                            <div class="img-box">
                                                <img src="<?php echo e($recent->thumbnail_url ?? asset('site_assets/images/default-blog.jpg')); ?>"
                                                    alt="<?php echo e($recent->title); ?>">
                                                <div class="overlay-content">
                                                    <a href="<?php echo e(route('blogs.show', $recent->slug)); ?>"><i
                                                            class="fa fa-link"></i></a>
                                                </div>
                                            </div>
                                            <div class="title-box">
                                                <h4><a href="<?php echo e(route('blogs.show', $recent->slug)); ?>"><?php echo e($recent->title); ?></a>
                                                </h4>
                                                <span><?php echo e($recent->created_at->format('d M Y')); ?></span>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </ul>
                        </div>
                        <!--End single sidebar-->

                        <!--Start sidebar categories Box-->
                        <!-- <div class="single-sidebar wow fadeInUp animated" data-wow-delay="0.3s" data-wow-duration="1200ms">
                                                    <div class="title">
                                                        <h3>Categories</h3>
                                                    </div>
                                                    <ul class="categorie-boxs">
                                                        <li><a href="#">Business <span>26</span></a></li>
                                                        <li class="active"><a href="#">Consultant <span>30</span></a></li>
                                                        <li><a href="#">Creative <span>71</span></a></li>
                                                        <li><a href="#">UI/UX <span>56</span></a></li>
                                                        <li><a href="#">Technology <span>60</span></a></li>
                                                    </ul>
                                                </div> -->
                        <!--End sidebar categories Box-->

                        <!--Start sidebar categories Box-->
                        <div class="single-sidebar wow fadeInUp animated" data-wow-delay="0.4s" data-wow-duration="1200ms">
                            <div class="title">
                                <h3>Never Miss News</h3>
                            </div>
                            <ul class="sidebar-social-links">
                                <li>
                                    <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                </li>
                            </ul>
                        </div>
                        <!--End sidebar categories Box-->

                        <!--Start Single Sidebar -->
                        <!-- <div class="single-sidebar wow fadeInUp animated" data-wow-delay="0.5s" data-wow-duration="1200ms">
                                                    <div class="title">
                                                        <h3>Twitter Feeds</h3>
                                                    </div>
                                                    <ul class="sidebar-twitter-feeds">
                                                        <li>
                                                            <div class="inner">
                                                                <div class="icon">
                                                                    <span class="icon-twitter"></span>
                                                                </div>
                                                                <div class="text">
                                                                    <p>
                                                                        <a href="#">Rescue - #Gutenberg ready @ wordpress Theme for Creative
                                                                            Bloggers available on @ ThemeForest https://t.co/2r1POjOjgVC…
                                                                            https://t.co/rDAnPyClu1</a>
                                                                    </p>
                                                                    <h5>November 25, 2018</h5>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="inner">
                                                                <div class="icon">
                                                                    <span class="icon-twitter"></span>
                                                                </div>
                                                                <div class="text">
                                                                    <p>
                                                                        <a href="#">Rescue - #Gutenberg ready @ wordpress Theme for Creative
                                                                            Bloggers available on @ ThemeForest https://t.co/2r1POjOjgVC…
                                                                            https://t.co/rDAnPyClu1</a>
                                                                    </p>
                                                                    <h5>November 25, 2018</h5>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="inner">
                                                                <div class="icon">
                                                                    <span class="icon-twitter"></span>
                                                                </div>
                                                                <div class="text">
                                                                    <p>
                                                                        <a href="#">Rescue - #Gutenberg ready @ wordpress Theme for Creative
                                                                            Bloggers available on @ ThemeForest https://t.co/2r1POjOjgVC…
                                                                            https://t.co/rDAnPyClu1</a>
                                                                    </p>
                                                                    <h5>November 25, 2018</h5>
                                                                </div>
                                                            </div>
                                                        </li>

                                                    </ul>
                                                </div> -->
                        <!--End Single Sidebar -->

                        <!--Start Single Sidebar -->
                        <!-- <div class="single-sidebar wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="1200ms">
                                                    <div class="title">
                                                        <h3>Instagram Feeds</h3>
                                                    </div>
                                                    <ul class="instagram">
                                                        <li>
                                                            <div class="img-box">
                                                                <img src="<?php echo e(asset('site_assets')); ?>//images/sidebar/instagram-1.jpg"
                                                                    alt="Awesome Image">
                                                                <div class="overlay-content">
                                                                    <a class="lightbox-image" data-fancybox="gallery"
                                                                        href="<?php echo e(asset('site_assets')); ?>//images/sidebar/instagram-1.jpg">
                                                                        <i class="fa fa-search-plus" aria-hidden="true"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="img-box">
                                                                <img src="<?php echo e(asset('site_assets')); ?>//images/sidebar/instagram-2.jpg"
                                                                    alt="Awesome Image">
                                                                <div class="overlay-content">
                                                                    <a class="lightbox-image" data-fancybox="gallery"
                                                                        href="<?php echo e(asset('site_assets')); ?>//images/sidebar/instagram-2.jpg">
                                                                        <i class="fa fa-search-plus" aria-hidden="true"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="img-box">
                                                                <img src="<?php echo e(asset('site_assets')); ?>//images/sidebar/instagram-3.jpg"
                                                                    alt="Awesome Image">
                                                                <div class="overlay-content">
                                                                    <a class="lightbox-image" data-fancybox="gallery"
                                                                        href="<?php echo e(asset('site_assets')); ?>//images/sidebar/instagram-3.jpg">
                                                                        <i class="fa fa-search-plus" aria-hidden="true"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="img-box">
                                                                <img src="<?php echo e(asset('site_assets')); ?>//images/sidebar/instagram-4.jpg"
                                                                    alt="Awesome Image">
                                                                <div class="overlay-content">
                                                                    <a class="lightbox-image" data-fancybox="gallery"
                                                                        href="<?php echo e(asset('site_assets')); ?>//images/sidebar/instagram-4.jpg">
                                                                        <i class="fa fa-search-plus" aria-hidden="true"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="img-box">
                                                                <img src="<?php echo e(asset('site_assets')); ?>//images/sidebar/instagram-5.jpg"
                                                                    alt="Awesome Image">
                                                                <div class="overlay-content">
                                                                    <a class="lightbox-image" data-fancybox="gallery"
                                                                        href="<?php echo e(asset('site_assets')); ?>//images/sidebar/instagram-5.jpg">
                                                                        <i class="fa fa-search-plus" aria-hidden="true"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="img-box">
                                                                <img src="<?php echo e(asset('site_assets')); ?>//images/sidebar/instagram-6.jpg"
                                                                    alt="Awesome Image">
                                                                <div class="overlay-content">
                                                                    <a class="lightbox-image" data-fancybox="gallery"
                                                                        href="<?php echo e(asset('site_assets')); ?>//images/sidebar/instagram-6.jpg">
                                                                        <i class="fa fa-search-plus" aria-hidden="true"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <div class="img-box">
                                                                <img src="<?php echo e(asset('site_assets')); ?>//images/sidebar/instagram-7.jpg"
                                                                    alt="Awesome Image">
                                                                <div class="overlay-content">
                                                                    <a class="lightbox-image" data-fancybox="gallery"
                                                                        href="<?php echo e(asset('site_assets')); ?>//images/sidebar/instagram-7.jpg">
                                                                        <i class="fa fa-search-plus" aria-hidden="true"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="img-box">
                                                                <img src="<?php echo e(asset('site_assets')); ?>//images/sidebar/instagram-8.jpg"
                                                                    alt="Awesome Image">
                                                                <div class="overlay-content">
                                                                    <a class="lightbox-image" data-fancybox="gallery"
                                                                        href="<?php echo e(asset('site_assets')); ?>//images/sidebar/instagram-8.jpg">
                                                                        <i class="fa fa-search-plus" aria-hidden="true"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="img-box">
                                                                <img src="<?php echo e(asset('site_assets')); ?>//images/sidebar/instagram-9.jpg"
                                                                    alt="Awesome Image">
                                                                <div class="overlay-content">
                                                                    <a class="lightbox-image" data-fancybox="gallery"
                                                                        href="<?php echo e(asset('site_assets')); ?>//images/sidebar/instagram-9.jpg">
                                                                        <i class="fa fa-search-plus" aria-hidden="true"></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </li>


                                                    </ul>
                                                </div> -->
                        <!--End Single Sidebar -->
                        <!--Start single sidebar-->
                        <!-- <div class="single-sidebar wow fadeInUp animated" data-wow-delay="0.7s" data-wow-duration="1200ms">
                                                    <div class="title">
                                                        <h3>Popular Tags</h3>
                                                    </div>
                                                    <ul class="popular-tag">
                                                        <li><a href="#">popular</a></li>
                                                        <li><a href="#">desgin</a></li>
                                                        <li><a href="#">ux</a></li>
                                                        <li><a href="#">usability</a></li>
                                                        <li><a href="#">develop</a></li>
                                                        <li><a href="#">icon</a></li>
                                                        <li><a href="#">business</a></li>
                                                        <li><a href="#">consult</a></li>
                                                        <li><a href="#">kit</a></li>
                                                        <li><a href="#">keyboard</a></li>
                                                        <li><a href="#">mouse</a></li>
                                                        <li><a href="#">tech</a></li>
                                                    </ul>
                                                </div> -->
                        <!--End single sidebar-->

                        <div class="sidebar-add-banner-box"
                            style="background-image: url(<?php echo e(asset('site_assets')); ?>//images/sidebar/add-banner.jpg)">
                            <div class="inner">
                                <h6>350x600</h6>
                                <h3>Add Banner</h3>
                            </div>
                        </div>

                    </div>
                </div>
                <!--End Sidebar Wrapper-->

            </div>
        </div>
    </section>
    <!--End Blog Style2 Area-->


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/front/blog-details.blade.php ENDPATH**/ ?>