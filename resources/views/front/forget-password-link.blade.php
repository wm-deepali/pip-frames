a@extends('layouts.new-master')

@section('title')
	Pip Frames -Reset Password
@endsection

@section('content')
	<div class="page-wrapper">
		<div class="page-content">
			<!--start breadcrumb-->
			<section class="py-3 border-bottom d-none d-md-flex">
				<div class="container">
					<div class="page-breadcrumb d-flex align-items-center">
						<h3 class="breadcrumb-title pe-3">Reset Password</h3>
						<div class="ms-auto">
							<nav aria-label="breadcrumb">
								<ol class="breadcrumb mb-0 p-0">
									<li class="breadcrumb-item"><a href="" {{route('home')}}"><i class="bx bx-home-alt"></i>
											Home</a>
									</li>
									<li class="breadcrumb-item active" aria-current="page">Sign Up</li>
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

			<section class="py-0 py-lg-5">
				<div class="container">
					<div
						class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
						<div class="row row-cols-1 row-cols-lg-1 row-cols-xl-2">
							<div class="col mx-auto">
								<div class="card mb-0">
									<div class="card-body" style="background:#ffffff;">
										<div class="border p-4 rounded">
											<div class="login-separater text-center mb-4"> <span>Reset Password</span>
												<hr />
											</div>


											<div class="form-body">
												<form class="row g-3" id="registerForm" method="post"
													action="{{ route('reset.password.post') }}"
													enctype="multipart/form-data">
													@csrf

													<div class="col-12">
														<label for="password" class="form-label">New Password</label>
														<input type="password" autocomplete="off" name="password"
															id="password" class="form-control" placeholder="New Password"
															required />
													</div>
													<div class="col-12">
														<label for="password-confirm" class="form-label">Confirm New
															Password</label>
														<input type="password" autocomplete="off"
															name="password_confirmation" id="password-confirm"
															class="form-control " placeholder="Confirm New Password"
															required />
													</div>


													<div class="col-12">
														<div class="d-grid">
															<button type="submit" class="btn btn-light"><i
																	class='bx bx-user'></i>Submit</button>
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
@push('after-scripts')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script src="
		https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js
		"></script>
	<link href="
		https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css
		" rel="stylesheet">


@endpush