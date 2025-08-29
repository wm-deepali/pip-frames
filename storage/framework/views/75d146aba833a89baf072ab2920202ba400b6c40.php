

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
                                    <li class="breadcrumb-item active">Enquires</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <a href="javascript:void(0)" class="btn btn-primary btn-round btn-sm" id="add-testimonial">Add</a>
                    </div>
                </div> -->
            </div>

            <div class="content-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Enquires</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="testimonial-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Subject</th>
                                                <th>Selected Subject</th>
                                                <th>Message</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__currentLoopData = $ContactMessage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enquiry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($loop->iteration); ?></td>
                                                    <td>
                                                        <?php echo e($enquiry->name ?? '-'); ?>

                                                    </td>
                                                    <td><?php echo e($enquiry->email  ?? '-'); ?></td>
                                                    <td><?php echo e($enquiry->phone ?? '-'); ?></td>
                                                    <td><?php echo e($enquiry->subject); ?></td>
                                                    <td><?php echo e($enquiry->selected_subject); ?></td>
                                                    <td><?php echo e(Str::limit($enquiry->message, 50)); ?></td>
                                                    <td><?php echo e($enquiry->created_at->format('d M Y, h:i A')); ?></td>
                                                  
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/admin/enquires/index.blade.php ENDPATH**/ ?>