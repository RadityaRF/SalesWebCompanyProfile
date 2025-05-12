<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MobilController extends Controller
{
    public function show($id)
    {
        // Ambil mobil + semua tipe terkait dalam sekali query
        $mobil = Mobil::with('tipeMobil')->findOrFail($id);

        return view('mobil.show', compact('mobil'));
    }
}
