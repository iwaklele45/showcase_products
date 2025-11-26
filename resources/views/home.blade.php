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

            <!-- Banner -->
            <div class="row">
                <div class="col-12">
                    <div class="card bg-primary text-white shadow-sm mb-4">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <h1 class="h3 text-white">Selamat datang di Showcase Products</h1>
                                    <p class="mb-0 opacity-75">Jelajahi kategori produk dari berbagai penjual. Temukan
                                        produk terbaik untuk kebutuhanmu.</p>
                                </div>
                                {{-- <div class="text-end">
                                    <a href="#" class="btn btn-light">Lihat Kategori</a>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Categories Row -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Categories</h3>
                        </div>
                        <div class="card-body">
                            @if (isset($categories) && $categories->count())
                                <div class="row">
                                    @foreach ($categories as $category)
                                        <div class="col-md-3 col-sm-4 mb-3">
                                            <a href="#" class="btn btn-outline-secondary w-100 text-start">
                                                {{ $category->name }}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p>No categories found.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!--! End of Categories Row-->
            <!-- Categories Row -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Products</h3>
                        </div>
                        <div class="card-body">
                            @if (isset($categories) && $categories->count())
                                <div class="row">
                                    @foreach ($categories as $category)
                                        <div class="col-md-3 col-sm-4 mb-3">
                                            <a href="#" class="btn btn-outline-secondary w-100 text-start">
                                                {{ $category->name }}
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p>No categories found.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!--! End of Categories Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->

@endsection
