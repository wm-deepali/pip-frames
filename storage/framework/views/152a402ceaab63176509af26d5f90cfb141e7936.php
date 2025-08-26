

<?php $__env->startSection('content'); ?>
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
          <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
          <li class="breadcrumb-item active">Delivery Charges</li>
          </ol>
        </div>
        </div>
      </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
      <div class="form-group breadcrumb-right">
        <a href="javascript:void(0)" class="btn btn-primary btn-round btn-sm" id="add-delivery-charge">Add</a>
      </div>
      </div>
    </div>

    <div class="content-body">
      <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <h4 class="card-title">Delivery Charges</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>No. of Days</th>
              <th>Price</th>
              <th>Details</th>
              <th>Default</th>
              <th>Created At</th>
              <th width="100px">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $deliverCharges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td><?php echo e($index + 1); ?></td>
          <td><?php echo e($item->title); ?></td>
          <td><?php echo e($item->no_of_days); ?></td>
          <td>£<?php echo e(number_format($item->price, 2)); ?></td>
          <td title="<?php echo e(strip_tags($item->details)); ?>">
          <?php echo e(\Illuminate\Support\Str::limit(strip_tags($item->details), 50)); ?>

          </td>
          <td>
            <span class="badge badge-<?php echo e($item->is_default ? 'success' : 'secondary'); ?>">
            <?php echo e($item->is_default ? 'Yes' : 'No'); ?>

            </span>
            </td>
          <td><?php echo e($item->created_at->format('Y-m-d')); ?></td>
          <td>
          <div class="d-flex">
          <a class="btn btn-sm btn-info mr-1 text-white edit-delivery-charge"
          data-id="<?php echo e($item->id); ?>">Edit</a>
          <button class="btn btn-sm btn-danger" onclick="deleteValue(<?php echo e($item->id); ?>)">Delete</button>
          </div>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
          <td colspan="7" class="text-center">No Delivery Charges entries found.</td>
        </tr>
        <?php endif; ?>
            </tbody>

          </table>
          </div>
        </div>
        </div>
      </div>
      </div>
    </div>
    </div>

    
    <div class="modal fade" id="delivery-charge-modal" tabindex="-1" role="dialog" aria-hidden="true"></div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  <script>
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    function ClassicEditorInit() {
    const fields = ['details'];
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
    // Add Delivery Charges
    $(document).on('click', '#add-delivery-charge', function () {
      $.get("<?php echo e(route('admin.delivery-charges.create')); ?>", function (result) {
      if (result.success) {
        $('#delivery-charge-modal').html(result.html).modal('show');
        ClassicEditorInit();
        // Delay needed to ensure modal DOM is rendered before binding
        setTimeout(() => {
        if (typeof initDeliveryModalScripts === 'function') {
          initDeliveryModalScripts();
        }
        }, 100);
      }
      });
    });

    // Edit Delivery Charges
    $(document).on('click', '.edit-delivery-charge', function () {
      const id = $(this).data('id');
      $.get(`<?php echo e(url('admin/delivery-charges')); ?>/${id}/edit`, function (result) {
      if (result.success) {
        $('#delivery-charge-modal').html(result.html).modal('show');
        ClassicEditorInit();
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
    $(document).on('click', '#save-delivery-charge-btn', function () {
      const form = $('#delivery-charge-form')[0];
      const formData = prepareFormData();
      const id = $(this).data("id");
      const url = id ? `<?php echo e(url('admin/delivery-charges')); ?>/${id}` : `<?php echo e(url('admin/delivery-charges')); ?>`;
      const method = id ? 'POST' : 'POST';

      if (id) formData.append('_method', 'PUT');

      $('#save-delivery-charge-btn').attr('disabled', true);
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
        $('#save-delivery-charge-btn').attr('disabled', false);
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

    function prepareFormData() {
    for (const instance in CKEDITOR.instances) {
      CKEDITOR.instances[instance].updateElement();
    }

    const formData = new FormData($('#delivery-charge-form')[0]);
    return formData;
    }


    // Update Delivery Charges
    $(document).on('click', '#update-delivery-charge-btn', function () {
    $(this).prop('disabled', true);
    $('.validation-err').text('');
    let id = $(this).data('id');
    const formData = prepareFormData();
    formData.append('_method', 'PUT');

    $.ajax({
      url: `/admin/delivery-charges/${id}`,
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
      if (response.success) {
        Swal.fire('Updated!', '', 'success');
        $('#delivery-charge-modal').modal('hide');
        setTimeout(() => location.reload(), 300);
      } else {
        $('#update-delivery-charge-btn').prop('disabled', false);
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


    // Delete Delivery Charges
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
        url: `<?php echo e(url('admin/delivery-charges')); ?>/${id}`,
        type: 'POST',
        data: { _method: 'DELETE', _token: '<?php echo e(csrf_token()); ?>' },
        success: function () {
        Swal.fire('Deleted!', '', 'success');
        setTimeout(() => location.reload(), 500);
        }
      });
      }
    });
    }

    // Destroy modal content after it closes
    $('#delivery-charge-modal').on('hidden.bs.modal', function () {
    $(this).html('');
    });

  </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/admin/delivery-charge/index.blade.php ENDPATH**/ ?>