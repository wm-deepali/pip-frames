<div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
    <form id="proof-reading-form" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title">Edit Proof Reading</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <div>
          <div class="reading-block border p-2 mb-2">
            <div class="form-group" id="reading-input-wrapper-0">
              <label>Proof Type <span class="text-danger">*</span></label>
              <input type="text"  value="{{ $ProofReading->proof_type }}" name="proof_type" class="form-control">
              <span class="validation-err proof_type-err text-danger"></span>
            </div>

            <div class="form-group" id="title-wrapper-0">
              <label>Price <span class="text-danger">*</span></label>
              <input type="text" name="price" class="form-control"  value="{{ $ProofReading->price }}" >
              <span class="validation-err price-err text-danger"></span>
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal">Cancel</button>
          <button type="button" id="update-proof-reading-btn" class="btn btn-primary"   data-id="{{ $ProofReading->id }}">Update</button>
        </div>

    </form>
  </div>
</div>
