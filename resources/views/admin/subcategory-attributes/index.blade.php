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
          <li class="breadcrumb-item active">Attributes Mapping</li>
          </ol>
        </div>
        </div>
      </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
      <div class="form-group breadcrumb-right">
        <a href="javascript:void(0)" class="btn btn-primary btn-round btn-sm" id="add-subcategory-attribute">Add</a>
      </div>
      </div>
    </div>

    <div class="content-body">
      <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <h4 class="card-title">Attribute Mapping</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>#</th>
              <th>Subcategory</th>
              <th>Attribute</th>
              <th>Required</th>
              <th>Step Number</th>
              <th>Sort Order</th>
              <th>Created</th>
              <th width="100px">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($links as $link)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $link->subcategory->name ?? '-' }}</td>
          <td>{{ $link->attribute->name ?? '-' }}</td>
          <td>{{ $link->is_required ? 'Yes' : 'No' }}</td>
          <td>{{ $link->step_number ?? '-' }}</td>
          <td>{{ $link->sort_order ?? '-' }}</td>
          <td>{{ $link->created_at->format('d M Y') }}</td>
          <td>
          <ul class="list-inline mb-0">
          <li class="list-inline-item">
          <a href="javascript:void(0)" class="btn btn-sm btn-primary edit-subcategory-attribute"
            data-id="{{ $link->id }}">
            <i class="fas fa-pencil-alt"></i>
          </a>
          </li>
          <li class="list-inline-item">
          <a href="javascript:void(0)" onclick="deleteSubcategoryAttribute({{ $link->id }})">
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

    <div class="modal fade" id="subcategory-attribute-modal" tabindex="-1" role="dialog" aria-hidden="true"></div>
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

    // Open Create Modal
    $(document).on('click', '#add-subcategory-attribute', function () {
      $.get("{{ route('admin.subcategory-attributes.create') }}", function (result) {
      if (result.success) {
        $('#subcategory-attribute-modal').html(result.html).modal('show');
      }
      });
    });

    // Open Edit Modal
    $(document).on('click', '.edit-subcategory-attribute', function () {
      const id = $(this).data('id');
      $.get(`{{ url('admin/subcategory-attributes') }}/${id}/edit`, function (result) {
      if (result.success) {
        $('#subcategory-attribute-modal').html(result.html).modal('show');
      }
      });
    });

    // check for duplicate attributes
    function hasDuplicateAttributes() {
      const attrIds = [];
      let hasDuplicate = false;

      $('select[name="attribute_id[]"]').each(function () {
      const val = $(this).val();
      if (val) {
        if (attrIds.includes(val)) {
        hasDuplicate = true;
        return false; // break
        }
        attrIds.push(val);
      }
      });

      return hasDuplicate;
    }

    function clearValidationErrors() {
      $('.validation-err').html('');
      $('#subcategory_id-err').html('');
      $('.attribute-values-error').html('');
      $('.sort-order-error').html('');
      $('#attribute_id-err').html('');
      $('#attribute-values-checkboxes + .text-danger').remove(); // remove appended error
      $('input[name="sort_order"] + .text-danger').remove();     // remove appended error
    }


    // Save Form (Create or Update)
    $(document).on('click', '#save-subcategory-attribute-btn', function () {
      clearValidationErrors(); // ✅ clear all old validation messages
      const id = $(this).data('id');
      id ? handleUpdate(id) : handleCreate();
    });

    function handleCreate() {
      if (hasDuplicateAttributes()) {
      Swal.fire('Validation Error', 'You cannot assign the same attribute more than once.', 'error');
      return;
      }

      const form = $('#subcategory-attribute-form')[0];
      const formData = new FormData(form);

      $('#save-subcategory-attribute-btn').attr('disabled', true);

      $.ajax({
      url: `{{ url('admin/subcategory-attributes') }}`,
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: handleResponseStore,
      error: handleError,
      });
    }

    function handleUpdate(id) {
      const form = $('#subcategory-attribute-form')[0];
      const formData = new FormData(form);
      formData.append('_method', 'PUT');

      $('#save-subcategory-attribute-btn').attr('disabled', true);
      $.ajax({
      url: `{{ url('admin/subcategory-attributes') }}/${id}`,
      type: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: handleResponseUpdate,
      });
    }

    function handleError(xhr) {
      $('#save-subcategory-attribute-btn').attr('disabled', false);

      if (xhr.status === 422) {
      const errors = xhr.responseJSON.errors || {};

      for (const key in errors) {
        const messages = errors[key];

        const baseKey = key.split('.')[0];
        const index = parseInt(key.split('.')[1]);

        if (baseKey === 'subcategory_id') {
        $('#subcategory_id-err').html(messages[0]);
        }

        else if (baseKey === 'attribute_value_ids') {
        if (!isNaN(index)) {
          $('.attribute-item').eq(index).find('.attribute-values-error').html(messages[0]);
        } else {
          $('.attribute-values-error').first().html(messages[0]);
        }
        }

        else if (baseKey === 'sort_order' && !isNaN(index)) {
        $('.attribute-item').eq(index).find('.sort-order-error').html(messages[0]);
        }

        else if (baseKey === 'attribute_id' && !isNaN(index)) {
        $('.attribute-item').eq(index).find('.validation-err').first().html(messages[0]);
        }

        else {
        console.warn('Unhandled validation field:', key, messages);
        }
      }
      } else {
      Swal.fire('Oops!', xhr.responseJSON?.message || 'Something went wrong.', 'error');
      }
    }

    // handle response
    function handleResponseStore(result) {
      console.log('here', result);

      $('#save-subcategory-attribute-btn').attr('disabled', false);
      if (result.success) {
      Swal.fire('Success!', result.message || 'Saved successfully.', 'success');
      setTimeout(() => location.reload(), 500);
      } else {
      $('#save-subcategory-attribute-btn').attr('disabled', false);
      if (result.code === 422) {
        const errors = result.errors;

        for (const key in errors) {
        const baseKey = key.split('.')[0];
        const index = parseInt(key.split('.')[1]);

        if (baseKey === 'subcategory_id') {
          $('#subcategory_id-err').html(errors[key][0]);
        }

        else if (baseKey === 'attribute_value_ids') {
          if (!isNaN(index)) {
          $('.attribute-item').eq(index).find('.attribute-values-error').html(errors[key][0]);
          } else {
          $('.attribute-values-error').first().html(errors[key][0]);
          }
        }

        else if (baseKey === 'sort_order' && !isNaN(index)) {
          $('.attribute-item').eq(index).find('.sort-order-error').html(errors[key][0]);
        }

        else if (baseKey === 'attribute_id' && !isNaN(index)) {
          $('.attribute-item').eq(index).find('.validation-err').first().html(errors[key][0]);
        }

        else {
          console.warn('Unhandled validation field:', key, errors[key]);
        }
        }

      } else {
        Swal.fire('Oops!', result.message || 'Something went wrong.', 'error');
      }
      }
    }


    function handleResponseUpdate(result) {
      $('#save-subcategory-attribute-btn').attr('disabled', false);
      if (result.success) {
      Swal.fire('Success!', result.message || 'Saved successfully.', 'success');
      setTimeout(() => location.reload(), 500);
      } else {
      $('#save-subcategory-attribute-btn').attr('disabled', false);
      if (result.code === 422) {
        const errors = result.errors;

        if (errors.subcategory_id) {
        $('#subcategory_id-err').html(errors.subcategory_id[0]);
        }

        if (errors.attribute_id) {
        $('#attribute_id-err').html(errors.attribute_id[0]);
        }

        if (errors.sort_order) {
        $('input[name="sort_order"]').after(`<div class="text-danger">${errors.sort_order[0]}</div>`);
        }

        if (errors.attribute_value_ids) {
        $('#attribute-values-checkboxes').after(`<div class="text-danger">${errors.attribute_value_ids[0]}</div>`);
        }
      }
      else {
        Swal.fire('Oops!', result.message || 'Something went wrong.', 'error');
      }
      }
    }

    // Load Attribute Values When Attribute is Selected
    $(document).on('change', '.attribute-select', function () {
      const attributeId = $(this).val();
      const $container = $(this).closest('.attribute-item').find('.attribute-values-container');
      $container.empty();

      if (attributeId) {
      $.get(`/admin/attributes/${attributeId}/values`, function (res) {
        if (res.success && res.values.length) {
        // Generate checkboxes for values
        const checkboxes = res.values.map(val => `
      <div class="form-check">
      <input class="form-check-input" type="checkbox" name="attribute_value_ids[${attributeId}][]" value="${val.id}" id="attr-val-${val.id}">
      <label class="form-check-label" for="attr-val-${val.id}">${val.value}</label>
      </div>
      `).join('');

        // Add "Select All" only if there are more than one value
        if (res.values.length > 1) {
          const selectAll = `
      <div class="form-check mb-1">
      <input type="checkbox" class="form-check-input select-all-values" id="select-all-${attributeId}">
      <label class="form-check-label" for="select-all-${attributeId}"><strong>Select All</strong></label>
      </div>
      `;
          $container.append(selectAll);
        }

        $container.append(checkboxes);
        }
      });
      }
    });

    // Handle "Select All" checkbox logic
    $(document).on('change', '.select-all-values', function () {
      const $container = $(this).closest('.attribute-values-container');
      const isChecked = $(this).is(':checked');
      $container.find('input[type="checkbox"]').not(this).prop('checked', isChecked);
    });

    // Add More Attribute Block
    $(document).on('click', '#add-more-attribute', function () {
      const $clone = $('.attribute-item:first').clone();
      $clone.find('select').val('');
      $clone.find('input').val('');
      $clone.find('.attribute-values-container').empty();
      $('#attribute-items-wrapper').append($clone);
    });

    // Remove Attribute Block
    $(document).on('click', '.remove-attribute', function () {
      if ($('.attribute-item').length > 1) {
      $(this).closest('.attribute-item').remove();
      } else {
      Swal.fire('At least one attribute is required');
      }
    });

    });

    // Delete Mapping
    function deleteSubcategoryAttribute(id) {
    Swal.fire({
      title: "Are you sure?",
      text: "This will delete the mapping.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
      $.ajax({
        url: `{{ url('admin/subcategory-attributes') }}/${id}`,
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