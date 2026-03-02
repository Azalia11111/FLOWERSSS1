<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlowerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SellerController;
use App\Models\Order;
use App\Http\Middleware\AdminMiddleware;
Route::get('/', [FlowerController::class, 'index'])->name('welcome');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::get('/', [FlowerController::class, 'index'])->name('flowers.index');

// Для админов: создание/редактирование/удаление
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::post('/flowers', [FlowerController::class, 'store'])->name('flowers.store');
    Route::get('/flowers/{flower}/edit', [FlowerController::class, 'edit'])->name('flowers.edit');
  
Route::put('/flowers/{flower}', [FlowerController::class, 'update'])->name('flowers.update');



    Route::delete('/flowers/{flower}', [FlowerController::class, 'destroy'])->name('flowers.destroy');
});


Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/cart/add/{id}', [CartController::class,'add'])->name('cart.add');


Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
 Route::middleware('auth')->group(function(){
 Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    
 Route::post('/orders', [\App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [\App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
});



