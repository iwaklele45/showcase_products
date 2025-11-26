<?php

use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
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
    $latestProducts = Product::with('category')->latest()->take(6)->get();

    return view('home', compact('categories', 'latestProducts'));
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
    
    Route::resource('/admin/users', AdminUserController::class)->names('admin.users');
});

// Public products page (accessible to everyone)
Route::get('/products', function () {
    $categories = Category::select('name')->distinct()->orderBy('name')->get();
    $query = Product::with(['category'])->latest();
    
    if (request('category')) {
        $query->whereHas('category', function($q) {
            $q->where('name', request('category'));
        });
    }
    
    $products = $query->paginate(12);
    return view('products.index', compact('categories', 'products'));
})->name('products.index');

Route::get('/products/{product}', function (Product $product) {
    $product->load(['category', 'user']);
    $relatedProducts = Product::where('id', '!=', $product->id)
        ->latest()
        ->take(4)
        ->get();

    return view('products.show', compact('product', 'relatedProducts'));
})->name('products.show');

Route::get('/search', function (Request $request) {
    $searchTerm = trim((string) $request->query('q', ''));
    $products = null;

    if ($searchTerm !== '') {
        $products = Product::with('category')
            ->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($searchTerm) . '%'])
            ->latest()
            ->paginate(12)
            ->withQueryString();
    }

    return view('products.search', compact('searchTerm', 'products'));
})->name('products.search');

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
