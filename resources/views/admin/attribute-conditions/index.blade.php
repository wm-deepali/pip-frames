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
          <li class="breadcrumb-item active">Attribute Conditions</li>
          </ol>
        </div>
        </div>
      </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
      <div class="form-group breadcrumb-right">
        <a href="javascript:void(0)" class="btn btn-primary btn-round btn-sm" id="add-attribute-condition">Add</a>
      </div>
      </div>
    </div>

    <div class="content-body">
      <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <h4 class="card-title">Attribute Conditions</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>#</th>
              <th>Subcategory</th>
              <th>When</th>
              <th>Then</th>
              <th>Action</th>
              <th>Created</th>
              <th>Options</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($conditions as $cond)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $cond->subcategory->name ?? '-' }}</td>
            <td>
            If <strong>{{ $cond->parentAttribute->name ?? '' }}</strong> =
            <strong>{{ $cond->parentValue->value ?? '' }}</strong>
            </td>
            <td>
    @switch($cond->action)
        @case('hide_attribute')
            Hide the <strong>({{ $cond->affectedAttribute->name }})</strong> attribute.
            @break
        @case('show_attribute')
            Always show <strong>({{ $cond->affectedAttribute->name }})</strong>.
            @break
        @case('hide_values')
            Hide these <strong>({{ $cond->affectedAttribute->name }})</strong> values: 
            <strong>
               {{ $cond->affectedValues ? implode(', ', $cond->affectedValues->pluck('value')->toArray()) : '' }}
            </strong>
            @break
        @case('show_values')
            Show only these <strong>({{ $cond->affectedAttribute->name }})</strong> values: 
            <strong>
              {{ $cond->affectedValues ? implode(', ', $cond->affectedValues->pluck('value')->toArray()) : '' }}
            </strong>
            @break
        @default
            {{ $cond->action }}
    @endswitch
</td>

            <!-- <td>
            <strong>{{ $cond->affectedAttribute->name ?? '' }}</strong>
            @if($cond->affected_value_id)
          = <strong>{{ $cond->affectedValue->value ?? '' }}</strong>
        @endif
            </td> -->
            <td><span class="badge badge-light-info text-capitalize">{{ $cond->action }}</span></td>
            <td>{{ $cond->created_at->format('d M Y') }}</td>
            <td>
            <ul class="list-inline mb-0">
            <li class="list-inline-item">
            <a href="javascript:void(0)" class="btn btn-sm btn-primary edit-attribute-condition"
              data-id="{{ $cond->id }}">
              <i class="fas fa-pencil-alt"></i>
            </a>
            </li>
            <li class="list-inline-item">
            <a href="javascript:void(0)" onclick="deleteAttributeCondition({{ $cond->id }})">
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

    <div class="modal fade" id="attribute-condition-modal" tabindex="-1" role="dialog" aria-hidden="true"></div>
    </div>
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
    // Load the create form via AJAX
    $('#add-attribute-condition').click(function () {
      $.get("{{ route('admin.attribute-conditions.create') }}", function (result) {
      if (result.success) {
        $('#attribute-condition-modal').html(result.html).modal('show');
      }
      });
    });

    // Load the edit form via AJAX
    $(document).on('click', '.edit-attribute-condition', function () {
      const id = $(this).data('id');
      $.get(`{{ url('admin/attribute-conditions') }}/${id}/edit`, function (result) {
      if (result.success) {
        $('#attribute-condition-modal').html(result.html).modal('show');
      }
      });
    });
    });

    $(document).on('click', '#save-attribute-condition-btn', function () {
    const $form = $('#attribute-condition-form');
    const formData = new FormData($form[0]);

    $('#save-attribute-condition-btn').attr('disabled', true);
    $('.validation-err').html('');
    $('input, select').removeClass('is-invalid');

    $.ajax({
      url: "{{ route('admin.attribute-conditions.store') }}",
      method: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function (res) {
      if (res.success) {
        $('#attribute-condition-modal').modal('hide');
        Swal.fire('Saved!', 'Attribute condition added successfully.', 'success');
        setTimeout(() => location.reload(), 500);
      }
      else {
        $('#save-attribute-condition-btn').attr('disabled', false);
        Swal.fire(res.msgText || 'Something went wrong');
      }
      }
    });
    });

    // Handle update for the edit modal
    $(document).on('submit', '#edit-attribute-condition-form', function (e) {
    e.preventDefault();

    const $form = $(this);
    const id = $form.data('id');
    const formData = $form.serialize();

    $.ajax({
      url: `/admin/attribute-conditions/${id}`,
      method: 'POST',
      data: formData,
      success: function (res) {
      if (res.success) {
        $('#attribute-condition-modal').modal('hide');
        Swal.fire('Updated!', res.message, 'success');
        setTimeout(() => location.reload(), 500);
      } else {
        Swal.fire('Error', 'Update failed.', 'error');
      }
      },
      error: function (xhr) {
      const errors = xhr.responseJSON?.errors || {};
      $('.validation-err').html('');
      $('input, select').removeClass('is-invalid');

      for (const key in errors) {
        const msg = errors[key][0];
        $(`[name="${key}"]`).addClass('is-invalid');
        $(`#${key}-err`).text(msg);
      }
      }
    });
    });


   $(document).on('click', '#update-attribute-condition-btn', function () {
  $(this).prop('disabled', true);
  $('.validation-err').text('');

  const form = $('#edit-attribute-condition-form');
  const id = form.data('id');
  let formData = new FormData(form[0]);
  formData.append('_method', 'PUT');

  $.ajax({
    url: `/admin/attribute-conditions/${id}`,
    type: 'POST',
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      if (response.success) {
        Swal.fire('Updated!', '', 'success');
        $('#attribute-condition-modal').modal('hide');
        setTimeout(() => location.reload(), 300);
      } else {
        $('#update-attribute-condition-btn').prop('disabled', false);
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


    // delete attribute condition
    function deleteAttributeCondition(id) {
    Swal.fire({
      title: "Are you sure?",
      text: "This will delete the condition.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
      $.ajax({
        url: `{{ url('admin/attribute-conditions') }}/${id}`,
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

  </script>
@endpush