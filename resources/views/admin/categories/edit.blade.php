@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Update Category {{$category->id}}</h2>
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
            <!-- end row -->
            <div class="form-elements-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- input style start -->
                        <div class="card-style">
                            <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
                                @method('PUT')
                                @csrf
                                <div class="input-style-1">
                                    <label>Category Name</label>
                                    <input type="text" placeholder="Category Name" name="name" value="{{ old('name', $category->name) }}" required />
                                </div>
                                <div class="input-style-2">
                                    <label>Category Slug</label>
                                    <input type="text" placeholder="Slug Category" name="slug" value="{{ old('slug', $category->slug) }}" readonly />
                                </div>
                                <div class="select-style-1">
                                    <label>Choice Parent Category</label>
                                    <div class="select-position">
                                        <select name="parent_id">
                                            <option value="">Select category</option>
                                            @foreach ($categories as $parentCategory)
                                                <option value="{{ $parentCategory->id }}" 
                                                    {{ $category->parent_id == $parentCategory->id ? 'selected' : '' }}>
                                                    {{ $parentCategory->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card-style mb-30">
                                    <h6 class="mb-25">Description</h6>
                                    <div class="input-style-3">
                                        <textarea placeholder="Message" rows="5" name="description">{{ old('description', $category->description) }}</textarea>
                                        <span class="icon"><i class="lni lni-text-format"></i></span>
                                    </div>
                                </div>
                                <div class="justify-content-center list-unstyled d-flex gap-3">
                                    <li>
                                        <button type="submit" class="main-btn success-btn rounded-full btn-hover save-btn">Save</button>
                                    </li>
                                    <li>
                                        <button type="reset" class="main-btn danger-btn rounded-full btn-hover reset-btn">Reset</button>
                                    </li>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
