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
                                <li class="breadcrumb-item"><a href="{{ route('admin.header-contact.index') }}">Header & Contact Info</a></li>
                                <li class="breadcrumb-item active">Edit Contact Info</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="content-body">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Contact Information</h4>
                </div>
                <div class="card-body">
                    <form id="contactForm" method="POST" novalidate>
                        @csrf
                        @method('POST')
                        <input type="hidden" name="id" value="{{ $contact->id }}">
                        <div class="row">
                            <!-- Contact Number -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Contact Number</label>
                                    <input type="text" name="contact_number" class="form-control" value="{{ old('contact_number', $contact->contact_number) }}">
                                    <div class="invalid-feedback" id="error-contact_number"></div>
                                    <div class="form-check mt-1">
                                        <input type="checkbox" name="show_on_header" value="1" class="form-check-input" id="show_on_header" {{ $contact->show_on_header ? 'checked' : '' }}>
                                        <label for="show_on_header" class="form-check-label">Show on Header</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Mobile Number -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <input type="text" name="mobile_number" class="form-control" value="{{ old('mobile_number', $contact->mobile_number) }}">
                                    <div class="invalid-feedback" id="error-mobile_number"></div>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email', $contact->email) }}">
                                    <div class="invalid-feedback" id="error-email"></div>
                                </div>
                            </div>

                            <!-- Website URL -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Website URL</label>
                                    <input type="url" name="website_url" class="form-control" value="{{ old('website_url', $contact->website_url) }}">
                                    <div class="invalid-feedback" id="error-website_url"></div>
                                </div>
                            </div>

                            <!-- Full Address -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Full Address</label>
                                    <textarea name="full_address" id="full_address" class="form-control" rows="3">{{ old('full_address', $contact->full_address) }}</textarea>
                                    <div class="invalid-feedback" id="error-full_address"></div>
                                </div>
                                <div id="map-preview" style="width:100%;height:250px;margin-top:10px;"></div>
                            </div>

                            <!-- Remove Google Map Embed Code input as we will generate it dynamically -->

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('admin.header-contact.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('after-scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Function to update Google Map preview based on address field
    function updateMap() {
        let address = $('#full_address').val();
        let mapPreview = $('#map-preview');
        if(address.trim()) {
            let src = 'https://maps.google.com/maps?q=' + encodeURIComponent(address) + '&t=m&z=16&output=embed';
            mapPreview.html('<iframe src="' + src + '" width="100%" height="250" style="border:0;" allowfullscreen loading="lazy"></iframe>');
        } else {
            mapPreview.html('<p>Please enter an address to preview the map.</p>');
        }
    }

    $(document).ready(function () {
        updateMap();

        // Update map preview on address change
        $('#full_address').on('input', updateMap);

        $('#contactForm').on('submit', function (e) {
            e.preventDefault();

            // Clear previous validation errors
            $('.invalid-feedback').text('');
            $('input, textarea').removeClass('is-invalid');

            $.ajax({
                url: "{{ route('admin.header-contact.update', $contact->id) }}",
                method: "POST",
                data: $(this).serialize(),
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated',
                        text: 'Contact info updated successfully!',
                    }).then(() => {
                        window.location.href = "{{ route('admin.header-contact.index') }}";
                    });
                },
                error: function (xhr) {
                    if(xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorText = '';
                        for (let field in errors) {
                            errorText += errors[field][0] + '<br>';

                            // Show error next to input
                            if($('#error-' + field).length) {
                                $('#error-' + field).text(errors[field][0]);
                                $('[name="'+field+'"]').addClass('is-invalid');
                            }
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Validation Error',
                            html: errorText,
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong!',
                        });
                    }
                }
            });
        });
    });
</script>
@endpush
