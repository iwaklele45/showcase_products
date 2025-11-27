@extends('admin-lte.layouts.app')

@section('title', 'Home Page')

@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            {{-- <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </div>
            </div> --}}
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">

            <!-- Hero -->
            <div class="row">
                <div class="col-12">
                    <div class="card bg-primary text-white border-0 shadow-sm mb-5">
                        <div class="card-body d-flex align-items-center py-5">
                            <div class="row align-items-center w-100">
                                <div class="col-lg-8">
                                    <p class="text-uppercase fw-semibold mb-2 opacity-75">Discover. Compare. Enjoy.</p>
                                    <h1 class="display-5 fw-bold text-white mb-3">Welcome to Showcase Products</h1>
                                    <p class="mb-4 opacity-75">Browse curated items from trusted sellers, find the perfect
                                        products for your needs, and manage your shopping journey in one place.</p>
                                    <div class="d-flex flex-wrap gap-2">
                                        <a href="{{ route('products.index') }}"
                                            class="btn btn-light btn-lg text-primary fw-semibold">
                                            Browse Products
                                        </a>
                                        @guest
                                            <a href="/login" class="btn btn-outline-light btn-lg fw-semibold">
                                                Log In to Get Started
                                            </a>
                                        @endguest
                                    </div>
                                </div>
                                <div class="col-lg-4 d-none d-lg-flex justify-content-end">
                                    <i class="bi bi-bag-check-fill" style="font-size: 7rem; opacity: 0.4;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Latest Products -->
            <div class="row align-items-center mb-3">
                <div class="col-12">
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                        <div>
                            <p class="text-uppercase text-muted small mb-1">Fresh from our sellers</p>
                            <h2 class="h3 fw-bold mb-0">Latest Products</h2>
                        </div>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
                            View All Products
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                @forelse ($latestProducts as $product)
                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3 mb-4">
                        <div class="card h-100 shadow-sm">
                            @if ($product->image)
                                <img src="{{ asset('images/products/' . $product->image) }}" class="card-img-top"
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
                                        <strong class="text-primary">Rp
                                            {{ number_format($product->price, 0, ',', '.') }}</strong>
                                        <small class="text-muted">Stock: {{ $product->stock }}</small>
                                    </div>
                                    <a href="{{ route('products.index', ['category' => optional($product->category)->name]) }}"
                                        class="btn btn-sm btn-outline-primary w-100">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="bi bi-info-circle"></i> No products available yet. Please check back soon!
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->

@endsection
