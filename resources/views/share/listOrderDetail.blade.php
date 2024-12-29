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
                                    <th>STT</th>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Size</th>
                                    <th>Color</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($orderDetails->count() > 0)
                                    @foreach ($orderDetails as $od)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td><img src="{{ asset('storage/' . $od->media->mediaUrl)}}" alt="{{$od->product->name}}" width="50px"></td>
                                            <td>{{$od->product->name}}</td>
                                            <td>{{$od->size->name}}</td>
                                            <td>{{$od->color->name}}</td>
                                            <td>{{$od->quantity}}</td>
                                            <td class="cart__price">
                                                {{ number_format($od->price * 1000, 0, ',', '.') }}đ
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
                                <a href="{{ route('viewOrder') }}">Return List Order</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
