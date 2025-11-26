@extends('admin-lte.layouts.app')

@section('title', 'Request Seller')

@section('content')

    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Request Menjadi Seller</h3>
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

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h3 class="card-title">Form Request Seller</h3>
                        </div>

                        <form action="{{ route('seller.request') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                @if (session('error'))
                                    <div class="alert alert-danger">{{ session('error') }}</div>
                                @endif

                                <div class="mb-3">
                                    <label for="store_name" class="form-label">Store Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="store_name" id="store_name"
                                        class="form-control @error('store_name') is-invalid @enderror"
                                        value="{{ old('store_name', Auth::user()->store_name) }}" required>
                                    @error('store_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="store_description" class="form-label">Store Description</label>
                                    <textarea name="store_description" id="store_description" rows="4"
                                        class="form-control @error('store_description') is-invalid @enderror">{{ old('store_description', Auth::user()->store_description) }}</textarea>
                                    @error('store_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                            <div class="card-footer">
                                <button class="btn btn-primary">Kirim Request</button>
                                <a href="{{ route('home') }}" class="btn btn-secondary">Batal</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
