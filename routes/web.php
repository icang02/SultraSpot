<?php

use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\TourPlaceController;
use App\Http\Controllers\UserOrderController;
use App\Models\Cart;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Home dan Dashboard Index
Route::get('/', fn () => Inertia::render('Home/Index'))->name('home');
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard/Index', ['title' => 'SultraSpot']);
})->middleware('auth')->name('dashboard');


// ADMIN / Manage User
Route::controller(ManageUserController::class)->group(function () {
    Route::get('/users/{role:name}', 'index')->middleware('auth')->can('admin');
    Route::get('/users/{role}/{user:username}', 'edit')->middleware('auth')->can('admin');
    Route::patch('/users/{user:username}', 'update');
    Route::delete('/users/{user:username}', 'destroy');
});

// Auth / User Authentication
Route::controller(AuthenticateController::class)->group(function () {
    Route::get('/login', 'login')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate');
    Route::post('/logout', 'logout')->name('logout');
    Route::get('/forget-password', 'forgetPassword');
    Route::get('/register', 'register')->middleware('guest')->name('register');
    Route::post('/register', 'registerStore');
    Route::get('/forget-password', 'forgot')->name('forgot');
});

// ADMIN - PENGUNJUNG / Controller Wisata
// # Admin
Route::get('wisata', [TourPlaceController::class, 'index'])->middleware('auth');
// # Pengunung
Route::get('list-wisata', [TourPlaceController::class, 'listWisata'])->middleware('auth')->name('list-wisata');
Route::get('list-wisata/{id}', [TourPlaceController::class, 'detailWisata'])->middleware('auth')->name('wisata.detail');

// PENGUNJUNG / Controller Keranjang
Route::controller(CartController::class)->group(function () {
    Route::get('carts', 'index')->middleware('auth')->can('pengunjung')->name('carts');
    Route::post('add-carts/{id}', 'add')->middleware('auth')->can('pengunjung');
    Route::post('checkout/{id}', 'checkout')->middleware('auth')->can('pengunjung');
    Route::patch('update-carts/{id}', 'update')->middleware('auth')->can('pengunjung');
    Route::delete('destroy-carts/{id}', 'destroy')->middleware('auth')->can('pengunjung');
});

// PENEGUNJUNG / Controller Kelola Checkout
Route::controller(CheckoutController::class)->group(function () {
    Route::get('checkout/{id_cart}', 'index')->middleware('auth')->can('pengunjung')->name('checkout');
    Route::get('order-success/{id_cart}', 'prosesCheckout')->middleware('auth')->name('order.success');
    Route::post('order/{id_place}', 'orderNow')->middleware('auth')->can('pengunjung')->name('order');
});

// PENEGUNJUNG / Controller Kelola Checkout
Route::controller(UserOrderController::class)->group(function () {
    Route::get('pesanan', 'index')->middleware('auth')->can('pengunjung')->name('pesanan');
    Route::get('pesanan/{id}', 'show')->middleware('auth')->can('pengunjung')->name('pesanan.show');
});
