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

    .field.field-top {
        align-items: flex-start;
    }

    .field.field-top .field-icon {
        margin-top: 2px;
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

    .form-group label .opt {
        font-weight: 500;
        letter-spacing: 0.02em;
        text-transform: none;
        color: #94a3b8;
    }

    .form-control {
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
    }

    textarea.form-control {
        min-height: 96px;
        resize: vertical;
        line-height: 1.5;
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

        <a href="{{ route('datadiri') }}" class="btn-back" aria-label="Kembali">
            <span class="arrow">&#8592;</span> Kembali
        </a>

        <div class="hero-main">
            <span class="hero-icon">
                <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
            </span>
            <div>
                <h4>Edit Data Diri</h4>
                <p class="form-subtitle">Perbarui data diri Anda dengan informasi terbaru.</p>
            </div>
        </div>
    </div>

    <div class="form-body">
        <form action="{{ route('datadiri.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="section-title first reveal" style="--d:.05s"><span class="step">1</span> Data Pribadi</div>
            <div class="form-grid reveal" style="--d:.1s">
                <div class="form-group field full">
                    <span class="field-icon">
                        <svg viewBox="0 0 24 24"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    </span>
                    <div class="field-body">
                        <label for="name">Nama</label>
                        <input id="name" name="name" class="form-control" value="{{ $user->name }}">
                    </div>
                </div>

                <div class="form-group field">
                    <span class="field-icon">
                        <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    </span>
                    <div class="field-body">
                        <label for="birth_place">Tempat Lahir</label>
                        <input id="birth_place" name="birth_place" class="form-control" value="{{ $user->birth_place }}">
                    </div>
                </div>

                <div class="form-group field">
                    <span class="field-icon">
                        <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                    </span>
                    <div class="field-body">
                        <label for="birth_date">Tanggal Lahir</label>
                        <input type="date" id="birth_date" name="birth_date" class="form-control" value="{{ $user->birth_date ? \Carbon\Carbon::parse($user->birth_date)->format('Y-m-d') : '' }}">
                    </div>
                </div>

                <div class="form-group field field-top full">
                    <span class="field-icon">
                        <svg viewBox="0 0 24 24"><path d="M3 11l9-8 9 8"/><path d="M5 10v10a1 1 0 0 0 1 1h4v-6h4v6h4a1 1 0 0 0 1-1V10"/></svg>
                    </span>
                    <div class="field-body">
                        <label for="address">Alamat</label>
                        <textarea id="address" name="address" class="form-control">{{ $user->address }}</textarea>
                    </div>
                </div>

                <div class="form-group field">
                    <span class="field-icon">
                        <svg viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.8 19.8 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                    </span>
                    <div class="field-body">
                        <label for="nomor_telepon">Nomor Telepon</label>
                        <input id="nomor_telepon" name="nomor_telepon" class="form-control" value="{{ $user->nomor_telepon }}">
                    </div>
                </div>

                <div class="form-group field">
                    <span class="field-icon">
                        <svg viewBox="0 0 24 24"><path d="M2 4h6a4 4 0 0 1 4 4v13a3 3 0 0 0-3-3H2z"/><path d="M22 4h-6a4 4 0 0 0-4 4v13a3 3 0 0 1 3-3h7z"/></svg>
                    </span>
                    <div class="field-body">
                        <label for="religion">Agama</label>
                        <input id="religion" name="religion" class="form-control" value="{{ $user->religion }}">
                    </div>
                </div>
            </div>

            <div class="section-title reveal" style="--d:.15s"><span class="step">2</span> Dokumen</div>
            <div class="form-grid reveal" style="--d:.2s">
                <div class="form-group field">
                    <span class="field-icon">
                        <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
                    </span>
                    <div class="field-body">
                        <label for="photo">Foto <span class="opt">(Opsional)</span></label>
                        <input type="file" id="photo" name="photo" class="form-control">
                    </div>
                </div>

                <div class="form-group field">
                    <span class="field-icon">
                        <svg viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><circle cx="8" cy="11" r="2"/><path d="M14 10h5M14 14h5M5 16.5c.6-1.6 4.4-1.6 6 0"/></svg>
                    </span>
                    <div class="field-body">
                        <label for="ktp">KTP <span class="opt">(Opsional)</span></label>
                        <input type="file" id="ktp" name="ktp" class="form-control">
                    </div>
                </div>

                <div class="form-group field full">
                    <span class="field-icon">
                        <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M8 13h8M8 17h8"/></svg>
                    </span>
                    <div class="field-body">
                        <label for="kk">KK <span class="opt">(Opsional)</span></label>
                        <input type="file" id="kk" name="kk" class="form-control">
                    </div>
                </div>
            </div>

            <div class="button-container reveal" style="--d:.25s">
                <p class="form-hint">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 16v-4M12 8h.01"/></svg>
                    Pastikan seluruh data sudah benar sebelum disimpan.
                </p>
                <button type="submit" class="btn btn-primary">
                    <svg viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><path d="M17 21v-8H7v8M7 3v5h8"/></svg>
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection