<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <form id="edit-attribute-condition-form" data-id="{{ $condition->id }}">
      <div class="modal-header">
        <h5 class="modal-title">Edit Attribute Condition</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <input type="hidden" name="subcategory_id" value="{{ $condition->subcategory_id }}">

        <div class="form-group">
          <label><strong>Parent Attribute</strong></label>
          <select name="parent_attribute_id" class="form-control" id="edit-parent-attribute">
            <option value="">-- Select --</option>
          </select>
          <span class="text-danger validation-err" id="parent_attribute_id-err"></span>
        </div>

        <div class="form-group">
          <label><strong>Parent Value</strong></label>
          <select name="parent_value_id" class="form-control" id="edit-parent-value">
            <option value="">-- Select --</option>
          </select>
          <span class="text-danger validation-err" id="parent_value_id-err"></span>
        </div>

        <div class="form-group">
          <label><strong>Affected Attribute</strong></label>
          <select name="affected_attribute_id" class="form-control" id="edit-affected-attribute">
            <option value="">-- Select --</option>
          </select>
          <span class="text-danger validation-err" id="affected_attribute_id-err"></span>
        </div>

        <div class="form-group">
          <label><strong>Action</strong></label>
          <select name="action" class="form-control" id="edit-action">
            <option value="">-- Select Action --</option>
            <option value="hide_attribute" {{ $condition->action == 'hide_attribute' ? 'selected' : '' }}>Hide the entire
              attribute</option>
            <option value="show_attribute" {{ $condition->action == 'show_attribute' ? 'selected' : '' }}>Always show the
              entire attribute</option>
            <option value="hide_values" {{ $condition->action == 'hide_values' ? 'selected' : '' }}>Hide selected options
              in the attribute</option>
            <option value="show_values" {{ $condition->action == 'show_values' ? 'selected' : '' }}>Show only selected
              options in the attribute</option>
          </select>

          <span class="text-danger validation-err" id="action-err"></span>
        </div>

        <div class="form-group" id="affected-values">
          <label><strong>Affected Values</strong></label>
          <div class="scrollable-checkbox-box" id="edit-affected-values">
            <p class="text-muted">Select values after choosing affected attribute.</p>
          </div>
          <span class="text-danger validation-err" id="affected_value_ids-err"></span>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" id="update-attribute-condition-btn">Update</button>
      </div>
    </form>
  </div>
</div>

<style>
  .scrollable-checkbox-box {
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 10px;
    max-height: 150px;
    overflow-y: auto;
    background-color: #fff;
  }
</style>

<script>
  $(document).ready(function () {
    const attributes = @json($attributes);
    const condition = @json($condition);
    const selectedAffectedValueIds = condition.affected_values.map(v => v.id);

    const attrMap = {};
    attributes.forEach(attr => {
      attrMap[attr.id] = attr.values;

      // Add to both selects
      $('#edit-parent-attribute').append(
        `<option value="${attr.id}" ${attr.id == condition.parent_attribute_id ? 'selected' : ''}>${attr.name}</option>`
      );
      $('#edit-affected-attribute').append(
        `<option value="${attr.id}" ${attr.id == condition.affected_attribute_id ? 'selected' : ''}>${attr.name}</option>`
      );
    });

    // Initialize preselected values
    populateSelect('#edit-parent-value', attrMap[condition.parent_attribute_id], condition.parent_value_id);
    populateCheckboxes('#edit-affected-values', attrMap[condition.affected_attribute_id], selectedAffectedValueIds);

    $('#edit-parent-attribute').change(function () {
      const attrId = $(this).val();
      populateSelect('#edit-parent-value', attrMap[attrId]);
    });

    $('#edit-affected-attribute').change(function () {
      const attrId = $(this).val();
      populateCheckboxes('#edit-affected-values', attrMap[attrId]);
    });

    function populateSelect(selector, values, selectedId = null) {
      const select = $(selector);
      select.empty().append(`<option value="">-- Select Value --</option>`);
      (values || []).forEach(val => {
        const selected = val.id == selectedId ? 'selected' : '';
        select.append(`<option value="${val.id}" ${selected}>${val.value}</option>`);
      });
    }

    function populateCheckboxes(containerSelector, values, selectedIds = []) {
      const container = $(containerSelector);
      container.empty();
      if (!values || values.length === 0) {
        container.html('<p class="text-muted">No values available</p>');
        return;
      }

      values.forEach(val => {
        const checked = selectedIds.includes(val.id) ? 'checked' : '';
        container.append(`
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="affected_value_ids[]" value="${val.id}" ${checked}>
            <label class="form-check-label">${val.value}</label>
          </div>
        `);
      });
    }

    function toggleAffectedValuesVisibility() {
      const action = $('#edit-action').val();

      if (action === 'hide_values' || action === 'show_values') {
        $('#affected-values').show();
      } else {
        $('#affected-values').hide();
      }
    }

    $('#edit-action').on('change', function () {
      toggleAffectedValuesVisibility();
    });

    // Initialize on page load
    toggleAffectedValuesVisibility();


    $('#edit-attribute-condition-form').submit(function (e) {
      e.preventDefault();
      const form = $(this);
      const id = form.data('id');

      $('.validation-err').html('');
      $('input, select').removeClass('is-invalid');

      $.ajax({
        url: `/admin/attribute-conditions/${id}`,
        method: 'POST',
        data: form.serialize(),
        success: function (res) {
          if (res.success) {
            $('#attribute-condition-modal').modal('hide');
            Swal.fire('Updated!', res.message, 'success');
            setTimeout(() => location.reload(), 500);
          }
        },
        error: function (xhr) {
          const errors = xhr.responseJSON?.errors || {};
          for (const key in errors) {
            $(`[name="${key}"]`).addClass('is-invalid');
            $(`#${key}-err`).text(errors[key][0]);
          }
        }
      });
    });
  });
</script>