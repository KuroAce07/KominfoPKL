<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CeklisForm;
use Illuminate\Support\Facades\Response;
use PDF;

class CeklisformController extends Controller
{
    public function index($dpa_id)
    {
        $ceklisForms = CeklisForm::where('dpa_id', $dpa_id)->get();
        return view('ceklisform.index', ['ceklisForms' => $ceklisForms, 'dpa_id' => $dpa_id]);

    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'dpa_id' => 'required',
            'nama' => 'required',
            'kwitansi' => 'nullable',
            'nota_bukti_invoice' => 'nullable',
            'dok_kontrak' => 'nullable',
            'surat_pemesanan' => 'nullable',
            'surat_perjanjian' => 'nullable',
            'ringkasan_kontrak' => 'nullable',
            'dok_epurchasing' => 'nullable',
            'dok_pendukung' => 'nullable',
            'tkdn' => 'nullable',
            'berita_serah_terima' => 'nullable',
            'berita_pembayaran' => 'nullable',
            'berita_pemeriksaan' => 'nullable',

            // Validasi untuk kolom lainnya
        ]);
    
        // Set nilai default 0 jika checkbox tidak diisi, atau 1 jika diisi
        $checkboxFields = ['kwitansi', 'nota_bukti_invoice', 'surat_pemesanan', 'dok_kontrak', 'surat_perjanjian', 'ringkasan_kontrak', 'dok_epurchasing', 'dok_pendukung', 'tkdn', 'berita_serah_terima', 'berita_pembayaran', 'berita_pemeriksaan'];
        foreach ($checkboxFields as $field) {
        $data[$field] = $request->has($field) ? 1 : 0;
    }
        // Set nilai default 0 untuk kolom lainnya
    
        $pdfPath = $this->generatePDF($data['dpa_id']);
        $data['dpa_id'] = $request->input('dpa_id');
        CeklisForm::create($data);

         // Generate and save PDF
        $pdfPath = $this->generatePDF($data['dpa_id']);

        $request->session()->put('pdfPath', $pdfPath);

        return redirect()->route('ceklisform.result', ['id' => $data['dpa_id']]);
            // ->with('success', 'Data berhasil disimpan.')->with('pdfPath', $pdfPath);
    }
    
    public function generatePDF($dpa_id)
    {
        $ceklisForms = CeklisForm::where('dpa_id', $dpa_id)->get();
        // dd($ceklisForms);
        $pdf = PDF::loadView('ceklisform.pdf', ['ceklisForms' => $ceklisForms]);
        
        $pdfPath = 'uploads/' . 'ceklisform_' . $dpa_id . '.pdf';
        $pdf->save(public_path($pdfPath));
        
        return $pdfPath;
    }

    public function downloadPdf($dpa_id)
    {
        $pdfPath = $this->generatePDF($dpa_id);
        
        $pdfContent = file_get_contents(public_path($pdfPath));
        $response = Response::make($pdfContent);
        $response->header('Content-Type', 'application/pdf');
        $response->header('Content-Disposition', 'inline; filename="' . $pdfPath . '"');
        
        return $response;
    }

    public function showResult($dpa_id)
    {
        $ceklisForms = CeklisForm::where('dpa_id', $dpa_id)->get();
        return view('ceklisform.result', ['ceklisForms' => $ceklisForms, 'dpa_id' => $dpa_id]);
    }

}
