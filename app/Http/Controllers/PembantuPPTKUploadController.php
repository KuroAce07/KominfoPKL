<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EPurchase;
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



class PembantuPPTKUploadController extends Controller
{

//=====================DOKUMEN KONTRAK==========================================================
public function storeDokumenKontrak(Request $request)
{
    $validatedData = $request->validate([
        'jenis_kontrak' => 'required',
        'nama_kegiatan_transaksi' => 'required',
        'tanggal_kontrak' => 'required|date',
        'jumlah_uang' => 'required|numeric',
        'ppn' => 'nullable|numeric',
        'pph' => 'nullable|numeric',
        'jumlah_potongan' => 'nullable|numeric',
        'jumlah_total' => 'required|numeric',
        'keterangan' => 'nullable',
        'upload_dokumen' => 'nullable|file',
        'dpa_id' => 'required|numeric', // Validate the selected DPA
    ]);    

    // Handle file upload and storage here

    // Create the DokumenKontrak instance with the provided validated data
    $dokumenKontrak = new DokumenKontrak($validatedData);

    // Manually set the dpa_id value
    $dokumenKontrak->dpa_id = $request->input('dpa_id');

    // Save the DokumenKontrak instance
    $dokumenKontrak->save();

    return redirect()->route('PembantuPPTKView.dokumenkontrak.create')->with('success', 'Dokumen Kontrak saved successfully.'); 
}
    
    public function showDokumenKontrak($id)
    {
        $dokumenKontrak = DokumenKontrak::findOrFail($id);
        return view('PembantuPPTKView.dokumenkontrak.show', ['dokumenKontrak' => $dokumenKontrak]);
    }

    public function createDokumenKontrak()
    {
        $dpas = DPA::all(); // Fetch the list of DPAs

        return view('PembantuPPTKView.dokumenkontrak.create', ['dpas' => $dpas]);
    }
    
    public function editDokumenKontrak($id)
{
    $dokumenKontrak = DokumenKontrak::findOrFail($id);
    $dpas = DPA::all(); // Fetch the list of DPAs

    return view('PembantuPPTKView.dokumenkontrak.edit', [
        'dokumenKontrak' => $dokumenKontrak,
        'dpas' => $dpas,
    ]);
}

public function updateDokumenKontrak(Request $request, $id)
{
    $validatedData = $request->validate([
        'jenis_kontrak' => 'required',
        'nama_kegiatan_transaksi' => 'required',
        'tanggal_kontrak' => 'required|date',
        'jumlah_uang' => 'required|numeric',
        'ppn' => 'nullable|numeric',
        'pph' => 'nullable|numeric',
        'jumlah_potongan' => 'nullable|numeric',
        'jumlah_total' => 'required|numeric',
        'keterangan' => 'nullable',
        'upload_dokumen' => 'nullable|file',
        'dpa_id' => 'required|numeric', // Validate the selected DPA
    ]);    

    // Handle file upload and storage here

    // Retrieve the existing DokumenKontrak instance
    $dokumenKontrak = DokumenKontrak::findOrFail($id);

    // Update the DokumenKontrak instance with the provided validated data
    $dokumenKontrak->fill($validatedData);

    // Manually set the dpa_id value
    $dokumenKontrak->dpa_id = $request->input('dpa_id');

    // Save the updated DokumenKontrak instance
    $dokumenKontrak->save();

    return redirect()->route('PembantuPPTKView.dokumenkontrak.show', ['id' => $id])->with('success', 'Dokumen Kontrak updated successfully.'); 
}

    //=====================DOKUMEN JUSTIFIKASI==========================================================
    public function createDokumenJustifikasi()
    {
        $dpas = DPA::all(); // Fetch the list of DPAs

        return view('PembantuPPTKView.dokumenjustifikasi.create', ['dpas' => $dpas]);
    }

    public function indexDokumenJustifikasi()
    {
        $dokumenJustifikasi = DokumenJustifikasi::all();
        return view('PembantuPPTKView.dokumenjustifikasi.index', ['dokumenJustifikasi' => $dokumenJustifikasi]);
    }

    public function storeDokumenJustifikasi(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable',
            'upload_dokumen' => 'nullable|file',
            'dpa_id' => 'required|numeric', // Validate the selected DPA
        ]);

        // Handle file upload and storage here

        // Create the DokumenJustifikasi instance with the provided validated data
        $dokumenJustifikasi = new DokumenJustifikasi($validatedData);

        // Manually set the dpa_id value
        $dokumenJustifikasi->dpa_id = $request->input('dpa_id');

        // Save the DokumenJustifikasi instance
        $dokumenJustifikasi->save();

        return redirect()->route('PembantuPPTKView.dokumenjustifikasi.create')->with('success', 'Dokumen Justifikasi saved successfully.');
    }

    public function editDokumenJustifikasi($id)
    {
        $dokumenJustifikasi = DokumenJustifikasi::findOrFail($id);
        $dpas = DPA::all(); // Fetch the list of DPAs

        return view('PembantuPPTKView.dokumenjustifikasi.edit', [
            'dokumenJustifikasi' => $dokumenJustifikasi,
            'dpas' => $dpas,
        ]);
    }

    public function updateDokumenJustifikasi(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable',
            'upload_dokumen' => 'nullable|file',
            'dpa_id' => 'required|numeric', // Validate the selected DPA
        ]);

        // Handle file upload and storage here

        // Retrieve the existing DokumenJustifikasi instance
        $dokumenJustifikasi = DokumenJustifikasi::findOrFail($id);

        // Update the DokumenJustifikasi instance with the provided validated data
        $dokumenJustifikasi->fill($validatedData);

        // Manually set the dpa_id value
        $dokumenJustifikasi->dpa_id = $request->input('dpa_id');

        // Save the updated DokumenJustifikasi instance
        $dokumenJustifikasi->save();

        return redirect()->route('PembantuPPTKView.dokumenjustifikasi.index')->with('success', 'Dokumen Justifikasi updated successfully.');
    }

    //=====================E-PURCHASING==========================================================

        public function createEPurchasing()
        {
            $dpas = DPA::all(); // Fetch the list of DPAs

            return view('PembantuPPTKView.epurchaseview.create', ['dpas' => $dpas]);
        }
    
        public function indexEPurchasing()
        {
            $ePurchasing = EPurchasing::first(); // Retrieve the first E-Purchasing instance
            return view('PembantuPPTKView.epurchaseview.index', ['ePurchasing' => $ePurchasing]);
        }           
    
        public function storeEPurchasing(Request $request)
        {
            $validatedData = $request->validate([
                'e_commerce' => 'required',
                'id_paket' => 'required',
                'jumlah' => 'required|numeric',
                'harga_total' => 'required|numeric',
                'tanggal_buat' => 'required|date',
                'tanggal_ubah' => 'required|date',
                'nama_pejabat_pengadaan' => 'required',
                'nama_penyedia' => 'required',
                'dpa_id' => 'required|numeric', // Validate the selected DPA
            ]);
        
            // Handle file upload and storage here
        
            // Create the EPurchasing instance with the provided validated data
            $ePurchasing = new EPurchasing($validatedData);
        
            // Manually set the dpa_id value
            $ePurchasing->dpa_id = $request->input('dpa_id');
        
            // Save the EPurchasing instance
            $ePurchasing->save();
        
            return redirect()->route('PembantuPPTKView.epurchaseview.create')->with('success', 'E-Purchasing data saved successfully.');
        }
        
        public function editEPurchasing($id)
        {
            $ePurchasing = EPurchasing::findOrFail($id);
            $dpas = DPA::all(); // Fetch the list of DPAs
            return view('PembantuPPTKView.epurchaseview.edit', ['ePurchasing' => $ePurchasing, 'dpas' => $dpas]);
        }        
        

        public function updateEPurchasing(Request $request, $id)
        {
            $validatedData = $request->validate([
                'e_commerce' => 'required',
                'id_paket' => 'required',
                'jumlah' => 'required|numeric',
                'harga_total' => 'required|numeric',
                'tanggal_buat' => 'required|date',
                'tanggal_ubah' => 'required|date',
                'nama_pejabat_pengadaan' => 'required',
                'nama_penyedia' => 'required',
                'dpa_id' => 'required|numeric', // Validate the selected DPA
            ]);
        
            // Handle file upload and storage here
        
            // Retrieve the existing EPurchasing instance
            $ePurchasing = EPurchasing::findOrFail($id);
        
            // Update the EPurchasing instance with the provided validated data
            $ePurchasing->fill($validatedData);
        
            // Manually set the dpa_id value
            $ePurchasing->dpa_id = $request->input('dpa_id');
        
            // Save the updated EPurchasing instance
            $ePurchasing->save();
        
            return redirect()->route('PembantuPPTKView.epurchaseview.index')->with('success', 'E-Purchasing data updated successfully.');
        }

//=====================DOKUMEN PENDUKUNG==========================================================

    public function createDokumenPendukung()
    {
        $dpas = DPA::all(); // Fetch the list of DPAs
        return view('PembantuPPTKView.dokumenpendukung.create', ['dpas' => $dpas]);
    }

    public function indexDokumenPendukung()
    {
        $dokumenPendukung = DokumenPendukung::first(); // Retrieve the first DokumenPendukung instance
        return view('PembantuPPTKView.dokumenpendukung.index', ['dokumenPendukung' => $dokumenPendukung]);
    }

    public function storeDokumenPendukung(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable',
            'upload_dokumen' => 'nullable|file',
            'dpa_id' => 'required|numeric', // Validate the selected DPA
        ]);

        // Handle file upload and storage here

        $dokumenPendukung = new DokumenPendukung($validatedData);

        // Manually set the dpa_id value
        $dokumenPendukung->dpa_id = $request->input('dpa_id');

        // Save the DokumenPendukung instance
        $dokumenPendukung->save();

        return redirect()->route('PembantuPPTKView.dokumenpendukung.create')->with('success', 'Dokumen Pendukung saved successfully.');
    }

    public function editDokumenPendukung($id)
    {
        $dokumenPendukung = DokumenPendukung::findOrFail($id);
        $dpas = DPA::all(); // Fetch the list of DPAs
        return view('PembantuPPTKView.dokumenpendukung.edit', ['dokumenPendukung' => $dokumenPendukung, 'dpas' => $dpas]);
    }

    public function updateDokumenPendukung(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable',
            'upload_dokumen' => 'nullable|file',
            'dpa_id' => 'required|numeric', // Validate the selected DPA
        ]);

        // Handle file upload and storage here

        // Retrieve the existing DokumenPendukung instance
        $dokumenPendukung = DokumenPendukung::findOrFail($id);

        // Update the DokumenPendukung instance with the provided validated data
        $dokumenPendukung->fill($validatedData);

        // Manually set the dpa_id value
        $dokumenPendukung->dpa_id = $request->input('dpa_id');

        // Save the updated DokumenPendukung instance
        $dokumenPendukung->save();

        return redirect()->route('PembantuPPTKView.dokumenpendukung.index')->with('success', 'Dokumen Pendukung data updated successfully.');
    }

    //=====================BAST==========================================================

    public function createBast()
    {
        $dpas = DPA::all(); // Fetch the list of DPAs

        return view('PembantuPPTKView.bast.create', ['dpas' => $dpas]);
    }

    public function indexBast($id)
    {
    $bast = Bast::findOrFail($id); // Fetch the specific BAST instance by its ID
    return view('PembantuPPTKView.bast.index', ['bast' => $bast]);
    }

    public function storeBast(Request $request)
    {
        $validatedData = $request->validate([
            'nomor' => 'required',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable',
            'upload_dokumen' => 'nullable|file',
            'dpa_id' => 'required|numeric', // Validate the selected DPA
        ]);

        // Handle file upload and storage here

        // Create the Bast instance with the provided validated data
        $bast = new Bast($validatedData);

        // Manually set the dpa_id value
        $bast->dpa_id = $request->input('dpa_id');

        // Save the Bast instance
        $bast->save();

        return redirect()->route('PembantuPPTKView.bast.create')->with('success', 'BAST saved successfully.');
    }

    public function editBast($id)
    {
        $bast = Bast::findOrFail($id);
        $dpas = DPA::all(); // Fetch the list of DPAs
        return view('PembantuPPTKView.bast.edit', ['bast' => $bast, 'dpas' => $dpas]);
    }

    public function updateBast(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nomor' => 'required',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable',
            'upload_dokumen' => 'nullable|file',
            'dpa_id' => 'required|numeric', // Validate the selected DPA
        ]);

        // Handle file upload and storage here

        // Retrieve the existing Bast instance
        $bast = Bast::findOrFail($id);

        // Update the Bast instance with the provided validated data
        $bast->fill($validatedData);

        // Manually set the dpa_id value
        $bast->dpa_id = $request->input('dpa_id');

        // Save the updated Bast instance
        $bast->save();

        return redirect()->route('PembantuPPTKView.bast.index')->with('success', 'BAST data updated successfully.');
    }

    //=====================BERITA ACARA PEMBAYARAN==========================================================

    public function createBap()
    {
        $dpas = DPA::all(); // Fetch the list of DPAs
    
        return view('PembantuPPTKView.bap.create', ['dpas' => $dpas]);
    }
    
    public function indexBap()
    {
        $baps = Bap::all();
        return view('PembantuPPTKView.bap.index', ['baps' => $baps]);
    }
    
    public function storeBap(Request $request)
    {
        $validatedData = $request->validate([
            'nomor' => 'required',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable',
            'upload_dokumen' => 'nullable|file',
            'dpa_id' => 'required|numeric', // Validate the selected DPA
        ]);

        // Handle file upload and storage here

        // Create the Bast instance with the provided validated data
        $bap = new Bap($validatedData);

        // Manually set the dpa_id value
        $bap->dpa_id = $request->input('dpa_id');

        $bap->save();

        return redirect()->route('PembantuPPTKView.bap.create')->with('success', 'BAP saved successfully.');
    }
    
    public function editBap($id)
    {
        $bap = Bap::findOrFail($id);
        $dpas = DPA::all(); // Fetch the list of DPAs
        return view('PembantuPPTKView.bap.edit', ['bap' => $bap, 'dpas' => $dpas]);
    }
    
    public function updateBap(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nomor' => 'required',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable',
            'upload_dokumen' => 'nullable|file',
            'dpa_id' => 'required|numeric', // Validate the selected DPA
        ]);
    
        // Handle file upload and storage here
    
        // Retrieve the existing Bap instance
        $bap = Bap::findOrFail($id);
    
        // Update the Bap instance with the provided validated data
        $bap->fill($validatedData);
    
        // Manually set the dpa_id value
        $bap->dpa_id = $request->input('dpa_id');
    
        // Save the updated Bap instance
        $bap->save();
    
        return redirect()->route('PembantuPPTKView.bap.index')->with('success', 'BAP data updated successfully.');
    }

    //=====================BERITA ACARA PEMERIKSAAN HASIL PEKERJAAN==========================================================

    public function createBaph()
    {
        $dpas = DPA::all(); // Fetch the list of DPAs
    
        return view('PembantuPPTKView.baph.create', ['dpas' => $dpas]);
    }
    
    public function indexBaph()
    {
        $baphs = Baph::all();
        return view('PembantuPPTKView.baph.index', ['baphs' => $baphs]);
    }
    
    public function storeBaph(Request $request)
    {
        $validatedData = $request->validate([
            'nomor' => 'required',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable',
            'upload_dokumen' => 'nullable|file',
            'dpa_id' => 'required|numeric', // Validate the selected DPA
        ]);

        // Handle file upload and storage here

        // Create the Bast instance with the provided validated data
        $baph = new Baph($validatedData);

        // Manually set the dpa_id value
        $baph->dpa_id = $request->input('dpa_id');

        $baph->save();

        return redirect()->route('PembantuPPTKView.baph.create')->with('success', 'BAPH saved successfully.');
    }
    
    public function editBaph($id)
    {
        $baph = Baph::findOrFail($id);
        $dpas = DPA::all(); // Fetch the list of DPAs
        return view('PembantuPPTKView.baph.edit', ['baph' => $baph, 'dpas' => $dpas]);
    }
    
    public function updateBaph(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nomor' => 'required',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable',
            'upload_dokumen' => 'nullable|file',
            'dpa_id' => 'required|numeric', // Validate the selected DPA
        ]);
    
        // Handle file upload and storage here
    
        // Retrieve the existing Bap instance
        $baph = Baph::findOrFail($id);
    
        // Update the Bap instance with the provided validated data
        $baph->fill($validatedData);
    
        // Manually set the dpa_id value
        $baph->dpa_id = $request->input('dpa_id');
    
        // Save the updated Bap instance
        $baph->save();
    
        return redirect()->route('PembantuPPTKView.baph.index')->with('success', 'BAPH data updated successfully.');
    }



//=====================PILIH REKANAN==========================================================

public function createPilihRekanan()
{
    $dpas = DPA::all();
    $rekanans = Rekanan::all(); // Fetch the list of Rekanans
    
    return view('PembantuPPTKView.pilihrekanan.create', [
        'dpas' => $dpas,
        'rekanans' => $rekanans, // Pass the Rekanans data to the view
    ]);
}

public function indexPilihRekanan()
{
    $pilihanRekanan = PilihRekanan::findOrFail();
    $dpas = DPA::all();
    $rekanans = Rekanan::all(); // Fetch the list of Rekanans
    
    return view('PembantuPPTKView.pilihrekanan.edit', [
        'pilihanRekanan' => $pilihanRekanan,
        'dpas' => $dpas,
        'rekanans' => $rekanans, // Pass the Rekanans data to the view
    ]);
}

public function storePilihRekanan(Request $request)
{
    $validatedData = $request->validate([
        'pilih' => 'nullable',
        'detail' => 'nullable',
        'jenis_pengadaan' => 'nullable',
        'keterangan' => 'nullable',
        'dpa_id' => 'required|numeric', // Validate the selected DPA
    ]);

    // Add the 'dpa_id' to the validated data
    $validatedData['dpa_id'] = $request->input('dpa_id');

    PilihRekanan::create($validatedData);

    return redirect()->route('PembantuPPTKView.pilihrekanan.create')->with('success', 'Pilihan Rekanan saved successfully.');
}

public function editPilihRekanan($id)
{
    $pilihanRekanan = PilihRekanan::findOrFail($id);
    $dpas = DPA::all();
    $rekanans = Rekanan::all(); // Fetch the list of Rekanans
    
    return view('PembantuPPTKView.pilihrekanan.edit', [
        'pilihanRekanan' => $pilihanRekanan,
        'dpas' => $dpas,
        'rekanans' => $rekanans, // Pass the Rekanans data to the view
    ]);
}

public function updatePilihRekanan(Request $request, $id)
{
    $validatedData = $request->validate([
        'pilih' => 'nullable',
        'detail' => 'nullable',
        'jenis_pengadaan' => 'nullable',
        'keterangan' => 'nullable',
        'dpa_id' => 'required|numeric', // Validate the selected DPA
    ]);

    // Retrieve the existing PilihRekanan instance
    $pilihanRekanan = PilihRekanan::findOrFail($id);

    // Update the PilihRekanan instance with the provided validated data
    $pilihanRekanan->fill($validatedData);

    // Manually set the dpa_id value
    $pilihanRekanan->dpa_id = $request->input('dpa_id');

    // Save the updated PilihRekanan instance
    $pilihanRekanan->save();

    return redirect()->route('PembantuPPTKView.pilihrekanan.index')->with('success', 'Pilihan Rekanan data updated successfully.');
}

public function dokumenPembantuPPTK()
{
return view('PembantuPPTKView.dokumenpembantupptk');
}


}


