@extends('layouts.share')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>List Order</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('dashboard') }}">Home</a>
                            <a href="{{ route('shop') }}">Shop</a>
                            <span>List Order</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>OrderId</th>
                                    <th>Name</th>
                                    <th>Total Price</th>
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($orders->count() > 0)
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{ Auth::user()->firstName . ' ' . Auth::user()->lastName }}</td>
                                            <td class="cart__price">
                                                {{ number_format($order->totalPrice * 1000, 0, ',', '.') }}đ
                                            </td>
                                            <td class="cart__color">{{ $order->paymentMethod }}</td>
                                            <td class="cart__size">{{ $order->status }}</td>
                                            <td class="cart__close">
                                                <form method="GET" action="{{route('viewOrderDetail', $order->id)}}">
                                                    @csrf
                                                    <button type="submit" class="btn btn-light"><i class="fa fa-eye"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success mt-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="{{ route('shop') }}">Continue Shopping</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
