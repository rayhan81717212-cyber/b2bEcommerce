<?php

use App\Http\Controllers\SiteController\CartController;
use App\Http\Controllers\SiteController\CustomerController;
use App\Http\Controllers\SiteController\CustomerPymentController;
use App\Http\Controllers\SiteController\CustomersDashboardController;
use App\Http\Controllers\SiteController\OrdersController;
use App\Http\Controllers\SiteController\ProductController;
use App\Http\Controllers\SiteController\ProductPageController;
use App\Http\Controllers\SiteController\WalletController;
use Illuminate\Support\Facades\Route;

Route::get('/customers/dashboard', [CustomersDashboardController::class, 'index'])
    ->middleware(['auth', 'customers'])
    ->name('customers.dashboard');

Route::get('/', [ProductController::class, 'home'])->name('home');

// add to cart route
Route::post('/add-to-cart/{id}', [CartController::class, 'addToCart']);
Route::get('/cart', [CartController::class, 'cartPage'])->name('cart.page');
Route::post('/cart/update', [CartController::class, 'cartUpdate'])->name('cart.update');

// checkOut Route
Route::get('/checkout', [OrdersController::class, 'checkoutPage'])->name('checkout.page');
Route::post('/order-place', [OrdersController::class, 'placeOrder'])->name('order.place')->middleware('auth');
Route::get('/order-success/{id}', [OrdersController::class, 'success'])->name('order.success');


// all product page route
Route::get('/all-product-page', [ProductPageController::class, 'allProduct'])->name('all.product.page');
Route::get('/deals', [ProductPageController::class, 'deals'])->name('deals.page');
Route::get('/product-single/{id}', [ProductPageController::class, 'singleProduct'])->name('product.single');
Route::post('/add-to-cart-product/{id}', [ProductPageController::class, 'addToCart'])->name('add-to-cart-product');




// customers route
Route::middleware(['auth', 'customers'])->group(function () {
// Profile route
Route::get('/customers-profile', [CustomerController::class, 'index'])->name('customers-profile');
Route::get('/customer/profile/create', [CustomerController::class, 'create'])->name('customer.create');
Route::post('/customer/profile/store', [CustomerController::class, 'store'])->name('customer.store');

// orders
Route::get('/customers/orders', [CustomersDashboardController::class, 'allOrder'])->name('customers.orders');
Route::get('/customer/order/{id?}', [CustomersDashboardController::class, 'show'])->name('customer.order.show');

// Payment Router
Route::get('/customers/payment', [CustomerPymentController::class, 'payment'])->name('customers.payment');

// wallet
Route::get('/wallets', [WalletController::class, 'wallet'])->name('wallets');


});