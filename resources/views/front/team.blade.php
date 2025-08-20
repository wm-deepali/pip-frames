@extends('layouts.new-master')

@section('title')
    Team || CarePress
@endsection

@section('content')

<!--Start breadcrumb area-->
<section class="breadcrumb-area"
    style="background-image: url({{ asset('site_assets') }}/images/breadcrumb/breadcrumb-1.png);">
    <div class="banner-curve"></div>
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="inner-content clearfix text-center">
                    <div class="title wow slideInUp animated" data-wow-delay="0.3s" data-wow-duration="1500ms">
                        <h2>Our Team<span class="dotted"></span></h2>
                    </div>
                    <div class="breadcrumb-menu wow slideInDown animated" data-wow-delay="0.3s"
                        data-wow-duration="1500ms">
                        <ul class="clearfix">
                            <li><a href="index-2.html">Home</a></li>
                            <li class="active">Team</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End breadcrumb area-->

<!--Start Team Page Area-->
<section class="team-page-area">
    <div class="container">
        <div class="row">
            <!--Start Single Filter Box-->
            <div class="col-xl-2 col-lg-4 col-md-4">
                <div class="single-filter-box text-center">
                    <span class="icon-coach"></span>
                    <h3>Trainer</h3>
                </div>
            </div>
            <!--End Single Filter Box-->
            <!--Start Single Filter Box-->
            <div class="col-xl-2 col-lg-4 col-md-4">
                <div class="single-filter-box text-center">
                    <span class="icon-stethoscope"></span>
                    <h3>Pet Expert</h3>
                </div>
            </div>
            <!--End Single Filter Box-->
            <!--Start Single Filter Box-->
            <div class="col-xl-2 col-lg-4 col-md-4">
                <div class="single-filter-box text-center">
                    <span class="icon-vet"></span>
                    <h3>Groomer</h3>
                </div>
            </div>
            <!--End Single Filter Box-->
            <!--Start Single Filter Box-->
            <div class="col-xl-2 col-lg-4 col-md-4">
                <div class="single-filter-box text-center">
                    <span class="icon-flask"></span>
                    <h3>Nutrition</h3>
                </div>
            </div>
            <!--End Single Filter Box-->
            <!--Start Single Filter Box-->
            <div class="col-xl-2 col-lg-4 col-md-4">
                <div class="single-filter-box text-center">
                    <span class="icon-veterinarian"></span>
                    <h3>Doctor</h3>
                </div>
            </div>
            <!--End Single Filter Box-->
            <!--Start Single Filter Box-->
            <div class="col-xl-2 col-lg-4 col-md-4">
                <div class="single-filter-box text-center">
                    <span class="icon-telemarketing"></span>
                    <h3>Support</h3>
                </div>
            </div>
            <!--End Single Filter Box-->
        </div>
        <div class="row team-page-content">
            <!--Start Single Team Member-->
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="single-team-member style2 wow animated fadeInUp" data-wow-delay="0.1s">
                    <div class="img-holder">
                        <div class="round-top"></div>
                        <div class="round-bottom"></div>
                        <div class="inner">
                            <img src="{{ asset('site_assets') }}/images/team/team-v1-1.png" alt="Awesome Image">
                            <div class="overlay-style-one bg1"></div>
                        </div>
                    </div>
                    <div class="title-holder text-center">
                        <h5>Founder</h5>
                        <h3><a href="#">Rosalina D. William</a></h3>
                        <div class="team-social-link">
                            <ul>
                                <li>
                                    <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                </li>
                                <li>
                                    <a class="tw" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                </li>
                                <li>
                                    <a class="linkedin" href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Single Team Member-->
            <!--Start Single Team Member-->
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="single-team-member style2 wow animated fadeInUp" data-wow-delay="0.1s">
                    <div class="img-holder">
                        <div class="round-top"></div>
                        <div class="round-bottom"></div>
                        <div class="inner">
                            <img src="{{ asset('site_assets') }}/images/team/team-v1-2.png" alt="Awesome Image">
                            <div class="overlay-style-one bg2"></div>
                        </div>
                    </div>
                    <div class="title-holder text-center">
                        <h5>CEO</h5>
                        <h3><a href="#">Miranda H. Halim</a></h3>
                        <div class="team-social-link">
                            <ul>
                                <li>
                                    <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                </li>
                                <li>
                                    <a class="tw" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                </li>
                                <li>
                                    <a class="linkedin" href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Single Team Member-->
            <!--Start Single Team Member-->
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="single-team-member style2 wow animated fadeInUp" data-wow-delay="0.1s">
                    <div class="img-holder">
                        <div class="round-top"></div>
                        <div class="round-bottom"></div>
                        <div class="inner">
                            <img src="{{ asset('site_assets') }}/images/team/team-v1-3.png" alt="Awesome Image">
                            <div class="overlay-style-one bg2"></div>
                        </div>
                    </div>
                    <div class="title-holder text-center">
                        <h5>Groomer</h5>
                        <h3><a href="#">Hilixer D. Browni</a></h3>
                        <div class="team-social-link">
                            <ul>
                                <li>
                                    <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                </li>
                                <li>
                                    <a class="tw" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                </li>
                                <li>
                                    <a class="linkedin" href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Single Team Member-->
            <!--Start Single Team Member-->
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="single-team-member style2 wow animated fadeInUp" data-wow-delay="0.1s">
                    <div class="img-holder">
                        <div class="round-top"></div>
                        <div class="round-bottom"></div>
                        <div class="inner">
                            <img src="{{ asset('site_assets') }}/images/team/team-v1-4.png" alt="Awesome Image">
                            <div class="overlay-style-one bg2"></div>
                        </div>
                    </div>
                    <div class="title-holder text-center">
                        <h5>Groomer</h5>
                        <h3><a href="#">Yokolili Y. Yankee</a></h3>
                        <div class="team-social-link">
                            <ul>
                                <li>
                                    <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                </li>
                                <li>
                                    <a class="tw" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                </li>
                                <li>
                                    <a class="linkedin" href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Single Team Member-->
        </div>
    </div>
</section>
<!--End Team Page Area-->

<!--Start Testimonial style1 Area-->
<section class="testimonial-style1-area">
    <div class="image-box1"><img src="{{ asset('site_assets') }}/images/testimonial/testimonial-image-1.png" alt="">
    </div>
    <div class="image-box2"><img src="{{ asset('site_assets') }}/images/testimonial/testimonial-image-2.png" alt="">
    </div>
    <div class="image-box3 paroller"><img src="{{ asset('site_assets') }}/images/testimonial/testimonial-image-3.png"
            alt=""></div>
    <div class="image-box4 paroller"><img src="{{ asset('site_assets') }}/images/testimonial/testimonial-image-4.png"
            alt=""></div>
    <div class="layer-outer" style="background-image: url({{ asset('site_assets') }}/images/resources/map.png)"></div>
    <div class="container">
        <div class="sec-title text-center">
            <div class="icon">
                <i class="icon-bone"></i>
            </div>
            <h2>Clients Feedback<span class="round-box zoominout"></span></h2>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="testimonial-carousel owl-carousel owl-theme">
                    <!--Start Single Testimonial Style1-->
                    <div class="single-testimonial-style1  wow fadeInUp" data-wow-delay="100ms"
                        data-wow-duration="1500ms">
                        <div class="img-holder">
                            <img src="{{ asset('site_assets') }}/images/testimonial/tes-v1-1.png" alt="Awesome Image">
                        </div>
                        <div class="text-holder">
                            <h2>Miranda H. Halim</h2>
                            <span>Founder, Miranda Family</span>
                            <div class="text-box">
                                <p>One thing is clear though: taking a proactive approach to collecting customer
                                    feedback ensures you never stray too far from the needs of your community, even as
                                    those needs evolve.</p>
                            </div>
                        </div>
                    </div>
                    <!--End Single Testimonial Style1-->
                    <!--Start Single Testimonial Style1-->
                    <div class="single-testimonial-style1  wow fadeInUp" data-wow-delay="100ms"
                        data-wow-duration="1500ms">
                        <div class="img-holder">
                            <img src="{{ asset('site_assets') }}/images/testimonial/tes-v1-1.png" alt="Awesome Image">
                        </div>
                        <div class="text-holder">
                            <h2>Miranda H. Halim</h2>
                            <span>Founder, Miranda Family</span>
                            <div class="text-box">
                                <p>One thing is clear though: taking a proactive approach to collecting customer
                                    feedback ensures you never stray too far from the needs of your community, even as
                                    those needs evolve.</p>
                            </div>
                        </div>
                    </div>
                    <!--End Single Testimonial Style1-->

                </div>
            </div>
        </div>
    </div>
</section>
<!--End Testimonial Style1 Area-->

@endsection