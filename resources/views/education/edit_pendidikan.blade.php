@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #eef4f7;
    }

    .small-container {
        width: 100%;
        max-width: 900px;
        background-color: rgb(228, 225, 225);
        padding: 20px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        margin: 80px auto;
        position: relative;
        z-index: 1;
    }

    .form-section {
        background: linear-gradient(to right, #ffffff, #f1f9ff);
        padding: 40px;
        border-radius: 25px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        margin-bottom: 50px;
    }

    .form-section h2 {
        color: #0d6efd;
        font-weight: bold;
        margin-bottom: 35px;
        text-align: center;
    }

    .form-label {
        font-weight: 500;
        color: #444;
        margin-bottom: 6px;
    }

    .form-control {
        border-radius: 12px;
        padding: 12px 18px;
        border: 1px solid #ccc;
        background-color: #f2f2f2 !important; /* Tambahkan !important agar tidak diubah setelah load */
        color: #222;
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
        transition: 0.2s;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.2);
        background-color: #d6d6d6 !important; /* Background saat focus */
    }

    .btn-primary {
        padding: 12px 40px;
        font-weight: bold;
        border-radius: 12px;
        background-color: #0d6efd;
        border: none;
        transition: 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0b5ed7;
    }

    .mb-3 {
        margin-bottom: 25px !important;
    }

    .btn-back {
        position: absolute;
        top: -90px;
        left: 0;
        font-size: 60px;
        color: rgb(163, 169, 174);
        font-weight: bold;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .btn-back:hover {
        color: #495057;
    }
</style>

<div class="small-container mt-4">
    <div class="position-relative">
        <a href="{{ route('pendidikan') }}" class="btn-back">&#8592;</a>
    </div>

    <div class="form-section">
        <h2>Edit Data Pendidikan</h2>
        <form action="{{ route('pendidikan.update', $pendidikan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="jenjang" class="form-label">Jenjang Pendidikan</label>
                    <select id="jenjang" name="jenjang" class="form-control" required>
                        <option value="">-- Pilih Jenjang --</option>
                        <option value="SMA/SMK" {{ $pendidikan->jenjang == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                        <option value="S1" {{ $pendidikan->jenjang == 'S1' ? 'selected' : '' }}>S1</option>
                        <option value="S2" {{ $pendidikan->jenjang == 'S2' ? 'selected' : '' }}>S2</option>
                        <option value="S3" {{ $pendidikan->jenjang == 'S3' ? 'selected' : '' }}>S3</option>
                        <option value="Prof" {{ $pendidikan->jenjang == 'Prof' ? 'selected' : '' }}>Profesi</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="institusi" class="form-label">Nama Institusi</label>
                    <input type="text" id="institusi" name="institusi" class="form-control" value="{{ $pendidikan->institusi }}" required>
                </div>
            </div>

            <div id="extra-field-container" class="row mb-3" style="display: none;">
                <div class="col-md-4">
                    <label for="lulusan" class="form-label">Lulusan</label>
                    <select name="lulusan" id="lulusan" class="form-control">
                        <option value="Dalam Negeri" {{ $pendidikan->lulusan == 'Dalam Negeri' ? 'selected' : '' }}>Dalam Negeri</option>
                        <option value="Luar Negeri" {{ $pendidikan->lulusan == 'Luar Negeri' ? 'selected' : '' }}>Luar Negeri</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="gelar" class="form-label">Gelar Pendidikan</label>
                    <input type="text" id="gelar" name="gelar" class="form-control" value="{{ $pendidikan->gelar }}">
                </div>
                <div class="col-md-4">
                    <label for="bidang_ilmu" class="form-label">Bidang Ilmu</label>
                    <input type="text" id="bidang_ilmu" name="bidang_ilmu" class="form-control" value="{{ $pendidikan->bidang_ilmu }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="jurusan" class="form-label">Jurusan</label>
                    <input type="text" id="jurusan" name="jurusan" class="form-control" value="{{ $pendidikan->jurusan }}" required>
                </div>
                <div class="col-md-6">
                    <label for="alamat_institusi" class="form-label">Alamat Institusi</label>
                    <input type="text" id="alamat_institusi" name="alamat_institusi" class="form-control" value="{{ $pendidikan->alamat_institusi }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="no_ijazah" class="form-label">No Ijazah</label>
                    <input type="text" id="no_ijazah" name="no_ijazah" class="form-control" value="{{ $pendidikan->no_ijazah }}" required>
                </div>
                <div class="col-md-3">
                    <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                    <input type="date" id="tanggal_masuk" name="tanggal_masuk" class="form-control" value="{{ $pendidikan->tanggal_masuk }}" required>
                </div>
                <div class="col-md-3">
                    <label for="tanggal_lulus" class="form-label">Tanggal Lulus</label>
                    <input type="date" id="tanggal_lulus" name="tanggal_lulus" class="form-control" value="{{ $pendidikan->tanggal_lulus }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="ijazah" class="form-label">Upload Ijazah</label>
                    <input type="file" id="ijazah" name="ijazah" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="file_pendamping" class="form-label">Pendamping Ijazah</label>
                    <input type="file" id="file_pendamping" name="file_pendamping" class="form-control">
                </div>
                <div class="col-md-4">
                    <label for="transkrip" class="form-label">Transkrip Nilai</label>
                    <input type="file" id="transkrip" name="transkrip" class="form-control">
                </div>
            </div>

            <div class="text-center mt-5">
                <button type="submit" style="height: 40px; width: 100px;" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
    function handleJenjangFieldControl(jenjang) {
        const extraContainer = document.getElementById('extra-field-container');
        const lulusan = document.getElementById('lulusan');
        const gelar = document.getElementById('gelar');
        const bidang = document.getElementById('bidang_ilmu');

        if (['S1', 'S2', 'S3', 'Prof'].includes(jenjang)) {
            extraContainer.style.display = 'flex';
            lulusan.disabled = false;
            gelar.readOnly = false;
            bidang.readOnly = false;
        } else {
            extraContainer.style.display = 'none';
            lulusan.disabled = true;
            gelar.readOnly = true;
            bidang.readOnly = true;

            lulusan.value = '';
            gelar.value = '';
            bidang.value = '';
        }
    }

    document.getElementById('jenjang').addEventListener('change', function () {
        handleJenjangFieldControl(this.value);
    });

    document.addEventListener('DOMContentLoaded', function () {
        handleJenjangFieldControl(document.getElementById('jenjang').value);
    });
</script>
@endsection
