@extends('layouts.minimal')

<style>
    body {
        background: linear-gradient(135deg, #e0eafc, #cfdef3);
        font-family: 'Poppins', sans-serif;
        font-size: 1rem;
        align-items: center;
        justify-content: center;
    }

    .container {
        max-width: 950px; 
        align-items:center;
        justify-content: center;
        display: flex;
        margin: 0 auto;
        flex-direction: column;
    }

    .section-card {
        background: rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(10px);
        border-radius: 2rem;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        margin-bottom: 2rem; /* Mengurangi jarak antar card */
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding-bottom: 1rem;
        max-width: 900px;
    }

    .section-header {
        font-size: 1.4rem; 
        font-weight: 700;
        padding: 1.2rem 2rem;
        border-radius: 3rem 3rem 0 0;
        background: linear-gradient(to right, #007bff, #00c6ff);
        color: white;
        max-width: 800px;
        text-transform: uppercase;
        position: relative;
        letter-spacing: 1px;
    }

    .section-header::before {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 20px;
        width: 60px;
        height: 3px;
        background-color: white;
        border-radius: 3px;
    }

    .profile-img {
        width: 120px; 
        height: 140px; 
        display: block;  
        margin: 0 auto; 
        object-fit: cover;  
        border-radius: 0%; 
        border: 4px solid #fff; 
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); 
    }

    .btn-outline-primary, .btn-outline-secondary, .btn-outline-info, .btn-outline-dark {
        border-radius: 25px;
        padding: 0.3rem 1rem; 
        font-size: 0.85rem; 
        transition: all 0.3s ease-in-out;
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: #fff;
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        color: #fff;
    }

    .btn-outline-info:hover {
        background-color: #17a2b8;
        color: #fff;
    }

    .btn-outline-dark:hover {
        background-color: #343a40;
        color: #fff;
    }

    .card-body {
        padding: 2rem; /* Menurunkan padding card */
    }

    .card-body .row {
        gap: 1rem; /* Menurunkan jarak antar kolom */
    }

    .table-responsive {
        margin-top: 1rem;
    }

    .custom-table th {
        width: 400px; /* Memperkecil lebar kolom */
        font-weight: 600;
        font-size: 1rem; /* Menurunkan ukuran font tabel */
        color: #343a40;
        vertical-align: top;
        padding-top: 1rem;
    }

    .custom-table td {
        font-size: 1rem; /* Menurunkan ukuran font tabel */
        padding-top: 1rem;
        color: #212529;
        width: 300px;
    }

    .custom-table tr + tr {
        border-top: 1px solid #dee2e6;
    }

    h4 {
        font-weight: 600;
        font-size: 1.4rem; /* Menurunkan ukuran font judul */
    }

    h5 {
        font-weight: 600;
        color: #007bff;
        font-size: 1.1rem; /* Menurunkan ukuran font subjudul */
    }

    .btn-back {
        background: transparent;
        border: 2px solid #007bff;
        color: #007bff;
        border-radius: 2rem;
        padding: 0.5rem 1rem;
        font-weight: 500;
        transition: all 0.3s ease-in-out;
    }

    .btn-back:hover {
        background-color: #007bff;
        color: white;
    }

    /* Jarak antar data setelah looping */
    .section-divider {
        margin-top: 0.5rem; /* Mengurangi jarak pemisah antar section */
        margin-bottom: 0.5rem;
        height: 1px;
        background-color:rgba(104, 103, 103, 1);
    }

    /* Tambahkan jarak antar data setiap kali looping */
    .table-responsive tbody tr {
        margin-bottom: 1rem; /* Menambahkan jarak antar data */
    }

    .table-responsive tbody tr:last-child {
        margin-bottom: 0; /* Tidak ada jarak pada baris terakhir */
    }
</style>


@section('content')
<div class="container py-5">


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
        <a href="{{ route('admin.dashboard') }}" style =" font-size: 20px;" class="btn btn-back">
            ⬅ Kembali
        </a>
    </div>

</div>

@include('layouts.footer')
@endsection
