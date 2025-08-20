<!--start footer section-->
<footer>
	<section class="py-4 " style="    background: #80808029;">
		<div class="container">
			<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-4">
				@php
					use App\Models\ContactInfo;
					$contactFooter = ContactInfo::first();
				@endphp
				<!-- Contact Info -->
				<div class="col">
					<div class="footer-section1 mb-3">
						<h6 class="mb-3 text-uppercase text-gray">Contact Info</h6>
						<div class="address mb-3">
							<p class="mb-0 text-uppercase text-gray">Address</p>
							<p class="mb-0 font-12 text-gray">
								{{ $contactFooter->address ?? "Unit 7 Lotherton Way Garforth Leeds LS252JY"}}</p>
						</div>
						<div class="phone mb-3">
							<p class="mb-0 text-uppercase text-gray">Phone</p>
							<p class="mb-0 font-13 text-gray">Toll Free:
								{{ $contactFooter->contact_number ?? '01132 874724' }}</p>
							<!-- <p class="mb-0 font-13">Mobile: +91-9810XXXXXX</p> -->
						</div>
						<div class="email mb-3">
							<p class="mb-0 text-uppercase text-gray">Email</p>
							<p class="mb-0 font-13 text-gray">{{ $contactFooter->email ?? 'andy@nuvemprint.com' }}</p>
						</div>
						<div class="working-days mb-3">
							<p class="mb-0 text-uppercase text-gray">WORKING HOURS</p>
							<p class="mb-0 font-13 text-gray">Mon - Sat / 9:00 AM - 7:00 PM</p>
						</div>
					</div>
				</div>

				<!-- Shop Categories -->
				<div class="col">
					<div class="footer-section2 mb-3">
						<h6 class="mb-3 text-uppercase text-gray">Booklet Types</h6>
						<ul class="list-unstyled">
							<?php $fsubcates = footerSubCategories(); ?>
							@if(isset($fsubcates) && count($fsubcates) > 0)
								@foreach($fsubcates as $fsubcate)
									<li class="mb-1"><a
											href="{{ route('subcategory-details', ['slug' => $fsubcate->slug]) }}"><i
												class='bx bx-chevron-right'></i>{{$fsubcate->name}}</a></li>
								@endforeach
							@endif

						</ul>
					</div>
				</div>

				<!-- Popular Tags -->
				<div class="col">
					<div class="footer-section3 mb-3">
						<h6 class="mb-3 text-uppercase text-gray">Popular Tags</h6>
						<div class="tags-box">
							<a href="#" class="tag-link text-gray">Booklets</a>
							<a href="#" class="tag-link text-gray">Perfect Bound</a>
							<a href="#" class="tag-link text-gray">Saddle Stitch</a>
							<a href="#" class="tag-link text-gray">Wire-O</a>
							<a href="#" class="tag-link text-gray">Magazine</a>
							<a href="#" class="tag-link text-gray">Catalogs</a>
							<a href="#" class="tag-link text-gray">Lookbook</a>
							<a href="#" class="tag-link text-gray">Print Customization</a>
							<a href="#" class="tag-link text-gray">Cover Lamination</a>
							<a href="#" class="tag-link text-gray">Premium Paper</a>
							<a href="#" class="tag-link text-gray">Bulk Orders</a>
							<a href="#" class="tag-link text-gray">Express Delivery</a>
							<a href="#" class="tag-link text-gray">Design Templates</a>

						</div>
					</div>
				</div>

				<!-- Subscribe + App Download -->
				<!-- <div class="col">
							<div class="footer-section4 mb-3">
								<h6 class="mb-3 text-uppercase text-gray">Stay Updated</h6>
								<div class="subscribe">
									<input type="text" class="form-control radius-30" placeholder="Enter Your Email" />
									<div class="mt-2 d-grid">
										<a href="#" class="btn btn-gray btn-ecomm radius-30">Subscribe</a>
									</div>
									<p class="mt-2 mb-0 font-13 text-gray">Get the latest updates on discounts, print tips, and
										design trends.</p>
								</div>
								
							</div>
						</div> -->
				<!-- Dynamic Pages -->
				@php
					use App\Models\Page;
					$footerPages = Page::where('status', 'published')->get();
				@endphp

				<div class="col">
					<div class="footer-section mb-3">
						<h6 class="mb-3 text-uppercase text-gray">Pages</h6>
						<ul class="list-unstyled">
							@foreach($footerPages as $page)
								<li class="mb-1">
									<a href="{{ route('page.show', $page->slug) }}">
										<i class='bx bx-chevron-right'></i> {{ $page->page_name }}
									</a>
								</li>
							@endforeach
						</ul>
					</div>
				</div>

			</div>

			<hr />

			<!-- Footer Bottom -->
			<div class="row row-cols-1 row-cols-md-2 align-items-center">
				<div class="col">
					<p class="mb-0 text-gray">Copyright © 2025 Nuvem Print. All rights reserved.</p>
				</div>
				<!-- <div class="col text-end">
							<div class="payment-icon">
								<div class="row row-cols-auto g-2 justify-content-end">
									<div class="col"><img src="assets/images/icons/visa.png" alt="Visa" /></div>
									<div class="col"><img src="assets/images/icons/paypal.png" alt="Paypal" /></div>
									<div class="col"><img src="assets/images/icons/mastercard.png" alt="MasterCard" />
									</div>
									<div class="col"><img src="assets/images/icons/american-express.png"
											alt="American Express" /></div>
								</div>
							</div>
						</div> -->
			</div>
			<!-- End Footer Bottom -->
		</div>
	</section>
</footer>

<!--end footer section-->
<!--start quick view product-->
<!-- Modal -->
<div class="modal fade" id="QuickViewProduct">
	<div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-xl-down">
		<div class="modal-content bg-dark-4 rounded-0 border-0">
			<div class="modal-body">
				<button type="button" class="btn-close float-end" data-bs-dismiss="modal"></button>
				<div class="row g-0">
					<div class="col-12 col-lg-6">
						<div class="image-zoom-section">
							<div class="product-gallery owl-carousel owl-theme border mb-3 p-3" data-slider-id="1">
								<div class="item">
									<img src="{{ URL::asset('assets/images/product-gallery/01.png') }}"
										class="img-fluid" alt="">
								</div>
								<div class="item">
									<img src="{{ URL::asset('assets/images/product-gallery/02.png') }}"
										class="img-fluid" alt="">
								</div>
								<div class="item">
									<img src="{{ URL::asset('assets/images/product-gallery/03.png') }}"
										class="img-fluid" alt="">
								</div>
								<div class="item">
									<img src="{{ URL::asset('assets/images/product-gallery/04.png') }}"
										class="img-fluid" alt="">
								</div>
							</div>
							<div class="owl-thumbs d-flex justify-content-center" data-slider-id="1">
								<button class="owl-thumb-item">
									<img src="{{ URL::asset('assets/images/product-gallery/01.png') }}" class="" alt="">
								</button>
								<button class="owl-thumb-item">
									<img src="{{ URL::asset('assets/images/product-gallery/02.png') }}" class="" alt="">
								</button>
								<button class="owl-thumb-item">
									<img src="{{ URL::asset('assets/images/product-gallery/03.png') }}" class="" alt="">
								</button>
								<button class="owl-thumb-item">
									<img src="{{ URL::asset('assets/images/product-gallery/04.png') }}" class="" alt="">
								</button>
							</div>
						</div>
					</div>
					<div class="col-12 col-lg-6">
						<div class="product-info-section p-3">
							<h3 class="mt-3 mt-lg-0 mb-0">Allen Solly Men's Polo T-Shirt</h3>
							<div class="product-rating d-flex align-items-center mt-2">
								<div class="rates cursor-pointer font-13"> <i class="bx bxs-star text-warning"></i>
									<i class="bx bxs-star text-warning"></i>
									<i class="bx bxs-star text-warning"></i>
									<i class="bx bxs-star text-warning"></i>
									<i class="bx bxs-star text-light-4"></i>
								</div>
								<div class="ms-1">
									<p class="mb-0">(24 Ratings)</p>
								</div>
							</div>
							<div class="d-flex align-items-center mt-3 gap-2">
								<h5 class="mb-0 text-decoration-line-through text-light-3">$98.00</h5>
								<h4 class="mb-0">$49.00</h4>
							</div>
							<div class="mt-3">
								<h6>Discription :</h6>
								<p class="mb-0">Virgil Abloh’s Off-White is a streetwear-inspired collection
									that continues to break away from the conventions of mainstream fashion.
									Made in Italy, these black and brown Odsy-1000 low-top sneakers.</p>
							</div>
							<dl class="row mt-3">
								<dt class="col-sm-3">Product id</dt>
								<dd class="col-sm-9">#BHU5879</dd>
								<dt class="col-sm-3">Delivery</dt>
								<dd class="col-sm-9">Russia, USA, and Europe</dd>
							</dl>
							<div class="row row-cols-auto align-items-center mt-3">
								<div class="col">
									<label class="form-label">Quantity</label>
									<select class="form-select form-select-sm">
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
									</select>
								</div>
								<div class="col">
									<label class="form-label">Size</label>
									<select class="form-select form-select-sm">
										<option>S</option>
										<option>M</option>
										<option>L</option>
										<option>XS</option>
										<option>XL</option>
									</select>
								</div>
								<div class="col">
									<label class="form-label">Colors</label>
									<div class="color-indigators d-flex align-items-center gap-2">
										<div class="color-indigator-item bg-primary"></div>
										<div class="color-indigator-item bg-danger"></div>
										<div class="color-indigator-item bg-success"></div>
										<div class="color-indigator-item bg-warning"></div>
									</div>
								</div>
							</div>
							<!--end row-->
							<div class="d-flex gap-2 mt-3">
								<a href="javascript:;" class="btn btn-white btn-ecomm"> <i
										class="bx bxs-cart-add"></i>Add to Cart</a> <a href="javascript:;"
									class="btn btn-light btn-ecomm"><i class="bx bx-heart"></i>Add to
									Wishlist</a>
							</div>
						</div>
					</div>
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
</div>
<!--end quick view product-->
<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
<!--End Back To Top Button-->
</div>
<!--end wrapper-->
<!--start switcher-->
<div class="switcher-wrapper">
	<div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
	</div>
	<div class="switcher-body">
		<div class="d-flex align-items-center">
			<h5 class="mb-0 text-uppercase">Theme Customizer</h5>
			<button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
		</div>
		<hr />
		<p class="mb-0">Gaussian Texture</p>
		<hr>
		<ul class="switcher">
			<li id="theme1"></li>
			<li id="theme2"></li>
			<li id="theme3"></li>
			<li id="theme4"></li>
			<li id="theme5"></li>
			<li id="theme6"></li>
		</ul>
		<hr>
		<p class="mb-0">Gradient Background</p>
		<hr>
		<ul class="switcher">
			<li id="theme7"></li>
			<li id="theme8"></li>
			<li id="theme9"></li>
			<li id="theme10"></li>
			<li id="theme11"></li>
			<li id="theme12"></li>
			<li id="theme13"></li>
			<li id="theme14"></li>
			<li id="theme15"></li>
		</ul>
	</div>
</div>
<!--end switcher-->