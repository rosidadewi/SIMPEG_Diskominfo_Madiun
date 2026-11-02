@extends('layouts.minimal')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    :root {
        --primary: #2563eb;
        --primary-soft: #eff6ff;
        --success: #16a34a;
        --success-soft: #dcfce7;
        --danger: #dc2626;
        --danger-soft: #fee2e2;
        --muted: #64748b;
        --ink: #0f172a;
        --line: #e2e8f0;
    }

    body {
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        background:
            radial-gradient(circle at 10% 0%, rgba(37, 99, 235, .15), transparent 40%),
            radial-gradient(circle at 90% 10%, rgba(14, 165, 233, .15), transparent 40%),
            linear-gradient(135deg, #f8fafc, #dbeafe);
        min-height: 100vh;
        background-attachment: fixed;
        color: var(--ink);
    }

    .dash-wrap {
        max-width: 1200px;
        margin: 0 auto;
        padding: 24px 16px 48px;
    }

    /* ===== Header ===== */
    .dash-header {
        background: linear-gradient(135deg, #1e40af, #2563eb 55%, #0ea5e9);
        background-size: 200% 200%;
        animation: headerFlow 12s ease-in-out infinite, fadeDown .6s ease both;
        border-radius: 24px;
        padding: 28px;
        color: #fff;
        box-shadow: 0 20px 40px -12px rgba(37, 99, 235, .45);
        position: relative;
        overflow: hidden;
    }

    .dash-header::before {
        content: "";
        position: absolute;
        left: -80px;
        bottom: -90px;
        width: 240px;
        height: 240px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .08);
        animation: floatBlob 9s ease-in-out infinite;
    }

    .dash-header::after {
        content: "";
        position: absolute;
        right: -60px;
        top: -60px;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .12);
        animation: floatBlob 7s ease-in-out infinite reverse;
    }

    .dash-header h2 {
        font-weight: 800;
        font-size: clamp(1.4rem, 3vw, 1.9rem);
        margin: 0;
    }

    .dash-header p {
        margin: 4px 0 0;
        opacity: .85;
        font-size: .95rem;
    }

    .btn-logout {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        background: linear-gradient(135deg, #ef4444, #dc2626);
        border: none;
        color: #fff;
        font-weight: 700;
        letter-spacing: .2px;
        border-radius: 14px;
        padding: 11px 22px;
        box-shadow: 0 8px 20px -6px rgba(220, 38, 38, .65);
        position: relative;
        z-index: 1;
    }

    .btn-logout svg {
        width: 20px;
        height: 20px;
        flex-shrink: 0;
        transition: transform .25s ease;
    }

    .btn-logout:hover {
        background: linear-gradient(135deg, #f87171, #b91c1c);
        color: #fff;
        box-shadow: 0 12px 26px -6px rgba(220, 38, 38, .8);
    }

    .btn-logout:hover svg {
        transform: translateX(3px);
    }

    .btn-logout:active {
        transform: scale(.97);
    }

    /* ===== Stats ===== */
    .stat-row {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 20px;
        position: relative;
        z-index: 1;
    }

    .stat-pill {
        background: rgba(255, 255, 255, .16);
        border: 1px solid rgba(255, 255, 255, .25);
        -webkit-backdrop-filter: blur(10px);
        backdrop-filter: blur(10px);
        border-radius: 14px;
        padding: 10px 16px;
        min-width: 120px;
        transition: transform .25s ease, background .25s ease;
    }

    .stat-pill:hover {
        transform: translateY(-3px);
        background: rgba(255, 255, 255, .24);
    }

    .stat-pill small {
        display: block;
        opacity: .8;
        font-size: .75rem;
    }

    .stat-pill strong {
        font-size: 1.35rem;
        font-weight: 800;
        display: inline-block;
    }

    .stat-pill strong.bump {
        animation: bump .35s ease;
    }

    /* ===== Search ===== */
    .search-sticky {
        position: sticky;
        top: 10px;
        z-index: 20;
        margin: 22px 0 8px;
    }

    .search-box {
        position: relative;
        display: flex;
        align-items: center;
        background: rgba(255, 255, 255, .85);
        -webkit-backdrop-filter: blur(14px);
        backdrop-filter: blur(14px);
        border: 1px solid var(--line);
        border-radius: 18px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, .08);
        transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease;
    }

    .search-box:focus-within {
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(37, 99, 235, .15), 0 12px 30px rgba(37, 99, 235, .15);
        transform: translateY(-1px);
    }

    .search-icon {
        position: absolute;
        left: 18px;
        width: 20px;
        height: 20px;
        color: var(--muted);
        pointer-events: none;
        transition: color .2s ease;
    }

    .search-box:focus-within .search-icon {
        color: var(--primary);
    }

    .search-box input {
        flex: 1;
        width: 100%;
        min-width: 0;
        border: none !important;
        outline: none !important;
        box-shadow: none !important;
        background: transparent !important;
        padding: 15px 48px 15px 50px;
        font-size: 1rem;
        border-radius: 18px;
    }

    .search-clear {
        position: absolute;
        right: 12px;
        width: 30px;
        height: 30px;
        border: none;
        border-radius: 50%;
        background: #e2e8f0;
        color: var(--muted);
        display: none;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        line-height: 1;
        cursor: pointer;
        transition: background .2s ease, color .2s ease, transform .2s ease;
    }

    .search-clear.show {
        display: inline-flex;
        animation: popIn .2s ease;
    }

    .search-clear:hover {
        background: var(--danger-soft);
        color: var(--danger);
        transform: rotate(90deg);
    }

    .search-meta {
        font-size: .82rem;
        color: var(--muted);
        margin: 10px 6px 18px;
        min-height: 1.2em;
        transition: opacity .2s ease;
    }

    .search-meta strong {
        color: var(--primary);
    }

    mark.hl {
        background: linear-gradient(120deg, #fde68a, #fcd34d);
        color: inherit;
        padding: 0 3px;
        border-radius: 5px;
    }

    /* ===== Cards ===== */
    .user-card {
        animation: cardIn .55s cubic-bezier(.2, .8, .2, 1) both;
        animation-delay: calc(var(--i, 0) * 45ms);
    }

    .user-card.is-hidden {
        display: none !important;
    }

    .user-card.pop {
        animation: cardPop .35s cubic-bezier(.2, .8, .2, 1) both;
        animation-delay: 0ms;
    }

    .user-card .card {
        --ring: #cbd5e1;
        display: flex;
        flex-direction: column;
        height: 100%;
        position: relative;
        overflow: hidden;
        background: #fff;
        border: 1px solid rgba(226, 232, 240, .9);
        border-radius: 22px;
        box-shadow: 0 6px 18px rgba(15, 23, 42, .06);
        transition: transform .25s ease, box-shadow .25s ease;
    }

    /* cincin avatar mengikuti status */
    .user-card .card:has(.status-btn.btn-success) {
        --ring: #86efac;
    }

    .user-card .card::before {
        content: "";
        position: absolute;
        inset: 0;
        border-radius: 22px;
        padding: 1.5px;
        background: linear-gradient(135deg, #60a5fa, #38bdf8, #818cf8);
        -webkit-mask: linear-gradient(#000 0 0) content-box, linear-gradient(#000 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        opacity: 0;
        transition: opacity .3s ease;
        pointer-events: none;
        z-index: 3;
    }

    .user-card .card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 38px rgba(37, 99, 235, .2);
    }

    .user-card .card:hover::before {
        opacity: 1;
    }

    /* Cover */
    .user-card .card-cover {
        position: relative;
        height: 92px;
        flex-shrink: 0;
        overflow: hidden;
        background: linear-gradient(135deg, #bfdbfe, #93c5fd 55%, #7dd3fc);
        background-size: 160% 160%;
        background-position: 0% 0%;
        transition: background-position .6s ease;
    }

    .user-card .card:hover .card-cover {
        background-position: 100% 100%;
    }

    .user-card .card-cover::before,
    .user-card .card-cover::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, .28);
        pointer-events: none;
    }

    .user-card .card-cover::before {
        width: 130px;
        height: 130px;
        left: -34px;
        top: -56px;
    }

    .user-card .card-cover::after {
        width: 110px;
        height: 110px;
        right: 46px;
        bottom: -66px;
        background: rgba(255, 255, 255, .2);
    }

    /* Body */
    .user-card .card-body {
        flex: 1 1 auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: -46px;
        padding: 0 1.25rem 1.25rem;
        position: relative;
        z-index: 1;
    }

    .user-card .card-body img {
        width: 92px;
        height: 92px;
        object-fit: cover;
        border: 4px solid #fff;
        background: #fff;
        box-shadow: 0 0 0 3px var(--ring), 0 10px 22px rgba(15, 23, 42, .18);
        transition: transform .35s ease, box-shadow .35s ease;
    }

    .user-card .card:hover .card-body img {
        transform: scale(1.06) rotate(-3deg);
    }

    .user-card .card-title {
        font-size: 1.05rem;
        font-weight: 800;
        line-height: 1.3;
        margin: 14px 0 8px;
        word-break: break-word;
    }

    .user-card .user-email {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        max-width: 100%;
        margin: 0 0 18px;
        padding: 5px 12px;
        background: #f1f5f9;
        border-radius: 999px;
        color: var(--muted);
        font-size: .8rem;
        word-break: break-all;
        text-align: left;
    }

    .user-card .user-email::before {
        content: "✉";
        font-size: .85rem;
        opacity: .7;
        flex-shrink: 0;
    }

    /* Area tombol aksi */
    .user-card .card-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        width: 100%;
        margin-top: auto;
        padding-top: 16px;
        border-top: 1px dashed var(--line);
    }

    .user-card .card-actions .delete-form {
        flex: 1 1 88px;
        margin: 0;
    }

    .user-card .card-actions .btn-detail {
        flex: 2 1 130px;
    }

    /* ===== Buttons ===== */
    .btn {
        transition: all .25s ease-in-out;
        border-radius: 12px;
        font-weight: 600;
        position: relative;
        overflow: hidden;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, .15);
    }

    .btn:active {
        transform: scale(.98);
    }

    /* selector di-scope agar tidak tertimpa class .btn bawaan Bootstrap */
    .user-card .btn-detail,
    .user-card .btn-delete {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        width: 100%;
        padding: 10px 12px;
        font-size: .86rem;
        font-weight: 700;
        line-height: 1.2;
        white-space: nowrap;
        text-decoration: none;
        border: 1px solid transparent;
        border-radius: 12px;
        cursor: pointer;
    }

    .user-card .btn-detail svg,
    .user-card .btn-delete svg {
        width: 16px;
        height: 16px;
        flex-shrink: 0;
        transition: transform .25s ease;
    }

    .user-card .btn-detail {
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        color: #fff;
        box-shadow: 0 8px 18px -8px rgba(37, 99, 235, .75);
    }

    .user-card .btn-detail:hover,
    .user-card .btn-detail:focus {
        background: linear-gradient(135deg, #1d4ed8, #2563eb);
        color: #fff;
        box-shadow: 0 12px 24px -8px rgba(37, 99, 235, .85);
    }

    .user-card .btn-detail:hover svg {
        transform: translateX(3px);
    }

    .user-card .btn-delete {
        background: #fff5f5;
        color: var(--danger);
        border-color: #fecaca;
    }

    .user-card .btn-delete:hover,
    .user-card .btn-delete:focus {
        background: var(--danger);
        border-color: var(--danger);
        color: #fff;
        box-shadow: 0 10px 22px -8px rgba(220, 38, 38, .8);
    }

    .user-card .btn-delete:hover svg {
        transform: rotate(-12deg) scale(1.1);
    }

    .user-card .btn:focus-visible {
        outline: 3px solid rgba(37, 99, 235, .35);
        outline-offset: 2px;
    }

    /* kilau halus saat hover */
    .btn-detail::after,
    .btn-delete::after {
        content: "";
        position: absolute;
        top: 0;
        left: -120%;
        width: 60%;
        height: 100%;
        background: linear-gradient(120deg, transparent, rgba(255, 255, 255, .45), transparent);
        transform: skewX(-20deg);
        transition: left .6s ease;
        pointer-events: none;
    }

    .btn-detail:hover::after,
    .btn-delete:hover::after {
        left: 140%;
    }

    /* Tombol status (pil di pojok cover) */
    .user-card .status-btn {
        position: absolute;
        top: 12px;
        right: 12px;
        z-index: 2;
        display: inline-flex;
        align-items: center;
        width: auto;
        padding: 6px 12px;
        font-size: .75rem;
        font-weight: 700;
        line-height: 1.2;
        border: 1px solid transparent;
        border-radius: 999px;
        cursor: pointer;
        box-shadow: 0 6px 14px -6px rgba(15, 23, 42, .35);
        transition: all .2s ease-in-out;
    }

    .user-card .status-btn.btn-success {
        background: var(--success-soft);
        color: #15803d;
        border-color: #bbf7d0;
    }

    .user-card .status-btn.btn-secondary {
        background: rgba(255, 255, 255, .92);
        color: var(--muted);
        border-color: var(--line);
    }

    .user-card .status-btn.btn-success:hover,
    .user-card .status-btn.btn-secondary:hover {
        filter: brightness(.97);
        transform: translateY(-1px);
    }

    /* ===== Empty state ===== */
    #emptyState {
        display: none;
        text-align: center;
        padding: 48px 16px;
        color: var(--muted);
    }

    #emptyState.show {
        display: block;
        animation: cardPop .4s ease both;
    }

    #emptyState .emoji {
        font-size: 3rem;
        display: inline-block;
        animation: wobble 2.4s ease-in-out infinite;
    }

    /* ===== Modal konfirmasi hapus ===== */
    .confirm-overlay {
        position: fixed;
        inset: 0;
        z-index: 1080;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 16px;
        background: rgba(15, 23, 42, .55);
        -webkit-backdrop-filter: blur(6px);
        backdrop-filter: blur(6px);
    }

    .confirm-overlay.show {
        display: flex;
        animation: overlayIn .25s ease both;
    }

    .confirm-dialog {
        width: 100%;
        max-width: 420px;
        background: #fff;
        border-radius: 24px;
        padding: 30px 26px 24px;
        text-align: center;
        box-shadow: 0 30px 60px -12px rgba(15, 23, 42, .45);
        position: relative;
        overflow: hidden;
        animation: dialogIn .35s cubic-bezier(.2, .9, .3, 1.2) both;
    }

    .confirm-dialog::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #f87171, #dc2626, #f97316);
    }

    .confirm-icon {
        width: 76px;
        height: 76px;
        margin: 0 auto 16px;
        border-radius: 50%;
        background: var(--danger-soft);
        color: var(--danger);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .confirm-icon::after {
        content: "";
        position: absolute;
        inset: -8px;
        border-radius: 50%;
        border: 2px solid rgba(220, 38, 38, .25);
        animation: pulseRing 1.8s ease-out infinite;
    }

    .confirm-icon svg {
        width: 36px;
        height: 36px;
        animation: shake .6s .25s ease both;
    }

    .confirm-dialog h4 {
        font-weight: 800;
        font-size: 1.25rem;
        margin: 0 0 8px;
    }

    .confirm-dialog p {
        color: var(--muted);
        font-size: .92rem;
        margin: 0;
    }

    .confirm-name {
        display: inline-block;
        margin: 12px 0 4px;
        padding: 6px 14px;
        background: #f1f5f9;
        border: 1px solid var(--line);
        border-radius: 999px;
        font-weight: 700;
        font-size: .9rem;
        color: var(--ink);
        max-width: 100%;
        word-break: break-word;
    }

    .confirm-note {
        margin-top: 14px !important;
        padding: 10px 12px;
        background: #fffbeb;
        border: 1px solid #fde68a;
        border-radius: 12px;
        color: #92400e !important;
        font-size: .8rem !important;
        text-align: left;
    }

    .confirm-actions {
        display: flex;
        gap: 10px;
        margin-top: 22px;
    }

    .confirm-actions .btn {
        flex: 1;
        padding: 11px 14px;
    }

    .confirm-actions .btn-cancel {
        background: #f1f5f9;
        border: none;
        color: var(--ink);
    }

    .confirm-actions .btn-cancel:hover {
        background: #e2e8f0;
        color: var(--ink);
    }

    .btn-confirm-delete {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        border: none;
        color: #fff;
        box-shadow: 0 8px 20px -6px rgba(220, 38, 38, .65);
    }

    .btn-confirm-delete:hover {
        background: linear-gradient(135deg, #f87171, #b91c1c);
        color: #fff;
    }

    .btn-confirm-delete.loading {
        pointer-events: none;
        opacity: .85;
    }

    .btn-confirm-delete.loading::before {
        content: "";
        display: inline-block;
        width: 14px;
        height: 14px;
        margin-right: 8px;
        vertical-align: -2px;
        border: 2px solid rgba(255, 255, 255, .5);
        border-top-color: #fff;
        border-radius: 50%;
        animation: spin .7s linear infinite;
    }

    @keyframes overlayIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes dialogIn {
        from { opacity: 0; transform: translateY(24px) scale(.9); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }

    @keyframes pulseRing {
        0% { transform: scale(.9); opacity: 1; }
        100% { transform: scale(1.35); opacity: 0; }
    }

    @keyframes shake {
        0%, 100% { transform: rotate(0); }
        20% { transform: rotate(-12deg); }
        40% { transform: rotate(10deg); }
        60% { transform: rotate(-6deg); }
        80% { transform: rotate(4deg); }
    }

    @keyframes spin {
        to { transform: rotate(360deg); }
    }

    @media (max-width: 575.98px) {
        .confirm-dialog {
            padding: 26px 20px 20px;
            border-radius: 22px;
        }

        .confirm-actions {
            flex-direction: column-reverse;
        }
    }

    /* ===== Keyframes ===== */
    @keyframes headerFlow {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    @keyframes floatBlob {
        0%, 100% { transform: translate(0, 0) scale(1); }
        50% { transform: translate(-14px, 12px) scale(1.06); }
    }

    @keyframes fadeDown {
        from { opacity: 0; transform: translateY(-14px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes cardIn {
        from { opacity: 0; transform: translateY(22px) scale(.97); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }

    @keyframes cardPop {
        from { opacity: 0; transform: scale(.94); }
        to { opacity: 1; transform: scale(1); }
    }

    @keyframes popIn {
        from { opacity: 0; transform: scale(.6); }
        to { opacity: 1; transform: scale(1); }
    }

    @keyframes bump {
        0% { transform: scale(1); }
        50% { transform: scale(1.3); }
        100% { transform: scale(1); }
    }

    @keyframes wobble {
        0%, 100% { transform: rotate(-6deg); }
        50% { transform: rotate(6deg); }
    }

    @media (max-width: 575.98px) {
        .dash-header {
            padding: 20px;
            border-radius: 20px;
        }

        .btn-logout {
            width: 100%;
        }

        .stat-pill {
            flex: 1 1 calc(50% - 12px);
            min-width: 0;
        }

        .search-box input {
            padding-top: 13px;
            padding-bottom: 13px;
            font-size: .95rem;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        *, *::before, *::after {
            animation: none !important;
            transition: none !important;
        }
    }

    /* =====================================================
       Polish v2 — tampilan lebih modern, jelas & responsif
       ===================================================== */
    html { scroll-behavior: smooth; }
    ::selection { background: rgba(37, 99, 235, .22); }

    body::before {
        content: "";
        position: fixed;
        inset: 0;
        z-index: 0;
        pointer-events: none;
        background-image: radial-gradient(rgba(37, 99, 235, .16) 1px, transparent 1px);
        background-size: 22px 22px;
        -webkit-mask-image: linear-gradient(to bottom, #000, transparent 65%);
        mask-image: linear-gradient(to bottom, #000, transparent 65%);
    }

    .dash-wrap { position: relative; z-index: 1; }

    /* --- Header --- */
    .dash-header {
        padding: 32px;
        border: 1px solid rgba(255, 255, 255, .18);
    }

    .head-grid {
        position: absolute;
        inset: 0;
        pointer-events: none;
        opacity: .55;
        background-image:
            linear-gradient(rgba(255, 255, 255, .09) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, .09) 1px, transparent 1px);
        background-size: 34px 34px;
        -webkit-mask-image: linear-gradient(115deg, #000 0%, transparent 58%);
        mask-image: linear-gradient(115deg, #000 0%, transparent 58%);
    }

    .head-brand {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .head-icon {
        flex-shrink: 0;
        width: 58px;
        height: 58px;
        display: grid;
        place-items: center;
        border-radius: 18px;
        background: rgba(255, 255, 255, .18);
        border: 1px solid rgba(255, 255, 255, .32);
        -webkit-backdrop-filter: blur(8px);
        backdrop-filter: blur(8px);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, .35), 0 12px 26px -10px rgba(0, 0, 0, .4);
    }

    .head-icon svg { width: 28px; height: 28px; }

    .head-eyebrow {
        display: inline-block;
        margin-bottom: 2px;
        font-size: .7rem;
        font-weight: 700;
        letter-spacing: .14em;
        text-transform: uppercase;
        opacity: .8;
    }

    .dash-header h2 { letter-spacing: -.02em; line-height: 1.15; }
    .dash-header p { max-width: 46ch; line-height: 1.5; }

    /* --- Statistik --- */
    .stat-row { gap: 14px; margin-top: 26px; }

    .stat-pill {
        display: flex;
        flex-direction: column;
        gap: 4px;
        min-width: 150px;
        padding: 12px 18px;
        border-radius: 16px;
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, .25);
    }

    .stat-pill small {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        font-size: .74rem;
        font-weight: 600;
        line-height: 1.25;
        letter-spacing: .02em;
        opacity: .92;
    }

    .stat-pill strong {
        font-size: 1.7rem;
        line-height: 1.1;
        font-variant-numeric: tabular-nums;
    }

    .stat-dot {
        flex-shrink: 0;
        width: 8px;
        height: 8px;
        margin-top: .3em;
        border-radius: 50%;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(255, 255, 255, .22);
    }

    .stat-dot.is-active {
        background: #4ade80;
        box-shadow: 0 0 0 3px rgba(74, 222, 128, .28), 0 0 10px #4ade80;
    }

    .stat-dot.is-inactive {
        background: #cbd5e1;
        box-shadow: 0 0 0 3px rgba(203, 213, 225, .22);
    }

    /* --- Pencarian & judul bagian --- */
    .search-box { border-radius: 20px; }
    .search-box input::placeholder { color: #94a3b8; font-weight: 400; }
    .search-box input { font-weight: 500; }

    .section-head {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 6px 16px;
        margin: 4px 4px 18px;
    }

    .section-head h3 {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0;
        font-size: 1.15rem;
        font-weight: 800;
        letter-spacing: -.01em;
    }

    .section-count {
        padding: 3px 10px;
        font-size: .72rem;
        font-weight: 700;
        letter-spacing: 0;
        color: var(--primary);
        background: var(--primary-soft);
        border: 1px solid #bfdbfe;
        border-radius: 999px;
    }

    .section-hint {
        margin: 0;
        font-size: .8rem;
        color: var(--muted);
    }

    /* --- Kartu pegawai --- */
    .user-card .card,
    .user-card .card::before { border-radius: 24px; }

    /* warna cover mengikuti status agar jelas dilihat sekilas */
    .user-card .card:has(.status-btn.btn-success) .card-cover {
        background-image: linear-gradient(135deg, #bbf7d0, #86efac 50%, #67e8f9);
    }

    .user-card .card:has(.status-btn.btn-secondary) .card-cover {
        background-image: linear-gradient(135deg, #e2e8f0, #cbd5e1 55%, #bfdbfe);
    }

    /* titik status di sudut foto */
    .user-card .card-body::before {
        content: "";
        position: absolute;
        top: 66px;
        left: calc(50% + 26px);
        z-index: 2;
        width: 20px;
        height: 20px;
        border: 3px solid #fff;
        border-radius: 50%;
        background: #94a3b8;
        box-shadow: 0 2px 6px rgba(15, 23, 42, .25);
        transition: background .25s ease;
    }

    .user-card .card:has(.status-btn.btn-success) .card-body::before {
        background: #22c55e;
        animation: statusPulse 2s ease-out infinite;
    }

    .user-card .card-title { letter-spacing: -.01em; color: var(--ink); }

    .user-card .card-actions .btn-detail,
    .user-card .card-actions .btn-delete { padding: 11px 12px; }

    /* --- Fokus keyboard --- */
    .btn:focus-visible,
    .search-clear:focus-visible,
    .user-card .status-btn:focus-visible {
        outline: 3px solid rgba(37, 99, 235, .4);
        outline-offset: 2px;
    }

    /* --- Kondisi kosong --- */
    #emptyState {
        margin-top: 8px;
        background: rgba(255, 255, 255, .7);
        -webkit-backdrop-filter: blur(10px);
        backdrop-filter: blur(10px);
        border: 2px dashed #cbd5e1;
        border-radius: 24px;
    }

    @keyframes statusPulse {
        0%   { box-shadow: 0 0 0 0 rgba(34, 197, 94, .55), 0 2px 6px rgba(15, 23, 42, .25); }
        100% { box-shadow: 0 0 0 10px rgba(34, 197, 94, 0), 0 2px 6px rgba(15, 23, 42, .25); }
    }

    @keyframes sheetIn {
        from { transform: translateY(100%); }
        to   { transform: translateY(0); }
    }

    /* --- Responsif --- */
    @media (max-width: 767.98px) {
        .head-icon { width: 48px; height: 48px; border-radius: 15px; }
        .head-icon svg { width: 24px; height: 24px; }
    }

    @media (max-width: 575.98px) {
        .dash-wrap { padding: 16px 14px 40px; }

        .dash-header { padding: 22px 18px; border-radius: 22px; }
        .head-brand { gap: 12px; }

        .stat-row {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 8px;
            margin-top: 20px;
        }

        .stat-pill { min-width: 0; padding: 10px 12px; border-radius: 14px; }
        .stat-pill small { font-size: .68rem; gap: 6px; }
        .stat-pill strong { font-size: 1.35rem; }

        .section-head { flex-direction: column; align-items: flex-start; gap: 4px; }

        /* modal tampil sebagai bottom sheet di HP */
        .confirm-overlay { align-items: flex-end; padding: 0; }

        .confirm-dialog {
            max-width: none;
            padding: 26px 20px calc(20px + env(safe-area-inset-bottom));
            border-radius: 26px 26px 0 0;
            animation: sheetIn .35s cubic-bezier(.2, .9, .3, 1) both;
        }
    }

    /* =====================================================
       Polish v3 — kartu & tombol lebih modern
       ===================================================== */
    .btn { font-family: inherit; letter-spacing: .01em; }

    /* --- Header & logout --- */
    .dash-header { border-radius: 28px; }
    .dash-header p { max-width: 60ch; }

    .head-eyebrow {
        display: inline-flex;
        align-items: center;
        margin-bottom: 8px;
        padding: 4px 12px;
        border-radius: 999px;
        background: rgba(255, 255, 255, .14);
        border: 1px solid rgba(255, 255, 255, .26);
        opacity: 1;
    }

    .stat-pill {
        background: linear-gradient(160deg, rgba(255, 255, 255, .24), rgba(255, 255, 255, .1));
        border-color: rgba(255, 255, 255, .3);
    }

    .btn-logout {
        padding: 12px 24px;
        border-radius: 999px;
        border: 1px solid rgba(255, 255, 255, .3);
        background: linear-gradient(135deg, #f43f5e, #dc2626);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, .35), 0 12px 24px -8px rgba(190, 18, 60, .7);
    }

    .btn-logout:hover {
        background: linear-gradient(135deg, #fb7185, #be123c);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, .4), 0 16px 30px -8px rgba(190, 18, 60, .8);
        transform: translateY(-2px);
        color: #fff;
    }

    /* --- Pencarian --- */
    .search-box {
        border-radius: 999px;
        background: rgba(255, 255, 255, .9);
        border-color: rgba(255, 255, 255, .95);
        box-shadow: 0 1px 2px rgba(15, 23, 42, .05), 0 14px 32px -14px rgba(37, 99, 235, .35);
    }

    .search-box input { border-radius: 999px; padding-left: 56px; }
    .search-icon { left: 22px; }

    /* --- Kartu --- */
    .user-card .card {
        --glow: rgba(37, 99, 235, .3);
        border-radius: 28px;
        border: 1px solid rgba(255, 255, 255, .95);
        background: linear-gradient(180deg, #ffffff, #f8fbff);
        box-shadow: 0 1px 2px rgba(15, 23, 42, .04), 0 12px 32px -14px rgba(30, 64, 175, .22);
    }

    .user-card .card:has(.status-btn.btn-success) { --glow: rgba(34, 197, 94, .32); }
    .user-card .card::before { border-radius: 28px; }

    .user-card .card:hover {
        transform: translateY(-8px);
        box-shadow: 0 1px 2px rgba(15, 23, 42, .04), 0 30px 54px -18px var(--glow);
    }

    .user-card .card-cover { height: 100px; }

    .user-card .card-cover::before {
        width: 170px;
        height: 170px;
        left: -44px;
        top: -80px;
        background: radial-gradient(circle, rgba(255, 255, 255, .6), transparent 70%);
    }

    .user-card .card-cover::after {
        width: 210px;
        height: 210px;
        right: -50px;
        bottom: -120px;
        background: radial-gradient(circle, rgba(255, 255, 255, .45), transparent 70%);
    }

    .user-card .card-body { margin-top: -52px; }

    .user-card .card-body img {
        width: 96px;
        height: 96px;
        border: 0;
        box-shadow: 0 0 0 4px #fff, 0 0 0 6px var(--ring), 0 16px 30px -10px rgba(15, 23, 42, .4);
    }

    /* titik status mengikuti ukuran foto 96px */
    .user-card .card-body::before {
        top: 73px;
        left: calc(50% + 25px);
        width: 22px;
        height: 22px;
    }

    .user-card .card-title {
        margin: 18px 0 10px;
        font-size: 1.1rem;
    }

    .user-card .user-email {
        padding: 6px 14px;
        background: #f1f5f9;
        border: 1px solid #e6edf6;
        color: #475569;
        font-weight: 500;
    }

    /* ikon amplop berupa SVG (menggantikan emoji yang tampak pudar) */
    .user-card .user-email::before {
        content: "";
        width: 14px;
        height: 14px;
        font-size: 0;
        opacity: .75;
        background: currentColor;
        -webkit-mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect x='3' y='5' width='18' height='14' rx='2'/%3E%3Cpath d='m3 7 9 6 9-6'/%3E%3C/svg%3E") center / contain no-repeat;
        mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect x='3' y='5' width='18' height='14' rx='2'/%3E%3Cpath d='m3 7 9 6 9-6'/%3E%3C/svg%3E") center / contain no-repeat;
    }

    /* --- Pil status --- */
    .user-card .status-btn {
        top: 14px;
        right: 14px;
        padding: 6px 12px;
        -webkit-backdrop-filter: blur(8px);
        backdrop-filter: blur(8px);
        box-shadow: 0 8px 18px -8px rgba(15, 23, 42, .4), inset 0 1px 0 rgba(255, 255, 255, .7);
    }

    .user-card .status-btn.btn-success {
        background: rgba(255, 255, 255, .88);
        color: #15803d;
        border-color: rgba(255, 255, 255, .95);
    }

    .user-card .status-btn.btn-secondary {
        background: rgba(255, 255, 255, .88);
        color: #475569;
        border-color: rgba(255, 255, 255, .95);
    }

    /* --- Tombol aksi kartu --- */
    .user-card .card-actions {
        gap: 10px;
        padding-top: 18px;
        border-top: 1px solid #eaf0f7;
    }

    .user-card .btn-detail,
    .user-card .btn-delete {
        padding: 12px 14px;
        font-size: .88rem;
        border-radius: 14px;
    }

    .user-card .btn-detail {
        background: linear-gradient(135deg, #2563eb, #4f46e5);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, .3), 0 12px 22px -10px rgba(37, 99, 235, .85);
    }

    .user-card .btn-detail:hover,
    .user-card .btn-detail:focus {
        background: linear-gradient(135deg, #1d4ed8, #4338ca);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, .3), 0 16px 28px -10px rgba(67, 56, 202, .9);
    }

    .user-card .btn-delete {
        background: #fff;
        color: #e11d48;
        border-color: #fecdd3;
        box-shadow: 0 1px 2px rgba(15, 23, 42, .05);
    }

    .user-card .btn-delete:hover,
    .user-card .btn-delete:focus {
        background: linear-gradient(135deg, #f43f5e, #e11d48);
        border-color: #e11d48;
        color: #fff;
        box-shadow: 0 14px 26px -10px rgba(225, 29, 72, .85);
    }

    /* --- Tombol modal --- */
    .confirm-dialog { border-radius: 28px; }

    .confirm-actions .btn {
        padding: 13px 16px;
        border-radius: 14px;
        font-weight: 700;
    }

    .btn-confirm-delete {
        background: linear-gradient(135deg, #f43f5e, #dc2626);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, .3), 0 14px 26px -10px rgba(220, 38, 38, .85);
    }

    .btn-confirm-delete:hover {
        background: linear-gradient(135deg, #fb7185, #be123c);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, .3), 0 18px 30px -10px rgba(190, 18, 60, .9);
    }

    .confirm-actions .btn-cancel {
        background: #fff;
        border: 1px solid var(--line);
        box-shadow: 0 1px 2px rgba(15, 23, 42, .05);
    }

    .confirm-actions .btn-cancel:hover { background: #f8fafc; }

    @media (max-width: 575.98px) {
        .confirm-dialog { border-radius: 28px 28px 0 0; }
    }

    /* =====================================================
       Polish v4 — latar gelap setema halaman login
       ===================================================== */
    html { background: #08142f; }

    body {
        background:
            radial-gradient(58% 48% at 6% 2%, rgba(20, 184, 166, .30), transparent 62%),
            radial-gradient(55% 55% at 94% 6%, rgba(37, 99, 235, .55), transparent 64%),
            radial-gradient(52% 52% at 96% 100%, rgba(79, 70, 229, .5), transparent 62%),
            linear-gradient(160deg, #0b1f4b 0%, #0a1a3d 45%, #08142f 100%);
        background-attachment: fixed;
    }

    /* pola titik halus */
    body::before {
        background-image: radial-gradient(rgba(148, 197, 255, .18) 1px, transparent 1px);
        background-size: 24px 24px;
        -webkit-mask-image: linear-gradient(to bottom, #000 0%, rgba(0, 0, 0, .55) 60%, transparent 100%);
        mask-image: linear-gradient(to bottom, #000 0%, rgba(0, 0, 0, .55) 60%, transparent 100%);
    }

    /* lingkaran transparan melayang, seperti di halaman login */
    body::after {
        content: "";
        position: fixed;
        inset: 0;
        z-index: 0;
        pointer-events: none;
        background:
            radial-gradient(circle at 3% 82%,  rgba(255, 255, 255, .05) 0 198px, rgba(255, 255, 255, .11) 199px, transparent 201px),
            radial-gradient(circle at 14% 19%, rgba(255, 255, 255, .06) 0 58px,  rgba(255, 255, 255, .12) 59px,  transparent 61px),
            radial-gradient(circle at 85% 97%, rgba(255, 255, 255, .06) 0 103px, rgba(255, 255, 255, .12) 104px, transparent 106px);
        animation: floatBlob 16s ease-in-out infinite;
    }

    /* --- Header di atas latar gelap --- */
    .dash-header {
        background-image: linear-gradient(135deg, #1e3a8a, #2563eb 60%, #0ea5e9);
        border-color: rgba(255, 255, 255, .16);
        box-shadow: 0 30px 70px -24px rgba(37, 99, 235, .75), 0 2px 0 rgba(255, 255, 255, .06) inset;
    }

    /* --- Pencarian --- */
    .search-box {
        box-shadow: 0 1px 2px rgba(0, 0, 0, .25), 0 18px 44px -18px rgba(56, 189, 248, .4);
    }

    .search-box input { color: var(--ink); }

    .search-meta { color: #9fb3d1; }
    .search-meta strong { color: #7dd3fc; }

    /* --- Judul bagian (teks langsung di atas latar gelap) --- */
    .section-head h3 { color: #fff; }

    .section-count {
        color: #7dd3fc;
        background: rgba(56, 189, 248, .14);
        border-color: rgba(125, 211, 252, .35);
    }

    .section-hint { color: #94a3b8; }

    /* --- Kartu tetap terang agar kontras --- */
    .user-card .card {
        color: var(--ink);
        border-color: rgba(255, 255, 255, .6);
        box-shadow: 0 1px 2px rgba(0, 0, 0, .2), 0 24px 44px -22px rgba(0, 0, 0, .65);
    }

    .user-card .card:hover {
        box-shadow: 0 1px 2px rgba(0, 0, 0, .2), 0 34px 60px -20px var(--glow);
    }

    /* --- Kondisi kosong versi gelap --- */
    #emptyState {
        background: rgba(255, 255, 255, .06);
        border-color: rgba(255, 255, 255, .22);
        color: #9fb3d1;
    }

    #emptyState h5 { color: #fff; }

    /* --- Modal di atas latar gelap --- */
    .confirm-overlay { background: rgba(3, 10, 30, .72); }
</style>

<div class="dash-wrap">

    <div class="dash-header">
        <span class="head-grid" aria-hidden="true"></span>
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div class="head-brand" style="position: relative; z-index: 1;">
                <span class="head-icon" aria-hidden="true">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/>
                        <circle cx="10" cy="7" r="4"/>
                        <path d="M21 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </span>
                <div class="head-text">
                    <span class="head-eyebrow">Panel Administrator</span>
                    <h2>Dashboard Admin</h2>
                    <p>Kelola data dan status seluruh pegawai dalam satu tempat.</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST" id="logoutForm">
                @csrf
                <button type="submit" class="btn btn-logout">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                        <polyline points="16 17 21 12 16 7"/>
                        <line x1="21" y1="12" x2="9" y2="12"/>
                    </svg>
                    <span>Logout</span>
                </button>
            </form>
        </div>

        <div class="stat-row">
            <div class="stat-pill">
                <small><i class="stat-dot"></i>Total Pegawai</small>
                <strong id="statTotal">{{ count($users) }}</strong>
            </div>
            <div class="stat-pill">
                <small><i class="stat-dot is-active"></i>Aktif</small>
                <strong id="statActive">0</strong>
            </div>
            <div class="stat-pill">
                <small><i class="stat-dot is-inactive"></i>Tidak Aktif</small>
                <strong id="statInactive">0</strong>
            </div>
        </div>
    </div>

    <div class="search-sticky">
        <div class="search-box">
            <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <circle cx="11" cy="11" r="7"/>
                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            <input type="search" id="searchInput" class="form-control" placeholder="Cari nama atau email pegawai..." autocomplete="off" aria-label="Cari pegawai">
            <button type="button" id="searchClear" class="search-clear" aria-label="Hapus pencarian">&times;</button>
        </div>
    </div>
    <div class="search-meta" id="searchMeta" aria-live="polite"></div>

    <div class="section-head">
        <h3>Daftar Pegawai <span class="section-count">{{ count($users) }} akun</span></h3>
        <p class="section-hint">Klik pil status pada kartu untuk mengubah tampilan aktif / tidak aktif.</p>
    </div>

    <div class="row g-3 g-lg-4" id="userCards">
        @foreach($users as $user)
        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 user-card">
            <div class="card">
                <div class="card-cover">
                    <!-- Tombol status tampilan -->
                    <button class="btn btn-sm status-btn {{ $user->is_active ? 'btn-success' : 'btn-secondary' }}"
                            data-status="{{ $user->is_active }}"
                            id="status-btn-{{ $user->id }}"
                            title="Klik untuk mengubah status">
                        {{ $user->is_active ? 'Aktif ✅' : 'Tidak Aktif ❌' }}
                    </button>
                </div>
                <div class="card-body text-center">
                    <img src="{{ $user->photo ? asset('storage/uploads/photo/' . $user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                         alt="{{ $user->name }}" class="rounded-circle">

                    <h5 class="card-title">{{ $user->name }}</h5>
                    <p class="user-email">{{ $user->email }}</p>

                    <div class="card-actions">
                        <!-- Lihat Detail -->
                        <a href="{{ route('admin.user.show', $user->id) }}" class="btn btn-detail btn-sm">
                            <span>Lihat Detail</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <line x1="5" y1="12" x2="19" y2="12"/>
                                <polyline points="12 5 19 12 12 19"/>
                            </svg>
                        </a>

                        <!-- Hapus User -->
                        <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-delete btn-sm" title="Hapus akun pegawai">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <polyline points="3 6 5 6 21 6"/>
                                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                                    <path d="M10 11v6M14 11v6"/>
                                    <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                                </svg>
                                <span>Hapus</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div id="emptyState">
        <div class="emoji">🕵️</div>
        <h5 class="mt-2 mb-1">Pegawai tidak ditemukan</h5>
        <p class="mb-0">Coba gunakan kata kunci yang lain.</p>
    </div>
</div>

<!-- Modal konfirmasi hapus pegawai -->
<div class="confirm-overlay" id="deleteModal" role="dialog" aria-modal="true" aria-labelledby="deleteTitle" aria-hidden="true">
    <div class="confirm-dialog">
        <div class="confirm-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                <line x1="12" y1="9" x2="12" y2="13"/>
                <line x1="12" y1="17" x2="12.01" y2="17"/>
            </svg>
        </div>
        <h4 id="deleteTitle">Hapus akun pegawai?</h4>
        <p>Anda akan menghapus akun:</p>
        <span class="confirm-name" id="deleteName">-</span>
        <p class="confirm-note">⚠️ Semua data milik pegawai ini ikut terhapus dan <strong>tidak dapat dikembalikan</strong>.</p>
        <div class="confirm-actions">
            <button type="button" class="btn btn-cancel" id="deleteCancel">Batal</button>
            <button type="button" class="btn btn-confirm-delete" id="deleteConfirm">Ya, Hapus</button>
        </div>
    </div>
</div>

<!-- Modal konfirmasi logout -->
<div class="confirm-overlay" id="logoutModal" role="dialog" aria-modal="true" aria-labelledby="logoutTitle" aria-hidden="true">
    <div class="confirm-dialog">
        <div class="confirm-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                <line x1="12" y1="9" x2="12" y2="13"/>
                <line x1="12" y1="17" x2="12.01" y2="17"/>
            </svg>
        </div>
        <h4 id="logoutTitle">Keluar dari akun?</h4>
        <p>Anda akan keluar dari:</p>
        <span class="confirm-name">Dashboard Admin</span>
        <p class="confirm-note">⚠️ Sesi Anda akan diakhiri dan Anda perlu <strong>login kembali</strong> untuk mengelola data pegawai.</p>
        <div class="confirm-actions">
            <button type="button" class="btn btn-cancel" id="logoutCancel">Batal</button>
            <button type="button" class="btn btn-confirm-delete" id="logoutConfirm">Ya, Keluar</button>
        </div>
    </div>
</div>

<script>
    // Update angka statistik
    function updateStats() {
        const buttons = document.querySelectorAll('.status-btn');
        let active = 0;
        buttons.forEach(b => { if (b.getAttribute('data-status') === '1') active++; });

        const activeEl = document.getElementById('statActive');
        const inactiveEl = document.getElementById('statInactive');
        const newInactive = buttons.length - active;

        [[activeEl, active], [inactiveEl, newInactive]].forEach(([el, val]) => {
            if (el.textContent !== String(val)) {
                el.textContent = val;
                el.classList.remove('bump');
                void el.offsetWidth; // restart animasi
                el.classList.add('bump');
            }
        });
    }

    // ===== Search user =====
    (function () {
        const input      = document.getElementById('searchInput');
        const clearBtn   = document.getElementById('searchClear');
        const meta       = document.getElementById('searchMeta');
        const emptyState = document.getElementById('emptyState');
        const cards      = Array.from(document.querySelectorAll('.user-card'));
        const total      = cards.length;

        // Simpan data asli tiap kartu & atur delay animasi masuk
        const items = cards.map((card, i) => {
            const titleEl = card.querySelector('.card-title');
            const emailEl = card.querySelector('.user-email');
            card.style.setProperty('--i', Math.min(i, 12));
            return {
                card,
                titleEl,
                emailEl,
                name: titleEl.textContent.trim(),
                email: emailEl.textContent.trim()
            };
        });

        // Highlight kata kunci dengan aman (tanpa innerHTML)
        function highlight(el, text, keyword) {
            el.textContent = '';
            const idx = keyword ? text.toLowerCase().indexOf(keyword) : -1;
            if (idx === -1) {
                el.textContent = text;
                return;
            }
            const mark = document.createElement('mark');
            mark.className = 'hl';
            mark.textContent = text.slice(idx, idx + keyword.length);
            el.append(
                document.createTextNode(text.slice(0, idx)),
                mark,
                document.createTextNode(text.slice(idx + keyword.length))
            );
        }

        function runSearch() {
            const keyword = input.value.trim().toLowerCase();
            let visible = 0;

            items.forEach(item => {
                const match = !keyword ||
                    item.name.toLowerCase().includes(keyword) ||
                    item.email.toLowerCase().includes(keyword);

                const wasHidden = item.card.classList.contains('is-hidden');

                if (match) {
                    item.card.classList.remove('is-hidden');
                    // animasi hanya saat kartu muncul kembali
                    if (wasHidden) {
                        item.card.classList.remove('pop');
                        void item.card.offsetWidth;
                        item.card.classList.add('pop');
                    }
                    visible++;
                } else {
                    item.card.classList.add('is-hidden');
                    item.card.classList.remove('pop');
                }

                highlight(item.titleEl, item.name, keyword);
                highlight(item.emailEl, item.email, keyword);
            });

            clearBtn.classList.toggle('show', input.value.length > 0);
            emptyState.classList.toggle('show', visible === 0);

            if (keyword) {
                meta.innerHTML = 'Menampilkan <strong>' + visible + '</strong> dari ' + total + ' pegawai';
            } else {
                meta.textContent = '';
            }
        }

        // 'input' menangkap ketikan, paste, drag-drop, dan input keyboard mobile
        input.addEventListener('input', runSearch);
        input.addEventListener('search', runSearch); // tombol ✕ bawaan browser

        clearBtn.addEventListener('click', function () {
            input.value = '';
            runSearch();
            input.focus();
        });

        input.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && input.value) {
                input.value = '';
                runSearch();
            }
        });

        // Jalankan sekali (mis. browser memulihkan isi input setelah refresh)
        runSearch();
    })();

    // ===== Modal konfirmasi hapus =====
    (function () {
        const modal      = document.getElementById('deleteModal');
        const nameEl     = document.getElementById('deleteName');
        const cancelBtn  = document.getElementById('deleteCancel');
        const confirmBtn = document.getElementById('deleteConfirm');
        let pendingForm  = null;
        let lastFocus    = null;

        function openModal(form) {
            const card = form.closest('.user-card');
            const titleEl = card ? card.querySelector('.card-title') : null;
            nameEl.textContent = titleEl ? titleEl.textContent.trim() : 'pegawai ini';

            pendingForm = form;
            lastFocus = document.activeElement;
            confirmBtn.classList.remove('loading');
            confirmBtn.textContent = 'Ya, Hapus';

            modal.classList.add('show');
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
            cancelBtn.focus(); // fokus awal di tombol aman
        }

        function closeModal() {
            modal.classList.remove('show');
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
            pendingForm = null;
            if (lastFocus && lastFocus.focus) lastFocus.focus();
        }

        // Cegah submit langsung, tampilkan modal dulu
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                openModal(form);
            });
        });

        confirmBtn.addEventListener('click', function () {
            if (!pendingForm) return;
            confirmBtn.classList.add('loading');
            confirmBtn.textContent = 'Menghapus...';
            pendingForm.submit(); // submit native, tidak memicu listener di atas
        });

        cancelBtn.addEventListener('click', closeModal);

        // Klik area gelap menutup modal
        modal.addEventListener('click', function (e) {
            if (e.target === modal) closeModal();
        });

        document.addEventListener('keydown', function (e) {
            if (!modal.classList.contains('show')) return;

            if (e.key === 'Escape') {
                closeModal();
            } else if (e.key === 'Tab') {
                // jaga fokus tetap di dalam modal
                const focusable = [cancelBtn, confirmBtn];
                const first = focusable[0];
                const last = focusable[focusable.length - 1];
                if (e.shiftKey && document.activeElement === first) {
                    e.preventDefault();
                    last.focus();
                } else if (!e.shiftKey && document.activeElement === last) {
                    e.preventDefault();
                    first.focus();
                }
            }
        });
    })();

    // ===== Modal konfirmasi logout =====
    (function () {
        const form       = document.getElementById('logoutForm');
        const modal      = document.getElementById('logoutModal');
        const cancelBtn  = document.getElementById('logoutCancel');
        const confirmBtn = document.getElementById('logoutConfirm');
        let lastFocus    = null;

        function openModal() {
            lastFocus = document.activeElement;
            confirmBtn.classList.remove('loading');
            confirmBtn.textContent = 'Ya, Keluar';

            modal.classList.add('show');
            modal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
            cancelBtn.focus(); // fokus awal di tombol aman
        }

        function closeModal() {
            modal.classList.remove('show');
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
            if (lastFocus && lastFocus.focus) lastFocus.focus();
        }

        // Cegah logout langsung, tampilkan peringatan dulu
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            openModal();
        });

        confirmBtn.addEventListener('click', function () {
            confirmBtn.classList.add('loading');
            confirmBtn.textContent = 'Keluar...';
            form.submit(); // submit native, tidak memicu listener di atas
        });

        cancelBtn.addEventListener('click', closeModal);

        modal.addEventListener('click', function (e) {
            if (e.target === modal) closeModal();
        });

        document.addEventListener('keydown', function (e) {
            if (!modal.classList.contains('show')) return;

            if (e.key === 'Escape') {
                closeModal();
            } else if (e.key === 'Tab') {
                // jaga fokus tetap di dalam modal
                if (e.shiftKey && document.activeElement === cancelBtn) {
                    e.preventDefault();
                    confirmBtn.focus();
                } else if (!e.shiftKey && document.activeElement === confirmBtn) {
                    e.preventDefault();
                    cancelBtn.focus();
                }
            }
        });
    })();

    // Toggle tampilan tombol aktif/tidak aktif tanpa simpan ke DB
    document.querySelectorAll('.status-btn').forEach(button => {
        const userId = button.id.split('-')[2]; // Ambil ID user dari id tombol
        const storedStatus = localStorage.getItem('status-' + userId); // Ambil status dari localStorage

        if (storedStatus) {
            // Jika ada status di localStorage, set status tombol sesuai dengan nilai itu
            button.setAttribute('data-status', storedStatus);
            if (storedStatus === '1') {
                button.classList.add('btn-success');
                button.classList.remove('btn-secondary');
                button.textContent = 'Aktif ✅';
            } else {
                button.classList.add('btn-secondary');
                button.classList.remove('btn-success');
                button.textContent = 'Tidak Aktif ❌';
            }
        }

        button.addEventListener('click', function () {
            let currentStatus = this.getAttribute('data-status') === '1';

            if (currentStatus) {
                this.classList.remove('btn-success');
                this.classList.add('btn-secondary');
                this.textContent = 'Tidak Aktif ❌';
                this.setAttribute('data-status', '0');
                localStorage.setItem('status-' + userId, '0'); // Simpan status ke localStorage
            } else {
                this.classList.remove('btn-secondary');
                this.classList.add('btn-success');
                this.textContent = 'Aktif ✅';
                this.setAttribute('data-status', '1');
                localStorage.setItem('status-' + userId, '1'); // Simpan status ke localStorage
            }

            updateStats();
        });
    });

    updateStats();
</script>

@endsection