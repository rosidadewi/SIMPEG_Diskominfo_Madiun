<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RiwayatPekerjaan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class RiwayatPekerjaanController extends Controller
{
    public function index()
    {
        // Menampilkan semua data riwayat pekerjaan user yang login
        $data = RiwayatPekerjaan::with('user')
                    ->where('user_id', Auth::id())
                    ->get();

        return view('job.riwayat_pekerjaan', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pangkat' => 'required',
            'jabatan' => 'required',
            'unit_kerja' => 'required',
            'sub_bagian' => 'nullable',
            'nip' => 'required',
            'nomor_sk' => 'required',
            'tanggal_sk' => 'required|date',
            'tmt_sk' => 'required|date',
            'mutasi' => 'nullable',
            'file_sk' => 'nullable|file|mimes:pdf',
        ], [
            'file_sk.mimes' => 'File harus berformat PDF',
        ]);

        $file_sk = null;
        if ($request->hasFile('file_sk')) {
            $file_sk = $request->file('file_sk')->store('uploads/sk/', 'public');
        }

        RiwayatPekerjaan::create([
            'user_id' => auth()->id(),
            'pangkat' => $request->pangkat,
            'jabatan' => $request->jabatan,
            'unit_kerja' => $request->unit_kerja,
            'sub_bagian' => $request->sub_bagian ?? '-',
            'nip' => $request->nip,
            'nomor_sk' => $request->nomor_sk,
            'tanggal_sk' => $request->tanggal_sk,
            'tmt_sk' => $request->tmt_sk,
            'mutasi' => $request->mutasi ?? '-',
            'file_sk' => $file_sk,
        ]);

        return redirect()->route('pekerjaan')->with('success', 'Data riwayat pekerjaan berhasil disimpan.');
    }

    public function edit($id)
    {
        $pekerjaan = RiwayatPekerjaan::findOrFail($id);
        return view('job.edit_pekerjaan', compact('pekerjaan'));
    }

    public function update(Request $request, $id)
    {
        $pekerjaan = RiwayatPekerjaan::findOrFail($id);

        $request->validate([
            'pangkat' => 'required',
            'jabatan' => 'required',
            'unit_kerja' => 'required',
            'sub_bagian' => 'nullable',
            'nip' => 'required',
            'nomor_sk' => 'required',
            'tanggal_sk' => 'required|date',
            'tmt_sk' => 'required|date',
            'mutasi' => 'nullable',
            'file_sk' => 'nullable|file|mimes:pdf',
        ]);

        // Simpan file baru jika diunggah
        if ($request->hasFile('file_sk')) {
            // Hapus file lama jika ada
            if ($pekerjaan->file_sk && Storage::disk('public')->exists($pekerjaan->file_sk)) {
                Storage::disk('public')->delete($pekerjaan->file_sk);
            }

            $pekerjaan->file_sk = $request->file('file_sk')->store('uploads/sk/', 'public');
        }

        $pekerjaan->update($request->except('file_sk'));

        return redirect()->route('pekerjaan')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pekerjaan = RiwayatPekerjaan::findOrFail($id);

        // Hapus file SK dari storage jika ada
        if ($pekerjaan->file_sk && Storage::disk('public')->exists($pekerjaan->file_sk)) {
            Storage::disk('public')->delete($pekerjaan->file_sk);
        }

        $pekerjaan->delete();

        return redirect()->route('pekerjaan')->with('success', 'Data berhasil dihapus.');
    }


}
