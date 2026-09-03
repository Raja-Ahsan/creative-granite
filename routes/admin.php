<?php

use App\Http\Controllers\Admin\EdgeProfileController;
use App\Http\Controllers\Admin\EstimateRequestController;
use App\Http\Controllers\Admin\ContactPageController;
use App\Http\Controllers\Admin\ContactInquiryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EditorUploadController;
use App\Http\Controllers\Admin\GalleryAlbumController;
use App\Http\Controllers\Admin\HeroSlideController;
use App\Http\Controllers\Admin\InstagramPostController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\MaterialsPageController;
use App\Http\Controllers\Admin\PortfolioItemController;
use App\Http\Controllers\Admin\ProcessStepController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductsPageController;
use App\Http\Controllers\Admin\ProjectTypeController;
use App\Http\Controllers\Admin\ServicePageSectionController;
use App\Http\Controllers\Admin\ServicesPageController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\EmailComposeController;
use App\Http\Controllers\Admin\EmailSettingController;
use App\Http\Controllers\Admin\EmailTemplateController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\WhoWeAreController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('hero-slides', HeroSlideController::class)->except(['show']);
    Route::resource('instagram-posts', InstagramPostController::class)->except(['show']);
    Route::resource('gallery-albums', GalleryAlbumController::class)->except(['show']);
    Route::resource('materials', MaterialController::class)->except(['show']);
    Route::get('materials-page', [MaterialsPageController::class, 'edit'])->name('materials-page.edit');
    Route::put('materials-page', [MaterialsPageController::class, 'update'])->name('materials-page.update');
    Route::resource('product-categories', ProductCategoryController::class)->except(['show']);
    Route::resource('products', ProductController::class)->except(['show']);
    Route::get('products-page', [ProductsPageController::class, 'edit'])->name('products-page.edit');
    Route::put('products-page', [ProductsPageController::class, 'update'])->name('products-page.update');
    Route::put('edge-profiles/section', [EdgeProfileController::class, 'updateSection'])->name('edge-profiles.section.update');
    Route::resource('edge-profiles', EdgeProfileController::class)->except(['show']);
    Route::put('process-steps/section', [ProcessStepController::class, 'updateSection'])->name('process-steps.section.update');
    Route::resource('process-steps', ProcessStepController::class)->except(['show']);
    Route::resource('portfolio-items', PortfolioItemController::class)->except(['show']);
    Route::resource('services', ServiceController::class)->except(['show']);
    Route::get('services-page', [ServicesPageController::class, 'edit'])->name('services-page.edit');
    Route::put('services-page', [ServicesPageController::class, 'update'])->name('services-page.update');
    Route::resource('service-page-sections', ServicePageSectionController::class)->except(['show']);
    Route::post('editor/upload-image', [EditorUploadController::class, 'store'])->name('editor.upload-image');

    Route::get('who-we-are', [WhoWeAreController::class, 'edit'])->name('who-we-are.edit');
    Route::put('who-we-are', [WhoWeAreController::class, 'update'])->name('who-we-are.update');

    Route::get('site-settings', [SiteSettingController::class, 'edit'])->name('site-settings.edit');
    Route::put('site-settings', [SiteSettingController::class, 'update'])->name('site-settings.update');

    Route::get('email-settings', [EmailSettingController::class, 'edit'])->name('email-settings.edit');
    Route::put('email-settings', [EmailSettingController::class, 'update'])->name('email-settings.update');
    Route::post('email-settings/test', [EmailSettingController::class, 'sendTest'])->name('email-settings.test');

    Route::resource('email-templates', EmailTemplateController::class)->except(['show']);
    Route::get('email/compose', [EmailComposeController::class, 'create'])->name('email.compose');
    Route::post('email/send', [EmailComposeController::class, 'send'])->name('email.send');

    Route::get('contact-page', [ContactPageController::class, 'edit'])->name('contact-page.edit');
    Route::put('contact-page', [ContactPageController::class, 'update'])->name('contact-page.update');
    Route::resource('project-types', ProjectTypeController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);

    Route::get('contact-inquiries', [ContactInquiryController::class, 'index'])->name('contact-inquiries.index');
    Route::patch('contact-inquiries/mark-all-read', [ContactInquiryController::class, 'markAllRead'])->name('contact-inquiries.mark-all-read');
    Route::get('contact-inquiries/{contactInquiry}', [ContactInquiryController::class, 'show'])->name('contact-inquiries.show');
    Route::delete('contact-inquiries/{contactInquiry}', [ContactInquiryController::class, 'destroy'])->name('contact-inquiries.destroy');

    Route::get('estimate-requests', [EstimateRequestController::class, 'index'])->name('estimate-requests.index');
    Route::patch('estimate-requests/mark-all-read', [EstimateRequestController::class, 'markAllRead'])->name('estimate-requests.mark-all-read');
    Route::get('estimate-requests/{estimateRequest}', [EstimateRequestController::class, 'show'])->name('estimate-requests.show');
    Route::delete('estimate-requests/{estimateRequest}', [EstimateRequestController::class, 'destroy'])->name('estimate-requests.destroy');
});
