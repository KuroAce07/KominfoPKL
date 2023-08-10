<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BendaharaController extends Controller
{
    public function index()
    {
        return view('bendahara');
    }

    public function store(Request $request)
    {
        $uploadedFiles = [];

        // Daftar tipe file yang diizinkan
        $allowedFileTypes = ['SPP', 'SPTJMSPP', 'VerifSPP', 'SPM', 'SPTJMSPM', 'SumberDana', 'SuratPengantar', 'FormCheck'];

        foreach ($allowedFileTypes as $fileType) {
            if ($request->hasFile($fileType)) {
                $file = $request->file($fileType);
                $originalFileName = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $newFileName = $fileType . '_' . date('Ymd') . '.' . $extension;

                // Simpan file ke direktori tertentu
                $destinationPath = public_path('uploads'); // Ganti dengan path yang sesuai
                $file->move($destinationPath, $newFileName);

                // Jika perlu menyimpan informasi file ke database
                // Misalnya:
                // File::create([
                //     'filename' => $newFileName,
                //     'original_name' => $originalFileName,
                //     'mime_type' => $file->getClientMimeType(),
                //     // tambahkan kolom lain jika diperlukan
                // ]);

                $uploadedFiles[] = $fileType;
            }
        }

        if (count($uploadedFiles) > 0) {
            return "File Berhasil diunggah";
        } else {
            return "Tidak ada file yang diunggah.";
        }
    }

    public function showChecklistForm()
    {
        return view('checklist_form');
    }
}
