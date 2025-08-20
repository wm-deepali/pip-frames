@extends('layouts.master')

@section('content')
  <div class="app-content content">
    <div class="content-wrapper">
    <div class="content-body">
      <div class="row">
      <div class="col-md-12">
        <!-- Header + Add Department Button -->
        <div class="d-flex justify-content-between align-items-center mb-2">
        <h4>Departments</h4>
        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addDepartmentModal">Add
          Department</button>
        </div>

        <!-- Department Table -->
        <div class="card">
        <div class="card-body">
          <table class="table table-bordered">
          <thead>
            <tr>
            <th>#</th>
            <th>Department Name</th>
            <th>Status</th>
            <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($departments as $index => $department)
          <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $department->name }}</td>
          <td>
          @if($department->status == 'active')
        <span class="badge badge-success">Active</span>
        @else
        <span class="badge badge-secondary">Inactive</span>
        @endif
          </td>
          <td>
          <button class="btn btn-sm btn-warning"
          onclick="editDepartment({{ $department->id }}, '{{ $department->name }}', '{{ $department->status }}')">Edit</button>

          <button class="btn btn-sm btn-danger"
          onclick="deleteConfirmation({{ $department->id }})">Delete</button>

          <button class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#viewNotesModal">View
          All Notes</button>
          </td>
          </tr>
        @empty
        <tr>
        <td colspan="4" class="text-center">No departments found.</td>
        </tr>
        @endforelse
          </tbody>

          </table>
        </div>
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>

  <!-- Add Department Modal -->
  <div class="modal fade" id="addDepartmentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
    <form id="addDepartmentForm">
      @csrf
      <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Department</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <label>Department Name</label>
        <input type="text" name="name" class="form-control mb-2" placeholder="Enter Department Name" required>

        <label>Status</label>
        <select name="status" class="form-control">
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
        </select>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit">Save</button>
      </div>
      </div>
    </form>


    </div>
  </div>

  <!-- View All Notes Modal -->
  <div class="modal fade" id="viewNotesModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title">Department Notes</h5>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      <div class="row">
        <!-- Sample Note Card 1 -->
        <div class="col-md-6">
        <div class="card border mb-3">
          <div class="card-body">
          <p><strong>Date & Time:</strong> 2025-07-15 15:00</p>
          <p><strong>Order ID:</strong> #342134</p>
          <p><strong>Customer:</strong> John Doe<br>Email: john@example.com<br>+1-555-1234</p>
          <p><strong>Note:</strong> Order reviewed and forwarded to the print team.</p>
          </div>
        </div>
        </div>

        <!-- Sample Note Card 2 -->
        <div class="col-md-6">
        <div class="card border mb-3">
          <div class="card-body">
          <p><strong>Date & Time:</strong> 2025-07-14 11:45</p>
          <p><strong>Order ID:</strong> #342135</p>
          <p><strong>Customer:</strong> Jane Smith<br>Email: jane@example.com<br>+1-555-4321</p>
          <p><strong>Note:</strong> Final file uploaded for print approval.</p>
          </div>
        </div>
        </div>

        <!-- Add more note cards here if needed -->
      </div>
      </div>
    </div>
    </div>
  </div>

  <!-- Required Bootstrap Scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection

@push('scripts')
  <script>
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    // add department
    $(document).ready(function () {
    $('#addDepartmentForm').on('submit', function (e) {
      e.preventDefault();

      let formData = {
      name: $('input[name="name"]').val(),
      status: $('select[name="status"]').val(),
      _token: '{{ csrf_token() }}'
      };

      let url = '{{ route('admin.manage-department.store') }}';
      let method = 'POST';

      if (isEditMode) {
      url = `/admin/manage-department/${editingDepartmentId}`;
      method = 'PUT';
      }

      $.ajax({
      url: url,
      type: method,
      data: formData,
      success: function (response) {
        if (response.success) {
        $('#addDepartmentModal').modal('hide');
        Swal.fire('Success!', response.message || '', 'success');
        setTimeout(() => location.reload(), 500);
        }
      },
      error: function (xhr) {
        let errors = xhr.responseJSON.errors;
        let errorMsg = '';

        for (let field in errors) {
        errorMsg += errors[field].join('\n') + '\n';
        }

        alert(errorMsg);
      }
      });
    });

    });


    // edit department
    let isEditMode = false;
    let editingDepartmentId = null;

    function editDepartment(id, name, status) {
    isEditMode = true;
    editingDepartmentId = id;

    $('#addDepartmentModal').modal('show');
    $('#addDepartmentModal .modal-title').text('Edit Department');
    $('#addDepartmentForm input[name="name"]').val(name);
    $('#addDepartmentForm select[name="status"]').val(status);
    }


    // delete department
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
        url: `/admin/manage-department/${id}`,
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