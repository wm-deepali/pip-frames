

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
          <li class="breadcrumb-item active">Sub Category</li>
          </ol>
        </div>
        </div>
      </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
      <div class="form-group breadcrumb-right">
        <a href="javascript:void(0)" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle"
        id="add-subcategory">Add</a>
      </div>
      </div>
    </div>

    <div class="content-body">
      <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <h4 class="card-title">Sub Category</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table class="table" id="pagetype-table">
            <thead>
            <tr>
              <th>#</th>
              <th>Categories</th>
              <th>Name</th>
              <th>Slug</th>
              <th>Thumbnail</th>
              <th>Calculator Required</th>
              <th>Status</th>
              <th>Created At</th>
              <th width="100px">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e($loop->iteration); ?></td>
            <td>
            <?php $__currentLoopData = $subcategory->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <span class="badge badge-secondary"><?php echo e($cat->name); ?></span>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td><?php echo e($subcategory->name); ?></td>
            <td><?php echo e($subcategory->slug); ?></td>
            <td> <img src="<?php echo e(asset('storage/' . $subcategory->thumbnail)); ?>" class="img-thumbnail"
               style="height:100px; width:100px; object-fit:cover;"></td>
            <td>
            <span class="badge badge-<?php echo e($subcategory->calculator_required ? 'success' : 'secondary'); ?>">
            <?php echo e($subcategory->calculator_required ? 'Yes' : 'No'); ?>

            </span>
            </td>
            <td><?php echo e(ucfirst($subcategory->status)); ?></td>

            <td><?php echo e($subcategory->created_at->format('d M Y, h:i A')); ?></td>

            <td>
            <ul class="list-inline">
            <li class="list-inline-item">
            <a href="javascript:void(0)" class="btn btn-primary btn-sm edit-subcategory"
              subcategory_id="<?php echo e($subcategory->id); ?>">
              <i class="fas fa-pencil-alt"></i>
            </a>
            </li>
            <li class="list-inline-item">
            <a href="javascript:void(0)" onclick="deleteConfirmation(<?php echo e($subcategory->id); ?>)">
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

  
  <div class="modal fade" id="subcategory-modal" tabindex="-1" role="dialog" aria-hidden="true"></div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
  <script>
    let galleryFiles = [];
    let galleryFileIndex = 0;
    let deletedImagePaths = [];

    function ClassicEditorInit() {
    const fields = ['information', 'available_sizes', 'binding_options', 'paper_types'];
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
    $(document).on('click', '#add-subcategory', function () {
      $.get("<?php echo e(url('admin/manage-subcategories/create')); ?>", function (result) {
      if (result.success) {
        $("#subcategory-modal").html(result.html).modal('show');
        ClassicEditorInit();
        galleryFiles = [];
        deletedImagePaths = [];
      }
      });
    });

    $(document).on('click', '.edit-subcategory', function () {
      const id = $(this).attr('subcategory_id');
      $.get(`<?php echo e(url('admin/manage-subcategories')); ?>/${id}/edit`, function (result) {
      if (result.success) {
        $("#subcategory-modal").html(result.html).modal('show');
        ClassicEditorInit();
        galleryFiles = [];
        deletedImagePaths = [];
      }
      });
    });

    $(document).on("change", "#gallery-input", function () {
      const files = this.files;
      for (let i = 0; i < files.length; i++) {
      const file = files[i];
      const index = galleryFileIndex++;
      galleryFiles.push({ index, file });

      const reader = new FileReader();
      reader.onload = function (e) {
        const preview = `
      <div class="col-md-2 text-center mb-2" data-index="${index}">
      <div class="position-relative border rounded mx-auto" style="width:100px; height:100px; overflow:hidden;">
      <img src="${e.target.result}" class="w-100 h-100" style="object-fit:cover;">
      <button type="button" class="btn btn-sm btn-danger btn-remove-image"
      data-index="${index}"
      style="position:absolute; top:5px; right:5px; border-radius: 50%; padding: 0.2rem 0.45rem; font-size: 0.7rem;">
      &times;
      </button>
      </div>
      </div>`;
        $('#gallery-preview-list').append(preview);
      };
      reader.readAsDataURL(file);
      }
      this.value = '';
    });


    $(document).on("click", ".btn-remove-image", function () {
      const index = $(this).data("index");
      galleryFiles = galleryFiles.filter(f => f.index !== index);
      $(`[data-index="${index}"]`).remove();
    });

    $(document).on("click", ".btn-remove-existing-image", function () {
      const path = $(this).data("path");
      deletedImagePaths.push(path);
      $(this).closest(".existing-image").remove();
    });

    function prepareFormData() {
      for (const instance in CKEDITOR.instances) {
      CKEDITOR.instances[instance].updateElement();
      }

      const formData = new FormData($('#subcategory-form')[0]);
      galleryFiles.forEach(f => formData.append('gallery[]', f.file));
      formData.append('deleted_image_paths', deletedImagePaths.join(','));

      return formData;
    }

    $(document).on("click", "#add-subcategory-btn", function () {
      const formData = prepareFormData();
      sendSubcategoryAjax("POST", "<?php echo e(url('admin/manage-subcategories')); ?>", formData, this);
    });

    $(document).on("click", "#update-subcategory-btn", function () {
      const id = $(this).attr("subcategory_id");
      const formData = prepareFormData();
      formData.append('_method', 'PUT');
      sendSubcategoryAjax("POST", `<?php echo e(url('admin/manage-subcategories')); ?>/${id}`, formData, this);
    });

    function sendSubcategoryAjax(method, url, formData, button) {
      $(button).attr('disabled', true);
      $('.validation-err').html('');
      $.ajax({
      url,
      type: method,
      processData: false,
      contentType: false,
      data: formData,
      success: function (result) {
        if (result.success) {
        Swal.fire('Success!', '', 'success');
        setTimeout(() => location.reload(), 400);
        } else {
        $(button).attr('disabled', false);
        if (result.code === 422) {
          for (const key in result.errors) {
          $(`#${key}-err`).html(result.errors[key][0]);
          }
        } else {
          Swal.fire(result.msgText);
        }
        }
      }
      });
    }
    });
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
        url: `<?php echo e(url('admin/manage-subcategories')); ?>/${id}`,
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

  </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/admin/subcategories/index.blade.php ENDPATH**/ ?>