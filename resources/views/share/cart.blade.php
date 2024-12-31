@extends('layouts.share')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('dashboard') }}">Home</a>
                            <a href="{{ route('shop') }}">Shop</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <form id="cartForm" method="POST" action="{{ route('cart.update') }}">
                            @csrf
                            @method('PUT')
                            <table>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Color</th>
                                        <th>Size</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @if (count($cartIndex) > 0)
                                        @foreach ($cartIndex as $item)
                                            <tr>
                                                <td class="product__cart__item">
                                                    <div class="product__cart__item__pic">
                                                        <img src="{{ asset('storage/' . $item['product']->media->first()->mediaUrl) }}"
                                                            alt="{{ $item['product']->name }}" width="50px">
                                                    </div>
                                                    <div class="product__cart__item__text">
                                                        <h6>{{ $item['product']->name }}</h6>
                                                    </div>
                                                </td>
                                                <td class="cart__color">{{ $item['color']->name }}</td>
                                                <td class="cart__size">{{ $item['size']->name }}</td>
                                                <td class="quantity__item">
                                                    <div class="quantity">
                                                        <div class="pro-qty-2">
                                                            <input type="number" id="quantity"
                                                                name="quantities[{{ $item['product']->id }}]"
                                                                value="{{ $item['quantity'] }}" min="1"
                                                                id="quantity-{{ $item['product']->id }}"
                                                                class="cart-quantity" data-price="{{ $item['price'] }}"
                                                                data-id="{{ $item['product']->id }}">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="cart__price">
                                                    {{ number_format($item['price'] * $item['quantity'] * 1000, 0, ',', '.') }}đ
                                                </td>
                                                <td class="cart__close">
                                                    <a class="delete__product" data-id="{{ $item['product']->id }}"
                                                        data-url="{{ route('cart.delete', $item['product']->id) }}"
                                                        data-sizeId="{{ $item['size']->id }}"
                                                        data-colorId="{{ $item['color']->id }}">
                                                        <i class="fa fa-close"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </form>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success mt-4">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="{{route('shop')}}">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="continue__btn update__btn">
                            <a href="javascript:void(0);" class="update__btn" id="updateCartBtn"><i
                                    class="fa fa-spinner"></i> Update cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                <div class="cart__discount">
                    <h6>Vouchers codes</h6>
                    @if(session('voucher_data'))
                        <div class="alert alert-success">
                            Voucher {{ session('voucher_data')['code'] }} applied successfully
                        </div>
                    @else
                        <form id="voucherForm">
                            @csrf
                            <input type="text" name="voucher_code" id="voucherCode" placeholder="Enter voucher code">
                            <button type="submit" id="applyVoucherBtn">Apply</button>
                        </form>
                    @endif
                    <div id="voucherMessage"></div>
                </div>

                <div class="cart__total">
                    <h6>Cart total</h6>
                    <ul>
                        @if(isset($subTotal) && $subTotal > 0)
                            <li>Subtotal <span id="subtotal">{{ number_format($subTotal * 1000, 0, ',', '.') }}đ</span></li>
                            @if(isset($voucherDiscount) && $voucherDiscount > 0)
                                <li>Voucher discount <span id="voucher-discount">-{{ number_format($voucherDiscount * 1000, 0, ',', '.') }}đ</span></li>
                            @endif
                            <li>Total <span id="grand-total">{{ number_format($grandTotal * 1000, 0, ',', '.') }}đ</span></li>
                        @else
                            <li>No products in the cart</li>
                        @endif
                    </ul>
                    @if(isset($subTotal) && $subTotal > 0)
                        <a href="{{ route('checkout') }}" class="primary-btn">Proceed to checkout</a>
                    @endif
                </div>


                </div>
            </div>
        </div>
    </section>
   
    <script>
              $(document).ready(function() {
            $('#voucherForm').on('submit', function(e) {
                e.preventDefault();
                
                var voucherCode = $('#voucherCode').val();
                if (!voucherCode) {
                    $('#voucherMessage').html('<div class="alert alert-danger">Please enter voucher code</div>');
                    return;
                }

                $('#applyVoucherBtn').prop('disabled', true);
                $('#voucherCode').prop('disabled', true);

                $.ajax({
                    url: '{{ route("cart.apply-voucher") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        voucher_code: voucherCode
                    },
                    success: function(response) {
                        if (response.success) {
                            window.location.reload();
                        } else {
                            $('#voucherMessage').html('<div class="alert alert-danger">' + response.message + '</div>');
                            $('#voucherCode').prop('disabled', false);
                            $('#applyVoucherBtn').prop('disabled', false);
                        }
                    },
                    error: function() {
                        $('#voucherMessage').html('<div class="alert alert-danger">Error applying voucher</div>');
                        $('#voucherCode').prop('disabled', false);
                        $('#applyVoucherBtn').prop('disabled', false);
                    }
                });
            });
        });

        document.getElementById('updateCartBtn').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('cartForm').submit();
        });

        document.querySelectorAll('.delete__product').forEach(function(deleteBtn) {
            deleteBtn.addEventListener('click', function(event) {
                event.preventDefault();
                var productId = this.getAttribute('data-id');
                var sizeId = this.getAttribute('data-sizeId');
                var colorId = this.getAttribute('data-colorId');
                var url = this.getAttribute('data-url');

                if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?")) {
                    var form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;
                    form.style.display = 'none';

                    var csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = '{{ csrf_token() }}';
                    form.appendChild(csrfToken);

                    var methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';
                    form.appendChild(methodField);

                    var productIdField = document.createElement('input');
                    productIdField.type = 'hidden';
                    productIdField.name = 'productId';
                    productIdField.value = productId;
                    form.appendChild(productIdField);

                    var sizeIdField = document.createElement('input');
                    sizeIdField.type = 'hidden';
                    sizeIdField.name = 'sizeId';
                    sizeIdField.value = sizeId;
                    form.appendChild(sizeIdField);

                    var colorIdField = document.createElement('input');
                    colorIdField.type = 'hidden';
                    colorIdField.name = 'colorId';
                    colorIdField.value = colorId;
                    form.appendChild(colorIdField);


                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    </script>
@endsection
