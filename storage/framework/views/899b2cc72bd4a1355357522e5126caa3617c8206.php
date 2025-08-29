<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

</html>

<head>
  <meta charset="UTF-8">
  <!-- responsive meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- For IE -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="description" content="Pip Frames">
  <meta name="keywords" content="Pip Frames">

  <?php echo $__env->yieldPushContent('before-styles'); ?>
  <title><?php echo $__env->yieldContent('title'); ?></title>

  <link rel="stylesheet" href="<?php echo e(asset('site_assets')); ?>/css/aos.css">
  <link rel="stylesheet" href="<?php echo e(asset('site_assets')); ?>/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo e(asset('site_assets')); ?>/css/imp.css">
  <link rel="stylesheet" href="<?php echo e(asset('site_assets')); ?>/css/custom-animate.css">
  <link rel="stylesheet" href="<?php echo e(asset('site_assets')); ?>/css/flaticon.css">
  <link rel="stylesheet" href="<?php echo e(asset('site_assets')); ?>/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo e(asset('site_assets')); ?>/css/owl.css">
  <link rel="stylesheet" href="<?php echo e(asset('site_assets')); ?>/css/magnific-popup.css">
  <link rel="stylesheet" href="<?php echo e(asset('site_assets')); ?>/css/scrollbar.css">
  <link rel="stylesheet" href="<?php echo e(asset('site_assets')); ?>/css/hiddenbar.css">

  <link rel="stylesheet" href="<?php echo e(asset('site_assets')); ?>/css/color.css">
  <link href="<?php echo e(asset('site_assets')); ?>/css/color/theme-color.css" id="jssDefault" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo e(asset('site_assets')); ?>/css/style.css">
  <link rel="stylesheet" href="<?php echo e(asset('site_assets')); ?>/css/responsive.css">
  <!-- Favicon -->
  <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('site_assets')); ?>/images/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" href="<?php echo e(asset('site_assets')); ?>/images/favicon/favicon-32x32.png" sizes="32x32">
  <link rel="icon" type="image/png" href="<?php echo e(asset('site_assets')); ?>/images/favicon/favicon-16x16.png" sizes="16x16">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <?php echo $__env->yieldPushContent('after-styles'); ?>
  <!-- Fixing Internet Explorer-->
  <!--[if lt IE 9]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="<?php echo e(asset('site_assets')); ?>/js/html5shiv.js"></script>
    <![endif]-->

</head>

<style>
  a {
  color: inherit;        /* Keep the color same as surrounding text */
  text-decoration: none; /* Remove underline */
}

</style>
<body>
  <?php
    use App\Models\ContactInfo;
    $contact = ContactInfo::first();
  ?>
  <div class="boxed_wrapper">

    <div class="preloader"></div>

    <!-- Hidden Navigation Bar -->

    <section class="hidden-bar right-align">
      <div class="hidden-bar-closer">
        <button><span class="flaticon-multiply"></span></button>
      </div>
      <div class="hidden-bar-wrapper">
        <div class="logo">
          <a href="<?php echo e(Route('home')); ?>"><img src="<?php echo e(asset('site_assets')); ?>/images/resources/logo.png" alt="Logo"
              style="width:127px;" /></a>
        </div>
        <div class="hiddenbar-about-us">
          <h3>About Us</h3>
          <div class="text">
            <p>PIP Frames brings your memories to life with customised portraits of Pets, People, and Illustrations.
              Each piece is crafted with care, turning your special moments into timeless art that beautifully
              complements your space</p>
          </div>
        </div>
        <div class="contact-info-box">
          <h3>Contact Info</h3>
          <ul>
            <li>
              <h5>Address</h5>
              <p>Unit 7 Lotherton Way Garforth <br> Leeds LS252JY</p>
            </li>
            <li>
              <h5>Phone</h5>
              <p><a href="tel:+01132 874724">+01132 874724</a></p>
            </li>
            <li>
              <h5>Email</h5>
              <p><a href="mailto:andy@pipframes.co.uk">andy@pipframes.co.uk</a></p>
            </li>
          </ul>
        </div>
        <div class="newsletter-form-box">
          <h3>Newsletter Subscribe</h3>
          <form action="#">
            <div class="row">
              <div class="col-xl-12">
                <input type="email" name="email" placeholder="Email Address...">
                <button type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
              </div>
            </div>
          </form>
        </div>
        <div class="copy-right-text">
          <p>© Pipframes 2025, All Rights Reserved.</p>
        </div>
      </div>
    </section>
    <!-- End Hidden Bar -->

    <!-- Main header-->
    <header class="main-header header-style-one">
      <!--Start Header Top-->
      <div class="header-top">
        <div class="outer-container">
          <div class="outer-box clearfix">
              <p class="text-center">Upto 30% OFF, No Coupon Required at www.pipframes.co.uk</p>

            <!--<div class="header-top-left pull-left">-->
            <!--  <div class="header-contact-info">-->
            <!--    <ul>-->
            <!--      <?php if($contact->show_on_header_email && !empty($contact->email)): ?>-->
            <!--        <li><span class="icon-envelope"></span><a-->
            <!--            href="mailto:<?php echo e($contact->email); ?>"><?php echo e($contact->email); ?></a></li>-->
            <!--      <?php endif; ?>-->
            <!--      <?php if($contact->show_on_header_mobile && !empty($contact->mobile_number)): ?>-->
            <!--        <li><span class="icon-phone-call"></span><a-->
            <!--            href="tel:<?php echo e($contact->mobile_number); ?>"><?php echo e($contact->mobile_number); ?></a></li>-->
            <!--      <?php endif; ?>-->

            <!--    </ul>-->
            <!--  </div>-->
            <!--</div>-->

            <!--<div class="header-top-right pull-right">-->
            <!--  <div class="header-social-link">-->
            <!--    <ul>-->
            <!--      <li>-->
            <!--        <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>-->
            <!--      </li>-->
            <!--      <li>-->
            <!--        <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>-->
            <!--      </li>-->
            <!--      <li>-->
            <!--        <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>-->
            <!--      </li>-->
            <!--      <li>-->
            <!--        <a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a>-->
            <!--      </li>-->
            <!--      <li>-->
            <!--        <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>-->
            <!--      </li>-->
            <!--    </ul>-->
            <!--  </div>-->
            <!--</div>-->

          </div>
        </div>
      </div>
      <!--End header Top-->

      <div class="header">
         
        <div class="outer-container mobile-top-header" >
          <div class="outer-box clearfix" style="background:#8fc424;">
              <p class="text-center" style="color:#fff; padding:5px 0px;">Upto 30% OFF, No Coupon Required at www.pipframes.co.uk</p>

          
          </div>
        </div>
     <div class="mobile-header-main">
        
              <div class="mobile-nav-toggler">
<div class="inner">
    <i class="fa fa-bars" style="font-size:24px;"></i> <!-- Hamburger icon -->
  </div>
                </div>
              <div class="logo mobile-logo">
                <a href="<?php echo e(Route('home')); ?>"><img src="<?php echo e(asset('site_assets')); ?>/images/resources/logo.png"
                    alt="Awesome Logo" title="" ></a>
              </div>
                <div class="">
                  
           <h4 >
              <a href="/cart" title="View Cart">
                <i class="fa fa-shopping-cart"></i>
              </a>
            </h4>
              </div>
                <!--Mobile Navigation Toggler-->
                
     </div>
        <div class="outer-container">
          <div class="outer-box clearfix m-heder">

            <!--Start Header Left-->
            <div class="header-left clearfix pull-left">

              <div class="logo desktop-logo">
                <a href="<?php echo e(Route('home')); ?>"><img src="<?php echo e(asset('site_assets')); ?>/images/resources/logo.png"
                    alt="Awesome Logo" title="" ></a>
              </div>
              

              <div class="nav-outer clearfix" style="display: flex;
        flex-direction: row-reverse;
    gap: 80px;
        align-items: center;">
                  <div class="">
                 <h4 >
              <a href="/cart" title="View Cart">
                <i class="fa fa-shopping-cart"></i>
              </a>
            </h4>
              </div>
              <div class="logo mobile-logo">
                <a href="<?php echo e(Route('home')); ?>"><img src="<?php echo e(asset('site_assets')); ?>/images/resources/logo.png"
                    alt="Awesome Logo" title="" ></a>
              </div>
                <!--Mobile Navigation Toggler-->
                <div class="mobile-nav-toggler">
                  <div class="inner">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </div>
                </div>
                
                <!-- Main Menu -->
                <nav class="main-menu style1 navbar-expand-md navbar-light">
                  <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                    <ul class="navigation clearfix">
                      <li><a href="<?php echo e(Route('home')); ?>">Home</a> </li>

                      <?php
                        use App\Models\Category;
                        $categories = Category::latest()->get();
                       ?>

                      <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                          <a href="<?php echo e(route('category.show', $category->slug)); ?>"><?php echo e($category->name); ?></a>

                        </li>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                      <li><a href="<?php echo e(Route('about-us')); ?>">About</a></li>
                      <li><a href="<?php echo e(Route('how-it-works')); ?>">How it Works</a> </li>


                      <li><a href="<?php echo e(Route('faq')); ?>">Faq</a></li>
                     
                      <li><a href="<?php echo e(Route('blogs')); ?>">Blogs</a></li>
                     
                      <li><a href="<?php echo e(Route('contact-us')); ?>">Contact</a></li>
                    </ul>
                  </div>
                </nav>
                <!-- Main Menu End-->
              </div>

            </div>
            <!--End Header Left-->

            <!--Start Header Right-->
            <div class="header-right pull-right clearfix">
              <div class="hidden-content-button bar-box">
                <a class="side-nav-toggler nav-toggler hidden-bar-opener" href="#">
                  <ul>
                    <li class="red2"></li>
                    <li class="red2"></li>
                    <li></li>
                  </ul>
                  <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                  </ul>
                  <ul>
                    <li class="red2"></li>
                    <li></li>
                    <li class="red2"></li>
                  </ul>
                </a>
              </div>
            </div>
            <!--End Header Right-->
          </div>
        </div>
      </div>
      <!--End header -->

      <!--Sticky Header-->
      <div class="sticky-header">
        <div class="container">
          <div class="header-left clearfix pull-left" style="width:80%;">
            <!--Logo-->
            <div class="logo float-left">
              <a href="<?php echo e(Route('home')); ?>" class="img-responsive"><img
                  src="<?php echo e(asset('site_assets')); ?>/images/resources/logo.png" alt="" title=""></a>
            </div>
            <!--Right Col-->
            <div class="right-col " style="padding-left:80px;">
              <!-- Main Menu -->
              <nav class="main-menu clearfix" style="padding-left:80px;">
                <!--Keep This Empty / Menu will come through Javascript-->
              </nav>
            </div>
          </div>
          <div class="header-right pull-right clearfix">
              <div class="hidden-content-button bar-box">
                <a class="side-nav-toggler nav-toggler hidden-bar-opener" href="#">
                  <ul>
                    <li class="red2"></li>
                    <li class="red2"></li>
                    <li></li>
                  </ul>
                  <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                  </ul>
                  <ul>
                    <li class="red2"></li>
                    <li></li>
                    <li class="red2"></li>
                  </ul>
                </a>
              </div>
            </div>
          
        </div>
      </div>
      <!--End Sticky Header-->

      <!-- Mobile Menu  -->
      <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><span class="icon flaticon-multiply"></span></div>

        <nav class="menu-box">
          <div class="nav-logo"><a href="<?php echo e(Route('home')); ?>"><img
                src="<?php echo e(asset('site_assets')); ?>/images/resources/logo.png" alt="" title="" style="width:90px;"></a></div>
          <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
          <!--Social Links-->
          <div class="social-links">
            <ul class="clearfix">
              <li><a href="#"><span class="fab fa fa-facebook-square"></span></a></li>
              <li><a href="#"><span class="fab fa fa-twitter-square"></span></a></li>
              <li><a href="#"><span class="fab fa fa-pinterest-square"></span></a></li>
              <li><a href="#"><span class="fab fa fa-google-plus-square"></span></a></li>
              <li><a href="#"><span class="fab fa fa-youtube-square"></span></a></li>
            </ul>
          </div>
        </nav>
      </div>
      <!-- End Mobile Menu -->
    </header>

    <?php echo $__env->yieldContent('content'); ?>


    <!--Start footer area-->
    <footer class="footer-area">
      <div class="footer-bg" style="background-image: url(<?php echo e(asset('site_assets')); ?>/images/shape/footer-bg.png)"></div>
      <div class="footer">
        <div class="container">
          <div class="row">
            <div class="col-xl-12">
              <div class="footer-logo">
                <div class="logo">
                  <a href="index-2.html"><img src="<?php echo e(asset('site_assets')); ?>/images/footer/footer-logo.png"
                      alt="Awesome Footer Logo" title="Logo"></a>
                </div>
                <div class="copy-right">
                  <p>All rights reserved</p>
                  <h4>Pip Frames - 2025</h4>
                </div>
              </div>
              <div class="footer-menu">
                <ul>
                  <?php
                    use App\Models\Page;
                    $footerPages = Page::where('status', 'published')->get();
                  ?>
                  <?php $__currentLoopData = $footerPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a href="<?php echo e(route('page.show', $page->slug)); ?>"><?php echo e($page->page_name); ?></a></li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
              </div>
              <!-- Footer Contact Info -->
              <div class="footer-contact-info">
                <?php if($contact->show_on_footer && !empty($contact->contact_number)): ?>
                  <div class="single-box">
                    <div class="icon"><span class="icon-phone-call"></span></div>
                    <div class="title">
                      <span>Customer Support</span>
                      <h3><a href="tel:<?php echo e($contact->contact_number); ?>"><?php echo e($contact->contact_number); ?></a></h3>
                    </div>
                  </div>
                <?php endif; ?>

                <?php if($contact->show_on_footer && !empty($contact->email)): ?>
                  <div class="single-box">
                    <div class="icon"><span class="icon-envelope"></span></div>
                    <div class="title">
                      <span>Support Email</span>
                      <h3><a href="mailto:<?php echo e($contact->email); ?>"><?php echo e($contact->email); ?></a></h3>
                    </div>
                  </div>
                <?php endif; ?>

                <?php if(!empty($contact->full_address)): ?>
                  <div class="single-box">
                    <div class="icon"><span class="icon-pin-2"></span></div>
                    <div class="title">
                      <span>Address</span>
                      <h3><?php echo e($contact->full_address); ?></h3>
                    </div>
                  </div>
                <?php endif; ?>
              </div>

              <!-- <div class="footer-contact-info">
                <div class="single-box">
                  <div class="icon">
                    <span class="icon-phone-call"></span>
                  </div>
                  <div class="title">
                    <span>Customer Support</span>
                    <h3><a href="tel:+01132 874724">+01132 874724</a></h3>
                  </div>
                </div>
                <div class="single-box">
                  <div class="icon">
                    <span class="icon-phone-call"></span>
                  </div>
                  <div class="title">
                    <span>Support Email</span>
                    <h3><a href="mailto:andy@pipframes.co.uk">andy@pipframes.co.uk</a></h3>
                  </div>
                </div>
                <div class="single-box">
                  <div class="icon">
                    <span class="icon-phone-call"></span>
                  </div>
                  <div class="title">
                    <span>Address</span>
                    <h3>Unit 7 Lotherton Way Garforth Leeds LS252JY</h3>
                  </div>
                </div>
                <div class="footer-social-info">
                  <a href="#" class="fb-clr"><i class="fa fa-facebook"></i></a>
                  <a href="#" class="tw-clr"><i class="fa fa-twitter"></i></a>
                  <a href="#" class="you-clr"><i class="fa fa-youtube"></i></a>
                  <a href="#" class="sk-clr"><i class="fa fa-skype"></i></a>
                </div>
              </div> -->

            </div>

          </div>
        </div>
      </div>
    </footer>
    <!--End footer area-->
  </div>
  <button class="scroll-top scroll-to-target" data-target="html">
    <span class="fa fa-angle-up"></span>
  </button>


  <?php echo $__env->yieldPushContent('after-scripts'); ?>
  <script src="<?php echo e(asset('site_assets')); ?>/js/jquery.js"></script>
  <script src="<?php echo e(asset('site_assets')); ?>/js/aos.js"></script>
  <script src="<?php echo e(asset('site_assets')); ?>/js/appear.js"></script>
  <script src="<?php echo e(asset('site_assets')); ?>/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo e(asset('site_assets')); ?>/js/bootstrap-select.min.js"></script>
  <script src="<?php echo e(asset('site_assets')); ?>/js/isotope.js"></script>
  <script src="<?php echo e(asset('site_assets')); ?>/js/jquery.bootstrap-touchspin.js"></script>
  <script src="<?php echo e(asset('site_assets')); ?>/js/jquery.countdown.min.js"></script>
  <script src="<?php echo e(asset('site_assets')); ?>/js/jquery.countTo.js"></script>
  <script src="<?php echo e(asset('site_assets')); ?>/js/jquery.easing.min.js"></script>
  <script src="<?php echo e(asset('site_assets')); ?>/js/jquery.enllax.min.js"></script>
  <script src="<?php echo e(asset('site_assets')); ?>/js/jquery.fancybox.js"></script>
  <script src="<?php echo e(asset('site_assets')); ?>/js/jquery.mixitup.min.js"></script>
  <script src="<?php echo e(asset('site_assets')); ?>/js/jquery.paroller.min.js"></script>
  <script src="<?php echo e(asset('site_assets')); ?>/js/jquery.polyglot.language.switcher.js"></script>
  <script src="<?php echo e(asset('site_assets')); ?>/js/map-script.js"></script>
  <script src="<?php echo e(asset('site_assets')); ?>/js/nouislider.js"></script>
  <script src="<?php echo e(asset('site_assets')); ?>/js/owl.js"></script>
  <script src="<?php echo e(asset('site_assets')); ?>/js/timePicker.js"></script>
  <script src="<?php echo e(asset('site_assets')); ?>/js/validation.js"></script>
  <script src="<?php echo e(asset('site_assets')); ?>/js/wow.js"></script>
  <script src="<?php echo e(asset('site_assets')); ?>/js/jquery.magnific-popup.min.js"></script>
  <script src="<?php echo e(asset('site_assets')); ?>/js/slick.js"></script>
  <script src="<?php echo e(asset('site_assets')); ?>/js/lazyload.js"></script>
  <script src="<?php echo e(asset('site_assets')); ?>/js/scrollbar.js"></script>
  <script src="<?php echo e(asset('site_assets')); ?>/js/tilt.jquery.js"></script>
  <script src="<?php echo e(asset('site_assets')); ?>/js/jquery.bxslider.min.js"></script>
  <script src="<?php echo e(asset('site_assets')); ?>/js/jquery-ui.js"></script>
  <script src="<?php echo e(asset('site_assets')); ?>/js/parallax.min.js"></script>
  <script src="<?php echo e(asset('site_assets')); ?>/js/jquery.tinyscrollbar.js"></script>
  <script src="<?php echo e(asset('site_assets')); ?>/js/jQuery.style.switcher.min.js"></script>
  <!-- thm custom script -->
  <script src="<?php echo e(asset('site_assets')); ?>/js/custom.js"></script>



</body>

<!-- Mirrored from mehedi.asiandevelopers.com/demo/carepress/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 18 Aug 2025 10:10:25 GMT -->

</html><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/layouts/new-master.blade.php ENDPATH**/ ?>