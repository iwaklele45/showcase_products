<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SellerRequestController;
use App\Models\Product;
use Illuminate\Http\Request;
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
    $latestProducts = Product::with('category')->latest()->take(6)->get();

    return view('home', compact('categories', 'latestProducts'));
})->name('home');


// ========== ADMIN ROUTES ==========
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

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

// Public products page (accessible to everyone)
Route::get('/products', function () {
    $categories = Category::select('name')->distinct()->orderBy('name')->get();
    $query = Product::with(['category'])->latest();

    if (request('category')) {
        $query->whereHas('category', function ($q) {
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
            Route::resource('products', ProductController::class);
        });
});


// ========== PROFILE ROUTES ==========
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// Chat Routes
Route::middleware('auth')->group(function () {
    Route::post('/chats/initiate/{product}', 'App\Http\Controllers\ChatController@initiate')->name('chats.initiate');
    Route::get('/chats', 'App\Http\Controllers\ChatController@index')->name('chats.index');
    Route::get('/chats/{chat}', 'App\Http\Controllers\ChatController@show')->name('chats.show');
    Route::post('/chats/{chat}/messages', 'App\Http\Controllers\ChatController@store')->name('chats.messages.store');

    // Notification Routes
    Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
});


require __DIR__ . '/auth.php';