@extends('layouts.master')

@section('content')
    <style>
        .sra3-input {
            margin-bottom: 10px;
        }
    </style>

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row mb-2">
                <div class="col-md-6">
                    <h4 class="mb-0">Edit Paper Weight Rates</h4>
                    <small class="text-muted d-block mt-1">
                        <i class="fas fa-info-circle"></i> Pricing is based on the number of <strong>SRA3 sheets</strong>
                        used per order.
                    </small>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ route('admin.centralized-paper-pricing.index') }}" class="btn btn-secondary btn-sm">← Back to List</a>
                </div>
            </div>

            <div class="content-body">
                <div class="card">
                    <div class="card-body">
                        <form id="edit-paper-weight-form">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="attribute_id" value="{{ $attribute->id }}">
                            <div id="dependency-section"></div>

                            <button type="submit" class="btn btn-success mt-2">Update Pricing</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@php
    $filteredValuesByParent = [];

    foreach ($attribute->parents as $parent) {
        if (strtolower(trim($parent->name)) === 'paper size') {
            continue;
        }

        $filteredValuesByParent[$parent->id] = [
            'name' => $parent->name,
            'values' => $parent->values->where('is_composite_value', false)->map(function ($val) {
                return [
                    'id' => $val->id,
                    'value' => $val->value,
                ];
            })->values()
        ];
    }

    $filteredValuesByParent[$attribute->id] = [
        'name' => $attribute->name . ' (Self)',
        'values' => $attribute->values->where('is_composite_value', false)->map(function ($val) {
            return [
                'id' => $val->id,
                'value' => $val->value,
            ];
        })->values()
    ];
@endphp

@push('scripts')
<script>
    $(document).ready(function () {
        const parentValues = @json($filteredValuesByParent);
        const existingRules = @json($pricingRules);
        let ruleIndex = 0;

        function getDependencyRowHtml(index, rule = null) {
            let html = `<div class="card mb-3 dependency-row border rounded" data-index="${index}">
                            <div class="card-body">
                                <div class="row">`;

            Object.entries(parentValues).forEach(([parentId, parentData]) => {
                const selectedValue = rule?.dependencies?.find(dep => dep.attribute_id == parentId)?.value_id 
                    ?? (parentId == "{{ $attribute->id }}" ? rule?.value_id : '');

                html += `<div class="col-md-3">
                            <label>${parentData.name}</label>
                            <select name="rows[${index}][dependency_values][${parentId}]" class="form-control" required>
                                <option value="">-- Select --</option>`;

                parentData.values.forEach(val => {
                    const selected = selectedValue == val.id ? 'selected' : '';
                    html += `<option value="${val.id}" ${selected}>${val.value}</option>`;
                });

                html += `</select></div>`;
            });

            const price = rule?.price ?? '';
            const perSheet = price ? (price / 1000).toFixed(4) : '0.00';

           html += `
    <div class="col-md-4">
        <label>Price</label>
        <div class="d-flex align-items-center">
            <input type="number" name="rows[${index}][price]" class="form-control price-input"
                step="0.01" min="0" placeholder="Price per 1000 sheets"
                value="${price}" data-index="${index}" required>
            <span class="ml-2 text-info small">
                £<span class="per-sheet-price" id="per-sheet-${index}">${perSheet}</span> / sheet
            </span>
        </div>
        <small class="text-muted">Per 1000 SRA3 sheets</small>
    </div>
`;


            return html;
        }

        function addDependencyRow(rule = null) {
            $('#dependency-section').append(getDependencyRowHtml(ruleIndex, rule));
            ruleIndex++;
        }

        existingRules.forEach(rule => {
            addDependencyRow(rule);
        });

        if (existingRules.length === 0) {
            addDependencyRow();
        }

        $('#dependency-section').after('<button type="button" class="btn btn-primary mt-2" id="add-dependency">+ Add Dependency</button>');

        $(document).on('click', '#add-dependency', function () {
            addDependencyRow();
        });

        $(document).on('click', '.remove-dependency', function () {
            $(this).closest('.dependency-row').remove();
        });

        $(document).on('input', '.price-input', function () {
            const index = $(this).data('index');
            const value = parseFloat($(this).val());
            if (!isNaN(value)) {
                const perSheet = (value / 1000).toFixed(4);
                $(`#per-sheet-${index}`).text(perSheet);
            } else {
                $(`#per-sheet-${index}`).text('0.00');
            }
        });

        $('#edit-paper-weight-form').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('admin.paper-weight-rates.update', $attribute->id) }}",
                method: "POST",
                data: $(this).serialize(),
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated!',
                        text: response.message ?? 'Data updated successfully.'
                    }).then(() => {
                        window.location.href = "{{ route('admin.centralized-paper-pricing.index') }}";
                    });
                },
                error: function (xhr) {
                    Swal.fire('Error', xhr.responseJSON?.message || 'Something went wrong.', 'error');
                }
            });
        });
    });
</script>
@endpush
