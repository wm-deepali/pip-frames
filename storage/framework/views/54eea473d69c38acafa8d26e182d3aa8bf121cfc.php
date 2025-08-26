

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
          <li class="breadcrumb-item active">Pricing Rules Listing</li>
          </ol>
        </div>
        </div>
      </div>
      </div>

      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
      <div class="form-group breadcrumb-right">
        <a href="<?php echo e(route('admin.pricing-rules.create')); ?>" class="btn-icon btn btn-primary btn-round btn-sm">Add
        Pricing Rule</a>
      </div>
      </div>
    </div>

    <div class="content-body">
      <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <h4 class="card-title">Pricing Rules Listing</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table class="table" id="quote-table">
            <thead>
            <tr>
              <th>ID</th>
              <th>Subcategory</th>
              <!-- <th>Pages Dragger</th> -->
              <!-- <th>Qty</th> -->
              <th>Attributes</th>
              <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $rules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <tr>

            <td><?php echo e($rule->id); ?></td>

            <td>
            <?php echo e($rule->subcategory->name ?? '-'); ?><br>
            <small>Cat: <?php echo e($rule->category->name ?? '-'); ?></small>
            </td>

            <!-- <td>
            <?php if($rule->pages_dragger_required): ?>
          <div class="mb-1">
            <div class="small text-muted ml-1">
            Required: <strong class="text-success">Yes</strong><br>

            <?php
          $depAttr = $dependencyAttrs[$rule->pages_dragger_dependency] ?? null;
          ?>

            <?php if($depAttr): ?>
          Depends on Attribute: <strong><?php echo e($depAttr->name); ?></strong><br>
          <?php else: ?>
          <em class="text-danger">Invalid Dependency</em><br>
          <?php endif; ?>

            Default Pages: <strong><?php echo e($rule->default_pages ?? '-'); ?></strong><br>
            Min Pages: <strong><?php echo e($rule->min_pages ?? '-'); ?></strong><br>
            Max Pages: <strong><?php echo e($rule->max_pages ?? '-'); ?></strong>

            </div>
          </div>
        <?php else: ?>
          <span class="text-muted">No</span>
        <?php endif; ?>
            </td> -->

            <!-- <td>
            Default: <strong><?php echo e($rule->default_quantity ?? '-'); ?></strong><br>
            Min: <strong><?php echo e($rule->min_quantity ?? '-'); ?></strong><br>
            Max: <strong><?php echo e($rule->max_quantity ?? '-'); ?></strong>
            </td> -->


            <td>
            <?php echo e($rule->attributes->count()); ?> Attribute<?php echo e($rule->attributes->count() !== 1 ? 's' : ''); ?>

            </td>


            <td>
            <a href="<?php echo e(route('admin.pricing-rules.show', $rule->id)); ?>" class="btn btn-sm btn-info">
            <i class="fas fa-eye"></i> View
            </a>
            <a href="<?php echo e(route('admin.pricing-rules.edit', $rule->id)); ?>" class="btn btn-sm btn-primary">
            <i class="fas fa-edit"></i> Edit
            </a>
            <button class="btn btn-sm btn-danger" onclick="deletePricingRule(<?php echo e($rule->id); ?>)">
            <i class="fas fa-trash"></i> Delete
            </button>
            </td>



          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
          <td colspan="6" class="text-center">No pricing rules found.</td>
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

    <!-- Add Pricing Rule Modal -->

  </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
  <script>
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    // delete pricing rule
    function deletePricingRule(id) {
    Swal.fire({
      title: "Are you sure?",
      text: "This will delete the pricing rule.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
      $.ajax({
        url: `<?php echo e(url('admin/pricing-rules')); ?>/${id}`,
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/admin/pricing-rules/index.blade.php ENDPATH**/ ?>