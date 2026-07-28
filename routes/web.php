<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\EstimateFormController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GalleryDetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ServiceDetailController;
use App\Http\Controllers\ServicesController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/gallery', GalleryController::class)->name('gallery');
Route::get('/gallery/{slug}', GalleryDetailController::class)->name('gallery.show');
Route::get('/products', ProductsController::class)->name('products');
Route::get('/products/{product:slug}', ProductDetailController::class)->name('products.show');
Route::get('/process', ProcessController::class)->name('process');
Route::get('/services', ServicesController::class)->name('services');
Route::get('/services/{service:slug}', ServiceDetailController::class)->name('services.show');
Route::get('/contact', ContactController::class)->name('contact');
Route::post('/contact', [ContactFormController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.submit');
Route::post('/estimate-request', [EstimateFormController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('estimate.submit');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
