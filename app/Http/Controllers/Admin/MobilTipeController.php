<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use App\Models\MobilTipe;
use Illuminate\Http\Request;

class MobilTipeController extends Controller
{
    public function index()
    {
        // Mengambil semua mobil beserta tipe-tipe yang dimiliki
        $mobils = Mobil::with('tipeMobil')->paginate(10);

        return view('admin.mobil_tipe.index_tipe', compact('mobils'));
    }
}
