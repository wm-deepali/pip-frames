@extends('layouts.new-master')

@section('title')
  Contact || CarePress
@endsection

@section('content')

  <!--Start breadcrumb area-->
  <section class="breadcrumb-area" style="background-image: url({{ asset('site_assets') }}/images/breadcrumb/breadcrumb-1.png);">
    <div class="banner-curve"></div>
    <div class="container">
    <div class="row">
      <div class="col-xl-12">
      <div class="inner-content clearfix text-center">
        <div class="title wow slideInUp animated" data-wow-delay="0.3s" data-wow-duration="1500ms">
        <h2>Contact Us<span class="dotted"></span></h2>
        </div>
        <div class="breadcrumb-menu wow slideInDown animated" data-wow-delay="0.3s" data-wow-duration="1500ms">
        <ul class="clearfix">
          <li><a href="index-2.html">Home</a></li>
          <li class="active">Contact</li>
        </ul>
        </div>
      </div>
      </div>
    </div>
    </div>
  </section>
  <!--End breadcrumb area-->

  <!--Start Contact Info Area-->
  <section class="contact-info-area style3">
    <div class="container">
    <div class="row">

      <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp">
      <div class="single-contact-info-box">
        <span class="icon-envelope"></span>
        <div class="title">
        <h3>Email Address<span class="dotted"></span></h3>
        </div>
        <ul>
        <li><a href="mailto:info@webmail.com">info@webmail.com</a></li>
        <li><a href="mailto:jobs@webmail.com">jobs@webmail.com</a></li>
        </ul>
      </div>
      </div>

      <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="200ms">
      <div class="single-contact-info-box">
        <span class="icon-call"></span>
        <div class="title">
        <h3>Phone Number<span class="dotted"></span></h3>
        </div>
        <ul>
        <li><a href="tel:123456789">244-344-786-999-6</a></li>
        <li><a href="tel:123456789">987-675-987-908</a></li>
        </ul>
      </div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="400ms">
      <div class="single-contact-info-box">
        <span class="icon-pin-2"></span>
        <div class="title">
        <h3>Office Address<span class="dotted"></span></h3>
        </div>
        <p>13/A, Jhumando City<br> New York, NYC</p>
      </div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="600ms">
      <div class="single-contact-info-box">
        <span class=" icon-mail-1"></span>
        <div class="title">
        <h3>Web Connection<span class="dotted"></span></h3>
        </div>
        <ul>
        <li><a href="https://www.facebook.com/webexample">fb.com/webexample</a></li>
        <li><a href="https://www.facebook.com/webexample">tw.com/webexample</a></li>
        </ul>
      </div>
      </div>

    </div>
    </div>
  </section>
  <!--End Contact Info Area-->


  <!--Start Contact Form Style1 Area-->
  <section class="contact-form-style1-area">
    <div class="contact-form-style1-bg" style="background-image: url({{ asset('site_assets') }}/images/shape/contact-form-style1-bg.png)">
    </div>
    <div class="container">
    <div class="sec-title text-center">
      <h5>//<span>Contact Us</span>//</h5>
      <h2>Get In Touch<span class="round-box zoominout"></span></h2>
    </div>
    <div class="row">
      <div class="col-xl-12">
      <div class="contact-form contact-page">
        <form id="contact-form" name="contact_form" class="default-form2"
        action="https://mehedi.asiandevelopers.com/demo/carepress/{{ asset('site_assets') }}/inc/sendmail.php" method="post">
        <div class="row">
          <div class="col-xl-4 col-lg-4">
          <div class="input-box">
            <input type="text" name="form_name" value="" placeholder="Your name" required="">
            <div class="icon">
            <span class="icon-user"></span>
            </div>
          </div>
          </div>
          <div class="col-xl-4 col-lg-4">
          <div class="input-box">
            <input type="email" name="form_email" value="" placeholder="Email address" required="">
            <div class="icon">
            <span class="icon-envelope"></span>
            </div>
          </div>
          </div>
          <div class="col-xl-4 col-lg-4">
          <div class="input-box">
            <select class="selectpicker" data-width="100%">
            <option selected="selected">Select Subject</option>
            <option>Rosalina D. William</option>
            <option>Miranda H. Halim</option>
            <option>Hilixer D. Browni</option>
            <option>Yokolili Y. Yankee</option>
            </select>
          </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xl-6">
          <div class="input-box">
            <input type="text" name="form_phone" value="" placeholder="Phone number">
            <div class="icon">
            <span class="icon-phone"></span>
            </div>
          </div>
          </div>
          <div class="col-xl-6">
          <div class="input-box">
            <input type="text" name="form_subject" value="" placeholder="Subject">
            <div class="icon">
            <span class="icon-pen"></span>
            </div>
          </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xl-12">
          <div class="input-box">
            <textarea name="form_message" placeholder="Write message" required=""></textarea>

          </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-12">
          <div class="button-box text-center">
            <input id="form_botcheck" name="form_botcheck" class="form-control" type="hidden" value="">
            <button class="btn-one gradient-bg-1" type="submit" data-loading-text="Please wait...">
            <span class="txt"><i class="icon-send"></i>Submit Now</span>
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
  <!--End Contact Form Style1 Area-->

  <!--Start Google Map Area-->
  <section class="google-map-area">
    <div class="contact-map-outer">
    <!--Map Canvas-->
    <div class="map-canvas" data-zoom="12" data-lat="-37.817085" data-lng="144.955631" data-type="roadmap"
      data-hue="#ffc400" data-title="Envato" data-icon-path="{{ asset('site_assets') }}/images/resources/map-marker.png"
      data-content="Melbourne VIC 3000, Australia<br><a href='mailto:info@youremail.com'>info@youremail.com</a>">
    </div>
    </div>
  </section>
  <!--End Google Map Area-->

@endsection