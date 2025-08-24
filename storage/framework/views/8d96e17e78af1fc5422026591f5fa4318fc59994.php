<?php
  $type = isset($m_type) ? $m_type : null;
  $meta = App\Models\SiteMetaContent::where('slug', $type)->first();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
  <title><?php echo e($meta ? $meta->title : 'Book Printer | Book Publishers, Printing and Binding UK'); ?></title>
  <meta name="keywords" content="<?php echo e($meta ? $meta->keywords : 'Book Printer | Book Publishers, Printing and Binding UK'); ?>">
  <meta name="description" content="<?php echo e($meta ? $meta->description : 'Book Printer | Book Publishers, Printing and Binding UK'); ?>">
  
  <meta property="og:locale" content="<?php echo e($meta ? $meta->og_locale : ''); ?>" />
  <meta property="og:type" content="<?php echo e($meta ? $meta->og_type : ''); ?>" />
  <meta property="og:title" content="<?php echo e($meta ? $meta->og_title : ''); ?>" />
  <meta property="og:image" content="<?php echo e($meta ? $meta->og_image : ''); ?>"/>
  <meta property="og:description" content="<?php echo e($meta ? $meta->og_description : ''); ?>"/>
  <meta property="og:url" content="<?php echo e($meta ? $meta->og_tag : ''); ?>"/>
  <meta property="og:site_name" content="<?php echo e($meta ? $meta->og_site_name : ''); ?>" />

  <meta property="article:publisher" content="<?php echo e($meta ? $meta->publisher : ''); ?>" />

  <meta name="twitter:card" content="<?php echo e($meta ? $meta->twitter_card : ''); ?>"/>
  <meta name="twitter:description" content="<?php echo e($meta ? $meta->twitter_description : ''); ?>"/>
  <meta name="twitter:title" content="<?php echo e($meta ? $meta->twitter_title : ''); ?>"/>
  <meta name="twitter:site" content="<?php echo e($meta ? $meta->twitter_site : ''); ?>"/>
  <meta name="twitter:domain" content="<?php echo e($meta ? $meta->twitter_tag_url : ''); ?>"/>
  <meta name="twitter:creator" content="<?php echo e($meta ? $meta->twitter_creator : ''); ?>"/>
  <meta name="twitter:image" content="<?php echo e($meta ? $meta->twitter_image : ''); ?>">

  <link rel="canonical" href="<?php echo e($meta ? $meta->canonical_link : ''); ?>" />

  <link href="<?php echo e(asset('site_assets')); ?>/images/favicon.png" rel="icon">
  <link href="<?php echo e(asset('site_assets')); ?>/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo e(asset('site_assets')); ?>/css/all.min.css" rel="stylesheet">
  <!--<link href="<?php echo e(asset('site_assets')); ?>/css/bootstrap-icons.css" rel="stylesheet">
  <link href="<?php echo e(asset('site_assets')); ?>/css/boxicons.min.css" rel="stylesheet">-->
  <link rel="stylesheet" href="<?php echo e(asset('site_assets')); ?>/css/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
  <link rel="stylesheet" href="<?php echo e(asset('site_assets')); ?>/css/lightbox.css">
  <link href="<?php echo e(asset('site_assets')); ?>/css/style.css" rel="stylesheet">

  <link href="<?php echo e(asset('site_assets')); ?>/css/price.css" rel="stylesheet">
<link href="<?php echo e(asset('site_assets/css/price-online-shop.css')); ?>" rel="stylesheet">
  <!--<script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>-->
  <meta name="google-site-verification" content="x6F-50UIc6Ah17Y1RdACj_-2ZQ-Mw0dFX2lkNjr4oO8" />


  <style>
   .error{ color:red; } 
  </style>
  <?php echo $__env->yieldPushContent('styles'); ?>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-0XETFD4J0S"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-0XETFD4J0S');
  </script>
  
  
  <!-- Global site tag (gtag.js) - Google Ads: 947565175 -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=AW-947565175"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'AW-947565175');
  </script>
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-MNFFQB8');</script>
  <!-- End Google Tag Manager -->
	<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "Book printers",
  "name": "Bookempire",
  "url": "https://bookempire.co.uk/",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "https://bookempire.co.uk/",
    "query-input": "required name=search_term_string"
  }
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Book Printer",
  "name": "Book Printer Bookempire Book Publishers Printing and Binding",
  "alternateName": "Bookempire",
  "url": "https://bookempire.co.uk/",
  "logo": "https://bookempire.co.uk/public/site_assets/images/logo.png",
  "sameAs": [
    "https://www.facebook.com/ukbookempire",
    "https://www.instagram.com/bookempire2007/"
  ]
}
</script>
</head>

<body>



  <?php echo $__env->yieldContent('content'); ?>

    <!-- Modal -->
  <div class="modal fade" id="requestCallback" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="requestCallbackLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="requestCallbackLabel">Request Callback</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body contact">
          <form action="javascript:void(0)" id="requestCallbackForm" method="post" role="form" class="php-email-form">
            <?php echo csrf_field(); ?>
            <div class="row">
              <div class="col-md-6 form-group">
                <label class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Your Name" required>
              </div>
              <div class="col-md-6 form-group">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Your Email" required>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 form-group mt-3">
                <label class="form-label">Phone</label>
                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Contact Number" required>
              </div>
              <div class="col-md-6 form-group mt-3">
                <label class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
              </div>
            </div>
            <div class="form-group mt-3">
                <label class="form-label">Message</label>
              <textarea class="form-control" name="message" id="message" rows="5" placeholder="Message" required></textarea>
            </div>
            <div class="alert alert-success d-none" id="msg_div">
              <span id="res_message"></span>
          </div>
            <div class="text-center"><button type="submit" id="send_form">Send Message</button></div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="fas fa-chevron-up"></i></a>

  <script src="<?php echo e(asset('site_assets')); ?>/js/jquery-3.6.0.min.js"></script>
  <!--<script async src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>  
  <script async src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/additional-methods.min.js"></script>-->
  <script async src="<?php echo e(asset('site_assets')); ?>/js/iconify.min.js"></script>
  <script async src="<?php echo e(asset('site_assets')); ?>/js/sweetalert.min.js"></script>
  <script async src="<?php echo e(asset('site_assets')); ?>/js/jquery.validate.js"></script>
  <script async src="<?php echo e(asset('site_assets')); ?>/js/additional-methods.min.js"></script>
  <script src="<?php echo e(asset('site_assets')); ?>/js/owl.carousel.min.js"></script>
  <script async src="<?php echo e(asset('site_assets')); ?>/js/bootstrap.bundle.min.js"></script>
  <script async src="<?php echo e(asset('site_assets')); ?>/js/purecounter.js"></script>
  <script async src="<?php echo e(asset('site_assets')); ?>/js/lightbox.min.js"></script>
  <script async src="<?php echo e(asset('site_assets')); ?>/js/main.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
	
var video_wrapper = $('.youtube-video-place');
if(video_wrapper.length){
$('.play-youtube-video').on('click', function(){video_wrapper.html('<iframe width="100%" height="315" allowfullscreen frameborder="0" class="embed-responsive-item" src="' + video_wrapper.data('yt-url') + '"></iframe>');});};
  
var video_wrapper1 = $('.youtube-video-place1');
if(video_wrapper1.length){
$('.play-youtube-video1').on('click', function(){video_wrapper1.html('<iframe width="100%" height="315" allowfullscreen frameborder="0" class="embed-responsive-item" src="' + video_wrapper1.data('yt-url') + '"></iframe>');});};
  
function openNav() {
  document.getElementById("mySidenav").style.width = "300px";
}
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
};

    $(document).ready(function() {
      $('.home-slider').owlCarousel({
        loop: true,
        margin: 0,
        responsiveClass: true,
        autoplay: true,
        singleItem: true,
        responsive: {
          0: {
            items: 1,
            nav: true,
            dots: false
          },
          600: {
            items: 1,
            nav: true,
            dots: false
          },
          1000: {
            items: 1,
            nav: true,
            dots: false
          }
        }
      })
    });
    $(document).ready(function() {
      $('.testimonial-slider').owlCarousel({
        loop: true,
        margin: 0,
        responsiveClass: true,
        responsive: {
          0: {
            items: 1,
            nav: true,
            dots: false
          },
          600: {
            items: 1,
            nav: true,
            dots: false
          },
          1000: {
            items: 1,
            nav: true,
            dots: false
          }
        }
      })
    });

    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
      var fileName = $(this).val().split("\\").pop();
      $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
  </script>
  <?php echo $__env->yieldPushContent('scripts'); ?>


  <script>
    $(document).ready(function(){
      
   if ($("#requestCallbackForm").length > 0) {
    $("#requestCallbackForm").validate({
      
    rules: {
      name: {
        required: true,
        maxlength: 50
      },
  
       mobile: {
            required: true,
            digits:true,
            minlength: 10,
            maxlength:15,
        },
        email: {
                required: true,
                maxlength: 50,
                email: true,
        },
        address: {
          required: true,
                
        },
        messages: {
          required: true,     
        }    
    },
    messages: {
        
      name: {
        required: "Please enter name",
        maxlength: "Your last name maxlength should be 50 characters long."
      },
      mobile: {
        required: "Please enter contact number",
        digits: "Please enter only numbers",
        minlength: "The contact number should be 10 digits",
        maxlength: "The contact number should be 12 digits",
      },
      email: {
          required: "Please enter valid email",
          email: "Please enter valid email",
          maxlength: "The email name should less than or equal to 50 characters",
        }
         
    },
    submitHandler: function(form) {
     $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      $('#send_form').html('Sending..');
      $.ajax({
        url: '' ,
        type: "POST",
        data: $('#requestCallbackForm').serialize(),
        success: function( response ) {
            $('#send_form').html('Submit');
      document.getElementById("requestCallbackForm").reset(); 
            return window.location = "<?php echo e(url('/thankyou')); ?>";
            $('#res_message').show();
            $('#res_message').html(response.msg);
            $('#msg_div').removeClass('d-none');
 
            document.getElementById("requestCallbackForm").reset(); 
            setTimeout(function(){
            $('#res_message').hide();
            $('#msg_div').hide();
            },10000);
        }
      });
    }
  });
}

      
    });
  </script>
  <!-- End Modal -->

<?php /**PATH D:\web-mingo-project\pip_frames\resources\views/layouts/app.blade.php ENDPATH**/ ?>