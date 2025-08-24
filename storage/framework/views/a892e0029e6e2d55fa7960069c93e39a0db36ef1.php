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

    
<?php if($inputType === 'select_colour'): ?>
  <div class="form-group" id="colour-fields-wrapper">
    <label>Colour Code</label>
    <input type="text" name="colour_code" 
           class="form-control colour-code-input" 
           value="<?php echo e($attributeValue->colour_code ?? ''); ?>" 
           placeholder="#FF0000">

    <label class="mt-2">Select Colour</label>
    <input type="color" name="colour_picker" 
           class="form-control form-control-color colour-picker-input" 
           value="<?php echo e($attributeValue->colour_code ?? '#ffffff'); ?>" 
           style="width: 60px; height: 38px; padding: 2px;">

    <label class="mt-2">Preview</label>
    <div class="colour-preview border rounded" 
         style="width: 60px; height: 38px; background: <?php echo e($attributeValue->colour_code ?? '#ffffff'); ?>">
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

    // --- Composite toggle ---
    function toggleComposedWrapper() {
        const isComposite = $('#is_composite_value').val() === '1';
        $('#composed-of-wrapper').toggleClass('d-none', !isComposite);
        $('#composed-of-select-wrapper input[type="checkbox"]').prop('disabled', !isComposite);
    }
    $('#is_composite_value').on('change', toggleComposedWrapper);
    toggleComposedWrapper();

    // --- Value wrapper visibility ---
    if (inputType === 'select_area') {
        $('#value-wrapper').addClass('d-none');
    } else {
        $('#value-wrapper').removeClass('d-none');
    }

    // --- Title field visibility ---
    if (['select_image', 'select_icon'].includes(inputType)) {
        $('#title-wrapper').show();
    } else {
        $('#title-wrapper').hide();
    }

    // --- Hide existing preview on new file selection ---
    $('input[name="value"]').on('change', function () {
        $(this).siblings('.existing-preview').hide();
    });

    // --- Colour picker sync (only if colour input type) ---
    if (inputType === 'select_colour') {
        const $codeInput = $('.colour-code-input');
        const $picker = $('.colour-picker-input');
        const $preview = $('.colour-preview');

        // Code -> Picker + Preview
        $codeInput.on('input', function () {
            const val = $(this).val().trim();
            if (/^#([0-9A-F]{3}){1,2}$/i.test(val)) {
                $picker.val(val);
                $preview.css('background', val);
            }
        });

        // Picker -> Code + Preview
        $picker.on('input', function () {
            const val = $(this).val();
            $codeInput.val(val);
            $preview.css('background', val);
        });
    }
});
</script>
<?php /**PATH D:\web-mingo-project\pip_frames\resources\views/admin/attribute-values/edit.blade.php ENDPATH**/ ?>