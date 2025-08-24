<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Edit Subcategory</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
      <form id="subcategory-form" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>

        <div class="form-row">
          
          <div class="form-group col-md-12">
            <label>Select Categories</label>
            <div class="form-control" style="height:150px; overflow-y:scroll;">
              <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="form-check">
          <input type="checkbox" name="category_ids[]" value="<?php echo e($category->id); ?>" class="form-check-input" <?php echo e(in_array($category->id, $subcategory->categories->pluck('id')->toArray()) ? 'checked' : ''); ?>>
          <label class="form-check-label"><?php echo e($category->name); ?></label>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="text-danger validation-err" id="category_ids-err"></div>
          </div>
          
          <!-- <div class="form-group col-md-6">
            <label>Description</label>
            <textarea name="description" id="description" class="form-control"
              rows="5"><?php echo e($subcategory->description); ?></textarea>
          </div> -->
        </div>

        <div class="form-row">
          
          <div class="form-group col-md-6">
            <label>Name</label>
            <input type="text" name="name" id="name" class="form-control" value="<?php echo e($subcategory->name); ?>">
            <div class="text-danger validation-err" id="name-err"></div>
          </div>

          
          <div class="form-group col-md-6">
            <label>Thumbnail</label>
            <input type="file" name="thumbnail" class="form-control">
            <?php if($subcategory->thumbnail): ?>
        <div class="mt-2">
          <img src="<?php echo e(asset('storage/' . $subcategory->thumbnail)); ?>" class="img-thumbnail"
          style="height:100px; width:100px; object-fit:cover;">
        </div>
      <?php endif; ?>
          </div>
        </div>


        
        <div class="form-group">
          <label>Gallery (multiple)</label>
          <input type="file" id="gallery-input" name="gallery[]" class="form-control" multiple>

          <div class="row mt-2" id="gallery-preview-list">
            <?php $__currentLoopData = $subcategory->gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imagePath): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-3 existing-image" data-path="<?php echo e($imagePath); ?>">
          <div class="position-relative border rounded mx-auto"
          style="width: 100px; height: 100px; overflow: hidden;">
          <img src="<?php echo e(asset('storage/' . $imagePath)); ?>" class="img-fluid w-100 h-100"
            style="object-fit: cover;">

          <button type="button" class="btn btn-sm btn-danger btn-remove-existing-image"
            data-path="<?php echo e($imagePath); ?>"
            style="position: absolute; top: 5px; right: 5px; border-radius: 50%; padding: 0.2rem 0.45rem; font-size: 0.7rem; line-height: 1;">
            &times;
          </button>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </div>

        </div>



        <input type="hidden" name="deleted_image_paths" id="deleted-image-paths">

        
        <!-- <ul class="nav nav-tabs">
          <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#info">Information</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#sizes">Available Sizes</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#binding">Binding Options</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#paper">Paper Types</a></li>
        </ul> -->

        <!-- <div class="tab-content pt-2">
          <div class="tab-pane fade show active" id="info">
            <textarea name="information" id="information" class="form-control"
              rows="4"><?php echo e($subcategory->details->information ?? ''); ?></textarea>
          </div>
          <div class="tab-pane fade" id="sizes">
            <textarea name="available_sizes" id="available_sizes" class="form-control"
              rows="4"><?php echo e($subcategory->details->available_sizes ?? ''); ?></textarea>
          </div>
          <div class="tab-pane fade" id="binding">
            <textarea name="binding_options" id="binding_options" class="form-control"
              rows="4"><?php echo e($subcategory->details->binding_options ?? ''); ?></textarea>
          </div>
          <div class="tab-pane fade" id="paper">
            <textarea name="paper_types" id="paper_types" class="form-control"
              rows="4"><?php echo e($subcategory->details->paper_types ?? ''); ?></textarea>
          </div>
        </div> -->

        <div class="form-row pt-1">
          
          <div class="form-group col-md-6">
            <label>Calculator Required</label>
            <select name="calculator_required" id="calculator_required" class="form-control">
              <option value="0" <?php echo e(!$subcategory->calculator_required ? 'selected' : ''); ?>>No</option>
              <option value="1" <?php echo e($subcategory->calculator_required ? 'selected' : ''); ?>>Yes</option>
            </select>
            <div class="text-danger validation-err" id="calculator_required-err"></div>
          </div>
          
          <div class="form-group col-md-6">
            <label>Status</label>
            <select name="status" class="form-control">
              <option value="active" <?php echo e($subcategory->status == 'active' ? 'selected' : ''); ?>>Active</option>
              <option value="inactive" <?php echo e($subcategory->status == 'inactive' ? 'selected' : ''); ?>>Inactive</option>
            </select>
          </div>
        </div>

        <button type="button" class="btn btn-primary" id="update-subcategory-btn"
          subcategory_id="<?php echo e($subcategory->id); ?>">Update</button>
      </form>
    </div>
  </div>
</div><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/admin/subcategories/ajax/edit-subcategory.blade.php ENDPATH**/ ?>