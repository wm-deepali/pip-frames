

<?php $__env->startSection('content'); ?>

  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
        <div class="breadcrumb-wrapper">
          <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
          <li class="breadcrumb-item"><a href="<?php echo e(route('admin.customers')); ?>">Customer Listing</a></li>
          <li class="breadcrumb-item active">Customer Detail</li>
          </ol>
        </div>
        </div>
      </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <h4 class="card-title">Customer Detail</h4>
        </div>
        <div class="card-body">
          <div class="row mb-2">
          <div class="col-md-2 text-center">
            <img
            src="<?php echo e($customer->profile_pic ? asset('storage/' . $customer->profile_pic) : asset('images/default-avatar.png')); ?>"
            class="profile-img mb-3" alt="Customer Profile" style="width:110px;">
          </div>
          <div class="col-md-8" style="margin-left:-30px;">
            <h5><?php echo e($customer->first_name); ?> <?php echo e($customer->last_name); ?></h5>
            <p><strong>Display Name:</strong> <?php echo e($customer->display_name); ?></p>
            <p><strong>Email:</strong> <?php echo e($customer->email); ?></p>
            <p><strong>Contact Number:</strong> <?php echo e($customer->mobile); ?></p>
            <!-- <p><strong>Full Address:</strong> <?php echo e($customer->address); ?></p> -->
          </div>
          </div>

          <!-- Bootstrap Tabs -->
          <ul class="nav nav-tabs mb-3" id="customerTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="enquiries-tab" data-toggle="tab" data-target="#enquiries"
            type="button" role="tab" aria-controls="enquiries" aria-selected="true">Enquiries</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="addresses-tab" data-toggle="tab" data-target="#addresses" type="button"
            role="tab" aria-controls="addresses" aria-selected="false">Addresses</button>
          </li>
          </ul>

          <div class="tab-content" id="customerTabContent">
          <!-- Enquiries Tab -->
          <div class="tab-pane fade show active" id="enquiries" role="tabpanel" aria-labelledby="enquiries-tab">
            <div class="table-responsive">
            <table class="table" id="enquiries-table">
              <thead>
              <tr>
                <th>Date & Time</th>
                <th>Quote ID</th>
                <th>Order ID</th>
                <th>Product</th>
                <th>Estimated Cost</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              <?php $__empty_1 = true; $__currentLoopData = $customer->quotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
              <td><?php echo e($quote->created_at->format('Y-m-d H:i')); ?></td>
              <td>#<?php echo e($quote->quote_number); ?></td>
                <td>#<?php echo e($quote->order_number); ?></td>
              <?php
          $subcategory = optional($quote->items->first())->subcategory;
          $category = $subcategory?->categories->first();
          ?>
              <td>
              <?php echo e($category?->name ?? '-'); ?> >
              <?php echo e($subcategory?->name ?? '-'); ?>

              </td>
              <td>£<?php echo e(number_format($quote->grand_total, 2)); ?></td>
              <td>
              <a href="<?php echo e(route('admin.quote.show', $quote->id)); ?>" class="btn btn-sm btn-info">View
              Quotation</a>
              </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <tr>
          <td colspan="5" class="text-center">No quotes found.</td>
          </tr>
        <?php endif; ?>
              </tbody>
            </table>
            </div>
          </div>

          <!-- Addresses Tab -->
          <div class="tab-pane fade" id="addresses" role="tabpanel" aria-labelledby="addresses-tab">
            <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
              <tr>
                <th>Type</th>
                <th>Tag</th>
                <th>Default</th>
                <th>Address Line</th>
                <th>City</th>
                <th>State</th>
                <th>Postal Code</th>
                <th>Country</th>
              </tr>
              </thead>
              <tbody>
              <?php $__empty_1 = true; $__currentLoopData = $customer->addresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $address): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr>
          <td><?php echo e(ucfirst($address->type)); ?></td>
          <td><?php echo e(ucfirst($address->address_tag)); ?></td>
          <td><?php echo e($address->is_default ? 'Yes' : 'No'); ?></td>
          <td><?php echo e($address->address_line1); ?> <?php echo e($address->address_line2); ?></td>
          <td><?php echo e($address->cityname->name ?? ''); ?></td>
          <td><?php echo e($address->statename->name ?? ''); ?></td>
          <td><?php echo e($address->postal_code); ?></td>
          <td><?php echo e($address->countryname->name ?? ''); ?></td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <tr>
          <td colspan="6" class="text-center">No addresses found.</td>
          </tr>
        <?php endif; ?>
              </tbody>
            </table>
            </div>
          </div>

          </div>
        </div>

        </div>
      </div>
      </div>
    </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/admin/customer_estimates/customer_detail.blade.php ENDPATH**/ ?>