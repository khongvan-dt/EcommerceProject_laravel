<!-- Header Section Begin -->
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-1 col-md-1">
                <div class="header__logo">
                    <a href="{{ route('dashboard') }}" class="navbar-brand text-dark fw-bold" style="font-weight: bold;">
                        Nahinn Store
                    </a>
                </div>
            </div>
            
            <div class="col-lg-10 col-md-10">
                <!-- <nav class="header__menu mobile-menu">
                    <ul>
                        <li class="active"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li><a href="{{ route('shop') }}">Shop</a></li>
                        <li><a href="#">Pages</a>
                            <ul class="dropdown">
                                <li><a href="{{route('about')}}">About Us</a></li>
                                <li><a href="{{route('shop')}}}">Shop Details</a></li>
                                <li><a href="{{route('cart')}}">Shopping Cart</a></li>
                                <li><a href="{{route('viewOrder')}}">Check Out</a></li>
                            </ul>
                        </li>
                        <li><a href="{{route('blog')}}">Blog</a></li>
                        <li><a href="{{route('contact')}}">Contacts</a></li>
                        @if (Auth::check())
                            <li class="dropdown">
                                <a href="#">My Account</a>
                                <ul class="dropdown">
                                    <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <li><a href="#" id="logoutLink">Logout</a></li>
                                    </form>
                                    <li><a href="">Edit Profile</a></li>
                                    <li><a href="{{ route('viewOrder') }}">My Orders</a></li>
                                </ul>
                            </li>
                        @else
                            <li><a href="{{ route('login') }}">SignIn</a></li>
                            <li><a href="{{ route('register') }}">SignUp</a></li>
                        @endif
                    </ul>
                </nav> -->
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}">Home</a>
                        </li>
                        <li class="{{ Request::routeIs('shop') ? 'active' : '' }}">
                            <a href="{{ route('shop') }}">Shop</a>
                        </li>
                        <li class="{{ Request::routeIs('about') || Request::routeIs('cart') || Request::routeIs('viewOrder') ? 'active' : '' }}">
                            <a href="#">Pages</a>
                            <ul class="dropdown">
                                <li class="{{ Request::routeIs('about') ? 'active' : '' }}">
                                    <a href="{{route('about')}}">About Us</a>
                                </li>
                                <li class="{{ Request::routeIs('shop') ? 'active' : '' }}">
                                    <a href="{{route('shop')}}">Shop Details</a>
                                </li>
                                <li class="{{ Request::routeIs('cart') ? 'active' : '' }}">
                                    <a href="{{route('cart')}}">Shopping Cart</a>
                                </li>
                                <li class="{{ Request::routeIs('viewOrder') ? 'active' : '' }}">
                                    <a href="{{route('viewOrder')}}">Check Out</a>
                                </li>
                            </ul>
                        </li>
                        <li class="{{ Request::routeIs('blog') ? 'active' : '' }}">
                            <a href="{{route('blog')}}">Blog</a>
                        </li>
                        <li class="{{ Request::routeIs('contact') ? 'active' : '' }}">
                            <a href="{{route('contact')}}">Contacts</a>
                        </li>
                        @if (Auth::check())
                            <li class="dropdown {{ Request::routeIs('viewOrder') ? 'active' : '' }}">
                                <a href="#">My Account</a>
                                <ul class="dropdown">
                                    <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <li><a href="#" id="logoutLink">Logout</a></li>
                                    </form>
                                    <li><a href="">Edit Profile</a></li>
                                    <li class="{{ Request::routeIs('viewOrder') ? 'active' : '' }}">
                                        <a href="{{ route('viewOrder') }}">My Orders</a>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="{{ Request::routeIs('login') ? 'active' : '' }}">
                                <a href="{{ route('login') }}">SignIn</a>
                            </li>
                            <li class="{{ Request::routeIs('register') ? 'active' : '' }}">
                                <a href="{{ route('register') }}">SignUp</a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
            <div class="col-lg-1 col-md-1">
                <div class="header__nav__option">
                    <a href="{{ route('cart') }}"><img src="{{ asset('assets/share/img/icon/cart.png') }}"
                            alt=""> <span>0</span></a>
                </div>
            </div>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>
<!-- Header Section End -->
<script>
    document.getElementById('logoutLink').addEventListener('click', function (e) {
        e.preventDefault(); // Ngăn chặn hành vi mặc định của liên kết
        document.getElementById('logoutForm').submit(); // Gửi form
    });
</script>