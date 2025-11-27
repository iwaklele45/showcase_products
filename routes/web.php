<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SellerRequestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Category;

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect('/admin/dashboard');
        }
    }

    $categories = Category::select('name')->distinct()->orderBy('name')->get();

    return view('home', compact('categories'));
})->name('home');


// ========== ADMIN ROUTES ==========
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // User management
    Route::resource('users', UserController::class);

    // Notifikasi & approval untuk seller
    Route::get('/admin/seller-requests', [SellerRequestController::class, 'index'])
        ->name('seller.requests');

    Route::get('/admin/seller-requests/{id}/show', [SellerRequestController::class, 'show'])
        ->name('seller.show');

    Route::get('/admin/seller-request/{user}', [SellerRequestController::class, 'show'])
        ->name('seller.show');

    Route::post('/admin/seller-request/{id}/approve', [SellerRequestController::class, 'approve'])
        ->name('seller.approve');

    Route::post('/admin/seller-request/{id}/reject', [SellerRequestController::class, 'reject'])
        ->name('seller.reject');
});


// ========== USER & SELLER ROUTES ==========
Route::middleware(['auth', 'role:user'])->group(function () {
    // User mengirim request menjadi seller
    Route::get('/request-seller', [SellerRequestController::class, 'showRequestForm'])
        ->name('seller.request.form');

    Route::post('/request-seller', [SellerRequestController::class, 'requestSeller'])
        ->name('seller.request');
});

Route::middleware(['auth', 'role:user,seller'])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    Route::get('/toko/{username}', [ShopController::class, 'index'])
        ->name('seller.index');

    Route::prefix('/toko/{username}')
        ->name('seller.')
        ->group(function () {
            Route::resource('categories', CategoryController::class);
            Route::resource('products', ProductController::class);
        });
});


// ========== PROFILE ROUTES ==========
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
