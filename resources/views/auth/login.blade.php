@extends('layouts.minimal')

@section('body-class', 'account-page')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

    :root {
        --mn-primary: #2563eb;
        --mn-primary-hover: #1d4ed8;
        --mn-primary-soft: #eff6ff;
        --mn-text: #0f1f4d;
        --mn-muted: #51607a;
        --mn-danger: #dc2626;
        --mn-border: #dbe5f2;
        --mn-radius: 14px;
    }

    * {
        box-sizing: border-box;
    }

    /* =========================
       LATAR: MESH GRADIENT BIRU
    ========================= */
    .mn {
        position: relative;
        isolation: isolate;
        min-height: 100vh;
        min-height: 100dvh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: max(40px, env(safe-area-inset-top)) 20px max(40px, env(safe-area-inset-bottom));
        overflow: hidden;
        font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif;
        -webkit-font-smoothing: antialiased;

        background:
            radial-gradient(ellipse 60% 55% at 8% 8%, rgba(56, 189, 248, .28), transparent 60%),
            radial-gradient(ellipse 55% 55% at 94% 90%, rgba(99, 102, 241, .38), transparent 62%),
            radial-gradient(ellipse 45% 40% at 88% 10%, rgba(37, 99, 235, .45), transparent 65%),
            linear-gradient(145deg, #071429 0%, #0b2150 48%, #0f2f6e 100%);
    }

    /* Pola titik halus */
    .mn::before {
        content: "";
        position: absolute;
        inset: 0;
        z-index: -1;
        pointer-events: none;
        background-image: radial-gradient(rgba(255, 255, 255, .22) 1px, transparent 1px);
        background-size: 26px 26px;
        opacity: .5;
        -webkit-mask-image: radial-gradient(ellipse at center, #000 30%, transparent 85%);
        mask-image: radial-gradient(ellipse at center, #000 30%, transparent 85%);
    }

    /* Cahaya biru bergerak */
    .mn::after {
        content: "";
        position: absolute;
        z-index: -1;
        width: 420px;
        height: 420px;
        top: -140px;
        right: -110px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(56, 189, 248, .4), rgba(56, 189, 248, 0) 70%);
        filter: blur(60px);
        pointer-events: none;
        animation: mnGlow 10s ease-in-out infinite alternate;
    }

    .mn-bg-circle {
        position: absolute;
        z-index: -1;
        border: 1px solid rgba(255, 255, 255, .14);
        border-radius: 50%;
        background: linear-gradient(145deg, rgba(255, 255, 255, .1), rgba(255, 255, 255, .02));
        box-shadow: 0 10px 40px rgba(2, 6, 23, .25);
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
        pointer-events: none;
        will-change: transform;
    }

    .mn-bg-circle.circle-one {
        width: 260px;
        height: 260px;
        left: -90px;
        bottom: 6%;
        animation: mnFloat 9s ease-in-out infinite;
    }

    .mn-bg-circle.circle-two {
        width: 140px;
        height: 140px;
        right: 9%;
        bottom: -40px;
        animation: mnFloat 7s ease-in-out infinite reverse;
    }

    .mn-bg-circle.circle-three {
        width: 80px;
        height: 80px;
        top: 15%;
        left: 11%;
        animation: mnFloat 6s ease-in-out infinite;
    }

    @keyframes mnGlow {
        from { transform: translate(0, 0) scale(1); opacity: .7; }
        to   { transform: translate(-60px, 80px) scale(1.2); opacity: 1; }
    }

    @keyframes mnFloat {
        0%, 100% { transform: translateY(0); }
        50%      { transform: translateY(-24px); }
    }

    /* =========================
       KARTU LOGIN (GLASS)
    ========================= */
    .mn-card {
        position: relative;
        z-index: 1;
        width: 100%;
        max-width: 440px;
        padding: 40px 36px 28px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, .95);
        border-radius: 28px;
        background:
            linear-gradient(180deg, rgba(255, 255, 255, .97), rgba(248, 250, 255, .94));

        box-shadow:
            0 40px 90px -15px rgba(2, 6, 23, .55),
            0 14px 36px rgba(2, 6, 23, .25),
            0 0 0 1px rgba(255, 255, 255, .25),
            inset 0 1px 0 #fff;

        backdrop-filter: blur(24px) saturate(1.4);
        -webkit-backdrop-filter: blur(24px) saturate(1.4);
        animation: mnCardEnter .75s cubic-bezier(.2, .8, .2, 1) both;
    }

    /* Aksen garis gradien di atas kartu */
    .mn-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 10%;
        width: 80%;
        height: 3px;
        border-radius: 0 0 12px 12px;
        background: linear-gradient(90deg, transparent, #60a5fa, #2563eb, #93c5fd, transparent);
    }

    /* Kilau lembut di pojok kartu */
    .mn-card::after {
        content: "";
        position: absolute;
        top: -90px;
        right: -90px;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(147, 197, 253, .35), transparent 70%);
        pointer-events: none;
    }

    @keyframes mnCardEnter {
        from { opacity: 0; transform: translateY(22px) scale(.985); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    /* =========================
       LOGO
    ========================= */
    .mn-logo-wrap {
        position: relative;
        z-index: 1;
        display: flex;
        justify-content: center;
        margin-bottom: 22px;
    }

    .mn-logo-link {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 96px;
        height: 96px;
        padding: 13px;
        border: 1px solid rgba(219, 234, 254, .95);
        border-radius: 26px;
        background: linear-gradient(145deg, #fff, #eff6ff);

        box-shadow:
            0 12px 28px rgba(37, 99, 235, .14),
            0 0 0 6px rgba(219, 234, 254, .45),
            inset 0 1px 0 #fff;

        transition: transform .3s ease, box-shadow .3s ease;
    }

    .mn-logo-link:hover {
        transform: translateY(-4px) rotate(-1.5deg);
        box-shadow:
            0 18px 34px rgba(37, 99, 235, .2),
            0 0 0 8px rgba(191, 219, 254, .5),
            inset 0 1px 0 #fff;
    }

    .mn-logo-link:focus-visible {
        outline: 3px solid rgba(59, 130, 246, .4);
        outline-offset: 4px;
    }

    .mn-logo {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    /* =========================
       LABEL SISTEM (SIMPEG NON-ASN)
    ========================= */
    .mn-badge-wrap {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        margin: -2px 0 12px;
    }

    /* Garis dekoratif kiri & kanan */
    .mn-badge-wrap::before,
    .mn-badge-wrap::after {
        content: "";
        width: 34px;
        height: 2px;
        flex: 0 0 34px;
        border-radius: 2px;
    }

    .mn-badge-wrap::before {
        background: linear-gradient(90deg, transparent, #60a5fa);
    }

    .mn-badge-wrap::after {
        background: linear-gradient(90deg, #60a5fa, transparent);
    }

    .mn-badge {
        display: inline-flex;
        align-items: baseline;
        gap: 8px;
        font-size: 20px;
        font-weight: 800;
        letter-spacing: 2.4px;
        line-height: 1.2;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .mn-badge-main {
        color: var(--mn-text);
    }

    .mn-badge-sub {
        background: linear-gradient(100deg, #1d4ed8, #2563eb 45%, #0ea5e9);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        color: var(--mn-primary);
    }

    @media (max-width: 360px) {
        .mn-badge {
            font-size: 17px;
            letter-spacing: 1.8px;
        }

        .mn-badge-wrap::before,
        .mn-badge-wrap::after {
            width: 18px;
            flex-basis: 18px;
        }
    }

    /* =========================
       JUDUL
    ========================= */
    .mn-heading {
        position: relative;
        z-index: 1;
        margin: 0;
        color: var(--mn-text);
        text-align: center;
        font-size: 28px;
        line-height: 1.25;
        font-weight: 800;
        letter-spacing: -.9px;
    }

    .mn-heading span {
        background: linear-gradient(100deg, #2563eb, #3b82f6 55%, #60a5fa);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        color: var(--mn-primary);
    }

    .mn-subtitle {
        position: relative;
        z-index: 1;
        max-width: 310px;
        margin: 10px auto 28px;
        color: var(--mn-muted);
        text-align: center;
        font-size: 13px;
        line-height: 1.75;
    }

    /* =========================
       FORM
    ========================= */
    .mn-form {
        position: relative;
        z-index: 1;
        width: 100%;
    }

    .mn-field {
        margin-bottom: 18px;
    }

    .mn-label {
        display: block;
        margin-bottom: 8px;
        color: #1e293b;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: .2px;
    }

    .mn-input-wrap {
        position: relative;
        display: flex;
        align-items: center;
        width: 100%;
    }

    .mn-input-icon {
        position: absolute;
        left: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        pointer-events: none;
        transition: color .2s ease, transform .2s ease;
    }

    .mn-input-icon svg {
        width: 19px;
        height: 19px;
        stroke: currentColor;
    }

    .mn-input {
        display: block;
        width: 100%;
        min-width: 0;
        height: 52px;
        padding: 0 46px 0 46px;
        border: 1.5px solid var(--mn-border);
        border-radius: var(--mn-radius);
        outline: none;
        background: rgba(255, 255, 255, .9);
        color: #0f172a;
        font-family: inherit;
        font-size: 14px;
        font-weight: 500;
        box-shadow: 0 1px 2px rgba(15, 23, 42, .03);
        -webkit-appearance: none;
        appearance: none;

        transition:
            border-color .2s ease,
            box-shadow .2s ease,
            background .2s ease;
    }

    .mn-input::placeholder {
        color: #a0aec0;
        font-weight: 400;
    }

    .mn-input:hover {
        border-color: #bfdbfe;
    }

    .mn-input:focus {
        border-color: #3b82f6;
        background: #fff;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, .14);
    }

    .mn-input-wrap:focus-within .mn-input-icon {
        color: var(--mn-primary);
        transform: scale(1.06);
    }

    /* Autofill browser tetap rapi */
    .mn-input:-webkit-autofill,
    .mn-input:-webkit-autofill:hover,
    .mn-input:-webkit-autofill:focus {
        -webkit-text-fill-color: #0f172a;
        -webkit-box-shadow: 0 0 0 1000px #eff6ff inset;
        transition: background-color 9999s ease-in-out 0s;
    }

    .mn-input.is-invalid {
        border-color: #f87171;
        background: #fffafa;
    }

    .mn-input.is-invalid:focus {
        box-shadow: 0 0 0 4px rgba(248, 113, 113, .14);
    }

    /* Tombol password */
    .mn-eye {
        position: absolute;
        right: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        padding: 0;
        border: 0;
        border-radius: 10px;
        background: transparent;
        color: #94a3b8;
        cursor: pointer;
        -webkit-tap-highlight-color: transparent;
        transition: background .2s ease, color .2s ease;
    }

    .mn-eye:hover {
        color: var(--mn-primary);
        background: var(--mn-primary-soft);
    }

    .mn-eye:focus-visible {
        outline: 2px solid #60a5fa;
        outline-offset: 2px;
    }

    .mn-eye svg {
        width: 19px;
        height: 19px;
        stroke: currentColor;
    }

    .mn-eye svg[hidden] {
        display: none;
    }

    .mn-feedback {
        display: block;
        margin-top: 7px;
        padding-left: 2px;
        color: var(--mn-danger);
        font-size: 11.5px;
        font-weight: 500;
        line-height: 1.5;
    }

    /* =========================
       TOMBOL LOGIN
    ========================= */
    .mn-submit {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        min-height: 52px;
        margin-top: 10px;
        padding: 13px 18px;
        overflow: hidden;
        border: 0;
        border-radius: var(--mn-radius);

        background: linear-gradient(110deg, #3b82f6 0%, #2563eb 50%, #1d4ed8 100%);
        background-size: 140% 100%;
        background-position: 0 0;

        box-shadow:
            0 10px 22px rgba(37, 99, 235, .28),
            inset 0 1px 0 rgba(255, 255, 255, .25);

        color: #fff;
        font-family: inherit;
        font-size: 14px;
        font-weight: 700;
        letter-spacing: .2px;
        cursor: pointer;
        -webkit-tap-highlight-color: transparent;

        transition:
            transform .2s ease,
            box-shadow .2s ease,
            background-position .4s ease;
    }

    .mn-submit::before {
        content: "";
        position: absolute;
        top: 0;
        left: -120%;
        width: 80%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, .28), transparent);
        transform: skewX(-20deg);
        transition: left .6s ease;
        pointer-events: none;
    }

    .mn-submit:hover:not(:disabled) {
        transform: translateY(-2px);
        background-position: 100% 0;
        box-shadow: 0 14px 28px rgba(37, 99, 235, .34);
    }

    .mn-submit:hover::before {
        left: 140%;
    }

    .mn-submit:active:not(:disabled) {
        transform: translateY(0);
        box-shadow: 0 6px 14px rgba(37, 99, 235, .26);
    }

    .mn-submit:focus-visible {
        outline: 3px solid rgba(59, 130, 246, .35);
        outline-offset: 3px;
    }

    .mn-submit:disabled {
        opacity: .88;
        cursor: wait;
        transform: none;
    }

    .mn-submit svg {
        width: 18px;
        height: 18px;
        stroke: currentColor;
        flex: 0 0 18px;
        transition: transform .25s ease;
    }

    .mn-submit:hover:not(:disabled) .mn-submit-icon {
        transform: translateX(3px);
    }

    /* Spinner (satu saja) */
    .mn-spinner {
        display: none;
        width: 18px;
        height: 18px;
        flex: 0 0 18px;
        border: 2px solid rgba(255, 255, 255, .4);
        border-top-color: #fff;
        border-radius: 50%;
    }

    .mn-submit.mn-loading .mn-spinner {
        display: inline-block;
        animation: mnSpin .7s linear infinite;
    }

    .mn-submit.mn-loading .mn-submit-icon {
        display: none !important;
    }

    /* Saat loading, hanya spinner ini yang tampil di dalam tombol */
    .mn-submit.mn-loading::before {
        display: none;
    }

    .mn-submit.mn-loading .mn-ripple {
        display: none;
    }

    /*
     * Blokir spinner/elemen tambahan dari luar (layout atau CSS global).
     * Di dalam tombol hanya boleh ada: spinner, ikon, teks, dan ripple.
     */
    .mn-submit::after {
        content: none !important;
        display: none !important;
    }

    .mn-submit > :not(.mn-spinner):not(.mn-submit-icon):not(#mnSubmitText):not(.mn-ripple) {
        display: none !important;
    }

    #mnSubmitText::before,
    #mnSubmitText::after {
        content: none !important;
        display: none !important;
    }

    #mnSubmitText > * {
        display: none !important;
    }

    @keyframes mnSpin {
        to { transform: rotate(360deg); }
    }

    /* =========================
       LINK DAFTAR
    ========================= */
    .mn-register {
        position: relative;
        z-index: 1;
        margin: 22px 0 0;
        color: var(--mn-muted);
        text-align: center;
        font-size: 12.5px;
        line-height: 1.8;
    }

    .mn-register a {
        color: var(--mn-primary);
        font-weight: 700;
        text-decoration: none;
        background: linear-gradient(currentColor, currentColor) 0 100% / 0 1.5px no-repeat;
        transition: color .2s ease, background-size .25s ease;
    }

    .mn-register a:hover {
        color: var(--mn-primary-hover);
        background-size: 100% 1.5px;
    }

    .mn-register a:focus-visible {
        outline: 2px solid #60a5fa;
        outline-offset: 3px;
        border-radius: 4px;
    }

    /* =========================
       FOOTER
    ========================= */
    .mn-footer {
        position: relative;
        z-index: 1;
        margin: 26px 0 0;
        padding-top: 18px;
        border-top: 1px solid rgba(191, 219, 254, .7);
        color: #94a3b8;
        text-align: center;
        font-size: 10.5px;
        line-height: 1.8;
    }

    .mn-footer strong {
        display: block;
        margin-bottom: 3px;
        color: #475569;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .8px;
    }

    /* =========================
       EFEK RIPPLE
    ========================= */
    .mn-ripple {
        position: absolute;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .38);
        transform: scale(0);
        animation: mnRipple .6s ease-out;
        pointer-events: none;
    }

    @keyframes mnRipple {
        to {
            transform: scale(24);
            opacity: 0;
        }
    }

    /* =========================
       RESPONSIVE
    ========================= */

    /* Tablet kecil & HP */
    @media (max-width: 480px) {
        .mn {
            padding: 24px 16px;
        }

        .mn-card {
            max-width: 100%;
            padding: 32px 22px 24px;
            border-radius: 24px;
        }

        .mn-logo-link {
            width: 84px;
            height: 84px;
            border-radius: 23px;
        }

        .mn-heading {
            font-size: 25px;
        }

        .mn-subtitle {
            margin-bottom: 24px;
            font-size: 12.5px;
        }

        /* 16px mencegah zoom otomatis di iOS Safari */
        .mn-input {
            height: 50px;
            font-size: 16px;
        }

        .mn-submit {
            min-height: 50px;
        }

        .mn-bg-circle.circle-one {
            width: 170px;
            height: 170px;
        }

        .mn-bg-circle.circle-two {
            width: 95px;
            height: 95px;
            right: 4%;
        }

        .mn-bg-circle.circle-three {
            left: 4%;
            width: 56px;
            height: 56px;
        }

        .mn::after {
            width: 280px;
            height: 280px;
        }
    }

    /* HP sangat kecil */
    @media (max-width: 360px) {
        .mn-card {
            padding: 28px 18px 22px;
        }

        .mn-heading {
            font-size: 22px;
        }

        .mn-logo-link {
            width: 76px;
            height: 76px;
        }
    }

    /* Layar pendek / HP landscape: card mulai dari atas agar bisa di-scroll */
    @media (max-height: 700px) {
        .mn {
            align-items: flex-start;
            padding-top: 24px;
            padding-bottom: 24px;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .mn::after,
        .mn-bg-circle,
        .mn-card {
            animation: none !important;
        }

        *,
        *::before,
        *::after {
            transition-duration: .01ms !important;
        }
    }
</style>

<div class="mn">
    {{-- Ornamen latar --}}
    <div class="mn-bg-circle circle-one" aria-hidden="true"></div>
    <div class="mn-bg-circle circle-two" aria-hidden="true"></div>
    <div class="mn-bg-circle circle-three" aria-hidden="true"></div>

    <main class="mn-card">
        {{-- Logo --}}
        <div class="mn-logo-wrap">
            <a
                href="https://madiunkota.go.id/"
                class="mn-logo-link"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="Website Pemerintah Kota Madiun"
            >
                <img
                    src="{{ asset('assets/img/logo2.png') }}"
                    alt="Logo Dinas Komunikasi dan Informatika Kota Madiun"
                    class="mn-logo"
                >
            </a>
        </div>

        {{-- Label sistem --}}
        <div class="mn-badge-wrap">
            <span class="mn-badge">
                <span class="mn-badge-main">SIMPEG</span>
                <span class="mn-badge-sub">NON-ASN</span>
            </span>
        </div>

        {{-- Judul --}}
        <h1 class="mn-heading">
            Selamat <span>Datang</span>
        </h1>

        <p class="mn-subtitle">
            Silakan masuk untuk melanjutkan ke akun Anda.
            Masukkan email dan kata sandi dengan benar.
        </p>

        {{-- Form login Laravel --}}
        <form
            action="{{ route('login') }}"
            method="POST"
            class="mn-form"
            id="mnLoginForm"
            novalidate
        >
            @csrf

            {{-- Email --}}
            <div class="mn-field">
                <label for="mnEmail" class="mn-label">
                    Alamat Email
                </label>

                <div class="mn-input-wrap">
                    <span class="mn-input-icon" aria-hidden="true">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <rect x="3" y="5" width="18" height="14" rx="3"></rect>
                            <path d="m4 7 8 6 8-6"></path>
                        </svg>
                    </span>

                    <input
                        type="email"
                        id="mnEmail"
                        name="email"
                        class="mn-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
                        value="{{ old('email') }}"
                        placeholder="nama@email.com"
                        autocomplete="username"
                        inputmode="email"
                        required
                        autofocus
                        aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}"
                        @if ($errors->has('email'))
                            aria-describedby="mnEmailError"
                        @endif
                    >
                </div>

                @error('email')
                    <span class="mn-feedback" id="mnEmailError" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mn-field">
                <label for="mnPassword" class="mn-label">
                    Kata Sandi
                </label>

                <div class="mn-input-wrap">
                    <span class="mn-input-icon" aria-hidden="true">
                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <rect x="4" y="10" width="16" height="11" rx="3"></rect>
                            <path d="M8 10V7a4 4 0 0 1 8 0v3"></path>
                            <path d="M12 14v3"></path>
                        </svg>
                    </span>

                    <input
                        type="password"
                        id="mnPassword"
                        name="password"
                        class="mn-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
                        placeholder="Masukkan kata sandi"
                        autocomplete="current-password"
                        required
                        aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}"
                        @if ($errors->has('password'))
                            aria-describedby="mnPasswordError"
                        @endif
                    >

                    <button
                        type="button"
                        class="mn-eye"
                        id="mnEye"
                        aria-label="Tampilkan kata sandi"
                        aria-pressed="false"
                    >
                        {{-- Ikon mata terbuka --}}
                        <svg
                            id="mnEyeOpen"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                        >
                            <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>

                        {{-- Ikon mata tertutup --}}
                        <svg
                            id="mnEyeClosed"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke-width="1.8"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            aria-hidden="true"
                            hidden
                        >
                            <path d="m3 3 18 18"></path>
                            <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"></path>
                            <path d="M9.9 5.2A10.8 10.8 0 0 1 12 5c6.5 0 10 7 10 7a14.8 14.8 0 0 1-3.1 3.9"></path>
                            <path d="M6.2 6.2C3.5 8 2 12 2 12s3.5 7 10 7a10.5 10.5 0 0 0 4-.8"></path>
                        </svg>
                    </button>
                </div>

                @error('password')
                    <span class="mn-feedback" id="mnPasswordError" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            {{-- Tombol login --}}
            <button
                type="submit"
                class="mn-submit"
                id="mnSubmit"
            >
                {{-- Hanya satu spinner --}}
                <span
                    class="mn-spinner"
                    id="mnSpinner"
                    aria-hidden="true"
                ></span>

                {{-- Ikon login normal --}}
                <svg
                    class="mn-submit-icon"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    aria-hidden="true"
                >
                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                    <path d="M10 17l5-5-5-5"></path>
                    <path d="M15 12H3"></path>
                </svg>

                <span id="mnSubmitText">Masuk ke Akun</span>
            </button>
        </form>

        {{-- Link pendaftaran --}}
        <p class="mn-register">
            Belum memiliki akun?
            <a href="{{ route('register') }}">Daftar sekarang</a>
        </p>

        {{-- Footer --}}
        <footer class="mn-footer">
            <strong>DINAS KOMUNIKASI DAN INFORMATIKA</strong>
            Pemerintah Kota Madiun
            <br>
            &copy; 2025 Diskominfo Kota Madiun
        </footer>
    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const passwordInput = document.getElementById('mnPassword');
        const eyeButton = document.getElementById('mnEye');
        const eyeOpen = document.getElementById('mnEyeOpen');
        const eyeClosed = document.getElementById('mnEyeClosed');

        const loginForm = document.getElementById('mnLoginForm');
        const submitButton = document.getElementById('mnSubmit');
        const submitText = document.getElementById('mnSubmitText');

        /*
         * Tampilkan atau sembunyikan kata sandi.
         */
        if (passwordInput && eyeButton && eyeOpen && eyeClosed) {
            eyeButton.addEventListener('click', function () {
                const showPassword = passwordInput.type === 'password';

                passwordInput.type = showPassword ? 'text' : 'password';

                eyeOpen.hidden = showPassword;
                eyeClosed.hidden = !showPassword;

                eyeButton.setAttribute(
                    'aria-label',
                    showPassword
                        ? 'Sembunyikan kata sandi'
                        : 'Tampilkan kata sandi'
                );

                eyeButton.setAttribute(
                    'aria-pressed',
                    showPassword ? 'true' : 'false'
                );

                passwordInput.focus();
            });
        }

        /*
         * Efek ripple pada tombol login.
         */
        if (submitButton) {
            submitButton.addEventListener('click', function (event) {
                if (window.matchMedia(
                    '(prefers-reduced-motion: reduce)'
                ).matches) {
                    return;
                }

                const rect = submitButton.getBoundingClientRect();
                const ripple = document.createElement('span');

                ripple.className = 'mn-ripple';
                ripple.style.left = (event.clientX - rect.left) + 'px';
                ripple.style.top = (event.clientY - rect.top) + 'px';

                submitButton.appendChild(ripple);

                ripple.addEventListener('animationend', function () {
                    ripple.remove();
                });
            });
        }

        /*
         * Loading submit.
         * Spinner tampil satu kali dan ikon login disembunyikan.
         */
        if (loginForm && submitButton) {
            const emailInput = document.getElementById('mnEmail');

            /*
             * Tampilkan pesan error di bawah kolom.
             */
            function showFieldError(input, errorId, message) {
                const field = input.closest('.mn-field');

                if (!field) {
                    return;
                }

                const old = document.getElementById(errorId);

                if (old) {
                    old.remove();
                }

                const error = document.createElement('span');

                error.className = 'mn-feedback';
                error.id = errorId;
                error.setAttribute('role', 'alert');
                error.textContent = message;

                field.appendChild(error);

                input.classList.add('is-invalid');
                input.setAttribute('aria-invalid', 'true');
                input.setAttribute('aria-describedby', errorId);
            }

            /*
             * Hapus pesan error dari kolom.
             */
            function clearFieldError(input, errorId) {
                const old = document.getElementById(errorId);

                if (old) {
                    old.remove();
                }

                input.classList.remove('is-invalid');
                input.setAttribute('aria-invalid', 'false');
                input.removeAttribute('aria-describedby');
            }

            /*
             * Pesan hilang otomatis saat pengguna mulai mengisi.
             */
            if (emailInput) {
                emailInput.addEventListener('input', function () {
                    clearFieldError(emailInput, 'mnEmailError');
                });
            }

            if (passwordInput) {
                passwordInput.addEventListener('input', function () {
                    clearFieldError(passwordInput, 'mnPasswordError');
                });
            }

            loginForm.addEventListener('submit', function (event) {
                /*
                 * Validasi kolom: tampilkan "harus diisi" jika kosong.
                 */
                let firstInvalid = null;

                if (emailInput) {
                    const emailValue = emailInput.value.trim();

                    if (emailValue === '') {
                        showFieldError(emailInput, 'mnEmailError', 'Alamat email harus diisi.');
                        firstInvalid = firstInvalid || emailInput;
                    } else if (!emailInput.checkValidity()) {
                        showFieldError(emailInput, 'mnEmailError', 'Format alamat email tidak valid.');
                        firstInvalid = firstInvalid || emailInput;
                    } else {
                        clearFieldError(emailInput, 'mnEmailError');
                    }
                }

                if (passwordInput) {
                    if (passwordInput.value === '') {
                        showFieldError(passwordInput, 'mnPasswordError', 'Kata sandi harus diisi.');
                        firstInvalid = firstInvalid || passwordInput;
                    } else {
                        clearFieldError(passwordInput, 'mnPasswordError');
                    }
                }

                if (firstInvalid) {
                    event.preventDefault();
                    firstInvalid.focus();
                    return;
                }

                /*
                 * Mencegah submit berulang.
                 */
                if (submitButton.classList.contains('mn-loading')) {
                    event.preventDefault();
                    return;
                }

                /*
                 * Pastikan hanya ada SATU spinner di dalam tombol.
                 */
                const spinners = submitButton.querySelectorAll('.mn-spinner');
                spinners.forEach(function (el, index) {
                    if (index > 0) {
                        el.remove();
                    }
                });

                /*
                 * Aktifkan tampilan loading.
                 */
                /*
                 * Hapus elemen asing yang ditambahkan skrip lain ke tombol,
                 * baik sekarang maupun sesudahnya.
                 */
                const allowedNodes = ['mnSpinner', 'mnSubmitText'];

                function removeForeignNodes() {
                    Array.from(submitButton.children).forEach(function (child) {
                        const isOurs =
                            allowedNodes.indexOf(child.id) !== -1 ||
                            child.classList.contains('mn-submit-icon') ||
                            child.classList.contains('mn-ripple');

                        if (!isOurs) {
                            child.remove();
                        }
                    });

                    if (submitText) {
                        Array.from(submitText.children).forEach(function (child) {
                            child.remove();
                        });
                    }
                }

                removeForeignNodes();

                if (window.MutationObserver) {
                    new MutationObserver(removeForeignNodes).observe(submitButton, {
                        childList: true,
                        subtree: true
                    });
                }

                submitButton.classList.add('mn-loading');
                submitButton.disabled = true;
                submitButton.setAttribute('data-mn-busy', 'true');

                if (submitText) {
                    submitText.textContent = 'Memproses...';
                }
            });

            /*
             * Reset tombol saat halaman dipulihkan dari cache
             * (misalnya setelah menekan tombol Back).
             */
            window.addEventListener('pageshow', function (event) {
                if (!event.persisted) {
                    return;
                }

                submitButton.classList.remove('mn-loading');
                submitButton.disabled = false;
                submitButton.removeAttribute('data-mn-busy');

                if (submitText) {
                    submitText.textContent = 'Masuk ke Akun';
                }
            });
        }
    });
</script>
@endsection