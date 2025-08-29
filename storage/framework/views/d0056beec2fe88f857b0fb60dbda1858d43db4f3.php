

<?php $__env->startSection('title'); ?>
  Contact || CarePress
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <!--Start breadcrumb area-->
  <section class="breadcrumb-area"
    style="background-image: url(<?php echo e(asset('site_assets')); ?>/images/breadcrumb/breadcrumb-1.png);">
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
              <li><a href="mailto:<?php echo e($contact->email ?? 'andy@pipframes.co.uk'); ?>"><?php echo e($contact->email ??
                  'andy@pipframes.co.uk'); ?></a></li>
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
              <li><a
                  href="tel:<?php echo e($contact->contact_number ?? '+01132 874724'); ?>"><?php echo e($contact->contact_number ?? '+01132 874724'); ?></a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="400ms">
          <div class="single-contact-info-box">
            <span class="icon-pin-2"></span>
            <div class="title">
              <h3>Office Address<span class="dotted"></span></h3>
            </div>
            <p><?php echo e($contact->full_address ?? "Unit 7 Lotherton Way Garforth Leeds LS252JY"); ?></p>
          </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="600ms">
          <div class="single-contact-info-box">
            <span class=" icon-mail-1"></span>
            <div class="title">
              <h3>Web Connection<span class="dotted"></span></h3>
            </div>
            <p>
              <?php if(!empty($contact->website_url)): ?>
                <a href="<?php echo e($contact->website_url); ?>" target="_blank" rel="noopener"><?php echo e($contact->website_url); ?></a>
              <?php else: ?>
                Not Available
              <?php endif; ?>
            </p>
          </div>
        </div>

      </div>
    </div>
  </section>
  <!--End Contact Info Area-->


  <!--Start Contact Form Style1 Area-->
  <section class="contact-form-style1-area">
    <div class="contact-form-style1-bg"
      style="background-image: url(<?php echo e(asset('site_assets')); ?>/images/shape/contact-form-style1-bg.png)">
    </div>
    <div class="container">
      <div class="sec-title text-center">
        <h5>//<span>Contact Us</span>//</h5>
        <h2>Get In Touch<span class="round-box zoominout"></span></h2>
      </div>
      <div class="row">
        <div class="col-xl-12">
          <div class="contact-form contact-page">
            <form id="contact-form" method="POST" action="<?php echo e(route('contact.store')); ?>">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-xl-4 col-lg-4">
            <div class="input-box">
                <input type="text" name="form_name" placeholder="Your name" required>
                <div class="icon"><span class="icon-user"></span></div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4">
            <div class="input-box">
                <input type="email" name="form_email" placeholder="Email address" required>
                <div class="icon"><span class="icon-envelope"></span></div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4">
            <div class="input-box">
                <select class="selectpicker" name="form_selected_subject" data-width="100%">
                    <option selected="selected">Select Subject</option>
                    <option>People Frames</option>
                    <option>Pet Frames</option>
                    <option>Illustration Frames</option>
                    <option>Others</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6">
            <div class="input-box">
                <input type="text" name="form_phone" placeholder="Phone number">
                <div class="icon"><span class="icon-phone"></span></div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="input-box">
                <input type="text" name="form_subject" placeholder="Subject">
                <div class="icon"><span class="icon-pen"></span></div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="input-box">
                <textarea name="form_message" placeholder="Write message" required></textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="button-box text-center">
                <button class="btn-one gradient-bg-1" type="submit">
                    <span class="txt"><i class="icon-send"></i>Submit Now</span>
                </button>
            </div>
        </div>
    </div>
</form>

            <form id="contact-form" name="contact_form" class="default-form2"
              action="https://mehedi.asiandevelopers.com/demo/carepress/<?php echo e(asset('site_assets')); ?>/inc/sendmail.php"
              method="post">
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
                      <option>People Frames</option>
                      <option>Pet Frames</option>
                      <option>Illustration Frames</option>
                      <option>Others</option>
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
        data-hue="#ffc400" data-title="Envato" data-icon-path="<?php echo e(asset('site_assets')); ?>/images/resources/map-marker.png"
        data-content="Unit 7 Lotherton Way Garforth Leeds LS252JY<br><a href='mailto:andy@pipframes.co.uk'>andy@pipframes.co.uk</a>">
      </div>
    </div>
  </section>
  <!--End Google Map Area-->

<?php $__env->stopSection(); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$('#contact-form').on('submit', function(e) {
    e.preventDefault();

    $.ajax({
        url: "<?php echo e(route('contact.store')); ?>",
        method: "POST",
        data: $(this).serialize(),
        success: function(response) {
            if (response.success) {
                alert(response.message);
                $('#contact-form')[0].reset();
            }
        },
        error: function(xhr) {
            let errors = xhr.responseJSON.errors;
            let errorMessage = "Please fix the following errors:\n";
            $.each(errors, function(key, value) {
                errorMessage += "- " + value[0] + "\n";
            });
            alert(errorMessage);
        }
    });
});
</script>

<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/front/contact-us.blade.php ENDPATH**/ ?>