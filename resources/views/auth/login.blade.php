@extends('layouts.minimal')
@section('body-class', 'account-page') {{-- Kunci utama aktifin style.css login --}}
@section('content')
    <div class="main-wrapper">
        <div class="account-content">
            <div class="container">
                <!-- Account Logo -->
                <div class="account-logo">
                    <a href="https://madiunkota.go.id/" target="_blank">
                        <img src="{{ URL::to('assets/img/logo2.png') }}" alt="Icon Kota Madiun" style="width: 170px; height: 200px;">
                    </a>
                </div>

                <!-- /Account Logo -->
                <div class="account-box">
                    <div class="account-wrapper">
                        <h3 class="account-title">LOGIN</h3><br>
                        
                        <!-- Account Form -->
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label>Password</label>
                                    </div>
                                </div>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <!-- <div class="form-group">
                                <div class="row">
                                    <div class="col"></div>
                                    <div class="col-auto">
                                        <a class="text-muted" href="{{ route('forget-password.post') }}">
                                            Lupa sandi?
                                        </a>
                                    </div>
                                </div>
                            </div> -->
                            <div class="form-group text-center">
                                <button class="btn btn-primary account-btn" type="submit">Login</button>
                            </div>
                            <div class="account-footer">
                                <p>Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
                            </div>
                        </form>
                        <!-- /Account Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
