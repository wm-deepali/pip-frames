<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <form id="postal-code-form" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title">Edit Postal Code</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div>
                    <div class="form-group">
                        <label>Serviceable <span class="text-danger">*</span></label>
                        <select name="is_serviceable" class="form-control">
                            <option value="1" {{ $PostalCode->is_serviceable ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ !$PostalCode->is_serviceable ? 'selected' : '' }}>No</option>
                        </select>
                        <span class="validation-err is_serviceable-err text-danger"></span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal">Cancel</button>
                    <button type="button" id="update-postal-code-btn" class="btn btn-primary"
                        data-id="{{ $PostalCode->id }}">Update</button>
                </div>

        </form>
    </div>
</div>