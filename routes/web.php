<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\MyAccountController;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductDetailsController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\Auth\ResetPasswordController;
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

Auth::routes();

Route::get('cache-clear',function(){ 
    Artisan::call("optimize:clear"); 
    return true;
});

Route::get('/admin', function () {
    return view('welcome');
});

Route::get('/faq', function () {
    return view('frontend.faq');
})->name('faq');

Route::get('/why-choose-us', function () {
    return view('frontend.why-choose-us');
})->name('why-choose-us');

Route::get('/terms-conditions', function () {
    return view('frontend.terms-conditions');
})->name('terms-conditions');

Route::get('/privacy-policy', function () {
    return view('frontend.privacy-policy');
})->name('privacy-policy');

Route::get('/about-us', function () {
    return view('frontend.about-us');
})->name('about-us');

Route::get('/fssai-certificate', function () {
    return view('frontend.fssai-certificate');
})->name('fssai-certificate');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/category/{id?}', [CategoryController::class, 'index'])->name('category');
Route::get('/product/{id?}', [ProductDetailsController::class, 'index'])->name('productDetails');

Route::post('/cart/add',  [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove',  [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::get('/create-order', [OrderController::class, 'index'])->name('create-order');

Route::get('/shopping-cart', [OrderController::class, 'getShoppingCart'])->name('shopping-cart');

Route::post('/order-status', [OrderController::class, 'orderStatus'])->name('order-status');

Route::get('/thank-you/{orderId}', [OrderController::class, 'thankyou'])->name('thankyou');

Route::get('/search', [ProductDetailsController::class, 'search'])->name('product.search');

Route::post('/pincode-check', [OrderController::class, 'pincodeCheck'])->name('pincode-check');

//SUBMIT PAYMENT FORM ROUTE
Route::post('/pay-now', [OrderController::class, 'submitPaymentForm'])->name('pay-now');

//CALLBACK ROUTE
Route::get('/confirm', [OrderController::class, 'confirmPayment'])->name('confirm');


Route::get('reset-password/{token}/{email}', [ResetPasswordController::class, 'showResetForm'] )->name('password.reset');

include 'upgrade.php';


Route::middleware('auth')->group(function () {
    Route::get('/myaccount', [MyAccountController::class, 'index'])->name('myaccount');
    Route::get('/myaccount-order', [MyAccountController::class, 'myAccountOrder'])->name('myaccount-order');
    Route::get('/myaccount-order-details/{orderId}', [MyAccountController::class, 'myAccountOrderDetails'])->name('myaccount-order-details');
    
    Route::get('/my-account-wishlist', [MyAccountController::class, 'myAccountWishlist'])->name('myaccount-wishlist');

    Route::get('/myaccount-details', [MyAccountController::class, 'myAccountDetails'])->name('myaccount-details');
    Route::post('/myaccount-details', [MyAccountController::class, 'updateDetails'])->name('update-myaccount-details');

    Route::get('/myaccount-address', [UserAddressController::class, 'index'])->name('myaccount-address');
    Route::get('/myaccount-billing-address-edit', [UserAddressController::class, 'editBillingAddress'])->name('myaccount-billing-address-edit');
    Route::post('/myaccount-billing-address-update', [UserAddressController::class, 'updateBillingAddress'])->name('myaccount-billing-address-update');
    Route::get('/myaccount-shipping-address-edit', [UserAddressController::class, 'editShippingAddress'])->name('myaccount-shipping-address-edit');
    Route::post('/myaccount-shipping-address-update', [UserAddressController::class, 'updateShippingAddress'])->name('myaccount-shipping-address-update');

    Route::get('wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('wishlist/add/{product}', [WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('wishlist/remove/{product}', [WishlistController::class, 'remove'])->name('wishlist.remove');

    Route::post('order-cancel', [OrderController::class, 'orderCancel'])->name('orderCancel');
});