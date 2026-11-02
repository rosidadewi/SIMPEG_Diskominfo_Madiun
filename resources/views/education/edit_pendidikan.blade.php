@extends('layouts.app')

@section('content')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* Warna latar halaman (sama dengan halaman Riwayat Pendidikan) */
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
        width: calc(100% - 32px);
        max-width: 920px;
        background-color: #ffffff;
        border-radius: 30px;
        box-shadow: 0 30px 70px rgba(4, 12, 40, 0.5), 0 2px 8px rgba(4, 12, 40, 0.15);
        margin: 40px auto;
        position: relative;
        z-index: 1;
        overflow: hidden;
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

    .btn-back {
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

    .btn-back .arrow {
        font-size: 17px;
        transition: transform 0.25s ease;
    }

    .btn-back:hover {
        background: #fff;
        color: var(--primary);
        text-decoration: none;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .btn-back:hover .arrow {
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
        border-bottom: 4px solid var(--accent);
        box-shadow: 0 12px 28px rgba(0, 0, 0, 0.25);
    }

    .hero-icon svg {
        width: 30px;
        height: 30px;
        fill: none;
        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .hero-main h4 {
        font-weight: 700;
        color: #fff;
        font-size: 26px;
        margin: 0;
        letter-spacing: -0.3px;
        line-height: 1.25;
        border: none;
        padding: 0;
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
    .section-title {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 34px 0 16px;
        font-size: 15px;
        font-weight: 700;
        color: var(--navy);
    }

    .section-title.first {
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

    .section-title::after {
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

    .form-group {
        margin: 0;
        min-width: 0;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    /* Tile field (ikon + label + isi) */
    .field {
        display: flex;
        align-items: center;
        gap: 14px;
        background: #ffffff;
        border: 1.5px solid var(--tile-border);
        border-radius: 18px;
        padding: 14px 16px;
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
        transition: border-color 0.25s ease, box-shadow 0.25s ease, transform 0.25s ease;
    }

    .field:hover {
        border-color: #cbd9f3;
        box-shadow: 0 8px 22px rgba(30, 58, 138, 0.09);
        transform: translateY(-2px);
    }

    .field:focus-within {
        border-color: var(--blue);
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15), 0 10px 26px rgba(30, 58, 138, 0.12);
        transform: translateY(-2px);
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
        transition: all 0.25s ease;
    }

    .field:focus-within .field-icon {
        background: linear-gradient(135deg, #1e3a8a, #3b82f6);
        color: #fff;
        box-shadow: 0 8px 18px rgba(37, 99, 235, 0.35);
    }

    .field-icon svg,
    .upload-icon svg,
    .upload-file svg,
    .btn-primary svg,
    .form-hint svg {
        width: 20px;
        height: 20px;
        fill: none;
        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
        flex-shrink: 0;
    }

    .field-body {
        flex: 1;
        min-width: 0;
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        font-size: 11px;
        font-weight: 600;
        letter-spacing: 0.09em;
        text-transform: uppercase;
        color: var(--muted);
        margin: 0 0 5px;
    }

    .req {
        margin-left: 3px;
        font-weight: 700;
        color: #ef4444;
    }

    .form-control {
        width: 100%;
        height: auto;
        min-height: 0;
        background-color: var(--tile-bg);
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

    .form-control:hover {
        border-color: #dbe5f7;
    }

    .form-control:focus {
        background-color: #fff;
        border-color: var(--blue);
        box-shadow: none;
        outline: none;
    }

    .form-control::placeholder {
        color: #9aa7ba;
        opacity: 1;
    }

    .form-control:disabled,
    .form-control[readonly] {
        opacity: 0.7;
        cursor: not-allowed;
    }

    select.form-control {
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2.5' stroke-linecap='round' stroke-linejoin='round'><polyline points='6 9 12 15 18 9'/></svg>");
        background-repeat: no-repeat;
        background-position: right 12px center;
        padding-right: 38px;
        cursor: pointer;
    }

    /* ===== Panel Detail Pendidikan Tinggi ===== */
    #extra-field-container {
        position: relative;
        flex-wrap: wrap;
        gap: 14px;
        margin: 30px 0 16px;
        padding: 26px 18px 18px;
        background: #f0f5fd;
        border: 1.5px solid #dbe6f7;
        border-radius: 22px;
    }

    #extra-field-container .panel-badge {
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

    #extra-field-container .form-group {
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
        height: 100%;
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
        border-color: var(--primary-2);
    }

    .upload-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 46px;
        height: 46px;
        color: var(--primary-2);
        background: #fff;
        border-bottom: 3px solid var(--accent);
        border-radius: 14px;
        box-shadow: 0 5px 12px rgba(30, 58, 138, 0.12);
    }

    .upload-card .upload-title {
        display: block;
        margin: 12px 0 4px;
        font-size: 14px;
        font-weight: 700;
        letter-spacing: 0;
        text-transform: none;
        color: var(--navy);
    }

    .upload-hint {
        display: block;
        margin-bottom: 12px;
        font-size: 12px;
        line-height: 1.5;
        color: var(--muted);
    }

    .upload-file {
        display: flex;
        align-items: center;
        gap: 8px;
        min-width: 0;
        padding: 8px 12px;
        font-size: 12px;
        line-height: 1.5;
        color: var(--muted);
        background: #fff;
        border-radius: 11px;
    }

    .upload-file svg {
        width: 15px;
        height: 15px;
    }

    .upload-file span {
        min-width: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .upload-card.has-file .upload-file {
        font-weight: 600;
        color: var(--primary);
    }

    /* Input file menutupi seluruh kartu (klik atau seret file) */
    .upload-card input[type="file"].form-control {
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
    .button-container {
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

    .form-hint {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
        font-size: 13px;
        color: var(--muted);
    }

    .form-hint svg {
        width: 18px;
        height: 18px;
        color: var(--primary-2);
    }

    .btn-primary {
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

    .btn-primary::after {
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

    .btn-primary:hover,
    .btn-primary:focus {
        background: linear-gradient(135deg, #12c08c, #047857);
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 14px 30px rgba(16, 185, 129, 0.48);
    }

    .btn-primary:hover::after {
        left: 130%;
    }

    .btn-primary:active {
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

        .upload-grid {
            grid-template-columns: 1fr;
        }

        #extra-field-container .form-group {
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
        }

        .hero-icon svg {
            width: 24px;
            height: 24px;
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

        .section-title {
            margin: 28px 0 14px;
            font-size: 14px;
        }

        .form-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .field {
            padding: 12px;
            gap: 12px;
            border-radius: 16px;
        }

        .field-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
        }

        #extra-field-container {
            padding: 24px 12px 12px;
            gap: 12px;
        }

        .form-control {
            font-size: 16px; /* mencegah zoom otomatis di iOS */
        }

        .button-container {
            flex-direction: column;
            align-items: stretch;
            padding: 16px;
        }

        .form-hint {
            justify-content: center;
            text-align: center;
        }

        .btn-primary {
            width: 100%;
        }
    }
</style>

<div class="small-container">
    <div class="form-hero">
        <span class="hero-dots"></span>

        <a href="{{ route('pendidikan') }}" class="btn-back" aria-label="Kembali">
            <span class="arrow">&#8592;</span> Kembali
        </a>

        <div class="hero-main">
            <span class="hero-icon">
                <svg viewBox="0 0 24 24"><path d="M22 10L12 5 2 10l10 5 10-5z"/><path d="M6 12v5c0 1.5 2.7 3 6 3s6-1.5 6-3v-5"/><path d="M22 10v6"/></svg>
            </span>
            <div>
                <h4>Edit Data Pendidikan</h4>
                <p class="form-subtitle">Perbarui data riwayat pendidikan beserta dokumen pendukung.</p>
            </div>
        </div>
    </div>

    <div class="form-body">
        <form action="{{ route('pendidikan.update', $pendidikan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="section-title first reveal" style="--d:.05s"><span class="step">1</span> Data Institusi</div>
            <div class="form-grid reveal" style="--d:.1s">
                <div class="form-group field">
                    <span class="field-icon">
                        <svg viewBox="0 0 24 24"><path d="M22 10L12 5 2 10l10 5 10-5z"/><path d="M6 12v5c0 1.5 2.7 3 6 3s6-1.5 6-3v-5"/></svg>
                    </span>
                    <div class="field-body">
                        <label for="jenjang">Jenjang Pendidikan <span class="req">*</span></label>
                        <select id="jenjang" name="jenjang" class="form-control" required>
                            <option value="">-- Pilih Jenjang --</option>
                            <option value="SMA/SMK" {{ $pendidikan->jenjang == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                            <option value="S1" {{ $pendidikan->jenjang == 'S1' ? 'selected' : '' }}>S1</option>
                            <option value="S2" {{ $pendidikan->jenjang == 'S2' ? 'selected' : '' }}>S2</option>
                            <option value="S3" {{ $pendidikan->jenjang == 'S3' ? 'selected' : '' }}>S3</option>
                            <option value="Prof" {{ $pendidikan->jenjang == 'Prof' ? 'selected' : '' }}>Profesi</option>
                        </select>
                    </div>
                </div>

                <div class="form-group field">
                    <span class="field-icon">
                        <svg viewBox="0 0 24 24"><rect x="4" y="2" width="16" height="20" rx="2"/><path d="M9 22v-4h6v4M8 6h.01M12 6h.01M16 6h.01M8 10h.01M12 10h.01M16 10h.01M8 14h.01M12 14h.01M16 14h.01"/></svg>
                    </span>
                    <div class="field-body">
                        <label for="institusi">Nama Institusi <span class="req">*</span></label>
                        <input type="text" id="institusi" name="institusi" class="form-control" placeholder="Contoh: Universitas Indonesia" value="{{ $pendidikan->institusi }}" required>
                    </div>
                </div>
            </div>

            <div id="extra-field-container" class="reveal" style="display: none; --d:.15s">
                <span class="panel-badge">Detail Pendidikan Tinggi</span>

                <div class="form-group field">
                    <span class="field-icon">
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
                    </span>
                    <div class="field-body">
                        <label for="lulusan">Lulusan</label>
                        <select name="lulusan" id="lulusan" class="form-control">
                            <option value="Dalam Negeri" {{ $pendidikan->lulusan == 'Dalam Negeri' ? 'selected' : '' }}>Dalam Negeri</option>
                            <option value="Luar Negeri" {{ $pendidikan->lulusan == 'Luar Negeri' ? 'selected' : '' }}>Luar Negeri</option>
                        </select>
                    </div>
                </div>

                <div class="form-group field">
                    <span class="field-icon">
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="6"/><path d="M15.5 13.5L17 22l-5-3-5 3 1.5-8.5"/></svg>
                    </span>
                    <div class="field-body">
                        <label for="gelar">Gelar Pendidikan</label>
                        <input type="text" id="gelar" name="gelar" class="form-control" placeholder="Contoh: S.Kom." value="{{ $pendidikan->gelar }}">
                    </div>
                </div>

                <div class="form-group field">
                    <span class="field-icon">
                        <svg viewBox="0 0 24 24"><path d="M2 4h6a4 4 0 0 1 4 4v13a3 3 0 0 0-3-3H2z"/><path d="M22 4h-6a4 4 0 0 0-4 4v13a3 3 0 0 1 3-3h7z"/></svg>
                    </span>
                    <div class="field-body">
                        <label for="bidang_ilmu">Bidang Ilmu</label>
                        <input type="text" id="bidang_ilmu" name="bidang_ilmu" class="form-control" placeholder="Contoh: Teknologi Informasi" value="{{ $pendidikan->bidang_ilmu }}">
                    </div>
                </div>
            </div>

            <div class="form-grid reveal" style="--d:.2s">
                <div class="form-group field">
                    <span class="field-icon">
                        <svg viewBox="0 0 24 24"><rect x="9" y="2" width="6" height="5" rx="1"/><rect x="2" y="17" width="6" height="5" rx="1"/><rect x="16" y="17" width="6" height="5" rx="1"/><path d="M12 7v5M5 17v-5h14v5"/></svg>
                    </span>
                    <div class="field-body">
                        <label for="jurusan">Jurusan <span class="req">*</span></label>
                        <input type="text" id="jurusan" name="jurusan" class="form-control" placeholder="Nama jurusan / program studi" value="{{ $pendidikan->jurusan }}" required>
                    </div>
                </div>

                <div class="form-group field">
                    <span class="field-icon">
                        <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </span>
                    <div class="field-body">
                        <label for="alamat_institusi">Alamat Institusi <span class="req">*</span></label>
                        <input type="text" id="alamat_institusi" name="alamat_institusi" class="form-control" placeholder="Kota, provinsi" value="{{ $pendidikan->alamat_institusi }}" required>
                    </div>
                </div>
            </div>

            <div class="section-title reveal" style="--d:.25s"><span class="step">2</span> Ijazah &amp; Periode</div>
            <div class="form-grid reveal" style="--d:.3s">
                <div class="form-group field full">
                    <span class="field-icon">
                        <svg viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><circle cx="8" cy="11" r="2"/><path d="M14 10h5M14 14h5M5 16.5c.6-1.6 4.4-1.6 6 0"/></svg>
                    </span>
                    <div class="field-body">
                        <label for="no_ijazah">No Ijazah <span class="req">*</span></label>
                        <input type="text" id="no_ijazah" name="no_ijazah" class="form-control" placeholder="Nomor seri ijazah" value="{{ $pendidikan->no_ijazah }}" required>
                    </div>
                </div>

                <div class="form-group field">
                    <span class="field-icon">
                        <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                    </span>
                    <div class="field-body">
                        <label for="tanggal_masuk">Tanggal Masuk <span class="req">*</span></label>
                        <input type="date" id="tanggal_masuk" name="tanggal_masuk" class="form-control" value="{{ $pendidikan->tanggal_masuk }}" required>
                    </div>
                </div>

                <div class="form-group field">
                    <span class="field-icon">
                        <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18M9 16l2 2 4-4"/></svg>
                    </span>
                    <div class="field-body">
                        <label for="tanggal_lulus">Tanggal Lulus <span class="req">*</span></label>
                        <input type="date" id="tanggal_lulus" name="tanggal_lulus" class="form-control" value="{{ $pendidikan->tanggal_lulus }}" required>
                    </div>
                </div>
            </div>

            <div class="section-title reveal" style="--d:.35s"><span class="step">3</span> Dokumen</div>
            <div class="upload-grid reveal" style="--d:.4s">
                <div class="upload-card">
                    <span class="upload-icon"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M8 13h8M8 17h8"/></svg></span>
                    <label for="ijazah" class="form-label upload-title">Upload Ijazah</label>
                    <span class="upload-hint">Klik atau seret file ke sini</span>
                    <div class="upload-file"><svg viewBox="0 0 24 24"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"/></svg><span>Belum ada file baru dipilih</span></div>
                    <input type="file" id="ijazah" name="ijazah" class="form-control">
                </div>

                <div class="upload-card">
                    <span class="upload-icon"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M9 15l2 2 4-4"/></svg></span>
                    <label for="file_pendamping" class="form-label upload-title">Pendamping Ijazah</label>
                    <span class="upload-hint">Klik atau seret file ke sini</span>
                    <div class="upload-file"><svg viewBox="0 0 24 24"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"/></svg><span>Belum ada file baru dipilih</span></div>
                    <input type="file" id="file_pendamping" name="file_pendamping" class="form-control">
                </div>

                <div class="upload-card">
                    <span class="upload-icon"><svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M8 18v-3M12 18v-6M16 18v-4"/></svg></span>
                    <label for="transkrip" class="form-label upload-title">Transkrip Nilai</label>
                    <span class="upload-hint">Klik atau seret file ke sini</span>
                    <div class="upload-file"><svg viewBox="0 0 24 24"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"/></svg><span>Belum ada file baru dipilih</span></div>
                    <input type="file" id="transkrip" name="transkrip" class="form-control">
                </div>
            </div>

            <div class="button-container reveal" style="--d:.45s">
                <p class="form-hint">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
                    <span><span class="req" style="margin-left:0">*</span> wajib diisi. Pastikan seluruh data sudah benar sebelum disimpan.</span>
                </p>
                <button type="submit" class="btn btn-primary">
                    <svg viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><path d="M17 21v-8H7v8M7 3v5h8"/></svg>
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function handleJenjangFieldControl(jenjang) {
        const extraContainer = document.getElementById('extra-field-container');
        const lulusan = document.getElementById('lulusan');
        const gelar = document.getElementById('gelar');
        const bidang = document.getElementById('bidang_ilmu');

        if (['S1', 'S2', 'S3', 'Prof'].includes(jenjang)) {
            extraContainer.style.display = 'flex';
            lulusan.disabled = false;
            gelar.readOnly = false;
            bidang.readOnly = false;
        } else {
            extraContainer.style.display = 'none';
            lulusan.disabled = true;
            gelar.readOnly = true;
            bidang.readOnly = true;

            lulusan.value = '';
            gelar.value = '';
            bidang.value = '';
        }
    }

    document.getElementById('jenjang').addEventListener('change', function () {
        handleJenjangFieldControl(this.value);
    });

    document.addEventListener('DOMContentLoaded', function () {
        handleJenjangFieldControl(document.getElementById('jenjang').value);
    });
</script>

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