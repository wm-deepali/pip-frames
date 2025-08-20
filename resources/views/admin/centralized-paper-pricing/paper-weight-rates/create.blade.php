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
                    <h4 class="mb-0">Add Paper Weight Rates</h4>
                    <small class="text-muted d-block mt-1">
                        <i class="fas fa-info-circle"></i> Pricing is based on the number of <strong>SRA3 sheets</strong>
                        used per order.
                    </small>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ route('admin.centralized-paper-pricing.index') }}" class="btn btn-secondary btn-sm">← Back
                        to List</a>
                </div>
            </div>

            <div class="content-body">
                <div class="card">
                    <div class="card-body">
                        <form id="paper-weight-form">
                            @csrf
                            <input type="hidden" name="attribute_id" value="{{ $attribute->id }}">

                            <div id="dependency-section"></div>
                            <button type="submit" class="btn btn-success mt-2">Save Pricing</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

    @php
        $filteredValuesByParent = [];

        // Include parent attributes — EXCLUDE "Paper Size"
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

        // Include self (attribute) as dependency
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

            $(document).on('input', '.price-input', function () {
                const index = $(this).data('index');
                const value = parseFloat($(this).val());

                if (!isNaN(value)) {
                    const perSheet = (value / 1000).toFixed(4); // 4 decimal places
                    $(`#per-sheet-${index}`).text(perSheet);
                } else {
                    $(`#per-sheet-${index}`).text('0.00');
                }
            });


            $(document).ready(function () {
                const parentValues = @json($filteredValuesByParent);
                let ruleIndex = 0;

                function getDependencyRowHtml(index) {
                    let html = `<div class="card mb-3 dependency-row border rounded" data-index="${index}">
                                                <div class="card-body">
                                                    <div class="row">`;

                    Object.entries(parentValues).forEach(([parentId, parentData]) => {
                        html += `
                                                    <div class="col-md-3">
                                                        <label>${parentData.name}</label>
                                                        <select name="rows[${index}][dependency_values][${parentId}]" class="form-control" required>
                                                            <option value="">-- Select --</option>`;
                        parentData.values.forEach(val => {
                            html += `<option value="${val.id}">${val.value}</option>`;
                        });
                        html += `</select>
                                                    </div>`;
                    });

                    html += `
                            <div class="col-md-3">
                                <label>Price</label>
                                <input type="number" name="rows[${index}][price]" class="form-control price-input" step="0.01" min="0" placeholder="Price per 1000 sheets" required data-index="${index}">
                                <small class="text-muted d-block">Enter price per 1000 SRA3 sheets</small>
                                <small class="text-info d-block">Calculated price per sheet: £<span class="per-sheet-price" id="per-sheet-${index}">0.00</span></small>
                            </div>
                            </div>
                            <div>
                                <button type="button" class="btn btn-danger btn-sm remove-dependency float-right">Remove Dependency</button>
                            </div>
                            </div>
                            </div>`;
                    return html;
                }

                function addDependencyRow() {
                    $('#dependency-section').append(getDependencyRowHtml(ruleIndex));
                    ruleIndex++;
                }

                addDependencyRow();

                $('#dependency-section').after('<button type="button" class="btn btn-primary mt-2" id="add-dependency">+ Add Dependency</button>');

                $(document).on('click', '#add-dependency', function () {
                    addDependencyRow();
                });

                $(document).on('click', '.remove-dependency', function () {
                    $(this).closest('.dependency-row').remove();
                });


                $('#paper-weight-form').submit(function (e) {
                    e.preventDefault();
                    $.ajax({
                        url: "{{ route('admin.paper-weight-rates.store') }}",
                        method: "POST",
                        data: $(this).serialize(),
                        success: function (response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Saved!',
                                text: response.message ?? 'Data saved successfully.'
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