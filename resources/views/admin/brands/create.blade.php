@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Add New Brand</h2>
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
                                        Brands
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-elements-wrapper">
                <div class="row">
                    <form method="POST" action="{{ route('admin.brands.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-lg-12">
                            <!-- input style start -->
                            <div class="card-style">
                                <div class="input-style-1">
                                    <label>Brand Name</label>
                                    <input type="text" placeholder="Brand Name" name="name"
                                        value="{{ old('name') }}" required />
                                    @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- end input -->
                                <div class="input-style-2">
                                    <label>Brand Slug</label>
                                    <input type="text" placeholder="Slug Brand" name="slug"
                                        value="{{ old('slug') }}" />
                                    @error('slug')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="input-style-3">
                                    <label>Brand Logo</label>
                                    <input type="file" name="logo" accept="image/*" />
                                    @error('logo')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="card-style mb-30">
                                    <h6 class="mb-25">Description</h6>
                                    <div class="input-style-3">
                                        <textarea placeholder="Brand Description" rows="5" name="description">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <span class="icon"><i class="lni lni-text-format"></i></span>
                                    </div>
                                    <!-- end textarea -->
                                </div>
                                <div class="justify-content-center list-unstyled d-flex gap-3">
                                    <li class="">
                                        <button type="submit"
                                            class="main-btn success-btn rounded-full btn-hover">Save</button>
                                    </li>
                                    <li>
                                        <button type="reset"
                                            class="main-btn danger-btn rounded-full btn-hover">Reset</button>
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
