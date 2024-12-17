<?php
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\SettingMenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\CheckoutController;

Route::get('/login', [LoginController::class, 'indexlogin'])->name('login');
Route::get('/register', [LoginController::class, 'indexregister'])->name('register');;
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [LoginController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::middleware('auth.user')->group(function () {
        Route::get('/keranjang', [KeranjangController::class, 'index'])->name('keranjang.index');
        Route::post('/keranjang/{id}', [KeranjangController::class, 'store'])->name('keranjang.store');
        Route::post('/keranjang/{id}/update', [KeranjangController::class, 'update'])->name('keranjang.update');
        Route::get('/keranjang/{id}/delete', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('/proses-checkout', [CheckoutController::class, 'prosesCheckout'])->name('checkout.proses');
    });
});




Route::prefix('dashboard')->middleware('auth.custom')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('menu', MenuController::class);
    Route::resource('setting_menus', SettingMenuController::class);
    Route::resource('user', UserController::class);
    Route::resource('role', RoleController::class);
    Route::resource('kategori', KategoriController::class);
    Route::resource('obat', ObatController::class);
});
