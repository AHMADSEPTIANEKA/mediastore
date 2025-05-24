<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PhoneController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaptopController;
use App\Http\Controllers\AccessoryController;
use App\Http\Controllers\SearchController;

Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::resource('accessories', AccessoryController::class);
Route::get('home',  [AccessoryController::class, 'home'])->name('accessories.home');
Route::resource('phones', PhoneController::class);
Route::resource('laptops', LaptopController::class);
// Route untuk menampilkan ponsel Android
Route::get('android', [PhoneController::class, 'android'])->name('phones.android');
Route::get('gaming', [LaptopController::class, 'gaming'])->name('laptops.gaming');
Route::get('ultrabook', [LaptopController::class, 'ultrabook'])->name('laptops.ultrabook');
Route::get('workstation', [LaptopController::class, 'workstation'])->name('laptops.workstation');
// Route untuk menampilkan ponsel iPhone
Route::get('iphone', [PhoneController::class, 'iphone'])->name('phones.iphone');
Route::get('android', [PhoneController::class, 'android'])->name('phones.android');
Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
