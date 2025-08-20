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
    /* border: 1px solid #f42b5b !important; */
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
    min-height: calc(100vh - 100px); /* Adjust 100px based on header + footer height */
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



<div class="page-wrapper">
	<div class="page-content">
		<!--start breadcrumb-->
		<section class="py-3  d-none d-md-flex" style="border-bottom:1px solid #80808045;">
			<div class="container">
				<div class="page-breadcrumb d-flex align-items-center">
					<h3 class="breadcrumb-title pe-3">Sign in</h3>
					<div class="ms-auto">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="{{route('home')}}"><i class="bx bx-home-alt"></i> Home </a>
								</li>
							<li class="breadcrumb-item active" aria-current="page">Sign In</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</section>
		
		<!--end breadcrumb-->
		<!--start shop cart-->
			@if (session('success'))
                  <h5 class="alert alert-success text-center">{{ Session::get('success') }}</h5><br>
                  <?php Session::forget('success');?>
                @endif
                @if (session('error'))
                  <h5 class="alert alert-danger text-center">{{ Session::get('error') }}</h5><br>
                  <?php Session::forget('error');?>
                @endif
		<section class="">
			<div class="container">
				<div class="section-authentication-signin d-flex align-items-center justify-content-center py-5" style="min-height: 80vh;margin-top:20px;">


					<div class="row row-cols-1 row-cols-xl-2">
						<div class="col mx-auto">
							<div class="card">
								<div class="card-body" style="background:#ebebeb;">
									<div class="border p-4 rounded">
										<div class="text-center">
											<h3 class="">Sign in</h3>
											<p>Don't have an account yet? <a href="{{ route('authentication-signup')}}" style="color:blue;">Sign up here</a>
											</p>
										</div>
										<div class="d-grid">
											<a class="btn-login-page my-4 shadow-sm " href="{{ route('google.redirect')}}"> <span class="d-flex justify-content-center align-items-center" style="background:#d9d9d9;">
												<img class="me-2" src="assets/images/icons/search.svg" width="16" alt="Image Description">
												<span class="text-black">Sign in with Google</span>
												</span></a>
											
										</div>
										<div class=" text-center " style="margin-bottom:25px;" > <span>OR</span>
											
										</div>
										<hr>
										<!--<hr/>-->
										<div class="form-body" >
											<form id="loginForm" method="post" action="{{ route('customer.authenticate') }}" enctype="multipart/form-data" class="row g-3">
                    @csrf
												<div class="col-12">
													<label for="inputEmailAddress" class="form-label">Email Address</label>
													<input type="email" name="email" class="form-control" id="inputEmailAddress" placeholder="Email Address" required>
												</div>
												<div class="col-12">
													<label for="inputChoosePassword" class="form-label">Enter Password</label>
													<div class="input-group" id="show_hide_password">
														<input type="password" name="password" class="form-control border-end-0" id="inputChoosePassword" value="12345678" placeholder="Enter Password" required> <a href="javascript:;" class="input-group-text "><i class='bx bx-hide'></i></a>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-check form-switch">
														<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
														<label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
													</div>
												</div>
												<div class="col-md-6 text-end">	<a href="{{ route('authentication-forgot-password.get')}}">Forgot Password ?</a>
												</div>
												<div class="col-12">
													<div class="d-grid">
														<button type="submit" class="btn btn-light"><i class="bx bxs-lock-open"></i>Sign in</button>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--end row-->
				</div>
			</div>
		</section>
		<!--end shop cart-->
	</div>
</div>
@endsection