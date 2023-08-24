<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DPA;
use App\Models\User;
use App\Traits\WablasTrait;
class ViewDPAController extends Controller
{
    public function index()
    {
        $dpaData = DPA::with('subDPA', 'pejabatPengadaanUser')->get();
        $users = User::where('role_id', 3)->get();
        $pejabatPengadaanUsers = User::where('role_id', 4)->get();
        $pembantupptkUsers = User::where('role_id', 5)->get();
    
        // Filter DPAs based on user access
        $accessibleDpaData = $dpaData->filter(function ($dpa) {
            return $this->canViewDpa($dpa);
        });
    
        // Check if the logged-in user has role_id 1 (admin) and allow access to all DPAs
        if (auth()->user()->role_id === 1) {
            $accessibleDpaData = $dpaData;
        }
    
        return view('ViewDPA.index', ['dpaData' => $accessibleDpaData, 'users' => $users, 'pejabatPengadaanUsers' => $pejabatPengadaanUsers, 'pembantupptkUsers' => $pembantupptkUsers]);
    }

    public function assignDpa($dpaId, $userId)
    {
        $user = User::findOrFail($userId);
        $dpa = DPA::findOrFail($dpaId);

        $dpa->user_id = $user->id;
        $dpa->save();
        
        $whatsappData = [];
        $whatsappData['phone'] = $user->mobile_number; // Assuming mobile_number is the column name in the users table
        $whatsappData['message'] = "Ada DPA Baru yang harus dikerjakan dengan Nomor DPA : {$dpa->nomor_dpa} ";
        $whatsappData['secret'] = false;
        $whatsappData['retry'] = false;
        $whatsappData['isGroup'] = false;
        WablasTrait::sendText([$whatsappData]);
        return redirect()->back()->with('success', 'DPA assigned successfully.');
    }

    public function assignPP($dpaId, $userId)
    {
    $user = User::findOrFail($userId);
    $dpa = DPA::findOrFail($dpaId);

        $dpa->user_id2 = $user->id;
        $dpa->save();

        return redirect()->back()->with('success', 'Pejabat Pengadaan assigned successfully.');
    }

    public function assignPPPTK($dpaId, $userId)
    {
    $user = User::findOrFail($userId);
    $dpa = DPA::findOrFail($dpaId);

        $dpa->user_id3 = $user->id;
        $dpa->save();

        return redirect()->back()->with('success', 'Pembantu PPTK assigned successfully.');
    }

    public function canViewDpa($dpa)
    {
        // Check if the logged-in user is assigned to this DPA as PPTK or Pembantu PPTK
        return auth()->user()->id === $dpa->user_id || auth()->user()->id === $dpa->user_id2|| auth()->user()->id === $dpa->user_id3;
    }
    
    
    public function show($dpaId)
{
    $dpa = DPA::with('subDPA')->findOrFail($dpaId);

    return view('ViewDPA.show', ['dpa' => $dpa]);
}

public function edit($dpaId)
{
    $dpa = DPA::findOrFail($dpaId);
    $users = User::where('role_id', 3)->get(); // Adjust the query based on your needs

    return view('ViewDPA.edit', ['dpa' => $dpa, 'users' => $users]);
}


public function pdf($dpaId)
{
    $dpa = DPA::findOrFail($dpaId);
    $pdfFilePath = public_path('uploads/' . $dpa->id . '/' . $dpa->id . '.pdf');

    if (file_exists($pdfFilePath)) {
        // Generate PDF view
        $pdf = PDF::loadView('ViewDPA.pdf', ['dpa' => $dpa]);

        // Return PDF download response
        return $pdf->download('dpa_' . $dpa->id . '.pdf');
    } else {
        return redirect()->back()->with('error', 'PDF file not found for this DPA.');
    }
}

public function update(Request $request, $dpaId)
{
    $dpa = DPA::findOrFail($dpaId);
    
    // Update the DPA fields based on the form inputs
    $dpa->nomor_dpa = $request->input('nomor_dpa');
    $dpa->urusan_pemerintahan = $request->input('urusan_pemerintahan');
    $dpa->bidang_urusan = $request->input('bidang_urusan');
    $dpa->program = $request->input('program');
    $dpa->kegiatan = $request->input('kegiatan');
    $dpa->dana = $request->input('dana');
    
    // Update PPTK (if applicable)
    if ($request->has('pptk')) {
        $user = User::findOrFail($request->input('pptk'));
        $dpa->user_id = $user->id;
    }

    $dpa->save();

    return redirect()->route('ViewDPA.index')->with('success', 'DPA updated successfully.');
}

}
