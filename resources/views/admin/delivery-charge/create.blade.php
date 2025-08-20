<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <form id="delivery-charge-form" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title">Add Delivery Charges</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <div id="delivery-charges-wrapper">
          <div class="delivery-block border p-2 mb-2">
            <div class="row">
              <div class="form-group col-md-4" id="days-wrapper-0">
                <label>No Of Days <span class="text-danger">*</span></label>
                <input type="number" name="delivery_charges[0][no_of_days]" class="form-control" step="1"
                  placeholder="Enter No Of Days">
                <span class="text-danger validation-err" id="delivery_charges_0_no_of_days-err"></span>
              </div>

              <div class="form-group col-md-4" id="price-wrapper-0">
                <label>Price <span class="text-danger">*</span></label>
                <input type="number" name="delivery_charges[0][price]" class="form-control" step="1"
                  placeholder="Enter price">
                <span class="text-danger validation-err" id="delivery_charges_0_price-err"></span>
              </div>

              <div class="form-group col-md-4">
                <label>Delivery Title</label>
                <input type="text" name="delivery_charges[0][title]" class="form-control" placeholder="Enter title">
                <span class="text-danger validation-err" id="delivery_charges_0_title-err"></span>
              </div>
            </div>

            <div class="form-group">
              <label>Details</label>
              <textarea name="delivery_charges[0][details]" id="details-0" class="form-control ck-editor"
                rows="3"></textarea>
              <span class="text-danger validation-err" id="delivery_charges_0_details-err"></span>
            </div>

            <div class="form-check mb-2">
              <input type="checkbox" name="delivery_charges[0][is_default]" value="1" class="form-check-input"
                id="is_default_0">
              <label class="form-check-label" for="is_default_0">Set as Default</label>
            </div>
          </div>
        </div>

        <button type="button" class="btn btn-success btn-sm mb-2" id="add-more-delivery">Add More</button>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal">Cancel</button>
          <button type="button" id="save-delivery-charge-btn" class="btn btn-primary">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  function initDeliveryModalScripts() {
    let valueIndex = $('#delivery-charges-wrapper .delivery-block').length;

    $('#add-more-delivery').off('click').on('click', function () {
      const newBlock = `
      <div class="delivery-block border p-2 mb-2">
        <div class="row">
          <div class="form-group col-md-4">
            <label>No Of Days <span class="text-danger">*</span></label>
            <input type="number" name="delivery_charges[${valueIndex}][no_of_days]" class="form-control" step="1"
              placeholder="Enter No Of Days">
            <span class="text-danger validation-err" id="delivery_charges_${valueIndex}_no_of_days-err"></span>
          </div>
          <div class="form-group col-md-4">
            <label>Price <span class="text-danger">*</span></label>
            <input type="text" name="delivery_charges[${valueIndex}][price]" class="form-control"
              placeholder="Enter price">
            <span class="text-danger validation-err" id="delivery_charges_${valueIndex}_price-err"></span>
          </div>
          <div class="form-group col-md-4">
            <label>Delivery Title</label>
            <input type="text" name="delivery_charges[${valueIndex}][delivery]" class="form-control"
              placeholder="Enter title">
            <span class="text-danger validation-err" id="delivery_charges_${valueIndex}_delivery-err"></span>
          </div>
        </div>

        <div class="form-group">
          <label>Details</label>
          <textarea name="delivery_charges[${valueIndex}][details]" id="details-${valueIndex}" class="form-control ck-editor" rows="3"></textarea>
          <span class="text-danger validation-err" id="delivery_charges_${valueIndex}_details-err"></span>
        </div>

        <div class="form-check mb-2">
          <input type="checkbox" name="delivery_charges[${valueIndex}][is_default]" value="1" class="form-check-input" id="is_default_${valueIndex}">
          <label class="form-check-label" for="is_default_${valueIndex}">Set as Default</label>
        </div>

        <button type="button" class="btn btn-danger btn-sm remove-delivery">Remove</button>
      </div>
      `;
      $('#delivery-charges-wrapper').append(newBlock);
      ClassicEditorInit();
      valueIndex++;
    });

    function ClassicEditorInit() {
      $('.ck-editor').each(function () {
        const id = $(this).attr('id');
        if (CKEDITOR.instances[id]) {
          CKEDITOR.instances[id].destroy(true);
        }
        CKEDITOR.replace(id);
      });
    }

    $(document).off('click', '.remove-delivery').on('click', '.remove-delivery', function () {
      $(this).closest('.delivery-block').remove();
    });

    ClassicEditorInit();
  }

  $('#yourModalId').on('shown.bs.modal', function () {
    initDeliveryModalScripts();
  });
</script>