<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nahinn Store</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('assets/share/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/share/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/share/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/share/css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/share/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/share/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/share/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/share/css/style.css') }}" type="text/css">

</head>

<body>

    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>


    @include('layouts.header_share')

        @yield('content')

    @include('layouts.footer_share')

        <!-- Search Begin -->
        <div class="search-model">
            <div class="h-100 d-flex align-items-center justify-content-center">
                <div class="search-close-switch">+</div>
                <form class="search-model-form">
                    <input type="text" id="search-input" placeholder="Search here.....">
                </form>
            </div>
        </div>
        <!-- Search End -->

        <!-- JS Implementations -->
        <script src="{{ asset('assets/share/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('assets/share/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/share/js/jquery.nice-select.min.js') }}"></script>
        <script src="{{ asset('assets/share/js/jquery.nicescroll.min.js') }}"></script>
        <script src="{{ asset('assets/share/js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('assets/share/js/jquery.countdown.min.js') }}"></script>
        <script src="{{ asset('assets/share/js/jquery.slicknav.js') }}"></script>
        <script src="{{ asset('assets/share/js/mixitup.min.js') }}"></script>
        <script src="{{ asset('assets/share/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('assets/share/js/main.js') }}"></script>
    </body>

    </html>
