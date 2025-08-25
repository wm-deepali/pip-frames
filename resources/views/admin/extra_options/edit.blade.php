<!-- resources/views/admin/extra_options/edit.blade.php -->
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <form id="extra-option-form" enctype="multipart/form-data">
      <div class="modal-header">
        <h5 class="modal-title">Edit Extra Option</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Title <span class="text-danger">*</span></label>
              <input type="text" name="title" class="form-control" value="{{ $extraOption->title ?? '' }}">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Code <span class="text-danger">*</span></label>
              <input type="text" name="code" class="form-control" value="{{ $extraOption->code ?? '' }}" placeholder="e.g. digital, skip">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Description</label>
              <textarea name="description" class="form-control" rows="3">{{ $extraOption->description ?? '' }}</textarea>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Price (£) <span class="text-danger">*</span></label>
              <input type="number" step="0.01" min="0" name="price" class="form-control" value="{{ $extraOption->price }}">
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Active</label>
              <select name="is_active" class="form-control">
                <option value="1" {{ $extraOption->is_active ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ !$extraOption->is_active ? 'selected' : '' }}>No</option>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Sort Order</label>
              <input type="number" min="0" name="sort_order" class="form-control" value="{{ $extraOption->sort_order }}">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="update-extra-option-btn"
          data-id="{{ $extraOption->id }}">Update</button>
      </div>
    </form>
  </div>
</div>

<script>
  $(document).ready(function () {
    // Update button click handler (AJAX example, adapt as needed)
    $(document).on('click', '#update-extra-option-btn', function () {
      let id = $(this).data('id');
      let formData = new FormData(document.getElementById('extra-option-form'));
      formData.append('_method', 'PUT');
      $(this).prop('disabled', true);

      $.ajax({
        url: `/admin/extra_options/${id}`,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          if (response.success) {
            Swal.fire('Updated!', '', 'success');
            setTimeout(() => location.reload(), 300);
          } else {
            $('#update-extra-option-btn').prop('disabled', false);
            // Display errors if present (customize as needed)
            if (response.errors) {
              $.each(response.errors, function (key, messages) {
                const $input = $(`[name="${key}"]`);
                const $errorSpan = $input.siblings('.' + key.replace(/\./g, '_') + '-err');
                if ($errorSpan.length) {
                  $errorSpan.html(messages[0]);
                }
              });
            } else {
              Swal.fire('Error', response.msgText ?? 'Something went wrong', 'error');
            }
          }
        }
      });
    });
  });
</script>
