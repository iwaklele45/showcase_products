@extends('admin-lte.layouts.app')

@section('title', 'Detail User')

@section('content')

    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Detail User</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></li>
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
                            <h3 class="card-title">Detail User</h3>
                        </div>

                        <div class="card-body">
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

                            <hr>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Role</h6>
                                </div>
                                <div class="col-sm-9">
                                    <p class="mb-0">
                                        @if ($user->role === 'admin')
                                            <span class="badge bg-danger">Admin</span>
                                        @elseif ($user->role === 'seller')
                                            <span class="badge bg-success">Seller</span>
                                        @else
                                            <span class="badge bg-secondary">User</span>
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <hr>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Terdaftar</h6>
                                </div>
                                <div class="col-sm-9">
                                    <p class="mb-0">{{ $user->created_at->format('d M Y H:i') }}</p>
                                </div>
                            </div>

                            <hr>

                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Terakhir Diperbarui</h6>
                                </div>
                                <div class="col-sm-9">
                                    <p class="mb-0">{{ $user->updated_at->format('d M Y H:i') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            {{-- <a href="{{ route('users.edit', $user) }}" class="btn btn-warning">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form> --}}
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">
                                Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end::App Content-->

@endsection
