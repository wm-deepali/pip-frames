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
                  <li class="breadcrumb-item active">sliders</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
          <div class="form-group breadcrumb-right">
            <a href="javascript:void(0)" class="btn btn-primary btn-round btn-sm" id="add-slider">Add</a>
          </div>
        </div>
      </div>

      <div class="content-body">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">sliders</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="slider-table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Content</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th width="100px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($sliders as $slider)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>
                            @if($slider->image_path)
                              <img src="{{ asset('storage/' . $slider->image_path) }}" alt="Author Image"
                                style="height: 80px; width:80px; object-fit: cover; border-radius: 50%;">
                            @else
                              <span class="text-muted">No Image</span>
                            @endif
                          </td>
                          <td>{{ Str::limit($slider->content, 50) }}</td>
                          <td>{{ ucfirst($slider->status) }}</td>
                          <td>{{ $slider->created_at->format('d M Y, h:i A') }}</td>
                          <td>
                            <ul class="list-inline">
                              <li class="list-inline-item">
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm edit-slider"
                                  data-id="{{ $slider->id }}">
                                  <i class="fas fa-pencil-alt"></i>
                                </a>
                              </li>
                              <li class="list-inline-item">
                                <a href="javascript:void(0)" onclick="deleteConfirmation({{ $slider->id }})"
                                  class="btn btn-danger btn-sm">
                                  <i class="fa fa-trash"></i>
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
    <div class="modal fade" id="slider-modal" tabindex="-1" role="dialog" aria-hidden="true"></div>
  </div>
@endsection

@push('scripts')
  <script>
    function ClassicEditorInit() {
      const fields = ['content'];
      fields.forEach(id => {
        if (CKEDITOR.instances[id]) {
          CKEDITOR.instances[id].destroy(true);
        }
        if (document.getElementById(id)) {
          CKEDITOR.replace(id);
        }
      });
    }

    $(document).ready(function () {
      // Open add slider modal
      $(document).on('click', '#add-slider', function () {
        $.get("{{ route('admin.sliders.create') }}", function (result) {
          if (result.success) {
            $('#slider-modal').html(result.html).modal('show');
            ClassicEditorInit();
          }
        });
      });

      // Open edit slider modal
      $(document).on('click', '.edit-slider', function () {
        let id = $(this).data('id');
        $.get(`{{ url('admin/sliders') }}/${id}/edit`, function (result) {
          if (result.success) {
            $('#slider-modal').html(result.html).modal('show');
            ClassicEditorInit();
          }
        });
      });

      // CSRF token setup for AJAX
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      // Save slider AJAX submit
      $(document).on('click', '#add-slider-btn', function () {
        let btn = $(this);
        btn.prop('disabled', true);

        // Clear previous validation errors
        $('.validation-err').text('');
        for (const instance in CKEDITOR.instances) {
          CKEDITOR.instances[instance].updateElement();
        }

        // Collect the form data including files
        let formData = new FormData($('#slider-form')[0]);

        $.ajax({
          url: '{{ route("admin.sliders.store") }}', // Adjust route as needed
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          success: function (response) {
            if (response.success) {
              Swal.fire('Success!', response.message || 'slider saved.', 'success');
              $('#slider-modal').modal('hide');
              // Reload or update the table/list accordingly
              setTimeout(() => location.reload(), 1000);
            } else {
              Swal.fire('Error', response.message || 'Failed to save.', 'error');
            }
            btn.prop('disabled', false);
          },
          error: function (xhr) {
            btn.prop('disabled', false);
            if (xhr.status === 422) {
              // Validation errors
              let errors = xhr.responseJSON.errors;
              for (let field in errors) {
                $('#' + field + '-err').text(errors[field][0]);
              }
            } else {
              Swal.fire('Error', 'Something went wrong.', 'error');
            }
          }
        });
      });


      $(document).ready(function () {
        // Update slider AJAX submit
        $(document).on('click', '#update-slider-btn', function () {
          let btn = $(this);
          btn.prop('disabled', true);

          // Clear previous validation errors
          $('.validation-err').text('');

          for (const instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].updateElement();
          }

          // Collect the form data including files
          let formData = new FormData($('#slider-edit-form')[0]);

          // Append the _method for PUT
          formData.append('_method', 'PUT');

          // Get slider ID from button data attribute
          let sliderId = btn.data('slider-id');

          $.ajax({
            url: `/admin/sliders/${sliderId}`, // Adjust URL pattern as per your routes
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
              if (response.success) {
                Swal.fire('Success!', response.message || 'slider updated.', 'success');
                $('#slider-modal').modal('hide');
                // Reload or update the table/list accordingly
                setTimeout(() => location.reload(), 1000);
              } else {
                Swal.fire('Error', response.message || 'Failed to update.', 'error');
              }
              btn.prop('disabled', false);
            },
            error: function (xhr) {
              btn.prop('disabled', false);
              if (xhr.status === 422) {
                // Validation errors
                let errors = xhr.responseJSON.errors;
                for (let field in errors) {
                  $('#' + field + '-err').text(errors[field][0]);
                }
              } else {
                Swal.fire('Error', 'Something went wrong.', 'error');
              }
            }
          });
        });
      });


      // Delete confirmation
      window.deleteConfirmation = function (id) {
        Swal.fire({
          title: 'Are you sure?',
          text: "You can't reverse this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: `{{ url('admin/sliders') }}/${id}`,
              type: 'DELETE',
              success: function (res) {
                if (res.success) {
                  Swal.fire('Deleted!', '', 'success');
                  setTimeout(() => location.reload(), 500);
                } else {
                  Swal.fire('Error', res.message || 'Failed to delete', 'error');
                }
              }
            });
          }
        });
      }
    });
  </script>
@endpush