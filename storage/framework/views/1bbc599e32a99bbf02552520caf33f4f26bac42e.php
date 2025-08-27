

<?php $__env->startSection('title'); ?>
    News Feeds || CarePress
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
                            <h2>News Feeds<span class="dotted"></span></h2>
                        </div>
                        <div class="breadcrumb-menu wow slideInDown animated" data-wow-delay="0.3s"
                            data-wow-duration="1500ms">
                            <ul class="clearfix">
                                <li><a href="index-2.html">Home</a></li>
                                <li class="active">News Feeds</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End breadcrumb area-->


    <!--Start Blog Style2 Area-->
    <section id="blog-area" class="blog-style3-area">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-7">
                    <div class="blog-posts">

                        <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="single-blog-style2 wow fadeInLeft" data-wow-delay="100ms" data-wow-duration="1500ms">
                                <div class="img-holder">
                                    <div class="inner">
                                        <img src="<?php echo e($blog->thumbnail_url ?? asset('site_assets/images/default-blog.jpg')); ?>"
                                            alt="<?php echo e($blog->title); ?>">
                                    </div>
                                </div>
                                <div class="text-holder">
                                    <h2 class="blog-title">
                                        <a href="<?php echo e(route('blogs.show', $blog->slug)); ?>"><?php echo e($blog->title); ?></a>
                                    </h2>
                                    <ul class="meta-info">
                                        <li><span class="icon-calendar"></span> <?php echo e($blog->created_at->format('d M Y')); ?></li>
                                    </ul>
                                    <div class="text">
                                        <p><?php echo e(Str::limit(strip_tags($blog->detail), 150, '...')); ?></p>
                                    </div>
                                    <div class="bottom-box">
                                        
                                        <div class="readmore">
                                            <a href="<?php echo e(route('blogs.show', $blog->slug)); ?>"><span class="icon-next"></span>
                                                Read
                                                More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>

                    <div class="row">
                        <div class="col-xl-12">
                            	<ul class="styled-pagination clearfix text-center">
										<li class="prev <?php echo e($blogs->onFirstPage() ? 'disabled' : ''); ?>">
											<a  href="<?php echo e($blogs->previousPageUrl() ?? 'javascript:;'); ?>">
												<i class="bx bx-chevron-left"></i> Prev
											</a>
										</li>
								
										<?php for($i = 1; $i <= $blogs->lastPage(); $i++): ?>
											<li
												class="dotted <?php echo e($blogs->currentPage() == $i ? 'active' : ''); ?>">
												<a  href="<?php echo e($blogs->url($i)); ?>">
													<?php echo e($i); ?>

												</a>
											</li>
										<?php endfor; ?>
									
										<li class="next <?php echo e($blogs->hasMorePages() ? '' : 'disabled'); ?>">
											<a href="<?php echo e($blogs->nextPageUrl() ?? 'javascript:;'); ?>"
												aria-label="Next">
												Next <i class="bx bx-chevron-right"></i>
											</a>
										</li>
							
                        </div>
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
                                        <img src="<?php echo e(asset('site_assets')); ?>//images/blog/sidebar-me-box-1.png" alt="Awesome Image"/>
                                    </div>
                                    <div class="text-holder">
                                        <h3>Rosalina D. Willaimson</h3>
                                        <p>Lorem ipsum dolor sit amet, consectet ur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</p>
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
                                                <a href="#"><i class="fa fa-link" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                        <div class="title-box">
                                            <h4><a  href="<?php echo e(route('blogs.show', $recent->slug)); ?>"><?php echo e($recent->title); ?></a></h4>
                                            <h6><span class="icon-calendar-1"></span><?php echo e($recent->created_at->format('d M Y')); ?></h6>
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
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/front/blogs.blade.php ENDPATH**/ ?>