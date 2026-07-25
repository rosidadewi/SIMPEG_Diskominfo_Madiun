<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class DataDiriController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('profile.datadiri', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit_datadiri', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
    
        $request->validate([
            'name' => 'required|string',
            'birth_place' => 'nullable|string',
            'birth_date' => 'nullable|date',
            'address' => 'nullable|string',
            'nomor_telepon' => 'nullable|string',
            'religion' => 'nullable|string',
            'photo' => 'nullable|image',
            'ktp' => 'nullable|mimes:pdf,jpg,jpeg,png',
            'kk' => 'nullable|mimes:pdf,jpg,jpeg,png',
        ]);
    
        $user->update($request->except(['photo', 'ktp', 'kk']));
    
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($user->photo && Storage::disk('public')->exists('uploads/photo/' . $user->photo)) {
                Storage::disk('public')->delete('uploads/photo/' . $user->photo);
            }
            // Simpan foto baru
            $path = $request->file('photo')->store('uploads/photo', 'public');
            $user->photo = basename($path);
        }
    
        if ($request->hasFile('ktp')) {
            // Hapus KTP lama jika ada
            if ($user->ktp && Storage::disk('public')->exists('uploads/ktp/' . $user->ktp)) {
                Storage::disk('public')->delete('uploads/ktp/' . $user->ktp);
            }
            $path = $request->file('ktp')->store('uploads/ktp', 'public');
            $user->ktp = basename($path);
        }
    
        if ($request->hasFile('kk')) {
            // Hapus KK lama jika ada
            if ($user->kk && Storage::disk('public')->exists('uploads/kk/' . $user->kk)) {
                Storage::disk('public')->delete('uploads/kk/' . $user->kk);
            }
            $path = $request->file('kk')->store('uploads/kk', 'public');
            $user->kk = basename($path);
        }
    
        $user->save();
    
        return redirect()->route('datadiri')->with('success', 'Data berhasil diperbarui.');
    }
    

    public function downloadPDF()
    {
        $user = Auth::user();
        $pdf = Pdf::loadView('profile.pdf_datadiri', compact('user'));
        return $pdf->download('Data_Diri_' . $user->name . '.pdf');
    }
}
