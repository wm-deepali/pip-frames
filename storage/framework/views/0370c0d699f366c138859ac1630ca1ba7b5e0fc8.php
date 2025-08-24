<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <form id="subcategory-attribute-form">
      <div class="modal-header">
        <h5 class="modal-title">Map Multiple Attributes to a Subcategory</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <div class="form-group">
          <label><strong>Subcategory <span class="text-danger">*</span></strong></label>
          <select name="subcategory_id" class="form-control">
            <option value="">-- Select Subcategory --</option>
            <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($subcategory->id); ?>"><?php echo e($subcategory->name); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
          <span class="text-danger validation-err" id="subcategory_id-err"></span>
        </div>

        <div id="attribute-items-wrapper">
          <div class="attribute-item border rounded p-1 mb-1 bg-light">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label><strong>Attribute <span class="text-danger">*</span></strong></label>
                <select name="attribute_id[]" class="form-control attribute-select">
                  <option value="">-- Select Attribute --</option>
                  <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($attribute->id); ?>" data-input-type="<?php echo e($attribute->input_type); ?>">
            <?php echo e($attribute->name); ?>

            </option>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
              </div>

              <div class="form-group col-md-6">
                <label><strong>Is Required?</strong></label>
                <select name="is_required[]" class="form-control">
                  <option value="1">Yes</option>
                  <option value="0" selected>No</option>
                </select>
              </div>

              <div class="form-group col-md-6">
                <label><strong>Attribute Values <span class="text-danger">*</span></strong></label>
                <div class="scrollable-checkbox-box attribute-values-container">
                  <!-- checkboxes will be appended dynamically -->
                </div>
                <span class="text-danger validation-err attribute-values-error"></span> <!-- Add this -->
              </div>

              <div class="form-group col-md-3">
                <label><strong>Sort Order</strong></label>
                <input type="number" name="sort_order[]" class="form-control" placeholder="e.g. 1">
              </div>
              <span class="text-danger validation-err" id="sort_order-error"></span>
              <div class="form-group col-md-3">
                <label><strong>Step Number</strong></label>
                <select name="step_number[]" class="form-control">
                  <option value="">-- Select Step --</option>
                  <option value="1">Step 1</option>
                  <option value="2">Step 2</option>
                  <option value="3">Step 3</option>
                  <!-- You can add more depending on how many steps you want to support -->
                </select>
                <span class="text-danger validation-err step_number-error"></span>
              </div>
            </div>

            <div class="text-right">
              <button type="button" class="btn btn-sm btn-danger remove-attribute">Remove</button>
            </div>
          </div>
        </div>

        <button type="button" class="btn btn-outline-primary btn-sm mb-1" id="add-more-attribute">
          + Add Another Attribute
        </button>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" id="save-subcategory-attribute-btn" class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
</div>

<style>
  .scrollable-checkbox-box {
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 10px;
    max-height: 150px;
    overflow-y: auto;
    background-color: #fff;
  }
</style>


<script>
  $(document).on('change', '.attribute-select', function () {
    const selectedOption = $(this).find('option:selected');
    const inputType = selectedOption.data('input-type');

    const container = $(this).closest('.attribute-item');
    const attributeValuesSection = container.find('.attribute-values-container').closest('.form-group');

    if (inputType === 'select_area') {
      attributeValuesSection.hide(); // Hide if 'select_area'
    } else {
      attributeValuesSection.show(); // Show otherwise
    }
  });

  // Optional: Trigger change on page load if needed (e.g. when editing)
  $('.attribute-select').trigger('change');
</script><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/admin/subcategory-attributes/create.blade.php ENDPATH**/ ?>