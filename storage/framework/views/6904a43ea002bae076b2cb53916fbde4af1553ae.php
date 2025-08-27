

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
          <li class="breadcrumb-item active">Manage FAQs</li>
          </ol>
        </div>
        </div>
      </div>
      </div>
      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
      <div class="form-group breadcrumb-right">
        <button class="btn-icon btn btn-primary btn-round btn-sm" data-toggle="modal" data-target="#addFaqModal">Add
        New FAQ</button>
      </div>
      </div>
    </div>
    <div class="content-body">
      <div class="row">
      <div class="col-md-12">
        <div class="card">
        <div class="card-header">
          <h4 class="card-title">FAQ Listing</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
          <table class="table" id="faq-table">
            <thead>
            <tr>
              <th>Date & Time</th>
              <th>Question</th>
              <th>Answer</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
          <td><?php echo e($faq->created_at->format('Y-m-d H:i')); ?></td>
          <td><?php echo e($faq->question); ?></td>
          <td><?php echo e($faq->answer); ?></td>
          <td><?php echo e($faq->status); ?></td>

          <td>
          <button class="btn btn-sm btn-info mr-1" onclick="editFaq(<?php echo e($faq->id); ?>)">Edit</button>
          <button class="btn btn-sm btn-danger" onclick="deleteFaq(<?php echo e($faq->id); ?>)">Delete</button>
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

    <!-- Add New FAQ Modal -->
    <div class="modal fade" id="addFaqModal" tabindex="-1" role="dialog" aria-labelledby="addFaqModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addFaqModalLabel">Add New FAQ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="faqForm" method="POST">
        <?php echo csrf_field(); ?>
        <div class="form-group">
          <label for="question">Question</label>
          <input type="text" class="form-control" id="question" name="question" required>
        </div>
        <input type="hidden" id="faq_id" name="faq_id">

        <div class="form-group">
          <label for="answer">Answer</label>
          <textarea class="form-control" id="answer" name="answer" rows="6" required></textarea>
        </div>
        <div class="form-group">
          <label for="status">Status</label>
          <select class="form-control" id="status" name="status" required>
          <option value="Published">Published</option>
          <option value="Draft">Draft</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Save FAQ</button>
        </form>

      </div>
      </div>
    </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>

    function editFaq(id) {
    $.get("<?php echo e(url('admin/faqs/edit')); ?>/" + id, function (data) {
      $('#faq_id').val(data.id);
      $('#question').val(data.question);
      $('#answer').val(data.answer);
      $('#status').val(data.status);
      $('#addFaqModalLabel').text("Edit FAQ");
      $('#addFaqModal').modal('show');
    });
    }

    function deleteFaq(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "This action cannot be undone!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
      $.ajax({
        url: '<?php echo e(url("admin/faqs/delete")); ?>/' + id,
        type: 'DELETE',
        data: {
        _token: '<?php echo e(csrf_token()); ?>'
        },
        success: function (response) {
        Swal.fire({
          title: 'Deleted!',
          text: response.message,
          icon: 'success',
          timer: 1500,
          showConfirmButton: false
        });
        setTimeout(() => location.reload(), 1500);
        },
        error: function (xhr) {
        Swal.fire('Delete failed!', '', 'error');
        console.log(xhr.responseText);
        }
      });
      }
    });
    }


    $('#faqForm').on('submit', function (e) {
    e.preventDefault();

    let id = $('#faq_id').val();
    let url = id ? '<?php echo e(url("admin/faqs/update")); ?>/' + id : '<?php echo e(route("admin.faqs.store")); ?>';

    $.ajax({
      url: url,
      method: 'POST',
      data: $(this).serialize(),
      headers: {
      'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
      },
      success: function (response) {
      if (response.success) {
        Swal.fire(response.message);
        $('#addFaqModal').modal('hide');
        $('#faqForm')[0].reset();
        $('#faq_id').val('');
        location.reload();
      }
      },
      error: function (xhr) {
      Swal.fire('Something went wrong!');
      console.log(xhr.responseText);
      }
    });
    });
  </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/admin/content/faq.blade.php ENDPATH**/ ?>