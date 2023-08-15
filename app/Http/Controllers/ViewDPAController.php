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
        $users = User::where('role_id', 3)->get();

        // Filter DPAs based on user access
        $accessibleDpaData = $dpaData->filter(function ($dpa) {
            return $this->canViewDpa($dpa);
        });

        // Check if the logged-in user has role_id 1 (admin) and allow access to all DPAs
        if (auth()->user()->role_id === 1) {
            $accessibleDpaData = $dpaData;
        }

        return view('ViewDPA.index', ['dpaData' => $accessibleDpaData, 'users' => $users]);
    }

    public function assignDpa($dpaId, $userId)
    {
        $user = User::findOrFail($userId);
        $dpa = DPA::findOrFail($dpaId);

        $dpa->user_id = $user->id;
        $dpa->save();

        return redirect()->back()->with('success', 'DPA assigned successfully.');
    }

    public function canViewDpa($dpa)
    {
        // Check if the logged-in user is assigned to this DPA
        return auth()->user()->id === $dpa->user_id;
    }
    
    public function show($dpaId)
{
    $dpa = DPA::with('subDPA')->findOrFail($dpaId);

    return view('ViewDPA.show', ['dpa' => $dpa]);
}
}
