<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index']);
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::get('/checkout/preview', [CheckoutController::class, 'preview'])->name('checkout.preview');


