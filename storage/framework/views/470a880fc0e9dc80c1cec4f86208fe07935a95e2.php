

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
          <li class="breadcrumb-item active">Customer Listing</li>
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
          <h4 class="card-title">Customer Listing</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table class="table" id="customer-table">
            <thead>
            <tr>
              <th>Date & Time</th>
              <th>Customer Info</th>
              <th>Total Quotes</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td><?php echo e($customer->created_at->format('Y-m-d H:i')); ?></td>
          <td>
          <?php echo e($customer->first_name); ?> <?php echo e($customer->last_name); ?><br>
          <?php echo e($customer->email); ?><br>
          <?php echo e($customer->mobile); ?>

          </td>
          <td><?php echo e($customer->quotes_count ?? 0); ?></td>
          <td>
          <a href="<?php echo e(route('admin.customers.detail', $customer->id)); ?>" class="btn btn-sm btn-info mr-1">View
          Customer Detail</a>
          <!-- <a href="" class="btn btn-sm btn-primary mr-1">View All Quotes</a> -->
          <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
          onclick="deleteConfirmation(<?php echo e($customer->id); ?>)">

          Delete Customer
          </button>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  <script>

    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    function deleteConfirmation(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "This will permanently delete the record!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonColor: '#d33'
    }).then((result) => {
      if (result.isConfirmed) {
      $.ajax({
        url: `/admin/customer/${id}`,
        type: "DELETE",
        success: function (response) {
        if (response.success) {
          Swal.fire('Deleted!', '', 'success');
          setTimeout(() => location.reload(), 300);
        } else {
          Swal.fire('Error', response.msgText, 'error');
        }
        }
      });
      }
    });
    }
  </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/admin/customer_estimates/customers.blade.php ENDPATH**/ ?>