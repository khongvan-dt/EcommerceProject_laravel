@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Products</h2>
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
                                        Products
                                    </li>
                                </ol>
                                <a href="{{ route('admin.products.create') }}" class="btn btn-primary float-right">Add New</a>
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
            <!-- end row -->
            <div class="tables-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-style mb-30">
                            <h6 class="mb-10">Products Management</h6>
                            <div class="table-wrapper table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <h6>STT</h6>
                                            </th>
                                            <th>
                                                <h6>Product Name</h6>
                                            </th>
                                            <th>
                                                <h6>Images</h6>
                                            </th>
                                            <th>
                                                <h6>Slug</h6>
                                            </th>
                                            <th>
                                                <h6>Brand</h6>
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
                                        @foreach ($products as $product)
                                            <tr>
                                                <td class="min-width">
                                                   <p>{{ $loop->iteration}}</p>                                                                                     
                                                </td>
                                                <td class="min-width">
                                                    <p>{{$product->name}}</p>
                                                </td>
                                                <td class="min-width">
                                                    @if($product->mainImage)
                                                        <a href="{{ route('admin.media.index', $product->id) }}">
                                                            <img src="{{ asset('storage/' . $product->mainImage->mediaUrl) }}" alt="Main Image" style="width: 100px; height: auto;">
                                                        </a>
                                                    @else
                                                        <p>No Image Available</p>
                                                    @endif
                                                </td>                                                                                          
                                                <td class="min-width">
                                                    <p>{{$product->slug}}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ $product->brand->name }}</p>
                                                </td>
                                                <td class="min-width">
                                                    @if ($product->status == 0)
                                                        <span class="status-btn active-btn">Active</span>
                                                    @else
                                                        <span class="status-btn inactive-btn">Inactive</span>
                                                    @endif  
                                                </td>
                                                <td>
                                                    <div class="action">
                                                        <form method="POST"
                                                            action="{{ route('admin.products.destroy', $product->id) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="text-danger"
                                                                onclick="return confirm('Are you sure you want to delete this product?')">
                                                                <i class="lni lni-trash-can"></i>
                                                            </button>
                                                        </form>
                                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                                            class="text-warning">
                                                            <i class="lni lni-pencil"></i>
                                                        </a>
                                                        <a href="{{ route('admin.attributes.index', $product->id) }}" class="text-success">
                                                            <i class="lni lni-plus"></i>
                                                        </a>                                                        
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
@endsection
