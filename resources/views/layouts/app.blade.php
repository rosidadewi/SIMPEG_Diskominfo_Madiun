<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.partials.head')
    @yield('style')
    <style>
        .invalid-feedback { font-size: 14px; }
        .error { color: red; }
    </style>
</head>
<body>

<div class="main-wrapper">

    <!-- Loader -->
    <div id="loader-wrapper">
        <div id="loader">
            <div class="loader-ellips">
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
            </div>
        </div>
    </div>

    @include('layouts.partials.header')
    @include('sidebar.sidebar')

    <div class="page-wrapper">
        <div class="content container-fluid">
            @yield('content')


            
        </div>
        @include('layouts.footer')
    </div>
</div>

<!-- JS -->
<script src="{{ URL::to('assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ URL::to('assets/js/popper.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ URL::to('assets/plugins/morris/morris.min.js') }}"></script>
<script src="{{ URL::to('assets/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ URL::to('assets/js/chart.js') }}"></script>
<script src="{{ URL::to('assets/js/Chart.min.js') }}"></script>
<script src="{{ URL::to('assets/js/line-chart.js') }}"></script>
<script src="{{ URL::to('assets/js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ URL::to('assets/js/select2.min.js') }}"></script>
<script src="{{ URL::to('assets/js/moment.min.js') }}"></script>
<script src="{{ URL::to('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ URL::to('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::to('assets/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ URL::to('assets/js/multiselect.min.js') }}"></script>
<script src="{{ URL::to('assets/js/jquery.validate.js') }}"></script>
<script src="{{ URL::to('assets/js/app.js') }}"></script>

<!-- RESPONSIVE -->
<link rel="stylesheet" href="{{ asset('assets/css/responsive-feedback.css') }}">
<script src="{{ asset('assets/js/instant-action.js') }}" defer></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


@yield('script')
@yield('scripts')




</body>
</html>
