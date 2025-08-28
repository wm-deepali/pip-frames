<!-- resources/views/admin/attributes/edit.blade.php -->
<div class="modal-dialog modal-xl" role="document">
  <div class="modal-content">
    <form id="attribute-form" enctype="multipart/form-data">

      <div class="modal-header">
        <h5 class="modal-title">Edit Attribute</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Name <span class="text-danger">*</span></label>
              <input type="text" name="name" class="form-control" value="<?php echo e($attribute->name ?? ''); ?>">
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label>Input Type <span class="text-danger">*</span></label>
              <select name="input_type" class="form-control">
                <!-- <option value="dropdown" <?php echo e($attribute->input_type == 'dropdown' ? 'selected' : ''); ?>>Dropdown</option> -->
                <option value="radio" <?php echo e($attribute->input_type == 'radio' ? 'selected' : ''); ?>>Radio</option>
                <option value="select_image" <?php echo e($attribute->input_type == 'select_image' ? 'selected' : ''); ?>>Select Image
                </option>
                <option value="select_area" <?php echo e($attribute->input_type == 'select_area' ? 'selected' : ''); ?>>Select Area
                </option>
                <option value="select_colour" <?php echo e($attribute->input_type == 'select_colour' ? 'selected' : ''); ?>></option>
                Select colours</option>
                <!-- <option value="checkbox" <?php echo e($attribute->input_type == 'checkbox' ? 'selected' : ''); ?>>Checkbox</option> -->
                <!-- <option value="text" <?php echo e($attribute->input_type == 'text' ? 'selected' : ''); ?>>Text</option> -->
                <!-- <option value="number" <?php echo e($attribute->input_type == 'number' ? 'selected' : ''); ?>>Number</option> -->
                <!-- <option value="range" <?php echo e($attribute->input_type == 'range' ? 'selected' : ''); ?>>Range</option> -->
                <!-- <option value="select_icon" <?php echo e($attribute->input_type == 'select_icon' ? 'selected' : ''); ?>>Select Icon</option> -->
                <!-- <option value="toggle" <?php echo e($attribute->input_type == 'toggle' ? 'selected' : ''); ?>>Toggle</option> -->
                <!-- <option value="textarea" <?php echo e($attribute->input_type == 'textarea' ? 'selected' : ''); ?>>Textarea</option> -->
                <!-- <option value="grouped_select" <?php echo e($attribute->input_type == 'grouped_select' ? 'selected' : ''); ?>>Grouped -->
                Select</option>
              </select>

            </div>
          </div>


          <!-- <div class="col-md-6">
            <div class="form-group">
              <label>Custom Input Type</label>
              <select name="custom_input_type" class="form-control">
                <option value="">-- Select --</option>
                <option value="number" <?php echo e($attribute->custom_input_type == 'number' ? 'selected' : ''); ?>>Number</option>
                <option value="text" <?php echo e($attribute->custom_input_type == 'text' ? 'selected' : ''); ?>>Text</option>
                <option value="file" <?php echo e($attribute->custom_input_type == 'file' ? 'selected' : ''); ?>>File</option>
                <option value="none" <?php echo e($attribute->custom_input_type == 'none' ? 'selected' : ''); ?>>None</option>
              </select>
            </div>
          </div> -->

          <!-- <div class="col-md-6">
            <div class="form-group">
              <label>Pricing Basis</label>
              <select name="pricing_basis" class="form-control">
                <option value="">-- Select --</option>
                <option value="per_page" <?php echo e($attribute->pricing_basis == 'per_page' ? 'selected' : ''); ?>>Depends Upon No.
                  of Pages</option>
                <option value="fixed_per_page" <?php echo e($attribute->pricing_basis == 'fixed_per_page' ? 'selected' : ''); ?>>Fixed
                  Price Per Page</option>
                <option value="per_product" <?php echo e($attribute->pricing_basis == 'per_product' ? 'selected' : ''); ?>>Depends
                  Upon Quantity Range</option>
                <option value="per_extra_copy" <?php echo e($attribute->pricing_basis == 'per_extra_copy' ? 'selected' : ''); ?>>Per
                  Extra Copy (Multiply by Product Qnty)</option>
              </select>
            </div>
          </div> -->

          <div class="col-md-6 area-unit-wrapper"
            style="<?php echo e($attribute->input_type == 'select_area' ? '' : 'display: none;'); ?>">
            <div class="form-group">
              <label>Area Unit for Pricing</label>
              <select class="form-control" name="area_unit" id="edit-area-unit">
                <option value="">-- Select Unit --</option>
                <option value="sq_inch" <?php echo e($attribute->area_unit == 'sq_inch' ? 'selected' : ''); ?>>Square Inch</option>
                <option value="sq_feet" <?php echo e($attribute->area_unit == 'sq_feet' ? 'selected' : ''); ?>>Square Feet</option>
                <option value="sq_meter" <?php echo e($attribute->area_unit == 'sq_meter' ? 'selected' : ''); ?>>Square Meter</option>
              </select>
            </div>
          </div>


          <div class="col-md-12">
            <div class="form-group">
              <label>Detail</label>
              <textarea name="detail" class="form-control" rows="3"><?php echo e($attribute->detail ?? ''); ?></textarea>
            </div>
          </div>

          <div class="col-md-2 portrait-landscape-wrapper"
            style="<?php echo e($attribute->input_type == 'select_image' ? '' : 'display: none;'); ?>">
            <div class="form-group">
              <label for="require_both_images">Require Both Portrait and Landscape Images</label>
              <select name="require_both_images" id="require_both_images" class="form-control">
                <option value="0" <?php echo e(empty($attribute->require_both_images) || $attribute->require_both_images == 0 ? 'selected' : ''); ?>>No</option>
                <option value="1" <?php echo e(!empty($attribute->require_both_images) && $attribute->require_both_images == 1 ? 'selected' : ''); ?>>Yes</option>
              </select>
            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label for="edit-setup">Setup Charges</label>
              <select name="has_setup_charge" id="edit-setup" class="form-control">
                <option value="">-- Select --</option>
                <option value="1" <?php echo e($attribute->has_setup_charge ? 'selected' : ''); ?>>Yes</option>
                <option value="0" <?php echo e(!$attribute->has_setup_charge ? 'selected' : ''); ?>>No</option>
              </select>
            </div>
          </div>


          <div class="col-md-2">
            <div class="form-group">
              <label for="main_frame_changes">Main Frame Image Changes</label>
              <select name="main_frame_changes" id="main-frame-changes" class="form-control">
                <option value="0" <?php echo e($attribute->main_frame_changes == 0 ? 'selected' : ''); ?>>No</option>
                <option value="1" <?php echo e($attribute->main_frame_changes == 1 ? 'selected' : ''); ?>>Yes</option>
              </select>

            </div>
          </div>

          <div class="col-md-2">
            <div class="form-group">
              <label for="required_file_uploads">Required File Uploads</label>
              <select name="required_file_uploads" id="required-file-uploads" class="form-control">
                <option value="0" <?php echo e($attribute->required_file_uploads == 0 ? 'selected' : ''); ?>>No</option>
                <option value="1" <?php echo e($attribute->required_file_uploads == 1 ? 'selected' : ''); ?>>Yes</option>
              </select>
            </div>
          </div>



          <!-- <div class="col-md-3">
            <div class="form-group">
              <label for="edit-quantity">Allow Quantity</label>
              <select name="allow_quantity" class="form-control" id="edit-quantity">
                <option value="1" <?php echo e($attribute->allow_quantity ? 'selected' : ''); ?>>Yes</option>
                <option value="0" <?php echo e(!$attribute->allow_quantity ? 'selected' : ''); ?>>No</option>
              </select>
              <input type="hidden" name="allow_quantity_hidden" id="allow_quantity_hidden"
                value="<?php echo e($attribute->allow_quantity); ?>">
            </div>
          </div> -->

          <!-- <div class="col-md-3">
            <div class="form-group">
              <label for="edit-composite">Is Composite</label>
              <select name="is_composite" class="form-control" id="edit-composite">
                <option value="1" <?php echo e($attribute->is_composite ? 'selected' : ''); ?>>Yes</option>
                <option value="0" <?php echo e(!$attribute->is_composite ? 'selected' : ''); ?>>No</option>
              </select>
            </div>
          </div> -->

          <!-- <div class="col-md-3">
            <div class="form-group">
              <label for="edit-image">Supports Images</label>
              <select name="has_image" class="form-control" id="edit-image">
                <option value="1" <?php echo e($attribute->has_image ? 'selected' : ''); ?>>Yes</option>
                <option value="0" <?php echo e(!$attribute->has_image ? 'selected' : ''); ?>>No</option>
              </select>
            </div>
          </div> -->

          <!-- <div class="col-md-3">
            <div class="form-group">
              <label for="edit-icon">Supports Icons</label>
              <select name="has_icon" class="form-control" id="edit-icon">
                <option value="1" <?php echo e($attribute->has_icon ? 'selected' : ''); ?>>Yes</option>
                <option value="0" <?php echo e(!$attribute->has_icon ? 'selected' : ''); ?>>No</option>
              </select>
            </div>
          </div> -->

          <div class="col-md-2">
            <div class="form-group">
              <label for="edit-dependency">Price Rule Dependency</label>
              <select name="has_dependency" class="form-control" id="edit-dependency">
                <option value="1" <?php echo e($attribute->has_dependency ? 'selected' : ''); ?>>Yes</option>
                <option value="0" <?php echo e(!$attribute->has_dependency ? 'selected' : ''); ?>>No</option>
              </select>
            </div>
          </div>

          <!-- Image Dependency Toggle -->
          <div class="col-md-2">
            <div class="form-group">
              <label for="edit-image-dependency">Image Dependency</label>
              <select name="has_image_dependency" id="edit-image-dependency" class="form-control">
                <option value="">-- Select --</option>
                <option value="1" <?php echo e(($attribute->has_image_dependency ?? 0) == 1 ? 'selected' : ''); ?>>Yes</option>
                <option value="0" <?php echo e(empty($attribute->has_image_dependency) ? 'selected' : ''); ?>>No</option>
              </select>
            </div>
          </div>

          <div class="col-md-6 dependency-parent-wrapper"
            style="<?php echo e(!$attribute->has_dependency ? 'display: none;' : ''); ?>">
            <div class="form-group">
              <label>Dependency Parents <span class="text-danger">*</span></label>
              <div class="border p-2 rounded" style="max-height: 200px; overflow-y: auto;">
                <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parentAttr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($parentAttr->id != $attribute->id): ?> 
                    <div class="form-check">
                      <input type="checkbox" class="form-check-input dependency-checkbox" name="dependency_parent[]"
                        value="<?php echo e($parentAttr->id); ?>" id="edit-dep-<?php echo e($parentAttr->id); ?>" <?php echo e($attribute->parents->contains('id', $parentAttr->id) ? 'checked' : ''); ?>>
                      <label class="form-check-label" for="edit-dep-<?php echo e($parentAttr->id); ?>">
                        <?php echo e($parentAttr->name); ?>

                      </label>
                    </div>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
          </div>


          <div class="col-md-6" id="image-dependency-wrapper"
            style="<?php echo e(empty($attribute->has_image_dependency) ? 'display:none;' : ''); ?>">
            <div class="form-group">
              <label>Image Dependency Parents <span class="text-danger">*</span></label>
              <div class="border rounded p-2" style="max-height: 200px; overflow-y: auto;">
                <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $parent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php
                    $imageParentIds = $attribute->imageParents->pluck('id')->toArray();
                    $isChecked = in_array($parent->id, $imageParentIds);
                  ?>
                  <?php if($parent->id != $attribute->id): ?>
                    <div class="form-check">
                      <input type="checkbox" class="image-dependency-checkbox" name="image_dependency_parent[]"
                        value="<?php echo e($parent->id); ?>" id="image-dep-<?php echo e($parent->id); ?>" <?php echo e($isChecked ? 'checked' : ''); ?>>
                      <label for="image-dep-<?php echo e($parent->id); ?>"><?php echo e($parent->name); ?></label>
                    </div>
                  <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            </div>
          </div>


        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" id="update-attribute-btn"
            data-id="<?php echo e($attribute->id); ?>">Update</button>
        </div>
    </form>
  </div>
</div>

<script>
  $(document).ready(function () {
    const excludedTypes = ['select_image', 'select_icon', 'grouped_select', 'range', 'toggle', 'number'];

    // Pricing Basis - Allow Quantity auto set
    function autoSetAllowQuantity(pricingBasis) {
      if (pricingBasis === 'per_page') {
        $('#edit-quantity').val('1').prop('disabled', true); // set to Yes and disable
        $('#allow_quantity_hidden').val('1'); // mirror to hidden
      } else {
        $('#edit-quantity').prop('disabled', false);
        $('#allow_quantity_hidden').val($('#edit-quantity').val()); // mirror current value
      }
    }


    function toggleImageDependencyField(value) {
      const $wrapper = $('#image-dependency-wrapper');
      if (value === '1') {
        $wrapper.css('display', 'block');
      } else {
        $wrapper.css('display', 'none');
        $wrapper.find('input[type="checkbox"]').prop('checked', false);
      }
    }

    // On page load
    toggleImageDependencyField($('#image-dependency').val());

    // On change event
    $('#image-dependency').on('change', function () {
      toggleImageDependencyField($(this).val());
    });



    $('select[name="input_type"]').on('change', function () {
      toggleEditSupportFields($(this).val());
    });


    function toggleEditSupportFields(selectedType) {
      if (excludedTypes.includes(selectedType)) {
        $('#edit-image').closest('.form-group').hide();
        $('#edit-icon').closest('.form-group').hide();
      } else {
        $('#edit-image').closest('.form-group').show();
        $('#edit-icon').closest('.form-group').show();
      }

      // Area unit field toggle
      if (selectedType === 'select_area') {
        $('.area-unit-wrapper').show();

        // Remove per_page and fixed_per_page from pricing_basis
        const $pricing = $('select[name="pricing_basis"]');
        $pricing.find('option[value="per_page"]').remove();
        $pricing.find('option[value="fixed_per_page"]').remove();
      } else {
        $('.area-unit-wrapper').hide();
        $('#edit-area-unit').val('');

        // Re-add removed options if they don't exist
        const $pricing = $('select[name="pricing_basis"]');
        const $placeholder = $pricing.find('option[value=""]');

        // Re-add only if missing
        if ($pricing.find('option[value="per_page"]').length === 0) {
          $placeholder.after('<option value="per_page">Depends Upon No. of Pages</option>');
        }
        if ($pricing.find('option[value="fixed_per_page"]').length === 0) {
          $placeholder.after('<option value="fixed_per_page">Fixed Price Per Page</option>');
        }

      }
    }


    // Dependency Parent Show/Hide
    function toggleDependencyParentField(value) {
      if (value === '1') {
        $('.dependency-parent-wrapper').show();
      } else {
        $('.dependency-parent-wrapper').hide();
        $('.dependency-checkbox').prop('checked', false); // uncheck all
      }
    }


    // On load
    toggleEditSupportFields($('select[name="input_type"]').val());
    toggleDependencyParentField($('#edit-dependency').val());

    // On change
    $('select[name="input_type"]').on('change', function () {
      toggleEditSupportFields($(this).val());
    });

    $('#edit-dependency').on('change', function () {
      toggleDependencyParentField($(this).val());
    });

    autoSetAllowQuantity($('select[name="pricing_basis"]').val()); // call on page load

    $('select[name="pricing_basis"]').on('change', function () {
      autoSetAllowQuantity($(this).val());
    });

    // Toggle image dependency parents visibility
    $('#edit-image-dependency').on('change', function () {
      const val = $(this).val();
      if (val === '1') {
        $('#image-dependency-wrapper').show();
      } else {
        $('#image-dependency-wrapper').hide();
        $('.image-dependency-checkbox').prop('checked', false);
      }
    });

    // Trigger on page load to set visibility correctly
    $('#edit-image-dependency').trigger('change');

  });

</script><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/admin/attributes/edit.blade.php ENDPATH**/ ?>