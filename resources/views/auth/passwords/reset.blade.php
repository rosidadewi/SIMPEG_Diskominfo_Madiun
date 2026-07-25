@extends('layouts.minimal')
@section('body-class', 'account-page')
@section('content')
<div class="main-wrapper">
    <div class="account-content">
        <div class="container">
            <div class="account-logo">
                <a href="https://madiunkota.go.id/" target="_blank">
                    <img src="{{ URL::to('assets/img/logo2.png') }}" alt="Icon Kota Madiun" style="width: 170px; height: 200px;">
                </a>
            </div>
            <div class="account-box">
                <div class="account-wrapper">
                    <h3 class="account-title">Reset Password</h3><br>
                    <form method="POST" action="{{ route('reset-password.post') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Password Baru</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary account-btn" type="submit">Reset Password</button>
                        </div>
                        <div class="account-footer">
                            <p>Kembali ke <a href="{{ route('login') }}">Login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
