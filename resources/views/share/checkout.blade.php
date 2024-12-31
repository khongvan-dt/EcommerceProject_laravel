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
                            <span>Check Out</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            @if ($errors->has('error'))
                                <div class="alert alert-danger">
                                    <strong>{{ $errors->first('error') }}</strong>
                                    @if ($errors->has('exception'))
                                        <p>{{ $errors->first('exception') }}</p>
                                    @endif
                                </div>
                            @endif

                            <h6 class="coupon__code"><span class="icon_tag_alt"></span> Have a coupon? <a
                                    href="#">Click
                                    here</a> to enter your code</h6>
                            <h6 class="checkout__title">Billing Details</h6>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>First Name<span>*</span></p>
                                        <input type="text" name="firstName"
                                            value="{{ Auth::user() && Auth::user()->firstName ? Auth::user()->firstName : '' }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" name="lastName"
                                            value="{{ Auth::user() && Auth::user()->lastName ? Auth::user()->lastName : '' }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" placeholder="Address" class="checkout__input__add" name="address"
                                    value="{{ Auth::user() && Auth::user()->address ? Auth::user()->address : '' }}" required>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="number" name="phone" 
                                            value="{{ Auth::user() && Auth::user()->phone ? Auth::user()->phone : '' }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="email" name="email"
                                            value="{{ Auth::user() && Auth::user()->email ? Auth::user()->email : '' }}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="acc">
                                    Create an account?
                                    <input type="checkbox" id="acc" name="checkRegister"
                                        {{ old('checkRegister') ? 'checked' : '' }}>
                                    <span class="checkmark"></span>
                                </label>
                                <p>Create an account by entering the information below. If you are a returning customer
                                    please login at the top of the page</p>
                            </div>
                            <div class="checkout__input" id="password-field" style="display: none;">
                                <p>Account Password<span>*</span></p>
                                <input type="password" name="password">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Your order</h4>
                                <div class="checkout__order__products">Product <span>Total</span></div>
                                <ul class="checkout__total__products">
                                    @foreach ($cartIndex as $item)
                                        <li>{{ $loop->iteration }}. {{ $item['product']->name }}
                                            <span>{{ number_format($item['price'] * $item['quantity'] * 1000, 0, ',', '.') }}đ</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <ul class="checkout__total__all">
                                    <li>Subtotal <span>{{ number_format($subTotal * 1000, 0, ',', '.') }}đ</span></li>
                                    <li>Total <span>{{ number_format($subTotal * 1000, 0, ',', '.') }}đ</span></li>
                                </ul>
                                <div class="checkout__input__checkbox">
                                    <label for="payMoney">
                                        PayMoney
                                        <input type="radio" id="payMoney" name="payment_method" value="paymoney" required>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label for="vnpay">
                                        VNPay
                                        <input type="radio" id="vnpay" name="payment_method" value="VNPay" required>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                                <input type="hidden" name="totalPrice" value="{{$subTotal}}">
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

    <script>
        document.getElementById('acc').addEventListener('change', function() {
            document.getElementById('password-field').style.display = this.checked ? 'block' : 'none';
        });
    </script>
@endsection
