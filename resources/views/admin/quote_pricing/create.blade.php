@extends('layouts.master')

@section('content')
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
                                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.quote-pricing.index') }}">Quote
                                            Pricing</a></li>
                                    <li class="breadcrumb-item active">Step 1 - Create Quote</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-body">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add New Quote - Step 1</h4>
                    </div>

                    <div class="card-body">
                        <form id="quote-step1-form">
                            @csrf
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label for="category_id" class="form-label font-weight-bold">Select Category</label>
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        <option value="">-- Select Category --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger validation-err" id="category_id-err"></span>
                                </div>

                                <div class="col-md-6">
                                    <label for="subcategory_id" class="form-label font-weight-bold">Select Sub
                                        Category</label>
                                    <select name="subcategory_id" id="subcategory_id" class="form-control" required>
                                        <option value="">-- Select Sub Category --</option>
                                        @foreach($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger validation-err" id="subcategory_id-err"></span>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label class="form-label font-weight-bold">Paper Options</label>
                                    <div class="border rounded p-2" style="max-height: 300px; overflow-y: auto;">
                                        @php
                                            $paperOptions = [
                                                'book_type' => 'Book Type',
                                                'printing_colour' => 'Printing Colour',
                                                'orientation' => 'Orientation',
                                                'paper_size' => 'Paper Size',
                                                'paper_type' => 'Paper Type',
                                                'paper_weight' => 'Paper Weight',
                                                'binding' => 'Binding',
                                            ];
                                          @endphp
                                        @foreach($paperOptions as $value => $label)
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="enable_options[]"
                                                    value="{{ $value }}" id="{{ $value }}">
                                                <label class="form-check-label" for="{{ $value }}">{{ $label }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label font-weight-bold">Cover Options</label>
                                    <div class="border rounded p-2" style="max-height: 300px; overflow-y: auto;">
                                        @php
                                            $coverOptions = [
                                                'cover_type' => 'Cover Type',
                                                'cover_weight' => 'Cover Weight',
                                                'cover_printing_colour' => 'Cover Printing Colour',
                                                'cover_finish' => 'Cover Finish',
                                                'endpaper_colour' => 'Endpaper Colour',
                                                'cover_foiling' => 'Cover Foiling'
                                            ];
                                          @endphp
                                        @foreach($coverOptions as $value => $label)
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="enable_options[]"
                                                    value="{{ $value }}" id="{{ $value }}">
                                                <label class="form-check-label" for="{{ $value }}">{{ $label }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label class="form-label font-weight-bold">Dust Jacket Options</label>
                                    <div class="border rounded p-2" style="max-height: 300px; overflow-y: auto;">
                                        @php
                                            $dustOptions = [
                                                'dust_jacket_colour' => 'Dust Jacket Colours',
                                                'dust_jacket_finish' => 'Dust Jacket Finish'
                                            ];
                                          @endphp
                                        @foreach($dustOptions as $value => $label)
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="enable_options[]"
                                                    value="{{ $value }}" id="{{ $value }}">
                                                <label class="form-check-label" for="{{ $value }}">{{ $label }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label font-weight-bold">Other Options</label>
                                    <div class="border rounded p-2" style="max-height: 300px; overflow-y: auto;">
                                        @php
                                            $otherOptions = [
                                                'bookmark_ribbon' => 'Bookmark Ribbon',
                                                'head_and_tail_band' => 'Head and Tail Band'
                                            ];
                                          @endphp
                                        @foreach($otherOptions as $value => $label)
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="enable_options[]"
                                                    value="{{ $value }}" id="{{ $value }}">
                                                <label class="form-check-label" for="{{ $value }}">{{ $label }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>


                            <div class="text-right mt-2">
                                <button type="submit" class="btn btn-primary">Next Step</button>
                                <a href="{{ route('admin.quote-pricing.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).on("submit", "#quote-step1-form", function (e) {
            e.preventDefault();

            const form = this;
            const formData = new FormData(form);
            const submitBtn = $(form).find('[type="submit"]');

            submitBtn.attr("disabled", true);
            $(".validation-err").html(""); // Clear previous errors

            $.ajax({
                url: "{{ route('admin.quote-pricing.store') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (result) {
                    if (result.success) {
                        window.location.href = result.redirect; // Move to Step 2
                    } else {
                        submitBtn.attr("disabled", false);

                        if (result.code === 422) {
                            for (const key in result.errors) {
                                $(`#${key}-err`).html(result.errors[key][0]);
                            }
                        } else {
                            Swal.fire(result.msgText || "Something went wrong");
                        }
                    }
                },
                error: function () {
                    submitBtn.attr("disabled", false);
                    Swal.fire("An error occurred. Please try again.");
                }
            });
        });
    </script>
@endpush