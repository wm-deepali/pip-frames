

<?php $__env->startSection('title', 'Thank You'); ?>

<?php $__env->startSection('content'); ?>
    <section class="featured-area">
        <div class="container py-5 text-center">
            <h1 class="mb-4">Thank You for Your Order!</h1>
            <p>Your order has been placed successfully. We will process it shortly.</p>
            <a href="<?php echo e(url('/')); ?>" class="btn btn-primary mt-3">Return to Home</a>
        </div>

    </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/front/thankyou.blade.php ENDPATH**/ ?>