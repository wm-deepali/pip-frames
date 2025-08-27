

<?php $__env->startSection('title'); ?>
    <?php echo e($page->meta_title ?? $page->title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('meta_tags'); ?>
    <meta name="title" content="<?php echo e($page->meta_title); ?>">
    <meta name="description" content="<?php echo e($page->meta_description); ?>">
    <meta name="keywords" content="<?php echo e($page->meta_keyword); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if($page && $page->status === 'published'): ?>
        <!--Start breadcrumb area-->
        <section class="breadcrumb-area"
            style="background-image: url(<?php echo e(asset('site_assets')); ?>//images/breadcrumb/breadcrumb-1.png);">
            <div class="banner-curve-gray"></div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="inner-content clearfix text-center">
                            <div class="title wow slideInUp animated" data-wow-delay="0.3s" data-wow-duration="1500ms">
                                <h2><?php echo e($page->page_name); ?><span class="dotted"></span></h2>
                            </div>
                            <div class="breadcrumb-menu wow slideInDown animated" data-wow-delay="0.3s"
                                data-wow-duration="1500ms">
                                <ul class="clearfix">
                                    <li><a href="index-2.html">Home</a></li>
                                    <li class="active"><?php echo e($page->page_name); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End breadcrumb area-->
        <!--Start Contact Info Area-->
        <section class="contact-info-area style3" style="margin-bottom:50px">
            <div class="container">
                <div class="row">
                    <?php echo $page->detail; ?>

                </div>
            </div>
        </section>

    <?php else: ?>
        <div class="page-wrapper">
            <div class="page-content text-center py-5">
                <h3>Page not found or unpublished.</h3>
            </div>
        </div>
    <?php endif; ?>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.new-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/front/dynamic_page.blade.php ENDPATH**/ ?>