<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIMPEG NON-ASN | DISKOMINFO KOTA MADIUN</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('assets/img/favicon.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/bootstrap.min.css') }}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/font-awesome.min.css') }}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="{{ URL::to('assets/css/toastr.min.css') }}">

    @yield('style')
    <style>
        .invalid-feedback { font-size: 14px; }
        .error { color: red; }
    </style>
</head>
<body class="@yield('body-class')">

    <div class="main-wrapper">
        @yield('content')
    </div>

    <!-- JS -->
    <script src="{{ URL::to('assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/popper.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/toastr_jquery.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/toastr.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/app.js') }}"></script>


    <!-- RESPONSIVE -->
<link rel="stylesheet" href="{{ asset('assets/css/responsive-feedback.css') }}">
<script src="{{ asset('assets/js/instant-action.js') }}" defer></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


    @yield('script')
</body>
</html>