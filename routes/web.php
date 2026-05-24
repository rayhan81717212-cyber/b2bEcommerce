<?php

use App\Http\Controllers\Admin\MailController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RoleController;  
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UsersController;

// product controller
use App\Http\Controllers\ProductController;  
use App\Http\Controllers\ProductGalleryController;
use App\Http\Controllers\CategoriesController; 
use App\Http\Controllers\OrderController; 
use App\Http\Controllers\PaymentController; 
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ComissionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Pos\PosController;
use App\Http\Controllers\StockController;

// 
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'admin']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // route================

    // user Route
    Route::resource('user', UsersController::class);
    Route::get('customer', [UsersController::class, 'customerDataGet'])->name('customer');
    Route::get('pending-vendor', [UsersController::class, 'pendingVendors'])->name('pending.vendor');
    Route::get('approved/vendors/{id}', [UsersController::class, 'approvedVendors'])->name('approved.vendor');

    // Role Route
    Route::resource('role', RoleController::class);


    // Product Route
    Route::resource("product",(ProductController::class));
    Route::get('product-pending', [ProductController::class, 'pendingProduct'])->name('product-pending');
    Route::get('search', [ProductController::class, 'search'])->name('product.search');
    Route::get('/product/approved/{id}', [ProductController::class, 'productApproved'])->name('product.approved');
    
    // Product Gallery
    Route::resource("productgallery",(ProductGalleryController::class));
    Route::get('/get-products/{brand_id}', [ProductController::class, 'getProducts']);

    // Categories router
    Route::resource('categories', (CategoriesController::class));

    // Categories router
    Route::resource('brand', (BrandController::class));

    // Categories router
    Route::resource('banner', (BannerController::class));
        

    // order Router
    Route::get('/order', [OrderController::class, 'index'])->name('order');
    Route::get('/cancelled-order', [OrderController::class, 'cancleOrder'])->name('cancelled-order');
    Route::get('/pending-order', [OrderController::class, 'pendingOrder'])->name('pending-order');
    Route::get('/delivered-order', [OrderController::class, 'deliveredOrder'])->name('delivered-order');
    Route::get('/confirmed-order', [OrderController::class, 'confirmedOrder'])->name('confirmed-order');
    Route::get('/processing-order', [OrderController::class, 'processingOrder'])->name('processing-order');
    Route::post('/order-status-update/{id}', [OrderController::class, 'updateOrderStatus'])->name('order.status.update');


    //  pos route
    Route::get('pos-product', [PosController::class, 'posPage'])->name('pos-product');
    Route::get('/pos/cart-data', [PosController::class, 'cartData']);
    Route::post('/pos/add/{id}', [PosController::class, 'addToCart']);
    Route::post('/pos/update', [PosController::class, 'cartUpdate']);
    Route::post('/pos/checkout', [PosController::class, 'checkout']);
    Route::post('/pos/clear', [PosController::class, 'clearCart']);
    Route::get('/pos/invoice/{id}', [PosController::class, 'invoice']);

    // stock management route
    Route::get('/stock-manage', [StockController::class, 'index'])->name('stock.index');
    Route::post('/restock', [StockController::class, 'restock'])->name('restock');
    Route::get('/stock-logs', [StockController::class, 'stockLogsGet'])->name('stock.logs');

    // Payment Router
    Route::get('/payments/history', [PaymentController::class, 'paymentIndex'])->name('payments.history');
    Route::get('/invoice/{id}', [PaymentController::class, 'invoice'])->name('invoice');

    // commission route
    Route::get('commission', [ComissionController::class, 'commissionIndex'])->name('commission');

    // email route
    Route::get('/email-form', [MailController::class, 'index'])->name('email-form');
    Route::post('/send-email', [MailController::class, 'sendMail'])->name('send.email');


    // report
    Route::get('/report', [DashboardController::class, 'reportPage']);
    Route::get('/report/export/pdf', [DashboardController::class, 'exportPdf']);

});

require __DIR__.'/auth.php';
require __DIR__.'/siteroute.php';
require __DIR__.'/vendor.php';
