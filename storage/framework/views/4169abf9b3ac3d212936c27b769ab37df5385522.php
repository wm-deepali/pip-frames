<div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
    <form id="attribute-value-form" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title">Edit Attribute Value</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        
        <div class="form-group">
          <label>Attribute <span class="text-danger">*</span></label>
          <select class="form-control" disabled id="attribute-select">
            <option value="<?php echo e($attribute->id); ?>" selected><?php echo e($attribute->name); ?></option>
          </select>
          <input type="hidden" name="attribute_id" value="<?php echo e($attribute->id); ?>">
          <span class="text-danger validation-err" id="attribute_id-err"></span>
        </div>

        
        <div class="form-group" id="title-wrapper" style="display: none;">
          <label>Title <span class="text-danger">*</span></label>
          <input type="text" name="title" class="form-control" value="<?php echo e($attributeValue->title); ?>">
          <span class="text-danger validation-err" id="title-err"></span>
        </div>

        
        <div class="form-group" id="value-wrapper">
          <label>Value <span class="text-danger">*</span></label>
          <?php
      $inputType = $attributeConfigs[$attribute->id]['input_type'] ?? 'text';
      ?>

          <?php if(in_array($inputType, ['select_image', 'select_icon'])): ?>
          <input type="file" name="value" class="form-control-file">
          <?php if($attributeValue->image_path): ?>
        <div class="mt-2 existing-preview">
        <strong>Existing Image:</strong><br>
        <img src="<?php echo e(asset('storage/' . $attributeValue->image_path)); ?>" width="80" alt="Current Image">
        </div>
        <?php endif; ?>
      <?php else: ?>
        <input type="text" name="value" class="form-control" value="<?php echo e($attributeValue->value); ?>">
      <?php endif; ?>

          <span class="text-danger validation-err" id="value-err"></span>
        </div>

        
        <?php if($attribute->has_icon): ?>
      <div class="form-group" id="icon-class-wrapper">
        <label>Icon Class</label>
        <input type="text" name="icon_class" class="form-control" value="<?php echo e($attributeValue->icon_class); ?>">
        <span class="text-danger validation-err" id="icon_class-err"></span>
      </div>
    <?php endif; ?>

        
        <?php if($attribute->has_image): ?>
        <div class="form-group" id="image-wrapper">
          <label>Image (optional)</label>
          <input type="file" name="image" class="form-control-file">
          <?php if($attributeValue->image_path): ?>
        <div class="mt-2">
        <img src="<?php echo e(asset('storage/' . $attributeValue->image_path)); ?>" width="60">
        </div>
        <?php endif; ?>
          <span class="text-danger validation-err" id="image-err"></span>
        </div>
    <?php endif; ?>

        <?php if(!is_null($attribute->custom_input_type) && $attribute->custom_input_type !== 'none'): ?>
      <div class="form-group" id="custom-input-label-wrapper">
        <label>Custom Input Label</label>
        <input type="text" name="custom_input_label" class="form-control"
        value="<?php echo e($attributeValue->custom_input_label); ?>">
        <span class="text-danger validation-err" id="custom_input_label-err"></span>
      </div>
    <?php endif; ?>

        <?php if($attribute->is_composite): ?>
        

        <div class="form-group mb-2" id="is-composite-wrapper">
          <label for="is_composite_value">Is Composite Value?</label>
          <select class="form-control" name="is_composite_value" id="is_composite_value">
          <option value="0" <?php echo e(!$attributeValue->is_composite_value ? 'selected' : ''); ?>>No</option>
          <option value="1" <?php echo e($attributeValue->is_composite_value ? 'selected' : ''); ?>>Yes</option>
          </select>
        </div>


        
        <div class="form-group <?php echo e($attributeValue->is_composite_value ? '' : 'd-none'); ?>" id="composed-of-wrapper">
          <label>Select Composed Of Values</label>
          <div id="composed-of-select-wrapper">
          <?php $__empty_1 = true; $__currentLoopData = $availableValues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php if($val->id == $attributeValue->id) continue; ?>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="composed_of[]" value="<?php echo e($val->id); ?>"
          id="composed_of_<?php echo e($val->id); ?>" <?php echo e(in_array($val->id, $attributeValue->composed_of_array ?? []) ? 'checked' : ''); ?>>
          <label class="form-check-label" for="composed_of_<?php echo e($val->id); ?>">
          <?php echo e($val->value); ?>

          </label>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <p class="text-muted">No values available to compose.</p>
        <?php endif; ?>
          </div>
        </div>
    <?php endif; ?>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="update-attribute-value-btn"
          data-id="<?php echo e($attributeValue->id); ?>">
          Update
        </button>
      </div>
    </form>
  </div>
</div>

<script>
  $(document).ready(function () {
    const inputType = <?php echo json_encode($attributeConfigs[$attribute->id]['input_type'] ?? 'text', 15, 512) ?>;

    function toggleComposedWrapper() {
      const isComposite = $('#is_composite_value').val() === '1';
      $('#composed-of-wrapper').toggleClass('d-none', !isComposite);
      $('#composed-of-select-wrapper input[type="checkbox"]').prop('disabled', !isComposite);
    }

    $('#is_composite_value').on('change', toggleComposedWrapper);
    toggleComposedWrapper();

    // Hide value wrapper entirely for select_area
    if (inputType === 'select_area') {
      $('#value-wrapper').addClass('d-none');
    } else {
      $('#value-wrapper').removeClass('d-none');
    }

    if (['select_image', 'select_icon'].includes(inputType)) {
      $('#title-wrapper').show();
    } else {
      $('#title-wrapper').hide();
    }

    $('input[name="value"]').on('change', function () {
      $(this).siblings('.existing-preview').hide();
    });
  });

  const inputType = <?php echo json_encode($attributeConfigs[$attribute->id]['input_type'] ?? 'text', 15, 512) ?>;

  function toggleComposedWrapper() {
    const isComposite = $('#is_composite_value').val() === '1';
    $('#composed-of-wrapper').toggleClass('d-none', !isComposite);
    $('#composed-of-select-wrapper input[type="checkbox"]').prop('disabled', !isComposite);
  }

  $('#is_composite_value').on('change', toggleComposedWrapper);


  toggleComposedWrapper();

  if (['select_image', 'select_icon'].includes(inputType)) {
    $('#title-wrapper').show();
  } else {
    $('#title-wrapper').hide();
  }

  $('input[name="value"]').on('change', function () {
    $(this).siblings('.existing-preview').hide();
  });
  });
</script><?php /**PATH D:\web-mingo-project\new\resources\views/admin/attribute-values/edit.blade.php ENDPATH**/ ?>