@extends('layouts.new-master')

@section('title')
	Home
@endsection

@section('content')


	<!-- Start Main Slider -->
	<section class="main-slider style1">
		<div class="slider-box">
			<!-- Banner Carousel -->
			<div class="banner-carousel owl-theme owl-carousel">
				<!-- Slide -->
				<div class="slide">
					<div class="image-layer"
						style="background-image:url({{ asset('site_assets') }}/images/slides/slide-v1-2.png)"></div>
					<div class="auto-container">
						<div class="content">
							<h5>//<span>Turn Moments into Masterpieces</span>//</h5>
							<h2>Beautifully hand-crafted <br> portraits designed just for you<span class="round"></span>
							</h2>
							<div class="btns-box">
								@php
									use App\Models\Category;
									$categories = Category::latest()->get();
									$firstCategory = $categories->first();
								@endphp

								@if($firstCategory)
									<a class="btn-one" href="{{ route('category.show', $firstCategory->slug) }}">
										<span class="txt">{{ $firstCategory->name }}</span>
									</a>

								@endif

								<a class="btn-one marleft style2" href="#"><span class="txt">+01132 874724</span></a>
							</div>
						</div>
					</div>
				</div>
				<!-- Slide -->
				<div class="slide">
					<div class="image-layer"
						style="background-image:url({{ asset('site_assets') }}/images/slides/slide-v1-2.png)"></div>
					<div class="auto-container">
						<div class="content">
							<h5>//<span>Custom Portraits of Pets, People & More</span>//</h5>
							<h2>Celebrate what you love <br> with art that lasts forever.<span class="round"></span></h2>
							<div class="btns-box">
								@if($firstCategory)
									<a class="btn-one" href="{{ route('category.show', $firstCategory->slug) }}">
										<span class="txt">{{ $firstCategory->name }}</span>
									</a>

								@endif
								<a class="btn-one marleft style2" href="#"><span class="txt">+01132 874724</span></a>
							</div>
						</div>
					</div>
				</div>
				<!-- Slide -->

			</div>
		</div>
	</section>
	<!-- End Main Slider paroller -->

	<!--Start Featured Area-->
	<section class="featured-area">
		<div class="container">
			<div class="row">
				<!--Start Single Featured Box-->
				<div class="col-xl-4">
					<div class="single-featured-box">
						<div class="inner">
							<div class="icon">
								<img src="{{ asset('site_assets') }}/images/slides/friend.png" style="width:60px;">
							</div>
							<div class="text">
								<h3>Peoples</h3>
								<p>Capture your cherished memories in timeless portraits.</p>
							</div>
						</div>
					</div>
				</div>
				<!--End Single Featured Box-->
				<!--Start Single Featured Box-->
				<div class="col-xl-4">
					<div class="single-featured-box">
						<div class="inner">
							<div class="icon">
								<span class="icon-dog"></span>
							</div>
							<div class="text">
								<h3>Pets</h3>
								<p>Celebrate your furry friends with art full of love and detail.</p>
							</div>
						</div>
					</div>
				</div>
				<!--End Single Featured Box-->
				<!--Start Single Featured Box-->
				<div class="col-xl-4">
					<div class="single-featured-box">
						<div class="inner">
							<div class="icon">
								<img src="{{ asset('site_assets') }}/images/slides/graphic-design-software.png"
									style="width:60px;">
							</div>
							<div class="text">
								<h3>Illustrations</h3>
								<p>Bring ideas to life with creative and personalised illustrations.</p>
							</div>
						</div>
					</div>
				</div>
				<!--End Single Featured Box-->
			</div>
		</div>
	</section>
	<!--End Featured Area-->

	<!--Start About Style1 Area-->
	<section class="about-style1-area">
		<div class="container">
			<div class="row">
				<div class="col-xl-7">
					<div class="about-style1-image-box">
						<div class="about-style1-image-box-bg"
							style="background-image: url({{ asset('site_assets') }}/images/shape/about-style1-image-box-bg.png)">
						</div>
						<div class="main-image">
							<img src="{{ asset('site_assets') }}/images/about/about-1.png" alt="Awesome Image">
						</div>
						<div class="about-experience-box">
							<div class="count-box">
								<h2>
									<span class="timer" data-from="1" data-to="10" data-speed="5000"
										data-refresh-interval="50">1020</span>
									<span class="icon-plus plus-icon"></span>
								</h2>
								<h5>Years Experience</h5>
							</div>
						</div>
					</div>
				</div>

				<div class="col-xl-5">
					<div class="about-style1-content-box">
						<div class="sec-title">
							<h5>//<span>About Us</span>//</h5>
							<h2>Creating Custom Frames<br> For Every Memory<span class="round-box zoominout"></span></h2>
						</div>
						<div class="inner-content">
							<div class="text">
								<p>With over 10 years of experience, we at PIP Frames specialize in crafting customized
									portraits
									and frames for Pets, People, and Illustrations. Each design is thoughtfully created to
									preserve
									your most precious moments, turning them into timeless pieces of art that bring warmth
									and beauty
									to your space.</p>
							</div>
							<div class="row">
								<div class="col-xl-6">
									<ul>
										<li>
											<div class="icon">
												<span class="icon-tick"></span>
											</div>
											<div class="title">
												<h5>Custom Portrait Experts</h5>
											</div>
										</li>
									</ul>
								</div>
								<div class="col-xl-6">
									<ul>
										<li>
											<div class="icon">
												<span class="icon-tick"></span>
											</div>
											<div class="title">
												<h5>Premium Quality Frames</h5>
											</div>
										</li>
									</ul>
								</div>
								<div class="col-xl-6">
									<ul>
										<li>
											<div class="icon">
												<span class="icon-tick"></span>
											</div>
											<div class="title">
												<h5>10+ Years Experience</h5>
											</div>
										</li>
									</ul>
								</div>
								<div class="col-xl-6">
									<ul>
										<li>
											<div class="icon">
												<span class="icon-tick"></span>
											</div>
											<div class="title">
												<h5>Personalised For Every Story</h5>
											</div>
										</li>
									</ul>
									</d ---- </div>
								</div>
	</section>
	<!--End About Style1 Area-->

	<!-- Start Service Style1 Area -->
	<section class="service-style1-area">
		<div class="shape1">
			<img src="{{ asset('site_assets') }}/images/shape/shape-1.png" alt="">
		</div>
		<div class="shape2">
			<img src="{{ asset('site_assets') }}/images/shape/shape-2.png" alt="">
		</div>
		<div class="container">
			<div class="sec-title text-center">
				<div class="icon">
					<i class="icon-bone"></i>
				</div>
				<h2>What We Do<span class="round-box zoominout"></span></h2>
				<p>At PIP Frames, we transform your memories into beautiful works of art.
					From heartfelt portraits of people and pets to creative custom illustrations,
					each frame is designed with care and precision.
					Our goal is to help you preserve your most special moments in a way that
					adds warmth, meaning, and style to your space.</p>
			</div>

			<div class="row">
				<!--Start Single Service Style1-->
				<div class="col-xl-4 col-lg-6 col-md-6 wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
					<div class="single-service-style1">
						<div class="img-holder">
							<div class="inner">
								<img src="{{ asset('site_assets') }}/images/services/people-frames.jpg"
									alt="People Portraits">
							</div>
						</div>
						<div class="text-holder">
							<h3><a href="#">People</a></h3>
							<p>Custom portraits that capture the essence of your loved ones,
								turning moments into timeless memories.</p>
							<div class="button">
								<a href="#">Read More</a>
							</div>
						</div>
					</div>
				</div>
				<!--End Single Service Style1-->

				<!--Start Single Service Style1-->
				<div class="col-xl-4 col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="100ms" data-wow-duration="1500ms">
					<div class="single-service-style1">
						<div class="img-holder">
							<div class="inner">
								<img src="{{ asset('site_assets') }}/images/services/pet-frames.jpg" alt="Pet Portraits">
							</div>
						</div>
						<div class="text-holder">
							<h3><a href="#">Pets</a></h3>
							<p>Celebrate your furry friends with personalised portraits
								designed with love, detail, and character.</p>
							<div class="button">
								<a href="#">Read More</a>
							</div>
						</div>
					</div>
				</div>
				<!--End Single Service Style1-->

				<!--Start Single Service Style1-->
				<div class="col-xl-4 col-lg-6 col-md-6 wow fadeInRight" data-wow-delay="200ms" data-wow-duration="1500ms">
					<div class="single-service-style1">fe
						<div class="img-holder">
							<div class="inner">
								<img src="{{ asset('site_assets') }}/images/services/illustration-frames.jpg"
									alt="Custom Illustrations">
							</div>
						</div>
						<div class="text-holder">
							<h3><a href="#">Illustrations</a></h3>
							<p>Creative and personalised illustrations that bring your
								imagination and stories beautifully to life.</p>
							<div class="button">
								<a href="#">Read More</a>
							</div>
						</div>
					</div>
				</div>
				<!--End Single Service Style1-->
			</div>
		</div>
	</section>

	<!-- End Service Style1 Area -->

	<!--Start Video Gallery Area-->
	<section class="video-gallery-area">
		<div class="container-fullwidth">
			<div class="row">
				<!-- Left Content -->
				<div class="col-xl-6">
					<div class="video-gallery-content-box text-center">
						<!-- <img src="{{ asset('site_assets') }}/images/resources/video-gallery-image.png" alt="Custom Frames"> -->
						<h2>Preserve Your Memories<br> With Custom Frames</h2>
						<p>At PIP Frames, we create stunning customised portraits and frames for People, Pets,
							and Illustrations. Each piece is designed with care to turn your most cherished
							moments into timeless works of art you’ll treasure forever.</p>
						<div class="button">
							@if($firstCategory)

								<a class="btn-one" href="{{ route('category.show', $firstCategory->slug) }}"><i
										class="fa fa-shopping-cart" aria-hidden="true"></i>
									<span class="txt">{{ $firstCategory->name }}</span>
								</a>

							@endif
						</div>
					</div>
				</div>

				<!-- Right Video Section -->
				<div class="col-xl-6">
					<div class="video-holder-box text-center"
						style="background-image: url({{ asset('site_assets') }}/images/resources/video-gallery-bg.jpg)">
						<div class="icon wow zoomIn" data-wow-delay="300ms" data-wow-duration="1500ms">
							<a class="video-popup thm-bgclr" title="PIP Frames Video Gallery"
								href="https://www.youtube.com/watch?v=p25gICT63ek">
								<span class="icon-play-button"></span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!--End Video Gallery Area-->

	<!--Start Feautres Area-->
	<section class="feautres-area">
		<div class="container">
			<div class="row">

				<div class="col-xl-6">
					<div class="working-hours-box"
						style="background-image: url({{ asset('site_assets') }}/images/resources/working-hours-box-bg.jpg)">
						<div class="inner-content">
							<div class="title">
								<h3>Working Hours<span></span></h3>
								<p>We are available round the clock, to build your memories forever</p>
							</div>
							<ul>
								<li><span class="left">Monday</span> <span class="right">08AM - 10PM</span></li>
								<li><span class="left">Thuesday</span> <span class="right">08AM - 10PM</span></li>
								<li><span class="left">Wednesday</span> <span class="right">08AM - 10PM</span></li>
								<li><span class="left">Thursday</span> <span class="right">08AM - 10PM</span></li>
								<li><span class="left">Friday</span> <span class="right">08AM - 10PM</span></li>
								<li><span class="left">Saturday</span> <span class="right">08AM - 10PM</span></li>
								<li><span class="left">Sunday</span> <span class="right holiday">Holiday</span></li>
							</ul>
						</div>
					</div>
				</div>

				<div class="col-xl-6">
					<div class="feautres-content-box">
						<div class="sec-title">
							<h5>//<span>Highlights</span>//</h5>
							<h2>What our Creativity says<span class="round-box zoominout"></span></h2>
						</div>
						<div class="inner-content">
							<div class="text">
								<p>At PIP Frames, we blend creativity and craftsmanship to deliver portraits and frames
									that stand out. Our features are designed to give you the perfect mix of
									personalisation,
									quality, and timeless value.</p>
							</div>

							<ul class="top">
								<li>
									<div class="inner">
										<div class="icon">
											<span class="icon-design"></span>
										</div>
										<div class="title">
											<h3>Custom Designs</h3>
											<p>Every portrait is tailored to your story and style.</p>
										</div>
									</div>
								</li>
								<li>
									<div class="inner">
										<div class="icon">
											<span class="icon-quality"></span>
										</div>
										<div class="title">
											<h3>Premium Quality</h3>
											<p>Crafted with high-quality materials for lasting beauty.</p>
										</div>
									</div>
								</li>
							</ul>

							<ul class="bottom">
								<li>
									<div class="inner">
										<div class="icon">
											<span class="icon-experience"></span>
										</div>
										<div class="title">
											<h3>10+ Years Experience</h3>
											<p>Trusted expertise in customised portraits & frames.</p>
										</div>
									</div>
								</li>
								<li>
									<div class="inner">
										<div class="icon">
											<span class="icon-delivery"></span>
										</div>
										<div class="title">
											<h3>Worldwide Delivery</h3>
											<p>Safely shipped to your doorstep, anywhere you are.</p>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>


			</div>
		</div>
	</section>
	<!--End Feautres Area-->

	<!--Start Team Area-->
	<!--	<section class="team-area">
			<div class="container">
				<div class="sec-title text-center">
					<div class="icon">
						<i class="icon-bone"></i>
					</div>
					<h2>Our Groomers<span class="round-box zoominout"></span></h2>
				</div>
				<div class="row">
					<!--Start Single Team Member-->
	<!--	<div class="col-xl-3 col-lg-6 col-md-6">
						<div class="single-team-member wow animated fadeInUp" data-wow-delay="0.1s">
							<div class="img-holder">
								<div class="round-top"></div>
								<div class="round-bottom"></div>
								<div class="inner">
									<img src="{{ asset('site_assets') }}/images/team/team-v1-1.png" alt="Awesome Image">
									<div class="overlay-style-one bg1"></div>
								</div>
							</div>
							<div class="title-holder text-center">
								<h5>Founder</h5>
								<h3><a href="#">Rosalina D. William</a></h3>
								<div class="team-social-link">
									<ul>
										<li>
											<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
										</li>
										<li>
											<a class="tw" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
										</li>
										<li>
											<a class="linkedin" href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!--End Single Team Member-->
	<!--Start Single Team Member-->
	<!--	<div class="col-xl-3 col-lg-6 col-md-6">
						<div class="single-team-member wow animated fadeInUp" data-wow-delay="0.3s">
							<div class="img-holder">
								<div class="round-top"></div>
								<div class="round-bottom"></div>
								<div class="inner">
									<img src="{{ asset('site_assets') }}/images/team/team-v1-2.png" alt="Awesome Image">
									<div class="overlay-style-one bg2"></div>
								</div>
							</div>
							<div class="title-holder text-center">
								<h5>CEO</h5>
								<h3><a href="#">Miranda H. Halim</a></h3>
								<div class="team-social-link">
									<ul>
										<li>
											<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
										</li>
										<li>
											<a class="tw" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
										</li>
										<li>
											<a class="linkedin" href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!--End Single Team Member-->
	<!--Start Single Team Member-->
	<!--	<div class="col-xl-3 col-lg-6 col-md-6">
						<div class="single-team-member wow animated fadeInUp" data-wow-delay="0.5s">
							<div class="img-holder">
								<div class="round-top"></div>
								<div class="round-bottom"></div>
								<div class="inner">
									<img src="{{ asset('site_assets') }}/images/team/team-v1-3.png" alt="Awesome Image">
									<div class="overlay-style-one bg2"></div>
								</div>
							</div>
							<div class="title-holder text-center">
								<h5>Groomer</h5>
								<h3><a href="#">Hilixer D. Browni</a></h3>
								<div class="team-social-link">
									<ul>
										<li>
											<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
										</li>
										<li>
											<a class="tw" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
										</li>
										<li>
											<a class="linkedin" href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!--End Single Team Member-->
	<!--Start Single Team Member-->
	<!--	<div class="col-xl-3 col-lg-6 col-md-6">
						<div class="single-team-member wow animated fadeInUp" data-wow-delay="0.7s">
							<div class="img-holder">
								<div class="round-top"></div>
								<div class="round-bottom"></div>
								<div class="inner">
									<img src="{{ asset('site_assets') }}/images/team/team-v1-4.png" alt="Awesome Image">
									<div class="overlay-style-one bg2"></div>
								</div>
							</div>
							<div class="title-holder text-center">
								<h5>Groomer</h5>
								<h3><a href="#">Yokolili Y. Yankee</a></h3>
								<div class="team-social-link">
									<ul>
										<li>
											<a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
										</li>
										<li>
											<a class="tw" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
										</li>
										<li>
											<a class="linkedin" href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!--End Single Team Member-->
	</div>
	</div>
	</section>
	<!--End Team Area-->

	<!--Start priceing plan Area-->
	<section class="priceing-plan-area">
		<div class="container">
			<div class="row">
				<div class="col-xl-12">
					<div class="sec-title">
						<h5>//<span>Insights</span>//</h5>
						<h2>Custom &amp; Style <span class="round-box zoominout"></span></h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-12">
					<div class="priceing-plan-content">
						<div class="priceing-plan-tabs tabs-box">

							<div class="tab-button-column clearfix">
								<ul class="tab-buttons clearfix">
									<li data-tab="#yearly" class="tab-btn active-btn">Easy Delivery</li>
									<!--	<li data-tab="#monthly" class="tab-btn">Monthly</li> -->
								</ul>
							</div>

							<div class="tabs-content">
								<!--Tab-->
								<div class="tab active-tab" id="yearly">
									<div class="priceing-plan-tab-content">
										<div class="row">

											<!-- Pets -->
											<div class="col-xl-4 col-lg-6 col-md-6">
												<div class="single-priceing-plan-box">
													<div class="top">
														<div class="left pull-left">
															<p>Custom Portrait</p>
															<h2>Pets</h2>
														</div>
														<div class="right pull-right">
															<h2><span>$</span>45</h2>
														</div>
													</div>
													<ul>
														<li>Custom Design<span class="icon-tick"></span></li>
														<li>Multiple Design Style<span class="icon-tick"></span></li>
														<li>Colour Selection<span class="icon-tick"></span></li>
														<li>Choose Frame<span class="icon-tick"></span></li>
														<li>Choose Colour<span class="icon-tick"></span></li>
														<li>Multiple Size Options<span class="icon-tick"></span></li>
														<li>Fastest Delivery<span class="icon-tick"></span></li>
														<li>Best Price<span class="icon-tick"></span></li>
													</ul>
													<div class="button">
														@if($firstCategory)
															<a class="btn-one"
																href="{{ route('category.show', $firstCategory->slug) }}"><i
																	class="fa fa-shopping-cart" aria-hidden="true"></i>
																<span class="txt">Customise Now</span>
															</a>

														@endif
													</div>
												</div>
											</div>

											<!-- People -->
											<div class="col-xl-4 col-lg-6 col-md-6">
												<div class="single-priceing-plan-box style2">
													<div class="top">
														<div class="left pull-left">
															<p>Custom Portrait</p>
															<h2>People</h2>
														</div>
														<div class="right pull-right">
															<h2><span>$</span>45</h2>
														</div>
													</div>
													<ul>
														<li>Custom Design<span class="icon-tick"></span></li>
														<li>Multiple Design Style<span class="icon-tick"></span></li>
														<li>Colour Selection<span class="icon-tick"></span></li>
														<li>Choose Frame<span class="icon-tick"></span></li>
														<li>Choose Colour<span class="icon-tick"></span></li>
														<li>Multiple Size Options<span class="icon-tick"></span></li>
														<li>Fastest Delivery<span class="icon-tick"></span></li>
														<li>Best Price<span class="icon-tick"></span></li>
													</ul>
													<div class="button">
														@if($firstCategory)
															<a class="btn-one"
																href="{{ route('category.show', $firstCategory->slug) }}"><i
																	class="fa fa-shopping-cart" aria-hidden="true"></i>
																<span class="txt">Customise Now</span>
															</a>

														@endif
													</div>
												</div>
											</div>

											<!-- Illustrations -->
											<div class="col-xl-4 col-lg-12 col-md-12">
												<div class="single-priceing-plan-box style3">
													<div class="top">
														<div class="left pull-left">
															<p>Custom Portrait</p>
															<h2>Illustrations</h2>
														</div>
														<div class="right pull-right">
															<h2><span>$</span>45</h2>
														</div>
													</div>
													<ul>
														<li>Custom Design<span class="icon-tick"></span></li>
														<li>Multiple Design Style<span class="icon-tick"></span></li>
														<li>Colour Selection<span class="icon-tick"></span></li>
														<li>Choose Frame<span class="icon-tick"></span></li>
														<li>Choose Colour<span class="icon-tick"></span></li>
														<li>Multiple Size Options<span class="icon-tick"></span></li>
														<li>Fastest Delivery<span class="icon-tick"></span></li>
														<li>Best Price<span class="icon-tick"></span></li>
													</ul>
													<div class="button">
														@if($firstCategory)
															<a class="btn-one"
																href="{{ route('category.show', $firstCategory->slug) }}"><i
																	class="fa fa-shopping-cart" aria-hidden="true"></i>
																<span class="txt">Customise Now</span>
															</a>

														@endif
													</div>
												</div>
											</div>

										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--End priceing plan Area-->



	<!--Start Testimonial style1 Area-->
	<section class="testimonial-style1-area">
		<div class="image-box1"><img src="{{ asset('site_assets') }}/images/testimonial/testimonial-image-1.png" alt="">
		</div>
		<div class="image-box2"><img src="{{ asset('site_assets') }}/images/testimonial/testimonial-image-2.png" alt="">
		</div>
		<div class="image-box3 paroller"><img src="{{ asset('site_assets') }}/images/testimonial/testimonial-image-3.png"
				alt=""></div>
		<div class="image-box4 paroller"><img src="{{ asset('site_assets') }}/images/testimonial/testimonial-image-4.png"
				alt=""></div>
		<div class="layer-outer" style="background-image: url({{ asset('site_assets') }}/images/resources/map.png)"></div>
		<div class="container">
			<div class="sec-title text-center">
				<div class="icon">
					<i class="icon-bone"></i>
				</div>
				<h2>Clients Feedback<span class="round-box zoominout"></span></h2>
			</div>
			<div class="row">
				<div class="col-xl-12 col-lg-12">
					<div class="testimonial-carousel owl-carousel owl-theme">

						<!--Start Single Testimonial Style1-->
						<div class="single-testimonial-style1 wow fadeInUp" data-wow-delay="100ms"
							data-wow-duration="1500ms">
							<div class="img-holder">
								<img src="{{ asset('site_assets') }}/images/testimonial/tes-v1-1.png" alt="Customer Image">
							</div>
							<div class="text-holder">
								<h2>Emily Johnson</h2>
								<span>London, UK</span>
								<div class="text-box">
									<p>I ordered a customised portrait frame and it turned out absolutely stunning!
										The quality is far beyond what I expected and it’s now the centrepiece of my living
										room.</p>
								</div>
							</div>
						</div>
						<!--End Single Testimonial Style1-->

						<!--Start Single Testimonial Style1-->
						<div class="single-testimonial-style1 wow fadeInUp" data-wow-delay="200ms"
							data-wow-duration="1500ms">
							<div class="img-holder">
								<img src="{{ asset('site_assets') }}/images/testimonial/tes-v1-2.png" alt="Customer Image">
							</div>
							<div class="text-holder">
								<h2>James Williams</h2>
								<span>Manchester, UK</span>
								<div class="text-box">
									<p>The customised frame I received was perfect!
										From ordering to delivery, everything was smooth and professional.
										I’ll definitely be ordering more as gifts for friends and family.</p>
								</div>
							</div>
						</div>
						<!--End Single Testimonial Style1-->

					</div>
				</div>
			</div>

			<!--End Single Testimonial Style1-->

		</div>
		</div>
		</div>
		</div>
	</section>
	<!--End Testimonial Style1 Area-->

	<!--Start Blog Style1 Area-->
	<section class="blog-style1-area">
		<div class="container">
			<div class="sec-title">
				<h5>//<span>Insights</span>//</h5>
				<h2>Recent Blogs<span class="round-box zoominout"></span></h2>
			</div>
			<div class="row">
				<div class="col-xl-12 col-lg-12">
					<div class="blog-carousel owl-carousel owl-theme owl-nav-style-one">
						<!--Start Single blog Style1-->
						<div class="single-blog-style1 wow fadeInLeft" data-wow-delay="100ms" data-wow-duration="1500ms">
							<div class="img-holder">
								<div class="date-box">
									<h5>24th Aug 2025</h5>
								</div>
								<div class="inner">
									<img src="{{ asset('site_assets') }}/images/blog/blog-v1-1.jpg" alt="Awesome Image">
								</div>
							</div>
							<div class="text-holder">
								<ul class="meta-info">
									<li><span class="icon-user"></span><a href="#">By Admin</a></li>
									<li><span class="icon-tag"></span><a href="#">Pip Frames</a></li>
								</ul>
								<h3 class="blog-title"><a href="blog-single.html">Transform Your Memories into Art: The
										Beauty of Customised Frames
										<span class="round-box zoominout"></span></a></h3>
							</div>
						</div>
						<!--End Single blog Style1-->
						<!--Start Single blog Style1-->
						<div class="single-blog-style1 wow fadeInLeft" data-wow-delay="100ms" data-wow-duration="1500ms">
							<div class="img-holder">
								<div class="date-box">
									<h5>22nd Aug 2025</h5>
								</div>
								<div class="inner">
									<img src="{{ asset('site_assets') }}/images/blog/blog-v1-2.jpg" alt="Awesome Image">
								</div>
							</div>
							<div class="text-holder">
								<ul class="meta-info">
									<li><span class="icon-user"></span><a href="#">By Admin</a></li>
									<li><span class="icon-tag"></span><a href="#">Pip Frames</a></li>
								</ul>
								<h3 class="blog-title"><a href="blog-single.html">Top 5 Gift Ideas with Personalised
										Portrait Frames<span class="round-box zoominout"></span></a></h3>
							</div>
						</div>
						<!--End Single blog Style1-->
						<!--Start Single blog Style1-->
						<div class="single-blog-style1 wow fadeInLeft" data-wow-delay="100ms" data-wow-duration="1500ms">
							<div class="img-holder">
								<div class="date-box">
									<h5>25th July 2025</h5>
								</div>
								<div class="inner">
									<img src="{{ asset('site_assets') }}/images/blog/blog-v1-3.jpg" alt="Awesome Image">
								</div>
							</div>
							<div class="text-holder">
								<ul class="meta-info">
									<li><span class="icon-user"></span><a href="#">By Admin</a></li>
									<li><span class="icon-tag"></span><a href="#">Pip Frames</a></li>
								</ul>
								<h3 class="blog-title"><a href="blog-single.html">Why Custom Frames Make Your Home Decor
										Truly Unique<span class="round-box zoominout"></span></a></h3>
							</div>
						</div>
						<!--End Single blog Style1-->

						<!--Start Single blog Style1-->
						<div class="single-blog-style1 wow fadeInLeft" data-wow-delay="100ms" data-wow-duration="1500ms">
							<div class="img-holder">
								<div class="date-box">
									<h5>20th Aug 2025</h5>
								</div>
								<div class="inner">
									<img src="{{ asset('site_assets') }}/images/blog/blog-v1-1.jpg" alt="Awesome Image">
								</div>
							</div>
							<div class="text-holder">
								<ul class="meta-info">
									<li><span class="icon-user"></span><a href="#">By Admin</a></li>
									<li><span class="icon-tag"></span><a href="#">Pip Frames</a></li>
								</ul>
								<h3 class="blog-title"><a href="blog-single.html">From Pets to People: Creative Ideas for
										Custom Portrait Frames<span class="round-box zoominout"></span></a></h3>
							</div>
						</div>
						<!--End Single blog Style1-->
						<!--Start Single blog Style1-->

						<!--End Single blog Style1-->
						<!--Start Single blog Style1-->




					</div>
				</div>
			</div>
		</div>
	</section>
	<!--End Blog Style1 Area-->

@endsection