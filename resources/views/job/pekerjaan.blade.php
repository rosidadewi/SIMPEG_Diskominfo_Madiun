@extends('layouts.app')

@section('content')
<style>
    body {
        background:rgb(143, 187, 237);
        font-family: 'Segoe UI', sans-serif;
    }

    .edit-container {
        background: #fff;
        max-width: 800px;
        margin: auto;
        padding: 25px 30px;
        border-radius: 20px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        animation: fadeIn 0.5s ease-in-out;
    }

    h4 {
        font-weight: 700;
        color: #1e3a5f;
        margin-bottom: 25px;
        text-align: center;
    }

    .form-control {
        background-color: #f0f4f8;
        border-radius: 12px;
        padding: 8px 14px;
        border: 1px solid #cbd5e0;
        transition: all 0.3s ease;
        font-size: 14px;
    }

    .form-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 8px rgba(52, 152, 219, 0.3);
    }

    label {
        font-weight: 600;
        color: #2d3436;
        margin-bottom: 5px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #3498db, #2e86c1);
        border: none;
        padding: 10px 25px;
        font-weight: bold;
        border-radius: 10px;
        transition: all 0.3s ease-in-out;
        font-size: 14px;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #2e86c1, #21618c);
    }

    .btn-back {
        position: absolute;
        top: -60px;
        left: 0;
        font-size: 60px;
        color:rgb(116, 126, 127);
        font-weight: bold;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .btn-back:hover {
        color: #2c3e50;
    }

    .text-danger {
        font-size: 0.85rem;
        color: #e74c3c;
        margin-top: 4px;
    }

    .row.mb-3 {
        margin-bottom: 1.2rem;
    }

    .button-container {
        text-align: center;
        margin-top: 40px;
    }

    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 140 140' width='10' height='10' xmlns='http://www.w3.org/2000/svg'%3E%3Cpolyline points='20,50 70,100 120,50' stroke='%23667' stroke-width='15' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 12px;
        padding-right: 30px;
    }

    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(15px);}
        to {opacity: 1; transform: translateY(0);}
    }
</style>


<div class="container mt-5">
    <div class="position-relative">
        <a href="{{ route('pekerjaan') }}" class="btn-back">&#8592;</a>
    </div>

    <div class="edit-container mt-5">
        <h4>Tambah Riwayat Pekerjaan</h4>

        <form action="{{ route('pekerjaan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Pangkat</label>
                <div class="col-sm-10">
                    <input type="text" name="pangkat" class="form-control" value="{{ old('pangkat') }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Jabatan</label>
                <div class="col-sm-10">
                    <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan') }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Unit Kerja</label>
                <div class="col-sm-10">
                    <input type="text" name="unit_kerja" class="form-control" value="{{ old('unit_kerja') }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Sub Bagian</label>
                <div class="col-sm-10">
                    <input type="text" name="sub_bagian" class="form-control" value="{{ old('sub_bagian') }}">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">NIP</label>
                <div class="col-sm-10">
                    <input type="text" name="nip" class="form-control" value="{{ old('nip') }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nomor SK</label>
                <div class="col-sm-10">
                    <input type="text" name="nomor_sk" class="form-control" value="{{ old('nomor_sk') }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Tanggal SK</label>
                <div class="col-sm-10">
                    <input type="date" name="tanggal_sk" class="form-control" value="{{ old('tanggal_sk') }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">TMT SK</label>
                <div class="col-sm-10">
                    <input type="date" name="tmt_sk" class="form-control" value="{{ old('tmt_sk') }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Mutasi</label>
                <div class="col-sm-10">
                    <select name="mutasi" class="form-control">
                        <option value="" disabled selected>Pilih Mutasi</option>
                        <option value="Mutasi Jabatan" {{ old('mutasi') == 'Mutasi Jabatan' ? 'selected' : '' }}>Mutasi Jabatan</option>
                        <option value="Mutasi Tempat Tugas" {{ old('mutasi') == 'Mutasi Tempat Tugas' ? 'selected' : '' }}>Mutasi Tempat Tugas</option>
                        <option value="Mutasi Antar Instansi" {{ old('mutasi') == 'Mutasi Antar Instansi' ? 'selected' : '' }}>Mutasi Antar Instansi</option>
                        <option value="Mutasi Kenaikan Pangkat" {{ old('mutasi') == 'Mutasi Kenaikan Pangkat' ? 'selected' : '' }}>Mutasi Kenaikan Pangkat</option>
                        <option value="Mutasi Penyesuaian Organisasi" {{ old('mutasi') == 'Mutasi Penyesuaian Organisasi' ? 'selected' : '' }}>Mutasi Penyesuaian Organisasi</option>
                        <option value="Mutasi Sementara" {{ old('mutasi') == 'Mutasi Sementara' ? 'selected' : '' }}>Mutasi Sementara</option>
                        <option value="Tidak Mutasi" {{ old('mutasi') == 'Tidak Mutasi' ? 'selected' : '' }}>Tidak Mutasi</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label>File SK (PDF)</label>
                <input type="file" name="file_sk" class="form-control">
                @if ($errors->has('file_sk'))
                    <div class="text-danger">{{ $errors->first('file_sk') }}</div>
                @endif
            </div>

            <div class="button-container">
                <button type="submit" class="btn btn-primary">💾 Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
