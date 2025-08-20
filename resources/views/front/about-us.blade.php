@extends('layouts.new-master')

@section('title')
	About
@endsection

@section('content')


	<!--Start breadcrumb area-->
	<section class="breadcrumb-area" style="background-image: url({{ asset('site_assets') }}/images/breadcrumb/breadcrumb-1.png);">
		<div class="banner-curve"></div>
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<div class="inner-content clearfix text-center">
						<div class="title wow slideInUp animated" data-wow-delay="0.3s" data-wow-duration="1500ms">
							<h2>About Us<span class="dotted"></span></h2>
						</div>
						<div class="breadcrumb-menu wow slideInDown animated" data-wow-delay="0.3s"
							data-wow-duration="1500ms">
							<ul class="clearfix">
								<li><a href="index-2.html">Home</a></li>
								<li class="active">About</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--End breadcrumb area-->

	<!--Start About Style2 Area-->
	<section class="about-style2-area">
		<div class="container">
			<div class="row">
				<div class="col-xl-5">
					<div class="about-style1-content-box style1instyle2">
						<div class="sec-title">
							<h5>//<span>About Us</span>//</h5>
							<h2>Best Agency For<br> Your Pet<span class="round-box zoominout"></span></h2>
						</div>
						<div class="inner-content">
							<div class="text">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
									incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
									nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
									Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
									fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
									culpa qui officia deserunt mollit.</p>
							</div>
							<div class="button-box">
								<a class="btn-one" href="#"><span class="txt">Make Appointment</span></a>
								<a class="btn-one style2 marleft" href="tel:123456789">
									<i class="fa fa-phone" aria-hidden="true"></i><span class="txt">987-876-876-87</span>
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-7">
					<div class="video-holder-box style2 text-center"
						style="background-image: url({{ asset('site_assets') }}/images/resources/video-gallery-bg-2.jpg)">
						<div class="icon">
							<a class="video-popup" title="CarePress" href="https://www.youtube.com/watch?v=p25gICT63ek">
								<span class="icon-play-button"></span>
							</a>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>
	<!--End About Style2 Area-->

	<!-- Start Showcase Area -->
	<section class="showcase-area">
		<div class="container">
			<div class="sec-title text-center">
				<h5>//<span>Showcase</span>//</h5>
				<h2>Photo Showcase<span class="round-box zoominout"></span></h2>
			</div>
			<div class="row masonary-layout">
				<!--Start Single Showcase box-->
				<div class="col-xl-3 col-lg-3 col-md-6">
					<div class="single-showcase-box">
						<div class="img-holder">
							<img src="{{ asset('site_assets') }}/images/resources/showcase-1.jpg" alt="" />
						</div>
					</div>
				</div>
				<!--End Single Showcase box-->
				<!--Start Single Showcase box-->
				<div class="col-xl-6 col-lg-6 col-md-6">
					<div class="single-showcase-box">
						<div class="img-holder">
							<img src="{{ asset('site_assets') }}/images/resources/showcase-2.jpg" alt="" />
						</div>
					</div>
				</div>
				<!--End Single Showcase box-->
				<!--Start Single Showcase box-->
				<div class="col-xl-3 col-lg-3 col-md-6">
					<div class="single-showcase-box">
						<div class="img-holder">
							<img src="{{ asset('site_assets') }}/images/resources/showcase-3.jpg" alt="" />
						</div>
					</div>
				</div>
				<!--End Single Showcase box-->

				<!--Start Single Showcase box-->
				<div class="col-xl-3 col-lg-3 col-md-6">
					<div class="single-showcase-box">
						<div class="img-holder">
							<img src="{{ asset('site_assets') }}/images/resources/showcase-4.jpg" alt="" />
						</div>
					</div>
				</div>
				<!--End Single Showcase box-->
				<!--Start Single Showcase box-->
				<div class="col-xl-3 col-lg-3 col-md-6">
					<div class="single-showcase-box">
						<div class="img-holder">
							<img src="{{ asset('site_assets') }}/images/resources/showcase-5.jpg" alt="" />
						</div>
					</div>
				</div>
				<!--End Single Showcase box-->
			</div>
		</div>

	</section>
	<!-- End Showcase Area -->

	<!--Start Skillset Area-->
	<section class="skillset-area">
		<div class="container">
			<div class="row">

				<div class="col-xl-6">
					<div class="skillset-progress-box">
						<div class="row">
							<div class="col-xl-6 col-lg-6 col-md-6">
								<div class="progress-block text-center">
									<div class="inner-box">
										<div class="graph-outer">
											<input type="text" class="dial" data-fgColor="#ff4880" data-bgColor="#f4f2ef"
												data-width="200" data-height="200" data-linecap="normal" value="78">
											<div class="inner-text count-box"><span class="count-text" data-stop="50"
													data-speed="2000"></span>%</div>
										</div>
									</div>
									<div class="title">
										<h2>Country Capture</h2>
										<p>Do it with easy way</p>
									</div>
								</div>
							</div>

							<div class="col-xl-6 col-lg-6 col-md-6">
								<div class="progress-block green text-center">
									<div class="inner-box">
										<div class="graph-outer">
											<input type="text" class="dial" data-fgColor="#8fc424" data-bgColor="#f4f2ef"
												data-width="200" data-height="200" data-linecap="normal" value="78">
											<div class="inner-text count-box"><span class="count-text" data-stop="79"
													data-speed="2000"></span>%</div>
										</div>
									</div>
									<div class="title">
										<h2>Success Rate</h2>
										<p>Do it with easy way</p>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>

				<div class="col-xl-6">
					<!--Start Skillset Text-->
					<div class="skillset-content-box">
						<div class="sec-title">
							<h5>//<span>Skillset</span>//</h5>
							<h2>Core Type Values<span class="round-box zoominout"></span></h2>
						</div>
						<div class="text">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
								incididunt ut labore et dolore magna aliq ua.Ut enim ad minim veniam, quis nostrud
								exercitation.</p>
						</div>
						<div class="bottom-text">
							<div class="img-box">
								<img src="{{ asset('site_assets') }}/images/resources/skillset-image.jpg" alt="">
							</div>
							<div class="text-box">
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
									consectetur adipisicing incid idunt ut labore et dolore magna.</p>
							</div>
						</div>

					</div>
				</div>

			</div>
		</div>
	</section>
	<!--End Skillset Area-->


	<!--Start Fact Counter Area-->
	<section class="fact-counter-area">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<div class="fact-counter-box">
						<div class="row">
							<!--Start Single Fact Counter-->
							<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
								<div class="single-fact-counter wow fadeInRight text-center" data-wow-delay="100ms"
									data-wow-duration="1500ms">
									<div class="count-box">
										<h2>
											<span class="timer" data-from="1" data-to="378" data-speed="5000"
												data-refresh-interval="50">378</span>
											<i class="flaticon-plus red"></i>
										</h2>
										<h5>Active Clients</h5>
									</div>
								</div>
							</div>
							<!--End Single Fact Counter-->
							<!--Start Single Fact Counter-->
							<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
								<div class="single-fact-counter wow fadeInRight text-center" data-wow-delay="100ms"
									data-wow-duration="1500ms">
									<div class="count-box">
										<h2>
											<span class="timer" data-from="1" data-to="378" data-speed="5000"
												data-refresh-interval="50">378</span>
											<i class="flaticon-plus green"></i>
										</h2>
										<h5>Country Coverage</h5>
									</div>
								</div>
							</div>
							<!--End Single Fact Counter-->
							<!--Start Single Fact Counter-->
							<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
								<div class="single-fact-counter wow fadeInRight text-center" data-wow-delay="100ms"
									data-wow-duration="1500ms">
									<div class="count-box">
										<h2>
											<span class="timer" data-from="1" data-to="58" data-speed="5000"
												data-refresh-interval="50">58</span>
											<i class="flaticon-plus orange"></i>
										</h2>
										<h5>Pet Deliver</h5>
									</div>
								</div>
							</div>
							<!--End Single Fact Counter-->
							<!--Start Single Fact Counter-->
							<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
								<div class="single-fact-counter wow fadeInRight text-center" data-wow-delay="100ms"
									data-wow-duration="1500ms">
									<div class="count-box">
										<h2>
											<span class="timer" data-from="1" data-to="378" data-speed="5000"
												data-refresh-interval="50">378</span>
											<i class="flaticon-plus blues"></i>
										</h2>
										<h5>Get Rewards</h5>
									</div>
								</div>
							</div>
							<!--End Single Fact Counter-->

						</div>
					</div>
				</div>

			</div>
		</div>
	</section>
	<!--End Fact Counter Area-->

	<!--Start Contact Form Style1 Area-->
	<section class="contact-form-style1-area">
		<div class="contact-form-style1-bg" style="background-image: url({{ asset('site_assets') }}/images/shape/contact-form-style1-bg.png)">
		</div>
		<div class="container">
			<div class="sec-title text-center">
				<h5>//<span>Contact Us</span>//</h5>
				<h2>Get In Touch<span class="round-box zoominout"></span></h2>
			</div>
			<div class="row">
				<div class="col-xl-12">
					<div class="contact-form contact-page">
						<form id="contact-form" name="contact_form" class="default-form2"
							action="https://mehedi.asiandevelopers.com/demo/carepress/{{ asset('site_assets') }}/inc/sendmail.php"
							method="post">
							<div class="row">
								<div class="col-xl-4 col-lg-4">
									<div class="input-box">
										<input type="text" name="form_name" value="" placeholder="Your name" required="">
										<div class="icon">
											<span class="icon-user"></span>
										</div>
									</div>
								</div>
								<div class="col-xl-4 col-lg-4">
									<div class="input-box">
										<input type="email" name="form_email" value="" placeholder="Email address"
											required="">
										<div class="icon">
											<span class="icon-envelope"></span>
										</div>
									</div>
								</div>
								<div class="col-xl-4 col-lg-4">
									<div class="input-box">
										<select class="selectpicker" data-width="100%">
											<option selected="selected">Select Subject</option>
											<option>Pet Grooming</option>
											<option>Dog Setting</option>
											<option>Healthy Meals</option>
											<option>Veterinary Service</option>
										</select>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-xl-6">
									<div class="input-box">
										<input type="text" name="form_phone" value="" placeholder="Phone number">
										<div class="icon">
											<span class="icon-phone"></span>
										</div>
									</div>
								</div>
								<div class="col-xl-6">
									<div class="input-box">
										<input type="text" name="form_subject" value="" placeholder="Subject">
										<div class="icon">
											<span class="icon-pen"></span>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-xl-12">
									<div class="input-box">
										<textarea name="form_message" placeholder="Write message" required=""></textarea>

									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xl-12">
									<div class="button-box text-center">
										<input id="form_botcheck" name="form_botcheck" class="form-control" type="hidden"
											value="">
										<button class="btn-one gradient-bg-1" type="submit"
											data-loading-text="Please wait...">
											<span class="txt"><i class="icon-send"></i>Submit Now</span>
										</button>
									</div>
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--End Contact Form Style1 Area-->



@endsection