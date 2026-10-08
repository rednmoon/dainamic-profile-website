<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileViewController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

// 1. Public Welcome / Landing Page
Route::get('/', function () {
    return view('welcome');
});

// 2. Profile Routes (All Authenticated Users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::post('/profile/info', [ProfileController::class, 'updateInfo'])->name('profile.info.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 3. User Dashboard Routes (Only Normal Users Allowed - Admin Blocked)
Route::middleware(['auth', 'user'])->prefix('dashboard')->group(function () {
    // Standard 'dashboard' name route for Breeze redirect
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth', 'user'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::put('/settings', [DashboardController::class, 'updateSettings'])->name('settings');



    // Services Routes
    Route::post('/services', [DashboardController::class, 'storeService'])->name('services.store');
    Route::get('/services/{id}/edit', [DashboardController::class, 'editService'])->name('services.edit');
    Route::put('/services/{id}', [DashboardController::class, 'updateService'])->name('services.update');
    Route::delete('/services/{id}', [DashboardController::class, 'destroyService'])->name('services.destroy');

    // Favourites Routes
    Route::post('/favourites', [DashboardController::class, 'storeFavourite'])->name('favourites.store');
    Route::delete('/favourites/{id}', [DashboardController::class, 'destroyFavourite'])->name('favourites.destroy');

    // Tours Routes
    Route::post('/tours', [DashboardController::class, 'storeTour'])->name('tours.store');
    Route::get('/tours/{id}/edit', [DashboardController::class, 'editTour'])->name('tours.edit');
    Route::put('/tours/{id}', [DashboardController::class, 'updateTour'])->name('tours.update');
    Route::delete('/tours/{id}', [DashboardController::class, 'destroyTour'])->name('tours.destroy');

    // Gallery Routes
    Route::post('/gallery', [DashboardController::class, 'storeGallery'])->name('gallery.store');
    Route::delete('/gallery/{id}', [DashboardController::class, 'destroyGallery'])->name('gallery.destroy');
});

// 4. Admin Dashboard & Management Routes (Only Admin Allowed)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // User Management
    Route::get('/users', [AdminController::class, 'index'])->name('admin.users');
    Route::post('/users/{id}/approve', [AdminController::class, 'approve'])->name('admin.users.approve');
    Route::post('/users/{id}/reject', [AdminController::class, 'reject'])->name('admin.users.reject');
    Route::delete('/users/{id}', [AdminController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/change-password', [AdminController::class, 'showChangePasswordForm'])->name('admin.password.change');
    Route::post('/change-password', [AdminController::class, 'updatePassword'])->name('admin.password.update');

});

// 5. Breeze Authentication Routes
require __DIR__.'/auth.php';

// 6. Public Dynamic User Profile Routes (Always keep at the bottom)
Route::get('/{username}', [ProfileViewController::class, 'show'])->name('user.profile');
Route::get('/{username}/gallery/load-more', [ProfileViewController::class, 'loadMoreGallery']);