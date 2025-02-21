<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PhoneController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaptopController;
use App\Http\Controllers\AccessoryController;

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

