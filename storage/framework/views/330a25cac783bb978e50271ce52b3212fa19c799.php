

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
          <li class="breadcrumb-item"><a href="<?php echo e(route('admin.content.blogs')); ?>">Manage Blogs</a></li>
          <li class="breadcrumb-item active">Add New Blog</li>
          </ol>
        </div>
        </div>
      </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
      <div class="form-group breadcrumb-right">
        <a href="<?php echo e(route('admin.content.blogs')); ?>" class="btn-icon btn btn-secondary btn-round btn-sm">Back to
        Blogs</a>
      </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <h4 class="card-title">Add New Blog</h4>
        </div>
        <div class="card-body">
          <form id="blogForm" method="POST" enctype="multipart/form-data">
          <div class="row">
            <!-- Left Column -->
            <div class="col-md-6">
            <div class="form-group">
              <label for="title">Title</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Enter blog title"
              required>
            </div>

            <div class="form-group">
              <label for="slug_url">Slug URL</label>
              <input type="text" class="form-control" id="slug_url" name="slug_url" placeholder="Enter slug URL"
              required>
            </div>

            <div class="form-group">
              <label for="meta_title">Meta Title</label>
              <input type="text" class="form-control" id="meta_title" name="meta_title"
              placeholder="Enter meta title" required>
            </div>

            <div class="form-group">
              <label for="meta_keywords">Meta Keywords</label>
              <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
              placeholder="Enter meta keywords" required>
            </div>

            <div class="form-group">
              <label for="thumbnail">Thumbnail Image</label>
              <input type="file" class="form-control-file" id="thumbnail" name="thumbnail" accept="image/*">
              <small class="form-text text-muted">Maximum file size: 2MB</small>
              <img id="thumbnail-preview" src="#" alt="Thumbnail Preview"
              style="display:none; max-height: 150px; margin-top: 10px;">
            </div>

            <div class="form-group">
              <label for="banner">Banner Image</label>
              <input type="file" class="form-control-file" id="banner" name="banner" accept="image/*">
              <small class="form-text text-muted">Maximum file size: 4MB</small>
              <img id="banner-preview" src="#" alt="Banner Preview"
              style="display:none; max-height: 150px; margin-top: 10px;">
            </div>


            </div>

            <!-- Right Column -->
            <div class="col-md-6">
            <div class="form-group">
              <label for="detail">Detail</label>
              <textarea class="form-control" id="detail" name="detail" rows="6" placeholder="Enter blog content"
              required></textarea>
            </div>

            <div class="form-group">
              <label for="meta_description">Meta Description</label>
              <textarea class="form-control" id="meta_description" name="meta_description" rows="4"
              placeholder="Enter meta description" required></textarea>
            </div>
            </div>
          </div>

          <div class="text-right">
            <button type="submit" class="btn btn-primary mt-2">Save Blog</button>
          </div>
          </form>

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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
  <script>

    // Automatic slug from blog title
    $('#title').on('input', function () {
    // Convert title to a slug
    let slug = $(this).val()
      .toLowerCase()
      .trim()
      .replace(/\s+/g, '-')      // Replace spaces with hyphens
      .replace(/[^\w\-]+/g, '')  // Remove all non-word chars
      .replace(/\-\-+/g, '-')    // Replace multiple - with single -
      .replace(/^-+|-+$/g, '');  // Trim - from start and end
    $('#slug_url').val(slug);
    });


    // Thumbnail preview
    $('#thumbnail').change(function () {
    const input = this;
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function (e) {
      $('#thumbnail-preview').attr('src', e.target.result).show();
      };
      reader.readAsDataURL(input.files[0]);
    }
    });

    // Banner preview
    $('#banner').change(function () {
    const input = this;
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = function (e) {
      $('#banner-preview').attr('src', e.target.result).show();
      };
      reader.readAsDataURL(input.files[0]);
    }
    });

    $(document).ready(function () {
    // Initialize CKEditor
    CKEDITOR.replace('detail');

    $('#blogForm').on('submit', function (e) {
      e.preventDefault();

      let formData = new FormData(this);
      const detailContent = CKEDITOR.instances['detail'].getData();
      formData.set('detail', detailContent.trim() ? detailContent : '');

      $.ajax({
      url: "<?php echo e(route('admin.content.blogs.store')); ?>",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      success: function (response) {
        Swal.fire('Blog added successfully!');
        window.location.href = "<?php echo e(route('admin.content.blogs')); ?>";
      },
      error: function (xhr) {
        let errors = xhr.responseJSON?.errors || {};
        let errorMessages = '';
        $.each(errors, function (key, value) {
        errorMessages += value[0] + '\n'; // Shows first error per field
        });
        Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        text: errorMessages.trim(),
        });
      }

      });
    });
    });
  </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/admin/blog/create.blade.php ENDPATH**/ ?>