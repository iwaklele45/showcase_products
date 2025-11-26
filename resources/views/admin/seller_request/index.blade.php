@extends('admin-lte.layouts.app')

@section('title', 'Request Seller')

@section('content')

    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Request Seller</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Request Seller</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content Header-->

    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Daftar Request Menjadi Seller</h3>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>Nama User</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Diajukan</th>
                                <th width="20%">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($requests as $req)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $req->user->name }}</td>
                                    <td>{{ $req->user->email }}</td>
                                    <td>
                                        <span class="badge bg-warning">{{ ucfirst($req->status) }}</span>
                                    </td>
                                    <td>{{ $req->created_at->format('d M Y') }}</td>
                                    <td>
                                        <form action="{{ route('seller.approve', $req->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button class="btn btn-success btn-sm">
                                                <i class="bi bi-check2-circle"></i> Approve
                                            </button>
                                        </form>

                                        <form action="{{ route('seller.reject', $req->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            <button class="btn btn-danger btn-sm">
                                                <i class="bi bi-x-circle"></i> Reject
                                            </button>
                                        </form>
                                        <a href="{{ route('seller.show', $req->user->id) }}"
                                            class="btn btn-warning btn-sm">Show Request</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada request pending.</td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>
    <!--end::App Content-->

@endsection
