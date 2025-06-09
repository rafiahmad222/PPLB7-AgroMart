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
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\EdukasiController;
use App\Models\Produk;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    $produks = Produk::all(); // Ambil semua data produk
    return view('welcome', compact('produks')); // Kirim data ke view
})->name('home');

Route::middleware(['auth'])->get('/profile/adminshowuser', [UserShowController::class, 'showUser'])->name('profile.adminshowuser');


Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/status', [StatusController::class, 'index'])->name('status.index');
    Route::put('/dashboard/pesanan/{id}/update-status', [StatusController::class, 'updateStatus'])
        ->name('dashboard.pesanan.updateStatus');
    Route::get('/api/chart-data', [StatusController::class, 'chartData'])->name('api.chartData');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/auth/redirect', [GoogleAuthController::class, 'redirect']);

Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);

Route::resource('produk', ProdukController::class);
Route::middleware('auth')->group(function () {
    Route::get('produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/filter', [ProdukController::class, 'filter'])->name('produk.filter');
    Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
    Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::get('/produk/filter', [ProdukController::class, 'filter'])->name('produk.filter');
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
    Route::get('/layanan/{id}', [LayananController::class, 'show'])->name('layanan.show');
    Route::get('/transaksi-layanan/{id}/invoice', [TransaksiLayananController::class, 'invoice'])
        ->name('transaksi-layanan.invoice');
    Route::get('/transaksi-layanan/create', [TransaksiLayananController::class, 'create'])->name('transaksi-layanan.create');
    Route::post('/transaksi-layanan/store', [TransaksiLayananController::class, 'store'])->name('transaksi-layanan.store');
});
Route::resource('kategori', KategoriController::class);
// Admin
Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::get('/layanan/{id}/edit', [LayananController::class, 'edit'])->name('layanan.edit');
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/edukasi/create', [EdukasiController::class, 'create'])->name('edukasi.create');
    Route::post('/edukasi', [EdukasiController::class, 'store'])->name('edukasi.store');
    Route::get('/edukasi/{artikel}/edit', [EdukasiController::class, 'edit'])->name('edukasi.edit');
    Route::put('/edukasi/{artikel}', [EdukasiController::class, 'update'])->name('edukasi.update');
    Route::delete('/edukasi/{artikel}', [EdukasiController::class, 'destroy'])->name('edukasi.destroy');
    Route::delete('/edukasi/video/{video}', [EdukasiController::class, 'destroyVideo'])->name('edukasi.destroy-video');
    Route::get('/edukasi/video/{video}/edit', [EdukasiController::class, 'editVideo'])->name('edukasi.video.edit');
    Route::put('/edukasi/video/{video}', [EdukasiController::class, 'updateVideo'])->name('edukasi.video.update');
    Route::post('/edukasi/{artikel}/komentar', [EdukasiController::class, 'storeKomentar'])->name('edukasi.komentar.store');
    Route::delete('/edukasi/{artikel}/komentar/{komentar}', [EdukasiController::class, 'destroyKomentar'])->name('edukasi.komentar.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/galeri/create', [GaleriController::class, 'create'])->name('galeri.create');
    Route::post('/galeri', [GaleriController::class, 'store'])->name('galeri.store');
    Route::delete('/galeri/{galeri}', [GaleriController::class, 'destroy'])->name('galeri.destroy');
});

Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.index');
Route::get('/galeri/{id}/edit', [GaleriController::class, 'edit'])->name('galeri.edit');
Route::put('/galeri/{id}', [GaleriController::class, 'update'])->name('galeri.update');
Route::get('/edukasi', [EdukasiController::class, 'index'])->name('edukasi.index');
Route::get('/edukasi/{artikel}', [EdukasiController::class, 'show'])->name('edukasi.show');
Route::middleware('auth')->group(function () {
    // Notification routes
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount']);
    Route::patch('/notifications/{notificationId}/read', [NotificationController::class, 'markAsRead']);
    Route::patch('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead']);
});
require __DIR__ . '/auth.php';
