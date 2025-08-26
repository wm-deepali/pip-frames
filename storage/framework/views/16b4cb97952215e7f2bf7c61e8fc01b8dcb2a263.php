

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
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e($loop->iteration); ?></td>
            <td><?php echo e($category->name); ?></td>
            <td><?php echo e($category->slug); ?></td>
            <td>
            <?php if($category->image): ?>
          <img src="<?php echo e(asset('storage/' . $category->image)); ?>" alt="Image" width="50" height="50"
          class="rounded">
        <?php else: ?>
          <span class="text-muted">No Image</span>
        <?php endif; ?>
            </td>
            <td><?php echo e(ucfirst($category->status)); ?></td>

            <td><?php echo e($category->created_at->format('d M Y, h:i A')); ?></td>

            <td>
            <ul class="list-inline">
            <li class="list-inline-item">
            <a href="javascript:void(0)" class="btn btn-primary btn-sm edit-category"
              data-id="<?php echo e($category->id); ?>">
              <i class="fas fa-pencil-alt"></i>
            </a>
            </li>
            <li class="list-inline-item">
            <a href="javascript:void(0)" onclick="deleteConfirmation(<?php echo e($category->id); ?>)">
              <i class="fa fa-trash text-danger"></i>
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
  </div>

  <div class="modal fade" id="category-modal" tabindex="-1" role="dialog" aria-hidden="true"></div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
        url: `<?php echo e(url('admin/manage-categories')); ?>/${id}`,
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
      url: "<?php echo e(url('admin/manage-categories/create')); ?>",
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
      url: "<?php echo e(url('admin/manage-categories')); ?>",
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
      url: `<?php echo e(url('admin/manage-categories')); ?>/${id}/edit`,
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
      url: `<?php echo e(url('admin/manage-categories')); ?>/${id}`,
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/admin/categories/index.blade.php ENDPATH**/ ?>