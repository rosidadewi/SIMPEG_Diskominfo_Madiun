@extends('layouts.minimal')

@section('content')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

<style>
    /* =====================================================
       Halaman detail pegawai — selaras dengan dashboard
       (style ditaruh di dalam section agar dimuat SETELAH
        Bootstrap dan tidak kalah oleh aturan bawaannya)
       ===================================================== */
    html { background: #08142f; }

    body {
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        font-size: 1rem;
        min-height: 100vh;
        background:
            radial-gradient(58% 48% at 6% 2%, rgba(20, 184, 166, .30), transparent 62%),
            radial-gradient(55% 55% at 94% 6%, rgba(37, 99, 235, .55), transparent 64%),
            radial-gradient(52% 52% at 96% 100%, rgba(79, 70, 229, .5), transparent 62%),
            linear-gradient(160deg, #0b1f4b 0%, #0a1a3d 45%, #08142f 100%);
        background-attachment: fixed;
    }

    /* pola titik halus */
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

    /* lingkaran transparan melayang */
    body::after {
        content: "";
        position: fixed;
        inset: 0;
        z-index: -1;
        pointer-events: none;
        background:
            radial-gradient(circle at 3% 82%,  rgba(255, 255, 255, .05) 0 198px, rgba(255, 255, 255, .11) 199px, transparent 201px),
            radial-gradient(circle at 14% 19%, rgba(255, 255, 255, .06) 0 58px,  rgba(255, 255, 255, .12) 59px,  transparent 61px),
            radial-gradient(circle at 85% 97%, rgba(255, 255, 255, .06) 0 103px, rgba(255, 255, 255, .12) 104px, transparent 106px);
        animation: dpFloat 16s ease-in-out infinite;
    }

    /* ===== Kerangka halaman ===== */
    .container.detail-page {
        --ink: #0f172a;
        --muted: #64748b;
        --line: #e8eef6;
        max-width: 920px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        align-items: stretch;
        gap: 26px;
    }

    .detail-page .section-divider { display: none; }

    /* ===== Kartu ===== */
    .detail-page .section-card {
        position: relative;
        width: 100%;
        max-width: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        color: var(--ink);
        background: linear-gradient(180deg, #ffffff, #f8fbff);
        border: 1px solid rgba(255, 255, 255, .6);
        border-radius: 28px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, .2), 0 28px 50px -24px rgba(0, 0, 0, .65);
        -webkit-backdrop-filter: none;
        backdrop-filter: none;
        animation: dpIn .6s cubic-bezier(.2, .8, .2, 1) both;
    }

    .detail-page > :nth-child(2) { animation-delay: .08s; }
    .detail-page > :nth-child(4) { animation-delay: .16s; }
    .detail-page > :nth-child(6) { animation-delay: .24s; }
    .detail-page > :nth-child(7) { animation-delay: .32s; }

    /* ===== Kartu profil ===== */
    .detail-page > .section-card:first-child {
        padding: 1.5rem 1.5rem 1.75rem;
    }

    .detail-page > .section-card:first-child::before {
        content: "";
        position: absolute;
        inset: 0 0 auto 0;
        height: 118px;
        background:
            radial-gradient(circle at 12% 0%, rgba(255, 255, 255, .38), transparent 45%),
            radial-gradient(circle at 92% 100%, rgba(255, 255, 255, .26), transparent 50%),
            linear-gradient(135deg, #1e3a8a, #2563eb 55%, #0ea5e9);
    }

    .detail-page .profile-img {
        position: relative;
        z-index: 1;
        display: block;
        width: 132px;
        height: 156px;
        margin: 34px auto 18px;
        object-fit: cover;
        border: 4px solid #fff;
        border-radius: 22px;
        box-shadow: 0 0 0 1px rgba(15, 23, 42, .06), 0 20px 38px -14px rgba(15, 23, 42, .55);
    }

    .detail-page h4 {
        position: relative;
        margin: 0 0 10px;
        font-size: 1.6rem;
        font-weight: 800;
        letter-spacing: -.02em;
        color: var(--ink);
    }

    .detail-page > .section-card:first-child .text-muted {
        position: relative;
        display: inline-block;
        margin: 0 auto;
        padding: 6px 16px;
        font-size: .9rem;
        font-weight: 500;
        color: #475569 !important;
        background: #f1f5f9;
        border: 1px solid #e6edf6;
        border-radius: 999px;
        word-break: break-all;
    }

    /* ===== Judul bagian ===== */
    .detail-page .section-header {
        position: relative;
        display: flex;
        align-items: center;
        gap: 12px;
        max-width: none;
        padding: 20px 28px;
        overflow: hidden;
        font-size: 1.05rem;
        font-weight: 800;
        letter-spacing: .08em;
        text-transform: uppercase;
        color: #fff;
        border-radius: 0;
        background-image: linear-gradient(120deg, #1d4ed8, #2563eb 50%, #06b6d4);
    }

    .detail-page .section-header.bg-success {
        background-image: linear-gradient(120deg, #047857, #10b981 55%, #2dd4bf);
    }

    .detail-page .section-header.bg-warning {
        background-image: linear-gradient(120deg, #d97706, #f59e0b 55%, #fb923c);
    }

    .detail-page .section-header::before {
        content: "";
        position: absolute;
        right: -50px;
        top: -80px;
        left: auto;
        bottom: auto;
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255, 255, 255, .35), transparent 70%);
        pointer-events: none;
    }

    .detail-page .card-body {
        padding: 10px 28px 28px;
    }

    .detail-page .table-responsive { margin-top: 0; }

    /* ===== Tabel data ===== */
    .detail-page .custom-table {
        width: 100%;
        margin: 0;
    }

    .detail-page .custom-table th {
        width: 36%;
        padding: 16px 14px 16px 0;
        font-size: .76rem;
        font-weight: 700;
        letter-spacing: .07em;
        text-transform: uppercase;
        color: var(--muted);
        vertical-align: middle;
        border-bottom: 1px solid var(--line);
        background: transparent;
    }

    .detail-page .custom-table td {
        padding: 16px 0 16px 14px;
        font-size: .98rem;
        font-weight: 600;
        color: var(--ink);
        vertical-align: middle;
        word-break: break-word;
        border-bottom: 1px solid var(--line);
        background: transparent;
    }

    .detail-page .custom-table tr + tr { border-top: 0; }

    .detail-page .custom-table tbody tr:last-child th,
    .detail-page .custom-table tbody tr:last-child td { border-bottom: 0; }

    .detail-page .custom-table tbody tr:hover > th,
    .detail-page .custom-table tbody tr:hover > td { background: rgba(37, 99, 235, .04); }

    .detail-page .custom-table .text-muted {
        font-weight: 500;
        color: #94a3b8 !important;
    }

    /* pemisah antar-data pada riwayat yang berulang */
    .detail-page .custom-table td[colspan] {
        height: 26px;
        padding: 0 !important;
        border: 0;
        background: linear-gradient(90deg, transparent, #cfd9e8, transparent) center / 100% 1px no-repeat;
    }

    .detail-page .custom-table tbody:last-of-type td[colspan] {
        height: 0;
        background: none;
    }

    /* pesan data kosong */
    .detail-page .table-responsive > .text-muted {
        margin: 12px 0 0;
        padding: 24px 20px;
        text-align: center;
        font-weight: 500;
        color: #64748b !important;
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        border-radius: 16px;
    }

    /* ===== Tombol lihat berkas ===== */
    .detail-page .custom-table .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        width: auto !important;
        min-width: 108px;
        padding: 7px 16px;
        font-size: .82rem;
        font-weight: 700;
        line-height: 1.3;
        text-decoration: none;
        border: 1px solid transparent;
        border-radius: 999px;
        box-shadow: 0 1px 2px rgba(15, 23, 42, .05);
        transition: all .25s ease;
    }

    .detail-page .custom-table .btn::before {
        content: "";
        flex-shrink: 0;
        width: 14px;
        height: 14px;
        background: currentColor;
        -webkit-mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M15 3h6v6'/%3E%3Cpath d='M10 14 21 3'/%3E%3Cpath d='M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6'/%3E%3C/svg%3E") center / contain no-repeat;
        mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M15 3h6v6'/%3E%3Cpath d='M10 14 21 3'/%3E%3Cpath d='M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6'/%3E%3C/svg%3E") center / contain no-repeat;
    }

    .detail-page .custom-table .btn:hover { transform: translateY(-2px); }
    .detail-page .custom-table .btn:active { transform: scale(.97); }

    .detail-page .custom-table .btn-outline-primary { color: #1d4ed8; background: #eff6ff; border-color: #bfdbfe; }
    .detail-page .custom-table .btn-outline-primary:hover { color: #fff; background: linear-gradient(135deg, #2563eb, #4f46e5); border-color: transparent; box-shadow: 0 12px 22px -10px rgba(37, 99, 235, .85); }

    .detail-page .custom-table .btn-outline-secondary { color: #475569; background: #f1f5f9; border-color: #cbd5e1; }
    .detail-page .custom-table .btn-outline-secondary:hover { color: #fff; background: linear-gradient(135deg, #64748b, #475569); border-color: transparent; box-shadow: 0 12px 22px -10px rgba(71, 85, 105, .85); }

    .detail-page .custom-table .btn-outline-info { color: #0e7490; background: #ecfeff; border-color: #a5f3fc; }
    .detail-page .custom-table .btn-outline-info:hover { color: #fff; background: linear-gradient(135deg, #06b6d4, #0891b2); border-color: transparent; box-shadow: 0 12px 22px -10px rgba(8, 145, 178, .85); }

    .detail-page .custom-table .btn-outline-dark { color: #1e293b; background: #f1f5f9; border-color: #cbd5e1; }
    .detail-page .custom-table .btn-outline-dark:hover { color: #fff; background: linear-gradient(135deg, #334155, #0f172a); border-color: transparent; box-shadow: 0 12px 22px -10px rgba(15, 23, 42, .85); }

    /* ===== Tombol kembali ===== */
    .detail-page .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 8px 26px 8px 8px;
        font-size: 1.02rem;
        font-weight: 700;
        color: #fff;
        background:
            linear-gradient(rgba(14, 26, 66, .85), rgba(14, 26, 66, .85)) padding-box,
            linear-gradient(110deg, #3b82f6, #38bdf8 55%, #2dd4bf) border-box;
        border: 1.5px solid transparent;
        border-radius: 999px;
        -webkit-backdrop-filter: blur(10px);
        backdrop-filter: blur(10px);
        box-shadow: 0 12px 28px -12px rgba(56, 189, 248, .55);
        transition: transform .25s ease, box-shadow .25s ease, background .25s ease;
    }

    .detail-page .btn-back .chip {
        display: grid;
        place-items: center;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: linear-gradient(135deg, #2563eb, #06b6d4);
        box-shadow: 0 6px 14px -6px rgba(6, 182, 212, .9);
    }

    .detail-page .btn-back .chip svg {
        width: 18px;
        height: 18px;
        transition: transform .25s ease;
    }

    .detail-page .btn-back:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 16px 34px -12px rgba(56, 189, 248, .8);
        background:
            linear-gradient(rgba(22, 40, 96, .9), rgba(22, 40, 96, .9)) padding-box,
            linear-gradient(110deg, #3b82f6, #38bdf8 55%, #2dd4bf) border-box;
    }

    .detail-page .btn-back:hover .chip svg { transform: translateX(-3px); }
    .detail-page .btn-back:active { transform: translateY(0) scale(.98); }

    .detail-page .btn-back:focus-visible {
        outline: 3px solid rgba(125, 211, 252, .55);
        outline-offset: 3px;
    }

    .detail-page .btn:focus-visible {
        outline: 3px solid rgba(125, 211, 252, .55);
        outline-offset: 2px;
    }

    @keyframes dpIn {
        from { opacity: 0; transform: translateY(22px) scale(.98); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    @keyframes dpFloat {
        0%, 100% { transform: translate(0, 0); }
        50%      { transform: translate(-10px, 12px); }
    }

    /* ===== Responsif ===== */
    @media (max-width: 767.98px) {
        .container.detail-page { gap: 20px; }
        .detail-page .section-card { border-radius: 24px; }
        .detail-page .section-header { padding: 18px 22px; font-size: .98rem; }
        .detail-page .card-body { padding: 8px 22px 24px; }
    }

    @media (max-width: 575.98px) {
        .detail-page .section-header { padding: 16px 18px; font-size: .9rem; letter-spacing: .06em; }
        .detail-page .card-body { padding: 6px 18px 22px; }

        .detail-page h4 { font-size: 1.35rem; }

        /* tabel menjadi daftar bertumpuk agar tidak sempit di HP */
        .detail-page .custom-table,
        .detail-page .custom-table tbody,
        .detail-page .custom-table tr,
        .detail-page .custom-table th,
        .detail-page .custom-table td {
            display: block;
            width: 100% !important;
        }

        .detail-page .custom-table th {
            padding: 14px 0 2px;
            border-bottom: 0;
        }

        .detail-page .custom-table td {
            padding: 0 0 14px;
        }

        .detail-page .custom-table tbody tr:last-child td { border-bottom: 0; padding-bottom: 6px; }
        .detail-page .custom-table td[colspan] { height: 22px; padding: 0 !important; }
        .detail-page .custom-table tbody tr:hover > th,
        .detail-page .custom-table tbody tr:hover > td { background: transparent; }

        .detail-page .btn-back { width: 100%; justify-content: center; }
    }

    @media (prefers-reduced-motion: reduce) {
        *, *::before, *::after {
            animation: none !important;
            transition: none !important;
        }
    }
</style>

<div class="container py-5 detail-page">


    {{-- Profil User --}}
    <div class="card section-card text-center p-4">
        <img src="{{ $user->photo ? asset('storage/uploads/photo/' . $user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
            alt="{{ $user->name }}" class="profile-img mb-3">
        <h4>{{ $user->name }}</h4>
        <p class="text-muted">{{ $user->email }}</p>
    </div>

    {{-- Data Diri --}}
    <div class="card section-card">
        <div class="section-header">📌 Data Diri</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless custom-table">
                    <tbody>
                        <tr>
                            <th>Tempat Lahir</th>
                            <td>{{ $user->birth_place ?? '-' }}</td>
                        </tr>
                        <tr>
                        <th>Tanggal Lahir</th>
                        <td>{{ \Carbon\Carbon::parse($user->birth_date)->translatedFormat('d F Y') ?? '-' }}</td>
                        </tr>

                        <tr>
                            <th>Alamat</th>
                            <td>{{ $user->address ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>No Telepon</th>
                            <td>{{ $user->nomor_telepon ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Agama</th>
                            <td>{{ $user->religion ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>KTP</th>
                            <td>
                                @if($user->ktp)
                                    <a href="{{ asset('storage/uploads/ktp/' . $user->ktp) }}" style="width: 100px;" target="_blank" class="btn btn-sm btn-outline-primary">Lihat KTP</a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>KK</th>
                            <td>
                                @if($user->kk)
                                    <a href="{{ asset('storage/uploads/kk/' . $user->kk) }}" style="width: 100px;" target="_blank" class="btn btn-sm btn-outline-primary">Lihat KK</a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Pemisah --}}
    <div class="section-divider"></div>

    {{-- Riwayat Pendidikan --}}
    <div class="card section-card">
        <div class="section-header bg-success text-white">🎓 Riwayat Pendidikan Terakhir</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless custom-table">
                    @forelse($user->pendidikan as $edu)
                        <tbody>
                            <tr>
                                <th>Jenjang</th>
                                <td>{{ $edu->jenjang ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Institusi</th>
                                <td>{{ $edu->institusi ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Gelar</th>
                                <td>{{ $edu->gelar ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Jurusan</th>
                                <td>{{ $edu->jurusan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Periode</th>
                                <td>
                                    {{ \Carbon\Carbon::parse($edu->tanggal_masuk)->translatedFormat('d F Y') ?? '-' }}
                                    s/d 
                                    {{ \Carbon\Carbon::parse($edu->tanggal_lulus)->translatedFormat('d F Y') ?? '-' }}
                                </td>

                            </tr>
                            <tr>
                                <th>Ijazah</th>
                                <td>
                                    @if($edu->ijazah)
                                        <a href="{{ asset('storage/' . $edu->ijazah) }}" style="width: 100px;" target="_blank" class="btn btn-sm btn-outline-primary">Ijazah</a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Transkrip</th>
                                <td>
                                    @if($edu->transkrip)
                                        <a href="{{ asset('storage/' . $edu->transkrip) }}" style="width: 100px;" target="_blank" class="btn btn-sm btn-outline-secondary">Transkrip</a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Pendamping</th>
                                <td>
                                    @if($edu->file_pendamping)
                                        <a href="{{ asset('storage/' . $edu->file_pendamping) }}" style="width: 100px;" target="_blank" class="btn btn-sm btn-outline-info">Pendamping</a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                        <tr>
                            <td colspan="2" class="text-center pt-4 pb-4"></td>
                        </tr>
                    @empty
                        <p class="text-muted">Belum ada data pendidikan.</p>
                    @endforelse
                </table>
            </div>
        </div>
    </div>

    {{-- Pemisah --}}
    <div class="section-divider"></div>

    {{-- Riwayat Pekerjaan --}}
    <div class="card section-card">
        <div class="section-header bg-warning text-white">💼 Riwayat Pekerjaan</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless custom-table">
                    @forelse($user->riwayatpekerjaan as $job)
                        <tbody>
                            <tr>
                                <th>NIP</th>
                                <td>{{ $job->nip ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Pangkat</th>
                                <td>{{ $job->pangkat ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Jabatan</th>
                                <td>{{ $job->jabatan ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Unit Kerja</th>
                                <td>{{ $job->unit_kerja ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Sub Bagian</th>
                                <td>{{ $job->sub_bagian ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Nomor SK</th>
                                <td>{{ $job->nomor_sk ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal SK</th>
                                <td>{{ \Carbon\Carbon::parse($job->tanggal_sk)->translatedFormat('d F Y') ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>TMT SK</th>
                                <td>{{ \Carbon\Carbon::parse($job->tmt_sk)->translatedFormat('d F Y') ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Mutasi</th>
                                <td>{{ $job->mutasi ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>File SK</th>
                                <td>
                                    @if($job->file_sk)
                                        <a href="{{ asset('storage/' . $job->file_sk) }}" style="width: 100px;" target="_blank" class="btn btn-sm btn-outline-dark">Lihat SK</a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                        <tr>
                            <td colspan="2" class="text-center pt-4 pb-4"></td>
                        </tr>
                    @empty
                        <p class="text-muted">Belum ada data pekerjaan.</p>
                    @endforelse
                </table>
            </div>
        </div>

    </div>

    {{-- Tombol Back --}}
    <div class="d-flex justify-content-start w-100 mt-3">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-back">
            <span class="chip">
                <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 12H5"/><path d="m12 19-7-7 7-7"/>
                </svg>
            </span>
            Kembali
        </a>
    </div>

</div>

@endsection