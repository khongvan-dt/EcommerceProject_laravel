@extends('layouts.share')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shop</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('dashboard') }}">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__search">
                            <form action="{{ route('shop') }}" method="GET">
                                <input type="text" name="search" placeholder="Search..."
                                    value="{{ request('search') }}">
                                <button type="submit"><span class="icon_search"></span></button>
                            </form>
                        </div>

                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Categories</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll">
                                                    @foreach ($categories as $category)
                                                        <li>
                                                            <a href="{{ route('shop', ['category' => $category->id]) }}">
                                                                {{ $category->name }} ({{ $category->products_count }})
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseTwo">Branding</a>
                                    </div>
                                    <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__brand">
                                                <ul>
                                                    @foreach ($brands as $brand)
                                                        <li>
                                                            <a href="{{ route('shop', ['brand' => $brand->id]) }}">
                                                                {{ $brand->name }} ({{ $brand->products_count }})
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                                    </div>
                                    <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__price">
                                                <ul>
                                                    <li><a href="{{ route('shop', ['price_range' => '0-200000']) }}">0đ -
                                                            200,000đ</a></li>
                                                    <li><a href="{{ route('shop', ['price_range' => '200000-400000']) }}">200,000đ
                                                            - 400,000đ</a></li>
                                                    <li><a href="{{ route('shop', ['price_range' => '400000-600000']) }}">400,000đ
                                                            - 600,000đ</a></li>
                                                    <li><a href="{{ route('shop', ['price_range' => '600000-800000']) }}">600,000đ
                                                            - 800,000đ</a></li>
                                                    <li><a
                                                            href="{{ route('shop', ['price_range' => '800000+']) }}">800,000đ+</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseFour">Size</a>
                                    </div>
                                    <div id="collapseFour" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__size">
                                                @foreach (['xs', 's', 'm', 'xl', '2xl', 'xxl', '3xl', '4xl'] as $size)
                                                    <label for="{{ $size }}">{{ $size }}
                                                        <input type="radio" name="size" value="{{ $size }}"
                                                            id="{{ $size }}"
                                                            {{ request('size') == $size ? 'checked' : '' }}>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseFive">Colors</a>
                                    </div>
                                    <div id="collapseFive" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__color">
                                                @foreach (['red', 'blue', 'green', 'yellow', 'black', 'white', 'purple', 'pink', 'orange', 'brown'] as $color)
                                                    <label class="c-{{ $loop->index + 1 }}"
                                                        for="color-{{ $color }}">
                                                        <input type="radio" name="color" value="{{ $color }}"
                                                            id="color-{{ $color }}"
                                                            {{ request('color') == $color ? 'checked' : '' }}>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__left">
                                    <p>Showing
                                        {{ ($products->currentPage() - 1) * $products->perPage() + 1 }}–{{ ($products->currentPage() - 1) * $products->perPage() + $products->count() }}
                                        of {{ $total_products }} results</p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__right">
                                    <p>Sort by Price:</p>
                                    <select id="sortPrice">
                                        <option value="low-to-high"
                                            {{ request('sort') == 'low-to-high' ? 'selected' : '' }}>Low To High</option>
                                        <option value="high-to-low"
                                            {{ request('sort') == 'high-to-low' ? 'selected' : '' }}>High To Low</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item__pic set-bg">
                                    <a href="{{ route('product', ['id' => $product->id]) }}">
                                        <img class="product__item__pic set-bg"
                                            src="{{ asset('storage/' . $product->media->first()->mediaUrl) }}"
                                            alt="{{ $product->name }}">
                                    </a>
                                </div>
                                <div class="product__item__text">
                                    <h6>{{ $product->name }}</h6>
                                    <a href="#" class="add-cart">+ Add To Cart</a>
                                    @if ($product->attributeValues->isNotEmpty())
                                        <h5>{{ number_format($product->attributeValues->first()->priceOut * 1000, 0, ',', '.') }}
                                            đ</h5>
                                    @else
                                        <h5>Giá chưa có</h5>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->
    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
@endsection
