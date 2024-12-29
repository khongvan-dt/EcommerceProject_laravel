@extends('layouts.share')

@section('content')
    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="{{ route('dashboard') }}">Home</a>
                            <a href="{{ route('shop') }}">Shop</a>
                            <span>Product Details</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <ul class="nav nav-tabs" role="tablist">
                            @foreach ($product->media as $media)
                                @if ($media->mainImage == 0)
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
                                            <div class="product__thumb__pic set-bg"
                                                data-setbg="{{ asset('storage/' . $media->mediaUrl) }}">
                                            </div>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="{{ asset('storage/' . $product->media->first()->mediaUrl) }}"
                                        alt="{{ $product->name }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <h4>{{ $product->name }}</h4>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <span> - 5 Reviews</span>
                            </div>
                            <h3 id="product-price">
                                {{ number_format($product->attributeValues->first()->priceOut * 1000, 0, ',', '.') }}đ</h3>
                            <!-- Giá mặc định ban đầu -->
                            <div class="product__details__option">
                                @foreach ($product->attributes as $attribute)
                                    @if ($attribute->name == 'Size')
                                        <div class="product__details__option__size">
                                            <span>Size:</span>
                                            @foreach ($product->attributeValues as $av)
                                                @if ($av->attributeId == $attribute->id)
                                                    <label for="size-{{ $av->id }}">{{ $av->name }}
                                                        <input type="radio" id="size-{{ $av->id }}" name="size"
                                                            class="size-option" value="{{ $av->id }}"
                                                            data-price="{{ $av->priceOut }}"
                                                            data-stock="{{ $av->stock }}">
                                                    </label>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif

                                    @if ($attribute->name == 'Color')
                                        <div class="product__details__option__color">
                                            <span>Color:</span>
                                            @foreach ($product->attributeValues as $av)
                                                @if ($av->attributeId == $attribute->id)
                                                    @php
                                                        $colorClass = in_array($av->name, [
                                                            'Red',
                                                            'Blue',
                                                            'Green',
                                                            'Yellow',
                                                            'Black',
                                                            'White',
                                                            'Purple',
                                                            'Pink',
                                                            'Orange',
                                                            'Brown',
                                                        ])
                                                            ? $av->name
                                                            : 'default-color';
                                                    @endphp
                                                    <label class="color" for="color"
                                                        style="background-color: {{ $colorClass }};">
                                                        <input type="radio" id="color" name="color"
                                                            class="color-option" value="{{ $av->id }}"
                                                            data-price="{{ $av->priceOut }}"
                                                            data-stock="{{ $av->stock }}">
                                                    </label>
                                                @endif
                                            @endforeach
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <div class="product__details__cart__option">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1" id="product-quantity">
                                    </div>
                                </div>
                                <input type="hidden" id="product-id" value="{{ $product->id }}">
                                <input type="hidden" id="selected-size-id" value="">
                                <input type="hidden" id="selected-color-id" value="">
                                <button class="primary-btn" id="add-to-cart">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                                        role="tab">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Customer
                                        Previews(5)</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <p>{{ $product->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->

    <!-- Related Section Begin -->
    <section class="related spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Related Product</h3>
                </div>
            </div>
            <div class="row">
                @foreach ($relatedProducts as $rproduct)
                    <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg"
                                data-setbg="{{ asset('storage/' . $rproduct->media->mediaUrl) }}">
                            </div>
                            <div class="product__item__text">
                                <h6>{{ $rproduct->name }}</h6>
                                <a href="#" class="add-cart">+ Add To Cart</a>
                                <div class="rating">
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related Section End -->
    <script>
        document.querySelectorAll('.size-option, .color-option').forEach(input => {
            input.addEventListener('change', function() {
                console.log('Changed:', this);
                updatePrice();
            });
        });

        document.getElementById('add-to-cart').addEventListener('click', function(event) {
            event.preventDefault();

            const quantity = document.getElementById('product-quantity').value;
            const productId = document.getElementById('product-id').value;

            const selectedSize = document.querySelector('input[name="size"]:checked');
            const selectedColor = document.querySelector('input[name="color"]:checked');

            if (!selectedSize || !selectedColor) {
                alert('Please select size and color');
                return;
            }

            const stock_size = parseInt(selectedSize.getAttribute('data-stock'));
            const stock_color = parseInt(selectedColor.getAttribute('data-stock'));

            if (stock_size < quantity || stock_color < quantity) {
                alert('Not enough stock');
                return;
            }

            const cartData = {
                productId: productId,
                sizeId: selectedSize.value,
                colorId: selectedColor.value,
                quantity: quantity
            };

            fetch('/add-to-cart', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify(cartData)
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    window.location.href = '/cart'; 
                })
                .catch(error => console.error('Error:', error));
        });


        function updatePrice() {
            const selectedSize = document.querySelector('input[name="size"]:checked');
            const selectedColor = document.querySelector('input[name="color"]:checked');

            console.log('Selected Size:', selectedSize);
            console.log('Selected Color:', selectedColor);

            let sizePrice = 0;
            let colorPrice = 0;
            if (selectedSize) {
                sizePrice = parseFloat(selectedSize.getAttribute('data-price'));
            }

            if (selectedColor) {
                colorPrice = parseFloat(selectedColor.getAttribute('data-price'));
            }

            if (sizePrice > 0 && colorPrice > 0) {
                const finalPrice = (sizePrice + colorPrice) / 2;
                console.log('Final Price:', finalPrice);

                document.getElementById('product-price').innerText = new Intl.NumberFormat().format(finalPrice * 1000) +
                    'đ';
            }
        }
    </script>
@endsection
