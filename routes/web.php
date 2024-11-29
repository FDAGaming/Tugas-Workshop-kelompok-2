<?php
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

route::get('/home',[MainController::class, 'index']);
route::get('/main',[MainController::class, 'main']);