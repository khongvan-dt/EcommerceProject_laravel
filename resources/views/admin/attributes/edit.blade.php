@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Update Attribute</h2>
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
                                        Attributes
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
                    <form method="POST" action="{{ route('admin.attributes.update', ['id' => $attribute->id, 'productId' => $productId]) }}">
                        @method('PUT')
                        @csrf
                        <div class="col-lg-12">
                            <!-- input style start -->
                            <div class="card-style">
                                <div class="input-style-1">
                                    <label>Attribute Name</label>
                                    <input type="text" placeholder="Attribute Name" name="name" required
                                        value="{{ $attribute->name }}" />
                                </div>
                                <div class="justify-content-center list-unstyled d-flex gap-3">
                                    <li class="">
                                        <button type="submit" href="#0"
                                            class="main-btn success-btn rounded-full btn-hover">Save</button>
                                    </li>

                                    <li>
                                        <button type="reset" href="#0"
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
