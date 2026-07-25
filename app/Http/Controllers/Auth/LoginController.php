<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except(['logout']);
    }

    public function login()
    {
        return view('auth.login');
    }

    // LoginController.php
public function authenticate(Request $request)
{
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string|min:8',
    ]);

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        $user = Auth::user();
        Session::put($this->getUserSessionData($user));
        $user->update(['last_login' => Carbon::now()]);

        // Cek apakah admin atau user
        if ($user->email === 'admin@gmail.com') {
            return redirect()->route('admin.dashboard')->with('success', 'Selamat datang Admin!');
        }

        return redirect()->route('home')->with('success', 'Login berhasil!');
    }

    return redirect()->back()->with('error', 'Email atau password salah')->withInput();
}

    

    private function getUserSessionData($user)
    {
        return [
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'nomor_telepon' => $user->nomor_telepon,
            'birth_place' => $user->birth_place,
            'birth_date' => $user->birth_date,
            'address' => $user->address,
            'religion' => $user->religion,
            'ktp' => $user->ktp,
            'kk' => $user->kk,
            'photo' => $user->photo,
            'join_date' => $user->join_date,
        ];
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logout berhasil.');
    }
}