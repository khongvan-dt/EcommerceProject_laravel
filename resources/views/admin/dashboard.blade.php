@extends('layouts.admin')

@section('content')
<!-- ========== section start ========== -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<section class="section">
    <div class="container-fluid">
        <!-- ========== title-wrapper start ========== -->
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title">
                        <h2>eCommerce Dashboard</h2>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-md-6">
                    <div class="breadcrumb-wrapper">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#0">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    eCommerce
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- ========== title-wrapper end ========== -->
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon purple">
                        <i class="lni lni-cart-full"></i>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">New Orders</h6>
                        <h3 class="text-bold mb-10">{{$totalOrdersLast30Days}}</h3>
                        @if ($percentageOrders >= 0)
                            <p class="text-sm text-success">
                                <i class="lni lni-arrow-up"></i> {{$percentageOrders}}%
                                <span class="text-gray">(30 days)</span>
                            </p>
                        @else
                           <p class="text-sm text-danger">
                                <i class="lni lni-arrow-down"></i> {{ abs($percentageOrders) }}%
                                <span class="text-gray">(30 days)</span>
                            </p>
                        @endif
                    </div>
                </div>
                <!-- End Icon Cart -->
            </div>
            <!-- End Col -->
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon success">
                        <i class="lni lni-dollar"></i>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">Total Income</h6>
                        <h3 class="text-bold mb-10"> ${{ number_format($totalPriceInThisMonth) }}</h3>
                            @if ($percentageChangePriceIn >= 0)
                            <p class="text-sm text-success">
                                <i class="lni lni-arrow-up"></i> {{$percentageChangePriceIn}}%
                                <span class="text-gray">(30 days)</span>
                                </p>
                            @else
                            <p class="text-sm text-danger">
                                <i class="lni lni-arrow-down"></i> {{ abs($percentageChangePriceIn) }}%
                                <span class="text-gray">(30 days)</span>
                                </p>
                            @endif
                    </div>
                </div>
            </div>
            <!-- End Col -->
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon primary">
                        <i class="lni lni-credit-cards"></i>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">Total Expense</h6>
                        <h3 class="text-bold mb-10">${{ number_format($totalSalesRevenueThisMonth) }}</h3>
                            @if ($percentageChangePriceOut >= 0)
                            <p class="text-sm text-success">

                                <i class="lni lni-arrow-up"></i> {{$percentageChangePriceOut}}%
                                <span class="text-gray">(30 days)</span>
                                </p>
                            @else
                            <p class="text-sm text-danger">
                                <i class="lni lni-arrow-down"></i> {{ abs($percentageChangePriceOut) }}%
                                <span class="text-gray">(30 days)</span>
                                </p>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <!-- End Col -->
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon orange">
                        <i class="lni lni-user"></i>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">New User</h6>
                        <h3 class="text-bold mb-10">{{$totalUsersLast30Days}}</h3>
                        @if ($percentageUsers >= 0)
                            <p class="text-sm text-success">
                                <i class="lni lni-arrow-up"></i> {{$percentageUsers}}%
                                <span class="text-gray">(30 days)</span>
                            </p>
                        @else
                            <p class="text-sm text-danger">
                                <i class="lni lni-arrow-down"></i> {{ abs($percentageUsers) }}%
                                <span class="text-gray">(30 days)</span>
                            </p>
                        @endif
                    </div>
                </div>
                <!-- End Icon Cart -->
            </div>
            <!-- End Col -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card-style mb-30">
                    <div class="title d-flex flex-wrap justify-content-between">
                        <div class="left">
                            <h6 class="text-medium mb-10">Yearly Stats</h6>
                            <h3 class="text-bold">${{ number_format($totalSalesRevenueThisMonth) }}</h3>
                        </div>
                        <div class="right">
                            <div class="select-style-1" style=" display: flex; gap: 10px;">
                                <div class="select-sm">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Xuất dữ liệu excel </button>

                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <form id="exportForm" action="{{ route('admin.dashboard') }}" method="GET">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Chọn thời gian xuất dữ liệu:</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </div>
                                        <div class="modal-body">
                                        <label for="startDate">Ngày bắt đầu:</label>
                                        <input id="startDate" name="startDate" class="form-control" type="date" required />
                                        <label for="endDate">Ngày kết thúc:</label>
                                        <input id="endDate" name="endDate" class="form-control" type="date" required />
                                        <input type="hidden" name="export" value="1">
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                                        <button type="submit" class="btn btn-primary">Xuất</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                                </div> 
                           </div>
                                <div class="select-position select-sm">
                                    <select class="light-bg" id="timeframeSelect">
                                        <option value="yearly">Yearly</option>
                                        <option value="monthly">Monthly</option>
                                        <option value="weekly">Weekly</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                     
                    <div class="chart">
                        <canvas id="Chart1" style="width: 100%; height: 400px;"></canvas>
                    </div>
                </div>
            </div>
            <div id="chartData" style="display: none;">
                @json($chartData)
            </div>
        </div>
        <!-- End Row -->
        <div class="row">
            
             <div class="col-lg-12">
                <div class="card-style mb-30">
                    <div class="title d-flex flex-wrap justify-content-between align-items-center">
                        <div class="left">
                            <h6 class="text-medium mb-30">Top Selling Products</h6>
                        </div>
                        <div class="right">
                            <div class="select-style-1">
                                <div class="select-position select-sm">
                                <select id="timeframeSelect" name="timeframe" class="form-select">
                                    <option value="yearly" {{ $timeframe === 'yearly' ? 'selected' : '' }}>Yearly</option>
                                    <option value="monthly" {{ $timeframe === 'monthly' ? 'selected' : '' }}>Monthly</option>
                                    <option value="weekly" {{ $timeframe === 'weekly' ? 'selected' : '' }}>Weekly</option>
                                </select>
                                </div>
                            </div>
                            <!-- end select -->
                        </div>
                    </div>
                    <!-- End Title -->
                    <div class="table-responsive">
                            <table class="table top-selling-table">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>
                                            <h6 class="text-sm text-medium">Products</h6>
                                        </th>
                                        <th class="min-width">
                                            <h6 class="text-sm text-medium">Category</h6>
                                        </th>
                                        <th class="min-width">
                                            <h6 class="text-sm text-medium">Price</h6>
                                        </th>
                                        <th class="min-width">
                                            <h6 class="text-sm text-medium">Sold</h6>
                                        </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($timeframe === 'yearly' && $getBestSellingThisYear)
                                    <tr>
                                        <td>
                                            <div class="product">
                                                <div class="image">
                                                    <img src="{{asset('storage/' . $getBestSellingThisYear->mediaUrl)}}" alt=""/>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm">{{$getBestSellingThisYear->product_name}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">{{$getBestSellingThisYear->category_name}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">${{number_format($getBestSellingThisYear->priceOut, 2)}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">{{$getBestSellingThisYear->total_sold}}</p>
                                        </td>
                                        <td>
                                            <div class="action justify-content-end">
                                                <button class="more-btn ml-10 dropdown-toggle" id="moreAction1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="lni lni-more-alt"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction1">
                                                    <li class="dropdown-item">
                                                        <a href="#0" class="text-gray">Edit</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @elseif($timeframe === 'monthly' && $getBestSelling30Days)
                                    <tr>
                                        <td>
                                            <div class="product">
                                                <div class="image">
                                                    <img src="{{ asset('storage/' . $getBestSelling30Days->mediaUrl) }}" alt="{{$getBestSelling30Days->product_name}}" style="width: 100px; height: auto;">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm">{{$getBestSelling30Days->product_name}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">{{$getBestSelling30Days->category_name}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">${{number_format($getBestSelling30Days->priceOut, 2)}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">{{$getBestSelling30Days->total_sold}}</p>
                                        </td>
                                        <td>
                                            <div class="action justify-content-end">
                                                <button class="more-btn ml-10 dropdown-toggle" id="moreAction1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="lni lni-more-alt"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction1">
                                                    <li class="dropdown-item">
                                                        <a href="#0" class="text-gray">Edit</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @elseif($timeframe === 'weekly' && $getBestSelling7Days)
                                    <tr>
                                        <td>
                                            <div class="product">
                                                <div class="image">
                                                    <img src="{{asset('storage/' . $getBestSelling7Days->mediaUrl)}}" alt=""/>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="text-sm">{{$getBestSelling7Days->product_name}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">{{$getBestSelling7Days->category_name}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">${{number_format($getBestSelling7Days->priceOut, 2)}}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm">{{$getBestSelling7Days->total_sold}}</p>
                                        </td>
                                        <td>
                                            <div class="action justify-content-end">
                                                <button class="more-btn ml-10 dropdown-toggle" id="moreAction1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="lni lni-more-alt"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction1">
                                                    <li class="dropdown-item">
                                                        <a href="#0" class="text-gray">Edit</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td colspan="6" class="text-center">No data available</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
 
                </div>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->
        <div class="row">
            <div class="col-lg-7">
                <div class="card-style mb-30">
                    <div class="title d-flex flex-wrap align-items-center justify-content-between">
                        <div class="left">
                            <h6 class="text-medium mb-2">Sales Forecast</h6>
                        </div>
                        <div class="right">
                            <div class="select-style-1 mb-2">
                                <div class="select-position select-sm">
                                    <select class="light-bg">
                                        <option value="">Last Month</option>
                                        <option value="">Last 3 Months</option>
                                        <option value="">Last Year</option>
                                    </select>
                                </div>
                            </div>
                            <!-- end select -->
                        </div>
                    </div>
                    <!-- End Title -->
                    <div class="chart">
                        <div id="legend3">
                            <ul class="legend3 d-flex flex-wrap align-items-center mb-30">
                                <li>
                                    <div class="d-flex">
                                        <span class="bg-color primary-bg"> </span>
                                        <div class="text">
                                            <p class="text-sm text-success">
                                                <span class="text-dark">Revenue</span> +25.55%
                                                <i class="lni lni-arrow-up"></i>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <span class="bg-color purple-bg"></span>
                                        <div class="text">
                                            <p class="text-sm text-success">
                                                <span class="text-dark">Net Profit</span> +45.55%
                                                <i class="lni lni-arrow-up"></i>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <span class="bg-color orange-bg"></span>
                                        <div class="text">
                                            <p class="text-sm text-danger">
                                                <span class="text-dark">Order</span> -4.2%
                                                <i class="lni lni-arrow-down"></i>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <canvas id="Chart3" style="width: 100%; height: 450px; margin-left: -35px;"></canvas>
                    </div>
                </div>
            </div>
            <!-- End Col -->
            <div class="col-lg-5">
                <div class="card-style mb-30">
                    <div class="title d-flex flex-wrap align-items-center justify-content-between">
                        <div class="left">
                            <h6 class="text-medium mb-2">Traffic</h6>
                        </div>
                        <div class="right">
                            <div class="select-style-1 mb-2">
                                <div class="select-position select-sm">
                                    <select class="bg-ligh">
                                        <option value="">Last 6 Months</option>
                                        <option value="">Last 3 Months</option>
                                        <option value="">Last Year</option>
                                    </select>
                                </div>
                            </div>
                            <!-- end select -->
                        </div>
                    </div>
                    <!-- End Title -->
                    <div class="chart">
                        <div id="legend4">
                            <ul class="legend3 d-flex flex-wrap gap-3 gap-sm-0 align-items-center mb-30">
                                <li>
                                    <div class="d-flex">
                                        <span class="bg-color primary-bg"> </span>
                                        <div class="text">
                                            <p class="text-sm text-success">
                                                <span class="text-dark">Store Visits</span>
                                                +25.55%
                                                <i class="lni lni-arrow-up"></i>
                                            </p>
                                            <h2>3456</h2>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="d-flex">
                                        <span class="bg-color danger-bg"></span>
                                        <div class="text">
                                            <p class="text-sm text-danger">
                                                <span class="text-dark">Visitors</span> -2.05%
                                                <i class="lni lni-arrow-down"></i>
                                            </p>
                                            <h2>3456</h2>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <canvas id="Chart4" style="width: 100%; height: 420px; margin-left: -35px;"></canvas>
                    </div>
                    <!-- End Chart -->
                </div>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->
        <div class="row">
            <div class="col-lg-5">
                <div class="card-style calendar-card mb-30">
                    <div id="calendar-mini"></div>
                </div>
            </div>
            <!-- End Col -->
            <div class="col-lg-7">
                <div class="card-style mb-30">
                    <div class="title d-flex flex-wrap align-items-center justify-content-between">
                        <div class="left">
                            <h6 class="text-medium mb-30">Sales History</h6>
                        </div>
                        <div class="right">
                            <div class="select-style-1">
                                <div class="select-position select-sm">
                                    <select class="light-bg">
                                        <option value="">Today</option>
                                        <option value="">Yesterday</option>
                                    </select>
                                </div>
                            </div>
                            <!-- end select -->
                        </div>
                    </div>
                    <!-- End Title -->
                    <div class="table-responsive">
                        <table class="table top-selling-table">
                            <thead>
                                <tr>
                                    <th>
                                        <h6 class="text-sm text-medium">Products</h6>
                                    </th>
                                    <th class="min-width">
                                        <h6 class="text-sm text-medium">
                                            Category <i class="lni lni-arrows-vertical"></i>
                                        </h6>
                                    </th>
                                    <th class="min-width">
                                        <h6 class="text-sm text-medium">
                                            Revenue <i class="lni lni-arrows-vertical"></i>
                                        </h6>
                                    </th>
                                    <th class="min-width">
                                        <h6 class="text-sm text-medium">
                                            Status <i class="lni lni-arrows-vertical"></i>
                                        </h6>
                                    </th>
                                    <th>
                                        <h6 class="text-sm text-medium text-end">
                                            Actions <i class="lni lni-arrows-vertical"></i>
                                        </h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="product">
                                            <div class="image">
                                                <img src="{{asset('assets/admin/images/products/product-mini-1.jpg')}}" alt="" />
                                            </div>
                                            <p class="text-sm">Bedroom</p>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm">Interior</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">$345</p>
                                    </td>
                                    <td>
                                        <span class="status-btn close-btn">Pending</span>
                                    </td>
                                    <td>
                                        <div class="action justify-content-end">
                                            <button class="edit">
                                                <i class="lni lni-pencil"></i>
                                            </button>
                                            <button class="more-btn ml-10 dropdown-toggle" id="moreAction1"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="lni lni-more-alt"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction1">
                                                <li class="dropdown-item">
                                                    <a href="#0" class="text-gray">Remove</a>
                                                </li>
                                                <li class="dropdown-item">
                                                    <a href="#0" class="text-gray">Edit</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="product">
                                            <div class="image">
                                                <img src="{{asset('assets/admin/images/products/product-mini-2.jpg')}}" alt="" />
                                            </div>
                                            <p class="text-sm">Arm Chair</p>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm">Interior</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">$345</p>
                                    </td>
                                    <td>
                                        <span class="status-btn warning-btn">Refund</span>
                                    </td>
                                    <td>
                                        <div class="action justify-content-end">
                                            <button class="edit">
                                                <i class="lni lni-pencil"></i>
                                            </button>
                                            <button class="more-btn ml-10 dropdown-toggle" id="moreAction1"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="lni lni-more-alt"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction1">
                                                <li class="dropdown-item">
                                                    <a href="#0" class="text-gray">Remove</a>
                                                </li>
                                                <li class="dropdown-item">
                                                    <a href="#0" class="text-gray">Edit</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="product">
                                            <div class="image">
                                                <img src="{{asset('assets/admin/images/products/product-mini-3.jpg')}}" alt="" />
                                            </div>
                                            <p class="text-sm">Sofa</p>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm">Interior</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">$345</p>
                                    </td>
                                    <td>
                                        <span class="status-btn success-btn">Completed</span>
                                    </td>
                                    <td>
                                        <div class="action justify-content-end">
                                            <button class="edit">
                                                <i class="lni lni-pencil"></i>
                                            </button>
                                            <button class="more-btn ml-10 dropdown-toggle" id="moreAction1"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="lni lni-more-alt"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction1">
                                                <li class="dropdown-item">
                                                    <a href="#0" class="text-gray">Remove</a>
                                                </li>
                                                <li class="dropdown-item">
                                                    <a href="#0" class="text-gray">Edit</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="product">
                                            <div class="image">
                                                <img src="{{asset('assets/admin/images/products/product-mini-4.jpg')}}" alt="" />
                                            </div>
                                            <p class="text-sm">Kitchen</p>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm">Interior</p>
                                    </td>
                                    <td>
                                        <p class="text-sm">$345</p>
                                    </td>
                                    <td>
                                        <span class="status-btn close-btn">Canceled</span>
                                    </td>
                                    <td>
                                        <div class="action justify-content-end">
                                            <button class="edit">
                                                <i class="lni lni-pencil"></i>
                                            </button>
                                            <button class="more-btn ml-10 dropdown-toggle" id="moreAction1"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="lni lni-more-alt"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="moreAction1">
                                                <li class="dropdown-item">
                                                    <a href="#0" class="text-gray">Remove</a>
                                                </li>
                                                <li class="dropdown-item">
                                                    <a href="#0" class="text-gray">Edit</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- End Table -->
                    </div>
                </div>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->
    </div>
    <!-- end container -->
</section>
<!-- ========== section end ========== -->
<!-- Thêm div để hiển thị toast notification -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1070">
    <div id="successToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                Xuất file Excel thành công!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<script>
document.getElementById('exportForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    // Lấy modal element
    const modal = document.getElementById('exampleModal');
    
    // Xóa class show và ẩn modal
    modal.classList.remove('show');
    modal.style.display = 'none';
    
    // Xóa backdrop
    const modalBackdrop = document.querySelector('.modal-backdrop');
    if (modalBackdrop) {
        modalBackdrop.remove();
    }
    
    // Xóa class modal-open từ body
    document.body.classList.remove('modal-open');
    document.body.style.paddingRight = '';
    
    // Hiển thị toast notification
    var successToast = new bootstrap.Toast(document.getElementById('successToast'), {
        delay: 3000
    });
    successToast.show();
    
    // Submit form
    setTimeout(() => {
        this.submit();
    }, 100);
});</script>
@endsection