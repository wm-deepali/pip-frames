@extends('layouts.master')

@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">

        <!-- Breadcrumb -->
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Header & Contact Info</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                <div class="form-group breadcrumb-right">
                    @if ($contact)
                        <a href="{{ route('admin.header-contact.edit', $contact->id) }}" class="btn-icon btn btn-primary btn-round btn-sm">Edit</a>
                    @else
                        <a href="{{ route('admin.header-contact.create') }}" class="btn-icon btn btn-success btn-round btn-sm">Add Contact Info</a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="content-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Contact Information</h4>
                        </div>

                        <div class="card-body">
                            @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if ($contact)
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr><th>Contact Number</th><td>{{ $contact->contact_number ?? 'N/A' }}</td></tr>
                                        <tr><th>Show on Header (Contact Number)</th><td>{{ $contact->show_on_header ? 'Yes' : 'No' }}</td></tr>
                                        <tr><th>Show on Footer (Contact Number)</th><td>{{ $contact->show_on_footer ? 'Yes' : 'No' }}</td></tr>

                                        <tr><th>Mobile Number</th><td>{{ $contact->mobile_number ?? 'N/A' }}</td></tr>
                                        <tr><th>Show on Header (Mobile)</th><td>{{ $contact->show_on_header_mobile ? 'Yes' : 'No' }}</td></tr>
                                        <tr><th>Show on Footer (Mobile)</th><td>{{ $contact->show_on_footer_mobile ? 'Yes' : 'No' }}</td></tr>

                                        <tr><th>Email</th><td>{{ $contact->email ?? 'N/A' }}</td></tr>
                                        <tr><th>Show on Header (Email)</th><td>{{ $contact->show_on_header_email ? 'Yes' : 'No' }}</td></tr>
                                        <tr><th>Show on Footer (Email)</th><td>{{ $contact->show_on_footer_email ? 'Yes' : 'No' }}</td></tr>

                                        <tr><th>Website URL</th><td>{{ $contact->website_url ?? 'N/A' }}</td></tr>
                                        <tr><th>Full Address</th><td>{{ $contact->full_address ?? 'N/A' }}</td></tr>
                                        {{-- Uncomment if you want to show map embed code --}}
                                        {{-- <tr><th>Google Map Embed</th><td>{!! $contact->location_map ?? 'N/A' !!}</td></tr> --}}
                                    </tbody>
                                </table>
                            @else
                                <p class="text-muted">No contact information found. Please add it first.</p>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Optional JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
