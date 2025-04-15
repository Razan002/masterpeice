<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\{
    DestinationController,
    UserController,
    PackageController,
    HomeController,
    ProductController
};
use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\Custom;
use App\Http\Controllers\BookingController;
use App\Http\Middleware\CustomerMiddleware;
use App\Http\Middleware\RedirectIfAuthenticated;

// tmp
Route::get('tmp', function () {
    return "Asdasd";
})->name('tmp')->middleware(Custom::class);

// Main Pages
Route::get('/', [DestinationController::class, 'indexHome'])->name('home');
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/service', function () { return view('service'); })->name('service');
Route::get('/booking', function () { return view('booking'); })->name('booking');
Route::get('/contacts', function () { return view('contacts'); })->name('contacts');

// Authentication Routes
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('registerr');
Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Package Routes
Route::get('/package', [PackageController::class, 'index'])->name('package');
Route::get('/packages/{id}', [PackageController::class, 'detailspackages'])->name('detailspackages');

Route::prefix('destinations')->group(function () {
    Route::get('/', [DestinationController::class, 'index'])->name('destination.index');
    Route::get('/{id}', [DestinationController::class, 'show'])->name('destination.show');
});

// User Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::prefix('user')->group(function () {
        Route::get('/{id}', [UserController::class, 'show'])->name('user.show');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('user.update');
    });
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ProductController::class, 'index'])->name('shop');

Route::prefix('products')->name('product.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index'); // product.index
    Route::get('/{product}', [ProductController::class, 'show'])->name('show'); // product.show
    Route::get('/category/{category}', [ProductController::class, 'byCategory'])->name('category'); // product.category
});
Route::post('/book-ticket', [BookingController::class, 'store'])->name('bookings.store')->middleware('auth');
