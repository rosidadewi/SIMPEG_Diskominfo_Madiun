@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css');

    :root {
        --dd-navy: #0f1f4d;
        --dd-blue: #2563eb;
        --dd-blue-light: #3b82f6;
        --dd-cyan: #22b8f0;
        --dd-green: #10b981;
        --dd-orange: #f59e0b;
        --dd-text: #0f1f4d;
        --dd-muted: #64748b;
        --dd-border: #e2e8f0;
    }

    body {
        background:
            radial-gradient(ellipse at 0% 100%, rgba(13, 148, 136, 0.28), transparent 45%),
            radial-gradient(ellipse at 100% 100%, rgba(37, 99, 235, 0.4), transparent 50%),
            radial-gradient(ellipse at 20% 0%, rgba(37, 99, 235, 0.22), transparent 45%),
            linear-gradient(180deg, #0a1a4a 0%, #071333 55%, #0a1f55 100%);
        background-attachment: fixed;
        font-family: 'Plus Jakarta Sans', 'Segoe UI', system-ui, -apple-system, sans-serif;
        color: var(--dd-text);
    }

    .dd-wrap {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 12px 56px;
        position: relative;
    }

    /* pola titik seperti dashboard */
    .dd-wrap::before {
        content: "";
        position: absolute;
        inset: -20px 0 auto 0;
        height: 320px;
        background-image: radial-gradient(rgba(255, 255, 255, 0.13) 1px, transparent 1px);
        background-size: 26px 26px;
        pointer-events: none;
        -webkit-mask-image: linear-gradient(180deg, #000, transparent);
        mask-image: linear-gradient(180deg, #000, transparent);
    }

    /* ===== Panel putih + garis aksen atas (sama dengan kartu dashboard) ===== */
    .header-bar,
    .card,
    .doc-item,
    .modal-content {
        position: relative;
        background: linear-gradient(180deg, #ffffff 0%, #f4f7fc 100%);
        border: 1px solid rgba(255, 255, 255, 0.7);
        box-shadow: 0 22px 50px rgba(2, 8, 30, 0.5);
        overflow: hidden;
    }

    .header-bar::before,
    .card::before,
    .doc-item::before,
    .modal-content::before {
        content: "";
        position: absolute;
        top: 0;
        left: 6%;
        right: 6%;
        height: 4px;
        border-radius: 0 0 8px 8px;
        background: linear-gradient(90deg, transparent, var(--dd-blue), var(--dd-cyan), transparent);
        z-index: 2;
    }

    /* cahaya lembut di pojok kanan atas */
    .header-bar::after,
    .card::after {
        content: "";
        position: absolute;
        top: -60px;
        right: -40px;
        width: 320px;
        height: 220px;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.16), transparent 65%);
        pointer-events: none;
    }

    /* ===== Header (hero) ===== */
    .header-bar {
        padding: 26px 36px;
        border-radius: 44px;
        margin-bottom: 28px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 18px;
    }

    .header-bar h4 {
        margin: 0;
        display: flex;
        align-items: center;
        gap: 22px;
        position: relative;
        z-index: 1;
    }

    .header-bar .title-icon {
        width: 76px;
        height: 76px;
        border-radius: 26px;
        background: #ffffff;
        border: 7px solid #d6e5ff;
        box-shadow: 0 12px 26px rgba(37, 99, 235, 0.22);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.7rem;
        color: var(--dd-blue);
        flex-shrink: 0;
    }

    .header-bar .title-text {
        display: block;
        font-weight: 800;
        font-size: 2rem;
        line-height: 1.15;
        color: var(--dd-navy);
    }

    .header-bar .title-text small {
        display: block;
        margin-top: 6px;
        font-size: 0.92rem;
        font-weight: 500;
        color: var(--dd-muted);
    }

    .header-actions {
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
        position: relative;
        z-index: 1;
    }

    /* ===== Tombol pill gradien ===== */
    .btn {
        border-radius: 999px;
        font-weight: 700;
        padding: 14px 30px;
        border: none;
        letter-spacing: 0.01em;
        transition: transform .18s ease, filter .18s ease;
    }

    .btn i {
        margin-right: 6px;
    }

    .btn:hover {
        transform: translateY(-2px);
        filter: brightness(1.06);
    }

    .btn-warning {
        background: linear-gradient(135deg, #fbbf24, #d97706);
        color: #fff;
        box-shadow: 0 12px 26px rgba(217, 119, 6, 0.4);
    }

    .btn-success {
        background: linear-gradient(135deg, #10b981, #047857);
        color: #fff;
        box-shadow: 0 12px 26px rgba(16, 185, 129, 0.4);
    }

    .btn-warning:hover,
    .btn-success:hover {
        color: #fff;
    }

    .btn-sm {
        padding: 10px 22px;
        font-size: 0.88rem;
    }

    /* ===== Kartu profil ===== */
    .card {
        border-radius: 44px;
    }

    .card-body {
        padding: 46px 44px 48px;
        position: relative;
        z-index: 1;
    }

    .profile-head {
        display: flex;
        align-items: center;
        gap: 34px;
        margin-bottom: 38px;
        padding-bottom: 34px;
        border-bottom: 1px dashed #d3dcef;
    }

    .photo-ring {
        padding: 8px;
        border-radius: 40px;
        background: #ffffff;
        border: 8px solid #d6e5ff;
        box-shadow: 0 14px 30px rgba(37, 99, 235, 0.22);
        flex-shrink: 0;
    }

    .profile-photo {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border-radius: 28px;
        background: #fff;
        display: block;
    }

    .no-photo {
        width: 150px;
        height: 150px;
        border-radius: 28px;
        background: #eef4ff;
        color: #6b8fd6;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        font-size: 13px;
        font-weight: 600;
        padding: 10px;
    }

    .no-photo i {
        font-size: 2.6rem;
        margin-bottom: 8px;
    }

    .profile-title {
        min-width: 0;
    }

    .profile-title .hello {
        font-size: 0.82rem;
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: var(--dd-muted);
        margin-bottom: 8px;
    }

    .profile-title h2 {
        margin: 0;
        font-size: 2.5rem;
        font-weight: 800;
        line-height: 1.12;
        background: linear-gradient(90deg, var(--dd-blue) 20%, var(--dd-cyan));
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
        color: var(--dd-blue);
        word-break: break-word;
    }

    .profile-title .email-pill {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        margin-top: 18px;
        padding: 10px 22px;
        border-radius: 999px;
        background: #f0f4fb;
        border: 1px solid var(--dd-border);
        font-weight: 700;
        font-size: 0.95rem;
        color: #1e293b;
        word-break: break-all;
    }

    .profile-title .email-pill i {
        color: var(--dd-blue);
    }

    /* ===== Judul seksi ===== */
    .section-title {
        font-size: 0.82rem;
        font-weight: 800;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--dd-navy);
        margin: 0 0 18px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .section-title::before {
        content: "";
        width: 6px;
        height: 20px;
        border-radius: 4px;
        background: linear-gradient(180deg, var(--dd-blue), var(--dd-cyan));
    }

    .section-title::after {
        content: "";
        flex: 1;
        height: 1px;
        background: var(--dd-border);
    }

    /* ===== Info grid ===== */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
        margin-bottom: 42px;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 18px;
        padding: 18px 22px;
        background: #f6f9fe;
        border: 1px solid var(--dd-border);
        border-radius: 26px;
        transition: transform .2s ease, border-color .2s ease, box-shadow .2s ease, background .2s ease;
        min-width: 0;
    }

    .info-item:hover {
        transform: translateY(-3px);
        background: #fff;
        border-color: #bcd2ff;
        box-shadow: 0 16px 32px rgba(37, 99, 235, 0.15);
    }

    .info-item.full {
        grid-column: 1 / -1;
    }

    .info-icon {
        width: 54px;
        height: 54px;
        border-radius: 18px;
        background: #eef4ff;
        border: 4px solid #cfe0ff;
        color: var(--dd-blue);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .info-item:nth-child(3) .info-icon,
    .info-item:nth-child(4) .info-icon {
        background: #ecfdf5;
        border-color: #a7f3d0;
        color: #059669;
    }

    .info-item:nth-child(5) .info-icon,
    .info-item:nth-child(6) .info-icon {
        background: #fffbeb;
        border-color: #fde68a;
        color: #d97706;
    }

    .info-text {
        min-width: 0;
        flex: 1;
    }

    .info-label {
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--dd-muted);
        margin-bottom: 3px;
    }

    .info-value {
        font-size: 1.05rem;
        font-weight: 700;
        color: var(--dd-navy);
        word-break: break-word;
    }

    /* ===== Dokumen (kartu seperti dashboard) ===== */
    .doc-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 24px;
    }

    .doc-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 6px;
        padding: 40px 28px 36px;
        border-radius: 40px;
        box-shadow: 0 16px 36px rgba(15, 31, 77, 0.14);
        border: 1px solid var(--dd-border);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .doc-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 26px 48px rgba(15, 31, 77, 0.22);
    }

    .doc-icon {
        width: 96px;
        height: 96px;
        border-radius: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem;
        margin-bottom: 12px;
    }

    .doc-item.ktp::before { background: linear-gradient(90deg, transparent, var(--dd-blue), transparent); }
    .doc-item.ktp .doc-icon { background: #eef4ff; border: 7px solid #cfe0ff; color: var(--dd-blue); }

    .doc-item.kk::before { background: linear-gradient(90deg, transparent, var(--dd-green), transparent); }
    .doc-item.kk .doc-icon { background: #ecfdf5; border: 7px solid #a7f3d0; color: #059669; }

    .doc-item .doc-name {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--dd-navy);
        margin: 0;
    }

    .doc-item .doc-desc {
        font-size: 0.95rem;
        color: var(--dd-muted);
        margin: 0 0 18px;
    }

    .info-link {
        display: inline-block;
        padding: 14px 38px;
        border-radius: 999px;
        color: #fff;
        text-decoration: none;
        cursor: pointer;
        font-weight: 700;
        font-size: 0.98rem;
        transition: transform .18s ease, filter .18s ease;
    }

    .info-link i {
        margin-right: 6px;
    }

    .info-link:hover {
        color: #fff;
        text-decoration: none;
        transform: translateY(-2px);
        filter: brightness(1.06);
    }

    .doc-item.ktp .info-link {
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        box-shadow: 0 12px 26px rgba(37, 99, 235, 0.4);
    }

    .doc-item.kk .info-link {
        background: linear-gradient(135deg, #10b981, #047857);
        box-shadow: 0 12px 26px rgba(16, 185, 129, 0.4);
    }

    /* ===== Modal ===== */
    .modal-content {
        border-radius: 36px;
    }

    .modal-content h5 {
        font-weight: 800;
        color: var(--dd-navy);
    }

    .modal-img {
        max-width: 100%;
        height: auto;
        border-radius: 22px;
        border: 1px solid var(--dd-border);
        box-shadow: 0 12px 32px rgba(15, 31, 77, 0.22);
        display: block;
        margin: 0 auto;
    }

    .modal-img {
        max-height: 70vh;
        object-fit: contain;
        background: #f1f5f9;
    }

    .modal-pdf {
        width: 100%;
        height: 70vh;
        border: 1px solid var(--dd-border);
        border-radius: 22px;
        background: #f1f5f9;
        box-shadow: 0 12px 32px rgba(15, 31, 77, 0.22);
        display: block;
    }

    .modal-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .modal-close {
        width: 44px;
        height: 44px;
        border: none;
        border-radius: 50%;
        background: #eef4ff;
        color: var(--dd-navy);
        font-size: 1.05rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        flex-shrink: 0;
        transition: background .18s ease, color .18s ease, transform .18s ease;
    }

    .modal-close:hover {
        background: #fee2e2;
        color: #dc2626;
        transform: rotate(90deg);
    }

    .modal-close:focus-visible {
        outline: 3px solid #bcd2ff;
        outline-offset: 2px;
    }

    .modal-backdrop.show {
        opacity: 0.75;
        background: #040b22;
    }

    /* ===== Responsif ===== */
    @media (max-width: 991.98px) {
        .profile-title h2 {
            font-size: 2.05rem;
        }
    }

    @media (max-width: 767.98px) {
        .header-bar {
            padding: 22px 20px;
            border-radius: 32px;
            flex-direction: column;
            align-items: stretch;
            text-align: left;
        }

        .header-bar h4 {
            gap: 16px;
        }

        .header-bar .title-icon {
            width: 62px;
            height: 62px;
            border-radius: 22px;
            border-width: 6px;
            font-size: 1.4rem;
        }

        .header-bar .title-text {
            font-size: 1.5rem;
        }

        .header-bar .title-text small {
            font-size: 0.82rem;
        }

        .header-actions {
            width: 100%;
        }

        .header-actions .btn {
            flex: 1;
            text-align: center;
            margin: 0 !important;
            padding: 13px 14px;
        }

        .card {
            border-radius: 32px;
        }

        .card-body {
            padding: 30px 18px 32px;
        }

        .profile-head {
            flex-direction: column;
            text-align: center;
            gap: 22px;
        }

        .profile-photo,
        .no-photo {
            width: 130px;
            height: 130px;
        }

        .profile-title h2 {
            font-size: 1.7rem;
        }

        .info-grid,
        .doc-grid {
            grid-template-columns: 1fr;
        }

        .info-item {
            padding: 14px 16px;
            border-radius: 22px;
        }

        .doc-item {
            border-radius: 32px;
            padding: 32px 20px 28px;
        }

        .modal-content {
            padding: 1.1rem !important;
            border-radius: 28px;
        }
    }
</style>

<div class="dd-wrap mt-2">
    <div class="header-bar">
        <h4>
            <span class="title-icon"><i class="fas fa-id-card"></i></span>
            <span class="title-text">Data Diri<small>Kelola semua informasi Data Diri Anda.</small></span>
        </h4>
        <div class="header-actions">
            <a href="{{ route('datadiri.edit') }}" class="btn btn-warning me-2"><i class="fas fa-edit"></i>Edit</a>
            <a href="{{ route('datadiri.download') }}" class="btn btn-success"><i class="fas fa-download"></i>Download PDF</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            <!-- Header Profil -->
            <div class="profile-head">
                <div class="photo-ring">
                    @if($user->photo)
                        <img src="{{ asset('storage/uploads/photo/' . $user->photo) }}" class="profile-photo" alt="Foto Profil">
                    @else
                        <div class="no-photo">
                            <i class="fas fa-user"></i>
                            Tidak ada foto
                        </div>
                    @endif
                </div>

                <div class="profile-title">
                    <div class="hello">Data Diri Pegawai</div>
                    <h2>{{ $user->name }}</h2>
                    <div class="email-pill"><i class="fas fa-envelope"></i>{{ $user->email }}</div>
                </div>
            </div>

            <!-- Data Pribadi -->
            <h6 class="section-title">Informasi Pribadi</h6>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-user"></i></div>
                    <div class="info-text">
                        <div class="info-label">Nama</div>
                        <div class="info-value">{{ $user->name }}</div>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-envelope"></i></div>
                    <div class="info-text">
                        <div class="info-label">Email</div>
                        <div class="info-value">{{ $user->email }}</div>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div class="info-text">
                        <div class="info-label">Tempat Lahir</div>
                        <div class="info-value">{{ $user->birth_place }}</div>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-calendar-alt"></i></div>
                    <div class="info-text">
                        <div class="info-label">Tanggal Lahir</div>
                        <div class="info-value">{{ \Carbon\Carbon::parse($user->birth_date)->translatedFormat('d F Y') }}</div>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-phone"></i></div>
                    <div class="info-text">
                        <div class="info-label">Nomor Telepon</div>
                        <div class="info-value">{{ $user->nomor_telepon }}</div>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-praying-hands"></i></div>
                    <div class="info-text">
                        <div class="info-label">Agama</div>
                        <div class="info-value">{{ $user->religion }}</div>
                    </div>
                </div>

                <div class="info-item full">
                    <div class="info-icon"><i class="fas fa-home"></i></div>
                    <div class="info-text">
                        <div class="info-label">Alamat</div>
                        <div class="info-value">{{ $user->address }}</div>
                    </div>
                </div>
            </div>

            <!-- Dokumen -->
            <h6 class="section-title">Dokumen</h6>
            <div class="doc-grid">
                <div class="doc-item ktp">
                    <div class="doc-icon"><i class="fas fa-id-card"></i></div>
                    <h6 class="doc-name">KTP</h6>
                    <p class="doc-desc">Kartu Tanda Penduduk Anda.</p>
                    <a class="info-link" data-bs-toggle="modal" data-bs-target="#ktpModal"><i class="fas fa-paperclip"></i>Lihat KTP</a>
                </div>

                <div class="doc-item kk">
                    <div class="doc-icon"><i class="fas fa-users"></i></div>
                    <h6 class="doc-name">KK</h6>
                    <p class="doc-desc">Kartu Keluarga Anda.</p>
                    <a class="info-link" data-bs-toggle="modal" data-bs-target="#kkModal"><i class="fas fa-paperclip"></i>Lihat KK</a>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal KTP -->
<div class="modal fade" id="ktpModal" tabindex="-1" aria-labelledby="ktpModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content p-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                <h5 id="ktpModalLabel" class="mb-0">KTP</h5>
                <div class="modal-actions">
                    <a href="{{ asset('storage/uploads/ktp/' . $user->ktp) }}" class="btn btn-success btn-sm" download><i class="fas fa-download"></i>Download KTP</a>
                    <button type="button" class="modal-close" data-bs-dismiss="modal" aria-label="Tutup"><i class="fas fa-times"></i></button>
                </div>
            </div>
            @php $ktpExt = strtolower(pathinfo((string) $user->ktp, PATHINFO_EXTENSION)); @endphp
            @if($ktpExt === 'pdf')
                <iframe src="{{ asset('storage/uploads/ktp/' . $user->ktp) }}" class="modal-pdf" title="KTP"></iframe>
            @else
                <img src="{{ asset('storage/uploads/ktp/' . $user->ktp) }}" class="modal-img mt-2" alt="KTP">
            @endif
        </div>
    </div>
</div>


<!-- Modal KK -->
<div class="modal fade" id="kkModal" tabindex="-1" aria-labelledby="kkModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content p-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                <h5 id="kkModalLabel" class="mb-0">Kartu Keluarga (KK)</h5>
                <div class="modal-actions">
                    <a href="{{ asset('storage/uploads/kk/' . $user->kk) }}" class="btn btn-success btn-sm" download><i class="fas fa-download"></i>Download KK</a>
                    <button type="button" class="modal-close" data-bs-dismiss="modal" aria-label="Tutup"><i class="fas fa-times"></i></button>
                </div>
            </div>
            @php $kkExt = strtolower(pathinfo((string) $user->kk, PATHINFO_EXTENSION)); @endphp
            @if($kkExt === 'pdf')
                <iframe src="{{ asset('storage/uploads/kk/' . $user->kk) }}" class="modal-pdf" title="KK"></iframe>
            @else
                <img src="{{ asset('storage/uploads/kk/' . $user->kk) }}" class="modal-img mt-2" alt="KK">
            @endif
        </div>
    </div>
</div>



@endsection