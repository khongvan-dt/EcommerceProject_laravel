@extends('layouts.admin')
@section('content')
 <section class="section">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                        <h2>Edit Product: {{ $product->name }}</h2>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="form-elements-wrapper">
            <div class="row">
            <form method="POST" action="{{ route('admin.products.store.update', $product->id) }}" enctype="multipart/form-data">
            @csrf
                    <div class="col-lg-12">
                        <div class="card-style">
                            <div class="input-style-1">
                                <label>Product Name</label>
                                <input type="text" name="name" value="{{ old('name', $product->name) }}" required />
                                @error('name')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="input-style-2">
                                <label>Product Slug</label>
                                <input type="text" name="slug" value="{{ old('slug', $product->slug) }}" />
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
                                            <option value="{{ $brand->id }}" 
                                                {{ old('brandId', $product->brandId) == $brand->id ? 'selected' : '' }}>
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
                                            <option value="{{ $category->id }}"
                                                {{ old('categoryId', $product->productCategory->categoryId) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="card-style mb-30">
                                <h6 class="mb-25">Description</h6>
                                <div class="input-style-3">
                                    <textarea name="description" rows="5">{{ old('description', $product->description) }}</textarea>
                                </div>
                            </div>

                            <div class="select-style-1">
                                <label>Choose Product Type</label>
                                <div class="select-position">
                                    <select name="typeId">
                                        <option value="">Select Type</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}"
                                                {{ old('typeId', $product->productType->typeId) == $type->id ? 'selected' : '' }}>
                                                {{ $type->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="input-style-2">
                                <label>Current Main Image</label>
                                <div id="mainImagePreview">
                                    @if($product->mainImage)
                                        <img src="{{ Storage::url($product->mainImage->mediaUrl) }}" width="200">
                                    @endif
                                </div>
                                <input type="file" name="mainImage" id="mainImage" accept="image/*" onchange="previewMainImage(this)"/>
                            </div>
                             <div class="input-style-2">
                                <label>Additional Images (<span id="imageCount">0</span>/10)</label>
                                <div class="current-images mb-3 d-flex flex-wrap">
                                    @foreach($product->productMedia->where('mainImage', 0) as $media)
                                        <div class="image-item">
                                            <img src="{{ Storage::url($media->mediaUrl) }}" width="100">
                                        </div>
                                    @endforeach
                                </div>
                                
                                <div class="file-input-container">
                                    <div class="selected-images d-flex flex-wrap" id="selectedImages">
                                    </div>
                                    <input type="file" name="additionalImages[]" id="additionalImages" multiple accept="image/*" onchange="previewImages(this)"/>
                                </div>
                            </div>

                            <div class="button-group">
                                <button type="submit" class="main-btn success-btn btn-hover">Update Product</button>
                                <a href="{{ route('admin.products.index') }}" class="main-btn danger-btn btn-hover">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection