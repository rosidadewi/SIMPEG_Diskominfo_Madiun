@extends('layouts.master')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    
    html { background: #08142f; }

    body {
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        min-height: 100vh;
        background:
            radial-gradient(58% 48% at 6% 2%, rgba(20, 184, 166, .30), transparent 62%),
            radial-gradient(55% 55% at 94% 6%, rgba(37, 99, 235, .55), transparent 64%),
            radial-gradient(52% 52% at 96% 100%, rgba(79, 70, 229, .5), transparent 62%),
            linear-gradient(160deg, #0b1f4b 0%, #0a1a3d 45%, #08142f 100%);
        background-attachment: fixed;
    }

    body::before {
        content: "";
        position: fixed;
        inset: 0;
        z-index: -1;
        pointer-events: none;
        background-image: radial-gradient(rgba(148, 197, 255, .18) 1px, transparent 1px);
        background-size: 24px 24px;
        -webkit-mask-image: linear-gradient(to bottom, #000 0%, rgba(0, 0, 0, .55) 60%, transparent 100%);
        mask-image: linear-gradient(to bottom, #000 0%, rgba(0, 0, 0, .55) 60%, transparent 100%);
    }

    /* ===== Sidebar (selaras tema; hanya tampilan) ===== */
    .sidebar {
        background: linear-gradient(180deg, #10275a, #0a1a3d) !important;
        border-right: 1px solid rgba(255, 255, 255, .08);
    }

    .sidebar .menu-title,
    .sidebar-menu .menu-title {
        color: rgba(219, 231, 255, .6) !important;
        font-size: .78rem;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
    }

    .sidebar-menu li a {
        color: #dbe7ff !important;
        font-weight: 600;
        text-decoration: none !important;
        border-radius: 14px;
        transition: background .25s ease, color .25s ease;
    }

    .sidebar-menu li a:hover { background: rgba(255, 255, 255, .08) !important; color: #fff !important; }

    .sidebar-menu li.active > a,
    .sidebar-menu li a.active {
        color: #fff !important;
        background: linear-gradient(135deg, #3b82f6, #2563eb) !important;
        box-shadow: 0 12px 24px -14px rgba(37, 99, 235, .9);
    }

    /* ===== Konten ===== */
    .page-wrapper { background: transparent !important; }

    .page-wrapper .dashboard-container {
        --ink: #0f172a;
        position: relative;
        max-width: 1080px;
        margin: 0 auto;
        padding: 28px 24px 56px;
        background: transparent !important;
    }

    .page-wrapper .dashboard-container .background-image { display: none !important; }

    /* lingkaran transparan */
    .page-wrapper .dashboard-container .decorative-circle {
        position: fixed;
        z-index: -1;
        border-radius: 50%;
        pointer-events: none;
        background: rgba(255, 255, 255, .06);
        border: 1px solid rgba(255, 255, 255, .12);
        animation: dbFloat 16s ease-in-out infinite;
    }

    .page-wrapper .dashboard-container .decorative-circle-2 { width: 400px; height: 400px; left: -200px; bottom: 6%; top: auto; right: auto; }
    .page-wrapper .dashboard-container .decorative-circle-3 { width: 215px; height: 215px; right: 6%; bottom: -70px; top: auto; left: auto; animation-delay: -6s; }

    /* ===== Header: kartu putih agar teks jelas terbaca ===== */
    .page-wrapper .dashboard-container .page-header.dashboard-header {
        position: relative;
        margin: 0 !important;
        padding: 26px 32px !important;
        overflow: hidden;
        background: linear-gradient(180deg, #ffffff, #eef3fb) !important;
        border: 1px solid rgba(255, 255, 255, .7) !important;
        border-radius: 32px !important;
        box-shadow: 0 1px 2px rgba(0, 0, 0, .2), 0 30px 60px -26px rgba(0, 0, 0, .7) !important;
        -webkit-backdrop-filter: none !important;
        backdrop-filter: none !important;
    }

    .page-wrapper .dashboard-container .dashboard-header::before {
        content: "";
        position: absolute;
        inset: 0 12% auto 12%;
        height: 3px;
        background: linear-gradient(90deg, transparent, #2563eb, #38bdf8, transparent);
    }

    .page-wrapper .dashboard-container .dashboard-header::after {
        content: "";
        position: absolute;
        right: -70px;
        top: -90px;
        width: 260px;
        height: 260px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(147, 197, 255, .45), transparent 70%);
        pointer-events: none;
    }

    .page-wrapper .dashboard-container .dashboard-header .row { position: relative; z-index: 1; align-items: center; }

    .page-wrapper .dashboard-container .header-logo {
        display: block;
        width: 92px !important;
        height: 92px !important;
        padding: 12px;
        object-fit: contain;
        background: linear-gradient(180deg, #ffffff, #f1f6ff);
        border-radius: 28px;
        box-shadow: 0 0 0 7px rgba(191, 219, 254, .7), 0 16px 30px -14px rgba(37, 99, 235, .55);
    }

    .page-wrapper .dashboard-container .dashboard-title {
        margin: 0 0 12px !important;
        font-size: clamp(1.35rem, 3.2vw, 2rem) !important;
        font-weight: 800 !important;
        letter-spacing: -.02em;
        line-height: 1.25;
        color: #0f1f4d !important;
        text-shadow: none !important;
        -webkit-text-fill-color: #0f1f4d !important;
        background: none !important;
    }

    .page-wrapper .dashboard-container .dashboard-title .accent {
        color: #2563eb !important;
        text-shadow: none !important;
        background: linear-gradient(90deg, #1d4ed8, #3b82f6) !important;
        -webkit-background-clip: text !important;
        background-clip: text !important;
        -webkit-text-fill-color: transparent !important;
    }

    /* tanggal: ikon kalender kini sejajar, tidak lagi menimpa teks */
    .page-wrapper .dashboard-container .dashboard-date {
        position: static !important;
        display: inline-flex !important;
        align-items: center;
        gap: 10px;
        width: auto !important;
        margin: 0 !important;
        padding: 8px 18px !important;
        font-size: .92rem !important;
        font-weight: 700 !important;
        color: #334155 !important;
        text-shadow: none !important;
        background: #eaf0fb !important;
        border: 1px solid #d6e2f5 !important;
        border-radius: 999px !important;
        box-shadow: none !important;
    }

    .page-wrapper .dashboard-container .dashboard-date::before {
        position: static !important;
        transform: none !important;
        margin: 0 !important;
        flex-shrink: 0;
        font-size: .95rem;
        color: #2563eb !important;
    }

    /* ===== Kartu menu ===== */
    .page-wrapper .dashboard-container .row.mt-5 {
        margin-top: 28px !important;
        row-gap: 0;
    }

    .page-wrapper .dashboard-container .row.mt-5 > [class*="col-"] { display: flex; }

    .page-wrapper .dashboard-container .card-modern {
        --tone: #2563eb;
        --tone-soft: #eff6ff;
        --tone-ring: #bfdbfe;
        position: relative;
        width: 100%;
        height: auto !important;
        min-height: 0 !important;
        overflow: hidden;
        color: var(--ink);
        background: linear-gradient(180deg, #ffffff, #f1f5fb) !important;
        border: 1px solid rgba(255, 255, 255, .7) !important;
        border-radius: 30px !important;
        box-shadow: 0 1px 2px rgba(0, 0, 0, .2), 0 26px 50px -26px rgba(0, 0, 0, .7) !important;
        transition: transform .3s ease, box-shadow .3s ease;
    }

    .page-wrapper .dashboard-container .card-modern::before {
        content: "";
        position: absolute;
        inset: 0 18% auto 18%;
        height: 3px;
        background: linear-gradient(90deg, transparent, var(--tone), transparent);
    }

    .page-wrapper .dashboard-container .card-modern:hover {
        transform: translateY(-6px);
        box-shadow: 0 1px 2px rgba(0, 0, 0, .2), 0 34px 56px -24px rgba(0, 0, 0, .8) !important;
    }

    .page-wrapper .dashboard-container .row.mt-5 > :nth-child(2) .card-modern { --tone: #059669; --tone-soft: #ecfdf5; --tone-ring: #a7f3d0; }
    .page-wrapper .dashboard-container .row.mt-5 > :nth-child(3) .card-modern { --tone: #d97706; --tone-soft: #fffbeb; --tone-ring: #fde68a; }

    .page-wrapper .dashboard-container .card-modern .card-body {
        display: flex;
        flex-direction: column;
        align-items: center;
        min-height: 0 !important;
        height: auto !important;
        padding: 32px 24px 30px !important;
    }

    .page-wrapper .dashboard-container .card-modern .fa-3x {
        display: grid;
        place-items: center;
        width: 72px;
        height: 72px;
        margin-bottom: 20px !important;
        font-size: 1.8rem;
        color: var(--tone) !important;
        background: var(--tone-soft);
        border-radius: 24px;
        box-shadow: 0 0 0 6px var(--tone-ring), 0 14px 26px -14px var(--tone);
    }

    .page-wrapper .dashboard-container .card-modern .card-title {
        margin-bottom: 8px;
        font-size: 1.2rem;
        font-weight: 800;
        letter-spacing: -.01em;
        color: #0f1f4d !important;
    }

    .page-wrapper .dashboard-container .card-modern .card-text {
        flex: 1 1 auto;
        margin-bottom: 22px;
        font-size: .95rem;
        line-height: 1.65;
        color: #52627c !important;
    }

    /* ===== Tombol ===== */
    .page-wrapper .dashboard-container .card-modern .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 170px;
        padding: 12px 26px;
        font-size: .95rem;
        font-weight: 700;
        color: #fff !important;
        border: 0;
        border-radius: 999px;
        transition: transform .25s ease, filter .25s ease;
    }

    .page-wrapper .dashboard-container .card-modern .btn-primary { background: linear-gradient(135deg, #3b82f6, #2563eb) !important; box-shadow: 0 14px 26px -12px rgba(37, 99, 235, .85); }
    .page-wrapper .dashboard-container .card-modern .btn-success { background: linear-gradient(135deg, #10b981, #059669) !important; box-shadow: 0 14px 26px -12px rgba(5, 150, 105, .85); }
    .page-wrapper .dashboard-container .card-modern .btn-warning { background: linear-gradient(135deg, #f59e0b, #d97706) !important; box-shadow: 0 14px 26px -12px rgba(217, 119, 6, .85); }

    .page-wrapper .dashboard-container .card-modern .btn:hover { transform: translateY(-2px); filter: brightness(1.06); }
    .page-wrapper .dashboard-container .card-modern .btn:active { transform: scale(.97); }
    .page-wrapper .dashboard-container .card-modern .btn:focus-visible { outline: 3px solid rgba(125, 211, 252, .6); outline-offset: 3px; }

    /* ===== Jam digital ===== */
    .page-wrapper .dashboard-container .dashboard-clock {
        display: inline-flex;
        align-items: baseline;
        gap: 10px;
        padding: 14px 24px;
        color: #fff;
        background: linear-gradient(135deg, #12306e, #0a1a3d);
        border: 1px solid rgba(255, 255, 255, .12);
        border-radius: 24px;
        box-shadow: 0 18px 32px -18px rgba(10, 26, 61, .9), inset 0 1px 0 rgba(255, 255, 255, .14);
    }

    .page-wrapper .dashboard-container .clock-time {
        font-size: clamp(1.6rem, 3.6vw, 2.2rem);
        font-weight: 800;
        letter-spacing: .04em;
        line-height: 1;
        font-variant-numeric: tabular-nums;
        font-feature-settings: "tnum";
        color: #fff;
    }

    .page-wrapper .dashboard-container .clock-zone {
        font-size: .8rem;
        font-weight: 700;
        letter-spacing: .12em;
        color: #7dd3fc;
    }

    /* ===== Efek modern ===== */
    /* aurora latar yang bergerak sangat pelan */
    body::after {
        content: "";
        position: fixed;
        inset: -20%;
        z-index: -1;
        pointer-events: none;
        background:
            radial-gradient(40% 35% at 30% 30%, rgba(56, 189, 248, .16), transparent 70%),
            radial-gradient(35% 40% at 75% 65%, rgba(99, 102, 241, .2), transparent 70%);
        animation: dbAurora 24s ease-in-out infinite alternate;
    }

    /* satu urutan masuk: header lalu kartu satu per satu */
    .page-wrapper .dashboard-container .page-header.dashboard-header { animation: dbRise .7s cubic-bezier(.2, .8, .2, 1) both; }
    .page-wrapper .dashboard-container .row.mt-5 > * { animation: dbRise .7s cubic-bezier(.2, .8, .2, 1) both; }
    .page-wrapper .dashboard-container .row.mt-5 > :nth-child(1) { animation-delay: .15s; }
    .page-wrapper .dashboard-container .row.mt-5 > :nth-child(2) { animation-delay: .27s; }
    .page-wrapper .dashboard-container .row.mt-5 > :nth-child(3) { animation-delay: .39s; }

    /* garis cahaya di atas header bergerak */
    .page-wrapper .dashboard-container .dashboard-header::before {
        inset: 0 0 auto 0;
        background: linear-gradient(90deg, transparent, #2563eb, #38bdf8, #2563eb, transparent);
        background-size: 200% 100%;
        animation: dbSheen 5s linear infinite;
    }

    /* nama pengguna berkilau halus */
    .page-wrapper .dashboard-container .dashboard-title .accent {
        background: linear-gradient(90deg, #1d4ed8, #38bdf8, #1d4ed8) !important;
        background-size: 200% auto !important;
        -webkit-background-clip: text !important;
        background-clip: text !important;
        animation: dbText 6s linear infinite;
    }

    /* indikator "live" pada jam */
    .page-wrapper .dashboard-container .dashboard-clock { align-items: center; }
    .page-wrapper .dashboard-container .dashboard-clock::before {
        content: "";
        width: 10px;
        height: 10px;
        flex-shrink: 0;
        border-radius: 50%;
        background: #34d399;
        box-shadow: 0 0 0 0 rgba(52, 211, 153, .7);
        animation: dbPulse 2s ease-out infinite;
    }

    /* kartu: sorotan mengikuti kursor + garis aksen melebar */
    .page-wrapper .dashboard-container .card-modern { --glow: rgba(59, 130, 246, .16); }
    .page-wrapper .dashboard-container .row.mt-5 > :nth-child(2) .card-modern { --glow: rgba(16, 185, 129, .16); }
    .page-wrapper .dashboard-container .row.mt-5 > :nth-child(3) .card-modern { --glow: rgba(245, 158, 11, .18); }

    .page-wrapper .dashboard-container .card-modern::before { transition: inset .4s ease; }
    .page-wrapper .dashboard-container .card-modern:hover::before { inset: 0 6% auto 6%; }

    .page-wrapper .dashboard-container .card-modern::after {
        content: "";
        position: absolute;
        inset: 0;
        pointer-events: none;
        opacity: 0;
        transition: opacity .3s ease;
        background: radial-gradient(280px circle at var(--mx, 50%) var(--my, 30%), var(--glow), transparent 70%);
    }

    .page-wrapper .dashboard-container .card-modern:hover::after { opacity: 1; }
    .page-wrapper .dashboard-container .card-modern .card-body { position: relative; z-index: 1; }

    /* ikon sedikit "hidup" saat kartu disentuh */
    .page-wrapper .dashboard-container .card-modern .fa-3x { transition: transform .35s cubic-bezier(.3, 1.4, .5, 1); }
    .page-wrapper .dashboard-container .card-modern:hover .fa-3x { transform: translateY(-5px) rotate(-6deg) scale(1.07); }

    /* kilau melintas pada tombol */
    .page-wrapper .dashboard-container .card-modern .btn { position: relative; overflow: hidden; }
    .page-wrapper .dashboard-container .card-modern .btn::after {
        content: "";
        position: absolute;
        top: 0;
        left: -70%;
        width: 40%;
        height: 100%;
        background: linear-gradient(100deg, transparent, rgba(255, 255, 255, .5), transparent);
        transform: skewX(-20deg);
        transition: left .6s ease;
    }
    .page-wrapper .dashboard-container .card-modern .btn:hover::after { left: 130%; }

    /* ===== Tombol & menu Log Out ===== */
    .dropdown-menu {
        padding: 8px;
        border: 1px solid rgba(15, 23, 42, .06);
        border-radius: 18px;
        box-shadow: 0 24px 48px -20px rgba(8, 20, 47, .55);
    }

    .dropdown-menu .dropdown-item,
    .dropdown-menu a {
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: background .2s ease, color .2s ease;
    }

    a[href*="logout"], a[href*="keluar"], [data-logout] {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #dc2626 !important;
        font-weight: 700 !important;
        text-decoration: none !important;
        border-radius: 12px;
        transition: background .2s ease, color .2s ease, transform .2s ease;
    }

    a[href*="logout"]:hover, a[href*="keluar"]:hover, [data-logout]:hover {
        color: #b91c1c !important;
        background: #fef2f2 !important;
        transform: translateX(2px);
    }

    a[href*="logout"]:focus-visible, a[href*="keluar"]:focus-visible, [data-logout]:focus-visible {
        outline: 3px solid rgba(248, 113, 113, .5);
        outline-offset: 2px;
    }

    /* ===== Dialog konfirmasi keluar (selaras panel admin) ===== */
    .logout-modal {
        position: fixed;
        inset: 0;
        z-index: 2000;
        display: grid;
        place-items: center;
        padding: 20px;
        background: rgba(5, 12, 32, .66);
        -webkit-backdrop-filter: blur(6px);
        backdrop-filter: blur(6px);
        opacity: 0;
        transition: opacity .25s ease;
    }

    .logout-modal[hidden] { display: none; }
    .logout-modal.show { opacity: 1; }

    .logout-modal .logout-box {
        position: relative;
        width: 100%;
        max-width: 480px;
        padding: 40px 36px 34px;
        overflow: hidden;
        text-align: center;
        color: #0f172a;
        background: linear-gradient(180deg, #ffffff, #f8fafd);
        border-radius: 36px;
        box-shadow: 0 40px 90px -30px rgba(0, 0, 0, .85);
        transform: translateY(18px) scale(.96);
        transition: transform .3s cubic-bezier(.2, .9, .3, 1.2);
    }

    .logout-modal.show .logout-box { transform: none; }

    /* garis merah-oranye di tepi atas */
    .logout-modal .logout-box::before {
        content: "";
        position: absolute;
        inset: 0 0 auto 0;
        height: 6px;
        background: linear-gradient(90deg, #f43f5e, #ef4444 55%, #f97316);
    }

    .logout-modal .logout-icon {
        display: grid;
        place-items: center;
        width: 88px;
        height: 88px;
        margin: 0 auto 22px;
        color: #dc2626;
        background: #fee2e2;
        border-radius: 50%;
        box-shadow: 0 0 0 14px rgba(254, 226, 226, .5), 0 0 0 15px rgba(248, 113, 113, .12);
    }

    .logout-modal .logout-icon svg { width: 42px; height: 42px; }

    .logout-modal h5 {
        margin: 0 0 10px;
        font-size: 1.5rem;
        font-weight: 800;
        letter-spacing: -.01em;
        color: #111827;
    }

    .logout-modal .logout-sub {
        margin: 0 0 12px;
        font-size: 1rem;
        color: #64748b;
    }

    .logout-modal .logout-from {
        display: inline-block;
        margin-bottom: 22px;
        padding: 10px 24px;
        font-size: 1.02rem;
        font-weight: 800;
        color: #111827;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        border-radius: 999px;
    }

    .logout-modal .logout-warn {
        margin: 0 0 26px;
        padding: 14px 18px;
        text-align: left;
        font-size: .95rem;
        line-height: 1.6;
        color: #92400e;
        background: #fffbeb;
        border: 1px solid #fde68a;
        border-radius: 16px;
    }

    .logout-modal .logout-actions { display: flex; gap: 14px; }

    .logout-modal .lo-btn {
        flex: 1;
        padding: 18px 20px;
        font-family: inherit;
        font-size: 1.05rem;
        font-weight: 800;
        border-radius: 18px;
        cursor: pointer;
        transition: transform .2s ease, filter .2s ease, background .2s ease, box-shadow .2s ease;
    }

    .logout-modal .lo-btn:hover { transform: translateY(-2px); }
    .logout-modal .lo-btn:active { transform: scale(.97); }
    .logout-modal .lo-btn:focus-visible { outline: 3px solid rgba(125, 211, 252, .7); outline-offset: 3px; }

    .logout-modal .lo-cancel {
        color: #111827;
        background: #fff;
        border: 1px solid #e2e8f0;
        box-shadow: 0 1px 2px rgba(15, 23, 42, .05);
    }
    .logout-modal .lo-cancel:hover { background: #f8fafc; }

    .logout-modal .lo-confirm {
        color: #fff;
        border: 0;
        background: linear-gradient(135deg, #f43f5e, #dc2626);
        box-shadow: 0 16px 28px -12px rgba(220, 38, 38, .85);
    }
    .logout-modal .lo-confirm:hover { filter: brightness(1.07); }

    @media (max-width: 480px) {
        .logout-modal .logout-box { padding: 34px 22px 26px; border-radius: 30px; }
        .logout-modal .logout-actions { flex-direction: column-reverse; }
    }

    @keyframes dbRise {
        from { opacity: 0; transform: translateY(24px) scale(.98); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }
    @keyframes dbSheen  { to { background-position: -200% 0; } }
    @keyframes dbText   { to { background-position: 200% center; } }
    @keyframes dbPulse  {
        70%  { box-shadow: 0 0 0 10px rgba(52, 211, 153, 0); }
        100% { box-shadow: 0 0 0 0 rgba(52, 211, 153, 0); }
    }
    @keyframes dbAurora {
        from { transform: translate(-3%, -2%) scale(1); }
        to   { transform: translate(4%, 3%) scale(1.08); }
    }

    @keyframes dbFloat {
        0%, 100% { transform: translate(0, 0); }
        50%      { transform: translate(-10px, 12px); }
    }

    /* ===== Responsif ===== */
    @media (max-width: 991.98px) {
        .page-wrapper .dashboard-container { padding: 20px 16px 40px; }
    }

    @media (max-width: 767.98px) {
        .page-wrapper .dashboard-container .page-header.dashboard-header { padding: 22px 18px !important; border-radius: 26px !important; text-align: center; }
        .page-wrapper .dashboard-container .dashboard-header .row { justify-content: center; row-gap: 14px; }
        .page-wrapper .dashboard-container .dashboard-header .col-auto,
        .page-wrapper .dashboard-container .dashboard-header .col { flex: 0 0 100%; max-width: 100%; }
        .page-wrapper .dashboard-container .header-logo { margin: 0 auto; width: 80px !important; height: 80px !important; }
        .page-wrapper .dashboard-container .dashboard-header .col-12 { flex: 0 0 100%; max-width: 100%; }
        .page-wrapper .dashboard-container .dashboard-clock { justify-content: center; width: 100%; }
        .page-wrapper .dashboard-container .card-modern { border-radius: 26px !important; }
        .page-wrapper .dashboard-container .card-modern .btn { width: 100%; }
    }

    @media (prefers-reduced-motion: reduce) {
        *, *::before, *::after { animation: none !important; transition: none !important; }
    }
</style>

<div class="page-wrapper">
    <div class="content container-fluid dashboard-container">
        <!-- Header Section -->
        <div class="page-header dashboard-header">
            <div class="row align-items-center">
                <div class="col-auto">
                    <img src="{{ asset('assets/images/logo_kominfo.png') }}" alt="Dinas Kominfo Logo" class="header-logo">
                </div>
                <div class="col">
                    <?php
                        date_default_timezone_set("Asia/Jakarta");
                        $hour = date("G");

                        $hari = [
                            'Sunday' => 'Minggu',
                            'Monday' => 'Senin',
                            'Tuesday' => 'Selasa',
                            'Wednesday' => 'Rabu',
                            'Thursday' => 'Kamis',
                            'Friday' => 'Jumat',
                            'Saturday' => 'Sabtu'
                        ];
                        $bulan = [
                            'Jan' => 'Januari',
                            'Feb' => 'Februari',
                            'Mar' => 'Maret',
                            'Apr' => 'April',
                            'May' => 'Mei',
                            'Jun' => 'Juni',
                            'Jul' => 'Juli',
                            'Aug' => 'Agustus',
                            'Sep' => 'September',
                            'Oct' => 'Oktober',
                            'Nov' => 'November',
                            'Dec' => 'Desember'
                        ];

                        $nama_hari_id = $hari[date("l")];
                        $nama_bulan_id = $bulan[date("M")];
                        $tanggal = date("d");
                        $tahun = date("Y");

                        $msg = $nama_hari_id . ", " . $tanggal . " " . $nama_bulan_id . " " . $tahun;

                        $greet = match (true) {
                            $hour >= 0 && $hour <= 10 => "Selamat Pagi",
                            $hour >= 11 && $hour <= 14 => "Selamat Siang",
                            $hour >= 15 && $hour <= 17 => "Selamat Sore",
                            default => "Selamat Malam",
                        };
                        $userName = Session::get('name', 'Pengguna');
                    ?>
                    <h3 class="page-title dashboard-title">{{ $greet }}, <span class="accent">{{ $userName }}</span>!</h3>
                    <h4 class="dashboard-date">{{ $msg }}</h4>
                </div>
                <div class="col-12 col-lg-auto">
                    <div class="dashboard-clock" aria-label="Jam digital WIB">
                        <span class="clock-time" id="digitalClock">{{ date('H:i:s') }}</span>
                        <span class="clock-zone">WIB</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Background Image -->
        <div class="background-image"></div>

        <!-- Animated Circles -->
        <div class="decorative-circle decorative-circle-2"></div>
        <div class="decorative-circle decorative-circle-3"></div>

        <!-- Main Content -->
        <div class="row mt-5">

            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card card-modern shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="fas fa-user-friends fa-3x mb-3 text-primary"></i>
                        <h5 class="card-title">Data Diri Pegawai</h5>
                        <p class="card-text">Kelola semua informasi dan Data Diri Anda.</p>
                        <a href="{{ route('datadiri') }}" class="btn btn-primary btn-sm rounded-pill">Lihat Data</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card card-modern shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="fas fa-book-open fa-3x mb-3 text-success"></i>
                        <h5 class="card-title">Riwayat Pendidikan</h5>
                        <p class="card-text">Catat dan kelola riwayat pendidikan terakhir Anda.</p>
                        <a href="{{ route('pendidikan') }}" class="btn btn-success btn-sm rounded-pill">Lihat Pendidikan</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4 mb-4">
                <div class="card card-modern shadow-sm border-0">
                    <div class="card-body text-center">
                        <i class="fas fa-briefcase fa-3x mb-3 text-warning"></i>
                        <h5 class="card-title">Riwayat Pekerjaan</h5>
                        <p class="card-text">Kelola data mutasi dan riwayat pekerjaan Anda.</p>
                        <a href="{{ route('pekerjaan') }}" class="btn btn-warning btn-sm rounded-pill">Lihat Pekerjaan</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Dialog konfirmasi keluar -->
<div class="logout-modal" id="logoutModal" role="alertdialog" aria-modal="true" aria-labelledby="logoutTitle" aria-describedby="logoutDesc" hidden>
    <div class="logout-box">
        <div class="logout-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><path d="M12 9v4"/><path d="M12 17h.01"/>
            </svg>
        </div>
        <h5 id="logoutTitle">Keluar dari akun?</h5>
        <p class="logout-sub">Anda akan keluar dari:</p>
        <span class="logout-from">Dashboard Pegawai</span>
        <p class="logout-warn" id="logoutDesc">⚠️ Sesi Anda akan diakhiri dan Anda perlu <strong>login kembali</strong> untuk mengelola data Anda.</p>
        <div class="logout-actions">
            <button type="button" class="lo-btn lo-cancel" data-lo="cancel">Batal</button>
            <button type="button" class="lo-btn lo-confirm" data-lo="confirm">Ya, Keluar</button>
        </div>
    </div>
</div>

<script>
    // Jam digital real time (WIB) — diperbarui tiap detik
    (function () {
        var el = document.getElementById('digitalClock');
        if (!el) return;

        var fmt = new Intl.DateTimeFormat('en-GB', {
            hour: '2-digit', minute: '2-digit', second: '2-digit',
            hour12: false, timeZone: 'Asia/Jakarta'
        });

        function tick() { el.textContent = fmt.format(new Date()); }

        tick();
        setInterval(tick, 1000);
    })();

    // Sorotan cahaya yang mengikuti kursor pada kartu menu
    (function () {
        document.querySelectorAll('.card-modern').forEach(function (card) {
            card.addEventListener('pointermove', function (e) {
                var r = card.getBoundingClientRect();
                card.style.setProperty('--mx', (e.clientX - r.left) + 'px');
                card.style.setProperty('--my', (e.clientY - r.top) + 'px');
            });
        });
    })();

    // Konfirmasi sebelum keluar (Log Out)
    (function () {
        var modal = document.getElementById('logoutModal');
        if (!modal) return;

        var cancelBtn = modal.querySelector('[data-lo="cancel"]');
        var confirmBtn = modal.querySelector('[data-lo="confirm"]');
        var pending = null, bypass = false, lastFocus = null;

        function isLogout(el) {
            if (!el || modal.contains(el)) return false;
            var href = (el.getAttribute('href') || '').toLowerCase();
            var form = el.closest('form');
            var action = form ? (form.getAttribute('action') || '').toLowerCase() : '';
            var text = (el.textContent || '').trim().toLowerCase();
            return /logout|keluar/.test(href)
                || (/logout|keluar/.test(action) && el.matches('button, input[type=submit]'))
                || el.hasAttribute('data-logout')
                || /^(log ?out|sign ?out|keluar)$/.test(text);
        }

        function openModal() {
            lastFocus = document.activeElement;
            modal.hidden = false;
            requestAnimationFrame(function () { modal.classList.add('show'); });
            cancelBtn.focus();
        }

        function closeModal() {
            modal.classList.remove('show');
            setTimeout(function () { modal.hidden = true; }, 250);
            if (lastFocus && lastFocus.focus) lastFocus.focus();
        }

        // Ditangkap lebih awal agar aksi bawaan tombol ditahan sampai dikonfirmasi
        document.addEventListener('click', function (e) {
            if (bypass) return;
            var el = e.target.closest('a, button, input[type=submit]');
            if (!isLogout(el)) return;
            e.preventDefault();
            e.stopPropagation();
            pending = el;
            openModal();
        }, true);

        confirmBtn.addEventListener('click', function () {
            var el = pending;
            pending = null;
            modal.classList.remove('show');
            modal.hidden = true;
            if (!el) return;
            bypass = true;
            el.click(); // jalankan aksi logout asli (link atau form)
            setTimeout(function () { bypass = false; }, 0);
        });

        cancelBtn.addEventListener('click', function () { pending = null; closeModal(); });
        modal.addEventListener('click', function (e) { if (e.target === modal) { pending = null; closeModal(); } });

        document.addEventListener('keydown', function (e) {
            if (modal.hidden) return;
            if (e.key === 'Escape') { pending = null; closeModal(); }
            if (e.key === 'Tab') {
                var first = cancelBtn, last = confirmBtn;
                if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
                else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
            }
        });
    })();
</script>
@endsection

@section('style')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
@endsection

@section('script')
<script src="{{ asset('assets/js/dashboard.js') }}"></script>
@endsection