@extends('seller.layouts.app')

@section('title', 'Edit Category')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Edit Category</h3>
                    </div>
                    <div class="col-sm-6 d-flex flex-column align-items-end">
                        <ol class="breadcrumb mb-2">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('seller.categories.index', $username) }}">Categories</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                        <a href="{{ route('seller.categories.index', $username) }}" class="btn btn-secondary">Back to
                            Categories</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 mx-auto">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Edit Category</h3>
                            </div>

                            <form action="{{ route('seller.categories.update', [$username, $category->id]) }}"
                                method="POST">
                                @csrf
                                @method('PATCH')

                                <div class="card-body">

                                    {{-- Category Name --}}
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Category Name</label>
                                        <input type="text" name="name" id="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', $category->name) }}" required>

                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                </div>

                                <div class="card-footer d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>

                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
