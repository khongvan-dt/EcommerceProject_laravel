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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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

    <style>
   .price-container {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.discounted-price {
    color: #dc2626;
    margin: 0;
}

.original-price {
    color: #6b7280;
    font-size: 0.9em;
    text-decoration: line-through;  
}

.discount-badge {
    background-color: #dc2626;
    color: white;
    padding: 2px 6px;
    border-radius: 4px;
    font-size: 0.8em;
}


  
.rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: center;
    gap: 8px;
}

.rating input {
    display: none;
}

.rating label {
    cursor: pointer;
    color: #ddd;
    transition: color 0.3s ease;
}

.rating input:checked ~ label,
.rating label:hover,
.rating label:hover ~ label {
    color: #ffc107;
}

.rating input:checked + label:hover,
.rating input:checked ~ label:hover,
.rating input:checked ~ label:hover ~ label,
.rating label:hover ~ input:checked ~ label {
    color: #ff9800;
}
</style>

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
