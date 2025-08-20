<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Add Subcategory</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <form id="subcategory-form" enctype="multipart/form-data">
                @csrf

                <div class="form-row">
                    {{-- Categories --}}
                    <div class="form-group col-md-6">
                        <label>Select Categories</label>
                        <div class="form-control" style="height:150px; overflow-y:scroll;">
                            @foreach($categories as $category)
                                <div class="form-check">
                                    <input type="checkbox" name="category_ids[]" value="{{ $category->id }}"
                                        class="form-check-input">
                                    <label class="form-check-label">{{ $category->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="text-danger validation-err" id="category_ids-err"></div>
                    </div>

                    {{-- Description --}}
                    <div class="form-group col-md-6">
                        <label>Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3"
                            style="height:110px;"></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                        <div class="text-danger validation-err" id="name-err"></div>
                    </div>

                    {{-- Thumbnail --}}
                    <div class="form-group col-md-6">
                        <label>Thumbnail</label>
                        <input type="file" name="thumbnail" class="form-control">
                    </div>
                </div>

                {{-- Gallery --}}
                <div class="form-group">
                    <label>Gallery (multiple)</label>
                    <input type="file" id="gallery-input" class="form-control" multiple>
                    <div id="gallery-preview-list" class="row mt-2"></div>
                </div>

                {{-- Tabbed Sections --}}
                <ul class="nav nav-tabs" id="tabContent">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#info">Information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#sizes">Available Sizes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#binding">Binding Options</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#paper">Paper Types</a>
                    </li>
                </ul>

                <div class="tab-content pt-2">
                    <div class="tab-pane fade show active" id="info">
                        <textarea name="information" id="information" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="tab-pane fade" id="sizes">
                        <textarea name="available_sizes" id="available_sizes" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="tab-pane fade" id="binding">
                        <textarea name="binding_options" id="binding_options" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="tab-pane fade" id="paper">
                        <textarea name="paper_types" id="paper_types" class="form-control" rows="4"></textarea>
                    </div>
                </div>

                <div class="form-row pt-1">
                    {{-- Calculator Required --}}
                    <div class="form-group col-md-6">
                        <label>Calculator Required</label>
                        <select name="calculator_required" id="calculator_required" class="form-control">
                            <option value="0" selected>No</option>
                            <option value="1">Yes</option>
                        </select>
                        <div class="text-danger validation-err" id="calculator_required-err"></div>
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


                <button type="button" class="btn btn-primary" id="add-subcategory-btn">Save</button>
            </form>
        </div>
    </div>
</div>