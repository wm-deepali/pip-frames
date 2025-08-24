

<?php $__env->startSection('content'); ?>
  <style>
    .remove-modifier,
    .add-modifier {
    margin-top: 10px;
    margin-right: 10px;
    }

    .per-page-row input {
    margin-bottom: 5px;
    }
  </style>

  <div class="app-content content">
    <div class="content-wrapper">
    <div class="content-header row mb-2">
      <div class="col-md-6">
      <h4 class="mb-0">Add Pricing Rule</h4>
      </div>
      <div class="col-md-6 text-right">
      <a href="<?php echo e(route('admin.pricing-rules.index')); ?>" class="btn btn-secondary btn-sm">← Back to List</a>
      </div>
    </div>

    <div class="content-body">
      <div class="card">
      <div class="card-body">
        <form method="POST" action="<?php echo e(route('admin.pricing-rules.store')); ?>" id="pricing-rule-form">
        <?php echo csrf_field(); ?>

        
        <div class="form-row">

          <div class="form-group col-md-3">
          <label>Category</label>
          <select class="form-control" id="category-select" name="category_id" required>
            <option value="">-- Select Category --</option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
          </div>

          <div class="form-group col-md-3">
          <label>Subcategory</label>
          <select class="form-control" id="subcategory-select" name="subcategory_id" required>
            <option value="">-- Select Subcategory --</option>
          </select>
          </div>


          <div class="form-group col-md-2">
          <label for="proof_reading_required">Proof Reading Required</label>
          <select class="form-control" name="proof_reading_required" id="proof_reading_required" required>
            <option value="">-- Select --</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
          </select>
          </div>

          <div class="form-group col-md-2">
          <label for="delivery_charges_required">Delivery Charges Required</label>
          <select class="form-control" name="delivery_charges_required" id="delivery_charges_required" required>
            <option value="">-- Select --</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
          </select>
          </div>

        </div>

        <!-- New row just for the checkbox -->
        <!-- <div class="form-row d-flex align-items-end" style="display: flex;"> -->

        <!-- <div class="form-group col-md-3">
      <label for="centralized_paper_rates">Apply Centralized Paper Rates</label>
      <select class="form-control" name="centralized_paper_rates" id="centralized_paper_rates" required>
      <option value="">-- Select --</option>
      <option value="1">Yes</option>
      <option value="0">No</option>
      </select>
      </div> -->

        <!-- <div class="form-group col-md-3">
      <label for="centralized_weight_rates">Apply Centralized Paper Weight-Based Rates</label>
      <select class="form-control" name="centralized_weight_rates" id="centralized_weight_rates" required>
      <option value="">-- Select --</option>
      <option value="1">Yes</option>
      <option value="0">No</option>
      </select>
      </div> -->
        <!--       
        <div class="form-group col-md-2" id="pages_dragger_required-wrapper" style="display: none;">
        <label for="pages_dragger_required">Pages Dragger Required</label>
        <select class="form-control" name="pages_dragger_required" id="pages_dragger_required">
        <option value="">-- Select --</option>
        <option value="1">Yes</option>
        <option value="0">No</option>
        </select>
        </div> -->

        <!-- <div class="form-group col-md-2">
        <label for="default_quantity">Default Quantity</label>
        <input type="number" name="default_quantity" id="default_quantity" class="form-control"
        placeholder="e.g. 1" min="1">
        </div>

        <div class="form-group col-md-2">
        <label for="min_quantity">Min Qty</label>
        <input type="number" name="min_quantity" id="min_quantity" class="form-control" min="1">
        </div> -->

        <!-- <div class="form-group col-md-2">
        <label for="max_quantity">Max Qty</label>
        <input type="number" name="max_quantity" id="max_quantity" class="form-control" min="1">
        </div>

      </div> -->

        <!-- <div id="pages-settings-group" style="display: none;" class="form-row">

        <div class="form-group col-md-2">
        <label for="pages-dragger-dependency">Dependency Attribute</label>
        <select id="pages-dragger-dependency" class="form-control" name="pages_dragger_dependency">
        <option value="">-- Select Attribute --</option>
        </select>
        </div>

        <div class="form-group col-md-2">
        <label for="default_pages">Default Pages</label>
        <input type="number" id="default_pages" name="default_pages" class="form-control" placeholder="e.g. 1"
        min="1">
        </div>

        <div class="form-group col-md-2">
        <label for="min_pages">Min Pages</label>
        <input type="number" id="min_pages" name="min_pages" class="form-control" min="1">
        </div>

        <div class="form-group col-md-2">
        <label for="max_pages">Max Pages</label>
        <input type="number" id="max_pages" name="max_pages" class="form-control" min="1">
        </div>

      </div> -->

        <hr>

        
        <h6>Attribute Modifiers</h6>
        <div id="attribute-modifier-container">
          <p class="text-muted">Select a subcategory to load attributes.</p>
        </div>

        <button type="button" class="btn btn-success mt-2" id="save-pricing-rule-btn">Save Pricing Rule</button>
        </form>
      </div>
      </div>
    </div>
    </div>
  </div>

  <script>
    const categoryMap = <?php echo json_encode($categories->mapWithKeys(fn($cat) => [$cat->id => $cat->subcategories->map(fn($s) => ['id' => $s->id, 'name' => $s->name])]), 512) ?>;
    let subcategoryAttributes = [];
    let rowIndex = 0;

    document.getElementById('category-select').addEventListener('change', function () {
    const subSelect = document.getElementById('subcategory-select');
    subSelect.innerHTML = '<option value="">-- Select Subcategory --</option>';
    const subs = categoryMap[this.value] || [];

    subs.forEach(sub => {
      const option = document.createElement('option');
      option.value = sub.id;
      option.textContent = sub.name;
      subSelect.appendChild(option);
    });

    document.getElementById('attribute-modifier-container').innerHTML = '<p class="text-muted">Select a subcategory to load attributes.</p>';
    });

    // document.getElementById('pages_dragger_required').addEventListener('change', function () {
    // const pagesSettingsGroup = document.getElementById('pages-settings-group');
    // const select = document.getElementById('pages-dragger-dependency');

    // if (this.value === '1') {
    //   pagesSettingsGroup.style.display = 'flex'; // or 'block' based on your layout

    //   // Reset and populate the select dropdown
    //   select.innerHTML = '<option value="">-- Select Attribute --</option>';
    //   subcategoryAttributes.forEach(attr => {
    //   if (!attr.is_composite && attr.values?.length) {
    //     const option = document.createElement('option');
    //     option.value = attr.id;
    //     option.textContent = attr.name;
    //     select.appendChild(option);
    //   }
    //   });

    // } else {
    //   pagesSettingsGroup.style.display = 'none';
    // }
    // });




    document.getElementById('subcategory-select').addEventListener('change', function () {
    const subcategoryId = this.value;
    if (!subcategoryId) return;

    fetch(`/admin/subcategories/${subcategoryId}/attributes`)
      .then(res => res.json())
      .then(data => {
      subcategoryAttributes = data.attributes || [];
      renderAttributeRows();

      // 👇 Show the checkbox now that attributes are available
      document.getElementById('pages_dragger_required-wrapper').style.display = 'block';

      // Optionally reset previous selection
      document.getElementById('pages_dragger_required').value = '0';
      document.getElementById('pages-settings-group').style.display = 'none';
      });

    });

    function renderAttributeRows() {
    const container = document.getElementById('attribute-modifier-container');
    container.innerHTML = '';
    if (subcategoryAttributes.length === 0) {
      container.innerHTML = '<p class="text-muted">No attributes available for this subcategory.</p>';
      return;
    }
    const row = createAttributeRow();
    container.appendChild(row);
    updateButtons('#attribute-modifier-container', 'attribute-row', 'add-modifier', 'remove-modifier', '.modifier-buttons');
    }

    function createAttributeRow(index = rowIndex++) {
    const row = document.createElement('div');
    row.className = 'form-row attribute-row border rounded p-2 mb-2 position-relative';
    const timestamp = Date.now();
    const defaultId = `default_${timestamp}`;

    row.innerHTML = `
      <div class="form-group col-md-2">
      <label>Attribute</label>
      <select class="form-control attribute-select" name="rows[${index}][attribute_id]">
      <option value="">-- Select --</option>
      ${subcategoryAttributes.map(attr => `<option value="${attr.id}">${attr.name}</option>`).join('')}
      </select>
      </div>


    <!-- Value Select -->
    <div class="form-group col-md-2 value-select-group">
    <label>Value</label>
    <select class="form-control" name="rows[${index}][value_id]">
      <option value="">-- Select --</option>
       ${subcategoryAttributes[0]?.values.map(val => `<option value="${val.id}">${val.value}</option>`).join('') || ''}
    </select>
    </div>

    <!-- Max Width & Height (for select_area only) -->
    <div class="form-group col-md-1 max-dimensions-group" style="display: none;">
    <label>Max Width</label>
    <input type="number" class="form-control" name="rows[${index}][max_width]">
    </div>

    <div class="form-group col-md-1 max-dimensions-group" style="display: none;">
    <label>Max Height</label>
    <input type="number" class="form-control" name="rows[${index}][max_height]">
    </div>


    <div class="dependency-group" style="display: none;"></div>

    <div class="form-group col-md-2 modifier-type-group" style="display: none;">
      <label>Modifier Type</label>
      <select class="form-control" name="rows[${index}][modifier_type]">
      <option value="add">Add</option>
      <option value="multiply">Multiply</option>
      </select>
      </div>

    <div class="form-group col-md-2 base-charges-group" style="display: none;">
      <label>Base Charges</label>
      <div class="input-group">
      <input type="text" class="form-control" name="rows[${index}][modifier_value]">
      </div>
      </div>

      <div class="form-group col-md-2 fixed-per-page-group" style="display: none;">
       <label>Price per Page (Fixed)</label>
      <div class="input-group">
      <input type="text" class="form-control" name="rows[${index}][flat_rate_per_page]">
      </div>
      </div>

     <div class="form-group col-md-2 extra-copy-group" style="display: none;">
      <label>Extra Copy Charge</label>
      <div class="input-group">
      <input type="text" class="form-control" name="rows[${index}][extra_copy_charge]">
      <select class="form-control col-auto" name="rows[${index}][extra_copy_charge_type]" style="max-width: 100px;">
      <option value="amount">amount</option>
      <option value="percentage">%</option>
      </select>
      </div>
      </div>

      <div class="form-group col-md-1 d-flex align-items-center justify-content-center mt-2">
      <div class="custom-control custom-checkbox">
      <input type="checkbox" class="custom-control-input default-checkbox" id="${defaultId}" name="rows[${index}][is_default]" value="1">
      <label class="custom-control-label" for="${defaultId}" title="Mark this value as default">Default</label>
      </div>
      </div>

      <div class="form-group col-md-1 d-flex align-items-center modifier-buttons"></div>

      <div class="col-md-12 per-page-container mt-2" style="display: none;">
      <label class="font-weight-bold">Pricing</label>
      <div class="per-page-wrapper">
      <div class="form-row per-page-row">
      <div class="form-group col-md-3">
      <input type="number" class="form-control" name="rows[${index}][per_page_pricing][0][quantity_from]" placeholder="From">
      </div>
      <div class="form-group col-md-3">
      <input type="number" class="form-control" name="rows[${index}][per_page_pricing][0][quantity_to]" placeholder="To">
      </div>
      <div class="form-group col-md-3">
      <input type="text" class="form-control" name="rows[${index}][per_page_pricing][0][price]" placeholder="Price">
      </div>
      <div class="form-group col-md-3 d-flex align-items-center">
      <button type="button" class="btn btn-sm btn-primary add-per-page">+ Add</button>
      </div>
      </div>
      </div>
      </div>
    `;
    return row;
    }

    function updateButtons(containerSelector, rowClass, addClass, removeClass, buttonGroupSelector) {
    const rows = document.querySelectorAll(`.${rowClass}`);
    rows.forEach((row, index) => {
      const btnGroup = row.querySelector(buttonGroupSelector);
      btnGroup.innerHTML = '';

      if (index !== 0) {
      const removeBtn = document.createElement('button');
      removeBtn.type = 'button';
      removeBtn.className = `btn btn-sm btn-danger ${removeClass}`;
      removeBtn.textContent = '- Remove';
      btnGroup.appendChild(removeBtn);
      }

      if (index === rows.length - 1) {
      const addBtn = document.createElement('button');
      addBtn.type = 'button';
      addBtn.className = `btn btn-sm btn-primary ${addClass}`;
      addBtn.textContent = '+ Add';
      btnGroup.appendChild(addBtn);
      }
    });
    }

    document.addEventListener('change', function (e) {
    if (e.target.name?.includes('[attribute_id]')) {
      const attrId = e.target.value;
      const selectedAttr = subcategoryAttributes.find(attr => attr.id == attrId);
      const row = e.target.closest('.attribute-row');

      const inputType = selectedAttr?.input_type;
      const valueSelectGroup = row.querySelector('.value-select-group');
      const dimensionInputs = row.querySelectorAll('.max-dimensions-group');

      if (inputType === 'select_area') {
      if (valueSelectGroup) valueSelectGroup.style.display = 'none';
      dimensionInputs.forEach(el => {
        el.style.display = 'block';
        // Update unit label here for width and height:
        const label = el.querySelector('label');
        if (label) {
        if (label.textContent.toLowerCase().includes('max width')) {
          label.textContent = `Max Width (${selectedAttr.area_unit ?? 'unit'})`;
        } else if (label.textContent.toLowerCase().includes('max height')) {
          label.textContent = `Max Height (${selectedAttr.area_unit ?? 'unit'})`;
        }
        }
      });
      const baseChargesGroup = row.querySelector('.base-charges-group');
      if (baseChargesGroup) {
        const baseChargeLabel = baseChargesGroup.querySelector('label');
        if (baseChargeLabel) {
        baseChargeLabel.textContent = `Base charges (${selectedAttr?.area_unit ?? 'unit'})`;
        }
      }
      } else {
      if (valueSelectGroup) valueSelectGroup.style.display = 'block';
      dimensionInputs.forEach(el => el.style.display = 'none');
      }

      // Update value options
      const valueSelect = row.querySelector('select[name*="[value_id]"]');
      valueSelect.innerHTML = selectedAttr?.values
      .filter(v => !v.is_composite_value) // 👈 Only include values where is_composite_value is false
      .map(v => `<option value="${v.id}">${v.value}</option>`)
      .join('') || '';

      // dependency-group
      if (Array.isArray(selectedAttr?.dependency_parents) && selectedAttr.dependency_parents.length > 0) {

      const attrName = row.querySelector('select[name*="[attribute_id]"]').name;
      const attrIndex = attrName.match(/rows\[(\d+)\]/)[1];

      // Find the "Value" field's parent form-group
      const valueField = row.querySelector('select[name*="[value_id]"]');
      const valueGroup = valueField.closest('.form-group');

      selectedAttr.dependency_parents.forEach((parentId) => {
        const parentAttr = subcategoryAttributes.find(attr => attr.id == parentId);
        if (!parentAttr) return;

        const values = parentAttr.values?.filter(v => !v.is_composite_value) || [];

        if (values.length > 0) {
        const selectName = `rows[${attrIndex}][dependency_value_ids][${parentId}]`;

        const wrapper = document.createElement('div');
        wrapper.className = 'form-group col-md-2 dependency-select';
        wrapper.innerHTML = `
      <label>Depends on "${parentAttr.name}"</label>
      <select class="form-control" name="${selectName}">
      <option value="">-- Select --</option>
      ${values.map(v => `<option value="${v.id}">${v.value}</option>`).join('')}
      </select>
    `;

        // Insert AFTER the valueGroup
        valueGroup.after(wrapper);
        }
      });

      }

      // Show/hide Per Page Pricing
      const perPageSection = row.querySelector('.per-page-container');
      if (['per_page', 'per_product'].includes(selectedAttr?.pricing_basis)) {
      perPageSection.style.display = 'block';
      const pricingLabel = perPageSection.querySelector('label.font-weight-bold');
      if (pricingLabel) {
        pricingLabel.textContent = selectedAttr?.pricing_basis === 'per_product'
        ? 'Per Product Pricing'
        : 'Per Page Pricing';
      }
      } else {
      perPageSection.style.display = 'none';
      }


      // Show/hide Modifier Type + Base Charges if has_setup_charge === true + Extra Copy Charge
      const extraCopySection = row.querySelector('.extra-copy-group');
      const modifierGroup = row.querySelector('.modifier-type-group');
      const baseChargesGroup = row.querySelector('.base-charges-group');
      const showSetupFields = selectedAttr?.has_setup_charge === true;
      const fixedPriceSection = row.querySelector('.fixed-per-page-group');

      fixedPriceSection.style.display = selectedAttr?.pricing_basis === 'fixed_per_page' ? 'block' : 'none';
      extraCopySection.style.display = selectedAttr?.pricing_basis === 'per_extra_copy' ? 'block' : 'none';
      modifierGroup.style.display = showSetupFields ? 'block' : 'none';
      baseChargesGroup.style.display = showSetupFields ? 'block' : 'none';
    }



    if (e.target.classList.contains('default-checkbox')) {
      const currentRow = e.target.closest('.attribute-row');
      const attrId = currentRow.querySelector('select[name*="[attribute_id]"]').value;

      document.querySelectorAll('.attribute-row').forEach(row => {
      const attrSelect = row.querySelector('select[name*="[attribute_id]"]');
      const checkbox = row.querySelector('.default-checkbox');
      if (row !== currentRow && attrSelect?.value === attrId) {
        checkbox.checked = false;
      }
      });
    }
    });

    document.addEventListener('click', function (e) {
    if (e.target.classList.contains('add-modifier')) {
      e.preventDefault();
      const container = document.getElementById('attribute-modifier-container');
      const row = createAttributeRow();
      container.appendChild(row);
      updateButtons('#attribute-modifier-container', 'attribute-row', 'add-modifier', 'remove-modifier', '.modifier-buttons');
    }

    if (e.target.classList.contains('remove-modifier')) {
      e.preventDefault();
      e.target.closest('.attribute-row').remove();
      updateButtons('#attribute-modifier-container', 'attribute-row', 'add-modifier', 'remove-modifier', '.modifier-buttons');
    }

    if (e.target.classList.contains('add-per-page')) {
      e.preventDefault();
      const wrapper = e.target.closest('.per-page-wrapper');
      const rows = wrapper.querySelectorAll('.per-page-row');
      const lastIndex = rows.length;
      const newRow = rows[0].cloneNode(true);
      newRow.querySelectorAll('input').forEach(input => input.value = '');
      newRow.querySelector('.add-per-page').outerHTML = '<button type="button" class="btn btn-sm btn-danger remove-per-page">- Remove</button>';


      const parentAttrIndex = wrapper.closest('.attribute-row')
      .querySelector('select[name*="[attribute_id]"]')
      .name.match(/rows\[(\d+)\]/)[1]; // get parent row index

      newRow.querySelectorAll('input').forEach(input => {
      const name = input.name;
      const updated = name.replace(
        /rows\[\d+\]\[per_page_pricing\]\[\d+\]/,
        `rows[${parentAttrIndex}][per_page_pricing][${lastIndex}]`
      );
      input.name = updated;
      });


      wrapper.appendChild(newRow);
    }

    if (e.target.classList.contains('remove-per-page')) {
      e.preventDefault();
      e.target.closest('.per-page-row').remove();
    }
    });

  </script>

  <?php $__env->startPush('scripts'); ?>
    <script>
    $(document).ready(function () {
    $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#save-pricing-rule-btn').on('click', function () {
      const $btn = $(this);
      const form = $('#pricing-rule-form')[0];

      // Remove invalid per_page_pricing inputs before sending
      $('.attribute-row').each(function () {
      const pricingContainer = $(this).find('.per-page-container');
      const attrSelect = $(this).find('select[name*="[attribute_id]"]');
      const attrId = attrSelect.val();
      const selectedAttr = subcategoryAttributes.find(attr => attr.id == attrId);

      if (!['per_page', 'per_product'].includes(selectedAttr?.pricing_basis)) {
      pricingContainer.find('input, select').each(function () {
      $(this).prop('disabled', true); // prevents submission
      });
      }
      });

      const formData = new FormData(form);
      $btn.prop('disabled', true);
      $('input, select').removeClass('is-invalid');
      $('.invalid-feedback').remove();

      $.ajax({
      url: "<?php echo e(route('admin.pricing-rules.store')); ?>",
      method: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function (res) {
      if (res.success) {
      Swal.fire('Saved!', res.message || 'Pricing rule created successfully.', 'success');
      setTimeout(() => {
        window.location.href = res.redirect;
      }, 800);
      } else {
      $btn.prop('disabled', false);
      Swal.fire('Error', res.message || 'Something went wrong', 'error');
      }
      },
      error: function (xhr) {
      $btn.prop('disabled', false);
      const errors = xhr.responseJSON.errors || {};
      for (const key in errors) {
      const fieldName = key.replace(/\.\d+/g, '[]');
      const msg = errors[key][0];
      const input = $(`[name="${fieldName}"]`).first();
      input.addClass('is-invalid');
      if (input.length && input.next('.invalid-feedback').length === 0) {
        input.after(`<div class="invalid-feedback">${msg}</div>`);
      }
      }
      }
      });
    });
    });
    </script>
  <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\new\resources\views/admin/pricing-rules/create.blade.php ENDPATH**/ ?>