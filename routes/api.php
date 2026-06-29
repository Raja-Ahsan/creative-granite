<?php

use App\Http\Controllers\Api\SiteContentController;
use Illuminate\Support\Facades\Route;

Route::get('/site', SiteContentController::class);
