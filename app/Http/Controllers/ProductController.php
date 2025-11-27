<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest as StoreProductReq;
use App\Http\Requests\UpdateProductRequest as UpdateProductReq;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($username)
    {
        $seller = User::where('username', $username)->where('role', 'seller')->firstOrFail();

        $products = Product::where('user_id', $seller->id)
            ->with('category')
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('seller.product.index', compact('seller', 'products', 'username'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($username)
    {
        $seller = User::where('username', $username)->where('role', 'seller')->firstOrFail();

        // only seller owner or admin can create
        if (Auth::id() !== $seller->id && optional(Auth::user())->role !== 'admin') {
            abort(403);
        }

        $categories = Category::where('user_id', $seller->id)->get();

        return view('seller.product.create', compact('categories', 'username'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($username, StoreProductReq $request)
    {
        $seller = User::where('username', $username)->where('role', 'seller')->firstOrFail();

        if (Auth::id() !== $seller->id && optional(Auth::user())->role !== 'admin') {
            abort(403);
        }

        $data = [
            'user_id' => $seller->id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'weight' => $request->weight,
        ];

        // Handle image upload (store in public/images/products)
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destination = public_path('images/products');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $data['image'] = $filename;
        }

        Product::create($data);

        return redirect()->route('seller.products.index', $username)->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($username, Product $product)
    {
        // optional: show product detail (not implemented UI)
        $seller = User::where('username', $username)->where('role', 'seller')->firstOrFail();
        if ($product->user_id !== $seller->id) abort(404);
        return view('products.show', compact('product', 'username'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($username, Product $product)
    {
        $seller = User::where('username', $username)->where('role', 'seller')->firstOrFail();
        if (Auth::id() !== $seller->id && optional(Auth::user())->role !== 'admin') {
            abort(403);
        }

        if ($product->user_id !== $seller->id) abort(404);

        $categories = Category::where('user_id', $seller->id)->get();

        return view('seller.product.edit', compact('product', 'categories', 'username'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($username, UpdateProductReq $request, Product $product)
    {
        $seller = User::where('username', $username)->where('role', 'seller')->firstOrFail();
        if (Auth::id() !== $seller->id && optional(Auth::user())->role !== 'admin') {
            abort(403);
        }

        if ($product->user_id !== $seller->id) abort(404);

        $data = [
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'weight' => $request->weight,
        ];

        if ($request->hasFile('image')) {
            // delete old image if exists
            if ($product->image && file_exists(public_path('images/products/' . $product->image))) {
                @unlink(public_path('images/products/' . $product->image));
            }
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destination = public_path('images/products');
            if (!file_exists($destination)) {
                mkdir($destination, 0755, true);
            }
            $file->move($destination, $filename);
            $data['image'] = $filename;
        }

        $product->update($data);

        return redirect()->route('seller.products.index', $username)->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($username, Product $product)
    {
        $seller = User::where('username', $username)->where('role', 'seller')->firstOrFail();
        if (Auth::id() !== $seller->id && optional(Auth::user())->role !== 'admin') {
            abort(403);
        }

        if ($product->user_id !== $seller->id) abort(404);

        $product->delete();

        return redirect()->route('seller.products.index', $username)->with('success', 'Product deleted successfully!');
    }
}
