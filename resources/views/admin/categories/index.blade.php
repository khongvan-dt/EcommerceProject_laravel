@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Categories</h2>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#0">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Categories
                                    </li>
                                </ol>
                                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary float-right">Add New</a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="tables-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-style mb-30">
                            <h6 class="mb-10">Categories Management</h6>
                            <div class="table-wrapper table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <h6>STT</h6>
                                            </th>
                                            <th>
                                                <h6>Name</h6>
                                            </th>
                                            <th>
                                                <h6>Slug</h6>
                                            </th>
                                            <th>
                                                <h6>Parent Category</h6>
                                            </th>
                                            <th>
                                                <h6>Description</h6>
                                            </th>
                                            <th>
                                                <h6>Status</h6>
                                            </th>
                                            <th>
                                                <h6>Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ $category->name }}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p><a href="#0">{{ $category->slug }}</a></p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ $category->parentId ? $category->parentId->name : 'No Parent' }}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ $category->description }}</p>
                                                </td>
                                                <td class="min-width">
                                                    @if ($category->status == 0)
                                                        <span class="status-btn active-btn">Active</span>
                                                    @else
                                                        <span class="status-btn inactive-btn">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="action">
                                                        <form method="POST" action="{{ route('admin.categories.destroy', $category->id) }}" onsubmit="return confirmDelete()">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button class="text-danger">
                                                                <i class="lni lni-trash-can"></i>
                                                            </button>
                                                        </form>

                                                        <form method="GET" action="{{ route('admin.categories.edit', $category->id) }}">
                                                            <button type="submit" class="text-warning">
                                                                <i class="lni lni-pencil"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this category? This action cannot be undone.');
        }
    </script>
@endsection
