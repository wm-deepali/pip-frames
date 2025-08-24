

<?php $__env->startSection('content'); ?>
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">

    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
      <h2 class="content-header-title">Image Conditions</h2>
      </div>
      <div class="content-header-right col-md-3 col-12">
      <a href="<?php echo e(route('admin.images.create')); ?>" class="btn btn-primary float-right">Add New</a>
      </div>
    </div>

    <div class="content-body">
      <section id="image-conditions-list">
      <div class="card">
        <div class="card-body table-responsive">
        <table class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>#</th>
            <th>Subcategory</th>
            <th>Dependencies</th>
            <th>Affected Attribute</th>
            <th>Affected Values + Image</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tbody>
          <?php $__empty_1 = true; $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $condition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr>
          <td><?php echo e($index + 1); ?></td>
          <td><?php echo e($condition->subcategory->name ?? '-'); ?></td>

          
          <td>
          <?php if($condition->dependencies->count()): ?>
          <ul class="mb-0 pl-3">
          <?php $__currentLoopData = $condition->dependencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li>
          <?php echo e($dep->attribute->name ?? 'Attribute'); ?>

          =
          <?php echo e($dep->value->value ?? 'Value'); ?>

          </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        <?php else: ?>
        <span class="text-muted">None</span>
        <?php endif; ?>
          </td>

          
          <td><?php echo e($condition->affectedAttribute->name ?? '-'); ?></td>

          
          <td>
          <?php if($condition->affectedValues->count()): ?>
          <ul class="mb-0 pl-3">
          <?php $__currentLoopData = $condition->affectedValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li>
          <?php echo e($val->value->value ?? '-'); ?>

          <?php if($val->image): ?>
          <br>
          <img src="<?php echo e(asset('storage/' . $val->image)); ?>" alt="value image" width="80"
          class="mt-1 border rounded">
        <?php endif; ?>
          </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        <?php else: ?>
        <span class="text-muted">None</span>
        <?php endif; ?>
          </td>
<td>
          <a href="<?php echo e(route('admin.images.edit', $condition->id)); ?>" class="btn btn-sm btn-info">Edit</a>
          <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="<?php echo e($condition->id); ?>">
            Delete
          </button>
          </td>

          </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
        <td colspan="6" class="text-center text-muted">No conditions found</td>
        </tr>
      <?php endif; ?>
          </tbody>
        </table>
        </div>
      </div>
      </section>
    </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
    $(document).ready(function () {
        $('.btn-delete').on('click', function () {
            let id = $(this).data('id');

            Swal.fire({
                title: "Are you sure?",
                text: "This condition will be permanently deleted!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?php echo e(url('admin/images')); ?>/" + id,  // adjust route prefix if needed
                        type: "POST",
                        data: {
                            _method: "DELETE",
                            _token: "<?php echo e(csrf_token()); ?>"
                        },
                        success: function (res) {
                            if (res.success) {
                                Swal.fire(
                                    "Deleted!",
                                    "Condition has been deleted.",
                                    "success"
                                );

                                // remove row from table
                                $("button[data-id='" + id + "']").closest('tr').fadeOut(500, function() {
                                    $(this).remove();
                                });
                            } else {
                                Swal.fire("Error", "Something went wrong!", "error");
                            }
                        },
                        error: function () {
                            Swal.fire("Error", "Server error, try again!", "error");
                        }
                    });
                }
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/admin/images/index.blade.php ENDPATH**/ ?>