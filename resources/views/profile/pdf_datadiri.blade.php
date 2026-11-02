<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Diri Pegawai</title>
    <style>
        @page {
            margin: 0;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            background-color: #ffffff;
            color: #1e293b;
            margin: 0;
            padding: 0;
            font-size: 13px;
        }

        /* ===== Header ===== */
        .header {
            background-color: #0f1f4d;
            border-bottom: 5px solid #22b8f0;
            padding: 34px 45px 28px 45px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            padding: 0;
            vertical-align: middle;
        }

        .header-right {
            width: 100px;
            text-align: right;
        }

        .logo-tile {
            width: 76px;
            height: 76px;
            background-color: #ffffff;
            border: 5px solid #d6e5ff;
            border-radius: 22px;
            padding: 6px;
            text-align: center;
            margin-left: auto;
        }

        .logo-tile img {
            width: 76px;
            height: 76px;
        }

        .header .badge {
            font-size: 9px;
            font-weight: bold;
            letter-spacing: 3px;
            color: #7fb2ff;
            margin-bottom: 8px;
        }

        .header h2 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
            color: #ffffff;
            text-align: left;
        }

        .header .line {
            width: 80px;
            height: 4px;
            background-color: #2563eb;
            margin-top: 14px;
        }

        /* ===== Content ===== */
        .content {
            padding: 34px 45px 60px 45px;
        }

        /* ===== Profile ===== */
        .profile {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 34px;
        }

        .profile td {
            vertical-align: middle;
            padding: 0;
        }

        .photo-cell {
            width: 205px;
        }

        .photo-ring {
            width: 170px;
            background-color: #e3eeff;
            border: 3px solid #cfe0ff;
            border-radius: 24px;
            padding: 8px;
            text-align: center;
        }

        .photo {
            text-align: center;
        }

        .photo img {
            width: 170px;
            max-height: 230px;
            border-radius: 16px;
        }

        .no-photo {
            background-color: #ffffff;
            color: #64748b;
            padding: 70px 10px;
            border-radius: 16px;
            text-align: center;
            font-size: 12px;
        }

        .name-label {
            font-size: 9px;
            font-weight: bold;
            letter-spacing: 3px;
            color: #64748b;
            margin-bottom: 8px;
        }

        .name-value {
            font-size: 27px;
            font-weight: bold;
            color: #2563eb;
            line-height: 1.25;
        }

        .name-line {
            width: 64px;
            height: 4px;
            background-color: #22b8f0;
            margin-top: 14px;
        }

        /* ===== Section title ===== */
        .section-title {
            border-left: 5px solid #2563eb;
            padding-left: 10px;
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 3px;
            color: #0f1f4d;
            margin-bottom: 10px;
        }

        /* ===== Info cards ===== */
        .grid {
            width: 100%;
            border-collapse: collapse;
        }

        .grid td {
            vertical-align: top;
            padding: 0 0 12px 0;
        }

        .grid td.left {
            padding-right: 6px;
            width: 50%;
        }

        .grid td.right {
            padding-left: 6px;
            width: 50%;
        }

        .card {
            background-color: #f5f8fd;
            border: 1px solid #dfe7f5;
            border-left: 5px solid #2563eb;
            border-radius: 12px;
            padding: 13px 16px;
        }

        .card.green  { border-left-color: #10b981; }
        .card.orange { border-left-color: #f59e0b; }
        .card.cyan   { border-left-color: #22b8f0; }

        .card .label {
            font-size: 8px;
            font-weight: bold;
            letter-spacing: 2px;
            color: #64748b;
            margin-bottom: 5px;
        }

        .card .value {
            font-size: 13px;
            font-weight: bold;
            color: #0f1f4d;
            line-height: 1.45;
        }

        /* ===== Footer band ===== */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 10px;
            background-color: #2563eb;
            border-top: 3px solid #22b8f0;
        }
    </style>
</head>
<body>
    @php
        // Ganti nama/path file logo di sini jika berbeda
        $logoPath = 'assets/img/logo_kominfo.png';
    @endphp

    <div class="header">
        <table class="header-table">
            <tr>
                <td class="header-left">
                    <div class="badge">DOKUMEN PEGAWAI</div>
                    <h2>Data Diri Pegawai</h2>
                    <div class="line"></div>
                </td>
                @if(file_exists($logoPath))
                <td class="header-right">
                    <div class="logo-tile">
                        <img src="{{ $logoPath }}" alt="KOMINFO">
                    </div>
                </td>
                @endif
            </tr>
        </table>
    </div>

    <div class="content">
        <!-- Foto Profil + Nama -->
        <table class="profile">
            <tr>
                <td class="photo-cell">
                    <div class="photo-ring">
                        <div class="photo">
                            @if($user->photo)
                                <img src="{{ public_path('storage/uploads/photo/' . $user->photo) }}" alt="Foto Profil">
                            @else
                                <div class="no-photo">Tidak ada foto</div>
                            @endif
                        </div>
                    </div>
                </td>
                <td>
                    <div class="name-label">NAMA PEGAWAI</div>
                    <div class="name-value">{{ $user->name }}</div>
                    <div class="name-line"></div>
                </td>
            </tr>
        </table>

        <!-- Info Pegawai -->
        <div class="section-title">INFORMASI PRIBADI</div>
        <table class="grid">
            <tr>
                <td colspan="2">
                    <div class="card">
                        <div class="label">NAMA</div>
                        <div class="value">{{ $user->name }}</div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="left">
                    <div class="card cyan">
                        <div class="label">TEMPAT, TGL LAHIR</div>
                        <div class="value">{{ $user->birth_place }}, {{ \Carbon\Carbon::parse($user->birth_date)->translatedFormat('d F Y') }}</div>
                    </div>
                </td>
                <td class="right">
                    <div class="card cyan">
                        <div class="label">NOMOR TELEPON</div>
                        <div class="value">{{ $user->nomor_telepon }}</div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="left">
                    <div class="card green">
                        <div class="label">AGAMA</div>
                        <div class="value">{{ $user->religion }}</div>
                    </div>
                </td>
                <td class="right">
                    <div class="card green">
                        <div class="label">EMAIL</div>
                        <div class="value">{{ $user->email }}</div>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="card orange">
                        <div class="label">ALAMAT</div>
                        <div class="value">{{ $user->address }}</div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="footer"></div>
</body>
</html>