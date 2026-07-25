<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Diri Pegawai</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            background-color: #ffffff;
            color: #1e293b;
            padding: 40px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #0f172a;
            font-size: 24px;
        }

        .photo {
            text-align: center;
            margin-bottom: 40px;
        }

        .photo img {
            max-width: 200px;
            max-height: 250px;
            border-radius: 10px;
        }

        .no-photo {
            background-color: #f1f5f9;
            color: #64748b;
            padding: 40px;
            border-radius: 10px;
            display: inline-block;
        }

        .info {
            width: 100%;
            margin-top: 20px;
            font-size: 14px;
        }

        .info-item {
            margin-bottom: 16px;
            display: flex;
            flex-direction: row;
            gap: 20px; /* jarak antara label dan value */
        }

        .info-label {
            width: 200px;
            font-weight: bold;
            color: #0f172a;
        }

        .info-value {
            color: #334155;
            flex: 1;
        }
    </style>
</head>
<body>
    <h2>Data Diri Pegawai</h2>

    <!-- Foto Profil di Tengah -->
    <div class="photo">
        @if($user->photo)
            <img src="{{ public_path('storage/uploads/photo/' . $user->photo) }}" alt="Foto Profil">
        @else
            <div class="no-photo">Tidak ada foto</div>
        @endif
    </div>

    <!-- Info Pegawai -->
    <div class="info">
        <div class="info-item">
            <div class="info-label">Nama</div>
            <div class="info-value">{{ $user->name }}</div>
        </div>
        <div class="info-item">
            <div class="info-label">Tempat, Tgl Lahir</div>
            <div class="info-value">{{ $user->birth_place }}, {{ \Carbon\Carbon::parse($user->birth_date)->translatedFormat('d F Y') }}</div>
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
    </div>
</body>
</html>
