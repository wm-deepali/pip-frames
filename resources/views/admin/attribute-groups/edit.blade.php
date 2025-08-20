<div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
    <form id="attribute-form" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title">Edit Attribute Group</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <div class="form-group">
          <label>Group Name <span class="text-danger">*</span></label>
          <input type="text" name="name" class="form-control" value="{{ $group->name }}">
          <small class="text-danger validation-err" id="name-err"></small>
        </div>

        <div class="form-group">
          <label>Select Attributes <span class="text-danger">*</span></label>
          <div class="border p-2" style="max-height: 300px; overflow-y: auto;">
            @foreach ($attributes as $attribute)
              <div class="form-check">
                <input type="checkbox" 
                       name="attribute_ids[]" 
                       value="{{ $attribute->id }}" 
                       class="form-check-input" 
                       id="attr-{{ $attribute->id }}"
                       {{ $group->attributes->contains($attribute->id) ? 'checked' : '' }}>
                <label class="form-check-label" for="attr-{{ $attribute->id }}">
                  {{ $attribute->name }} ({{ ucfirst(str_replace('_', ' ', $attribute->input_type)) }})
                </label>
              </div>
            @endforeach
          </div>
          <small class="text-danger validation-err" id="attribute_ids-err"></small>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="update-attribute-btn" data-id="{{ $group->id }}">Update</button>
      </div>
    </form>
  </div>
</div>
