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
          <li class="breadcrumb-item active">Customer Listing</li>
          </ol>
        </div>
        </div>
      </div>
      </div>

    </div>
    <div class="content-body">
      <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <h4 class="card-title">Customer Listing</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table class="table" id="customer-table">
            <thead>
            <tr>
              <th>Date & Time</th>
              <th>Customer Info</th>
              <th>Total Quotes</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($customers as $customer)
        <tr>
          <td>{{ $customer->created_at->format('Y-m-d H:i') }}</td>
          <td>
          {{ $customer->first_name }} {{ $customer->last_name }}<br>
          {{ $customer->email }}<br>
          {{ $customer->mobile }}
          </td>
          <td>{{ $customer->quotes_count ?? 0 }}</td>
          <td>
          <a href="{{ route('admin.customers.detail', $customer->id) }}" class="btn btn-sm btn-info mr-1">View
          Customer Detail</a>
          <!-- <a href="" class="btn btn-sm btn-primary mr-1">View All Quotes</a> -->
          <button type="button" class="btn btn-sm btn-danger" data-toggle="modal"
          onclick="deleteConfirmation({{ $customer->id }})">

          Delete Customer
          </button>
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
        url: `/admin/customer/${id}`,
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