@extends('seller.layouts.app')

@section('title', 'Seller Store Dasboard')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Categories</h3>
                    </div>
                    <div class="col-sm-6 d-flex flex-column align-items-end">
                        <ol class="breadcrumb mb-2">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Category</li>
                        </ol>
                        <a href="{{ route('seller.categories.create', $username) }}" class="btn btn-primary">Add
                            New
                            Category</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-content">
            <div class="container-fluid">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">All Category </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse"
                                        title="Collapse">
                                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped table-hover table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px" class="text-center">#</th>
                                            <th>Name of Category</th>
                                            <th class="text-start" style="width: 200px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($categories ?? [] as $index => $category)
                                            <tr class="align-middle">
                                                <td class="text-center">{{ $index + 1 }}.</td>
                                                <td>{{ $category->name }}</td>
                                                <td class="text-start">
                                                    <a href="{{ route('seller.categories.edit', [$username, $category->id]) }}"
                                                        class="btn m-1 btn-warning">Edit</a>
                                                    <form
                                                        action="{{ route('seller.categories.destroy', [$username, $category->id]) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Delete this category?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn m-1 btn-danger">Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center py-4">No categories yet.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer clearfix">
                                <div class="float-end">
                                    {!! $categories->links('pagination::bootstrap-5') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
