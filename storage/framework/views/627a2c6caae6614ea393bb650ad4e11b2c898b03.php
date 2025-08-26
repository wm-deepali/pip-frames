<?php $__env->startPush('before-styles'); ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('after-styles'); ?>
    <style>
        /* .container {
              max-width: 1200px;
              margin: auto;
            } */

        .page-wrapper {
            height: auto;
        }

        .main-content {
            display: flex;
            gap: 1.5rem;
        }

        .left,
        .right {
            background-color: #fff;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .left {
            flex: 2;
        }

        .right {
            flex: 1;
        }

        h3 {
            margin-top: 0;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .input-row {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .option-buttons button {
            padding: 0.5rem 1rem;
            border: 1px solid #ccc;
            background-color: white;
            cursor: pointer;
            border-radius: 4px;
        }

        .option-buttons button.active {
            border: 2px solid #f42b5b;
        }

        .image-preview {
            background-color: #f0f0f0;
            height: 100px;
            width: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            font-size: 0.9rem;
            color: #666;
        }

        .thumbnail-list {
            display: flex;
            gap: 1rem;
            margin-top: 0.5rem;
        }

        .thumbnail-list img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
            border: 2px solid transparent;
        }

        .thumbnail-list img.selected {
            border-color: #f42b5b;
        }

        .slider-container {
            margin-top: 1rem;
        }

        input[type=range] {
            width: 100%;
        }

        .slider-values {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        .delivery-box {
            border: 2px solid #f42b5b;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
            background-color: #2e3c4d;
            color: white;
        }

        .delivery-box .best-value {
            color: gold;
            font-size: 0.8rem;
            margin-bottom: 0.5rem;
        }

        .design-options {
            display: flex;
            gap: 1rem;
            margin: 1rem 0;
        }

        .design-box {
            border: 1px solid #ccc;
            padding: 0.5rem;
            text-align: center;
            border-radius: 6px;
            flex: 1;
        }

        .btn-yellow {
            background-color: #ffcf00;
            border: none;
            padding: 0.75rem 1rem;
            width: 100%;
            font-weight: bold;
            cursor: pointer;
            border-radius: 6px;
            margin: 1rem 0;
        }

        .additional-links {
            font-size: 0.9rem;
            color: #555;
        }

        .additional-links a {
            color: #333;
            text-decoration: none;
        }

        .tab-container {
            margin-top: 1.5rem;
            background-color: #fff;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .tab-buttons {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .tab-buttons button {
            padding: 0.5rem 1rem;
            border: 1px solid #ccc;
            background-color: #f5f7fa;
            cursor: pointer;
            border-radius: 4px;
            font-weight: 500;
        }

        .tab-buttons button.active {
            background-color: #f42b5b;
            color: white;
            border-color: #f42b5b;
        }

        .tab-content {
            display: none;
            padding: 1rem;
            background-color: #f9f9f9;
            border-radius: 4px;
        }

        .tab-content.active {
            display: block;
        }
    </style>
    <style>
        .error {
            color: red;
            font-size: 0.875rem;
        }
    </style>
<?php $__env->stopPush(); ?>
<div class="col-lg-4">
    <div class="card shadow-none mb-3 mb-lg-0">
        <div class="card-body">
            <div class="list-group list-group-flush"> <a href="<?php echo e(route('account-dashboard')); ?>"
                    class="list-group-item  <?php echo e(($activeMenu ?? '') === 'dashboard' ? 'active' : 'bg-transparent'); ?> d-flex justify-content-between align-items-center">Dashboard
                    <i class='bx bx-tachometer fs-5'></i></a>
                <a href="<?php echo e(route('account-orders')); ?>"
                    class="list-group-item d-flex justify-content-between align-items-center  <?php echo e(($activeMenu ?? '') === 'orders' ? 'active' : 'bg-transparent'); ?> ">Orders
                    <i class='bx bx-cart-alt fs-5'></i></a>
                <a href="<?php echo e(route('account-downloads')); ?>"
                    class="list-group-item d-flex justify-content-between align-items-center <?php echo e(($activeMenu ?? '') === 'downloads' ? 'active' : 'bg-transparent'); ?>">Downloads
                    <i class='bx bx-download fs-5'></i></a>
                <a href="<?php echo e(route('account-addresses')); ?>"
                    class="list-group-item d-flex justify-content-between align-items-center <?php echo e(($activeMenu ?? '') === 'addresses' ? 'active' : 'bg-transparent'); ?>">Addresses
                    <i class='bx bx-home-smile fs-5'></i></a>
                <a href="<?php echo e(route('account-payment-methods')); ?>"
                    class="list-group-item d-flex justify-content-between align-items-center <?php echo e(($activeMenu ?? '') === 'payment-methods' ? 'active' : 'bg-transparent'); ?>">Payment
                    Methods <i class='bx bx-credit-card fs-5'></i></a>
                <a href="<?php echo e(route('account-user-details')); ?>"
                    class="list-group-item d-flex justify-content-between align-items-center <?php echo e(($activeMenu ?? '') === 'account-details' ? 'active' : 'bg-transparent'); ?>">Account
                    Details <i class='bx bx-user-circle fs-5'></i></a>
                <a href="<?php echo e(route('account-logout')); ?>"
                    class="list-group-item d-flex justify-content-between align-items-center <?php echo e(($activeMenu ?? '') === 'logout' ? 'active' : 'bg-transparent'); ?>">
                    Logout
                    <i class='bx bx-log-out fs-5'></i>
                </a>

            </div>
        </div>
    </div>
</div><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/layouts/includes/user-sidebar.blade.php ENDPATH**/ ?>