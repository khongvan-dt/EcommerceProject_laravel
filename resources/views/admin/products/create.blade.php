@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Add New Product</h2>
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
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            <div class="form-elements-wrapper">
                <div class="row">
                    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-12">
                            <!-- input style start -->
                            <div class="card-style">
                                <div class="input-style-1">
                                    <label>Product Name</label>
                                    <input type="text" placeholder="Product Name" name="name" value="{{ old('name') }}" required />
                                    @error('name')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- end input -->
                                <div class="input-style-2">
                                    <label>Product Slug</label>
                                    <input type="text" placeholder="Slug Product" name="slug" value="{{ old('slug') }}" />
                                    @error('slug')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="select-style-1">
                                    <label>Choose Brand</label>
                                    <div class="select-position">
                                        <select name="brandId">
                                            <option value="">Select Brand</option>
                                            @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }} {{ old('brandId') == $brand->id ? 'selected' : '' }}">
                                                {{ $brand->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('brandId')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="select-style-1">
                                    <label>Choose Category</label>
                                    <div class="select-position">
                                        <select name="categoryId">
                                            <option value="">Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }} {{ old('categoryId') == $category->id ? 'selected' : '' }}">
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('categoryId')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="card-style mb-30">
                                    <h6 class="mb-25">Description</h6>
                                    <div class="input-style-3">
                                        <textarea placeholder="Product Description" rows="5" name="description">{{ old('description') }}</textarea>
                                        <span class="icon"><i class="lni lni-text-format"></i></span>
                                    </div>
                                    @error('description')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                    <!-- end textarea -->
                                </div>
                                <div class="select-style-1">
                                    <label>Choose Product Type</label>
                                    <div class="select-position">
                                        <select name="typeId">
                                            <option value="">Select Product Type</option>
                                            @foreach ($types as $type)
                                                <option value="{{ $type->id }}" {{ old('typeId') == $type->id ? 'selected' : '' }}>
                                                    {{ $type->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('productTypeId')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="input-style-2">
                                    <label>Choose Main Image</label>
                                    <input type="file" name="mainImage" required />
                                    @error('mainImage')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="input-style-2">
                                    <label>Choose Additional Images</label>
                                    <input type="file" name="additionalImages[]" multiple />
                                    <small>(Maximum 10 images)</small>
                                    @error('additionalImages')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="justify-content-center list-unstyled d-flex gap-3">
                                    <li>
                                        <button type="submit" class="main-btn success-btn rounded-full btn-hover">Save</button>
                                    </li>
                                    <li>
                                        <button type="reset" class="main-btn danger-btn rounded-full btn-hover">Reset</button>
                                    </li>
                                </div>
                                <!-- end input -->
                            </div>
                        </div>
                    </form>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- ========== title-wrapper end ========== -->
        </div>
        <!-- end container -->
    </section>
@endsection
