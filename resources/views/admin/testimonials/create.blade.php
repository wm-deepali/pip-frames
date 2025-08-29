<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Add Testimonial</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <form id="testimonial-form" enctype="multipart/form-data">
                @csrf

                <div class="form-row">
                    {{-- Author Name --}}
                    <div class="form-group col-md-6">
                        <label>Author Name <span class="text-danger">*</span></label>
                        <input type="text" name="author_name" id="author_name" class="form-control" required>
                        <div class="text-danger validation-err" id="author_name-err"></div>
                    </div>

                    {{-- Author Image --}}
                    <div class="form-group col-md-6">
                        <label>Author Image</label>
                        <input type="file" name="author_image" id="author_image" class="form-control">
                        <div class="text-danger validation-err" id="author_image-err"></div>
                    </div>
                </div>

                <div class="form-row">
                    {{-- Location --}}
                    <div class="form-group col-md-6">
                        <label>Location</label>
                        <input type="text" name="location" id="location" class="form-control">
                        <div class="text-danger validation-err" id="location-err"></div>
                    </div>

                    {{-- Status --}}
                    <div class="form-group col-md-6">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="active" selected>Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <div class="text-danger validation-err" id="status-err"></div>
                    </div>
                </div>

                {{-- Feedback Content --}}
                <div class="form-group">
                    <label>Feedback <span class="text-danger">*</span></label>
                    <textarea name="feedback" id="feedback" rows="5" class="form-control" required></textarea>
                    <div class="text-danger validation-err" id="feedback-err"></div>
                </div>

                <button type="button" class="btn btn-primary" id="add-testimonial-btn">Save</button>
            </form>
        </div>
    </div>
</div>
