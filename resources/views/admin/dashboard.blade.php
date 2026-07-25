@extends('layouts.minimal')

@section('content')

<style>

    body {
        background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
        min-height: 100vh;
        background-attachment: fixed;
    }

    .container {
        background: rgba(241, 240, 240, 0.9);
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .btn {
        transition: all 0.3s ease-in-out;
    }

    .btn:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

    .user-card .card {
        padding: 10px;
        border-radius: 16px;
    }

    .user-card .card-body {
        padding: 1rem;
    }

    .user-card .card-title {
        font-size: 1rem;
    }

    .user-card img {
        width: 67px;
        height: 70px;
    }

    .status-btn {
        transition: all 0.2s ease-in-out;
    }
</style>

<div class="container mt-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">📋 Dashboard Admin</h2>
        <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button style="width: 140px;" type="submit" class="btn btn-danger">🚪 Logout</button>
            </form>
    </div>

    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="🔍 Cari nama pegawai...">
    </div>

    <div class="row" id="userCards">
        @foreach($users as $user)
        <div class="col-md-3 mb-4 user-card">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <img src="{{ $user->photo ? asset('storage/uploads/photo/' . $user->photo) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                         alt="{{ $user->name }}" class="rounded-circle mb-2">

                    <h5 class="card-title">{{ $user->name }}</h5>
                    <p class="text-muted" style="font-size: 0.85rem">{{ $user->email }}</p>

                    <!-- Tombol status tampilan -->
                    <button class="btn btn-sm w-100 mt-2 status-btn {{ $user->is_active ? 'btn-success' : 'btn-secondary' }}" 
                            data-status="{{ $user->is_active }}" 
                            id="status-btn-{{ $user->id }}">
                        {{ $user->is_active ? 'Aktif ✅' : 'Tidak Aktif ❌' }}
                    </button>

                    <!-- Lihat Detail -->
                    <a href="{{ route('admin.user.show', $user->id) }}" class="btn btn-primary btn-sm w-100 mt-2">
                        Lihat Detail
                    </a>

                    <!-- Hapus User -->
                    <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" class="w-100 mt-2" onsubmit="return confirm('Yakin ingin menghapus user ini beserta semua datanya?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm w-100">🗑️ Hapus Akun</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    // Search user
    document.getElementById('searchInput').addEventListener('keyup', function () {
        const keyword = this.value.toLowerCase();
        const userCards = document.querySelectorAll('.user-card');

        userCards.forEach(card => {
            const name = card.querySelector('.card-title').textContent.toLowerCase();
            card.style.display = name.includes(keyword) ? 'block' : 'none';
        });
    });

    // Toggle tampilan tombol aktif/tidak aktif tanpa simpan ke DB
    document.querySelectorAll('.status-btn').forEach(button => {
        const userId = button.id.split('-')[2]; // Ambil ID user dari id tombol
        const storedStatus = localStorage.getItem('status-' + userId); // Ambil status dari localStorage
        
        if (storedStatus) {
            // Jika ada status di localStorage, set status tombol sesuai dengan nilai itu
            button.setAttribute('data-status', storedStatus);
            if (storedStatus === '1') {
                button.classList.add('btn-success');
                button.classList.remove('btn-secondary');
                button.textContent = 'Aktif ✅';
            } else {
                button.classList.add('btn-secondary');
                button.classList.remove('btn-success');
                button.textContent = 'Tidak Aktif ❌';
            }
        }

        button.addEventListener('click', function () {
            let currentStatus = this.getAttribute('data-status') === '1';
            
            if (currentStatus) {
                this.classList.remove('btn-success');
                this.classList.add('btn-secondary');
                this.textContent = 'Tidak Aktif ❌';
                this.setAttribute('data-status', '0');
                localStorage.setItem('status-' + userId, '0'); // Simpan status ke localStorage
            } else {
                this.classList.remove('btn-secondary');
                this.classList.add('btn-success');
                this.textContent = 'Aktif ✅';
                this.setAttribute('data-status', '1');
                localStorage.setItem('status-' + userId, '1'); // Simpan status ke localStorage
            }
        });
    });
</script>

@endsection
