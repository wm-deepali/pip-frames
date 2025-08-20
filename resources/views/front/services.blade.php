@extends('layouts.new-master')

@section('title')
    Services
@endsection

@section('content')
    <!--Start breadcrumb area-->
    <section class="breadcrumb-area style2" style="background-image: url({{ asset('site_assets') }}/images/breadcrumb/breadcrumb-1.png);">
        <div class="banner-curve"></div>
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="inner-content clearfix text-center">
                        <div class="title wow slideInUp animated" data-wow-delay="0.3s" data-wow-duration="1500ms">
                            <h2>What We Do<span class="dotted"></span></h2>
                        </div>
                        <div class="breadcrumb-menu wow slideInDown animated" data-wow-delay="0.3s"
                            data-wow-duration="1500ms">
                            <ul class="clearfix">
                                <li><a href="index-2.html">Home</a></li>
                                <li class="active">Services</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End breadcrumb area-->

    <!-- Start Service Style1 Area -->
    <section class="service-style1-area service-page">
        <div class="container">
            <div class="row">
                <!--Start Single Service Style1-->
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <div class="single-service-style1">
                        <div class="img-holder">
                            <div class="inner">
                                <img src="{{ asset('site_assets') }}/images/services/service-v1-1.jpg" alt="">
                            </div>
                        </div>
                        <div class="text-holder">
                            <h3><a href="ser-pet-grooming.html">Pet Grooming</a></h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor. </p>
                            <div class="button">
                                <a href="ser-pet-grooming.html">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Single Service Style1-->
                <!--Start Single Service Style1-->
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay="100ms" data-wow-duration="1500ms">
                    <div class="single-service-style1">
                        <div class="img-holder">
                            <div class="inner">
                                <img src="{{ asset('site_assets') }}/images/services/service-v1-2.jpg" alt="">
                            </div>
                        </div>
                        <div class="text-holder">
                            <h3><a href="ser-dog-setting.html">Dog Setting</a></h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor. </p>
                            <div class="button">
                                <a href="ser-dog-setting.html">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Single Service Style1-->
                <!--Start Single Service Style1-->
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <div class="single-service-style1">
                        <div class="img-holder">
                            <div class="inner">
                                <img src="{{ asset('site_assets') }}/images/services/service-v1-3.jpg" alt="">
                            </div>
                        </div>
                        <div class="text-holder">
                            <h3><a href="ser-healthy-meals.html">Healthy Meals</a></h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor. </p>
                            <div class="button">
                                <a href="ser-healthy-meals.html">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Single Service Style1-->
                <!--Start Single Service Style1-->
                <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInRight" data-wow-delay="100ms" data-wow-duration="1500ms">
                    <div class="single-service-style1">
                        <div class="img-holder">
                            <div class="inner">
                                <img src="{{ asset('site_assets') }}/images/services/service-v1-4.jpg" alt="">
                            </div>
                        </div>
                        <div class="text-holder">
                            <h3><a href="ser-veterinary-service.html">Veterinary Service</a></h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor. </p>
                            <div class="button">
                                <a href="ser-veterinary-service.html">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Single Service Style1-->

            </div>

        </div>
    </section>
    <!-- End Service Style1 Area -->

    <!--Start Choose Style1 Area-->
    <section class="choose-style1-area pdtop0">
        <div class="container">
            <div class="row">

                <div class="col-xl-6">
                    <div class="feautres-content-box">
                        <div class="sec-title">
                            <h5>//<span>Choices</span>//</h5>
                            <h2>Why Choose Us<span class="round-box zoominout"></span></h2>
                        </div>
                        <div class="inner-content">
                            <div class="text">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                    exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            </div>

                            <ul class="top">
                                <li>
                                    <div class="inner">
                                        <div class="icon">
                                            <span class="icon-vet"></span>
                                        </div>
                                        <div class="title">
                                            <h3>Pet Care</h3>
                                            <p>Get a solid solution</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="inner">
                                        <div class="icon">
                                            <span class="icon-injection"></span>
                                        </div>
                                        <div class="title">
                                            <h3>Pet Medicine</h3>
                                            <p>Get a solid solution</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <ul class="bottom">
                                <li>
                                    <div class="inner">
                                        <div class="icon">
                                            <span class="icon-veterinary"></span>
                                        </div>
                                        <div class="title">
                                            <h3>Grooming</h3>
                                            <p>Get a solid solution</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="inner">
                                        <div class="icon">
                                            <span class="icon-vaccine"></span>
                                        </div>
                                        <div class="title">
                                            <h3>Monthly Care</h3>
                                            <p>Get a solid solution</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="choose-style1-image-box">
                        <img src="{{ asset('site_assets') }}/images/resources/choose-style1-image.jpg" alt="">
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--End Choose Style1 Area-->

    <!--Start Faq Style1 Area-->
    <section class="faq-style1-area gray-bg">
        <div class="container">
            <div class="row">

                <div class="col-lg-6">
                    <div class="faq-style1-image-box">
                        <div class="faq-top">
                            <img src="{{ asset('site_assets') }}/images/resources/faq-top-image.jpg" alt="">
                        </div>
                        <div class="faq-main-image">
                            <img src="{{ asset('site_assets') }}/images/resources/faq-main-image.jpg" alt="">
                            <div class="box zoominout"></div>
                        </div>
                        <div class="faq-bottom">
                            <img src="{{ asset('site_assets') }}/images/resources/faq-bottom-image.jpg" alt="">
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="faq-left-content style2">
                        <div class="sec-title">
                            <h5>//<span>Faq</span>//</h5>
                            <h2>Get Every Answer<br>From Here<span class="round-box zoominout"></span></h2>
                        </div>
                        <div class="accordion-box style2">
                            <!--Start single accordion box-->
                            <div class="accordion accordion-block">
                                <div class="accord-btn">
                                    <h4>How can i install this theme?</h4>
                                </div>
                                <div class="accord-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                        exercitation ullamco laboris.</p>
                                </div>
                            </div>
                            <!--End single accordion box-->
                            <!--Start single accordion box-->
                            <div class="accordion accordion-block">
                                <div class="accord-btn active">
                                    <h4>What is terms & conditions?</h4>
                                </div>
                                <div class="accord-content collapsed">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                        exercitation ullamco laboris.</p>
                                </div>
                            </div>
                            <!--End single accordion box-->
                            <!--Start single accordion box-->
                            <div class="accordion accordion-block">
                                <div class="accord-btn">
                                    <h4>How can i make change on this theme?</h4>
                                </div>
                                <div class="accord-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                        exercitation ullamco laboris.</p>
                                </div>
                            </div>
                            <!--End single accordion box-->

                            <!--Start single accordion box-->
                            <div class="accordion accordion-block mar0">
                                <div class="accord-btn">
                                    <h4>What is your payment system?</h4>
                                </div>
                                <div class="accord-content">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                        exercitation ullamco laboris.</p>
                                </div>
                            </div>
                            <!--End single accordion box-->
                        </div>

                    </div>
                </div>



            </div>
        </div>
    </section>
    <!--End Faq Style1 Area-->

    <!--Start thm form box style1 area-->
    <section class="thm-formbox-style1-area style2">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="thm-formbox-style1">
                        <form name="thm_form1" class="thm-formbox1" action="#" method="post">
                            <div class="row">
                                <div class="col-xl-3 col-lg-3">
                                    <div class="input-box">
                                        <input type="text" name="form_search_area_name" value=""
                                            placeholder="Search Area Name" required="">
                                        <div class="icon">
                                            <span class="icon-search"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3">
                                    <div class="input-box">
                                        <select class="selectpicker" data-width="100%">
                                            <option selected="selected">Select Doctor</option>
                                            <option>Rosalina D. William</option>
                                            <option>Miranda H. Halim</option>
                                            <option>Hilixer D. Browni</option>
                                            <option>Yokolili Y. Yankee</option>
                                        </select>
                                        <div class="icon">
                                            <span class="icon-user"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3">
                                    <div class="input-box">
                                        <select class="selectpicker" data-width="100%">
                                            <option selected="selected">Select Service</option>
                                            <option>Pet Grooming</option>
                                            <option>Dog Setting</option>
                                            <option>Healthy Meals</option>
                                            <option>Veterinary Service</option>
                                        </select>
                                        <div class="icon">
                                            <span class="icon-dog-1"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3">
                                    <div class="button-box">
                                        <button class="btn-one" type="submit" data-loading-text="Please wait...">
                                            <span class="txt">Search & Book Now</span>
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End thm form box style1 area-->

    <!--Start Blog Style1 Area-->
    <section class="blog-style1-area">
        <div class="container">
            <div class="sec-title">
                <h5>//<span>Insights</span>//</h5>
                <h2>News & Feeds<span class="round-box zoominout"></span></h2>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="blog-carousel owl-carousel owl-theme owl-nav-style-one">
                        <!--Start Single blog Style1-->
                        <div class="single-blog-style1 wow fadeInLeft" data-wow-delay="100ms" data-wow-duration="1500ms">
                            <div class="img-holder">
                                <div class="date-box">
                                    <h5>24th June 2020</h5>
                                </div>
                                <div class="inner">
                                    <img src="{{ asset('site_assets') }}/images/blog/blog-v1-1.jpg" alt="Awesome Image">
                                </div>
                            </div>
                            <div class="text-holder">
                                <ul class="meta-info">
                                    <li><span class="icon-user"></span><a href="#">By Admin</a></li>
                                    <li><span class="icon-tag"></span><a href="#">Pet, Care, Medicine</a></li>
                                </ul>
                                <h3 class="blog-title"><a href="blog-single.html">Share five inspirational Quotes of the Day
                                        with friends<span class="round-box zoominout"></span></a></h3>
                            </div>
                        </div>
                        <!--End Single blog Style1-->
                        <!--Start Single blog Style1-->
                        <div class="single-blog-style1 wow fadeInLeft" data-wow-delay="100ms" data-wow-duration="1500ms">
                            <div class="img-holder">
                                <div class="date-box">
                                    <h5>24th June 2020</h5>
                                </div>
                                <div class="inner">
                                    <img src="{{ asset('site_assets') }}/images/blog/blog-v1-2.jpg" alt="Awesome Image">
                                </div>
                            </div>
                            <div class="text-holder">
                                <ul class="meta-info">
                                    <li><span class="icon-user"></span><a href="#">By Admin</a></li>
                                    <li><span class="icon-tag"></span><a href="#">Pet, Care, Medicine</a></li>
                                </ul>
                                <h3 class="blog-title"><a href="blog-single.html">Share five inspirational Quotes of the Day
                                        with friends<span class="round-box zoominout"></span></a></h3>
                            </div>
                        </div>
                        <!--End Single blog Style1-->
                        <!--Start Single blog Style1-->
                        <div class="single-blog-style1 wow fadeInLeft" data-wow-delay="100ms" data-wow-duration="1500ms">
                            <div class="img-holder">
                                <div class="date-box">
                                    <h5>24th June 2020</h5>
                                </div>
                                <div class="inner">
                                    <img src="{{ asset('site_assets') }}/images/blog/blog-v1-3.jpg" alt="Awesome Image">
                                </div>
                            </div>
                            <div class="text-holder">
                                <ul class="meta-info">
                                    <li><span class="icon-user"></span><a href="#">By Admin</a></li>
                                    <li><span class="icon-tag"></span><a href="#">Pet, Care, Medicine</a></li>
                                </ul>
                                <h3 class="blog-title"><a href="blog-single.html">Share five inspirational Quotes of the Day
                                        with friends<span class="round-box zoominout"></span></a></h3>
                            </div>
                        </div>
                        <!--End Single blog Style1-->

                        <!--Start Single blog Style1-->
                        <div class="single-blog-style1 wow fadeInLeft" data-wow-delay="100ms" data-wow-duration="1500ms">
                            <div class="img-holder">
                                <div class="date-box">
                                    <h5>24th June 2020</h5>
                                </div>
                                <div class="inner">
                                    <img src="{{ asset('site_assets') }}/images/blog/blog-v1-1.jpg" alt="Awesome Image">
                                </div>
                            </div>
                            <div class="text-holder">
                                <ul class="meta-info">
                                    <li><span class="icon-user"></span><a href="#">By Admin</a></li>
                                    <li><span class="icon-tag"></span><a href="#">Pet, Care, Medicine</a></li>
                                </ul>
                                <h3 class="blog-title"><a href="blog-single.html">Share five inspirational Quotes of the Day
                                        with friends<span class="round-box zoominout"></span></a></h3>
                            </div>
                        </div>
                        <!--End Single blog Style1-->
                        <!--Start Single blog Style1-->
                        <div class="single-blog-style1 wow fadeInLeft" data-wow-delay="100ms" data-wow-duration="1500ms">
                            <div class="img-holder">
                                <div class="date-box">
                                    <h5>24th June 2020</h5>
                                </div>
                                <div class="inner">
                                    <img src="{{ asset('site_assets') }}/images/blog/blog-v1-2.jpg" alt="Awesome Image">
                                </div>
                            </div>
                            <div class="text-holder">
                                <ul class="meta-info">
                                    <li><span class="icon-user"></span><a href="#">By Admin</a></li>
                                    <li><span class="icon-tag"></span><a href="#">Pet, Care, Medicine</a></li>
                                </ul>
                                <h3 class="blog-title"><a href="blog-single.html">Share five inspirational Quotes of the Day
                                        with friends<span class="round-box zoominout"></span></a></h3>
                            </div>
                        </div>
                        <!--End Single blog Style1-->
                        <!--Start Single blog Style1-->
                        <div class="single-blog-style1 wow fadeInLeft" data-wow-delay="100ms" data-wow-duration="1500ms">
                            <div class="img-holder">
                                <div class="date-box">
                                    <h5>24th June 2020</h5>
                                </div>
                                <div class="inner">
                                    <img src="{{ asset('site_assets') }}/images/blog/blog-v1-3.jpg" alt="Awesome Image">
                                </div>
                            </div>
                            <div class="text-holder">
                                <ul class="meta-info">
                                    <li><span class="icon-user"></span><a href="#">By Admin</a></li>
                                    <li><span class="icon-tag"></span><a href="#">Pet, Care, Medicine</a></li>
                                </ul>
                                <h3 class="blog-title"><a href="blog-single.html">Share five inspirational Quotes of the Day
                                        with friends<span class="round-box zoominout"></span></a></h3>
                            </div>
                        </div>
                        <!--End Single blog Style1-->



                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Blog Style1 Area-->



@endsection