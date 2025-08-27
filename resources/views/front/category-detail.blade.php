@extends('layouts.new-master')

@section('title')
    Home
@endsection

<style>
    .select-area-inputs input {
width: 100%;
padding: 8px;
margin-top: 4px;
box-sizing: border-box;
border: 2px solid #eeeeee;
border-radius: 8px;
}

    #preview-container img {
        margin-right: 8px;
        margin-top: 8px;
    }

    .col-area input[readonly] {
        color: #1d2124;
        font-weight: bold;
        padding: 8px;
        margin-top: 4px;
    }

    .colour-swatch {
        display: inline-block;
        vertical-align: middle;
    }

    /* Hide the native radio button */
.custom-radio input[type="radio"] {
  display: none;
}

/* Create a custom radio look */
.custom-radio label {
  display: flex;
  align-items: center;
  cursor: pointer;
  padding: 8px 12px;
  border: 1px solid #ccc;
  border-radius: 20px;
  margin-bottom: 10px;
  transition: background-color 0.3s, border-color 0.3s;
}

/* The circle for radio */
.custom-radio label::before {
  content: "";
  display: inline-block;
  width: 18px;
  height: 18px;
  margin-right: 10px;
  border: 2px solid #ccc;
  border-radius: 50%;
  box-sizing: border-box;
}

/* Checked state */
.custom-radio input[type="radio"]:checked + label {
  background-color: #ff3b7c;
  border-color: #ff3b7c;
  color: white;
}

.custom-radio input[type="radio"]:checked + label::before {
  border-color: white;
  background-color: white;
}

</style>
@section('content')

    @include('front.calculator')


    <!-- End Main Slider paroller -->

    <!--Start Featured Area-->
    <!--<section class="featured-area">-->
    <!--    <div class="container">-->
    <!--        <div class="row">-->
                <!--Start Single Featured Box-->
    <!--            <div class="col-xl-4">-->
    <!--                <div class="single-featured-box">-->
    <!--                    <div class="inner">-->
    <!--                        <div class="icon">-->
    <!--                            <span class="icon-dog"></span>-->
    <!--                        </div>-->
    <!--                        <div class="text">-->
    <!--                            <h3>Dog Boarding</h3>-->
    <!--                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
                <!--End Single Featured Box-->
                <!--Start Single Featured Box-->
    <!--            <div class="col-xl-4">-->
    <!--                <div class="single-featured-box">-->
    <!--                    <div class="inner">-->
    <!--                        <div class="icon">-->
    <!--                            <span class="icon-dog-food clr2"></span>-->
    <!--                        </div>-->
    <!--                        <div class="text">-->
    <!--                            <h3>Dog Boarding</h3>-->
    <!--                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
                <!--End Single Featured Box-->
                <!--Start Single Featured Box-->
    <!--            <div class="col-xl-4">-->
    <!--                <div class="single-featured-box">-->
    <!--                    <div class="inner">-->
    <!--                        <div class="icon">-->
    <!--                            <span class="icon-pet-bowl clr3"></span>-->
    <!--                        </div>-->
    <!--                        <div class="text">-->
    <!--                            <h3>Pet Adoption</h3>-->
    <!--                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
                <!--End Single Featured Box-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!--End Featured Area-->

    <!--Start About Style1 Area-->
    <!--<section class="about-style1-area">-->
    <!--    <div class="container">-->
    <!--        <div class="row">-->
    <!--            <div class="col-xl-7">-->
    <!--                <div class="about-style1-image-box">-->
    <!--                    <div class="about-style1-image-box-bg"-->
    <!--                        style="background-image: url({{ asset('site_assets') }}/images/shape/about-style1-image-box-bg.png)">-->
    <!--                    </div>-->
    <!--                    <div class="main-image">-->
    <!--                        <img src="{{ asset('site_assets') }}/images/about/about-1.png" alt="Awesome Image">-->
    <!--                    </div>-->
    <!--                    <div class="about-experience-box">-->
    <!--                        <div class="count-box">-->
    <!--                            <h2>-->
    <!--                                <span class="timer" data-from="1" data-to="20" data-speed="5000"-->
    <!--                                    data-refresh-interval="50">1020</span>-->
    <!--                                <span class="icon-plus plus-icon"></span>-->
    <!--                            </h2>-->
    <!--                            <h5>Years Experience</h5>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->

    <!--            <div class="col-xl-5">-->
    <!--                <div class="about-style1-content-box">-->
    <!--                    <div class="sec-title">-->
    <!--                        <h5>//<span>About Us</span>//</h5>-->
    <!--                        <h2>Best Agency For<br> Your Pet<span class="round-box zoominout"></span></h2>-->
    <!--                    </div>-->
    <!--                    <div class="inner-content">-->
    <!--                        <div class="text">-->
    <!--                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor-->
    <!--                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud-->
    <!--                                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure-->
    <!--                                dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.-->
    <!--                                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt-->
    <!--                                mollit.</p>-->
    <!--                        </div>-->
    <!--                        <div class="row">-->
    <!--                            <div class="col-xl-6">-->
    <!--                                <ul>-->
    <!--                                    <li>-->
    <!--                                        <div class="icon">-->
    <!--                                            <span class="icon-tick"></span>-->
    <!--                                        </div>-->
    <!--                                        <div class="title">-->
    <!--                                            <h5>Certified Groomer</h5>-->
    <!--                                        </div>-->
    <!--                                    </li>-->
    <!--                                </ul>-->
    <!--                            </div>-->
    <!--                            <div class="col-xl-6">-->
    <!--                                <ul>-->
    <!--                                    <li>-->
    <!--                                        <div class="icon">-->
    <!--                                            <span class="icon-tick"></span>-->
    <!--                                        </div>-->
    <!--                                        <div class="title">-->
    <!--                                            <h5>Animal Lover</h5>-->
    <!--                                        </div>-->
    <!--                                    </li>-->
    <!--                                </ul>-->
    <!--                            </div>-->
    <!--                            <div class="col-xl-6">-->
    <!--                                <ul>-->
    <!--                                    <li>-->
    <!--                                        <div class="icon">-->
    <!--                                            <span class="icon-tick"></span>-->
    <!--                                        </div>-->
    <!--                                        <div class="title">-->
    <!--                                            <h5>14+ Years Experience</h5>-->
    <!--                                        </div>-->
    <!--                                    </li>-->
    <!--                                </ul>-->
    <!--                            </div>-->
    <!--                            <div class="col-xl-6">-->
    <!--                                <ul>-->
    <!--                                    <li>-->
    <!--                                        <div class="icon">-->
    <!--                                            <span class="icon-tick"></span>-->
    <!--                                        </div>-->
    <!--                                        <div class="title">-->
    <!--                                            <h5>Pet Parent Of 3 Dogs</h5>-->
    <!--                                        </div>-->
    <!--                                    </li>-->
    <!--                                </ul>-->
    <!--                            </div>-->

    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->

    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!--End About Style1 Area-->

    <!-- Start Service Style1 Area -->
    <!--<section class="service-style1-area">-->
    <!--    <div class="shape1">-->
    <!--        <img src="{{ asset('site_assets') }}/images/shape/shape-1.png" alt="">-->
    <!--    </div>-->
    <!--    <div class="shape2">-->
    <!--        <img src="{{ asset('site_assets') }}/images/shape/shape-2.png" alt="">-->
    <!--    </div>-->
    <!--    <div class="container">-->
    <!--        <div class="sec-title text-center">-->
    <!--            <div class="icon">-->
    <!--                <i class="icon-bone"></i>-->
    <!--            </div>-->
    <!--            <h2>What We Do<span class="round-box zoominout"></span></h2>-->
    <!--        </div>-->
    <!--        <div class="row">-->
                <!--Start Single Service Style1-->
    <!--            <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">-->
    <!--                <div class="single-service-style1">-->
    <!--                    <div class="img-holder">-->
    <!--                        <div class="inner">-->
    <!--                            <img src="{{ asset('site_assets') }}/images/services/service-v1-1.jpg" alt="">-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="text-holder">-->
    <!--                        <h3><a href="#">Pet Grooming</a></h3>-->
    <!--                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor. </p>-->
    <!--                        <div class="button">-->
    <!--                            <a href="#">Read More</a>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
                <!--End Single Service Style1-->
                <!--Start Single Service Style1-->
    <!--            <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay="100ms" data-wow-duration="1500ms">-->
    <!--                <div class="single-service-style1">-->
    <!--                    <div class="img-holder">-->
    <!--                        <div class="inner">-->
    <!--                            <img src="{{ asset('site_assets') }}/images/services/service-v1-2.jpg" alt="">-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="text-holder">-->
    <!--                        <h3><a href="#">Dog Setting</a></h3>-->
    <!--                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor. </p>-->
    <!--                        <div class="button">-->
    <!--                            <a href="#">Read More</a>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
                <!--End Single Service Style1-->
                <!--Start Single Service Style1-->
    <!--            <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">-->
    <!--                <div class="single-service-style1">-->
    <!--                    <div class="img-holder">-->
    <!--                        <div class="inner">-->
    <!--                            <img src="{{ asset('site_assets') }}/images/services/service-v1-3.jpg" alt="">-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="text-holder">-->
    <!--                        <h3><a href="#">Healthy Meals</a></h3>-->
    <!--                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor. </p>-->
    <!--                        <div class="button">-->
    <!--                            <a href="#">Read More</a>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
                <!--End Single Service Style1-->
                <!--Start Single Service Style1-->
    <!--            <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInRight" data-wow-delay="100ms" data-wow-duration="1500ms">-->
    <!--                <div class="single-service-style1">-->
    <!--                    <div class="img-holder">-->
    <!--                        <div class="inner">-->
    <!--                            <img src="{{ asset('site_assets') }}/images/services/service-v1-4.jpg" alt="">-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="text-holder">-->
    <!--                        <h3><a href="#">Veterinary Service</a></h3>-->
    <!--                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor. </p>-->
    <!--                        <div class="button">-->
    <!--                            <a href="#">Read More</a>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
                <!--End Single Service Style1-->

    <!--        </div>-->

    <!--    </div>-->
    <!--</section>-->
    <!-- End Service Style1 Area -->

    <!--Start Video Gallery Area-->
    <!--<section class="video-gallery-area">-->
    <!--    <div class="container-fullwidth">-->
    <!--        <div class="row">-->
    <!--            <div class="col-xl-6">-->
    <!--                <div class="video-gallery-content-box text-center">-->
    <!--                    <img src="{{ asset('site_assets') }}/images/resources/video-gallery-image.png" alt="">-->
    <!--                    <h2>Get Every Pet<br> Food & Toods Here.</h2>-->
    <!--                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut-->
    <!--                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco-->
    <!--                        laboris nisi ut aliquip.</p>-->
    <!--                    <div class="button">-->
    <!--                        <a class="btn-one" href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span-->
    <!--                                class="txt">Shop Now</span></a>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->

    <!--            <div class="col-xl-6">-->
    <!--                <div class="video-holder-box text-center"-->
    <!--                    style="background-image: url({{ asset('site_assets') }}/images/resources/video-gallery-bg.jpg)">-->
    <!--                    <div class="icon wow zoomIn" data-wow-delay="300ms" data-wow-duration="1500ms">-->
    <!--                        <a class="video-popup thm-bgclr" title="CarePress Video Gallery"-->
    <!--                            href="https://www.youtube.com/watch?v=p25gICT63ek">-->
    <!--                            <span class="icon-play-button"></span>-->
    <!--                        </a>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->

    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!--End Video Gallery Area-->

    <!--Start Feautres Area-->
    <!--<section class="feautres-area">-->
    <!--    <div class="container">-->
    <!--        <div class="row">-->

    <!--            <div class="col-xl-6">-->
    <!--                <div class="working-hours-box"-->
    <!--                    style="background-image: url({{ asset('site_assets') }}/images/resources/working-hours-box-bg.jpg)">-->
    <!--                    <div class="inner-content">-->
    <!--                        <div class="title">-->
    <!--                            <h3>Working Hours<span></span></h3>-->
    <!--                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor-->
    <!--                                incididunt.</p>-->
    <!--                        </div>-->
    <!--                        <ul>-->
    <!--                            <li><span class="left">Monday</span> <span class="right">08AM - 10PM</span></li>-->
    <!--                            <li><span class="left">Thuesday</span> <span class="right">08AM - 10PM</span></li>-->
    <!--                            <li><span class="left">Wednesday</span> <span class="right">08AM - 10PM</span></li>-->
    <!--                            <li><span class="left">Thursday</span> <span class="right">08AM - 10PM</span></li>-->
    <!--                            <li><span class="left">Friday</span> <span class="right">08AM - 10PM</span></li>-->
    <!--                            <li><span class="left">Saturday</span> <span class="right">08AM - 10PM</span></li>-->
    <!--                            <li><span class="left">Sunday</span> <span class="right holiday">Holiday</span></li>-->
    <!--                        </ul>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->

    <!--            <div class="col-xl-6">-->
    <!--                <div class="feautres-content-box">-->
    <!--                    <div class="sec-title">-->
    <!--                        <h5>//<span>Feautres</span>//</h5>-->
    <!--                        <h2>Core Level Features<span class="round-box zoominout"></span></h2>-->
    <!--                    </div>-->
    <!--                    <div class="inner-content">-->
    <!--                        <div class="text">-->
    <!--                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor-->
    <!--                                incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud-->
    <!--                                exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>-->
    <!--                        </div>-->

    <!--                        <ul class="top">-->
    <!--                            <li>-->
    <!--                                <div class="inner">-->
    <!--                                    <div class="icon">-->
    <!--                                        <span class="icon-vet"></span>-->
    <!--                                    </div>-->
    <!--                                    <div class="title">-->
    <!--                                        <h3>Pet Care</h3>-->
    <!--                                        <p>Get a solid solution</p>-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                            </li>-->
    <!--                            <li>-->
    <!--                                <div class="inner">-->
    <!--                                    <div class="icon">-->
    <!--                                        <span class="icon-injection"></span>-->
    <!--                                    </div>-->
    <!--                                    <div class="title">-->
    <!--                                        <h3>Pet Medicine</h3>-->
    <!--                                        <p>Get a solid solution</p>-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                            </li>-->
    <!--                        </ul>-->

    <!--                        <ul class="bottom">-->
    <!--                            <li>-->
    <!--                                <div class="inner">-->
    <!--                                    <div class="icon">-->
    <!--                                        <span class="icon-veterinary"></span>-->
    <!--                                    </div>-->
    <!--                                    <div class="title">-->
    <!--                                        <h3>Grooming</h3>-->
    <!--                                        <p>Get a solid solution</p>-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                            </li>-->
    <!--                            <li>-->
    <!--                                <div class="inner">-->
    <!--                                    <div class="icon">-->
    <!--                                        <span class="icon-vaccine"></span>-->
    <!--                                    </div>-->
    <!--                                    <div class="title">-->
    <!--                                        <h3>Monthly Care</h3>-->
    <!--                                        <p>Get a solid solution</p>-->
    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                            </li>-->
    <!--                        </ul>-->

    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->

    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!--End Feautres Area-->

    <!--Start Team Area-->
    <!--<section class="team-area">-->
    <!--    <div class="container">-->
    <!--        <div class="sec-title text-center">-->
    <!--            <div class="icon">-->
    <!--                <i class="icon-bone"></i>-->
    <!--            </div>-->
    <!--            <h2>Our Groomers<span class="round-box zoominout"></span></h2>-->
    <!--        </div>-->
    <!--        <div class="row">-->
                <!--Start Single Team Member-->
    <!--            <div class="col-xl-3 col-lg-6 col-md-6">-->
    <!--                <div class="single-team-member wow animated fadeInUp" data-wow-delay="0.1s">-->
    <!--                    <div class="img-holder">-->
    <!--                        <div class="round-top"></div>-->
    <!--                        <div class="round-bottom"></div>-->
    <!--                        <div class="inner">-->
    <!--                            <img src="{{ asset('site_assets') }}/images/team/team-v1-1.png" alt="Awesome Image">-->
    <!--                            <div class="overlay-style-one bg1"></div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="title-holder text-center">-->
    <!--                        <h5>Founder</h5>-->
    <!--                        <h3><a href="#">Rosalina D. William</a></h3>-->
    <!--                        <div class="team-social-link">-->
    <!--                            <ul>-->
    <!--                                <li>-->
    <!--                                    <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>-->
    <!--                                </li>-->
    <!--                                <li>-->
    <!--                                    <a class="tw" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>-->
    <!--                                </li>-->
    <!--                                <li>-->
    <!--                                    <a class="linkedin" href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>-->
    <!--                                </li>-->
    <!--                            </ul>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
                <!--End Single Team Member-->
                <!--Start Single Team Member-->
    <!--            <div class="col-xl-3 col-lg-6 col-md-6">-->
    <!--                <div class="single-team-member wow animated fadeInUp" data-wow-delay="0.3s">-->
    <!--                    <div class="img-holder">-->
    <!--                        <div class="round-top"></div>-->
    <!--                        <div class="round-bottom"></div>-->
    <!--                        <div class="inner">-->
    <!--                            <img src="{{ asset('site_assets') }}/images/team/team-v1-2.png" alt="Awesome Image">-->
    <!--                            <div class="overlay-style-one bg2"></div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="title-holder text-center">-->
    <!--                        <h5>CEO</h5>-->
    <!--                        <h3><a href="#">Miranda H. Halim</a></h3>-->
    <!--                        <div class="team-social-link">-->
    <!--                            <ul>-->
    <!--                                <li>-->
    <!--                                    <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>-->
    <!--                                </li>-->
    <!--                                <li>-->
    <!--                                    <a class="tw" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>-->
    <!--                                </li>-->
    <!--                                <li>-->
    <!--                                    <a class="linkedin" href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>-->
    <!--                                </li>-->
    <!--                            </ul>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
                <!--End Single Team Member-->
                <!--Start Single Team Member-->
    <!--            <div class="col-xl-3 col-lg-6 col-md-6">-->
    <!--                <div class="single-team-member wow animated fadeInUp" data-wow-delay="0.5s">-->
    <!--                    <div class="img-holder">-->
    <!--                        <div class="round-top"></div>-->
    <!--                        <div class="round-bottom"></div>-->
    <!--                        <div class="inner">-->
    <!--                            <img src="{{ asset('site_assets') }}/images/team/team-v1-3.png" alt="Awesome Image">-->
    <!--                            <div class="overlay-style-one bg2"></div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="title-holder text-center">-->
    <!--                        <h5>Groomer</h5>-->
    <!--                        <h3><a href="#">Hilixer D. Browni</a></h3>-->
    <!--                        <div class="team-social-link">-->
    <!--                            <ul>-->
    <!--                                <li>-->
    <!--                                    <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>-->
    <!--                                </li>-->
    <!--                                <li>-->
    <!--                                    <a class="tw" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>-->
    <!--                                </li>-->
    <!--                                <li>-->
    <!--                                    <a class="linkedin" href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>-->
    <!--                                </li>-->
    <!--                            </ul>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
                <!--End Single Team Member-->
                <!--Start Single Team Member-->
    <!--            <div class="col-xl-3 col-lg-6 col-md-6">-->
    <!--                <div class="single-team-member wow animated fadeInUp" data-wow-delay="0.7s">-->
    <!--                    <div class="img-holder">-->
    <!--                        <div class="round-top"></div>-->
    <!--                        <div class="round-bottom"></div>-->
    <!--                        <div class="inner">-->
    <!--                            <img src="{{ asset('site_assets') }}/images/team/team-v1-4.png" alt="Awesome Image">-->
    <!--                            <div class="overlay-style-one bg2"></div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                    <div class="title-holder text-center">-->
    <!--                        <h5>Groomer</h5>-->
    <!--                        <h3><a href="#">Yokolili Y. Yankee</a></h3>-->
    <!--                        <div class="team-social-link">-->
    <!--                            <ul>-->
    <!--                                <li>-->
    <!--                                    <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>-->
    <!--                                </li>-->
    <!--                                <li>-->
    <!--                                    <a class="tw" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>-->
    <!--                                </li>-->
    <!--                                <li>-->
    <!--                                    <a class="linkedin" href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>-->
    <!--                                </li>-->
    <!--                            </ul>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
                <!--End Single Team Member-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!--End Team Area-->

    <!--Start priceing plan Area-->
    <!--<section class="priceing-plan-area">-->
    <!--    <div class="container">-->
    <!--        <div class="row">-->
    <!--            <div class="col-xl-12">-->
    <!--                <div class="sec-title">-->
    <!--                    <h5>//<span>Insights</span>//</h5>-->
    <!--                    <h2>News &amp; Feeds <span class="round-box zoominout"></span></h2>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--        <div class="row">-->
    <!--            <div class="col-xl-12">-->
    <!--                <div class="priceing-plan-content">-->
    <!--                    <div class="priceing-plan-tabs tabs-box">-->

    <!--                        <div class="tab-button-column clearfix">-->
    <!--                            <ul class="tab-buttons clearfix">-->
    <!--                                <li data-tab="#yearly" class="tab-btn active-btn">Yearly</li>-->
    <!--                                <li data-tab="#monthly" class="tab-btn">Monthly</li>-->
    <!--                            </ul>-->
    <!--                        </div>-->

    <!--                        <div class="tabs-content">-->
                                <!--Tab-->
    <!--                            <div class="tab active-tab" id="yearly">-->
    <!--                                <div class="priceing-plan-tab-content">-->
    <!--                                    <div class="row">-->
    <!--                                        <div class="col-xl-4 col-lg-6 col-md-6">-->
    <!--                                            <div class="single-priceing-plan-box">-->
    <!--                                                <div class="top">-->
    <!--                                                    <div class="left pull-left">-->
    <!--                                                        <p>Basic</p>-->
    <!--                                                        <h2>Day Care</h2>-->
    <!--                                                    </div>-->
    <!--                                                    <div class="right pull-right">-->
    <!--                                                        <h2><span>$</span>49</h2>-->
    <!--                                                    </div>-->
    <!--                                                </div>-->
    <!--                                                <ul>-->
    <!--                                                    <li>Single room<span class="icon-tick"></span></li>-->
    <!--                                                    <li>SocialiseExcercise<span class="icon-tick"></span></li>-->
    <!--                                                    <li>Custom Meals<span class="icon-tick"></span></li>-->
    <!--                                                    <li>Spa and Grooming<span class="icon-tick"></span></li>-->
    <!--                                                    <li class="deactive">Excercise 2x<span-->
    <!--                                                            class="icon-tick deactive"></span></li>-->
    <!--                                                    <li class="deactive">Custom Meals<span-->
    <!--                                                            class="icon-tick deactive"></span></li>-->
    <!--                                                    <li class="deactive">Grooming 2x<span-->
    <!--                                                            class="icon-tick deactive"></span></li>-->
    <!--                                                </ul>-->
    <!--                                                <div class="button">-->
    <!--                                                    <a class="btn-one" href="#">-->
    <!--                                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i><span-->
    <!--                                                            class="txt">Purchase Now</span>-->
    <!--                                                    </a>-->
    <!--                                                </div>-->
    <!--                                            </div>-->
    <!--                                        </div>-->

    <!--                                        <div class="col-xl-4 col-lg-6 col-md-6">-->
    <!--                                            <div class="single-priceing-plan-box style2">-->
    <!--                                                <div class="top">-->
    <!--                                                    <div class="left pull-left">-->
    <!--                                                        <p>Exclusive</p>-->
    <!--                                                        <h2>2X Care</h2>-->
    <!--                                                    </div>-->
    <!--                                                    <div class="right pull-right">-->
    <!--                                                        <h2><span>$</span>69</h2>-->
    <!--                                                    </div>-->
    <!--                                                </div>-->
    <!--                                                <ul>-->
    <!--                                                    <li>Single room<span class="icon-tick"></span></li>-->
    <!--                                                    <li>SocialiseExcercise<span class="icon-tick"></span></li>-->
    <!--                                                    <li>Custom Meals<span class="icon-tick"></span></li>-->
    <!--                                                    <li>Spa and Grooming<span class="icon-tick"></span></li>-->
    <!--                                                    <li>Excercise 2x<span class="icon-tick"></span></li>-->
    <!--                                                    <li class="deactive">Custom Meals<span-->
    <!--                                                            class="icon-tick deactive"></span></li>-->
    <!--                                                    <li class="deactive">Grooming 2x<span-->
    <!--                                                            class="icon-tick deactive"></span></li>-->
    <!--                                                </ul>-->
    <!--                                                <div class="button">-->
    <!--                                                    <a class="btn-one" href="#">-->
    <!--                                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i><span-->
    <!--                                                            class="txt">Purchase Now</span>-->
    <!--                                                    </a>-->
    <!--                                                </div>-->
    <!--                                            </div>-->
    <!--                                        </div>-->

    <!--                                        <div class="col-xl-4 col-lg-12 col-md-12">-->
    <!--                                            <div class="single-priceing-plan-box style3">-->
    <!--                                                <div class="top">-->
    <!--                                                    <div class="left pull-left">-->
    <!--                                                        <p>Exclusive</p>-->
    <!--                                                        <h2>2X Care</h2>-->
    <!--                                                    </div>-->
    <!--                                                    <div class="right pull-right">-->
    <!--                                                        <h2><span>$</span>69</h2>-->
    <!--                                                    </div>-->
    <!--                                                </div>-->
    <!--                                                <ul>-->
    <!--                                                    <li>Single room<span class="icon-tick"></span></li>-->
    <!--                                                    <li>SocialiseExcercise<span class="icon-tick"></span></li>-->
    <!--                                                    <li>Custom Meals<span class="icon-tick"></span></li>-->
    <!--                                                    <li>Spa and Grooming<span class="icon-tick"></span></li>-->
    <!--                                                    <li>Excercise 2x<span class="icon-tick"></span></li>-->
    <!--                                                    <li>Custom Meals<span class="icon-tick"></span></li>-->
    <!--                                                    <li>Grooming 2x<span class="icon-tick"></span></li>-->
    <!--                                                </ul>-->
    <!--                                                <div class="button">-->
    <!--                                                    <a class="btn-one" href="#">-->
    <!--                                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i><span-->
    <!--                                                            class="txt">Purchase Now</span>-->
    <!--                                                    </a>-->
    <!--                                                </div>-->
    <!--                                            </div>-->
    <!--                                        </div>-->

    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                            </div>-->

                                <!--Tab-->
    <!--                            <div class="tab" id="monthly">-->
    <!--                                <div class="priceing-plan-tab-content">-->
    <!--                                    <div class="row">-->
    <!--                                        <div class="col-xl-4 col-lg-6 col-md-6">-->
    <!--                                            <div class="single-priceing-plan-box">-->
    <!--                                                <div class="top">-->
    <!--                                                    <div class="left pull-left">-->
    <!--                                                        <p>Basic</p>-->
    <!--                                                        <h2>Day Care</h2>-->
    <!--                                                    </div>-->
    <!--                                                    <div class="right pull-right">-->
    <!--                                                        <h2><span>$</span>49</h2>-->
    <!--                                                    </div>-->
    <!--                                                </div>-->
    <!--                                                <ul>-->
    <!--                                                    <li>Single room<span class="icon-tick"></span></li>-->
    <!--                                                    <li>SocialiseExcercise<span class="icon-tick"></span></li>-->
    <!--                                                    <li>Custom Meals<span class="icon-tick"></span></li>-->
    <!--                                                    <li>Spa and Grooming<span class="icon-tick"></span></li>-->
    <!--                                                    <li class="deactive">Excercise 2x<span-->
    <!--                                                            class="icon-tick deactive"></span></li>-->
    <!--                                                    <li class="deactive">Custom Meals<span-->
    <!--                                                            class="icon-tick deactive"></span></li>-->
    <!--                                                    <li class="deactive">Grooming 2x<span-->
    <!--                                                            class="icon-tick deactive"></span></li>-->
    <!--                                                </ul>-->
    <!--                                                <div class="button">-->
    <!--                                                    <a class="btn-one" href="#">-->
    <!--                                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i><span-->
    <!--                                                            class="txt">Purchase Now</span>-->
    <!--                                                    </a>-->
    <!--                                                </div>-->
    <!--                                            </div>-->
    <!--                                        </div>-->

    <!--                                        <div class="col-xl-4 col-lg-6 col-md-6">-->
    <!--                                            <div class="single-priceing-plan-box style2">-->
    <!--                                                <div class="top">-->
    <!--                                                    <div class="left pull-left">-->
    <!--                                                        <p>Exclusive</p>-->
    <!--                                                        <h2>2X Care</h2>-->
    <!--                                                    </div>-->
    <!--                                                    <div class="right pull-right">-->
    <!--                                                        <h2><span>$</span>69</h2>-->
    <!--                                                    </div>-->
    <!--                                                </div>-->
    <!--                                                <ul>-->
    <!--                                                    <li>Single room<span class="icon-tick"></span></li>-->
    <!--                                                    <li>SocialiseExcercise<span class="icon-tick"></span></li>-->
    <!--                                                    <li>Custom Meals<span class="icon-tick"></span></li>-->
    <!--                                                    <li>Spa and Grooming<span class="icon-tick"></span></li>-->
    <!--                                                    <li>Excercise 2x<span class="icon-tick"></span></li>-->
    <!--                                                    <li class="deactive">Custom Meals<span-->
    <!--                                                            class="icon-tick deactive"></span></li>-->
    <!--                                                    <li class="deactive">Grooming 2x<span-->
    <!--                                                            class="icon-tick deactive"></span></li>-->
    <!--                                                </ul>-->
    <!--                                                <div class="button">-->
    <!--                                                    <a class="btn-one" href="#">-->
    <!--                                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i><span-->
    <!--                                                            class="txt">Purchase Now</span>-->
    <!--                                                    </a>-->
    <!--                                                </div>-->
    <!--                                            </div>-->
    <!--                                        </div>-->

    <!--                                        <div class="col-xl-4 col-lg-12 col-md-12">-->
    <!--                                            <div class="single-priceing-plan-box style3">-->
    <!--                                                <div class="top">-->
    <!--                                                    <div class="left pull-left">-->
    <!--                                                        <p>Exclusive</p>-->
    <!--                                                        <h2>2X Care</h2>-->
    <!--                                                    </div>-->
    <!--                                                    <div class="right pull-right">-->
    <!--                                                        <h2><span>$</span>69</h2>-->
    <!--                                                    </div>-->
    <!--                                                </div>-->
    <!--                                                <ul>-->
    <!--                                                    <li>Single room<span class="icon-tick"></span></li>-->
    <!--                                                    <li>SocialiseExcercise<span class="icon-tick"></span></li>-->
    <!--                                                    <li>Custom Meals<span class="icon-tick"></span></li>-->
    <!--                                                    <li>Spa and Grooming<span class="icon-tick"></span></li>-->
    <!--                                                    <li>Excercise 2x<span class="icon-tick"></span></li>-->
    <!--                                                    <li>Custom Meals<span class="icon-tick"></span></li>-->
    <!--                                                    <li>Grooming 2x<span class="icon-tick"></span></li>-->
    <!--                                                </ul>-->
    <!--                                                <div class="button">-->
    <!--                                                    <a class="btn-one" href="#">-->
    <!--                                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i><span-->
    <!--                                                            class="txt">Purchase Now</span>-->
    <!--                                                    </a>-->
    <!--                                                </div>-->
    <!--                                            </div>-->
    <!--                                        </div>-->

    <!--                                    </div>-->
    <!--                                </div>-->
    <!--                            </div>-->

    <!--                        </div>-->

    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!--End priceing plan Area-->



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
						<div class="single-testimonial-style1 wow fadeInUp" data-wow-delay="100ms"
							data-wow-duration="1500ms">
							<div class="img-holder">
								<img src="{{ asset('site_assets') }}/images/testimonial/tes-v1-1.png" alt="Customer Image">
							</div>
							<div class="text-holder">
								<h2>Emily Johnson</h2>
								<span>London, UK</span>
								<div class="text-box">
									<p>I ordered a customised portrait frame and it turned out absolutely stunning!
										The quality is far beyond what I expected and it’s now the centrepiece of my living
										room.</p>
								</div>
							</div>
						</div>
						<!--End Single Testimonial Style1-->

						<!--Start Single Testimonial Style1-->
						<div class="single-testimonial-style1 wow fadeInUp" data-wow-delay="200ms"
							data-wow-duration="1500ms">
							<div class="img-holder">
								<img src="{{ asset('site_assets') }}/images/testimonial/tes-v1-2.png" alt="Customer Image">
							</div>
							<div class="text-holder">
								<h2>James Williams</h2>
								<span>Manchester, UK</span>
								<div class="text-box">
									<p>The customised frame I received was perfect!
										From ordering to delivery, everything was smooth and professional.
										I’ll definitely be ordering more as gifts for friends and family.</p>
								</div>
							</div>
						</div>
						<!--End Single Testimonial Style1-->

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

    <!--Start Blog Style1 Area-->
    <!--<section class="blog-style1-area">-->
    <!--    <div class="container">-->
    <!--        <div class="sec-title">-->
    <!--            <h5>//<span>Insights</span>//</h5>-->
    <!--            <h2>News & Feeds<span class="round-box zoominout"></span></h2>-->
    <!--        </div>-->
    <!--        <div class="row">-->
    <!--            <div class="col-xl-12 col-lg-12">-->
    <!--                <div class="blog-carousel owl-carousel owl-theme owl-nav-style-one">-->
                        <!--Start Single blog Style1-->
    <!--                    <div class="single-blog-style1 wow fadeInLeft" data-wow-delay="100ms" data-wow-duration="1500ms">-->
    <!--                        <div class="img-holder">-->
    <!--                            <div class="date-box">-->
    <!--                                <h5>24th June 2020</h5>-->
    <!--                            </div>-->
    <!--                            <div class="inner">-->
    <!--                                <img src="{{ asset('site_assets') }}/images/blog/blog-v1-1.jpg" alt="Awesome Image">-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <div class="text-holder">-->
    <!--                            <ul class="meta-info">-->
    <!--                                <li><span class="icon-user"></span><a href="#">By Admin</a></li>-->
    <!--                                <li><span class="icon-tag"></span><a href="#">Pet, Care, Medicine</a></li>-->
    <!--                            </ul>-->
    <!--                            <h3 class="blog-title"><a href="blog-single.html">Share five inspirational Quotes of the Day-->
    <!--                                    with friends<span class="round-box zoominout"></span></a></h3>-->
    <!--                        </div>-->
    <!--                    </div>-->
                        <!--End Single blog Style1-->
                        <!--Start Single blog Style1-->
    <!--                    <div class="single-blog-style1 wow fadeInLeft" data-wow-delay="100ms" data-wow-duration="1500ms">-->
    <!--                        <div class="img-holder">-->
    <!--                            <div class="date-box">-->
    <!--                                <h5>24th June 2020</h5>-->
    <!--                            </div>-->
    <!--                            <div class="inner">-->
    <!--                                <img src="{{ asset('site_assets') }}/images/blog/blog-v1-2.jpg" alt="Awesome Image">-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <div class="text-holder">-->
    <!--                            <ul class="meta-info">-->
    <!--                                <li><span class="icon-user"></span><a href="#">By Admin</a></li>-->
    <!--                                <li><span class="icon-tag"></span><a href="#">Pet, Care, Medicine</a></li>-->
    <!--                            </ul>-->
    <!--                            <h3 class="blog-title"><a href="blog-single.html">Share five inspirational Quotes of the Day-->
    <!--                                    with friends<span class="round-box zoominout"></span></a></h3>-->
    <!--                        </div>-->
    <!--                    </div>-->
                        <!--End Single blog Style1-->
                        <!--Start Single blog Style1-->
    <!--                    <div class="single-blog-style1 wow fadeInLeft" data-wow-delay="100ms" data-wow-duration="1500ms">-->
    <!--                        <div class="img-holder">-->
    <!--                            <div class="date-box">-->
    <!--                                <h5>24th June 2020</h5>-->
    <!--                            </div>-->
    <!--                            <div class="inner">-->
    <!--                                <img src="{{ asset('site_assets') }}/images/blog/blog-v1-3.jpg" alt="Awesome Image">-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <div class="text-holder">-->
    <!--                            <ul class="meta-info">-->
    <!--                                <li><span class="icon-user"></span><a href="#">By Admin</a></li>-->
    <!--                                <li><span class="icon-tag"></span><a href="#">Pet, Care, Medicine</a></li>-->
    <!--                            </ul>-->
    <!--                            <h3 class="blog-title"><a href="blog-single.html">Share five inspirational Quotes of the Day-->
    <!--                                    with friends<span class="round-box zoominout"></span></a></h3>-->
    <!--                        </div>-->
    <!--                    </div>-->
                        <!--End Single blog Style1-->

                        <!--Start Single blog Style1-->
    <!--                    <div class="single-blog-style1 wow fadeInLeft" data-wow-delay="100ms" data-wow-duration="1500ms">-->
    <!--                        <div class="img-holder">-->
    <!--                            <div class="date-box">-->
    <!--                                <h5>24th June 2020</h5>-->
    <!--                            </div>-->
    <!--                            <div class="inner">-->
    <!--                                <img src="{{ asset('site_assets') }}/images/blog/blog-v1-1.jpg" alt="Awesome Image">-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <div class="text-holder">-->
    <!--                            <ul class="meta-info">-->
    <!--                                <li><span class="icon-user"></span><a href="#">By Admin</a></li>-->
    <!--                                <li><span class="icon-tag"></span><a href="#">Pet, Care, Medicine</a></li>-->
    <!--                            </ul>-->
    <!--                            <h3 class="blog-title"><a href="blog-single.html">Share five inspirational Quotes of the Day-->
    <!--                                    with friends<span class="round-box zoominout"></span></a></h3>-->
    <!--                        </div>-->
    <!--                    </div>-->
                        <!--End Single blog Style1-->
                        <!--Start Single blog Style1-->
    <!--                    <div class="single-blog-style1 wow fadeInLeft" data-wow-delay="100ms" data-wow-duration="1500ms">-->
    <!--                        <div class="img-holder">-->
    <!--                            <div class="date-box">-->
    <!--                                <h5>24th June 2020</h5>-->
    <!--                            </div>-->
    <!--                            <div class="inner">-->
    <!--                                <img src="{{ asset('site_assets') }}/images/blog/blog-v1-2.jpg" alt="Awesome Image">-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <div class="text-holder">-->
    <!--                            <ul class="meta-info">-->
    <!--                                <li><span class="icon-user"></span><a href="#">By Admin</a></li>-->
    <!--                                <li><span class="icon-tag"></span><a href="#">Pet, Care, Medicine</a></li>-->
    <!--                            </ul>-->
    <!--                            <h3 class="blog-title"><a href="blog-single.html">Share five inspirational Quotes of the Day-->
    <!--                                    with friends<span class="round-box zoominout"></span></a></h3>-->
    <!--                        </div>-->
    <!--                    </div>-->
                        <!--End Single blog Style1-->
                        <!--Start Single blog Style1-->
    <!--                    <div class="single-blog-style1 wow fadeInLeft" data-wow-delay="100ms" data-wow-duration="1500ms">-->
    <!--                        <div class="img-holder">-->
    <!--                            <div class="date-box">-->
    <!--                                <h5>24th June 2020</h5>-->
    <!--                            </div>-->
    <!--                            <div class="inner">-->
    <!--                                <img src="{{ asset('site_assets') }}/images/blog/blog-v1-3.jpg" alt="Awesome Image">-->
    <!--                            </div>-->
    <!--                        </div>-->
    <!--                        <div class="text-holder">-->
    <!--                            <ul class="meta-info">-->
    <!--                                <li><span class="icon-user"></span><a href="#">By Admin</a></li>-->
    <!--                                <li><span class="icon-tag"></span><a href="#">Pet, Care, Medicine</a></li>-->
    <!--                            </ul>-->
    <!--                            <h3 class="blog-title"><a href="blog-single.html">Share five inspirational Quotes of the Day-->
    <!--                                    with friends<span class="round-box zoominout"></span></a></h3>-->
    <!--                        </div>-->
    <!--                    </div>-->
                        <!--End Single blog Style1-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</section>-->
    <!--End Blog Style1 Area-->


@endsection