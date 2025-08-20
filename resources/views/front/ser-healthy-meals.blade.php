@extends('layouts.new-master')

@section('title')
    Healthy Meals || Services
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
                       <h2>Healthy Meals<span class="dotted"></span></h2>
                    </div>
                    <div class="breadcrumb-menu wow slideInDown animated" data-wow-delay="0.3s" data-wow-duration="1500ms">
                        <ul class="clearfix">
                            <li><a href="index-2.html">Home</a></li>
                            <li class="active">Service Details</li>
                        </ul>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End breadcrumb area-->
  
<!--Start Service Details Area-->
<section class="service-details-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-8">
                <div class="service-details-content">
                    <div class="service-details-main-image">
                        <img src="{{ asset('site_assets') }}/images/services/service-details-v1-1.jpg" alt="">
                        <div class="overlay-box">
                            <div class="icon">
                                <span class="icon-vaccine"></span>
                            </div>
                            <div class="title">
                                <h3>Monthly Care</h3>
                                <p>Get a solid solution</p>
                            </div>
                        </div>    
                    </div>
                    <div class="service-details-text-box">
                        <h2>Healthy Meals<span class="dotted"></span></h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem.</p>
                        
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem.</p>
                    </div>
                    <div class="service-details-bottom-image">
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="single-image-nox">
                                    <img src="{{ asset('site_assets') }}/images/services/service-details-v1-2.jpg" alt="">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="single-image-nox">
                                    <img src="{{ asset('site_assets') }}/images/services/service-details-v1-3.jpg" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="service-details-bottom-text">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-lg-4">
                <div class="service-details-sidebar">
                    <div class="service-details-categories">
                        <div class="title">
                            <h3>Services Category<span class="dotted"></span></h3>
                        </div>
                        <div class="categories-box">
                            <ul class="categories clearfix">
                                <li><a href="ser-pet-grooming.html">Pet Grooming</a></li>
                                <li><a href="ser-dog-setting.html">Dog Setting</a></li>
                                <li class="active"><a href="ser-healthy-meals.html">Healthy Meals</a></li>
                                <li><a href="ser-veterinary-service.html">Veterinary Service</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="callto-action-box text-center" style="background-image: url({{ asset('site_assets') }}/images/resources/callto-action-box-bg.jpg)">
                        <p>Call To Action</p> 
                        <h3>Enjoy Your Whole<br> Weekend.</h3>
                        <a class="btn-one" href="#"><span class="txt">Appointment</span></a>   
                    </div>
                    
                </div>
            </div>              
        
        </div>
        
        <div class="row">
            <div class="col-xl-12">
                <div class="servicedet-prev-next-option">
                    <div class="box prev">
                        <div class="inner">
                            <div class="image">
                                <img src="{{ asset('site_assets') }}/images/services/service-details-prev-1.jpg" alt="">
                            </div>
                            <div class="title">
                                <p><a href="#">Prev Service</a></p>
                                <h3><a href="#">Pet Grooming.</a></h3>
                            </div>
                        </div>
                    </div>
                    
                    <div class="box next">
                        <div class="inner-next">
                            <div class="image">
                                <img src="{{ asset('site_assets') }}/images/services/service-details-next-1.jpg" alt="">
                            </div>
                            <div class="title">
                                <p><a href="#">Next Service</a></p>
                                <h3><a href="#">Pet Sitting.</a></h3>
                            </div>
                        </div>
                    </div>  
                     
                </div>
            </div>
        </div>
    </div>
</section>   
<!--End Service Details Area-->
 
 
 @endsection

