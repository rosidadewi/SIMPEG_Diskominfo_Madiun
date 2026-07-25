<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
{
    $user = auth()->user();

    // Pengecekan berdasarkan email admin
    if ($user->email === 'admin@gmail.com') {
        return redirect()->route('admin.dashboard'); // Arahkan admin ke dashboard admin
    }

    return view('dashboard.dashboard'); // Arahkan pengguna biasa ke dashboard biasa
}

}
