<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <form id="manage-vat-form" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title">Add Vat</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                {{-- Values Wrapper --}}
                <div id="manage-vat-wrapper">
                    <div class="vat-block border p-2 mb-2">
                        <div class="form-group" id="vat-input-wrapper-0">
                            <label>Country<span class="text-danger">*</span></label>
                            <select name="vats[0][country]" class="form-control" required>
                                <option value="">-- Select Country --</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="Ireland">Ireland</option>
                                <option value="Europe">Europe</option>
                            </select>
                            <span class="text-danger validation-err" id="vats_0_country-err"></span>
                        </div>

                        <div class="form-group" id="title-wrapper-0">
                            <label>Vat Percentage <span class="text-danger">*</span></label>
                            <input type="number" name="vats[0][vat_percentage]" class="form-control" step="1"
                                placeholder="Enter Percentage">
                            <span class="text-danger validation-err" id="vats_0_vat_percentage-err"></span>
                        </div>
                    </div>
                </div>

                <!-- ✅ Move this outside -->
                <button type="button" class="btn btn-success btn-sm mb-2" id="add-more-vat">Add More</button>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal">Cancel</button>
                    <button type="button" id="save-manage-vat-btn" class="btn btn-primary">Save</button>
                </div>

        </form>
    </div>
</div>
<script>
    function initVatModalScripts() {
        let valueIndex = $('#manage-vat-wrapper .vat-block').length;
        console.log('herer');

        // Add new block
        $('#add-more-vat').off('click').on('click', function () {
            const newBlock = `
        <div class="vat-block border p-2 mb-2">
          <div class="form-group" id="vat-input-wrapper-${valueIndex}">
            <label>Country <span class="text-danger">*</span></label>
            <select name="vats[${valueIndex}][country]" class="form-control" required>
  <option value="">-- Select Country --</option>
  <option value="United Kingdom">United Kingdom</option>
  <option value="Ireland">Ireland</option>
  <option value="Europe">Europe</option>
</select>
            <span class="text-danger validation-err" id="vats_${valueIndex}_country-err"></span>
          </div>

          <div class="form-group" id="title-wrapper-${valueIndex}">
            <label>Vat Percentage <span class="text-danger">*</span></label>
            <input type="text" name="vats[${valueIndex}][vat_percentage]" class="form-control"  placeholder="Enter percentage">
            <span class="text-danger validation-err" id="vats_${valueIndex}_vat_percentage-err"></span>
          </div>

          <button type="button" class="btn btn-danger btn-sm remove-vat">Remove</button>
        </div>
      `;
            $('#manage-vat-wrapper').append(newBlock);
            valueIndex++;
        });

        // Remove block
        $(document).off('click', '.remove-vat').on('click', '.remove-vat', function () {
            $(this).closest('.vat-block').remove();
        });
    }

    // Call this when modal is shown (bootstrap event)
    $('#yourModalId').on('shown.bs.modal', function () {
        initVatModalScripts();
    });
</script>