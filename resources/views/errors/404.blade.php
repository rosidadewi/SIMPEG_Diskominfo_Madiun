@extends('layouts.minimal')

@section('content')
<div class="main-wrapper" style="display: flex; align-items: center; justify-content: center; min-height: 100vh; background: linear-gradient(135deg, #cfd9df 0%, #e2ebf0 100%); padding: 20px;">
    <div class="error-box" style="text-align: center; background: #ffffff; padding: 50px 30px; border-radius: 20px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1); max-width: 450px; width: 100%;">
        <h1 style="font-size: 120px; font-weight: 700; color: #1e3a8a; margin-bottom: 20px;">404</h1>
        <h3 style="font-size: 24px; font-weight: 600; color: #374151; margin-bottom: 10px;">
            <i class="fa fa-exclamation-triangle" style="color: #f59e0b;"></i> Oops! Page not found!
        </h3>
        <p style="font-size: 16px; color: #6b7280; margin-bottom: 30px;">Maaf, halaman yang kamu cari tidak ditemukan.</p>
        <a href="{{ route('home') }}" class="btn btn-custom" style="display: inline-block; background: #1e3a8a; color: #fff; padding: 12px 30px; border-radius: 10px; font-size: 16px; font-weight: 600; text-decoration: none; transition: background 0.3s;">
            Kembali ke Beranda
        </a>
    </div>
</div>
@endsection
