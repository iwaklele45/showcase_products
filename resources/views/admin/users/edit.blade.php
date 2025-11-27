@extends('admin-lte.layouts.app')

@section('title', 'Edit User')

@section('content')

    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Edit User</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                        {{-- <li class="breadcrumb-item"><a href="{{ route('users.index') }}">User</a></li> --}}
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                            <h3 class="card-title">Form Edit User</h3>
                        </div>

                        <form action="" method="POST" class="needs-validation" novalidate>
                            @csrf
                            @method('PATCH')

                            <div class="card-body">
                                <!-- Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name', $user->name) }}" required>

                                    <div class="app-content">
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="card-title">User Information</h3>
                                                        </div>

                                                        <form action="{{ route('admin.users.update', $user) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="card-body">
                                                                <div class="mb-3">
                                                                    <label for="name" class="form-label">Name <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text"
                                                                        class="form-control @error('name') is-invalid @enderror"
                                                                        id="name" name="name"
                                                                        value="{{ old('name', $user->name) }}" required>
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
                                                                        value="{{ old('username', $user->username) }}"
                                                                        required>
                                                                    <div class="mb-3">
                                                                        <label for="username" class="form-label">Username
                                                                            <span class="text-danger">*</span></label>
                                                                        <input type="text"
                                                                            class="form-control @error('username') is-invalid @enderror"
                                                                            id="username" name="username"
                                                                            value="{{ old('username', $user->username) }}"
                                                                            required>
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
                                                                            value="{{ old('email', $user->email) }}"
                                                                            required>
                                                                        <div class="mb-3">
                                                                            <label for="email" class="form-label">Email
                                                                                <span class="text-danger">*</span></label>
                                                                            <input type="email"
                                                                                class="form-control @error('email') is-invalid @enderror"
                                                                                id="email" name="email"
                                                                                value="{{ old('email', $user->email) }}"
                                                                                required>
                                                                            @error('email')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}</div>
                                                                            @enderror
                                                                        </div>

                                                                        <!-- Password (optional) -->
                                                                        <div class="mb-3">
                                                                            <label for="password"
                                                                                class="form-label">Password (kosongkan jika
                                                                                tidak ingin
                                                                                mengubah)</label>
                                                                            <input type="password"
                                                                                class="form-control @error('password') is-invalid @enderror"
                                                                                id="password" name="password">
                                                                            <div class="mb-3">
                                                                                <label for="password"
                                                                                    class="form-label">Password <small
                                                                                        class="text-muted">(leave blank to
                                                                                        keep current)</small></label>
                                                                                <input type="password"
                                                                                    class="form-control @error('password') is-invalid @enderror"
                                                                                    id="password" name="password">
                                                                                @error('password')
                                                                                    <div class="invalid-feedback">
                                                                                        {{ $message }}</div>
                                                                                @enderror
                                                                            </div>

                                                                            <!-- Password Confirmation -->
                                                                            <div class="mb-3">
                                                                                <label for="password_confirmation"
                                                                                    class="form-label">Konfirmasi
                                                                                    Password</label>
                                                                                <input type="password"
                                                                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                                                                    id="password_confirmation"
                                                                                    name="password_confirmation">
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
                                                                                        {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
                                                                                        Admin</option>
                                                                                    <option value="user"
                                                                                        {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>
                                                                                        User</option>
                                                                                    <option value="seller"
                                                                                        {{ old('role', $user->role) === 'seller' ? 'selected' : '' }}>
                                                                                        Seller</option>
                                                                                    <div class="mb-3">
                                                                                        <label for="password_confirmation"
                                                                                            class="form-label">Confirm
                                                                                            Password</label>
                                                                                        <input type="password"
                                                                                            class="form-control"
                                                                                            id="password_confirmation"
                                                                                            name="password_confirmation">
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
                                                                                                {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
                                                                                                Admin</option>
                                                                                            <option value="seller"
                                                                                                {{ old('role', $user->role) === 'seller' ? 'selected' : '' }}>
                                                                                                Seller</option>
                                                                                            <option value="user"
                                                                                                {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>
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
                                                                                    class="btn btn-primary">Perbarui</button>
                                                                                <a href=""
                                                                                    class="btn btn-secondary">Batal</a>

                                                                                <div class="mb-3" id="storeFields"
                                                                                    style="display: {{ old('role', $user->role) === 'seller' ? 'block' : 'none' }};">
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
                                                                                            value="{{ old('store_name', $user->store_name) }}">
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
                                                                                            name="store_description" rows="3">{{ old('store_description', $user->store_description) }}</textarea>
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
                                                                                        {{ old('email_verified', $user->email_verified) ? 'checked' : '' }}>
                                                                                    <label class="form-check-label"
                                                                                        for="email_verified">
                                                                                        Email Verified
                                                                                    </label>
                                                                                </div>
                                                                            </div>

                                                                            <div class="card-footer">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary">Update
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
                            </script>
                        @endsection
