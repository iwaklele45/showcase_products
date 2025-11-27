@extends('admin-lte.layouts.app')

@section('title', 'Search Products')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-sm-6">
                    <h3 class="mb-0">Search Products</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Search</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <form action="{{ route('products.search') }}" method="GET">
                                <div class="row g-3 align-items-center">
                                    <div class="col-md-10">
                                        <input type="text"
                                               id="search-input"
                                               name="q"
                                               value="{{ $searchTerm }}"
                                               class="form-control form-control-lg"
                                               placeholder="e.g. Sneakers, Backpack, Smart Watch"
                                               autofocus>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button type="submit" class="btn btn-primary btn-lg w-100">
                                            <i class="bi bi-search"></i> Search
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if ($searchTerm === '')
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="alert alert-info shadow-sm">
                            <i class="bi bi-info-circle"></i>
                            Enter a product name above to see matching items.
                        </div>
                    </div>
                </div>
            @else
                <div class="row mt-4">
                    <div class="col-12">
                        <p class="text-muted mb-3">Showing results for "<strong>{{ $searchTerm }}</strong>"</p>
                    </div>
                </div>

                <div class="row">
                    @if ($products && $products->count())
                        @foreach ($products as $product)
                            <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4">
                                <div class="card h-100 shadow-sm">
                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                                            alt="{{ $product->name }}" style="height: 210px; object-fit: cover;">
                                    @else
                                        <div class="bg-secondary d-flex align-items-center justify-content-center"
                                            style="height: 210px;">
                                            <i class="bi bi-image text-white" style="font-size: 3rem;"></i>
                                        </div>
                                    @endif

                                    <div class="card-body d-flex flex-column">
                                        <span class="badge bg-primary mb-2 align-self-start">
                                            {{ $product->category->name ?? 'Uncategorized' }}
                                        </span>
                                        <h5 class="card-title">{{ $product->name }}</h5>
                                        <p class="card-text text-muted small flex-grow-1">
                                            {{ \Illuminate\Support\Str::limit($product->description, 80) }}
                                        </p>
                                        <div class="mt-auto">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <strong class="text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</strong>
                                                <small class="text-muted">Stock: {{ $product->stock }}</small>
                                            </div>
                                            <a href="{{ route('products.show', $product) }}"
                                                class="btn btn-sm btn-outline-primary w-100">
                                                View Details
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12">
                            <div class="alert alert-warning text-center">
                                <i class="bi bi-exclamation-circle"></i>
                                No products found matching "{{ $searchTerm }}".
                            </div>
                        </div>
                    @endif
                </div>

                @if ($products && $products->hasPages())
                    <div class="row mt-3">
                        <div class="col-12 d-flex justify-content-center">
                            {{ $products->links() }}
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
@endsection
