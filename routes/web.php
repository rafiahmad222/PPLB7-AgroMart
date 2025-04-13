<?php

use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'admin'])->name('dashboard');

Route::get('/home', [HomeController::class, 'index'], function () {
    return view('home');
})->middleware(['auth'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/auth/redirect', [GoogleAuthController:: class, 'redirect']);

Route::get('/auth/google/callback', [GoogleAuthController:: class, 'callback']);

Route::resource('kategori', KategoriController::class);
Route::get('/produk/filter', [ProdukController::class, 'filter'])->name('produk.filter');
Route::resource('produk', ProdukController::class);
Route::middleware('auth')->group(function () {
    Route::get('produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/filter', [ProdukController::class, 'filter'])->name('produk.filter');
    Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
    Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
});

Route::get('/checkout/{produk}', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/invoice/{id}', [CheckoutController::class, 'invoice'])->name('checkout.invoice');
Route::get('/pesananku', [App\Http\Controllers\PesananController::class, 'pesananku'])->name('pesananku');
Route::post('/pesananku/konfirmasi/{id}', [App\Http\Controllers\PesananController::class, 'konfirmasi'])->name('pesananku.konfirmasi');

Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');

require __DIR__.'/auth.php';
