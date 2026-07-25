@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(to right, #eef2f3, #8e9eab);
        font-family: 'Segoe UI', sans-serif;
    }

    .container {
        max-width: 1100px;
        background-color: #ffffff;
        padding: 40px 30px;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        margin-top: 15px;
    }

    h3 {
        font-weight: bold;
        color: #2d3748;
        text-align: center;
        margin-bottom: 30px;
        font-size: 28px;
    }

    .btn {
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease-in-out;
    }

    .btn-success {
        background: #16a34a;
        border: none;
        color: #fff;
    }

    .btn-success:hover {
        background: #15803d;
    }

    .btn-danger {
        background: #dc2626;
        border: none;
        color: #fff;
    }

    .btn-danger:hover {
        background: #b91c1c;
    }

    .alert-success {
        font-weight: bold;
        border-radius: 10px;
    }

    .card-job {
        background: #ffffff;
        border-left: 6px solid #0ea5e9;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
        position: relative; 
        display: flex; 
        flex-direction: row;
    }

    .card-job:hover {
        transform: scale(1.02);
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 15px;
    }

    .data-table td {
        padding: 12px 15px;
        vertical-align: top;
    }

    .data-label {
        font-weight: 600;
        color: #1f2937;
        width: 200px;
        padding-right: 15px;
        text-align: left;
        border-right: 2px solid #ddd;
    }

    .data-value {
        color: #374151;
        text-align: left;
        word-wrap: break-word;
    }

    .data-actions {
        text-align: center;
        margin-top: 15px;
    }

    .d-flex.justify-content-between {
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 30px;
    }

    .icon {
        margin-right: 8px;
        color: #0f172a;
    }

    .data-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        align-items: center;
    }

    .data-row .data-label {
        flex-basis: 30%;
    }

    .data-row .data-value {
        flex-basis: 60%;
    }

    .action-btns a,
    .action-btns form button {
        margin-left: 10px;
    }

    .card-job-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-job-footer a {
        margin-left: 10px;
    }

   
    .user-photo {
        width: 160px; 
        height: 190px; 
        object-fit: cover;
        border: 3px solid #ddd;
        margin-left: 20px;
        margin-top: 20px;
    }

    /* Flexbox for aligning card content */
    .card-job-content {
        flex: 1;
        margin-right: 20px;
    }

    /* Content alignment inside card */
    .data-row {
        margin-bottom: 10px;
    }

    /* Positioning the buttons (Edit and Delete) */
    .action-btns {
        position: absolute;
        bottom: 15px;
        right: 15px;
        display: flex;
        gap: 10px;
    }

    .action-btns a,
    .action-btns form button {
        padding: 10px 15px;
        font-size: 14px;
    }

    /* Style Tombol Action */
    .action-btns a,
    .action-btns form button {
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<div class="container">
    <h3><i class="bi bi-briefcase-fill"></i> Riwayat Pekerjaan</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between">
        <a href="{{ route('pekerjaan.tambah') }}" class="btn btn-success">+ Tambah Riwayat</a>
    </div>

    @if($data->isEmpty())
        <div class="text-center p-4 text-muted">
            <p><i class="bi bi-info-circle"></i> Belum ada data riwayat pekerjaan.</p>
        </div>
    @else
        @foreach($data as $pekerjaan)
            <div class="card-job">
                <div class="card-job-content">
                    <div class="data-row">
                        <div class="data-label"><i class="bi bi-person-badge icon"></i>Pangkat</div>
                        <div class="data-value">{{ $pekerjaan->pangkat }}</div>
                    </div>
                    <div class="data-row">
                        <div class="data-label"><i class="bi bi-briefcase icon"></i>Jabatan</div>
                        <div class="data-value">{{ $pekerjaan->jabatan }}</div>
                    </div>
                    <div class="data-row">
                        <div class="data-label"><i class="bi bi-building icon"></i>Unit Kerja</div>
                        <div class="data-value">{{ $pekerjaan->unit_kerja }}</div>
                    </div>
                    <div class="data-row">
                        <div class="data-label"><i class="bi bi-diagram-3 icon"></i>Sub Bagian</div>
                        <div class="data-value">{{ $pekerjaan->sub_bagian ?? '-' }}</div>
                    </div>
                    <div class="data-row">
                        <div class="data-label"><i class="bi bi-card-text icon"></i>NIP</div>
                        <div class="data-value">{{ $pekerjaan->nip }}</div>
                    </div>
                    <div class="data-row">
                        <div class="data-label"><i class="bi bi-file-text icon"></i>Nomor SK</div>
                        <div class="data-value">{{ $pekerjaan->nomor_sk }}</div>
                    </div>
                    <div class="data-row">
                        <div class="data-label"><i class="bi bi-calendar-check icon"></i>Tanggal SK</div>
                        <div class="data-value">{{ \Carbon\Carbon::parse($pekerjaan->tanggal_sk)->translatedFormat('d F Y') }}</div>
                    </div>

                    <div class="data-row">
                        <div class="data-label"><i class="bi bi-calendar-event icon"></i>TMT SK</div>
                        <div class="data-value">{{ \Carbon\Carbon::parse($pekerjaan->tmt_sk)->translatedFormat('d F Y') }}</div>
                    </div>
                    <div class="data-row">
                        <div class="data-label"><i class="bi bi-arrow-left-right icon"></i>Mutasi</div>
                        <div class="data-value">{{ $pekerjaan->mutasi }}</div>
                    </div>
                    <div class="data-row">
                        <div class="data-label"><i class="bi bi-file-earmark-arrow-down icon"></i>File SK</div>
                        <div class="data-value">
                            @if($pekerjaan->file_sk)
                                <a href="{{ asset('storage/' . $pekerjaan->file_sk) }}" target="_blank" class="btn btn-sm btn-info">👁️ Preview</a>
                                <a href="{{ asset('storage/' . $pekerjaan->file_sk) }}" download class="btn btn-sm btn-secondary">⬇ Download</a>
                            @else
                                <span class="text-muted">Tidak ada file</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-column align-items-center ml-4">
                    @if($pekerjaan->user && $pekerjaan->user->photo)
                        <img src="{{ asset('storage/uploads/photo/' . $pekerjaan->user->photo) }}" alt="Foto Pengguna" class="user-photo">
                    @else
                        <img src="{{ asset('storage/default-photo.jpg') }}" alt="Foto Pengguna" class="user-photo">
                    @endif
                </div>

                <!-- Action Buttons (Edit and Delete) -->
                <div class="action-btns">
                    <a href="{{ route('pekerjaan.edit', $pekerjaan->id) }}" class="btn btn-sm btn-warning">✏️ Edit</a>
                    <form action="{{ route('pekerjaan.destroy', $pekerjaan->id) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin ingin menghapus data ini?')" class="btn btn-sm btn-danger">🗑️ Hapus</button>
                    </form>
                </div>
            </div>
        @endforeach
    @endif
</div>

@endsection
