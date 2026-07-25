<!-- Header -->
<div class="header">
    <!-- Logo -->
    <div class="header-left">
    <a href="https://kominfo.madiunkota.go.id/" class="logo" target="_blank">
    <img src="{{ URL::to('/assets/images/logo_kominfo.png') }}" width="50" height="50" alt="">
        </a>

    </div>
    <!-- /Logo -->
    <a id="toggle_btn" href="javascript:void(0);">
        <span class="bar-icon">
            <span></span><span></span><span></span>
        </span>
    </a>

    <div class="page-title-box">
        <h3>Hi, {{ Session::has('name') ? explode(' ', Session::get('name'))[0] : 'Guest' }}</h3>
    </div>

    <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>

    <ul class="nav user-menu">
        <li class="nav-item dropdown has-arrow main-drop">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                <span class="user-img">
                    <img src="{{ Auth::check() && Auth::user()->photo ? asset('storage/uploads/photo/' . Auth::user()->photo) : asset('assets/images/default-user.png') }}" width="200" height="30" alt="">
                    <span class="status online"></span>
                </span>
                <span>{{ Session::has('name') ? explode(' ', Session::get('name'))[0] : 'Guest' }}</span>
            </a>
            <div class="dropdown-menu">
            <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-danger" style = "width: 140px;" type="submit">Logout</button>
                </form>
            </div>
        </li>
    </ul>

    <div class="dropdown mobile-user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-ellipsis-v"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
        <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-danger" style = "width: 140px;" type="submit">Logout</button>
                </form>
        </div>
    </div>
</div>

<!-- /Header -->

   <!-- jQuery -->
   <script src="{{ URL::to('assets/js/jquery-3.5.1.min.js') }}"></script>
    <!-- Bootstrap Core JS -->
    <script src="{{ URL::to('assets/js/popper.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/bootstrap.min.js') }}"></script>


    <!-- RESPONSIVE -->
<link rel="stylesheet" href="{{ asset('assets/css/responsive-feedback.css') }}">
<script src="{{ asset('assets/js/instant-action.js') }}" defer></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

