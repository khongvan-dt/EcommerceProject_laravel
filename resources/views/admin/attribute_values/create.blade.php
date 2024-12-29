@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Add New Attribute Value</h2>
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
                                        Attribute Values
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <!-- Display general error messages -->
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
                    <form method="POST" action="{{route('admin.attributeValues.store')}}">
                        @csrf
                        <div class="col-lg-12">
                            <input type="hidden" name="attributeId" value="{{$attributeId}}" />
                            <div class="card-style">
                                <div class="input-style-1">
                                    <label>Name</label>
                                    <input type="text" placeholder="Attribute Value Name" name="name"
                                        value="{{ old('name') }}" required />
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="input-style-1">
                                    <label>Stock</label>
                                    <input type="number" placeholder="Stock" name="stock" value="{{ old('stock') }}"
                                        required />
                                    @error('stock')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="input-style-1">
                                    <label>Price In (đ)</label>
                                    <input type="number" placeholder="Price In" name="priceIn"
                                        value="{{ old('priceIn') }}" required />
                                    @error('priceIn')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="input-style-1">
                                    <label>Price Out (đ)</label>
                                    <input type="number" placeholder="Price Out" name="priceOut"
                                        value="{{ old('priceOut') }}" required />
                                    @error('priceOut')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
