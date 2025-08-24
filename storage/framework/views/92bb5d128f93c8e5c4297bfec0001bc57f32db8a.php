<div class="modal-dialog">
    <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title">Add</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
            <div class="container-fluid">
                <form id="add-category-form" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter name">
                        <div class="text-danger validation-err" id="name-err"></div>
                    </div>
                    
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="active" selected>Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <div class="text-danger validation-err" id="status-err"></div>
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" name="image" id="image" class="form-control-file">
                        <div class="text-danger validation-err" id="image-err"></div>
                    </div>

                    <div class="form-group text-right">
                        <button type="button" class="btn btn-info" id="add-category-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH D:\web-mingo-project\new\resources\views/admin/categories/ajax/add-category.blade.php ENDPATH**/ ?>