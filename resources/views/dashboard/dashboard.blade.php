@extends('layouts.master')

@section('content')
<div class="page-wrapper">
    <div class="content container-fluid dashboard-container">
        <!-- Header Section -->
        <div class="page-header dashboard-header">
            <div class="row align-items-center">
                <div class="col-auto">
                    <img src="{{ asset('assets/images/logo_kominfo.png') }}" alt="Dinas Kominfo Logo" class="header-logo">
                </div>
                <div class="col">
                    <?php
                        date_default_timezone_set("Asia/Jakarta");
                        $hour = date("G");

                        $hari = [
                            'Sunday' => 'Minggu',
                            'Monday' => 'Senin',
                            'Tuesday' => 'Selasa',
                            'Wednesday' => 'Rabu',
                            'Thursday' => 'Kamis',
                            'Friday' => 'Jumat',
                            'Saturday' => 'Sabtu'
                        ];
                        $bulan = [
                            'Jan' => 'Januari',
                            'Feb' => 'Februari',
                            'Mar' => 'Maret',
                            'Apr' => 'April',
                            'May' => 'Mei',
                            'Jun' => 'Juni',
                            'Jul' => 'Juli',
                            'Aug' => 'Agustus',
                            'Sep' => 'September',
                            'Oct' => 'Oktober',
                            'Nov' => 'November',
                            'Dec' => 'Desember'
                        ];

                        $nama_hari_id = $hari[date("l")];
                        $nama_bulan_id = $bulan[date("M")];
                        $tanggal = date("d");
                        $tahun = date("Y");

                        $msg = $nama_hari_id . ", " . $tanggal . " " . $nama_bulan_id . " " . $tahun;

                        $greet = match (true) {
                            $hour >= 0 && $hour <= 10 => "Selamat Pagi",
                            $hour >= 11 && $hour <= 14 => "Selamat Siang",
                            $hour >= 15 && $hour <= 17 => "Selamat Sore",
                            default => "Selamat Malam",
                        };
                        $userName = Session::get('name', 'Pengguna');
                    ?>
                    <h3 class="page-title dashboard-title">{{ $greet }}, {{ $userName }}!</h3>
                    <h4 class="dashboard-date">{{ $msg }}</h4>
                </div>
            </div>
        </div>

        <!-- Background Image -->
        <div class="background-image"></div>

        <!-- Animated Circles -->
        <div class="decorative-circle decorative-circle-2"></div>
        <div class="decorative-circle decorative-circle-3"></div>

        <!-- Main Content -->
        <div class="row mt-5">
        

            <div class="col-md-4 mb-4">
                <div class="card card-modern shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="fas fa-user-friends fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">Data Diri Pegawai</h5>
                        <p class="card-text">Kelola semua informasi dan Data Diri Anda.</p>
                        <a href="{{ route('datadiri') }}" class="btn btn-primary btn-sm rounded-pill">Lihat Data</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card card-modern shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="fas fa-book-open fa-3x mb-3 text-success"></i>
                        <h5 class="card-title">Riwayat Pendidikan</h5>
                        <p class="card-text">Catat dan kelola riwayat pendidikan terakhir Anda.</p>
                        <a href="{{ route('pendidikan') }}" class="btn btn-success btn-sm rounded-pill">Lihat Pendidikan</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card card-modern shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="fas fa-briefcase fa-3x mb-3 text-warning"></i>
                        <h5 class="card-title">Riwayat Pekerjaan</h5>
                        <p class="card-text">Kelola data mutasi dan riwayat pekerjaan Anda.</p>
                        <a href="{{ route('pekerjaan') }}" class="btn btn-warning btn-sm rounded-pill">Lihat Pekerjaan</a>
                    </div>
                </div>
            </div>

            </div>

        </div>
    </div>
</div>
@endsection

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
@endsection

@section('script')
<script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endsection
