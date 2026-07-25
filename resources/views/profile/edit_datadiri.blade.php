@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(to right, #dbeafe, #e0f2fe);
        font-family: 'Poppins', sans-serif;
        color: #2f3542;
    }

    .edit-container {
        max-width: 880px;
        margin: 0 auto;
        background: #ffffff;
        padding: 35px;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease-in-out;
        animation: fadeIn 0.6s ease-in-out;
    }

    h4 {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1e272e;
        border-bottom: 2px solid #dcdde1;
        padding-bottom: 10px;
        margin-bottom: 30px;
    }

    label {
        font-weight: 600;
        font-size: 0.95rem;
        color: #34495e;
    }

    .form-control {
        border-radius: 10px;
        padding: 12px 18px;
        border: 1px solid #cfd8dc;
        background-color: #f1f5f9;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        background-color: #e0f2fe;
        border-color: #3b82f6;
        box-shadow: 0 0 10px rgba(59, 130, 246, 0.2);
    }

    .btn-primary {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        border: none;
        padding: 12px 30px;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 12px;
        color: #fff;
        box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        transition: all 0.3s ease-in-out;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
    }

    .btn-back {
        position: absolute;
        top: -65px;
        left: 0;
        font-size: 50px;
        color: #7e8c99;
        font-weight: bold;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .btn-back:hover {
        color: #495057;
    }

    .button-container {
        margin-top: 40px;
        text-align: center;
    }

    .row.mb-3 {
    justify-content: center;
    }


    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(20px);}
        to {opacity: 1; transform: translateY(0);}
    }
</style>



<div class="container mt-5">
    <div class="position-relative">
        <!-- Menggunakan simbol panah kembali -->
        <a href="{{ route('datadiri') }}" class="btn-back">&#8592;</a>
    </div>
    
    <div class="edit-container mt-5">
        <h4>Edit Data Diri</h4>

        <form action="{{ route('datadiri.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-6">
                    <input name="name" class="form-control" value="{{ $user->name }}">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Tempat Lahir</label>
                <div class="col-sm-6">
                    <input name="birth_place" class="form-control" value="{{ $user->birth_place }}">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-sm-6">
                <input type="date" name="birth_date" class="form-control" value="{{ $user->birth_date ? \Carbon\Carbon::parse($user->birth_date)->format('Y-m-d') : '' }}">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-6">
                    <textarea name="address" class="form-control">{{ $user->address }}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Nomor Telepon</label>
                <div class="col-sm-6">
                    <input name="nomor_telepon" class="form-control" value="{{ $user->nomor_telepon }}">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">Agama</label>
                <div class="col-sm-6">
                    <input name="religion" class="form-control" value="{{ $user->religion }}">
                </div>
            </div>

            <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Foto (Opsional)</label>
            <div class="col-sm-6">
                <input type="file" name="photo" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">KTP (Opsional)</label>
            <div class="col-sm-6">
                <input type="file" name="ktp" class="form-control">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">KK (Opsional)</label>
            <div class="col-sm-6">
                <input type="file" name="kk" class="form-control">
            </div>
        </div>

            <div class="button-container">
                <button type="submit" class="btn btn-primary">💾 Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
