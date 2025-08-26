

<?php $__env->startSection('content'); ?>
<div class="app-content content">
  <div class="content-overlay"></div>
  <div class="header-navbar-shadow"></div>
  <div class="content-wrapper">

    <!-- Breadcrumb -->
    <div class="content-header row">
      <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <div class="breadcrumb-wrapper">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
                <li class="breadcrumb-item active">Header & Contact Info</li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
        <div class="form-group breadcrumb-right">
          <?php if($contact): ?>
            <a href="<?php echo e(route('admin.header-contact.edit', $contact->id)); ?>" class="btn-icon btn btn-primary btn-round btn-sm">Edit</a>
          <?php else: ?>
            <a href="<?php echo e(route('admin.header-contact.create')); ?>" class="btn-icon btn btn-success btn-round btn-sm">Add Contact Info</a>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="content-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Contact Information</h4>
            </div>

            <div class="card-body">
              <?php if(session('success')): ?>
                <div class="alert alert-success"><?php echo e(session('success')); ?></div>
              <?php endif; ?>

              <?php if($contact): ?>
                <table class="table table-bordered">
                  <tbody>
                    <tr><th>Contact Number</th><td><?php echo e($contact->contact_number ?? 'N/A'); ?></td></tr>
                    <tr><th>Show on Header</th><td><?php echo e($contact->show_on_header ? 'Yes' : 'No'); ?></td></tr>
                    <tr><th>Mobile Number</th><td><?php echo e($contact->mobile_number ?? 'N/A'); ?></td></tr>
                    <tr><th>Email</th><td><?php echo e($contact->email ?? 'N/A'); ?></td></tr>
                    <tr><th>Website URL</th><td><?php echo e($contact->website_url ?? 'N/A'); ?></td></tr>
                    <tr><th>Full Address</th><td><?php echo e($contact->full_address ?? 'N/A'); ?></td></tr>
                    <!-- <tr><th>Google Map Embed</th><td><?php echo $contact->location_map ?? 'N/A'; ?></td></tr> -->
                  </tbody>
                </table>
              <?php else: ?>
                <p class="text-muted">No contact information found. Please add it first.</p>
              <?php endif; ?>
            </div>

          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- JS if needed -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/admin/info/index.blade.php ENDPATH**/ ?>