

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
                                    <li class="breadcrumb-item active">Postal Codes</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="content-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Postal Codes</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Postcode</th>
                                                <th>City</th>
                                                <th>State</th>
                                                <th>Country</th>
                                                <th>Serviceable?</th>
                                                <th>Created At</th>
                                                <th width="100px">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $postalCodes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td><?php echo e($index + 1); ?></td>
                                                    <td><?php echo e($item->pincode); ?></td>
                                                    <td><?php echo e($item->city); ?></td>
                                                    <td><?php echo e($item->state); ?></td>
                                                    <td><?php echo e($item->country); ?></td>
                                                    <td>
                                                        <span
                                                            class="badge badge-<?php echo e($item->is_serviceable ? 'success' : 'danger'); ?>">
                                                            <?php echo e($item->is_serviceable ? 'Yes' : 'No'); ?>

                                                        </span>
                                                    </td>
                                                    <td><?php echo e($item->created_at->format('Y-m-d')); ?></td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a class="btn btn-sm btn-info mr-1 text-white edit-postal-code"
                                                                data-id="<?php echo e($item->id); ?>">Edit</a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="9" class="text-center">No postal codes found.</td>
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

        
        <div class="modal fade" id="postal-code-modal" tabindex="-1" role="dialog" aria-hidden="true"></div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });



        $(document).ready(function () {

            // Edit postal codes
            $(document).on('click', '.edit-postal-code', function () {
                const id = $(this).data('id');
                $.get(`<?php echo e(url('admin/postal-codes')); ?>/${id}/edit`, function (result) {
                    if (result.success) {
                        $('#postal-code-modal').html(result.html).modal('show');
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
        });

        function prepareFormData() {
            const formData = new FormData($('#postal-code-form')[0]);
            return formData;
        }


        // Update postal codes
        $(document).on('click', '#update-postal-code-btn', function () {
            $(this).prop('disabled', true);
            $('.validation-err').text('');
            let id = $(this).data('id');
            const formData = prepareFormData();
            formData.append('_method', 'PUT');

            $.ajax({
                url: `/admin/postal-codes/${id}`,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    if (response.success) {
                        Swal.fire('Updated!', '', 'success');
                        $('#postal-code-modal').modal('hide');
                        setTimeout(() => location.reload(), 300);
                    } else {
                        $('#update-postal-code-btn').prop('disabled', false);
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


        // Destroy modal content after it closes
        $('#postal-code-modal').on('hidden.bs.modal', function () {
            $(this).html('');
        });

    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/admin/postal-code/index.blade.php ENDPATH**/ ?>