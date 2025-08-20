<div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
    <form id="attribute-value-form" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title">Add Attribute Value</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        {{-- Attribute Select --}}
        <div class="form-group">
          <label>Attribute <span class="text-danger">*</span></label>
          <select name="attribute_id" class="form-control" id="attribute-select">
            @foreach ($attributes as $attribute)
        <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
      @endforeach
          </select>
          <span class="text-danger validation-err" id="attribute_id-err"></span>
        </div>

        {{-- Values Wrapper --}}
        <div id="attribute-values-wrapper">
          <div class="value-block border p-2 mb-2">
            <div class="form-group" id="value-input-wrapper-0">
              <label>Value <span class="text-danger">*</span></label>
              <input type="text" name="attribute_values[0][value]" class="form-control">
              <span class="text-danger validation-err" id="values_0_value-err"></span>
            </div>

            <div class="form-group d-none" id="title-wrapper-0">
              <label>Title <span class="text-danger">*</span></label>
              <input type="text" name="attribute_values[0][title]" class="form-control">
              <span class="text-danger validation-err" id="values_0_title-err"></span>
            </div>

            <div class="form-group" id="icon-class-wrapper-0">
              <label>Icon Class (optional)</label>
              <input type="text" name="attribute_values[0][icon_class]" class="form-control"
                placeholder="e.g., fa fa-star">
              <span class="text-danger validation-err" id="values_0_icon_class-err"></span>
            </div>

            <div class="form-group" id="image-wrapper-0">
              <label>Image (optional)</label>
              <input type="file" name="attribute_values[0][image]" class="form-control-file">
              <span class="text-danger validation-err" id="values_0_image-err"></span>
            </div>

            <div class="form-group d-none" id="custom-label-wrapper-0">
              <label>Custom Input Label</label>
              <input type="text" name="attribute_values[0][custom_input_label]" class="form-control">
              <span class="text-danger validation-err" id="values_0_custom_input_label-err"></span>
            </div>



            <div class="form-group mb-2" id="is-composite-wrapper-0">
              <label for="is_composite_0">Is Composite Value?</label>
              <select class="form-control is-composite-select" data-index="0" name="attribute_values[0][is_composite]"
                id="is_composite_0">
                <option value="0">No</option>
                <option value="1">Yes</option>
              </select>
            </div>


            <div class="form-group d-none composed-of-wrapper" id="composed-of-wrapper-0">
              <label>Select Composed Of Values</label>
              <div id="composed-of-select-wrapper-0"></div>
              <span class="text-danger validation-err" id="values_0_composed_of-err"></span>
            </div>
            <button type="button" class="btn btn-danger btn-sm remove-value d-none">Remove</button>
          </div>
        </div>

        <button type="button" class="btn btn-success btn-sm" id="add-more-value">Add More</button>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal">Cancel</button>
        <button type="button" id="save-attribute-value-btn" class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
</div>

<script>
  function initAttributeModalScripts() {
    const existingValuesGrouped = @json($existingValuesGrouped);
    const attributeConfigs = @json($attributeConfigs);
    let valueIndex = $('#attribute-values-wrapper .value-block').length;

    function renderValueField(index, isFileType) {
      const wrapper = $(`#value-input-wrapper-${index}`);
      const input = isFileType
        ? `<input type="file" name="attribute_values[${index}][value]" class="form-control-file">`
        : `<input type="text" name="attribute_values[${index}][value]" class="form-control">`;
      wrapper.html(`
        <label>Value ${isFileType ? '(File)' : ''} <span class="text-danger">*</span></label>
        ${input}
        <span class="text-danger validation-err" id="values_${index}_value-err"></span>
      `);
    }

    function toggleFieldsForBlock(index) {
      const attributeId = $('#attribute-select').val();
      const config = attributeConfigs[attributeId] || {};
      const inputType = config.input_type || '';
      const customInputType = config.custom_input_type || 'none';

      const isFileType = ['select_image', 'select_icon'].includes(inputType);

      // Hide value input if input_type is select_area
      // Hide the entire value block if input_type is select_area
      const blockWrapper = $(`#value-input-wrapper-${index}`).closest('.value-block');
      if (inputType === 'select_area') {
        blockWrapper.addClass('d-none');
      } else {
        blockWrapper.removeClass('d-none');
        renderValueField(index, isFileType);
      }


      if (['text', 'number', 'file'].includes(customInputType)) {
        $(`#custom-label-wrapper-${index}`).removeClass('d-none');
      } else {
        $(`#custom-label-wrapper-${index}`).addClass('d-none');
      }

      $(`#icon-class-wrapper-${index}`)[config.has_icon ? 'show' : 'hide']();
      $(`#image-wrapper-${index}`)[config.has_image ? 'show' : 'hide']();
      $(`#title-wrapper-${index}`)[isFileType ? 'removeClass' : 'addClass']('d-none');

      if (config.is_composite) {
        $(`#is-composite-wrapper-${index}`).show();
      } else {
        $(`#is-composite-wrapper-${index}`).hide();
        $(`#is_composite_${index}`).prop('checked', false);
        $(`#composed-of-wrapper-${index}`).addClass('d-none');
      }

      const isChecked = $(`#is_composite_${index}`).val() === '1';
      $(`#composed-of-wrapper-${index}`)[isChecked ? 'removeClass' : 'addClass']('d-none');

      if (isChecked) {
        renderComposedOfSelect(index);
      }
    }


    // Initial toggle
    toggleFieldsForBlock(0);


    $('#attribute-select').off('change').on('change', function () {
      for (let i = 0; i < valueIndex; i++) {
        toggleFieldsForBlock(i);

        // If checkbox is checked, rerender composed select with new values
        if ($(`#is_composite_${i}`).is(':checked')) {
          renderComposedOfSelect(i);
        }
      }
    });


    $('#add-more-value').off('click').on('click', function () {
      const newBlock = `
        <div class="value-block border p-2 mb-2">
          <div class="form-group" id="value-input-wrapper-${valueIndex}">
            <label>Value <span class="text-danger">*</span></label>
            <input type="text" name="attribute_values[${valueIndex}][value]" class="form-control">
            <span class="text-danger validation-err" id="values_${valueIndex}_value-err"></span>
          </div>

          <div class="form-group d-none" id="title-wrapper-${valueIndex}">
            <label>Title <span class="text-danger">*</span></label>
            <input type="text" name="attribute_values[${valueIndex}][title]" class="form-control">
            <span class="text-danger validation-err" id="values_${valueIndex}_title-err"></span>
          </div>

          <div class="form-group" id="icon-class-wrapper-${valueIndex}">
            <label>Icon Class (optional)</label>
            <input type="text" name="attribute_values[${valueIndex}][icon_class]" class="form-control">
            <span class="text-danger validation-err" id="values_${valueIndex}_icon_class-err"></span>
          </div>

          <div class="form-group" id="image-wrapper-${valueIndex}">
            <label>Image (optional)</label>
            <input type="file" name="attribute_values[${valueIndex}][image]" class="form-control-file">
            <span class="text-danger validation-err" id="values_${valueIndex}_image-err"></span>
          </div>

           <div class="form-group d-none" id="custom-label-wrapper-${valueIndex}">
              <label>Custom Input Label</label>
              <input type="text" name="attribute_values[${valueIndex}][custom_input_label]" class="form-control">
              <span class="text-danger validation-err" id="values_${valueIndex}_custom_input_label-err"></span>
            </div>

              

<div class="form-group mb-2" id="is-composite-wrapper-${valueIndex}">
  <label for="is_composite_${valueIndex}">Is Composite Value?</label>
  <select class="form-control is-composite-select" data-index="${valueIndex}" name="attribute_values[${valueIndex}][is_composite]" id="is_composite_${valueIndex}">
    <option value="0">No</option>
    <option value="1">Yes</option>
  </select>
</div>


<div class="form-group d-none composed-of-wrapper" id="composed-of-wrapper-${valueIndex}">
  <label>Select Composed Of Values</label>
  <div id="composed-of-select-wrapper-${valueIndex}"></div>
  <span class="text-danger validation-err" id="values_${valueIndex}_composed_of-err"></span>
</div>


          <button type="button" class="btn btn-danger btn-sm remove-value">Remove</button>
        </div>
      `;
      $('#attribute-values-wrapper').append(newBlock);
      toggleFieldsForBlock(valueIndex);
      valueIndex++;
    });

    $(document).off('click', '.remove-value').on('click', '.remove-value', function () {
      $(this).closest('.value-block').remove();
    });

    $(document).off('change', '.is-composite-select').on('change', '.is-composite-select', function () {
      const index = $(this).data('index');
      const isComposite = $(this).val() === '1';
      $(`#composed-of-wrapper-${index}`)[isComposite ? 'removeClass' : 'addClass']('d-none');

      if (isComposite) {
        renderComposedOfSelect(index);
      }
    });



    function renderComposedOfSelect(index) {
      const attributeId = $('#attribute-select').val();
      const values = existingValuesGrouped[attributeId] || [];

      if (values.length === 0) {
        $(`#composed-of-select-wrapper-${index}`).html('<p class="text-muted">No values available.</p>');
        return;
      }

      let checkboxes = values.map(val => {
        return `
      <div class="form-check">
        <input class="form-check-input" 
               type="checkbox" 
               name="attribute_values[${index}][composed_of][]" 
               value="${val.id}" 
               id="composed_of_${index}_${val.id}">
        <label class="form-check-label" for="composed_of_${index}_${val.id}">
          ${val.display_value}
        </label>
      </div>
    `;
      }).join('');

      $(`#composed-of-select-wrapper-${index}`).html(checkboxes);
    }


  }
</script>