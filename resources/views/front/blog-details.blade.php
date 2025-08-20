@extends('layouts.new-master')

@section('title')
    News Details || CarePress
@endsection


@section('content')

    <!--Start breadcrumb area-->
    <section class="breadcrumb-area"
        style="background-image: url({{ asset('site_assets') }}//images/breadcrumb/breadcrumb-1.png);">
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
                            <div class="text-holder">
                                <!--Start Blog Details Single-->
                                <div class="blog-details-single">
                                    <div class="categories">
                                        <h5>Business</h5>
                                    </div>
                                    <h2 class="blog-title">Lorem ipsum dolor sit amet, consecte cing elit, sed do eiusmod
                                        tempor.</h2>
                                    <ul class="meta-info">
                                        <li><span class="icon-user"></span><a href="#">by Piklo D. Sindom</a></li>
                                        <li><span class="icon-calendar"></span><a href="#">24th March 2019</a></li>
                                        <li><span class="icon-chat"></span><a href="#">35 Comments</a></li>
                                    </ul>
                                    <div class="text">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                            nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                            fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                                            culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde
                                            omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam
                                            rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto
                                            beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit
                                            aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui
                                            ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum
                                            quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi
                                            tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Lorem
                                            ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                            nostrud exercitation ullamco laboris nisi ut aliquip ex ea.</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim exercitation
                                            ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                                            in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                                            deserunt. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                            eiusmod tempor incididunt ut labore</p>
                                    </div>

                                    <div class="blog-details-image-1">
                                        <img src="{{ asset('site_assets') }}//images/blog/blog-details-image-1.jpg" alt="">
                                    </div>

                                    <div class="blog-details-text-1">
                                        <h2>A cleansing hot shower or bath</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ullamco
                                            laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                                            reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                                            Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia. et
                                            dolore magna aliqua. Ut </p>
                                    </div>

                                    <div class="blog-details-text-2">
                                        <h2>Setting the mood with incense</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                            nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                            fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                                            culpa qui officia. </p>
                                    </div>

                                    <div class="blog-details-text-3">
                                        <h2>Setting the mood with incense</h2>
                                        <ul>
                                            <li><span class="icon-tick"></span>Lorem ipsum dolor sit amet, consectetur
                                                adipisicing elit, sed do.</li>
                                            <li><span class="icon-tick"></span>Lorem ipsum dolor sit amet, consectetur
                                                adipisicing elit, sed do.</li>
                                            <li><span class="icon-tick"></span>Lorem ipsum dolor sit amet, consectetur
                                                adipisicing elit, sed do.</li>
                                            <li><span class="icon-tick"></span>Lorem ipsum dolor sit amet, consectetur
                                                adipisicing elit, sed do.</li>
                                            <li><span class="icon-tick"></span>Lorem ipsum dolor sit amet, consectetur
                                                adipisicing elit, sed do.</li>
                                        </ul>
                                    </div>

                                    <div class="blog-details-author-box text-center">
                                        <div class="quote"><span class="icon-quote"></span></div>
                                        <h6>by Hetmayar</h6>
                                        <h2>Viral dreamcatcher keytar typewriter, aest hetic offal umami. Aesthetic polaroid
                                            pug pitchfork post-ironic.</h2>
                                    </div>

                                    <div class="blog-details-text-4">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                            nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                            fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, officia
                                            deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus
                                            error sit voluptatem accusantium.ex</p>
                                    </div>

                                    <div class="blog-details-image-2">
                                        <div class="image-box">
                                            <img src="{{ asset('site_assets') }}//images/blog/blog-details-image-2.jpg"
                                                alt="">
                                        </div>
                                        <div class="text-box">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat no
                                                officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis
                                                iste natus error sit voluptatem accusantium doloremque laudantium.</p>
                                        </div>
                                    </div>

                                    <div class="blog-details-text-5">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                            nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                            fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, deserunt
                                            mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit
                                            voluptatem. ex ea commodo</p>
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
                                <!--End Blog Details Single-->

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
                                </div>

                            </div>
                        </div>

                        <div class="blog-details-bottom-content">
                            <div class="related-blog-post">
                                <div class="inner-title">
                                    <h3>Releted Post</h3>
                                </div>
                                <div class="row">
                                    <!--Start Single blog Style1-->
                                    <div class="col-xl-6">
                                        <div class="single-blog-style1">
                                            <div class="img-holder">
                                                <div class="inner">
                                                    <img src="{{ asset('site_assets') }}//images/blog/related-blog-1.jpg"
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
                                    <!--End Single blog Style1-->
                                    <!--Start Single blog Style1-->
                                    <div class="col-xl-6">
                                        <div class="single-blog-style1">
                                            <div class="img-holder">
                                                <div class="inner">
                                                    <img src="{{ asset('site_assets') }}//images/blog/related-blog-2.jpg"
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
                                    <!--End Single blog Style1-->
                                </div>
                            </div>

                            <div class="author-box-holder">
                                <div class="inner">
                                    <div class="img-box">
                                        <img src="{{ asset('site_assets') }}//images/blog/author.jpg" alt="">
                                    </div>
                                    <div class="text-box">
                                        <span>Written by</span>
                                        <h2>Rosalina D. William</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                            nostrud exercitation ullamco laboris nisi ut aliquip ex ea.</p>
                                    </div>
                                </div>
                            </div>

                            <!--Start comment box-->
                            <div class="comment-box">
                                <div class="title">
                                    <h3>Comments</h3>
                                </div>
                                <div class="outer-box">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!--Start single comment-->
                                            <div class="single-comment">
                                                <div class="single-comment-box">
                                                    <div class="img-holder">
                                                        <img src="{{ asset('site_assets') }}//images/blog/comment-1.png"
                                                            alt="Awesome Image">
                                                    </div>
                                                    <div class="text-holder">
                                                        <div class="top">
                                                            <div class="name">
                                                                <h3>Rosalina Kelian</h3>
                                                                <h5><span class="icon-calendar"></span>24th March 2019</h5>
                                                            </div>
                                                            <div class="reply">
                                                                <a href="#"><span class="icon-reply"></span>Reply</a>
                                                            </div>
                                                        </div>
                                                        <div class="text">
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                                                                do eiusmod tempor incididunt ut labore et dolore magna
                                                                aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                                                ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--End single comment-->
                                            <!--Start single comment-->
                                            <div class="single-comment comment-reply">
                                                <div class="single-comment-box">
                                                    <div class="img-holder">
                                                        <img src="{{ asset('site_assets') }}//images/blog/comment-2.png"
                                                            alt="Awesome Image">
                                                    </div>
                                                    <div class="text-holder">
                                                        <div class="top">
                                                            <div class="name">
                                                                <h3>Rosalina Kelian</h3>
                                                                <h5><span class="icon-calendar"></span>24th March 2019</h5>
                                                            </div>
                                                            <div class="reply">
                                                                <a href="#"><span class="icon-reply"></span>Reply</a>
                                                            </div>
                                                        </div>
                                                        <div class="text">
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                                                                do eiusmod tempor incididunt ut labore et dolore magna
                                                                aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                                                ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--End single comment-->
                                            <!--Start single comment-->
                                            <div class="single-comment">
                                                <div class="single-comment-box">
                                                    <div class="img-holder">
                                                        <img src="{{ asset('site_assets') }}//images/blog/comment-3.png"
                                                            alt="Awesome Image">
                                                    </div>
                                                    <div class="text-holder">
                                                        <div class="top">
                                                            <div class="name">
                                                                <h3>Arista Williamson</h3>
                                                                <h5><span class="icon-calendar"></span>24th March 2019</h5>
                                                            </div>
                                                            <div class="reply">
                                                                <a href="#"><span class="icon-reply"></span>Reply</a>
                                                            </div>
                                                        </div>
                                                        <div class="text">
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                                                                do eiusmod tempor incididunt ut labore et dolore magna
                                                                aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                                                                ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--End single comment-->

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--End comment box-->

                            <!--Start add comment box-->
                            <div class="add-comment-box">
                                <div class="title">
                                    <h3>Post Comment</h3>
                                </div>
                                <form id="add-comment-form" action="#">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-box">
                                                        <textarea name="message" placeholder="Type your comments...."
                                                            required=""></textarea>
                                                        <div class="icon"><span class="icon-pen"></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-box">
                                                        <input type="text" name="fname" value=""
                                                            placeholder="Type your name...." required="">
                                                        <div class="icon"><span class="icon-user"></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-box">
                                                        <input type="email" name="femail" value=""
                                                            placeholder="Type your email...." required="">
                                                        <div class="icon"><span class="icon-envelope"></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-box">
                                                        <input type="text" name="fwebsite" value=""
                                                            placeholder="Type your website....">
                                                        <div class="icon"><span class="icon-earth-grid-symbol"></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="button-box">
                                                        <button class="btn-one" type="submit">
                                                            <span class="txt"><i class="icon-chat"></i>Post Comments</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--End add comment box-->

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
                                    <img src="{{ asset('site_assets') }}//images/blog/sidebar-me-box-1.png"
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
                                            <img src="{{ asset('site_assets') }}//images/sidebar/popular-feeds-1.png"
                                                alt="Awesome Image">
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
                                            <img src="{{ asset('site_assets') }}//images/sidebar/popular-feeds-2.png"
                                                alt="Awesome Image">
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
                                            <img src="{{ asset('site_assets') }}//images/sidebar/popular-feeds-3.png"
                                                alt="Awesome Image">
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
                                            <img src="{{ asset('site_assets') }}//images/sidebar/popular-feeds-4.png"
                                                alt="Awesome Image">
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
                                        <img src="{{ asset('site_assets') }}//images/sidebar/instagram-1.jpg"
                                            alt="Awesome Image">
                                        <div class="overlay-content">
                                            <a class="lightbox-image" data-fancybox="gallery"
                                                href="{{ asset('site_assets') }}//images/sidebar/instagram-1.jpg">
                                                <i class="fa fa-search-plus" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="img-box">
                                        <img src="{{ asset('site_assets') }}//images/sidebar/instagram-2.jpg"
                                            alt="Awesome Image">
                                        <div class="overlay-content">
                                            <a class="lightbox-image" data-fancybox="gallery"
                                                href="{{ asset('site_assets') }}//images/sidebar/instagram-2.jpg">
                                                <i class="fa fa-search-plus" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="img-box">
                                        <img src="{{ asset('site_assets') }}//images/sidebar/instagram-3.jpg"
                                            alt="Awesome Image">
                                        <div class="overlay-content">
                                            <a class="lightbox-image" data-fancybox="gallery"
                                                href="{{ asset('site_assets') }}//images/sidebar/instagram-3.jpg">
                                                <i class="fa fa-search-plus" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="img-box">
                                        <img src="{{ asset('site_assets') }}//images/sidebar/instagram-4.jpg"
                                            alt="Awesome Image">
                                        <div class="overlay-content">
                                            <a class="lightbox-image" data-fancybox="gallery"
                                                href="{{ asset('site_assets') }}//images/sidebar/instagram-4.jpg">
                                                <i class="fa fa-search-plus" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="img-box">
                                        <img src="{{ asset('site_assets') }}//images/sidebar/instagram-5.jpg"
                                            alt="Awesome Image">
                                        <div class="overlay-content">
                                            <a class="lightbox-image" data-fancybox="gallery"
                                                href="{{ asset('site_assets') }}//images/sidebar/instagram-5.jpg">
                                                <i class="fa fa-search-plus" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="img-box">
                                        <img src="{{ asset('site_assets') }}//images/sidebar/instagram-6.jpg"
                                            alt="Awesome Image">
                                        <div class="overlay-content">
                                            <a class="lightbox-image" data-fancybox="gallery"
                                                href="{{ asset('site_assets') }}//images/sidebar/instagram-6.jpg">
                                                <i class="fa fa-search-plus" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>

                                <li>
                                    <div class="img-box">
                                        <img src="{{ asset('site_assets') }}//images/sidebar/instagram-7.jpg"
                                            alt="Awesome Image">
                                        <div class="overlay-content">
                                            <a class="lightbox-image" data-fancybox="gallery"
                                                href="{{ asset('site_assets') }}//images/sidebar/instagram-7.jpg">
                                                <i class="fa fa-search-plus" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="img-box">
                                        <img src="{{ asset('site_assets') }}//images/sidebar/instagram-8.jpg"
                                            alt="Awesome Image">
                                        <div class="overlay-content">
                                            <a class="lightbox-image" data-fancybox="gallery"
                                                href="{{ asset('site_assets') }}//images/sidebar/instagram-8.jpg">
                                                <i class="fa fa-search-plus" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="img-box">
                                        <img src="{{ asset('site_assets') }}//images/sidebar/instagram-9.jpg"
                                            alt="Awesome Image">
                                        <div class="overlay-content">
                                            <a class="lightbox-image" data-fancybox="gallery"
                                                href="{{ asset('site_assets') }}//images/sidebar/instagram-9.jpg">
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

                        <div class="sidebar-add-banner-box"
                            style="background-image: url({{ asset('site_assets') }}//images/sidebar/add-banner.jpg)">
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