<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title')
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css') }}" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>

    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    <link rel="stylesheet" href="{{ asset('fontend/css/bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('fontend/css/cumtom.css') }}">

    {{-- Owl Carousel --}}
    <link rel="stylesheet" href="{{ asset('fontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fontend/css/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">

    {{-- Font awesome --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Damion&family=Roboto&display=swap" rel="stylesheet">


    <style>
        a {
            text-decoration: none !important;
        }
    </style>
</head>

<body class="g-sidenav-show  bg-gray-200">

    @include('layouts.inc.frontnavbar')
    <div class="content">
        @yield('content')
    </div>

    <script src="{{ asset('fontend/js/bootstrap.bundle.js') }}"></script>

    <script src="{{ asset('fontend/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('fontend/js/owl.carousel.min.js') }}"></script>

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/material-dashboard.min.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ asset('fontend/js/custom.js') }}"></script>
    <script src="{{ asset('fontend/js/checkout.js') }}"></script>

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script>
        var availableTags = [];
        $.ajax({
            method: "GET",
            url: "/product-list",
            success: function(response) {
                //console.log(response);
                startAutocomplete(availableTags);
            }
        });

        function startAutocomplete(availableTags) {

            $("#search_product").autocomplete({
                source: availableTags
            });
        }
        </script>

    @if (session('status'))
        <script>
            swal("{{ session('status') }}");
        </script>
    @endif
    @yield('scripts')
</body>

</html>
