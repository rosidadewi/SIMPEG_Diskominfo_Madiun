@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* Warna latar halaman (sama dengan halaman Data Diri) */
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

    @keyframes fadeSlide {
        from { opacity: 0; transform: translateY(-8px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .reveal {
        animation: fadeUp 0.55s cubic-bezier(0.22, 1, 0.36, 1) both;
        animation-delay: var(--d, 0s);
    }

    @media (prefers-reduced-motion: reduce) {
        .reveal, .small-container, #extra-field-container { animation: none !important; }
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
        font-size: 30px;
        border-bottom: 4px solid var(--accent);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.25);
    }

    .hero-icon i {
        line-height: 1;
    }

    .hero-main h2 {
        font-weight: 700;
        color: #fff;
        font-size: 26px;
        margin: 0;
        letter-spacing: -0.3px;
        line-height: 1.25;
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

    .small-container .section-title.is-first {
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

    /* ===== Panel Detail Pendidikan Tinggi (S1/S2/S3/Prof) ===== */
    #extra-field-container {
        position: relative;
        flex-wrap: wrap;
        gap: 14px;
        margin: 30px 0 16px;
        padding: 26px 18px 18px;
        background: #f0f5fd;
        border: 1.5px solid #dbe6f7;
        border-radius: 22px;
        animation: fadeSlide 0.35s ease both;
    }

    #extra-field-container::before {
        content: "Detail Pendidikan Tinggi";
        position: absolute;
        top: -13px;
        left: 20px;
        padding: 5px 14px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.07em;
        line-height: 1.2;
        text-transform: uppercase;
        color: #fff;
        background: linear-gradient(135deg, #1e3a8a, #3b82f6);
        border-radius: 999px;
        box-shadow: 0 6px 14px rgba(37, 99, 235, 0.3);
    }

    #extra-field-container .field {
        flex: 1 1 calc(33.333% - 10px);
        min-width: 220px;
    }

    /* ===== Kartu upload dokumen ===== */
    .upload-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
    }

    .upload-card {
        position: relative;
        display: flex;
        flex-direction: column;
        gap: 12px;
        min-height: 176px;
        padding: 18px;
        background: #f0f5fd;
        border: 1.6px dashed #b9c8e8;
        border-radius: 20px;
        transition: border-color 0.2s ease, background-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
    }

    .upload-card:hover,
    .upload-card.drag {
        background: #e8f0fd;
        border-color: var(--blue);
        transform: translateY(-2px);
        box-shadow: 0 10px 22px rgba(30, 58, 138, 0.12);
    }

    .upload-card:focus-within {
        border-color: var(--blue);
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
    }

    .upload-card:has(input:user-invalid) {
        border-color: #f87171;
    }

    .upload-card.has-file {
        border-style: solid;
        border-color: #34d399;
        background: #f0fdf8;
    }

    /* Input asli menutupi seluruh kartu: klik & seret file tetap berfungsi */
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

    .upload-card .upload-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 46px;
        height: 46px;
        font-size: 20px;
        color: var(--primary-2);
        background: #fff;
        border-bottom: 3px solid var(--accent);
        border-radius: 14px;
        box-shadow: 0 5px 12px rgba(30, 58, 138, 0.12);
        transition: color 0.25s ease;
    }

    .upload-card .upload-icon i {
        line-height: 1;
    }

    .upload-card.has-file .upload-icon {
        color: var(--success-2);
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

    .upload-card .upload-hint {
        display: block;
        font-size: 12px;
        line-height: 1.5;
        color: var(--muted);
    }

    .upload-card .file-name {
        display: flex;
        align-items: center;
        gap: 8px;
        min-width: 0;
        margin-top: auto;
        padding: 8px 12px;
        font-size: 12px;
        line-height: 1.5;
        color: var(--muted);
        background: #fff;
        border-radius: 11px;
    }

    .upload-card .file-name i {
        flex-shrink: 0;
    }

    .upload-card .file-name span {
        min-width: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .upload-card.has-file .file-name {
        font-weight: 600;
        color: #047857;
        background: #dcfce7;
    }

    /* ===== Action bar ===== */
    .form-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-top: 36px;
        padding: 18px 20px;
        background: linear-gradient(135deg, #f4f7fd, #eaf0fc);
        border: 1px solid var(--tile-border);
        border-radius: 20px;
        text-align: left;
    }

    .form-actions .hint {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
        font-size: 13px;
        color: var(--muted);
    }

    .form-actions .hint i {
        font-size: 18px;
        line-height: 1;
        color: var(--primary-2);
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
        margin: 0 !important;
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

        .hero-main h2 {
            font-size: 22px;
        }

        .upload-grid {
            grid-template-columns: 1fr;
        }

        .upload-card {
            min-height: 0;
        }

        #extra-field-container .field {
            flex-basis: 100%;
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

        .hero-main h2 {
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

        #extra-field-container {
            padding: 24px 12px 12px;
            gap: 12px;
        }

        .small-container .form-control {
            font-size: 16px; /* mencegah zoom otomatis di iOS */
        }

        .form-actions {
            flex-direction: column;
            align-items: stretch;
            padding: 16px;
        }

        .form-actions .hint {
            justify-content: center;
            text-align: center;
        }

        .small-container .btn-primary {
            width: 100%;
        }
    }
</style>

<!-- Menyertakan SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="small-container">

    <div class="form-hero">
        <span class="hero-dots"></span>

        <a href="{{ route('pendidikan') }}" class="btn-back" title="Kembali">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>

        <div class="hero-main">
            <div class="hero-icon"><i class="bi bi-mortarboard-fill"></i></div>
            <div>
                <h2>Form Pendidikan</h2>
                <p class="form-subtitle">Lengkapi data riwayat pendidikan beserta dokumen pendukung.</p>
            </div>
        </div>
    </div>

    <div class="form-body">
        <form action="{{ route('pendidikan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="section-title is-first reveal" style="--d:.05s"><span class="step">1</span> Data Institusi</div>

            <div class="form-grid reveal" style="--d:.1s">
                <div class="field">
                    <span class="field-icon"><i class="bi bi-mortarboard"></i></span>
                    <div class="field-body">
                        <label for="jenjang" class="form-label">Jenjang Pendidikan <span class="req">*</span></label>
                        <select id="jenjang" name="jenjang" class="form-control" required>
                            <option value="">-- Pilih Jenjang --</option>
                            <option value="SMA/SMK">SMA/SMK</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                            <option value="Prof">Profesi</option>
                        </select>
                    </div>
                </div>
                <div class="field">
                    <span class="field-icon"><i class="bi bi-building"></i></span>
                    <div class="field-body">
                        <label for="institusi" class="form-label">Nama Institusi <span class="req">*</span></label>
                        <input type="text" id="institusi" name="institusi" class="form-control" placeholder="Contoh: Universitas Indonesia" required>
                    </div>
                </div>
            </div>

            <!-- Tambahan field ketika jenjang S1/S2/S3/Prof -->
            <div id="extra-field-container" style="display:none;">
                <div class="field">
                    <span class="field-icon"><i class="bi bi-globe2"></i></span>
                    <div class="field-body">
                        <label for="lulusan" class="form-label">Lulusan</label>
                        <select name="lulusan" id="lulusan" class="form-control">
                            <option value="Dalam Negeri">Dalam Negeri</option>
                            <option value="Luar Negeri">Luar Negeri</option>
                        </select>
                    </div>
                </div>
                <div class="field">
                    <span class="field-icon"><i class="bi bi-award"></i></span>
                    <div class="field-body">
                        <label for="gelar" class="form-label">Gelar Pendidikan</label>
                        <input type="text" id="gelar" name="gelar" class="form-control" placeholder="Contoh: S.Kom">
                    </div>
                </div>
                <div class="field">
                    <span class="field-icon"><i class="bi bi-book"></i></span>
                    <div class="field-body">
                        <label for="bidang_ilmu" class="form-label">Bidang Ilmu</label>
                        <input type="text" id="bidang_ilmu" name="bidang_ilmu" class="form-control" placeholder="Contoh: Teknologi Informasi">
                    </div>
                </div>
            </div>

            <div class="form-grid reveal" style="--d:.15s">
                <div class="field">
                    <span class="field-icon"><i class="bi bi-diagram-3"></i></span>
                    <div class="field-body">
                        <label for="jurusan" class="form-label">Jurusan <span class="req">*</span></label>
                        <input type="text" id="jurusan" name="jurusan" class="form-control" placeholder="Nama jurusan / program studi" required>
                    </div>
                </div>
                <div class="field">
                    <span class="field-icon"><i class="bi bi-geo-alt"></i></span>
                    <div class="field-body">
                        <label for="alamat_institusi" class="form-label">Alamat Institusi <span class="req">*</span></label>
                        <input type="text" id="alamat_institusi" name="alamat_institusi" class="form-control" placeholder="Kota, provinsi" required>
                    </div>
                </div>
            </div>

            <div class="section-title reveal" style="--d:.2s"><span class="step">2</span> Ijazah &amp; Periode</div>

            <div class="form-grid reveal" style="--d:.25s">
                <div class="field full">
                    <span class="field-icon"><i class="bi bi-card-heading"></i></span>
                    <div class="field-body">
                        <label for="no_ijazah" class="form-label">No Ijazah <span class="req">*</span></label>
                        <input type="text" id="no_ijazah" name="no_ijazah" class="form-control" placeholder="Nomor seri ijazah" required>
                    </div>
                </div>
                <div class="field">
                    <span class="field-icon"><i class="bi bi-calendar3"></i></span>
                    <div class="field-body">
                        <label for="tanggal_masuk" class="form-label">Tanggal Masuk <span class="req">*</span></label>
                        <input type="date" id="tanggal_masuk" name="tanggal_masuk" class="form-control" required>
                    </div>
                </div>
                <div class="field">
                    <span class="field-icon"><i class="bi bi-calendar-check"></i></span>
                    <div class="field-body">
                        <label for="tanggal_lulus" class="form-label">Tanggal Lulus <span class="req">*</span></label>
                        <input type="date" id="tanggal_lulus" name="tanggal_lulus" class="form-control" required>
                    </div>
                </div>
            </div>

            <div class="section-title reveal" style="--d:.3s"><span class="step">3</span> Dokumen</div>

            <div class="upload-grid reveal" style="--d:.35s">
                <div class="upload-card">
                    <input type="file" id="ijazah" name="ijazah" class="form-control" required>
                    <span class="upload-icon"><i class="bi bi-file-earmark-text"></i></span>
                    <div>
                        <label for="ijazah" class="form-label">Upload Ijazah <span class="req">*</span></label>
                        <span class="upload-hint">Klik atau seret file ke sini</span>
                    </div>
                    <span class="file-name"><i class="bi bi-paperclip"></i><span>Belum ada file dipilih</span></span>
                </div>

                <div class="upload-card">
                    <input type="file" id="file_pendamping" name="file_pendamping" class="form-control">
                    <span class="upload-icon"><i class="bi bi-file-earmark-check"></i></span>
                    <div>
                        <label for="file_pendamping" class="form-label">Pendamping Ijazah</label>
                        <span class="upload-hint">Klik atau seret file ke sini</span>
                    </div>
                    <span class="file-name"><i class="bi bi-paperclip"></i><span>Belum ada file dipilih</span></span>
                </div>

                <div class="upload-card">
                    <input type="file" id="transkrip" name="transkrip" class="form-control">
                    <span class="upload-icon"><i class="bi bi-file-earmark-bar-graph"></i></span>
                    <div>
                        <label for="transkrip" class="form-label">Transkrip Nilai</label>
                        <span class="upload-hint">Klik atau seret file ke sini</span>
                    </div>
                    <span class="file-name"><i class="bi bi-paperclip"></i><span>Belum ada file dipilih</span></span>
                </div>
            </div>

            <div class="form-actions reveal" style="--d:.4s">
                <p class="hint"><i class="bi bi-info-circle"></i> <span><span class="req" style="margin-left:0">*</span> wajib diisi. Pastikan seluruh data sudah benar sebelum disimpan.</span></p>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check2-circle me-1"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('jenjang').addEventListener('change', function () {
        const jenjang = this.value;
        const extraContainer = document.getElementById('extra-field-container');

        if (['S1', 'S2', 'S3', 'Prof'].includes(jenjang)) {
            extraContainer.style.display = 'flex';
        } else {
            extraContainer.style.display = 'none';
        }
    });

    // Tampilkan nama file yang dipilih pada kartu upload
    document.querySelectorAll('.upload-card').forEach(function (card) {
        const input = card.querySelector('input[type="file"]');
        const label = card.querySelector('.file-name span');
        const icon = card.querySelector('.file-name i');

        input.addEventListener('change', function () {
            if (this.files && this.files.length) {
                label.textContent = this.files[0].name;
                icon.className = 'bi bi-check-circle-fill';
                card.classList.add('has-file');
            } else {
                label.textContent = 'Belum ada file dipilih';
                icon.className = 'bi bi-paperclip';
                card.classList.remove('has-file');
            }
        });

        ['dragenter', 'dragover'].forEach(function (evt) {
            input.addEventListener(evt, function () { card.classList.add('drag'); });
        });
        ['dragleave', 'drop'].forEach(function (evt) {
            input.addEventListener(evt, function () { card.classList.remove('drag'); });
        });
    });

    // Menampilkan SweetAlert jika ada session success
    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#2f5bb7'
    });
    @endif
</script>
@endsection