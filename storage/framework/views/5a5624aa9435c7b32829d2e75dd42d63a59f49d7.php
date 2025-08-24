

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
          <li class="breadcrumb-item"><a href="<?php echo e(route('admin.combination-image.index')); ?>">Combination
            Images</a></li>
          <li class="breadcrumb-item active">Add Combination Image</li>
          </ol>
        </div>
        </div>
      </div>
      </div>
    </div>

    <div class="content-body">
      <div class="card">
      <div class="card-header">
        <h4 class="card-title">Add Combination Image</h4>
      </div>
      <div class="card-body">
        <form action="#" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <div class="form-group">
          <label for="subcategory_id">Subcategory</label>
          <select name="subcategory_id" class="form-control" required>
          <option value="">-- Select Subcategory --</option>
          <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($subcat->id); ?>"><?php echo e($subcat->name); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>
<div class="form-group">
  <label for="attribute_value_ids">Attribute Values <span class="text-danger">*</span></label>
  <div class="border rounded p-2" style="max-height: 250px; overflow-y: auto;">
    <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div class="mb-2">
        <strong><?php echo e($attribute->name); ?></strong>
        <div class="ms-2">
          <?php $__currentLoopData = $attribute->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="form-check">
              <input type="checkbox" 
                     name="attribute_value_ids[]" 
                     value="<?php echo e($value->id); ?>" 
                     class="form-check-input" 
                     id="val-<?php echo e($value->id); ?>">
              <label class="form-check-label" for="val-<?php echo e($value->id); ?>">
                <?php echo e($value->value); ?>

              </label>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
  <small class="text-muted">Select attribute values for this combination</small>
</div>




        <div class="form-group">
          <label for="preview_image">Preview Image</label>
          <input type="file" name="preview_image" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="<?php echo e(route('admin.combination-image.index')); ?>" class="btn btn-secondary">Cancel</a>
        </form>
      </div>
      </div>

    </div>

    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/admin/combination-image/create.blade.php ENDPATH**/ ?>