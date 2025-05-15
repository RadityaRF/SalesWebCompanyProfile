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

    public function show(MobilTipe $tipe)
    {
        return view('admin.mobil_tipe.detail_tipe', compact('tipe'));
    }

    public function create()
    {
        // Retrieve all mobil data to pass to the view for dropdown
        $mobils = Mobil::all(); // Adjust accordingly to get your data
        return view('admin.mobil_tipe.create_tipe', compact('mobils'));
    }

    public function store(Request $req)
    {
        // Validate the input
        $data = $req->validate([
            'id_mobil' => 'required|exists:mobil,id', // Ensure selected mobil exists
            'nama_tipe' => 'required|string|max:255',
            'spesifikasi' => 'nullable|string',
            'gambar_mobil_tipe' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validasi image
            'harga_mobil' => 'required|integer',
        ]);

        // Handle image upload
        if ($req->hasFile('gambar_mobil_tipe')) {
            $file = $req->file('gambar_mobil_tipe');
            $filePath = 'mobil_tipe/' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/mobil_tipe'), $filePath);
            $data['gambar_mobil_tipe'] = $filePath;
        }

        // Create new MobilTipe entry
        MobilTipe::create($data);

        return redirect()->route('admin.mobil_tipe.index_tipe')->with('success', 'Tipe mobil berhasil ditambahkan');
    }
}
