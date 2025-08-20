@extends('layouts.new-master')

@section('title')
   Product Details || CarePress 
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
                       <h2>Product Details<span class="dotted"></span></h2>
                    </div>
                    <div class="breadcrumb-menu wow slideInDown animated" data-wow-delay="0.3s" data-wow-duration="1500ms">
                        <ul class="clearfix">
                            <li><a href="index-2.html">Home</a></li>
                            <li class="active">Shop Details</li>
                        </ul>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--End breadcrumb area-->
 
  
<!--Start Shop Details Area-->
<section class="shop-details-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="shop-details-content">
                    <div class="row">
                        <div class="col-xl-5 col-lg-8">
                            <div class="single-product-image-holder">
                               
                                <div class="single-product-image-holder">
                                    <ul class="slider-content clearfix bxslider2">
                                        <li>
                                            <div class="single-product-slide clearfix">
                                                <div class="big-image-box">
                                                    <img src="{{ asset('site_assets') }}/images/shop/shop-single-1.jpg" alt="Awesome Image">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="single-product-slide clearfix">
                                                <div class="big-image-box">
                                                    <img src="{{ asset('site_assets') }}/images/shop/shop-single-2.jpg" alt="Awesome Image">
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="single-product-slide clearfix">
                                                <div class="big-image-box">
                                                    <img src="{{ asset('site_assets') }}/images/shop/shop-single-3.jpg" alt="Awesome Image">
                                                </div>
                                            </div>
                                        </li>
                                    </ul>    
       
                                    <div class="slider-pager clearfix">
                                        <ul class="thumb-box">
                                            <li>
                                                <a class="active" data-slide-index="0" href="#">
                                                    <div class="img-holder">
                                                        <img src="{{ asset('site_assets') }}/images/shop/shop-single-thumb-1.jpg" alt="Awesome Image">    
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a data-slide-index="1" href="#">
                                                    <div class="img-holder">
                                                        <img src="{{ asset('site_assets') }}/images/shop/shop-single-thumb-2.jpg" alt="Awesome Image">    
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a data-slide-index="2" href="#">
                                                    <div class="img-holder">
                                                        <img src="{{ asset('site_assets') }}/images/shop/shop-single-thumb-3.jpg" alt="Awesome Image">    
                                                    </div>
                                                </a>
                                            </li>
                                          
                                        </ul>
                                    </div>  
                                      
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="col-xl-7 col-lg-12">
                            <div class="single-product-info-box">
                                <div class="product-title">
                                    <p>Wet Food</p>
                                    <h2>Good Deeds Royal Pet Food</h2>
                                </div>
                                <div class="product-value">
                                    <h3>£245.00 <del>£399.99</del></h3>
                                    <div class="review-box">
                                        <ul>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star-half"></i></li>
                                        </ul>
                                        <span>(25 Customer review)</span>
                                    </div>    
                                </div>
                                <div class="product-text">
                                    <p>Sweet as can be, the darling Lucy Love Sophia Rust Red Embroidered Dress is here to brighten your day! Slender straps support the apron neckline of this gauzy, woven dress bedecked in floral embroidery. Sheath silhouette ends at a mini hem.  Sleek, polished, and boasting an impeccably polished modern fit, this blue, 2-button Lazio suit features a notch lapel, flap pockets, and accompanying flat front trousers—all in pure wool by Vitale Barberis Canonico.</p>
                                    <div class="bottom">
                                        <ul>
                                            <li><span>Availability:</span> In stock </li>
                                            <li><span>Tags:</span> Fashion, Hood, Classic</li>
                                        </ul>
                                        <ul>
                                            <li><span>Product Code:</span> #4657</li>
                                        </ul>
                                    </div>
                                </div>
                                
                                <div class="product-cart-box">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-4">
                                            <div class="input-box">
                                                <div class="title">
                                                    <h4>Color</h4>
                                                </div> 
                                                <select class="selectpicker" data-width="100%">
                                                    <option selected="selected">Select Color</option>
                                                    <option>Red</option>
                                                    <option>Green</option>
                                                    <option>Blue</option>
                                                    <option>yellow</option>
                                                </select>  
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4">
                                            <div class="input-box">
                                                <div class="title">
                                                    <h4>Size</h4>
                                                </div> 
                                                <select class="selectpicker" data-width="100%">
                                                    <option selected="selected">Select size</option>
                                                    <option>XL</option>
                                                    <option>L</option>
                                                    <option>M</option>
                                                    <option>LG</option>
                                                </select>  
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4">
                                            <div class="input-box">
                                                <div class="title">
                                                    <h4>Qty</h4>
                                                </div> 
                                                <div class="quantity-box">
                                                    <input class="quantity-spinner" type="text" value="2" name="quantity">
                                                </div> 
                                                <div class="clear-selection"><a href="#">Clear Selection</a></div> 
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="product-details-button-box">
                                                <div class="addto-cart-button">
                                                    <button class="btn-one addtocart" type="submit">
                                                        <span class="txt"><i class="icon-basket"></i>Add To Cart</span>
                                                    </button>
                                                </div>
                                                <div class="wishlist-button">
                                                    <button class="btn-one wishlist" type="submit">
                                                        <span class="txt"><i class="icon-basket"></i>Add To Wishlist</span>
                                                    </button>    
                                                </div>
                                                <div class="compare-button">
                                                    <button class="btn-one compare" type="submit">
                                                        <span class="txt"><i class="icon-basket"></i>Compare</span>
                                                    </button>    
                                                </div>
                                            </div>     
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="share-products-socials">
                                    <h5>Share This:</h5>
                                    <ul>
                                        <li><a href="#"><i class="fa fa-facebook fb" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter tw" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-pinterest pin" aria-hidden="true"></i></a></li>
                                        <li><a href="#"><i class="fa fa-linkedin lin" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div> 
                                   
                            </div>  
                        </div>
                        
                        
                    </div>       
                </div>    
            </div>
        </div>
    </div>
</section>
<!--End Shop Details Area-->

<!--Start Products Details Tab Area-->
<section class="products-details-tab-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="product-tab-box tabs-box">
                   
                    <ul class="tab-btns tab-buttons clearfix">
                        <li data-tab="#desc" class="tab-btn active-btn"><span>description</span></li>
                        <li data-tab="#comme" class="tab-btn"><span>COMMENTS</span></li>
                        <li data-tab="#review" class="tab-btn"><span>review</span></li>
                    </ul>
                    
                    <div class="tabs-content">
                        <div class="tab active-tab" id="desc" style="display: block;">
                            <div class="product-descriptions-content">
                                <div class="text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto.</p>
                                </div>
                                
                                <div class="table-outer">
                                    <img src="{{ asset('site_assets') }}/images/shop/tab-table.jpg" alt="">    
                                </div>
                                <div class="bottom-text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore.</p>
                                    <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur.</p>
                                </div>    
                                 
                            </div> 
                        </div>

                        <div class="tab" id="comme">
                            <div class="review-form">
                                <div class="shop-page-title">
                                    <div class="title">Add Your Comments</div>
                                    <p>Your email address will not be published. Required fields are marked <b>*</b></p>
                                </div>
                                <form id="review-form" action="#">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-box">
                                                <p>Name<span>*</span></p>
                                                <input type="text" name="fname" placeholder="" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-box">
                                                <p>Email<span>*</span></p>
                                                <input type="email" name="email" placeholder="" required="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="add-rating-box">
                                                <div class="add-rating-title">
                                                    <p>Your Rating</p>    
                                                </div>
                                                <div class="review-box">
                                                    <ul>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                        <li><i class="fa fa-star"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="input-box">
                                                <p>Your Review<span>*</span></p>
                                                <textarea name="review" placeholder="" required=""></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button class="btn-one" type="submit">
                                                <span class="txt">Submit<i class="flaticon-next"></i></span>
                                            </button>
                                        </div>
                                    </div>
                                </form>  
                            </div>     
                        </div>

                        <div class="tab" id="review">
                            <div class="review-box-holder">
                                <div class="row">
                                    <div class="col-xl-12">  
                                        <!--Start single review outer box-->
                                        <div class="single-review-outer-box">
                                            <div class="single-review-box">
                                                <div class="image-holder">
                                                    <img src="{{ asset('site_assets') }}/images/shop/review-1.png" alt="Awesome Image">
                                                </div>
                                                <div class="text-holder">
                                                    <div class="top">
                                                        <div class="name">
                                                            <h3>Steven Rich <span> – April 10, 2019:</span></h3>
                                                        </div>
                                                        <div class="review-box">
                                                            <ul>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="text">
                                                        <p>Value for money , I use it from long time and it is very useful and good product.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--End single review outer box-->
                                        <!--Start single review outer box-->
                                        <div class="single-review-outer-box">
                                            <div class="single-review-box">
                                                <div class="image-holder">
                                                    <img src="{{ asset('site_assets') }}/images/shop/review-2.png" alt="Awesome Image">
                                                </div>
                                                <div class="text-holder">
                                                    <div class="top">
                                                        <div class="name">
                                                            <h3>William Cobus <span>– April 09, 2019:</span></h3>
                                                        </div>
                                                        <div class="review-box">
                                                            <ul>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="text">
                                                        <p>We denounce with righteous indignation and dislike men who are so beguiled &amp; demoralized.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--End single review outer box-->
                                    </div>
                                </div>
                            </div>     
                        </div>

                    </div>
                       
                </div>          
            </div>
        </div>
    </div>
</section>
<!--End Products Details Tab Area-->
@endsection