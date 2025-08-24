
<?php $__env->startSection('content'); ?>

<section class="page-header-section" style="background: url(<?php echo e(asset('site_assets')); ?>/images/banner-1.jpg) no-repeat;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-7">
        <div class="page-header-block">
          <h1>404 Error</h1>
          <h2 class="stylish-font">Page Not Found</h2>
          <p>Your search page not found</p>
          <div class="page-header-buttons">
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#requestCallback">Request Callback</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<style>
.error-error-blk {
  text-align: center;
}
.error-error-blk h3 {
  font-size: 120px;
  margin: 0;
}
.error-error-blk h4 {
  font-size: 30px;
  margin: 0 0 15px;
}
.error-error-blk p {
  font-size: 18px;
}
.error-error-blk a {
  background: #fcd63c;
  color: #000;
  padding: 9px 20px;
  display: inline-block;
  font-weight: bold;
  border-radius: 4px;
}
</style>
<main id="main">
  <section class="error-box-section">
	  <div class="container">
		  <div class="row justify-content-center">
			  <div class="col-md-6">
				  <div class="error-error-blk">
					  <h3>404</h3>
					  <h4>Page Not Found</h4>
					  <p>The page you are looking for doesn't exist or an other error occurred.</p>
					  <a href="/">Back to Home</a>
				  </div>
			  </div>
		  </div>
	  </div>
  </section>
</main>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/errors/404.blade.php ENDPATH**/ ?>