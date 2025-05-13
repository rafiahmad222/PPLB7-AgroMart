<?php

use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\AdminPesananController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserShowController;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\AlamatController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\TransaksiLayananController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['admin'])->name('dashboard');
Route::put('/dashboard/pesanan/{id}/update-status', [DashboardController::class, 'updateStatus'])
    ->name('dashboard.pesanan.updateStatus');
Route::get('/api/chart-data', [App\Http\Controllers\DashboardController::class, 'chartData'])->name('api.chartData');

Route::middleware(['auth'])->get('/profile/adminshowuser', [UserShowController::class, 'showUser'])->name('profile.adminshowuser');


Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/auth/redirect', [GoogleAuthController::class, 'redirect']);

Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);

Route::resource('kategori', KategoriController::class);
Route::get('/produk/filter', [ProdukController::class, 'filter'])->name('produk.filter');
Route::resource('produk', ProdukController::class);
Route::middleware('auth')->group(function () {
    Route::get('produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/filter', [ProdukController::class, 'filter'])->name('produk.filter');
    Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
    Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
});
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/invoice/{id}', [CheckoutController::class, 'invoice'])->name('checkout.invoice');
    Route::get('/pesananku', [App\Http\Controllers\PesananController::class, 'pesananku'])->name('pesananku');
    Route::post('/pesananku/konfirmasi/{id}', [App\Http\Controllers\PesananController::class, 'konfirmasi'])->name('pesananku.konfirmasi');
});

Route::get('/register', [RegisteredUserController::class, 'create'])->middleware('guest')->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');

Route::get('/get-kecamatan/{id_kabupaten_kota}', [ProfileController::class, 'getKecamatan']);
Route::get('/get-kode-pos/{id_kecamatan}', [ProfileController::class, 'getKodePos'])->name('get.kodepos');
Route::post('/alamat/store', [AlamatController::class, 'store'])->name('alamat.store');
Route::put('/alamat/update', [AlamatController::class, 'update'])->name('alamat.update');

Route::resource('layanan', LayananController::class);
Route::middleware('auth')->group(function () {
    Route::get('/layanan/{id}', [App\Http\Controllers\LayananController::class, 'show'])->name('layanan.show');

    Route::get('/transaksi-layanan/create', [TransaksiLayananController::class, 'create'])->name('transaksi-layanan.create');
    Route::post('/transaksi-layanan/store', [TransaksiLayananController::class, 'store'])->name('transaksi-layanan.store');
});

// Admin
Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::get('/layanan/{id}/edit', [LayananController::class, 'edit'])->name('layanan.edit');
});
require __DIR__ . '/auth.php';
