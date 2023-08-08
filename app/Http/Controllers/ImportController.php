<?php

namespace App\Http\Controllers;

use App\Models\ArsipLama;

class ImportController extends Controller
{
    public function showImportedData()
    {
        $importedData = ArsipLama::all(); // Fetch all the imported data from the database

        return view('imported_data', compact('importedData'));
    }
}
