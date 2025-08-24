@extends('layouts.master')

@section('content')
  <div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
      <div class="row breadcrumbs-top">
        <div class="col-12">
        <div class="breadcrumb-wrapper">
          <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active">Attribute Values</li>
          </ol>
        </div>
        </div>
      </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
      <div class="form-group breadcrumb-right">
        <a href="javascript:void(0)" class="btn btn-primary btn-round btn-sm" id="add-attribute-value">Add</a>
      </div>
      </div>
    </div>

    <div class="content-body">
      <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <h4 class="card-title">Attribute Values</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>#</th>
              <th>Attribute</th>
              <!-- <th>is Composite Value</th> -->
              <th>Value</th>
              <th>Image</th>
              <!-- <th>Icon</th> -->
              <!-- <th>Custom Input Label</th> -->
              <th>Created At</th>
              <th width="100px">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($values as $value)
            <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $value->attribute->name ?? '-' }}</td>
            <!-- <td>
        <span class="badge badge-{{ $value->is_composite_value ? 'success' : 'secondary' }}">
        {{ $value->is_composite_value ? 'Yes' : 'No' }}
        </span>
        </td> -->
            <td>
            @if($value->colour_code)
          <div style="display: flex; align-items: center; gap: 8px;">
          <span>{{ $value->value }}</span>
          <span
          style="width: 20px; height: 20px; border-radius: 4px; display: inline-block; background-color: {{ $value->colour_code }}; border: 1px solid #ccc;"></span>
          <span>{{ $value->colour_code }}</span>
          </div>
          @else
          {{ $value->value }}
          @endif
            </td>

            <td>
            @if ($value->image_path)
          <img src="{{ asset('storage/' . $value->image_path) }}" width="40">
          @else
          -
          @endif
            </td>
            <!-- <td>{!! $value->icon_class ? "<i class='{$value->icon_class}'></i>" : '-' !!}</td> -->
            <!-- <td>{{ $value->custom_input_label ?? '-' }}</td> -->

            <td>{{ $value->created_at->format('d M Y') }}</td>
            <td>
            <ul class="list-inline mb-0">
              <li class="list-inline-item">
              <a href="javascript:void(0)" class="btn btn-sm btn-primary edit-attribute-value"
              data-id="{{ $value->id }}">
              <i class="fas fa-pencil-alt"></i>
              </a>
              </li>
              <li class="list-inline-item">
              <a href="javascript:void(0)" onclick="deleteValue({{ $value->id }})">
              <i class="fa fa-trash text-danger"></i>
              </a>
              </li>
            </ul>
            </td>
            </tr>
        @endforeach
            </tbody>
          </table>
          </div>
        </div>
        </div>
      </div>
      </div>
    </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="attribute-value-modal" tabindex="-1" role="dialog" aria-hidden="true"></div>
  </div>
@endsection

@push('scripts')
  <script>
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    $(document).ready(function () {
    // Add Attribute Value
    $(document).on('click', '#add-attribute-value', function () {
      $.get("{{ route('admin.attribute-values.create') }}", function (result) {
      if (result.success) {
        $('#attribute-value-modal').html(result.html).modal('show');

        // Delay needed to ensure modal DOM is rendered before binding
        setTimeout(() => {
        if (typeof initAttributeModalScripts === 'function') {
          initAttributeModalScripts();
        }
        }, 100);
      }
      });
    });

    // Edit Attribute Value
    $(document).on('click', '.edit-attribute-value', function () {
      const id = $(this).data('id');
      $.get(`{{ url('admin/attribute-values') }}/${id}/edit`, function (result) {
      if (result.success) {
        $('#attribute-value-modal').html(result.html).modal('show');

        // Wait for modal to render before toggling
        setTimeout(() => {
        const attrId = $('#attribute-select').val();
        if (typeof toggleEditFields === 'function') {
          toggleEditFields(attrId);
        }
        }, 100);
      }
      });
    });

    // Save or Update
    $(document).on('click', '#save-attribute-value-btn', function () {
      const form = $('#attribute-value-form')[0];
      const formData = new FormData(form);
      const id = $(this).data("id");
      const url = id ? `{{ url('admin/attribute-values') }}/${id}` : `{{ url('admin/attribute-values') }}`;
      const method = id ? 'POST' : 'POST';

      if (id) formData.append('_method', 'PUT');

      $('#save-attribute-value-btn').attr('disabled', true);
      $('.validation-err').html('');

      $.ajax({
      url: url,
      type: method,
      data: formData,
      processData: false,
      contentType: false,
      success: function (result) {
        if (result.success) {
        Swal.fire('Success!', result.message || '', 'success');
        setTimeout(() => location.reload(), 500);
        } else {
        $('#save-attribute-value-btn').attr('disabled', false);
        if (result.code === 422) {
          for (const key in result.errors) {
          $(`#${key}-err`).html(result.errors[key][0]);
          }
        } else {
          Swal.fire(result.msgText || 'Something went wrong');
        }
        }
      }
      });
    });
    });

    // Update Attribute
    $(document).on('click', '#update-attribute-value-btn', function () {
    $(this).prop('disabled', true);
    $('.validation-err').text('');

    let id = $(this).data('id');

    // Ensure unchecked checkboxes are also sent
    if (!$('#is_composite').is(':checked')) {
      // Temporarily add a hidden input to ensure is_composite is submitted as false
      $('<input>')
      .attr({ type: 'hidden', name: 'is_composite', value: '0', id: 'is_composite_hidden' })
      .appendTo('#attribute-value-form');
    }

    let formData = new FormData(document.getElementById('attribute-value-form'));
    formData.append('_method', 'PUT');

    $.ajax({
      url: `/admin/attribute-values/${id}`,
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
      $('#is_composite_hidden').remove(); // Clean up after append

      if (response.success) {
        Swal.fire('Updated!', '', 'success');
        $('#attribute-value-modal').modal('hide');
        setTimeout(() => location.reload(), 300);
      } else {
        $('#update-attribute-value-btn').prop('disabled', false);
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


    // Delete Attribute Value
    function deleteValue(id) {
    Swal.fire({
      title: "Are you sure?",
      text: "This will delete the value.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
      $.ajax({
        url: `{{ url('admin/attribute-values') }}/${id}`,
        type: 'POST',
        data: { _method: 'DELETE', _token: '{{ csrf_token() }}' },
        success: function () {
        Swal.fire('Deleted!', '', 'success');
        setTimeout(() => location.reload(), 500);
        }
      });
      }
    });
    }

    // Destroy modal content after it closes
    $('#attribute-value-modal').on('hidden.bs.modal', function () {
    $(this).html('');
    });

  </script>
@endpush