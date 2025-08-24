

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
          <li class="breadcrumb-item"><a href="<?php echo e(route('admin.pricing-rules.index')); ?>">Pricing Rules</a></li>
          <li class="breadcrumb-item active">View Pricing Rule</li>
          </ol>
        </div>
        </div>
      </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
      <a href="<?php echo e(route('admin.pricing-rules.edit', $rule->id)); ?>" class="btn btn-primary btn-sm">Edit</a>
      </div>
    </div>

    <div class="content-body">
      <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <h4 class="card-title">Pricing Rule Details</h4>
        </div>
        <div class="card-body">
          <dl class="row">

          <dt class="col-sm-3">Subcategory</dt>
          <dd class="col-sm-9">
            <?php echo e($rule->subcategory->name ?? '-'); ?> <br>
            <small>Category: <?php echo e($rule->category->name ?? '-'); ?></small>
          </dd>

          <hr class="col-12 my-2">


          <dt class="col-sm-3">Pages Dragger</dt>
          <dd class="col-sm-9">
            <?php if($rule->pages_dragger_required): ?>
          <div class="mb-1">
          <strong class="text-success">Required</strong>
          <?php
          $depAttr = $dependencyAttrs[$rule->pages_dragger_dependency] ?? null;
        ?>
          <?php if($depAttr): ?>
        <br>Depends on: <strong><?php echo e($depAttr->name); ?></strong>
        <?php else: ?>
        <br><em class="text-danger">Invalid Dependency</em>
        <?php endif; ?>
          </div>
          <div class="row">
          <div class="col-md-4"><strong>Default Pages:</strong> <?php echo e($rule->default_pages ?? '-'); ?></div>
          <div class="col-md-4"><strong>Min Pages:</strong> <?php echo e($rule->min_pages ?? '-'); ?></div>
          <div class="col-md-4"><strong>Max Pages:</strong> <?php echo e($rule->max_pages ?? '-'); ?></div>
          </div>
        <?php else: ?>
        <span class="text-muted">No</span>
        <?php endif; ?>
          </dd>

          <hr class="col-12 my-2">

          <dt class="col-sm-3">Quantity</dt>
          <dd class="col-sm-9">
            <div class="row">
            <div class="col-md-4"><strong>Default:</strong> <?php echo e($rule->default_quantity ?? '-'); ?></div>
            <div class="col-md-4"><strong>Min:</strong> <?php echo e($rule->min_quantity ?? '-'); ?></div>
            <div class="col-md-4"><strong>Max:</strong> <?php echo e($rule->max_quantity ?? '-'); ?></div>
            </div>
          </dd>

          <hr class="col-12 my-2">


          <dt class="col-sm-3">Attributes</dt>
          <dd class="col-sm-9">
            <?php $__empty_1 = true; $__currentLoopData = $rule->attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
          <div class="border rounded p-2 mb-2">
          <strong><?php echo e($attr->attribute->name ?? '-'); ?></strong>:
          <?php if($attr->attribute->input_type == 'select_area'): ?>
        <div>
          <strong>Max Width:</strong> <?php echo e($attr->max_width ?? '-'); ?>,
          <strong>Max Height:</strong> <?php echo e($attr->max_height ?? '-'); ?>

        </div>

        <?php else: ?>
        <?php echo e($attr->value->value ?? '-'); ?>

        <?php endif; ?>

          <?php if($attr->is_default): ?>
        <span class="badge badge-primary ml-1">Default</span>
        <?php endif; ?>
          <br>
          <small class="text-muted">
            (<?php echo e(ucfirst($attr->price_modifier_type)); ?>

            <?php echo e($attr->price_modifier_type === 'multiply' ? '×' : ''); ?>

            <?php echo e(rtrim(rtrim(number_format($attr->price_modifier_value, 4, '.', ''), '0'), '.')); ?>

            <?php echo e($attr->base_charges_type === 'percentage' ? '%' : ''); ?>

            <?php echo e($attr->extra_copy_charge ? '| Extra: ' . rtrim(rtrim(number_format($attr->extra_copy_charge, 4, '.', ''), '0'), '.') : ''); ?>

            <?php echo e($attr->extra_copy_charge_type === 'percentage' ? '%' : ''); ?>)
          </small>

          <?php if($attr->dependencies && $attr->dependencies->isNotEmpty()): ?>
          <div class="small text-danger mt-1">
          <strong>Depends on:</strong>
          <ul class="pl-3 mb-0">
          <?php $__currentLoopData = $attr->dependencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li>
          <strong><?php echo e($dep->parentAttribute->name ?? 'Attribute #' . $dep->parent_attribute_id); ?></strong>
          =
          <span
          class="text-dark"><?php echo e($dep->parentValue->value ?? 'Value #' . $dep->parent_value_id); ?></span>
          </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
          </div>
        <?php endif; ?>

          <?php if($attr->quantityRanges->isNotEmpty()): ?>
          <div class="text-muted small mt-1">
          <strong><?php echo e($attr->attribute->pricing_basis === 'per_product' ? 'Per Product Pricing:' : 'Per Page Pricing:'); ?></strong>
          <ul class="mb-0 pl-3">
          <?php $__currentLoopData = $attr->quantityRanges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $range): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <li>
          From <?php echo e($range->quantity_from); ?> to <?php echo e($range->quantity_to); ?>:
          £<?php echo e(rtrim(rtrim(number_format($range->price, 4, '.', ''), '0'), '.')); ?>

          </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
          </div>
        <?php endif; ?>

          <?php if($attr->attribute->pricing_basis === 'fixed_per_page'): ?>
        <div class="text-muted small mt-1">
          <strong>Fixed Per Page Price:</strong>
          £<?php echo e(rtrim(rtrim(number_format($attr->flat_rate_per_page, 4, '.', ''), '0'), '.')); ?>

        </div>
        <?php endif; ?>

          <?php if($attr->attribute->pricing_basis === 'per_extra_copy'): ?>
        <div class="text-muted small mt-1">
          <strong>Per Extra Copy Price:</strong>
          £<?php echo e(rtrim(rtrim(number_format($attr->extra_copy_charge, 4, '.', ''), '0'), '.')); ?>

        </div>
        <?php endif; ?>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <span class="text-muted">No Modifiers</span>
        <?php endif; ?>
          </dd>

          </dl>
        </div>
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\new\resources\views/admin/pricing-rules/view.blade.php ENDPATH**/ ?>