

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
                  <li class="breadcrumb-item"><a href="<?php echo e(route('admin.images.index')); ?>">Image Settings</a></li>
                  <li class="breadcrumb-item active">
                    Add Setting
                  </li>
                </ol>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="content-body">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Add Image Setting</h4>
          </div>

          <div class="card-body">
            <form id="image-settings-form" method="POST" enctype="multipart/form-data"
              action="<?php echo e(route('admin.images.store')); ?>">
              <?php echo csrf_field(); ?>

              <div class="form-group">
                <label><strong>Subcategory <span class="text-danger">*</span></strong></label>
                <select name="subcategory_id" class="form-control" id="subcategory-select">
                  <option value="">-- Select Subcategory --</option>
                  <?php $__currentLoopData = $subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($subcategory->id); ?>" <?php echo e(old('subcategory_id', $condition->subcategory_id ?? '') == $subcategory->id ? 'selected' : ''); ?>>
                      <?php echo e($subcategory->name); ?>

                    </option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <span class="text-danger validation-err" id="subcategory_id-err"></span>
              </div>

              
              <div id="conditions-container">
                <div class="condition-block border rounded p-1 mb-1">
                  <div class="dependencies-container">
                    <div class="dependency-row row mb-1">
                      <div class="form-group col-md-5">
                        <label><strong>Attribute</strong></label>
                        <select name="conditions[0][dependencies][0][attribute_id]"
                          class="form-control dependency-attribute-select">
                          <option value="">-- Select Attribute --</option>
                        </select>
                      </div>
                      <div class="form-group col-md-5">
                        <label><strong>Value</strong></label>
                        <select name="conditions[0][dependencies][0][value_id]"
                          class="form-control dependency-value-select">
                          <option value="">-- Select Value --</option>
                        </select>
                      </div>
                      <div class="form-group col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger btn-sm remove-dependency d-none">Remove</button>
                      </div>

                    </div>
                  </div>
                  <button type="button" class="btn btn-outline-primary btn-sm add-dependency">+ Add Dependency</button>


                  <div class="row mb-2">
                    <div class="form-group col-md-6">
                      <label><strong>Affected Attribute <span class="text-danger">*</span></strong></label>
                      <select name="conditions[0][affected_attribute_id]" class="form-control affected-attribute-select">
                        <option value="">-- Select Attribute --</option>
                      </select>
                      <span class="text-danger validation-err affected_attribute_id-err"></span>
                    </div>

                    <div class="form-group col-md-6" id="add-affected-values">
                      <label><strong>Affected Value(s)</strong></label>
                      <div class="scrollable-checkbox-box affected-values-checkboxes">
                        <p class="text-muted">Select values after choosing affected attribute.</p>
                      </div>
                      <span class="text-danger validation-err affected_value_id-err"></span>
                    </div>
                  </div>

                  <button type="button" class="btn btn-danger btn-sm remove-condition-btn d-none">Remove</button>
                </div>
              </div>

              <button type="button" id="add-more-condition" class="btn btn-outline-primary btn-sm">+ Add More</button>
          </div>

          <div class="card-footer text-right">
            <a href="<?php echo e(route('admin.images.index')); ?>" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary"><?php echo e(isset($condition) ? 'Update' : 'Save'); ?></button>
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\pip_frames\resources\views/admin/images/create.blade.php ENDPATH**/ ?>