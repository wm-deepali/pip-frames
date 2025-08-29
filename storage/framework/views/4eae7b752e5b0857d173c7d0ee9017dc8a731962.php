<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit slider</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <form id="slider-edit-form" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                        <label>Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        <?php if($slider->image_path): ?>
                        <div class="mt-2">
                            <img src="<?php echo e(asset('storage/' . $slider->image_path)); ?>" alt="Image"
                                class="img-thumbnail" style="height:100px; width:100px; object-fit:cover;">
                        </div>
                        <?php endif; ?>
                        <div class="text-danger validation-err" id="author_image-err"></div>
                    </div>
              
                    
                    <div class="form-group col-md-6">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="active" <?php echo e($slider->status == 'active' ? 'selected' : ''); ?>>Active
                            </option>
                            <option value="inactive" <?php echo e($slider->status == 'inactive' ? 'selected' : ''); ?>>InActive
                            </option>
                        </select>
                        <div class="text-danger validation-err" id="status-err"></div>
                    </div>
                </div>

                
                <div class="form-group">
                    <label>Content <span class="text-danger">*</span></label>
                    <textarea name="content" id="content" rows="5" class="form-control" required><?php echo e($slider->content); ?></textarea>
                    <div class="text-danger validation-err" id="content-err"></div>
                </div>

                <button type="button" class="btn btn-primary" id="update-slider-btn"
                    data-slider-id="<?php echo e($slider->id); ?>">Update</button>
            </form>
        </div>
    </div>
</div>
<?php /**PATH D:\web-mingo-project\pip_frames\resources\views/admin/sliders/edit.blade.php ENDPATH**/ ?>