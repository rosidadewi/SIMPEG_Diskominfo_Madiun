<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use App\Models\Pendidikan;
use App\Models\RiwayatPekerjaan;
use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // Filter nama jika ada pencarian
        $query = User::query()->where('email', '!=', 'admin@gmail.com');

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $users = $query->get();

        return view('admin.dashboard', compact('users'));
    }



public function show($id)
{
    $user = User::with(['pendidikan', 'riwayatpekerjaan'])->findOrFail($id);

    // Format tanggal lahir (misalnya) dengan Carbon
    $user->birth_date = Carbon::parse($user->birth_date)->format('d F Y');
    
    foreach ($user->pendidikan as $pendidikan) {
        $pendidikan->tanggal_masuk = Carbon::parse($pendidikan->tanggal_masuk)->format('d F Y');
    }

    foreach ($user->pendidikan as $pendidikan) {
        $pendidikan->tanggal_lulus = Carbon::parse($pendidikan->tanggal_lulus)->format('d F Y');
    }

    foreach ($user->riwayatpekerjaan as $pekerjaan) {
        $pekerjaan->tanggal_sk = Carbon::parse($pekerjaan->tanggal_sk)->format('d F Y');
    }

    foreach ($user->riwayatpekerjaan as $pekerjaan) {
        $pekerjaan->tmt_sk = Carbon::parse($pekerjaan->tmt_sk)->format('d F Y');
    }

    return view('admin.user_detail', compact('user'));
}

    

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->is_active = !$user->is_active; // Toggle status aktif/tidak aktif
        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'Status user berhasil diperbarui.');
    }

 

public function destroy($id)
{
    $user = User::findOrFail($id);

    // Hapus file KTP, KK, Foto
    foreach (['ktp', 'kk', 'photo'] as $fileField) {
        if ($user->$fileField && Storage::exists('public/' . $user->$fileField)) {
            Storage::delete('public/' . $user->$fileField);
        }
    }

    // Hapus pendidikan dan file pendukung
    foreach ($user->pendidikan as $pendidikan) {
        foreach (['ijazah', 'file_pendamping', 'transkrip'] as $doc) {
            if ($pendidikan->$doc && Storage::exists('public/' . $pendidikan->$doc)) {
                Storage::delete('public/' . $pendidikan->$doc);
            }
        }
        $pendidikan->delete();
    }

    // Hapus riwayat pekerjaan dan file SK
    foreach ($user->riwayatpekerjaan as $pekerjaan) {
        if ($pekerjaan->file_sk && Storage::exists('public/' . $pekerjaan->file_sk)) {
            Storage::delete('public/' . $pekerjaan->file_sk);
        }
        $pekerjaan->delete();
    }

    // Hapus user
    $user->delete();

    return redirect()->route('admin.dashboard')->with('success', 'Akun user dan semua datanya berhasil dihapus.');
}

}
