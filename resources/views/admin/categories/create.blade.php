@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Add New Category</h2>
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
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Display validation errors -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- form -->
            <div class="form-elements-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- input style start -->
                        <div class="card-style">
                            <form method="POST" action="{{ route('admin.categories.store') }}">
                                @csrf
                                <div class="input-style-1">
                                    <label>Category Name</label>
                                    <input type="text" placeholder="Category Name" name="name" value="{{ old('name') }}" required/>
                                </div>
                                <!-- end input -->
                                <div class="input-style-2">
                                    <label>Category Slug</label>
                                    <input type="text" placeholder="Slug Category" name="slug" value="{{ old('slug') }}" required/>
                                </div>
                                <div class="select-style-1">
                                    <label>Choice Parent Category</label>
                                    <div class="select-position">
                                        <select name="parentId">
                                            <option value="">Chọn danh mục</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('parentId') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card-style mb-30">
                                    <h6 class="mb-25">Description</h6>
                                    <div class="input-style-3">
                                        <textarea placeholder="Message" rows="5" name="description">{{ old('description') }}</textarea>
                                        <span class="icon"><i class="lni lni-text-format"></i></span>
                                    </div>
                                    <!-- end textarea -->
                                </div>
                                <div class="justify-content-center list-unstyled d-flex gap-3">
                                    <li class="">
                                        <button type="submit" class="main-btn success-btn rounded-full btn-hover">Save</button>
                                    </li>
                                    <li>
                                        <button type="reset" class="main-btn danger-btn rounded-full btn-hover">Reset</button>
                                    </li>
                                </div>
                            </form>
                            <!-- end input -->
                        </div>
                    </div>
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
