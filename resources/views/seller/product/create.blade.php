@extends('seller.layouts.app')

@section('title', 'Add New Product')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Add New Product</h3>
                    </div>
                    <div class="col-sm-6 d-flex flex-column align-items-end">
                        <ol class="breadcrumb mb-2">
                            <li class="breadcrumb-item"><a href="#">Products</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create</li>
                        </ol>
                        <a href="{{ route('seller.products.index', $username) }}" class="btn btn-secondary">Back to
                            Products</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 mx-auto">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Product Form</h3>
                            </div>

                            <form action="{{ route('seller.products.store', $username) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="card-body">

                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Category</label>
                                        <select name="category_id" id="category_id" class="form-control">
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Product Name</label>
                                        <input type="text" name="name" id="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Enter product name" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" step="0.01" name="price" id="price"
                                            class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="stock" class="form-label">Stock</label>
                                        <input type="number" name="stock" id="stock" class="form-control"
                                            value="0" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="weight" class="form-label">Weight (grams)</label>
                                        <input type="number" step="0.01" name="weight" id="weight" class="form-control"
                                            placeholder="Enter weight in grams">
                                    </div>

                                    <div class="mb-3">
                                        <label for="image" class="form-label">Image</label>
                                        <input type="file" name="image" id="image" class="form-control">
                                        @error('image')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="card-footer d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Save Product</button>
                                </div>

                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
