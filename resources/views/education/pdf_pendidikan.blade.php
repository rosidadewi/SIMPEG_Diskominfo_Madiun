<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Pendidikan</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            background-color: #ffffff;
            color: #1e293b;
            padding: 40px 60px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #0f172a;
            font-size: 24px;
            border-bottom: 2px solid #cbd5e1;
            padding-bottom: 10px;
        }

        .profile {
            text-align: center;
            margin: -1 auto -10px auto;
}

        .profile img {
            max-width: 120px;
            max-height: 180px;
            border-radius: 10px;
            border: 2px solid #94a3b8;
            margin-bottom: 10px;
        }

        .no-photo {
            background-color: #f1f5f9;
            color: #64748b;
            padding: 60px;
            border-radius: 10px;
            display: inline-block;
            font-size: 14px;
        }

        .user-info {
            font-size: 14px;
            margin-top: 10px;
            line-height: 1.6;
        }

        .section {
            margin-top: 40px;
            padding: 20px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            background-color: #f8fafc;
        }

        .section + .section {
            margin-top: 30px;
        }

        .info-row {
            display: flex;
            margin-bottom: 12px;
            font-size: 12px;
        }

        .label {
            width: 200px;
            font-weight: bold;
            color: #0f172a;
        }

        .value {
            flex: 1;
            color: #334155;
        }

        .divider {
            height: 2px;
            background-color: #cbd5e1;
            margin: 30px 0;
        }
    </style>
</head>
<body>
    <h2>Riwayat Pendidikan Terakhir</h2>

    @if($user)
    <div class="profile">
        @if($user->photo)
            <img src="{{ public_path('storage/uploads/photo/' . $user->photo) }}" alt="Foto Profil">
        @else
            <div class="no-photo">Tidak ada foto</div>
        @endif
        <div class="user-info">
            <strong>Nama:</strong> {{ $user->name ?? '-' }}<br>
            <strong>Email:</strong> {{ $user->email ?? '-' }}
        </div>
    </div>
    @endif

    @foreach($pendidikans as $data)
        <div class="section">
            <div class="info-row">
                <div class="label">Jenjang:</div>
                <div class="value">{{ $data->jenjang }}</div>
            </div>
            <div class="info-row">
                <div class="label">Nama Institusi:</div>
                <div class="value">{{ $data->institusi }}</div>
            </div>
            <div class="info-row">
                <div class="label">Gelar:</div>
                <div class="value">{{ $data->gelar }}</div>
            </div>
            <div class="info-row">
                <div class="label">Bidang Ilmu:</div>
                <div class="value">{{ $data->bidang_ilmu }}</div>
            </div>
            <div class="info-row">
                <div class="label">Jurusan:</div>
                <div class="value">{{ $data->jurusan }}</div>
            </div>
            <div class="info-row">
                <div class="label">Lulusan Dalam Negeri:</div>
                <div class="value">{{ $data->lulusan_dalam_negeri ? 'YA' : 'TIDAK' }}</div>
            </div>
            <div class="info-row">
                <div class="label">Alamat Institusi:</div>
                <div class="value">{{ $data->alamat_institusi }}</div>
            </div>
            <div class="info-row">
                <div class="label">No Ijazah:</div>
                <div class="value">{{ $data->no_ijazah }}</div>
            </div>
            <div class="info-row">
                <div class="label">Tanggal Masuk:</div>
                <div class="value">{{ $data->tanggal_masuk }}</div>
            </div>
            <div class="info-row">
                <div class="label">Tanggal Lulus:</div>
                <div class="value">{{ $data->tanggal_lulus }}</div>
            </div>
        </div>
    @endforeach
</body>
</html>
