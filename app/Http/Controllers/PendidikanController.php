<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendidikan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class PendidikanController extends Controller
{
    // Tampilkan semua riwayat pendidikan
    public function index()
    {
        $pendidikans = Pendidikan::where('user_id', Auth::id())->get();
        return view('education.riwayat_pendidikan', compact('pendidikans'));
    }

    // Tampilkan form tambah pendidikan
    public function create()
    {
        return view('education.pendidikan');
    }

    // Simpan data pendidikan baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenjang' => 'required',
            'institusi' => 'required',
            'lulusan' => 'nullable|string',
            'gelar' => 'nullable|string',
            'bidang_ilmu' => 'nullable|string',
            'jurusan' => 'required',
            'alamat_institusi' => 'required',
            'no_ijazah' => 'required',
            'tanggal_masuk' => 'required|date',
            'tanggal_lulus' => 'required|date',
            'ijazah' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'file_pendamping' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'transkrip' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        ]);
        

        $ijazahPath = $request->hasFile('ijazah') ? $request->file('ijazah')->store('uploads/ijazah', 'public') : null;
        $pendampingPath = $request->hasFile('file_pendamping') ? $request->file('file_pendamping')->store('uploads/pendamping', 'public') : null;
        $transkripPath = $request->hasFile('transkrip') ? $request->file('transkrip')->store('uploads/transkrip', 'public') : null;

        $user = Auth::user();

        $user->pendidikan()->create([
            'jenjang' => $validated['jenjang'],
            'institusi' => $validated['institusi'],
            'lulusan' => $validated['lulusan'],
            'gelar' => $validated['gelar'],
            'bidang_ilmu' => $validated['bidang_ilmu'],
            'jurusan' => $validated['jurusan'],
            'alamat_institusi' => $validated['alamat_institusi'],
            'no_ijazah' => $validated['no_ijazah'],
            'tanggal_masuk' => $validated['tanggal_masuk'],
            'tanggal_lulus' => $validated['tanggal_lulus'],
            'ijazah' => $ijazahPath,
            'file_pendamping' => $pendampingPath,
            'transkrip' => $transkripPath,
        ]);

        return redirect()->route('pendidikan')->with('success', 'Data pendidikan berhasil disimpan!');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $pendidikan = Pendidikan::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('education.edit_pendidikan', compact('pendidikan'));
    }

    // Simpan hasil edit
    public function update(Request $request, $id)
    {
        $pendidikan = Pendidikan::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $validated = $request->validate([
            'jenjang' => 'required',
            'institusi' => 'required',
            'lulusan' => 'nullable|string',
            'gelar' => 'nullable|string',
            'bidang_ilmu' => 'nullable|string',
            'jurusan' => 'required',
            'alamat_institusi' => 'required',
            'no_ijazah' => 'required',
            'tanggal_masuk' => 'required|date',
            'tanggal_lulus' => 'required|date',
            'ijazah' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'file_pendamping' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
            'transkrip' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        ]);
        

        if ($request->hasFile('ijazah')) {
            $validated['ijazah'] = $request->file('ijazah')->store('uploads/ijazah', 'public');
        }

        if ($request->hasFile('file_pendamping')) {
            $validated['file_pendamping'] = $request->file('file_pendamping')->store('uploads/pendamping', 'public');
        }

        if ($request->hasFile('transkrip')) {
            $validated['transkrip'] = $request->file('transkrip')->store('uploads/transkrip', 'public');
        }

        $pendidikan->update($validated);

        return redirect()->route('pendidikan')->with('success', 'Data pendidikan berhasil diperbarui!');
    }


    public function downloadPdf()
    {
        $user = Auth::user();
        $pendidikans = $user->pendidikan()->get(); // ambil semua data pendidikan user
    
        $pdf = Pdf::loadView('education.pdf_pendidikan', compact('pendidikans', 'user'));
        return $pdf->download('riwayat_pendidikan_' . $user->name . '.pdf');
    }


    public function destroy($id)
    {
        $pendidikan = Pendidikan::findOrFail($id);
    
        // Pastikan hanya pemilik data yang bisa hapus
        if ($pendidikan->user_id !== Auth::id()) {
            abort(403, 'Unauthorized');
        }
    
        // Hapus file jika ada
        if ($pendidikan->ijazah) {
            Storage::disk('public')->delete($pendidikan->ijazah);
        }
        if ($pendidikan->file_pendamping) {
            Storage::disk('public')->delete($pendidikan->file_pendamping);
        }
        if ($pendidikan->transkrip) {
            Storage::disk('public')->delete($pendidikan->transkrip);
        }
    
        // Hapus data dari database
        $pendidikan->delete();
    
        return redirect()->back()->with('success', 'Data pendidikan dan file terkait berhasil dihapus.');
    }


}
