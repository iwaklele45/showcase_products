@extends('admin-lte.layouts.app')

@section('title', 'Daftar User')

@section('content')

    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Daftar User</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content Header-->

    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Daftar User</h3>
                    {{-- <a href="{{ route('users.create') }}" class="btn btn-light btn-sm">
                        <i class="bi bi-plus-circle"></i> Tambah User
                    </a> --}}
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th width="20%">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td><code>{{ $user->username }}</code></td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->role === 'admin')
                                            <span class="badge bg-danger">Admin</span>
                                        @elseif ($user->role === 'seller')
                                            <span class="badge bg-success">Seller</span>
                                        @else
                                            <span class="badge bg-secondary">User</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('users.show', $user) }}" class="btn btn-info btn-sm"
                                            title="Lihat">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('users.edit', $user) }}" class="btn btn-warning btn-sm"
                                            title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada user.</td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-end mt-3">
                        {{ $users->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--end::App Content-->

@endsection
