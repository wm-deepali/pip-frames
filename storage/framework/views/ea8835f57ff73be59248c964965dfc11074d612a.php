<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
  <meta name="description" content="Pip Frames">
  <meta name="keywords" content="Pip Frames">
  <title>Pip Frames</title>
  <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(URL::asset('admin_assets/images/favicon.png')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('admin_assets/css/flatpickr.min.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('admin_assets/css/bootstrap.min.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('admin_assets/css/bootstrap-extended.min.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('admin_assets/css/chart-apex.min.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('admin_assets/css/select2.min.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('admin_assets/css/form-flat-pickr.min.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('admin_assets/css/bs-stepper.min.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(URL::asset('admin_assets/css/style.css')); ?>">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.11.1/css/jquery.dataTables.css">
  <script src="<?php echo e(URL::asset('admin_assets/js/tree.js')); ?>"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	 <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>


  <style>
   .error{ color:red; } 
  </style>
  <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="horizontal-layout horizontal-menu  navbar-floating footer-static" data-open="hover" data-menu="horizontal-menu" data-col="">
  
 <?php echo $__env->yieldPushContent('after-scripts'); ?>
  <?php echo $__env->make('partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php echo $__env->yieldContent('content'); ?>
  
  <?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\new\resources\views/layouts/master.blade.php ENDPATH**/ ?>