@extends('layouts.new-master')

@section('title')
Pip Frames -About Us
@endsection

@section('content')
<style>
    .btn-login-page {
        display: inline-block;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        text-align: center;
        letter-spacing: .5px;
        text-decoration: none;
        vertical-align: middle;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
        background-color: #d9d9d9 !important;
        padding: .375rem .75rem;
        font-size: 1rem;
        border-radius: .25rem;
        transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .form-control {
        border: 2px solid #e0e0e0 !important;
        color: black !important;
        border-radius: .375rem !important;
    }

    .custom-select {
        border: 2px solid #e0e0e0 !important;
        color: black !important;
        border-radius: .375rem !important;
    }

    .page-content {
        min-height: calc(100vh - 100px);
        padding-bottom: 80px; /* Prevent overlap with footer */
    }
</style>
<style>
    .custom-switch .form-check-input {
        width: 50px;
        height: 26px;
        background-color: #ccc;
        border-radius: 50px;
        position: relative;
        border: none;
        transition: background-color 0.3s ease;
        cursor: pointer;
        outline: none;
        box-shadow: none;
    }

    .custom-switch .form-check-input:checked {
        background-color: #28a745 !important; /* Green when checked */
    }

    .custom-switch .form-check-input:focus {
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25); /* Green glow on focus */
    }

    .custom-switch .form-check-input::before {
        content: '';
        position: absolute;
        top: 3px;
        left: 3px;
        width: 20px;
        height: 20px;
        background-color: white;
        border-radius: 50%;
        transition: transform 0.3s ease;
    }

    .custom-switch .form-check-input:checked::before {
        transform: translateX(24px); /* Slide toggle dot */
    }

    .custom-switch .form-check-label {
        margin-left: 10px;
        vertical-align: middle;
    }
</style>


<div class="page-wrapper" >
    <div class="page-content">
        <!-- Breadcrumb -->
        <section class="py-3  d-none d-md-flex" style="border-bottom:1px solid #80808045">
            <div class="container">
                <div class="page-breadcrumb d-flex align-items-center">
                    <h3 class="breadcrumb-title pe-3">Sign Up</h3>
                    <div class="ms-auto">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="{{route('home')}}"><i class="bx bx-home-alt"></i> Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Sign Up</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>

        <!-- Flash Messages -->
        @if (session('success'))
            <h5 class="alert alert-success text-center">{{ Session::get('success') }}</h5><br>
            <?php Session::forget('success');?>
        @endif
        @if (session('error'))
            <h5 class="alert alert-danger text-center">{{ Session::get('error') }}</h5><br>
            <?php Session::forget('error');?>
        @endif

        <!-- Sign-Up Section -->
        <section class="py-0 py-lg-5 " style="margin-top:80px;">
            <div class="container">
                <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0 mb-5">
                    <div class="row row-cols-1 row-cols-lg-1 row-cols-xl-2">
                        <div class="col mx-auto">
                            <div class="card mb-0">
                                <div class="card-body" style="background:#ebebeb;">
                                    <div class="border p-4 rounded">
                                        <div class="text-center">
                                            <h3 class="">Sign Up</h3>
                                            <p>Already have an account? <a href="{{ route('authentication-signin') }}" style="color:blue;">Sign in here</a></p>
                                        </div>
                                        <div class="d-grid">
                                            <a class="btn-login-page my-4 shadow-sm " href="{{ route('google.redirect') }}">
                                                <span class="d-flex justify-content-center align-items-center">
                                                    <img class="me-2" src="assets/images/icons/search.svg" width="16" alt="Image Description">
                                                    <span>Sign Up with Google</span>
                                                </span>
                                            </a>
                                        </div>
                                        <div class=" text-center " style="margin-bottom:25px;" > <span>OR</span>
											
										</div>
										<hr>
                                        <div class="form-body">
                                            <form class="row g-3" id="registerForm" method="post" action="{{ route('customer-register') }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="col-sm-6">
                                                    <label for="inputFirstName" class="form-label">First Name</label>
                                                    <input type="text" name="first_name" class="form-control" id="inputFirstName" placeholder="John" required>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="inputLastName" class="form-label">Last Name</label>
                                                    <input type="text" name="last_name" class="form-control" id="inputLastName" placeholder="Doe" required>
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputEmailAddress" class="form-label">Email Address</label>
                                                    <input type="email" name="email" class="form-control" id="inputEmailAddress" placeholder="example@user.com" required>
                                                    <span id="email_feedback" style="display:none; color:red;">Email already exists</span>
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputMobile" class="form-label">Mobile</label>
                                                    <input type="tel" onkeypress="return isNumber(event)" autocomplete="off" class="form-control" name="mobile" minlength="10" maxlength="10" placeholder="Mobile number" id="inputMobile" required>
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputChoosePassword" class="form-label">Password</label>
                                                    <div class="input-group" id="show_hide_password">
                                                        <input type="password" name="password" class="form-control border-end-0" id="inputChoosePassword" placeholder="Enter Password" required>
                                                        <a href="javascript:;" class="input-group-text "><i class='bx bx-hide'></i></a>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputSelectCountry" class="form-label">Country</label>
                                                    <select class="form-select" name="country" id="inputSelectCountry" required>
                                                        <option>Select Country</option>
                                                        @php $countries = countrylist(); @endphp
                                                        @foreach($countries as $country)
                                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" required>
                                                        <label class="form-check-label" for="flexSwitchCheckChecked">I read and agree to Terms & Conditions</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button type="submit" class="btn btn-light"><i class='bx bx-user'></i> Sign up</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div> <!-- form-body -->
                                    </div> <!-- border box -->
                                </div> <!-- card-body -->
                            </div> <!-- card -->
                        </div>
                    </div> <!-- row -->
                </div> <!-- section-authentication-signin -->
            </div> <!-- container -->
        </section>
        <!--end section-->
    </div>
</div>
@endsection

@push('after-scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css" rel="stylesheet">

<script>
    $(document).ready(function () {
        $('#inputEmailAddress').on('input change', function () {
            checkEmailExists();
        });
    });

    function checkEmailExists() {
        var email = $('#inputEmailAddress').val();
        var emailFeedback = $('#email_feedback');
        var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

        if (emailPattern.test(email)) {
            $.ajax({
                url: '{{ route("check-email") }}',
                method: 'POST',
                data: {
                    email: email,
                    _token: '{{ csrf_token() }}'
                },
                success: function (data) {
                    if (data.exists) {
                        emailFeedback.text('Email already exists').show();
                        $('#inputEmailAddress').removeClass('is-valid').addClass('is-invalid');
                    } else {
                        emailFeedback.hide();
                        $('#inputEmailAddress').removeClass('is-invalid').addClass('is-valid');
                    }
                }
            });
        } else {
            emailFeedback.text('Invalid email address').show();
            $('#inputEmailAddress').removeClass('is-valid').addClass('is-invalid');
        }
    }

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        return !(charCode > 31 && (charCode < 48 || charCode > 57));
    }
</script>
@endpush
