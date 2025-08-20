@extends('layouts.new-master')

@section('title')
   News Feeds || CarePress 
@endsection

@section('content')


<!--Start breadcrumb area-->     
<section class="breadcrumb-area" style="background-image: url({{ asset('site_assets') }}//images/breadcrumb/breadcrumb-1.png);">
    <div class="banner-curve-gray"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="inner-content clearfix text-center">
                    <div class="title wow slideInUp animated" data-wow-delay="0.3s" data-wow-duration="1500ms">
                       <h2>News Feeds<span class="dotted"></span></h2>
                    </div>
                    <div class="breadcrumb-menu wow slideInDown animated" data-wow-delay="0.3s" data-wow-duration="1500ms">
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
                   
                    <!--Start Single blog Style2-->
                    <div class="single-blog-style2 wow fadeInLeft" data-wow-delay="100ms" data-wow-duration="1500ms">
                        <div class="img-holder">
                            <div class="inner">
                                <img src="{{ asset('site_assets') }}//images/blog/blog-v2-1.jpg" alt="Awesome Image">
                            </div>
                        </div> 
                        <div class="text-holder">
                            <div class="categories">
                                <h5>Business</h5>
                            </div>
                            <h2 class="blog-title">
                                <a href="blog-single.html">Lorem ipsum dolor sit amet, consecte cing elit, sed do eiusmod tempor.</a>
                            </h2>
                            <ul class="meta-info">
                                <li><span class="icon-eye"></span><a href="#">232 Views</a></li>
                                <li><span class="icon-chat"></span><a href="#">35 Comments</a></li>
                                <li><span class="icon-calendar"></span><a href="#">24th March 2019</a></li>
                            </ul>
                            <div class="text">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint </p>
                            </div>
                            <div class="bottom-box">
                                <div class="author">
                                    <div class="image">
                                        <img src="{{ asset('site_assets') }}//images/blog/author-1.png" alt="">
                                    </div>
                                    <div class="name">
                                        <h4>by Hetmayar</h4>
                                    </div>    
                                </div>
                                <div class="readmore">
                                    <a href="#"><span class="icon-next"></span>Read More</a>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <!--End Single blog Style2--> 
                    
                    <!--Start Single blog Style2-->
                    <div class="single-blog-style2 wow fadeInLeft" data-wow-delay="100ms" data-wow-duration="1500ms">
                        <div class="single-item">
                            <div class="img-holder">
                                <div class="video-holder-box style3 text-center" style="background-image: url({{ asset('site_assets') }}//images/blog/blog-v2-2.jpg)">
                                    <div class="icon">
                                        <a class="video-popup" title="CarePress" href="https://www.youtube.com/watch?v=p25gICT63ek">
                                            <span class="icon-play-button"></span>
                                        </a>
                                    </div>
                                </div>
                            </div> 
                            <div class="text-holder">
                                <div class="categories">
                                    <h5>Business</h5>
                                </div>
                                <h2 class="blog-title">
                                    <a href="blog-single.html">Adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</a>
                                </h2>
                                <ul class="meta-info">
                                    <li><span class="icon-eye"></span><a href="#">232 Views</a></li>
                                    <li><span class="icon-chat"></span><a href="#">35 Comments</a></li>
                                    <li><span class="icon-calendar"></span><a href="#">24th March 2019</a></li>
                                </ul>
                                <div class="text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint </p>
                                </div>
                                <div class="bottom-box">
                                    <div class="author">
                                        <div class="image">
                                            <img src="{{ asset('site_assets') }}//images/blog/author-1.png" alt="">
                                        </div>
                                        <div class="name">
                                            <h4>by Hetmayar</h4>
                                        </div>    
                                    </div>
                                    <div class="readmore">
                                        <a href="#"><span class="icon-next"></span>Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <!--End Single blog Style2--> 
                    
                    <!--Start Single blog Style2-->
                    <div class="single-blog-style2 wow fadeInLeft" data-wow-delay="100ms" data-wow-duration="1500ms">
                        <div class="blog-carousel-2 owl-carousel owl-theme owl-nav-style-one">
                            <!--Start Single Item-->
                            <div class="single-item">
                                <div class="img-holder">
                                    <div class="inner">
                                        <img src="{{ asset('site_assets') }}//images/blog/blog-v2-3.jpg" alt="Awesome Image">
                                    </div>
                                </div>
                            </div>
                            <!--End Single Item-->
                            <!--Start Single Item-->
                            <div class="single-item">
                                <div class="img-holder">
                                    <div class="inner">
                                        <img src="{{ asset('site_assets') }}//images/blog/blog-v2-3.jpg" alt="Awesome Image">
                                    </div>
                                </div>
                            </div>
                            <!--End Single Item-->  
                        </div>
                        <div class="text-holder">
                            <div class="categories">
                                <h5>Business</h5>
                            </div>
                            <h2 class="blog-title">
                                <a href="blog-single.html">Magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco</a>
                            </h2>
                            <ul class="meta-info">
                                <li><span class="icon-eye"></span><a href="#">232 Views</a></li>
                                <li><span class="icon-chat"></span><a href="#">35 Comments</a></li>
                                <li><span class="icon-calendar"></span><a href="#">24th March 2019</a></li>
                            </ul>
                            <div class="text">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint </p>
                            </div>
                            <div class="bottom-box">
                                <div class="author">
                                    <div class="image">
                                        <img src="{{ asset('site_assets') }}//images/blog/author-1.png" alt="">
                                    </div>
                                    <div class="name">
                                        <h4>by Hetmayar</h4>
                                    </div>    
                                </div>
                                <div class="readmore">
                                    <a href="#"><span class="icon-next"></span>Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End Single blog Style2-->
                    
                    <!--Start Single blog Style2-->
                    <div class="single-blog-style2 wow fadeInLeft" data-wow-delay="100ms" data-wow-duration="1500ms">
                        <div class="audio-box-holder">
                            <img src="{{ asset('site_assets') }}//images/blog/audio.jpg" alt="">    
                        </div> 
                        <div class="text-holder">
                            <div class="categories">
                                <h5>Business</h5>
                            </div>
                            <h2 class="blog-title">
                                <a href="blog-single.html">Laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor.</a>
                            </h2>
                            <ul class="meta-info">
                                <li><span class="icon-eye"></span><a href="#">232 Views</a></li>
                                <li><span class="icon-chat"></span><a href="#">35 Comments</a></li>
                                <li><span class="icon-calendar"></span><a href="#">24th March 2019</a></li>
                            </ul>
                            <div class="text">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint </p>
                            </div>
                            <div class="bottom-box">
                                <div class="author">
                                    <div class="image">
                                        <img src="{{ asset('site_assets') }}//images/blog/author-1.png" alt="">
                                    </div>
                                    <div class="name">
                                        <h4>by Hetmayar</h4>
                                    </div>    
                                </div>
                                <div class="readmore">
                                    <a href="#"><span class="icon-next"></span>Read More</a>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <!--End Single blog Style2-->
                    <!--Start Single blog Style2-->
                    <div class="single-blog-style2 wow fadeInLeft" data-wow-delay="100ms" data-wow-duration="1500ms">
                        <div class="text-holder">
                            <div class="categories">
                                <h5>Business</h5>
                            </div>
                            <h2 class="blog-title">
                                <a href="blog-single.html">In reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</a>
                            </h2>
                            <ul class="meta-info">
                                <li><span class="icon-eye"></span><a href="#">232 Views</a></li>
                                <li><span class="icon-chat"></span><a href="#">35 Comments</a></li>
                                <li><span class="icon-calendar"></span><a href="#">24th March 2019</a></li>
                            </ul>
                            <div class="text">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint </p>
                            </div>
                            <div class="bottom-box">
                                <div class="author">
                                    <div class="image">
                                        <img src="{{ asset('site_assets') }}//images/blog/author-1.png" alt="">
                                    </div>
                                    <div class="name">
                                        <h4>by Hetmayar</h4>
                                    </div>    
                                </div>
                                <div class="readmore">
                                    <a href="#"><span class="icon-next"></span>Read More</a>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <!--End Single blog Style2-->
                    
                    <!--Start Single blog Style2-->
                    <div class="single-blog-style2 wow fadeInLeft" data-wow-delay="100ms" data-wow-duration="1500ms">
                        <div class="outer-box" style="background-image: url({{ asset('site_assets') }}//images/pattern/single-blog-style2-bg.jpg)">
                            <div class="inner-content">
                                <div class="icon-holder">
                                    <span class="icon-quote"></span>
                                </div>
                                <div class="text-holder">
                                    <h2 class="blog-title">
                                        <a href="blog-single.html">Excepteur sint occaecat cupida tat non proident, sunt in.</a>
                                    </h2>
                                    <ul class="meta-info">
                                        <li><span class="icon-eye"></span><a href="#">232 Views</a></li>
                                        <li><span class="icon-chat"></span><a href="#">35 Comments</a></li>
                                        <li><span class="icon-calendar"></span><a href="#">24th March 2019</a></li>
                                    </ul>
                                </div> 
                            </div>
                        </div>
                    </div>
                    <!--End Single blog Style2-->
                    <!--Start Single blog Style2-->
                    <div class="single-blog-style2 style2instyle3 wow fadeInLeft" data-wow-delay="100ms" data-wow-duration="1500ms">
                        <div class="text-holder">
                            <div class="categories">
                                <h5>Business</h5>
                            </div>
                            <h2 class="blog-title">
                                <a href="blog-single.html">Culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis</a>
                            </h2>
                            <ul class="meta-info">
                                <li><span class="icon-eye"></span><a href="#">232 Views</a></li>
                                <li><span class="icon-chat"></span><a href="#">35 Comments</a></li>
                                <li><span class="icon-calendar"></span><a href="#">24th March 2019</a></li>
                            </ul>
                        </div> 
                    </div>
                    <!--End Single blog Style2-->     
                </div>
                
                <div class="row">
                    <div class="col-xl-12">
                        <ul class="styled-pagination clearfix text-center">
                            <li class="prev"><a href="#"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a></li>
                            <li><a href="#">1</a></li>
                            <li class="active"><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li class="dotted"><a href="#"><span>...</span></a></li>
                            <li><a href="#">10</a></li>
                            <li class="next"><a href="#"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div> 
                  
            </div>
            
            <!--Start sidebar Wrapper-->
            <div class="col-xl-4 col-lg-5 col-md-9 col-sm-12">
                <div class="sidebar-wrapper">
                   
                    <div class="single-sidebar wow fadeInUp animated" data-wow-delay="0.0s" data-wow-duration="1200ms">
                        <div class="sidebar-about-me-box text-center">
                            <div class="title">
                                <h3>About Me</h3>
                            </div>
                            <div class="image-box">
                                <img src="{{ asset('site_assets') }}//images/blog/sidebar-me-box-1.png" alt="Awesome Image"/>
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
                    </div>
                   
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
                            <h3>Popular Feeds</h3>
                        </div>
                        <ul class="popular-feeds">
                            <li>
                                <div class="inner">   
                                    <div class="img-box">
                                        <img src="{{ asset('site_assets') }}//images/sidebar/popular-feeds-1.png" alt="Awesome Image">
                                        <div class="overlay-content">
                                            <a href="#"><i class="fa fa-link" aria-hidden="true"></i></a>
                                        </div>    
                                    </div>
                                    <div class="title-box">
                                        <h4><a href="#">Lorem ipsum dolor sit<br> cing elit, sed do.</a></h4>
                                        <h6><span class="icon-calendar-1"></span>24th March 2019</h6>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="inner">   
                                    <div class="img-box">
                                        <img src="{{ asset('site_assets') }}//images/sidebar/popular-feeds-2.png" alt="Awesome Image">
                                        <div class="overlay-content">
                                            <a href="#"><i class="fa fa-link" aria-hidden="true"></i></a>
                                        </div>    
                                    </div>
                                    <div class="title-box">
                                        <h4><a href="#">Lorem ipsum dolor sit<br> cing elit, sed do.</a></h4>
                                        <h6><span class="icon-calendar-1"></span>24th March 2019</h6>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="inner">   
                                    <div class="img-box">
                                        <img src="{{ asset('site_assets') }}//images/sidebar/popular-feeds-3.png" alt="Awesome Image">
                                        <div class="overlay-content">
                                            <a href="#"><i class="fa fa-link" aria-hidden="true"></i></a>
                                        </div>    
                                    </div>
                                    <div class="title-box">
                                        <h4><a href="#">Lorem ipsum dolor sit<br> cing elit, sed do.</a></h4>
                                        <h6><span class="icon-calendar-1"></span>24th March 2019</h6>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="inner">   
                                    <div class="img-box">
                                        <img src="{{ asset('site_assets') }}//images/sidebar/popular-feeds-4.png" alt="Awesome Image">
                                        <div class="overlay-content">
                                            <a href="#"><i class="fa fa-link" aria-hidden="true"></i></a>
                                        </div>    
                                    </div>
                                    <div class="title-box">
                                        <h4><a href="#">Lorem ipsum dolor sit<br> cing elit, sed do.</a></h4>
                                        <h6><span class="icon-calendar-1"></span>24th March 2019</h6>
                                    </div>
                                </div>
                            </li>
                           
                        </ul>     
                    </div>
                    <!--End single sidebar-->
                    
                    <!--Start sidebar categories Box-->
                    <div class="single-sidebar wow fadeInUp animated" data-wow-delay="0.3s" data-wow-duration="1200ms">
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
                    </div>
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
                    <div class="single-sidebar wow fadeInUp animated" data-wow-delay="0.5s" data-wow-duration="1200ms">
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
                                            <a href="#">Rescue - #Gutenberg ready @ wordpress Theme for Creative Bloggers available on @ ThemeForest https://t.co/2r1POjOjgVC… https://t.co/rDAnPyClu1</a>
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
                                            <a href="#">Rescue - #Gutenberg ready @ wordpress Theme for Creative Bloggers available on @ ThemeForest https://t.co/2r1POjOjgVC… https://t.co/rDAnPyClu1</a>
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
                                            <a href="#">Rescue - #Gutenberg ready @ wordpress Theme for Creative Bloggers available on @ ThemeForest https://t.co/2r1POjOjgVC… https://t.co/rDAnPyClu1</a>
                                        </p>
                                        <h5>November 25, 2018</h5>
                                    </div>
                                </div> 
                            </li>
                            
                        </ul>
                    </div>
                    <!--End Single Sidebar -->
                    
                    <!--Start Single Sidebar -->
                    <div class="single-sidebar wow fadeInUp animated" data-wow-delay="0.6s" data-wow-duration="1200ms">
                        <div class="title">
                            <h3>Instagram Feeds</h3>
                        </div>
                        <ul class="instagram">
                            <li>
                                <div class="img-box">
                                    <img src="{{ asset('site_assets') }}//images/sidebar/instagram-1.jpg" alt="Awesome Image">
                                    <div class="overlay-content">
                                        <a class="lightbox-image" data-fancybox="gallery" href="{{ asset('site_assets') }}//images/sidebar/instagram-1.jpg">
                                            <i class="fa fa-search-plus" aria-hidden="true"></i>
                                        </a>
                                    </div>    
                                </div>
                            </li>
                            <li>
                                <div class="img-box">
                                    <img src="{{ asset('site_assets') }}//images/sidebar/instagram-2.jpg" alt="Awesome Image">
                                    <div class="overlay-content">
                                        <a class="lightbox-image" data-fancybox="gallery" href="{{ asset('site_assets') }}//images/sidebar/instagram-2.jpg">
                                            <i class="fa fa-search-plus" aria-hidden="true"></i>
                                        </a>
                                    </div>    
                                </div>
                            </li>
                            <li>
                                <div class="img-box">
                                    <img src="{{ asset('site_assets') }}//images/sidebar/instagram-3.jpg" alt="Awesome Image">
                                    <div class="overlay-content">
                                        <a class="lightbox-image" data-fancybox="gallery" href="{{ asset('site_assets') }}//images/sidebar/instagram-3.jpg">
                                            <i class="fa fa-search-plus" aria-hidden="true"></i>
                                        </a>
                                    </div>    
                                </div>
                            </li>
                            <li>
                                <div class="img-box">
                                    <img src="{{ asset('site_assets') }}//images/sidebar/instagram-4.jpg" alt="Awesome Image">
                                    <div class="overlay-content">
                                        <a class="lightbox-image" data-fancybox="gallery" href="{{ asset('site_assets') }}//images/sidebar/instagram-4.jpg">
                                            <i class="fa fa-search-plus" aria-hidden="true"></i>
                                        </a>
                                    </div>    
                                </div>
                            </li>
                            <li>
                                <div class="img-box">
                                    <img src="{{ asset('site_assets') }}//images/sidebar/instagram-5.jpg" alt="Awesome Image">
                                    <div class="overlay-content">
                                        <a class="lightbox-image" data-fancybox="gallery" href="{{ asset('site_assets') }}//images/sidebar/instagram-5.jpg">
                                            <i class="fa fa-search-plus" aria-hidden="true"></i>
                                        </a>
                                    </div>    
                                </div>
                            </li>
                            <li>
                                <div class="img-box">
                                    <img src="{{ asset('site_assets') }}//images/sidebar/instagram-6.jpg" alt="Awesome Image">
                                    <div class="overlay-content">
                                        <a class="lightbox-image" data-fancybox="gallery" href="{{ asset('site_assets') }}//images/sidebar/instagram-6.jpg">
                                            <i class="fa fa-search-plus" aria-hidden="true"></i>
                                        </a>
                                    </div>    
                                </div>
                            </li>
                            
                            <li>
                                <div class="img-box">
                                    <img src="{{ asset('site_assets') }}//images/sidebar/instagram-7.jpg" alt="Awesome Image">
                                    <div class="overlay-content">
                                        <a class="lightbox-image" data-fancybox="gallery" href="{{ asset('site_assets') }}//images/sidebar/instagram-7.jpg">
                                            <i class="fa fa-search-plus" aria-hidden="true"></i>
                                        </a>
                                    </div>    
                                </div>
                            </li>
                            <li>
                                <div class="img-box">
                                    <img src="{{ asset('site_assets') }}//images/sidebar/instagram-8.jpg" alt="Awesome Image">
                                    <div class="overlay-content">
                                        <a class="lightbox-image" data-fancybox="gallery" href="{{ asset('site_assets') }}//images/sidebar/instagram-8.jpg">
                                            <i class="fa fa-search-plus" aria-hidden="true"></i>
                                        </a>
                                    </div>    
                                </div>
                            </li>
                            <li>
                                <div class="img-box">
                                    <img src="{{ asset('site_assets') }}//images/sidebar/instagram-9.jpg" alt="Awesome Image">
                                    <div class="overlay-content">
                                        <a class="lightbox-image" data-fancybox="gallery" href="{{ asset('site_assets') }}//images/sidebar/instagram-9.jpg">
                                            <i class="fa fa-search-plus" aria-hidden="true"></i>
                                        </a>
                                    </div>    
                                </div>
                            </li>
                           
                            
                        </ul>
                    </div>
                    <!--End Single Sidebar -->
                    <!--Start single sidebar-->
                    <div class="single-sidebar wow fadeInUp animated" data-wow-delay="0.7s" data-wow-duration="1200ms">
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
                    </div>
                    <!--End single sidebar-->
                    
                    <div class="sidebar-add-banner-box" style="background-image: url({{ asset('site_assets') }}//images/sidebar/add-banner.jpg)">
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
 
 

  
@endsection
