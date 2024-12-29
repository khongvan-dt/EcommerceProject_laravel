@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Update Vouchers</h2>
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
                                        Vouchers
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
                    <form method="POST" action="{{ route('admin.vouchers.update', $voucher->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="col-lg-12">
                            <!-- input style start -->
                            <div class="card-style">
                                <div class="input-style-1">
                                    <label>Voucher Code</label>
                                    <input type="text" placeholder="Voucher Code" name="code" value="{{ old('code', $voucher->code)}}" required />
                                    @error('code')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Discount percentage -->
                                <div class="input-style-2">
                                    <label>Discount Percentage</label>
                                    <input type="number" placeholder="Discount Percentage" name="discountPercentage"
                                        value="{{ old('discountPercentage', $voucher->discountPercentage) }}" required />
                                    @error('discountPercentage')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="input-style-2">
                                    <label>Minimum Purchase Amount</label>
                                    <input type="number" placeholder="Minimum Purchase Amount"
                                        value="{{ old('minPurchaseAmount', $voucher->minPurchaseAmount)  }}" name="minPurchaseAmount" required />
                                    @error('minPurchaseAmount')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="input-style-2">
                                    <label>Quantity</label>
                                    <input type="number" placeholder="Quantity" name="quantity"
                                        value="{{ old('quantity', $voucher->quantity)}}" required />
                                    @error('quantity')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Start Date -->
                                <div class="input-style-3">
                                    <label>Start Date</label>
                                    <input type="date" name="startDate"
                                        value="{{ old('startDate', \Carbon\Carbon::parse($voucher->startDate)->format('Y-m-d')) }}" required />
                                    @error('startDate')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- End Date -->
                                <div class="input-style-3">
                                    <label>End Date</label>
                                    <input type="date" name="endDate" value="{{ old('endDate', \Carbon\Carbon::parse($voucher->endDate)->format('Y-m-d')) }}"
                                        required />
                                    @error('endDate')
                                        <div class="text-danger mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="justify-content-center list-unstyled d-flex gap-3">
                                    <li class="">
                                        <button type="submit"
                                            class="main-btn success-btn rounded-full btn-hover">Save</button>
                                    </li>

                                    <li>
                                        <button
                                            type="reset"class="main-btn danger-btn rounded-full btn-hover">Reset</button>
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
