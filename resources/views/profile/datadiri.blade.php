@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(to right, #dfe9f3, #ffffff);
        font-family: 'Segoe UI', sans-serif;
    }

    .container {
        max-width: 1000px;
    }

    .card {
        border: none;
        border-radius: 20px;
        background: #ffffff;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.07);
    }

    .card-body {
        padding: 40px;
    }

    .profile-photo {
        max-width: 100%;
        max-height: 250px;
        border-radius: 15px;
        border: 3px solid #dee2e6;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        background: #f8f9fa;
    }

    .info-item {
        display: flex;
        gap: 10px;
        margin-bottom: 16px;
        align-items: center;
        font-size: 16px;
    }

    .info-label {
        width: 150px;
        font-weight: 600;
        color: #1e293b;
    }

    .info-value {
        flex: 1;
        color: #334155;
        background: #f1f5f9;
        padding: 8px 15px;
        border-radius: 8px;
    }

    .info-link {
        color: #0d6efd;
        text-decoration: none;
        cursor: pointer;
    }

    .info-link:hover {
        text-decoration: underline;
    }

    .btn {
        border-radius: 10px;
        font-weight: 600;
        padding: 8px 20px;
    }

    .btn-warning {
        background: linear-gradient(to right, #f6d365, #fda085);
        border: none;
        color: #fff;
    }

    .btn-success {
        background: linear-gradient(to right, #96e6a1, #d4fc79);
        border: none;
        color: #333;
    }

    .btn-warning:hover,
    .btn-success:hover {
        opacity: 0.9;
    }

    .header-bar {
        background: #f8fafc;
        padding: 15px 25px;
        border-radius: 15px;
        margin-bottom: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    }

    .header-bar h4 {
        margin: 0;
        font-weight: bold;
        color: #2c3e50;
    }

    .modal-img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
</style>

<div class="container mt-2">
    <div class="header-bar">
        <h4>📄 Data Diri</h4>
        <div>
            <a href="{{ route('datadiri.edit') }}" class="btn btn-warning me-2">✏️ Edit</a>
            <a href="{{ route('datadiri.download') }}" class="btn btn-success">⬇️ Download PDF</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <!-- Kolom Data -->
                <div class="col-md-8">
                    <div class="info-item">
                        <div class="info-label">Nama</div>
                        <div class="info-value">{{ $user->name }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Tempat Lahir</div>
                        <div class="info-value">{{ $user->birth_place }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Tanggal Lahir</div>
                        <div class="info-value">{{ \Carbon\Carbon::parse($user->birth_date)->translatedFormat('d F Y') }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Alamat</div>
                        <div class="info-value">{{ $user->address }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Nomor Telepon</div>
                        <div class="info-value">{{ $user->nomor_telepon }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Agama</div>
                        <div class="info-value">{{ $user->religion }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Email</div>
                        <div class="info-value">{{ $user->email }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">KTP</div>
                        <div class="info-value">
                            <a class="info-link" data-bs-toggle="modal" data-bs-target="#ktpModal">📎 Lihat KTP</a>
                        </div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">KK</div>
                        <div class="info-value">
                            <a class="info-link" data-bs-toggle="modal" data-bs-target="#kkModal">📎 Lihat KK</a>
                        </div>
                    </div>
                </div>

                <!-- Kolom Foto -->
                <div class="col-md-4 text-center">
                    @if($user->photo)
                        <img src="{{ asset('storage/uploads/photo/' . $user->photo) }}" class="profile-photo mb-3" alt="Foto Profil">
                    @else
                        <div class="bg-light text-muted rounded p-5">Tidak ada foto</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal KTP -->
<div class="modal fade" id="ktpModal" tabindex="-1" aria-labelledby="ktpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 id="ktpModalLabel" class="mb-0">KTP</h5>
                <a href="{{ asset('storage/uploads/ktp/' . $user->ktp) }}" class="btn btn-success btn-sm" download>⬇️ Download KTP</a>
            </div>
            <img src="{{ asset('storage/uploads/ktp/' . $user->ktp) }}" class="modal-img mt-2" alt="KTP">
        </div>
    </div>
</div>


<!-- Modal KK -->
<div class="modal fade" id="kkModal" tabindex="-1" aria-labelledby="kkModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 id="kkModalLabel" class="mb-0">Kartu Keluarga (KK)</h5>
                <a href="{{ asset('storage/uploads/kk/' . $user->kk) }}" class="btn btn-success btn-sm" download>⬇️ Download KK</a>
            </div>
            <img src="{{ asset('storage/uploads/kk/' . $user->kk) }}" class="modal-img mt-2" alt="KK">
        </div>
    </div>
</div>



@endsection
