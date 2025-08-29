

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
                  <li class="breadcrumb-item active">Testimonials</li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
          <div class="form-group breadcrumb-right">
            <a href="javascript:void(0)" class="btn btn-primary btn-round btn-sm" id="add-testimonial">Add</a>
          </div>
        </div>
      </div>

      <div class="content-body">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Testimonials</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="testimonial-table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Author Image</th>
                        <th>Author Name</th>
                        <th>Location</th>
                        <th>Feedback</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th width="100px">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><?php echo e($loop->iteration); ?></td>
                          <td>
                            <?php if($testimonial->author_image): ?>
                              <img src="<?php echo e(asset('storage/' . $testimonial->author_image)); ?>" alt="Author Image"
                                style="height: 80px; width:80px; object-fit: cover; border-radius: 50%;">
                            <?php else: ?>
                              <span class="text-muted">No Image</span>
                            <?php endif; ?>
                          </td>
                          <td><?php echo e($testimonial->author_name); ?></td>
                          <td><?php echo e($testimonial->location ?? '-'); ?></td>
                          <td><?php echo e(Str::limit($testimonial->feedback, 50)); ?></td>
                          <td><?php echo e(ucfirst($testimonial->status)); ?></td>
                          <td><?php echo e($testimonial->created_at->format('d M Y, h:i A')); ?></td>
                          <td>
                            <ul class="list-inline">
                              <li class="list-inline-item">
                                <a href="javascript:void(0)" class="btn btn-primary btn-sm edit-testimonial"
                                  data-id="<?php echo e($testimonial->id); ?>">
                                  <i class="fas fa-pencil-alt"></i>
                                </a>
                              </li>
                              <li class="list-inline-item">
                                <a href="javascript:void(0)" onclick="deleteConfirmation(<?php echo e($testimonial->id); ?>)"
                                  class="btn btn-danger btn-sm">
                                  <i class="fa fa-trash"></i>
                                </a>
                              </li>
                            </ul>
                          </td>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    
    <div class="modal fade" id="testimonial-modal" tabindex="-1" role="dialog" aria-hidden="true"></div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  <script>
    $(document).ready(function () {
      // Open add testimonial modal
      $(document).on('click', '#add-testimonial', function () {
        $.get("<?php echo e(route('admin.testimonials.create')); ?>", function (result) {
          if (result.success) {
            $('#testimonial-modal').html(result.html).modal('show');
          }
        });
      });

      // Open edit testimonial modal
      $(document).on('click', '.edit-testimonial', function () {
        let id = $(this).data('id');
        $.get(`<?php echo e(url('admin/testimonials')); ?>/${id}/edit`, function (result) {
            if (result.success) {
              $('#testimonial-modal').html(result.html).modal('show');
            }
          });
        });

        // CSRF token setup for AJAX
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        // Save testimonial AJAX submit
        $(document).on('click', '#add-testimonial-btn', function () {
          let btn = $(this);
          btn.prop('disabled', true);

          // Clear previous validation errors
          $('.validation-err').text('');

          // Collect the form data including files
          let formData = new FormData($('#testimonial-form')[0]);

          $.ajax({
            url: '<?php echo e(route("admin.testimonials.store")); ?>', // Adjust route as needed
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
              if (response.success) {
                Swal.fire('Success!', response.message || 'Testimonial saved.', 'success');
                $('#testimonial-modal').modal('hide');
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
  // Update testimonial AJAX submit
  $(document).on('click', '#update-testimonial-btn', function () {
    let btn = $(this);
    btn.prop('disabled', true);

    // Clear previous validation errors
    $('.validation-err').text('');

    // Collect the form data including files
    let formData = new FormData($('#testimonial-edit-form')[0]);

    // Append the _method for PUT
    formData.append('_method', 'PUT');

    // Get testimonial ID from button data attribute
    let testimonialId = btn.data('testimonial-id');

    $.ajax({
      url: `/admin/testimonials/${testimonialId}`, // Adjust URL pattern as per your routes
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        if (response.success) {
          Swal.fire('Success!', response.message || 'Testimonial updated.', 'success');
          $('#testimonial-modal').modal('hide');
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
                url: `admin/testimonials/${id}`,
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/admin/testimonials/index.blade.php ENDPATH**/ ?>