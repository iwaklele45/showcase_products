@extends('admin-lte.layouts.app')

@section('title', 'Detail Request Seller')

@section('content')

    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Detail Request Seller</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('seller.requests') }}">Request Seller</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content Header-->

    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">Informasi Seller Request</h3>
                        </div>

                        <div class="card-body">
                            <!-- User Information -->
                            <h5 class="mb-3">Data User</h5>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nama</h6>
                                </div>
                                <div class="col-sm-9">
                                    <p class="mb-0">{{ $user->name }}</p>
                                </div>
                            </div>

                            <hr>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Username</h6>
                                </div>
                                <div class="col-sm-9">
                                    <p class="mb-0"><code>{{ $user->username }}</code></p>
                                </div>
                            </div>

                            <hr>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                </div>
                                <div class="col-sm-9">
                                    <p class="mb-0">{{ $user->email }}</p>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Store Information -->
                            <h5 class="mb-3">Informasi Toko</h5>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Nama Toko</h6>
                                </div>
                                <div class="col-sm-9">
                                    <p class="mb-0">
                                        @if ($user->store_name)
                                            {{ $user->store_name }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <hr>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Deskripsi Toko</h6>
                                </div>
                                <div class="col-sm-9">
                                    <p class="mb-0">
                                        @if ($user->store_description)
                                            {{ $user->store_description }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Request Information -->
                            <h5 class="mb-3">Informasi Request</h5>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Status</h6>
                                </div>
                                <div class="col-sm-9">
                                    <p class="mb-0">
                                        @if ($sellerVerification->status === 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif ($sellerVerification->status === 'verified')
                                            <span class="badge bg-success">Verified</span>
                                        @elseif ($sellerVerification->status === 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <hr>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Diajukan</h6>
                                </div>
                                <div class="col-sm-9">
                                    <p class="mb-0">{{ $sellerVerification->created_at->format('d M Y H:i') }}</p>
                                </div>
                            </div>

                            <hr>

                            {{-- <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Diverifikasi</h6>
                                </div>
                                <div class="col-sm-9">
                                    <p class="mb-0">
                                        @if ($sellerVerification->verified_at)
                                            {{ $sellerVerification->verified_at->format('d M Y H:i') }}
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </p>
                                </div>
                            </div> --}}

                        </div>

                        <div class="card-footer">
                            @if ($sellerVerification->status === 'pending')
                                <form action="{{ route('seller.approve', $sellerVerification->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-check2-circle"></i> Approve
                                    </button>
                                </form>

                                <form action="{{ route('seller.reject', $sellerVerification->id) }}" method="POST"
                                    class="d-inline" onsubmit="return confirm('Yakin ingin menolak request ini?')">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        <i class="bi bi-x-circle"></i> Reject
                                    </button>
                                </form>
                            @endif

                            <a href="{{ route('seller.requests') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end::App Content-->

@endsection
