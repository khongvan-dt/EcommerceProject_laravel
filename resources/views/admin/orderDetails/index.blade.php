@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Order Details</h2>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="breadcrumb-wrapper">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="{{route('admin.dashboard')}}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="{{route('admin.orders.index')}}">Orders</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Order Details
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="tables-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-style mb-30">
                            <h6 class="mb-10">Order Details Management</h6>
                            <div class="table-wrapper table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <h6>STT</h6>
                                            </th>
                                            <th>
                                                <h6>Image</h6>
                                            </th>
                                            <th>
                                                <h6>Product</h6>
                                            </th>
                                            <th>
                                                <h6>Size</h6>
                                            </th>
                                            <th>
                                                <h6>Color</h6>
                                            </th>
                                            <th>
                                                <h6>Quantity</h6>
                                            </th>
                                            <th>
                                                <h6>Price</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderDetails as $od)
                                            <tr>
                                                <td>
                                                    <p>{{ $loop->iteration }}</p>
                                                </td>
                                                <td class="min-width">
                                                    <img src="{{ asset('storage/' . $od->media->mediaUrl)}}" alt="{{$od->product->name}}" width="50px">
                                                </td>
                                                <td class="min-width">
                                                    <p>{{$od->product->name}}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ $od->size->name }}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ $od->color->name }}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ $od->quantity }}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ number_format($od->price * 1000, 0, ',', '.') }}đ</p>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
