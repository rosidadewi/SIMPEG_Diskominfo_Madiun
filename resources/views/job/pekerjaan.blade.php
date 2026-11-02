@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* Latar halaman (sama dengan halaman Pendidikan) */
    body {
        background:
            radial-gradient(circle at 92% 38%, rgba(31, 82, 190, 0.45), transparent 46%),
            radial-gradient(circle at 6% 72%, rgba(12, 74, 118, 0.70), transparent 46%),
            linear-gradient(180deg, #0a1a47 0%, #0b1f50 45%, #0a1636 100%) !important;
        background-attachment: fixed !important;
        background-color: #0a1a47 !important;
        font-family: 'Poppins', 'Segoe UI', system-ui, sans-serif;
        color: #0f172a;
        min-height: 100vh;
    }

    :root {
        --navy: #0b1f5c;
        --primary: #1e3a8a;
        --primary-2: #2d4fbf;
        --blue: #3b82f6;
        --accent: #facc15;
        --text: #0f172a;
        --muted: #64748b;
        --danger: #ef4444;
        --tile-bg: #f4f7fd;
        --tile-border: #e5ebf6;
        --icon-bg: #e4ebfb;
        --success-1: #10b981;
        --success-2: #059669;
    }

    /* ===== Animasi ===== */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(14px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @keyframes cardIn {
        from { opacity: 0; transform: translateY(22px) scale(0.985); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    .reveal {
        animation: fadeUp 0.55s cubic-bezier(0.22, 1, 0.36, 1) both;
        animation-delay: var(--d, 0s);
    }

    @media (prefers-reduced-motion: reduce) {
        .reveal, .small-container { animation: none !important; }
        * { transition: none !important; }
    }

    /* ===== Card ===== */
    .small-container {
        position: relative;
        z-index: 1;
        width: calc(100% - 32px);
        max-width: 920px;
        background-color: #ffffff;
        border-radius: 30px;
        box-shadow: 0 30px 70px rgba(4, 12, 40, 0.5), 0 2px 8px rgba(4, 12, 40, 0.15);
        margin: 40px auto;
        overflow: hidden;
        font-family: 'Poppins', 'Segoe UI', system-ui, sans-serif;
        color: var(--text);
        animation: cardIn 0.6s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    .small-container *,
    .small-container *::before,
    .small-container *::after {
        box-sizing: border-box;
    }

    /* ===== Hero header ===== */
    .form-hero {
        position: relative;
        padding: 26px 40px 34px;
        background: linear-gradient(135deg, #0b1f5c 0%, #1e3a8a 55%, #2563eb 100%);
        color: #fff;
        overflow: hidden;
    }

    .form-hero::before {
        content: "";
        position: absolute;
        top: -90px;
        right: -60px;
        width: 280px;
        height: 280px;
        border-radius: 50%;
        background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.22), rgba(255, 255, 255, 0) 70%);
        pointer-events: none;
    }

    .form-hero::after {
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        height: 5px;
        background: linear-gradient(90deg, rgba(250, 204, 21, 0) 0%, #facc15 70%, #fde047 100%);
    }

    .hero-dots {
        position: absolute;
        right: 36px;
        bottom: 18px;
        width: 110px;
        height: 60px;
        background-image: radial-gradient(rgba(255, 255, 255, 0.35) 1.6px, transparent 1.6px);
        background-size: 14px 14px;
        opacity: 0.7;
        pointer-events: none;
    }

    .small-container .btn-back {
        position: relative;
        z-index: 1;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 7px 16px 7px 12px;
        margin-bottom: 20px;
        font-size: 13px;
        font-weight: 600;
        line-height: 1;
        color: #fff;
        background: rgba(255, 255, 255, 0.14);
        border: 1px solid rgba(255, 255, 255, 0.28);
        border-radius: 999px;
        text-decoration: none;
        -webkit-backdrop-filter: blur(6px);
        backdrop-filter: blur(6px);
        transition: all 0.25s ease;
    }

    .small-container .btn-back i {
        font-size: 16px;
        line-height: 1;
        transition: transform 0.25s ease;
    }

    .small-container .btn-back:hover {
        background: #fff;
        color: var(--primary);
        text-decoration: none;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .small-container .btn-back:hover i {
        transform: translateX(-3px);
    }

    .hero-main {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .hero-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        width: 64px;
        height: 64px;
        border-radius: 20px;
        background: #ffffff;
        color: var(--primary);
        font-size: 28px;
        border-bottom: 4px solid var(--accent);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.25);
    }

    .hero-icon i {
        line-height: 1;
    }

    .hero-main h4 {
        font-weight: 700;
        color: #fff;
        font-size: 26px;
        margin: 0;
        letter-spacing: -0.3px;
        line-height: 1.25;
        text-align: left;
    }

    .form-subtitle {
        margin: 4px 0 0;
        font-size: 14px;
        color: rgba(255, 255, 255, 0.78);
    }

    /* ===== Body ===== */
    .form-body {
        padding: 32px 40px 36px;
    }

    /* ===== Section title (step) ===== */
    .small-container .section-title {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 34px 0 16px;
        font-size: 15px;
        font-weight: 700;
        letter-spacing: 0;
        text-transform: none;
        color: var(--navy);
    }

    .small-container .section-title.first {
        margin-top: 0;
    }

    .section-title .step {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 700;
        color: #fff;
        background: linear-gradient(135deg, #1e3a8a, #3b82f6);
        box-shadow: 0 6px 14px rgba(37, 99, 235, 0.35);
    }

    .small-container .section-title::after {
        content: "";
        flex: 1;
        height: 2px;
        border-radius: 2px;
        background: linear-gradient(90deg, #dbe5f7, rgba(219, 229, 247, 0));
    }

    /* ===== Form layout ===== */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
    }

    .field.full {
        grid-column: 1 / -1;
    }

    /* Tile field (ikon + label + isi) */
    .small-container .field {
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 0;
        margin: 0;
        background: #ffffff;
        border: 1.5px solid var(--tile-border);
        border-radius: 18px;
        padding: 14px 16px;
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
        transition: border-color 0.25s ease, box-shadow 0.25s ease, transform 0.25s ease;
    }

    .small-container .field:hover {
        border-color: #cbd9f3;
        box-shadow: 0 8px 22px rgba(30, 58, 138, 0.09);
        transform: translateY(-2px);
    }

    .small-container .field:focus-within {
        border-color: var(--blue);
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15), 0 10px 26px rgba(30, 58, 138, 0.12);
        transform: translateY(-2px);
    }

    .small-container .field:has(.form-control:user-invalid) {
        border-color: #f87171;
    }

    .field-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        width: 46px;
        height: 46px;
        border-radius: 14px;
        background: var(--icon-bg);
        color: var(--primary-2);
        font-size: 20px;
        transition: all 0.25s ease;
    }

    .field-icon i {
        line-height: 1;
    }

    .field:focus-within .field-icon {
        background: linear-gradient(135deg, #1e3a8a, #3b82f6);
        color: #fff;
        box-shadow: 0 8px 18px rgba(37, 99, 235, 0.35);
    }

    .field-body {
        flex: 1;
        min-width: 0;
        display: flex;
        flex-direction: column;
    }

    .small-container .field .form-label {
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.09em;
        text-transform: uppercase;
        color: var(--muted);
        margin: 0 0 5px;
    }

    .small-container .req {
        margin-left: 3px;
        font-weight: 700;
        color: var(--danger);
    }

    .small-container .form-control {
        width: 100%;
        height: auto;
        min-height: 0;
        background-color: var(--tile-bg) !important;
        border: 1.5px solid transparent;
        border-radius: 10px;
        padding: 9px 12px;
        font-family: inherit;
        font-size: 15px;
        font-weight: 500;
        color: var(--text);
        box-shadow: none;
        margin: 0;
        transition: border-color 0.2s ease, background-color 0.2s ease;
    }

    .small-container .form-control:hover {
        border-color: #dbe5f7;
    }

    .small-container .form-control:focus {
        background-color: #fff !important;
        border-color: var(--blue);
        box-shadow: none;
        outline: none;
    }

    .small-container .form-control::placeholder {
        color: #9aa7ba;
        opacity: 1;
    }

    .small-container select.form-control {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'><polyline points='6 9 12 15 18 9'/></svg>");
        background-repeat: no-repeat;
        background-position: right 12px center;
        padding-right: 38px;
        cursor: pointer;
    }

    /* ===== Pesan error ===== */
    .small-container .text-danger {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-top: 10px;
        font-size: 12.5px;
        font-weight: 600;
        line-height: 1.4;
        color: #dc2626 !important;
    }

    /* ===== Kartu upload dokumen ===== */
    .upload-card {
        position: relative;
        display: flex;
        align-items: center;
        gap: 18px;
        padding: 18px;
        background: #f0f5fd;
        border: 1.6px dashed #b9c8e8;
        border-radius: 20px;
        transition: border-color 0.2s ease, background-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
    }

    .upload-card:hover,
    .upload-card.dragover {
        background: #e8f0fd;
        border-color: var(--blue);
        transform: translateY(-2px);
        box-shadow: 0 10px 22px rgba(30, 58, 138, 0.12);
    }

    .upload-card:focus-within {
        border-color: var(--blue);
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
    }

    .upload-card.has-file {
        border-style: solid;
        border-color: #34d399;
        background: #f0fdf8;
    }

    .upload-icon {
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        font-size: 21px;
        color: var(--primary-2);
        background: #fff;
        border-bottom: 3px solid var(--accent);
        border-radius: 14px;
        box-shadow: 0 5px 12px rgba(30, 58, 138, 0.12);
        transition: color 0.25s ease;
    }

    .upload-icon i {
        line-height: 1;
    }

    .upload-card.has-file .upload-icon {
        color: var(--success-2);
    }

    .upload-info {
        flex-shrink: 0;
        min-width: 0;
    }

    .small-container .upload-card .form-label {
        display: block;
        margin: 0 0 4px;
        font-size: 14px;
        font-weight: 700;
        letter-spacing: 0;
        text-transform: none;
        color: var(--navy);
    }

    .upload-hint {
        display: block;
        font-size: 12px;
        line-height: 1.5;
        color: var(--muted);
    }

    .upload-file {
        flex: 1;
        display: flex;
        align-items: center;
        gap: 8px;
        min-width: 0;
        padding: 9px 12px;
        font-size: 12px;
        line-height: 1.5;
        color: var(--muted);
        background: #fff;
        border-radius: 11px;
    }

    .upload-file i {
        flex-shrink: 0;
    }

    .upload-file span {
        min-width: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .upload-card.has-file .upload-file {
        font-weight: 600;
        color: #047857;
        background: #dcfce7;
    }

    /* Input file menutupi seluruh kartu (klik atau seret file) */
    .small-container .upload-card input[type="file"].form-control {
        position: absolute;
        top: 0;
        left: 0;
        z-index: 2;
        width: 100%;
        height: 100%;
        min-height: 0;
        margin: 0;
        padding: 0;
        opacity: 0;
        border: 0;
        border-radius: 20px;
        cursor: pointer;
    }

    /* ===== Action bar ===== */
    .form-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-top: 36px;
        padding: 18px 20px;
        background: linear-gradient(135deg, #f4f7fd, #eaf0fc);
        border: 1px solid var(--tile-border);
        border-radius: 20px;
    }

    .required-note {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
        font-size: 13px;
        color: var(--muted);
    }

    .required-note i {
        font-size: 18px;
        line-height: 1;
        color: var(--primary-2);
    }

    .required-note .star {
        font-weight: 700;
        color: var(--danger);
    }

    .small-container .btn-primary {
        position: relative;
        overflow: hidden;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: linear-gradient(135deg, var(--success-1), var(--success-2));
        border: none;
        color: #ffffff;
        font-family: inherit;
        font-weight: 600;
        border-radius: 14px;
        padding: 12px 32px;
        font-size: 15px;
        min-width: 180px;
        box-shadow: 0 10px 24px rgba(16, 185, 129, 0.38);
        transition: all 0.25s ease;
    }

    .small-container .btn-primary i {
        font-size: 18px;
        line-height: 1;
        color: #fff;
    }

    .small-container .btn-primary::after {
        content: "";
        position: absolute;
        top: 0;
        left: -80%;
        width: 50%;
        height: 100%;
        background: linear-gradient(100deg, transparent, rgba(255, 255, 255, 0.35), transparent);
        transform: skewX(-20deg);
        transition: left 0.6s ease;
    }

    .small-container .btn-primary:hover,
    .small-container .btn-primary:focus {
        background: linear-gradient(135deg, #12c08c, #047857);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 14px 30px rgba(16, 185, 129, 0.48);
    }

    .small-container .btn-primary:hover::after {
        left: 130%;
    }

    .small-container .btn-primary:active {
        transform: translateY(0);
    }

    /* ===== Responsive ===== */
    @media (max-width: 768px) {
        .small-container {
            margin: 28px auto;
            border-radius: 26px;
        }

        .form-hero {
            padding: 22px 28px 30px;
        }

        .form-body {
            padding: 28px 28px 30px;
        }

        .hero-main h4 {
            font-size: 22px;
        }
    }

    @media (max-width: 600px) {
        .small-container {
            width: calc(100% - 24px);
            margin: 16px auto;
            border-radius: 22px;
        }

        .form-hero {
            padding: 18px 20px 26px;
        }

        .hero-dots {
            display: none;
        }

        .hero-icon {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            font-size: 24px;
        }

        .hero-main {
            gap: 14px;
        }

        .hero-main h4 {
            font-size: 19px;
        }

        .form-subtitle {
            font-size: 12.5px;
        }

        .form-body {
            padding: 22px 16px 24px;
        }

        .small-container .section-title {
            margin: 28px 0 14px;
            font-size: 14px;
        }

        .form-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .small-container .field {
            padding: 12px;
            gap: 12px;
            border-radius: 16px;
        }

        .field-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            font-size: 18px;
        }

        .small-container .form-control {
            font-size: 16px; /* mencegah zoom otomatis di iOS */
        }

        .upload-card {
            flex-direction: column;
            align-items: stretch;
            gap: 12px;
        }

        .upload-info {
            flex-shrink: 1;
        }

        .upload-file {
            flex: none;
            padding: 10px 12px;
        }

        .form-footer {
            flex-direction: column;
            align-items: stretch;
            padding: 16px;
        }

        .required-note {
            justify-content: center;
            text-align: center;
        }

        .small-container .btn-primary {
            width: 100%;
        }
    }
</style>

<div class="small-container">
    <div class="form-hero">
        <span class="hero-dots"></span>

        <a href="{{ route('pekerjaan') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        <div class="hero-main">
            <div class="hero-icon"><i class="bi bi-briefcase-fill"></i></div>
            <div>
                <h4>Tambah Riwayat Pekerjaan</h4>
                <p class="form-subtitle">Lengkapi data riwayat pekerjaan beserta dokumen SK.</p>
            </div>
        </div>
    </div>

    <div class="form-body">
        <form action="{{ route('pekerjaan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="section-title first reveal" style="--d:.05s"><span class="step">1</span> Data Jabatan</div>
            <div class="form-grid reveal" style="--d:.1s">
                <div class="field">
                    <span class="field-icon"><i class="bi bi-award"></i></span>
                    <div class="field-body">
                        <label for="pangkat" class="form-label">Pangkat <span class="req">*</span></label>
                        <input type="text" id="pangkat" name="pangkat" class="form-control" placeholder="Pangkat / golongan" value="{{ old('pangkat') }}" required>
                    </div>
                </div>

                <div class="field">
                    <span class="field-icon"><i class="bi bi-briefcase"></i></span>
                    <div class="field-body">
                        <label for="jabatan" class="form-label">Jabatan <span class="req">*</span></label>
                        <input type="text" id="jabatan" name="jabatan" class="form-control" placeholder="Nama jabatan" value="{{ old('jabatan') }}" required>
                    </div>
                </div>

                <div class="field">
                    <span class="field-icon"><i class="bi bi-building"></i></span>
                    <div class="field-body">
                        <label for="unit_kerja" class="form-label">Unit Kerja <span class="req">*</span></label>
                        <input type="text" id="unit_kerja" name="unit_kerja" class="form-control" placeholder="Nama unit kerja" value="{{ old('unit_kerja') }}" required>
                    </div>
                </div>

                <div class="field">
                    <span class="field-icon"><i class="bi bi-diagram-3"></i></span>
                    <div class="field-body">
                        <label for="sub_bagian" class="form-label">Sub Bagian</label>
                        <input type="text" id="sub_bagian" name="sub_bagian" class="form-control" placeholder="Nama sub bagian (jika ada)" value="{{ old('sub_bagian') }}">
                    </div>
                </div>

                <div class="field full">
                    <span class="field-icon"><i class="bi bi-person-vcard"></i></span>
                    <div class="field-body">
                        <label for="nip" class="form-label">NIP <span class="req">*</span></label>
                        <input type="text" id="nip" name="nip" class="form-control" placeholder="Nomor Induk Pegawai" value="{{ old('nip') }}" required>
                    </div>
                </div>
            </div>

            <div class="section-title reveal" style="--d:.15s"><span class="step">2</span> Surat Keputusan</div>
            <div class="form-grid reveal" style="--d:.2s">
                <div class="field full">
                    <span class="field-icon"><i class="bi bi-file-earmark-text"></i></span>
                    <div class="field-body">
                        <label for="nomor_sk" class="form-label">Nomor SK <span class="req">*</span></label>
                        <input type="text" id="nomor_sk" name="nomor_sk" class="form-control" placeholder="Nomor surat keputusan" value="{{ old('nomor_sk') }}" required>
                    </div>
                </div>

                <div class="field">
                    <span class="field-icon"><i class="bi bi-calendar3"></i></span>
                    <div class="field-body">
                        <label for="tanggal_sk" class="form-label">Tanggal SK <span class="req">*</span></label>
                        <input type="date" id="tanggal_sk" name="tanggal_sk" class="form-control" value="{{ old('tanggal_sk') }}" required>
                    </div>
                </div>

                <div class="field">
                    <span class="field-icon"><i class="bi bi-calendar-check"></i></span>
                    <div class="field-body">
                        <label for="tmt_sk" class="form-label">TMT SK <span class="req">*</span></label>
                        <input type="date" id="tmt_sk" name="tmt_sk" class="form-control" value="{{ old('tmt_sk') }}" required>
                    </div>
                </div>

                <div class="field full">
                    <span class="field-icon"><i class="bi bi-arrow-left-right"></i></span>
                    <div class="field-body">
                        <label for="mutasi" class="form-label">Mutasi</label>
                        <select id="mutasi" name="mutasi" class="form-control">
                            <option value="" disabled selected>Pilih Mutasi</option>
                            <option value="Mutasi Jabatan" {{ old('mutasi') == 'Mutasi Jabatan' ? 'selected' : '' }}>Mutasi Jabatan</option>
                            <option value="Mutasi Tempat Tugas" {{ old('mutasi') == 'Mutasi Tempat Tugas' ? 'selected' : '' }}>Mutasi Tempat Tugas</option>
                            <option value="Mutasi Antar Instansi" {{ old('mutasi') == 'Mutasi Antar Instansi' ? 'selected' : '' }}>Mutasi Antar Instansi</option>
                            <option value="Mutasi Kenaikan Pangkat" {{ old('mutasi') == 'Mutasi Kenaikan Pangkat' ? 'selected' : '' }}>Mutasi Kenaikan Pangkat</option>
                            <option value="Mutasi Penyesuaian Organisasi" {{ old('mutasi') == 'Mutasi Penyesuaian Organisasi' ? 'selected' : '' }}>Mutasi Penyesuaian Organisasi</option>
                            <option value="Mutasi Sementara" {{ old('mutasi') == 'Mutasi Sementara' ? 'selected' : '' }}>Mutasi Sementara</option>
                            <option value="Tidak Mutasi" {{ old('mutasi') == 'Tidak Mutasi' ? 'selected' : '' }}>Tidak Mutasi</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="section-title reveal" style="--d:.25s"><span class="step">3</span> Dokumen</div>
            <div class="reveal" style="--d:.3s">
                <div class="upload-card">
                    <span class="upload-icon"><i class="bi bi-file-earmark-pdf"></i></span>
                    <div class="upload-info">
                        <label for="file_sk" class="form-label upload-title">File SK (PDF)</label>
                        <span class="upload-hint">Klik atau seret file ke sini</span>
                    </div>
                    <div class="upload-file"><i class="bi bi-paperclip"></i><span>Belum ada file dipilih</span></div>
                    <input type="file" id="file_sk" name="file_sk" class="form-control">
                </div>
                @if ($errors->has('file_sk'))
                    <div class="text-danger"><i class="bi bi-exclamation-circle"></i> {{ $errors->first('file_sk') }}</div>
                @endif
            </div>

            <div class="form-footer reveal" style="--d:.35s">
                <p class="required-note"><i class="bi bi-info-circle"></i> <span><span class="star">*</span> wajib diisi. Pastikan seluruh data sudah benar sebelum disimpan.</span></p>
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle"></i> Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Tampilan kartu upload: tampilkan nama file yang dipilih (tidak mengubah proses upload)
    document.querySelectorAll('.upload-card input[type="file"]').forEach(function (input) {
        var card = input.closest('.upload-card');
        var label = card.querySelector('.upload-file span');
        var kosong = label.textContent;

        input.addEventListener('change', function () {
            if (input.files && input.files.length) {
                label.textContent = input.files[0].name;
                card.classList.add('has-file');
            } else {
                label.textContent = kosong;
                card.classList.remove('has-file');
            }
        });

        ['dragenter', 'dragover'].forEach(function (ev) {
            input.addEventListener(ev, function () { card.classList.add('dragover'); });
        });

        ['dragleave', 'drop', 'change'].forEach(function (ev) {
            input.addEventListener(ev, function () { card.classList.remove('dragover'); });
        });
    });
</script>
@endsection