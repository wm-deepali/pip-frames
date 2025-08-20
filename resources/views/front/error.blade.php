@extends('layouts.new-master')

@section('title')
    Error Page || CarePress
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
                        <h2>Error Page<span class="dotted"></span></h2>
                    </div>
                    <div class="breadcrumb-menu wow slideInDown animated" data-wow-delay="0.3s"
                        data-wow-duration="1500ms">
                        <ul class="clearfix">
                            <li><a href="index-2.html">Home</a></li>
                            <li class="active">404</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End breadcrumb area-->

<!--Start Error Page Area-->
<section class="error-page-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="error-content text-center wow slideInUp" data-wow-delay="0ms" data-wow-duration="1500ms">
                    <h4>Page Not Found</h4>
                    <div class="title">404</div>
                    <p>We’re unable to find a page you are looking for, Try later or click the button.</p>
                    <div class="btns-box">
                        <a class="btn-one" href="index-2.html"><span class="txt">Back to Home</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End Error Page Area-->

@endsection