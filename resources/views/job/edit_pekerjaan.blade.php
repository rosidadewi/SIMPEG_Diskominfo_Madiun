@extends('layouts.app')

@section('content')

<style>
    body {
        background: linear-gradient(to right, #e3f2fd, #64b5f6);
        font-family: 'Segoe UI', sans-serif;
        color: #333;
    }
    .small-container {
    width: 100%;
    max-width: 600px; /* Ukuran kecil */
    background-color: #ffffff;
    padding: 20px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    margin: 80px auto; /* Tengah */
    position: relative;
    z-index: 1;
}





    h4 {
        font-weight: 600;
        color: #0f172a;
        text-align: center;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .btn-back {
        position: absolute;
        top: -30px;
        left: 0;
        font-size: 40px;
        color: #607d8b;
        font-weight: bold;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .btn-back:hover {
        color: #0f172a;
    }

    .form-control {
        border-radius: 12px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 15px;
        padding: 8px 12px;
        font-size: 16px;
    }

    .form-control:focus {
        border-color: #1e3a8a;
        box-shadow: 0 0 10px rgba(30, 58, 138, 0.3);
    }

    .form-group label {
        font-size: 16px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }

    .form-control,
    .select-control {
        background-color: #f9fafb;
        padding: 8px 12px;
        font-size: 16px;
    }

    .select-control {
        height: 40px;
    }

    .btn-primary {
        background-color: #1e3a8a;
        border: none;
        color: #ffffff;
        font-weight: 600;
        border-radius: 10px;
        padding: 10px 25px;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #1e40af;
        transform: translateY(-2px);
    }

    .button-container {
        display: flex;
        justify-content: center;
        margin-top: 30px;
    }

    .btn-upload {
        background-color: #4caf50;
        border-radius: 10px;
        color: #fff;
        padding: 8px 20px;
        margin-top: 10px;
    }

    .btn-upload:hover {
        background-color: #388e3c;
    }

    .file-info {
        font-size: 12px;
        color: #374151;
        margin-top: 8px;
    }

    .alert {
        background-color: #f1f8e9;
        color: #388e3c;
        padding: 10px;
        border-radius: 10px;
        margin-top: 20px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .alert a {
        color: #388e3c;
        text-decoration: underline;
    }

    .form-control::placeholder {
        color: #9e9e9e;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        margin-bottom: 10px;
    }

    .form-group input,
    .form-group select {
        width: 100%;
    }

    /* Override margin and padding Bootstrap */
    .form-control, .select-control, .btn {
        margin: 0 !important; /* Menghilangkan margin ekstra */
        padding: 8px 12px !important; /* Menetapkan padding yang seragam */
    }
</style>

<div class="small-container">
    <div class="position-relative">
        <a href="{{ route('pekerjaan') }}" class="btn-back">&#8592;</a>
    </div>

    <h4>Edit Riwayat Pekerjaan</h4><br>

    <form action="{{ route('pekerjaan.update', $pekerjaan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="pangkat">Pangkat</label>
            <input type="text" id="pangkat" name="pangkat" class="form-control" value="{{ $pekerjaan->pangkat }}" required>
        </div>

        <div class="form-group">
            <label for="jabatan">Jabatan</label>
            <input type="text" id="jabatan" name="jabatan" class="form-control" value="{{ $pekerjaan->jabatan }}" required>
        </div>

        <div class="form-group">
            <label for="unit_kerja">Unit Kerja</label>
            <input type="text" id="unit_kerja" name="unit_kerja" class="form-control" value="{{ $pekerjaan->unit_kerja }}" required>
        </div>

        <div class="form-group">
            <label for="sub_bagian">Sub Bagian</label>
            <input type="text" id="sub_bagian" name="sub_bagian" class="form-control" value="{{ $pekerjaan->sub_bagian }}">
        </div>

        <div class="form-group">
            <label for="nip">NIP</label>
            <input type="text" id="nip" name="nip" class="form-control" value="{{ $pekerjaan->nip }}" required>
        </div>

        <div class="form-group">
            <label for="nomor_sk">Nomor SK</label>
            <input type="text" id="nomor_sk" name="nomor_sk" class="form-control" value="{{ $pekerjaan->nomor_sk }}" required>
        </div>

        <div class="form-group">
            <label for="tanggal_sk">Tanggal SK</label>
            <input type="date" id="tanggal_sk" name="tanggal_sk" class="form-control" value="{{ $pekerjaan->tanggal_sk }}" required>
        </div>

        <div class="form-group">
            <label for="tmt_sk">TMT SK</label>
            <input type="date" id="tmt_sk" name="tmt_sk" class="form-control" value="{{ $pekerjaan->tmt_sk }}" required>
        </div>

        <div class="form-group">
            <label for="mutasi">Mutasi</label>
            <select name="mutasi" id="mutasi" class="form-control select-control">
                <option value="">-- Pilih Mutasi --</option>
                <option value="Mutasi Jabatan" {{ $pekerjaan->mutasi == 'Mutasi Jabatan' ? 'selected' : '' }}>Mutasi Jabatan</option>
                <option value="Mutasi Tempat Tugas" {{ $pekerjaan->mutasi == 'Mutasi Tempat Tugas' ? 'selected' : '' }}>Mutasi Tempat Tugas</option>
                <option value="Mutasi Antar Instansi" {{ $pekerjaan->mutasi == 'Mutasi Antar Instansi' ? 'selected' : '' }}>Mutasi Antar Instansi</option>
                <option value="Mutasi Kenaikan Pangkat" {{ $pekerjaan->mutasi == 'Mutasi Kenaikan Pangkat' ? 'selected' : '' }}>Mutasi Kenaikan Pangkat</option>
                <option value="Mutasi Penyesuaian Organisasi" {{ $pekerjaan->mutasi == 'Mutasi Penyesuaian Organisasi' ? 'selected' : '' }}>Mutasi Penyesuaian Organisasi</option>
                <option value="Mutasi Sementara" {{ $pekerjaan->mutasi == 'Mutasi Sementara' ? 'selected' : '' }}>Mutasi Sementara</option>
                <option value="Tidak Mutasi" {{ $pekerjaan->mutasi == 'Tidak Mutasi' ? 'selected' : '' }}>Tidak Mutasi</option>
            </select>
        </div>

        <div class="form-group">
            <label for="file_sk">File SK (PDF)</label>
            @if($pekerjaan->file_sk)
                <p>
                    <a href="{{ asset('storage/' . $pekerjaan->file_sk) }}" target="_blank" class="btn btn-sm btn-info">Lihat File Lama</a>
                </p>
            @endif
            <input type="file" name="file_sk" id="file_sk" class="form-control">
        </div>

        <div class="button-container"> 
            <button type="submit" class="btn btn-primary">💾 Update</button>
        </div>
    </form>
</div>

@endsection
