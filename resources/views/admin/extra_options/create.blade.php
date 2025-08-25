<!-- Add Extra Option Modal -->
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <form id="extra-option-form" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title">Add Extra Option</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div id="extra-option-fields-wrapper">
          <div class="extra-option-item border p-2 mb-2">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Title <span class="text-danger">*</span></label>
                  <input type="text" name="extra_options[0][title]" class="form-control">
                  <small class="text-danger validation-err" id="extra_options_0_title-err"></small>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Code <span class="text-danger">*</span></label>
                  <input type="text" name="extra_options[0][code]" class="form-control" placeholder="e.g. digital, skip">
                  <small class="text-danger validation-err" id="extra_options_0_code-err"></small>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Description</label>
                  <textarea name="extra_options[0][description]" class="form-control" rows="2"
                            placeholder="E.g. description for display"></textarea>
                  <small class="text-danger validation-err" id="extra_options_0_description-err"></small>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Price (£) <span class="text-danger">*</span></label>
                  <input type="number" step="0.01" min="0" name="extra_options[0][price]" class="form-control">
                  <small class="text-danger validation-err" id="extra_options_0_price-err"></small>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Active</label>
                  <select name="extra_options[0][is_active]" class="form-control">
                    <option value="1" selected>Yes</option>
                    <option value="0">No</option>
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label>Sort Order</label>
                  <input type="number" min="0" name="extra_options[0][sort_order]" value="0" class="form-control">
                  <small class="text-danger validation-err" id="extra_options_0_sort_order-err"></small>
                </div>
              </div>
              <div class="col-md-12 text-right">
                <button type="button" class="btn btn-danger btn-sm remove-extra-option d-none">Remove</button>
              </div>
            </div>
          </div>
        </div>
        <button type="button" class="btn btn-sm btn-success" id="add-more-extra-option">Add More</button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="save-extra-option-btn">Save</button>
      </div>
    </form>
  </div>
</div>

<script>
let extraOptionIndex = 1;

// Add new extra option field block
$(document).on('click', '#add-more-extra-option', function () {
  const html = `
    <div class="extra-option-item border p-2 mb-2">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Title <span class="text-danger">*</span></label>
            <input type="text" name="extra_options[${extraOptionIndex}][title]" class="form-control">
            <small class="text-danger validation-err" id="extra_options_${extraOptionIndex}_title-err"></small>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label>Code <span class="text-danger">*</span></label>
            <input type="text" name="extra_options[${extraOptionIndex}][code]" class="form-control" placeholder="e.g. digital, skip">
            <small class="text-danger validation-err" id="extra_options_${extraOptionIndex}_code-err"></small>
          </div>
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label>Description</label>
            <textarea name="extra_options[${extraOptionIndex}][description]" class="form-control" rows="2"
                      placeholder="E.g. description for display"></textarea>
            <small class="text-danger validation-err" id="extra_options_${extraOptionIndex}_description-err"></small>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>Price (£) <span class="text-danger">*</span></label>
            <input type="number" step="0.01" min="0" name="extra_options[${extraOptionIndex}][price]" class="form-control">
            <small class="text-danger validation-err" id="extra_options_${extraOptionIndex}_price-err"></small>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>Active</label>
            <select name="extra_options[${extraOptionIndex}][is_active]" class="form-control">
              <option value="1" selected>Yes</option>
              <option value="0">No</option>
            </select>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label>Sort Order</label>
            <input type="number" min="0" name="extra_options[${extraOptionIndex}][sort_order]" value="0" class="form-control">
            <small class="text-danger validation-err" id="extra_options_${extraOptionIndex}_sort_order-err"></small>
          </div>
        </div>
        <div class="col-md-12 text-right">
          <button type="button" class="btn btn-danger btn-sm remove-extra-option">Remove</button>
        </div>
      </div>
    </div>
  `;
  $('#extra-option-fields-wrapper').append(html);
  extraOptionIndex++;
});

// Remove extra option block
$(document).on('click', '.remove-extra-option', function () {
  $(this).closest('.extra-option-item').remove();
});
</script>
