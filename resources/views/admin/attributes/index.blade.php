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
          <li class="breadcrumb-item active">Attributes</li>
          </ol>
        </div>
        </div>
      </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
      <div class="form-group breadcrumb-right">
        <a href="javascript:void(0)" class="btn btn-primary btn-round btn-sm" id="add-attribute">Add</a>
      </div>
      </div>
    </div>

    <div class="content-body">
      <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <h4 class="card-title">Attributes</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table class="table table-striped" id="attribute-table">
            <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Detail</th>
              <th>Input Type</th>
              <th>Custom Input</th>
              <th>Pricing Basis</th>
              <th>Has Dependency</th>
              <th>Parent Attribute</th>
              <th>Has Setup Charge</th>
              <th>Allow Quantity</th>
              <th>Is Composite</th>
              <th>Has Image</th>
              <th>Has Icon</th>
              <th>Created At</th>
              <th width="100px">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($attributes as $attribute)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $attribute->name }}</td>
            <td>{{ $attribute->detail }}</td>
            <td>{{ ucfirst(str_replace('_', ' ', $attribute->input_type)) }}</td>
            <td>
            {{ ucfirst($attribute->custom_input_type ?? 'N/A') }}
            </td>
            <td>{{ ucfirst(str_replace('_', ' ', $attribute->pricing_basis))  }}</td>
            <td>
            <span class="badge badge-{{ $attribute->has_dependency ? 'success' : 'secondary' }}">
            {{ $attribute->has_dependency ? 'Yes' : 'No' }}
            </span>
            </td>

            <td>
            @if($attribute->has_dependency && $attribute->parents->isNotEmpty())
          @foreach($attribute->parents as $parent)
          <span class="badge badge-info">{{ $parent->name }}</span>
          @endforeach
        @else
          <span class="text-muted">—</span>
        @endif
            </td>
            <td>
            <span class="badge badge-{{ $attribute->has_setup_charge ? 'success' : 'secondary' }}">
            {{ $attribute->has_setup_charge ? 'Yes' : 'No' }}
            </span>
            </td>
            <td>
            <span class="badge badge-{{ $attribute->allow_quantity ? 'success' : 'secondary' }}">
            {{ $attribute->allow_quantity ? 'Yes' : 'No' }}
            </span>
            </td>
            <td>
            <span class="badge badge-{{ $attribute->is_composite ? 'success' : 'secondary' }}">
            {{ $attribute->is_composite ? 'Yes' : 'No' }}
            </span>
            </td>
            <td>
            <span class="badge badge-{{ $attribute->has_image ? 'success' : 'secondary' }}">
            {{ $attribute->has_image ? 'Yes' : 'No' }}
            </span>
            </td>
            <td>
            <span class="badge badge-{{ $attribute->has_icon ? 'success' : 'secondary' }}">
            {{ $attribute->has_icon ? 'Yes' : 'No' }}
            </span>
            </td>
            <td>{{ $attribute->created_at->format('d M Y') }}</td>
            <td>
            <ul class="list-inline mb-0">
            <li class="list-inline-item">
            <a href="javascript:void(0)" class="btn btn-sm btn-primary edit-attribute"
              data-id="{{ $attribute->id }}">
              <i class="fas fa-pencil-alt"></i>
            </a>
            </li>
            <li class="list-inline-item">
            <a href="javascript:void(0)" onclick="deleteConfirmation({{ $attribute->id }})">
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
    <div class="modal fade" id="attribute-modal" tabindex="-1" role="dialog" aria-hidden="true"></div>
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

    // Add Attribute
    $(document).on('click', '#add-attribute', function () {
      $.get("{{ route('admin.attributes.create') }}", function (result) {
      if (result.success) {
        $('#attribute-modal').html(result.html).modal('show');
      }
      });
    });

    // Edit Attribute
    $(document).on('click', '.edit-attribute', function () {
      const id = $(this).data('id');
      $.get(`{{ url('admin/attributes') }}/${id}/edit`, function (result) {
      if (result.success) {
        $('#attribute-modal').html(result.html).modal('show');
      }
      });
    });

    // Save or Update
    $(document).on('click', '#save-attribute-btn', function () {
      const form = $('#attribute-form')[0];
      const formData = new FormData(form);
      const url = `{{ url('admin/attributes') }}`;
      const method = 'POST';

      $('#save-attribute-btn').attr('disabled', true);
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
        $('#save-attribute-btn').attr('disabled', false);
        if (result.code === 422) {
          for (const key in result.errors) {
          // Convert dot notation to underscore format to match IDs
          const normalizedKey = key.replace(/\./g, '_') + '-err';
          $(`#${normalizedKey}`).html(result.errors[key][0]);
          }
        }
        else {
          Swal.fire(result.msgText || 'Something went wrong');
        }
        }
      }
      });
    });

    });

    // Update Attribute
    $(document).on('click', '#update-attribute-btn', function () {
    $(this).prop('disabled', true);
    $('.validation-err').text('');

    let id = $(this).data('id');
    let formData = new FormData(document.getElementById('attribute-form'));
    formData.append('_method', 'PUT');

    $.ajax({
      url: `/admin/attributes/${id}`,
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
      if (response.success) {
        Swal.fire('Updated!', '', 'success');
        $('#attribute-modal').modal('hide');
        setTimeout(() => location.reload(), 300);
      } else {
        $('#update-attribute-btn').prop('disabled', false);
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


    // Delete Attribute
    function deleteConfirmation(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "This will permanently delete the record!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonColor: '#d33'
    }).then((result) => {
      if (result.isConfirmed) {
      $.ajax({
        url: `/admin/attributes/${id}`,
        type: "DELETE",
        success: function (response) {
        if (response.success) {
          Swal.fire('Deleted!', '', 'success');
          setTimeout(() => location.reload(), 300);
        } else {
          Swal.fire('Error', response.msgText, 'error');
        }
        }
      });
      }
    });
    }
  </script>
@endpush