<?php

use App\Http\Controllers\Admin\ContactInquiryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EditorUploadController;
use App\Http\Controllers\Admin\HeroSlideController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\PortfolioItemController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\EmailComposeController;
use App\Http\Controllers\Admin\EmailSettingController;
use App\Http\Controllers\Admin\EmailTemplateController;
use App\Http\Controllers\Admin\SiteSettingController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('hero-slides', HeroSlideController::class)->except(['show']);
    Route::resource('materials', MaterialController::class)->except(['show']);
    Route::resource('portfolio-items', PortfolioItemController::class)->except(['show']);
    Route::resource('services', ServiceController::class)->except(['show']);
    Route::post('editor/upload-image', [EditorUploadController::class, 'store'])->name('editor.upload-image');

    Route::get('site-settings', [SiteSettingController::class, 'edit'])->name('site-settings.edit');
    Route::put('site-settings', [SiteSettingController::class, 'update'])->name('site-settings.update');

    Route::get('email-settings', [EmailSettingController::class, 'edit'])->name('email-settings.edit');
    Route::put('email-settings', [EmailSettingController::class, 'update'])->name('email-settings.update');
    Route::post('email-settings/test', [EmailSettingController::class, 'sendTest'])->name('email-settings.test');

    Route::resource('email-templates', EmailTemplateController::class)->except(['show']);
    Route::get('email/compose', [EmailComposeController::class, 'create'])->name('email.compose');
    Route::post('email/send', [EmailComposeController::class, 'send'])->name('email.send');

    Route::get('contact-inquiries', [ContactInquiryController::class, 'index'])->name('contact-inquiries.index');
    Route::patch('contact-inquiries/mark-all-read', [ContactInquiryController::class, 'markAllRead'])->name('contact-inquiries.mark-all-read');
    Route::get('contact-inquiries/{contactInquiry}', [ContactInquiryController::class, 'show'])->name('contact-inquiries.show');
    Route::delete('contact-inquiries/{contactInquiry}', [ContactInquiryController::class, 'destroy'])->name('contact-inquiries.destroy');
});
