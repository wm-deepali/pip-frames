<!-- Add Attribute Group Modal -->
<div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
    <form id="attribute-group-form">
      <div class="modal-header">
        <h5 class="modal-title">Add Attribute Group</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <div class="form-group">
          <label>Group Name <span class="text-danger">*</span></label>
          <input type="text" name="name" class="form-control" placeholder="Enter group name">
          <small class="text-danger validation-err" id="name-err"></small>
        </div>

        <div class="form-group">
          <label>Select Attributes <span class="text-danger">*</span></label>
          <div class="border p-2" style="max-height: 300px; overflow-y: auto;">
            @forelse ($attributes as $attribute)
              <div class="form-check">
                <input type="checkbox" name="attribute_ids[]" value="{{ $attribute->id }}" class="form-check-input" id="attr-{{ $attribute->id }}">
                <label class="form-check-label" for="attr-{{ $attribute->id }}">
                  {{ $attribute->name }} ({{ ucfirst(str_replace('_', ' ', $attribute->input_type)) }})
                </label>
              </div>
            @empty
              <p class="text-muted">No attributes available.</p>
            @endforelse
          </div>
          <small class="text-danger validation-err" id="attribute_ids-err"></small>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="save-group-btn">Save</button>
      </div>
    </form>
  </div>
</div>
