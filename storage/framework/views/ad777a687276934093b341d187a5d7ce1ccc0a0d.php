 <div class="card mt-2">
          <div class="card mt-2">
          <div class="card-header">
            <h4 class="card-title">Canceled Orders</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
            <table class="table">
              <thead>
              <tr>
                <th>Date & Time</th>
                <th>quote ID</th>
                <th>Order ID</th>
                <th>Product</th>
                <th>Billed Amount</th>
                <th>Payment Status</th>
                <th>Order Status</th>
                <th>Customer Info</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              <?php $__empty_1 = true; $__currentLoopData = $canceledQuotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
              <td><?php echo e($quote->created_at->format('Y-m-d H:i')); ?></td>
              <td>#<?php echo e($quote->quote_number); ?></td>
              <td><?php echo e($quote->order_number ?? '-'); ?></td>
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
              <?php if(!$quote->payments->isEmpty()): ?>
          <a href="<?php echo e(route('admin.quotes.invoice', $quote->id)); ?>"
            class="btn btn-sm btn-dark mb-1">View Invoice</a>
          <?php endif; ?>
              <a href="<?php echo e(route('admin.quote.show', $quote->id)); ?>" class="btn btn-sm btn-info mb-1">View
              Order Details</a>
              <a href="<?php echo e(route('admin.customers.detail', $quote->customer->id)); ?>"
              class="btn btn-sm btn-primary mb-1">View Customer Detail</a>
          
              <button class="btn btn-sm btn-secondary mb-1 view-notes-btn" data-toggle="modal"
              data-target="#viewNotesModal" data-quote-id="<?php echo e($quote->id); ?>">
              View All Notes
              </button>

              </td>
            </tr>
            <div id="quote-notes-<?php echo e($quote->id); ?>" class="d-none">
              <?php $__currentLoopData = $quote->departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-md-6">
          <div class="card border mb-3">
            <div class="card-body">
            <p><strong>Date & Time:</strong> <?php echo e($department->pivot->created_at ?? '-'); ?></p>
            <p><strong>Department:</strong> <?php echo e($department->name); ?></p>
            <p><strong>Notes:</strong> <?php echo e($department->pivot->notes ?? '-'); ?></p>
            </div>
          </div>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <tr>
          <td colspan="5" class="text-center">No approved orders found.</td>
          </tr>
        <?php endif; ?>
              </tbody>

            </table>
            </div>
          </div>
          </div>

        </div><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/admin/quotes/tabs/canceled.blade.php ENDPATH**/ ?>