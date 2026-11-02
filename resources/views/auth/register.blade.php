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
       LATAR: NAVY ELEGAN
    ========================= */
    .mn {
        position: relative;
        isolation: isolate;
        min-height: 100vh;
        min-height: 100dvh;
        width: 100%;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding: max(40px, env(safe-area-inset-top)) 20px max(40px, env(safe-area-inset-bottom));
        overflow: hidden;
        font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', sans-serif;
        -webkit-font-smoothing: antialiased;

        background-color: #0b2150;
        background-image:
            radial-gradient(ellipse 60% 40% at 8% 4%, rgba(56, 189, 248, .26), transparent 60%),
            radial-gradient(ellipse 55% 40% at 94% 96%, rgba(99, 102, 241, .36), transparent 62%),
            radial-gradient(ellipse 45% 30% at 90% 6%, rgba(37, 99, 235, .42), transparent 65%),
            linear-gradient(180deg, #071429 0%, #0b2150 50%, #0f2f6e 100%);
        background-repeat: no-repeat;
        background-size: 100% 100%;
    }

    .mn::before {
        content: "";
        position: fixed;
        inset: 0;
        z-index: -1;
        pointer-events: none;
        background-image: radial-gradient(rgba(255, 255, 255, .22) 1px, transparent 1px);
        background-size: 26px 26px;
        opacity: .5;
        -webkit-mask-image: radial-gradient(ellipse at center, #000 30%, transparent 85%);
        mask-image: radial-gradient(ellipse at center, #000 30%, transparent 85%);
    }

    .mn::after {
        content: "";
        position: fixed;
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
        position: fixed;
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
       KARTU REGISTER (GLASS)
    ========================= */
    .mn-card {
        position: relative;
        z-index: 1;
        width: 100%;
        max-width: 760px;
        margin: auto;
        padding: 44px 44px 28px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, .95);
        border-radius: 30px;
        background: linear-gradient(180deg, rgba(255, 255, 255, .97), rgba(248, 250, 255, .95));

        box-shadow:
            0 40px 90px -15px rgba(2, 6, 23, .55),
            0 14px 36px rgba(2, 6, 23, .25),
            0 0 0 1px rgba(255, 255, 255, .25),
            inset 0 1px 0 #fff;

        backdrop-filter: blur(24px) saturate(1.4);
        -webkit-backdrop-filter: blur(24px) saturate(1.4);
        animation: mnCardEnter .75s cubic-bezier(.2, .8, .2, 1) both;
    }

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

    .mn-card::after {
        content: "";
        position: absolute;
        top: -90px;
        right: -90px;
        width: 240px;
        height: 240px;
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

    /* =========================
       JUDUL
    ========================= */
    .mn-heading {
        position: relative;
        z-index: 1;
        margin: 0;
        color: var(--mn-text);
        text-align: center;
        font-size: 30px;
        line-height: 1.2;
        font-weight: 800;
        letter-spacing: -1px;
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
        max-width: 400px;
        margin: 10px auto 24px;
        color: var(--mn-muted);
        text-align: center;
        font-size: 13px;
        line-height: 1.75;
    }

    /* =========================
       BAR KELENGKAPAN DATA
    ========================= */
    .mn-progress {
        position: relative;
        z-index: 1;
        margin-bottom: 22px;
        padding: 14px 18px;
        border: 1px solid #dbe8fb;
        border-radius: 16px;
        background: linear-gradient(135deg, #f3f8ff, #eaf2ff);
    }

    .mn-progress-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 10px;
        font-size: 12px;
    }

    .mn-progress-title {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--mn-text);
        font-weight: 700;
    }

    .mn-progress-title svg {
        width: 16px;
        height: 16px;
        fill: none;
        stroke: var(--mn-primary);
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .mn-progress-value {
        color: var(--mn-primary-hover);
        font-size: 13px;
        font-weight: 800;
    }

    .mn-progress-track {
        height: 8px;
        overflow: hidden;
        border-radius: 999px;
        background: #d6e5fb;
    }

    .mn-progress-bar {
        display: block;
        width: 0;
        height: 100%;
        border-radius: 999px;
        background: linear-gradient(90deg, #38bdf8, #2563eb);
        box-shadow: 0 0 12px rgba(37, 99, 235, .45);
        transition: width .45s cubic-bezier(.2, .8, .2, 1), background .3s ease;
    }

    .mn-progress.is-complete .mn-progress-bar {
        background: linear-gradient(90deg, #22c55e, #15803d);
        box-shadow: 0 0 12px rgba(34, 197, 94, .45);
    }

    .mn-progress.is-complete .mn-progress-value {
        color: #15803d;
    }

    /* =========================
       FORM & PANEL BAGIAN
    ========================= */
    .mn-form {
        position: relative;
        z-index: 1;
        width: 100%;
    }

    .mn-panel {
        margin-bottom: 18px;
        padding: 22px 22px 4px;
        border: 1px solid #e1ebf8;
        border-radius: 20px;
        background: linear-gradient(180deg, #fbfdff, #f5f9ff);
        box-shadow: 0 1px 2px rgba(15, 31, 77, .03);
        transition: border-color .3s ease, box-shadow .3s ease;
    }

    .mn-panel:focus-within {
        border-color: #bcd3f7;
        box-shadow: 0 8px 24px rgba(37, 99, 235, .07);
    }

    .mn-panel.is-done {
        border-color: #bbf0cb;
    }

    .mn-panel-head {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        padding-bottom: 14px;
        border-bottom: 1px solid #e3ecf8;
    }

    .mn-step {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        flex: 0 0 28px;
        border-radius: 9px;
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        box-shadow: 0 5px 12px rgba(37, 99, 235, .3);
        color: #fff;
        font-size: 13px;
        font-weight: 800;
        transition: background .3s ease, box-shadow .3s ease;
    }

    .mn-panel.is-done .mn-step {
        background: linear-gradient(135deg, #22c55e, #15803d);
        box-shadow: 0 5px 12px rgba(21, 128, 61, .3);
    }

    .mn-panel-title {
        color: var(--mn-text);
        font-size: 15px;
        font-weight: 800;
        letter-spacing: -.2px;
    }

    .mn-panel-count {
        margin-left: auto;
        padding: 4px 11px;
        border-radius: 999px;
        background: #e0ecff;
        color: var(--mn-primary-hover);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .2px;
        white-space: nowrap;
        transition: background .3s ease, color .3s ease;
    }

    .mn-panel.is-done .mn-panel-count {
        background: #dcfce7;
        color: #15803d;
    }

    .mn-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 0 18px;
    }

    .mn-field {
        min-width: 0;
        margin-bottom: 18px;
    }

    .mn-field.full {
        grid-column: 1 / -1;
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

    .mn-input-wrap.is-textarea {
        align-items: flex-start;
    }

    .mn-input-icon {
        position: absolute;
        left: 15px;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        pointer-events: none;
        transition: color .2s ease, transform .2s ease;
    }

    .mn-input-wrap.is-textarea .mn-input-icon {
        top: 16px;
    }

    .mn-input-icon svg {
        width: 19px;
        height: 19px;
        fill: none;
        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
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
        background: #fff;
        color: #0f172a;
        font-family: inherit;
        font-size: 14px;
        font-weight: 500;
        box-shadow: 0 1px 2px rgba(15, 23, 42, .03);
        -webkit-appearance: none;
        appearance: none;
        transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
    }

    textarea.mn-input {
        height: auto;
        min-height: 96px;
        padding: 14px 16px 14px 46px;
        line-height: 1.6;
        resize: vertical;
    }

    select.mn-input {
        padding-right: 42px;
        cursor: pointer;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        background-size: 18px;
    }

    input[type="date"].mn-input {
        padding-right: 14px;
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
        background-color: #fff;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, .14);
    }

    .mn-input-wrap:focus-within .mn-input-icon {
        color: var(--mn-primary);
        transform: scale(1.06);
    }

    .mn-input:-webkit-autofill,
    .mn-input:-webkit-autofill:hover,
    .mn-input:-webkit-autofill:focus {
        -webkit-text-fill-color: #0f172a;
        -webkit-box-shadow: 0 0 0 1000px #eff6ff inset;
        transition: background-color 9999s ease-in-out 0s;
    }

    .mn-input.is-invalid {
        border-color: #f87171;
        background-color: #fffafa;
    }

    .mn-input.is-invalid:focus {
        box-shadow: 0 0 0 4px rgba(248, 113, 113, .14);
    }

    /* =========================
       UPLOAD FILE (KUSTOM)
    ========================= */
    .mn-file {
        position: relative;
    }

    .mn-file-input {
        position: absolute;
        width: 1px;
        height: 1px;
        opacity: 0;
        overflow: hidden;
        pointer-events: none;
    }

    .mn-file-box {
        display: flex;
        align-items: center;
        gap: 12px;
        width: 100%;
        min-height: 56px;
        padding: 8px;
        border: 1.5px dashed #bcd3f7;
        border-radius: var(--mn-radius);
        background: linear-gradient(180deg, #f8fbff, #eef5ff);
        cursor: pointer;
        transition: border-color .2s ease, background .2s ease, box-shadow .2s ease;
    }

    .mn-file-box:hover {
        border-color: #60a5fa;
        background: #eaf3ff;
    }

    .mn-file-input:focus-visible + .mn-file-box {
        border-style: solid;
        border-color: #3b82f6;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, .14);
    }

    .mn-file-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        flex: 0 0 38px;
        border-radius: 11px;
        background: #dbeafe;
        color: var(--mn-primary-hover);
        transition: background .2s ease, color .2s ease;
    }

    .mn-file-icon svg {
        width: 19px;
        height: 19px;
        fill: none;
        stroke: currentColor;
        stroke-width: 1.9;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .mn-file-text {
        min-width: 0;
        flex: 1;
    }

    .mn-file-name {
        display: block;
        overflow: hidden;
        color: #64748b;
        font-size: 12.5px;
        font-weight: 500;
        line-height: 1.35;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .mn-file-meta {
        display: none;
        color: #94a3b8;
        font-size: 11px;
        line-height: 1.3;
    }

    .mn-file-btn {
        flex: 0 0 auto;
        padding: 9px 15px;
        border-radius: 10px;
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        box-shadow: 0 4px 10px rgba(37, 99, 235, .25);
        color: #fff;
        font-size: 12px;
        font-weight: 700;
        line-height: 1;
        transition: transform .2s ease;
    }

    .mn-file-box:hover .mn-file-btn {
        transform: translateY(-1px);
    }

    .mn-file.has-file .mn-file-box {
        border-style: solid;
        border-color: #86efac;
        background: linear-gradient(180deg, #f7fffa, #f0fdf4);
    }

    .mn-file.has-file .mn-file-icon {
        background: #dcfce7;
        color: #15803d;
    }

    .mn-file.has-file .mn-file-name {
        color: #0f172a;
        font-weight: 600;
    }

    .mn-file.has-file .mn-file-meta {
        display: block;
    }

    .mn-file.has-file .mn-file-btn {
        background: #fff;
        box-shadow: inset 0 0 0 1.5px #bfdbfe;
        color: var(--mn-primary-hover);
    }

    .mn-file.is-invalid .mn-file-box {
        border-color: #f87171;
        background: #fffafa;
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
        fill: none;
        stroke: currentColor;
        stroke-width: 1.8;
        stroke-linecap: round;
        stroke-linejoin: round;
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
       LEVEL PASSWORD
    ========================= */
    .mn-strength {
        margin-top: 12px;
        padding: 13px 15px;
        border: 1px solid #e2ebf7;
        border-radius: 14px;
        background: #fff;
    }

    .mn-strength-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 10px;
        font-size: 11.5px;
    }

    .mn-strength-title {
        color: var(--mn-muted);
        font-weight: 600;
    }

    .mn-strength-label {
        padding: 3px 10px;
        border-radius: 999px;
        background: #e2e8f0;
        color: #64748b;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .2px;
        transition: background .25s ease, color .25s ease;
    }

    .mn-strength-bars {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 6px;
    }

    .mn-strength-bars span {
        height: 6px;
        border-radius: 999px;
        background: #e2e8f0;
        transition: background .3s ease;
    }

    .mn-strength[data-level="1"] .mn-strength-bars span:nth-child(-n+1) { background: #ef4444; }
    .mn-strength[data-level="2"] .mn-strength-bars span:nth-child(-n+2) { background: #f59e0b; }
    .mn-strength[data-level="3"] .mn-strength-bars span:nth-child(-n+3) { background: #3b82f6; }
    .mn-strength[data-level="4"] .mn-strength-bars span:nth-child(-n+4) { background: #16a34a; }

    .mn-strength[data-level="1"] .mn-strength-label { background: #fee2e2; color: #b91c1c; }
    .mn-strength[data-level="2"] .mn-strength-label { background: #fef3c7; color: #b45309; }
    .mn-strength[data-level="3"] .mn-strength-label { background: #dbeafe; color: #1d4ed8; }
    .mn-strength[data-level="4"] .mn-strength-label { background: #dcfce7; color: #15803d; }

    .mn-rules {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 7px 14px;
        margin: 12px 0 0;
        padding: 0;
        list-style: none;
    }

    .mn-rules li {
        display: flex;
        align-items: center;
        gap: 7px;
        color: #7c8aa3;
        font-size: 11.5px;
        line-height: 1.4;
        transition: color .2s ease;
    }

    .mn-rules li::before {
        content: "";
        width: 15px;
        height: 15px;
        flex: 0 0 15px;
        border-radius: 50%;
        background: #e2e8f0 center / 9px no-repeat;
        transition: background-color .2s ease;
    }

    .mn-rules li.ok {
        color: #166534;
        font-weight: 600;
    }

    .mn-rules li.ok::before {
        background-color: #16a34a;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='3.5' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m5 12 5 5L20 7'/%3E%3C/svg%3E");
    }

    .mn-hint {
        display: block;
        min-height: 0;
        margin-top: 7px;
        padding-left: 2px;
        font-size: 11.5px;
        font-weight: 600;
        line-height: 1.5;
    }

    .mn-hint.ok {
        color: #15803d;
    }

    .mn-hint.bad {
        color: #b45309;
    }

    /* =========================
       TOMBOL REGISTER
    ========================= */
    .mn-submit {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        min-height: 54px;
        margin-top: 4px;
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
        transition: transform .2s ease, box-shadow .2s ease, background-position .4s ease;
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
        flex: 0 0 18px;
        fill: none;
        stroke: currentColor;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
        transition: transform .25s ease;
    }

    .mn-submit:hover:not(:disabled) .mn-submit-icon {
        transform: translateX(3px);
    }

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

    .mn-submit.mn-loading .mn-submit-icon,
    .mn-submit.mn-loading::before,
    .mn-submit.mn-loading .mn-ripple {
        display: none !important;
    }

    /* Hanya spinner milik halaman ini yang boleh tampil di tombol */
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
       LINK LOGIN
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
       RIPPLE
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
    @media (max-width: 768px) {
        .mn-card {
            padding: 38px 30px 26px;
        }
    }

    @media (max-width: 640px) {
        .mn-grid {
            grid-template-columns: minmax(0, 1fr);
        }

        .mn-panel {
            padding: 18px 16px 2px;
            border-radius: 18px;
        }

        .mn-card {
            padding: 34px 22px 24px;
        }
    }

    @media (max-width: 480px) {
        .mn {
            padding: 20px 12px;
        }

        .mn-card {
            max-width: 100%;
            padding: 30px 16px 22px;
            border-radius: 24px;
        }

        .mn-logo-link {
            width: 84px;
            height: 84px;
            border-radius: 23px;
        }

        .mn-heading {
            font-size: 26px;
        }

        .mn-subtitle {
            margin-bottom: 20px;
            font-size: 12.5px;
        }

        .mn-progress {
            padding: 12px 14px;
        }

        /* 16px mencegah zoom otomatis di iOS Safari */
        .mn-input,
        select.mn-input,
        textarea.mn-input {
            font-size: 16px;
        }

        .mn-input {
            height: 50px;
        }

        textarea.mn-input {
            height: auto;
        }

        .mn-rules {
            grid-template-columns: minmax(0, 1fr);
        }

        .mn-submit {
            min-height: 52px;
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

    @media (max-width: 360px) {
        .mn-card {
            padding: 26px 12px 20px;
        }

        .mn-heading {
            font-size: 23px;
        }

        .mn-logo-link {
            width: 76px;
            height: 76px;
        }

        .mn-badge {
            font-size: 17px;
            letter-spacing: 1.8px;
        }

        .mn-badge-wrap::before,
        .mn-badge-wrap::after {
            width: 18px;
            flex-basis: 18px;
        }

        .mn-panel {
            padding: 16px 12px 2px;
        }

        .mn-file-btn {
            padding: 9px 11px;
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
                    alt="Icon Kota Madiun"
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
            <span>Register</span>
        </h1>

        <p class="mn-subtitle">
            Lengkapi data diri Anda dengan benar untuk membuat akun baru.
        </p>

        {{-- Bar kelengkapan data --}}
        <div class="mn-progress" id="mnProgress" aria-live="polite">
            <div class="mn-progress-head">
                <span class="mn-progress-title">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M9 11l3 3L22 4"></path>
                        <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                    </svg>
                    Kelengkapan data
                </span>
                <span class="mn-progress-value" id="mnProgressText">0%</span>
            </div>

            <div class="mn-progress-track">
                <span class="mn-progress-bar" id="mnProgressBar"></span>
            </div>
        </div>

        {{-- Form register Laravel --}}
        <form
            method="POST"
            action="{{ route('register.post') }}"
            enctype="multipart/form-data"
            class="mn-form"
            id="mnRegisterForm"
        >
            @csrf

            {{-- ===== Bagian 1: Data Pribadi ===== --}}
            <section class="mn-panel" data-panel>
                <div class="mn-panel-head">
                    <span class="mn-step" data-step="1">1</span>
                    <span class="mn-panel-title">Data Pribadi</span>
                    <span class="mn-panel-count" data-count>0/6</span>
                </div>

                <div class="mn-grid">
                    {{-- Nama Lengkap --}}
                    <div class="mn-field full">
                        <label for="mnName" class="mn-label">Nama Lengkap</label>

                        <div class="mn-input-wrap">
                            <span class="mn-input-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24">
                                    <circle cx="12" cy="8" r="4"></circle>
                                    <path d="M4 21a8 8 0 0 1 16 0"></path>
                                </svg>
                            </span>

                            <input
                                type="text"
                                id="mnName"
                                class="mn-input @error('name') is-invalid @enderror"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Masukkan Nama Lengkap"
                                autocomplete="name"
                                data-track
                            >
                        </div>

                        @error('name')
                            <span class="mn-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Tempat Lahir --}}
                    <div class="mn-field">
                        <label for="mnBirthPlace" class="mn-label">Tempat Lahir</label>

                        <div class="mn-input-wrap">
                            <span class="mn-input-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24">
                                    <path d="M12 21s7-6.2 7-11.5a7 7 0 1 0-14 0C5 14.8 12 21 12 21Z"></path>
                                    <circle cx="12" cy="9.5" r="2.5"></circle>
                                </svg>
                            </span>

                            <input
                                type="text"
                                id="mnBirthPlace"
                                class="mn-input @error('birth_place') is-invalid @enderror"
                                name="birth_place"
                                value="{{ old('birth_place') }}"
                                placeholder="Masukkan Tempat Lahir"
                                data-track
                            >
                        </div>

                        @error('birth_place')
                            <span class="mn-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div class="mn-field">
                        <label for="mnBirthDate" class="mn-label">Tanggal Lahir</label>

                        <div class="mn-input-wrap">
                            <span class="mn-input-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24">
                                    <rect x="3" y="5" width="18" height="16" rx="3"></rect>
                                    <path d="M8 3v4M16 3v4M3 10h18"></path>
                                </svg>
                            </span>

                            <input
                                type="date"
                                id="mnBirthDate"
                                class="mn-input @error('birth_date') is-invalid @enderror"
                                name="birth_date"
                                value="{{ old('birth_date') }}"
                                data-track
                            >
                        </div>

                        @error('birth_date')
                            <span class="mn-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Alamat --}}
                    <div class="mn-field full">
                        <label for="mnAddress" class="mn-label">Alamat</label>

                        <div class="mn-input-wrap is-textarea">
                            <span class="mn-input-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24">
                                    <path d="m3 11 9-8 9 8"></path>
                                    <path d="M5 10v10h14V10"></path>
                                </svg>
                            </span>

                            <textarea
                                id="mnAddress"
                                class="mn-input @error('address') is-invalid @enderror"
                                name="address"
                                rows="3"
                                placeholder="Masukkan Alamat Lengkap"
                                data-track
                            >{{ old('address') }}</textarea>
                        </div>

                        @error('address')
                            <span class="mn-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Nomor Telepon --}}
                    <div class="mn-field">
                        <label for="mnPhone" class="mn-label">Nomor Telepon</label>

                        <div class="mn-input-wrap">
                            <span class="mn-input-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24">
                                    <path d="M5 4h4l2 5-2.5 1.5a11 11 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2Z"></path>
                                </svg>
                            </span>

                            <input
                                type="text"
                                id="mnPhone"
                                class="mn-input @error('nomor_telepon') is-invalid @enderror"
                                name="nomor_telepon"
                                value="{{ old('nomor_telepon') }}"
                                placeholder="Masukkan Nomor Telepon"
                                inputmode="tel"
                                autocomplete="tel"
                                data-track
                            >
                        </div>

                        @error('nomor_telepon')
                            <span class="mn-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Agama --}}
                    <div class="mn-field">
                        <label for="mnReligion" class="mn-label">Agama</label>

                        <div class="mn-input-wrap">
                            <span class="mn-input-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24">
                                    <path d="M4 5a2 2 0 0 1 2-2h13v16H6a2 2 0 0 0-2 2V5Z"></path>
                                    <path d="M4 19a2 2 0 0 1 2-2h13"></path>
                                </svg>
                            </span>

                            <select
                                id="mnReligion"
                                class="mn-input @error('religion') is-invalid @enderror"
                                name="religion"
                                data-track
                            >
                                <option disabled selected>-- Pilih Agama --</option>
                                <option value="Islam" {{ old('religion') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('religion') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ old('religion') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('religion') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('religion') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ old('religion') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                            </select>
                        </div>

                        @error('religion')
                            <span class="mn-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </section>

            {{-- ===== Bagian 2: Dokumen ===== --}}
            <section class="mn-panel" data-panel>
                <div class="mn-panel-head">
                    <span class="mn-step" data-step="2">2</span>
                    <span class="mn-panel-title">Dokumen</span>
                    <span class="mn-panel-count" data-count>0/3</span>
                </div>

                <div class="mn-grid">
                    {{-- Upload KTP --}}
                    <div class="mn-field">
                        <label for="mnKtp" class="mn-label">Upload KTP</label>

                        <div class="mn-file @error('ktp') is-invalid @enderror">
                            <input type="file" id="mnKtp" class="mn-file-input" name="ktp" data-track>

                            <label for="mnKtp" class="mn-file-box">
                                <span class="mn-file-icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8l-5-5Z"></path>
                                        <path d="M14 3v5h5M9 13h6M9 17h6"></path>
                                    </svg>
                                </span>

                                <span class="mn-file-text">
                                    <span class="mn-file-name">Belum ada file dipilih</span>
                                    <span class="mn-file-meta"></span>
                                </span>

                                <span class="mn-file-btn">Pilih File</span>
                            </label>
                        </div>

                        @error('ktp')
                            <span class="mn-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Upload KK --}}
                    <div class="mn-field">
                        <label for="mnKk" class="mn-label">Upload KK</label>

                        <div class="mn-file @error('kk') is-invalid @enderror">
                            <input type="file" id="mnKk" class="mn-file-input" name="kk" data-track>

                            <label for="mnKk" class="mn-file-box">
                                <span class="mn-file-icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8l-5-5Z"></path>
                                        <path d="M14 3v5h5M9 13h6M9 17h6"></path>
                                    </svg>
                                </span>

                                <span class="mn-file-text">
                                    <span class="mn-file-name">Belum ada file dipilih</span>
                                    <span class="mn-file-meta"></span>
                                </span>

                                <span class="mn-file-btn">Pilih File</span>
                            </label>
                        </div>

                        @error('kk')
                            <span class="mn-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Upload Foto --}}
                    <div class="mn-field full">
                        <label for="mnPhoto" class="mn-label">Upload Foto</label>

                        <div class="mn-file @error('photo') is-invalid @enderror">
                            <input type="file" id="mnPhoto" class="mn-file-input" name="photo" data-track>

                            <label for="mnPhoto" class="mn-file-box">
                                <span class="mn-file-icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24">
                                        <rect x="3" y="4" width="18" height="16" rx="3"></rect>
                                        <circle cx="9" cy="10" r="1.8"></circle>
                                        <path d="m21 16-5-5-9 9"></path>
                                    </svg>
                                </span>

                                <span class="mn-file-text">
                                    <span class="mn-file-name">Belum ada file dipilih</span>
                                    <span class="mn-file-meta"></span>
                                </span>

                                <span class="mn-file-btn">Pilih File</span>
                            </label>
                        </div>

                        @error('photo')
                            <span class="mn-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </section>

            {{-- ===== Bagian 3: Akun ===== --}}
            <section class="mn-panel" data-panel>
                <div class="mn-panel-head">
                    <span class="mn-step" data-step="3">3</span>
                    <span class="mn-panel-title">Akun</span>
                    <span class="mn-panel-count" data-count>0/3</span>
                </div>

                <div class="mn-grid">
                    {{-- Email --}}
                    <div class="mn-field full">
                        <label for="mnEmail" class="mn-label">Email</label>

                        <div class="mn-input-wrap">
                            <span class="mn-input-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24">
                                    <rect x="3" y="5" width="18" height="14" rx="3"></rect>
                                    <path d="m4 7 8 6 8-6"></path>
                                </svg>
                            </span>

                            <input
                                type="email"
                                id="mnEmail"
                                class="mn-input @error('email') is-invalid @enderror"
                                name="email"
                                value="{{ old('email') }}"
                                placeholder="Masukkan Email"
                                autocomplete="username"
                                inputmode="email"
                                data-track
                            >
                        </div>

                        @error('email')
                            <span class="mn-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Password + level --}}
                    <div class="mn-field full">
                        <label for="mnPassword" class="mn-label">Password</label>

                        <div class="mn-input-wrap">
                            <span class="mn-input-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24">
                                    <rect x="4" y="10" width="16" height="11" rx="3"></rect>
                                    <path d="M8 10V7a4 4 0 0 1 8 0v3"></path>
                                    <path d="M12 14v3"></path>
                                </svg>
                            </span>

                            <input
                                type="password"
                                id="mnPassword"
                                class="mn-input @error('password') is-invalid @enderror"
                                name="password"
                                placeholder="Masukkan Password min. 8 karakter"
                                autocomplete="new-password"
                                data-track
                            >

                            <button
                                type="button"
                                class="mn-eye"
                                data-target="mnPassword"
                                aria-label="Tampilkan password"
                                aria-pressed="false"
                            >
                                <svg class="eye-open" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>

                                <svg class="eye-closed" viewBox="0 0 24 24" aria-hidden="true" hidden>
                                    <path d="m3 3 18 18"></path>
                                    <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"></path>
                                    <path d="M9.9 5.2A10.8 10.8 0 0 1 12 5c6.5 0 10 7 10 7a14.8 14.8 0 0 1-3.1 3.9"></path>
                                    <path d="M6.2 6.2C3.5 8 2 12 2 12s3.5 7 10 7a10.5 10.5 0 0 0 4-.8"></path>
                                </svg>
                            </button>
                        </div>

                        @error('password')
                            <span class="mn-feedback" role="alert">{{ $message }}</span>
                        @enderror

                        {{-- Level kekuatan password --}}
                        <div class="mn-strength" id="mnStrength" data-level="0" aria-live="polite">
                            <div class="mn-strength-head">
                                <span class="mn-strength-title">Level kekuatan password</span>
                                <span class="mn-strength-label" id="mnStrengthLabel">Belum diisi</span>
                            </div>

                            <div class="mn-strength-bars" aria-hidden="true">
                                <span></span><span></span><span></span><span></span>
                            </div>

                            <ul class="mn-rules">
                                <li data-rule="length">Minimal 8 karakter</li>
                                <li data-rule="case">Huruf besar &amp; kecil</li>
                                <li data-rule="number">Mengandung angka</li>
                                <li data-rule="symbol">Mengandung simbol (!@#$)</li>
                            </ul>
                        </div>
                    </div>

                    {{-- Ulangi Password --}}
                    <div class="mn-field full">
                        <label for="mnPasswordConfirm" class="mn-label">Ulangi Password</label>

                        <div class="mn-input-wrap">
                            <span class="mn-input-icon" aria-hidden="true">
                                <svg viewBox="0 0 24 24">
                                    <rect x="4" y="10" width="16" height="11" rx="3"></rect>
                                    <path d="M8 10V7a4 4 0 0 1 8 0v3"></path>
                                    <path d="M12 14v3"></path>
                                </svg>
                            </span>

                            <input
                                type="password"
                                id="mnPasswordConfirm"
                                class="mn-input"
                                name="password_confirmation"
                                placeholder="Ulangi Password min. 8 karakter"
                                autocomplete="new-password"
                                data-track="confirm"
                            >

                            <button
                                type="button"
                                class="mn-eye"
                                data-target="mnPasswordConfirm"
                                aria-label="Tampilkan password"
                                aria-pressed="false"
                            >
                                <svg class="eye-open" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7S2 12 2 12Z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>

                                <svg class="eye-closed" viewBox="0 0 24 24" aria-hidden="true" hidden>
                                    <path d="m3 3 18 18"></path>
                                    <path d="M10.6 10.6a2 2 0 0 0 2.8 2.8"></path>
                                    <path d="M9.9 5.2A10.8 10.8 0 0 1 12 5c6.5 0 10 7 10 7a14.8 14.8 0 0 1-3.1 3.9"></path>
                                    <path d="M6.2 6.2C3.5 8 2 12 2 12s3.5 7 10 7a10.5 10.5 0 0 0 4-.8"></path>
                                </svg>
                            </button>
                        </div>

                        <span class="mn-hint" id="mnMatchHint" aria-live="polite"></span>
                    </div>
                </div>
            </section>

            {{-- Tombol register --}}
            <button type="submit" class="mn-submit" id="mnSubmit">
                <span class="mn-spinner" id="mnSpinner" aria-hidden="true"></span>

                <svg class="mn-submit-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="9" cy="8" r="4"></circle>
                    <path d="M2 21a7 7 0 0 1 14 0"></path>
                    <path d="M19 8v6M16 11h6"></path>
                </svg>

                <span id="mnSubmitText">Register</span>
            </button>
        </form>

        {{-- Link login --}}
        <p class="mn-register">
            Sudah punya akun?
            <a href="{{ route('login') }}">Login</a>
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
        const registerForm = document.getElementById('mnRegisterForm');
        const submitButton = document.getElementById('mnSubmit');
        const submitText = document.getElementById('mnSubmitText');

        const passwordInput = document.getElementById('mnPassword');
        const confirmInput = document.getElementById('mnPasswordConfirm');

        /*
         * Tampilkan atau sembunyikan password (kedua kolom password).
         */
        document.querySelectorAll('.mn-eye').forEach(function (button) {
            const input = document.getElementById(button.getAttribute('data-target'));
            const eyeOpen = button.querySelector('.eye-open');
            const eyeClosed = button.querySelector('.eye-closed');

            if (!input || !eyeOpen || !eyeClosed) {
                return;
            }

            button.addEventListener('click', function () {
                const show = input.type === 'password';

                input.type = show ? 'text' : 'password';

                eyeOpen.hidden = show;
                eyeClosed.hidden = !show;

                button.setAttribute(
                    'aria-label',
                    show ? 'Sembunyikan password' : 'Tampilkan password'
                );
                button.setAttribute('aria-pressed', show ? 'true' : 'false');

                input.focus();
            });
        });

        /*
         * Level kekuatan password.
         * Level 1 Lemah, 2 Sedang, 3 Kuat, 4 Sangat Kuat.
         * Jika kurang dari 8 karakter, level maksimal "Lemah".
         */
        const strengthBox = document.getElementById('mnStrength');
        const strengthLabel = document.getElementById('mnStrengthLabel');
        const matchHint = document.getElementById('mnMatchHint');
        const levelNames = ['Belum diisi', 'Lemah', 'Sedang', 'Kuat', 'Sangat Kuat'];

        function evaluatePassword() {
            if (!passwordInput || !strengthBox || !strengthLabel) {
                return;
            }

            const value = passwordInput.value;

            const checks = {
                length: value.length >= 8,
                case: /[a-z]/.test(value) && /[A-Z]/.test(value),
                number: /\d/.test(value),
                symbol: /[^A-Za-z0-9]/.test(value)
            };

            const score = Object.keys(checks).filter(function (key) {
                return checks[key];
            }).length;

            let level = 0;

            if (value.length > 0) {
                level = checks.length ? Math.max(1, Math.min(4, score)) : 1;
            }

            strengthBox.setAttribute('data-level', String(level));
            strengthLabel.textContent = levelNames[level];

            Object.keys(checks).forEach(function (key) {
                const item = strengthBox.querySelector('[data-rule="' + key + '"]');

                if (item) {
                    item.classList.toggle('ok', checks[key]);
                }
            });
        }

        function evaluateMatch() {
            if (!confirmInput || !passwordInput || !matchHint) {
                return;
            }

            if (confirmInput.value === '') {
                matchHint.textContent = '';
                matchHint.className = 'mn-hint';
                return;
            }

            if (confirmInput.value === passwordInput.value) {
                matchHint.textContent = 'Password cocok';
                matchHint.className = 'mn-hint ok';
            } else {
                matchHint.textContent = 'Password belum sama';
                matchHint.className = 'mn-hint bad';
            }
        }

        if (passwordInput) {
            passwordInput.addEventListener('input', function () {
                evaluatePassword();
                evaluateMatch();
            });

            evaluatePassword();
        }

        if (confirmInput) {
            confirmInput.addEventListener('input', evaluateMatch);
        }

        /*
         * Tampilkan nama dan ukuran file yang dipilih.
         */
        function formatSize(bytes) {
            if (bytes < 1024) {
                return bytes + ' B';
            }

            if (bytes < 1024 * 1024) {
                return (bytes / 1024).toFixed(1) + ' KB';
            }

            return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
        }

        document.querySelectorAll('.mn-file-input').forEach(function (input) {
            const wrap = input.closest('.mn-file');
            const nameEl = wrap.querySelector('.mn-file-name');
            const metaEl = wrap.querySelector('.mn-file-meta');
            const buttonEl = wrap.querySelector('.mn-file-btn');

            input.addEventListener('change', function () {
                const file = input.files && input.files[0];

                if (file) {
                    nameEl.textContent = file.name;
                    metaEl.textContent = formatSize(file.size);
                    buttonEl.textContent = 'Ganti';
                    wrap.classList.add('has-file');
                    wrap.classList.remove('is-invalid');
                } else {
                    nameEl.textContent = 'Belum ada file dipilih';
                    metaEl.textContent = '';
                    buttonEl.textContent = 'Pilih File';
                    wrap.classList.remove('has-file');
                }
            });
        });

        /*
         * Kelengkapan data: hitung kolom yang sudah terisi
         * per bagian dan secara keseluruhan (hanya tampilan).
         */
        const progressBox = document.getElementById('mnProgress');
        const progressBar = document.getElementById('mnProgressBar');
        const progressText = document.getElementById('mnProgressText');
        const panels = document.querySelectorAll('[data-panel]');

        function isFilled(el) {
            if (el.type === 'file') {
                return !!(el.files && el.files.length);
            }

            if (el.tagName === 'SELECT') {
                const option = el.options[el.selectedIndex];

                return !!option && !option.disabled && el.value !== '';
            }

            if (el.getAttribute('data-track') === 'confirm') {
                return el.value !== '' && passwordInput && el.value === passwordInput.value;
            }

            return el.value.trim() !== '';
        }

        function updateProgress() {
            let totalDone = 0;
            let totalAll = 0;

            panels.forEach(function (panel) {
                const fields = panel.querySelectorAll('[data-track]');
                const countEl = panel.querySelector('[data-count]');
                const stepEl = panel.querySelector('[data-step]');

                let done = 0;

                fields.forEach(function (field) {
                    if (isFilled(field)) {
                        done++;
                    }
                });

                const complete = fields.length > 0 && done === fields.length;

                totalDone += done;
                totalAll += fields.length;

                panel.classList.toggle('is-done', complete);

                if (countEl) {
                    countEl.textContent = complete ? 'Lengkap' : done + '/' + fields.length;
                }

                if (stepEl) {
                    stepEl.textContent = complete ? '✓' : stepEl.getAttribute('data-step');
                }
            });

            const percent = totalAll ? Math.round((totalDone / totalAll) * 100) : 0;

            if (progressBar) {
                progressBar.style.width = percent + '%';
            }

            if (progressText) {
                progressText.textContent = percent + '%';
            }

            if (progressBox) {
                progressBox.classList.toggle('is-complete', percent === 100);
            }
        }

        if (registerForm) {
            registerForm.addEventListener('input', updateProgress);
            registerForm.addEventListener('change', updateProgress);
        }

        updateProgress();
        window.addEventListener('load', updateProgress);
        setTimeout(updateProgress, 500);

        /*
         * Efek ripple pada tombol register.
         */
        if (submitButton) {
            submitButton.addEventListener('click', function (event) {
                if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
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
         * Loading submit: satu spinner saja, cegah submit ganda.
         */
        if (registerForm && submitButton) {
            registerForm.addEventListener('submit', function (event) {
                if (submitButton.classList.contains('mn-loading')) {
                    event.preventDefault();
                    return;
                }

                const allowedIds = ['mnSpinner', 'mnSubmitText'];

                function removeForeignNodes() {
                    Array.from(submitButton.children).forEach(function (child) {
                        const isOurs =
                            allowedIds.indexOf(child.id) !== -1 ||
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
             * Reset tombol saat halaman dipulihkan dari cache (tombol Back).
             */
            window.addEventListener('pageshow', function (event) {
                if (!event.persisted) {
                    return;
                }

                submitButton.classList.remove('mn-loading');
                submitButton.disabled = false;
                submitButton.removeAttribute('data-mn-busy');

                if (submitText) {
                    submitText.textContent = 'Register';
                }

                updateProgress();
            });
        }
    });
</script>
@endsection