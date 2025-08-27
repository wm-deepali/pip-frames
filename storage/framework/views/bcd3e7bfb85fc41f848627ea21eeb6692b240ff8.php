

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
          <li class="breadcrumb-item active">Dynamic Page Creations</li>
          </ol>
        </div>
        </div>
      </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
      <div class="form-group breadcrumb-right">
        <button class="btn-icon btn btn-primary btn-round btn-sm" data-toggle="modal" data-target="#addPageModal">Add
        New Page</button>
      </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <h4 class="card-title">Dynamic Pages Listing</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table class="table" id="dynamic-pages-table">
            <thead>
            <tr>
              <th>Date & Time</th>
              <th>Page Name</th>
              <th>Slug</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>

            <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td><?php echo e($page->page_name); ?></td>
          <td><?php echo e($page->slug); ?></td>
          <td><?php echo e(ucfirst($page->status)); ?></td>
          <td><?php echo e($page->created_at->format('Y-m-d H:i')); ?></td>
          <td>
          <a href="javascript:void(0);" class="btn btn-sm btn-info mr-1 edit-page-btn"
          data-id="<?php echo e($page->id); ?>">Edit</a>
          <button class="btn btn-sm btn-danger delete-page-btn" data-id="<?php echo e($page->id); ?>">Delete</button>

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

    <!-- Add New Page Modal -->
    <div class="modal fade" id="addPageModal" tabindex="-1" role="dialog" aria-labelledby="addPageModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
      <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addPageModalLabel">Add New Page</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addPageForm" action="">
        <div class="form-row">
          <div class="form-group col-md-6">
          <label for="page_name">Page Name</label>
          <input type="text" class="form-control" id="page_name" name="page_name" placeholder="Enter page name"
            required>
          </div>
          <div class="form-group col-md-6">
          <label for="slug">Slug</label>
          <input type="text" class="form-control" id="slug" name="slug"
            placeholder="Enter slug (e.g., about-comic-books)" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
          <label for="title">Page Title</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
          </div>
          <div class="form-group col-md-6">
          <label for="meta_title">Meta Title</label>
          <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Enter meta title"
            required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
          <label for="meta_keyword">Meta Keyword</label>
          <input type="text" class="form-control" id="meta_keyword" name="meta_keyword"
            placeholder="Enter meta keywords (comma-separated)" required>
          </div>
          <div class="form-group col-md-6">
          <label for="status">Status</label>
          <select class="form-control" id="status" name="status" required>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
          </select>
          </div>
        </div>

        <div class="form-group">
          <label for="meta_description">Meta Description</label>
          <textarea class="form-control" id="meta_description" name="meta_description" rows="3"
          placeholder="Enter meta description" required></textarea>
        </div>

        <div class="form-group">
          <label for="detail">Detail Content</label>
          <textarea class="form-control rich-editor" id="detail" name="detail" rows="6"
          placeholder="Enter page content" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Save Page</button>
        </form>

      </div>
      </div>
    </div>
    </div>


    <div class="modal fade" id="editPageModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Page</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <div class="modal-body">
        <form id="editPageForm">
        <input type="hidden" id="edit_id" name="id">

        
        

        <div class="form-row">
          <div class="form-group col-md-6">
          <label for="edit_page_name">Page Name</label>
          <input type="text" class="form-control" id="edit_page_name" name="page_name" required>
          </div>
          <div class="form-group col-md-6">
          <label for="edit_slug">Slug</label>
          <input type="text" class="form-control" id="edit_slug" name="slug" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
          <label for="edit_title">Title</label>
          <input type="text" class="form-control" id="edit_title" name="title" required>
          </div>
          <div class="form-group col-md-6">
          <label for="edit_meta_title">Meta Title</label>
          <input type="text" class="form-control" id="edit_meta_title" name="meta_title" required>
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
          <label for="edit_meta_keyword">Meta Keyword</label>
          <input type="text" class="form-control" id="edit_meta_keyword" name="meta_keyword" required>
          </div>
          <div class="form-group col-md-6">
          <label for="edit_status">Status</label>
          <select class="form-control" id="edit_status" name="status" required>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
          </select>
          </div>
        </div>

        <div class="form-group">
          <label for="edit_meta_description">Meta Description</label>
          <textarea class="form-control" id="edit_meta_description" name="meta_description" rows="3"
          required></textarea>
        </div>

        <div class="form-group">
          <label for="edit_detail">Detail Content</label>
          <textarea class="form-control" id="edit_detail" name="detail" rows="6" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Page</button>
        </form>
      </div>
      </div>
    </div>
    </div>


  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace('detail');


    function confirmDelete(url) {
    if (confirm('Are you sure you want to delete this page?')) {
      window.location.href = url;
    }
    }

    document.getElementById('edit_page_name').addEventListener('input', function () {
    const slug = this.value.trim().toLowerCase().replace(/\s+/g, '-').replace(/[^\w\-]+/g, '');
    document.getElementById('edit_slug').value = slug;
    });


    document.getElementById('page_name').addEventListener('input', function () {
    const slug = this.value.trim().toLowerCase().replace(/\s+/g, '-').replace(/[^\w\-]+/g, '');
    document.getElementById('slug').value = slug;
    });

    $('#addPageForm').on('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    const detailContent = CKEDITOR.instances['detail'].getData();
    formData.set('detail', detailContent.trim() ? detailContent : '');

    $.ajax({
      url: '<?php echo e(route("admin.pages.store")); ?>',
      method: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
      success: function (result) {
      Swal.fire('Success!', result.message || '', 'success');
      $('#addPageModal').modal('hide');
      $('#addPageForm')[0].reset();
      CKEDITOR.instances['detail'].setData('');
      location.reload();
      },
      error: function (xhr) {
      if (xhr.status === 422) {
        let errors = xhr.responseJSON.errors;
        let msg = '';
        for (let field in errors) msg += errors[field][0] + '\n';
        Swal.fire(msg);
      } else {
        Swal.fire('Something went wrong.');
      }
      }
    });
    });


    CKEDITOR.replace('edit_detail');

    // Handle Edit Button
    $('.edit-page-btn').on('click', function () {
    const id = $(this).data('id');
    $.get(`/admin/pages/${id}/edit`, function (data) {
      $('#edit_id').val(data.id);
      $('#edit_page_name').val(data.page_name);
      $('#edit_slug').val(data.slug);
      $('#edit_title').val(data.title);
      $('#edit_meta_title').val(data.meta_title);
      $('#edit_meta_keyword').val(data.meta_keyword);
      $('#edit_meta_description').val(data.meta_description);
      $('#edit_status').val(data.status);
      CKEDITOR.instances['edit_detail'].setData(data.detail);
      $('#editPageModal').modal('show');
    });
    });

    // Update Page Form Submit
    $('#editPageForm').on('submit', function (e) {
    e.preventDefault();
    const id = $('#edit_id').val();
    const formData = new FormData(this);
    const detailContent = CKEDITOR.instances['edit_detail'].getData();
    formData.set('detail', detailContent.trim() ? detailContent : '');

    $.ajax({
      url: `/admin/pages/${id}/update`,
      method: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
      success: function (result) {
      Swal.fire('Updated!', result.message || '', 'success');
      $('#editPageModal').modal('hide');
      location.reload();
      },
      error: function (xhr) {
      Swal.fire('Error', 'Update failed', 'error');
      }
    });
    });


    $('.delete-page-btn').on('click', function () {
    const id = $(this).data('id');
    Swal.fire({
      title: 'Are you sure?',
      text: 'This will delete the page permanently!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
      $.ajax({
        url: `/admin/pages/${id}`,
        method: 'DELETE',
        headers: { 'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>' },
        success: function () {
        Swal.fire('Deleted!', 'Page deleted.', 'success');
        location.reload();
        },
        error: function () {
        Swal.fire('Error', 'Delete failed.', 'error');
        }
      });
      }
    });
    });

  </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/admin/content/dynamic_pages.blade.php ENDPATH**/ ?>