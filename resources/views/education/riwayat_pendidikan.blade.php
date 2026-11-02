@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* Warna latar halaman (sama dengan halaman Data Diri) */
    body {
        background:
            radial-gradient(circle at 92% 38%, rgba(31, 82, 190, 0.45), transparent 46%),
            radial-gradient(circle at 6% 72%, rgba(12, 74, 118, 0.70), transparent 46%),
            linear-gradient(180deg, #0a1a47 0%, #0b1f50 45%, #0a1636 100%) !important;
        background-attachment: fixed !important;
        background-color: #0a1a47 !important;
    }

    .edu-page {
        --primary: #2f5bb7;
        --primary-dark: #234693;
        --primary-rgb: 47, 91, 183;
        --primary-soft: #e8f0fd;
        --accent: #5b9df0;
        --yellow: #ffd21f;
        --text: #2b3a44;
        --muted: #64748b;
        --border: #e3eaf3;
        --field-bg: #f6f8fc;

        position: relative;
        width: 100%;
        max-width: 1000px;
        margin: -18px auto 60px;
        padding: 0 16px;
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        color: var(--text);
    }

    .edu-page *,
    .edu-page *::before,
    .edu-page *::after {
        box-sizing: border-box;
    }

    /* ---------- Header halaman ---------- */
    .header-bar {
        position: relative;
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 26px;
        padding: 22px 28px;
        background: #fff;
        border-radius: 28px;
        box-shadow: 0 18px 40px rgba(2, 10, 40, 0.35);
        overflow: hidden;
        animation: riseIn 0.5s cubic-bezier(.2, .8, .2, 1) both;
    }

    .header-bar::before {
        content: "";
        position: absolute;
        top: 0;
        left: 8%;
        right: 8%;
        height: 4px;
        border-radius: 0 0 6px 6px;
        background: linear-gradient(90deg, transparent, var(--primary), var(--accent), var(--yellow), transparent);
    }

    .header-title {
        display: flex;
        align-items: center;
        gap: 16px;
        min-width: 0;
    }

    .header-icon {
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 56px;
        height: 56px;
        font-size: 26px;
        color: var(--primary);
        background: var(--primary-soft);
        border-radius: 18px;
        box-shadow: inset 0 -4px 0 var(--yellow), 0 8px 20px rgba(var(--primary-rgb), 0.18);
    }

    .header-bar h4 {
        margin: 0 0 2px;
        font-weight: 800;
        font-size: 1.45rem;
        letter-spacing: -0.01em;
        color: #14264f;
    }

    .header-bar p {
        margin: 0;
        font-size: 0.9rem;
        color: var(--muted);
    }

    /* ---------- Tombol ---------- */
    .edu-page .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 22px;
        font-weight: 700;
        font-size: 0.92rem;
        border: none;
        border-radius: 12px;
        text-decoration: none;
        transition: transform 0.2s ease, box-shadow 0.2s ease, opacity 0.2s ease;
    }

    .edu-page .btn:hover { transform: translateY(-2px); }
    .edu-page .btn:active { transform: translateY(0); }

    .edu-page .btn-success {
        color: #fff;
        background: linear-gradient(135deg, #10b981, #059669);
        box-shadow: 0 8px 18px rgba(16, 185, 129, 0.32);
    }

    .edu-page .btn-warning {
        color: #3b2a00;
        background: linear-gradient(135deg, #ffd21f, #f5a30a);
        box-shadow: 0 8px 18px rgba(245, 163, 10, 0.32);
    }

    .edu-page .btn-danger {
        color: #fff;
        background: linear-gradient(135deg, #ef4444, #dc2626);
        box-shadow: 0 8px 18px rgba(239, 68, 68, 0.30);
    }

    .edu-page .btn-sm {
        padding: 7px 14px;
        font-size: 0.82rem;
        border-radius: 10px;
    }

    .edu-page .btn-success:hover,
    .edu-page .btn-warning:hover,
    .edu-page .btn-danger:hover {
        opacity: 0.95;
    }

    /* ---------- Kartu pendidikan ---------- */
    .edu-card {
        position: relative;
        margin-bottom: 26px;
        padding: 28px clamp(18px, 4vw, 34px) 26px;
        background: #fff;
        border-radius: 26px;
        box-shadow: 0 18px 40px rgba(2, 10, 40, 0.35);
        overflow: hidden;
        animation: riseIn 0.55s cubic-bezier(.2, .8, .2, 1) both;
    }

    .edu-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #26469a, #5b9df0 70%, var(--yellow));
    }

    .edu-head {
        display: flex;
        align-items: center;
        gap: 18px;
        margin-bottom: 24px;
        padding-bottom: 22px;
        border-bottom: 1px dashed var(--border);
    }

    .jenjang-badge {
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-width: 74px;
        height: 74px;
        padding: 0 12px;
        color: var(--yellow);
        background: linear-gradient(135deg, #26469a, #4a80dc);
        border-bottom: 4px solid var(--yellow);
        border-radius: 20px;
        box-shadow: 0 10px 22px rgba(var(--primary-rgb), 0.35);
        text-align: center;
    }

    .jenjang-badge small {
        font-size: 0.58rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.8);
    }

    .jenjang-badge strong {
        font-size: 1.15rem;
        font-weight: 800;
        line-height: 1.2;
        white-space: nowrap;
    }

    .edu-title { min-width: 0; }

    .eyebrow {
        display: block;
        margin-bottom: 2px;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--muted);
    }

    .edu-title h3 {
        margin: 0;
        font-size: 1.35rem;
        font-weight: 800;
        line-height: 1.3;
        color: #14264f;
        word-break: break-word;
    }

    /* ---------- Info ---------- */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 14px;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 0;
        padding: 13px 16px;
        background: var(--field-bg);
        border: 1px solid var(--border);
        border-radius: 16px;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .info-item:hover {
        border-color: #c3d6f3;
        box-shadow: 0 6px 16px rgba(var(--primary-rgb), 0.08);
    }

    .info-item.wide { grid-column: 1 / -1; }

    .info-icon {
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        font-size: 18px;
        color: var(--primary);
        background: var(--primary-soft);
        border-radius: 12px;
    }

    .info-body { min-width: 0; }

    .info-label {
        display: block;
        margin-bottom: 1px;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--muted);
    }

    .info-value {
        font-size: 0.98rem;
        font-weight: 700;
        color: var(--text);
        word-break: break-word;
    }

    /* ---------- Dokumen ---------- */
    .doc-section { margin-top: 26px; }

    .section-title {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 0 0 14px;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--primary);
    }

    .section-title::before {
        content: "";
        width: 5px;
        height: 18px;
        border-radius: 4px;
        background: linear-gradient(180deg, var(--primary), var(--yellow));
    }

    .section-title::after {
        content: "";
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, var(--border), transparent);
    }

    .doc-list {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .edu-page .info-link {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 11px 18px;
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--primary);
        background: var(--primary-soft);
        border: 1.5px solid #cfdcf3;
        border-radius: 14px;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .edu-page .info-link i { font-size: 1.05rem; }

    .edu-page .info-link:hover {
        color: #fff;
        background: var(--primary);
        border-color: var(--primary);
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(var(--primary-rgb), 0.28);
        text-decoration: none;
    }

    .doc-name {
        display: block;
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        opacity: 0.75;
    }

    .doc-text { display: flex; flex-direction: column; line-height: 1.25; }

    /* ---------- Aksi ---------- */
    .button-group-bottom {
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
        gap: 14px;
        margin-top: 26px;
    }

    .button-group-bottom.card-actions {
        justify-content: flex-end;
        padding-top: 22px;
        border-top: 1px dashed var(--border);
    }

    .button-group-bottom form.inline { display: inline-flex; margin: 0; }

    .edu-page .page-actions { margin-top: 8px; }

    /* ---------- Kosong ---------- */
    .edu-page .alert {
        display: flex;
        align-items: center;
        gap: 14px;
        margin: 0 0 26px;
        padding: 22px 26px;
        font-weight: 600;
        color: #1e3a8a;
        background: #fff;
        border: none;
        border-left: 6px solid var(--yellow);
        border-radius: 20px;
        box-shadow: 0 18px 40px rgba(2, 10, 40, 0.35);
    }

    .edu-page .alert i {
        font-size: 1.6rem;
        color: var(--primary);
    }

    /* ---------- Modal ---------- */
    .edu-page .modal-content {
        position: relative;
        padding: 1.5rem !important;
        border: none;
        border-radius: 20px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 30px 70px rgba(2, 10, 40, 0.45);
    }

    /* Garis aksen biru di atas modal */
    .edu-page .modal-content::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, transparent, #2f5bb7 15%, #5b9df0 85%, transparent);
    }

    .edu-page .modal-content h5 {
        font-size: 1.25rem;
        font-weight: 800;
        letter-spacing: -0.01em;
        color: #14264f;
    }

    .edu-page .modal-content > .d-flex {
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 1rem !important;
    }

    .edu-page .modal-tools .btn-sm {
        padding: 5px 12px;
        font-size: 0.875rem;
        border-radius: 8px;
    }

    .modal-tools {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Tombol close (X) pada preview */
    .edu-page .modal-close {
        flex-shrink: 0;
        width: 44px;
        height: 44px;
        padding: 0;
        margin: 0;
        opacity: 1;
        background-color: #e8eefc;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='none' stroke='%2314264f' stroke-width='2.4' stroke-linecap='round'%3E%3Cpath d='m3.5 3.5 9 9m0-9-9 9'/%3E%3C/svg%3E");
        background-size: 16px;
        background-position: center;
        background-repeat: no-repeat;
        border: 0;
        border-radius: 50%;
        transition: background-color 0.2s ease, transform 0.2s ease;
    }

    .edu-page .modal-close:hover {
        background-color: #d6e2fb;
        transform: scale(1.06);
    }

    .edu-page .modal-close:focus {
        box-shadow: 0 0 0 4px rgba(var(--primary-rgb), 0.18);
    }

    /* Bingkai preview gelap, sama seperti viewer PDF */
    .modal-img {
        display: block;
        width: 100%;
        height: auto;
        max-height: 70vh;
        object-fit: contain;
        padding: 10px;
        background: #2b2b30;
        border: 0;
        border-radius: 20px;
    }

    .modal-pdf {
        display: block;
        width: 100%;
        height: 70vh;
        background: #2b2b30;
        border: 0;
        border-radius: 20px;
    }

    .preview-fallback {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        padding: 36px 20px;
        text-align: center;
        color: var(--muted);
        background: var(--field-bg);
        border: 1.5px dashed #c3d6f3;
        border-radius: 16px;
    }

    .preview-fallback i {
        font-size: 2.6rem;
        color: var(--primary);
    }

    .preview-fallback p { margin: 0; font-weight: 600; }

    @media (max-width: 576px) {
        .modal-pdf { height: 60vh; border-radius: 16px; }
        .modal-img { border-radius: 16px; padding: 6px; }
        .edu-page .modal-content { padding: 1.1rem !important; }
        .edu-page .modal-content h5 { font-size: 1.1rem; }
        .edu-page .modal-close { width: 40px; height: 40px; background-size: 14px; }
        .edu-page .modal-tools .btn-sm { padding: 5px 10px; font-size: 0.8rem; }
    }

    @keyframes riseIn {
        from { opacity: 0; transform: translateY(22px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @media (prefers-reduced-motion: reduce) {
        .edu-page *,
        .edu-page *::before,
        .edu-page *::after {
            animation: none !important;
            transition: none !important;
        }
    }

    @media (max-width: 576px) {
        .edu-page { padding: 0 12px; margin-top: 0; }
        .header-bar { padding: 20px; border-radius: 22px; }
        .header-title { gap: 12px; }
        .header-icon { width: 48px; height: 48px; font-size: 22px; border-radius: 15px; }
        .header-bar h4 { font-size: 1.2rem; }
        .header-bar .btn { width: 100%; }
        .edu-card { border-radius: 22px; }
        .edu-head { gap: 14px; }
        .jenjang-badge { min-width: 62px; height: 62px; border-radius: 17px; }
        .jenjang-badge strong { font-size: 1rem; }
        .edu-title h3 { font-size: 1.15rem; }
        .info-grid { grid-template-columns: 1fr; }
        .doc-list .info-link { flex: 1 1 100%; }
        .button-group-bottom .btn,
        .button-group-bottom form.inline { flex: 1 1 100%; }
        .button-group-bottom form.inline .btn { width: 100%; }
    }

    /* ---------- SweetAlert konfirmasi hapus ---------- */
    .swal-hapus-container.swal2-container.swal2-backdrop-show,
    .swal-hapus-container.swal2-container {
        background: rgba(4, 12, 40, 0.55) !important;
        -webkit-backdrop-filter: blur(6px);
        backdrop-filter: blur(6px);
    }

    .swal-hapus-popup.swal2-popup {
        position: relative;
        width: 100%;
        max-width: 440px;
        padding: 2.4rem 1.8rem 1.8rem;
        overflow: hidden;
        background: #fff;
        border-radius: 28px;
        box-shadow: 0 30px 70px rgba(2, 10, 40, 0.45);
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
    }

    /* Garis aksen merah di atas */
    .swal-hapus-popup.swal2-popup::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 8px;
        background: linear-gradient(90deg, #f43f5e, #dc2626 60%, #f97316);
    }

    /* Ikon segitiga peringatan dalam lingkaran merah muda */
    .swal-hapus-popup .swal2-icon.swal2-warning {
        width: 84px;
        height: 84px;
        margin: 0.4rem auto 1.3rem;
        color: #dc2626;
        background: #fee2e2;
        border: 0;
        border-radius: 50%;
        animation: none;
    }

    .swal-hapus-popup .swal2-icon .swal2-icon-content {
        font-size: 2.4rem;
        line-height: 1;
    }

    .swal-hapus-popup .swal2-title {
        margin: 0 0 0.6rem;
        padding: 0;
        font-size: 1.6rem;
        font-weight: 800;
        letter-spacing: -0.01em;
        color: #14264f;
    }

    .swal-hapus-popup .swal2-html-container {
        margin: 0;
        padding: 0;
        font-size: 1rem;
        font-weight: 500;
        color: #64748b;
    }

    .hapus-sub {
        margin: 0 0 12px;
    }

    .hapus-nama {
        display: inline-block;
        max-width: 100%;
        margin-bottom: 20px;
        padding: 10px 22px;
        font-size: 1.05rem;
        font-weight: 800;
        color: #14264f;
        background: #f1f5fb;
        border: 1px solid #e3eaf3;
        border-radius: 999px;
        word-break: break-word;
    }

    .hapus-note {
        display: block;
        margin: 0;
        padding: 14px 18px;
        font-size: 0.95rem;
        font-weight: 500;
        line-height: 1.5;
        text-align: left;
        color: #8a3b0c;
        background: #fffbeb;
        border: 1px solid #fde9a8;
        border-radius: 16px;
    }

    .hapus-note strong { font-weight: 800; }

    .swal-hapus-popup .swal2-actions {
        display: flex;
        flex-wrap: nowrap;
        width: 100%;
        gap: 14px;
        margin: 1.5rem 0 0;
        padding: 0;
    }

    .swal-hapus-popup .swal2-actions .btn-hapus-batal,
    .swal-hapus-popup .swal2-actions .btn-hapus-ya {
        flex: 1 1 0;
        margin: 0;
        padding: 0.95rem 1rem;
        font-family: inherit;
        font-size: 1.05rem;
        font-weight: 800;
        border-radius: 16px;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .swal-hapus-popup .swal2-actions .btn-hapus-batal {
        color: #14264f;
        background: #fff;
        border: 1.5px solid #e3eaf3;
    }

    .swal-hapus-popup .swal2-actions .btn-hapus-ya {
        color: #fff;
        background: linear-gradient(135deg, #f43f5e, #dc2626);
        border: 0;
        box-shadow: 0 12px 24px rgba(220, 38, 38, 0.32);
    }

    .swal-hapus-popup .swal2-actions .btn-hapus-batal:hover,
    .swal-hapus-popup .swal2-actions .btn-hapus-ya:hover {
        transform: translateY(-2px);
    }

    .swal-hapus-popup .swal2-actions .btn-hapus-batal:focus-visible,
    .swal-hapus-popup .swal2-actions .btn-hapus-ya:focus-visible {
        outline: none;
        box-shadow: 0 0 0 4px rgba(47, 91, 183, 0.22);
    }

    @media (max-width: 576px) {
        .swal-hapus-popup.swal2-popup { padding: 2.2rem 1.2rem 1.4rem; border-radius: 24px; }
        .swal-hapus-popup .swal2-title { font-size: 1.35rem; }
        .swal-hapus-popup .swal2-actions { gap: 10px; }
    }
</style>

<div class="edu-page">
    <div class="header-bar">
        <div class="header-title">
            <div class="header-icon"><i class="bi bi-mortarboard-fill"></i></div>
            <div>
                <h4>Riwayat Pendidikan Terakhir</h4>
                <p>Kelola semua riwayat pendidikan Anda.</p>
            </div>
        </div>
        <a href="{{ route('pendidikan.create') }}" class="btn btn-success"><i class="bi bi-plus-lg"></i> Tambah Pendidikan</a>
    </div>

    @php
        // Tentukan jenis pratinjau berdasarkan ekstensi file
        $previewType = function ($path) {
            $ext = strtolower(pathinfo((string) $path, PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'svg'])) return 'image';
            if ($ext === 'pdf') return 'pdf';
            return 'other';
        };
    @endphp

    @forelse($pendidikans as $data)
        <div class="edu-card">
            <div class="edu-head">
                <div class="jenjang-badge">
                    <small>Jenjang</small>
                    <strong>{{ $data->jenjang ?? '-' }}</strong>
                </div>
                <div class="edu-title">
                    <span class="eyebrow">Institusi</span>
                    <h3>{{ $data->institusi ?? '-' }}</h3>
                </div>
            </div>

            <div class="info-grid">
                @if(in_array($data->jenjang, ['S1', 'S2', 'S3', 'Prof']))
                    <div class="info-item">
                        <span class="info-icon"><i class="bi bi-award"></i></span>
                        <div class="info-body">
                            <span class="info-label">Gelar</span>
                            <div class="info-value">{{ $data->gelar ?? '-' }}</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <span class="info-icon"><i class="bi bi-journal-bookmark"></i></span>
                        <div class="info-body">
                            <span class="info-label">Bidang Ilmu</span>
                            <div class="info-value">{{ $data->bidang_ilmu ?? '-' }}</div>
                        </div>
                    </div>

                    <div class="info-item">
                        <span class="info-icon"><i class="bi bi-globe2"></i></span>
                        <div class="info-body">
                            <span class="info-label">Lulusan</span>
                            <div class="info-value">{{ $data->lulusan ?? '-' }}</div>
                        </div>
                    </div>
                @endif

                <div class="info-item">
                    <span class="info-icon"><i class="bi bi-diagram-3"></i></span>
                    <div class="info-body">
                        <span class="info-label">Jurusan</span>
                        <div class="info-value">{{ $data->jurusan ?? '-' }}</div>
                    </div>
                </div>

                <div class="info-item">
                    <span class="info-icon"><i class="bi bi-card-text"></i></span>
                    <div class="info-body">
                        <span class="info-label">No Ijazah</span>
                        <div class="info-value">{{ $data->no_ijazah ?? '-' }}</div>
                    </div>
                </div>

                <div class="info-item">
                    <span class="info-icon"><i class="bi bi-calendar-event"></i></span>
                    <div class="info-body">
                        <span class="info-label">Tanggal Masuk</span>
                        <div class="info-value">
                            {{ \Carbon\Carbon::parse($data->tanggal_masuk)->translatedFormat('d F Y') ?? '-' }}
                        </div>
                    </div>
                </div>

                <div class="info-item">
                    <span class="info-icon"><i class="bi bi-calendar-check"></i></span>
                    <div class="info-body">
                        <span class="info-label">Tanggal Lulus</span>
                        <div class="info-value">
                            {{ \Carbon\Carbon::parse($data->tanggal_lulus)->translatedFormat('d F Y') ?? '-' }}
                        </div>
                    </div>
                </div>

                <div class="info-item wide">
                    <span class="info-icon"><i class="bi bi-geo-alt"></i></span>
                    <div class="info-body">
                        <span class="info-label">Alamat Institusi</span>
                        <div class="info-value">{{ $data->alamat_institusi ?? '-' }}</div>
                    </div>
                </div>
            </div>

            @if($data->ijazah || $data->file_pendamping || $data->transkrip)
                <div class="doc-section">
                    <div class="section-title">Dokumen</div>
                    <div class="doc-list">
                        @if($data->ijazah)
                            <a class="info-link" href="#ijazahModal{{ $data->id }}" data-bs-toggle="modal" data-bs-target="#ijazahModal{{ $data->id }}">
                                <i class="bi bi-paperclip"></i>
                                <span class="doc-text"><span class="doc-name">Ijazah</span>Lihat Ijazah</span>
                            </a>
                        @endif

                        @if($data->file_pendamping)
                            <a class="info-link" href="#pendampingModal{{ $data->id }}" data-bs-toggle="modal" data-bs-target="#pendampingModal{{ $data->id }}">
                                <i class="bi bi-paperclip"></i>
                                <span class="doc-text"><span class="doc-name">Pendamping Ijazah</span>Lihat Pendamping</span>
                            </a>
                        @endif

                        @if($data->transkrip)
                            <a class="info-link" href="#transkripModal{{ $data->id }}" data-bs-toggle="modal" data-bs-target="#transkripModal{{ $data->id }}">
                                <i class="bi bi-paperclip"></i>
                                <span class="doc-text"><span class="doc-name">Transkrip Nilai</span>Lihat Transkrip</span>
                            </a>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Tombol Edit & Hapus -->
            <div class="button-group-bottom card-actions">
                <a href="{{ route('pendidikan.edit', $data->id) }}" class="btn btn-warning"><i class="bi bi-pencil-square"></i> Edit</a>

                <form action="{{ route('pendidikan.destroy', $data->id) }}" method="POST" class="inline form-hapus">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger"><i class="bi bi-trash3"></i> Hapus</button>
                </form>
            </div>
        </div>

        <!-- Modal Ijazah -->
        <div class="modal fade" id="ijazahModal{{ $data->id }}" tabindex="-1" aria-labelledby="ijazahModalLabel{{ $data->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 id="ijazahModalLabel{{ $data->id }}" class="mb-0">Ijazah</h5>
                        <div class="modal-tools">
                            <a href="{{ asset('storage/' . $data->ijazah) }}" class="btn btn-success btn-sm" download><i class="bi bi-download"></i> Download Ijazah</a>
                            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                    </div>
                    @php $type = $previewType($data->ijazah); $url = asset('storage/' . $data->ijazah); @endphp
                    @if($type === 'image')
                        <a href="{{ $url }}" target="_blank" rel="noopener" title="Buka ukuran penuh"><img src="{{ $url }}" class="modal-img mt-2" alt="Ijazah"></a>
                    @elseif($type === 'pdf')
                        <iframe src="{{ $url }}" class="modal-pdf mt-2" title="Ijazah"></iframe>
                    @else
                        <div class="preview-fallback mt-2">
                            <i class="bi bi-file-earmark-text"></i>
                            <p>Pratinjau tidak tersedia untuk jenis file ini.</p>
                            <a href="{{ $url }}" target="_blank" rel="noopener" class="btn btn-warning btn-sm"><i class="bi bi-box-arrow-up-right"></i> Buka File</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Modal Pendamping -->
        <div class="modal fade" id="pendampingModal{{ $data->id }}" tabindex="-1" aria-labelledby="pendampingModalLabel{{ $data->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 id="pendampingModalLabel{{ $data->id }}" class="mb-0">Pendamping Ijazah</h5>
                        <div class="modal-tools">
                            <a href="{{ asset('storage/' . $data->file_pendamping) }}" class="btn btn-success btn-sm" download><i class="bi bi-download"></i> Download Pendamping</a>
                            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                    </div>
                    @php $type = $previewType($data->file_pendamping); $url = asset('storage/' . $data->file_pendamping); @endphp
                    @if($type === 'image')
                        <a href="{{ $url }}" target="_blank" rel="noopener" title="Buka ukuran penuh"><img src="{{ $url }}" class="modal-img mt-2" alt="Pendamping Ijazah"></a>
                    @elseif($type === 'pdf')
                        <iframe src="{{ $url }}" class="modal-pdf mt-2" title="Pendamping Ijazah"></iframe>
                    @else
                        <div class="preview-fallback mt-2">
                            <i class="bi bi-file-earmark-text"></i>
                            <p>Pratinjau tidak tersedia untuk jenis file ini.</p>
                            <a href="{{ $url }}" target="_blank" rel="noopener" class="btn btn-warning btn-sm"><i class="bi bi-box-arrow-up-right"></i> Buka File</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Modal Transkrip -->
        <div class="modal fade" id="transkripModal{{ $data->id }}" tabindex="-1" aria-labelledby="transkripModalLabel{{ $data->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 id="transkripModalLabel{{ $data->id }}" class="mb-0">Transkrip Nilai</h5>
                        <div class="modal-tools">
                            <a href="{{ asset('storage/' . $data->transkrip) }}" class="btn btn-success btn-sm" download><i class="bi bi-download"></i> Download Transkrip</a>
                            <button type="button" class="btn-close modal-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                    </div>
                    @php $type = $previewType($data->transkrip); $url = asset('storage/' . $data->transkrip); @endphp
                    @if($type === 'image')
                        <a href="{{ $url }}" target="_blank" rel="noopener" title="Buka ukuran penuh"><img src="{{ $url }}" class="modal-img mt-2" alt="Transkrip"></a>
                    @elseif($type === 'pdf')
                        <iframe src="{{ $url }}" class="modal-pdf mt-2" title="Transkrip Nilai"></iframe>
                    @else
                        <div class="preview-fallback mt-2">
                            <i class="bi bi-file-earmark-text"></i>
                            <p>Pratinjau tidak tersedia untuk jenis file ini.</p>
                            <a href="{{ $url }}" target="_blank" rel="noopener" class="btn btn-warning btn-sm"><i class="bi bi-box-arrow-up-right"></i> Buka File</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    @empty
        <div class="alert alert-info"><i class="bi bi-info-circle-fill"></i> Belum ada data pendidikan. Yuk, tambahkan dulu!</div>
    @endforelse

    <div class="button-group-bottom page-actions">
        <a href="{{ route('pendidikan.download') }}" class="btn btn-success"><i class="bi bi-download"></i> Download PDF</a>
    </div>
</div>

<!-- Menyertakan SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Menampilkan SweetAlert jika data berhasil disimpan (session success)
    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#2f5bb7'
    });
    @endif

    // Konfirmasi hapus dengan SweetAlert
    document.querySelectorAll('.form-hapus').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            // Ambil nama institusi dari kartu untuk ditampilkan di dialog
            var card = form.closest('.edu-card');
            var titleEl = card ? card.querySelector('.edu-title h3') : null;
            var tmp = document.createElement('div');
            tmp.textContent = titleEl ? titleEl.textContent.trim() : '';
            var nama = tmp.innerHTML;

            Swal.fire({
                icon: 'warning',
                iconHtml: '<i class="bi bi-exclamation-triangle"></i>',
                title: 'Hapus data pendidikan?',
                html:
                    '<p class="hapus-sub">Anda akan menghapus data:</p>' +
                    (nama ? '<div class="hapus-nama">' + nama + '</div>' : '') +
                    '<div class="hapus-note">&#9888;&#65039; Data ini akan dihapus dan <strong>tidak dapat dikembalikan</strong>.</div>',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                buttonsStyling: false,
                customClass: {
                    container: 'swal-hapus-container',
                    popup: 'swal-hapus-popup',
                    confirmButton: 'btn-hapus-ya',
                    cancelButton: 'btn-hapus-batal'
                }
            }).then(function (result) {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection