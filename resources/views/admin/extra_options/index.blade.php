@extends('layouts.master')

@section('content')
<div class="app-content content">
  <!-- Content overlay, header, etc. -->
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Extra Options</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <a href="javascript:void(0)" class="btn btn-primary btn-round btn-sm" id="add-extra-option">Add</a>
        </div>
      </div>
    </div>

    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Extra Options</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped" id="extra-option-table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Price</th>
                      <th>Code</th>
                      <th>Active</th>
                      <th>Sort Order</th>
                      <th>Created At</th>
                      <th width="100px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($extraOptions as $option)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $option->title }}</td>
                      <td>{{ $option->description }}</td>
                      <td>£{{ number_format($option->price, 2) }}</td>
                      <td>{{ $option->code }}</td>
                      <td>
                        <span class="badge badge-{{ $option->is_active ? 'success' : 'secondary' }}">
                          {{ $option->is_active ? 'Yes' : 'No' }}
                        </span>
                      </td>
                      <td>{{ $option->sort_order }}</td>
                      <td>{{ $option->created_at->format('d M Y') }}</td>
                      <td>
                        <ul class="list-inline mb-0">
                          <li class="list-inline-item">
                            <a href="javascript:void(0)" class="btn btn-sm btn-primary edit-extra-option"
                              data-id="{{ $option->id }}">
                              <i class="fas fa-pencil-alt"></i>
                            </a>
                          </li>
                          <li class="list-inline-item">
                            <a href="javascript:void(0)" onclick="deleteExtraOptionConfirmation({{ $option->id }})">
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
  <div class="modal fade" id="extra-option-modal" tabindex="-1" role="dialog" aria-hidden="true"></div>
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
    // Add Extra Option
    $(document).on('click', '#add-extra-option', function () {
        console.log("here");
        
      $.get("{{ route('admin.extra_options.create') }}", function (result) {
        if (result.success) {
          $('#extra-option-modal').html(result.html).modal('show');
        }
      });
    });

    // Edit Extra Option
    $(document).on('click', '.edit-extra-option', function () {
      const id = $(this).data('id');
      $.get(`{{ url('admin/extra_options') }}/${id}/edit`, function (result) {
        if (result.success) {
          $('#extra-option-modal').html(result.html).modal('show');
        }
      });
    });

    // Save Extra Option
    $(document).on('click', '#save-extra-option-btn', function () {
      const form = $('#extra-option-form')[0];
      const formData = new FormData(form);
      const url = `{{ url('admin/extra_options') }}`;

      $('#save-extra-option-btn').attr('disabled', true);
      $('.validation-err').html('');

      $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (result) {
          if (result.success) {
            Swal.fire('Success!', result.message || '', 'success');
            setTimeout(() => location.reload(), 500);
          } else {
            $('#save-extra-option-btn').attr('disabled', false);
            if (result.code === 422) {
              for (const key in result.errors) {
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

    // Update Extra Option
    $(document).on('click', '#update-extra-option-btn', function () {
      $(this).prop('disabled', true);
      $('.validation-err').text('');

      let id = $(this).data('id');
      let formData = new FormData(document.getElementById('extra-option-form'));
      formData.append('_method', 'PUT');

      $.ajax({
        url: `/admin/extra_options/${id}`,
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          if (response.success) {
            Swal.fire('Updated!', '', 'success');
            $('#extra-option-modal').modal('hide');
            setTimeout(() => location.reload(), 300);
          } else {
            $('#update-extra-option-btn').prop('disabled', false);
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

    // Delete Extra Option
    window.deleteExtraOptionConfirmation = function(id) {
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
            url: `/admin/extra_options/${id}`,
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
  });
</script>
@endpush
