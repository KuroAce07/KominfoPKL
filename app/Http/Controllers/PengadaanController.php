<?php

namespace App\Http\Controllers;

use App\Models\DPA;
use Illuminate\Http\Request;
use App\Models\Pengadaan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PengadaanController extends Controller
{
    public function create_pengadaan($dpa_id)
    {
        return view('pengadaan.create_pengadaan',['dpa_id' => $dpa_id]);
    }

    public function store_pengadaan(Request $request)
    {
        $data = $request->validate([
            'dpa_id' => 'required',
            'pilihan' => 'required',
            'keterangan' => 'required',
            'berkas' => 'nullable|file|mimes:jpeg,png,pdf',
        ]);

        if ($request->hasFile('berkas')) {
            $uploadedFile = $request->file('berkas');
            $destinationPath = public_path('uploads/berkas pemilihan'); // Update the path to match your project's directory structure
            $filename = $uploadedFile->getClientOriginalName();
        
            // Move the uploaded file to the destination directory
            $uploadedFile->move($destinationPath, $filename);
        
            $data['berkas'] = 'uploads/berkas pemilihan/' . $filename;
        }
        
        // Assign the dpa_id from the form input
        $data['dpa_id'] = $request->input('dpa_id');

        // Create a new Pengadaan record with the data
        Pengadaan::create($data);

        return redirect()->route('pengadaan.create_pengadaan', ['id' => $data['dpa_id']])
            ->with('success', 'Data berhasil disimpan.');
    }

    public function berkas() {
        $berkass = Pengadaan::with(['dpa'])->get();

        return view('pengadaan.index', [
            'berkass' => $berkass
        ]);
    }

    public function delete($id)
    {
        $berkas = Pengadaan::findOrFail($id);

        // Periksa apakah pengguna memiliki peran 'Pejabat Pengadaan'
        if (!Auth::user()->hasRole('Pejabat Pengadaan')) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus dokumen pemilihan.');
        }
        
        if ($berkas->berkas) {
            // Hapus berkas fisik dari sistem berkas
            File::delete(public_path($berkas->berkas));
        }

        // Hapus rekaman dari database
        $berkas->delete();

        return redirect()->route('pengadaan.index')->with('success', 'Dokumen pemilihan berhasil dihapus.');
    }
}
