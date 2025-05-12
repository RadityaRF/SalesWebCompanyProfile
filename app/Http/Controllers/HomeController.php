<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Ambil daftar jenis mobil untuk nav filter
        $jenisList = ['All', 'SUV', 'Sedan', 'MPV', 'City Car & Hatchback', 'Sports'];

        // Baca filter dari query string
        $filter = $request->query('jenis', 'All');

        // Query: jika filter != All, where jenis_mobil = filter
        $query = Mobil::query();
        if ($filter !== 'All') {
            $query->where('jenis_mobil', $filter);
        }
        $mobils = $query->get();

        return view('homepage.home', compact('mobils', 'jenisList', 'filter'));
    }
}
