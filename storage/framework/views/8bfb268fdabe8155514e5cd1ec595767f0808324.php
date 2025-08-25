

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
                                    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.images.index')); ?>">Image
                                            Settings</a></li>
                                    <li class="breadcrumb-item active">Edit Setting</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Image Setting</h4>
                    </div>

                    <div class="card-body">
                        <form id="image-settings-form" method="POST" enctype="multipart/form-data"
                            action="<?php echo e(route('admin.images.update', $condition->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            
                            <div class="form-group">
                                <label><strong>Subcategory <span class="text-danger">*</span></strong></label>
                                <select name="subcategory_id" class="form-control" id="subcategory-select">
                                    <option value="">-- Select Subcategory --</option>
                                    <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($subcategory->id); ?>" <?php echo e($condition->subcategory_id == $subcategory->id ? 'selected' : ''); ?>>
                                            <?php echo e($subcategory->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span class="text-danger validation-err" id="subcategory_id-err"></span>
                            </div>

                            
                            <div id="conditions-container">
                                <?php $__currentLoopData = $condition->dependencies->groupBy('condition_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $condIndex => $deps): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="condition-block border rounded p-1 mb-1">
                                        <input type="hidden" name="conditions[<?php echo e($loop->index); ?>][id]"
                                            value="<?php echo e($condition->id); ?>">

                                        
                                        <div class="dependencies-container">
                                            <?php $__currentLoopData = $deps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $depIndex => $dep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="dependency-row row mb-1">
                                                    <div class="form-group col-md-5">
                                                        <label><strong>Attribute</strong></label>
                                                        <select
                                                            name="conditions[<?php echo e($loop->parent->index); ?>][dependencies][<?php echo e($loop->index); ?>][attribute_id]"
                                                            class="form-control dependency-attribute-select">
                                                            <option value="">-- Select Attribute --</option>
                                                            <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($attr['id']); ?>" <?php echo e($dep->attribute_id == $attr['id'] ? 'selected' : ''); ?>>
                                                                    <?php echo e($attr['name']); ?>

                                                                </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-5">
                                                        <label><strong>Value</strong></label>
                                                        <select
                                                            name="conditions[<?php echo e($loop->parent->index); ?>][dependencies][<?php echo e($loop->index); ?>][value_id]"
                                                            class="form-control dependency-value-select">
                                                            <option value="">-- Select Value --</option>

                                                            <?php if(isset($attributeValueMap[$dep->attribute_id])): ?>
                                                                <?php $__currentLoopData = $attributeValueMap[$dep->attribute_id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($val['id']); ?>" <?php echo e($dep->value_id == $val['id'] ? 'selected' : ''); ?>><?php echo e($val['value']); ?>

                                                                    </option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endif; ?>

                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2 d-flex align-items-end">
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm remove-dependency">Remove</button>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>

                                        <button type="button" class="btn btn-outline-primary btn-sm add-dependency">+ Add
                                            Dependency</button>

                                        
                                        <div class="row mb-2">
                                            <div class="form-group col-md-6">
                                                <label><strong>Affected Attribute <span
                                                            class="text-danger">*</span></strong></label>
                                                <select name="conditions[<?php echo e($loop->index); ?>][affected_attribute_id]"
                                                    class="form-control affected-attribute-select">
                                                    <option value="">-- Select Attribute --</option>
                                                    <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($attr['id']); ?>" <?php echo e($condition->affected_attribute_id == $attr['id'] ? 'selected' : ''); ?>>
                                                            <?php echo e($attr['name']); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <span class="text-danger validation-err affected_attribute_id-err"></span>
                                            </div>

                                            
                                            <div class="form-group col-md-6">
                                                <label><strong>Affected Value(s)</strong></label>
                                                <div class="scrollable-checkbox-box affected-values-checkboxes">
                                                    <?php if(isset($attributeValueMap[$condition->affected_attribute_id])): ?>
                                                        <?php $__currentLoopData = $attributeValueMap[$condition->affected_attribute_id]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php
                                                                // Get the existing affected value record
                                                                $affected = $condition->affectedValues->firstWhere('value_id', $val['id']);
                                                            ?>
                                                            <div class="form-check d-flex align-items-center mb-1">
                                                                <input type="checkbox"
                                                                    name="conditions[<?php echo e($loop->parent->index); ?>][affected_value_ids][]"
                                                                    value="<?php echo e($val['id']); ?>"
                                                                    id="value-<?php echo e($loop->parent->index); ?>-<?php echo e($val['id']); ?>" <?php echo e($affected ? 'checked' : ''); ?>>
                                                                <label class="form-check-label mr-2"
                                                                    for="value-<?php echo e($loop->parent->index); ?>-<?php echo e($val['id']); ?>">
                                                                    <?php echo e($val['value']); ?>

                                                                </label>

                                                                <input type="file"
                                                                    name="conditions[<?php echo e($loop->parent->index); ?>][value_images][<?php echo e($val['id']); ?>]"
                                                                    class="form-control-file ml-2 d-none browse-input" accept="image/*">

                                                                <select class="form-control ml-2" style="max-width: 120px;"
                                                                    name="conditions[<?php echo e($loop->parent->index); ?>][orientation][<?php echo e($val['id']); ?>]">
                                                                    <option value="">Orientation</option>
                                                                    <option value="landscape" <?php echo e((isset($affected) && $affected->orientation == 'landscape') ? 'selected' : ''); ?>>
                                                                        Landscape</option>
                                                                    <option value="portrait" <?php echo e((isset($affected) && $affected->orientation == 'portrait') ? 'selected' : ''); ?>>
                                                                        Portrait</option>
                                                                </select>

                                                                <?php if($affected && !empty($affected->image)): ?>
                                                                    <img src="<?php echo e(asset('storage/' . $affected->image)); ?>" alt="img"
                                                                        class="ml-2" style="width:40px; height:40px;">
                                                                <?php endif; ?>

                                                                <button type="button"
                                                                    class="btn btn-sm btn-outline-secondary ml-2 browse-btn">Browse</button>
                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <p class="text-muted">Select affected attribute to load values.</p>
                                                    <?php endif; ?>
                                                </div>
                                                <span class="text-danger validation-err affected_value_id-err"></span>
                                            </div>

                                        </div>

                                        <button type="button" class="btn btn-danger btn-sm remove-condition-btn">Remove</button>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <button type="button" id="add-more-condition" class="btn btn-outline-primary btn-sm">+ Add
                                More</button>

                            <div class="card-footer text-right">
                                <a href="<?php echo e(route('admin.images.index')); ?>" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <style>
            .scrollable-checkbox-box {
                border: 1px solid #ccc;
                border-radius: 4px;
                padding: 10px;
                max-height: 150px;
                overflow-y: auto;
                background-color: #fff;
            }
        </style>
<?php $__env->stopSection(); ?>

    <?php $__env->startPush('scripts'); ?>
            <script>
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // Handle form submit via AJAX
                $(document).on('submit', '#image-settings-form', function (e) {
                    e.preventDefault();
                    const $form = $(this);
                    const formData = new FormData(this);

                    $form.find('button[type="submit"]').attr('disabled', true);
                    $('.validation-err').html('');
                    $('input, select').removeClass('is-invalid');

                    $.ajax({
                        url: $form.attr('action'),
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (res) {
                            if (res.success) {
                                Swal.fire('Saved!', 'Image Setting saved successfully.', 'success');
                                setTimeout(() => window.location.href = "<?php echo e(route('admin.images.index')); ?>", 800);
                            } else {
                                $form.find('button[type="submit"]').attr('disabled', false);
                                Swal.fire(res.msgText || 'Something went wrong');
                            }
                        },
                        error: function (xhr) {
                            $form.find('button[type="submit"]').attr('disabled', false);
                            if (xhr.status === 422) {
                                const errors = xhr.responseJSON.errors;
                                Object.keys(errors).forEach(field => {
                                    const errorMessage = errors[field][0];
                                    $(`[name="${field}"]`).addClass('is-invalid');
                                    $(`#${field}-err`).html(errorMessage);
                                });
                            } else {
                                Swal.fire('Error', 'Something went wrong', 'error');
                            }
                        }
                    });
                });

                let conditionIndex = 1;

                $(document).ready(function () {

                    const subcategoryId = $('#subcategory-select').val();
                    if (subcategoryId) {
                        $.get(`/admin/subcategories/${subcategoryId}/attributes`, function (res) {
                            if (res.success) {
                                window.attributeValueMap = {};
                                window.attributesMap = {};

                                res.attributes.forEach(attr => {
                                    window.attributeValueMap[attr.id] = attr.values;
                                    window.attributesMap[attr.id] = attr.name;
                                });
                            }
                        });
                    }

                    $('#subcategory-select').change(function () {
                        const subcategoryId = $(this).val();
                        if (!subcategoryId) return;

                        $.get(`/admin/subcategories/${subcategoryId}/attributes`, function (res) {
                            if (res.success) {
                                window.attributeValueMap = {};

                                // Reset dropdowns
                                $('.dependency-attribute-select, .affected-attribute-select')
                                    .empty()
                                    .append(`<option value="">-- Select Attribute --</option>`);
                                $('.dependency-value-select').empty().append(`<option value="">-- Select Value --</option>`);

                                res.attributes.forEach(attr => {
                                    const option = `<option value="${attr.id}">${attr.name}</option>`;
                                    $('.dependency-attribute-select, .affected-attribute-select').append(option);

                                    // Store name + values
                                    window.attributeValueMap[attr.id] = attr.values;
                                    window.attributesMap = window.attributesMap || {};
                                    window.attributesMap[attr.id] = attr.name;
                                });

                            }
                        });
                    });

                    // Add dependency
                    $(document).on('click', '.add-dependency', function () {
                        const container = $(this).siblings('.dependencies-container');
                        const blockIndex = $(this).closest('.condition-block').index();
                        const depIndex = container.find('.dependency-row').length;

                        const newRow = `
                        <div class="dependency-row row mb-1">
                          <div class="form-group col-md-5">
                          <select name="conditions[${blockIndex}][dependencies][${depIndex}][attribute_id]"
                          class="form-control dependency-attribute-select">
                          <option value="">-- Select Attribute --</option>
                          </select>
                          </div>
                          <div class="form-group col-md-5">
                          <select name="conditions[${blockIndex}][dependencies][${depIndex}][value_id]"
                          class="form-control dependency-value-select">
                          <option value="">-- Select Value --</option>
                          </select>
                          </div>
                          <div class="form-group col-md-2 d-flex align-items-end">
                          <button type="button" class="btn btn-danger btn-sm remove-dependency">Remove</button>
                          </div>
                        </div>`;

                        container.append(newRow);

                        // Re-populate attributes for the new select
                        if (window.attributeValueMap) {
                            Object.keys(window.attributeValueMap).forEach(attrId => {
                                container.find('.dependency-attribute-select:last').append(
                                    `<option value="${attrId}">${window.attributesMap[attrId]}</option>`
                                );
                            });

                        }
                    });

                    // Remove dependency
                    $(document).on('click', '.remove-dependency', function () {
                        $(this).closest('.dependency-row').remove();
                    });

                    // When attribute changes, populate values
                    $(document).on('change', '.dependency-attribute-select', function () {
                        const attrId = $(this).val();
                        const valueSelect = $(this).closest('.dependency-row').find('.dependency-value-select');
                        valueSelect.empty().append(`<option value="">-- Select Value --</option>`);
                        if (window.attributeValueMap && window.attributeValueMap[attrId]) {
                            window.attributeValueMap[attrId].forEach(val => {
                                valueSelect.append(`<option value="${val.id}">${val.value}</option>`);
                            });
                        }
                    });


                    // Affected attribute change
                    $(document).on('change', '.affected-attribute-select', function () {
                        const attrId = $(this).val();
                        const container = $(this).closest('.condition-block').find('.affected-values-checkboxes');
                        container.empty();
                        if (window.attributeValueMap && window.attributeValueMap[attrId]) {
                            window.attributeValueMap[attrId].forEach(val => {
                                const checkboxWithFile = `
        <div class="form-check d-flex align-items-center mb-1">
          <input class="form-check-input mr-1" type="checkbox" 
            name="conditions[${conditionIndex - 1}][affected_value_ids][]" 
            value="${val.id}" id="value-${conditionIndex}-${val.id}">

          <label class="form-check-label mr-2" for="value-${conditionIndex}-${val.id}">
            ${val.value}
          </label>

          <input type="file" 
            name="conditions[${conditionIndex - 1}][value_images][${val.id}]"
            class="form-control-file ml-2 d-none browse-input"
            accept="image/*">

          <select class="form-control ml-2" style="max-width: 120px;"
            name="conditions[${conditionIndex - 1}][orientation][${val.id}]">
            <option value="">Orientation</option>
            <option value="landscape">Landscape</option>
            <option value="portrait">Portrait</option>
          </select>

          <button type="button" class="btn btn-sm btn-outline-secondary ml-2 browse-btn">
            Browse
          </button>
        </div>`;
                                container.append(checkboxWithFile);

                            });
                        }
                    });


                    // Add More Condition
                    $('#add-more-condition').click(function () {
                        const newBlock = $('.condition-block:first').clone();
                        newBlock.find('select, input').val('');
                        newBlock.find('input[type="hidden"][name*="[id]"]').val(''); // clear condition ID
                        newBlock.find('.affected-values-checkboxes').html('<p class="text-muted">Select values after choosing affected attribute.</p>');
                        newBlock.find('.remove-condition-btn').removeClass('d-none');

                        // Update name attributes with new index

                        newBlock.find('select, input').each(function () {
                            const name = $(this).attr('name');
                            if (name) {
                                const updatedName = name.replace(/\[\d+\]/g, `[${conditionIndex}]`);
                                $(this).attr('name', updatedName);
                            }
                        });


                        $('#conditions-container').append(newBlock);
                        conditionIndex++;
                    });

                    function toggleAffectedValuesVisibility() {
                        const action = $('#add-action').val();

                        if (action === 'hide_values' || action === 'show_values') {
                            $('#add-affected-values').show();
                        } else {
                            $('#add-affected-values').hide();
                        }
                    }

                    $('#add-action').on('change', function () {
                        toggleAffectedValuesVisibility();
                    });

                    // When Browse button clicked, trigger hidden file input
                    $(document).on('click', '.browse-btn', function () {
                        $(this).siblings('.browse-input').trigger('click');
                    });

                    // Show file name when selected
                    $(document).on('change', '.browse-input', function () {
                        const fileName = this.files[0] ? this.files[0].name : '';
                        if (fileName) {
                            $(this).siblings('.browse-btn').text(fileName);
                        } else {
                            $(this).siblings('.browse-btn').text('Browse');
                        }
                    });



                    // Remove Condition Block
                    $(document).on('click', '.remove-condition-btn', function () {
                        $(this).closest('.condition-block').remove();
                    });
                });
            </script>
    <?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/admin/images/edit.blade.php ENDPATH**/ ?>