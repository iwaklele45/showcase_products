<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (Auth::check()) {
        if (Auth::user()->role === 'admin') {
            return redirect('/admin/dashboard');
        }
    }

    // Fetch distinct category names across sellers and pass to homepage
    $categories = Category::select('name')->distinct()->orderBy('name')->get();

    return view('home', compact('categories'));
})->name('home');

//test adminlte view npm and adding on app.css & app.js
// Route::view('/dashboard', 'dashboard-adminlte');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
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
            Route::resource('products', \App\Http\Controllers\ProductController::class);
        });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
