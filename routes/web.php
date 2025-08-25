<?php

use App\Http\Controllers\Admin\AttributeGroupController;
use App\Http\Controllers\Admin\AttributeGroupSubcategoryAssignmentController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CentralizedPaperPricingController;
use App\Http\Controllers\Admin\ContactInfoController;
use App\Http\Controllers\Admin\CustomerEstimateController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\ImageSettingController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PaperRatesController;
use App\Http\Controllers\Admin\PaperWeightRatesController;
use App\Http\Controllers\Admin\QuotePricingController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AttributeValueController;
use App\Http\Controllers\Admin\Sra3SheetController;
use App\Http\Controllers\Admin\SubcategoryAttributeController;
use App\Http\Controllers\Admin\AttributeConditionController;
use App\Http\Controllers\Admin\PricingRuleController;
use App\Http\Controllers\Admin\QuoteController;

use App\Http\Controllers\Admin\VatController;
use App\Http\Controllers\DeliveryChargeController;
use App\Http\Controllers\PostalCodeController;
use App\Http\Controllers\ProofReadingController;
use App\Models\Attribute;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    HomeController,
    CategoryController,
    SubCategoryController,
};
use App\Http\Controllers\Admin\BookTypeController;
use App\Http\Controllers\Admin\PageTypeController;
use App\Http\Controllers\Admin\PageRangeController;
use App\Http\Controllers\Admin\QuantityRangeController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/foo', function () {
    $target = '/var/www/vhosts/bookempire.co.uk/httpdocs/storage/app/public';
    $shortcut = '/var/www/vhosts/bookempire.co.uk/httpdocs/public/storage';
    symlink($target, $shortcut);
});
Auth::routes(['register' => false]);


Route::group(['middleware' => 'auth'], function () {

    Route::get('/profile', [HomeController::class, 'profile'])
        ->name('profile.show');

    Route::get('/settings', [HomeController::class, 'profileSettings'])
        ->name('profile.setting');

    Route::post('social-form-submission', [HomeController::class, 'socialFormSubmit'])
        ->name('social-form.submit');

    Route::post('user-info-form-submission', [HomeController::class, 'userInfoSubmit'])
        ->name('user-bio.submit');

    Route::post('user-basic-info-submission', [HomeController::class, 'userBasicInfoSubmit'])
        ->name('user-basicinfo.submit');

    Route::post('change-password', [HomeController::class, 'changePassword'])
        ->name('change-password');

    Route::get('save-basic-settings', [HomeController::class, 'basicSettingSubmit'])
        ->name('basic-setting.save');

    Route::get('get-states', [HomeController::class, 'getStateList'])
        ->name('get-states');

    Route::get('get-cities', [HomeController::class, 'getCityList'])
        ->name('get-cities');

    // Route for Site Meta Tags
    Route::get('site/metas', [HomeController::class, 'manageSiteMetas'])->name('admin.manageSiteMetas');
    Route::get('site/meta/edit/{id}', [HomeController::class, 'editMetaContent'])->name('admin.editMetaContent');
    Route::post('update/site/metas', [HomeController::class, 'updateSiteMetas'])->name('admin.updateSiteMetas');
});




Route::group(['middleware' => 'auth'], function () {
    Route::name('admin.')->group(function () {

        Route::get('/home', [HomeController::class, 'index'])
            ->name('home');

        Route::get('customers', [CustomerEstimateController::class, 'index'])->name('customers');
        Route::get('customers/detail/{id}', [CustomerEstimateController::class, 'detail'])->name('customers.detail');
        Route::delete('customer/{id}', [CustomerEstimateController::class, 'destroy'])->name('customer.destroy');
        Route::get('quote-request', [QuoteController::class, 'index'])->name('quote.request');
        Route::get('order-details/{id}', [QuoteController::class, 'show'])->name('quote.show');
        Route::get('/quotes/{id}/download-pdf', [QuoteController::class, 'downloadPdf'])->name('quotes.download.pdf');
        Route::post('/quotes/update-status', [QuoteController::class, 'updateStatus'])->name('quotes.update.status');
        Route::post('/quotes/update-department', [QuoteController::class, 'processToDepartment'])->name('quote.update-department');
        Route::get('/quote/{quote}/invoice', [QuoteController::class, 'viewInvoice'])->name('quotes.invoice');
        Route::post('/quotes/payment-submit', [QuoteController::class, 'submitPayment'])->name('quotes.payment.submit');
        Route::get('/invoices/download/{quote}', [QuoteController::class, 'downloadInvoice'])->name('invoices.download');
        Route::post('/quotes/update-note', [QuoteController::class, 'updateNote'])->name('quote.update-note');



        Route::get('header-contact', [ContactInfoController::class, 'index'])->name('header-contact.index');
        Route::get('header-contact/create', [ContactInfoController::class, 'create'])->name('header-contact.create');
        Route::post('header-contact', [ContactInfoController::class, 'store'])->name('header-contact.store');
        Route::get('header-contact/{id}/edit', [ContactInfoController::class, 'edit'])->name('header-contact.edit');
        Route::post('header-contact/update/{id}', [ContactInfoController::class, 'update'])->name('header-contact.update');


        // Route::view('quote-request', 'admin.customer_estimates.quote_request')->name('quote.request');
        Route::view('order-details', 'admin.quotes.index')->name('quote.index');
        Route::resource('manage-department', DepartmentController::class);

        Route::view('content/manage-page-content', 'admin.content.manage_page_content')->name('content.manage.page.content');

        Route::get('content/faq', [FaqController::class, 'index'])->name('content.faq');
        Route::post('/faqs/store', [FaqController::class, 'store'])->name('faqs.store');
        Route::post('faqs/update/{id}', [FaqController::class, 'update'])->name('faqs.update');
        Route::delete('faqs/delete/{id}', [FaqController::class, 'destroy'])->name('faqs.delete');
        Route::get('faqs/edit/{id}', [FaqController::class, 'edit'])->name('faqs.edit');


        Route::get('content/blogs', [BlogController::class, 'index'])->name('content.blogs');
        Route::post('/blogs/store', [BlogController::class, 'store'])->name('content.blogs.store');
        Route::get('content/blogs/create', [BlogController::class, 'create'])->name('content.blogs.create');
        Route::get('content/blogs/{id}/edit', [BlogController::class, 'edit'])->name('content.blogs.edit');
        Route::delete('content/blogs/{id}', [BlogController::class, 'destroy'])->name('content.blogs.destroy');
        Route::post('content/blogs/update/{id}', [BlogController::class, 'update'])->name('content.blogs.update');

        Route::get('content/dynamic-pages', [PageController::class, 'index'])->name('content.dynamic.pages');
        Route::prefix('pages')->name('pages.')->group(function () {
            Route::post('/store', [PageController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [PageController::class, 'edit'])->name('edit');
            Route::post('/{id}/update', [PageController::class, 'update'])->name('update');
            Route::delete('/{id}', [PageController::class, 'destroy'])->name('destroy');
        });



        // ===== Category MANAGEMENT ROUTES ===== //
        Route::resource('manage-categories', CategoryController::class);
        Route::resource('manage-subcategories', SubCategoryController::class);


        // ===== Dynamic Quote System ===== //
        Route::resource('attributes', AttributeController::class);
        Route::resource('attribute-groups', AttributeGroupController::class);
        Route::resource('attribute-values', AttributeValueController::class);
        Route::resource('group-assignments', AttributeGroupSubcategoryAssignmentController::class);
        Route::resource('subcategory-attributes', SubcategoryAttributeController::class);
        Route::resource('attribute-conditions', AttributeConditionController::class);
        Route::resource('pricing-rules', PricingRuleController::class);
        Route::resource('quotes', QuoteController::class);
        Route::resource('extra_options', \App\Http\Controllers\Admin\ExtraOptionController::class);

        Route::resource('images', ImageSettingController::class);


        Route::prefix('centralized-paper-pricing')->name('centralized-paper-pricing.')->group(function () {
            Route::resource('/', CentralizedPaperPricingController::class);
        });

        Route::prefix('sra3-sheet')->name('sra3-sheets.')->group(function () {
            Route::resource('/', Sra3SheetController::class)->only(['create', 'edit', 'store', 'update'])->parameters([
                '' => 'attribute' // means resource will use {attribute} instead of {sra3_sheet}
            ]);
        });

        Route::prefix('paper-rates')->name('paper-rates.')->group(function () {
            Route::resource('/', PaperRatesController::class)->only(['create', 'edit', 'store', 'update'])->parameters([
                '' => 'attribute' // means resource will use {attribute} instead of {sra3_sheet}
            ]);
        });

        Route::prefix('paper-weight-rates')->name('paper-weight-rates.')->group(function () {
            Route::resource('/', PaperWeightRatesController::class)->only(['create', 'edit', 'store', 'update'])->parameters([
                '' => 'attribute' // means resource will use {attribute} instead of {sra3_sheet}
            ]);
        });


        Route::get('attributes/{id}/values', [AttributeValueController::class, 'getValues']);
        Route::get('subcategories/{id}/attributes', [AttributeConditionController::class, 'getSubcategoryAttributes']);

        Route::resource('proof-reading', ProofReadingController::class);
        Route::resource('delivery-charges', DeliveryChargeController::class);
        Route::resource('postal-codes', PostalCodeController::class);
        Route::resource('manage-vat', VatController::class);


        // ===== Quote Pricing ===== //
        Route::resource('quote-pricing', QuotePricingController::class);
        Route::get('quote-pricing/step2/{quote}', [QuotePricingController::class, 'step2'])
            ->name('quote-pricing.step2');
        Route::post('quote-pricing/step2/save/{quote}', [QuotePricingController::class, 'step2Save'])
            ->name('quote-pricing.step2.save');
    });
});
