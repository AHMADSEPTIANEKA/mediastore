<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PhoneController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaptopController;
use App\Http\Controllers\AccessoryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Auth;

// Route Homepage redirect ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Routes untuk login, register, logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Dashboard routes dengan middleware role dan auth

Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:user'])->group(function() {
    Route::get('/user/dashboard', [DashboardController::class, 'user'])->name('user.dashboard');
});
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// Contoh akses data user (pastikan ada method index di AuthController)
Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/users', [AuthController::class, 'index'])->name('users.index');
});

// Resource routes
Route::resource('accessories', AccessoryController::class);
Route::resource('phones', PhoneController::class);
Route::resource('laptops', LaptopController::class);

// Custom category routes
Route::get('home',  [AccessoryController::class, 'home'])->name('accessories.home');
Route::get('android', [PhoneController::class, 'android'])->name('phones.android');
Route::get('iphone', [PhoneController::class, 'iphone'])->name('phones.iphone');

Route::get('gaming', [LaptopController::class, 'gaming'])->name('laptops.gaming');
Route::get('ultrabook', [LaptopController::class, 'ultrabook'])->name('laptops.ultrabook');
Route::get('workstation', [LaptopController::class, 'workstation'])->name('laptops.workstation');

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search');

// Cart routes (gabungkan get cart hanya sekali)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

// Payment routes
Route::get('/payment/{product_id}/{type}', [PaymentController::class, 'show'])->name('payment');
Route::get('/payment', [PaymentController::class, 'show'])->name('payment.show');
Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');

