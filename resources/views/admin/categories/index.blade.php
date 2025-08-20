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
          <li class="breadcrumb-item active">Category</li>
          </ol>
        </div>
        </div>
      </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
      <div class="form-group breadcrumb-right">
        <a href="javascript:void(0)" class="btn-icon btn btn-primary btn-round btn-sm" id="add-category">Add</a>
      </div>
      </div>
    </div>

    <div class="content-body">
      <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <h4 class="card-title">Category</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table class="table" id="pagetype-table">
            <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Slug</th>
              <th>Image</th>
              <th>Status</th>
              <th>Created At</th>
              <th width="100px">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($categories as $category)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->slug }}</td>
            <td>
            @if($category->image)
          <img src="{{ asset('storage/' . $category->image) }}" alt="Image" width="50" height="50"
          class="rounded">
        @else
          <span class="text-muted">No Image</span>
        @endif
            </td>
            <td>{{ ucfirst($category->status) }}</td>

            <td>{{ $category->created_at->format('d M Y, h:i A') }}</td>

            <td>
            <ul class="list-inline">
            <li class="list-inline-item">
            <a href="javascript:void(0)" class="btn btn-primary btn-sm edit-category"
              data-id="{{ $category->id }}">
              <i class="fas fa-pencil-alt"></i>
            </a>
            </li>
            <li class="list-inline-item">
            <a href="javascript:void(0)" onclick="deleteConfirmation({{ $category->id }})">
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
  </div>

  <div class="modal fade" id="category-modal" tabindex="-1" role="dialog" aria-hidden="true"></div>
@endsection

@push('scripts')
  <script>
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    function deleteConfirmation(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
      $.ajax({
        url: `{{ url('admin/manage-categories') }}/${id}`,
        type: "DELETE",
        dataType: "json",
        success: function (result) {
        if (result.success) {
          Swal.fire('Deleted!', '', 'success');
          setTimeout(() => location.reload(), 400);
        } else {
          Swal.fire(result.msgText);
        }
        }
      });
      }
    });
    }

    $(document).ready(function () {
    $('#pagetype-table').DataTable();

    // open create modal
    $(document).on('click', '#add-category', function () {
      $.ajax({
      url: "{{ url('admin/manage-categories/create') }}",
      type: "GET",
      dataType: "json",
      success: function (result) {
        if (result.success) {
        $("#category-modal").html(result.html).modal('show');
        }
      }
      });
    });

    // add category
    $(document).on("click", "#add-category-btn", function () {
      $(this).attr('disabled', true);
      $('.validation-err').html('');

      const form = $('#add-category-form')[0];
      const formData = new FormData(form);

      $.ajax({
      url: "{{ url('admin/manage-categories') }}",
      type: 'POST',
      processData: false,
      contentType: false,
      dataType: 'json',
      data: formData,
      context: this,
      success: function (result) {
        if (result.success) {
        Swal.fire('Created!', '', 'success');
        setTimeout(() => location.reload(), 400);
        } else {
        $(this).attr('disabled', false);
        if (result.code === 422) {
          for (const key in result.errors) {
          $(`#${key}-err`).html(result.errors[key][0]);
          }
        } else {
          console.log(result.msgText);
        }
        }
      }
      });
    });

    // open edit modal
    $(document).on("click", ".edit-category", function () {
      const id = $(this).data('id');
      $.ajax({
      url: `{{ url('admin/manage-categories') }}/${id}/edit`,
      type: "GET",
      dataType: "json",
      success: function (result) {
        if (result.success) {
        $("#category-modal").html(result.html).modal('show');
        } else {
        console.log(result.msgText);
        }
      }
      });
    });

    // update category
    $(document).on("click", "#update-category-btn", function () {
      $(this).attr('disabled', true);
      $('.validation-err').html('');

      const form = $('#edit-category-form')[0];
      const formData = new FormData(form);
      formData.append('_method', 'PUT');
      const id = $(this).data('category-id');

      $.ajax({
      url: `{{ url('admin/manage-categories') }}/${id}`,
      type: 'POST',
      processData: false,
      contentType: false,
      dataType: 'json',
      data: formData,
      context: this,
      success: function (result) {
        if (result.success) {
        Swal.fire('Updated!', '', 'success');
        setTimeout(() => location.reload(), 400);
        } else {
        $(this).attr('disabled', false);
        if (result.code === 422) {
          for (const key in result.errors) {
          $(`#${key}-err`).html(result.errors[key][0]);
          }
        } else {
          console.log(result.msgText);
        }
        }
      }
      });
    });

    });
  </script>
@endpush