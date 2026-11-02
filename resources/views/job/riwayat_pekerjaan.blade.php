@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* Latar halaman (sama dengan halaman Riwayat Pendidikan) */
    body {
        background:
            radial-gradient(circle at 92% 38%, rgba(31, 82, 190, 0.45), transparent 46%),
            radial-gradient(circle at 6% 72%, rgba(12, 74, 118, 0.70), transparent 46%),
            linear-gradient(180deg, #0a1a47 0%, #0b1f50 45%, #0a1636 100%) !important;
        background-attachment: fixed !important;
        background-color: #0a1a47 !important;
    }

    .pk-page {
        --primary: #2f5bb7;
        --primary-dark: #234693;
        --primary-rgb: 47, 91, 183;
        --primary-soft: #e8f0fd;
        --yellow: #ffd21f;
        --text: #2b3a44;
        --ink: #14264f;
        --muted: #64748b;
        --border: #e3eaf3;
        --field-bg: #f6f8fc;

        --wrap-px: 16px;
        --wrap-mt: -17px;
        --card-r: 30px;

        position: relative;
        box-sizing: border-box;
        width: 100%;
        max-width: 100%;
        margin: var(--wrap-mt) auto 70px;
        padding: 0 var(--wrap-px);
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        color: var(--text);
    }

    .pk-page *,
    .pk-page *::before,
    .pk-page *::after {
        box-sizing: border-box;
    }

    /* ---------- Kartu putih dengan garis gradasi di atas ---------- */
    .pk-top,
    .pk-card,
    .pk-empty {
        position: relative;
        overflow: hidden;
        background: #fff;
        border-radius: var(--card-r);
        box-shadow: 0 20px 50px rgba(2, 10, 40, 0.45);
        animation: pkRise 0.55s cubic-bezier(.2, .8, .2, 1) both;
    }

    .pk-top::before,
    .pk-card::before,
    .pk-empty::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #2f5bb7 0%, #5b9df0 72%, #ffd21f 100%);
    }

    /* ---------- Kartu judul halaman ---------- */
    .pk-top {
        display: flex;
        align-items: center;
        gap: 18px;
        margin-bottom: 26px;
        padding: 22px 28px 21px;
    }

    .pk-top-icon {
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 57px;
        height: 57px;
        font-size: 26px;
        color: var(--primary);
        background: var(--primary-soft);
        border-bottom: 3px solid var(--yellow);
        border-radius: 18px;
        box-shadow: 0 8px 18px rgba(var(--primary-rgb), 0.16);
    }

    .pk-top-text { flex: 1; min-width: 0; }

    .pk-top-text h3 {
        margin: 0 0 3px;
        font-size: 1.45rem;
        font-weight: 800;
        line-height: 1.2;
        letter-spacing: -0.01em;
        color: var(--ink);
        text-align: left;
    }

    .pk-top-text p {
        margin: 0;
        font-size: 0.9rem;
        line-height: 1.4;
        color: var(--muted);
    }

    .pk-btn-add {
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        padding: 12px 22px;
        font-family: inherit;
        font-size: 0.9rem;
        font-weight: 700;
        line-height: 1.3;
        color: #fff;
        text-decoration: none;
        background: linear-gradient(135deg, #10b981, #059669);
        border: none;
        border-radius: 14px;
        box-shadow: 0 10px 20px rgba(16, 185, 129, 0.32);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .pk-btn-add i { font-size: 1.05em; }

    .pk-btn-add:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 14px 26px rgba(16, 185, 129, 0.42);
    }

    .pk-btn-add:focus-visible {
        outline: none;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.30);
    }

    /* ---------- Notifikasi ---------- */
    .pk-alert {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 26px;
        padding: 14px 20px;
        font-size: 0.9rem;
        font-weight: 700;
        color: #166534;
        background: #ecfdf3;
        border: 1.2px solid #bbf0d0;
        border-radius: 18px;
        box-shadow: 0 10px 24px rgba(2, 10, 40, 0.25);
    }

    .pk-alert i { font-size: 1.15rem; color: #16a34a; }

    /* ---------- Daftar ---------- */
    .pk-list {
        display: flex;
        flex-direction: column;
        gap: 26px;
    }

    /* ---------- Kartu riwayat ---------- */
    .pk-card {
        padding: 28px 34px 27px;
    }

    .pk-head {
        display: flex;
        align-items: center;
        gap: 20px;
        padding-bottom: 24px;
        margin-bottom: 25px;
        border-bottom: 1px dashed var(--border);
    }

    .user-photo {
        flex-shrink: 0;
        width: 76px;
        height: 92px;
        object-fit: cover;
        object-position: center top;
        border-radius: 20px;
        border-bottom: 4px solid var(--yellow);
        background: var(--primary-soft);
        box-shadow: 0 10px 20px rgba(var(--primary-rgb), 0.28);
    }

    .pk-title { min-width: 0; }

    .pk-eyebrow {
        display: block;
        margin-bottom: 6px;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: #5b6b85;
    }

    .pk-jabatan {
        margin: 0;
        font-size: 1.4rem;
        font-weight: 800;
        line-height: 1.25;
        letter-spacing: -0.005em;
        color: var(--ink);
        overflow-wrap: anywhere;
    }

    /* ---------- Kotak data ---------- */
    .pk-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 15px;
    }

    .pk-wide { grid-column: span 2; }

    .pk-item {
        display: flex;
        align-items: center;
        gap: 14px;
        min-width: 0;
        padding: 15px 17px;
        background: var(--field-bg);
        border: 1.2px solid var(--border);
        border-radius: 18px;
    }

    .pk-item-icon {
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        font-size: 1.05rem;
        color: var(--primary);
        background: var(--primary-soft);
        border-radius: 13px;
    }

    .pk-item-text { min-width: 0; }

    .data-label {
        display: block;
        margin-bottom: 2px;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: #5b6b85;
    }

    .data-value {
        font-size: 1rem;
        font-weight: 700;
        line-height: 1.35;
        color: var(--ink);
        overflow-wrap: anywhere;
    }

    /* ---------- Judul bagian Dokumen ---------- */
    .pk-sec {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 26px 0 15px;
        font-size: 0.8rem;
        font-weight: 800;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--primary);
    }

    .pk-sec::before {
        content: "";
        flex-shrink: 0;
        width: 4px;
        height: 20px;
        background: linear-gradient(180deg, #2f5bb7, #ffd21f);
        border-radius: 4px;
    }

    .pk-sec::after {
        content: "";
        flex: 1;
        height: 1px;
        background: linear-gradient(90deg, var(--border), transparent);
    }

    .pk-docs {
        display: flex;
        flex-wrap: wrap;
        gap: 13px;
    }

    .pk-doc {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 10px 22px 10px 18px;
        text-decoration: none;
        background: #eef4fd;
        border: 1.2px solid #d5e2f6;
        border-radius: 16px;
        transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
    }

    a.pk-doc:hover {
        transform: translateY(-2px);
        border-color: var(--primary);
        box-shadow: 0 8px 18px rgba(var(--primary-rgb), 0.16);
    }

    a.pk-doc:focus-visible {
        outline: none;
        box-shadow: 0 0 0 4px rgba(var(--primary-rgb), 0.22);
    }

    .pk-doc > i {
        font-size: 1.05rem;
        color: var(--primary);
    }

    .pk-doc-label {
        display: block;
        font-size: 0.62rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #6f8fd0;
    }

    .pk-doc-value {
        display: block;
        font-size: 0.95rem;
        font-weight: 700;
        line-height: 1.3;
        color: var(--primary);
    }

    .pk-doc.is-empty > i,
    .pk-doc.is-empty .pk-doc-value { color: var(--muted); }

    .pk-doc.is-empty { background: var(--field-bg); border-color: var(--border); }

    /* ---------- Kartu File SK (gaya sama dengan kartu KTP/KK di Data Diri) ---------- */
    .pk-sk {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        width: min(100%, 360px);
        padding: 34px 24px 30px;
        overflow: hidden;
        text-align: center;
        background: linear-gradient(180deg, #ffffff 0%, #f6f8fc 100%);
        border: 1.2px solid var(--border);
        border-radius: 30px;
        box-shadow: 0 14px 34px rgba(var(--primary-rgb), 0.14);
    }

    .pk-sk::before {
        content: "";
        position: absolute;
        top: 0;
        left: 12%;
        right: 12%;
        height: 4px;
        background: linear-gradient(90deg, transparent, #2f5bb7 30%, #5b9df0 70%, transparent);
        border-radius: 0 0 4px 4px;
    }

    .pk-sk-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 76px;
        height: 76px;
        margin-bottom: 16px;
        font-size: 34px;
        color: #2563eb;
        background: #eaf1ff;
        border: 4px solid #d3e2fb;
        border-radius: 24px;
    }

    .pk-sk-title {
        margin: 0 0 4px;
        font-size: 1.35rem;
        font-weight: 800;
        color: var(--ink);
    }

    .pk-sk-desc {
        margin: 0 0 22px;
        font-size: 0.95rem;
        color: var(--muted);
    }

    .pk-sk-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 13px 32px;
        font-family: inherit;
        font-size: 1rem;
        font-weight: 800;
        line-height: 1.2;
        color: #fff;
        cursor: pointer;
        background: linear-gradient(135deg, #3b74e8, #234693);
        border: none;
        border-radius: 999px;
        box-shadow: 0 12px 22px rgba(var(--primary-rgb), 0.34);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .pk-sk-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 16px 28px rgba(var(--primary-rgb), 0.44);
    }

    .pk-sk-btn:focus-visible {
        outline: none;
        box-shadow: 0 0 0 4px rgba(var(--primary-rgb), 0.28);
    }

    .pk-sk-btn i { font-size: 1.1em; }

    /* ---------- Aksi ---------- */
    .pk-foot {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        margin-top: 27px;
        padding-top: 23px;
        border-top: 1px dashed var(--border);
    }

    .action-btns {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .action-btns form { margin: 0; }

    .pk-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        padding: 11px 24px;
        font-family: inherit;
        font-size: 0.95rem;
        font-weight: 700;
        line-height: 1.3;
        text-decoration: none;
        cursor: pointer;
        border: none;
        border-radius: 14px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .pk-btn:hover { transform: translateY(-2px); }

    .pk-btn-edit {
        color: #3b2a00;
        background: linear-gradient(135deg, #ffd21f, #f5a50a);
        box-shadow: 0 10px 18px rgba(245, 165, 10, 0.34);
    }

    .pk-btn-edit:hover { color: #3b2a00; box-shadow: 0 14px 24px rgba(245, 165, 10, 0.44); }

    .pk-btn-del {
        color: #fff;
        background: linear-gradient(135deg, #f25555, #dc2626);
        box-shadow: 0 10px 18px rgba(220, 38, 38, 0.30);
    }

    .pk-btn-del:hover { color: #fff; box-shadow: 0 14px 24px rgba(220, 38, 38, 0.40); }

    .pk-btn:focus-visible {
        outline: none;
        box-shadow: 0 0 0 4px rgba(var(--primary-rgb), 0.28);
    }

    /* ---------- Kosong ---------- */
    .pk-empty {
        padding: 60px 24px 52px;
        text-align: center;
    }

    .pk-empty-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 64px;
        height: 64px;
        margin-bottom: 14px;
        font-size: 28px;
        color: var(--primary);
        background: var(--primary-soft);
        border-bottom: 3px solid var(--yellow);
        border-radius: 20px;
        box-shadow: 0 8px 18px rgba(var(--primary-rgb), 0.16);
    }

    .pk-empty p {
        margin: 0;
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--muted);
    }

    /* ---------- Modal Preview File SK ---------- */
    .pk-modal {
        position: fixed;
        inset: 0;
        z-index: 2000;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 24px 16px;
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        background: rgba(4, 12, 40, 0.62);
        backdrop-filter: blur(3px);
        -webkit-backdrop-filter: blur(3px);
    }

    .pk-modal.is-open {
        display: flex;
        animation: pkFade 0.2s ease both;
    }

    .pk-modal *,
    .pk-modal *::before,
    .pk-modal *::after { box-sizing: border-box; }

    .pk-modal-box {
        position: relative;
        display: flex;
        flex-direction: column;
        width: 100%;
        max-width: 860px;
        height: min(88vh, 820px);
        padding: 26px 30px 28px;
        overflow: hidden;
        background: #fff;
        border-radius: 28px;
        box-shadow: 0 30px 70px rgba(2, 10, 40, 0.55);
        animation: pkRise 0.35s cubic-bezier(.2, .8, .2, 1) both;
    }

    .pk-modal-box::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #2f5bb7 0%, #5b9df0 72%, #ffd21f 100%);
    }

    .pk-modal-head {
        flex-shrink: 0;
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 18px;
    }

    .pk-modal-title {
        flex: 1;
        min-width: 0;
        margin: 0;
        font-size: 1.25rem;
        font-weight: 800;
        color: #14264f;
        overflow-wrap: anywhere;
    }

    .pk-modal-dl {
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        font-family: inherit;
        font-size: 0.9rem;
        font-weight: 700;
        line-height: 1.3;
        color: #fff;
        text-decoration: none;
        background: linear-gradient(135deg, #10b981, #059669);
        border-radius: 12px;
        box-shadow: 0 8px 16px rgba(16, 185, 129, 0.30);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .pk-modal-dl:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 12px 22px rgba(16, 185, 129, 0.40);
    }

    .pk-modal-close {
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        font-size: 1.1rem;
        color: #14264f;
        cursor: pointer;
        background: #e8f0fd;
        border: none;
        border-radius: 50%;
        transition: background 0.2s ease, transform 0.2s ease;
    }

    .pk-modal-close:hover { background: #d5e2f6; transform: rotate(90deg); }

    .pk-modal-dl:focus-visible,
    .pk-modal-close:focus-visible {
        outline: none;
        box-shadow: 0 0 0 4px rgba(47, 91, 183, 0.25);
    }

    .pk-modal-body {
        flex: 1;
        min-height: 0;
        overflow: hidden;
        background: #323639;
        border-radius: 20px;
    }

    .pk-modal-body iframe {
        display: block;
        width: 100%;
        height: 100%;
        border: 0;
    }

    @media (max-width: 576px) {
        .pk-modal { padding: 12px 8px; }
        .pk-modal-box { height: 90vh; padding: 20px 14px 16px; border-radius: 22px; }
        .pk-modal-head { flex-wrap: wrap; gap: 10px; }
        .pk-modal-title { flex: 1 1 calc(100% - 54px); font-size: 1.05rem; }
        .pk-modal-close { order: 2; width: 38px; height: 38px; }
        .pk-modal-dl { order: 3; flex: 1 1 100%; justify-content: center; }
        .pk-modal-body { border-radius: 16px; }
    }

    /* ---------- SweetAlert Hapus ---------- */
    .swal2-popup.pk-swal {
        position: relative;
        overflow: hidden;
        width: 31em;
        max-width: 92vw;
        padding: 2.6rem 2.2rem 2.2rem;
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        border-radius: 30px;
        box-shadow: 0 30px 70px rgba(2, 10, 40, 0.5);
    }

    .swal2-popup.pk-swal::before {
        content: "";
        position: absolute;
        top: 0; left: 0; right: 0;
        height: 6px;
        background: linear-gradient(90deg, #f43f5e 0%, #dc2626 60%, #f97316 100%);
    }

    .pk-swal .swal2-html-container {
        margin: 0;
        padding: 0;
        overflow: visible;
    }

    .pk-swal .pk-sw-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 84px;
        height: 84px;
        margin-bottom: 18px;
        font-size: 38px;
        color: #dc2626;
        background: #fee2e2;
        border-radius: 50%;
    }

    .pk-swal .pk-sw-title {
        margin: 0 0 8px;
        font-size: 1.6rem;
        font-weight: 800;
        color: #14264f;
    }

    .pk-swal .pk-sw-sub {
        margin: 0 0 14px;
        font-size: 1rem;
        color: #64748b;
    }

    .pk-swal .pk-sw-name {
        display: block;
        margin-bottom: 18px;
        padding: 12px 18px;
        font-size: 1.1rem;
        font-weight: 800;
        color: #14264f;
        background: #eef4fd;
        border: 1.2px solid #d5e2f6;
        border-radius: 999px;
        overflow-wrap: anywhere;
    }

    .pk-swal .pk-sw-warn {
        margin: 0;
        padding: 14px 18px;
        font-size: 1rem;
        line-height: 1.5;
        text-align: left;
        color: #7c2d12;
        background: #fffbeb;
        border: 1.2px solid #fde9b0;
        border-radius: 18px;
    }

    .pk-swal .pk-sw-warn b { color: #92400e; }

    .swal2-popup.pk-swal .swal2-actions {
        width: 100%;
        margin: 24px 0 0;
        gap: 14px;
        flex-wrap: nowrap;
    }

    .swal2-popup.pk-swal .pk-sw-btn {
        flex: 1;
        margin: 0;
        padding: 15px 12px;
        font-family: inherit;
        font-size: 1.05rem;
        font-weight: 800;
        cursor: pointer;
        border-radius: 16px;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .swal2-popup.pk-swal .pk-sw-btn:hover { transform: translateY(-2px); }

    .swal2-popup.pk-swal .pk-sw-cancel {
        color: #14264f;
        background: #fff;
        border: 1.5px solid #d5e2f6;
    }

    .swal2-popup.pk-swal .pk-sw-confirm {
        color: #fff;
        background: linear-gradient(135deg, #f43f5e, #dc2626);
        border: none;
        box-shadow: 0 12px 22px rgba(220, 38, 38, 0.32);
    }

    .swal2-popup.pk-swal .pk-sw-btn:focus-visible {
        outline: none;
        box-shadow: 0 0 0 4px rgba(47, 91, 183, 0.25);
    }

    @media (max-width: 576px) {
        .swal2-popup.pk-swal { padding: 2.2rem 1.2rem 1.6rem; border-radius: 24px; }
        .pk-swal .pk-sw-title { font-size: 1.35rem; }
    }

    @keyframes pkRise {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @keyframes pkFade {
        from { opacity: 0; }
        to   { opacity: 1; }
    }

    @media (prefers-reduced-motion: reduce) {
        .pk-page *,
        .pk-page *::before,
        .pk-page *::after,
        .pk-modal,
        .pk-modal * {
            animation: none !important;
            transition: none !important;
        }
    }

    /* ---------- Responsif ---------- */
    @media (max-width: 991px) {
        .pk-page { --wrap-px: 0px; --wrap-mt: 0px; --card-r: 28px; }

        .pk-top { padding: 20px 24px 19px; }
        .pk-card { padding: 26px 26px 24px; }

        .pk-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .pk-sub { grid-column: span 2; }
    }

    @media (max-width: 576px) {
        .pk-page { --card-r: 22px; }

        .pk-top {
            flex-wrap: wrap;
            gap: 14px;
            margin-bottom: 18px;
            padding: 20px 16px 18px;
        }

        .pk-top-icon { width: 48px; height: 48px; font-size: 22px; border-radius: 15px; }
        .pk-top-text h3 { font-size: 1.2rem; }
        .pk-top-text p { font-size: 0.8rem; }
        .pk-btn-add { width: 100%; }

        .pk-alert { margin-bottom: 18px; padding: 12px 16px; }
        .pk-list { gap: 18px; }
        .pk-card { padding: 22px 16px 18px; }

        .pk-head { gap: 14px; padding-bottom: 18px; margin-bottom: 18px; }
        .user-photo { width: 64px; height: 78px; border-radius: 16px; }
        .pk-jabatan { font-size: 1.1rem; }

        .pk-grid { grid-template-columns: 1fr; gap: 10px; }
        .pk-wide,
        .pk-sub { grid-column: auto; }
        .pk-item { gap: 12px; padding: 12px 14px; }
        .pk-item-icon { width: 38px; height: 38px; font-size: 0.95rem; }

        .pk-sec { margin: 22px 0 12px; }
        .pk-docs { gap: 10px; }
        .pk-doc { flex: 1 1 100%; }

        .pk-sk { width: 100%; padding: 28px 18px 24px; border-radius: 24px; }

        .pk-foot { margin-top: 20px; padding-top: 18px; }
        .action-btns { width: 100%; gap: 10px; }
        .action-btns > a,
        .action-btns > form { flex: 1; }
        .action-btns .pk-btn { width: 100%; padding-left: 12px; padding-right: 12px; }
    }
</style>

<div class="pk-page">
    <div class="pk-top">
        <div class="pk-top-icon"><i class="bi bi-briefcase-fill"></i></div>
        <div class="pk-top-text">
            <h3>Riwayat Pekerjaan</h3>
            <p>Kelola semua riwayat pekerjaan Anda.</p>
        </div>
        <a href="{{ route('pekerjaan.tambah') }}" class="pk-btn-add"><i class="bi bi-plus-lg"></i> Tambah Riwayat</a>
    </div>

    @if(session('success'))
        <div class="pk-alert"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
    @endif

    @if($data->isEmpty())
        <div class="pk-empty">
            <div class="pk-empty-icon"><i class="bi bi-info-circle"></i></div>
            <p>Belum ada data riwayat pekerjaan.</p>
        </div>
    @else
        <div class="pk-list">
            @foreach($data as $pekerjaan)
                <div class="pk-card">
                    <div class="pk-head">
                        @if($pekerjaan->user && $pekerjaan->user->photo)
                            <img src="{{ asset('storage/uploads/photo/' . $pekerjaan->user->photo) }}" alt="Foto Pengguna" class="user-photo">
                        @else
                            <img src="{{ asset('storage/default-photo.jpg') }}" alt="Foto Pengguna" class="user-photo">
                        @endif

                        <div class="pk-title">
                            <span class="pk-eyebrow">Jabatan</span>
                            <h4 class="pk-jabatan">{{ $pekerjaan->jabatan }}</h4>
                        </div>
                    </div>

                    <div class="pk-grid">
                        <div class="pk-item">
                            <span class="pk-item-icon"><i class="bi bi-award"></i></span>
                            <div class="pk-item-text">
                                <span class="data-label">Pangkat</span>
                                <div class="data-value">{{ $pekerjaan->pangkat }}</div>
                            </div>
                        </div>
                        <div class="pk-item">
                            <span class="pk-item-icon"><i class="bi bi-card-text"></i></span>
                            <div class="pk-item-text">
                                <span class="data-label">NIP</span>
                                <div class="data-value">{{ $pekerjaan->nip }}</div>
                            </div>
                        </div>
                        <div class="pk-item">
                            <span class="pk-item-icon"><i class="bi bi-arrow-left-right"></i></span>
                            <div class="pk-item-text">
                                <span class="data-label">Mutasi</span>
                                <div class="data-value">{{ $pekerjaan->mutasi }}</div>
                            </div>
                        </div>
                        <div class="pk-item">
                            <span class="pk-item-icon"><i class="bi bi-file-text"></i></span>
                            <div class="pk-item-text">
                                <span class="data-label">Nomor SK</span>
                                <div class="data-value">{{ $pekerjaan->nomor_sk }}</div>
                            </div>
                        </div>
                        <div class="pk-item">
                            <span class="pk-item-icon"><i class="bi bi-calendar-check"></i></span>
                            <div class="pk-item-text">
                                <span class="data-label">Tanggal SK</span>
                                <div class="data-value">{{ \Carbon\Carbon::parse($pekerjaan->tanggal_sk)->translatedFormat('d F Y') }}</div>
                            </div>
                        </div>
                        <div class="pk-item">
                            <span class="pk-item-icon"><i class="bi bi-calendar-event"></i></span>
                            <div class="pk-item-text">
                                <span class="data-label">TMT SK</span>
                                <div class="data-value">{{ \Carbon\Carbon::parse($pekerjaan->tmt_sk)->translatedFormat('d F Y') }}</div>
                            </div>
                        </div>
                        <div class="pk-item pk-wide">
                            <span class="pk-item-icon"><i class="bi bi-building"></i></span>
                            <div class="pk-item-text">
                                <span class="data-label">Unit Kerja</span>
                                <div class="data-value">{{ $pekerjaan->unit_kerja }}</div>
                            </div>
                        </div>
                        <div class="pk-item pk-sub">
                            <span class="pk-item-icon"><i class="bi bi-diagram-3"></i></span>
                            <div class="pk-item-text">
                                <span class="data-label">Sub Bagian</span>
                                <div class="data-value">{{ $pekerjaan->sub_bagian ?? '-' }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="pk-sec">Dokumen</div>
                    <div class="pk-docs">
                        @if($pekerjaan->file_sk)
                            <div class="pk-sk">
                                <div class="pk-sk-icon"><i class="bi bi-file-earmark-text-fill"></i></div>
                                <h5 class="pk-sk-title">SK</h5>
                                <p class="pk-sk-desc">Surat Keputusan Anda.</p>
                                {{-- Preview dibuka di modal; tombol Download SK ada di dalam modal --}}
                                <button type="button"
                                        class="pk-sk-btn btn-preview-sk"
                                        data-src="{{ asset('storage/' . $pekerjaan->file_sk) }}"
                                        data-nama="{{ $pekerjaan->jabatan }}">
                                    <i class="bi bi-paperclip"></i> Lihat SK
                                </button>
                            </div>
                        @else
                            <div class="pk-doc is-empty">
                                <i class="bi bi-paperclip"></i>
                                <span>
                                    <span class="pk-doc-label">File SK</span>
                                    <span class="pk-doc-value">Tidak ada file</span>
                                </span>
                            </div>
                        @endif
                    </div>

                    <div class="pk-foot">
                        <!-- Action Buttons (Edit and Delete) -->
                        <div class="action-btns">
                            <a href="{{ route('pekerjaan.edit', $pekerjaan->id) }}" class="pk-btn pk-btn-edit"><i class="bi bi-pencil-square"></i> Edit</a>
                            <form action="{{ route('pekerjaan.destroy', $pekerjaan->id) }}" method="POST" style="display:inline" class="form-hapus" data-nama="{{ $pekerjaan->jabatan }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="pk-btn pk-btn-del"><i class="bi bi-trash3"></i> Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

{{-- Modal Preview File SK (satu modal dipakai semua kartu) --}}
<div class="pk-modal" id="pkModal" role="dialog" aria-modal="true" aria-labelledby="pkModalTitle" aria-hidden="true">
    <div class="pk-modal-box">
        <div class="pk-modal-head">
            <h5 class="pk-modal-title" id="pkModalTitle">Surat Keputusan (SK)</h5>
            <a href="#" download class="pk-modal-dl" id="pkModalDl"><i class="bi bi-download"></i> Download SK</a>
            <button type="button" class="pk-modal-close" id="pkModalClose" aria-label="Tutup"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="pk-modal-body">
            <iframe id="pkModalFrame" title="Preview Surat Keputusan" src="about:blank"></iframe>
        </div>
    </div>
</div>

{{-- Hapus baris script SweetAlert2 di bawah jika layouts.app sudah memuatnya --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    /* ---------- Modal Preview SK ---------- */
    (function () {
        var modal = document.getElementById('pkModal');
        var frame = document.getElementById('pkModalFrame');
        var dl    = document.getElementById('pkModalDl');
        var close = document.getElementById('pkModalClose');
        var title = document.getElementById('pkModalTitle');
        var lastBtn = null;

        // Pindahkan ke <body> agar tidak terjebak stacking context layout
        document.body.appendChild(modal);

        function openModal(src, nama, trigger) {
            lastBtn = trigger || null;
            title.textContent = nama ? 'Surat Keputusan (SK) - ' + nama : 'Surat Keputusan (SK)';
            dl.setAttribute('href', src);
            frame.src = src;
            modal.classList.add('is-open');
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
            close.focus();
        }

        function closeModal() {
            modal.classList.remove('is-open');
            modal.setAttribute('aria-hidden', 'true');
            frame.src = 'about:blank';
            document.body.style.overflow = '';
            if (lastBtn) lastBtn.focus();
        }

        document.querySelectorAll('.btn-preview-sk').forEach(function (btn) {
            btn.addEventListener('click', function () {
                openModal(btn.dataset.src, btn.dataset.nama, btn);
            });
        });

        close.addEventListener('click', closeModal);

        // Klik area gelap di luar kotak = tutup
        modal.addEventListener('click', function (e) {
            if (e.target === modal) closeModal();
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && modal.classList.contains('is-open')) closeModal();
        });
    })();

    /* ---------- Konfirmasi Hapus ---------- */
    document.querySelectorAll('.form-hapus').forEach(function (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            var nama = form.dataset.nama || 'data ini';
            var div = document.createElement('div');
            div.textContent = nama; // aman dari karakter HTML
            var namaAman = div.innerHTML;

            Swal.fire({
                html:
                    '<div class="pk-sw-icon"><i class="bi bi-exclamation-triangle"></i></div>' +
                    '<h2 class="pk-sw-title">Hapus data pekerjaan?</h2>' +
                    '<p class="pk-sw-sub">Anda akan menghapus data:</p>' +
                    '<span class="pk-sw-name">' + namaAman + '</span>' +
                    '<p class="pk-sw-warn"><i class="bi bi-exclamation-triangle-fill" style="color:#f59e0b"></i> ' +
                    'Data ini akan dihapus dan <b>tidak dapat dikembalikan</b>.</p>',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                buttonsStyling: false,
                focusCancel: true,
                customClass: {
                    popup: 'pk-swal',
                    confirmButton: 'pk-sw-btn pk-sw-confirm',
                    cancelButton: 'pk-sw-btn pk-sw-cancel'
                }
            }).then(function (result) {
                if (result.isConfirmed) {
                    form.submit(); // submit form DELETE seperti sebelumnya
                }
            });
        });
    });
</script>

@endsection