<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DataDiriController;
use App\Http\Controllers\PendidikanController;
use App\Http\Controllers\RiwayatPekerjaanController;

use App\Http\Controllers\AdminController;




// ----------- Public Routes -------------- //
Route::get('/', function () {
    return view('auth.login');
});


// --------- Authentication Routes ---------- //
Auth::routes();

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::get('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/register', [RegisterController::class, 'storeUser'])->name('register.post');
    Route::get('forget-password', [ForgotPasswordController::class, 'getEmail'])->name('forget-password.get');
    Route::post('forget-password', [ForgotPasswordController::class, 'postEmail'])->name('forget-password.post');
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'getPassword'])->name('reset-password.get');
    Route::post('reset-password', [ResetPasswordController::class, 'updatePassword'])->name('reset-password.post');

});


Route::get('/datadiri', function () {
    return view('profile.datadiri');
})->middleware(['auth'])->name('datadiri');


Route::middleware('auth')->group(function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

});




Route::middleware(['auth'])->group(function () {
    Route::get('/datadiri', [DataDiriController::class, 'index'])->name('datadiri');
    Route::get('/datadiri/edit', [DataDiriController::class, 'edit'])->name('datadiri.edit');
    Route::post('/datadiri/update', [DataDiriController::class, 'update'])->name('datadiri.update');
    Route::get('/datadiri/download', [DataDiriController::class, 'downloadPdf'])->name('datadiri.download');
});



// Route Pendidikan
Route::middleware(['auth'])->group(function () {
    // Tampilan utama riwayat pendidikan
    Route::get('/pendidikan', [PendidikanController::class, 'index'])->name('pendidikan');

    // Form tambah pendidikan
    Route::get('/pendidikan/tambah', [PendidikanController::class, 'create'])->name('pendidikan.create');
    Route::post('/pendidikan/store', [PendidikanController::class, 'store'])->name('pendidikan.store');

    // Form edit pendidikan
    Route::get('/pendidikan/{id}/edit', [PendidikanController::class, 'edit'])->name('pendidikan.edit');
    Route::put('/pendidikan/{id}/update', [PendidikanController::class, 'update'])->name('pendidikan.update');

    // Download PDF pendidikan
    Route::get('/pendidikan/download', [PendidikanController::class, 'downloadPdf'])->name('pendidikan.download');

    // Hapus data Pendidikan
    Route::delete('/pendidikan/{id}', [PendidikanController::class, 'destroy'])->name('pendidikan.destroy');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/pekerjaan', [RiwayatPekerjaanController::class, 'index'])->name('pekerjaan');
    Route::post('/pekerjaan/store', [RiwayatPekerjaanController::class, 'store'])->name('pekerjaan.store');
    Route::get('/pekerjaan/{id}/edit', [RiwayatPekerjaanController::class, 'edit'])->name('pekerjaan.edit');
    Route::put('/pekerjaan/{id}', [RiwayatPekerjaanController::class, 'update'])->name('pekerjaan.update');
    Route::delete('/pekerjaan/{id}', [RiwayatPekerjaanController::class, 'destroy'])->name('pekerjaan.destroy');
    Route::get('/pekerjaan/tambah', function () {
        return view('job.pekerjaan');
    })->middleware('auth')->name('pekerjaan.tambah');
    Route::get('/pekerjaan/preview/{id}', [RiwayatPekerjaanController::class, 'preview'])->name('pekerjaan.preview');
    
});


// ROUTING ADMIN 


Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/user/{id}', [AdminController::class, 'show'])->name('admin.user.show');
    Route::patch('/user/{id}/toggle', [AdminController::class, 'toggleStatus'])->name('admin.user.toggleStatus');
    Route::delete('/user/{id}', [AdminController::class, 'destroy'])->name('admin.user.destroy');

});
