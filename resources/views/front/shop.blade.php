@extends('layouts.new-master')

@section('title')
    Shop || CarePress
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
                       <h2>Our Shop<span class="dotted"></span></h2>
                    </div>
                    <div class="breadcrumb-menu wow slideInDown animated" data-wow-delay="0.3s" data-wow-duration="1500ms">
                        <ul class="clearfix">
                            <li><a href="index-2.html">Home</a></li>
                            <li class="active">Shop</li>
                        </ul>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End breadcrumb area-->
 
  
<!--Start Shop Area-->
<section class="shop-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-8">
                <div class="shop-content">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="showing-result-shorting">
                               
                                <div class="showing">
                                    <p>Showing 1-9 of 35 results</p>
                                </div> 
                                <div class="shorting"> 
                                    <select class="selectpicker" data-width="100%">
                                        <option selected="selected">Default Sorting</option>
                                        <option>Default Sorting</option>
                                        <option>Default Sorting</option>
                                        <option>Default Sorting</option>
                                        <option>Default Sorting</option>
                                    </select>       
                                </div>
                                
                            </div>     
                        </div>
                    </div>
                    
                    <div class="row">
                        <!--Start single product item-->
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                            <div class="single-product-item">
                                <div class="img-holder">
                                    <img src="{{ asset('site_assets') }}/images/shop/shop-1.jpg" alt="Awesome Product Image">
                                    <div class="overlay-content">
                                        <a class="btn-one" href="#"><span class="txt">Add To Cart<span class="icon-basket"></span></span></a>   
                                    </div>
                                </div>
                                <div class="title-holder">
                                    <h4><a href="shop-single.html">Lucy Love Sophia Rust Chair</a></h4>
                                    <div class="price-box">
                                        <span>£85.00</span> <del>£270.00</del>    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End single product item-->
                        <!--Start single product item-->
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                            <div class="single-product-item">
                                <div class="img-holder">
                                    <img src="{{ asset('site_assets') }}/images/shop/shop-2.jpg" alt="Awesome Product Image">
                                    <div class="overlay-content">
                                        <a class="btn-one" href="#"><span class="txt">Add To Cart<span class="icon-basket"></span></span></a>   
                                    </div>
                                </div>
                                <div class="title-holder">
                                    <h4><a href="shop-single.html">Lucy Love Sophia Rust Chair</a></h4>
                                    <div class="price-box">
                                        <span>£85.00</span> <del>£270.00</del>    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End single product item-->
                        <!--Start single product item-->
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                            <div class="single-product-item">
                                <div class="img-holder">
                                    <img src="{{ asset('site_assets') }}/images/shop/shop-3.jpg" alt="Awesome Product Image">
                                    <div class="overlay-content">
                                        <a class="btn-one" href="#"><span class="txt">Add To Cart<span class="icon-basket"></span></span></a>   
                                    </div>
                                </div>
                                <div class="title-holder">
                                    <h4><a href="shop-single.html">Lucy Love Sophia Rust Chair</a></h4>
                                    <div class="price-box">
                                        <span>£85.00</span> <del>£270.00</del>    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End single product item-->
                        
                        <!--Start single product item-->
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                            <div class="single-product-item">
                                <div class="img-holder">
                                    <img src="{{ asset('site_assets') }}/images/shop/shop-4.jpg" alt="Awesome Product Image">
                                    <div class="overlay-content">
                                        <a class="btn-one" href="#"><span class="txt">Add To Cart<span class="icon-basket"></span></span></a>   
                                    </div>
                                </div>
                                <div class="title-holder">
                                    <h4><a href="shop-single.html">Lucy Love Sophia Rust Chair</a></h4>
                                    <div class="price-box">
                                        <span>£85.00</span> <del>£270.00</del>    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End single product item-->
                        <!--Start single product item-->
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                            <div class="single-product-item">
                                <div class="img-holder">
                                    <img src="{{ asset('site_assets') }}/images/shop/shop-5.jpg" alt="Awesome Product Image">
                                    <div class="overlay-content">
                                        <a class="btn-one" href="#"><span class="txt">Add To Cart<span class="icon-basket"></span></span></a>   
                                    </div>
                                </div>
                                <div class="title-holder">
                                    <h4><a href="shop-single.html">Lucy Love Sophia Rust Chair</a></h4>
                                    <div class="price-box">
                                        <span>£85.00</span> <del>£270.00</del>    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End single product item-->
                        <!--Start single product item-->
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                            <div class="single-product-item">
                                <div class="img-holder">
                                    <img src="{{ asset('site_assets') }}/images/shop/shop-6.jpg" alt="Awesome Product Image">
                                    <div class="overlay-content">
                                        <a class="btn-one" href="#"><span class="txt">Add To Cart<span class="icon-basket"></span></span></a>   
                                    </div>
                                </div>
                                <div class="title-holder">
                                    <h4><a href="shop-single.html">Lucy Love Sophia Rust Chair</a></h4>
                                    <div class="price-box">
                                        <span>£85.00</span> <del>£270.00</del>    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End single product item-->
                        
                        <!--Start single product item-->
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                            <div class="single-product-item">
                                <div class="img-holder">
                                    <img src="{{ asset('site_assets') }}/images/shop/shop-7.jpg" alt="Awesome Product Image">
                                    <div class="overlay-content">
                                        <a class="btn-one" href="#"><span class="txt">Add To Cart<span class="icon-basket"></span></span></a>   
                                    </div>
                                </div>
                                <div class="title-holder">
                                    <h4><a href="shop-single.html">Lucy Love Sophia Rust Chair</a></h4>
                                    <div class="price-box">
                                        <span>£85.00</span> <del>£270.00</del>    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End single product item-->
                        <!--Start single product item-->
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                            <div class="single-product-item">
                                <div class="img-holder">
                                    <img src="{{ asset('site_assets') }}/images/shop/shop-8.jpg" alt="Awesome Product Image">
                                    <div class="overlay-content">
                                        <a class="btn-one" href="#"><span class="txt">Add To Cart<span class="icon-basket"></span></span></a>   
                                    </div>
                                </div>
                                <div class="title-holder">
                                    <h4><a href="shop-single.html">Lucy Love Sophia Rust Chair</a></h4>
                                    <div class="price-box">
                                        <span>£85.00</span> <del>£270.00</del>    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End single product item-->
                        <!--Start single product item-->
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                            <div class="single-product-item">
                                <div class="img-holder">
                                    <img src="{{ asset('site_assets') }}/images/shop/shop-9.jpg" alt="Awesome Product Image">
                                    <div class="overlay-content">
                                        <a class="btn-one" href="#"><span class="txt">Add To Cart<span class="icon-basket"></span></span></a>   
                                    </div>
                                </div>
                                <div class="title-holder">
                                    <h4><a href="shop-single.html">Lucy Love Sophia Rust Chair</a></h4>
                                    <div class="price-box">
                                        <span>£85.00</span> <del>£270.00</del>    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End single product item-->
                        
                        <!--Start single product item-->
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                            <div class="single-product-item">
                                <div class="img-holder">
                                    <img src="{{ asset('site_assets') }}/images/shop/shop-10.jpg" alt="Awesome Product Image">
                                    <div class="overlay-content">
                                        <a class="btn-one" href="#"><span class="txt">Add To Cart<span class="icon-basket"></span></span></a>   
                                    </div>
                                </div>
                                <div class="title-holder">
                                    <h4><a href="shop-single.html">Lucy Love Sophia Rust Chair</a></h4>
                                    <div class="price-box">
                                        <span>£85.00</span> <del>£270.00</del>    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End single product item-->
                        <!--Start single product item-->
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                            <div class="single-product-item">
                                <div class="img-holder">
                                    <img src="{{ asset('site_assets') }}/images/shop/shop-11.jpg" alt="Awesome Product Image">
                                    <div class="overlay-content">
                                        <a class="btn-one" href="#"><span class="txt">Add To Cart<span class="icon-basket"></span></span></a>   
                                    </div>
                                </div>
                                <div class="title-holder">
                                    <h4><a href="shop-single.html">Lucy Love Sophia Rust Chair</a></h4>
                                    <div class="price-box">
                                        <span>£85.00</span> <del>£270.00</del>    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End single product item-->
                        <!--Start single product item-->
                        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                            <div class="single-product-item">
                                <div class="img-holder">
                                    <img src="{{ asset('site_assets') }}/images/shop/shop-12.jpg" alt="Awesome Product Image">
                                    <div class="overlay-content">
                                        <a class="btn-one" href="#"><span class="txt">Add To Cart<span class="icon-basket"></span></span></a>   
                                    </div>
                                </div>
                                <div class="title-holder">
                                    <h4><a href="shop-single.html">Lucy Love Sophia Rust Chair</a></h4>
                                    <div class="price-box">
                                        <span>£85.00</span> <del>£270.00</del>    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End single product item-->
                        
                    </div>    
                </div>    
            </div>
            
            <div class="col-xl-3 col-lg-4 col-md-7">
                <div class="sidebar-box-style2">
                    <!--Start Single Sidebar style2-->
                    <div class="single-sidebar-style2">
                        <div class="title">
                            <h4>Filter By Color</h4>
                        </div>
                        <ul class="color-filter filter-checkbox">
                            <li>
                                <div class="single-checkbox">
                                    <input type="checkbox" name="red" id="red-clr">
                                    <label for="red-clr"><span></span>Red</label>
                                </div>
                            </li>
                            <li>
                                <div class="single-checkbox">
                                    <input type="checkbox" name="blue" id="blue-clr" checked>
                                    <label for="blue-clr"><span></span>Blue</label>    
                                </div>
                            </li>
                            <li>
                                <div class="single-checkbox">
                                    <input type="checkbox" name="white" id="white-clr" checked>
                                    <label for="white-clr"><span></span>White</label>
                                </div>
                            </li>
                            <li>
                                <div class="single-checkbox">
                                    <input type="checkbox" name="green" id="green-clr">
                                    <label for="green-clr"><span></span>Green</label>
                                </div>
                            </li>
                            
                            <li>
                                <div class="single-checkbox">
                                    <input type="checkbox" name="violet" id="violet-clr">
                                    <label for="violet-clr"><span></span>Violet</label>
                                </div>
                            </li>
                            <li>
                                <div class="single-checkbox">
                                    <input type="checkbox" name="yellow" id="yellow-clr">
                                    <label for="yellow-clr"><span></span>Yellow</label>
                                </div>
                            </li>
                            <li>
                                <div class="single-checkbox">
                                    <input type="checkbox" name="orange" id="orange-clr">
                                    <label for="orange-clr"><span></span>Orange</label>
                                </div>
                            </li>
                            
                        </ul>    
                    </div>
                    <!--End Single Sidebar style2-->
                    
                    <!--Start Single Sidebar style2-->
                    <div class="single-sidebar-style2">
                        <div class="title">
                            <h4>Filter By Size</h4>
                        </div>
                        <ul class="size-filter">
                            <li>>  XS(56)</li>  
                            <li class="active">>  S(284)</li>  
                            <li>>  M(284)</li>  
                            <li>>  L(284)</li>  
                            <li>>  XL(38)</li>  
                        </ul>    
                    </div>
                    <!--End Single Sidebar style2-->
                    
                    <!--Start Single Sidebar style2-->
                    <div class="single-sidebar-style2">
                        <div class="title">
                            <h4>Filter By Price</h4>
                        </div>
                        <div class="price-ranger">
                            <div id="slider-range"></div>
                            <div class="ranger-min-max-block">
                                <input type="text" readonly class="min"> 
                                <span class="line"></span>
                                <input type="text" readonly class="max">
                                <input class="" type="submit" value="Filter">
                            </div>
                        </div>  
                    </div>
                    <!--End Single Sidebar style2-->
                    
                    <!--Start Single Sidebar style2-->
                    <div class="single-sidebar-style2">
                        <div class="title">
                            <h4>Filter By Tags</h4>
                        </div>
                        <ul class="tag-filter">
                            <li><a href="#">#Accessories,</a></li>    
                            <li><a href="#">#Clothing,</a></li>    
                            <li><a href="#">#Fashion,</a></li>    
                            <li><a href="#">#Footwear,</a></li>    
                            <li><a href="#">#Good,</a></li>    
                            <li><a href="#">#Kid,</a></li>    
                            <li><a href="#">#Men,</a></li>    
                            <li><a href="#">#Wear,</a></li>    
                            <li><a href="#">#Wm.</a></li>    
                        </ul>  
                    </div>
                    <!--End Single Sidebar style2-->
                    
                    <div class="shop-sidebar-image-box">
                        <img src="{{ asset('site_assets') }}/images/shop/shop-sidebar-image.jpg" alt="">    
                    </div>
                    
                    
                </div>
            </div>
            
        </div>
    </div>
</section>
<!--End Shop Area-->
 
 
@endsection