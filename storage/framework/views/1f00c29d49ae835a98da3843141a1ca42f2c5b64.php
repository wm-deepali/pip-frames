<div class="card mt-2">
  <div class="card-header">
    <h4 class="card-title">Quote Requests - New Orders</h4>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Date & Time</th>
            <th>Quote ID</th>
            <th>Product</th>
            <th>Billed Amount</th>
            <th>Payment Status</th>
            <th>Order Status</th>
            <th>Customer Info</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $quotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
        <td><?php echo e($quote->created_at->format('Y-m-d H:i')); ?></td>
        <td>#<?php echo e($quote->quote_number); ?></td>
        <td>
          <?php echo e(optional($quote->items->first()->subcategory->categories->first())->name ?? '-'); ?>

          >
          <?php echo e(optional($quote->items->first()->subcategory)->name ?? '-'); ?>

        </td>
        <td>£<?php echo e(number_format($quote->grand_total, 2)); ?></td>

        <td> <?php if($quote->payments->isEmpty()): ?>
        <!-- No payment exists, show Pay Now -->
        <span class="badge badge-danger">UnPaid</span>
      <?php else: ?>
        <!-- Payment exists, show Paid badge -->
        <span class="badge badge-success">Paid</span>
      <?php endif; ?>
        </td>

        <td><?php echo e($quote->status ?? ''); ?></td>
        <td>
          <?php echo e($quote->customer->first_name ?? '-'); ?> <?php echo e($quote->customer->last_name ?? ''); ?><br>
          <?php echo e($quote->customer->email ?? '-'); ?><br>
          <?php echo e($quote->customer->mobile ?? '-'); ?>

        </td>

        <td>
            <?php if($quote->payments->isEmpty()): ?>
          <!-- No payment exists, show Pay Now -->
          <button class="btn btn-sm btn-success pay-now-btn mb-1" data-quote-id="<?php echo e($quote->id); ?>"
            data-order-value="<?php echo e($quote->grand_total); ?>">
            Pay Now
          </button>
          <?php else: ?>
          <a href="<?php echo e(route('admin.quotes.invoice', $quote->id)); ?>"
            class="btn btn-sm btn-dark mb-1">View Invoice</a>
          <?php endif; ?>
          <a href="<?php echo e(route('admin.quote.show', $quote->id)); ?>" class="btn btn-sm btn-info mb-1">View
          Order
          Detail</a>
          <a href="<?php echo e(route('admin.customers.detail', $quote->customer->id)); ?>"
          class="btn btn-sm btn-primary mb-1">View Customer Detail</a>
          <button class="btn btn-sm btn-warning mb-1 change-status-btn" data-toggle="modal"
          data-target="#changeStatusModal" data-quote-id="<?php echo e($quote->id); ?>">
          Change Status
          </button>
          <!-- <a href="<?php echo e(route('admin.quote.index')); ?>" class="btn btn-sm btn-dark mb-1">View Invoice</a> -->
        </td>
        </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>
      </table>
    </div>
  </div>
</div><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/admin/quotes/tabs/new-order.blade.php ENDPATH**/ ?>