@extends('layouts.minimal')
@section('body-class', 'account-page')
@section('content')
    <div class="main-wrapper">
        <div class="account-content">
            <div class="container">
                <!-- Logo Akun -->
                <div class="account-logo">
                <a href="https://madiunkota.go.id/" target="_blank">
                    <img src="{{ URL::to('assets/img/logo2.png') }}" alt="PKN UMS DISKOMINFO"></a>
                </div>
                <!-- /Logo Akun -->

                <div class="account-box">
                    <div class="account-wrapper">
                        <h3 class="account-title">Lupa Kata Sandi</h3>
                        <p class="account-subtitle">Masukkan email Anda untuk mendapatkan link reset kata sandi.</p>
                        <!-- Form Akun -->
                        <form method="POST" action="/forget-password">
                            @csrf
                            <div class="form-group">
                                <label>Alamat Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Masukkan email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-primary account-btn" type="submit">KIRIM</button>
                            </div>
                            <div class="account-footer">
                                <p>Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
                            </div>
                        </form>
                        <!-- /Form Akun -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
