@extends('layouts.master')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

@section('content')
    <style>
        .remove-modifier,
        .add-modifier {
            margin-top: 10px;
            margin-right: 10px;
        }

        .per-page-row input {
            margin-bottom: 5px;
        }

        .form-check {
            padding-top: 0.65rem;
            padding-left: 1.25rem;
        }

        label {
            font-weight: 500;
            font-size: 0.875rem;
        }

        .toggle-pricing {
            cursor: pointer;
            margin-left: 10px;
            font-size: 2rem;
            font-weight: 700;
            color: #fff;
            background: #EA5455;
            padding: 10px 15px;
            border-radius: 4px;
            margin-top: 20px;


        }
    </style>

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-2">
                <div class="col-md-6">
                    <h4 class="mb-0">Edit Pricing Rule</h4>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ route('admin.pricing-rules.index') }}" class="btn btn-secondary btn-sm">← Back to List</a>
                </div>
            </div>

            <div class="content-body">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.pricing-rules.update', $pricingRule->id) }}"
                            id="pricing-rule-form">
                            @csrf
                            @method('PUT')

                            {{-- Category & Subcategory --}}
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label>Category</label>
                                    <div class="form-control-plaintext">{{ $pricingRule->category->name }}</div>
                                    <input type="hidden" name="category_id" value="{{ $pricingRule->category_id }}">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Subcategory</label>
                                    <div class="form-control-plaintext">{{ $pricingRule->subcategory->name }}</div>
                                    <input type="hidden" name="subcategory_id" value="{{ $pricingRule->subcategory_id }}">
                                </div>


                                <div class="form-group col-md-2">
                                    <label for="proof_reading_required">Proof Reading Required</label>
                                    <select class="form-control" name="proof_reading_required" id="proof_reading_required"
                                        required>
                                        <option value="">-- Select --</option>
                                        <option value="1" {{ $pricingRule->proof_reading_required ? 'selected' : '' }}>Yes
                                        </option>
                                        <option value="0" {{ !$pricingRule->proof_reading_required ? 'selected' : '' }}>No
                                        </option>
                                    </select>
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="delivery_charges_required">Delivery Charges Required</label>
                                    <select class="form-control" name="delivery_charges_required"
                                        id="delivery_charges_required" required>
                                        <option value="">-- Select --</option>
                                        <option value="1" {{ $pricingRule->delivery_charges_required ? 'selected' : '' }}>
                                            Yes</option>
                                        <option value="0" {{ !$pricingRule->delivery_charges_required ? 'selected' : '' }}>
                                            No</option>
                                    </select>
                                </div>
                            </div>

                            <!-- <div class="form-row d-flex align-items-end" style="display: flex;"> -->

                                <!-- <div class="form-group col-md-3">
                                        <label for="centralized_paper_rates">Apply Centralized Paper Rates</label>
                                        <select class="form-control" name="centralized_paper_rates" id="centralized_paper_rates"
                                            required>
                                            <option value="">-- Select --</option>
                                            <option value="1" {{ $pricingRule->centralized_paper_rates ? 'selected' : '' }}>Yes
                                            </option>
                                            <option value="0" {{ !$pricingRule->centralized_paper_rates ? 'selected' : '' }}>No
                                            </option>
                                        </select>
                                    </div> -->

                                <!-- <div class="form-group col-md-3">
                                        <label for="centralized_weight_rates">Apply Centralized Paper Weight-Based Rates</label>
                                        <select class="form-control" name="centralized_weight_rates"
                                            id="centralized_weight_rates" required>
                                            <option value="">-- Select --</option>
                                            <option value="1" {{ $pricingRule->centralized_weight_rates ? 'selected' : '' }}>Yes
                                            </option>
                                            <option value="0" {{ !$pricingRule->centralized_weight_rates ? 'selected' : '' }}>No
                                            </option>
                                        </select>
                                    </div> -->

                                <!-- <div class="form-group col-md-2" id="pages_dragger_required-wrapper">
                                        <label for="pages_dragger_required">Pages Dragger Required</label>
                                        <select class="form-control" name="pages_dragger_required" id="pages_dragger_required">
                                            <option value="">-- Select --</option>
                                            <option value="1" {{ $pricingRule->pages_dragger_required ? 'selected' : '' }}>Yes
                                            </option>
                                            <option value="0" {{ !$pricingRule->pages_dragger_required ? 'selected' : '' }}>No
                                            </option>
                                        </select>
                                    </div> -->

                                <!-- <div class="form-group col-md-2">
                                        <label for="default_quantity">Default Quantity</label>
                                        <input type="number" name="default_quantity" id="default_quantity" class="form-control"
                                            placeholder="e.g. 1" min="1" value="{{ $pricingRule->default_quantity }}">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="min_quantity">Min Qty</label>
                                        <input type="number" name="min_quantity" id="min_quantity" class="form-control" min="1"
                                            value="{{ $pricingRule->min_quantity }}">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="max_quantity">Max Qty</label>
                                        <input type="number" name="max_quantity" id="max_quantity" class="form-control" min="1"
                                            value="{{ $pricingRule->max_quantity }}">
                                    </div> -->

                            <!-- </div> -->
                            <!-- 
                                <div id="pages-settings-group"
                                    style="{{ $pricingRule->pages_dragger_required ? '' : 'display:none;'}}" class="form-row">

                                    <div class="form-group col-md-2">
                                        <label for="pages-dragger-dependency">Dependent Attribute</label>
                                        <select name="pages_dragger_dependency" id="pages-dragger-dependency"
                                            class="form-control">
                                            <option value="">-- Select Attribute --</option>
                                            @foreach($subcategoryAttributes as $attr)
                                                @if(count($attr['values']))
                                                    <option value="{{ $attr['id'] }}" {{ $pricingRule->pages_dragger_dependency == $attr['id'] ? 'selected' : '' }}>
                                                        {{ $attr['name'] }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="default_pages">Default Number of Pages</label>
                                        <input type="number" id="default_pages" name="default_pages" class="form-control"
                                            placeholder="e.g. 1" min="1" value="{{ $pricingRule->default_pages }}">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="min_pages">Min Pages</label>
                                        <input type="number" id="min_pages" name="min_pages" class="form-control" min="1"
                                            value="{{ $pricingRule->min_pages }}">
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="max_pages">Max Pages</label>
                                        <input type="number" id="max_pages" name="max_pages" class="form-control" min="1"
                                            value="{{ $pricingRule->max_pages }}">
                                    </div>

                                </div> -->
                            <hr>

                            {{-- Attribute Modifiers --}}
                            <h6>Attribute Modifiers</h6>
                            <input type="hidden" name="deleted_ids[]" id="deleted-ids">
                            <div id="attribute-modifier-container">
                                @foreach($pricingRule->attributes as $index => $mod)
                                    <div class="form-row attribute-row border rounded p-2 mb-2 position-relative">
                                        {{-- Hidden ID input for tracking existing modifier --}}
                                        <input type="hidden" name="rows[{{ $index }}][id]" value="{{ $mod->id }}">
                                        <div class="form-group d-flex">

                                            @if($mod->quantityRanges->count() > 0)
                                                <span class="toggle-pricing" data-target="#pricing-container-{{ $index }}"
                                                    style="cursor: pointer; margin-left: 10px; font-size: 1rem;">+ </span>
                                            @endif

                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>
                                                <!--@if($mod->quantityRanges->count() > 0)-->
                                                <!--    <span class="toggle-pricing" data-target="#pricing-container-{{ $index }}" style="cursor: pointer; margin-left: 10px; font-size: 1rem;">+ </span>-->
                                                <!--@endif-->
                                                Attribute
                                            </label>
                                            <select class="form-control" name="rows[{{ $index }}][attribute_id]">
                                                @foreach($subcategoryAttributes as $attr)
                                                    <option value="{{ $attr['id'] }}" {{ $attr['id'] == $mod->attribute_id ? 'selected' : '' }}> {{ $attr['name'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>


                                        @php
                                            $selectedAttr = $subcategoryAttributes->firstWhere('id', $mod->attribute_id);
                                            $selectedDepValues = $mod->dependencies->pluck('parent_value_id', 'parent_attribute_id')->toArray();

                                        @endphp

                                        {{-- Attribute Value Select --}}
                                        <div class="form-group col-md-2 value-select-group">
                                            <label>Value</label>
                                            <select class="form-control" name="rows[{{ $index }}][value_id]"
                                                data-selected="{{ $mod->value_id }}"
                                                data-dependencies='@json($selectedDepValues)'>
                                                @foreach($selectedAttr->values ?? [] as $val)
                                                    <option value="{{ $val['id'] }}" {{ $val['id'] == $mod->value_id ? 'selected' : '' }}> {{ $val['value'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- Max Width & Height for select_area --}}
                                        <div class="form-group col-md-1 max-dimensions-group" style="display: none;">
                                            <label>
                                                Max Width ({{ $mod->attribute->area_unit ?? 'unit' }})
                                            </label>
                                            <input type="number" class="form-control" name="rows[{{ $index }}][max_width]"
                                                value="{{ $mod->max_width ?? '' }}">
                                        </div>

                                        <div class="form-group col-md-1 max-dimensions-group" style="display: none;">
                                            <label>Max Height ({{ $mod->attribute->area_unit ?? 'unit' }})</label>
                                            <input type="number" class="form-control" name="rows[{{ $index }}][max_height]"
                                                value="{{ $mod->max_height ?? '' }}">
                                        </div>


                                        <div class="form-group col-md-2 modifier-type-group" style="display: none;">
                                            <label>Modifier Type</label>
                                            <select class="form-control" name="rows[{{ $index }}][modifier_type]">
                                                <option value="add" {{ $mod->price_modifier_type == 'add' ? 'selected' : '' }}>Add
                                                </option>
                                                <option value="multiply" {{ $mod->price_modifier_type == 'multiply' ? 'selected' : '' }}>Multiply</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-2 base-charges-group" style="display: none;">
                                            <label>
                                                Base charges ({{ $mod->attribute->area_unit ?? 'unit' }})
                                            </label>
                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                    name="rows[{{ $index }}][modifier_value]"
                                                    value="{{ $mod->price_modifier_value }}">

                                            </div>
                                        </div>

                                        <div class="form-group col-md-2 fixed-per-page-group" style="display: none;">
                                            <label>Price per Page (Fixed)</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                    name="rows[{{ $index }}][flat_rate_per_page]"
                                                    value="{{ $mod->flat_rate_per_page }}">
                                            </div>
                                        </div>

                                        <div class="form-group col-md-2 extra-copy-group" style="display: none;">
                                            <label>Extra Copy Charge</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                    name="rows[{{ $index }}][extra_copy_charge]"
                                                    value="{{ $mod->extra_copy_charge }}">
                                                <select class="form-control col-auto"
                                                    name="rows[{{ $index }}][extra_copy_charge_type]" style="max-width: 100px;">
                                                    <option value="">Select Type</option>
                                                    <option value="amount" {{ $mod->extra_copy_charge_type === 'amount' ? 'selected' : '' }}>Amount</option>
                                                    <option value="percentage" {{ $mod->extra_copy_charge_type === 'percentage' ? 'selected' : '' }}>%</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-1 d-flex align-items-center justify-content-center mt-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="default_{{ $index }}"
                                                    name="rows[{{ $index }}][is_default]" value="1" {{ $mod->is_default ? 'checked' : '' }}><label class="custom-control-label"
                                                    for="default_{{ $index }}" title="Mark this value as default">
                                                    Default
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-1 d-flex align-items-end modifier-buttons"></div>

                                        <div class="col-md-12 per-page-container mt-2" id="pricing-container-{{ $index }}"
                                            style="display: none;">
                                            <label class="font-weight-bold">Per Product Pricing</label>
                                            <div class="per-page-wrapper">
                                                @foreach($mod->quantityRanges as $qIndex => $range)
                                                    <div class="form-row per-page-row">
                                                        <input type="hidden"
                                                            name="rows[{{ $index }}][per_page_pricing][{{ $qIndex }}][id]"
                                                            value="{{ $range->id }}">
                                                        <div class="form-group col-md-3">
                                                            <input type="number" class="form-control"
                                                                name="rows[{{ $index }}][per_page_pricing][{{ $qIndex }}][quantity_from]"
                                                                placeholder="From" value="{{ $range->quantity_from }}">
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <input type="number" class="form-control"
                                                                name="rows[{{ $index }}][per_page_pricing][{{ $qIndex }}][quantity_to]"
                                                                placeholder="To" value="{{ $range->quantity_to }}">
                                                        </div>
                                                        <div class="form-group col-md-3">
                                                            <input type="text" class="form-control"
                                                                name="rows[{{ $index }}][per_page_pricing][{{ $qIndex }}][price]"
                                                                placeholder="Price" value="{{ $range->price }}">
                                                        </div>
                                                        <div class="form-group col-md-3 d-flex align-items-center">
                                                            @if ($qIndex === 0)
                                                                <button type="button" class="btn btn-sm btn-primary add-per-page">+
                                                                    Add</button>
                                                            @else <button type="button"
                                                                class="btn btn-sm btn-danger remove-per-page">− Remove</button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            </div>

                            <button type="button" class="btn btn-success mt-2" id="save-pricing-rule-btn">Update Pricing
                                Rule</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let subcategoryAttributes = @json($subcategoryAttributes);

        function createAttributeRow(index) {
            const attrOptions = subcategoryAttributes.map(attr => `<option value="${attr.id}">${attr.name}</option>`).join('');
            const defaultValues = subcategoryAttributes[0]?.values || [];
            const valueOptions = defaultValues.map(val => `<option value="${val.id}">${val.value}</option>`).join('');
            const row = document.createElement('div');

            row.className = 'form-row attribute-row border rounded p-2 mb-2 position-relative';
            row.dataset.index = index;

            row.innerHTML = `
                                                                                                                                                                                            <div class="form-group col-md-2">
                                                                                                                                                                                                <label> 
                                                                                                                                                                                                    @if(false) <!-- This is a placeholder; actual condition handled in Blade -->
                                                                                                                                                                                                        <span class="toggle-pricing" data-target="#pricing-container-${index}" style="cursor: pointer; margin-left: 10px; font-size: 1rem;">+ </span>
                                                                                                                                                                                                    @endif
                                                                                                                                                                                                    Attribute
                                                                                                                                                                                                </label>
                                                                                                                                                                                                <select class="form-control" name="rows[${index}][attribute_id]">
                                                                                                                                                                                                    <option value="">-- Select --</option>
                                                                                                                                                                                                    ${attrOptions}
                                                                                                                                                                                                </select>
                                                                                                                                                                                            </div>
                                                                                                                                                                                            <!-- Value Select -->
                                                    <div class="form-group col-md-2 value-select-group">
                                                        <label>Value</label>
                                                        <select class="form-control" name="rows[${index}][value_id]">
                                                            <option value="">-- Select --</option>
                                                            ${valueOptions}
                                                        </select>
                                                    </div>

                                                    <!-- Max Width & Height (for select_area) -->
                                                    <div class="form-group col-md-1 max-dimensions-group" style="display: none;">
                                                        <label>Max Width</label>
                                                        <input type="number" class="form-control" name="rows[${index}][max_width]">
                                                    </div>

                                                    <div class="form-group col-md-1 max-dimensions-group" style="display: none;">
                                                        <label>Max Height</label>
                                                        <input type="number" class="form-control" name="rows[${index}][max_height]">
                                                    </div>



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
                                                                                                                                                                                        <input type="text" class="form-control"
                                                                                                                                                                                            name="rows[${index}][flat_rate_per_page]">
                                                                                                                                                                                    </div>
                                                                                                                                                                                </div>
                                                                                                                                                                                            <div class="form-group col-md-2 extra-copy-group" style="display: none;">
                                                                                                                                                                                                <label>Extra Copy Charge</label>
                                                                                                                                                                                                <div class="input-group">
                                                                                                                                                                                                    <input type="text" class="form-control" name="rows[${index}][extra_copy_charge]">
                                                                                                                                                                                                    <select class="form-control col-auto" name="rows[${index}][extra_copy_charge_type]" style="max-width: 100px;">
                                                                                                                                                                                                        <option value="">Select Type</option>
                                                                                                                                                                                                        <option value="amount">Amount</option>
                                                                                                                                                                                                        <option value="percentage">%</option>
                                                                                                                                                                                                    </select>
                                                                                                                                                                                                </div>
                                                                                                                                                                                            </div>
                                                                                                                                                                                            <div class="form-group col-md-1 d-flex align-items-center justify-content-center mt-2">
                                                                                                                                                                                                <div class="custom-control custom-checkbox">
                                                                                                                                                                                                    <input type="checkbox" class="custom-control-input" id="default_${index}" name="rows[${index}][is_default]" value="1">
                                                                                                                                                                                                    <label class="custom-control-label" for="default_${index}" title="Mark this value as default">Default</label>
                                                                                                                                                                                                </div>
                                                                                                                                                                                            </div>
                                                                                                                                                                                            <div class="form-group col-md-1 d-flex align-items-end modifier-buttons"></div>
                                                                                                                                                                                            <div class="col-md-12 per-page-container mt-2" id="pricing-container-${index}" style="display: none;">
                                                                                                                                                                                                <label class="font-weight-bold">Per Product Pricing</label>
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


        function handleAttributeChange(row, isInitial = false) {
            const attributeSelect = row.querySelector('select[name*="[attribute_id]"]');
            const attrId = attributeSelect?.value;
            const selectedAttr = subcategoryAttributes.find(attr => attr.id == attrId);

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

            const valueSelect = row.querySelector('select[name*="[value_id]"]');
            const selectedValueId = valueSelect?.dataset.selected;
            valueSelect.innerHTML = selectedAttr?.values
                .filter(v => !v.is_composite_value)
                .map(v => {
                    const selected = v.id == selectedValueId ? 'selected' : '';
                    return `<option value="${v.id}" ${selected}>${v.value}</option>`;
                })
                .join('') || '';


            if (Array.isArray(selectedAttr?.dependency_parents) && selectedAttr.dependency_parents.length > 0) {
                const attrName = row.querySelector('select[name*="[attribute_id]"]').name;
                const attrIndex = attrName.match(/rows\[(\d+)\]/)[1];

                row.querySelectorAll('.dependency-select').forEach(dep => dep.remove());
                const valueField = row.querySelector('select[name*="[value_id]"]');
                const valueGroup = valueField.closest('.form-group');
                const dependencyData = valueField.dataset.dependencies
                    ? JSON.parse(valueField.dataset.dependencies)
                    : {};

                selectedAttr.dependency_parents.forEach((parentId) => {
                    const parentAttr = subcategoryAttributes.find(attr => attr.id == parentId);
                    if (!parentAttr) return;

                    const values = parentAttr.values?.filter(v => !v.is_composite_value) || [];
                    const preselected = dependencyData[parentId] || '';

                    const selectName = `rows[${attrIndex}][dependency_value_ids][${parentId}]`;

                    const wrapper = document.createElement('div');
                    wrapper.className = 'form-group col-md-2 dependency-select';
                    wrapper.innerHTML = `
                                                                                                                                                                <label>Depends on "${parentAttr.name}"</label>
                                                                                                                                                                <select class="form-control" name="${selectName}">
                                                                                                                                                                    <option value="">-- Select --</option>
                                                                                                                                                                    ${values.map(v => `<option value="${v.id}" ${v.id == preselected ? 'selected' : ''}>${v.value}</option>`).join('')}
                                                                                                                                                                </select>
                                                                                                                                                            `;

                    valueGroup.after(wrapper);
                });

            }

            if (selectedAttr?.dependency_parent) {
                const parentAttr = subcategoryAttributes.find(attr => attr.id == selectedAttr.dependency_parent);
                const values = parentAttr?.values?.filter(v => !v.is_composite_value) || [];
                const selectedDepValueId = dependencySelect?.dataset.selected;

                dependencySelect.innerHTML = values
                    .map(v => {
                        const selected = v.id == selectedDepValueId ? 'selected' : '';
                        return `<option value="${v.id}" ${selected}>${v.value}</option>`;
                    })
                    .join('');
                dependencyGroup.style.display = 'block';
            }

            // Per Page Pricing
            const perPageSection = row.querySelector('.per-page-container');
            const toggleButton = row.querySelector('.toggle-pricing');

            if (['per_page', 'per_product'].includes(selectedAttr?.pricing_basis)) {
                // Only show directly if it's a newly added row
                if (!isInitial) {
                    perPageSection.style.display = 'block';
                    if (toggleButton) toggleButton.textContent = '- ';
                } else {
                    // Keep hidden but allow toggling
                    perPageSection.style.display = 'none';
                    if (toggleButton) toggleButton.textContent = '+ ';
                }
            } else {
                perPageSection.style.display = 'none';
                if (toggleButton) toggleButton.textContent = '+ ';
            }

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

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('add-modifier')) {
                e.preventDefault();
                const container = document.getElementById('attribute-modifier-container');
                const nextIndex = container.querySelectorAll('.attribute-row').length;
                const row = createAttributeRow(nextIndex);
                row.setAttribute('data-is-new', 'true');
                container.appendChild(row);

                updateButtons('#attribute-modifier-container', 'attribute-row', 'add-modifier', 'remove-modifier', '.modifier-buttons');
            }


            if (e.target.classList.contains('remove-row')) {
                const row = e.target.closest('.attribute-row');
                const idInput = row.querySelector('input[name*="[id]"]');
                const id = idInput?.value;

                if (id) {
                    // Add to deleted_ids hidden input
                    const deletedInput = document.getElementById('deleted-ids');
                    const current = deletedInput.value ? JSON.parse(deletedInput.value) : [];
                    current.push(id);
                    deletedInput.value = JSON.stringify(current);
                }

                // Remove the row from DOM
                row.remove();
            }


            if (e.target.classList.contains('remove-modifier')) {
                e.preventDefault();
                const container = document.getElementById('attribute-modifier-container');
                const row = e.target.closest('.attribute-row');
                const idInput = row.querySelector('input[name*="[id]"]');
                const id = idInput?.value;

                if (id) {
                    // Add to deleted_ids hidden input
                    const deletedInput = document.getElementById('deleted-ids');
                    const current = deletedInput.value ? JSON.parse(deletedInput.value) : [];
                    current.push(id);
                    deletedInput.value = JSON.stringify(current);
                }

                // Remove the row from DOM
                row.remove();

                // Re-index remaining inputs
                container.querySelectorAll('.attribute-row').forEach((row, index) => {
                    row.dataset.index = index;
                    row.querySelectorAll('input, select, label').forEach((el) => {
                        if (el.name) el.name = el.name.replace(/rows\[\d+\]/, `rows[${index}]`);
                        if (el.id) el.id = el.id.replace(/default_\d+/, `default_${index}`);
                        if (el.tagName.toLowerCase() === 'label' && el.htmlFor) el.htmlFor = el.htmlFor.replace(/default_\d+/, `default_${index}`);
                    });
                });
                updateButtons('#attribute-modifier-container', 'attribute-row', 'add-modifier', 'remove-modifier', '.modifier-buttons');
            }
            if (e.target.classList.contains('add-per-page')) {
                e.preventDefault();
                const wrapper = e.target.closest('.per-page-wrapper');
                const rows = wrapper.querySelectorAll('.per-page-row');
                const lastIndex = rows.length;
                const newRow = rows[0].cloneNode(true);
                newRow.querySelectorAll('input').forEach(input => input.value = '');
                newRow.querySelector('.add-per-page').outerHTML = '<button type="button" class="btn btn-sm btn-danger remove-per-page">− Remove</button>';

                const parentAttrIndex = wrapper.closest('.attribute-row')
                    .querySelector('select[name*="[attribute_id]"]')
                    .name.match(/rows\[(\d+)\]/)[1];
                newRow.querySelectorAll('input').forEach(input => {
                    const name = input.name;
                    const updated = name.replace(/rows\[\d+\]\[per_page_pricing\]\[\d+\]/, `rows[${parentAttrIndex}][per_page_pricing][${lastIndex}]`);
                    input.name = updated;
                });
                wrapper.appendChild(newRow);
            }
            if (e.target.classList.contains('remove-per-page')) {
                e.preventDefault();
                e.target.closest('.per-page-row').remove();
            }
            if (e.target.classList.contains('toggle-pricing')) {
                e.preventDefault();
                const toggleIcon = e.target;
                const targetId = toggleIcon.getAttribute('data-target');
                const pricingContainer = document.querySelector(targetId);
                const isVisible = pricingContainer.style.display !== 'none';

                if (isVisible) {
                    pricingContainer.style.display = 'none';
                    toggleIcon.textContent = '+ ';
                } else {
                    pricingContainer.style.display = 'block';
                    toggleIcon.textContent = '- ';
                }
            }
        });

        document.addEventListener('change', function (e) {
            const row = e.target.closest('.attribute-row');
            if (row) {
                row.setAttribute('data-is-changed', 'true');
            }
            if (e.target.name?.includes('[attribute_id]')) {
                handleAttributeChange(row);
            }
            if (e.target.name.includes('[is_default]')) {
                const changedRow = e.target.closest('.attribute-row');
                const attributeSelect = changedRow.querySelector('select[name*="[attribute_id]"]');
                const currentAttrId = attributeSelect.value;

                // Find all rows with same attribute_id and uncheck other checkboxes
                document.querySelectorAll('.attribute-row').forEach(row => {
                    const attrSelect = row.querySelector('select[name*="[attribute_id]"]');
                    const attrId = attrSelect?.value;

                    if (attrId === currentAttrId && row !== changedRow) {
                        const checkbox = row.querySelector('input[name*="[is_default]"]');
                        if (checkbox) checkbox.checked = false;
                    }
                });
            }
        });

        // document.getElementById('pages_dragger_required').addEventListener('change', function () {
        //     const pagesSettingsGroup = document.getElementById('pages-settings-group');

        //     if (this.value === '1') {
        //         pagesSettingsGroup.style.display = 'flex';

        //         // Fill attribute options if needed dynamically (optional since already loaded in Blade)
        //     } else {
        //         pagesSettingsGroup.style.display = 'none';
        //         document.getElementById('pages-dragger-dependency').value = '';
        //     }
        // });

        document.addEventListener('DOMContentLoaded', function () {
            updateButtons('#attribute-modifier-container', 'attribute-row', 'add-modifier', 'remove-modifier', '.modifier-buttons');

            document.querySelectorAll('.attribute-row').forEach(row => {
                handleAttributeChange(row, true);
            });
        });
    </script>

    @push('scripts')
        <script>
            $(document).ready(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#save-pricing-rule-btn').on('click', function () {
                    const $btn = $(this);
                    $btn.prop('disabled', true);
                    // Remove invalid per_page_pricing inputs before sending
                    $('.attribute-row').each(function () {
                        const isNew = $(this).data('is-new');
                        const isChanged = $(this).data('is-changed');
                        if (!isNew && !isChanged) {
                            // Disable all inputs in this row to prevent submission
                            $(this).find('input, select, textarea').prop('disabled', true);
                        }
                    });

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

                    const form = $('#pricing-rule-form')[0];
                    const formData = new FormData(form);
                    $('input, select').removeClass('is-invalid');
                    $('.invalid-feedback').remove();

                    $.ajax({
                        url: "{{ route('admin.pricing-rules.update', $pricingRule->id) }}",
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (res) {
                            if (res.success) {
                                Swal.fire('Updated!', res.message || 'Pricing rule updated successfully.', 'success');
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
                                const msg = errors[key][0];
                                const baseKey = key.replace(/\.\d+/, '[]');
                                const $input = $(`[name="${baseKey}"]`).first();
                                $input.addClass('is-invalid');
                                if ($input.next('.invalid-feedback').length === 0) {
                                    $input.after(`<div class="invalid-feedback">${msg}</div>`);
                                } else {
                                    $input.next('.invalid-feedback').text(msg);
                                }
                            }
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection