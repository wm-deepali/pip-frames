<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Add slider</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <form id="slider-form" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                        <label>Slider Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        <div class="text-danger validation-err" id="image-err"></div>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="active" selected>Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <div class="text-danger validation-err" id="status-err"></div>
                    </div>
                </div>


                
                <div class="form-group ">
                    <label>Content <span class="text-danger">*</span></label>
                    <textarea name="content" id="content" rows="5" class="form-control" required></textarea>
                    <div class="text-danger validation-err" id="content-err"></div>
                </div>

                <button type="button" class="btn btn-primary" id="add-slider-btn">Save</button>
            </form>
        </div>
    </div>
</div><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/admin/sliders/create.blade.php ENDPATH**/ ?>