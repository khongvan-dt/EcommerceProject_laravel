@extends('layouts.share')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Check Out</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('dashboard') }}">Home</a>
                            <a href="{{ route('shop') }}">Shop</a>
                            <span>Result Order</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="checkout spad">
        <div class="container">
            <div class="alert alert-success text-center" role="alert">
                @if ($paymentStatus == 'success')
                    <h4 class="alert-heading">Thanh toán thành công!</h4>
                    <p>Chúc mừng bạn! Bạn đã thanh toán thành công.</p>
                    <hr>
                    <p class="mb-0">Hãy xem chi tiết đơn hàng của bạn.</p>
                @else
                    <h4 class="alert-heading">Thanh toán thất bại!</h4>
                    <p>Vui lòng kiểm tra thông tin đơn hàng và thử lại.</p>
                @endif
                <a href="{{route('viewOrder')}}" class="btn btn-primary mt-3">View Order</a>
            </div>
        </div>
    </section>
@endsection
