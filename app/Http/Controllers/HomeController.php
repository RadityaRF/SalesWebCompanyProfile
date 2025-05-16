<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil; // Pastikan model Mobil Anda ada di App\Models\Mobil
use Jenssegers\Agent\Agent; // Install package ini dengan: composer require jenssegers/agent

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama dengan daftar mobil awal.
     */
    public function index(Request $request)
    {
        $jenisList = ['All', 'SUV', 'Sedan', 'MPV', 'City Car & Hatchback', 'Sports'];

        // Deteksi perangkat mobile
        $agent = new Agent();
        $isMobile = $agent->isMobile();

        // Tampilkan semua mobil pada awalnya
        $query = Mobil::query();
        if (!$isMobile) {
            $currentFilter = $request->query('jenis', 'All');
            if ($currentFilter !== 'All') {
                $query->where('jenis_mobil', $currentFilter);
            }
        }

        // Mendapatkan mobil
        $mobils = $query->latest()->get();

        return view('homepage.home', [
            'mobils' => $mobils,
            'jenisList' => $jenisList,
        ]);
    }

    public function filterMobil(Request $request)
    {
        // Deteksi perangkat mobile
        $agent = new Agent();
        $isMobile = $agent->isMobile();

        $jenis = $request->query('jenis');
        $mobils = Mobil::when($jenis && $jenis !== 'All', function($q) use ($jenis) {
            $q->where('jenis_mobil', $jenis);
        })->get();

        // Kembalikan partial view
        return view('homepage.car_grid', compact('mobils'))->render();
    }
}
