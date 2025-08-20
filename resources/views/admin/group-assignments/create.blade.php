<!-- Add Group Assignment Modal -->
<div class="modal-dialog modal-md" role="document">
  <div class="modal-content">
    <form id="group-assignment-form">
      <div class="modal-header">
        <h5 class="modal-title">{{ $assignment ? 'Edit' : 'Add' }} Group Assignment</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <input type="hidden" name="assignment_id" value="{{ $assignment->id ?? '' }}">

        <!-- Subcategory Dropdown -->
        <div class="form-group">
          <label>Subcategory <span class="text-danger">*</span></label>
          <select name="subcategory_id" class="form-control">
            <option value="">-- Select Subcategory --</option>
            @foreach ($subcategories as $subcat)
              <option value="{{ $subcat->id }}"
                {{ optional($assignment)->subcategory_id == $subcat->id ? 'selected' : '' }}>
                {{ $subcat->name }}
              </option>
            @endforeach
          </select>
          <small class="text-danger validation-err" id="subcategory_id-err"></small>
        </div>

        <!-- Attribute Group Dropdown -->
        <div class="form-group">
          <label>Attribute Group <span class="text-danger">*</span></label>
          <select name="attribute_group_id" class="form-control">
            <option value="">-- Select Group --</option>
            @foreach ($attributeGroups as $group)
              <option value="{{ $group->id }}"
                {{ optional($assignment)->attribute_group_id == $group->id ? 'selected' : '' }}>
                {{ $group->name }}
              </option>
            @endforeach
          </select>
          <small class="text-danger validation-err" id="attribute_group_id-err"></small>
        </div>

        <!-- Sort Order -->
        <div class="form-group">
          <label>Sort Order</label>
          <input type="number" name="sort_order" class="form-control"
            value="{{ optional($assignment)->sort_order ?? 0 }}">
          <small class="text-danger validation-err" id="sort_order-err"></small>
        </div>

        <!-- Toggleable Checkbox -->
        <div class="form-check">
          <input type="checkbox" name="is_toggleable" value="1" class="form-check-input"
            id="is_toggleable"
            {{ optional($assignment)->is_toggleable ? 'checked' : '' }}>
          <label class="form-check-label" for="is_toggleable">Toggleable</label>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="{{ $assignment ? 'update-assignment-btn' : 'save-group-btn' }}"
          data-id="{{ $assignment->id ?? '' }}">
          {{ $assignment ? 'Update' : 'Save' }}
        </button>
      </div>
    </form>
  </div>
</div>
