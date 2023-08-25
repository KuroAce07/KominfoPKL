<?php

namespace App\Http\Controllers;

use App\Models\DPA;
use Illuminate\Http\Request;
use App\Models\Pengadaan;


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
}
