<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8')}}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge')}}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0')}}" />
    <link rel="shortcut icon" href="{{ asset('assets/admin/images/favicon.svg') }}" type="image/x-icon'" />
    <title>Dashboard</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/lineicons.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/materialdesignicons.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/fullcalendar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/fullcalendar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/admin/css/main.css') }}" />
</head>

<body>
    <!-- ======== Preloader =========== -->
    <div id="preloader">
        <div class="spinner"></div>
    </div>
    <!-- ======== Preloader =========== -->

    <!-- ======== sidebar-nav start =========== -->
    <aside class="sidebar-nav-wrapper">
        <div class="navbar-logo">
            <a href="{{ route('admin.dashboard') }}" class="navbar-brand text-primary fw-bold">
                Nahinn Store
            </a>
        </div>
        <nav class="sidebar-nav">
    <ul>
         <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{route('admin.dashboard')}}">
                <span class="icon">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.74999 18.3333C12.2376 18.3333 15.1364 15.8128 15.7244 12.4941C15.8448 11.8143 15.2737 11.25 14.5833 11.25H9.99999C9.30966 11.25 8.74999 10.6903 8.74999 10V5.41666C8.74999 4.7263 8.18563 4.15512 7.50586 4.27556C4.18711 4.86357 1.66666 7.76243 1.66666 11.25C1.66666 15.162 4.83797 18.3333 8.74999 18.3333Z" />
                        <path
                            d="M17.0833 10C17.7737 10 18.3432 9.43708 18.2408 8.75433C17.7005 5.14918 14.8508 2.29947 11.2457 1.75912C10.5629 1.6568 10 2.2263 10 2.91665V9.16666C10 9.62691 10.3731 10 10.8333 10H17.0833Z" />
                    </svg>
                </span>
                <span class="text">Dashboard</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <a href="{{route('admin.categories.index')}}">
                <span class="icon">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="M9 8h10M9 12h10M9 16h10M4.99 8H5m-.02 4h.01m0 4H5" />
                    </svg>
                </span>
                <span class="text">Categories</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('admin.brands.*') ? 'active' : '' }}">
            <a href="{{route('admin.brands.index')}}">
                <span class="icon">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="m17 21-5-4-5 4V3.889a.92.92 0 0 1 .244-.629.808.808 0 0 1 .59-.26h8.333a.81.81 0 0 1 .589.26.92.92 0 0 1 .244.63V21Z" />
                    </svg>
                </span>
                <span class="text">Brands</span>
            </a>
        </li>

        <li class="nav-item nav-item-has-children {{ request()->routeIs('admin.products.*') || request()->routeIs('admin.types.*') ? 'active' : '' }}">
            <a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_2"
                aria-controls="ddmenu_2" aria-expanded="false" aria-label="Toggle navigation">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                    viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linejoin="round" stroke-width="2"
                        d="M10 12v1h4v-1m4 7H6a1 1 0 0 1-1-1V9h14v9a1 1 0 0 1-1 1ZM4 5h16a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Z" />
                </svg>
                <span class="text">Products</span>
            </a>
            <ul id="ddmenu_2" class="collapse dropdown-nav">
                <li>
                    <a href="{{route('admin.products.index')}}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">Products</a>
                </li>
                <li>
                    <a href="{{route('admin.types.index')}}" class="{{ request()->routeIs('admin.types.*') ? 'active' : '' }}">Types</a>
                </li>
            </ul>
        </li>

        <li class="nav-item {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
            <a href="{{route('admin.blogs.index')}}">
                <span class="icon">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 19V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v13H7a2 2 0 0 0-2 2Zm0 0a2 2 0 0 0 2 2h12M9 3v14m7 0v4" />
                    </svg>
                </span>
                <span class="text">Blogs</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <a href="{{route('admin.users.index')}}">
                <span class="icon">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-width="2"
                            d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </span>
                <span class="text">Users</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('admin.discounts.*') ? 'active' : '' }}">
            <a href="{{route('admin.discounts.index')}}">
                <span class="icon">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="M8 7V6a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1M3 18v-7a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                    </svg>
                </span>
                <span class="text">Discounts</span>
            </a>
        </li>

        <li class="nav-item {{ request()->routeIs('admin.vouchers.*') ? 'active' : '' }}">
            <a href="{{route('admin.vouchers.index')}}">
                <span class="icon">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path fill-rule="evenodd"
                            d="M20.29 8.567c.133.323.334.613.59.85v.002a3.536 3.536 0 0 1 0 5.166 2.442 2.442 0 0 0-.776 1.868 3.534 3.534 0 0 1-3.651 3.653 2.483 2.483 0 0 0-1.87.776 3.537 3.537 0 0 1-5.164 0 2.44 2.44 0 0 0-1.87-.776 3.533 3.533 0 0 1-3.653-3.654 2.44 2.44 0 0 0-.775-1.868 3.537 3.537 0 0 1 0-5.166 2.44 2.44 0 0 0 .775-1.87 3.55 3.55 0 0 1 1.033-2.62 3.594 3.594 0 0 1 2.62-1.032 2.401 2.401 0 0 0 1.87-.775 3.535 3.535 0 0 1 5.165 0 2.444 2.444 0 0 0 1.869.775 3.532 3.532 0 0 1 3.652 3.652c-.012.35.051.697.184 1.02ZM9.927 7.371a1 1 0 1 0 0 2h.01a1 1 0 0 0 0-2h-.01Zm5.889 2.226a1 1 0 0 0-1.414-1.415L8.184 14.4a1 1 0 0 0 1.414 1.414l6.218-6.217Zm-2.79 5.028a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01Z"
                            clip-rule="evenodd" />
                    </svg>
                </span>
                <span class="text">Vouchers</span>
            </a>
        </li>

        <li class="nav-item nav-item-has-children {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
            <a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_4"
                aria-controls="ddmenu_4" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 8H5m12 0a1 1 0 0 1 1 1v2.6M17 8l-4-4M5 8a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.6M5 8l4-4 4 4m6 4h-4a2 2 0 1 0 0 4h4a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1Z" />
                    </svg>
                </span>
                <span class="text">Orders</span>
            </a>
            <ul id="ddmenu_4" class="collapse dropdown-nav">
                <li>
                    <a href="{{route('admin.orders.index')}}" class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">Orders</a>
                </li>
            </ul>
        </li>

        <li class="nav-item nav-item-has-children {{ request()->routeIs('admin.reviewBlogs.*') || request()->routeIs('admin.reviewProducts.*') ? 'active' : '' }}">
            <a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ddmenu_55"
                aria-controls="ddmenu_55" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M15.583 8.445h.01M10.86 19.71l-6.573-6.63a.993.993 0 0 1 0-1.4l7.329-7.394A.98.98 0 0 1 12.31 4l5.734.007A1.968 1.968 0 0 1 20 5.983v5.5a.992.992 0 0 1-.316.727l-7.44 7.5a.974.974 0 0 1-1.384.001Z" />
                            </svg>
                </span>
                <span class="text">Reviews</span>
            </a>
            <ul id="ddmenu_55" class="collapse dropdown-nav">
                <li>
                    <a href="{{route('admin.reviewBlogs.index')}}" class="{{ request()->routeIs('admin.reviewBlogs.*') ? 'active' : '' }}">Blogs</a>
                </li>
                <li>
                    <a href="{{route('admin.reviewProducts.index')}}" class="{{ request()->routeIs('admin.reviewProducts.*') ? 'active' : '' }}">Products</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
    
    
    </aside>
    <div class="overlay"></div>

    <main class="main-wrapper">
        @section('layouts.header_admin')
            <header class="header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-10 col-md-10 col-10">
                            <div class="header-left d-flex align-items-center">
                                <div class="menu-toggle-btn mr-15">
                                    <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                                        <i class="lni lni-chevron-left me-2"></i> Menu
                                    </button>
                                </div>
                                <div class="header-search d-none d-md-flex w-100">
                                    <form action="#" class="w-100">
                                        <input type="text" placeholder="Search..." />
                                        <button><i class="lni lni-search-alt"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-2">
                            <div class="header-right">
                                <!-- profile start -->
                                <div class="profile-box ml-15">
                                    <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <div class="profile-info">
                                            <div class="info">
                                                <div class="image">
                                                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" />
                                                </div>
                                                <div>
                                                    <h6 class="fw-500">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</h6>
                                                    <p>{{ Auth::user()->role }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                                        <li>
                                            <div class="author-info flex items-center !p-1">
                                                <div class="image">
                                                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" />
                                                </div>
                                                <div class="content">
                                                    <h4 class="text-sm">{{Auth::user()->firstName}}{{Auth::user()->lastName }}</h4>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="#0">
                                                <i class="lni lni-user"></i> View Profile
                                            </a>
                                        </li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                                @csrf
                                            </form>
                                            <a href="#" onclick="document.getElementById('logout-form').submit();">
                                                <i class="lni lni-exit"></i> Sign Out
                                            </a>
                                        </li>                                        
                                    </ul>
                                </div>
                                <!-- profile end -->
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            @yield('content')

        @section('layouts.footer_admin')
        </main>

        <script src="{{ asset('assets/admin/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/Chart.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/dynamic-pie-chart.js') }}"></script>
        <script src="{{ asset('assets/admin/js/moment.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/fullcalendar.js') }}"></script>
        <script src="{{ asset('assets/admin/js/jvectormap.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/world-merc.js') }}"></script>
        <script src="{{ asset('assets/admin/js/polyfill.js') }}"></script>
        <script src="{{ asset('assets/admin/js/main.js') }}"></script>


        <script>
            // ======== jvectormap activation
            var markers = [{
                    name: "Egypt",
                    coords: [26.8206, 30.8025]
                },
                {
                    name: "Russia",
                    coords: [61.524, 105.3188]
                },
                {
                    name: "Canada",
                    coords: [56.1304, -106.3468]
                },
                {
                    name: "Greenland",
                    coords: [71.7069, -42.6043]
                },
                {
                    name: "Brazil",
                    coords: [-14.235, -51.9253]
                },
            ];

            var jvm = new jsVectorMap({
                map: "world_merc",
                selector: "#map",
                zoomButtons: true,

                regionStyle: {
                    initial: {
                        fill: "#d1d5db",
                    },
                },

                labels: {
                    markers: {
                        render: (marker) => marker.name,
                    },
                },

                markersSelectable: true,
                selectedMarkers: markers.map((marker, index) => {
                    var name = marker.name;

                    if (name === "Russia" || name === "Brazil") {
                        return index;
                    }
                }),
                markers: markers,
                markerStyle: {
                    initial: {
                        fill: "#4A6CF7"
                    },
                    selected: {
                        fill: "#ff5050"
                    },
                },
                markerLabelStyle: {
                    initial: {
                        fontWeight: 400,
                        fontSize: 14,
                    },
                },
            });
            // ====== calendar activation
            document.addEventListener("DOMContentLoaded", function() {
                var calendarMiniEl = document.getElementById("calendar-mini");
                var calendarMini = new FullCalendar.Calendar(calendarMiniEl, {
                    initialView: "dayGridMonth",
                    headerToolbar: {
                        end: "today prev,next",
                    },
                });
                calendarMini.render();
            });

            // =========== chart one start
            const ctx1 = document.getElementById("Chart1").getContext("2d");
            const chart1 = new Chart(ctx1, {
                type: "line",
                data: {
                    labels: [
                        "Jan",
                        "Fab",
                        "Mar",
                        "Apr",
                        "May",
                        "Jun",
                        "Jul",
                        "Aug",
                        "Sep",
                        "Oct",
                        "Nov",
                        "Dec",
                    ],
                    datasets: [{
                        label: "",
                        backgroundColor: "transparent",
                        borderColor: "#365CF5",
                        data: [
                            600, 800, 750, 880, 940, 880, 900, 770, 920, 890, 976, 1100,
                        ],
                        pointBackgroundColor: "transparent",
                        pointHoverBackgroundColor: "#365CF5",
                        pointBorderColor: "transparent",
                        pointHoverBorderColor: "#fff",
                        pointHoverBorderWidth: 5,
                        borderWidth: 5,
                        pointRadius: 8,
                        pointHoverRadius: 8,
                        cubicInterpolationMode: "monotone", // Add this line for curved line
                    }, ],
                },
                options: {
                    plugins: {
                        tooltip: {
                            callbacks: {
                                labelColor: function(context) {
                                    return {
                                        backgroundColor: "#ffffff",
                                        color: "#171717"
                                    };
                                },
                            },
                            intersect: false,
                            backgroundColor: "#f9f9f9",
                            title: {
                                fontFamily: "Plus Jakarta Sans",
                                color: "#8F92A1",
                                fontSize: 12,
                            },
                            body: {
                                fontFamily: "Plus Jakarta Sans",
                                color: "#171717",
                                fontStyle: "bold",
                                fontSize: 16,
                            },
                            multiKeyBackground: "transparent",
                            displayColors: false,
                            padding: {
                                x: 30,
                                y: 10,
                            },
                            bodyAlign: "center",
                            titleAlign: "center",
                            titleColor: "#8F92A1",
                            bodyColor: "#171717",
                            bodyFont: {
                                family: "Plus Jakarta Sans",
                                size: "16",
                                weight: "bold",
                            },
                        },
                        legend: {
                            display: false,
                        },
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    title: {
                        display: false,
                    },
                    scales: {
                        y: {
                            grid: {
                                display: false,
                                drawTicks: false,
                                drawBorder: false,
                            },
                            ticks: {
                                padding: 35,
                                max: 1200,
                                min: 500,
                            },
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                color: "rgba(143, 146, 161, .1)",
                                zeroLineColor: "rgba(143, 146, 161, .1)",
                            },
                            ticks: {
                                padding: 20,
                            },
                        },
                    },
                },
            });
            // =========== chart one end

            // =========== chart two start
            const ctx2 = document.getElementById("Chart2").getContext("2d");
            const chart2 = new Chart(ctx2, {
                type: "bar",
                data: {
                    labels: [
                        "Jan",
                        "Fab",
                        "Mar",
                        "Apr",
                        "May",
                        "Jun",
                        "Jul",
                        "Aug",
                        "Sep",
                        "Oct",
                        "Nov",
                        "Dec",
                    ],
                    datasets: [{
                        label: "",
                        backgroundColor: "#365CF5",
                        borderRadius: 30,
                        barThickness: 6,
                        maxBarThickness: 8,
                        data: [
                            600, 700, 1000, 700, 650, 800, 690, 740, 720, 1120, 876, 900,
                        ],
                    }, ],
                },
                options: {
                    plugins: {
                        tooltip: {
                            callbacks: {
                                titleColor: function(context) {
                                    return "#8F92A1";
                                },
                                label: function(context) {
                                    let label = context.dataset.label || "";

                                    if (label) {
                                        label += ": ";
                                    }
                                    label += context.parsed.y;
                                    return label;
                                },
                            },
                            backgroundColor: "#F3F6F8",
                            titleAlign: "center",
                            bodyAlign: "center",
                            titleFont: {
                                size: 12,
                                weight: "bold",
                                color: "#8F92A1",
                            },
                            bodyFont: {
                                size: 16,
                                weight: "bold",
                                color: "#171717",
                            },
                            displayColors: false,
                            padding: {
                                x: 30,
                                y: 10,
                            },
                        },
                    },
                    legend: {
                        display: false,
                    },
                    legend: {
                        display: false,
                    },
                    layout: {
                        padding: {
                            top: 15,
                            right: 15,
                            bottom: 15,
                            left: 15,
                        },
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            grid: {
                                display: false,
                                drawTicks: false,
                                drawBorder: false,
                            },
                            ticks: {
                                padding: 35,
                                max: 1200,
                                min: 0,
                            },
                        },
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false,
                                color: "rgba(143, 146, 161, .1)",
                                drawTicks: false,
                                zeroLineColor: "rgba(143, 146, 161, .1)",
                            },
                            ticks: {
                                padding: 20,
                            },
                        },
                    },
                    plugins: {
                        legend: {
                            display: false,
                        },
                        title: {
                            display: false,
                        },
                    },
                },
            });
            // =========== chart two end

            // =========== chart three start
            const ctx3 = document.getElementById("Chart3").getContext("2d");
            const chart3 = new Chart(ctx3, {
                type: "line",
                data: {
                    labels: [
                        "Jan",
                        "Feb",
                        "Mar",
                        "Apr",
                        "May",
                        "Jun",
                        "Jul",
                        "Aug",
                        "Sep",
                        "Oct",
                        "Nov",
                        "Dec",
                    ],
                    datasets: [{
                            label: "Revenue",
                            backgroundColor: "transparent",
                            borderColor: "#365CF5",
                            data: [80, 120, 110, 100, 130, 150, 115, 145, 140, 130, 160, 210],
                            pointBackgroundColor: "transparent",
                            pointHoverBackgroundColor: "#365CF5",
                            pointBorderColor: "transparent",
                            pointHoverBorderColor: "#365CF5",
                            pointHoverBorderWidth: 3,
                            pointBorderWidth: 5,
                            pointRadius: 5,
                            pointHoverRadius: 8,
                            fill: false,
                            tension: 0.4,
                        },
                        {
                            label: "Profit",
                            backgroundColor: "transparent",
                            borderColor: "#9b51e0",
                            data: [
                                120, 160, 150, 140, 165, 210, 135, 155, 170, 140, 130, 200,
                            ],
                            pointBackgroundColor: "transparent",
                            pointHoverBackgroundColor: "#9b51e0",
                            pointBorderColor: "transparent",
                            pointHoverBorderColor: "#9b51e0",
                            pointHoverBorderWidth: 3,
                            pointBorderWidth: 5,
                            pointRadius: 5,
                            pointHoverRadius: 8,
                            fill: false,
                            tension: 0.4,
                        },
                        {
                            label: "Order",
                            backgroundColor: "transparent",
                            borderColor: "#f2994a",
                            data: [180, 110, 140, 135, 100, 90, 145, 115, 100, 110, 115, 150],
                            pointBackgroundColor: "transparent",
                            pointHoverBackgroundColor: "#f2994a",
                            pointBorderColor: "transparent",
                            pointHoverBorderColor: "#f2994a",
                            pointHoverBorderWidth: 3,
                            pointBorderWidth: 5,
                            pointRadius: 5,
                            pointHoverRadius: 8,
                            fill: false,
                            tension: 0.4,
                        },
                    ],
                },
                options: {
                    plugins: {
                        tooltip: {
                            intersect: false,
                            backgroundColor: "#fbfbfb",
                            titleColor: "#8F92A1",
                            bodyColor: "#272727",
                            titleFont: {
                                size: 16,
                                family: "Plus Jakarta Sans",
                                weight: "400",
                            },
                            bodyFont: {
                                family: "Plus Jakarta Sans",
                                size: 16,
                            },
                            multiKeyBackground: "transparent",
                            displayColors: false,
                            padding: {
                                x: 30,
                                y: 15,
                            },
                            borderColor: "rgba(143, 146, 161, .1)",
                            borderWidth: 1,
                            enabled: true,
                        },
                        title: {
                            display: false,
                        },
                        legend: {
                            display: false,
                        },
                    },
                    layout: {
                        padding: {
                            top: 0,
                        },
                    },
                    responsive: true,
                    // maintainAspectRatio: false,
                    legend: {
                        display: false,
                    },
                    scales: {
                        y: {
                            grid: {
                                display: false,
                                drawTicks: false,
                                drawBorder: false,
                            },
                            ticks: {
                                padding: 35,
                            },
                            max: 350,
                            min: 50,
                        },
                        x: {
                            grid: {
                                drawBorder: false,
                                color: "rgba(143, 146, 161, .1)",
                                drawTicks: false,
                                zeroLineColor: "rgba(143, 146, 161, .1)",
                            },
                            ticks: {
                                padding: 20,
                            },
                        },
                    },
                },
            });
            // =========== chart three end

            // ================== chart four start
            const ctx4 = document.getElementById("Chart4").getContext("2d");
            const chart4 = new Chart(ctx4, {
                type: "bar",
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"],
                    datasets: [{
                            label: "",
                            backgroundColor: "#365CF5",
                            borderColor: "transparent",
                            borderRadius: 20,
                            borderWidth: 5,
                            barThickness: 20,
                            maxBarThickness: 20,
                            data: [600, 700, 1000, 700, 650, 800],
                        },
                        {
                            label: "",
                            backgroundColor: "#d50100",
                            borderColor: "transparent",
                            borderRadius: 20,
                            borderWidth: 5,
                            barThickness: 20,
                            maxBarThickness: 20,
                            data: [690, 740, 720, 1120, 876, 900],
                        },
                    ],
                },
                options: {
                    plugins: {
                        tooltip: {
                            backgroundColor: "#F3F6F8",
                            titleColor: "#8F92A1",
                            titleFontSize: 12,
                            bodyColor: "#171717",
                            bodyFont: {
                                weight: "bold",
                                size: 16,
                            },
                            multiKeyBackground: "transparent",
                            displayColors: false,
                            padding: {
                                x: 30,
                                y: 10,
                            },
                            bodyAlign: "center",
                            titleAlign: "center",
                            enabled: true,
                        },
                        legend: {
                            display: false,
                        },
                    },
                    layout: {
                        padding: {
                            top: 0,
                        },
                    },
                    responsive: true,
                    // maintainAspectRatio: false,
                    title: {
                        display: false,
                    },
                    scales: {
                        y: {
                            grid: {
                                display: false,
                                drawTicks: false,
                                drawBorder: false,
                            },
                            ticks: {
                                padding: 35,
                                max: 1200,
                                min: 0,
                            },
                        },
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false,
                                color: "rgba(143, 146, 161, .1)",
                                zeroLineColor: "rgba(143, 146, 161, .1)",
                            },
                            ticks: {
                                padding: 20,
                            },
                        },
                    },
                },
            });
            // =========== chart four end
        </script>
    </body>

    </html>
