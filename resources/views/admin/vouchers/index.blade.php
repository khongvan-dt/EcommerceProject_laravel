@extends('layouts.admin')

@section('content')
    <section class="section">
        <div class="container-fluid">
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title">
                            <h2>Vouchers Management</h2>
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
                                <a href="{{ route('admin.vouchers.create') }}" class="btn btn-primary float-right">Add
                                    New</a>
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
                            <h6 class="mb-10">Vouchers Management</h6>
                            <div class="table-wrapper table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <h6>Code</h6>
                                            </th>
                                            <th>
                                                <h6>Discount Percentage</h6>
                                            </th>
                                            <th>
                                                <h6>Min Purchase Amount</h6>
                                            </th>
                                            <th>
                                                <h6>Quantity</h6>
                                            </th>
                                            <th>
                                                <h6>Start Date</h6>
                                            </th>
                                            <th>
                                                <h6>End Date</h6>
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
                                        @foreach ($vouchers as $voucher)
                                            <tr>
                                                <td>
                                                   <p>{{$voucher->code}}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{$voucher->discountPercentage}}%</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ number_format($voucher->minPurchaseAmount* 1000, 0, ',', '.') }} đ</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{$voucher->quantity}}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ \Carbon\Carbon::parse($voucher->startDate)->format('d/m/Y') }}</p>
                                                </td>
                                                <td class="min-width">
                                                    <p>{{ \Carbon\Carbon::parse($voucher->endDate)->format('d/m/Y') }}</p>
                                                </td>
                                                <td class="min-width">
                                                    @if ($voucher->status == 'ACTIVE')
                                                        <span class="status-btn active-btn">Active</span>
                                                    @else
                                                        <span class="status-btn inactive-btn">Inactive</span>
                                                    @endif  
                                                </td>
                                                <td>
                                                    <div class="action">
                                                        <form method="POST"
                                                            action="{{ route('admin.vouchers.destroy', $voucher->id) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="text-danger"
                                                                onclick="return confirm('Are you sure you want to delete this voucher?')">
                                                                <i class="lni lni-trash-can"></i>
                                                            </button>
                                                        </form>
                                                        <a href="{{ route('admin.vouchers.edit', $voucher->id) }}"
                                                            class="text-warning">
                                                            <i class="lni lni-pencil"></i>
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
@endsection
