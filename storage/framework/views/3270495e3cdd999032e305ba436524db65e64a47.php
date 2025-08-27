

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
          <li class="breadcrumb-item active">Manage Blogs</li>
          </ol>
        </div>
        </div>
      </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
      <div class="form-group breadcrumb-right">
        <a href="<?php echo e(route('admin.content.blogs.create')); ?>" class="btn-icon btn btn-primary btn-round btn-sm">Add New
        Blog</a>
      </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <h4 class="card-title">Blog Listing</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table class="table" id="blog-table">
            <thead>
            <tr>
              <th>Date & Time</th>
              <th>Title</th>
              <th>Slug</th>
              <th>Meta Title</th>
              <th>Meta Description</th>
              <th>Detail</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td><?php echo e($blog->created_at->format('Y-m-d H:i')); ?></td>
          <td><?php echo e($blog->title); ?></td>
          <td><?php echo e($blog->slug); ?></td>
          <td><?php echo e($blog->meta_title); ?></td>
          <td><?php echo e(\Illuminate\Support\Str::limit($blog->meta_description, 50)); ?></td>
          <td><?php echo \Illuminate\Support\Str::limit(strip_tags($blog->detail), 60); ?></td>
          <td><?php echo e($blog->status ?? 'Draft'); ?></td>
          <td>
          <a href="<?php echo e(route('admin.content.blogs.edit', $blog->id)); ?>"
          class="btn btn-sm btn-info mr-1">Edit</a>
          <button class="btn btn-danger btn-sm delete-btn" data-id="<?php echo e($blog->id); ?>">Delete</button>
          </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
          <td colspan="8" class="text-center">No blogs found.</td>
        </tr>
        <?php endif; ?>


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
  <script>

    $(document).on('click', '.delete-btn', function () {
    const blogId = $(this).data('id');

    Swal.fire({
      title: 'Are you sure?',
      text: 'This blog will be permanently deleted.',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
    }).then((result) => {
      if (result.isConfirmed) {
      $.ajax({
        url: '/admin/content/blogs/' + blogId,
        type: 'DELETE',
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
        Swal.fire('Deleted!', response.message, 'success');
        location.reload();
        },
        error: function () {
        Swal.fire('Error!', 'Something went wrong.', 'error');
        }
      });
      }
    });
    });

  </script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/admin/blog/index.blade.php ENDPATH**/ ?>