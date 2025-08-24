<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <form id="attribute-condition-form">
      <div class="modal-header">
        <h5 class="modal-title">Add Attribute Condition</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        
        <div class="form-group">
          <label><strong>Subcategory <span class="text-danger">*</span></strong></label>
          <select name="subcategory_id" class="form-control" id="subcategory-select">
            <option value="">-- Select Subcategory --</option>
            <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($subcategory->id); ?>"><?php echo e($subcategory->name); ?></option>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
          <span class="text-danger validation-err" id="subcategory_id-err"></span>
        </div>

        
        <div id="conditions-container">
          <div class="condition-block border rounded p-1 mb-1">
            <div class="row">
              <div class="form-group col-md-6">
                <label><strong>Parent Attribute <span class="text-danger">*</span></strong></label>
                <select name="conditions[0][parent_attribute_id]" class="form-control parent-attribute-select">
                  <option value="">-- Select Attribute --</option>
                </select>
                <span class="text-danger validation-err parent_attribute_id-err"></span>

              </div>
              <div class="form-group col-md-6">
                <label><strong>Parent Value <span class="text-danger">*</span></strong></label>
                <select name="conditions[0][parent_value_id]" class="form-control parent-value-select">
                  <option value="">-- Select Value --</option>
                </select>
                <span class="text-danger validation-err parent_value_id-err"></span>
              </div>
            </div>

            <div class="row">
              <div class="form-group col-md-6">
                <label><strong>Affected Attribute <span class="text-danger">*</span></strong></label>
                <select name="conditions[0][affected_attribute_id]" class="form-control affected-attribute-select">
                  <option value="">-- Select Attribute --</option>
                </select>
                <span class="text-danger validation-err affected_attribute_id-err"></span>

              </div>
              <div class="form-group col-md-6">
                <label><strong>Action <span class="text-danger">*</span></strong></label>

                <select name="conditions[0][action]" class="form-control" id="add-action">
                    <option value="">-- Select Action --</option>
                  <option value="hide_attribute">Hide the entire attribute</option>
                  <option value="show_attribute">Always show the entire attribute</option>
                  <option value="hide_values">Hide selected options in the attribute</option>
                  <option value="show_values">Show only selected options in the attribute</option>
                </select>

              </div>
            </div>

            <div class="form-group" id="add-affected-values"> 
              <label><strong>Affected Value(s)</strong></label>
              <div class="scrollable-checkbox-box affected-values-checkboxes" >
                <p class="text-muted">Select values after choosing affected attribute.</p>
              </div>
              <span class="text-danger validation-err affected_value_id-err"></span>
            </div>

            <button type="button" class="btn btn-danger btn-sm remove-condition-btn d-none">Remove</button>
          </div>
        </div>

        <button type="button" id="add-more-condition" class="btn btn-outline-primary btn-sm">+ Add More</button>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal">Cancel</button>
        <button type="button" id="save-attribute-condition-btn" class="btn btn-primary">Save</button>
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
  let conditionIndex = 1;

  $(document).ready(function () {
    $('#subcategory-select').change(function () {
      const subcategoryId = $(this).val();
      if (!subcategoryId) return;

      $.get(`/admin/subcategories/${subcategoryId}/attributes`, function (res) {
        if (res.success) {
          window.attributeValueMap = {};
          $('.parent-attribute-select, .affected-attribute-select').empty().append(`<option value="">-- Select Attribute --</option>`);
          $('.parent-value-select').empty().append(`<option value="">-- Select Value --</option>`);

          res.attributes.forEach(attr => {
            const option = `<option value="${attr.id}">${attr.name}</option>`;
            $('.parent-attribute-select, .affected-attribute-select').append(option);
            window.attributeValueMap[attr.id] = attr.values;
          });
        }
      });
    });

    // Parent attribute change
    $(document).on('change', '.parent-attribute-select', function () {
      const attrId = $(this).val();
      const valueSelect = $(this).closest('.condition-block').find('.parent-value-select');
      valueSelect.empty().append(`<option value="">-- Select Value --</option>`);
      if (window.attributeValueMap && window.attributeValueMap[attrId]) {
        window.attributeValueMap[attrId].forEach(val => {
          valueSelect.append(`<option value="${val.id}">${val.value}</option>`);
        });
      }
    });

    // Affected attribute change
    $(document).on('change', '.affected-attribute-select', function () {
      const attrId = $(this).val();
      const container = $(this).closest('.condition-block').find('.affected-values-checkboxes');
      container.empty();
      if (window.attributeValueMap && window.attributeValueMap[attrId]) {
        window.attributeValueMap[attrId].forEach(val => {
          const checkbox = `
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="conditions[${conditionIndex - 1}][affected_value_ids][]" value="${val.id}">
              <label class="form-check-label">${val.value}</label>
            </div>`;
          container.append(checkbox);
        });
      }
    });

    // Add More Condition
    $('#add-more-condition').click(function () {
      const newBlock = $('.condition-block:first').clone();
      newBlock.find('select, input').val('');
      newBlock.find('.affected-values-checkboxes').html('<p class="text-muted">Select values after choosing affected attribute.</p>');
      newBlock.find('.remove-condition-btn').removeClass('d-none');

      // Update name attributes with new index
      newBlock.find('select, input').each(function () {
        const name = $(this).attr('name');
        if (name) {
          const updatedName = name.replace(/\[0\]/g, `[${conditionIndex}]`);
          $(this).attr('name', updatedName);
        }
      });

      $('#conditions-container').append(newBlock);
      conditionIndex++;
    });

    function toggleAffectedValuesVisibility() {
      const action = $('#add-action').val();

      if (action === 'hide_values' || action === 'show_values') {
        $('#add-affected-values').show();
      } else {
        $('#add-affected-values').hide();
      }
    }

    $('#add-action').on('change', function () {
      toggleAffectedValuesVisibility();
    });


    // Remove Condition Block
    $(document).on('click', '.remove-condition-btn', function () {
      $(this).closest('.condition-block').remove();
    });
  });
</script><?php /**PATH D:\web-mingo-project\new\resources\views/admin/attribute-conditions/create.blade.php ENDPATH**/ ?>