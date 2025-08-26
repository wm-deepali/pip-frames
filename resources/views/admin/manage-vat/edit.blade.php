<div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
        <form id="manage-vat-form" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title">Edit Vat</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div>
                    <div class="vat-block border p-2 mb-2">
                        <div class="form-group">
                            <label>Country<span class="text-danger">*</span></label>
                            <select name="country" class="form-control" required>
                                <option value="">-- Select Country --</option>
                                <option value="United Kingdom" {{ $Vat->country == 'United Kingdom' ? 'selected' : '' }}>
                                    United Kingdom</option>
                                <option value="Ireland" {{ $Vat->country == 'Ireland' ? 'selected' : '' }}>Ireland
                                </option>
                                <option value="Europe" {{ $Vat->country == 'Europe' ? 'selected' : '' }}>Europe</option>
                            </select>

                            <span class="validation-err country-err text-danger"></span>
                        </div>

                        <div class="form-group">
                            <label>Vat Percentage <span class="text-danger">*</span></label>
                            <input type="number" name="vat_percentage" class="form-control" step="1"
                                value="{{ $Vat->vat_percentage }}" placeholder="Enter Percentage">
                            <span class="validation-err price-err text-danger"></span>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal">Cancel</button>
                    <button type="button" id="update-manage-vat-btn" class="btn btn-primary"
                        data-id="{{ $Vat->id }}">Update</button>
                </div>

        </form>
    </div>
</div>