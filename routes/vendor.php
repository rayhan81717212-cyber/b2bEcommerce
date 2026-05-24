<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\vendor\VendorProductController;
use Illuminate\Support\Facades\Route;

Route::get('/vendor/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'vendor']);

