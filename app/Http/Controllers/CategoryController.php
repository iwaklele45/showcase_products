<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($username)
    {
        // find seller by username
        $seller = User::where('username', $username)->where('role', 'seller')->firstOrFail();

        // get categories for the seller with pagination (5 per page)
        $categories = Category::where('user_id', $seller->id)->orderBy('id', 'desc')->paginate(5);

        return view('seller.category.index', compact('seller', 'categories', 'username'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($username)
    {
        return view('seller.category.create', compact('username'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($username, StoreCategoryRequest $request)
    {
        Category::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
        ]);

        return redirect()
            ->route('seller.categories.index', $username)
            ->with('success', 'Category created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($username, Category $category)
    {
        // ensure category belongs to the current seller/user (or admin)
        if (Auth::id() !== $category->user_id && optional(Auth::user())->role !== 'admin') {
            abort(403);
        }

        return view('seller.category.edit', compact('category', 'username'));
    }


    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // removed duplicate stub

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, $username, Category $category)
    {
        // ensure category belongs to the current seller/user (or admin)
        if (Auth::id() !== $category->user_id && optional(Auth::user())->role !== 'admin') {
            abort(403);
        }

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('seller.categories.index', $username)->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($username, Category $category)
    {
        // ensure category belongs to the current seller/user (or admin)
        if (Auth::id() !== $category->user_id && optional(Auth::user())->role !== 'admin') {
            abort(403);
        }

        $category->delete();

        return redirect()->route('seller.categories.index', $username)->with('success', 'Category deleted successfully!');
    }
}
