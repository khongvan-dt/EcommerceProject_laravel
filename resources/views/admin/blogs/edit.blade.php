@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Edit Blog</h2>
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
                                        Blogs
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success message after update -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="form-elements-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- input style start -->
                        <div class="card-style">
                            <form method="POST" action="{{ route('admin.blogs.update', $blog->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="input-style-1">
                                    <label>Blog Title</label>
                                    <input type="text" placeholder="Blog Title" name="title" value="{{ old('title', $blog->title) }}" required/>
                                </div>

                                <div class="input-style-2">
                                    <label>Blog Slug</label>
                                    <input type="text" placeholder="Slug Blog" name="slug" value="{{ old('slug', $blog->slug) }}" />
                                </div>

                                <div class="input-style-3">
    <label>Blog Image</label>
    <div id="imagePreview" class="mt-2">
        @if($blog->image)
            <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" class="preview-image">
        @endif
    </div>
    <input type="file" name="image" accept="image/*" onchange="previewImage(this, 'imagePreview', 'preview-image')" />
</div>

                                <div class="card-style mb-30">
                                    <h6 class="mb-25">Content</h6>
                                    <div class="input-style-3">
                                        <textarea placeholder="Blog Content" rows="5" name="content">{{ old('content', $blog->content) }}</textarea>
                                        <span class="icon"><i class="lni lni-text-format"></i></span>
                                    </div>
                                </div>

                                <div class="justify-content-center list-unstyled d-flex gap-3">
                                    <li class="">
                                        <button type="submit" class="main-btn success-btn rounded-full btn-hover">Save</button>
                                    </li>

                                    <li>
                                        <a href="{{ route('admin.blogs.index') }}" class="main-btn danger-btn rounded-full btn-hover">Cancel</a>
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
