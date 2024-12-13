<!DOCTYPE html>
<html lang="en">

<head>
    <title>Pharma &mdash; Colorlib Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,700|Crimson+Text:400,400i" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets2/fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets2/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets2/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets2/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('assets2/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets2/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets2/css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('assets2/css/style.css') }}">

</head>

<body>
    <div class="site-wrap">
        @include('home.layout.navbar')
        @yield('konten')
        @include('home.layout.footer')
    </div>

    @yield('script')
    <script src="{{ asset('assets2/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('assets2/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('assets2/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets2/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets2/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets2/js/aos.js') }}"></script>
    <script src="{{ asset('assets2/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('assets2/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets2/js/main.js') }}"></script>

</body>

</html>
