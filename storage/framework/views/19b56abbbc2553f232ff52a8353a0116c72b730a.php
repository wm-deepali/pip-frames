<!-- Add Modal -->
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <form id="attribute-form" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title">Add Attributes</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <div id="attribute-fields-wrapper">
          <div class="attribute-item border p-2 mb-2">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Name <span class="text-danger">*</span></label>
                  <input type="text" name="attributes[0][name]" class="form-control">
                  <small class="text-danger validation-err" id="attributes_0_name-err"></small>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Input Type <span class="text-danger">*</span></label>
                  <select name="attributes[0][input_type]" class="form-control">
                    <!-- <option value="dropdown">Dropdown</option> -->
                    <!-- <option value="radio">Radio</option> -->
                    <option value="select_image">Select Image</option>
                    <option value="select_area">Select Area</option>
                    <!-- <option value="checkbox">Checkbox</option> -->
                    <!-- <option value="text">Text</option> -->
                    <!-- <option value="number">Number</option> -->
                    <!-- <option value="range">Range</option> -->
                    <!-- <option value="select_icon">Select Icon</option> -->
                    <!-- <option value="toggle">Toggle</option> -->
                    <!-- <option value="textarea">Textarea</option> -->
                    <!-- <option value="grouped_select">Grouped Select</option> -->
                  </select>
                  <small class="text-danger validation-err" id="attributes_0_input_type-err"></small>
                </div>
              </div>

              <!-- <div class="col-md-6">
                <div class="form-group">
                  <label>Pricing Basis</label>
                  <select name="attributes[0][pricing_basis]" class="form-control">
                    <option value="">-- Select --</option>
                    <option value="per_page">Depends Upon No. of Pages</option>
                    <option value="fixed_per_page">Fixed Price Per Page</option>
                    <option value="per_product">Depends Upon Quantity Range</option>
                    <option value="per_extra_copy">Per Extra Copy (Multiply by Product Qnty)</option>
                  </select>
                  <small class="text-danger validation-err" id="attributes_0_pricing_basis-err"></small>
                </div>
              </div> -->

              <div class="col-md-6 area-unit-wrapper d-none">
                <div class="form-group">
                  <label>Area Unit for Pricing</label>
                  <select class="form-control area-unit-select" name="attributes[0][area_unit]">
                    <option value="">-- Select Unit --</option>
                    <option value="sq_inch">Square Inch</option>
                    <option value="sq_feet">Square Feet</option>
                    <option value="sq_meter">Square Meter</option>
                  </select>
                </div>
              </div>

              <!-- <div class="col-md-6">
                <div class="form-group">
                  <label>Custom Input Type</label>
                  <select name="attributes[0][custom_input_type]" class="form-control">
                    <option value="">-- Select --</option>
                    <option value="number">Number</option>
                    <option value="text">Text</option>
                    <option value="file">File</option>
                    <option value="none">None</option>
                  </select>
                  <small class="text-danger validation-err" id="attributes_0_custom_input_type-err"></small>
                </div>
              </div> -->

              <div class="col-md-12">
                <div class="form-group">
                  <label>Detail</label>
                  <textarea name="attributes[0][detail]" class="form-control" rows="2"
                    placeholder="Optional description..."></textarea>
                  <small class="text-danger validation-err" id="attributes_0_detail-err"></small>
                </div>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label for="setup-0">Setup Charges</label>
                  <select name="attributes[0][has_setup_charge]" id="setup-0" class="form-control">
                    <option value="">-- Select --</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                </div>
              </div>

              <!-- <div class="col-md-3">
                <div class="form-group">
                  <label for="quantity-0">Allow Quantity</label>
                  <select name="attributes[0][allow_quantity]" id="quantity-0" class="form-control">
                    <option value="">-- Select --</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                </div>
              </div> -->
<!-- 
              <div class="col-md-3">
                <div class="form-group">
                  <label for="composite-0">Is Composite</label>
                  <select name="attributes[0][is_composite]" id="composite-0" class="form-control">
                    <option value="">-- Select --</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                </div>
              </div> -->


              <!-- <div class="col-md-3">
                <div class="form-group">
                  <label for="image-0">Supports Images</label>
                  <select name="attributes[0][has_image]" id="image-0" class="form-control">
                    <option value="">-- Select --</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                </div>
              </div> -->

              <!-- <div class="col-md-3">
                <div class="form-group">
                  <label for="icon-0">Supports Icons</label>
                  <select name="attributes[0][has_icon]" id="icon-0" class="form-control">
                    <option value="">-- Select --</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                </div>
              </div> -->

              <div class="col-md-3">
                <div class="form-group">
                  <label for="dependency-0">Has Dependency</label>
                  <select name="attributes[0][has_dependency]" id="dependency-0" class="form-control">
                    <option value="">-- Select --</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                  </select>
                </div>
              </div>

              <div class="col-md-6 dependency-parent-wrapper d-none">
                <div class="form-group">
                  <label>Dependency Parent <span class="text-danger">*</span></label>
                  <div class="border p-1 rounded" style="max-height: 200px; overflow-y: auto;">
                    <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="form-check">
              <input type="checkbox" class="form-check-input dependency-checkbox"
              name="attributes[0][dependency_parent][]" value="<?php echo e($attribute->id); ?>"
              id="dep-0-<?php echo e($attribute->id); ?>">
              <label class="form-check-label" for="dep-0-<?php echo e($attribute->id); ?>">
              <?php echo e($attribute->name); ?>

              </label>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                </div>
              </div>

              <div class="col-md-12 text-right">
                <button type="button" class="btn btn-danger btn-sm remove-attribute d-none">Remove</button>
              </div>
            </div>
          </div>
        </div>
        <button type="button" class="btn btn-sm btn-success" id="add-more-attribute">Add More</button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="save-attribute-btn">Save</button>
      </div>
    </form>
  </div>
</div>

<script>
  let attributeIndex = 1;
  const allAttributes = <?php echo json_encode($attributes, 15, 512) ?>;
  const excludedTypes = ['select_image', 'select_icon', 'grouped_select', 'range', 'toggle', 'number'];

  // Attach change event for all input_type selects
  $(document).on('change', 'select[name$="[input_type]"]', function () {
    const $item = $(this).closest('.attribute-item');
    const selectedType = $(this).val();
    toggleSupportFields($item, selectedType);
  });


  function toggleSupportFields($item, selectedType) {
    // Handle image/icon visibility
    if (excludedTypes.includes(selectedType)) {
      $item.find('.form-check-input[name$="[has_image]"]').closest('.form-group').hide();
      $item.find('.form-check-input[name$="[has_icon]"]').closest('.form-group').hide();
    } else {
      $item.find('.form-check-input[name$="[has_image]"]').closest('.form-group').show();
      $item.find('.form-check-input[name$="[has_icon]"]').closest('.form-group').show();
    }

    // Handle Area Unit visibility
    if (selectedType === 'select_area') {
      $item.find('.area-unit-wrapper').removeClass('d-none');

      // Remove per_page and fixed_per_page options from pricing_basis
      const $pricingSelect = $item.find('select[name$="[pricing_basis]"]');
      $pricingSelect.find('option[value="per_page"]').remove();
      $pricingSelect.find('option[value="fixed_per_page"]').remove();
    } else {
      $item.find('.area-unit-wrapper').addClass('d-none');
      $item.find('.area-unit-select').val('');

      // Re-add options if they are missing (in case user changes from select_area to something else)
      const $pricingSelect = $item.find('select[name$="[pricing_basis]"]');
      const $placeholder = $pricingSelect.find('option[value=""]');
      console.log($placeholder);
      

      if ($pricingSelect.find('option[value="per_page"]').length === 0) {
        $placeholder.after('<option value="per_page">Depends Upon No. of Pages</option>');
      }

      if ($pricingSelect.find('option[value="fixed_per_page"]').length === 0) {
        $placeholder.after('<option value="fixed_per_page">Fixed Price Per Page</option>');
      }
    }
  }


  // Handle Pricing Basis change
  // $(document).on('change', 'select[name$="[pricing_basis]"]', function () {
  //   const $item = $(this).closest('.attribute-item');
  //   const pricingBasis = $(this).val();
  //   const $allowQty = $item.find('select[name$="[allow_quantity]"]');
  //   const allowQtyName = $allowQty.attr('name');

  //   if (pricingBasis === 'per_page') {
  //     $allowQty.val('1').prop('disabled', true);

  //     // If hidden field not already added
  //     if ($item.find(`input[type="hidden"][name="${allowQtyName}"]`).length === 0) {
  //       $allowQty.after(`<input type="hidden" name="${allowQtyName}" value="1" class="hidden-allow-quantity">`);
  //     }
  //   } else {
  //     $allowQty.prop('disabled', false);
  //     $item.find(`.hidden-allow-quantity`).remove();
  //   }
  // });


  // Handle Dependency toggle
  $(document).on('change', 'select[name$="[has_dependency]"]', function () {
    const $item = $(this).closest('.attribute-item');
    const hasDependency = $(this).val() === '1';
    const $parentWrapper = $item.find('.dependency-parent-wrapper');
    const $parentSelect = $item.find('select.dependency-parent');

    if (hasDependency) {
      // Clear and populate with other attribute names
      $parentSelect.empty().append('<option value="">-- Select Parent Attribute --</option>');
      allAttributes.forEach(attr => {
        $parentSelect.append(`<option value="${attr.id}">${attr.name}</option>`);
      });

      // Optional: Also append current session-added attributes
      $('.attribute-item').not($item).each(function () {
        const name = $(this).find('input[name$="[name]"]').val();
        const indexMatch = $(this).find('input[name$="[name]"]').attr('name').match(/\d+/);
        const idx = indexMatch ? indexMatch[0] : null;
        if (name && idx !== null) {
          $parentSelect.append(`<option value="new-${idx}">${name}</option>`);
        }
      });


      $parentWrapper.removeClass('d-none');
    } else {
      $parentWrapper.addClass('d-none');
      $parentSelect.val('');
    }
  });



  // Add new attribute field block
  $(document).on('click', '#add-more-attribute', function () {
    const html = `
       <div class="attribute-item border p-2 mb-2">
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <label>Name <span class="text-danger">*</span></label>
        <input type="text" name="attributes[${attributeIndex}][name]" class="form-control">
        <small class="text-danger" id="attributes.${attributeIndex}.name-err"></small>
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <label>Input Type <span class="text-danger">*</span></label>
        <select name="attributes[${attributeIndex}][input_type]" class="form-control">
          <option value="select_image">Select Image</option>
        </select>
        <small class="text-danger" id="attributes.${attributeIndex}.input_type-err"></small>
      </div>
    </div>
  
    
    <div class="col-md-12">
      <div class="form-group">
        <label>Detail</label>
        <textarea name="attributes[${attributeIndex}][detail]" class="form-control" rows="2"
          placeholder="Optional description..."></textarea>
        <small class="text-danger" id="attributes.${attributeIndex}.detail-err"></small>
      </div>
    </div>

     <div class="col-md-3">
        <div class="form-group">
          <label for="setup-${attributeIndex}">Setup Charges</label>
          <select name="attributes[${attributeIndex}][has_setup_charge]" class="form-control" id="setup-${attributeIndex}">
            <option value="">-- Select --</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
          </select>
        </div>
    </div>

    
    <div class="col-md-3">
      <div class="form-group">
        <label for="dependency-${attributeIndex}">Has Dependency</label>
        <select name="attributes[${attributeIndex}][has_dependency]" class="form-control"
          id="dependency-${attributeIndex}">
          <option value="">-- Select --</option>
          <option value="1">Yes</option>
          <option value="0" selected>No</option>
        </select>
      </div>
    </div>


 <div class="col-md-6 dependency-parent-wrapper d-none">
                <div class="form-group">
                  <label for="parent-${attributeIndex}">Dependency Parent <span class="text-danger">*</span></label>
                  <div class="border p-1 rounded" style="max-height: 200px; overflow-y: auto;">
                    <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="form-check">
              <input type="checkbox" class="form-check-input dependency-checkbox"
              name="attributes[${attributeIndex}][dependency_parent][]" value="<?php echo e($attribute->id); ?>"
              id="dep-${attributeIndex}-<?php echo e($attribute->id); ?>">
              <label class="form-check-label" for="dep-${attributeIndex}-<?php echo e($attribute->id); ?>">
              <?php echo e($attribute->name); ?>

              </label>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                </div>
              </div>
              

    <div class="col-md-12 text-right">
      <button type="button" class="btn btn-danger btn-sm remove-attribute">Remove</button>
    </div>
  </div>
</div>
    `;

    $('#attribute-fields-wrapper').append(html);
    // const $newItem = $('#attribute-fields-wrapper .attribute-item').last();
    // const $pricing = $newItem.find('select[name$="[pricing_basis]"]');
    // if ($pricing.val() === 'per_page') {
    //   $newItem.find('select[name$="[allow_quantity]"]').val('1').prop('disabled', true);
    // }
    attributeIndex++;


  });

  // Remove attribute block
  $(document).on('click', '.remove-attribute', function () {
    $(this).closest('.attribute-item').remove();
  });

  // Trigger toggle for existing field on load (index 0)
  $(document).ready(function () {
    const $firstItem = $('.attribute-item').first();

    const selectedType = $firstItem.find('select[name$="[input_type]"]').val();
    toggleSupportFields($firstItem, selectedType);


    // Handle dependency on load
    const hasDependency = $firstItem.find('select[name$="[has_dependency]"]').val() === '1';
    if (hasDependency) {
      $firstItem.find('select[name$="[has_dependency]"]').trigger('change');
    }

    // const pricingBasis = $firstItem.find('select[name$="[pricing_basis]"]').val();
    // if (pricingBasis === 'per_page') {
    //   const $allowQty = $firstItem.find('select[name$="[allow_quantity]"]');
    //   const allowQtyName = $allowQty.attr('name');
    //   $allowQty.val('1').prop('disabled', true);

    //   if ($firstItem.find(`input[type="hidden"][name="${allowQtyName}"]`).length === 0) {
    //     $allowQty.after(`<input type="hidden" name="${allowQtyName}" value="1" class="hidden-allow-quantity">`);
    //   }
    // }

  });



</script><?php /**PATH D:\web-mingo-project\new\resources\views/admin/attributes/add.blade.php ENDPATH**/ ?>