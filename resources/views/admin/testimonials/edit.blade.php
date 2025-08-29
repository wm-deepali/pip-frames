<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Testimonial</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <form id="testimonial-edit-form" enctype="multipart/form-data">
                @csrf

                <div class="form-row">
                    {{-- Author Name --}}
                    <div class="form-group col-md-6">
                        <label>Author Name <span class="text-danger">*</span></label>
                        <input type="text" name="author_name" id="author_name" class="form-control"
                            value="{{ $testimonial->author_name }}" required>
                        <div class="text-danger validation-err" id="author_name-err"></div>
                    </div>

                    {{-- Author Image --}}
                    <div class="form-group col-md-6">
                        <label>Author Image</label>
                        <input type="file" name="author_image" id="author_image" class="form-control">
                        @if($testimonial->author_image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $testimonial->author_image) }}" alt="Author Image"
                                class="img-thumbnail" style="height:100px; width:100px; object-fit:cover;">
                        </div>
                        @endif
                        <div class="text-danger validation-err" id="author_image-err"></div>
                    </div>
                </div>

                <div class="form-row">
                    {{-- Location --}}
                    <div class="form-group col-md-6">
                        <label>Location</label>
                        <input type="text" name="location" id="location" class="form-control"
                            value="{{ $testimonial->location }}">
                        <div class="text-danger validation-err" id="location-err"></div>
                    </div>

                    {{-- Status --}}
                    <div class="form-group col-md-6">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="active" {{ $testimonial->status == 'active' ? 'selected' : '' }}>Active
                            </option>
                            <option value="inactive" {{ $testimonial->status == 'inactive' ? 'selected' : '' }}>InActive
                            </option>
                        </select>
                        <div class="text-danger validation-err" id="status-err"></div>
                    </div>
                </div>

                {{-- Feedback Content --}}
                <div class="form-group">
                    <label>Feedback <span class="text-danger">*</span></label>
                    <textarea name="feedback" id="feedback" rows="5" class="form-control" required>{{ $testimonial->feedback }}</textarea>
                    <div class="text-danger validation-err" id="feedback-err"></div>
                </div>

                <button type="button" class="btn btn-primary" id="update-testimonial-btn"
                    data-testimonial-id="{{ $testimonial->id }}">Update</button>
            </form>
        </div>
    </div>
</div>
