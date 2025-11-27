@extends('admin-lte.layouts.app')

@section('title', $product->name)

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">{{ $product->name }}</h3>
                    <p class="text-muted mb-0">{{ $product->category->name ?? 'Uncategorized' }}</p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card shadow-sm mb-4">
                        @if ($product->image)
                            <img src="{{ asset('images/products/' . $product->image) }}" class="card-img-top"
                                alt="{{ $product->name }}" style="max-height: 480px; object-fit: cover;">
                        @else
                            <div class="bg-secondary d-flex align-items-center justify-content-center"
                                style="height: 480px;">
                                <i class="bi bi-image text-white" style="font-size: 4rem;"></i>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <span class="badge bg-primary mb-3">{{ $product->category->name ?? 'Uncategorized' }}</span>
                            <h1 class="h3 fw-bold">{{ $product->name }}</h1>
                            <p class="text-muted mb-4">Added on {{ $product->created_at->format('M d, Y') }}</p>

                            <h2 class="text-primary fw-bold mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</h2>

                            <div class="mb-4">
                                <p class="fw-semibold mb-1">Description</p>
                                <p class="text-muted">{{ $product->description }}</p>
                            </div>

                            <div class="row mb-1">
                                <div class="col-sm-6">
                                    <p class="fw-semibold mb-1">Stock</p>
                                    <p>{{ $product->stock }}</p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="fw-semibold mb-1">Weight</p>
                                    <p>{{ $product->weight ? $product->weight . ' grams' : 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="row mb-1">
                                <div class="col-sm-6">
                                    <p class="fw-semibold mb-1">Seller</p>
                                    <p>{{ optional($product->user)->name ?? 'Unknown Seller' }}</p>
                                    @auth
                                        @if (Auth::id() !== $product->user_id)
                                            <form action="{{ route('chats.initiate', $product->id) }}" method="POST"
                                                class="mt-2">
                                                @csrf
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    <i class="bi bi-chat-dots"></i> Chat Seller
                                                </button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="mb-0">You might also like</h4>
                        <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                </div>

                @forelse ($relatedProducts as $related)
                    <div class="col-12 col-sm-6 col-lg-3 mb-4">
                        <div class="card h-100">
                            @if ($related->image)
                                <img src="{{ asset('images/products/' . $related->image) }}" class="card-img-top"
                                    alt="{{ $related->name }}" style="height: 180px; object-fit: cover;">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center"
                                    style="height: 180px;">
                                    <i class="bi bi-image text-muted" style="font-size: 2.5rem;"></i>
                                </div>
                            @endif

                            <div class="card-body d-flex flex-column">
                                <span class="badge bg-primary mb-2 align-self-start">
                                    {{ $related->category->name ?? 'Uncategorized' }}
                                </span>
                                <h5 class="card-title">{{ $related->name }}</h5>
                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h4 class="text-primary mb-0">Rp {{ number_format($related->price, 0, ',', '.') }}
                                        </h4>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="bi bi-box-seam"></i> Stock: {{ $related->stock }}
                                        </small>
                                        <a href="{{ route('products.show', $related) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i> View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            No related products available.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
