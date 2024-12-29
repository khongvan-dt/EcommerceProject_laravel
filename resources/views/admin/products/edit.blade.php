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
                    <div class="col-lg-12">
                        <!-- input style start -->
                        <div class="card-style">
                            <div class="input-style-1">
                                <label>Product Name</label>
                                <input type="text" placeholder="Product Name" name="name" required/>
                            </div>
                            <!-- end input -->
                            <div class="input-style-2">
                                <label>Product Slug</label>
                                <input type="text" placeholder="Slug Product" />
                            </div>
                            <div class="select-style-1">
                                <label>Choose Brand</label>
                                <div class="select-position">
                                    <select>
                                        <option value="">Select Brand</option>
                                        <option value="1">Brand One</option>
                                        <option value="2">Brand Two</option>
                                        <option value="3">Brand Three</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-style mb-30">
                                <h6 class="mb-25">Description</h6>
                                <div class="input-style-3">
                                    <textarea placeholder="Product Description" rows="5"></textarea>
                                    <span class="icon"><i class="lni lni-text-format"></i></span>
                                </div>
                                <!-- end textarea -->
                            </div>
                            <div class="justify-content-center list-unstyled d-flex gap-3">
                                <li class="">
                                    <a href="#0" class="main-btn success-btn rounded-full btn-hover">Save</a>
                                </li>

                                <li>
                                    <a href="#0" class="main-btn danger-btn rounded-full btn-hover">Reset</a>
                                </li>
                            </div>
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
