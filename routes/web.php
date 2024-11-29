<?php
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;

Route::get('/', function () {
    return view('welcome');
});

route::get('/home',[MainController::class, 'index']);
route::get('/main',[MainController::class, 'main']);

Route::resource('menus', MenuController::class);
