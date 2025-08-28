<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutControlller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GoogleController;
use App\Models\ContactInfo;

/*
|--------------------------------------------------------------------------
| Site Routes
|--------------------------------------------------------------------------
|
| Here is where you can register site routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| not contains the middleware group. Now create something great!
|
*/

Route::get('/artisan', function () {
    \Artisan::call('cache:clear');
    \Artisan::call('config:clear');
    \Artisan::call('route:clear');
    // \Artisan::call('optimize');
    dd('cleared');
});
Route::get("/pass", function () {
    echo Hash::make("Empire@123#$");
});
Route::get('/stl', function () {
    \Artisan::call('storage:link');
    dd('linked');
});
Route::get('/', [SiteController::class, 'index'])->name('home');

Route::get('/page/{slug}', [PageController::class, 'show'])->name('page.show');


Route::get('/category/{slug}', [SiteController::class, 'show'])->name('category.show');

Route::get('/attributes', [SiteController::class, 'attributes'])->name('attributes');
Route::get('/get-attribute-images', [SiteController::class, 'AttributeImages'])->name('get-attribute-images');
Route::post('/get-price', [SiteController::class, 'calculatePrice'])->name('get-price');

Route::get('/get-all-image-conditions', [SiteController::class, 'getAllImageConditions'])->name('get-all-image-conditions');

Route::get('/thank-you', function () {
    return view('front.thank-you');
})->name('thank-you');
Route::get('/how-it-works', function () {
    return view('front.how-it-works');
})->name('how-it-works');


Route::get('/top-form', function () {
    return view('front.top-form');
})->name('top-form');


Route::get('/order/thankyou', function () {
    return view('front.thankyou');
})->name('order.thankyou');


Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update/{index}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{index}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/check-postcode', [CartController::class, 'check'])->name('check.postcode');

Route::get('checkout', [CheckoutControlller::class, 'checkout'])->name('checkout');
Route::post('checkout/submit', [CheckoutControlller::class, 'checkoutSubmit'])->name('checkout.submit');

Route::get('/payment-success', [CheckoutControlller::class, 'success'])->name('payment.success');
Route::get('/payment-cancel', [CheckoutControlller::class, 'cancel'])->name('payment.cancel');


Route::get('order-tracking', function () {
    return view('front.order-tracking');
})->name('order-tracking');

Route::get('about-us', function () {
    return view('front.about-us');
})->name('about-us');

Route::get('services', function () {
    return view('front.services');
})->name('services');

Route::get('contact-us', function () {
    $contact = ContactInfo::first();
    return view('front.contact-us', compact('contact'));
})->name('contact-us');

Route::get('ser-pet-grooming', function () {
    return view('front.ser-pet-grooming');
})->name('ser-pet-grooming');

Route::get('ser-dog-setting', function () {
    return view('front.ser-dog-setting');
})->name('ser-dog-setting');

Route::get('ser-healthy-meals', function () {
    return view('front.ser-healthy-meals');
})->name('ser-healthy-meals');

Route::get('ser-veterinary-service', function () {
    return view('front.ser-veterinary-service');
})->name('ser-veterinary-service');

Route::get('shop', function () {
    return view('front.shop');
})->name('shop');

Route::get('shop-details', function () {
    return view('front.shop-details');
})->name('shop-details');

Route::get('team', function () {
    return view('front.team');
})->name('team');

Route::get('blog-details', function () {
    return view('front.blog-details');
})->name('blog-details');

Route::get('error', function () {
    return view('front.error');
})->name('error');


Route::get('blogs', [BlogController::class, 'publicIndex'])->name('blogs');
Route::get('/blog/{slug}', [BlogController::class, 'publicShow'])->name('blogs.show');
Route::get('/blogs/search', [BlogController::class, 'search'])->name('blogs.search');

Route::get('faq', [FaqController::class, 'publicIndex'])->name('faq');

Route::post('states-by-country', [CustomerController::class, 'statesByCountry'])->name('states-by-country');
Route::post('cities-by-state', [CustomerController::class, 'citiesByState'])->name('cities-by-state');

Route::controller(GoogleController::class)->group(function () {
    Route::get('customer/google/redirect', 'redirectToGoogle')->name('google.redirect');
    Route::middleware(['web'])->get('customer/google/callback', 'handleGoogleCallback')->name('google.callback');
});

Route::get('authentication-signin', function () {
    return view('front.authentication-signin');
})->name('authentication-signin');

Route::get('authentication-signup', function () {
    return view('front.authentication-signup');
})->name('authentication-signup');

Route::get('/customer-data/{id}', [CustomerController::class, 'getCustomerData']);


Route::middleware(['web'])->group(function () {

    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customer-data', 'getCustomerData');

        Route::get('add-required-details', 'addRequiredDetails')->name('first.details');
        Route::post('/check-email', 'checkEmail')->name('check-email');
        Route::get('account/verify/{token}', 'verifyAccount')->name('customer.verify');
        Route::post('/customer-register', 'register')->name('customer-register');
        Route::post('/authenticate', 'authenticate')->name('customer.authenticate');

        Route::post('first/add-details/store', 'storeRequiredDetails')->name('first.details.store');
        Route::get('authentication-forgot-password', 'showForgetPasswordForm')->name('authentication-forgot-password.get');
        Route::post('authentication-forgot-password', 'submitForgetPasswordForm')->name('authentication-forgot-password.post');
        Route::get('reset-password/{token}', 'showResetPasswordForm')->name('reset.password.get');
        Route::post('reset-password', 'submitResetPasswordForm')->name('reset.password.post');
    });


    Route::get('shop-categories', [SiteController::class, 'shopCategories'])->name('shop-categories');


    // Update front routes and functions start
    Route::middleware(['auth:customer'])->group(function () {
        Route::get('account-dashboard', [CustomerController::class, 'dashboard'])->name('account-dashboard');
        Route::get('account-orders', [CustomerController::class, 'orders'])->name('account-orders');
        Route::get('/view-invoice/{quote}', [CustomerController::class, 'viewInvoice'])->name('view-invoice');
        Route::get('/order-details/{quote}', [CustomerController::class, 'orderDetails'])->name('order-details');
        Route::get('account-downloads', [CustomerController::class, 'downloads'])->name('account-downloads');
        Route::get('account-addresses', [CustomerController::class, 'addresses'])->name('account-addresses');
        Route::get('account-payment-methods', [CustomerController::class, 'paymentmethods'])->name('account-payment-methods');
        Route::get('account-user-details', [CustomerController::class, 'userDetails'])->name('account-user-details');

        Route::post('profile-update', [CustomerController::class, 'updateProfile'])->name('profile.update');
        Route::post('profile-pic-update', [CustomerController::class, 'updateProfilePic'])->name('profile-pic.update');
        Route::post('profile-password-update', [CustomerController::class, 'changePassword'])->name('profile-password.update');

        Route::post('addresses-store', [CustomerController::class, 'addressStore'])->name('addresses.store');



        Route::get('account-logout', [CustomerController::class, 'logout'])->name('account-logout');
    });
});