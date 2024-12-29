@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Orders</h2>
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
                            <h6 class="mb-10">Brands Management</h6>
                            <div class="table-wrapper table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <h6>STT</h6>
                                            </th>
                                            <th>
                                                <h6>Name</h6>
                                            </th>
                                            <th>
                                                <h6>Total Price</h6>
                                            </th>
                                            <th>
                                                <h6>Payment Method</h6>
                                            </th>
                                            <th>
                                                <h6>Status</h6>
                                            </th>
                                            <th>
                                                <h6>Action</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>
                                                    <p>{{ $loop->iteration }}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ $order->user->name }}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p> {{ number_format($order->totalPrice * 1000, 0, ',', '.') }}đ</p>
                                                </td>
                                                <td>{{ $order->paymentMethod }}</td>
                                                <td>{{ $order->status }}</td>
                                                <td>
                                                    <div class="action">
                                                        <form method="POST"
                                                            action="{{ route('admin.orders.destroy', $order->id) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="text-danger"
                                                                onclick="return confirm('Are you sure you want to delete this order?')">
                                                                <i class="lni lni-trash-can"></i>
                                                            </button>
                                                        </form>
                                                        <a href="{{ route('admin.orders.edit', $order->id) }}"
                                                            class="text-warning">
                                                            <i class="lni lni-pencil"></i>
                                                        </a>
                                                        <a href="{{ route('admin.orderDetails.index', $order->id) }}"
                                                            class="text-warning">
                                                            <i class="lni lni-eye"></i>
                                                        </a>
                                                    </div>
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
    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this category? This action cannot be undone.');
        }
    </script>
@endsection
