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
          <li class="breadcrumb-item active">Quote Pricing</li>
          </ol>
        </div>
        </div>
      </div>
      </div>

      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
      <div class="form-group breadcrumb-right">
        <a href="javascript:void(0)" class="btn-icon btn btn-primary btn-round btn-sm" id="add-quote">Add New
        Quote</a>
      </div>
      </div>
    </div>

    <div class="content-body">
      <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <h4 class="card-title">Quote Pricing</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table class="table" id="quote-table">
            <thead>
            <tr>
              <th>#</th>
              <th>Date & Time</th>
              <th>Category</th>
              <th>Sub Category</th>
              <th>Status</th>
              <th width="100px">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($quotes as $quote)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $quote->created_at->format('d M Y, h:i A') }}</td>
          <td>{{ $quote->category->name ?? '-' }}</td>
          <td>{{ $quote->subcategory->name ?? '-' }}</td>
          <td>{{ ucfirst($quote->status) }}</td>
          <td>
          <ul class="list-inline">
          <li class="list-inline-item">
          <a href="javascript:void(0)" class="btn btn-primary btn-sm edit-quote"
            quote_id="{{ $quote->id }}">
            <i class="fas fa-pencil-alt"></i>
          </a>
          </li>
          <li class="list-inline-item">
          <a href="javascript:void(0)" onclick="deleteConfirmation({{ $quote->id }})">
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

  {{-- Modal --}}
  <div class="modal fade" id="quote-modal" tabindex="-1" role="dialog" aria-hidden="true"></div>
@endsection

@push('scripts')
  <script>
    $(document).ready(function () {
    // Open Step 1 Form
    $(document).on('click', '#add-quote', function () {
      window.location.href = "{{ route('admin.quote-pricing.create') }}";
    });



    // Edit Existing Quote
    $(document).on('click', '.edit-quote', function () {
      const id = $(this).attr('quote_id');
      $.get(`{{ url('admin/quote') }}/${id}/edit-step1`, function (result) {
      if (result.success) {
        $("#quote-modal").html(result.html).modal('show');
      }
      });
    });

    // Submit Step 1 Form
    $(document).on("click", "#save-quote-step1", function () {
      const form = $('#quote-step1-form')[0];
      const formData = new FormData(form);
      const button = this;

      $(button).attr('disabled', true);
      $('.validation-err').html('');

      $.ajax({
      url: $(form).attr('action'),
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function (result) {
        if (result.success) {
        window.location.href = result.redirect;
        } else {
        $(button).attr('disabled', false);
        if (result.code === 422) {
          for (const key in result.errors) {
          $(`#${key}-err`).html(result.errors[key][0]);
          }
        } else {
          Swal.fire(result.msgText || "Something went wrong");
        }
        }
      }

      });
    });

    // Delete Quote
    window.deleteConfirmation = function (id) {
      Swal.fire({
      title: 'Are you sure?',
      text: "This will permanently delete the quote.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
        url: `{{ url('admin/quote') }}/${id}`,
        type: 'DELETE',
        data: { _token: '{{ csrf_token() }}' },
        success: function (response) {
          if (response.success) {
          Swal.fire('Deleted!', '', 'success');
          setTimeout(() => location.reload(), 500);
          }
        }
        });
      }
      });
    };
    });
  </script>
@endpush