@extends('layouts.app')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
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

    body {
        background:
            radial-gradient(900px 500px at 85% -5%, rgba(59, 130, 246, 0.35), transparent 60%),
            radial-gradient(700px 500px at -10% 40%, rgba(250, 204, 21, 0.10), transparent 60%),
            linear-gradient(180deg, #1a3a8f 0%, #0f2a6b 45%, #0a1a4a 100%);
        background-attachment: fixed;
        font-family: 'Poppins', 'Segoe UI', system-ui, sans-serif;
        color: var(--text);
        min-height: 100vh;
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

    h4 {
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
    .btn-primary svg,
    .file-lama svg,
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

    .form-control,
    .select-control {
        width: 100%;
        height: auto;
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

    .form-control:hover,
    .select-control:hover {
        border-color: #dbe5f7;
    }

    .form-control:focus,
    .select-control:focus {
        background-color: #fff;
        border-color: var(--blue);
        box-shadow: none;
        outline: none;
    }

    .form-control::placeholder {
        color: #9aa7ba;
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

    /* Input file bergaya dropzone */
    input[type="file"].form-control {
        padding: 10px 12px;
        cursor: pointer;
        font-size: 14px;
        background-color: #f8faff;
        border: 1.5px dashed #b9c8e8;
    }

    input[type="file"].form-control:hover {
        background-color: #eef3ff;
        border-color: var(--blue);
    }

    input[type="file"].form-control::file-selector-button {
        background: linear-gradient(135deg, #1e3a8a, #2563eb);
        color: #fff;
        border: none;
        border-radius: 8px;
        padding: 7px 16px;
        margin-right: 14px;
        font-family: inherit;
        font-weight: 600;
        cursor: pointer;
        transition: filter 0.2s ease;
    }

    input[type="file"].form-control::file-selector-button:hover {
        filter: brightness(1.12);
    }

    /* ===== Link file lama (chip dokumen) ===== */
    .file-lama {
        margin: 0 0 10px;
    }

    .file-lama .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #eef3ff;
        border: 1px solid #d3def9;
        color: var(--primary);
        border-radius: 12px;
        padding: 7px 14px;
        font-size: 13px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .file-lama .btn svg {
        width: 16px;
        height: 16px;
    }

    .file-lama .btn:hover {
        background: var(--primary);
        border-color: var(--primary);
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 8px 18px rgba(30, 58, 138, 0.25);
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

        h4 {
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
        }

        .hero-icon svg {
            width: 24px;
            height: 24px;
        }

        .hero-main {
            gap: 14px;
        }

        h4 {
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

        .form-control,
        .select-control {
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

        <a href="{{ route('pekerjaan') }}" class="btn-back" aria-label="Kembali">
            <span class="arrow">&#8592;</span> Kembali
        </a>

        <div class="hero-main">
            <span class="hero-icon">
                <svg viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2M2 13h20"/></svg>
            </span>
            <div>
                <h4>Edit Riwayat Pekerjaan</h4>
                <p class="form-subtitle">Perbarui data riwayat pekerjaan Anda dengan informasi terbaru.</p>
            </div>
        </div>
    </div>

    <div class="form-body">
        <form action="{{ route('pekerjaan.update', $pekerjaan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="section-title first reveal" style="--d:.05s"><span class="step">1</span> Data Jabatan</div>
            <div class="form-grid reveal" style="--d:.1s">
                <div class="form-group field">
                    <span class="field-icon">
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="6"/><path d="M15.5 13.5L17 22l-5-3-5 3 1.5-8.5"/></svg>
                    </span>
                    <div class="field-body">
                        <label for="pangkat">Pangkat</label>
                        <input type="text" id="pangkat" name="pangkat" class="form-control" value="{{ $pekerjaan->pangkat }}" required>
                    </div>
                </div>

                <div class="form-group field">
                    <span class="field-icon">
                        <svg viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
                    </span>
                    <div class="field-body">
                        <label for="jabatan">Jabatan</label>
                        <input type="text" id="jabatan" name="jabatan" class="form-control" value="{{ $pekerjaan->jabatan }}" required>
                    </div>
                </div>

                <div class="form-group field">
                    <span class="field-icon">
                        <svg viewBox="0 0 24 24"><rect x="4" y="2" width="16" height="20" rx="2"/><path d="M9 22v-4h6v4M8 6h.01M12 6h.01M16 6h.01M8 10h.01M12 10h.01M16 10h.01M8 14h.01M12 14h.01M16 14h.01"/></svg>
                    </span>
                    <div class="field-body">
                        <label for="unit_kerja">Unit Kerja</label>
                        <input type="text" id="unit_kerja" name="unit_kerja" class="form-control" value="{{ $pekerjaan->unit_kerja }}" required>
                    </div>
                </div>

                <div class="form-group field">
                    <span class="field-icon">
                        <svg viewBox="0 0 24 24"><rect x="9" y="2" width="6" height="5" rx="1"/><rect x="2" y="17" width="6" height="5" rx="1"/><rect x="16" y="17" width="6" height="5" rx="1"/><path d="M12 7v5M5 17v-5h14v5"/></svg>
                    </span>
                    <div class="field-body">
                        <label for="sub_bagian">Sub Bagian</label>
                        <input type="text" id="sub_bagian" name="sub_bagian" class="form-control" value="{{ $pekerjaan->sub_bagian }}">
                    </div>
                </div>

                <div class="form-group field full">
                    <span class="field-icon">
                        <svg viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><circle cx="8" cy="11" r="2"/><path d="M14 10h5M14 14h5M5 16.5c.6-1.6 4.4-1.6 6 0"/></svg>
                    </span>
                    <div class="field-body">
                        <label for="nip">NIP</label>
                        <input type="text" id="nip" name="nip" class="form-control" value="{{ $pekerjaan->nip }}" required>
                    </div>
                </div>
            </div>

            <div class="section-title reveal" style="--d:.15s"><span class="step">2</span> Surat Keputusan</div>
            <div class="form-grid reveal" style="--d:.2s">
                <div class="form-group field full">
                    <span class="field-icon">
                        <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M8 13h8M8 17h8"/></svg>
                    </span>
                    <div class="field-body">
                        <label for="nomor_sk">Nomor SK</label>
                        <input type="text" id="nomor_sk" name="nomor_sk" class="form-control" value="{{ $pekerjaan->nomor_sk }}" required>
                    </div>
                </div>

                <div class="form-group field">
                    <span class="field-icon">
                        <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                    </span>
                    <div class="field-body">
                        <label for="tanggal_sk">Tanggal SK</label>
                        <input type="date" id="tanggal_sk" name="tanggal_sk" class="form-control" value="{{ $pekerjaan->tanggal_sk }}" required>
                    </div>
                </div>

                <div class="form-group field">
                    <span class="field-icon">
                        <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18M9 16l2 2 4-4"/></svg>
                    </span>
                    <div class="field-body">
                        <label for="tmt_sk">TMT SK</label>
                        <input type="date" id="tmt_sk" name="tmt_sk" class="form-control" value="{{ $pekerjaan->tmt_sk }}" required>
                    </div>
                </div>

                <div class="form-group field full">
                    <span class="field-icon">
                        <svg viewBox="0 0 24 24"><path d="M17 1l4 4-4 4"/><path d="M3 11V9a4 4 0 0 1 4-4h14"/><path d="M7 23l-4-4 4-4"/><path d="M21 13v2a4 4 0 0 1-4 4H3"/></svg>
                    </span>
                    <div class="field-body">
                        <label for="mutasi">Mutasi</label>
                        <select name="mutasi" id="mutasi" class="form-control select-control">
                            <option value="">-- Pilih Mutasi --</option>
                            <option value="Mutasi Jabatan" {{ $pekerjaan->mutasi == 'Mutasi Jabatan' ? 'selected' : '' }}>Mutasi Jabatan</option>
                            <option value="Mutasi Tempat Tugas" {{ $pekerjaan->mutasi == 'Mutasi Tempat Tugas' ? 'selected' : '' }}>Mutasi Tempat Tugas</option>
                            <option value="Mutasi Antar Instansi" {{ $pekerjaan->mutasi == 'Mutasi Antar Instansi' ? 'selected' : '' }}>Mutasi Antar Instansi</option>
                            <option value="Mutasi Kenaikan Pangkat" {{ $pekerjaan->mutasi == 'Mutasi Kenaikan Pangkat' ? 'selected' : '' }}>Mutasi Kenaikan Pangkat</option>
                            <option value="Mutasi Penyesuaian Organisasi" {{ $pekerjaan->mutasi == 'Mutasi Penyesuaian Organisasi' ? 'selected' : '' }}>Mutasi Penyesuaian Organisasi</option>
                            <option value="Mutasi Sementara" {{ $pekerjaan->mutasi == 'Mutasi Sementara' ? 'selected' : '' }}>Mutasi Sementara</option>
                            <option value="Tidak Mutasi" {{ $pekerjaan->mutasi == 'Tidak Mutasi' ? 'selected' : '' }}>Tidak Mutasi</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="section-title reveal" style="--d:.25s"><span class="step">3</span> Dokumen</div>
            <div class="form-grid reveal" style="--d:.3s">
                <div class="form-group field full">
                    <span class="field-icon">
                        <svg viewBox="0 0 24 24"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"/></svg>
                    </span>
                    <div class="field-body">
                        <label for="file_sk">File SK (PDF)</label>
                        @if($pekerjaan->file_sk)
                            <p class="file-lama">
                                <a href="{{ asset('storage/' . $pekerjaan->file_sk) }}" target="_blank" class="btn btn-sm btn-info">
                                    <svg viewBox="0 0 24 24"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"/></svg>
                                    Lihat File Lama
                                </a>
                            </p>
                        @endif
                        <input type="file" name="file_sk" id="file_sk" class="form-control">
                    </div>
                </div>
            </div>

            <div class="button-container reveal" style="--d:.35s">
                <p class="form-hint">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
                    Pastikan seluruh data sudah benar sebelum disimpan.
                </p>
                <button type="submit" class="btn btn-primary">
                    <svg viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><path d="M17 21v-8H7v8M7 3v5h8"/></svg>
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

@endsection