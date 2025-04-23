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
// use App\Http\Controllers\ProductOwnerAdminController;
use App\Http\Controllers\GeneralAdminController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\Custom;
use App\Http\Controllers\BookingController;
use App\Http\Middleware\CustomerMiddleware;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminPackagesController;
use App\Http\Controllers\Admin\AdminBookingController;
;

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
Route::post('loginn', [AuthController::class, 'login'])->name('loginn');
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('registerr');
Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Package Routes
Route::get('/packages', [PackageController::class, 'index'])->name('package');
Route::get('/packagess/{id}', [PackageController::class, 'detailspackages'])->name('detailspackages');
Route::patch('/packagess/{package}/make-available', [PackageController::class, 'makeAvailable'])
->name('packages.make-available')
->middleware('auth:admin');
Route::prefix('destinations')->group(function () {
    Route::get('des/', [DestinationController::class, 'index'])->name('destination.index');
    Route::get('dess/{id}', [DestinationController::class, 'show'])->name('destination.show');
});

// User Routes
Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::prefix('user')->group(function () {
        Route::get('/{id}', [UserController::class, 'show'])->name('user.show');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('user.update');
    });
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ProductController::class, 'index'])->name('shop');

Route::prefix('products')->name('product.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index'); // product.index
    Route::get('/{product}', [ProductController::class, 'show'])->name('show'); // product.show
    Route::get('/category/{category}', [ProductController::class, 'byCategory'])->name('category'); // product.category
});
Route::post('/book-ticket', [BookingController::class, 'store'])->name('bookings.store')->middleware('auth');

// مسار لعرض الصفحة الشخصية
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::post('/profile/booking/cancel/{id}', [ProfileController::class, 'cancelBooking'])->name('profile.booking.cancel');

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [GeneralAdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [GeneralAdminController::class, 'manageUsers'])->name('admin.users');
    Route::get('/packages', [AdminPackagesController::class, 'index'])->name('admin.packages.index');  
    Route::get('packages/create', [AdminPackagesController::class, 'create'])->name('admin.packages.create');
    Route::post('admin/packages', [AdminPackagesController::class, 'store'])->name('admin.packages.store');
    Route::get('packages/{package}', [AdminPackagesController::class, 'show'])->name('admin.packages.show');
    Route::get('packages/{package}/edit', [AdminPackagesController::class, 'edit'])->name('admin.packages.edit');
    Route::put('packages/{package}', [AdminPackagesController::class, 'update'])->name('admin.packages.update');
    Route::delete('packages/{package}', [AdminPackagesController::class, 'destroy'])->name('admin.packages.destroy');



    // مسارات إدارة المستخدمين
    Route::get('/users', [UserAdminController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [UserAdminController::class, 'create'])->name('admin.users.create');
    // Route::post('/users', [UserAdminController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}/edit', [UserAdminController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [UserAdminController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [UserAdminController::class, 'destroy'])->name('admin.users.destroy');

    // Users
    Route::get('/admin/users', [GeneralAdminController::class, 'manageUsers'])->name('admin.users.index');
    Route::post('/admin/users', [GeneralAdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/users/create', [GeneralAdminController::class, 'createUser'])->name('admin.users.create');
    // Route::post('/users', [GeneralAdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/users/{id}', [GeneralAdminController::class, 'showUser'])->name('admin.users.show');
    // Bookings
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings');
    Route::get('/bookings/{id}', [GeneralAdminController::class, 'showBooking'])->name('admin.bookings.show');
    Route::get('/bookings/{id}/edit', [GeneralAdminController::class, 'editBooking'])->name('admin.bookings.edit');
    Route::put('/bookings/{id}', [GeneralAdminController::class, 'updateBooking'])->name('admin.bookings.update');
    Route::post('/bookings/{id}', [GeneralAdminController::class, 'deleteBooking'])->name('admin.bookings.destroy');    // Reviews
    Route::get('/reviews', [GeneralAdminController::class, 'manageReviews'])->name('admin.reviews');
    Route::get('/reviews/{id}', [GeneralAdminController::class, 'showReview'])->name('admin.reviews.show');
    Route::delete('/reviews/{id}', [GeneralAdminController::class, 'deleteReview'])->name('admin.reviews.destroy');
});

 