@extends('seller.layouts.app')

@section('title', 'Seller Products')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Products</h3>
                    </div>
                    <div class="col-sm-6 d-flex flex-column align-items-end">
                        <ol class="breadcrumb mb-2">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Products</li>
                        </ol>
                        <a href="{{ route('seller.products.create', $username) }}" class="btn btn-primary">Add New
                            Product</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-content">
            <div class="container-fluid">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">All Products</h3>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped table-hover table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px" class="text-center">#</th>
                                            <th>Name of Product</th>
                                            <th>Category</th>
                                            <th>Stock</th>
                                            <th>Sell</th>
                                            <th class="text-start" style="width: 200px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($products ?? [] as $index => $product)
                                            <tr class="align-middle">
                                                <td class="text-center">{{ $index + 1 }}.</td>
                                                <td>{{ $product->name }}
                                                    @if ($product->image)
                                                        <div class="mb-2 ratio ratio-1x1 border d-flex justify-content-center align-items-center bg-light"
                                                            style="width: 100px;">
                                                            <img src="{{ asset('images/products/' . $product->image) }}"
                                                                alt="Product Image" class="img-fluid"
                                                                style="object-fit: contain; width: 100%; height: 100%;" />
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>{{ optional($product->category)->name }}</td>
                                                <td>{{ $product->stock }}</td>
                                                <td>{{ $product->sell }}</td>
                                                <td class="text-start">
                                                    <a href="{{ route('seller.products.edit', [$username, $product->id]) }}"
                                                        class="btn m-1 btn-warning">Edit</a>
                                                    <form
                                                        action="{{ route('seller.products.destroy', [$username, $product->id]) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Delete this product?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn m-1 btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-4">No products yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix">
                                <div class="float-end">
                                    {!! $products->links('pagination::bootstrap-5') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
