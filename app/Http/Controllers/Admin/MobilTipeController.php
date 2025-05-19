<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use App\Models\MobilTipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Import Storage for file handling

class MobilTipeController extends Controller
{
    public function index()
    {
        // Mengambil semua mobil beserta tipe-tipe yang dimiliki
        $mobils = Mobil::with(['tipeMobil' => function($query) {
                        $query->orderBy('harga_mobil', 'asc');
                    }])
                    ->orderBy('harga_mulai', 'asc')
                    ->paginate(10);

        return view('admin.mobil_tipe.index_tipe', compact('mobils'));
    }

    public function show(MobilTipe $tipe)
    {
        return view('admin.mobil_tipe.detail_tipe', compact('tipe'));
    }

    // Proses untuk menampilkan form tambah tipe mobil
    public function create()
    {
        // Retrieve all mobil data to pass to the view for dropdown
        $mobils = Mobil::orderBy('nama_mobil')->get();
        return view('admin.mobil_tipe.create_tipe', compact('mobils'));
    }

    // Proses untuk menyimpan data tipe mobil
    public function store(Request $req)
    {
        // Validate the input
        $data = $req->validate([
            'id_mobil' => 'required|exists:mobil,id', // Ensure selected mobil exists
            'nama_tipe' => 'required|string|max:255',
            'spesifikasi' => 'nullable|string',
            'gambar_mobil_tipe' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // Validasi image
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

    // Proses untuk menampilkan form edit tipe mobil
    public function edit(MobilTipe $tipe)
    {
        // Ambil daftar mobil untuk dropdown
        $mobils = Mobil::orderBy('nama_mobil')->get();
        return view('admin.mobil_tipe.edit_tipe', compact('tipe', 'mobils'));
    }

    // Proses untuk memperbarui data tipe mobil
    public function update(Request $req, MobilTipe $tipe)
    {
        // Validasi input
        $data = $req->validate([
            'id_mobil' => 'required|exists:mobil,id', // Periksa apakah mobil yang dipilih ada
            'nama_tipe' => 'required|string|max:255',
            'spesifikasi' => 'nullable|string',
            'gambar_mobil_tipe' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'harga_mobil' => 'required|integer',
        ]);

        // Jika checkbox untuk menghapus gambar dicentang
        if ($req->has('hapus_gambar')) {
            // Hapus gambar dari storage jika ada
            if ($tipe->gambar_mobil_tipe) {
                Storage::delete('public/' . $tipe->gambar_mobil_tipe);
            }
            $data['gambar_mobil_tipe'] = null; // Set gambar menjadi null
        }

        // Cek jika ada gambar yang diupload
        if ($req->hasFile('gambar_mobil_tipe')) {
            // Hapus gambar lama jika ada
            if ($tipe->gambar_mobil_tipe) {
                Storage::delete('public/' . $tipe->gambar_mobil_tipe);
            }

            // Upload gambar baru
            $file = $req->file('gambar_mobil_tipe');
            $filePath = 'mobil_tipe/' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/mobil_tipe'), $filePath);
            $data['gambar_mobil_tipe'] = $filePath;
        }

        // Update data tipe mobil di database
        $tipe->update($data);

        return redirect()->route('admin.mobil_tipe.index_tipe')->with('success', 'Tipe Mobil berhasil diperbarui');
    }

    // Proses untuk menghapus tipe mobil
    public function destroy(MobilTipe $tipe)
    {
        // Hapus gambar dari storage jika ada
        if ($tipe->gambar_mobil_tipe) {
            Storage::delete('public/' . $tipe->gambar_mobil_tipe);
        }

        // Hapus data tipe dari database
        $tipe->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.mobil_tipe.index_tipe')->with('success', 'Tipe Mobil berhasil dihapus');
    }
}
