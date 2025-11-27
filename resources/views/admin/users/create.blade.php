@extends('admin-lte.layouts.app')

@section('title', 'Tambah User')

@section('content')

    <!--begin::App Content Header-->
@section('title', 'Create User')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Tambah User</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        {{-- <li class="breadcrumb-item"><a href="{{ route('') }}">User</a></li> --}}
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                        <h3 class="mb-0">Create User</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create</li>
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
                            <h3 class="card-title">Form Tambah User</h3>
                        </div>

                        <form action="" method="POST" class="needs-validation" novalidate>
                            @csrf

                            <div class="card-body">
                                <!-- Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name') }}" required>

                                    <div class="app-content">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="card-title">User Information</h3>
                                                        </div>

                                                        <form action="{{ route('admin.users.store') }}" method="POST">
                                                            @csrf

                                                            <div class="card-body">
                                                                <div class="mb-3">
                                                                    <label for="name" class="form-label">Name <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text"
                                                                        class="form-control @error('name') is-invalid @enderror"
                                                                        id="name" name="name"
                                                                        value="{{ old('name') }}" required>
                                                                    @error('name')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>

                                                                <!-- Username -->
                                                                <div class="mb-3">
                                                                    <label for="username" class="form-label">Username <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text"
                                                                        class="form-control @error('username') is-invalid @enderror"
                                                                        id="username" name="username"
                                                                        value="{{ old('username') }}" required>
                                                                    <div class="mb-3">
                                                                        <label for="username" class="form-label">Username
                                                                            <span class="text-danger">*</span></label>
                                                                        <input type="text"
                                                                            class="form-control @error('username') is-invalid @enderror"
                                                                            id="username" name="username"
                                                                            value="{{ old('username') }}" required>
                                                                        @error('username')
                                                                            <div class="invalid-feedback">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>

                                                                    <!-- Email -->
                                                                    <div class="mb-3">
                                                                        <label for="email" class="form-label">Email <span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="email"
                                                                            class="form-control @error('email') is-invalid @enderror"
                                                                            id="email" name="email"
                                                                            value="{{ old('email') }}" required>
                                                                        <div class="mb-3">
                                                                            <label for="email" class="form-label">Email
                                                                                <span class="text-danger">*</span></label>
                                                                            <input type="email"
                                                                                class="form-control @error('email') is-invalid @enderror"
                                                                                id="email" name="email"
                                                                                value="{{ old('email') }}" required>
                                                                            @error('email')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}</div>
                                                                            @enderror
                                                                        </div>

                                                                        <!-- Password -->
                                                                        <div class="mb-3">
                                                                            <label for="password"
                                                                                class="form-label">Password <span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="password"
                                                                                class="form-control @error('password') is-invalid @enderror"
                                                                                id="password" name="password" required>
                                                                            <div class="mb-3">
                                                                                <label for="password"
                                                                                    class="form-label">Password <span
                                                                                        class="text-danger">*</span></label>
                                                                                <input type="password"
                                                                                    class="form-control @error('password') is-invalid @enderror"
                                                                                    id="password" name="password"
                                                                                    required>
                                                                                @error('password')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>

                                                                            <!-- Password Confirmation -->
                                                                            <div class="mb-3">
                                                                                <label for="password_confirmation"
                                                                                    class="form-label">Konfirmasi Password
                                                                                    <span
                                                                                        class="text-danger">*</span></label>
                                                                                <input type="password"
                                                                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                                                                    id="password_confirmation"
                                                                                    name="password_confirmation" required>
                                                                                @error('password_confirmation')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>

                                                                            <!-- Role -->
                                                                            <div class="mb-3">
                                                                                <label for="role"
                                                                                    class="form-label">Role <span
                                                                                        class="text-danger">*</span></label>
                                                                                <select
                                                                                    class="form-select @error('role') is-invalid @enderror"
                                                                                    id="role" name="role"
                                                                                    required>
                                                                                    <option value="">-- Pilih Role --
                                                                                    </option>
                                                                                    <option value="admin"
                                                                                        {{ old('role') === 'admin' ? 'selected' : '' }}>
                                                                                        Admin
                                                                                    </option>
                                                                                    <option value="user"
                                                                                        {{ old('role') === 'user' ? 'selected' : '' }}>
                                                                                        User</option>
                                                                                    <option value="seller"
                                                                                        {{ old('role') === 'seller' ? 'selected' : '' }}>
                                                                                        Seller
                                                                                    </option>
                                                                                    <div class="mb-3">
                                                                                        <label for="password_confirmation"
                                                                                            class="form-label">Confirm
                                                                                            Password <span
                                                                                                class="text-danger">*</span></label>
                                                                                        <input type="password"
                                                                                            class="form-control"
                                                                                            id="password_confirmation"
                                                                                            name="password_confirmation"
                                                                                            required>
                                                                                    </div>

                                                                                    <div class="mb-3">
                                                                                        <label for="role"
                                                                                            class="form-label">Role <span
                                                                                                class="text-danger">*</span></label>
                                                                                        <select
                                                                                            class="form-select @error('role') is-invalid @enderror"
                                                                                            id="role" name="role"
                                                                                            required>
                                                                                            <option value="">Select
                                                                                                Role</option>
                                                                                            <option value="admin"
                                                                                                {{ old('role') === 'admin' ? 'selected' : '' }}>
                                                                                                Admin</option>
                                                                                            <option value="seller"
                                                                                                {{ old('role') === 'seller' ? 'selected' : '' }}>
                                                                                                Seller</option>
                                                                                            <option value="user"
                                                                                                {{ old('role') === 'user' ? 'selected' : '' }}>
                                                                                                User</option>
                                                                                        </select>
                                                                                        @error('role')
                                                                                            <div class="invalid-feedback">
                                                                                                {{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>
                                                                            </div>

                                                                            <div class="card-footer">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Simpan</button>
                                                                                <a href=""
                                                                                    class="btn btn-secondary">Batal</a>

                                                                                <div class="mb-3" id="storeFields"
                                                                                    style="display: none;">
                                                                                    <hr>
                                                                                    <h5>Store Information (for Sellers)</h5>

                                                                                    <div class="mb-3">
                                                                                        <label for="store_name"
                                                                                            class="form-label">Store
                                                                                            Name</label>
                                                                                        <input type="text"
                                                                                            class="form-control @error('store_name') is-invalid @enderror"
                                                                                            id="store_name"
                                                                                            name="store_name"
                                                                                            value="{{ old('store_name') }}">
                                                                                        @error('store_name')
                                                                                            <div class="invalid-feedback">
                                                                                                {{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>

                                                                                    <div class="mb-3">
                                                                                        <label for="store_description"
                                                                                            class="form-label">Store
                                                                                            Description</label>
                                                                                        <textarea class="form-control @error('store_description') is-invalid @enderror" id="store_description"
                                                                                            name="store_description" rows="3">{{ old('store_description') }}</textarea>
                                                                                        @error('store_description')
                                                                                            <div class="invalid-feedback">
                                                                                                {{ $message }}</div>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>

                                                                                <div class="form-check mb-3">
                                                                                    <input class="form-check-input"
                                                                                        type="checkbox"
                                                                                        id="email_verified"
                                                                                        name="email_verified"
                                                                                        {{ old('email_verified') ? 'checked' : '' }}>
                                                                                    <label class="form-check-label"
                                                                                        for="email_verified">
                                                                                        Email Verified
                                                                                    </label>
                                                                                </div>
                                                                            </div>

                                                                            <div class="card-footer">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Create
                                                                                    User</button>
                                                                                <a href="{{ route('admin.users.index') }}"
                                                                                    class="btn btn-secondary">Cancel</a>
                                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!--end::App Content-->

                                </div>
                            </div>
                        @endsection

                        @section('scripts')
                            <script>
                                document.getElementById('role').addEventListener('change', function() {
                                    const storeFields = document.getElementById('storeFields');
                                    if (this.value === 'seller') {
                                        storeFields.style.display = 'block';
                                    } else {
                                        storeFields.style.display = 'none';
                                    }
                                });

                                // Trigger on page load if role is already selected
                                if (document.getElementById('role').value === 'seller') {
                                    document.getElementById('storeFields').style.display = 'block';
                                }
                            </script>
                        @endsection
