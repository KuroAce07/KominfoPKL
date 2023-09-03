<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DokumenKontrak;
use App\Models\DokumenPendukung;
use App\Models\EPurchasing;
use App\Models\DokumenJustifikasi;
use App\Models\Bast;
use App\Models\Bap;
use App\Models\Baph;
use App\Models\PilihRekanan;
use App\Models\DPA;
use App\Models\Rekanan;
use App\Models\User;

class PembantuPPTKUploadController extends Controller
{

//=====================DOKUMEN KONTRAK==========================================================

public function createDokumenKontrak()
{
    $dpas = DPA::all(); // Fetch the list of DPAs
    $dpaId = request()->query('dpaId'); // Get the value of dpaId from the URL parameter
    return view('PembantuPPTKView.dokumenkontrak.create', compact('dpas', 'dpaId'));
}

public function showDokumenKontrak($dpaId)
{
    $dokumenKontrak = DokumenKontrak::where('dpa_id', $dpaId)->firstOrFail();
    return view('PembantuPPTKView.dokumenkontrak.show', ['dokumenKontrak' => $dokumenKontrak,'dpaId' => $dpaId,]);
}


public function storeDokumenKontrak(Request $request)
{
    $validatedData = $request->validate([
        'dpa_id' => 'required|numeric', // Validate the selected DPA
        'jenis_kontrak' => 'required',
        'nama_kegiatan_transaksi' => 'required',
        'tanggal_kontrak' => 'required|date',
        'jumlah_uang' => 'required|numeric',
        'ppn' => 'nullable|numeric',
        'pph' => 'nullable|numeric',
        'potongan_lain' => 'nullable|numeric',
        'jumlah_potongan' => 'nullable|numeric',
        'jumlah_total' => 'required|numeric',
        'keterangan' => 'nullable|string',
        'upload_dokumen' => 'nullable|file',
        'alasan' => 'nullable',
    ]);

    $dokumenKontrak = new DokumenKontrak($validatedData);
    $dokumenKontrak->dpa_id = $request->input('dpa_id');

    // Process and store the uploaded file
    if ($request->hasFile('upload_dokumen')) {
        $uploadedFile = $request->file('upload_dokumen');

        // Create a directory path based on the dpa_id
        $directoryPath = public_path('uploads') . DIRECTORY_SEPARATOR . $dokumenKontrak->dpa_id;

        // Make sure the directory exists, if not, create it
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        // Move the uploaded file to the directory
        $fileName = time() . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedFile->move($directoryPath, $fileName);

        // Update the dokumenKontrak with the file information
        $dokumenKontrak->upload_dokumen = $directoryPath . DIRECTORY_SEPARATOR . $fileName;
    }

    $dokumenKontrak->save();

    return redirect()->route('PembantuPPTKView.dokumenkontrak.create')->with('success', 'Dokumen Kontrak saved successfully.');
}

public function editDokumenKontrak($id)
{
    $dokumenKontrak = DokumenKontrak::findOrFail($id);
    $dpas = DPA::all(); // Fetch the list of DPAs
    return view('PembantuPPTKView.dokumenkontrak.edit', ['dokumenKontrak' => $dokumenKontrak, 'dpas' => $dpas]);
}

public function updateDokumenKontrak(Request $request, $id)
{
    $validatedData = $request->validate([
        'dpa_id' => 'nullable|numeric', // Validate the selected DPA
        'jenis_kontrak' => 'nullable',
        'nama_kegiatan_transaksi' => 'nullable',
        'tanggal_kontrak' => 'nullable|date',
        'jumlah_uang' => 'nullable|numeric',
        'ppn' => 'nullable|numeric',
        'pph' => 'nullable|numeric',
        'potongan_lain' => 'nullable|numeric',
        'jumlah_potongan' => 'nullable|numeric',
        'jumlah_total' => 'nullable|numeric',
        'keterangan' => 'nullable|string',
        'upload_dokumen' => 'nullable|file',
        'alasan' => 'nullable',
    ]);

    $dokumenKontrak = DokumenKontrak::findOrFail($id);
    $dokumenKontrak->fill($validatedData);

    // Set the approval value based on checkbox
    if ($request->has('approval')) {
        $dokumenKontrak->approval = 0; // Default value if neither checkbox is checked
    } elseif ($request->has('reject')) {
        $dokumenKontrak->approval = 2;
    } else {
        $dokumenKontrak->approval = 1;
    }

    $dokumenKontrak->save();
    $dpa_id = $request->input('dpa_id'); // Retrieve the value of 'dpa_id' from the request

    return redirect()->route('PembantuPPTKView.dokumenkontrak.show', ['dpaId' => $dpa_id])->with('success', 'Dokumen Kontrak updated successfully.');
    
}

    //=====================DOKUMEN JUSTIFIKASI==========================================================
    public function createDokumenJustifikasi()
    {
        $dpas = DPA::all(); // Fetch the list of DPAs
        $dpaId = request()->query('dpaId');
        return view('PembantuPPTKView.dokumenjustifikasi.create', compact('dpas', 'dpaId'));
    }
    
    public function indexDokumenJustifikasi($dpaId)
    {
    $dokumenJustifikasi = DokumenJustifikasi::where('dpa_id', $dpaId)->get();
    $dpas = DPA::all();
    return view('PembantuPPTKView.dokumenjustifikasi.index', ['dokumenJustifikasi' => $dokumenJustifikasi, 'dpas' => $dpas, 'dpaId' => $dpaId,]);
    }  

    public function storeDokumenJustifikasi(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable',
            'upload_dokumen' => 'nullable|file',
            'dpa_id' => 'required|numeric', // Validate the selected DPA
            'alasan' => 'nullable',
        ]);
    
        $dokumenJustifikasi = new DokumenJustifikasi($validatedData);
        $dokumenJustifikasi->dpa_id = $request->input('dpa_id');
    
        // Process and store the uploaded file
        if ($request->hasFile('upload_dokumen')) {
            $uploadedFile = $request->file('upload_dokumen');
    
            $directoryPath = public_path('uploads') . DIRECTORY_SEPARATOR . $dokumenJustifikasi->dpa_id;
    
            if (!file_exists($directoryPath)) {
                mkdir($directoryPath, 0777, true);
            }
    
            $fileName = time() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move($directoryPath, $fileName);
    
            $dokumenJustifikasi->upload_dokumen = $directoryPath . DIRECTORY_SEPARATOR . $fileName;
        }
    
        $dokumenJustifikasi->save();
    
        return redirect()->route('PembantuPPTKView.dokumenjustifikasi.create')->with('success', 'Dokumen Justifikasi saved successfully.');
    }

    public function editDokumenJustifikasi($id)
    {
        $dokumenJustifikasi = DokumenJustifikasi::findOrFail($id);
        $dpas = DPA::all(); // Fetch the list of DPAs

        return view('PembantuPPTKView.dokumenjustifikasi.edit', ['dokumenJustifikasi' => $dokumenJustifikasi,'dpas' => $dpas,]);
    }

    public function updateDokumenJustifikasi(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'nullable',
            'tanggal' => 'nullable|date',
            'keterangan' => 'nullable',
            'upload_dokumen' => 'nullable|file',
            'alasan' => 'nullable',
        ]);

        $dokumenJustifikasi = DokumenJustifikasi::findOrFail($id);
        $dokumenJustifikasi->fill($validatedData);
    
        
        if ($request->has('approval')) {
            $dokumenJustifikasi->approval = 0; 
        } elseif ($request->has('reject')) {
            $dokumenJustifikasi->approval = 2;
        } else {
            $dokumenJustifikasi->approval = 1;
        }
    
        $dpaId = $request->input('dpa_id'); 
        $dokumenJustifikasi->dpa_id = $dpaId;
        $dokumenJustifikasi->save();
    
        return redirect()->route('PembantuPPTKView.dokumenjustifikasi.index', ['dpaId' => $dpaId])->with('success', 'Dokumen Justifikasi updated successfully.');
    }

    //=====================E-PURCHASING==========================================================

    public function createEPurchasing()
    {
        $dpas = DPA::all(); // Fetch the list of DPAs
        $pejabatPengadaanUsers = User::where('role_id', 4)->get();
        $dpaId = request()->query('dpaId');
        return view('PembantuPPTKView.epurchaseview.create', ['dpas' => $dpas, 'pejabatPengadaanUsers' => $pejabatPengadaanUsers]);
    }
    
    
    public function indexEPurchasing($dpaId)
    {
        $ePurchasing = EPurchasing::select('e_purchasings.*', 'users.first_name', 'users.last_name')
            ->join('users', 'users.id', '=', 'e_purchasings.nama_pejabat_pengadaan')
            ->where('dpa_id', $dpaId)
            ->firstOrFail();
    
        return view('PembantuPPTKView.epurchaseview.index', ['ePurchasing' => $ePurchasing]);
    }
            
        
        
    
        public function storeEPurchasing(Request $request)
        {
            $validatedData = $request->validate([
                'e_commerce' => 'nullable',
                'id_paket' => 'nullable',
                'jumlah' => 'nullable|numeric',
                'harga_total' => 'nullable|numeric',
                'tanggal_buat' => 'nullable|date',
                'tanggal_ubah' => 'nullable|date',
                'nama_pejabat_pengadaan' => 'nullable',
                'nama_penyedia' => 'nullable',
                'dpa_id' => 'nullable|numeric', // Validate the selected DPA
                'upload_dokumen' => 'nullable|file', // Add file validation
                'alasan' => 'nullable',
            ]);
        
            $ePurchasing = new EPurchasing($validatedData);
            $ePurchasing->dpa_id = $request->input('dpa_id');
        
            // Process and store the uploaded file
            if ($request->hasFile('upload_dokumen')) {
                $uploadedFile = $request->file('upload_dokumen');
        
                $directoryPath = public_path('uploads') . DIRECTORY_SEPARATOR . $ePurchasing->dpa_id;
        
                if (!file_exists($directoryPath)) {
                    mkdir($directoryPath, 0777, true);
                }
        
                $fileName = time() . '.' . $uploadedFile->getClientOriginalExtension();
                $uploadedFile->move($directoryPath, $fileName);
        
                $ePurchasing->upload_dokumen = $directoryPath . DIRECTORY_SEPARATOR . $fileName;
            }
        
            $ePurchasing->save();
        
            return redirect()->route('PembantuPPTKView.epurchaseview.create')->with('success', 'E-Purchasing data saved successfully.');
        }    
        
        public function editEPurchasing($id)
        {
            $ePurchasing = EPurchasing::findOrFail($id);
            $dpas = DPA::all(); // Fetch the list of DPAs
            $pejabatPengadaanUsers = User::where('role_id', 4)->get();
        
            return view('PembantuPPTKView.epurchaseview.edit', [
                'ePurchasing' => $ePurchasing,
                'dpas' => $dpas,
                'pejabatPengadaanUsers' => $pejabatPengadaanUsers, // Include this line
            ]);
        }
        


        public function updateEPurchasing(Request $request, $id)
        {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'e_commerce' => 'nullable',
                'id_paket' => 'nullable',
                'jumlah' => 'nullable|numeric',
                'harga_total' => 'nullable|numeric',
                'tanggal_buat' => 'nullable|date',
                'tanggal_ubah' => 'nullable|date',
                'nama_pejabat_pengadaan' => 'nullable',
                'nama_penyedia' => 'nullable',
                'dpa_id' => 'required|numeric', // Validate the selected DPA
                'alasan' => 'nullable',

            ]);
        
            $ePurchasing = EPurchasing::findOrFail($id);
            $ePurchasing->fill($validatedData);
        
            // Set the approval value based on checkbox
            if ($request->has('approval')) {
                $ePurchasing->approval = 0; // Default value if neither checkbox is checked
            } elseif ($request->has('reject')) {
                $ePurchasing->approval = 2;
            } else {
                $ePurchasing->approval = 1;
            }
        
            $dpaId = $request->input('dpa_id'); // Retrieve dpaId from the input
            $ePurchasing->dpa_id = $dpaId;
            $ePurchasing->save();
        
            return redirect()->route('PembantuPPTKView.epurchaseview.index', ['dpaId' => $dpaId])->with('success', 'E-Purchasing data updated successfully.');
        }
    
//=====================DOKUMEN PENDUKUNG==========================================================

public function createDokumenPendukung()
{
    $dpas = DPA::all(); 
    $dpaId = request()->query('dpaId');
    return view('PembantuPPTKView.dokumenpendukung.create', compact('dpas', 'dpaId'));
}

public function indexDokumenPendukung($dpaId)
{
    $dokumenPendukung = DokumenPendukung::where('dpa_id', $dpaId)->firstOrFail();
    return view('PembantuPPTKView.dokumenpendukung.index', ['dokumenPendukung' => $dokumenPendukung, 'dpaId' => $dpaId,]);
}

public function storeDokumenPendukung(Request $request)
{
    $validatedData = $request->validate([
        'nama' => 'required',
        'tanggal' => 'required|date',
        'keterangan' => 'nullable',
        'upload_dokumen' => 'nullable|file',
        'dpa_id' => 'required|numeric',
        'alasan' => 'nullable',
    ]);

    $dokumenPendukung = new DokumenPendukung($validatedData);
    $dokumenPendukung->dpa_id = $request->input('dpa_id');

    // Process and store the uploaded file
    if ($request->hasFile('upload_dokumen')) {
        $uploadedFile = $request->file('upload_dokumen');
        
        // Create a directory path based on the dpa_id
        $directoryPath = public_path('uploads') . DIRECTORY_SEPARATOR . $dokumenPendukung->dpa_id;

        // Make sure the directory exists, if not, create it
        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        // Move the uploaded file to the directory
        $fileName = time() . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedFile->move($directoryPath, $fileName);

        // Update the dokumenPendukung with the file information
        $dokumenPendukung->upload_dokumen = $directoryPath . DIRECTORY_SEPARATOR . $fileName;
    }

    $dokumenPendukung->save();

    return redirect()->route('PembantuPPTKView.dokumenpendukung.create')->with('success', 'Dokumen Pendukung saved successfully.');
}


public function editDokumenPendukung($id)
{
    $dokumenPendukung = DokumenPendukung::findOrFail($id);
    $dpas = DPA::all(); // Fetch the list of DPAs
    return view('PembantuPPTKView.dokumenpendukung.edit', ['dokumenPendukung' => $dokumenPendukung,'dpas' => $dpas]);
}

public function updateDokumenPendukung(Request $request, $id)
{
    $validatedData = $request->validate([
        'nama' => 'nullable',
        'tanggal' => 'nullable|date',
        'keterangan' => 'nullable',
        'upload_dokumen' => 'nullable|file',
        'alasan' => 'nullable',
    ]);

    $dokumenPendukung = DokumenPendukung::findOrFail($id);
    $dokumenPendukung->fill($validatedData);

    if ($request->has('approval')) {
        $dokumenPendukung->approval = 0; // Default value if neither checkbox is checked
    } elseif ($request->has('reject')) {
        $dokumenPendukung->approval = 2;
    } else {
        $dokumenPendukung->approval = 1;
    }

    $dpaId = $request->input('dpa_id'); // Retrieve dpaId from the input
    $dokumenPendukung->save();
    $dpa_id = $request->input('dpa_id');

    return redirect()->route('PembantuPPTKView.dokumenpendukung.index', ['dpaId' => $dpaId])->with('success', 'Dokumen Pendukung data updated successfully.');
}

    //=====================BAST==========================================================

    public function createBast()
    {
        $dpas = DPA::all();
        $dpaId = request()->query('dpaId');
        return view('PembantuPPTKView.bast.create', compact('dpas', 'dpaId'));
    }

    public function indexBast($dpaId)
    {
    $bast = Bast::where('dpa_id', $dpaId)->firstOrFail();
    $dpas = DPA::all();
    return view('PembantuPPTKView.bast.index', ['bast' => $bast, 'dpaId' => $dpaId,]);
    }

    public function storeBast(Request $request)
    {
        $validatedData = $request->validate([
            'nomor' => 'required',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable',
            'upload_dokumen' => 'nullable|file',
            'dpa_id' => 'required|numeric',
            'alasan' => 'nullable',
        ]);
    
        $bast = new Bast($validatedData);
        $bast->dpa_id = $request->input('dpa_id');
    
        // Process and store the uploaded file
        if ($request->hasFile('upload_dokumen')) {
            $uploadedFile = $request->file('upload_dokumen');
    
            $directoryPath = public_path('uploads') . DIRECTORY_SEPARATOR . $bast->dpa_id;
    
            if (!file_exists($directoryPath)) {
                mkdir($directoryPath, 0777, true);
            }
    
            $fileName = time() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move($directoryPath, $fileName);
    
            $bast->upload_dokumen = $directoryPath . DIRECTORY_SEPARATOR . $fileName;
        }
    
        $bast->save();
    
        return redirect()->route('PembantuPPTKView.bast.create')->with('success', 'BAST saved successfully.');
    }

    public function editBast($id)
    {
        $bast = Bast::findOrFail($id);
        $dpas = DPA::all(); 
        return view('PembantuPPTKView.bast.edit', ['bast' => $bast, 'dpas' => $dpas]);
    }
    
    public function updateBast(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nomor' => 'nullable',
            'tanggal' => 'nullable|date',
            'keterangan' => 'nullable',
            'upload_dokumen' => 'nullable|file',
            'dpa_id' => 'required|numeric',
            'alasan' => 'nullable',
        ]);
    

        $bast = Bast::findOrFail($id);
        $bast->fill($validatedData);
    
        if ($request->has('approval')) {
            $bast->approval = 0; // Default value if neither checkbox is checked
        } elseif ($request->has('reject')) {
            $bast->approval = 2;
        } else {
            $bast->approval = 1;
        }
    
        $dpaId = $request->input('dpa_id');
        $dpa_id = $request->input('dpa_id');
        $bast->save();
    
        return redirect()->route('PembantuPPTKView.bast.index', ['dpaId' => $dpaId])->with('success', 'BAST data updated successfully.');
    }
    

    //=====================BERITA ACARA PEMBAYARAN==========================================================

    public function createBap()
{
    $dpas = DPA::all(); // Fetch the list of DPAs
    $dpaId = request()->query('dpaId');
    return view('PembantuPPTKView.bap.create', compact('dpas', 'dpaId'));
}

public function indexBap($dpaId)
{
    $baps = Bap::where('dpa_id', $dpaId)->firstOrFail();
    return view('PembantuPPTKView.bap.index', ['baps' => $baps, 'dpaId' => $dpaId,]); 
}

public function storeBap(Request $request)
{
    $validatedData = $request->validate([
        'nomor' => 'required',
        'tanggal' => 'required|date',
        'keterangan' => 'nullable',
        'upload_dokumen' => 'nullable|file',
        'dpa_id' => 'required|numeric',
        'alasan' => 'nullable',
    ]);

    $bap = new Bap($validatedData);
    $bap->dpa_id = $request->input('dpa_id');

    // Process and store the uploaded file
    if ($request->hasFile('upload_dokumen')) {
        $uploadedFile = $request->file('upload_dokumen');

        $directoryPath = public_path('uploads') . DIRECTORY_SEPARATOR . $bap->dpa_id;

        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        $fileName = time() . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedFile->move($directoryPath, $fileName);

        $bap->upload_dokumen = $directoryPath . DIRECTORY_SEPARATOR . $fileName;
    }

    $bap->save();

    return redirect()->route('PembantuPPTKView.bap.create')->with('success', 'BAP saved successfully.');
}

public function editBap($id)
{
    $baps = Bap::findOrFail($id);
    $dpas = DPA::all(); 
    return view('PembantuPPTKView.bap.edit', ['baps' => $baps, 'dpas' => $dpas]);
}

public function updateBap(Request $request, $id)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'nomor' => 'nullable',
        'tanggal' => 'nullable|date',
        'keterangan' => 'nullable',
        'upload_dokumen' => 'nullable|file',
        'dpa_id' => 'required|numeric',
        'alasan' => 'nullable',
    ]);

    $baps = Bap::findOrFail($id);
    $baps->fill($validatedData);

    if ($request->has('approval')) {
        $baps->approval = 0;
    } elseif ($request->has('reject')) {
        $baps->approval = 2;
    } else {
        $baps->approval = 1;
    }

    $dpaId = $request->input('dpa_id'); 
    $baps->dpa_id = $dpaId;
    $baps->save();

    return redirect()->route('PembantuPPTKView.bap.index', ['dpaId' => $dpaId])->with('success', 'BAP data updated successfully.');
}

    //=====================BERITA ACARA PEMERIKSAAN HASIL PEKERJAAN==========================================================


    public function createBaph()
{
    $dpas = DPA::all(); // Fetch the list of DPAs
    $dpaId = request()->query('dpaId');
    return view('PembantuPPTKView.baph.create', compact('dpas', 'dpaId'));
}

public function indexBaph($dpaId)
{
    $baphs = Baph::where('dpa_id', $dpaId)->firstOrFail();
    return view('PembantuPPTKView.baph.index', ['baphs' => $baphs, 'dpaId' => $dpaId,]); 
}

public function storeBaph(Request $request)
{
    $validatedData = $request->validate([
        'nomor' => 'required',
        'tanggal' => 'required|date',
        'keterangan' => 'nullable',
        'upload_dokumen' => 'nullable|file',
        'dpa_id' => 'required|numeric',
        'alasan' => 'nullable',
    ]);

    $baph = new Baph($validatedData);
    $baph->dpa_id = $request->input('dpa_id');

    // Process and store the uploaded file
    if ($request->hasFile('upload_dokumen')) {
        $uploadedFile = $request->file('upload_dokumen');

        $directoryPath = public_path('uploads') . DIRECTORY_SEPARATOR . $baph->dpa_id;

        if (!file_exists($directoryPath)) {
            mkdir($directoryPath, 0777, true);
        }

        $fileName = time() . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedFile->move($directoryPath, $fileName);

        $baph->upload_dokumen = $directoryPath . DIRECTORY_SEPARATOR . $fileName;
    }

    $baph->save();

    return redirect()->route('PembantuPPTKView.baph.create')->with('success', 'BAP saved successfully.');
}


public function editBaph($id)
{
    $baphs = Baph::findOrFail($id);
    $dpas = DPA::all(); 
    return view('PembantuPPTKView.baph.edit', ['baphs' => $baphs, 'dpas' => $dpas]);
}

public function updateBaph(Request $request, $id)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'nomor' => 'nullable',
        'tanggal' => 'nullable|date',
        'keterangan' => 'nullable',
        'upload_dokumen' => 'nullable|file',
        'dpa_id' => 'required|numeric',
        'alasan' => 'nullable',
    ]);

    $baphs = Baph::findOrFail($id);
    $baphs->fill($validatedData);

    if ($request->has('approval')) {
        $baphs->approval = 0;
    } elseif ($request->has('reject')) {
        $baphs->approval = 2;
    } else {
        $baphs->approval = 1;
    }

    $dpaId = $request->input('dpa_id'); 
    $baphs->dpa_id = $dpaId;
    $baphs->save();

    return redirect()->route('PembantuPPTKView.baph.index', ['dpaId' => $dpaId])->with('success', 'BAPH data updated successfully.');
}
    
//=====================PILIH REKANAN==========================================================

public function createPilihRekanan()
{
    $dpas = DPA::all();
    $rekanans = Rekanan::all(); 

    return view('PembantuPPTKView.pilihrekanan.create', ['dpas' => $dpas,'rekanans' => $rekanans,]);
}

public function indexPilihRekanan($dpaId)
{
    $pilihanRekanan = PilihRekanan::where('dpa_id', $dpaId)->firstOrFail();
    $rekanans = Rekanan::all();
    $dpas = DPA::all(); 
    
    return view('PembantuPPTKView.pilihrekanan.index', compact('pilihanRekanan', 'rekanans', 'dpas')); // add 'dpas' to the compact function
}

public function storePilihRekanan(Request $request)
{
    $validatedData = $request->validate([
        'pilih' => 'required',
        'detail' => 'required',
        'jenis_pengadaan' => 'required',
        'keterangan' => 'required',
        'dpa_id' => 'required|numeric', 
        'alasan' => 'nullable',
    ]);

    $pilihanRekanan = new PilihRekanan($validatedData);
    $pilihanRekanan->dpa_id = $request->input('dpa_id');
    $pilihanRekanan->save();

    return redirect()->route('PembantuPPTKView.pilihrekanan.create')->with('success', 'Pilihan Rekanan saved successfully.');
}

public function editPilihRekanan($id)
{
    $pilihanRekanan = PilihRekanan::findOrFail($id);
    $dpas = DPA::all();
    $rekanans = Rekanan::all(); 

    return view('PembantuPPTKView.pilihrekanan.edit', ['pilihanRekanan' => $pilihanRekanan,'dpas' => $dpas,'rekanans' => $rekanans, ]);
}

public function updatePilihRekanan(Request $request, $id)
{
    $validatedData = $request->validate([
        'pilih' => 'nullable',
        'detail' => 'nullable',
        'jenis_pengadaan' => 'nullable',
        'keterangan' => 'nullable',
        'dpa_id' => 'required|numeric', 
        'alasan' => 'nullable',
    ]);

    $pilihanRekanan = PilihRekanan::findOrFail($id);
    $pilihanRekanan->fill($validatedData);

    if ($request->has('approval')) {
        $pilihanRekanan->approval = 0; 
    } elseif ($request->has('reject')) {
        $pilihanRekanan->approval = 2;
    } else {
        $pilihanRekanan->approval = 1;
    }

    $dpaId = $request->input('dpa_id'); 
    $pilihanRekanan->dpa_id = $dpaId;
    $pilihanRekanan->save();

    return redirect()->route('PembantuPPTKView.pilihrekanan.index', ['dpaId' => $dpaId])->with('success', 'Pilihan Rekanan data updated successfully.');
}

public function dokumenPembantuPPTK()
{
return view('PembantuPPTKView.dokumenpembantupptk');
}

}


