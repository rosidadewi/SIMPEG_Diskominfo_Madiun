<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.partials.head')

    {{-- [TEMA] Font tema dari master --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @yield('style')
    <style>
        .invalid-feedback { font-size: 14px; }
        .error { color: red; }
    </style>
</head>
<body>

<div class="main-wrapper">

    <!-- Loader -->
    <div id="loader-wrapper">
        <div id="loader">
            <div class="loader-ellips">
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
            </div>
        </div>
    </div>

    @include('layouts.partials.header')
    @include('sidebar.sidebar')

    <div class="page-wrapper">
        <div class="content container-fluid">
            @yield('content')
        </div>
        @include('layouts.footer')
    </div>
</div>

{{-- [TEMA] Dialog konfirmasi keluar (dari master) --}}
<div class="logout-modal" id="masterLogoutModal" role="alertdialog" aria-modal="true" aria-labelledby="logoutTitle" aria-describedby="logoutDesc" hidden>
    <div class="logout-box">
        <div class="logout-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><path d="M12 9v4"/><path d="M12 17h.01"/>
            </svg>
        </div>
        <h5 id="logoutTitle">Keluar dari akun?</h5>
        <p class="logout-sub">Anda akan keluar dari:</p>
        <span class="logout-from">{{ Session::get('name', 'SIMPEG Non-ASN') }}</span>
        <p class="logout-warn" id="logoutDesc">⚠️ Sesi Anda akan diakhiri dan Anda perlu <strong>login kembali</strong> untuk mengelola data Anda.</p>
        <div class="logout-actions">
            <button type="button" class="lo-btn lo-cancel" data-lo="cancel">Batal</button>
            <button type="button" class="lo-btn lo-confirm" data-lo="confirm">Ya, Keluar</button>
        </div>
    </div>
</div>

<!-- JS (tidak diubah) -->
<script src="{{ URL::to('assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ URL::to('assets/js/popper.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ URL::to('assets/plugins/morris/morris.min.js') }}"></script>
<script src="{{ URL::to('assets/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ URL::to('assets/js/chart.js') }}"></script>
<script src="{{ URL::to('assets/js/Chart.min.js') }}"></script>
<script src="{{ URL::to('assets/js/line-chart.js') }}"></script>
<script src="{{ URL::to('assets/js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ URL::to('assets/js/select2.min.js') }}"></script>
<script src="{{ URL::to('assets/js/moment.min.js') }}"></script>
<script src="{{ URL::to('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ URL::to('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::to('assets/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ URL::to('assets/js/multiselect.min.js') }}"></script>
<script src="{{ URL::to('assets/js/jquery.validate.js') }}"></script>
<script src="{{ URL::to('assets/js/app.js') }}"></script>

<!-- RESPONSIVE -->
<link rel="stylesheet" href="{{ asset('assets/css/responsive-feedback.css') }}">
<script src="{{ asset('assets/js/instant-action.js') }}" defer></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

{{-- [TEMA] Ditaruh setelah semua CSS agar tidak kalah --}}
<style>
    /* ===== Latar tema ===== */
    html {
        background-color: #08142f;
        background-image:
            radial-gradient(58% 48% at 6% 2%, rgba(20, 184, 166, .30), transparent 62%),
            radial-gradient(55% 55% at 94% 6%, rgba(37, 99, 235, .55), transparent 64%),
            radial-gradient(52% 52% at 96% 100%, rgba(79, 70, 229, .5), transparent 62%),
            linear-gradient(160deg, #0b1f4b 0%, #0a1a3d 45%, #08142f 100%);
        background-attachment: fixed;
        min-height: 100%;
    }

    body {
        background: none !important;
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        min-height: 100vh;
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

    .main-wrapper,
    .page-wrapper { background: transparent !important; }

    .page-wrapper .page-title { color: #fff; font-weight: 800; }
    .page-wrapper .breadcrumb { background: transparent; }
    .page-wrapper .breadcrumb-item,
    .page-wrapper .breadcrumb-item a { color: rgba(219, 231, 255, .75); }
    .page-wrapper .breadcrumb-item.active { color: #fff; }

    /* ===== Header ===== */
    .header {
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        background: linear-gradient(100deg, #0b1f4b 0%, #1e40af 50%, #3b82f6 100%) !important;
        border-bottom: 0 !important;
        box-shadow: 0 14px 30px -18px rgba(0, 0, 0, .75);
    }

    .header::after {
        content: "";
        position: absolute;
        left: 0;
        right: 0;
        bottom: 0;
        height: 2px;
        pointer-events: none;
        background: linear-gradient(90deg, transparent, #38bdf8 30%, #2dd4bf 70%, transparent);
    }

    .header .page-title-box h3 {
        color: #fff !important;
        font-weight: 800;
        letter-spacing: -.01em;
    }

    .header #toggle_btn .bar-icon span { background: #fff !important; }
    .header .mobile_btn, .header .mobile-user-menu .nav-link { color: #fff !important; }

    .header .user-menu .nav-link { color: #fff !important; font-weight: 700; }
    .header .user-menu .has-arrow .dropdown-toggle::after { border-color: #fff !important; }

    .header .user-img img {
        width: 34px !important;
        height: 34px !important;
        object-fit: cover;
        border: 2px solid rgba(255, 255, 255, .85);
        border-radius: 50%;
    }

    /* ===== Menu dropdown & tombol Logout ===== */
    .user-menu .dropdown-menu,
    .mobile-user-menu .dropdown-menu {
        min-width: 190px;
        padding: 10px;
        border: 1px solid rgba(15, 23, 42, .06);
        border-radius: 18px;
        background: linear-gradient(180deg, #ffffff, #f1f5fb);
        box-shadow: 0 24px 48px -20px rgba(8, 20, 47, .6);
    }

    .btn-logout {
        display: flex !important;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100% !important;
        padding: 11px 18px;
        font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
        font-weight: 700;
        color: #fff !important;
        border: 0;
        border-radius: 14px;
        background: linear-gradient(135deg, #f43f5e, #dc2626) !important;
        box-shadow: 0 12px 22px -12px rgba(220, 38, 38, .85);
        transition: transform .2s ease, filter .2s ease;
    }

    .btn-logout svg { width: 18px; height: 18px; flex-shrink: 0; }
    .btn-logout:hover { transform: translateY(-2px); filter: brightness(1.07); }
    .btn-logout:active { transform: scale(.97); }
    .btn-logout:focus-visible { outline: 3px solid rgba(248, 113, 113, .5); outline-offset: 2px; }

    /* ===== Sidebar ===== */
    .sidebar {
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
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

    /* ===== Dialog konfirmasi keluar ===== */
    .logout-modal {
        position: fixed;
        inset: 0;
        z-index: 2000;
        display: grid;
        place-items: center;
        padding: 20px;
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
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

    .logout-modal .logout-sub { margin: 0 0 12px; font-size: 1rem; color: #64748b; }

    .logout-modal .logout-from {
        display: inline-block;
        max-width: 100%;
        margin-bottom: 22px;
        padding: 10px 24px;
        font-size: 1.02rem;
        font-weight: 800;
        color: #111827;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        border-radius: 999px;
        overflow-wrap: anywhere;
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
        transition: transform .2s ease, filter .2s ease, background .2s ease;
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

    @media (prefers-reduced-motion: reduce) {
        .logout-modal, .logout-modal * { transition: none !important; }
    }
</style>

@yield('script')
@yield('scripts')

{{-- [TEMA] Konfirmasi sebelum keluar --}}
<script>
    (function () {
        var modal = document.getElementById('masterLogoutModal');
        if (!modal) return;

        if (document.querySelector('.logout-modal:not(#masterLogoutModal)')) {
            modal.remove();
            return;
        }

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
            el.click();
            setTimeout(function () { bypass = false; }, 0);
        });

        cancelBtn.addEventListener('click', function () { pending = null; closeModal(); });
        modal.addEventListener('click', function (e) { if (e.target === modal) { pending = null; closeModal(); } });

        document.addEventListener('keydown', function (e) {
            if (modal.hidden) return;
            if (e.key === 'Escape') { pending = null; closeModal(); }
            if (e.key === 'Tab') {
                if (e.shiftKey && document.activeElement === cancelBtn) { e.preventDefault(); confirmBtn.focus(); }
                else if (!e.shiftKey && document.activeElement === confirmBtn) { e.preventDefault(); cancelBtn.focus(); }
            }
        });
    })();
</script>

</body>
</html>