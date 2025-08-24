

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
                <li class="breadcrumb-item active">Combination Images</li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <a href="<?php echo e(route('admin.combination-image.create')); ?>" 
             class="btn-icon btn btn-primary btn-round btn-sm">Add Combination Image</a>
        </div>
      </div>
    </div>

    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Combination Images Listing</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="combination-table">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Subcategory</th>
                      <th>Attributes & Values</th>
                      <th>Preview Image</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $combinations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $combo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                      <tr>
                        <td><?php echo e($combo->id); ?></td>

                        <td>
                          <?php echo e($combo->subcategory->name ?? '-'); ?>

                        </td>

                        <td>
                          <?php $__currentLoopData = $combo->attribute_value_ids; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $valId): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                              $value = $attributeValues[$valId] ?? null;
                            ?>
                            <?php if($value): ?>
                              <span class="badge badge-light-primary">
                                <?php echo e($value->attribute->name); ?>: <?php echo e($value->value); ?>

                              </span>
                            <?php endif; ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </td>

                        <td>
                          <?php if($combo->preview_image): ?>
                            <img src="<?php echo e(asset('storage/' . $combo->preview_image)); ?>" 
                                 alt="Preview" width="100">
                          <?php else: ?>
                            <span class="text-muted">No Image</span>
                          <?php endif; ?>
                        </td>

                        <td>
                          <a href="<?php echo e(route('admin.combination-image.edit', $combo->id)); ?>" 
                             class="btn btn-sm btn-primary">
                            <i class="fas fa-edit"></i> Edit
                          </a>
                          <button class="btn btn-sm btn-danger" 
                                  onclick="deleteCombination(<?php echo e($combo->id); ?>)">
                            <i class="fas fa-trash"></i> Delete
                          </button>
                        </td>
                      </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                      <tr>
                        <td colspan="5" class="text-center">No combination images found.</td>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  function deleteCombination(id) {
    Swal.fire({
      title: "Are you sure?",
      text: "This will delete the combination image.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: `<?php echo e(url('admin/combinations')); ?>/${id}`,
          type: 'POST',
          data: { _method: 'DELETE', _token: '<?php echo e(csrf_token()); ?>' },
          success: function () {
            Swal.fire('Deleted!', '', 'success');
            setTimeout(() => location.reload(), 500);
          }
        });
      }
    });
  }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\new\resources\views/admin/combination-image/index.blade.php ENDPATH**/ ?>