<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'nomor_telepon' => 'required|string|max:15|regex:/^[0-9]+$/',
            'address' => 'required|string',
            'religion' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'kk' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            $ktpPath = $request->file('ktp')->store('uploads/ktp', 'public');
            $ktpName = basename($ktpPath); // hanya ambil nama filenya aja

            // dan begitu juga untuk KK dan Foto
            $kkPath = $request->file('kk')->store('uploads/kk', 'public');
            $kkName = basename($kkPath);

            $photoPath = $request->file('photo')->store('uploads/photo', 'public');
            $photoName = basename($photoPath);


            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'nomor_telepon' => $request->nomor_telepon,
                'birth_place' => $request->birth_place,
                'birth_date' => $request->birth_date,
                'address' => $request->address,
                'religion' => $request->religion,
                'ktp' => $ktpName,
                'kk' => $kkName,
                'photo' => $photoName,
                'join_date' => Carbon::now()->toDateString(),
            ]);

            return redirect()->route('login')->with('success', 'Akun berhasil dibuat!');
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('error', 'Gagal membuat akun. Silakan coba lagi.');
        }
    }
}