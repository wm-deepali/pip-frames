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
                    <h4 class="mb-0">Edit SRA3 Sheet Counts ({{ $attribute->name }})</h4>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ route('admin.centralized-paper-pricing.index') }}" class="btn btn-secondary btn-sm">← Back
                        to List</a>
                </div>
            </div>

            <div class="content-body">
                <div class="card">
                    <div class="card-body">
                        <input type="hidden" name="attribute_id" value="{{ $attribute->id }}">
                        <form id="sra3-form">
                            @csrf
                            @method('PUT') 
                            <input type="hidden" name="attribute_id" value="{{ $attribute->id }}">

                            @foreach($attribute->values as $value)
                                <div class="form-group row sra3-input">
                                    <label class="col-md-4 col-form-label">{{ $value->value ?? 'Unnamed Value' }}</label>
                                    <div class="col-md-4">
                                        <input type="number" name="sra3_counts[{{ $value->id }}]" class="form-control"
                                            placeholder="Sheets from SRA3" min="1" value="{{ $sra3Counts[$value->id] ?? '' }}">
                                    </div>
                                </div>
                            @endforeach

                            <button type="submit" class="btn btn-success mt-3">Update SRA3 Counts</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {

            $('#sra3-form').submit(function (e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('admin.sra3-sheets.update', $attribute->id) }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function (response) {
                        Swal.fire('Updated!', response.message ?? 'SRA3 counts updated.', 'success');
                        window.location.href = "{{ route('admin.centralized-paper-pricing.index') }}";
                    },
                    error: function (xhr) {
                        Swal.fire('Error', xhr.responseJSON?.message || 'Something went wrong.', 'error');
                    }
                });
            });

        });
    </script>
@endpush