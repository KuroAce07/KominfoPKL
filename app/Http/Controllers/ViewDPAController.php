<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DPA;
use App\Models\User;

class ViewDPAController extends Controller
{
    public function index()
    {
        $dpaData = DPA::with('subDPA')->get();
        $users = User::where('role_id', 2)->get(); // Assuming role_id 2 represents TA/TP users

        return view('ViewDPA.index', ['dpaData' => $dpaData, 'users' => $users]);
    }

    public function assignDpa($dpaId, $userId)
    {
        $user = User::findOrFail($userId);
        $dpa = DPA::findOrFail($dpaId);

        $user->assignedDpas()->syncWithoutDetaching([$dpa->id]);

        return redirect()->back()->with('success', 'DPA assigned successfully.');
    }
}
