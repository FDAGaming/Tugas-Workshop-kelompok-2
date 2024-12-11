<?php
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


route::get('/',[HomeController::class, 'index']);
route::get('/dashboard',[DashboardController::class, 'index']);
