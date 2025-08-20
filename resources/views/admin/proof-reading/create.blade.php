<div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
    <form id="proof-reading-form" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title">Add Proof Reading</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        {{-- Values Wrapper --}}
        <div id="proof-values-wrapper">
          <div class="reading-block border p-2 mb-2">
            <div class="form-group" id="reading-input-wrapper-0">
              <label>Proof Type <span class="text-danger">*</span></label>
              <input type="text" name="proof_readings[0][proof_type]" class="form-control"
                placeholder="Enter proof type">
              <span class="text-danger validation-err" id="proof_readings_0_proof_type-err"></span>
            </div>

            <div class="form-group" id="title-wrapper-0">
              <label>Price <span class="text-danger">*</span></label>
              <input type="number" name="proof_readings[0][price]" class="form-control" step="1"
                placeholder="Enter price">
              <span class="text-danger validation-err" id="proof_readings_0_price-err"></span>
            </div>
          </div>
        </div>

        <!-- ✅ Move this outside -->
        <button type="button" class="btn btn-success btn-sm mb-2" id="add-more-reading">Add More</button>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal">Cancel</button>
          <button type="button" id="save-proof-reading-btn" class="btn btn-primary">Save</button>
        </div>

    </form>
  </div>
</div>
<script>
  function initProofModalScripts() {
    let valueIndex = $('#proof-values-wrapper .reading-block').length;
    console.log('herer');

    // Add new block
    $('#add-more-reading').off('click').on('click', function () {
      const newBlock = `
        <div class="reading-block border p-2 mb-2">
          <div class="form-group" id="reading-input-wrapper-${valueIndex}">
            <label>Proof Type <span class="text-danger">*</span></label>
            <input type="text" name="proof_readings[${valueIndex}][proof_type]" class="form-control" placeholder="Enter proof type">
            <span class="text-danger validation-err" id="proof_readings_${valueIndex}_proof_type-err"></span>
          </div>

          <div class="form-group" id="title-wrapper-${valueIndex}">
            <label>Price <span class="text-danger">*</span></label>
            <input type="text" name="proof_readings[${valueIndex}][price]" class="form-control"  placeholder="Enter price">
            <span class="text-danger validation-err" id="proof_readings_${valueIndex}_price-err"></span>
          </div>

          <button type="button" class="btn btn-danger btn-sm remove-reading">Remove</button>
        </div>
      `;
      $('#proof-values-wrapper').append(newBlock);
      valueIndex++;
    });

    // Remove block
    $(document).off('click', '.remove-reading').on('click', '.remove-reading', function () {
      $(this).closest('.reading-block').remove();
    });
  }

  // Call this when modal is shown (bootstrap event)
  $('#yourModalId').on('shown.bs.modal', function () {
    initProofModalScripts();
  });
</script>