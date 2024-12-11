<?php
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;

Route::get('/login', [LoginController::class, 'indexlogin'])->name('login');
Route::get('/register', [LoginController::class, 'indexregister'])->name('register');;
Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [LoginController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('userpage');
});


Route::prefix('dashboard')->middleware('auth.custom')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});
