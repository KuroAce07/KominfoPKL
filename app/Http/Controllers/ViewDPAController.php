<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DPA;

class ViewDPAController extends Controller
{
    public function index()
    {
        $dpaData = DPA::all();

        return view('ViewDPA.index', ['dpaData' => $dpaData]);
    }
}