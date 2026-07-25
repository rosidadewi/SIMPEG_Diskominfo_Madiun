@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(to right, #dfe9f3, #ffffff);
        font-family: 'Segoe UI', sans-serif;
    }

    .container {
        max-width: 1000px;
    }

    .header-bar {
        background: #f8fafc;
        padding: 15px 25px;
        border-radius: 15px;
        margin-bottom: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 3px 10px rgba(0,0,0,0.05);
    }

    .header-bar h4 {
        margin: 0;
        font-weight: bold;
        color: #2c3e50;
    }

    .card {
        border: none;
        border-radius: 20px;
        background: #ffffff;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.07);
        margin-bottom: 30px;
        position: relative;
    }

    .card-body {
        padding: 30px;
    }

    .info-item {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 16px;
        align-items: center;
        font-size: 16px;
    }

    .info-label {
        width: 180px;
        font-weight: 600;
        color: #1e293b;
    }

    .info-value {
        flex: 1;
        color: #334155;
        background: #f1f5f9;
        padding: 8px 15px;
        border-radius: 8px;
    }

    .info-link {
        color: #0d6efd;
        text-decoration: none;
        cursor: pointer;
    }

    .info-link:hover {
        text-decoration: underline;
    }

    .btn {
        border-radius: 10px;
        font-weight: 600;
        padding: 8px 20px;
    }

    .btn-warning {
        background: linear-gradient(to right, #f6d365, #fda085);
        border: none;
        color: #fff;
    }

    .btn-success {
        background: linear-gradient(to right, #96e6a1, #d4fc79);
        border: none;
        color: #333;
    }

    .btn-warning:hover,
    .btn-success:hover,
    .btn-danger:hover {
        opacity: 0.9;
    }

    .text-end .btn {
        padding: 10px 25px;
        font-size: 16px;
    }

    .file-link {
        text-decoration: underline;
        color: #0d6efd;
    }

    .button-group-bottom {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 25px;
    }
</style>

<div class="container mt-3">
    <div class="header-bar">
        <h4>📚 Riwayat Pendidikan Terakhir</h4>
        <a href="{{ route('pendidikan.create') }}" class="btn btn-success">+ Tambah Pendidikan</a>
    </div>

    @forelse($pendidikans as $data)
        <div class="card">
            <div class="card-body">
                <div class="info-item">
                    <div class="info-label">Jenjang</div>
                    <div class="info-value">{{ $data->jenjang ?? '-' }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">Institusi</div>
                    <div class="info-value">{{ $data->institusi ?? '-' }}</div>
                </div>

                @if(in_array($data->jenjang, ['S1', 'S2', 'S3', 'Prof']))
                    <div class="info-item">
                        <div class="info-label">Gelar</div>
                        <div class="info-value">{{ $data->gelar ?? '-' }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Bidang Ilmu</div>
                        <div class="info-value">{{ $data->bidang_ilmu ?? '-' }}</div>
                    </div>

                    <div class="info-item">
                        <div class="info-label">Lulusan</div>
                        <div class="info-value">{{ $data->lulusan ?? '-' }}</div>
                    </div>
                @endif

                <div class="info-item">
                    <div class="info-label">Jurusan</div>
                    <div class="info-value">{{ $data->jurusan ?? '-' }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">Alamat Institusi</div>
                    <div class="info-value">{{ $data->alamat_institusi ?? '-' }}</div>
                </div>

                <div class="info-item">
                    <div class="info-label">No Ijazah</div>
                    <div class="info-value">{{ $data->no_ijazah ?? '-' }}</div>
                </div>

                <div class="info-item">
                <div class="info-label">Tanggal Masuk</div>
                <div class="info-value">
                    {{ \Carbon\Carbon::parse($data->tanggal_masuk)->translatedFormat('d F Y') ?? '-' }}
                </div>
                </div>

                <div class="info-item">
                <div class="info-label">Tanggal Lulus</div>
                <div class="info-value">
                    {{ \Carbon\Carbon::parse($data->tanggal_lulus)->translatedFormat('d F Y') ?? '-' }}
                </div>
                </div>


                @if($data->ijazah)
                    <div class="info-item">
                        <div class="info-label">Ijazah</div>
                        <div class="info-value">
                            <a class="info-link" data-bs-toggle="modal" data-bs-target="#ijazahModal{{ $data->id }}">📎 Lihat Ijazah</a>
                        </div>
                    </div>
                @endif

                @if($data->file_pendamping)
                    <div class="info-item">
                        <div class="info-label">Pendamping Ijazah</div>
                        <div class="info-value">
                            <a class="info-link" data-bs-toggle="modal" data-bs-target="#pendampingModal{{ $data->id }}">📎 Lihat Pendamping</a>
                        </div>
                    </div>
                @endif

                @if($data->transkrip)
                    <div class="info-item">
                        <div class="info-label">Transkrip Nilai</div>
                        <div class="info-value">
                            <a class="info-link" data-bs-toggle="modal" data-bs-target="#transkripModal{{ $data->id }}">📎 Lihat Transkrip</a>
                        </div>
                    </div>
                @endif

                <!-- Tombol Edit & Hapus -->
                <div class="button-group-bottom">
                    <a href="{{ route('pendidikan.edit', $data->id) }}" class="btn btn-warning">✏️ Edit</a>

                    <form action="{{ route('pendidikan.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus data ini?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">🗑️ Hapus</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Ijazah -->
        <div class="modal fade" id="ijazahModal{{ $data->id }}" tabindex="-1" aria-labelledby="ijazahModalLabel{{ $data->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 id="ijazahModalLabel{{ $data->id }}" class="mb-0">Ijazah</h5>
                        <a href="{{ asset('storage/' . $data->ijazah) }}" class="btn btn-success btn-sm" download>⬇️ Download Ijazah</a>
                    </div>
                    <img src="{{ asset('storage/' . $data->ijazah) }}" class="modal-img mt-2" alt="Ijazah">
                </div>
            </div>
        </div>

        <!-- Modal Pendamping -->
        <div class="modal fade" id="pendampingModal{{ $data->id }}" tabindex="-1" aria-labelledby="pendampingModalLabel{{ $data->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 id="pendampingModalLabel{{ $data->id }}" class="mb-0">Pendamping Ijazah</h5>
                        <a href="{{ asset('storage/' . $data->file_pendamping) }}" class="btn btn-success btn-sm" download>⬇️ Download Pendamping</a>
                    </div>
                    <img src="{{ asset('storage/' . $data->file_pendamping) }}" class="modal-img mt-2" alt="Pendamping Ijazah">
                </div>
            </div>
        </div>

        <!-- Modal Transkrip -->
        <div class="modal fade" id="transkripModal{{ $data->id }}" tabindex="-1" aria-labelledby="transkripModalLabel{{ $data->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 id="transkripModalLabel{{ $data->id }}" class="mb-0">Transkrip Nilai</h5>
                        <a href="{{ asset('storage/' . $data->transkrip) }}" class="btn btn-success btn-sm" download>⬇️ Download Transkrip</a>
                    </div>
                    <img src="{{ asset('storage/' . $data->transkrip) }}" class="modal-img mt-2" alt="Transkrip">
                </div>
            </div>
        </div>

    @empty
        <div class="alert alert-info">Belum ada data pendidikan. Yuk, tambahkan dulu!</div>
    @endforelse

    <div class="button-group-bottom">
        <a href="{{ route('pendidikan.download') }}" class="btn btn-success">⬇️ Download PDF</a>
    </div>
</div>
@endsection
