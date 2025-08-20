<div class="modal-dialog">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Edit</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <div class="container-fluid">
                <form id="edit-category-form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="category_id" value="{{ $category->id }}">

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter name" value="{{ $category->name }}">
                        <div class="text-danger validation-err" id="name-err"></div>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="active" {{ $category->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $category->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        <div class="text-danger validation-err" id="status-err"></div>
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" class="form-control-file">
                        <div class="text-danger validation-err" id="image-err"></div>

                        @if($category->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $category->image) }}" alt="Current Image" width="100" class="img-thumbnail">
                            </div>
                        @endif
                    </div>

                    <div class="form-group text-right">
                        <button type="button" class="btn btn-info" id="update-category-btn" data-category-id="{{ $category->id }}">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
