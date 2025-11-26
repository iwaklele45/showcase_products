@extends('admin-lte.layouts.app')

@section('title', 'User Dashboard')

@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Dashboard</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                @if (Auth::user()->role == 'user')
                    <div class="col-12 col-sm-6 col-md-3">
                        <a href="" class="info-box text-decoration-none text-body shadow-sm"
                            style="cursor: pointer;">
                            <span class="info-box-icon text-bg-success shadow-sm"> <i class="bi bi-shop"></i> </span>

                            <div class="info-box-content">
                                <span class="info-box-text fs-6">Request Seller</span>
                                <span class="info-box-number text-muted" style="font-size: 0.8rem;">
                                    Make a your shop</span>
                            </div>
                        </a>
                    </div>
                @endif

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon text-bg-danger shadow-sm">
                            <i class="bi bi-hand-thumbs-up-fill"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text fs-6">Followers</span>
                            <span class="info-box-number fs-7">41,410</span>
                        </div>
                    </div>
                </div>

                @if (Auth::user()->role == 'seller')
                    <div class="col-12 col-sm-6 col-md-3">
                        <a href="{{ route('seller.index', Auth::user()->username) }}"
                            class="info-box text-decoration-none text-body shadow-sm" style="cursor: pointer;">
                            <span class="info-box-icon text-bg-success shadow-sm"> <i class="bi bi-shop"></i> </span>

                            <div class="info-box-content">
                                <span class="info-box-text fs-6">My Shop</span>
                                <span class="info-box-number text-muted" style="font-size: 0.8rem;">
                                    {{ Auth::user()->username }} </span>
                            </div>
                        </a>
                    </div>
                @endif

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{ route('profile.edit') }}" class="info-box text-decoration-none text-body shadow-sm"
                        style="cursor: pointer;">
                        <span class="info-box-icon text-bg-primary shadow-sm">
                            <i class="bi bi-gear-fill"></i>
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text fs-6">My Profile</span>
                            <span class="info-box-text fs-7">Edit your personal profile</span>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>
    <!--end::App Content-->

@endsection
