<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroSlideController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\PortfolioItemController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SiteSettingController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web', 'auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('hero-slides', HeroSlideController::class)->except(['show']);
    Route::resource('materials', MaterialController::class)->except(['show']);
    Route::resource('portfolio-items', PortfolioItemController::class)->except(['show']);
    Route::resource('services', ServiceController::class)->except(['show']);

    Route::get('site-settings', [SiteSettingController::class, 'edit'])->name('site-settings.edit');
    Route::put('site-settings', [SiteSettingController::class, 'update'])->name('site-settings.update');
});
