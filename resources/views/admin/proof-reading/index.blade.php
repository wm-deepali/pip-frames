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
          <li class="breadcrumb-item active">Proof Readings</li>
          </ol>
        </div>
        </div>
      </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
      <div class="form-group breadcrumb-right">
        <a href="javascript:void(0)" class="btn btn-primary btn-round btn-sm" id="add-proof-reading">Add</a>
      </div>
      </div>
    </div>

    <div class="content-body">
      <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <h4 class="card-title">Proof Readings</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>#</th>
              <th>Proof Type</th>
              <th>Price</th>
              <th>Created At</th>
              <th width="100px">Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse ($proofReading as $index => $item)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $item->proof_type }}</td>
          <td>£{{ number_format($item->price, 2) }}</td>
          <td>{{ $item->created_at->format('Y-m-d') }}</td>
          <td>
          <div class="d-flex">
          <a class="btn btn-sm btn-info mr-1 text-white edit-proof-reading" data-id="{{ $item->id }}">
          Edit
          </a>

          <button class="btn btn-sm btn-danger" onclick="deleteValue({{ $item->id }})">Delete</button>
          </div>
          </td>

        </tr>
        @empty
        <tr>
          <td colspan="5" class="text-center">No proof reading entries found.</td>
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

    {{-- Modal --}}
    <div class="modal fade" id="proof-reading-modal" tabindex="-1" role="dialog" aria-hidden="true"></div>
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
    // Add Proof Reading
    $(document).on('click', '#add-proof-reading', function () {
      $.get("{{ route('admin.proof-reading.create') }}", function (result) {
      if (result.success) {
        $('#proof-reading-modal').html(result.html).modal('show');

        // Delay needed to ensure modal DOM is rendered before binding
        setTimeout(() => {
        if (typeof initProofModalScripts === 'function') {
          initProofModalScripts();
        }
        }, 100);
      }
      });
    });

    // Edit Proof Reading
    $(document).on('click', '.edit-proof-reading', function () {
      const id = $(this).data('id');
      $.get(`{{ url('admin/proof-reading') }}/${id}/edit`, function (result) {
      if (result.success) {
        $('#proof-reading-modal').html(result.html).modal('show');

        // Wait for modal to render before toggling
        setTimeout(() => {
        if (typeof toggleEditFields === 'function') {
          toggleEditFields();
        }
        }, 100);
      }
      });
    });

    // Save 
    $(document).on('click', '#save-proof-reading-btn', function () {
      const form = $('#proof-reading-form')[0];
      const formData = new FormData(form);
      const id = $(this).data("id");
      const url = id ? `{{ url('admin/proof-reading') }}/${id}` : `{{ url('admin/proof-reading') }}`;
      const method = id ? 'POST' : 'POST';

      if (id) formData.append('_method', 'PUT');

      $('#save-proof-reading-btn').attr('disabled', true);
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
        $('#save-proof-reading-btn').attr('disabled', false);
        if (result.code === 422) {
          for (const key in result.errors) {
          const safeKey = key.replace(/\./g, '_').replace(/\[/g, '_').replace(/\]/g, '');
          $(`#${safeKey}-err`).html(result.errors[key][0]);
          }

        } else {
          Swal.fire(result.msgText || 'Something went wrong');
        }
        }
      }
      });
    });
    });

    // Update Proof Reading
    $(document).on('click', '#update-proof-reading-btn', function () {
    $(this).prop('disabled', true);
    $('.validation-err').text('');
    let id = $(this).data('id');
    let formData = new FormData(document.getElementById('proof-reading-form'));
    formData.append('_method', 'PUT');

    $.ajax({
      url: `/admin/proof-reading/${id}`,
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
      if (response.success) {
        Swal.fire('Updated!', '', 'success');
        $('#proof-reading-modal').modal('hide');
        setTimeout(() => location.reload(), 300);
      } else {
        $('#update-proof-reading-btn').prop('disabled', false);
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


    // Delete Proof Reading
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
        url: `{{ url('admin/proof-reading') }}/${id}`,
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
    $('#proof-reading-modal').on('hidden.bs.modal', function () {
    $(this).html('');
    });

  </script>
@endpush