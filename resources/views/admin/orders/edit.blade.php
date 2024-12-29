@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Update Order {{ $order->id }}</h2>
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
                                        Orders
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
            <!-- end row -->
            <div class="form-elements-wrapper">
                <div class="row">
                    <form method="POST" action="{{ route('admin.orders.update', $order->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="col-lg-12">
                            <!-- input style start -->
                            <div class="card-style">
                                <div class="input-style-2">
                                    <label>Total Price</label>
                                    <input type="number" placeholder="Total Price" name="totalPrice"
                                        value="{{ $order->totalPrice }}" />
                                </div>
                                @error('totalPrice')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                                <div class="d-flex justify-content-center">
                                    <div class="form-check radio-style mb-20">
                                        <input class="form-check-input" type="radio" value="VnPay" name="paymentMethod"
                                            id="radio-1" @if ($order->paymentMethod == 'VnPay') checked @endif>
                                        <label class="form-check-label" for="radio-1">
                                            VNPay
                                        </label>
                                    </div>
                                    <div class="form-check radio-style mb-20">
                                        <input class="form-check-input" type="radio" value="paymoney" name="paymentMethod"
                                            id="radio-2" @if ($order->paymentMethod == 'paymoney') checked @endif>
                                        <label class="form-check-label" for="radio-2">
                                            Pay to Money
                                        </label>
                                    </div>
                                </div>
                                @error('paymentMethod')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                                <div class="select-style-1">
                                    <label>Choose Status</label>
                                    <div class="select-position">
                                        <select name="status">
                                            <option value="">Select Status</option>
                                            <option value="pending">Pending</option>
                                            <option value="completed">Completed</option>
                                            <option value="cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                    @error('status')
                                        <div class="text-danger mt-1">{{ $message }}</div>
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
