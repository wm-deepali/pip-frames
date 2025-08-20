<div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
    <form id="subcategory-attribute-form">
      <div class="modal-header">
        <h5 class="modal-title">Edit Subcategory Attribute Mapping</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <div class="form-group">
          <label>Subcategory <span class="text-danger">*</span></label>
          <select name="subcategory_id" class="form-control">
            @foreach($subcategories as $subcategory)
        <option value="{{ $subcategory->id }}" {{ $subcategoryAttribute->subcategory_id == $subcategory->id ? 'selected' : '' }}>
          {{ $subcategory->name }}
        </option>
      @endforeach
          </select>
          <span class="text-danger validation-err" id="subcategory_id-err"></span>
        </div>

        <div class="form-group">
          <label>Attribute <span class="text-danger">*</span></label>
          <select name="attribute_id" class="form-control">
            @foreach($attributes as $attribute)
        <option value="{{ $attribute->id }}" data-input-type="{{ $attribute->input_type }}" {{ $subcategoryAttribute->attribute_id == $attribute->id ? 'selected' : '' }}>
          {{ $attribute->name }}
        </option>
      @endforeach
          </select>
          <span class="text-danger validation-err" id="attribute_id-err"></span>
        </div>

        <div class="form-group">
          <label>Attribute Values <span class="text-danger">*</span></label>
          <div id="attribute-values-checkboxes" class="scrollable-checkbox-box">
            <!-- Checkboxes will be filled dynamically -->
          </div>
          <span class="text-danger validation-err" id="attribute_value_ids-err"></span>
        </div>

        <div class="form-group">
          <label>Is Required?</label>
          <select name="is_required" class="form-control">
            <option value="1" {{ $subcategoryAttribute->is_required ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ !$subcategoryAttribute->is_required ? 'selected' : '' }}>No</option>
          </select>
        </div>

        <div class="form-group">
          <label>Sort Order</label>
          <input type="number" name="sort_order" class="form-control" value="{{ $subcategoryAttribute->sort_order }}">
          <span class="text-danger validation-err" id="sort_order-err"></span> <!-- Add this -->
        </div>


        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" id="save-subcategory-attribute-btn" data-id="{{ $subcategoryAttribute->id }}"
            class="btn btn-primary">Update</button>
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
  }
</style>

<script>
  $(document).ready(function () {
    let currentAttributeId = $('select[name="attribute_id"]').val();
    let currentSubcategoryId = $('select[name="subcategory_id"]').val();
    const $wrapper = $('#attribute-values-checkboxes');

    function loadAttributeValues(attributeId, subcategoryId) {
      if (!attributeId || !subcategoryId) return;

      $.get(`/admin/attributes/${attributeId}/values?subcategory_id=${subcategoryId}`, function (res) {
        if (res.success) {
          $wrapper.empty(); // Clear existing checkboxes
          const selected = res.selected_values || [];

          // Add "Select All" if more than one value exists
          if (res.values.length > 1) {
            const selectAll = `
              <div class="form-check mb-1">
                <input type="checkbox" class="form-check-input select-all-values" id="select-all-${attributeId}">
                <label class="form-check-label" for="select-all-${attributeId}"><strong>Select All</strong></label>
              </div>
            `;
            $wrapper.append(selectAll);
          }

          // Append individual value checkboxes
          res.values.forEach(val => {
            const isChecked = selected.includes(val.id) ? 'checked' : '';
            const checkbox = `
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="attribute_value_ids[]" value="${val.id}" id="attr-val-${val.id}" ${isChecked}>
                <label class="form-check-label mr-2" for="attr-val-${val.id}">${val.value}</label>
              </div>
            `;
            $wrapper.append(checkbox);
          });
        }
      });
    }

    // Initial load on modal open
    toggleAttributeValuesSection();
    loadAttributeValues(currentAttributeId, currentSubcategoryId);

    // On attribute change
    $(document).on('change', 'select[name="attribute_id"]', function () {
      const newAttrId = $(this).val();
      const subcategoryId = $('select[name="subcategory_id"]').val();

      if (newAttrId === currentAttributeId) return;

      currentAttributeId = newAttrId;
      toggleAttributeValuesSection(); // 👈 Add this line
      loadAttributeValues(newAttrId, subcategoryId);
    });

    // "Select All" toggle
    $(document).on('change', '.select-all-values', function () {
      const isChecked = $(this).is(':checked');
      const $container = $(this).closest('#attribute-values-checkboxes');
      $container.find('input[type="checkbox"]').not(this).prop('checked', isChecked);
    });

    function toggleAttributeValuesSection() {
      console.log('her');
      
      const selectedOption = $('select[name="attribute_id"]').find('option:selected');
      const inputType = selectedOption.data('input-type');
      const $valuesGroup = $('#attribute-values-checkboxes').closest('.form-group');

      if (inputType === 'select_area') {
        $valuesGroup.hide();
      } else {
        $valuesGroup.show();
      }
    }


  });
</script>