@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Add New Discount</h2>
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
                                        Discounts
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
                    <form method="POST" action="{{ route('admin.discounts.store') }}">
                        @csrf
                        <div class="col-lg-12">
                            <!-- input style start -->
                            <div class="card-style">
                                <!-- Product selection -->
                                <div class="select-style-1">
                                    <label>Choose Product</label>
                                    <div class="select-position">
                                        <select name="productId">
                                            <option value="">Select Product</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}"
                                                    {{ old('productId') == $product->id ? 'selected' : '' }}>
                                                    {{ $product->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('productId')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- end input -->

                                <!-- Discount percentage -->
                                <div class="input-style-2">
                                    <label>Discount Percentage</label>
                                    <input type="number" placeholder="Discount Percentage" name="discountPercentage"
                                        value="{{ old('discountPercentage') }}" required />
                                    @error('discountPercentage')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Start Date -->
                                <div class="input-style-3">
                                    <label>Start Date</label>
                                    <input type="date" name="startDate" value="{{ old('startDate') }}" required />
                                    @error('startDate')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- End Date -->
                                <div class="input-style-3">
                                    <label>End Date</label>
                                    <input type="date" name="endDate" value="{{ old('endDate') }}" required />
                                    @error('endDate')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Buttons -->
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
