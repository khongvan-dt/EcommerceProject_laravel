@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Update Type</h2>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Types
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
                            <form method="POST" action="{{ route('admin.types.update', $type->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="input-style-1">
                                    <label for="name">Type Name</label>
                                    <input type="text" id="name" name="name" placeholder="Type Name"
                                           value="{{ old('name', $type->name) }}" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-around">
                                    <div class="form-check radio-style radio-success mb-20">
                                        <input class="form-check-input" type="radio" name="status" value="0"
                                               id="status-active" 
                                               {{ old('status', $type->status) == '0' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status-active">Active</label>
                                    </div>
                                    <div class="form-check radio-style radio-danger mb-20">
                                        <input class="form-check-input" type="radio" name="status" value="1"
                                               id="status-inactive"
                                               {{ old('status', $type->status) == '1' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="status-inactive">Inactive</label>
                                    </div>
                                </div>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <div class="d-flex justify-content-center list-unstyled gap-3 mt-4">
                                    <button type="submit" class="main-btn success-btn rounded-full btn-hover">Save</button>
                                    <button type="reset" class="main-btn danger-btn rounded-full btn-hover">Reset</button>
                                </div>
                            </form>
                            <!-- end form -->
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- ========== title-wrapper end ========== -->
    </section>
@endsection
