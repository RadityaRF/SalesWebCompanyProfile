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

        $currentFilter = $isMobile ? 'All' : $request->query('jenis', 'All');

        $query = Mobil::query();

        if ($currentFilter !== 'All') {
            $query->where('jenis_mobil', $currentFilter);
        }

        $mobils = $query->latest()->get();

        return view('homepage.home', [
            'mobils' => $mobils,
            'jenisList' => $jenisList,
            'filter' => $currentFilter,
        ]);
    }

    public function filterMobil(Request $request)
    {
        // Deteksi perangkat mobile
        $agent = new Agent();
        $isMobile = $agent->isMobile();

        if ($isMobile) {
            $mobils = Mobil::latest()->get();
        } else {
            $filterJenis = $request->query('jenis', 'All');
            $query = Mobil::query();

            if ($filterJenis && $filterJenis !== 'All') {
                $query->where('jenis_mobil', $filterJenis);
            }

            $mobils = $query->latest()->get();
        }

        if ($request->ajax()) {
            return view('homepage._car_grid', ['mobils' => $mobils])->render();
        }

        return redirect()->route('home', ['jenis' => $filterJenis ?? 'All']);
    }
}
